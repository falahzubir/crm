<!-- Sidebar -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="" class="app-brand-link">
            <span class="app-brand-logo demo">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" viewBox="0 0 25 25">
                    <mask id="a" width="25" height="25" x="0" y="0" maskUnits="userSpaceOnUse"
                        style="mask-type:luminance">
                        <path fill="#fff" d="M25 0H0v25h25V0Z" />
                    </mask>
                    <g mask="url(#a)">
                        <path fill="#18CDCA"
                            d="M2.447 10.963a2.234 2.234 0 0 1 .578-2.158l5.78-5.78a2.234 2.234 0 0 1 2.158-.578l5.408 1.45a4.07 4.07 0 0 1 .746-2.058L10.603.094A2.758 2.758 0 0 0 7.94.808L.808 7.94a2.758 2.758 0 0 0-.714 2.663l1.812 6.763a4.068 4.068 0 0 1 2.04-.812l-1.5-5.591Zm18.557-2.704 1.548 5.778a2.236 2.236 0 0 1-.578 2.158l-5.78 5.78a2.235 2.235 0 0 1-2.158.578l-5.591-1.498a4.067 4.067 0 0 1-.812 2.039l6.763 1.812a2.754 2.754 0 0 0 2.664-.714l7.132-7.132a2.757 2.757 0 0 0 .713-2.663l-1.88-7.017a4.08 4.08 0 0 1-2.021.879Z" />
                        <path fill="#4F80E1"
                            d="M2.069 18.3A3.275 3.275 0 1 0 6.7 22.93a3.275 3.275 0 0 0-4.631-4.63ZM18.13 1.9a3.274 3.274 0 1 0 4.629 4.63 3.274 3.274 0 0 0-4.63-4.63Zm-3.708 19.281c-.131 0-.262-.017-.39-.05l-5.118-1.372a4.599 4.599 0 0 0-3.673-3.674l-1.372-5.118a1.51 1.51 0 0 1 .39-1.454L9.512 4.26a1.505 1.505 0 0 1 1.454-.39l4.975 1.333a4.6 4.6 0 0 0 3.778 3.565l1.41 5.265a1.508 1.508 0 0 1-.39 1.455l-5.253 5.253a1.493 1.493 0 0 1-1.064.44Z" />
                    </g>
                </svg>
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">CRM</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <ul class="menu-inner py-1">
        <li class="menu-item active">
            <a href="{{ route('customer.list') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-group"></i>
                <div class="sidebar-text">Customer List</div>
            </a>
        </li>

        {{-- <li class="menu-item">
            <a href="" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-cog"></i>
                <div class="sidebar-text">Setting</div>
            </a>
        </li> --}}

        <li class="menu-item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <a href="#" id="logout-link" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-log-in"></i>
                    <div class="sidebar-text">Logout</div>
                </a>
            </form>
        </li>
    </ul>
</aside>
<!-- / Sidebar -->
