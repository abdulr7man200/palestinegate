        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <li><a href="{{route("welcome")}}">Home</a></li>
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        {{-- <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="index.html">Dashboard 1</a>
                                </li>
                                <li>
                                    <a href="index2.html">Dashboard 2</a>
                                </li>
                                <li>
                                    <a href="index3.html">Dashboard 3</a>
                                </li>
                                <li>
                                    <a href="index4.html">Dashboard 4</a>
                                </li>
                            </ul>
                        </li> --}}
                        @role('admin')
                        <li class="{{ Route::is('dashboard') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li class="{{ Route::is('users.index') ? 'active' : '' }}">
                            <a href="{{ route('users.index') }}">
                                <i class="fas fa-users"></i>Users</a>
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
                        

                    </ul>
                </nav>
            </div>
        </aside>
