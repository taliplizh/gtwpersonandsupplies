@extends('layouts.backend')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />


@section('content')
<style>
.center {
  margin: auto;
  width: 100%;
  padding: 10px;
}
body {
      font-family: 'Kanit', sans-serif;
      font-size: 14px;
      }

      .form-control{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
            }

     label{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
            
      }   


      input::-webkit-calendar-picker-indicator{ 
  
    font-family: 'Kanit', sans-serif;
            font-size: 14px;
        
}     
</style>
<script>
    function checklogin(){
     window.location.href = '{{route("index")}}'; 
    }
    </script>
<?php
if(Auth::check()){
    $status = Auth::user()->status;
    $id_user = Auth::user()->PERSON_ID;   
}else{    
    echo "<body onload=\"checklogin()\"></body>";
    exit();
} 
$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos); 


?>
<?php
function RemoveDateThai($strDate)
{
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth= date("n",strtotime($strDate));
  $strDay= date("j",strtotime($strDate));

  $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
  $strMonthThai=$strMonthCut[$strMonth];
  return "$strDay $strMonthThai $strYear";
  }


  function Removeformate($strDate)
{
  $strYear = date("Y",strtotime($strDate));
  $strMonth= date("m",strtotime($strDate));
  $strDay= date("d",strtotime($strDate));

  return $strDay."/".$strMonth."/".$strYear;
  }

  
?>
<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
          
            }
            .form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
            }

                .table-fixed tbody {
        height: 300px;
        overflow-y: auto;
        width: 100%;
    }

    .table-fixed thead,
    .table-fixed tbody,
    .table-fixed tr,
    .table-fixed td,
    .table-fixed th {
        display: block;
    }

    .table-fixed tbody td,
    .table-fixed tbody th,
    .table-fixed thead > tr > th {
        float: left;
        position: relative;

        &::after {
            content: '';
            clear: both;
            display: block;
        }
    }
</style>


