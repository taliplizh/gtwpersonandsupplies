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

label{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
            
      }  
      p{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
            
      } 

      @media only screen and (min-width: 1200px) {
label {
    float:right;
  }

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

  function RemovegetAge($birthday) {
    $then = strtotime($birthday);
    return(floor((time()-$then)/31556926));
}


function Monththai($strtime)
{
  if($strtime == '1'){
      $month = 'มกราคม';
  }else if($strtime == '2'){
      $month = 'กุมภาพันธ์';
  }else if($strtime == '3'){
      $month = 'มีนาคม';
  }else if($strtime == '4'){
      $month = 'เมษายน';
  }else if($strtime == '5'){
      $month = 'พฤษภาคม';
  }else if($strtime == '6'){
      $month = 'มิถุนายน';
  }else if($strtime == '7'){
      $month = 'กรกฎาคม';
  }else if($strtime == '8'){
      $month = 'สิงหาคม';
  }else if($strtime == '9'){
      $month = 'กันยายน';
  }else if($strtime == '10'){
      $month = 'ตุลาคม';
  }else if($strtime == '11'){
      $month = 'พฤศจิกายน';
  }else if($strtime == '12'){
      $month = 'ธันวาคม';
  }else{
      $month = '';
  }

  return $month;
  }

  function Yearthai($strtime)
  {
    $year = $strtime+543;
    return $year;
  }

?>
           
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

                <div class="block-header block-header-default ">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ตรวจสอบคำร้อง การจัดตารางเวร</B></h3>
                </div>
                <div class="block-content">    

    
        <form  method="post" action="{{route('operate.updatever')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden"  name="ID" value="{{ $infooperateid }}"/>
       
        <div class="row">
       
        <div class="col-sm-2">
            <div class="form-group">
            <label >ประจำเดือน :</label>
            </div>                               
        </div> 
        <div class="col-sm-3">
            <div class="form-group" >
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ Monththai($operateindexinfo -> OPERATE_INDEX_MONTH) }}</h1>
            </div>                               
        </div>
        
        <div class="col-sm-2">
            <div class="form-group">
            <label >ปีพุทธศักราช :</label>
            </div>                               
        </div>  
        <div class="col-sm-3">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ Yearthai($operateindexinfo -> OPERATE_INDEX_YEAR) }}</h1>
            </div>                               
        </div>  
       
        </div>

        <div class="row">
        <div class="col-sm-2">
            <div class="form-group">
            <label >หน่วยงาน :</label>
            </div>                               
        </div>  
        <div class="col-sm-3">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $operateindexinfo -> HR_DEPARTMENT_SUB_SUB_NAME}}</h1>
            </div>                               
        </div>    
        <div class="col-sm-2">
            <div class="form-group">
            <label >ผู้จัดเวร :</label>
            </div>                               
        </div>  
        <div class="col-sm-3">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $operateindexinfo -> OPERATE_ORGANIZER_NAME }}</h1>
            </div>                               
        </div>
        </div>

        
        <div class="row">
        <div class="col-sm-2">
            <div class="form-group">
            <label>ผู้ตรวจสอบคนที่1 :</label>
            </div>                               
        </div>  
        <div class="col-sm-3">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $operateindexinfo -> OPERATE_VERIFY_1_NAME }}</h1>
            </div>                               
        </div>  
        <div class="col-sm-2">
            <div class="form-group">
            <label>ผู้ตรวจสอบคนที่2 :</label>
            </div>                               
        </div>  
        <div class="col-sm-3">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $operateindexinfo -> OPERATE_VERIFY_2_NAME}}</h1>
            </div>                               
        </div>    
       </div>
     
       
      
      <input type="hidden" name = "OPERATE_VERIFY_ID"  id="OPERATE_VERIFY_ID"  value="{{ $inforpersonuserid ->ID }} ">
   
    
      <label style="float:left;">หมายเหตุ</label>
      <textarea   name = "OPERATE_VERIFY_COMMENT"  id="OPERATE_VERIFY_COMMENT" class="form-control input-lg" ></textarea>
        <div class="modal-footer">
        <div align="right">
        <button type="submit" name = "SUBMIT"  class="btn btn-success btn-lg" value="approved" >ผ่านการตรวจสอบ</button>
        <button type="submit"  name = "SUBMIT"  class="btn btn-hero-sm btn-hero-danger" value="not_approved" >ไม่ผ่านการตรวจสอบ</button>
        <a href="{{ url('general_operate/genoperateindexver/'.$inforpersonuserid ->ID)  }}" class="btn btn-warning btn-lg" >กลับหน้าตรวจสอบ</a>
       
        </div>
        </div>
        </form>  
           
      

                      

@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>



<script>
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true               //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });


  
</script>



@endsection