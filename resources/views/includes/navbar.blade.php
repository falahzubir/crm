<!-- Navbar -->
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0">
        <a id="sidebar-toggle" class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <li class="nav-item">
                <div class="p-2">
                    <div class="mb-0">
                        <label class="float-end"><strong>{{ Auth::user()->name }}</strong></label>
                    </div>

                    <div class="mb-0">
                        <label class="float-end">
                            @if (Auth::user()->role)
                                {{ Auth::user()->role->name }}
                            @endif
                        </label>
                    </div>
                </div>
            </li>

            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <div class="avatar avatar-online">
                    <img src="{{ asset('assets/img/avatars/user.jpeg') }}" class="w-px-45 h-100 rounded-circle" />
                </div>
            </li>
        </ul>
    </div>
</nav>

<!-- / Navbar -->