<body onload="vehicle_edit();run01();";>
           
                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="content">
                <div class="block block-rounded block-bordered">

            
                <div class="block-content">    
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อมูลการอบรม {{$id}}</h2> 
                        

    <form action="{{ route('perdev.update',['iduser'=>  $inforpersonuserid->ID]) }}" method="post" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="ID" id="ID" class="form-control input-lg" value="{{$id}}" >

        <div class="row push">
        <div class="col-sm-2">
        <label>ตามหนังสือ :</label>
        </div> 
        <div class="col-lg-8 detali_bookname">
                <input type="hidden" name="BOOK_ID" id="BOOK_ID" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" value="{{$infoindex->BOOK_ID}}" >
                <input name="BOOK_NAME" id="BOOK_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoindex->BOOK_NAME}}" >
                
    </div>  
        <div class="col-lg-2">
                <button type="button" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target=".addbook"  >หนังสืออ้างถึง</button>
        </div> 
        </div>
       
        <div class="row push">
        <div class="col-sm-2">
        <label>เลขที่หนังสือ :</label>
        </div> 
        <div class="col-lg-5 detali_booknum">
                <input name="BOOK_NUM" id="BOOK_NUM"  value="{{$infoindex->BOOK_NUM}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
       
    </div>  
        <div class="col-sm-1">
        <label>ลงวันที่ :</label>
       
        </div>
        <div class="col-lg-4 detali_bookdate">
              @if($infoindex->BOOK_DATE_REG !== '' && $infoindex->BOOK_DATE_REG !== null)
                <input name="BOOK_DATE_REG" id="BOOK_DATE_REG" value="{{formate($infoindex->BOOK_DATE_REG)}}" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" readonly>
              @else
                <input name="BOOK_DATE_REG" id="BOOK_DATE_REG"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" readonly>
              @endif
        </div> 
       </div>
       <div class="row push">
       <div class="col-sm-2">
        <label>หัวข้อประชุม :</label>
        </div> 
        <div class="col-lg-10">
        <input name="RECORD_HEAD_USE" id="RECORD_HEAD_USE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoindex->RECORD_HEAD_USE}}" onchange="check_record_head_use();">
        <div style="color: red;font-size: 16px;" id="record_head_use"></div>
    </div> 
       </div>
       <div class="row push">
       <div class="col-sm-2">
        <label>สถานที่จัดประชุม :</label>
        </div> 
        <div class="col-lg-5">
        <select name="RECORD_LOCATION_ID" id="RECORD_LOCATION_ID" class="form-control input-lg location_re" style=" font-family: 'Kanit', sans-serif;" onchange="check_record_location_id();">
        <option value="" selected>--กรุณาเลือกสถานที่--</option>
                            @foreach ($locations as $location)
                            @if($infoindex->RECORD_LOCATION_ID == $location -> LOCATION_ID)
                            <option value="{{ $location -> LOCATION_ID }}" selected>{{ $location -> LOCATION_ORG_NAME }}</option>  
                            @else                    
                            <option value="{{ $location -> LOCATION_ID }}">{{ $location -> LOCATION_ORG_NAME }}</option>  
                            @endif         
                            @endforeach 
        </select> 
        <div style="color: red; font-size: 16px;" id="record_location_id"></div>    
        </div>
        <div class="col-sm-4">
        <input name="ADD_RECORD_LOCATION" id="ADD_RECORD_LOCATION" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif; background-color: #CCFFFF;" placeholder="ระบุถานที่หากต้องการเพิ่ม">
        </div> 
        <div class="col-lg-1">
        <a class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;color:#FFFFFF;" onclick="addlocation();"><i class="fas fa-plus"></i> เพิ่ม</a>
        </div> 
        <!--<input list="RECORD_LOCATION_ID" name="RECORD_LOCATION_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                <datalist id="RECORD_LOCATION_ID">
                            @foreach ($locations as $location)                    
                            <option value="{{ $location -> LOCATION_ORG_NAME }}">           
                            @endforeach 
                    </datalist>
        </div>--> 
        
        </div>

       <div class="row push">

       <div class="col-sm-2">
        <label>จังหวัด :</label>
        </div> 
        <div class="col-lg-5">
        <select name="PROVINCE_ID" id="PROVINCE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="check_province_id();">
        <option value="" selected>--เลือกจังหวัด-- {{$infoindex->PROVINCE_ID}}</option>
            @foreach ($infoprovinces as $infoprovince)
                  @if($infoindex_pro->PROVINCE_ID == $infoprovince -> ID)
                  <option value="{{ $infoprovince -> ID }}" selected>{{ $infoprovince -> PROVINCE_NAME }}</option>     
                  @else     
                    <option value="{{ $infoprovince -> ID }}">{{ $infoprovince -> PROVINCE_NAME }}</option>                   
                    @endif
            @endforeach 
        </select> 
        <div style="color: red; font-size: 16px;" id="province_id"></div>    
        </div> 
        <div class="col-sm-1">
        <label>ระดับ :</label>
        </div> 
        <div class="col-lg-4">
        <select name="RECORD_LEVEL_ID" id="RECORD_LEVEL_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="checklevel_id();">
        <option value="" selected>--เลือกระดับ--</option>
            @foreach ($levels as $level)
          
                  @if($infoindex->RECORD_LEVEL_ID == $level -> ID)
                  <option value=" {{ $level -> ID }}" selected>{{ $level -> RECORD_LEVEL_NAME }}</option>   
                  @else
                  <option value=" {{ $level -> ID }}">{{ $level -> RECORD_LEVEL_NAME }}</option>   
                  @endif
                
        
            @endforeach 
        </select> 
        <div style="color: red; font-size: 16px;" id="level_id"></div>   
        </div> 
       </div>

      


       <div class="row push">
       <div class="col-sm-2">
        <label>ประเภท :</label>
        </div> 
        <div class="col-lg-5">
        <select name="RECORD_TYPE_ID" id="RECORD_TYPE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="check_record_type_id()">
        <option value="" selected>--กรุณาเลือกประเภท-</option>
            @foreach ($types as $type)
                @if($infoindex->RECORD_TYPE_ID == $type -> RECORD_TYPE_ID)             
                <option value=" {{ $type -> RECORD_TYPE_ID }}" selected>{{ $type -> RECORD_TYPE_NAME }}</option>                   
                @else
                <option value=" {{ $type -> RECORD_TYPE_ID }}">{{ $type -> RECORD_TYPE_NAME }}</option> 
                @endif
            @endforeach 
        </select> 
        <div style="color: red; font-size: 16px;" id="record_type_id" ></div>   
        </div> 
        <div class="col-xs-6 col-sm-4 col-lg-2">
        <label>ประเภทสถานที่ประชุม :</label>
        </div> 
        <div class="col-sm-3 text-left">
        <select name="LOCATION_PROV_ID" id="LOCATION_PROV_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="check_location_prov_id()">
        <option value="" selected>--กรุณาเลือกสถานที่-</option>
            @foreach ($type_locations as $type_location)
            @if($infoindex->LOCATION_PROV_ID == $type_location -> LOCATION_ID)                  
            <option value=" {{ $type_location -> LOCATION_ID }}" selected>{{ $type_location -> LOCATION_NAME }}</option>                   
            @else
            <option value=" {{ $type_location -> LOCATION_ID }}">{{ $type_location -> LOCATION_NAME }}</option>  
            @endif

            @endforeach 
        </select> 
        <div style="color: red; font-size: 16px;" id="location_prov_id" ></div>    
        </div> 
       </div>
       <div class="row push">
       <div class="col-sm-2">
        <label>หน่วยงานที่จัด :</label>
        </div> 
        <div class="col-lg-5">
        
        <select name="RECORD_ORG_ID" id="RECORD_ORG_ID" class="form-control input-lg org_re" style=" font-family: 'Kanit', sans-serif;" onchange="check_record_org_id();">
        <option value="" selected>--กรุณาเลือกหน่วยงาน--</option>
                            @foreach ($orgs as $org)   
                            @if($infoindex->RECORD_ORG_ID == $org -> RECORD_ORG_ID) 
                            <option value="{{ $org -> RECORD_ORG_ID }}" selected>{{ $org -> RECORD_ORG_NAME }}</option>    
                            @else
                            <option value="{{ $org -> RECORD_ORG_ID }}">{{ $org -> RECORD_ORG_NAME }}</option>   
                            @endif                 
                                    
                            @endforeach 
        </select> 
        <div style="color: red; font-size: 16px;" id="record_org_id" ></div>   
       </div>
       <div class="col-sm-4">
        <input name="ADD_RECORD_ORG" id="ADD_RECORD_ORG" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif; background-color: #CCFFFF;" placeholder="ระบุหน่วยงานหากต้องการเพิ่ม">
        </div> 
        <div class="col-lg-1">
        <a class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;color:#FFFFFF;" onclick="addorg();"><i class="fas fa-plus"></i> เพิ่ม</a>
        </div> 
       </div>

       <div class="row push">
       <div class="col-sm-2">
        <label>ระหว่างวันที่ :</label>
        </div> 
        <div class="col-lg-2">
        <input name="DATE_GO" id="DATE_GO" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" value="{{ formate($infoindex->DATE_GO)}}" readonly>
        </div> 
        <div class="col-sm-1">
        <label>ถึงวันที่ :</label>
        </div> 
        <div class="col-lg-2">
        <input name="DATE_BACK" id="DATE_BACK" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" value="{{ formate($infoindex->DATE_BACK)}}" readonly>
        </div> 
        <div class="col-sm-1">
        <label>ประเภท :</label>
        </div> 
        <div class="col-lg-4">
        <select name="DAY_TYPE_ID" id="DAY_TYPE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="check_day_type_id();">
            @foreach ($day_types as $day_type) 
            @if($infoindex->DAY_TYPE_ID == $day_type -> DAY_TYPE_ID)                         
            <option value=" {{ $day_type -> DAY_TYPE_ID }}" selected>{{ $day_type -> DAY_TYPE_NAME }}</option>
            @else
            <option value=" {{ $day_type -> DAY_TYPE_ID }}">{{ $day_type -> DAY_TYPE_NAME }}</option>
            @endif                       
            @endforeach 
        </select>  
        <div style="color: red; font-size: 16px;" id="daytype"></div>   
        </div> 
       </div>

       <div class="row push">
       <div class="col-sm-2">
        <label>วันเดินทาง :</label>
        </div> 
        <div class="col-lg-2">
        <input name="DATE_TRAVEL_GO" id="DATE_TRAVEL_GO" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" value="{{ formate($infoindex->DATE_TRAVEL_GO)}}" readonly>
        </div> 
        <div class="col-sm-1">
        <label>ถึงวันที่ :</label>
        </div> 
        <div class="col-lg-2">
        <input name="DATE_TRAVEL_BACK" id="DATE_TRAVEL_BACK" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" value="{{ formate($infoindex->DATE_TRAVEL_BACK)}}" readonly>
        </div> 
        <div class="col-sm-1">
        <label>ลักษณะ :</label>
        </div> 
        <div class="col-lg-4">
        <select name="RECORD_GO_ID" id="RECORD_GO_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="check_record_go_id();">
        <option value="" selected>--กรุณาเลือกลักษณะการไป-</option>
            @foreach ($gos as $go)
            @if($infoindex->RECORD_GO_ID == $go -> RECORD_GO_ID)                   
            <option value=" {{ $go -> RECORD_GO_ID }}" selected>{{ $go -> RECORD_GO_NAME }}</option>                   
            @else
            <option value=" {{ $go -> RECORD_GO_ID }}">{{ $go -> RECORD_GO_NAME }}</option>   
            @endif
            @endforeach 
        </select> 
        <div style="color: red; font-size: 16px;" id="record_go_id"></div>    
        </div> 
       </div>

       <div class="row push">
       <div class="col-sm-2">
        <label>พาหนะเดินทาง :</label>
        </div> 
        <div class="col-lg-5">
        <select name="RECORD_VEHICLE_ID" id="RECORD_VEHICLE_ID" onchange="check_record_vehicle_id();vehicle_edit();" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;"  >
        <option value="" selected>--กรุณาเลือกพาหนะเดินทาง--</option>
            @foreach ($vehicles as $vehicle)
            @if($infoindex->RECORD_VEHICLE_ID == $vehicle -> RECORD_VEHICLE_ID)                 
            <option value=" {{ $vehicle -> RECORD_VEHICLE_ID }}" selected>{{ $vehicle -> RECORD_VEHICLE_NAME }}</option>                   
            @else
            <option value=" {{ $vehicle -> RECORD_VEHICLE_ID }}">{{ $vehicle -> RECORD_VEHICLE_NAME }}</option>  
            @endif

            @endforeach 
        </select> 
        <div style="color: red; font-size: 16px;" id="record_vehicle_id" >
       
        </div>    
       </div>
      
        <div class="vehicle_re">
        <input  type="hidden" name ="CAR_REG" id="CAR_REG" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >
        </div>  
       
     
       </div>
       <div class="row push">
       <div class="col-sm-2">
        <label>การเบิกเงิน :</label>
        </div> 
        <div class="col-lg-4">
        <select name="RECORD_MONEY_ID" id="RECORD_MONEY_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="check_record_money_id();">
        <option value="" selected>--กรุณาเลือกประเภทการเบิกเงิน--</option>
                @foreach ($withdraws as $withdraw)
                @if($infoindex->RECORD_MONEY_ID == $withdraw ->WITHDRAW_ID)
                <option value="{{ $withdraw ->WITHDRAW_ID  }}" selected>{{ $withdraw->WITHDRAW_NAME}}</option>
                @else
                <option value="{{ $withdraw ->WITHDRAW_ID  }}">{{ $withdraw->WITHDRAW_NAME}}</option>
                @endif                                                     
                        
                @endforeach 
         
        </select>
        <div style="color: red; font-size: 16px;" id="record_money_id" ></div>         
       </div>
       <div class="col-sm-2">
        <label>หมายเหตุ :</label>
        </div> 
        <div class="col-lg-4">
        <input name="RECORD_COMMENT" id="RECORD_COMMENT" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $infoindex->RECORD_COMMENT }}">     
       </div>
       </div>
       <div class="row push">
       <div class="col-sm-2">
        <label>หัวหน้าฝ่าย :</label>
        </div> 
        <div class="col-lg-4">
        <select name="LEADER_HR_ID" id="LEADER_HR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                    
                    @foreach ($leader_alls as $leader_all)   
                            @if($infoindex->LEADER_HR_ID == $leader_all ->LEADER_ID)                                                  
                                    <option value="{{ $leader_all ->LEADER_ID  }}" selected>{{ $leader_all->HR_FNAME}} {{$leader_all->HR_LNAME}}</option>
                             @else 
                                    <option value="{{ $leader_all ->LEADER_ID  }}">{{ $leader_all->HR_FNAME}} {{$leader_all->HR_LNAME}}</option>
                             @endif      

                    @endforeach 
                </select>    
       </div>
       
     
       <div class="col-sm-2">
        <label>มอบหมายงานให้ :</label>
        </div> 
        <div class="col-lg-4">
        <select name="OFFER_WORK_HR_ID" id="OFFER_WORK_HR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="check_offer_work_hr_id();checkall();">
                    <option value="">--กรุณาเลือกผู้มอบหมายงานให้--</option>
                        @foreach ($LEAVEWORK_SENDs as $LEAVEWORK_SEND) 
                        @if($infoindex->OFFER_WORK_HR_ID == $LEAVEWORK_SEND ->ID)  
                        <option value="{{ $LEAVEWORK_SEND ->ID  }}" selected>{{ $LEAVEWORK_SEND->HR_FNAME}} {{$LEAVEWORK_SEND->HR_LNAME}}</option>
                        @else 
                        <option value="{{ $LEAVEWORK_SEND ->ID  }}">{{ $LEAVEWORK_SEND->HR_FNAME}} {{$LEAVEWORK_SEND->HR_LNAME}}</option>
                        @endif

                        @endforeach 
                    </select>  
                    <div style="color: red; font-size: 16px;" id="offer_work_hr_id" ></div>   
       </div>
       </div>

       <div class="row push">
                                        <div class="col-sm-2">
                                        &nbsp; &nbsp;
                                        </div> 
                                        <div class="col-sm-2">
                                        @if($infoindex->DR_PROVINCE_USE == 'true')
                                        <input type="checkbox" id="DR_PROVINCE_USE" name="DR_PROVINCE_USE" value="true" checked>
                                        @else
                                        <input type="checkbox" id="DR_PROVINCE_USE" name="DR_PROVINCE_USE" value="true">
                                        @endif
                                        
                                        อนุมัติโดยนายแพทย์ สสจ.
                                        </div> 
                                    </div> 
       
       <div class="row push">
                        <div class="col-lg-12">
                            <!-- Block Tabs Default Style -->
                            <div class="block block-rounded block-bordered">
                                <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #FFEBCD;">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">คณะเดินทาง</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object2" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">สมรรถนะที่ได้</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object3" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">สาขาที่เกี่ยวข้อง</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object4" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">การเดินทาง</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object5" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ค่าใช้จ่ายครั้งนี้</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object6" style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;">บันทึกขอใช้รถยนต์</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object7" style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;">บันทึกผู้อำนวยการ</a>
                                    </li>
                                  
                                </ul>
                                <div class="block-content tab-content">
                                    <div class="tab-pane active" id="object1" role="tabpanel">
                                      
                                     <table class="table gwt-table" >
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;">ชื่อ สกุล</td>
                                                <td style="text-align: center;" width="30%">ตำแหน่ง</td>
                                                <td style="text-align: center;" width="15%">ระดับ</td>
                                                <td style="text-align: center;" width="12%"><a  class="btn btn-success addRow" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody1"> 
                                        <?php $checkper = 0; ?>
                                    @foreach ($infoconcludepersons as $infoconcludeperson)  
                                    <tr>
                                        <td> 
                                        <select name="PERSON_ID[]" id="PERSON_ID{{$checkper}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="checkposition({{$checkper}});checklevel({{$checkper}})">
                                        <option value="">--กรุณาเลือกผู้ร่วมเดินทาง--</option>
                                                            @foreach ($PERSONALLs as $PERSONALL) 
                                                            @if($infoconcludeperson->HR_PERSON_ID == $PERSONALL ->ID)                                                    
                                                                <option value="{{ $PERSONALL ->ID  }}" selected>{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}</option>
                                                            @else
                                                                <option value="{{ $PERSONALL ->ID  }}">{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}</option>
                                                            @endif
                                                            @endforeach 
                                         </select>    
                                        </td>
                                        <td><div class="showposition{{$checkper}}"></div></td>
                                        <td><div class="showlevel{{$checkper}}"></div></td>
                                        <td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>
                                    <?php $checkper++; ?>
                                    @endforeach 

                                    </tbody>   
                                    </table>


                                    </div>
                                    <div class="tab-pane" id="object2" role="tabpanel">
                                    <table class="table gwt-table" >
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;">สมรรถนะที่ได้รับในครั้งนี้</td>
     
                                                <td style="text-align: center;" width="15%"><a  class="btn btn-success addRow2" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody2"> 
                                        @foreach ($infocapacitys as $infocapacity)     
                                    <tr>
                                        <td> 
                                        <select name="RECORD_CAPACITY_ID[]" id="RECORD_CAPACITY_ID[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                        <option value="">--กรุณาเลือกสมรรถนะ--</option>
                                                            @foreach ($capacitys as $capacity) 
                                                            @if( $infocapacity->RECORD_CAPACITY_ID == $capacity ->RECORD_CAPACITY_ID)
                                                            <option value="{{ $capacity ->RECORD_CAPACITY_ID  }}" selected>{{ $capacity->RECORD_CAPACITY_NAME}}</option>           
                                                            @else
                                                            <option value="{{ $capacity ->RECORD_CAPACITY_ID  }}">{{ $capacity->RECORD_CAPACITY_NAME}}</option>
                                                            @endif                                                    
                                                               
                                                            @endforeach 
                                         </select>    
                                        </td>
                                     
                                        <td style="text-align: center;"><a class="btn btn-danger remove2" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>
                                    @endforeach 
                                    </tbody>   
                                    </table>
                                    </div>
                                    <div class="tab-pane" id="object3" role="tabpanel">
                                       
                                        <table class="table gwt-table" >
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;">สาขาที่เกี่ยวข้องกับการไปครั้งนี้</td>
     
                                                <td style="text-align: center;" width="15%"><a  class="btn btn-success addRow3" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody3"> 
                                        @foreach ($infobranchs as $infobranch)     
                                    <tr>
                                        <td> 
                                        <select name="RECORD_BRANCH_ID[]" id="RECORD_BRANCH_ID[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                        <option value="">--กรุณาเลือกสาขา--</option>
                                                            @foreach ($branchs as $branch)
                                                            @if($infobranch->RECORD_BRANCH_ID==$branch ->RECORD_BRANCH_ID)
                                                                <option value="{{ $branch ->RECORD_BRANCH_ID  }}" selected>{{ $branch->RECORD_BRANCH_NAME}}</option>
                                                            @else
                                                                <option value="{{ $branch ->RECORD_BRANCH_ID  }}">{{ $branch->RECORD_BRANCH_NAME}}</option>
                                                            @endif                                                     
                                                              
                                                            @endforeach 
                                         </select>    
                                        
                                        </td>
                                     
                                        <td style="text-align: center;"><a class="btn btn-danger remove3" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>
                                    @endforeach 
                                    </tbody>   
                                    </table>
                                    </div>
                                    <div class="tab-pane" id="object4" role="tabpanel">

                                    <div class="row push">
                                                <div class="col-sm-3 text-left">
                                                <label>เดินทางออกจาก รพ./บ้านพัก เลขที่ :</label>
                                                </div>
                                                <div class="col-sm-2">
                                                <input name="FROM_BAN_NUM" id="FROM_BAN_NUM" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoindex->FROM_BAN_NUM}}">
                                                </div> 
                                                <div class="col-sm-1">
                                                <label>จังหวัด :</label>
                                                </div>
                                                <div class="col-sm-2">
                                                <select name="FROM_PROVINCE_ID" id="FROM_PROVINCE_ID" class="form-control input-lg provice" style=" font-family: 'Kanit', sans-serif;" >
                                                       
                                                       <option value=" ">--เลือกจังหวัด--</option>
                                                       @foreach ($infoprovinces as $infoprovince)                               
                                                                @if($infoindex->FROM_PROVINCE_ID == $infoprovince -> ID)
                                                                <option value=" {{ $infoprovince -> ID }}" selected>{{ $infoprovince -> PROVINCE_NAME }}</option>
                                                                @else
                                                                <option value=" {{ $infoprovince -> ID }}" >{{ $infoprovince -> PROVINCE_NAME }}</option>
                                                                @endif
                                                              
       
                                                       @endforeach         
                                                       </select>
                                                </div> 
                                                <div class="col-sm-1">
                                                <label>อำเภอ :</label>
                                                </div>
                                                <div class="col-sm-3 text-left">
                                                <select name="FROM_AMPHUR_ID" id="FROM_AMPHUR_ID" class="form-control input-lg amphures" style=" font-family: 'Kanit', sans-serif;" >
                                                        <option value="">--กรุณาเลือกอำเภอ--</option>
                                                        <option value="{{$infoindex->FROM_AMPHUR_ID}}" selected>{{ $infoindex -> AMPHUR_NAME }}</option>
                                                        </select>
                                                </div>        
                                              
                                    </div>
                                    
                                    <div class="row push">
                                                <div class="col-sm-1">
                                                <label>ตำบล :</label>
                                                </div>
                                                <div class="col-sm-4">
                                                <select name="FROM_TAMBON_ID" id="FROM_TAMBON_ID" class="form-control input-lg tumbon" style=" font-family: 'Kanit', sans-serif;" >
                                                        <option value="">--กรุณาเลือกตำบล--</option>
                                                        <option value="{{$infoindex->FROM_TAMBON_ID}}" selected>{{ $infoindex -> TUMBON_NAME }}</option>
                                                        </select>
                                                </div> 
                                  
                                                <div class="col-sm-1">
                                                <label>เวลา :</label>
                                                </div>
                                                <div class="col-sm-2">
                                                <input type="text" class="js-masked-time form-control" id="FROM_TIME" name="FROM_TIME" value="{{ $infoindex->FROM_TIME}}" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00">
                                                </div> 

                                               
                                    </div>
                                 
                                    <div class="row push">
                                                <div class="col-sm-3 text-left">
                                                <label>เดินทางกลับถึง รพ./บ้านพัก เลขที่ :</label>
                                                </div>
                                                <div class="col-sm-2">
                                                <input name="BACK_BAN_NUM" id="BACK_BAN_NUM" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $infoindex_back->BACK_BAN_NUM}}">
                                                </div> 
                                                <div class="col-sm-1">
                                                <label>จังหวัด :</label>
                                                </div>
                                                <div class="col-sm-2">
                                                <select name="BACK_PROVINCE_ID" id="BACK_PROVINCE_ID" class="form-control input-lg provice_sub" style=" font-family: 'Kanit', sans-serif;"  >
                                                <option value=" ">--เลือกจังหวัด--</option>
                                                                        
                 
                                                 @foreach ($infoprovinces as $infoprovince)                               
                                                                @if($infoindex_back->BACK_PROVINCE_ID == $infoprovince -> ID)
                                                                <option value=" {{ $infoprovince -> ID }}" selected>{{ $infoprovince -> PROVINCE_NAME }}</option>
                                                                @else
                                                                <option value=" {{ $infoprovince -> ID }}" >{{ $infoprovince -> PROVINCE_NAME }}</option>
                                                                @endif
                                                              
       
                                                       @endforeach         
        
                                                  
                                                </select>


                                                </div> 
                                                <div class="col-sm-1">
                                                <label>อำเภอ :</label>
                                                </div>
                                                <div class="col-sm-3 text-left">
                                                <select name="BACK_AMPHUR_ID" id="BACK_AMPHUR_ID" class="form-control input-lg amphures_sub" style=" font-family: 'Kanit', sans-serif;" >
                                                <option value="">--กรุณาเลือกอำเภอ--</option>
                                                
                                                <option value="{{$infoindex_back->BACK_AMPHUR_ID}}" selected>{{ $infoindex_back -> AMPHUR_NAME }}</option>
                                                
                                                </select>
                                                </div> 
                                    </div>
                                    <div class="row push">
                                    <div class="col-sm-1">
                                                <label>ตำบล :</label>
                                                </div>
                                                <div class="col-sm-4">
                                                <select name="BACK_TAMBON_ID" id="BACK_TAMBON_ID" class="form-control input-lg tumbon_sub" style=" font-family: 'Kanit', sans-serif;" >
                                                <option value="">--กรุณาเลือกตำบล--</option>
                                                <option value="{{$infoindex->BACK_TAMBON_ID}}" selected>{{ $infoindex_back -> TUMBON_NAME }}</option>
                                                </select>
                                                </div> 
                                  
                                    <div class="col-sm-1">
                                                <label>เวลา :</label>
                                                </div>
                                                <div class="col-sm-2">
                                               
                                                <input type="text" class="js-masked-time form-control" id="BACK_TIME" name="BACK_TIME" value="{{ $infoindex->BACK_TIME}}" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00" >
                                            </div> 
                                    </div>
                                    <div class="row push">
                                        <div>
                                            <label>&nbsp;&nbsp;ระยะไปกลับ : </label>
                                        </div>
                                        <div class="col-sm-2">
                                        <input name="DISTANCE" id="DISTANCE" value="{{$infoindex->DISTANCE}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" placeholder="ระบุกิโลเมตร" OnKeyPress="return chkNumber(this);" onkeyup="showdistance();showdistancemon();">
                                        
                                        </div>
                                       
                                    </div>
                                        
                                    </div>
                                    <div class="tab-pane" id="object5" role="tabpanel">
                                    <div class="row push">
                                    <div class="col-sm-2">
                                    <label>รวมเป็นเงิน </label>
                                    </div>
                                    <div class="col-sm-1">   
                                    <label> <div id="money">0</div></label> 
                                    </div>
                                    <div class="col-sm-1">
                                    <label>บาท</label>
                                    </div>
                                    </div>
                                    <table class="table gwt-table">
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;">รายการ</td>
                                                <td style="text-align: center;" width="20%">จำนวนวัน</td>
                                                <td style="text-align: center;" width="15%" >จำนวนเงิน</td>
                                                <td style="text-align: center;" width="12%"><a  class="btn btn-success addRow5" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody5">
                                        @foreach ($infoconcludemoneys as $infoconcludemoney)    
                                    <tr>
                                       <td> <select name="MONEY_ID[]" id="MONEY_ID[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                        
                                                            @foreach ($moneysets as $moneyset)  
                                                                @if($infoconcludemoney->MONEY_ID == $moneyset ->MONEY_ID)
                                                                <option value="{{ $moneyset ->MONEY_ID  }}" selected>{{ $moneyset->MONEY_NAME}}</option>
                                                                @else
                                                                <option value="{{ $moneyset ->MONEY_ID  }}">{{ $moneyset->MONEY_NAME}}</option>
                                                                @endif                                                   
                                                               
                                                            @endforeach 
                                         </select> </td>  
                                        <td> <input name="SUMDAY[]" id="SUMDAY[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ number_format($infoconcludemoney->SUMDAY)}}"></td>
                                        <td> <input name="SUMMONEY[]" id="SUMMONEY[]" class="form-control input-lg items" style=" font-family: 'Kanit', sans-serif;" value="{{$infoconcludemoney->SUMMONEY}}" onkeyup="callmoney()"></td>
                                        <td style="text-align: center;"><a class="btn btn-danger remove5" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>
                                    @endforeach 
                                    </tbody>   
                                    </table>

                                  

                                    </div>
                                    <div class="tab-pane" id="object6" role="tabpanel">
                                    <div class="row push">
                                                <div class="col-sm-2">
                                                <label >ยี่ห้อรถ :</label>
                                                </div>
                                                <div class="col-sm-2">
                                                <input name="" id="" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                </div> 
                                             
                                                <div class="col-sm-2">
                                                <label style="float:right;">ระยะทางจาก :</label>
                                                </div>
                                                <div class="col-sm-2">
                                                <input name="" id="" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                </div> 
                                                <div>
                                                <label>ถึง</label>
                                                </div>
                                                <div class="col-sm-2">
                                               <input name="" id="" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                </div> 
                                    </div>
                                    <div class="row push">
                                                <div class="col-sm-1">
                                                <label >ระยะทาง :</label>
                                                </div>
                                                <div class="col-sm-1">
                                                <div id="distance" style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;"></div>
                                                </div>
                                                <div class="col-sm-2">
                                                <label >กิโลเมตร  กิโลเมตรละ</label>
                                                </div> 
                                                <div class="col-sm-1">
                                                <input name="UNITDIS" id="UNITDIS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="showdistancemon();">
                                                </div>
                                                <div class="col-sm-1">
                                                <label >บาท</label>
                                                </div> 

                                                <div class="col-sm-2">
                                                <label style="float:right;" >จำนวนเงิน :</label>
                                                </div>
                                                <div class="col-sm-3 text-left">
                                               <div id="moneydistance" style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;"></div>
                                                </div> 
                                                <div class="col-sm-1">
                                                <label >บาท</label>
                                                </div> 
                                    </div> 
                                

                                  
                              
                                   </div>
                                    <div class="tab-pane" id="object7" role="tabpanel">
                                       
                                        <textarea rows="4" cols="50" class="form-control" style=" font-family: 'Kanit', sans-serif;background-color: #F0F8FF;">

                                        </textarea>
                                        <br>
                                    </div>
                                   
                                </div>
                            </div>
        </div>

       </div>


       <input type="hidden" name ="PERSON_ID_CREATE" id="PERSON_ID_CREATE" class="form-control input-lg" value="{{$inforpersonuserid -> ID }}">

        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกแก้ไขข้อมูล</button>
        <a href="{{ url('person_dev/persondevinfo/'.$inforpersonuserid -> ID)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไข ?')" >ยกเลิก</a>
        </div>

       
        </div>
        </form>  


     <!--    เมนูเลือก   -->
       
     <div class="modal fade addbook" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalbook">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">          
                        <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">เลือกหนังสืออ้างถึง</h2>
                    </div>
                <div class="modal-body">
            <body>
                <div class="container mt-3">
                    <input class="form-control" id="myInput" type="text" placeholder="Search..">
            <br>
                    <div style='overflow:scroll; height:300px;'>
                    <table class="table">
                        <thead>
                            <tr>
                                <td style="text-align: center;" width="20%">เลขที่หนังสือ</td>
                                <td style="text-align: center;">หนังสือ</th>
                                <td style="text-align: center;" width="15%">ลงวันที่</td>
                                <td style="text-align: center;" width="5%">เลือก</td>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @foreach ($books as $book) 
                                <tr>
                                    <td >{{$book->BOOK_NUMBER}}</td>
                                    <td >{{$book->BOOK_NAME}}</td>
                                    <td >{{DateThai($book->BOOK_DATE)}}</td>                                
                                    <td >
                                         <button type="button" class="btn btn-hero-sm btn-hero-info"    onclick="selectbook({{$book->BOOK_ID}});">เลือก</button> 
                                        {{-- <button type="button" class="btn btn-hero-sm btn-hero-info"   >เลือก</button> --}}
                                    </td>
                                </tr>
                            @endforeach   
                        </tbody>
                    </table>    
                </div>
            </div>
            </div>
                <div class="modal-footer">
                    <div align="right">
                            <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" >ปิดหน้าต่าง</button>
                    </div>
                </div>
            </body>
        </div>
      </div>
    </div>  
       
               
                      

