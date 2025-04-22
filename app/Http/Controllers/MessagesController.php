<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Models\AdoptionApplication;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    /**
     * Get all conversations for the authenticated user.
     */
    public function getUserConversations(Request $request)
    {
        $userId = Auth::id();
    
        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated',
            ], 401);
        }
    
        $conversations = Conversation::where(function ($query) use ($userId) {
            $query->where('sender_id', $userId)
                  ->orWhere('receiver_id', $userId);
        })
        ->whereHas('application', function ($query) {
            $query->where('status', 'Ongoing');
        })
        ->where('sender_id', '!=', 'receiver_id') // Prevent self-conversations
        ->with([
            'sender' => function ($query) {
                $query->select('user_id', 'name', 'username', 'profile_picture', 'is_online')
                      ->whereNotNull('user_id');
            },
            'receiver' => function ($query) {
                $query->select('user_id', 'name', 'username', 'profile_picture', 'is_online')
                      ->whereNotNull('user_id');
            },
            'messages' => function ($query) {
                $query->orderBy('created_at', 'asc')
                      ->with(['sender' => function ($subQuery) {
                          $subQuery->select('user_id', 'username', 'profile_picture')
                                   ->whereNotNull('user_id');
                      }]);
            },
            'application' => function ($query) {
                $query->select('application_id', 'adopter_name', 'status')
                      ->where('status', 'Ongoing');
            }
        ])
        ->orderBy('updated_at', 'desc')
        ->get();
    
        $formattedConversations = $conversations->map(function ($conversation) use ($userId) {
            // Determine the other user (opposite of the authenticated user)
            $otherUser = $conversation->sender_id == $userId
                ? $conversation->receiver
                : $conversation->sender;
    
            // Skip if otherUser is null, invalid, or the same as the authenticated user
            if (!$otherUser || $otherUser->user_id == $userId) {
                \Log::warning("Invalid conversation detected", [
                    'conversation_id' => $conversation->conversation_id,
                    'user_id' => $userId,
                    'sender_id' => $conversation->sender_id,
                    'receiver_id' => $conversation->receiver_id,
                ]);
                return null;
            }
    
            return [
                'conversation_id' => $conversation->conversation_id,
                'other_user' => [
                    'user_id' => $otherUser->user_id,
                    'name' => $otherUser->name ?? 'Unknown User',
                    'username' => $otherUser->username ?? 'unknown',
                    'profile_picture' => $otherUser->profile_picture ?? '/default-profile.png',
                    'is_online' => $otherUser->is_online ?? false,
                ],
                'messages' => $conversation->messages ?? [],
                'application' => $conversation->application
                    ? [
                        'application_id' => $conversation->application->application_id,
                        'adopter_name' => $conversation->application->adopter_name ?? 'Unknown',
                    ]
                    : null,
                'updated_at' => $conversation->updated_at,
            ];
        })->filter()->values();
    
        return response()->json([
            'success' => true,
            'data' => $formattedConversations,
            'message' => 'Successfully retrieved ongoing adoption conversations',
        ], 200);
    }

    /**
     * Start a new conversation for an adoption application.
     */
    public function startConversation(Request $request, $applicationId)
    {
        $application = AdoptionApplication::findOrFail($applicationId);
        $userId = Auth::id();
    
        // Check if the authenticated user is the sender or receiver
        if ($application->sender_id !== $userId && $application->receiver_id !== $userId) {
            abort(403, 'Unauthorized');
        }
    
        // Check for an existing conversation
        $existingConversation = Conversation::where(function ($query) use ($application) {
            $query->where('sender_id', $application->sender_id)
                  ->where('receiver_id', $application->receiver_id);
        })->orWhere(function ($query) use ($application) {
            $query->where('sender_id', $application->receiver_id)
                  ->where('receiver_id', $application->sender_id);
        })->where('application_id', $applicationId)->first();
    
        if ($existingConversation) {
            // Fetch sender and receiver details for existing conversation
            $sender = User::findOrFail($existingConversation->sender_id, ['user_id', 'username', 'profile_picture']);
            $receiver = User::findOrFail($existingConversation->receiver_id, ['user_id', 'username', 'profile_picture']);
    
            return response()->json([
                'success' => true,
                'conversation_id' => $existingConversation->conversation_id,
                'sender' => [
                    'user_id' => $sender->user_id,
                    'username' => $sender->username,
                    'profile_picture' => $sender->profile_picture,
                ],
                'receiver' => [
                    'user_id' => $receiver->sender_id,
                    'username' => $receiver->username,
                    'profile_picture' => $receiver->sender_profile_picture,
                ],
            ]);
        }
    
        // Create a new conversation
        $conversation = Conversation::create([
            'sender_id' => $application->sender_id,
            'receiver_id' => $application->receiver_id,
            'application_id' => $applicationId,
        ]);
    
        // Fetch sender and receiver details for new conversation
        $sender = User::findOrFail($conversation->sender_id, ['id', 'username', 'profile_picture']);
        $receiver = User::findOrFail($conversation->receiver_id, ['id', 'username', 'profile_picture']);
    
        return response()->json([
            'success' => true,
            'conversation_id' => $conversation->conversation_id,
            'sender' => [
                'user_id' => $sender->id,
                'username' => $sender->username,
                'profile_picture' => $sender->profile_picture,
            ],
            'receiver' => [
                'user_id' => $receiver->id,
                'username' => $receiver->username,
                'profile_picture' => $receiver->profile_picture,
            ],
        ]);
    }

    /**
     * Send a message in a conversation.
     */
    public function sendMessage(Request $request, $conversationId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $userId = Auth::id();
        $conversation = Conversation::findOrFail($conversationId);

        if ($conversation->sender_id !== $userId && $conversation->receiver_id !== $userId) {
            abort(403, 'Unauthorized');
        }

        $message = Message::create([
            'conversation_id' => $conversationId,
            'sender_id' => $userId,
            'content' => $request->content,
        ]);

        $message->load('sender:user_id,username,profile_picture');

        return response()->json([
            'success' => true,
            'message' => $message,
            'message' => 'Message sent successfully'
        ], 201);
    }
}