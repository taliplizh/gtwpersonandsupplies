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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มข้อมูลชั้นความลับ</h2>    

    
        <form  method="post" action="{{ route('admin.savebooksecret') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
    <div class="col-lg-2">
      <label >ชั้นความลับ</label>
      </div>
      <div class="col-lg-3">
      <input  name = "BOOK_SECRET_NAME"  id="BOOK_SECRET_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_book_secret_name();">
      <div style="color: red; font-size: 16px;" id="book_secret_name"></div>  
    </div>
     

      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
         <a href="{{ url('admin_book/setupbooksecret')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>    

@endsection

@section('footer')

<script>
   
    function check_book_secret_name()
    {                         
        book_secret_name = document.getElementById("BOOK_SECRET_NAME").value;             
            if (book_secret_name==null || book_secret_name==''){
            document.getElementById("book_secret_name").style.display = "";     
            text_book_secret_name = "*กรุณาระบุชั้นความลับ";
            document.getElementById("book_secret_name").innerHTML = text_book_secret_name;
            }else{
            document.getElementById("book_secret_name").style.display = "none";
            }
    }
   
   
   </script>
   <script>      
    $('form').submit(function () {
     
      var book_secret_name,text_book_secret_name;
      
     
      book_secret_name = document.getElementById("BOOK_SECRET_NAME").value;
     
                
       
      if (book_secret_name==null || book_secret_name==''){
      document.getElementById("book_secret_name").style.display = "";     
      text_book_secret_name = "*กรุณาระบุชั้นความลับ";
      document.getElementById("book_secret_name").innerHTML = text_book_secret_name;
      }else{
      document.getElementById("book_secret_name").style.display = "none";
      }
     
        
      if(book_secret_name==null || book_secret_name==''
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
  </script>


<script>



@endsection