@endsection

@section('footer')



<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>
<script>
     function check_record_head_use()
        {        
            record_head_use  = document.getElementById("RECORD_HEAD_USE").value;             
                if (record_head_use==null || record_head_use==''){
                document.getElementById("record_head_use").style.display = "";     
                text_record_head_use = "*กรุณาระบุหัวข้อประชุม";
                document.getElementById("record_head_use").innerHTML = text_record_head_use;
                }else{
                document.getElementById("record_head_use").style.display = "none";
                }
        }      
        function check_record_location_id()       
        {                 
            record_location_id = document.getElementById("RECORD_LOCATION_ID").value;             
                if (record_location_id==null || record_location_id==''){
                document.getElementById("record_location_id").style.display = "";     
                text_record_location_id = "*กรุณาระบุหัวข้อประชุม";
                document.getElementById("record_location_id").innerHTML = text_record_location_id;
                }else{
                document.getElementById("record_location_id").style.display = "none";
                }
        }
        function check_province_id()
        {        
            province_id = document.getElementById("PROVINCE_ID").value;             
                if (province_id==null || province_id==''){
                document.getElementById("province_id").style.display = "";     
                text_province_id = "*กรุณาเลือกจังหวัด";
                document.getElementById("province_id").innerHTML = text_province_id;
                }else{
                document.getElementById("province_id").style.display = "none";
                }
        }
        function checklevel_id()
        {        
            // alert('test')
            level_id = document.getElementById("RECORD_LEVEL_ID").value;             
                if (level_id==null || level_id==''){
                document.getElementById("level_id").style.display = "";     
                text_level_id = "*กรุณาเลือกระดับ";
                document.getElementById("level_id").innerHTML = text_level_id;
                }else{
                document.getElementById("level_id").style.display = "none";
                }
        }
        function check_record_type_id()
        {        
            record_type_id = document.getElementById("RECORD_TYPE_ID").value;             
                if (record_type_id==null || record_type_id==''){
                document.getElementById("record_type_id").style.display = "";     
                text_record_level_id = "*กรุณาเลือกประเภท";
                document.getElementById("record_type_id").innerHTML = text_record_level_id;
                }else{
                document.getElementById("record_type_id").style.display = "none";
                }
        }
        function check_location_prov_id()
        {        
            location_prov_id = document.getElementById("LOCATION_PROV_ID").value;             
                if (location_prov_id==null || location_prov_id==''){
                document.getElementById("location_prov_id").style.display = "";     
                text_location_prov_id = "*กรุณาเลือกสถานที่";
                document.getElementById("location_prov_id").innerHTML = text_location_prov_id;
                }else{
                document.getElementById("location_prov_id").style.display = "none";
                }
        }

       
        function check_record_vehicle_id()
        {              
          record_vehicle_id = document.getElementById("RECORD_VEHICLE_ID").value;             
                if (record_vehicle_id==null || record_vehicle_id==''){
                document.getElementById("record_vehicle_id").style.display = "";     
                text_record_vehicle_id = "*กรุณาเลือกพาหนะเดินทาง";
                document.getElementById("record_vehicle_id").innerHTML = text_record_vehicle_id;
                }else{
                document.getElementById("record_vehicle_id").style.display = "none";
                }
        }
       
        function check_record_go_id()
        { 
                        
            record_go_id = document.getElementById("RECORD_GO_ID").value;             
                if (record_go_id==null || record_go_id==''){
                document.getElementById("record_go_id").style.display = "";     
                text_record_go_id = "*กรุณาเลือกลักษณะการไป";
                document.getElementById("record_go_id").innerHTML = text_record_go_id;
                }else{
                document.getElementById("record_go_id").style.display = "none";
                }
        }
        function check_record_org_id()
        { 
                        
            record_org_id = document.getElementById("RECORD_ORG_ID").value;             
                if (record_org_id==null || record_org_id==''){
                document.getElementById("record_org_id").style.display = "";     
                text_record_org_id = "*กรุณาเลือกหน่วยงาน";
                document.getElementById("record_org_id").innerHTML = text_record_org_id;
                }else{
                document.getElementById("record_org_id").style.display = "none";
                }
        }
        function check_record_money_id()
        { 
                        
            record_money_id = document.getElementById("RECORD_MONEY_ID").value;             
                if (record_money_id==null || record_money_id==''){
                document.getElementById("record_money_id").style.display = "";     
                text_record_money_id = "*กรุณาเลือกประเภทการเบิกเงิน";
                document.getElementById("record_money_id").innerHTML = text_record_money_id;
                }else{
                document.getElementById("record_money_id").style.display = "none";
                }
        }
        function check_offer_work_hr_id()
        { 
                        
            offer_work_hr_id = document.getElementById("OFFER_WORK_HR_ID").value;             
                if (offer_work_hr_id==null || offer_work_hr_id==''){
                document.getElementById("offer_work_hr_id").style.display = "";     
                text_offer_work_hr_id = "*กรุณาเลือกผู้มอบหมายงานให้";
                document.getElementById("offer_work_hr_id").innerHTML = text_offer_work_hr_id;
                }else{
                document.getElementById("offer_work_hr_id").style.display = "none";
                }
        }

