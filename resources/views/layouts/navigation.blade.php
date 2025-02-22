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
                        <li class="{{ Request::routeIs('welcome') ? 'active' : '' }}">
                            <a href="{{ route('welcome') }}">Home</a>
                        </li>
                        <li class="{{ Request::routeIs('Services') ? 'active' : '' }}">
                            <a href="{{ route('Services') }}">Services</a>
                        </li>
                        <li class="{{ Request::routeIs('showstays') ? 'active' : '' }}">
                            <a href="{{ route('showstays') }}">Stays</a>
                        </li>
                        <li class="{{ Request::routeIs('showcars') ? 'active' : '' }}">
                            <a href="{{ route('showcars') }}">Cars</a>
                        </li>
                        <li class="{{ Request::routeIs('aboutus') ? 'active' : '' }}">
                            <a href="{{ route('aboutus') }}">About Us</a>
                        </li>
                        <li class="{{ Request::routeIs('contactus') ? 'active' : '' }}">
                            <a href="{{ route('contactus') }}">Contact Us</a>
                        </li>
                        @if (Auth::check())
                        <li class="{{ Request::routeIs('reservations') ? 'active' : '' }}">
                            <a href="{{ route('reservations') }}">Reservations</a>
                        </li>
                        <li class="{{ Request::routeIs('profile.edit') ? 'active' : '' }}">
                            <a href="{{ route('profile.edit') }}">Profile</a>
                        </li>
                            <li>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                            @role('admin|manager')
                                <li class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                            @endrole
                        @else
                            <li class="{{ Request::routeIs('login') ? 'active' : '' }}">
                                <a href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="{{ Request::routeIs('register') ? 'active' : '' }}">
                                <a href="{{ route('register') }}">Register</a>
                            </li>
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
