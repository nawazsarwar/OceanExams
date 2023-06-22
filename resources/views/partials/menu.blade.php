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
                @can('students_attendance_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/mark-attendances*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/mark-attendances*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-check-double">

                            </i>
                            <p>
                                {{ trans('cruds.studentsAttendance.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('mark_attendance_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.mark-attendances.index") }}" class="nav-link {{ request()->is("admin/mark-attendances") || request()->is("admin/mark-attendances/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.markAttendance.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('fees_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/fee-heads*") ? "menu-open" : "" }} {{ request()->is("admin/fee-structures*") ? "menu-open" : "" }} {{ request()->is("admin/ledgers*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/fee-heads*") ? "active" : "" }} {{ request()->is("admin/fee-structures*") ? "active" : "" }} {{ request()->is("admin/ledgers*") ? "active" : "" }}" href="#">
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
                            @can('ledger_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.ledgers.index") }}" class="nav-link {{ request()->is("admin/ledgers") || request()->is("admin/ledgers/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-hand-holding-usd">

                                        </i>
                                        <p>
                                            {{ trans('cruds.ledger.title') }}
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
                @can('questions_bank_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/questions*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/questions*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-money-check">

                            </i>
                            <p>
                                {{ trans('cruds.questionsBank.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('question_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.questions.index") }}" class="nav-link {{ request()->is("admin/questions") || request()->is("admin/questions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-question">

                                        </i>
                                        <p>
                                            {{ trans('cruds.question.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('communication_centre_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/tests*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/tests*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-comments">

                            </i>
                            <p>
                                {{ trans('cruds.communicationCentre.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('test_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tests.index") }}" class="nav-link {{ request()->is("admin/tests") || request()->is("admin/tests/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.test.title') }}
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
                    <li class="nav-item has-treeview {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/phones*") ? "menu-open" : "" }} {{ request()->is("admin/addresses*") ? "menu-open" : "" }} {{ request()->is("admin/audit-logs*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/users*") ? "active" : "" }} {{ request()->is("admin/roles*") ? "active" : "" }} {{ request()->is("admin/permissions*") ? "active" : "" }} {{ request()->is("admin/phones*") ? "active" : "" }} {{ request()->is("admin/addresses*") ? "active" : "" }} {{ request()->is("admin/audit-logs*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
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
                    <li class="nav-item has-treeview {{ request()->is("admin/institute-types*") ? "menu-open" : "" }} {{ request()->is("admin/institute-levels*") ? "menu-open" : "" }} {{ request()->is("admin/affiliationers*") ? "menu-open" : "" }} {{ request()->is("admin/designations*") ? "menu-open" : "" }} {{ request()->is("admin/employee-types*") ? "menu-open" : "" }} {{ request()->is("admin/countries*") ? "menu-open" : "" }} {{ request()->is("admin/provinces*") ? "menu-open" : "" }} {{ request()->is("admin/postal-codes*") ? "menu-open" : "" }} {{ request()->is("admin/blood-groups*") ? "menu-open" : "" }} {{ request()->is("admin/religions*") ? "menu-open" : "" }} {{ request()->is("admin/castes*") ? "menu-open" : "" }} {{ request()->is("admin/boards*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/institute-types*") ? "active" : "" }} {{ request()->is("admin/institute-levels*") ? "active" : "" }} {{ request()->is("admin/affiliationers*") ? "active" : "" }} {{ request()->is("admin/designations*") ? "active" : "" }} {{ request()->is("admin/employee-types*") ? "active" : "" }} {{ request()->is("admin/countries*") ? "active" : "" }} {{ request()->is("admin/provinces*") ? "active" : "" }} {{ request()->is("admin/postal-codes*") ? "active" : "" }} {{ request()->is("admin/blood-groups*") ? "active" : "" }} {{ request()->is("admin/religions*") ? "active" : "" }} {{ request()->is("admin/castes*") ? "active" : "" }} {{ request()->is("admin/boards*") ? "active" : "" }}" href="#">
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
                            @can('board_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.boards.index") }}" class="nav-link {{ request()->is("admin/boards") || request()->is("admin/boards/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.board.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('asset_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/asset-categories*") ? "menu-open" : "" }} {{ request()->is("admin/asset-locations*") ? "menu-open" : "" }} {{ request()->is("admin/asset-statuses*") ? "menu-open" : "" }} {{ request()->is("admin/assets*") ? "menu-open" : "" }} {{ request()->is("admin/assets-histories*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/asset-categories*") ? "active" : "" }} {{ request()->is("admin/asset-locations*") ? "active" : "" }} {{ request()->is("admin/asset-statuses*") ? "active" : "" }} {{ request()->is("admin/assets*") ? "active" : "" }} {{ request()->is("admin/assets-histories*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-book">

                            </i>
                            <p>
                                {{ trans('cruds.assetManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('asset_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.asset-categories.index") }}" class="nav-link {{ request()->is("admin/asset-categories") || request()->is("admin/asset-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tags">

                                        </i>
                                        <p>
                                            {{ trans('cruds.assetCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('asset_location_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.asset-locations.index") }}" class="nav-link {{ request()->is("admin/asset-locations") || request()->is("admin/asset-locations/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-map-marker">

                                        </i>
                                        <p>
                                            {{ trans('cruds.assetLocation.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('asset_status_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.asset-statuses.index") }}" class="nav-link {{ request()->is("admin/asset-statuses") || request()->is("admin/asset-statuses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-server">

                                        </i>
                                        <p>
                                            {{ trans('cruds.assetStatus.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('asset_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.assets.index") }}" class="nav-link {{ request()->is("admin/assets") || request()->is("admin/assets/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-book">

                                        </i>
                                        <p>
                                            {{ trans('cruds.asset.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('assets_history_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.assets-histories.index") }}" class="nav-link {{ request()->is("admin/assets-histories") || request()->is("admin/assets-histories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-th-list">

                                        </i>
                                        <p>
                                            {{ trans('cruds.assetsHistory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('expense_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/expense-categories*") ? "menu-open" : "" }} {{ request()->is("admin/income-categories*") ? "menu-open" : "" }} {{ request()->is("admin/expenses*") ? "menu-open" : "" }} {{ request()->is("admin/incomes*") ? "menu-open" : "" }} {{ request()->is("admin/expense-reports*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/expense-categories*") ? "active" : "" }} {{ request()->is("admin/income-categories*") ? "active" : "" }} {{ request()->is("admin/expenses*") ? "active" : "" }} {{ request()->is("admin/incomes*") ? "active" : "" }} {{ request()->is("admin/expense-reports*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-money-bill">

                            </i>
                            <p>
                                {{ trans('cruds.expenseManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('expense_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.expense-categories.index") }}" class="nav-link {{ request()->is("admin/expense-categories") || request()->is("admin/expense-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-list">

                                        </i>
                                        <p>
                                            {{ trans('cruds.expenseCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('income_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.income-categories.index") }}" class="nav-link {{ request()->is("admin/income-categories") || request()->is("admin/income-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-list">

                                        </i>
                                        <p>
                                            {{ trans('cruds.incomeCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('expense_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.expenses.index") }}" class="nav-link {{ request()->is("admin/expenses") || request()->is("admin/expenses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-arrow-circle-right">

                                        </i>
                                        <p>
                                            {{ trans('cruds.expense.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('income_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.incomes.index") }}" class="nav-link {{ request()->is("admin/incomes") || request()->is("admin/incomes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-arrow-circle-right">

                                        </i>
                                        <p>
                                            {{ trans('cruds.income.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('expense_report_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.expense-reports.index") }}" class="nav-link {{ request()->is("admin/expense-reports") || request()->is("admin/expense-reports/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-chart-line">

                                        </i>
                                        <p>
                                            {{ trans('cruds.expenseReport.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('library_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/books*") ? "menu-open" : "" }} {{ request()->is("admin/issue-books*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/books*") ? "active" : "" }} {{ request()->is("admin/issue-books*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-book">

                            </i>
                            <p>
                                {{ trans('cruds.libraryManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('book_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.books.index") }}" class="nav-link {{ request()->is("admin/books") || request()->is("admin/books/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-book-open">

                                        </i>
                                        <p>
                                            {{ trans('cruds.book.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('issue_book_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.issue-books.index") }}" class="nav-link {{ request()->is("admin/issue-books") || request()->is("admin/issue-books/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-hand-holding">

                                        </i>
                                        <p>
                                            {{ trans('cruds.issueBook.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('enquiry_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/enquiries*") ? "menu-open" : "" }} {{ request()->is("admin/class-levels*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/enquiries*") ? "active" : "" }} {{ request()->is("admin/class-levels*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-question">

                            </i>
                            <p>
                                {{ trans('cruds.enquiryManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('enquiry_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.enquiries.index") }}" class="nav-link {{ request()->is("admin/enquiries") || request()->is("admin/enquiries/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-at">

                                        </i>
                                        <p>
                                            {{ trans('cruds.enquiry.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('class_level_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.class-levels.index") }}" class="nav-link {{ request()->is("admin/class-levels") || request()->is("admin/class-levels/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-graduation-cap">

                                        </i>
                                        <p>
                                            {{ trans('cruds.classLevel.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
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