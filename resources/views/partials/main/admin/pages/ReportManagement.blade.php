<section id="reports" class="body-font">
    <div class="container px-5 py-24 mx-auto flex justify-center flex-col align-middle items-center">
        <div class="flex flex-col text-center w-full mb-4">
            <h1 class="sm:text-3xl text-2xl font-medium title-fonttext-primary">Reported Content</h1>
            <p class="lg:w-2/3 mx-auto leading-relaxed text-base text-secondary">
                Recent logs decription
            </p>
            <div class="flex flex-wrap gap-x-2 gap-y-2 align-middle items-center justify-center w-full m-4">
              <div class="dropdown">
                  <div tabindex="0" role="button" class="btn m-1">Filter by</div>
                    <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                        <li><a>
                            Date Descending
                        </a></li>
                        <li><a>
                            Date Ascending
                        </a></li>
                        <li><a>
                            Account
                        </a></li>
                        <li><a>
                            Post
                        </a></li>
                        <li><a>
                            Announcement
                        </a></li>
                        <li><a>
                            Event
                        </a></li>
                    </ul>
                </div>
                <input type="text" placeholder="Search here..." class="input input-bordered w-full max-w-xs" />
            </div>
        </div>
        <div class="join">
            <button class="join-item btn btn-sm">1</button>
            <button class="join-item btn btn-sm">2</button>
            <button class="join-item btn btn-sm">3</button>
            <button class="join-item btn btn-sm">4</button>
        </div>
        <div class="overflow-x-auto m-4">
            <table class="table table-xs w-full">
              <thead>
                <tr>
                  <th></th>
                  <th>Name</th>
                  <th>Job</th>
                  <th>company</th>
                  <th>location</th>
                  <th>Last Login</th>
                  <th>Favorite Color</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th>1</th>
                  <td>Cy Ganderton</td>
                  <td>Quality Control Specialist</td>
                  <td>Littel, Schaden and Vandervort</td>
                  <td>Canada</td>
                  <td>12/16/2020</td>
                  <td>Blue</td>
                </tr>
                <tr>
                  <th>2</th>
                  <td>Hart Hagerty</td>
                  <td>Desktop Support Technician</td>
                  <td>Zemlak, Daniel and Leannon</td>
                  <td>United States</td>
                  <td>12/5/2020</td>
                  <td>Purple</td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <th></th>
                  <th>Name</th>
                  <th>Job</th>
                  <th>company</th>
                  <th>location</th>
                  <th>Last Login</th>
                  <th>Favorite Color</th>
                </tr>
              </tfoot>
            </table>
        </div>
        <div class="join">
            <button class="join-item btn btn-sm">1</button>
            <button class="join-item btn btn-sm">2</button>
            <button class="join-item btn btn-sm">3</button>
            <button class="join-item btn btn-sm">4</button>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<div class="max-w-md w-full bg-base-100 rounded-lg shadow p-4 md:p-6">
    <div class="flex justify-between">
      <div>
        <h5 class="leading-none text-3xl font-bold text-primary pb-2">123</h5>
        <p class="text-base font-normal text-base-content">Reports this week</p>
      </div>
    </div>
    <div id="area-chart"></div>
    <div class="grid grid-cols-1 items-center border-t border-base-200 justify-between">
      <div class="flex justify-between items-center pt-5">
        <a
          href="#reports"
          class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-primary hover:bg-base-200 hover:text-primary-focus px-3 py-2">
          Content Reports
          <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
          </svg>
        </a>
      </div>
    </div>
</div>  

<script>
    const options = {
    chart: {
        height: "100%",
        maxWidth: "100%",
        type: "area",
        fontFamily: "Inter, sans-serif",
        dropShadow: {
        enabled: false,
        },
        toolbar: {
        show: false,
        },
    },
    tooltip: {
        enabled: true,
        x: {
        show: false,
        },
    },
    fill: {
        type: "gradient",
        gradient: {
        opacityFrom: 0.55,
        opacityTo: 0,
        shade: "#1C64F2",
        gradientToColors: ["#1C64F2"],
        },
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        width: 6,
    },
    grid: {
        show: false,
        strokeDashArray: 4,
        padding: {
        left: 2,
        right: 2,
        top: 0
        },
    },
    series: [
        {
        name: "New users",
        data: [6500, 6418, 6456, 6526, 6356, 6456],
        color: "#1A56DB",
        },
    ],
    xaxis: {
        categories: ['01 February', '02 February', '03 February', '04 February', '05 February', '06 February', '07 February'],
        labels: {
        show: false,
        },
        axisBorder: {
        show: false,
        },
        axisTicks: {
        show: false,
        },
    },
    yaxis: {
        show: false,
    },
    }

    if (document.getElementById("area-chart") && typeof ApexCharts !== 'undefined') {
    const chart = new ApexCharts(document.getElementById("area-chart"), options);
    chart.render();
    }
</script>