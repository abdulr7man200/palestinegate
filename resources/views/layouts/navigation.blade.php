<header class="site-header js-site-header">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-6 col-lg-4 site-logo" data-aos="fade"><a href="{{route("welcome")}}">Palestine Gate</a></div>
        <div class="col-6 col-lg-8">


          <div class="site-menu-toggle js-site-menu-toggle"  data-aos="fade">
            <span></span>
            <span></span>
            <span></span>
          </div>

          <div class="site-navbar js-site-navbar">
            <nav role="navigation">
              <div class="container">
                <div class="row full-height align-items-center">
                  <div class="col-md-6 mx-auto">
                    <ul class="list-unstyled menu">
                      <li class="active"><a href="{{route("welcome")}}">Home</a></li>
                      <li><a href="{{ route("Services")}}">Services</a></li>
                      <li><a href="{{ route("stays")}}">Stays</a></li>
                      <li><a href="{{ route("cars")}}">Cars</a></li>
                      <li><a href="{{route("aboutus")}}">About Us</a></li>
                      <li><a href="{{ route ("contactus")}}">Contact Us</a></li>
                     @if (Auth::check())
                     <li> 
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @role("admin")
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    @endrole

                     @else
                     <li><a href="{{ route('login') }}">Login</a></li>
                      <li><a href="{{ route('register') }}">Register</a></li>
                     @endif
                    </ul>
                  </div>
                </div>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>
