<template>
    <div class="bg-base-200">
        <div class="container mx-auto py-8">
            <div class="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4">
                <!-- Profile Card -->
                <div class="col-span-4 sm:col-span-3 sticky">
                    <div class="bg-base-100 shadow-lg rounded-lg p-6">
                        <div class="flex flex-col items-center relative group">
                            <!-- Profile Picture -->
                            <img :src="`/storage/${user.profile_picture}`" class="w-32 h-32 bg-base-300 rounded-full mb-4 object-cover transition-all duration-300 group-hover:brightness-75" alt="User Avatar">

                            <!-- Camera Icon inside the Profile Picture, only shown when hovering over the image -->
                            <i class="fas fa-camera w-8 h-8 absolute top-0 bottom-0 left-0 right-0 m-auto opacity-0 hover:opacity-100 text-white bg-gray-800 p-2 rounded-full transition-opacity duration-300" @click="openModal"></i>

                            <!-- Modal for Image Preview -->
                            <div v-if="isModalOpen" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50">
                                <div class="bg-white p-6 rounded-lg w-80">
                                    <h2 class="text-xl font-bold mb-4">Choose Profile Picture</h2>
                                    <!-- Image Preview -->
                                    <div class="mb-4">
                                        <img :src="imagePreview" v-if="imagePreview" class="w-full h-40 object-cover rounded-lg"/>
                                        <p v-if="!imagePreview" class="text-gray-500">No image selected</p>
                                    </div>

                                    <!-- File Input -->
                                    <input type="file" @change="handleFileChange" class="mb-4" accept="image/*" />

                                    <!-- Save and Cancel Buttons -->
                                    <div class="flex justify-end gap-4">
                                        <button @click="save" class="p-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">Save</button>
                                        <button @click="closeModal" class="p-2 bg-gray-500 text-white rounded-lg hover:bg-gray-700">Cancel</button>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-row gap-x-2 align-middle items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4 hover:text-blue-600" viewBox="0 0 16 16" @click="toggleEditing">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg>

                                <div v-if="isEditing">
                                    <input v-model="user.name" type="text" class="mt-2 p-3 w-4/2 text-sm font-bold border-2 border-gray-300 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-white dark:ring-blue-400 transition duration-300" @blur="save" @keyup.enter="save"/>
                                    <button @click="save" class="mt-2 p-2 bg-blue-500 text-white font-bold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">Save</button>
                                </div>
                                <div v-else>
                                    <h1 class="text-xl font-bold">{{ user.name }}</h1>
                                </div>
                            </div>
                            <span class="text-sm">{{ user.username }}</span>
                            <p class="text-base-content/70">{{ user.role }}</p>
                        </div>

                        <hr class="my-6 border-t border-base-300">
                        <!-- -->
                        <div class="flex flex-col">
                            <ul class="flex flex-wrap gap-x-2 gap-y-2">
                                <button class="GetVerifiedButton m-auto"  onclick="GetVerifiedModal.showModal()">
                                    <span class="GetVerifiedShadow"></span>
                                    <span class="GetVerifiedEdge"></span>
                                    <span class="front text flex-col flex">
                                        Get Verified
                                    </span>
                                </button>
                            </ul>
                        </div>
                        <hr class="my-6 border-t border-base-300">
                        <!-- -->
                        <div class="flex flex-col">
                            <span class="text-base-content uppercase font-bold tracking-wider mb-2">Badges</span>
                            <ul class="flex flex-wrap gap-x-2 gap-y-2">
                                <div class="badge badge-accent">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
                                        <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5q0 .807-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33 33 0 0 1 2.5.5m.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935m10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935M3.504 1q.01.775.056 1.469c.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.5.5 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667q.045-.694.056-1.469z"/>
                                    </svg>
                                    100-Paws-t
                                </div>
                                <div class="badge badge-warning badge-outline flex flex-row">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
                                        <path d="M2 1.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1-.5-.5m2.5.5v1a3.5 3.5 0 0 0 1.989 3.158c.533.256 1.011.791 1.011 1.491v.702c0 .7-.478 1.235-1.011 1.491A3.5 3.5 0 0 0 4.5 13v1h7v-1a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351v-.702c0-.7.478-1.235 1.011-1.491A3.5 3.5 0 0 0 11.5 3V2z"/>
                                    </svg>
                                    First Accounts
                                </div>
                                <div class="badge badge-info badge-outline">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
                                        <path d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.707L8 2.207 1.354 8.853a.5.5 0 1 1-.708-.707z"/>
                                        <path d="m14 9.293-6-6-6 6V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5zm-6-.811c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.691 0-5.018"/>
                                    </svg>
                                    Foster
                                </div>
                                <div class="badge badge-accent badge-outline">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
                                        <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6m5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1z"/>
                                    </svg>
                                    Applied
                                </div>
                                <div class="badge badge-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
                                        <path d="M2 1.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1-.5-.5m2.5.5v1a3.5 3.5 0 0 0 1.989 3.158c.533.256 1.011.791 1.011 1.491v.702c0 .7-.478 1.235-1.011 1.491A3.5 3.5 0 0 0 4.5 13v1h7v-1a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351v-.702c0-.7.478-1.235 1.011-1.491A3.5 3.5 0 0 0 11.5 3V2z"/>
                                    </svg>
                                    Furr-Parent
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- About Me Section -->
                <div class="col-span-4 sm:col-span-9 flex gap-y-4 flex-col">
                    <div class="bg-base-100 shadow-lg rounded-lg p-6">
                        <div class="flex flex-row gap-x-2 align-middle items-center justify-left">
                            <h1 class="text-xl font-bold">Bio</h1>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4 hover:text-blue-600" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                            </svg>
                        </div>
                        <p class="text-base-content/70">
                            Animal lover and proud pet parent! Here to connect, share, and help find loving homes for our furry friends. Let’s make a difference together!                            
                        </p>
                    </div>
                    <div class="p-2 flex flex-wrap gap-x-4">
                        <!-- mag cchange ng laman yung "div sa baba base sa pinindot dito" -->
                        <div class="flex flex-row md:border-r-2 md:border-accent pr-4 gap-x-4 gap-y-4">        
                            <h1 class="text-xl font-bold hover:scale-105 hover:text-primary transition-all duration-100">
                                Posts
                            </h1>
                            <!-- If shelter Acooutt -->
                            <h1 class="text-xl font-bold hover:scale-105 hover:text-primary transition-all duration-100">
                                Announcement
                            </h1>
                            <h1 class="text-xl font-bold hover:scale-105 hover:text-primary transition-all duration-100">
                                Events
                            </h1>
                        </div>
                        <!-- Modal muna to -->
                        <div>
                            <h1 
                                class="text-xl font-bold hover:scale-105 hover:text-primary transition-all duration-100"
                                onclick="adoptionModal.showModal()"
                            >
                                Adoption Lists
                            </h1>
                        </div>
                    </div>
                    <div class="bg-base-100 shadow-lg rounded-lg p-6">
                        <ProfilePostCard/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Place Account Registration Form -->
    <dialog id="GetVerifiedModal" class="modal">
        <div class="modal-box bg-base-100 text-base-content max-w-3xl w-full">
            <!-- Modal Header -->
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="text-3xl font-bold">Get Verified</h3>
            <p class="py-2">
                Complete the registration form to begin the verification process and become an official shelter, pet shop, or pet clinic partner. Once verified, you'll gain access to all the features and benefits available to verified organizations.
            </p>

            <!-- Form Inputs -->
            <form method="POST" action="/register-verification" enctype="multipart/form-data">
                <!-- Username (Autofilled, Read-only) -->
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text">Username</span>
                    </label>
                    <input type="text" name="username" value="{{ auth()->user()->username }} inde ko alam to" class="input input-bordered w-full" readonly>
                </div>

                <!-- Email (Autofilled, Editable) -->
                <div class="form-control w-full mt-4">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" name="email" value="{{ auth()->user()->email }} auto filled, pero pwedeng mapalitan" class="input input-bordered w-full">
                </div>

                <!-- Dropdown -->
                <div class="form-control w-full mt-4">
                    <label class="label">
                        <span class="label-text">Select Type of Organization:</span>
                    </label>
                    <select name="type" class="select select-bordered w-full">
                        <option value="Pet Shelter">Pet Shelter</option>
                        <option value="Pet Clinic">Pet Clinic</option>
                        <option value="Pet Shop">Pet Shop</option>
                    </select>
                </div>

                <!-- Media Input -->
                <div class="form-control w-full mt-4">
                    <label class="label">
                        <span class="label-text">Upload Required Documents and Images for Verification...</span>
                    </label>
                    <input type="file" name="documents[]" class="file-input file-input-bordered w-full" accept="image/*,.pdf" multiple>
                </div>

                <!-- Buttons -->
                <div class="modal-action">
                    <button type="button" class="btn btn-ghost" formmethod="dialog">Cancel</button>
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </dialog>



    <!-- EZ MODAL WTF -->
    <dialog id="adoptionModal" class="modal">
        <div class="modal-box w-full max-w-5xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
        
            <h3 class="text-lg font-bold mb-4">Adoption Requests</h3>
        
            <!-- Search and Filter Section -->
            <div class="flex flex-wrap items-center justify-between mb-4">
            <!-- Filter Button -->
            <div>
                <button class="btn btn-outline btn-primary">Filter</button>
            </div>
        
            <!-- Search Input -->
            <div class="form-control w-full max-w-md">
                <input type="text" placeholder="Search requests..." class="input input-bordered" />
            </div>
            </div>
        
            <!-- Table Section -->
            <div class="overflow-x-auto z-10">
                <table class="table w-full">
                    <!-- Table Head -->
                    <thead>
                    <tr>
                        <th>Trace Number</th>
                        <th>Sender</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
            
                    <!-- Table Body -->
                    <tbody v-if="userAdoptionForms.length > 0">
                        <tr v-for="(application, index) in userAdoptionForms" :key="index">
                            <td>{{ application.adoption_code }}</td>
                            <td>{{ application.adopter_account }}</td>
                            <td>{{ application.status }}</td>
                            <td>
                                <button v-if="application.status === 'Pending'" class="btn btn-xs btn-success text-white" @click.prevent="openReviewModal(application)">
                                    Review
                                </button>

                                <button v-if="application.status === 'Ongoing'" class="btn btn-xs btn-primary text-white" @click.prevent="openReviewModal(application)">
                                    Review
                                </button>

                                <button v-if="application.status === 'Reject'" class="btn btn-xs btn-info text-white" disabled>
                                    Rejected
                                </button>

                                <button v-if="application.status === 'Complete'" class="btn btn-xs btn-info text-white" disabled>
                                    Completed
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-if="userAdoptionForms.length === 0" class="text-center py-2">
                    <p class="text-gray-500">No adoption request available.</p>
                </div>
                <!-- Review Modal -->
            </div>
        </div>
        <div v-if="showFormModal" class="fixed inset-0 z-80 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-base-300 rounded-lg shadow-lg w-full max-w-4xl max-h-[800px] p-6 relative">
                <h3 class="text-4xl font-bold mb-4 flex flex-row align-middle items-center gap-x-4">
                    <img :src="`/storage/${ selectedApplication.adopter_profile}`" class="w-24 h-24 bg-base-300 rounded-full mb-4 object-cover transition-all duration-300 group-hover:brightness-75" alt="">
                    <strong>Review Adoption Application</strong>
                </h3>

                <div class="max-h-[400px] overflow-y-scroll mb-4 mx-2">  
                    <form @submit.prevent="saveReview">
                        <div class="form-control mb-4 text-xl">
                            <p class="flex">
                                <strong>Adoption Code:</strong>
                                <span class="ml-8">{{ selectedApplication?.adoption_code || '' }}</span>
                            </p>
                        </div>
                        <div class="form-control mb-4 text-xl">
                            <p class="flex">
                                <strong>Adopter Account:</strong>
                                <span class="ml-8">{{ selectedApplication?.adopter_account || '' }}</span>
                            </p>
                        </div>
                        <div class="form-control mb-4 text-xl">
                            <p class="flex">
                                <strong>Adopter Name:</strong>
                                <span class="ml-8">{{ selectedApplication?.adopter_name || '' }}</span>
                            </p>
                        </div>
                        <div class="form-control mb-4 text-xl">
                            <p class="flex">
                                <strong>Contact Info:</strong>
                                <span class="ml-8">{{ selectedApplication?.contact_info || '' }}</span>
                            </p>
                        </div>
                        <div class="form-control mb-4 text-xl">
                            <p class="flex">
                                <strong>Adopt Type:</strong>
                                <span class="ml-8 capitalize">{{ selectedApplication?.adopt_type || '' }}</span>
                            </p>
                        </div>
                        <div class="form-control mb-4 text-xl">
                            <p class="flex">
                                <strong>Employment Status:</strong>
                                <span class="ml-8 capitalize">{{ selectedApplication?.employment_status || '' }}</span>
                            </p>
                        </div>
                        <div class="form-control mb-4 text-xl">
                            <p class="flex">
                                <strong>Social Media Links:</strong>
                                <span class="ml-8">{{ selectedApplication?.socmed || 'No Social Media Links' }}</span>
                            </p>
                        </div>
                        <div class="form-control mb-4 text-xl">
                            <p class="flex">
                                <strong>Location:</strong>
                                <span class="ml-8">{{ selectedApplication?.location || '' }}</span>
                            </p>
                        </div>
                        <div class="form-control mb-4 text-xl">
                            <p class="flex">
                                <strong>Experience:</strong>
                                <span class="ml-8">{{ selectedApplication?.experience || '' }}</span>
                            </p>
                        </div>
                        <div class="form-control mb-4 text-xl">
                            <p class="flex">
                                <strong>Reason:</strong>
                                <span class="ml-8">{{ selectedApplication?.reason || '' }}</span>
                            </p>
                        </div>
                        <div class="form-control mb-4 text-xl">
                            <p class="flex">
                                <strong>Current Pets:</strong>
                                <span class="ml-8">{{ selectedApplication?.current_pets || '' }}</span>
                            </p>
                        </div>
                        <div class="form-control mb-4 text-xl">
                            <p>
                                <strong>Government ID:</strong>
                                <div v-if="selectedApplication.gov_id">
                                    <!-- Display PDF if the file is a PDF -->
                                    <iframe
                                        v-if="selectedApplication.gov_id.endsWith('.pdf')"
                                        :src="`/storage/${selectedApplication.gov_id}`"
                                        width="100%"
                                        height="500px"
                                        class="rounded-lg"
                                        frameborder="0"
                                    ></iframe>

                                    <!-- Display image if the file is an image -->
                                    <img
                                        v-else
                                        :src="`/storage/${selectedApplication.gov_id}`"
                                        alt="Government ID"
                                        class="rounded-lg"
                                    />
                                </div>
                                <span v-else>No Government ID uploaded.</span>
                            </p>
                        </div>
                        <div class="flex justify-end gap-4 mt-6">
                            <button v-if="selectedApplication.status === 'Pending'" @click.prevent="rejectForm" type="button" class="btn btn-error bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                                <strong>Reject</strong>
                            </button>
                            <button v-if="selectedApplication.status === 'Pending'" @click.prevent="acceptForm" type="submit" class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                                <strong>Accept</strong>
                            </button>
                            <button v-if="selectedApplication.status === 'Ongoing'" type="button" class="btn btn-error bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600" @click.prevent="changeStatusToFailed">
                                <strong>Reject</strong>
                            </button>
                            <button v-if="selectedApplication.status === 'Ongoing'" type="button" class="btn btn-warning bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600" @click.prevent="changeStatusToComplete">
                                <strong>Completed</strong>
                            </button>
                            
                        </div>
                    </form>
                </div>  
                <button
                    class="absolute top-3 right-3 text-gray-400 hover:text-gray-600"
                    @click.prevent="closeReviewModal"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

    </dialog>         
