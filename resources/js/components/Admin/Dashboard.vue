<template>

  <section class="body-font">
    <div class="container py-12 mx-auto w-full justify-center align-middle px-4">
      <div class="flex flex-col text-center mb-10">
        <h1 class="sm:text-3xl text-4xl font-medium title-font mb-4">Site Metrics</h1>
        <p class="leading-relaxed text-xs">
          Monitor the growth and engagement of our community with<br> detailed, real-time site metrics and insights that reflect <br>the performance and activity across the platform.
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
        <h1 class="sm:text-3xl text-4xl font-medium title-font mb-4">Site Metrics</h1>
        <p class="leading-relaxed text-xs">
          Monitor the growth and engagement of our community with<br> detailed, real-time site metrics and insights that reflect <br>the performance and activity across the platform.
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
        <h1 class="sm:text-3xl text-4xl font-medium title-font mb-4">Site Metrics</h1>
        <p class="leading-relaxed text-xs">
          Monitor the growth and engagement of our community with<br> detailed, real-time site metrics and insights that reflect <br>the performance and activity across the platform.
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
