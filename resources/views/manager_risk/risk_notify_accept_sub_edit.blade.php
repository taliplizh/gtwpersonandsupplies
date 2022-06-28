@extends('layouts.risk')   
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
        font-size: 13px;
       
        }

        label{
                font-family: 'Kanit', sans-serif;
                font-size: 13px;
           
        } 
        @media only screen and (min-width: 1200px) {
    label {
        float:right;
    }
        }        
        .text-pedding{
   padding-left:10px;
                    }

        .text-font {
    font-size: 13px;
                  }   
      
      
      .form-control{
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
    
    function Removeformatetime($strtime)
    {
    $H = substr($strtime,0,5);
    return $H;
    }  
?>          
<!-- Advanced Tables -->
<br>
<br>
<br>

<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h2 class="block-title" style="font-family: 'Kanit', sans-serif;">แก้ไขรายละเอียดการตอบรับ</h2>   
               
                </div> 
            <div class="block-content block-content-full " align="left">

<form  method="post" action="{{ route('mrisk.risk_notify_accept_sub_update') }}" enctype="multipart/form-data">
@csrf
                                 
<input type="hidden" name = "RISKREP_ID"  id="RISKREP_ID" class="form-control input-lg" value="{{$rigreps->RISKREP_ID}} " > 
<input type="hidden" name = "NOTIFY_ACCEPT_ID"  id="NOTIFY_ACCEPT_ID" class="form-control input-lg" value=" {{$notify_accepts->NOTIFY_ACCEPT_ID}}" > 

<div class="row push">
        <div class="col-sm-2">
        <label style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">รหัสความเสี่ยง :</label>
        </div> 
        <div class="col-lg-3 " style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">
            {{ $rigreps->RISKREP_ID}}
        </div> 
        <div class="col-sm-1">
        <label style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">วันที่บันทึก :</label>
        </div> 
        <div class="col-lg-1 " style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">
            {{ formate($rigreps->RISKREP_DATESAVE)}}
        </div> 
        <div class="col-sm-1">
            <label style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">วันที่เกิดเหตุ :</label>
            </div> 
            <div class="col-lg-1" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">
                {{ formate($rigreps->RISKREP_STARTDATE)}}
            </div>
        <div class="col-sm-1">
            <label style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">เวลาเกิดเหตุ :</label>
            </div> 
            <div class="col-lg-1 " style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">  
                {{ $rigreps->RISKREP_TIME}}   
        </div> 
       
</div> 

<div class="row push">
    <div class="col-sm-2">
    <label style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">เรื่องความเสี่ยง :</label>
    </div> 
    <div class="col-lg-3" style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">
        {{ $rigreps->INCIDENCE_SETTING_NAME}}
    </div> 
    <div class="col-sm-1">
        <label style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">สถานที่เกิดเหตุ :</label>
        </div> 
        <div class="col-lg-2 " style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">   
            {{ $rigreps->SETUP_GROUPLOCATION_NAME}}  
    </div> 
    <div class="col-sm-1">
        <!-- {{-- <label>สถานที่ต้นเหตุ :</label> --}} -->
        </div> 
        <div class="col-lg-2 ">  
          
    </div> 
</div>


<div class="row push">
    <div class="col-sm-2"> 
        <label style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">ครั้งที่:</label>
    </div> 
    <div class="col-lg-2 "> 
        <input value="{{ $notify_accepts-> NOTIFY_ACCEPT_NO}}" name="NOTIFY_ACCEPT_NO" id="NOTIFY_ACCEPT_NO" class="form-control input-sm" style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">
    
    </div> 
    <div class="col-sm-2"> 
        <label>วันที่-เวลาตอบกลับ :</label>
    </div> 
    <div class="col-lg-3 ">        
        <input value="{{formate($notify_accepts-> NOTIFY_ACCEPT_DATE)}}" name="NOTIFY_ACCEPT_DATE" id="NOTIFY_ACCEPT_DATE" class="form-control input-sm datepicker" data-date-format="mm/dd/yyyy" readonly>
    </div> 
    <div class="col-sm-1"> 
        <label style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">ผู้บันทึก:</label>
    </div> 
    <div class="col-lg-2 "> 
        <select name="NOTIFY_ACCEPT_USER_SAVE" id="NOTIFY_ACCEPT_USER_SAVE" class="form-control input-sm" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">
            <option value="">เลือก</option>
                @foreach($infopers as $infoper)
                    @if($infoper->ID == $notify_accepts->NOTIFY_ACCEPT_USER_SAVE)
                    <option value="{{ $infoper-> ID}}" selected>{{ $infoper-> HR_FNAME}}&nbsp;&nbsp; {{ $infoper-> HR_LNAME}}</option>
                    @else
                    <option value="{{ $infoper-> ID}}" >{{ $infoper-> HR_FNAME}}&nbsp;&nbsp; {{ $infoper-> HR_LNAME}}</option>
                    @endif
                @endforeach
        </select> 
    </div> 
</div>

<div class="row push">
    <div class="col-sm-2"> 
        <label style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">เกี่ยวกับ :</label>
    </div> 
    <div class="col-lg-3 ">        
        <input value="{{ $notify_accepts-> NOTIFY_ACCEPT_ABOUT}}" name = "NOTIFY_ACCEPT_ABOUT"  id="NOTIFY_ACCEPT_ABOUT" class="form-control input-lg" style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">
    </div>
    <div class="col-sm-1"> 
        <label style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">รายละเอียด :</label>
    </div> 
    <div class="col-lg-6 ">        
        <textarea name="NOTIFY_ACCEPT_DETAIL" id="NOTIFY_ACCEPT_DETAIL" rows="4" class="form-control input-lg" style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">{{ $notify_accepts-> NOTIFY_ACCEPT_DETAIL}}</textarea>
    </div>
</div>

          
        
   
<div class="modal-footer">
    <div align="right">
    <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
    <a href="{{ url('manager_risk/risk_notify_repeat/'.$rigreps->RISKREP_ID)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a>
    </div>  
    </div>

  
    
  
@endsection
@section('footer')
<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>
<script>

   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });
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