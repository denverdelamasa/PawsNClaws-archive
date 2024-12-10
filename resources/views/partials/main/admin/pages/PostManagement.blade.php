<section class="body-font">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-col text-center w-full mb-4">
            <h1 class="sm:text-3xl text-2xl font-medium title-font text-primary">Posts Management</h1>
            <p class="lg:w-2/3 mx-auto leading-relaxed text-base text-secondary">
                Lahat ng posts nandito
            </p>
        </div>
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
                        Most Liked
                    </a></li>
                    <li><a>
                        Most Comments
                    </a></li>
                </ul>
            </div>
            <input type="text" placeholder="Search here..." class="input input-bordered w-full max-w-xs" />
        </div>
        <div class="overflow-x-auto">
            <table class="table">
              <!-- head -->
              <thead>
                <tr>
                  <th>
                    <label>
                      <input type="checkbox" class="checkbox" />
                    </label>
                  </th>
                  <th>Name</th>
                  <th>Job</th>
                  <th>Favorite Color</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <!-- row 1 -->
                <tr>
                  <th>
                    <label>
                      <input type="checkbox" class="checkbox" />
                    </label>
                  </th>
                  <td>
                    <div class="flex items-center gap-3">
                      <div class="avatar">
                        <div class="mask mask-squircle h-12 w-12">
                          <img
                            src="https://img.daisyui.com/images/profile/demo/2@94.webp"
                            alt="Avatar Tailwind CSS Component" />
                        </div>
                      </div>
                      <div>
                        <div class="font-bold">Hart Hagerty</div>
                        <div class="text-sm opacity-50">United States</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    Zemlak, Daniel and Leannon
                    <br />
                    <span class="badge badge-ghost badge-sm">Desktop Support Technician</span>
                  </td>
                  <td>Purple</td>
                  <th>
                    <button class="btn btn-ghost btn-xs">details</button>
                  </th>
                </tr>
                <!-- row 2 -->
                <tr>
                  <th>
                    <label>
                      <input type="checkbox" class="checkbox" />
                    </label>
                  </th>
                  <td>
                    <div class="flex items-center gap-3">
                      <div class="avatar">
                        <div class="mask mask-squircle h-12 w-12">
                          <img
                            src="https://img.daisyui.com/images/profile/demo/3@94.webp"
                            alt="Avatar Tailwind CSS Component" />
                        </div>
                      </div>
                      <div>
                        <div class="font-bold">Brice Swyre</div>
                        <div class="text-sm opacity-50">China</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    Carroll Group
                    <br />
                    <span class="badge badge-ghost badge-sm">Tax Accountant</span>
                  </td>
                  <td>Red</td>
                  <th>
                    <button class="btn btn-ghost btn-xs">details</button>
                  </th>
                </tr>
                <!-- row 3 -->
                <tr>
                  <th>
                    <label>
                      <input type="checkbox" class="checkbox" />
                    </label>
                  </th>
                  <td>
                    <div class="flex items-center gap-3">
                      <div class="avatar">
                        <div class="mask mask-squircle h-12 w-12">
                          <img
                            src="https://img.daisyui.com/images/profile/demo/4@94.webp"
                            alt="Avatar Tailwind CSS Component" />
                        </div>
                      </div>
                      <div>
                        <div class="font-bold">Marjy Ferencz</div>
                        <div class="text-sm opacity-50">Russia</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    Rowe-Schoen
                    <br />
                    <span class="badge badge-ghost badge-sm">Office Assistant I</span>
                  </td>
                  <td>Crimson</td>
                  <th>
                    <button class="btn btn-ghost btn-xs">details</button>
                  </th>
                </tr>
                <!-- row 4 -->
                <tr>
                  <th>
                    <label>
                      <input type="checkbox" class="checkbox" />
                    </label>
                  </th>
                  <td>
                    <div class="flex items-center gap-3">
                      <div class="avatar">
                        <div class="mask mask-squircle h-12 w-12">
                          <img
                            src="https://img.daisyui.com/images/profile/demo/5@94.webp"
                            alt="Avatar Tailwind CSS Component" />
                        </div>
                      </div>
                      <div>
                        <div class="font-bold">Yancy Tear</div>
                        <div class="text-sm opacity-50">Brazil</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    Wyman-Ledner
                    <br />
                    <span class="badge badge-ghost badge-sm">Community Outreach Specialist</span>
                  </td>
                  <td>Indigo</td>
                  <th>
                    <button class="btn btn-ghost btn-xs">details</button>
                  </th>
                </tr>
              </tbody>
              <!-- foot -->
              <tfoot>
                <tr>
                  <th></th>
                  <th>Name</th>
                  <th>Job</th>
                  <th>Favorite Color</th>
                  <th></th>
                </tr>
              </tfoot>
            </table>
        </div>
    </div>
