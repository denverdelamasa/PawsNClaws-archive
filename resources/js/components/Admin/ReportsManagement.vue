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

      <!-- Report Table -->
      <div class="overflow-x-auto w-full">
        <div v-if="reports.length === 0" class="text-center py-8">
          <p class="text-lg text-gray-500">No reports available at this time.</p>
        </div>
        <table v-else class="table w-full">
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
                  v-if="report.type === 'comment'" 
                  class="btn btn-sm btn-primary"
                  @click="openReviewCommentModal(report)"
                >Review Comment</button>

                <button 
                  v-else-if="report.type === 'post'" 
                  class="btn btn-sm btn-primary"
                  @click="openReviewPostModal(report)"
                >Review Post</button>

                <button 
                  v-else-if="report.type === 'announcement'" 
                  class="btn btn-sm btn-primary"
                  @click="openReviewAnnouncementModal(report)"
                >Review Announcement</button>

                <button 
                  v-else-if="report.type === 'event'" 
                  class="btn btn-sm btn-primary"
                  @click="openReviewEventModal(report)"
                >Review Event</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Comment Modal -->
      <div v-if="showCommentModal" class="modal modal-open">
        <div class="modal-box">
          <h3 class="font-bold text-lg">Review Comment Report</h3>

          <div v-if="selectedReport.type === 'comment'" class="space-y-4">
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
            <button class="btn btn-warning" @click="takeDownContent(selectedReport, 'comment')">Take Down</button>
          </div>
        </div>
      </div>

      <!-- Post Modal -->
      <div v-if="showPostModal" class="modal modal-open">
        <div class="modal-box">
          <h3 class="font-bold text-lg">Review Post Report</h3>

          <div v-if="selectedReport.type === 'post'">
            <div class="card bg-base-200 border border-base-300 shadow-md">
              <div class="px-4 pt-4" v-if="report_post_image">
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
            <button class="btn btn-warning" @click="takeDownContent(selectedReport, 'post')">Take Down</button>
          </div>
        </div>
      </div>

      <!-- Announcement Modal -->
      <div v-if="showAnnouncementModal" class="modal modal-open">
        <div class="modal-box">
          <h3 class="font-bold text-lg">Review Announcement Report</h3>

          <div v-if="selectedReport.type === 'announcement'">
            <div class="card bg-base-200 border border-base-300 shadow-md">
              <div class="px-4 pt-4">
                <img 
                  :src="`/storage/${selectedReport.report_announcement_thumbnail}`" 
                  alt="Reported Announcement" 
                  class="w-full max-h-[500px] rounded-lg object-cover"
                />
              </div>
              <div class="card-body">
                <div class="flex items-center space-x-3">
                  <div class="avatar">
                    <div class="w-12 h-12 rounded-full">
                      <img 
                        :src="selectedReport.report_announcement_author_profile ? `/storage/${selectedReport.report_announcement_author_profile}` : 'https://picsum.photos/200'" 
                        alt="Author Avatar"
                      />
                    </div>
                  </div>
                  <div>
                    <p class="font-semibold">{{ selectedReport.report_announcement_author }}</p>
                    <p class="text-sm text-gray-500">{{ selectedReport.report_announcement_created_at }}</p>
                  </div>
                </div>
                <p class="mt-4">{{ selectedReport.report_announcement_description }}</p>
                <p class="text-sm text-gray-600 mt-2">Reported {{ selectedReport.report_announcement_count }} time(s)</p>
              </div>
            </div>
          </div>

          <div class="modal-action">
            <button class="btn btn-error" @click="closeReviewAnnouncementModal">Close</button>
            <button class="btn btn-warning" @click="takeDownContent(selectedReport, 'announcement')">Take Down</button>
          </div>
        </div>
      </div>

      <!-- Event Modal -->
      <div v-if="showEventModal" class="modal modal-open">
        <div class="modal-box">
          <h3 class="font-bold text-lg">Review Event Report</h3>

          <div v-if="selectedReport.type === 'event'">
            <div class="card bg-base-200 border border-base-300 shadow-md">
              <div class="px-4 pt-4">
                <img 
                  :src="`/storage/${selectedReport.report_event_thumbnail}`" 
                  alt="Reported Event" 
                  class="w-full max-h-[500px] rounded-lg object-cover"
                />
              </div>
              <div class="card-body">
                <div class="flex items-center space-x-3">
                  <div class="avatar">
                    <div class="w-12 h-12 rounded-full">
                      <img 
                        :src="selectedReport.report_event_author_profile ? `/storage/${selectedReport.report_event_author_profile}` : 'https://picsum.photos/200'" 
                        alt="Author Avatar"
                      />
                    </div>
                  </div>
                  <div>
                    <p class="font-semibold">{{ selectedReport.report_event_author }}</p>
                    <p class="text-sm text-gray-500">{{ selectedReport.report_event_created_at }}</p>
                  </div>
                </div>
                <p class="mt-4">{{ selectedReport.report_event_description }}</p>
                <p class="text-sm text-gray-600 mt-2">Reported {{ selectedReport.report_event_count }} time(s)</p>
              </div>
            </div>
          </div>

          <div class="modal-action">
            <button class="btn btn-error" @click="closeReviewEventModal">Close</button>
            <button class="btn btn-warning" @click="takeDownContent(selectedReport, 'event')">Take Down</button>
          </div>
        </div>
      </div>
    </div>
  </section>
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
      showAnnouncementModal: false,
      showEventModal: false,
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

    openReviewAnnouncementModal(report) {
      this.selectedReport = report;
      this.showAnnouncementModal = true;
    },

    closeReviewAnnouncementModal() {
      this.showAnnouncementModal = false;
      this.selectedReport = null;
    },

    openReviewEventModal(report) {
      this.selectedReport = report;
      this.showEventModal = true;
    },

    closeReviewEventModal() {
      this.showEventModal = false;
      this.selectedReport = null;
    },

    takeDownContent(report, type) {
      axios.post('/api/reports/take-down', {
        report_id: report.report_id,
        type: type
      })
        .then(response => {
          alert(response.data.message);
          this.fetchReports(); // Refresh the reports list
          this.closeReviewCommentModal();
          this.closeReviewPostModal();
          this.closeReviewAnnouncementModal();
          this.closeReviewEventModal();
        })
        .catch(error => {
          console.error('Error taking down content:', error);
          alert('Failed to take down content.');
        });
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