<div class="h-full w-full bg-base-100 overflow-auto gap-4 p-6">
  <!-- Services -->
  <div class="flex flex-col m-2 p-2 border-b-2 border-base-300">
    <div class="flex gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-12 h-12" viewBox="0 0 16 16">
            <path d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.707L8 2.207 1.354 8.853a.5.5 0 1 1-.708-.707z"/>
            <path d="m14 9.293-6-6-6 6V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5zm-6-.811c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.691 0-5.018"/>
        </svg>
        <h2 class="text-5xl font-bold">Services</h2>
    </div>
    <p class="text-lg mb-2">Explore a variety of pet services tailored to your needs, including grooming, veterinary care, boarding, and training.</p>

    <div class="w-full mb-2">
        @for ($i = 1; $i <= 6; $i++)
            <div class="relative w-full flex justify-center flex-wrap">
                <div class="card bg-base-200 w-96 shadow-sm border-2 border-base-300">
                    <figure>
                        <img src="https://th.bing.com/th/id/OIP.PXS4cGMqIeBeuiCVKKEjvAHaE8?rs=1&pid=ImgDetMain" alt="Service Image"/>
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">Service #{{ $i }}</h2>
                        <p>High-quality pet services to keep your furry friend happy and healthy.</p>
                        <div class="card-actions justify-end">
                            <button class="btn btn-primary">Visit Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
  </div>
</div>
<style scoped>
    .loadMore {
    width: 165px;
    height: 62px;
    cursor: pointer;
    color: #fff;
    font-size: 17px;
    border-radius: 1rem;
    border: none;
    position: relative;
    transition: 0.1s;
    }

    .loadMore::after {
    content: '';
    width: 100%;
    height: 100%;
    background-image: radial-gradient( circle farthest-corner at 10% 20%,  rgba(255,94,247,1) 17.8%, rgba(2,245,255,1) 100.2% );
    filter: blur(15px);
    z-index: -1;
    position: absolute;
    left: 0;
    top: 0;
    }

    .loadMore:active {
    transform: scale(0.9) rotate(3deg);
    background: radial-gradient( circle farthest-corner at 10% 20%,  rgba(255,94,247,1) 17.8%, rgba(2,245,255,1) 100.2% );
    transition: 0.5s;
    }
</style>