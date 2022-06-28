@extends('layouts.backend_admin')
  
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

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


@section('content')
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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อมูลประเภทการเบิก</h2>    

    
        <form  method="post" action="{{ route('admin.updatesuppliesordertype') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
    <div class="col-lg-2">
      <label >ประเภทการเบิก</label>
      </div>
      <div class="col-lg-3">
      <input  name = "SUPPLIES_ORDER_TYPE_NAME"  id="SUPPLIES_ORDER_TYPE_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliesordertype->SUPPLIES_ORDER_TYPE_NAME}}" onkeyup="check_suppliesordertypename();">
      <div style="color: red; font-size: 16px;" id="suppliesordertypename"></div> 
    </div>
    
      <input  type="hidden" name = "SUPPLIES_ORDER_TYPE_ID"  id="SUPPLIES_ORDER_TYPE_ID" class="form-control input-lg" value="{{$infosuppliesordertype->SUPPLIES_ORDER_TYPE_ID}}">
      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกแก้ไขข้อมูล</button>
         <a href="{{ url('admin_asset_supplies/setupsuppliesordertype')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
        
                  
      
                      

@endsection

@section('footer')


<script>   
    function check_suppliesordertypename()
    {                         
        suppliesordertypename = document.getElementById("SUPPLIES_ORDER_TYPE_NAME").value;             
            if (suppliesordertypename==null || suppliesordertypename==''){
            document.getElementById("suppliesordertypename").style.display = "";     
            text_suppliesordertypename = "*กรุณาระบุประเภทการเบิก";
            document.getElementById("suppliesordertypename").innerHTML = text_suppliesordertypename;
            }else{
            document.getElementById("suppliesordertypename").style.display = "none";
            }
    }
    

   </script>
    <script>      
    $('form').submit(function () {
     
      var suppliesordertypename,text_suppliesordertypename; 
     
      suppliesordertypename = document.getElementById("SUPPLIES_ORDER_TYPE_NAME").value; 
   
                     
      if (suppliesordertypename==null || suppliesordertypename==''){
      document.getElementById("suppliesordertypename").style.display = "";     
      text_suppliesordertypename = "*กรุณาระบุประเภทการเบิก";
      document.getElementById("suppliesordertypename").innerHTML = text_suppliesordertypename;
      }else{
      document.getElementById("suppliesordertypename").style.display = "none";
      }
  
  
      if(suppliesordertypename==null || suppliesordertypename==''     
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>



@endsection