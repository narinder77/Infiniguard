
<!--**********************************
    Header start
***********************************-->
<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="dashboard_bar">
                        {{$page_title ? $page_title : '' }}
                    </div>
                </div>
                <ul class="navbar-nav header-right">

                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="javascript:void(0)" role="button" data-bs-toggle="dropdown">
                            <img src="{{ asset('assets/images/profile/17.jpg')}}" width="20" alt=""/>
                            <div class="header-info">
                                <span class="text-black">Peter Parkur</span>
                                <p class="fs-12 mb-0">Super Admin</p>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('admin.profile.edit')}}" class="dropdown-item ai-icon">
                                <div class="iconbox">
                                    <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                </div>
                                <span class="ms-2">Profile </span>
                            </a>
                            <a href="{{ route('admin.password.create')}}" class="dropdown-item ai-icon">
                                 <div class="iconbox">
                                <svg width="11" height="14" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.5 10.6667C5.86467 10.6667 6.21441 10.5262 6.47227 10.2761C6.73013 10.0261 6.875 9.68696 6.875 9.33333C6.875 8.97971 6.73013 8.64057 6.47227 8.39052C6.21441 8.14048 5.86467 8 5.5 8C5.13533 8 4.78559 8.14048 4.52773 8.39052C4.26987 8.64057 4.125 8.97971 4.125 9.33333C4.125 9.68696 4.26987 10.0261 4.52773 10.2761C4.78559 10.5262 5.13533 10.6667 5.5 10.6667ZM9.625 4.66667C9.98967 4.66667 10.3394 4.80714 10.5973 5.05719C10.8551 5.30724 11 5.64638 11 6V12.6667C11 13.0203 10.8551 13.3594 10.5973 13.6095C10.3394 13.8595 9.98967 14 9.625 14H1.375C1.01033 14 0.660591 13.8595 0.402728 13.6095C0.144866 13.3594 0 13.0203 0 12.6667V6C0 5.64638 0.144866 5.30724 0.402728 5.05719C0.660591 4.80714 1.01033 4.66667 1.375 4.66667H2.0625V3.33333C2.0625 2.44928 2.42466 1.60143 3.06932 0.976311C3.71398 0.351189 4.58832 0 5.5 0C5.95142 0 6.39842 0.0862192 6.81547 0.253735C7.23253 0.421251 7.61148 0.666782 7.93068 0.976311C8.24988 1.28584 8.50309 1.6533 8.67584 2.05772C8.84859 2.46214 8.9375 2.89559 8.9375 3.33333V4.66667H9.625ZM5.5 1.33333C4.95299 1.33333 4.42839 1.54405 4.04159 1.91912C3.6548 2.29419 3.4375 2.8029 3.4375 3.33333V4.66667H7.5625V3.33333C7.5625 2.8029 7.3452 2.29419 6.95841 1.91912C6.57161 1.54405 6.04701 1.33333 5.5 1.33333Z" fill="#096C88"/>
                                </svg>
                                </div>
                                <span class="ms-2">Change Password</span>
                            </a>
                            <a href="{{ route('admin.logout')}}" class="dropdown-item ai-icon">
                                 <div class="iconbox">
                                <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                </div>
                                <span class="ms-2">Logout </span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
