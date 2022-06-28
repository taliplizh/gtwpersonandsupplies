@extends('layouts.crm')   
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
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

    $datenow = date('Y-m-d');
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

<center>
<div class="block mt-5" style="width: 98%;" >
    <div class="block block-rounded block-bordered">            
       
            
            
            <div class="block-header block-header-default">
                <h3 class="block-title text-left" style="font-family: 'Kanit', sans-serif;"><B>เพิ่มรายละเอียด</B></h3>
                &nbsp;&nbsp;
          
                <a href="{{ url('manager_crm/detaildonate/'.$donateinfopersons->DONATE_PERSON_ID)  }}"   class="btn btn-hero-sm btn-hero-success foo15" ><i class="fas fa-arrow-circle-left mr-2"></i>ย้อนกลับ</a>
            </div>  

            
<div class="block-content block-content-full" align="left">
<form  method="post" action="{{ route('mcrm.detaildonate_save') }}" enctype="multipart/form-data">
@csrf

<input type="hidden" value="{{ $donateinfopersons->DONATE_PERSON_ID }}" id="DONATE_PERSON_ID" name="DONATE_PERSON_ID">

<div class="row push">

<div class="col-sm-2">
<label>เล่มที่ :</label>
</div> 
<div class="col-sm-3 ">              
<input  name="PERSON_DONATE_SUB_BOOKNO" id="PERSON_DONATE_SUB_BOOKNO" class="form-control input-sm fo13" value="{{$subNo}}" >
</div> 
<div class="col-sm-1">
<label>เลขที่ :</label>
</div> 
<div class="col-sm-2 ">              
<input  name="PERSON_DONATE_SUB_NO" id="PERSON_DONATE_SUB_NO" class="form-control input-sm fo13" value="{{$billNos}}" >
</div> 
<div class="col-sm-1">
<label>ปี :</label>
</div> 
<div class="col-sm-2 "> 
<select name="PERSON_DONATE_SUB_YEAR" id="PERSON_DONATE_SUB_YEAR" class="form-control input-sm fo13" required>
<option value="">--เลือก--</option>
    @foreach ($budgets as $budget)                    
        <option value="{{ $budget -> LEAVE_YEAR_ID }}">{{ $budget -> LEAVE_YEAR_ID }}</option>           
    @endforeach  
</select>
</div> 
</div>

<div class="row push">
<div class="col-sm-2">
<label>บริจาคเข้าในงาน :</label>
</div> 
<div class="col-sm-3">
<input type="text" name="PERSON_DONATE_SUB_WORK" id="PERSON_DONATE_SUB_WORK" class="form-control input-sm fo13" required>
</div> 
<div class="col-sm-1">
    <label>กองทุน :</label>
    </div> 
    <div class="col-sm-5">
    <select name="PERSON_DONATE_SUB_FUND" id="PERSON_DONATE_SUB_FUND" class="form-control input-sm fo13 donulfun">
    <option value="">--เลือก--</option>
        @foreach ($donatfunds as $donatfund)                    
            <option value="{{ $donatfund ->DONATE_FUND_ID  }}">{{ $donatfund ->DONATE_FUND_NAME  }}</option>           
        @endforeach  
    </select>
    </div> 
  
</div> 



<div class="row push">
    <div class="col-sm-2">
        <label>ลงวันที่ :</label>
    </div> 
    <div class="col-sm-2 ">
    <input name="PERSON_DONATE_SUB_DATE" id="PERSON_DONATE_SUB_DATE" class="form-control input-sm datepicker fo13" data-date-format="mm/dd/yyyy" value="{{formate($datenow)}}" readonly>     
    </div> 
  
    <div class="col-sm-2">
        <label>ประเภทของบริจาค :</label>
        </div> 
        <div class="col-sm-5">
        <select name="PERSON_DONATE_SUB_WEALTH_ID" id="PERSON_DONATE_SUB_WEALTH_ID" class="form-control input-sm fo13 addtypecrm" required>
        <option value="">--เลือก--</option>
            @foreach ($donatiwealths as $donatiwealth)                    
                <option value="{{ $donatiwealth -> DONATIONWEALTH_ID }}">{{ $donatiwealth -> DONATIONWEALTH_NAME }}</option>           
            @endforeach  
        </select>
    </div> 
  

