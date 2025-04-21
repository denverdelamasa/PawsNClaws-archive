<template>
  <section class="body-font">
    <div class="container py-12 mx-auto w-full justify-center align-middle px-4">
      <div class="flex flex-col text-center mb-10">
        <h1 class="sm:text-3xl text-4xl font-medium title-font mb-4">Site Metrics</h1>
        <p class="leading-relaxed text-xs">
          Monitor the growth and engagement of our community with detailed, real-time site metrics and insights that reflect the performance and activity across the platform.
        </p>
      </div>

      <!-- NEW: Responsive grid -->
      <div class="flex flex-wrap gap-4 justify-center">
        <!-- Repeat this block for each stat -->
        <div class="stats shadow bg-base-200 rounded-lg hide-scrollbar">
            <div class="stat">
              <div class="stat-figure text-indigo-500">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-12 h-12" viewBox="0 0 16 16">
                      <path d="M8 9.05a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                      <path d="M1 1a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h.5a.5.5 0 0 0 .5-.5.5.5 0 0 1 1 0 .5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5.5.5 0 0 1 1 0 .5.5 0 0 0 .5.5h.5a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H6.707L6 1.293A1 1 0 0 0 5.293 1zm0 1h4.293L6 2.707A1 1 0 0 0 6.707 3H15v10h-.085a1.5 1.5 0 0 0-2.4-.63C11.885 11.223 10.554 10 8 10c-2.555 0-3.886 1.224-4.514 2.37a1.5 1.5 0 0 0-2.4.63H1z"/>
                  </svg>
              </div>
              <div class="stat-title text-primary">Accounts</div>
              <div class="stat-value text-2xl">{{ dashboard.total_users }}</div>
            </div>
          </div>
          <div class="stats shadow bg-base-200 rounded-lg hide-scrollbar">
            <div class="stat">
              <div class="stat-figure text-indigo-500">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-12 h-12" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1zm7.5.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0zM2 5.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5M10.5 5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zM13 8h-2V6h2z"/>
                  </svg>
              </div>
              <div class="stat-title text-primary">Posts</div>
              <div class="stat-value text-2xl">{{ dashboard.total_posts }}</div>
            </div>
          </div>
          <div class="stats shadow bg-base-200 rounded-lg hide-scrollbar">
            <div class="stat">
              <div class="stat-figure text-indigo-500">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-12 h-12" viewBox="0 0 16 16">
                      <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21 21 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21 21 0 0 0 14 7.655V1.222z"/>
                  </svg>
              </div>
              <div class="stat-title text-primary ">Reports</div>
              <div class="stat-value text-2xl">{{ dashboard.total_reports }}</div>
            </div>
          </div>
          <div class="stats shadow bg-base-200 rounded-lg hide-scrollbar">
            <div class="stat">
              <div class="stat-figure text-indigo-500">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-12 h-12" viewBox="0 0 16 16">
                      <path d="M14 9.5a2 2 0 1 1-4 0 2 2 0 0 1 4 0m-6 5.7c0 .8.8.8.8.8h6.4s.8 0 .8-.8-.8-3.2-4-3.2-4 2.4-4 3.2"/>
                      <path fill="green" d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h5.243c.122-.326.295-.668.526-1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v7.81c.353.23.656.496.91.783Q16 12.312 16 12V4a2 2 0 0 0-2-2z"/>                  
                  </svg>
              </div>
              <div class="stat-title text-primary">Active</div>
              <div class="stat-value text-2xl">{{ dashboard.online_users }}</div>
            </div>
          </div>

      </div>
    </div>
  </section>

  <section class="body-font">
    <div class="container py-12 mx-auto w-full justify-center align-middle px-4">
      <div class="flex flex-col text-center mb-10">
        <h1 class="sm:text-3xl text-4xl font-medium title-font mb-4">Recent Logs</h1>
        <p class="leading-relaxed text-xs">
          A chronological overview of recent activities within the system. Track logins, post deletions, user updates, and more to monitor platform behavior and maintain transparency.
        </p>
      </div>

      <div class="overflow-x-auto rounded-lg border border-base-300">
        <table class="table table-xs md:table-sm lg:table-md">
          <thead class="bg-base-200">
            <tr>
              <th>#</th>
              <th>Date & Time</th>
              <th>Username</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>1</th>
              <td>2025-04-10 14:35</td>
              <td>mod_jenna</td>
              <td>Approved foster application from user: <span class="font-semibold">doglover99</span></td>
            </tr>
            <tr>
              <th>2</th>
              <td>2025-04-10 13:12</td>
              <td>admin_carlos</td>
              <td>Updated user role: <span class="font-semibold">pawsup23</span> → Moderator</td>
            </tr>
            <tr>
              <th>3</th>
              <td>2025-04-10 11:50</td>
              <td>shelter_sunnyhome</td>
              <td>Created new event: <span class="italic">Adopt-A-Pet Sunday</span></td>
            </tr>
            <tr>
              <th>4</th>
              <td>2025-04-10 09:27</td>
              <td>mod_jenna</td>
              <td>Deleted post flagged for spam from user: <span class="font-semibold">user1245</span></td>
            </tr>
            <tr>
              <th>5</th>
              <td>2025-04-09 17:03</td>
              <td>admin_carlos</td>
              <td>Manually verified shelter: <span class="font-semibold">Happy Tails PH</span></td>
            </tr>
          </tbody>
        </table>
        <div class="flex justify-center mt-4 mb-4">
          <div class="join">
            <button class="join-item btn btn-xs sm:btn-sm md:btn-md">«</button>
            <button class="join-item btn btn-xs sm:btn-sm md:btn-md btn-active">1</button>
            <button class="join-item btn btn-xs sm:btn-sm md:btn-md">2</button>
            <button class="join-item btn btn-xs sm:btn-sm md:btn-md">3</button>
            <button class="join-item btn btn-xs sm:btn-sm md:btn-md">»</button>
          </div>
        </div>
      </div>

    </div>
  </section> 
  
  <section class="body-font">
    <div class="container py-12 mx-auto w-full justify-center align-middle px-4">
      <div class="flex flex-col text-center mb-10">
        <h1 class="sm:text-3xl text-4xl font-medium title-font mb-4">Pending Queue</h1>
        <p class="leading-relaxed text-xs">
          displays all current pending requests awaiting admin review. This includes foster applications, shelter applications, and account upgrade requests. Review and take action to ensure a smooth verification process and platform integrity.
        </p>
      </div>

      <div class="overflow-x-auto rounded-lg border border-base-300">
        <table class="table table-xs md:table-sm lg:table-md">
          <thead class="bg-base-200">
            <tr>
              <th>#</th>
              <th>Date Applied</th>
              <th>Username</th>
              <th>Role Applied</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>1</th>
              <td>2025-04-10</td>
              <td>doglover99</td>
              <td>Foster</td>
              <td>
                <button class="btn btn-xs btn-primary btn-outline" onclick="view_modal_1.showModal()">View</button>
              </td>
            </tr>
            <tr>
              <th>2</th>
              <td>2025-04-09</td>
              <td>pawsup23</td>
              <td>Moderator</td>
              <td>
                <button class="btn btn-xs btn-primary btn-outline" onclick="view_modal_2.showModal()">View</button>
              </td>
            </tr>
            <tr>
              <th>3</th>
              <td>2025-04-08</td>
              <td>happytails_ph</td>
              <td>Shelter</td>
              <td>
                <button class="btn btn-xs btn-primary btn-outline" onclick="view_modal_3.showModal()">View</button>
              </td>
            </tr>
          </tbody>
        </table>

        <!-- Pagination -->
        <div class="flex justify-center mt-4 mb-4">
          <div class="join">
            <button class="join-item btn btn-xs sm:btn-sm md:btn-md">«</button>
            <button class="join-item btn btn-xs sm:btn-sm md:btn-md btn-active">1</button>
            <button class="join-item btn btn-xs sm:btn-sm md:btn-md">2</button>
            <button class="join-item btn btn-xs sm:btn-sm md:btn-md">3</button>
            <button class="join-item btn btn-xs sm:btn-sm md:btn-md">»</button>
          </div>
        </div>
      </div>

      <!-- View Modal 1 -->
      <dialog id="view_modal_1" class="modal">
        <div class="modal-box">
          <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
          </form>
          <h3 class="text-lg font-bold mb-2">Foster Application</h3>
          <p><span class="font-semibold">Username:</span> doglover99</p>
          <p><span class="font-semibold">Email:</span> doglover99@email.com</p>
          <p><span class="font-semibold">Role Applied:</span> Foster</p>
          <p><span class="font-semibold">Date Applied:</span> 2025-04-10</p>
          <p><span class="font-semibold">Status:</span> <span class="badge badge-warning">Pending</span></p>
          <p class="mt-3"><span class="font-semibold">Notes:</span> I’ve been fostering animals since 2022. Hoping to help more!</p>
          <div class="mt-4 flex justify-end gap-2">
            <button class="btn btn-success btn-sm">Approve</button>
            <button class="btn btn-error btn-sm">Reject</button>
          </div>
        </div>
      </dialog>

      <!-- View Modal 2 -->
      <dialog id="view_modal_2" class="modal">
        <div class="modal-box">
          <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
          </form>
          <h3 class="text-lg font-bold mb-2">Moderator Application</h3>
          <p><span class="font-semibold">Username:</span> pawsup23</p>
          <p><span class="font-semibold">Email:</span> pawsup23@email.com</p>
          <p><span class="font-semibold">Role Applied:</span> Moderator</p>
          <p><span class="font-semibold">Date Applied:</span> 2025-04-09</p>
          <p><span class="font-semibold">Status:</span> <span class="badge badge-warning">Pending</span></p>
          <p class="mt-3"><span class="font-semibold">Notes:</span> Active user who reports frequently. Wants to help moderate the community.</p>
          <div class="mt-4 flex justify-end gap-2">
            <button class="btn btn-success btn-sm">Approve</button>
            <button class="btn btn-error btn-sm">Reject</button>
          </div>
        </div>
      </dialog>

      <!-- View Modal 3 -->
      <dialog id="view_modal_3" class="modal">
        <div class="modal-box">
          <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
          </form>
          <h3 class="text-lg font-bold mb-2">Shelter Application</h3>
          <p><span class="font-semibold">Username:</span> happytails_ph</p>
          <p><span class="font-semibold">Email:</span> info@happytails.ph</p>
          <p><span class="font-semibold">Role Applied:</span> Shelter</p>
          <p><span class="font-semibold">Date Applied:</span> 2025-04-08</p>
          <p><span class="font-semibold">Status:</span> <span class="badge badge-warning">Pending</span></p>
          <p class="mt-3"><span class="font-semibold">Notes:</span> Legit shelter with paperwork. Hoping to reach more adopters through the platform.</p>
          <div class="mt-4 flex justify-end gap-2">
            <button class="btn btn-success btn-sm">Approve</button>
            <button class="btn btn-error btn-sm">Reject</button>
          </div>
        </div>
      </dialog>


    </div>
  </section> 
</template>
<script>
import axios from 'axios';

export default {
    data(){
        return{
            dashboard:{
                total_users: 0,
                total_posts: 0,
                total_reports: 0,
                online_users: 0,
            }
        }
    },
    methods: {
        async fetchDashboard() {
            try {
                const response = await axios.get('/api/dashboard/count');
                this.dashboard = response.data;
            } catch (error) {
                console.error('Error fetching statistics:', error);
            }
        },
    },
    mounted() {
        this.fetchDashboard();
    },
}
</script>