</script>
<script>
 $('form').submit(function () {
    var record_head_use,text_record_head_use; 
    var record_location_id,text_record_location_id;
    var province_id,text_province_id;
    var level_id,text_level_id;
    var record_type_id,text_record_type_id;
    var location_prov_id,text_location_prov_id;
    var record_vehicle_id,text_record_vehicle_id;
  
    var record_go_id,text_record_go_id;
    var record_org_id,text_record_org_id;
    var record_money_id,text_record_money_id;
    var offer_work_hr_id,text_offer_work_hr_id;


    record_head_use = document.getElementById("RECORD_HEAD_USE").value;
    record_location_id = document.getElementById("RECORD_LOCATION_ID").value;
    province_id = document.getElementById("PROVINCE_ID").value;
    level_id = document.getElementById("RECORD_LEVEL_ID").value;
    record_type_id = document.getElementById("RECORD_TYPE_ID").value;
    location_prov_id = document.getElementById("LOCATION_PROV_ID").value;
    record_vehicle_id = document.getElementById("RECORD_VEHICLE_ID").value;
   
    record_go_id = document.getElementById("RECORD_GO_ID").value;
    record_org_id = document.getElementById("RECORD_ORG_ID").value;
    record_money_id = document.getElementById("RECORD_MONEY_ID").value;
    offer_work_hr_id = document.getElementById("OFFER_WORK_HR_ID").value;


    if (record_head_use==null || record_head_use==''){
        document.getElementById("record_head_use").style.display = "";     
        text_record_head_use= "*กรุณาระบุหัวข้อประชุม";
        document.getElementById("record_head_use").innerHTML = text_record_head_use;
        }else{
        document.getElementById("record_head_use").style.display = "none";
        }

        if (record_location_id==null || record_location_id==''){
        document.getElementById("record_location_id").style.display = "";     
        text_record_location_id= "*กรุณาเลือกสถานที่";
        document.getElementById("record_location_id").innerHTML = text_record_location_id;
        }else{
        document.getElementById("record_location_id").style.display = "none";
        }
       

        if (province_id==null || province_id==''){
        document.getElementById("province_id").style.display = "";     
        text_province_id= "*กรุณาเลือกจังหวัด";
        document.getElementById("province_id").innerHTML = text_province_id;
        }else{
        document.getElementById("province_id").style.display = "none";
        }

        if (level_id==null || level_id==''){
        document.getElementById("level_id").style.display = "";     
        text_level_id= "*กรุณาเลือกระดับ";
        document.getElementById("level_id").innerHTML = text_level_id;
        }else{
        document.getElementById("level_id").style.display = "none";
        }

        if (record_type_id==null || record_type_id==''){
        document.getElementById("record_type_id").style.display = "";     
        text_record_type_id= "*กรุณาเลือกประเภท";
        document.getElementById("record_type_id").innerHTML = text_record_type_id;
        }else{
        document.getElementById("record_type_id").style.display = "none";
        }

        if (location_prov_id==null || location_prov_id==''){
        document.getElementById("location_prov_id").style.display = "";     
        text_location_prov_id= "*กรุณาเลือกสถานที่";
        document.getElementById("location_prov_id").innerHTML = text_location_prov_id;
        }else{
        document.getElementById("location_prov_id").style.display = "none";
        }

        if (record_vehicle_id==null || record_vehicle_id==''){
        document.getElementById("record_vehicle_id").style.display = "";     
        text_record_vehicle_id= "*กรุณาเลือกพาหนะเดินทาง";
        document.getElementById("record_vehicle_id").innerHTML = text_record_vehicle_id;
        }else{
        document.getElementById("record_vehicle_id").style.display = "none";
        }
        
        if (record_go_id==null || record_go_id==''){
        document.getElementById("record_go_id").style.display = "";     
        text_record_go_id= "*กรุณาเลือกลักษณะการไป";
        document.getElementById("record_go_id").innerHTML = text_record_go_id;
        }else{
        document.getElementById("record_go_id").style.display = "none";
        }
        if (record_org_id==null || record_org_id==''){
        document.getElementById("record_org_id").style.display = "";     
        text_record_org_id= "*กรุณาเลือกหน่วยงาน";
        document.getElementById("record_org_id").innerHTML = text_record_org_id;
        }else{
        document.getElementById("record_org_id").style.display = "none";
        }
        if (record_money_id==null || record_money_id==''){
        document.getElementById("record_money_id").style.display = "";     
        text_record_money_id= "*กรุณาเลือกประเภทการเบิกเงิน";
        document.getElementById("record_money_id").innerHTML = text_record_money_id;
        }else{
        document.getElementById("record_money_id").style.display = "none";
        }
        if (offer_work_hr_id==null || offer_work_hr_id==''){
        document.getElementById("offer_work_hr_id").style.display = "";     
        text_offer_work_hr_id= "*กรุณาเลือกผู้มอบหมายงานไห้";
        document.getElementById("offer_work_hr_id").innerHTML = text_offer_work_hr_id;
        }else{
        document.getElementById("offer_work_hr_id").style.display = "none";
        }

        if(record_head_use==null || record_head_use==''||
    record_location_id==null || record_location_id==''||
    province_id==null || province_id==''||
    level_id==null || level_id==''||
    record_type_id==null || record_type_id==''||
    location_prov_id==null || location_prov_id==''||
    record_vehicle_id==null || record_vehicle_id==''||
    record_go_id==null || record_go_id==''||
    record_org_id==null || record_org_id==''||
    record_money_id==null || record_money_id==''||
    offer_work_hr_id==null || offer_work_hr_id==''
    )

{
  alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
  return false;   
}


});   
</script>
<script>
    
    function vehicle_edit(){
      
        var type_vehicle=document.getElementById("RECORD_VEHICLE_ID");
        var type_vehicle_id = type_vehicle.options[type_vehicle.selectedIndex].value;
        var id=document.getElementById("ID").value;
        //alert(type_vehicle_id);
        
            var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('perdev.vehicle_edit')}}",
                     method:"GET",
                     data:{type_vehicle_id:type_vehicle_id,id:id,_token:_token},
                     success:function(result){
                        $('.vehicle_re').html(result);
                     }
             })

    }
    //===============================เพิ่มสถานที่====================================
    function addlocation(){
      
      var record_location=document.getElementById("ADD_RECORD_LOCATION").value;
    
      //alert(record_location);
      
          var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('perdev.addlocation')}}",
                   method:"GET",
                   data:{record_location:record_location,_token:_token},
                   success:function(result){
                      $('.location_re').html(result);
                   }
           })

  }
