@extends('layouts.repairnomal')
   
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">


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

      label{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
           
      } 

      @media only screen and (min-width: 1200px) {
label {
    float:right;
  }

      }

      
      .text-pedding{
  padding-top:5px;
   padding-left:10px;
                    }

        .text-font {
    font-size: 13px;
                  }   


            .form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
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



use App\Http\Controllers\MeetingController;
$checkver = MeetingController::checkver($user_id);
$countver = MeetingController::countver($user_id);


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

  function formateDatetime($strDate)
  {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));

    $H= date("H",strtotime($strDate));
    $I= date("i",strtotime($strDate));

  $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
  $strMonthThai=$strMonthCut[$strMonth];

  return  "$strDay $strMonthThai $strYear $H:$I";
    }

  
  function Removeformatetime($strtime)
{
  $H = substr($strtime,0,5);
  return $H;
  }

  date_default_timezone_set("Asia/Bangkok");
  $date = date('Y-m-d');

  list($a,$b,$c,$d) = explode('/',$url); 

  
?>
<center>    
     <div class="block" style="width: 95%;">

                             <!-- Dynamic Table Simple -->
                             <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ทะเบียนซ่อมทั่วไป</B></h3>
                            
                        </div>
                        <div class="block-content block-content-full">
                        <form method="post">
@csrf

<div class="row">
<div class="col-sm-0.5">
                            &nbsp;&nbsp; ปีงบ&nbsp;
                        </div>
                        <div class="col-sm-1.5">
                        <span>
                                <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;">
                                @foreach ($budgets as $budget)
                                @if($budget->LEAVE_YEAR_ID== $year_id)
                                    <option value="{{ $budget->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}</option>
                                @else
                                    <option value="{{ $budget->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                                @endif                                 
                            @endforeach                         
                                </select>
                            </span>
                        </div>

            <div class="col-sm-4 date_budget">
            <div class="row">
                        <div class="col-sm">
                        วันที่
                        </div>
                    <div class="col-md-4">
             
                    <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_bigen) }}" readonly>
                    
                    </div>
                    <div class="col-sm">
                        ถึง 
                        </div>
                    <div class="col-md-4">
           
                    <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_end) }}" readonly>
                  
                    </div>
                    </div>

                </div>

<div class="col-sm-0.5">
&nbsp;สถานะ &nbsp;
</div>

<div class="col-sm-2">
<span>
<select name="SEND_STATUS" id="SEND_STATUS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">

<option value="">ทั้งหมด</option>
@foreach ($infostatuss as $infostatus)  
 
        @if($infostatus->STATUS_NAME == $status_check)
            <option value="{{$infostatus->STATUS_NAME}}" selected>{{ $infostatus->STATUS_NAME_TH}}</option>
        @else
            <option value="{{$infostatus->STATUS_NAME}}" >{{ $infostatus->STATUS_NAME_TH}}</option>

            @endif
    @endforeach 

  


</select>
</span>
</div> 

<div class="col-sm-0.5">
&nbsp;ค้นหา &nbsp;
</div>

<div class="col-sm-2">
<span>

<input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">

</span>
</div>

<div class="col-sm-30">
&nbsp;
</div> 
<div class="col-sm-1.5">
<span>
<button type="submit" class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-search mr-2"></i>ค้นหา</button>
</span> 
</div>


              
                  </div>  
             </form>
             <div class="row">
<div class="col-md-12" style=" font-size: 15px;">
ความเร่งด่วน :: 
<p class="fa fa-circle" style="color:#008000;  font-size: 15px;"></p> ปกติ


<p class="fa fa-circle" style="color:#87CEFA;  font-size: 15px;"></p> ด่วน


<p class="fa fa-circle" style="color:#FFA500;  font-size: 15px;"></p> ด่วนมาก

<p class="fa fa-circle" style="color:#FF4500;  font-size: 15px;"></p> ด่วนที่สุด &nbsp;&nbsp;&nbsp;&nbsp;



คะแนน :: 
<img src="{{ asset('storage/images/1.png') }}"  width="15" height="15"/>ต้องปรับปรุง


<img src="{{ asset('storage/images/2.png') }}"  width="15" height="15"/> พอใช้


<img src="{{ asset('storage/images/3.png') }}"  width="15" height="15"/> ปานกลาง