</template>
<script>
import axios from 'axios';
import Swal from 'sweetalert2';
import '@fortawesome/fontawesome-free/css/all.min.css';
import ProfilePostCard from '../partials/profile/ProfilePostCard.vue';

export default {
  components: {
    ProfilePostCard
  },
  data() {
    return {
      isEditing: false,
      isModalOpen: false,
      imagePreview: null,
      userAdoptionForms: [],
      showFormModal: false,
      selectedApplication: null,
      user: {
        name: '',
        username: '',
        profile_picture: '',
        role: '',
        bio: '',
      },
    };
  },
  methods: {
    openReviewModal(application) {
        console.log(application);
        this.selectedApplication = application; // Clone the application object
        this.showFormModal = true; // Open the modal
        console.log("showFormModal state:", this.showFormModal);
    },
    closeReviewModal() {
        this.showFormModal = false; // Close the modal
        this.selectedApplication = null; // Clear the application data
    },
    acceptForm() {
        // Ensure there is an application_id to update
        const applicationId = this.selectedApplication?.application_id;
        
        if (!applicationId) {
            // Show a message or alert if no application_id is available
            return;
        }

        // Update the status of the adoption application (send a request to the backend)
        axios.put(`/api/user/adoption/accept/${applicationId}`)
        .then((response) => {
            // Handle the success (e.g., show a success message, update UI, etc.)
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Adoption Form Accepted!",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: "#1e293b",
                color: "#ffffff",
            });
            this.fetchUserAdoptionApplications();
            this.closeReviewModal(); // Close the modal after success
        })
        .catch((error) => {
            // Handle the error (e.g., show an error message)
            console.error('Error accepting application:', error);
            alert('Something went wrong. Please try again.');
        });
    },

    rejectForm() {
        // Ensure there is an application_id to update
        const applicationId = this.selectedApplication?.application_id;
        
        if (!applicationId) {
            // Show a message or alert if no application_id is available
            return;
        }

        // Update the status of the adoption application (send a request to the backend)
        axios.put(`/api/user/adoption/reject/${applicationId}`)
        .then((response) => {
            // Handle the success (e.g., show a success message, update UI, etc.)
            Swal.fire({
                position: "center",
                icon: "error",
                title: "Adoption Form Rejected!",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: "#1e293b",
                color: "#ffffff",
            });
            this.fetchUserAdoptionApplications();
            this.closeReviewModal(); // Close the modal after success
        })
        .catch((error) => {
            // Handle the error (e.g., show an error message)
            console.error('Error accepting application:', error);
            alert('Something went wrong. Please try again.');
        });
    },

    changeStatusToComplete() {
        const applicationId = this.selectedApplication?.application_id;
        if (!applicationId) return;

        axios
        .put(`/api/user/adoption/complete/${applicationId}`)
        .then((response) => {
            alert('Adoption application completed!');
            this.closeReviewModal();
        })
        .catch((error) => {
            console.error('Error completing application:', error);
            alert('Something went wrong. Please try again.');
        });
    },

    // Change the adoption application status to 'Failed'
    changeStatusToFailed() {
        const applicationId = this.selectedApplication?.application_id;
        if (!applicationId) return;

        axios
        .put(`/api/user/adoption/fail/${applicationId}`)
        .then((response) => {
            alert('Adoption application marked as failed!');
            this.closeReviewModal();
        })
        .catch((error) => {
            console.error('Error marking as failed:', error);
            alert('Something went wrong. Please try again.');
        });
    },

    openModal() {
      this.isModalOpen = true;
    },
    closeModal() {
      this.isModalOpen = false;
      this.imagePreview = null; // Reset image preview when closed
    },
    handleFileChange(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onloadend = () => {
          this.imagePreview = reader.result; // Set the preview image
          this.selectedImage = file; // Store the selected image file
        };
        reader.readAsDataURL(file);
      }
    },
    toggleEditing() {
      this.isEditing = !this.isEditing;
    },
    async save() {
        this.isEditing = false; // Hide the input field after saving

        const formData = new FormData();
        formData.append('name', this.user.name); // Append the updated name

        try {
            const response = await axios.put('/api/user/update/profile', formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
            });

            // Log server response for debugging
            console.log('Server Response:', response.data);

            // On success, update the local user data
            if (response.data.name) {
            this.user.name = response.data.name;

            Swal.fire({
                position: "bottom-end",
                icon: "success",
                title: "Your profile has been updated successfully!",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: "#1e293b",
                color: "#ffffff",
                toast: true,
            });

            this.fetchUserProfileInfo(); // Refresh user profile data
            this.closeModal(); // Close the modal after saving
            } else {
            throw new Error('Name not updated in server response.');
            }
        } catch (error) {
            console.error('Error updating profile:', error);

            Swal.fire({
            position: "bottom-end",
            icon: "error",
            title: "An error occurred. Please try again.",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: "#1e293b",
            color: "#ffffff",
            toast: true,
            });
        }
        },
    async fetchUserProfileInfo() {
      try {
        const response = await axios.get('/api/user/profile/info');
        // Update the profile data with the response
        this.user = response.data;
      } catch (error) {
        console.error('Error fetching profile data:', error);
      }
    },
    async fetchUserAdoptionApplications() {
      try {
        const response = await axios.get('/api/user/adoption');
        // Update the profile data with the response
        this.userAdoptionForms = response.data;
      } catch (error) {
        console.error('Error fetching profile data:', error);
      }
    },
  },
  mounted() {
    this.fetchUserProfileInfo();
    this.fetchUserAdoptionApplications();
  },
};
</script>

