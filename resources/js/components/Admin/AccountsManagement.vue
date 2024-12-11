<template>
  <section class="body-font">
    <div class="container px-5 py-24 mx-auto flex justify-center flex-col align-middle items-center">
      <div class="flex flex-col text-center w-full mb-4">
        <h1 class="sm:text-3xl text-2xl font-medium title-font text-primary">Users</h1>
        <p class="lg:w-2/3 mx-auto leading-relaxed text-base text-secondary">
          Accounts list
        </p>
        <div class="flex flex-wrap gap-x-2 gap-y-2 align-middle items-center justify-center w-50 m-4">
          <div class="dropdown">
            <div tabindex="0" role="button" class="btn m-1">Filter by</div>
            <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
              <li><a>Alphabetical</a></li>
              <li><a>Recent</a></li>
              <li><a>Oldest</a></li>
              <li><a>Most Active</a></li>
              <li><a>Least Active</a></li>
            </ul>
          </div>
          <input type="text" placeholder="Search here..." class="input input-bordered w-full max-w-xs" />
        </div>
      </div>
      <div class="overflow-x-auto m-4">
        <table class="table table-m w-full">
          <thead>
            <tr>
              <th class="text-center px-4 py-2"></th>
              <th class="text-center px-4 py-2">Profile</th>
              <th class="text-center px-4 py-2">Name</th>
              <th class="text-center px-4 py-2">Role</th>
              <th class="text-center px-4 py-2">Status</th>
              <th class="text-center px-4 py-2">Last Login</th>
              <th class="text-center px-4 py-2">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(user, index) in users" :key="user.user_id" class="text-center">
              <th>{{ index + 1 }}</th>
              <td><img :src="user.profile_picture ? '/storage/' + user.profile_picture : defaultProfilePicture" 
                         alt="Profile Picture" 
                         class="w-10 h-10 rounded-full object-cover transition-transform duration-200 ease-in-out transform hover:scale-125 cursor-pointer">
              </td>
              <td>
                {{ user.name }}
                <br>
                {{ user.email }}
              </td>
              <td>
                {{ user.role }}
                <br>
                <!-- Change Role Button -->
                <button class="btn btn-xs bg-blue-500 text-white px-3 py-1 rounded" @click="checkAdminAndOpenChangeRoleModal(user)">
                  Change
                </button>
              </td>
              <td>{{ user.status }}</td>  
              <td>
                <!-- Conditionally render last_online based on is_online status -->
                <span v-if="user.is_online === false" class="text-gray-500">
                  {{ user.last_online }} ago
                </span>
                <span v-else class="flex items-center text-green-600 font-semibold">
                  <span class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>
                   Online
                </span>
              </td>
              <td>
                <!-- Actions with icons -->
                <button class="btn btn-sm bg-red-500 text-white px-4 py-2 rounded mr-2" @click="checkAdminAndOpenSuspendUserModal(user)">
                  <i class="fas fa-ban"></i> Suspend
                </button>
                <button class="btn btn-sm bg-yellow-500 text-white px-4 py-2 rounded mr-2" @click="warnUser(user.user_id)">
                  <i class="fas fa-exclamation-triangle"></i> Warn
                </button>
                <button class="btn btn-sm bg-red-700 text-white px-4 py-2 rounded" @click="checkAdminAndOpenDeleteModal(user)">
                  <i class="fas fa-trash"></i> Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      
      <!-- Modal for Unauthorized Access -->
      <div v-if="isUnauthorizedModalOpen" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-md shadow-lg w-96">
          <h3 class="text-lg font-semibold mb-4">{{ unauthorizedMessage }}</h3>
          <div class="flex justify-end gap-2">
            <button @click="closeUnauthorizedModal" class="btn btn-sm bg-gray-500 text-white px-4 py-2 rounded">Close</button>
          </div>
        </div>
      </div>

      <!-- Modal for Changing User Role -->
      <div v-if="isModalOpen" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-md shadow-lg w-96">
          <h3 class="text-lg font-semibold mb-4">Change User Role</h3>
          <div class="flex flex-col items-center mb-4">
            <img :src="currentUser?.profile_picture ? '/storage/' + currentUser.profile_picture : defaultProfilePicture" 
                 alt="Profile Picture" 
                 class="w-16 h-16 rounded-full object-cover mb-2">
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
            <button @click="closeModal" class="btn btn-sm bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
            <button @click="changeUserRole" class="btn btn-sm bg-blue-500 text-white px-4 py-2 rounded">Change</button>
          </div>
        </div>
      </div>

      <!-- Modal for Suspending User -->
      <div v-if="isSuspendModalOpen" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-md shadow-lg w-96">
          <h3 class="text-lg font-semibold mb-4">Suspend User</h3>
          <div class="flex flex-col items-center mb-4">
            <img :src="currentUser?.profile_picture ? '/storage/' + currentUser.profile_picture : defaultProfilePicture" 
                 alt="Profile Picture" 
                 class="w-16 h-16 rounded-full object-cover mb-2">
            <p class="text-lg font-medium">{{ currentUser?.name }}</p>
            <p class="text-sm text-gray-600">{{ currentUser?.email }}</p>
          </div>
          <label for="suspensionDuration">Suspension Duration:</label>
          <select v-model="suspensionDuration" id="suspensionDuration" class="select select-bordered w-full mb-4">
            <option value="1">1 Day</option>
            <option value="7">1 Week</option>
            <option value="30">1 Month</option>
          </select>
          <div class="flex justify-end gap-2">
            <button @click="closeSuspendModal" class="btn btn-sm bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
            <button @click="suspendUserAction" class="btn btn-sm bg-red-500 text-white px-4 py-2 rounded">Suspend</button>
          </div>
        </div>
      </div>

      <!-- Modal for Delete Confirmation -->
      <div v-if="isDeleteModalOpen" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-md shadow-lg w-96">
          <h3 class="text-lg font-semibold mb-4">Are you sure you want to delete this user?</h3>
          <div class="flex flex-col items-center mb-4">
            <img :src="currentUser?.profile_picture ? '/storage/' + currentUser.profile_picture : defaultProfilePicture" 
                 alt="Profile Picture" 
                 class="w-16 h-16 rounded-full object-cover mb-2">
            <p class="text-lg font-medium">{{ currentUser?.name }}</p>
            <p class="text-sm text-gray-600">{{ currentUser?.email }}</p>
          </div>
          <div class="flex justify-end gap-2">
            <button @click="closeDeleteModal" class="btn btn-sm bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
            <button @click="confirmDeleteUser" class="btn btn-sm bg-red-500 text-white px-4 py-2 rounded">Delete</button>
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