//===============================เพิ่มหน่วยงาน====================================
  function addorg(){
      
      var record_org=document.getElementById("ADD_RECORD_ORG").value;
    
      //alert(record_location);
      
          var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('perdev.addorg')}}",
                   method:"GET",
                   data:{record_org:record_org,_token:_token},
                   success:function(result){
                      $('.org_re').html(result);
                   }
           })

  }
//======================หาตำแหน่งผู้เดินทาง===========================
function run01(){
    var count = $('.tbody1').children('tr').length;
    //alert(count);
    var number;
        for (number = 0; number < count; number++) { 
            checkposition(number);
            checklevel(number);
            
        }
        callmoney();
}

function checkposition(number){
      
    
      var PERSON_ID=document.getElementById("PERSON_ID"+number).value;
      
      //alert(PERSON_ID);
      
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('perdev.checkposition')}}",
                   method:"GET",
                   data:{PERSON_ID:PERSON_ID,_token:_token},
                   success:function(result){
                      $('.showposition'+number).html(result);
                   }
           })

        

  }

  function checklevel(number){
      
    
      var PERSON_ID=document.getElementById("PERSON_ID"+number).value;
      
      //alert(PERSON_ID);
      
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('perdev.checklevel')}}",
                   method:"GET",
                   data:{PERSON_ID:PERSON_ID,_token:_token},
                   success:function(result){
                      $('.showlevel'+number).html(result);
                   }
           })

  }
  //========================รวมค่าใช้จ่าย=============================
  function callmoney(){
    
    var items = document.getElementsByClassName("items");
    var itemCount = items.length;
    var total = 0;
    for(var i = 0; i < itemCount; i++)
    {
        total = total +  parseInt(items[i].value);
    }

    
    document.getElementById("money").innerHTML = total;
  
}


    //------------------------------------------

    $('.provice').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('dropdown.fetch')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.amphures').html(result);
                     }
             })
            // console.log(select);
             }        
     });

     $('.amphures').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('dropdown.fetchsub')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.tumbon').html(result);
                     }
             })
            // console.log(select);
             }        
     });

     $('.provice_sub').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('dropdown.fetch')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.amphures_sub').html(result);
                     }
             })
            // console.log(select);
             }        
     });

     $('.amphures_sub').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('dropdown.fetchsub')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.tumbon_sub').html(result);
                     }
             })
            // console.log(select);
             }        
     });

     //----------------แสดงข้อมูลกิโลเมตร--------------------------
     function showdistance(){
       
        var distance = document.getElementById("DISTANCE").value;
        distances = distance.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        document.getElementById("distance").innerHTML = distances;
     }  
     
     function showdistancemon(){
       
       var distance = document.getElementById("DISTANCE").value;
       var unitdis = document.getElementById("UNITDIS").value;

       moneydistance = distance * unitdis;
      
       //alert(moneydistances);
      
       moneydistances = moneydistance.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
   
       document.getElementById("moneydistance").innerHTML = moneydistances;


    }

     
