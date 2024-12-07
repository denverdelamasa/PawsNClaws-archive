<!-- From Uiverse.io by Nawsome -->
<div class="feed-loader bg-base-100 rounded-xl border border-base-300">
  <div class="wrapper">
    <div class="circle bg-base-200"></div>
    <div class="line-1 bg-base-200"></div>
    <div class="line-2 bg-base-200"></div>
    <div class="line-3 bg-base-200"></div>
    <div class="line-4 bg-base-200"></div>
  </div>
</div>
<style>
    .feed-loader{
    position: relative;
    width: 450px;
    height: 240px;
    margin-bottom: 10px;
    padding: 15px;
    overflow: hidden;
    }

    .feed-loader:after {
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: linear-gradient(110deg, rgba(227, 227, 227, 0) 0%, rgba(227, 227, 227, 0) 40%, rgba(207, 207, 207, 0.5) 50%, rgba(227, 227, 227, 0) 60%, rgba(227, 227, 227, 0) 100%);
    animation: gradient-animation_2 1.2s linear infinite;
    }

    .feed-loader .wrapper {
    width: 100%;
    height: 100%;
    position: relative;
    }

    .feed-loader .circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    }

    .feed-loader .button {
    display: inline-block;
    height: 32px;
    width: 75px;
    }

    .feed-loader .line-1 {
    position: absolute;
    top: 11px;
    left: 58px;
    height: 10px;
    width: 100px;
    }

    .feed-loader .line-2 {
    position: absolute;
    top: 34px;
    left: 58px;
    height: 10px;
    width: 150px;
    }

    .feed-loader .line-3 {
    position: absolute;
    top: 57px;
    left: 0px;
    height: 10px;
    width: 100%;
    }

    .feed-loader .line-4 {
    position: absolute;
    top: 80px;
    left: 0px;
    height: 10px;
    width: 92%;
    }

    @keyframes gradient-animation_2 {
    0% {
        transform: translateX(-100%);
    }

    100% {
        transform: translateX(100%);
    }
    }
</style>