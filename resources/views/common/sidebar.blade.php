
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">

                <div class="sidebar-brand-text mx-3">Admin Panel</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            @role('admin')
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item {{ Request::is('add-roles*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('viewroles') }}">
                        <i class="fas fa-user fa-sm fa-fw mr-2"></i>
                        <span>Roles</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('add-permissions*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('viewpermissions') }}">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Permissions</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('add-user*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('viewuser') }}">
                        <i class="fas fa-user fa-sm fa-fw mr-2"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('add-subjects*') ? 'active' : '' }}">
                    <a class="nav-link" href="#">
                        <i class="fas fa-book fa-sm fa-fw mr-2"></i>
                        <span>Subjects</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('add-exams*') ? 'active' : '' }}">
                    <a class="nav-link" href="#">
                        <i class="far fa-calendar-alt fa-sm fa-fw mr-2"></i>
                        <span>Schedule Exam</span>
                    </a>
                </li>
            @endrole

            @role('faculty')
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item {{ Request::is('create-exampapers*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('viewexampaper') }}">
                        <i class="fas fa-book fa-sm fa-fw mr-2"></i>
                        <span>Create Exampaper</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('check-exampapers*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('checkexampaper') }}">
                        <i class="fas fa-book fa-sm fa-fw mr-2"></i>
                        <span>Check Exampaper</span>
                    </a>
                </li>
            @endrole

            @role('student')
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item {{ Request::is('start-exam*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('viewexmpage') }}">
                        <i class="fas fa-book fa-sm fa-fw mr-2"></i>
                        <span>Start Exam</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('exam-result*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('exmres') }}">
                        <i class="fas fa-book fa-sm fa-fw mr-2"></i>
                        <span>Exam Result</span>
                    </a>
                </li>
            @endrole

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
