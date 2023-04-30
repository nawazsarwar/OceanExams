<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::apiResource('users', 'UsersApiController');

    // Partners
    Route::post('partners/media', 'PartnersApiController@storeMedia')->name('partners.storeMedia');
    Route::apiResource('partners', 'PartnersApiController');

    // Institutes
    Route::post('institutes/media', 'InstitutesApiController@storeMedia')->name('institutes.storeMedia');
    Route::apiResource('institutes', 'InstitutesApiController');

    // Institute Types
    Route::apiResource('institute-types', 'InstituteTypesApiController');

    // Institute Levels
    Route::apiResource('institute-levels', 'InstituteLevelsApiController');

    // Affiliationers
    Route::apiResource('affiliationers', 'AffiliationersApiController');

    // Courses
    Route::post('courses/media', 'CoursesApiController@storeMedia')->name('courses.storeMedia');
    Route::apiResource('courses', 'CoursesApiController');

    // Grade
    Route::apiResource('grades', 'GradeApiController');

    // Subjects
    Route::apiResource('subjects', 'SubjectsApiController');

    // Batches
    Route::apiResource('batches', 'BatchesApiController');

    // Students
    Route::post('students/media', 'StudentsApiController@storeMedia')->name('students.storeMedia');
    Route::apiResource('students', 'StudentsApiController');

    // Omr Based Tests
    Route::apiResource('omr-based-tests', 'OmrBasedTestsApiController');

    // File Mode Online Test
    Route::apiResource('file-mode-online-tests', 'FileModeOnlineTestApiController');

    // Fees Structure
    Route::apiResource('fees-structures', 'FeesStructureApiController');

    // Grade Subjects
    Route::apiResource('grade-subjects', 'GradeSubjectsApiController');

    // Chapters
    Route::apiResource('chapters', 'ChaptersApiController');

    // Designations
    Route::apiResource('designations', 'DesignationsApiController');

    // Employees
    Route::post('employees/media', 'EmployeesApiController@storeMedia')->name('employees.storeMedia');
    Route::apiResource('employees', 'EmployeesApiController');

    // Employee Types
    Route::apiResource('employee-types', 'EmployeeTypesApiController');

    // Transport Vehicles
    Route::apiResource('transport-vehicles', 'TransportVehiclesApiController');

    // Transport Routes
    Route::apiResource('transport-routes', 'TransportRoutesApiController');

    // Route Stops
    Route::apiResource('route-stops', 'RouteStopsApiController');
});