</div>   


<div class="row push">
<div class="col-sm-2">
<label>รายการที่บริจาค :</label>
</div> 
<div class="col-sm-3 ">
<input name="PERSON_DONATE_SUB_DETAIL" id="PERSON_DONATE_SUB_DETAIL" class="form-control input-sm fo13" required> 
</div> 
<div class="col-sm-1">
<label>จำนวน :</label>
</div> 
<div class="col-sm-1 ">
<input name="PERSON_DONATE_SUB_QTY" id="PERSON_DONATE_SUB_QTY" class="form-control input-sm fo13" required>
</div> 
<div class="col-sm-1">
<label>หน่วยนับ :</label>
</div> 
<div class="col-sm-1.5 ">
    <select name="PERSON_DONATE_SUB_UNIT_ID" id="PERSON_DONATE_SUB_UNIT_ID" class="form-control input-sm fo13 unitcrm" required>
        <option value="">--เลือก--</option>  
            @foreach ($donateunits as $donateunit)                    
                <option value="{{ $donateunit -> DONATIONUNIT_ID }}">{{ $donateunit -> DONATIONUNIT_NAME }}</option>           
            @endforeach 
    </select>   
</div> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<div class="col-lg-2">
    <input type="text" class="form-control input-lg fo13" id="DONATIONUNIT_NAME" name="DONATIONUNIT_NAME" style=" font-family: 'Kanit', sans-serif; background-color: #CCFFFF;" placeholder="ระบุหน่วยนับ" >
</div> 
<div class="col-lg-1">
    <a class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif; font-size: 9px;font-size: 1.0rem;font-weight:normal;color:#FFFFFF;" onclick="unitcrm();">เพิ่ม</a>
</div> 
</div> 

<div class="row push">
    <div class="col-sm-2">
        <label>ราคา :</label>
        </div> 
        <div class="col-sm-3 ">
        <input name="PERSON_DONATE_SUB_PRICE" id="PERSON_DONATE_SUB_PRICE" class="form-control input-sm fo13"  onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข '); this.value='';}"required>
        </div> 
        <div class="col-sm-0.5">
            <label>บาท</label>
            </div> 
</div> 


<div class="row push">
<div class="col-sm-2">
<label>เพื่อใช้สำหรับ :</label>
</div> 
<div class="col-sm-10 ">
<textarea  name="PERSON_DONATE_SUB_COMENT" id="PERSON_DONATE_SUB_COMENT" class="form-control input-sm fo13"  rows="2" >  </textarea >
</div> 
</div>
  

 
<div class="modal-footer">
<div align="right">
<button type="submit"  class="btn btn-hero-sm btn-hero-info foo14" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
<a href="{{ url('manager_crm/detaildonate/'.$donateinfopersons->DONATE_PERSON_ID)  }}" class="btn btn-hero-sm btn-hero-danger foo14" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มรายละเอียด ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
</div>


@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script>
    $(document).ready(function() {
    $("select").select2();
});

  $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });

    function donulfun(){      
      var record_donulfun=document.getElementById("DONATE_FUND_NAME").value;   
          var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('mcrm.donation_fund_addajax')}}",
                   method:"GET",
                   data:{record_donulfun:record_donulfun,_token:_token},
                   success:function(result){
                      $('.donulfun').html(result);
                   }
           })
  }
  function addtypecrm(){      
      var record_typecrm=document.getElementById("DONATIONWEALTH_NAME").value;   
          var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('mcrm.donation_fund_addtypeajax')}}",
                   method:"GET",
                   data:{record_typecrm:record_typecrm,_token:_token},
                   success:function(result){
                      $('.addtypecrm').html(result);
                   }
           })
  }
  function unitcrm(){      
      var record_unitcrm=document.getElementById("DONATIONUNIT_NAME").value;   
          var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('mcrm.donation_fund_addunitajax')}}",
                   method:"GET",
                   data:{record_unitcrm:record_unitcrm,_token:_token},
                   success:function(result){
                      $('.unitcrm').html(result);
                   }
           })
  }
    
</script>

@endsection