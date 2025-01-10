        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <li><a href="{{route("welcome")}}">Home</a></li>
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">

                        @role('admin')
                        <li class="{{ Route::is('dashboard') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>

                        <li class="{{ Route::is('booking.index') ? 'active' : '' }}">
                            <a href="{{ route('booking.index') }}">
                                <i class="fas fa-calendar-alt"></i>Booking</a>
                        </li>

                        <li class="{{ Route::is('users.index') ? 'active' : '' }}">
                            <a href="{{ route('users.index') }}">
                                <i class="fas fa-users"></i>Users</a>
                        </li>


                        <li class="{{ Route::is('feedback.index') ? 'active' : '' }}">
                            <a href="{{ route('feedback.index') }}">
                                <i class="fas fa-comments"></i>FeedBack</a>
                        </li>

                        <li class="{{ Route::is('contact.index') ? 'active' : '' }}">
                            <a href="{{ route('contact.index') }}">
                                <i class="fas fa-envelope"></i>Contact</a>
                        </li>

                        @endrole


                        <li class="{{ Route::is('cars.index') ? 'active' : '' }}">
                            <a href="{{ route('cars.index') }}">
                                <i class="fas fa-car"></i>Cars</a>
                        </li>

                        <li class="{{ Route::is('stays.index') ? 'active' : '' }}">
                            <a href="{{ route('stays.index') }}">
                                <i class="fas fa-hotel"></i>Stays</a>
                        </li>


                        <li class="{{ Route::is('rooms.index') ? 'active' : '' }}">
                            <a href="{{ route('rooms.index') }}">
                                <i class="fas fa-building"></i>Rooms</a>
                        </li>


                    </ul>
                </nav>
            </div>
        </aside>
