@extends('layouts.backend_admin')
  
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

if($status=='USER' and $user_id != $id_user  ){
    echo "You do not have access to data.";
    exit();
}

function Removeformate($strDate)
{
  $strYear = date("Y",strtotime($strDate));
  $strMonth= date("m",strtotime($strDate));
  $strDay= date("d",strtotime($strDate));

  
  return $strDay."/".$strMonth."/".$strYear;
  }
?>

           
                    <!-- Advanced Tables -->
                 
                <div class="content">
                <div class="block block-rounded block-bordered">

                <div class="block-content"> 
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">เพิ่มข้อมูลระดับ</h2>    

    
        <form  method="post" action="{{ route('admin.savepersonlevel') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
      <div class="col-lg-1">
      <label >ระดับ</label>
      </div>
      <div class="col-lg-3">
      <input  name = "HR_LEVEL_NAME"  id="HR_LEVEL_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_hr_level_name();" required>
      <div style="color: red; font-size: 16px;" id="hr_level_name"></div>
    </div>
      </div>
    
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save"></i>  บันทึกข้อมูล</button>
         <a href="{{ url('admin_person/setupinfolevel')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" ><i class="fas fa-window-close"></i>  ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script>

$(document).ready(function() {
$('select').select2();
});

  function check_hr_level_name()
  {                         
    hr_level_name = document.getElementById("HR_LEVEL_NAME").value;             
          if (hr_level_name==null || hr_level_name==''){
          document.getElementById("hr_level_name").style.display = "";     
          text_hr_level_name = "*กรุณาระบุระดับ";
          document.getElementById("hr_level_name").innerHTML = text_hr_level_name;
          }else{
          document.getElementById("hr_level_name").style.display = "none";
          }
  }


 </script>
 <script>      
  $('form').submit(function () {
    var hr_level_name,text_hr_level_name;
    

    hr_level_name = document.getElementById("HR_LEVEL_NAME").value;
   


    if (hr_level_name==null || hr_level_name==''){
    document.getElementById("hr_level_name").style.display = "";     
    text_hr_level_name = "*กรุณาระบุระดับ";
    document.getElementById("hr_level_name").innerHTML = text_hr_level_name;
    }else{
    document.getElementById("hr_level_name").style.display = "none";
    }
   

    if(hr_level_name==null || hr_level_name==''           
    )
  {
  alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
  return false;   
  }
  }); 
</script>

<script>
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,  //Set เป็นปี พ.ศ.
                autoclose: true 
            });  //กำหนดเป็นวันปัจุบัน

      
});
    

</script>



@endsection