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
                <span
                  v-else
                  class="text-green-600 font-semibold flex items-center"
                >
                  <span class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>
                  Online
                </span>
              </td>
              <td class="whitespace-nowrap">
                <div class="flex flex-wrap gap-1">
                  <!-- Action Buttons -->
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
    </div>
  </section>

</template>

<script>
import axios from 'axios';
import '@fortawesome/fontawesome-free/css/all.min.css';

export default {
  data() {
    return {
      users: [], // Will hold the user data
      isModalOpen: false, // Track modal open state for role change
      isSuspendModalOpen: false, // Track modal open state for suspension
      isDeleteModalOpen: false,
      selectedRole: '', // Role selected in the modal
      suspensionDuration: 7, // Default suspension duration in days
      currentUser: null, // Current user to change role or suspend
      isUnauthorizedModalOpen: false,
      unauthorizedMessage: '',
    };
  },
  methods: {
    async checkAdminAndOpenSuspendUserModal(user) {
      const currentUserRole = await this.getCurrentUserRole();
      if (currentUserRole !== 'Admin') {
        this.openUnauthorizedModal('Only admins can change roles');
      } else {
        this.currentUser = user;
        this.isSuspendModalOpen = true;
      }
    },
    async checkAdminAndOpenDeleteModal(user) {
      const currentUserRole = await this.getCurrentUserRole();
      if (currentUserRole !== 'Admin') {
        this.openUnauthorizedModal('Only admins can change roles');
      } else {
        this.currentUser = user;
        this.isDeleteModalOpen = true;
      }
    },
    openUnauthorizedModal(message) {
      this.unauthorizedMessage = message;
      this.isUnauthorizedModalOpen = true;
    },
    closeUnauthorizedModal() {
      this.isUnauthorizedModalOpen = false;
    },
    async getCurrentUserRole() {
      try {
        const response = await axios.get('/api/users/check/role');  // Adjust the URL if needed
        return response.data.role;
      } catch (error) {
        console.error('Error fetching user role:', error);
        return null;  // Or handle error appropriately
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
    fetchUsers() {
      axios.get('/api/users/lists')
        .then(response => {
          this.users = response.data;
        })
        .catch(error => {
          console.error('There was an error fetching users:', error);
        });
    },
    openChangeRoleModal(user) {
      this.currentUser = user;
      this.selectedRole = '';
      this.isModalOpen = true;
    },
    closeModal() {
      this.isModalOpen = false;
    },
    changeUserRole() {
      if (!this.selectedRole) {
        alert('Please select a role');
        return;
      }

      axios.put(`/api/users/role/change/${this.currentUser.user_id}`, { role: this.selectedRole })
        .then(response => {
          this.closeModal();
          this.fetchUsers();
          alert('User role changed successfully');
        })
        .catch(error => {
          console.error('There was an error changing the user role:', error);
        });
    },
    openSuspendUserModal(user) {
      this.currentUser = user;
      this.suspensionDuration = 7; // Default to 1 week
      this.isSuspendModalOpen = true;
    },
    closeSuspendModal() {
      this.isSuspendModalOpen = false;
    },
    suspendUserAction() {
      axios.put(`/api/users/role/suspend/${this.currentUser.user_id}`, { duration: this.suspensionDuration })
        .then(() => {
          this.closeSuspendModal();
          this.fetchUsers();
          alert('User suspended successfully');
        })
        .catch(error => {
          console.error('Error suspending user:', error);
        });
    },
    openDeleteModal(user) {
      this.currentUser = user;
      this.isDeleteModalOpen = true;
    },

    // Close the delete confirmation modal
    closeDeleteModal() {
      this.isDeleteModalOpen = false;
    },

    // Perform the delete action
    confirmDeleteUser() {
      axios.delete(`/api/users/delete/${this.currentUser.user_id}`)
        .then(() => {
          this.fetchUsers(); // Refresh the users list
          this.closeDeleteModal(); // Close the modal
          alert('User deleted successfully');
        })
        .catch(error => {
          console.error('Error deleting user:', error);
          this.closeDeleteModal(); // Close the modal even if there's an error
        });
    },
    warnUser(userId) {
      axios.post(`/api/users/warn/${userId}`)
        .then(() => {
          alert('User warned successfully');
        })
        .catch(error => {
          console.error('Error warning user:', error);
        });
    },
  },
  mounted() {
    this.fetchUsers();
  }
};
</script>

<style scoped>
.btn i {
  margin-right: 5px;
}
</style>