<img src="{{ asset('storage/images/4.png') }}"  width="15" height="15"/> ดี


<img src="{{ asset('storage/images/5.png') }}" width="15" height="15"/> ดีมาก
</div>
</div>
             <div class="table-responsive" style="height:650px;"> 
                            <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                <thead style="background-color: #FFEBCD;">
                                    <tr height="40">
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                                       
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  width="7%">รหัส</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">สถานะ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ความเร่งด่วน</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ความพึงพอใจ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%" >วดป./เวลา</th> 
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">แจ้งซ่อม</th>  
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">อาการ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="12%">เลขครุภัณฑ์</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">ผู้ร้องขอ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  width="8%">หน่วยงาน</th>  
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  width="8%">สถานที่พบ</th>  
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  width="8%">ช่างที่ต้องการ</th>   
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  width="7%">คำสั่ง</th>   
                                       
                                    </tr >
                                </thead>
                                <tbody>
                                

                                <?php $number = 0; ?>
                                @foreach ($inforepairnomals as $inforepairnomal)
                                <?php $number++;
                                
                                  if($inforepairnomal->REPAIR_STATUS == 'CANCEL'){
                                    $color = 'background-color: #FFF0F5;';
                                  }else{
                                    $color = '';
                                  }
                                
                                ?>


                                    <tr height="20" style="{{$color}}">
                                        <td class="text-font" style="vertical-align: text-top;border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{$number}}</td>
                                        <td class="text-font text-pedding" style="vertical-align: text-top;border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $inforepairnomal->REPAIR_ID }}</td>  

                                        
                                        @if($inforepairnomal->REPAIR_STATUS == 'REPAIR_OUT')
                                        <td  style="vertical-align: text-top;border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="badge badge-secondary" >แจ้งยกเลิก</span></td>
                                        @elseif($inforepairnomal->REPAIR_STATUS== 'REQUEST')
                                        <td  style="vertical-align: text-top;border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="badge badge-warning" >ร้องขอ</span></td>
                                        @elseif($inforepairnomal->REPAIR_STATUS== 'RECEIVE')
                                        <td  style="vertical-align: text-top;border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="badge badge-info" >รับงาน</span></td>
                                        @elseif($inforepairnomal->REPAIR_STATUS == 'PENDING')
                                        <td  style="vertical-align: text-top;border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="badge badge-danger" >กำลังดำเนินการ</span></td>
                                        @elseif($inforepairnomal->REPAIR_STATUS == 'CANCEL')
                                        <td  style="vertical-align: text-top;border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="badge badge-dark" >ยกเลิก</span></td>
                                        @elseif($inforepairnomal->REPAIR_STATUS == 'SUCCESS')
                                        <td  style="vertical-align: text-top;border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="badge badge-success" >ซ่อมเสร็จ</span></td>
                                        @elseif($inforepairnomal->REPAIR_STATUS == 'OUTSIDE')
                                        <td  style="vertical-align: text-top;border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="badge badge-danger" >ส่งซ่อมนอก</span></td>
                                        @elseif($inforepairnomal->REPAIR_STATUS == 'DEAL')
                                        <td  style="vertical-align: text-top;border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="badge badge-danger" >จำหน่าย</span></td>
                                       @else
                                       <td class="text-font" style="vertical-align: text-top;border-color:#F0FFFF;text-align: center;border: 1px solid black;" ></td>
                                        @endif

                                        @if($inforepairnomal->PRIORITY_ID == 1)
                                        <td class="text-font" style="vertical-align: text-top;border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="fa fa-2x fa-circle" style="color:#008000;"></span></td> 
                                        @elseif($inforepairnomal->PRIORITY_ID == 2)
                                        <td class="text-font" style="vertical-align: text-top;border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="fa fa-2x fa-circle" style="color:#87CEFA;"></span></td>
                                        @elseif($inforepairnomal->PRIORITY_ID == 3)
                                        <td class="text-font" style="vertical-align: text-top;border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="fa fa-2x fa-circle" style="color:#FFA500;"></span></td>         
                                        @elseif($inforepairnomal->PRIORITY_ID == 4)
                                        <td class="text-font" style="vertical-align: text-top;border-color:#F0FFFF;text-align: center;border: 1px solid black;" ><span class="fa fa-2x fa-circle" style="color:#FF4500;"></span></td>
                                        
                                        @endif

                                        @if($inforepairnomal->FANCINESS_SCORE == 1)
                                        <td  style="vertical-align: text-top;border-color:#F0FFFF;text-align: center;border: 1px solid black;" ><img src="{{ asset('storage/images/1.png') }}"  width="30" height="30"/></td> 
                                        @elseif($inforepairnomal->FANCINESS_SCORE == 2)
                                        <td  style="vertical-align: text-top;border-color:#F0FFFF;text-align: center;border: 1px solid black;" ><img src="{{ asset('storage/images/2.png') }}"  width="30" height="30"/></td>
                                        @elseif($inforepairnomal->FANCINESS_SCORE == 3)
                                        <td  style="vertical-align: text-top;border-color:#F0FFFF;text-align: center;border: 1px solid black;" ><img src="{{ asset('storage/images/3.png') }}"  width="30" height="30"/></td>         
                                        @elseif($inforepairnomal->FANCINESS_SCORE == 4)
                                        <td  style="vertical-align: text-top;border-color:#F0FFFF;text-align: center;border: 1px solid black;" ><img src="{{ asset('storage/images/4.png') }}"  width="30" height="30"/></td>
                                        @elseif($inforepairnomal->FANCINESS_SCORE == 5)
                                        <td  style="vertical-align: text-top;border-color:#F0FFFF;text-align: center;border: 1px solid black;" ><img src="{{ asset('storage/images/5.png') }}"  width="30" height="30"/></td>
                                        @else
                                        <td style="vertical-align: text-top;border-color:#F0FFFF;text-align: center;border: 1px solid black;" ></td>       
                                        @endif  
                
                                        <td class="text-font text-pedding" style="vertical-align: text-top;border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ formateDatetime($inforepairnomal->DATE_TIME_REQUEST) }}</td> 



                                        <td class="text-font text-pedding" style="vertical-align: text-top;border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $inforepairnomal->REPAIR_NAME }}</td>  
                                        <td class="text-font text-pedding" style="vertical-align: text-top;border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $inforepairnomal->SYMPTOM }}</td>     
                                        <td class="text-font text-pedding" style="vertical-align: text-top;border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $inforepairnomal->ARTICLE_NUM }}</td>                                                                      
                                        <td class="text-font text-pedding" style="vertical-align: text-top;border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $inforepairnomal->USRE_REQUEST_NAME }}</td> 
                                        <td class="text-font text-pedding" style="vertical-align: text-top;border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{$inforepairnomal->HR_DEPARTMENT_SUB_SUB_NAME}}</td>                                       
                                        <td class="text-font text-pedding" style="vertical-align: text-top;border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{$inforepairnomal->BUILD_NAME}}</td>  
                                        <td class="text-font text-pedding" style="vertical-align: text-top;border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{$inforepairnomal->TECH_REPAIR_NAME}}</td>     
                                        <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                        <div class="dropdown">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px"> 
                                                <a class="dropdown-item"  href="#detail_repairnomal"  data-toggle="modal"  style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" onclick="detail({{$inforepairnomal->ID}});">รายละเอียด</a>

                                              
                                                @if($codes == '11120')                               
                                                    <a class="dropdown-item"  href="{{url('formpdf/11120/pdfrepair_11120/'.$inforepairnomal->ID)}}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank">พิมพ์ใบแจ้งซ่อม</a>
                                                @elseif ($codes == '10743')
                                                    <a class="dropdown-item"  href="{{url('formpdf/10743/formrepairnormal_10743/'.$inforepairnomal->ID)}}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank">พิมพ์ใบแจ้งซ่อม</a>
                                                @elseif ($codes == '10978')
                                                    <a class="dropdown-item"  href="{{url('formpdf/10978/pdf-repair_10978/'.$inforepairnomal->ID)}}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank">พิมพ์ใบแจ้งซ่อม</a>
                                                @else
                                                    <a class="dropdown-item"  href="{{ url('manager_repairnomal/pdf_normal/'.$inforepairnomal -> ID)}}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank">พิมพ์ใบแจ้งซ่อม</a>
                                            
                                                @endif
                                                

                                                       <!-- @if($checkpdf >0)
                                                        <a class="dropdown-item" href="{{ url('formpdf/pdf-repair/'.$inforepairnomal -> ID) }}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank">ใบแจ้งซ่อม รพ.</a>
                                                        @else
                                                        <a class="dropdown-item"  href="{{ url('manager_repairnomal/pdf_normal/'.$inforepairnomal -> ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank">ใบแจ้งซ่อม</a>
                                                        @endif -->


                                                @if($inforepairnomal->REPAIR_STATUS== 'REQUEST')
                                                <a class="dropdown-item"  href="{{ url('manager_repairnomal/repairnomaledit/edit/'.$inforepairnomal -> ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                    <a class="dropdown-item" href="{{ url('manager_repairnomal/repairnomalreceived/'.$inforepairnomal->ID) }}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">รับงาน</a>
                                                @endif
                                                @if($inforepairnomal->REPAIR_STATUS== 'RECEIVE' )
                                                   <a class="dropdown-item"  href="{{ url('manager_repairnomal/repairnomalreceiveedit/edit/'.$inforepairnomal -> ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขข้อมูลรับงาน</a>    
                                                    <a class="dropdown-item" href="{{ url('manager_repairnomal/repairnomalamong/'.$inforepairnomal->ID) }}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ดำเนินการซ่อม</a>
                                                @endif
                                                @if($inforepairnomal->REPAIR_STATUS== 'PENDING' || $inforepairnomal->REPAIR_STATUS== 'OUTSIDE') 
                                                    <a class="dropdown-item"  href="{{ url('manager_repairnomal/repairnomalamongedit/edit/'.$inforepairnomal -> ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขดำเนินการซ่อม</a>       
                                                    <a class="dropdown-item" href="{{ url('manager_repairnomal/repairnomalsuccess/'.$inforepairnomal->ID) }}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">บันทึกซ่อม</a>
                                                    @endif
                                                @if($inforepairnomal->REPAIR_STATUS== 'SUCCESS' || $inforepairnomal->REPAIR_STATUS== 'DEAL') 
                                                    <a class="dropdown-item"  href="{{ url('manager_repairnomal/repairnomalsuccessedit/edit/'.$inforepairnomal -> ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขบันทึกซ่อม</a>    
                                                @endif
                                                    
                                                    <a class="dropdown-item"  href="{{ url('manager_repairnomal/repairnomalcancel/'.$inforepairnomal -> ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ยกเลิก</a>

                                                    @if($checfunc == '1')
                                                    <a class="dropdown-item"  href="{{ url('manager_repairnomal/repairnomalsuccessnow/'.$inforepairnomal -> ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ดำเนินการเรียบร้อย</a>
                                                    @endif
                                                </div>
                                        </div>
                                        </td>     

                                    </tr>


                                    @endforeach  
                                    
                                    <div id="detail_repairnomal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                            
                                            <div class="row">
                                            <div><h3  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;รายละเอียดการแจ้งซ่อมทัวไป&nbsp;&nbsp;</h3></div>
                                            </div>
                                                </div>
                                                <div class="modal-body" >
                                                    
                                        
                                                            
                                                 <div id="detail"></div>
                                                
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                <div align="right">
                                            
                                                <button type="button" class="btn btn-hero-sm btn-hero-secondary" data-dismiss="modal" ><i class="fas fa-window-close mr-2"></i>ปิดหน้าต่าง</button>
                                                </div>
                                                </div>
                                                </form>  
                                        </body>
                                            
                                            
                                            </div>
                                            </div>
                                        </div>
                                   
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>


               
                </div>

                          
                 
                  
      
                      

@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>



 <!-- Page JS Plugins -->
<script src="{{ asset('asset/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<!-- Page JS Code -->
<script src="{{ asset('asset/js/pages/be_comp_charts.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['easy-pie-chart', 'sparkline']); });</script>


 <!-- Page JS Plugins -->
 <script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>
<!-- Page JS Code -->
 <script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>


<script>
 $('.budget').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('admin.selectbudget')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.date_budget').html(result);
                        datepick();
                     }
             })
            // console.log(select);
             }        
     });
    
function detail(id){


$.ajax({
           url:"{{route('mrepairnomal.detailrepairnomal')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#detail').html(result);
             
         
              //alert("Hello! I am an alert box!!");
           }
            
   })
    
}
datepick();
   function datepick(){
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                todayHighlight: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    };





    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    
  
</script>



@endsection