</script>

<script>
     $('.addRow').on('click',function(){
         addRow();
     });

     function addRow(){
        var count = $('.tbody1').children('tr').length;
         var tr ='<tr>'+
                '<td>'+ 
                '<select name="PERSON_ID[]" id="PERSON_ID'+count+'" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" onchange="checkposition('+count+');checklevel('+count+');">'+
                '<option value="">--กรุณาเลือกผู้ร่วมเดินทาง--</option>'+
                '@foreach ($PERSONALLs as $PERSONALL)'+                                                   
                '<option value="{{ $PERSONALL ->ID  }}">{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}</option>'+
                '@endforeach'+ 
                '</select>'+      
                '</td>'+
                '<td><div class="showposition'+count+'"></div></td>'+
                '<td><div class="showlevel'+count+'"></div></td>'+
                '<td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                '</tr>';
        $('.tbody1').append(tr);
     };

     $('.tbody1').on('click','.remove', function(){
            $(this).parent().parent().remove();
     });
//-------------------------------------------------

     $('.addRow2').on('click',function(){
         addRow2();
     });

     function addRow2(){
         var tr = '<tr>'+
                  '<td>'+ 
                  '<select name="RECORD_CAPACITY_ID[]" id="RECORD_CAPACITY_ID[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+
                  '<option value="">--กรุณาเลือกสมรรถนะ--</option>'+
                  '@foreach ($capacitys as $capacity)'+                                                     
                  '<option value="{{ $capacity ->RECORD_CAPACITY_ID  }}">{{ $capacity->RECORD_CAPACITY_NAME}}</option>'+
                  '@endforeach'+ 
                  '</select>'+    
                  '</td>'+                      
                '<td style="text-align: center;"><a class="btn btn-danger remove2" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                '</tr>';
        $('.tbody2').append(tr);
     };

     $('.tbody2').on('click','.remove2', function(){
            $(this).parent().parent().remove();
     });

   //-------------------------------------------------  
     $('.addRow3').on('click',function(){
         addRow3();
     });

     function addRow3(){
       
    
         var tr = '<tr>'+
                  '<td>'+ 
                  '<select name="RECORD_BRANCH_ID[]" id="RECORD_BRANCH_ID[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+
                        '<option value="">--กรุณาเลือกสาขา--</option>'+
                        '@foreach ($branchs as $branch)'+                                                     
                        '<option value="{{ $branch ->RECORD_BRANCH_ID  }}">{{ $branch->RECORD_BRANCH_NAME}}</option>'+
                        '@endforeach'+
                  '</select>'+                                         
                  '</td>'+                           
                  '<td style="text-align: center;"><a class="btn btn-danger remove3" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                 '</tr>';
        $('.tbody3').append(tr);
       
     };

     $('.tbody3').on('click','.remove3', function(){
            $(this).parent().parent().remove();
     });

