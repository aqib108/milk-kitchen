<section class="logo-banner2">
  <div class="container">
    <div class="flex-wraper">
      <div class="">
        <img src="{{asset('customer-panel/images/logo.png')}}" class="img-fluid" alt="">
      </div>
      <div>
        <h2 class="heading-one-banner">FOOD SERVICE PORTAL</h2>
      </div>
      <div>
        <button id="logout_btn" class="btn btn-logout" href="{{ route('logout') }}"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
         {{ __('Logout') }}
        </button>
        <button  class="btn btn-logout" >
          <a href="{{route('admin.setting')}}" style="color: black;">Update Password</a>
        
        </button>
        
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      </div>
    </div>
  </div>
</section>