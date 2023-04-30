<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'partner_create',
            ],
            [
                'id'    => 20,
                'title' => 'partner_edit',
            ],
            [
                'id'    => 21,
                'title' => 'partner_show',
            ],
            [
                'id'    => 22,
                'title' => 'partner_delete',
            ],
            [
                'id'    => 23,
                'title' => 'partner_access',
            ],
            [
                'id'    => 24,
                'title' => 'institute_create',
            ],
            [
                'id'    => 25,
                'title' => 'institute_edit',
            ],
            [
                'id'    => 26,
                'title' => 'institute_show',
            ],
            [
                'id'    => 27,
                'title' => 'institute_delete',
            ],
            [
                'id'    => 28,
                'title' => 'institute_access',
            ],
            [
                'id'    => 29,
                'title' => 'institute_type_create',
            ],
            [
                'id'    => 30,
                'title' => 'institute_type_edit',
            ],
            [
                'id'    => 31,
                'title' => 'institute_type_show',
            ],
            [
                'id'    => 32,
                'title' => 'institute_type_delete',
            ],
            [
                'id'    => 33,
                'title' => 'institute_type_access',
            ],
            [
                'id'    => 34,
                'title' => 'institute_level_create',
            ],
            [
                'id'    => 35,
                'title' => 'institute_level_edit',
            ],
            [
                'id'    => 36,
                'title' => 'institute_level_show',
            ],
            [
                'id'    => 37,
                'title' => 'institute_level_delete',
            ],
            [
                'id'    => 38,
                'title' => 'institute_level_access',
            ],
            [
                'id'    => 39,
                'title' => 'affiliationer_create',
            ],
            [
                'id'    => 40,
                'title' => 'affiliationer_edit',
            ],
            [
                'id'    => 41,
                'title' => 'affiliationer_show',
            ],
            [
                'id'    => 42,
                'title' => 'affiliationer_delete',
            ],
            [
                'id'    => 43,
                'title' => 'affiliationer_access',
            ],
            [
                'id'    => 44,
                'title' => 'miscellaneou_access',
            ],
            [
                'id'    => 45,
                'title' => 'course_create',
            ],
            [
                'id'    => 46,
                'title' => 'course_edit',
            ],
            [
                'id'    => 47,
                'title' => 'course_show',
            ],
            [
                'id'    => 48,
                'title' => 'course_delete',
            ],
            [
                'id'    => 49,
                'title' => 'course_access',
            ],
            [
                'id'    => 50,
                'title' => 'academic_session_create',
            ],
            [
                'id'    => 51,
                'title' => 'academic_session_edit',
            ],
            [
                'id'    => 52,
                'title' => 'academic_session_show',
            ],
            [
                'id'    => 53,
                'title' => 'academic_session_delete',
            ],
            [
                'id'    => 54,
                'title' => 'academic_session_access',
            ],
            [
                'id'    => 55,
                'title' => 'grade_create',
            ],
            [
                'id'    => 56,
                'title' => 'grade_edit',
            ],
            [
                'id'    => 57,
                'title' => 'grade_show',
            ],
            [
                'id'    => 58,
                'title' => 'grade_delete',
            ],
            [
                'id'    => 59,
                'title' => 'grade_access',
            ],
            [
                'id'    => 60,
                'title' => 'section_create',
            ],
            [
                'id'    => 61,
                'title' => 'section_edit',
            ],
            [
                'id'    => 62,
                'title' => 'section_show',
            ],
            [
                'id'    => 63,
                'title' => 'section_delete',
            ],
            [
                'id'    => 64,
                'title' => 'section_access',
            ],
            [
                'id'    => 65,
                'title' => 'subject_create',
            ],
            [
                'id'    => 66,
                'title' => 'subject_edit',
            ],
            [
                'id'    => 67,
                'title' => 'subject_show',
            ],
            [
                'id'    => 68,
                'title' => 'subject_delete',
            ],
            [
                'id'    => 69,
                'title' => 'subject_access',
            ],
            [
                'id'    => 70,
                'title' => 'batch_create',
            ],
            [
                'id'    => 71,
                'title' => 'batch_edit',
            ],
            [
                'id'    => 72,
                'title' => 'batch_show',
            ],
            [
                'id'    => 73,
                'title' => 'batch_delete',
            ],
            [
                'id'    => 74,
                'title' => 'batch_access',
            ],
            [
                'id'    => 75,
                'title' => 'coaching_data_access',
            ],
            [
                'id'    => 76,
                'title' => 'student_create',
            ],
            [
                'id'    => 77,
                'title' => 'student_edit',
            ],
            [
                'id'    => 78,
                'title' => 'student_show',
            ],
            [
                'id'    => 79,
                'title' => 'student_delete',
            ],
            [
                'id'    => 80,
                'title' => 'student_access',
            ],
            [
                'id'    => 81,
                'title' => 'tests_management_access',
            ],
            [
                'id'    => 82,
                'title' => 'omr_based_test_create',
            ],
            [
                'id'    => 83,
                'title' => 'omr_based_test_edit',
            ],
            [
                'id'    => 84,
                'title' => 'omr_based_test_show',
            ],
            [
                'id'    => 85,
                'title' => 'omr_based_test_delete',
            ],
            [
                'id'    => 86,
                'title' => 'omr_based_test_access',
            ],
            [
                'id'    => 87,
                'title' => 'file_mode_online_test_create',
            ],
            [
                'id'    => 88,
                'title' => 'file_mode_online_test_edit',
            ],
            [
                'id'    => 89,
                'title' => 'file_mode_online_test_show',
            ],
            [
                'id'    => 90,
                'title' => 'file_mode_online_test_delete',
            ],
            [
                'id'    => 91,
                'title' => 'file_mode_online_test_access',
            ],
            [
                'id'    => 92,
                'title' => 'students_attendance_access',
            ],
            [
                'id'    => 93,
                'title' => 'fees_management_access',
            ],
            [
                'id'    => 94,
                'title' => 'fees_structure_create',
            ],
            [
                'id'    => 95,
                'title' => 'fees_structure_edit',
            ],
            [
                'id'    => 96,
                'title' => 'fees_structure_show',
            ],
            [
                'id'    => 97,
                'title' => 'fees_structure_delete',
            ],
            [
                'id'    => 98,
                'title' => 'fees_structure_access',
            ],
            [
                'id'    => 99,
                'title' => 'grade_subject_create',
            ],
            [
                'id'    => 100,
                'title' => 'grade_subject_edit',
            ],
            [
                'id'    => 101,
                'title' => 'grade_subject_show',
            ],
            [
                'id'    => 102,
                'title' => 'grade_subject_delete',
            ],
            [
                'id'    => 103,
                'title' => 'grade_subject_access',
            ],
            [
                'id'    => 104,
                'title' => 'chapter_create',
            ],
            [
                'id'    => 105,
                'title' => 'chapter_edit',
            ],
            [
                'id'    => 106,
                'title' => 'chapter_show',
            ],
            [
                'id'    => 107,
                'title' => 'chapter_delete',
            ],
            [
                'id'    => 108,
                'title' => 'chapter_access',
            ],
            [
                'id'    => 109,
                'title' => 'designation_create',
            ],
            [
                'id'    => 110,
                'title' => 'designation_edit',
            ],
            [
                'id'    => 111,
                'title' => 'designation_show',
            ],
            [
                'id'    => 112,
                'title' => 'designation_delete',
            ],
            [
                'id'    => 113,
                'title' => 'designation_access',
            ],
            [
                'id'    => 114,
                'title' => 'employee_create',
            ],
            [
                'id'    => 115,
                'title' => 'employee_edit',
            ],
            [
                'id'    => 116,
                'title' => 'employee_show',
            ],
            [
                'id'    => 117,
                'title' => 'employee_delete',
            ],
            [
                'id'    => 118,
                'title' => 'employee_access',
            ],
            [
                'id'    => 119,
                'title' => 'employee_type_create',
            ],
            [
                'id'    => 120,
                'title' => 'employee_type_edit',
            ],
            [
                'id'    => 121,
                'title' => 'employee_type_show',
            ],
            [
                'id'    => 122,
                'title' => 'employee_type_delete',
            ],
            [
                'id'    => 123,
                'title' => 'employee_type_access',
            ],
            [
                'id'    => 124,
                'title' => 'transport_vehicle_create',
            ],
            [
                'id'    => 125,
                'title' => 'transport_vehicle_edit',
            ],
            [
                'id'    => 126,
                'title' => 'transport_vehicle_show',
            ],
            [
                'id'    => 127,
                'title' => 'transport_vehicle_delete',
            ],
            [
                'id'    => 128,
                'title' => 'transport_vehicle_access',
            ],
            [
                'id'    => 129,
                'title' => 'transport_route_create',
            ],
            [
                'id'    => 130,
                'title' => 'transport_route_edit',
            ],
            [
                'id'    => 131,
                'title' => 'transport_route_show',
            ],
            [
                'id'    => 132,
                'title' => 'transport_route_delete',
            ],
            [
                'id'    => 133,
                'title' => 'transport_route_access',
            ],
            [
                'id'    => 134,
                'title' => 'route_stop_create',
            ],
            [
                'id'    => 135,
                'title' => 'route_stop_edit',
            ],
            [
                'id'    => 136,
                'title' => 'route_stop_show',
            ],
            [
                'id'    => 137,
                'title' => 'route_stop_delete',
            ],
            [
                'id'    => 138,
                'title' => 'route_stop_access',
            ],
            [
                'id'    => 139,
                'title' => 'transportation_management_access',
            ],
            [
                'id'    => 140,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
