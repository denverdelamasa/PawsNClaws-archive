<template>
  <section id="reports" class="body-font">
    <div class="container px-5 py-24 mx-auto flex flex-col items-center">
      
      <!-- Header -->
      <div class="text-center w-full mb-4">
        <h1 class="sm:text-5xl text-4xl font-bold">Reported Content</h1>
        <p class="lg:w-2/3 mx-auto text-base">
          View a list of all content that has been flagged by users for review. Stay on top of reports and keep the community safe.
        </p>
      </div>

      <!-- Filter & Search -->
      <div class="flex flex-wrap justify-center items-center w-full gap-2 mb-6">
        <div class="dropdown">
          <div tabindex="0" role="button" class="btn btn-outline">Filter by</div>
          <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52 z-[1]">
            <li><a>Date Descending</a></li>
            <li><a>Date Ascending</a></li>
            <li><a>Account</a></li>
            <li><a>Post</a></li>
            <li><a>Announcement</a></li>
            <li><a>Event</a></li>
          </ul>
        </div>

        <input 
          v-model="searchQuery" 
          type="text" 
          placeholder="Search here..." 
          class="input input-bordered w-full max-w-md" 
        />
      </div>

      <!-- Report Table -->
      <div class="overflow-x-auto w-full">
        <table class="table w-full">
          <thead>
            <tr class="text-sm text-base-content">
              <th>Reporter</th>
              <th>Reason</th>
              <th>Type</th>
              <th>Review</th>
            </tr>
          </thead>
          <tbody>
            <tr 
              v-for="(report, index) in reports" 
              :key="index" 
              class="hover:bg-base-200 transition-all"
            >
              <td>{{ report.reporter_name }}</td>
              <td>{{ report.reason }}</td>
              <td>{{ report.type }}</td>
              <td>
                <button 
                  v-if="report.type === 'Comment'" 
                  class="btn btn-sm btn-primary"
                  @click="openReviewCommentModal(report)"
                >Review Comment</button>

                <button 
                  v-else-if="report.type === 'Post'" 
                  class="btn btn-sm btn-primary"
                  @click="openReviewPostModal(report)"
                >Review Post</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Comment Modal -->
      <div v-if="showCommentModal" class="modal modal-open">
        <div class="modal-box">
          <h3 class="font-bold text-lg">Review Comment Report</h3>

          <div v-if="selectedReport.type === 'Comment'" class="space-y-4">
            <div class="flex items-center space-x-4">
              <div class="avatar">
                <div class="w-12 h-12 rounded-full">
                  <img 
                    :src="selectedReport.report_comment_author_profile ? `/storage/${selectedReport.report_comment_author_profile}` : 'https://picsum.photos/200'" 
                    alt="Avatar"
                  />
                </div>
              </div>
              <div>
                <p class="font-semibold">{{ selectedReport.report_comment_author }}</p>
                <p class="text-sm text-gray-500">{{ selectedReport.report_comment_created_at }}</p>
              </div>
            </div>
            <p class="text-base">{{ selectedReport.report_comment }}</p>
            <p class="text-sm text-gray-600">Reported {{ selectedReport.report_comment_count }} time(s)</p>
          </div>

          <div v-else>
            <p>No details available for this type.</p>
          </div>

          <div class="modal-action">
            <button class="btn btn-error" @click="closeReviewCommentModal">Close</button>
          </div>
        </div>
      </div>

      <!-- Post Modal -->
      <div v-if="showPostModal" class="modal modal-open">
        <div class="modal-box">
          <h3 class="font-bold text-lg">Review Post Report</h3>

          <div v-if="selectedReport.type === 'Post'">
            <div class="card bg-base-200 border border-base-300 shadow-md">
              <div class="px-4 pt-4">
                <img 
                  :src="`/storage/${selectedReport.report_post_image}`" 
                  alt="Reported Post" 
                  class="w-full max-h-[500px] rounded-lg object-cover"
                />
              </div>
              <div class="card-body">
                <div class="flex items-center space-x-3">
                  <div class="avatar">
                    <div class="w-12 h-12 rounded-full">
                      <img 
                        :src="selectedReport.report_post_author_profile ? `/storage/${selectedReport.report_post_author_profile}` : 'https://picsum.photos/200'" 
                        alt="Author Avatar"
                      />
                    </div>
                  </div>
                  <div>
                    <p class="font-semibold">{{ selectedReport.report_post_author }}</p>
                    <p class="text-sm text-gray-500">{{ selectedReport.report_post_created_at }}</p>
                  </div>
                </div>
                <p class="mt-4">{{ selectedReport.report_post_caption }}</p>
                <p class="text-sm text-gray-600 mt-2">Reported {{ selectedReport.report_post_count }} time(s)</p>
              </div>
            </div>
          </div>

          <div class="modal-action">
            <button class="btn btn-error" @click="closeReviewPostModal">Close</button>
          </div>
        </div>
      </div>

      <!-- Pagination Placeholder -->
      <div class="join mt-8">
        <button class="join-item btn btn-sm">1</button>
        <button class="join-item btn btn-sm">2</button>
        <button class="join-item btn btn-sm">3</button>
        <button class="join-item btn btn-sm">4</button>
      </div>
    </div>
  </section>

  <!--
    <div class="max-w-md w-full bg-base-100 rounded-lg shadow p-4 md:p-6">
      <div class="flex justify-between">
        <div>
          <h5 class="leading-none text-3xl font-bold text-primary pb-2">{{ reportCount }}</h5>
          <p class="text-base font-normal text-base-content">Reports this week</p>
        </div>
      </div>
      <div id="area-chart"></div>
      <div class="grid grid-cols-1 items-center border-t border-base-200 justify-between">
        <div class="flex justify-between items-center pt-5">
          <a href="#reports" class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-primary hover:bg-base-200 hover:text-primary-focus px-3 py-2">
            Content Reports
            <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
          </a>
        </div>
      </div>
    </div>
  -->
