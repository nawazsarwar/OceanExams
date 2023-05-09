<?php

Route::view('/', 'welcome');
Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Partners
    Route::delete('partners/destroy', 'PartnersController@massDestroy')->name('partners.massDestroy');
    Route::post('partners/media', 'PartnersController@storeMedia')->name('partners.storeMedia');
    Route::post('partners/ckmedia', 'PartnersController@storeCKEditorImages')->name('partners.storeCKEditorImages');
    Route::resource('partners', 'PartnersController');

    // Institute Types
    Route::delete('institute-types/destroy', 'InstituteTypesController@massDestroy')->name('institute-types.massDestroy');
    Route::post('institute-types/parse-csv-import', 'InstituteTypesController@parseCsvImport')->name('institute-types.parseCsvImport');
    Route::post('institute-types/process-csv-import', 'InstituteTypesController@processCsvImport')->name('institute-types.processCsvImport');
    Route::resource('institute-types', 'InstituteTypesController');

    // Institute Levels
    Route::delete('institute-levels/destroy', 'InstituteLevelsController@massDestroy')->name('institute-levels.massDestroy');
    Route::post('institute-levels/parse-csv-import', 'InstituteLevelsController@parseCsvImport')->name('institute-levels.parseCsvImport');
    Route::post('institute-levels/process-csv-import', 'InstituteLevelsController@processCsvImport')->name('institute-levels.processCsvImport');
    Route::resource('institute-levels', 'InstituteLevelsController');

    // Affiliationers
    Route::delete('affiliationers/destroy', 'AffiliationersController@massDestroy')->name('affiliationers.massDestroy');
    Route::post('affiliationers/parse-csv-import', 'AffiliationersController@parseCsvImport')->name('affiliationers.parseCsvImport');
    Route::post('affiliationers/process-csv-import', 'AffiliationersController@processCsvImport')->name('affiliationers.processCsvImport');
    Route::resource('affiliationers', 'AffiliationersController');

    // Institutes
    Route::delete('institutes/destroy', 'InstitutesController@massDestroy')->name('institutes.massDestroy');
    Route::post('institutes/media', 'InstitutesController@storeMedia')->name('institutes.storeMedia');
    Route::post('institutes/ckmedia', 'InstitutesController@storeCKEditorImages')->name('institutes.storeCKEditorImages');
    Route::post('institutes/parse-csv-import', 'InstitutesController@parseCsvImport')->name('institutes.parseCsvImport');
    Route::post('institutes/process-csv-import', 'InstitutesController@processCsvImport')->name('institutes.processCsvImport');
    Route::resource('institutes', 'InstitutesController');

    // Subjects
    Route::delete('subjects/destroy', 'SubjectsController@massDestroy')->name('subjects.massDestroy');
    Route::post('subjects/parse-csv-import', 'SubjectsController@parseCsvImport')->name('subjects.parseCsvImport');
    Route::post('subjects/process-csv-import', 'SubjectsController@processCsvImport')->name('subjects.processCsvImport');
    Route::resource('subjects', 'SubjectsController');

    // Courses
    Route::delete('courses/destroy', 'CoursesController@massDestroy')->name('courses.massDestroy');
    Route::post('courses/media', 'CoursesController@storeMedia')->name('courses.storeMedia');
    Route::post('courses/ckmedia', 'CoursesController@storeCKEditorImages')->name('courses.storeCKEditorImages');
    Route::resource('courses', 'CoursesController');

    // Academic Sessions
    Route::delete('academic-sessions/destroy', 'AcademicSessionsController@massDestroy')->name('academic-sessions.massDestroy');
    Route::resource('academic-sessions', 'AcademicSessionsController');

    // Sections
    Route::delete('sections/destroy', 'SectionsController@massDestroy')->name('sections.massDestroy');
    Route::resource('sections', 'SectionsController');

    // Transport Routes
    Route::delete('transport-routes/destroy', 'TransportRoutesController@massDestroy')->name('transport-routes.massDestroy');
    Route::post('transport-routes/parse-csv-import', 'TransportRoutesController@parseCsvImport')->name('transport-routes.parseCsvImport');
    Route::post('transport-routes/process-csv-import', 'TransportRoutesController@processCsvImport')->name('transport-routes.processCsvImport');
    Route::resource('transport-routes', 'TransportRoutesController');

    // Route Stops
    Route::delete('route-stops/destroy', 'RouteStopsController@massDestroy')->name('route-stops.massDestroy');
    Route::post('route-stops/parse-csv-import', 'RouteStopsController@parseCsvImport')->name('route-stops.parseCsvImport');
    Route::post('route-stops/process-csv-import', 'RouteStopsController@processCsvImport')->name('route-stops.processCsvImport');
    Route::resource('route-stops', 'RouteStopsController');

    // Students
    Route::delete('students/destroy', 'StudentsController@massDestroy')->name('students.massDestroy');
    Route::post('students/media', 'StudentsController@storeMedia')->name('students.storeMedia');
    Route::post('students/ckmedia', 'StudentsController@storeCKEditorImages')->name('students.storeCKEditorImages');
    Route::resource('students', 'StudentsController');

    // Omr Based Tests
    Route::delete('omr-based-tests/destroy', 'OmrBasedTestsController@massDestroy')->name('omr-based-tests.massDestroy');
    Route::resource('omr-based-tests', 'OmrBasedTestsController');

    // File Mode Online Test
    Route::delete('file-mode-online-tests/destroy', 'FileModeOnlineTestController@massDestroy')->name('file-mode-online-tests.massDestroy');
    Route::resource('file-mode-online-tests', 'FileModeOnlineTestController');

    // Fee Heads
    Route::delete('fee-heads/destroy', 'FeeHeadsController@massDestroy')->name('fee-heads.massDestroy');
    Route::post('fee-heads/parse-csv-import', 'FeeHeadsController@parseCsvImport')->name('fee-heads.parseCsvImport');
    Route::post('fee-heads/process-csv-import', 'FeeHeadsController@processCsvImport')->name('fee-heads.processCsvImport');
    Route::resource('fee-heads', 'FeeHeadsController');

    // Fee Structure
    Route::delete('fee-structures/destroy', 'FeeStructureController@massDestroy')->name('fee-structures.massDestroy');
    Route::resource('fee-structures', 'FeeStructureController');

    // Chapters
    Route::delete('chapters/destroy', 'ChaptersController@massDestroy')->name('chapters.massDestroy');
    Route::post('chapters/parse-csv-import', 'ChaptersController@parseCsvImport')->name('chapters.parseCsvImport');
    Route::post('chapters/process-csv-import', 'ChaptersController@processCsvImport')->name('chapters.processCsvImport');
    Route::resource('chapters', 'ChaptersController');

    // Designations
    Route::delete('designations/destroy', 'DesignationsController@massDestroy')->name('designations.massDestroy');
    Route::post('designations/parse-csv-import', 'DesignationsController@parseCsvImport')->name('designations.parseCsvImport');
    Route::post('designations/process-csv-import', 'DesignationsController@processCsvImport')->name('designations.processCsvImport');
    Route::resource('designations', 'DesignationsController');

    // Employees
    Route::delete('employees/destroy', 'EmployeesController@massDestroy')->name('employees.massDestroy');
    Route::post('employees/media', 'EmployeesController@storeMedia')->name('employees.storeMedia');
    Route::post('employees/ckmedia', 'EmployeesController@storeCKEditorImages')->name('employees.storeCKEditorImages');
    Route::post('employees/parse-csv-import', 'EmployeesController@parseCsvImport')->name('employees.parseCsvImport');
    Route::post('employees/process-csv-import', 'EmployeesController@processCsvImport')->name('employees.processCsvImport');
    Route::resource('employees', 'EmployeesController');

    // Employee Types
    Route::delete('employee-types/destroy', 'EmployeeTypesController@massDestroy')->name('employee-types.massDestroy');
    Route::post('employee-types/parse-csv-import', 'EmployeeTypesController@parseCsvImport')->name('employee-types.parseCsvImport');
    Route::post('employee-types/process-csv-import', 'EmployeeTypesController@processCsvImport')->name('employee-types.processCsvImport');
    Route::resource('employee-types', 'EmployeeTypesController');

    // Transport Vehicles
    Route::delete('transport-vehicles/destroy', 'TransportVehiclesController@massDestroy')->name('transport-vehicles.massDestroy');
    Route::resource('transport-vehicles', 'TransportVehiclesController');

    // Addresses
    Route::delete('addresses/destroy', 'AddressesController@massDestroy')->name('addresses.massDestroy');
    Route::resource('addresses', 'AddressesController');

    // Phones
    Route::delete('phones/destroy', 'PhonesController@massDestroy')->name('phones.massDestroy');
    Route::resource('phones', 'PhonesController');

    // Countries
    Route::delete('countries/destroy', 'CountriesController@massDestroy')->name('countries.massDestroy');
    Route::resource('countries', 'CountriesController');

    // Provinces
    Route::delete('provinces/destroy', 'ProvincesController@massDestroy')->name('provinces.massDestroy');
    Route::resource('provinces', 'ProvincesController');

    // Postal Code
    Route::delete('postal-codes/destroy', 'PostalCodeController@massDestroy')->name('postal-codes.massDestroy');
    Route::resource('postal-codes', 'PostalCodeController');

    // Blood Groups
    Route::delete('blood-groups/destroy', 'BloodGroupsController@massDestroy')->name('blood-groups.massDestroy');
    Route::resource('blood-groups', 'BloodGroupsController');

    // Religions
    Route::delete('religions/destroy', 'ReligionsController@massDestroy')->name('religions.massDestroy');
    Route::resource('religions', 'ReligionsController');

    // Castes
    Route::delete('castes/destroy', 'CastesController@massDestroy')->name('castes.massDestroy');
    Route::resource('castes', 'CastesController');

    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
        Route::post('profile/two-factor', 'ChangePasswordController@toggleTwoFactor')->name('password.toggleTwoFactor');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth', '2fa']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Partners
    Route::delete('partners/destroy', 'PartnersController@massDestroy')->name('partners.massDestroy');
    Route::post('partners/media', 'PartnersController@storeMedia')->name('partners.storeMedia');
    Route::post('partners/ckmedia', 'PartnersController@storeCKEditorImages')->name('partners.storeCKEditorImages');
    Route::resource('partners', 'PartnersController');

    // Institute Types
    Route::delete('institute-types/destroy', 'InstituteTypesController@massDestroy')->name('institute-types.massDestroy');
    Route::resource('institute-types', 'InstituteTypesController');

    // Institute Levels
    Route::delete('institute-levels/destroy', 'InstituteLevelsController@massDestroy')->name('institute-levels.massDestroy');
    Route::resource('institute-levels', 'InstituteLevelsController');

    // Affiliationers
    Route::delete('affiliationers/destroy', 'AffiliationersController@massDestroy')->name('affiliationers.massDestroy');
    Route::resource('affiliationers', 'AffiliationersController');

    // Institutes
    Route::delete('institutes/destroy', 'InstitutesController@massDestroy')->name('institutes.massDestroy');
    Route::post('institutes/media', 'InstitutesController@storeMedia')->name('institutes.storeMedia');
    Route::post('institutes/ckmedia', 'InstitutesController@storeCKEditorImages')->name('institutes.storeCKEditorImages');
    Route::resource('institutes', 'InstitutesController');

    // Subjects
    Route::delete('subjects/destroy', 'SubjectsController@massDestroy')->name('subjects.massDestroy');
    Route::resource('subjects', 'SubjectsController');

    // Courses
    Route::delete('courses/destroy', 'CoursesController@massDestroy')->name('courses.massDestroy');
    Route::post('courses/media', 'CoursesController@storeMedia')->name('courses.storeMedia');
    Route::post('courses/ckmedia', 'CoursesController@storeCKEditorImages')->name('courses.storeCKEditorImages');
    Route::resource('courses', 'CoursesController');

    // Academic Sessions
    Route::delete('academic-sessions/destroy', 'AcademicSessionsController@massDestroy')->name('academic-sessions.massDestroy');
    Route::resource('academic-sessions', 'AcademicSessionsController');

    // Sections
    Route::delete('sections/destroy', 'SectionsController@massDestroy')->name('sections.massDestroy');
    Route::resource('sections', 'SectionsController');

    // Transport Routes
    Route::delete('transport-routes/destroy', 'TransportRoutesController@massDestroy')->name('transport-routes.massDestroy');
    Route::resource('transport-routes', 'TransportRoutesController');

    // Route Stops
    Route::delete('route-stops/destroy', 'RouteStopsController@massDestroy')->name('route-stops.massDestroy');
    Route::resource('route-stops', 'RouteStopsController');

    // Students
    Route::delete('students/destroy', 'StudentsController@massDestroy')->name('students.massDestroy');
    Route::post('students/media', 'StudentsController@storeMedia')->name('students.storeMedia');
    Route::post('students/ckmedia', 'StudentsController@storeCKEditorImages')->name('students.storeCKEditorImages');
    Route::resource('students', 'StudentsController');

    // Omr Based Tests
    Route::delete('omr-based-tests/destroy', 'OmrBasedTestsController@massDestroy')->name('omr-based-tests.massDestroy');
    Route::resource('omr-based-tests', 'OmrBasedTestsController');

    // File Mode Online Test
    Route::delete('file-mode-online-tests/destroy', 'FileModeOnlineTestController@massDestroy')->name('file-mode-online-tests.massDestroy');
    Route::resource('file-mode-online-tests', 'FileModeOnlineTestController');

    // Fee Heads
    Route::delete('fee-heads/destroy', 'FeeHeadsController@massDestroy')->name('fee-heads.massDestroy');
    Route::resource('fee-heads', 'FeeHeadsController');

    // Fee Structure
    Route::delete('fee-structures/destroy', 'FeeStructureController@massDestroy')->name('fee-structures.massDestroy');
    Route::resource('fee-structures', 'FeeStructureController');

    // Chapters
    Route::delete('chapters/destroy', 'ChaptersController@massDestroy')->name('chapters.massDestroy');
    Route::resource('chapters', 'ChaptersController');

    // Designations
    Route::delete('designations/destroy', 'DesignationsController@massDestroy')->name('designations.massDestroy');
    Route::resource('designations', 'DesignationsController');

    // Employees
    Route::delete('employees/destroy', 'EmployeesController@massDestroy')->name('employees.massDestroy');
    Route::post('employees/media', 'EmployeesController@storeMedia')->name('employees.storeMedia');
    Route::post('employees/ckmedia', 'EmployeesController@storeCKEditorImages')->name('employees.storeCKEditorImages');
    Route::resource('employees', 'EmployeesController');

    // Employee Types
    Route::delete('employee-types/destroy', 'EmployeeTypesController@massDestroy')->name('employee-types.massDestroy');
    Route::resource('employee-types', 'EmployeeTypesController');

    // Transport Vehicles
    Route::delete('transport-vehicles/destroy', 'TransportVehiclesController@massDestroy')->name('transport-vehicles.massDestroy');
    Route::resource('transport-vehicles', 'TransportVehiclesController');

    // Addresses
    Route::delete('addresses/destroy', 'AddressesController@massDestroy')->name('addresses.massDestroy');
    Route::resource('addresses', 'AddressesController');

    // Phones
    Route::delete('phones/destroy', 'PhonesController@massDestroy')->name('phones.massDestroy');
    Route::resource('phones', 'PhonesController');

    // Countries
    Route::delete('countries/destroy', 'CountriesController@massDestroy')->name('countries.massDestroy');
    Route::resource('countries', 'CountriesController');

    // Provinces
    Route::delete('provinces/destroy', 'ProvincesController@massDestroy')->name('provinces.massDestroy');
    Route::resource('provinces', 'ProvincesController');

    // Postal Code
    Route::delete('postal-codes/destroy', 'PostalCodeController@massDestroy')->name('postal-codes.massDestroy');
    Route::resource('postal-codes', 'PostalCodeController');

    // Blood Groups
    Route::delete('blood-groups/destroy', 'BloodGroupsController@massDestroy')->name('blood-groups.massDestroy');
    Route::resource('blood-groups', 'BloodGroupsController');

    // Religions
    Route::delete('religions/destroy', 'ReligionsController@massDestroy')->name('religions.massDestroy');
    Route::resource('religions', 'ReligionsController');

    // Castes
    Route::delete('castes/destroy', 'CastesController@massDestroy')->name('castes.massDestroy');
    Route::resource('castes', 'CastesController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
    Route::post('profile/toggle-two-factor', 'ProfileController@toggleTwoFactor')->name('profile.toggle-two-factor');
});
Route::group(['namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Two Factor Authentication
    if (file_exists(app_path('Http/Controllers/Auth/TwoFactorController.php'))) {
        Route::get('two-factor', 'TwoFactorController@show')->name('twoFactor.show');
        Route::post('two-factor', 'TwoFactorController@check')->name('twoFactor.check');
        Route::get('two-factor/resend', 'TwoFactorController@resend')->name('twoFactor.resend');
    }
});
