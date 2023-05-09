<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li>
                    <select class="searchable-field form-control">

                    </select>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs("admin.home") ? "active" : "" }}" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('partner_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.partners.index") }}" class="nav-link {{ request()->is("admin/partners") || request()->is("admin/partners/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon far fa-handshake">

                            </i>
                            <p>
                                {{ trans('cruds.partner.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('institute_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.institutes.index") }}" class="nav-link {{ request()->is("admin/institutes") || request()->is("admin/institutes/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.institute.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('academic_session_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.academic-sessions.index") }}" class="nav-link {{ request()->is("admin/academic-sessions") || request()->is("admin/academic-sessions/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fab fa-sellsy">

                            </i>
                            <p>
                                {{ trans('cruds.academicSession.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('course_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.courses.index") }}" class="nav-link {{ request()->is("admin/courses") || request()->is("admin/courses/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-book-open">

                            </i>
                            <p>
                                {{ trans('cruds.course.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('section_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.sections.index") }}" class="nav-link {{ request()->is("admin/sections") || request()->is("admin/sections/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-puzzle-piece">

                            </i>
                            <p>
                                {{ trans('cruds.section.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('subject_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.subjects.index") }}" class="nav-link {{ request()->is("admin/subjects") || request()->is("admin/subjects/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-flask">

                            </i>
                            <p>
                                {{ trans('cruds.subject.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('chapter_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.chapters.index") }}" class="nav-link {{ request()->is("admin/chapters") || request()->is("admin/chapters/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-book">

                            </i>
                            <p>
                                {{ trans('cruds.chapter.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('student_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.students.index") }}" class="nav-link {{ request()->is("admin/students") || request()->is("admin/students/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-user-graduate">

                            </i>
                            <p>
                                {{ trans('cruds.student.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('fees_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/fee-heads*") ? "menu-open" : "" }} {{ request()->is("admin/fee-structures*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/fee-heads*") ? "active" : "" }} {{ request()->is("admin/fee-structures*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-money-bill-alt">

                            </i>
                            <p>
                                {{ trans('cruds.feesManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('fee_head_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.fee-heads.index") }}" class="nav-link {{ request()->is("admin/fee-heads") || request()->is("admin/fee-heads/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.feeHead.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('fee_structure_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.fee-structures.index") }}" class="nav-link {{ request()->is("admin/fee-structures") || request()->is("admin/fee-structures/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-invoice-dollar">

                                        </i>
                                        <p>
                                            {{ trans('cruds.feeStructure.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('tests_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/omr-based-tests*") ? "menu-open" : "" }} {{ request()->is("admin/file-mode-online-tests*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/omr-based-tests*") ? "active" : "" }} {{ request()->is("admin/file-mode-online-tests*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-filter">

                            </i>
                            <p>
                                {{ trans('cruds.testsManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('omr_based_test_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.omr-based-tests.index") }}" class="nav-link {{ request()->is("admin/omr-based-tests") || request()->is("admin/omr-based-tests/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.omrBasedTest.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('file_mode_online_test_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.file-mode-online-tests.index") }}" class="nav-link {{ request()->is("admin/file-mode-online-tests") || request()->is("admin/file-mode-online-tests/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-vial">

                                        </i>
                                        <p>
                                            {{ trans('cruds.fileModeOnlineTest.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('transportation_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/transport-vehicles*") ? "menu-open" : "" }} {{ request()->is("admin/transport-routes*") ? "menu-open" : "" }} {{ request()->is("admin/route-stops*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/transport-vehicles*") ? "active" : "" }} {{ request()->is("admin/transport-routes*") ? "active" : "" }} {{ request()->is("admin/route-stops*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-bus-alt">

                            </i>
                            <p>
                                {{ trans('cruds.transportationManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('transport_vehicle_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.transport-vehicles.index") }}" class="nav-link {{ request()->is("admin/transport-vehicles") || request()->is("admin/transport-vehicles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-bus-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.transportVehicle.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('transport_route_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.transport-routes.index") }}" class="nav-link {{ request()->is("admin/transport-routes") || request()->is("admin/transport-routes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-road">

                                        </i>
                                        <p>
                                            {{ trans('cruds.transportRoute.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('route_stop_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.route-stops.index") }}" class="nav-link {{ request()->is("admin/route-stops") || request()->is("admin/route-stops/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-ban">

                                        </i>
                                        <p>
                                            {{ trans('cruds.routeStop.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('employee_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/employees*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/employees*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.employeeManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('employee_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.employees.index") }}" class="nav-link {{ request()->is("admin/employees") || request()->is("admin/employees/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user-friends">

                                        </i>
                                        <p>
                                            {{ trans('cruds.employee.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/audit-logs*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/permissions*") ? "active" : "" }} {{ request()->is("admin/roles*") ? "active" : "" }} {{ request()->is("admin/users*") ? "active" : "" }} {{ request()->is("admin/audit-logs*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.audit-logs.index") }}" class="nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.auditLog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('miscellaneou_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/institute-types*") ? "menu-open" : "" }} {{ request()->is("admin/institute-levels*") ? "menu-open" : "" }} {{ request()->is("admin/affiliationers*") ? "menu-open" : "" }} {{ request()->is("admin/designations*") ? "menu-open" : "" }} {{ request()->is("admin/employee-types*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/institute-types*") ? "active" : "" }} {{ request()->is("admin/institute-levels*") ? "active" : "" }} {{ request()->is("admin/affiliationers*") ? "active" : "" }} {{ request()->is("admin/designations*") ? "active" : "" }} {{ request()->is("admin/employee-types*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-cog">

                            </i>
                            <p>
                                {{ trans('cruds.miscellaneou.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('institute_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.institute-types.index") }}" class="nav-link {{ request()->is("admin/institute-types") || request()->is("admin/institute-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-check-square">

                                        </i>
                                        <p>
                                            {{ trans('cruds.instituteType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('institute_level_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.institute-levels.index") }}" class="nav-link {{ request()->is("admin/institute-levels") || request()->is("admin/institute-levels/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-level-up-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.instituteLevel.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('affiliationer_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.affiliationers.index") }}" class="nav-link {{ request()->is("admin/affiliationers") || request()->is("admin/affiliationers/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-stamp">

                                        </i>
                                        <p>
                                            {{ trans('cruds.affiliationer.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('designation_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.designations.index") }}" class="nav-link {{ request()->is("admin/designations") || request()->is("admin/designations/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-chart-line">

                                        </i>
                                        <p>
                                            {{ trans('cruds.designation.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('employee_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.employee-types.index") }}" class="nav-link {{ request()->is("admin/employee-types") || request()->is("admin/employee-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-check-square">

                                        </i>
                                        <p>
                                            {{ trans('cruds.employeeType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('address_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.addresses.index") }}" class="nav-link {{ request()->is("admin/addresses") || request()->is("admin/addresses/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-street-view">

                            </i>
                            <p>
                                {{ trans('cruds.address.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('phone_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.phones.index") }}" class="nav-link {{ request()->is("admin/phones") || request()->is("admin/phones/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-phone">

                            </i>
                            <p>
                                {{ trans('cruds.phone.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('country_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.countries.index") }}" class="nav-link {{ request()->is("admin/countries") || request()->is("admin/countries/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-globe-americas">

                            </i>
                            <p>
                                {{ trans('cruds.country.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('province_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.provinces.index") }}" class="nav-link {{ request()->is("admin/provinces") || request()->is("admin/provinces/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-compass">

                            </i>
                            <p>
                                {{ trans('cruds.province.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('postal_code_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.postal-codes.index") }}" class="nav-link {{ request()->is("admin/postal-codes") || request()->is("admin/postal-codes/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-envelope">

                            </i>
                            <p>
                                {{ trans('cruds.postalCode.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('blood_group_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.blood-groups.index") }}" class="nav-link {{ request()->is("admin/blood-groups") || request()->is("admin/blood-groups/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-tint">

                            </i>
                            <p>
                                {{ trans('cruds.bloodGroup.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('religion_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.religions.index") }}" class="nav-link {{ request()->is("admin/religions") || request()->is("admin/religions/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-church">

                            </i>
                            <p>
                                {{ trans('cruds.religion.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('caste_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.castes.index") }}" class="nav-link {{ request()->is("admin/castes") || request()->is("admin/castes/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.caste.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    {{ trans('global.change_password') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                            <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>