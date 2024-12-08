<template>
    <div class="admin-dashboard flex">
      <!-- Sidebar using DaisyUI components (fixed on the left) -->
      <div class="sidebar w-64 h-screen bg-base-200 p-4">
        <div class="text-lg font-bold text-white mb-6">Admin Dashboard</div>
        <div class="menu p-2 space-y-2">
          <router-link
            to="/admin/dashboard/posts"
            class="menu-item text-white hover:bg-base-300 p-2 rounded"
          >
            Posts
          </router-link>
          <router-link
            to="/admin/dashboard/stats"
            class="menu-item text-white hover:bg-base-300 p-2 rounded"
          >
            Stats
          </router-link>
          <router-link
            to="/admin/dashboard/reports"
            class="menu-item text-white hover:bg-base-300 p-2 rounded"
          >
            Reports
          </router-link>
          <router-link
            to="/admin/dashboard/users"
            class="menu-item text-white hover:bg-base-300 p-2 rounded"
          >
            Users
          </router-link>
        </div>
      </div>
  
      <!-- Content area where child routes will be rendered -->
      <div class="content flex-1 p-6">
        <router-view></router-view> <!-- Child route content will load here -->
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'AdminDashboard',
  };
  </script>
  
  <style scoped>
  .admin-dashboard {
    display: flex;
  }
  
  .sidebar {
    width: 250px; /* Sidebar width */
    height: 100vh; /* Full viewport height */
    background-color: #2a303c; /* Dark background for sidebar */
  }
  
  .menu-item {
    /* Styling for individual menu items */
    text-decoration: none;
    display: block;
    padding: 0.75rem 1.25rem;
    border-radius: 0.375rem;
  }
  
  .menu-item:hover {
    background-color: #3b4850;
  }
  </style>
  