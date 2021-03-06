<?php

namespace App\Imports;
use Carbon\Carbon;
use App\Models\PersonImport;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class Hrdperson implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PersonImport([
            'ID' => $row['id'],
            'FINGLE_ID' => $row['fingle_id'],
            'HR_CID' => $row['hr_cid'],
            'HR_PREFIX_ID' => $row['hr_prefix_id'],
            'HR_FNAME' => $row['hr_fname'],
            'HR_LNAME' => $row['hr_lname'],
            'HR_EN_NAME' => $row['hr_en_name'],
            'PAY' => $row['pay'],
            'SEX' => $row['sex'],
            'HR_BLOODGROUP_ID' => $row['hr_bloodgroup_id'],
            'HR_MARRY_STATUS_ID' => $row['hr_marry_status_id'],
            'HR_BIRTHDAY' =>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['hr_birthday'])->format('Y-m-d'),
            'HR_PHONE' => $row['hr_phone'],
            'HR_EMAIL' => $row['hr_email'],
            'HR_FACEBOOK' => $row['hr_facebook'],
            'HR_LINE' => $row['hr_line'],
            'HR_HOME_NUMBER' => $row['hr_home_number'],
            'HR_VILLAGE_NO' => $row['hr_village_no'],
            'HR_ROAD_NAME' => $row['hr_road_name'],
            'HR_SOI_NAME' => $row['hr_soi_name'],
            'PROVINCE_ID' => $row['province_id'],
            'AMPHUR_ID' => $row['amphur_id'],
            'TUMBON_ID' => $row['tumbon_id'],
            'HR_VILLAGE_NAME' => $row['hr_village_name'],
            'HR_ZIPCODE' => $row['hr_zipcode'],
            'HR_RELIGION_ID' => $row['hr_religion_id'],
            'HR_NATIONALITY_ID' => $row['hr_nationality_id'],
            'HR_CITIZENSHIP_ID' => $row['hr_citizenship_id'],
            'HR_DEPARTMENT_ID' => $row['hr_department_id'],
            'HR_DEPARTMENT_SUB_ID' => $row['hr_department_sub_id'],
            'HR_POSITION_ID' => $row['hr_position_id'],
            'HR_FARTHER_NAME' => $row['hr_father_name'],
            'HR_FARTHER_CID' => $row['hr_father_cid'],
            'HR_MATHER_NAME' => $row['hr_mather_name'],
            'HR_MATHER_CID' => $row['hr_mather_cid'],
            'HR_STATUS_ID' => $row['hr_status_id'],
            'HR_LEVEL_ID' => $row['hr_level_id'],
            'HR_IMAGE' => $row['hr_image'],
            'HR_USERNAME' => $row['hr_username'],
            'HR_PASSWORD' => $row['hr_password'],
            'DATE_TIME_UPDATE' => $row['date_time_update'],
            'DATE_TIME_CREATE' => $row['date_time_create'],
            'HR_STARTWORK_DATE' =>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['hr_startwork_date'])->format('Y-m-d'),
            'HR_WORK_REGISTER_DATE' => $row['hr_work_register_date'],
            'HR_WORK_END_DATE' => $row['hr_work_end_date'],
            'HR_PIC' => $row['hr_pic'],
            'HR_POSITION_NUM' => $row['hr_position_num'],
            'HR_SALARY' => $row['hr_salary'],
            'MONEY_POSITION' => $row['money_position'],
            'IP_INSERT' => $row['ip_insert'],
            'IP_UPDATE' => $row['ip_update'],
            'PCODE' => $row['pcode'],
            'PERSON_TYPE' => $row['person_type'],
            'PCODE_MAIN' => $row['pcode_main'],
            'USER_TYPE' => $row['user_type'],
            'HR_HIGH' => $row['hr_high'],
            'HR_WEIGHT' => $row['hr_weight'],
            'PERMIS_ID' => $row['permis_id'],
            'VCODE' => $row['vcode_date'],
            'VCODE_DATE' =>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['vcode_date'])->format('Y-m-d'),
            'VGROUP_ID' => $row['vgroup_id'],
            'NICKNAME' => $row['nickname'],
            'HR_PERSON_TYPE_ID' => $row['hr_person_type_id'],
            'POSITION_IN_WORK' => $row['position_in_work'],
            'BOOK_BANK_NUMBER' => $row['book_bank_number'],
            'BOOK_BANK_NAME' => $row['book_bank_name'],
            'BOOK_BANK' => $row['book_bank'],
            'BOOK_BANK_BRANCH' => $row['book_bank_branch'],
            'HR_DATE_PUT' =>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['hr_date_put'])->format('Y-m-d'),
            'HR_HOME_NUMBER_1' => $row['hr_home_number_1'],
            'HR_HOME_NUMBER_2' => $row['hr_home_number_2'],
            'HR_ROAD_NAME_1' => $row['hr_road_name_1'],
            'HR_ROAD_NAME_2' => $row['hr_road_name_2'],
            'HR_VILLAGE_NO_1' => $row['hr_village_no_1'],
            'HR_VILLAGE_NO_2' => $row['hr_village_no_2'],
            'HR_VILLAGE_NAME_1' => $row['hr_village_name_1'],
            'HR_VILLAGE_NAME_2' => $row['hr_village_name_2'],
            'PROVINCE_ID_1' => $row['province_id_1'],
            'PROVINCE_ID_2' => $row['province_id_2'],
            'AMPHUR_ID_1' => $row['amphur_id_1'],
            'AMPHUR_ID_2' => $row['amphur_id_2'],
            'TUMBON_ID_1' => $row['tumbon_id_1'],
            'TUMBON_ID_2' => $row['tumbon_id_2'],
            'HR_ZIPCODE_1' => $row['hr_zipcode_1'],
            'HR_ZIPCODE_2' => $row['hr_zipcode_2'],
            'HR_HOME_PHONE_1' => $row['hr_home_phone_1'],
            'HR_HOME_PHONE_2' => $row['hr_home_phone_2'],
            'SAME_ADDR_1' => $row['same_addr_1'],
            'SAME_ADDR_2' => $row['same_addr_2'],
            'HR_BANK_ID' => $row['hr_bank_id'],
            'HR_FINGLE1' => $row['hr_fingle1'],
            'HR_FINGLE2' => $row['hr_fingle2'],
            'HR_FINGLE3' => $row['hr_fingle3'],
            'LICEN' => $row['licen'],
            'BOOK_BANK_OT_NUMBER' => $row['book_bank_ot_number'],
            'BOOK_BANK_OT_NAME' => $row['book_bank_ot_name'],
            'HR_BANK_OT_ID' => $row['hr_bank_ot_id'],
            'BOOK_BANK_OT' => $row['book_bank_ot'],
            'BOOK_BANK_OT_BRANCH' => $row['book_bank_ot_branch'],
            'MARRY_CID' => $row['marry_cid'],
            'MARRY_NAME' => $row['marry_name'],
            'HR_DEPARTMENT_SUB_SUB_ID' => $row['hr_department_sub_sub_id'],
            'HOS_USE_CODE' => $row['hos_use_code'],
            'HR_KIND_ID' => $row['hr_kind_id'],
            'HR_KIND_TYPE_ID' => $row['hr_kind_type_id'],
            'LINE_NAME' => $row['line_name'],
            'LINE_TOKEN' => $row['line_token'],
            'LINE_TOKEN1' => $row['line_token1'],
            'LINE_TOKEN2' => $row['line_token2'],
            'HR_IMAGE_NAME' => $row['hr_image_name'],
            'HR_AGENCY_ID' => $row['hr_agency_id'],
            'USERNAME' => $row['username'],
        ]);
    }
}
