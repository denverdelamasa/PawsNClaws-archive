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
              <li><a @click="setFilter('alphabetical')">Alphabetical</a></li>
              <li><a @click="setFilter('recent')">Recent</a></li>
              <li><a @click="setFilter('oldest')">Oldest</a></li>
              <li><a @click="setFilter('most_active')">Most Active</a></li>
              <li><a @click="setFilter('least_active')">Least Active</a></li>
            </ul>
          </details>
          <input
            type="text"
            v-model="searchQuery"
            @input="debouncedFetchUsers"
            placeholder="Search users..."
            class="input input-bordered input-sm w-full max-w-xs"
          />
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
              <th v-if="showActionsColumn">Actions</th>
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
                  <!--<button class="btn btn-xs bg-red-500 text-white" @click="checkAdminAndOpenSuspendUserModal(user)">
                    <i class="fas fa-ban"></i> <span class="hidden sm:inline">Suspend</span>
                  </button>
                  <button class="btn btn-xs bg-yellow-500 text-white" @click="warnUser(user.user_id)">
                    <i class="fas fa-exclamation-triangle"></i> <span class="hidden sm:inline">Warn</span>
                  </button>
                  <button class="btn btn-xs bg-red-700 text-white" @click="checkAdminAndOpenDeleteModal(user)">
                    <i class="fas fa-trash"></i> <span class="hidden sm:inline">Delete</span>
                  </button>-->
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
      <div v-if="isVerificationModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60 transition-opacity duration-300" :class="{ 'opacity-0': !isVerificationModalOpen }" aria-modal="true" role="dialog">
        <div class="bg-base-100 p-6 rounded-xl shadow-2xl w-full max-w-4xl mx-4 sm:mx-6 lg:mx-8 max-h-[90vh] overflow-y-auto transform transition-all duration-300 scale-100" :class="{ 'scale-95 opacity-0': !isVerificationModalOpen }">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-semibold text-base-content">Verification Application</h3>
                <button @click="closeVerificationModal" class="btn btn-sm btn-circle btn-ghost hover:bg-base-200" aria-label="Close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Content -->
            <div v-if="selectedApplication" class="flex flex-col gap-6">
                <!-- User Info -->
                <div class="flex flex-col items-center bg-base-200 p-4 rounded-lg shadow-sm">
                    <img
                        :src="currentUser?.profile_picture ? '/storage/' + currentUser.profile_picture : defaultProfilePicture"
                        alt="Profile Picture"
                        class="w-16 h-16 sm:w-20 sm:h-20 rounded-full object-cover border-2 border-base-300 shadow-md mb-3"
                    />
                    <p class="text-lg sm:text-xl font-medium text-base-content">{{ currentUser?.name }}</p>
                    <p class="text-sm text-base-content/70">{{ currentUser?.email }}</p>
                </div>

                <!-- Application Details -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-medium text-base-content/70">Applied Role</p>
                        <p class="text-base font-semibold capitalize">{{ selectedApplication.role }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-base-content/70">Status</p>
                        <p class="text-base font-semibold">
                            <span :class="{
                                'badge badge-primary': selectedApplication.status === 'pending',
                                'badge badge-success': selectedApplication.status === 'approved',
                                'badge badge-error': selectedApplication.status === 'rejected'
                            }">
                                {{ selectedApplication.status.charAt(0).toUpperCase() + selectedApplication.status.slice(1) }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-base-content/70">Submitted</p>
                        <p class="text-base font-semibold">{{ new Date(selectedApplication.created_at).toLocaleString() }}</p>
                    </div>
                </div>

                <!-- Documents -->
                <div>
                    <p class="text-sm font-medium text-base-content/70 mb-2">Documents</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div v-for="(doc, index) in selectedApplication.documents" :key="index" class="bg-base-200 p-4 rounded-lg shadow-sm">
                            <a :href="doc" target="_blank" class="link link-primary text-sm truncate block mb-2">{{ doc.split('/').pop() }}</a>
                            <iframe
                                v-if="doc.endsWith('.pdf')"
                                :src="doc"
                                class="w-full h-64 sm:h-80 rounded-lg"
                                frameborder="0"
                            ></iframe>
                            <img
                                v-else
                                :src="doc"
                                alt="Document"
                                class="w-full h-auto rounded-lg object-contain max-h-64 sm:max-h-80"
                            />
                        </div>
                    </div>
                </div>

                <!-- Rejection Reason -->
                <div v-if="selectedApplication.status === 'pending' && showRejectionInput" class="mt-4">
                    <label for="rejectionReason" class="block text-sm font-medium text-base-content/70 mb-2">Rejection Reason</label>
                    <textarea
                        v-model="rejectionReason"
                        id="rejectionReason"
                        class="textarea textarea-bordered w-full text-base resize-y"
                        placeholder="Enter reason for rejection (optional)"
                        rows="4"
                    ></textarea>
                </div>

                <!-- Action Buttons -->
                <div v-if="selectedApplication.status === 'pending'" class="flex flex-col sm:flex-row justify-end gap-3 mt-6">
                    <button
                        v-if="!showRejectionInput"
                        class="btn btn-error w-full sm:w-auto"
                        @click="showRejectionInput = true"
                    >Reject</button>
                    <button
                        v-if="showRejectionInput"
                        class="btn btn-error w-full sm:w-auto"
                        @click="updateApplicationStatus('rejected')"
                    >Confirm Reject</button>
                    <button
                        v-if="showRejectionInput"
                        class="btn btn-ghost w-full sm:w-auto"
                        @click="showRejectionInput = false; rejectionReason = ''"
                    >Cancel</button>
                    <button
                        v-if="!showRejectionInput"
                        class="btn btn-success w-full sm:w-auto"
                        @click="updateApplicationStatus('approved')"
                    >Approve</button>
                </div>
            </div>
            <div v-else class="text-center py-6">
                <p class="text-base text-base-content/70">No verification application found.</p>
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
      searchQuery: '', // New: Store search input
      selectedFilter: 'alphabetical', // New: Default filter
    };
  },
  computed: {
    showActionsColumn() {
      return !this.users.some(user => user.has_pending_verification);
    }
  },
  methods: {
    setFilter(filter) {
      this.selectedFilter = filter;
      this.fetchUsers();
    },
    async fetchUsers() {
      try {
        const response = await axios.get('/api/users/lists', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`,
          },
          params: {
            search: this.searchQuery,
            filter: this.selectedFilter,
          },
        });
        this.users = response.data;
      } catch (error) {
        console.error('Error fetching users:', error);
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