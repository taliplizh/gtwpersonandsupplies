@extends('layouts.backend_admin')
  
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
?>

           
                    <!-- Advanced Tables -->
                 
                <div class="content">
                <div class="block block-rounded block-bordered">

                <div class="block-content"> 
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มข้อมูลประเภทการลงเวลา</h2>    

    
        <form  method="post" action="{{ route('admin.savecheintype') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
    <div class="col-lg-2">
      <label >ประเภทการลงเวลา</label>
      </div>
      <div class="col-lg-3">
      <input  name = "CHECKIN_TYPE_NAME"  id="CHECKIN_TYPE_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_checkin_type_name();">
      <div style="color: red; font-size: 16px;" id="checkin_type_name"></div> 
    </div>
     

      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
         <a href="{{ url('admin_checkin/setupcheckintype')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
                 

@endsection

@section('footer')

<script>
   
    function check_checkin_type_name()
    {                         
      checkin_type_name = document.getElementById("CHECKIN_TYPE_NAME").value;             
            if (checkin_type_name==null || checkin_type_name==''){
            document.getElementById("checkin_type_name").style.display = "";     
            text_checkin_type_name = "*กรุณาระบุประเภทการลงเวลา";
            document.getElementById("checkin_type_name").innerHTML = text_checkin_type_name;
            }else{
            document.getElementById("checkin_type_name").style.display = "none";
            }
    }
   
   </script>
   <script>      
    $('form').submit(function () {
     
      var checkin_type_name,text_checkin_type_name;
     
      checkin_type_name = document.getElementById("CHECKIN_TYPE_NAME").value;
                
       
      if (checkin_type_name==null || checkin_type_name==''){
      document.getElementById("checkin_type_name").style.display = "";     
      text_checkin_type_name = "*กรุณาระบุประเภทการลงเวลา";
      document.getElementById("checkin_type_name").innerHTML = text_checkin_type_name;
      }else{
      document.getElementById("checkin_type_name").style.display = "none";
      }
        
      if(checkin_type_name==null || checkin_type_name==''
    )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
  </script>


<script>



@endsection