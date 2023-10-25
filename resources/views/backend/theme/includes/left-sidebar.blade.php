<!-- Sidebar Menu -->

<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        @auth
        <li class="nav-item">
            <a href="{{ route('admin.dashboard.index') }}"
                class="nav-link @if (request()->route()->named('admin.dashboard.*')) active @endif">
                <i class="nav-icon fas fa-tachometer-alt" aria-hidden="true"></i>
                <p>
                    Dashboard

                </p>
            </a>
        </li>
        @endauth

        @can('admin.users.index')
        <li class="nav-item">
            <a href="{{ route('admin.users.index') }}"
                class="nav-link @if (request()->route()->named('admin.users.*')) active @endif">
                <i class="nav-icon fas fa-users" aria-hidden="true"></i>
                <p>
                    Manage Users

                </p>
            </a>
        </li>
        @endcan

        {{-- @can('admin.roles.index')
        <li class="nav-item">
            <a href="{{ route('admin.roles.index') }}"
                class="nav-link @if (request()->route()->named('admin.roles.*')) active @endif">
                <i class="nav-icon fas fa-user-cog " aria-hidden="true"></i>
                <p>
                    Manage Roles

                </p>
            </a>
        </li>
        @endcan --}}

        @canany('admin.public-registry.type.index', 'admin.public-registry.public-registry.index')
        <li class="nav-item @if (request()->route()->named('admin.public-registry.*')) menu-open @endif">
            <a href="#" class="nav-link @if (request()->route()->named('admin.public-registry.*')) active @endif">
                <i class="nav-icon fas fa-registered" aria-hidden="true"></i>
                <p>
                    Public Registry
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>

            @can('admin.public-registry.type.index')
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.public-registry.type.index') }}"
                        class="nav-link @if (request()->route()->named('admin.public-registry.type.*')) active @endif">
                        <i class="far fa-list-alt nav-icon"></i>
                        <p>Types</p>
                    </a>
                </li>
            </ul>
            @endcan

            @can('admin.public-registry.public-registry.index')
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.public-registry.public-registry.index') }}"
                        class="nav-link @if (request()->route()->named('admin.public-registry.public-registry.*')) active @endif">
                        <i class="far fa-building nav-icon"></i>
                        <p>Registries</p>
                    </a>
                </li>
            </ul>
            @endcan
        </li>
        @endcanany

        @can('admin.activity.index')
        <li class="nav-item">
            <a href="{{ route('admin.activity.index') }}"
                class="nav-link @if (request()->route()->named('admin.activity.*')) active @endif">
                <i class="nav-icon fas fa-futbol" aria-hidden="true"></i>
                <p>
                    Manage Activities

                </p>
            </a>
        </li>
        @endcan

        @can('admin.regulation.index')
        <li class="nav-item">
            <a href="{{ route('admin.regulation.index') }}"
                class="nav-link @if (request()->route()->named('admin.regulation.*')) active @endif">
                <i class="nav-icon fas fa-gavel" aria-hidden="true"></i>
                <p>
                    Manage Regulations

                </p>
            </a>
        </li>
        @endcan

        @canany('admin.about.member.index', 'admin.about.faq.faq.index', 'admin.about.faq.type.index')
        <li class="nav-item @if (request()->route()->named('admin.about.*')) menu-open @endif">
            <a href="#" class="nav-link @if (request()->route()->named('admin.about.*')) active @endif">
                <i class="nav-icon fas fa-info-circle" aria-hidden="true"></i>
                <p>
                    Manage About
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>

            @can('admin.about.faq.type.index')
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.about.faq.type.index') }}"
                        class="nav-link @if (request()->route()->named('admin.about.faq.type.*')) active @endif">
                        <i class="far fa-list-alt nav-icon"></i>
                        <p>FAQ Types</p>
                    </a>
                </li>
            </ul>
            @endcan

            @can('admin.about.faq.faq.index')
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.about.faq.faq.index') }}"
                        class="nav-link @if (request()->route()->named('admin.about.faq.faq.*')) active @endif">
                        <i class="far fa-question-circle nav-icon"></i>
                        <p>FAQs</p>
                    </a>
                </li>
            </ul>
            @endcan

            @can('admin.about.member.index')
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.about.member.index') }}"
                        class="nav-link @if (request()->route()->named('admin.about.member.*')) active @endif">
                        <i class="far fa-id-badge nav-icon"></i>
                        <p>Members</p>
                    </a>
                </li>
            </ul>
            @endcan

        </li>
        @endcanany

        @canany('admin.master-plan.plan.index', 'admin.master-plan.plot.index')
        <li class="nav-item @if (request()->route()->named('admin.master-plan.*')) menu-open @endif">
            <a href="#" class="nav-link @if (request()->route()->named('admin.master-plan.*')) active @endif">
                <i class="nav-icon fas fa-border-all" aria-hidden="true"></i>
                <p>
                    Manage Master Plan
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>

            @can('admin.master-plan.plan.index')
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.master-plan.plan.index') }}"
                        class="nav-link @if (request()->route()->named('admin.master-plan.plan.*')) active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Plans</p>
                    </a>
                </li>
            </ul>
            @endcan

            @can('admin.master-plan.plot.index')
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.master-plan.plot.index') }}"
                        class="nav-link @if (request()->route()->named('admin.master-plan.plot.*')) active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Plots</p>
                    </a>
                </li>
            </ul>
            @endcan

        </li>
        @endcanany

        @canany('admin.media-room.category.index', 'admin.media-room.publication.index')
        <li class="nav-item @if (request()->route()->named('admin.media-room.*')) menu-open @endif">
            <a href="#" class="nav-link @if (request()->route()->named('admin.media-room.*')) active @endif">
                <i class="nav-icon fas fa-camera" aria-hidden="true"></i>
                <p>
                    Manage Media Room
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>

            @can('admin.media-room.publication.index')
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.media-room.publication.index') }}"
                        class="nav-link @if (request()->route()->named('admin.media-room.publication.*')) active @endif">
                        <i class="far fa-newspaper nav-icon"></i>
                        <p>Publications</p>
                    </a>
                </li>
            </ul>
            @endcan

            @can('admin.media-room.gallery.index')
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.media-room.gallery.index') }}"
                        class="nav-link @if (request()->route()->named('admin.media-room.gallery.*')) active @endif">
                        <i class="far fa-image nav-icon"></i>
                        <p>Gallery</p>
                    </a>
                </li>
            </ul>
            @endcan
        </li>
        @endcanany

        @can('admin.event.index')
        <li class="nav-item">
            <a href="{{ route('admin.event.index') }}"
                class="nav-link @if (request()->route()->named('admin.event.*')) active @endif">
                <i class="nav-icon fas fa-calendar" aria-hidden="true"></i>
                <p>
                    Manage Events

                </p>
            </a>
        </li>
        @endcan

        @can('admin.inquiry.index')
        <li class="nav-item">
            <a href="{{ route('admin.inquiry.index') }}"
                class="nav-link @if (request()->route()->named('admin.inquiry.*')) active @endif">
                <i class="nav-icon fas fa-paper-plane" aria-hidden="true"></i>
                <p>
                    Manage Inquiries

                </p>
            </a>
        </li>
        @endcan

        @can('admin.change-password.edit')
        <li class="nav-item">
            <a href="{{ route('admin.change-password.edit') }}"
                class="nav-link @if (request()->route()->named('admin.change-password.edit')) active @endif">
                <i class="nav-icon fas fa-lock" aria-hidden="true"></i>
                <p>
                    Change Password

                </p>
            </a>
        </li>
        @endcan

        @auth
        <li class="nav-item ">
            <a href="javascript:void" class="nav-link" onclick="$('#logout-form').submit();">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                    Logout

                </p>
            </a>
        </li>
        @endauth
    </ul>
</nav>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"
    onsubmit="event.preventDefault();submitForm(this);">
    @csrf
</form>
<!-- /.sidebar-menu -->
