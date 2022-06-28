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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มข้อมูลตำแหน่งทีมนำองค์กร</h2>    

    
        <form  method="post" action="{{ route('admin.saveteamposition') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
      <div class="col-lg-1">    
      <label >ชื่อตำแหน่ง</label>
      </div>
      <div class="col-lg-3">
      <input name="TEAM_POSITION_NAME" id="TEAM_POSITION_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_team_position_name();">
      <div style="color: red; font-size: 16px;" id="team_position_name"></div>
    </div>
 


      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save"></i>   บันทึกข้อมูล</button>
         <a href="{{ url('admin_person/setupinfopersonteamposition')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close"></i>  ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script>
   
    function check_team_position_name()
    {                         
      team_position_name = document.getElementById("TEAM_POSITION_NAME").value;             
            if (team_position_name==null || team_position_name==''){
            document.getElementById("team_position_name").style.display = "";     
            text_team_position_name = "*กรุณาระบุชื่อตำแหน่ง";
            document.getElementById("team_position_name").innerHTML = text_team_position_name;
            }else{
            document.getElementById("team_position_name").style.display = "none";
            }
    } 
   
   </script>
   <script>      
    $('form').submit(function () {
     
      var team_position_name,text_team_position_name;
           
       
      team_position_name = document.getElementById("TEAM_POSITION_NAME").value;
          
       
      if (team_position_name==null || team_position_name==''){
      document.getElementById("team_position_name").style.display = "";     
      text_team_position_name = "*กรุณาระบุชื่อตำแหน่ง";
      document.getElementById("team_position_name").innerHTML = text_team_position_name;
      }else{
      document.getElementById("team_position_name").style.display = "none";
      }

     
  
      if(team_position_name==null || team_position_name==''        
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