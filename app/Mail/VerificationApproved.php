<?php

namespace App\Mail;

use App\Models\VerifyApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    public $user;

    /**
     * Create a new message instance.
     *
     * @param VerifyApplication $application
     * @param \App\Models\User $user
     * @return void
     */
    public function __construct(VerifyApplication $application, $user)
    {
        $this->application = $application;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Verification Application Has Been Approved')
                    ->view('emails.verification_approved')
                    ->with([
                        'userName' => $this->user->name,
                        'role' => $this->application->role === 'shelter' ? 'Pet Shelter' : 'Pet Clinic',
                    ]);
    }
}