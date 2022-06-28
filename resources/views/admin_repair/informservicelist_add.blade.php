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
?>
                    <!-- Advanced Tables -->             
<div class="content">
    <div class="block block-rounded block-bordered">
        <div class="block-content"> 
            <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มข้อมูลบริการอื่นฯ</h2>    
        <form  method="post" action="{{ route('admin.saveservicelist') }}" enctype="multipart/form-data">
            @csrf
            <div class="row push">
                <div class="col-lg-2">
                    <label >บริการอื่นฯ</label>
                </div>
                <div class="col-lg-4">
                    <input  name = "SERVICE_LIST_NAME"  id="SERVICE_LIST_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup=" check_servicelistname();">
                    <div style="color: red; font-size: 16px;" id="servicelistname"></div> 
                </div>
                <div class="col-lg-6">
                    
                </div>
            </div>
          
            <div class="modal-footer">
            <div align="right">
                <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save"></i> บันทึกข้อมูล</button>
                <a href="{{ url('admin_repair/Setupservicelist')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close"></i>  ยกเลิก</a> 
            </div>
        </div>
        </form>  
         
@endsection

@section('footer')

<script>   
    function check_servicelistname()
    {                         
        servicelistname = document.getElementById("SERVICE_LIST_NAME").value;             
            if (servicelistname==null || servicelistname==''){
            document.getElementById("servicelistname").style.display = "";     
            text_servicelistname = "*กรุณาระบุบริการอื่นฯ";
            document.getElementById("servicelistname").innerHTML = text_servicelistname;
            }else{
            document.getElementById("servicelistname").style.display = "none";
            }
    }
 

   </script>
    <script>      
    $('form').submit(function () {
     
      var servicelistname,text_servicelistname; 
     
     
      servicelistname = document.getElementById("SERVICE_LIST_NAME").value; 
     
   
                     
      if (servicelistname==null || servicelistname==''){
      document.getElementById("servicelistname").style.display = "";     
      text_servicelistname = "*กรุณาระบุบริการอื่นฯ";
      document.getElementById("servicelistname").innerHTML = text_servicelistname;
      }else{
      document.getElementById("servicelistname").style.display = "none";
      }
      
  
      if(servicelistname==null || servicelistname=='' 
         
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>

@endsection