//-------------------------------------------------
     $('.addRow5').on('click',function(){
         addRow5();
     });

     function addRow5(){
         var tr ='<tr>'+
                '<td><select name="MONEY_ID[]" id="MONEY_ID[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+
                '<option value="">--กรุณาเลือกรายการ--</option>'+
                '@foreach ($moneysets as $moneyset)'+                                                     
                '<option value="{{ $moneyset ->MONEY_ID  }}">{{ $moneyset->MONEY_NAME}}</option>'+
                 '@endforeach'+
                '</select></td>'+
                '<td> <input name="SUMDAY[]" id="SUMDAY[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" ></td>'+
                '<td> <input name="SUMMONEY[]" id="SUMMONEY[]" class="form-control input-lg items" style=" font-family: \'Kanit\', sans-serif;" onkeyup="callmoney()"></td>'+
                '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove5" style="color:#FFFFFF;" ></a></td>'+
                '</tr>';
        $('.tbody5').append(tr);
     };

     $('.tbody5').on('click','.remove5', function(){
            $(this).parent().parent().remove();
            callmoney();
     });




</script>


<script>
     $(document).ready(function () {
            var i = 1;
            $('#add').click(function(){
                i++;
                $('dynamic_fileld').append('<tr id="row'+i+'"><td> <input name="name[]" id="name[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" ></td><td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
            });
            $(document).on('click','.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('row'+button_id+'').remove();
            });
           
    });


   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                    //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });





