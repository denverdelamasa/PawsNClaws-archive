<template>
  <section class="body-font w-full">
    <div class="container px-5 py-12 mx-auto">
      <div class="flex flex-col text-center w-full mb-4">
        <h1 class="sm:text-4xl text-3xl font-bold title-font">User Management</h1>
        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
          View, filter, and manage all registered accounts.
        </p>
      </div>

      <!-- Filters & Search -->
      <div class="mb-4 flex flex-col gap-2 sm:justify-between">
        <div class="flex items-center gap-2 align-middle justify-center">
          <details class="dropdown">
            <summary class="btn btn-sm">Filter by</summary>
            <ul class="menu dropdown-content bg-base-100 rounded-box z-10 w-52 p-2 shadow">
              <li><a>Alphabetical</a></li>
              <li><a>Recent</a></li>
              <li><a>Oldest</a></li>
              <li><a>Most Active</a></li>
              <li><a>Least Active</a></li>
            </ul>
          </details>
          <input type="text" placeholder="Search users..." class="input input-bordered input-sm w-full max-w-xs" />
        </div>
      </div>

      <!-- Responsive Table Wrapper -->
      <div class="overflow-x-auto bg-base-100 rounded-lg shadow mb-4 w-full">
        <table class="table table-auto min-w-[fit-content]">
          <thead>
            <tr>
              <th>#</th>
              <th>Profile</th>
              <th>Name & Email</th>
              <th>Role</th>
              <th>Status</th>
              <th>Last Login</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(user, index) in users" :key="user.user_id">
              <th class="whitespace-nowrap">{{ index + 1 }}</th>
              <td>
                <div class="avatar">
                  <div class="mask mask-squircle w-10 h-10">
                    <img
                      :src="user.profile_picture ? '/storage/' + user.profile_picture : defaultProfilePicture"
                      alt="Profile Picture"
                    />
                  </div>
                </div>
              </td>
              <td class="whitespace-nowrap">
                <div class="font-bold">{{ user.name }}</div>
                <div class="text-sm opacity-50">{{ user.email }}</div>
              </td>
              <td class="whitespace-nowrap">
                {{ user.role }}<br/>
                <button
                  class="btn btn-xs bg-blue-500 text-white mt-1"
                  @click="checkAdminAndOpenChangeRoleModal(user)"
                >Change</button>
              </td>
              <td class="whitespace-nowrap">{{ user.status }}</td>
              <td class="whitespace-nowrap">
                <span v-if="!user.is_online" class="text-gray-500">{{ user.last_online }} ago</span>
                <span v-else class="text-green-600 font-semibold flex items-center">
                  <span class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>
                  Online
                </span>
              </td>
              <td class="whitespace-nowrap">
                <div class="flex flex-wrap gap-1">
                  <!-- Verification Button (shown if user has pending application) -->
                  <button
                    v-if="user.has_pending_verification"
                    class="btn btn-xs bg-purple-500 text-white"
                    @click="checkAdminAndOpenVerificationModal(user)"
                  >
                    <i class="fas fa-file-alt"></i> <span class="hidden sm:inline">View Verification</span>
                  </button>
                  <!-- Other Action Buttons -->
                  <button class="btn btn-xs bg-red-500 text-white" @click="checkAdminAndOpenSuspendUserModal(user)">
                    <i class="fas fa-ban"></i> <span class="hidden sm:inline">Suspend</span>
                  </button>
                  <button class="btn btn-xs bg-yellow-500 text-white" @click="warnUser(user.user_id)">
                    <i class="fas fa-exclamation-triangle"></i> <span class="hidden sm:inline">Warn</span>
                  </button>
                  <button class="btn btn-xs bg-red-700 text-white" @click="checkAdminAndOpenDeleteModal(user)">
                    <i class="fas fa-trash"></i> <span class="hidden sm:inline">Delete</span>
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Unauthorized Modal -->
      <div v-if="isUnauthorizedModalOpen" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-md shadow-lg w-96">
          <h3 class="text-lg font-semibold mb-4">{{ unauthorizedMessage }}</h3>
          <div class="flex justify-end gap-2">
            <button @click="closeUnauthorizedModal" class="btn btn-sm bg-gray-500 text-white">Close</button>
          </div>
        </div>
      </div>

      <!-- Change Role Modal -->
      <div v-if="isModalOpen" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50">
        <div class="bg-base-200 p-6 rounded-md shadow-lg w-96">
          <h3 class="text-lg font-semibold mb-4">Change User Role</h3>
          <div class="flex flex-col items-center mb-4">
            <img :src="currentUser?.profile_picture ? '/storage/' + currentUser.profile_picture : defaultProfilePicture"
                alt="Profile Picture" class="w-16 h-16 rounded-full object-cover mb-2" />
            <p class="text-lg font-medium">{{ currentUser?.name }}</p>
            <p class="text-sm text-gray-600">{{ currentUser?.email }}</p>
          </div>
          <select v-model="selectedRole" class="select select-bordered w-full mb-4">
            <option disabled value="">Select a Role</option>
            <option>User</option>
            <option>Shelter</option>
            <option>Vet Clinic</option>
            <option>Moderator</option>
            <option>Admin</option>
          </select>
          <div class="flex justify-end gap-2">
            <button @click="closeModal" class="btn btn-sm bg-gray-500 text-white">Cancel</button>
            <button @click="changeUserRole" class="btn btn-sm bg-blue-500 text-white">Change</button>
          </div>
        </div>
      </div>

      <!-- Suspend User Modal -->
      <div v-if="isSuspendModalOpen" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50">
        <div class="bg-base-200 p-6 rounded-md shadow-lg w-96">
          <h3 class="text-lg font-semibold mb-4">Suspend User</h3>
          <div class="flex flex-col items-center mb-4">
            <img :src="currentUser?.profile_picture ? '/storage/' + currentUser.profile_picture : defaultProfilePicture"
                alt="Profile Picture" class="w-16 h-16 rounded-full object-cover mb-2" />
            <p class="text-lg font-medium">{{ currentUser?.name }}</p>
            <p class="text-sm text-gray-600">{{ currentUser?.email }}</p>
          </div>
          <label for="suspensionDuration">Duration:</label>
          <select v-model="suspensionDuration" id="suspensionDuration" class="select select-bordered w-full mb-4">
            <option value="1">1 Day</option>
            <option value="7">1 Week</option>
            <option value="30">1 Month</option>
          </select>
          <div class="flex justify-end gap-2">
            <button @click="closeSuspendModal" class="btn btn-sm bg-gray-500 text-white">Cancel</button>
            <button @click="suspendUserAction" class="btn btn-sm bg-red-500 text-white">Suspend</button>
          </div>
        </div>
      </div>

      <!-- Delete User Modal -->
      <div v-if="isDeleteModalOpen" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50">
        <div class="bg-base-200 p-6 rounded-md shadow-lg w-96">
          <h3 class="text-lg font-semibold mb-4">Are you sure you want to delete this user?</h3>
          <div class="flex flex-col items-center mb-4">
            <img :src="currentUser?.profile_picture ? '/storage/' + currentUser.profile_picture : defaultProfilePicture"
                alt="Profile Picture" class="w-16 h-16 rounded-full object-cover mb-2" />
            <p class="text-lg font-medium">{{ currentUser?.name }}</p>
            <p class="text-sm text-gray-600">{{ currentUser?.email }}</p>
          </div>
          <div class="flex justify-end gap-2">
            <button @click="closeDeleteModal" class="btn btn-sm bg-gray-500 text-white">Cancel</button>
            <button @click="confirmDeleteUser" class="btn btn-sm bg-red-500 text-white">Delete</button>
          </div>
        </div>
      </div>

      <!-- Verification Application Modal -->
      <div v-if="isVerificationModalOpen" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50">
        <div class="bg-base-200 p-6 rounded-md shadow-lg w-full max-w-4xl">
          <h3 class="text-lg font-semibold mb-4">Verification Application</h3>
          <div v-if="selectedApplication" class="flex flex-col gap-4">
            <!-- Existing fields -->
            <div class="flex flex-col items-center">
              <img
                :src="currentUser?.profile_picture ? '/storage/' + currentUser.profile_picture : defaultProfilePicture"
                alt="Profile Picture"
                class="w-16 h-16 rounded-full object-cover mb-2"
              />
              <p class="text-lg font-medium">{{ currentUser?.name }}</p>
              <p class="text-sm text-gray-600">{{ currentUser?.email }}</p>
            </div>
            <p><strong>Applied Role:</strong> {{ selectedApplication.role }}</p>
            <p><strong>Status:</strong> {{ selectedApplication.status }}</p>
            <p><strong>Submitted:</strong> {{ new Date(selectedApplication.created_at).toLocaleString() }}</p>
            <div>
              <strong>Documents:</strong>
              <div v-for="(doc, index) in selectedApplication.documents" :key="index" class="mt-2">
                <a :href="doc" target="_blank" class="link link-primary">{{ doc.split('/').pop() }}</a>
                <iframe
                  v-if="doc.endsWith('.pdf')"
                  :src="doc"
                  width="100%"
                  height="300px"
                  class="mt-2 rounded-lg"
                  frameborder="0"
                ></iframe>
                <img
                  v-else
                  :src="doc"
                  alt="Document"
                  class="mt-2 rounded-lg max-w-full"
                />
              </div>
            </div>
            <!-- Rejection Reason Input (shown only when rejecting) -->
            <div v-if="selectedApplication.status === 'pending' && showRejectionInput" class="mt-4">
              <label for="rejectionReason" class="block text-sm font-medium">Rejection Reason:</label>
              <textarea
                v-model="rejectionReason"
                id="rejectionReason"
                class="textarea textarea-bordered w-full"
                placeholder="Enter reason for rejection (optional)"
                rows="4"
              ></textarea>
            </div>
            <!-- Buttons -->
            <div v-if="selectedApplication.status === 'pending'" class="flex justify-end gap-2 mt-4">
              <button
                class="btn btn-error"
                @click="showRejectionInput = true"
                v-if="!showRejectionInput"
              >Reject</button>
              <button
                v-if="showRejectionInput"
                class="btn btn-error"
                @click="updateApplicationStatus('rejected')"
              >Confirm Reject</button>
              <button
                v-if="showRejectionInput"
                class="btn btn-gray"
                @click="showRejectionInput = false; rejectionReason = ''"
              >Cancel</button>
              <button
                class="btn btn-success"
                @click="updateApplicationStatus('approved')"
                v-if="!showRejectionInput"
              >Approve</button>
            </div>
          </div>
          <div v-else class="text-center">
            <p>No verification application found.</p>
          </div>
          <div class="flex justify-end mt-4">
            <button @click="closeVerificationModal" class="btn btn-sm bg-gray-500 text-white">Close</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';
