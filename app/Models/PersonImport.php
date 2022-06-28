<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class PersonImport extends Model
{
    protected $table = 'hrd_person';
    protected $primaryKey = 'ID';
    protected $fillable = [
        'ID','FINGLE_ID','HR_CID',
        'HR_PREFIX_ID','HR_FNAME','HR_LNAME',
        'HR_EN_NAME','PAY','SEX','HR_BLOODGROUP_ID','HR_MARRY_STATUS_ID',
        'HR_BIRTHDAY',
        'HR_PHONE','HR_EMAIL','HR_FACEBOOK','HR_LINE','HR_HOME_NUMBER','HR_VILLAGE_NO','HR_ROAD_NAME',
        'HR_SOI_NAME','PROVINCE_ID','AMPHUR_ID','TUMBON_ID','HR_VILLAGE_NAME','HR_ZIPCODE','HR_RELIGION_ID',
        'HR_NATIONALITY_ID','HR_CITIZENSHIP_ID','HR_DEPARTMENT_ID','HR_DEPARTMENT_SUB_ID','HR_POSITION_ID','HR_FARTHER_NAME','HR_FARTHER_CID',
        'HR_MATHER_NAME','HR_MATHER_CID','HR_STATUS_ID','HR_LEVEL_ID','HR_IMAGE','HR_USERNAME','HR_PASSWORD',
        'DATE_TIME_UPDATE','DATE_TIME_CREATE','HR_STARTWORK_DATE','HR_WORK_REGISTER_DATE','HR_WORK_END_DATE','HR_PIC','HR_POSITION_NUM',
        'HR_SALARY','MONEY_POSITION','IP_INSERT','IP_UPDATE','PCODE','PERSON_TYPE','PCODE_MAIN',
        'USER_TYPE','HR_HIGH','HR_WEIGHT','PERMIS_ID','VCODE','VCODE_DATE','VGROUP_ID',
        'NICKNAME','HR_PERSON_TYPE_ID','POSITION_IN_WORK','BOOK_BANK_NUMBER','BOOK_BANK_NAME','BOOK_BANK','BOOK_BANK_BRANCH',
        'HR_DATE_PUT','HR_HOME_NUMBER_1','HR_HOME_NUMBER_2','HR_ROAD_NAME_1','HR_ROAD_NAME_2','HR_VILLAGE_NO_1','HR_VILLAGE_NO_2',
        'HR_VILLAGE_NAME_1','HR_VILLAGE_NAME_2','PROVINCE_ID_1','PROVINCE_ID_2','AMPHUR_ID_1','AMPHUR_ID_2','TUMBON_ID_1',
        'TUMBON_ID_2','HR_ZIPCODE_1','HR_ZIPCODE_2','HR_HOME_PHONE_1','HR_HOME_PHONE_2','SAME_ADDR_1','SAME_ADDR_2',
        'HR_BANK_ID','HR_FINGLE1','HR_FINGLE2','HR_FINGLE3','LICEN','BOOK_BANK_OT_NUMBER','BOOK_BANK_OT_NAME',
        'HR_BANK_OT_ID','BOOK_BANK_OT','BOOK_BANK_OT_BRANCH','MARRY_CID','MARRY_NAME','HR_DEPARTMENT_SUB_SUB_ID','HOS_USE_CODE',
        'HR_KIND_ID','HR_KIND_TYPE_ID','LINE_NAME','LINE_TOKEN','LINE_TOKEN1','LINE_TOKEN2','HR_IMAGE_NAME','HR_AGENCY_ID','USERNAME'
   ];
  
   public static function boot()
   {
       parent::boot();
       static::creating(function($model)
       {
        //    $user = new User();
        //    $user->PERSON_ID = $model->ID;
        //    $user->username = $model->USERNAME;
        //    $user->name = $model->HR_FNAME.' '.$model->HR_LNAME;
        //    $user->password = Hash::make('123456');
        //    $user->status = 'USER';
        //    $user->save();
        //    $user = Auth::user();          
        //    $model->PERSON_ID = $user->PERSON_ID;
        //    $model->DATEDO_WORK ? $model->DATEDO_WORK =  DateThaiToEn($model->DATEDO_WORK) : null;
        //    $model->DATEDO_EXIT ?  $model->DATEDO_EXIT  =  DateThaiToEn($model->DATEDO_EXIT) : null;

       });

       static::updating(function($model)
       {
        //    $user = Auth::user();
        //    $model->USER_EDIT_ID = $user->id;
        //    $model->DATEDO_WORK ? $model->DATEDO_WORK =  DateThaiToEn($model->DATEDO_WORK) : null;
        //    $model->DATEDO_EXIT ?  $model->DATEDO_EXIT  =  DateThaiToEn($model->DATEDO_EXIT) : null;
           
       });      
  }
}
