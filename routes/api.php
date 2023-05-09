<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::apiResource('users', 'UsersApiController');

    // Institute Types
    Route::apiResource('institute-types', 'InstituteTypesApiController');

    // Institute Levels
    Route::apiResource('institute-levels', 'InstituteLevelsApiController');

    // Affiliationers
    Route::apiResource('affiliationers', 'AffiliationersApiController');

    // Partners
    Route::post('partners/media', 'PartnersApiController@storeMedia')->name('partners.storeMedia');
    Route::apiResource('partners', 'PartnersApiController');

    // Institutes
    Route::post('institutes/media', 'InstitutesApiController@storeMedia')->name('institutes.storeMedia');
    Route::apiResource('institutes', 'InstitutesApiController');

    // Courses
    Route::post('courses/media', 'CoursesApiController@storeMedia')->name('courses.storeMedia');
    Route::apiResource('courses', 'CoursesApiController');

    // Subjects
    Route::apiResource('subjects', 'SubjectsApiController');

    // Transport Routes
    Route::apiResource('transport-routes', 'TransportRoutesApiController');

    // Route Stops
    Route::apiResource('route-stops', 'RouteStopsApiController');

    // Students
    Route::post('students/media', 'StudentsApiController@storeMedia')->name('students.storeMedia');
    Route::apiResource('students', 'StudentsApiController');

    // Omr Based Tests
    Route::apiResource('omr-based-tests', 'OmrBasedTestsApiController');

    // File Mode Online Test
    Route::apiResource('file-mode-online-tests', 'FileModeOnlineTestApiController');

    // Fee Heads
    Route::apiResource('fee-heads', 'FeeHeadsApiController');

    // Fee Structure
    Route::apiResource('fee-structures', 'FeeStructureApiController');

    // Chapters
    Route::apiResource('chapters', 'ChaptersApiController');

    // Designations
    Route::apiResource('designations', 'DesignationsApiController');

    // Employee Types
    Route::apiResource('employee-types', 'EmployeeTypesApiController');

    // Employees
    Route::post('employees/media', 'EmployeesApiController@storeMedia')->name('employees.storeMedia');
    Route::apiResource('employees', 'EmployeesApiController');

    // Transport Vehicles
    Route::apiResource('transport-vehicles', 'TransportVehiclesApiController');

    // Countries
    Route::apiResource('countries', 'CountriesApiController');

    // Provinces
    Route::apiResource('provinces', 'ProvincesApiController');

    // Postal Code
    Route::apiResource('postal-codes', 'PostalCodeApiController');

    // Addresses
    Route::apiResource('addresses', 'AddressesApiController');

    // Phones
    Route::apiResource('phones', 'PhonesApiController');

    // Blood Groups
    Route::apiResource('blood-groups', 'BloodGroupsApiController');

    // Religions
    Route::apiResource('religions', 'ReligionsApiController');

    // Castes
    Route::apiResource('castes', 'CastesApiController');

    // Mark Attendance
    Route::apiResource('mark-attendances', 'MarkAttendanceApiController');

    // Questions
    Route::post('questions/media', 'QuestionsApiController@storeMedia')->name('questions.storeMedia');
    Route::apiResource('questions', 'QuestionsApiController');
});