<style scoped>
    /* From Uiverse.io by cssbuttons-io */ 
    .GetVerifiedButton {
        position: relative;
        border: none;
        background: transparent;
        padding: 0;
        cursor: pointer;
        outline-offset: 4px;
        transition: filter 250ms;
        user-select: none;
        touch-action: manipulation;
    }

    .GetVerifiedShadow {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 12px;
        background: hsl(0deg 0% 0% / 0.25);
        will-change: transform;
        transform: translateY(2px);
        transition: transform
            600ms
            cubic-bezier(.3, .7, .4, 1);
    }

    .GetVerifiedEdge {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 12px;
        background: linear-gradient(
            to left,
            hsl(220deg 100% 16%) 0%, 
            hsl(220deg 100% 32%) 8%, 
            hsl(220deg 100% 32%) 92%, 
            hsl(220deg 100% 16%) 100%
        );
    }

    .front {
        display: block;
        position: relative;
        padding: 12px 27px;
        border-radius: 12px;
        font-size: 1.1rem;
        color: white;
        background: hsl(220deg 100% 47%);
        will-change: transform;
        transform: translateY(-4px);
        transition: transform
            600ms
            cubic-bezier(.3, .7, .4, 1);
    }

    .GetVerifiedButton:hover {
        filter: brightness(110%);
    }

    .GetVerifiedButton:hover .front {
        transform: translateY(-6px);
        transition: transform
            250ms
            cubic-bezier(.3, .7, .4, 1.5);
    }

    .GetVerifiedButton:active .front {
        transform: translateY(-2px);
        transition: transform 34ms;
    }

    .GetVerifiedButton:hover .shadow {
        transform: translateY(4px);
        transition: transform
            250ms
            cubic-bezier(.3, .7, .4, 1.5);
    }

    .GetVerifiedButton:active .shadow {
        transform: translateY(1px);
        transition: transform 34ms;
    }

    .GetVerifiedButton:focus:not(:focus-visible) {
        outline: none;
    }
</style>

<style>
  /* Hide the scrollbar but allow scrolling */
  .hide-scrollbar::-webkit-scrollbar {
  display: none; /* Hides scrollbar in WebKit browsers */
  }

  .hide-scrollbar {
  -ms-overflow-style: none; /* Hides scrollbar in IE and Edge */
  scrollbar-width: none; /* Hides scrollbar in Firefox */
  overflow: auto; /* Ensure scrolling is enabled */
  }
</style>
