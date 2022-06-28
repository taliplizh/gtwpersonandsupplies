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
      font-size: 10px;
     
      }

label{
            font-family: 'Kanit', sans-serif;
            font-size: 10px;
            font-size: 1.0rem;
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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มข้อมูลกลุ่มกรรมการ</h2>    

    
        <form  method="post" action="{{ route('admin.savesuppliesboardlist') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
    <div class="col-lg-2">
      <label >กลุ่มกรรมการ</label>
      </div>
      <div class="col-lg-6">
      <input  name = "BOARD_GROUP_NAME"  id="BOARD_GROUP_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_boardgroupname();">
      <div style="color: red; font-size: 16px;" id="boardgroupname"></div> 
    </div>


   

      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
         <a href="{{ url('admin_asset_supplies/setupsuppliesboardlist')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
        
                  
      
                      

@endsection

@section('footer')


<script>   
    function check_boardgroupname()
    {                         
        boardgroupname = document.getElementById("BOARD_GROUP_NAME").value;             
            if (boardgroupname==null || boardgroupname==''){
            document.getElementById("boardgroupname").style.display = "";     
            text_boardgroupname = "*กรุณาระบุกลุ่มกรรมการ";
            document.getElementById("boardgroupname").innerHTML = text_boardgroupname;
            }else{
            document.getElementById("boardgroupname").style.display = "none";
            }
    }
    

   </script>
    <script>      
    $('form').submit(function () {
     
      var boardgroupname,text_boardgroupname; 
     
      boardgroupname = document.getElementById("BOARD_GROUP_NAME").value; 
   
                     
      if (boardgroupname==null || boardgroupname==''){
      document.getElementById("boardgroupname").style.display = "";     
      text_boardgroupname = "*กรุณาระบุกลุ่มกรรมการ";
      document.getElementById("boardgroupname").innerHTML = text_boardgroupname;
      }else{
      document.getElementById("boardgroupname").style.display = "none";
      }
  
  
      if(boardgroupname==null || boardgroupname==''     
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>



@endsection