<section class="body-font">
    <div class="container px-5 py-24 mx-auto flex flex-col justify-center items-center">
        <div class="flex flex-col text-center w-full mb-4">
            <h1 class="sm:text-3xl text-2xl font-medium title-font">Adoption forms lists</h1>
            <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
                Review all submitted adoption requests from users and fosters in one place.
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
              </ul>
          </div>
          <input type="text" placeholder="Search here..." class="input input-bordered w-full max-w-md" />
        </div>
        <!-- Table Section -->
        <div class="overflow-x-auto">
          <table class="table w-full">
              <!-- Table Head -->
              <thead>
              <tr>
                  <th>Id</th>
                  <th>Sender</th>
                  <th>receiver</th>
                  <th>Status</th>
                  <th>Actions</th>
              </tr>
              </thead>
      
              <!-- Table Body -->
              <tbody v-for="(application, index) in userAdoptionForms" :key="index">
              <tr>
                  <td>adoption code</td>
                  <th>account sender</th>
                  <td>account receiver</td>
                  <td>Status</td>
                  <td>
                      <button class="btn btn-xs btn-success" @click="openReviewModal(application)">Review</button>
                  </td>
              </tr>
              </tbody>
          </table> 
          <!-- Review Modal -->
          <dialog v-if="showFormModal" class="modal">
              <div class="modal-box w-full max-w-6xl">
                  <h3 class="text-lg font-bold mb-4">Review Application</h3>
                  <form>
                  <div class="form-control">
                      <label class="label">Adoption Code:</label>
                      <input type="text" disabled />
                  </div>
                  <div class="form-control">
                      <label class="label">Adopter Account:</label>
                      <input type="text" disabled />
                  </div>
                  <button class="btn btn-primary">Save Review</button>
                  <button class="btn btn-error" @click="closeReviewModal()">Cancel</button>
                  </form>
              </div>
          </dialog>
        </div>
        <!-- pagination -->
        <div class="join my-2">
          <button class="join-item btn btn-sm">1</button>
          <button class="join-item btn btn-sm">2</button>
          <button class="join-item btn btn-sm">3</button>
          <button class="join-item btn btn-sm">4</button>
        </div> 
    </div>
</section>