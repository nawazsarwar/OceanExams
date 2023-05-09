<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    @yield('styles')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('frontend.home') }}">
                                    {{ __('Dashboard') }}
                                </a>
                            </li>
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if(Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('frontend.profile.index') }}">{{ __('My profile') }}</a>

                                    @can('partner_access')
                                        <a class="dropdown-item" href="{{ route('frontend.partners.index') }}">
                                            {{ trans('cruds.partner.title') }}
                                        </a>
                                    @endcan
                                    @can('institute_access')
                                        <a class="dropdown-item" href="{{ route('frontend.institutes.index') }}">
                                            {{ trans('cruds.institute.title') }}
                                        </a>
                                    @endcan
                                    @can('academic_session_access')
                                        <a class="dropdown-item" href="{{ route('frontend.academic-sessions.index') }}">
                                            {{ trans('cruds.academicSession.title') }}
                                        </a>
                                    @endcan
                                    @can('course_access')
                                        <a class="dropdown-item" href="{{ route('frontend.courses.index') }}">
                                            {{ trans('cruds.course.title') }}
                                        </a>
                                    @endcan
                                    @can('section_access')
                                        <a class="dropdown-item" href="{{ route('frontend.sections.index') }}">
                                            {{ trans('cruds.section.title') }}
                                        </a>
                                    @endcan
                                    @can('subject_access')
                                        <a class="dropdown-item" href="{{ route('frontend.subjects.index') }}">
                                            {{ trans('cruds.subject.title') }}
                                        </a>
                                    @endcan
                                    @can('chapter_access')
                                        <a class="dropdown-item" href="{{ route('frontend.chapters.index') }}">
                                            {{ trans('cruds.chapter.title') }}
                                        </a>
                                    @endcan
                                    @can('student_access')
                                        <a class="dropdown-item" href="{{ route('frontend.students.index') }}">
                                            {{ trans('cruds.student.title') }}
                                        </a>
                                    @endcan
                                    @can('students_attendance_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.studentsAttendance.title') }}
                                        </a>
                                    @endcan
                                    @can('mark_attendance_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.mark-attendances.index') }}">
                                            {{ trans('cruds.markAttendance.title') }}
                                        </a>
                                    @endcan
                                    @can('fees_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.feesManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('fee_head_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.fee-heads.index') }}">
                                            {{ trans('cruds.feeHead.title') }}
                                        </a>
                                    @endcan
                                    @can('fee_structure_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.fee-structures.index') }}">
                                            {{ trans('cruds.feeStructure.title') }}
                                        </a>
                                    @endcan
                                    @can('tests_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.testsManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('omr_based_test_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.omr-based-tests.index') }}">
                                            {{ trans('cruds.omrBasedTest.title') }}
                                        </a>
                                    @endcan
                                    @can('file_mode_online_test_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.file-mode-online-tests.index') }}">
                                            {{ trans('cruds.fileModeOnlineTest.title') }}
                                        </a>
                                    @endcan
                                    @can('questions_bank_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.questionsBank.title') }}
                                        </a>
                                    @endcan
                                    @can('question_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.questions.index') }}">
                                            {{ trans('cruds.question.title') }}
                                        </a>
                                    @endcan
                                    @can('transportation_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.transportationManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('transport_vehicle_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.transport-vehicles.index') }}">
                                            {{ trans('cruds.transportVehicle.title') }}
                                        </a>
                                    @endcan
                                    @can('transport_route_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.transport-routes.index') }}">
                                            {{ trans('cruds.transportRoute.title') }}
                                        </a>
                                    @endcan
                                    @can('route_stop_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.route-stops.index') }}">
                                            {{ trans('cruds.routeStop.title') }}
                                        </a>
                                    @endcan
                                    @can('employee_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.employeeManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('employee_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.employees.index') }}">
                                            {{ trans('cruds.employee.title') }}
                                        </a>
                                    @endcan
                                    @can('user_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.userManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('user_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.users.index') }}">
                                            {{ trans('cruds.user.title') }}
                                        </a>
                                    @endcan
                                    @can('role_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.roles.index') }}">
                                            {{ trans('cruds.role.title') }}
                                        </a>
                                    @endcan
                                    @can('permission_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.permissions.index') }}">
                                            {{ trans('cruds.permission.title') }}
                                        </a>
                                    @endcan
                                    @can('phone_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.phones.index') }}">
                                            {{ trans('cruds.phone.title') }}
                                        </a>
                                    @endcan
                                    @can('address_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.addresses.index') }}">
                                            {{ trans('cruds.address.title') }}
                                        </a>
                                    @endcan
                                    @can('miscellaneou_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.miscellaneou.title') }}
                                        </a>
                                    @endcan
                                    @can('institute_type_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.institute-types.index') }}">
                                            {{ trans('cruds.instituteType.title') }}
                                        </a>
                                    @endcan
                                    @can('institute_level_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.institute-levels.index') }}">
                                            {{ trans('cruds.instituteLevel.title') }}
                                        </a>
                                    @endcan
                                    @can('affiliationer_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.affiliationers.index') }}">
                                            {{ trans('cruds.affiliationer.title') }}
                                        </a>
                                    @endcan
                                    @can('designation_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.designations.index') }}">
                                            {{ trans('cruds.designation.title') }}
                                        </a>
                                    @endcan
                                    @can('employee_type_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.employee-types.index') }}">
                                            {{ trans('cruds.employeeType.title') }}
                                        </a>
                                    @endcan
                                    @can('country_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.countries.index') }}">
                                            {{ trans('cruds.country.title') }}
                                        </a>
                                    @endcan
                                    @can('province_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.provinces.index') }}">
                                            {{ trans('cruds.province.title') }}
                                        </a>
                                    @endcan
                                    @can('postal_code_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.postal-codes.index') }}">
                                            {{ trans('cruds.postalCode.title') }}
                                        </a>
                                    @endcan
                                    @can('blood_group_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.blood-groups.index') }}">
                                            {{ trans('cruds.bloodGroup.title') }}
                                        </a>
                                    @endcan
                                    @can('religion_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.religions.index') }}">
                                            {{ trans('cruds.religion.title') }}
                                        </a>
                                    @endcan
                                    @can('caste_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.castes.index') }}">
                                            {{ trans('cruds.caste.title') }}
                                        </a>
                                    @endcan

                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if(session('message'))
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                        </div>
                    </div>
                </div>
            @endif
            @if($errors->count() > 0)
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <ul class="list-unstyled mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
@yield('scripts')

</html>