</section>

<section class="body-font">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-col text-center w-full mb-4">
            <h1 class="sm:text-3xl text-2xl font-medium title-font text-primary">Flagged Posts</h1>
            <p class="lg:w-2/3 mx-auto leading-relaxed text-base text-secondary">
                Lahat ng reported posts nandito
            </p>
        </div>
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
                        Most Liked
                    </a></li>
                    <li><a>
                        Most Comments
                    </a></li>
                </ul>
            </div>
            <input type="text" placeholder="Search here..." class="input input-bordered w-full max-w-xs" />
        </div>
        <div class="overflow-x-auto">
            <table class="table">
              <!-- head -->
              <thead>
                <tr>
                  <th>
                    <label>
                      <input type="checkbox" class="checkbox" />
                    </label>
                  </th>
                  <th>Name</th>
                  <th>Job</th>
                  <th>Favorite Color</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <!-- row 1 -->
                <tr>
                  <th>
                    <label>
                      <input type="checkbox" class="checkbox" />
                    </label>
                  </th>
                  <td>
                    <div class="flex items-center gap-3">
                      <div class="avatar">
                        <div class="mask mask-squircle h-12 w-12">
                          <img
                            src="https://img.daisyui.com/images/profile/demo/2@94.webp"
                            alt="Avatar Tailwind CSS Component" />
                        </div>
                      </div>
                      <div>
                        <div class="font-bold">Hart Hagerty</div>
                        <div class="text-sm opacity-50">United States</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    Zemlak, Daniel and Leannon
                    <br />
                    <span class="badge badge-ghost badge-sm">Desktop Support Technician</span>
                  </td>
                  <td>Purple</td>
                  <th>
                    <button class="btn btn-ghost btn-xs">details</button>
                  </th>
                </tr>
                <!-- row 2 -->
                <tr>
                  <th>
                    <label>
                      <input type="checkbox" class="checkbox" />
                    </label>
                  </th>
                  <td>
                    <div class="flex items-center gap-3">
                      <div class="avatar">
                        <div class="mask mask-squircle h-12 w-12">
                          <img
                            src="https://img.daisyui.com/images/profile/demo/3@94.webp"
                            alt="Avatar Tailwind CSS Component" />
                        </div>
                      </div>
                      <div>
                        <div class="font-bold">Brice Swyre</div>
                        <div class="text-sm opacity-50">China</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    Carroll Group
                    <br />
                    <span class="badge badge-ghost badge-sm">Tax Accountant</span>
                  </td>
                  <td>Red</td>
                  <th>
                    <button class="btn btn-ghost btn-xs">details</button>
                  </th>
                </tr>
                <!-- row 3 -->
                <tr>
                  <th>
                    <label>
                      <input type="checkbox" class="checkbox" />
                    </label>
                  </th>
                  <td>
                    <div class="flex items-center gap-3">
                      <div class="avatar">
                        <div class="mask mask-squircle h-12 w-12">
                          <img
                            src="https://img.daisyui.com/images/profile/demo/4@94.webp"
                            alt="Avatar Tailwind CSS Component" />
                        </div>
                      </div>
                      <div>
                        <div class="font-bold">Marjy Ferencz</div>
                        <div class="text-sm opacity-50">Russia</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    Rowe-Schoen
                    <br />
                    <span class="badge badge-ghost badge-sm">Office Assistant I</span>
                  </td>
                  <td>Crimson</td>
                  <th>
                    <button class="btn btn-ghost btn-xs">details</button>
                  </th>
                </tr>
                <!-- row 4 -->
                <tr>
                  <th>
                    <label>
                      <input type="checkbox" class="checkbox" />
                    </label>
                  </th>
                  <td>
                    <div class="flex items-center gap-3">
                      <div class="avatar">
                        <div class="mask mask-squircle h-12 w-12">
                          <img
                            src="https://img.daisyui.com/images/profile/demo/5@94.webp"
                            alt="Avatar Tailwind CSS Component" />
                        </div>
                      </div>
                      <div>
                        <div class="font-bold">Yancy Tear</div>
                        <div class="text-sm opacity-50">Brazil</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    Wyman-Ledner
                    <br />
                    <span class="badge badge-ghost badge-sm">Community Outreach Specialist</span>
                  </td>
                  <td>Indigo</td>
                  <th>
                    <button class="btn btn-ghost btn-xs">details</button>
                  </th>
                </tr>
              </tbody>
              <!-- foot -->
              <tfoot>
                <tr>
                  <th></th>
                  <th>Name</th>
                  <th>Job</th>
                  <th>Favorite Color</th>
                  <th></th>
                </tr>
              </tfoot>
            </table>
        </div>
    </div>
</section>