import '@fortawesome/fontawesome-free/css/all.min.css';

export default {
  data() {
    return {
      users: [],
      isModalOpen: false,
      isSuspendModalOpen: false,
      isDeleteModalOpen: false,
      isVerificationModalOpen: false,
      selectedRole: '',
      suspensionDuration: 7,
      currentUser: null,
      selectedApplication: null,
      isUnauthorizedModalOpen: false,
      unauthorizedMessage: '',
      defaultProfilePicture: 'https://via.placeholder.com/150', // Adjust as needed
      rejectionReason: '', // New: Store rejection reason input
      showRejectionInput: false, // New: Toggle rejection reason input
    };
  },
  methods: {
    async fetchUsers() {
      try {
        const response = await axios.get('/api/users/lists', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`,
          },
        });
        // Add has_pending_verification flag based on API response or separate check
        this.users = response.data;
      } catch (error) {
        console.error('There was an error fetching users:', error);
        Swal.fire({
          position: 'bottom-end',
          icon: 'error',
          title: 'Failed to fetch users.',
          showConfirmButton: false,
          timer: 3000,
          toast: true,
          background: '#1e293b',
          color: '#ffffff',
        });
      }
    },
    async checkAdminAndOpenVerificationModal(user) {
      const currentUserRole = await this.getCurrentUserRole();
      if (currentUserRole !== 'Admin') {
        this.openUnauthorizedModal('Only admins can view verification applications');
      } else {
        this.currentUser = user;
        await this.fetchVerificationApplication(user.user_id);
        this.isVerificationModalOpen = true;
      }
    },
    async fetchVerificationApplication(userId) {
      try {
        const response = await axios.get(`/api/verify/user-applications/${userId}`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`,
          },
        });
        // Take the most recent application (or adjust to handle multiple)
        this.selectedApplication = response.data.applications[0] || null;
      } catch (error) {
        console.error('Error fetching verification application:', error);
        this.selectedApplication = null;
        Swal.fire({
          position: 'bottom-end',
          icon: 'error',
          title: 'Failed to fetch verification application.',
          showConfirmButton: false,
          timer: 3000,
          toast: true,
          background: '#1e293b',
          color: '#ffffff',
        });
      }
    },
    async updateApplicationStatus(status) {
      if (!this.selectedApplication) return;

      try {
        const endpoint = status === 'approved'
          ? `/api/verify/applications/${this.selectedApplication.verify_id}/accept`
          : `/api/verify/applications/${this.selectedApplication.verify_id}/reject`;

        const response = await axios.put(endpoint, {
          reason: status === 'rejected' ? 'Reason for rejection' : undefined, // Optional: Add a reason for rejection
        }, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`,
          },
        });

        if (response.data.success) {
          Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            title: `Application ${status}!`,
            showConfirmButton: false,
            timer: 3000,
            toast: true,
            background: '#1e293b',
            color: '#ffffff',
          });
          this.closeVerificationModal();
          this.fetchUsers(); // Refresh user list
        } else {
          throw new Error(response.data.message);
        }
      } catch (error) {
        console.error(`Error ${status} application:`, error);
        Swal.fire({
          position: 'bottom-end',
          icon: 'error',
          title: `Failed to ${status} application.`,
          showConfirmButton: false,
          timer: 3000,
          toast: true,
          background: '#1e293b',
          color: '#ffffff',
        });
      }
    },
    closeVerificationModal() {
      this.isVerificationModalOpen = false;
      this.currentUser = null;
      this.selectedApplication = null;
    },
    async checkAdminAndOpenSuspendUserModal(user) {
      const currentUserRole = await this.getCurrentUserRole();
      if (currentUserRole !== 'Admin') {
        this.openUnauthorizedModal('Only admins can suspend users');
      } else {
        this.currentUser = user;
        this.isSuspendModalOpen = true;
      }
    },
    async checkAdminAndOpenDeleteModal(user) {
      const currentUserRole = await this.getCurrentUserRole();
      if (currentUserRole !== 'Admin') {
        this.openUnauthorizedModal('Only admins can delete users');
      } else {
        this.currentUser = user;
        this.isDeleteModalOpen = true;
      }
    },
    async checkAdminAndOpenChangeRoleModal(user) {
      const currentUserRole = await this.getCurrentUserRole();
      if (currentUserRole !== 'Admin') {
        this.openUnauthorizedModal('Only admins can change roles');
      } else {
        this.currentUser = user;
        this.isModalOpen = true;
      }
    },
    async getCurrentUserRole() {
      try {
        const response = await axios.get('/api/users/check/role', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`,
          },
        });
        return response.data.role;
      } catch (error) {
        console.error('Error fetching user role:', error);
        return null;
      }
    },
    openUnauthorizedModal(message) {
      this.unauthorizedMessage = message;
      this.isUnauthorizedModalOpen = true;
    },
    closeUnauthorizedModal() {
      this.isUnauthorizedModalOpen = false;
    },
    changeUserRole() {
      if (!this.selectedRole) {
        Swal.fire({
          position: 'bottom-end',
          icon: 'warning',
          title: 'Please select a role',
          showConfirmButton: false,
          timer: 3000,
          toast: true,
          background: '#1e293b',
          color: '#ffffff',
        });
        return;
      }

      axios.put(`/api/users/role/change/${this.currentUser.user_id}`, { role: this.selectedRole }, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      })
        .then(() => {
          this.closeModal();
          this.fetchUsers();
          Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            title: 'User role changed successfully',
            showConfirmButton: false,
            timer: 3000,
            toast: true,
            background: '#1e293b',
            color: '#ffffff',
          });
        })
        .catch(error => {
          console.error('There was an error changing the user role:', error);
          Swal.fire({
            position: 'bottom-end',
            icon: 'error',
            title: 'Failed to change user role',
            showConfirmButton: false,
            timer: 3000,
            toast: true,
            background: '#1e293b',
            color: '#ffffff',
          });
        });
    },
    closeModal() {
      this.isModalOpen = false;
    },
    suspendUserAction() {
      axios.put(`/api/users/role/suspend/${this.currentUser.user_id}`, { duration: this.suspensionDuration }, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      })
        .then(() => {
          this.closeSuspendModal();
          this.fetchUsers();
          Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            title: 'User suspended successfully',
            showConfirmButton: false,
            timer: 3000,
            toast: true,
            background: '#1e293b',
            color: '#ffffff',
          });
        })
        .catch(error => {
          console.error('Error suspending user:', error);
          Swal.fire({
            position: 'bottom-end',
            icon: 'error',
            title: 'Failed to suspend user',
            showConfirmButton: false,
            timer: 3000,
            toast: true,
            background: '#1e293b',
            color: '#ffffff',
          });
        });
    },
    closeSuspendModal() {
      this.isSuspendModalOpen = false;
    },
    confirmDeleteUser() {
      axios.delete(`/api/users/delete/${this.currentUser.user_id}`, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      })
        .then(() => {
          this.fetchUsers();
          this.closeDeleteModal();
          Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            title: 'User deleted successfully',
            showConfirmButton: false,
            timer: 3000,
            toast: true,
            background: '#1e293b',
            color: '#ffffff',
          });
        })
        .catch(error => {
          console.error('Error deleting user:', error);
          this.closeDeleteModal();
          Swal.fire({
            position: 'bottom-end',
            icon: 'error',
            title: 'Failed to delete user',
            showConfirmButton: false,
            timer: 3000,
            toast: true,
            background: '#1e293b',
            color: '#ffffff',
          });
        });
    },
    closeDeleteModal() {
      this.isDeleteModalOpen = false;
    },
    warnUser(userId) {
      axios.post(`/api/users/warn/${userId}`, {}, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      })
        .then(() => {
          Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            title: 'User warned successfully',
            showConfirmButton: false,
            timer: 3000,
            toast: true,
            background: '#1e293b',
            color: '#ffffff',
          });
        })
        .catch(error => {
          console.error('Error warning user:', error);
          Swal.fire({
            position: 'bottom-end',
            icon: 'error',
            title: 'Failed to warn user',
            showConfirmButton: false,
            timer: 3000,
            toast: true,
            background: '#1e293b',
            color: '#ffffff',
          });
        });
    },
  },
  mounted() {
    this.fetchUsers();
  },
};
</script>

<style scoped>
.btn i {
  margin-right: 5px;
}
</style>