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
                'title' => 'miscellaneou_access',
            ],
            [
                'id'    => 20,
                'title' => 'institute_type_create',
            ],
            [
                'id'    => 21,
                'title' => 'institute_type_edit',
            ],
            [
                'id'    => 22,
                'title' => 'institute_type_show',
            ],
            [
                'id'    => 23,
                'title' => 'institute_type_delete',
            ],
            [
                'id'    => 24,
                'title' => 'institute_type_access',
            ],
            [
                'id'    => 25,
                'title' => 'institute_level_create',
            ],
            [
                'id'    => 26,
                'title' => 'institute_level_edit',
            ],
            [
                'id'    => 27,
                'title' => 'institute_level_show',
            ],
            [
                'id'    => 28,
                'title' => 'institute_level_delete',
            ],
            [
                'id'    => 29,
                'title' => 'institute_level_access',
            ],
            [
                'id'    => 30,
                'title' => 'affiliationer_create',
            ],
            [
                'id'    => 31,
                'title' => 'affiliationer_edit',
            ],
            [
                'id'    => 32,
                'title' => 'affiliationer_show',
            ],
            [
                'id'    => 33,
                'title' => 'affiliationer_delete',
            ],
            [
                'id'    => 34,
                'title' => 'affiliationer_access',
            ],
            [
                'id'    => 35,
                'title' => 'partner_create',
            ],
            [
                'id'    => 36,
                'title' => 'partner_edit',
            ],
            [
                'id'    => 37,
                'title' => 'partner_show',
            ],
            [
                'id'    => 38,
                'title' => 'partner_delete',
            ],
            [
                'id'    => 39,
                'title' => 'partner_access',
            ],
            [
                'id'    => 40,
                'title' => 'institute_create',
            ],
            [
                'id'    => 41,
                'title' => 'institute_edit',
            ],
            [
                'id'    => 42,
                'title' => 'institute_show',
            ],
            [
                'id'    => 43,
                'title' => 'institute_delete',
            ],
            [
                'id'    => 44,
                'title' => 'institute_access',
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
                'title' => 'section_create',
            ],
            [
                'id'    => 51,
                'title' => 'section_edit',
            ],
            [
                'id'    => 52,
                'title' => 'section_show',
            ],
            [
                'id'    => 53,
                'title' => 'section_delete',
            ],
            [
                'id'    => 54,
                'title' => 'section_access',
            ],
            [
                'id'    => 55,
                'title' => 'subject_create',
            ],
            [
                'id'    => 56,
                'title' => 'subject_edit',
            ],
            [
                'id'    => 57,
                'title' => 'subject_show',
            ],
            [
                'id'    => 58,
                'title' => 'subject_delete',
            ],
            [
                'id'    => 59,
                'title' => 'subject_access',
            ],
            [
                'id'    => 60,
                'title' => 'academic_session_create',
            ],
            [
                'id'    => 61,
                'title' => 'academic_session_edit',
            ],
            [
                'id'    => 62,
                'title' => 'academic_session_show',
            ],
            [
                'id'    => 63,
                'title' => 'academic_session_delete',
            ],
            [
                'id'    => 64,
                'title' => 'academic_session_access',
            ],
            [
                'id'    => 65,
                'title' => 'transportation_management_access',
            ],
            [
                'id'    => 66,
                'title' => 'transport_route_create',
            ],
            [
                'id'    => 67,
                'title' => 'transport_route_edit',
            ],
            [
                'id'    => 68,
                'title' => 'transport_route_show',
            ],
            [
                'id'    => 69,
                'title' => 'transport_route_delete',
            ],
            [
                'id'    => 70,
                'title' => 'transport_route_access',
            ],
            [
                'id'    => 71,
                'title' => 'route_stop_create',
            ],
            [
                'id'    => 72,
                'title' => 'route_stop_edit',
            ],
            [
                'id'    => 73,
                'title' => 'route_stop_show',
            ],
            [
                'id'    => 74,
                'title' => 'route_stop_delete',
            ],
            [
                'id'    => 75,
                'title' => 'route_stop_access',
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
                'title' => 'fee_head_create',
            ],
            [
                'id'    => 95,
                'title' => 'fee_head_edit',
            ],
            [
                'id'    => 96,
                'title' => 'fee_head_show',
            ],
            [
                'id'    => 97,
                'title' => 'fee_head_delete',
            ],
            [
                'id'    => 98,
                'title' => 'fee_head_access',
            ],
            [
                'id'    => 99,
                'title' => 'fee_structure_create',
            ],
            [
                'id'    => 100,
                'title' => 'fee_structure_edit',
            ],
            [
                'id'    => 101,
                'title' => 'fee_structure_show',
            ],
            [
                'id'    => 102,
                'title' => 'fee_structure_delete',
            ],
            [
                'id'    => 103,
                'title' => 'fee_structure_access',
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
                'title' => 'employee_management_access',
            ],
            [
                'id'    => 115,
                'title' => 'employee_type_create',
            ],
            [
                'id'    => 116,
                'title' => 'employee_type_edit',
            ],
            [
                'id'    => 117,
                'title' => 'employee_type_show',
            ],
            [
                'id'    => 118,
                'title' => 'employee_type_delete',
            ],
            [
                'id'    => 119,
                'title' => 'employee_type_access',
            ],
            [
                'id'    => 120,
                'title' => 'employee_create',
            ],
            [
                'id'    => 121,
                'title' => 'employee_edit',
            ],
            [
                'id'    => 122,
                'title' => 'employee_show',
            ],
            [
                'id'    => 123,
                'title' => 'employee_delete',
            ],
            [
                'id'    => 124,
                'title' => 'employee_access',
            ],
            [
                'id'    => 125,
                'title' => 'transport_vehicle_create',
            ],
            [
                'id'    => 126,
                'title' => 'transport_vehicle_edit',
            ],
            [
                'id'    => 127,
                'title' => 'transport_vehicle_show',
            ],
            [
                'id'    => 128,
                'title' => 'transport_vehicle_delete',
            ],
            [
                'id'    => 129,
                'title' => 'transport_vehicle_access',
            ],
            [
                'id'    => 130,
                'title' => 'country_create',
            ],
            [
                'id'    => 131,
                'title' => 'country_edit',
            ],
            [
                'id'    => 132,
                'title' => 'country_show',
            ],
            [
                'id'    => 133,
                'title' => 'country_delete',
            ],
            [
                'id'    => 134,
                'title' => 'country_access',
            ],
            [
                'id'    => 135,
                'title' => 'province_create',
            ],
            [
                'id'    => 136,
                'title' => 'province_edit',
            ],
            [
                'id'    => 137,
                'title' => 'province_show',
            ],
            [
                'id'    => 138,
                'title' => 'province_delete',
            ],
            [
                'id'    => 139,
                'title' => 'province_access',
            ],
            [
                'id'    => 140,
                'title' => 'postal_code_create',
            ],
            [
                'id'    => 141,
                'title' => 'postal_code_edit',
            ],
            [
                'id'    => 142,
                'title' => 'postal_code_show',
            ],
            [
                'id'    => 143,
                'title' => 'postal_code_delete',
            ],
            [
                'id'    => 144,
                'title' => 'postal_code_access',
            ],
            [
                'id'    => 145,
                'title' => 'address_create',
            ],
            [
                'id'    => 146,
                'title' => 'address_edit',
            ],
            [
                'id'    => 147,
                'title' => 'address_show',
            ],
            [
                'id'    => 148,
                'title' => 'address_delete',
            ],
            [
                'id'    => 149,
                'title' => 'address_access',
            ],
            [
                'id'    => 150,
                'title' => 'phone_create',
            ],
            [
                'id'    => 151,
                'title' => 'phone_edit',
            ],
            [
                'id'    => 152,
                'title' => 'phone_show',
            ],
            [
                'id'    => 153,
                'title' => 'phone_delete',
            ],
            [
                'id'    => 154,
                'title' => 'phone_access',
            ],
            [
                'id'    => 155,
                'title' => 'blood_group_create',
            ],
            [
                'id'    => 156,
                'title' => 'blood_group_edit',
            ],
            [
                'id'    => 157,
                'title' => 'blood_group_show',
            ],
            [
                'id'    => 158,
                'title' => 'blood_group_delete',
            ],
            [
                'id'    => 159,
                'title' => 'blood_group_access',
            ],
            [
                'id'    => 160,
                'title' => 'religion_create',
            ],
            [
                'id'    => 161,
                'title' => 'religion_edit',
            ],
            [
                'id'    => 162,
                'title' => 'religion_show',
            ],
            [
                'id'    => 163,
                'title' => 'religion_delete',
            ],
            [
                'id'    => 164,
                'title' => 'religion_access',
            ],
            [
                'id'    => 165,
                'title' => 'caste_create',
            ],
            [
                'id'    => 166,
                'title' => 'caste_edit',
            ],
            [
                'id'    => 167,
                'title' => 'caste_show',
            ],
            [
                'id'    => 168,
                'title' => 'caste_delete',
            ],
            [
                'id'    => 169,
                'title' => 'caste_access',
            ],
            [
                'id'    => 170,
                'title' => 'mark_attendance_create',
            ],
            [
                'id'    => 171,
                'title' => 'mark_attendance_edit',
            ],
            [
                'id'    => 172,
                'title' => 'mark_attendance_show',
            ],
            [
                'id'    => 173,
                'title' => 'mark_attendance_delete',
            ],
            [
                'id'    => 174,
                'title' => 'mark_attendance_access',
            ],
            [
                'id'    => 175,
                'title' => 'questions_bank_access',
            ],
            [
                'id'    => 176,
                'title' => 'question_create',
            ],
            [
                'id'    => 177,
                'title' => 'question_edit',
            ],
            [
                'id'    => 178,
                'title' => 'question_show',
            ],
            [
                'id'    => 179,
                'title' => 'question_delete',
            ],
            [
                'id'    => 180,
                'title' => 'question_access',
            ],
            [
                'id'    => 181,
                'title' => 'communication_centre_access',
            ],
            [
                'id'    => 182,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