function chkNumber(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9')) return false;
ele.onKeyPress=vchar;
}

function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    

    $('body').on('keydown', 'input, select, textarea', function(e) {
    var self = $(this)
      , form = self.parents('form:eq(0)')
      , focusable
      , next
      ;
    if (e.keyCode == 13) {
        focusable = form.find('input,a,select,button,textarea').filter(':visible');
        next = focusable.eq(focusable.index(this)+1);
        if (next.length) {
            next.focus();
        } else {
            form.submit();
        }
        return false;
    }
});



  
</script>

<script>
function selectbook(book_id){
      
      var _token=$('input[name="_token"]').val();

           $.ajax({
                   url:"{{route('car.selectbookname')}}",
                   method:"GET",
                   data:{book_id:book_id,_token:_token},
                   success:function(result){
                    $('.detali_bookname').html(result);
                   }
           })

           $.ajax({
                   url:"{{route('car.selectbooknum')}}",
                   method:"GET",
                   data:{book_id:book_id,_token:_token},
                   success:function(result){
                    $('.detali_booknum').html(result);
                   }
           })

           $.ajax({
                   url:"{{route('car.selectbookdate')}}",
                   method:"GET",
                   data:{book_id:book_id,_token:_token},
                   success:function(result){
                    $('.detali_bookdate').html(result);
                   }
           })

           $('#modalbook').modal('hide');

}

</script>
<script>
        $(document).ready(function(){
          $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
        </script>
@endsection