</template>

<script>
import axios from 'axios';
import ApexCharts from 'apexcharts';

export default {
  data() {
    return {
      reports: [],
      reportCount: 0,
      searchQuery: '',
      showCommentModal: false,
      showPostModal: false,
      selectedReport: null,
      chartOptions: {
        chart: {
          height: "100%",
          maxWidth: "100%",
          type: "area",
          fontFamily: "Inter, sans-serif",
          dropShadow: { enabled: false },
          toolbar: { show: false },
        },
        tooltip: { enabled: true, x: { show: false } },
        fill: {
          type: "gradient",
          gradient: {
            opacityFrom: 0.55,
            opacityTo: 0,
            shade: "#1C64F2",
            gradientToColors: ["#1C64F2"],
          },
        },
        dataLabels: { enabled: false },
        stroke: { width: 6 },
        grid: {
          show: false,
          strokeDashArray: 4,
          padding: { left: 2, right: 2, top: 0 },
        },
        series: [{ name: "New users", data: [], color: "#1A56DB" }],
        xaxis: {
          categories: [],
          labels: { show: false },
          axisBorder: { show: false },
          axisTicks: { show: false },
        },
        yaxis: { show: false },
      },
    };
  },

  methods: {
    fetchReports() {
      axios.get('/api/reports/lists')
        .then(response => {
          this.reports = response.data;
          this.reportCount = this.reports.length;
          this.renderChart();
        })
        .catch(error => {
          console.error('Error fetching reports:', error);
        });
    },
    openReviewCommentModal(report) {
        this.selectedReport = report;
        this.showCommentModal = true;
    },

    closeReviewCommentModal() {
        this.showCommentModal = false;
        this.selectedReport = null;
    },
    openReviewPostModal(report) {
      this.selectedReport = report;
      this.showPostModal = true;
    },

    closeReviewPostModal() {
      this.showPostModal = false;
      this.selectedReport = null;
    },

    renderChart() {
      if (document.getElementById("area-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("area-chart"), this.chartOptions);
        chart.render();
      }
    },
  },

  mounted() {
    this.fetchReports();
  },
};
</script>

<style scoped>
/* Add your custom styles here */
</style>
