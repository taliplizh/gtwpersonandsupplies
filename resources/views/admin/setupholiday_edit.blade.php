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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อมูลวันหยุดนักขัตฤกษ์</h2>    

    
        <form  method="post" action="{{ route('admin.updateholiday') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
    <div class="col-lg-1">
      <input type="hidden"  name = "ID"  id="ID" value="{{ $infoholidays->ID }}">
      <label >วันที่หยุด</label>
      </div>
      <div class="col-lg-3">
      <input  name = "DATE_HOLIDAY"  id="DATE_HOLIDAY"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" value="{{ formate($infoholidays->DATE_HOLIDAY) }}" readonly>
      </div>
      <div class="col-lg-1">
      <label >รายละเอียด</label>
      </div>
      <div class="col-lg-3">
      <input  name = "DATE_COMMENT"  id="DATE_COMMENT" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $infoholidays->DATE_COMMENT }}">
      </div>
      <div class="col-lg-1">
      <label >ประเภทวัน</label>
      </div>
      <div class="col-lg-3">
      <select name="DATE_TYPE" id="DATE_TYPE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
            <option value="">--เลือกประเภทวัน--</option>
            @if( $infoholidays->DATE_TYPE == 'วันหยุดราชการ')
              <option value="วันหยุดราชการ" selected>วันหยุดราชการ</option>    
           @else
              <option value="วันหยุดราชการ">วันหยุดราชการ</option>    
              @endif

            @if($infoholidays->DATE_TYPE == 'หยุดชดเชย')
              <option value="หยุดชดเชย" selected>หยุดชดเชย</option>
            @else
              <option value="หยุดชดเชย">หยุดชดเชย</option>  
              @endif
                                                     
            
             </select>    
      </div>

    

      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
         <a href="{{ url('admin_leave/setupinfoholiday')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการบันทึกข้อมูล ?')" >ยกเลิก</a> 
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
                thaiyear: true,  //Set เป็นปี พ.ศ.
                autoclose: true 
            });  //กำหนดเป็นวันปัจุบัน

      
});
    

</script>



@endsection