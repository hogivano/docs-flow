<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-left ms-3"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute right-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('dashboard') }}">
            <img src="/logo.jpeg" class="navbar-brand-img h-100" alt="...">
            <span class="ms-1 font-weight-bold">PUPR</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item mt-2">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Transaksi</h6>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link {{ in_array(Route::currentRouteName(), ['permohonan.index', 'permohonan.create', 'permohonan.edit', 'permohonan.detail']) ? 'active' : '' }}"
                    href="{{ route('permohonan.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-book"></i>
                    </div>
                    <span class="nav-link-text ms-1">Permohonan</span>
                </a>
            </li>
            @if(request()->get('role') && request()->get('role')->id == 1)
                <li class="nav-item mt-2">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Master</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ in_array(Route::currentRouteName(), ['application.index', 'application.create', 'application.edit', 'application.detail']) ? 'active' : '' }}"
                        href="{{ route('application.index') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-file-contract"></i>
                        </div>
                        <span class="nav-link-text ms-1">Application</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ in_array(Route::currentRouteName(),
                        ['process.index', 'process.create', 'process.edit', 'process.detail', 'process-action.create', 'process-action.edit', 'process.create.application',
                        'process-action.edit-byProcessId']) ? 'active' : '' }}"
                        href="{{ route('process.index') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-stream"></i>
                        </div>
                        <span class="nav-link-text ms-1">Process</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ in_array(Route::currentRouteName(),
                        ['process-role.index', 'process-role.setting-byappid', 'process-role.setting-byprocessId']) ? 'active' : '' }}"
                        href="{{ route('process-role.index') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-key"></i>
                        </div>
                        <span class="nav-link-text ms-1">Process Role</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ in_array(Route::currentRouteName(), ['base-action.index', 'base-action.create', 'base-action.edit']) ? 'active' : '' }}"
                        href="{{ route('base-action.index') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-i-cursor"></i>
                        </div>
                        <span class="nav-link-text ms-1">Base Action</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ in_array(Route::currentRouteName(), ['roles.index', 'roles.create', 'roles.edit']) ? 'active' : '' }}"
                        href="{{ route('roles.index') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-key-25"></i>
                        </div>
                        <span class="nav-link-text ms-1">Roles</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ in_array(Route::currentRouteName(), ['user.index', 'user.create', 'user.edit']) ? 'active' : '' }}"
                        href="{{ route('user.index') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-circle-08"></i>
                        </div>
                        <span class="nav-link-text ms-1">User</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</aside>
