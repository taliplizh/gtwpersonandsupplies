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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อมูลอุปกรณ์โสด</h2>    

    
        <form  method="post" action="{{ route('admin.updateroomarticle') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
    <div class="col-lg-1">

      <label >อุปกรณ์โสด</label>
      </div>
      <div class="col-lg-3">
      <input  name = "ARTICLE_NAME"  id="ARTICLE_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoarticle->ARTICLE_NAME}}" onkeyup="check_article_name();">
      <div style="color: red; font-size: 16px;" id="article_name"></div> 
    </div>
    
      <input  type="hidden" name = "ARTICLE_ID"  id="ARTICLE_ID" class="form-control input-lg" value="{{$infoarticle->ARTICLE_ID}}">
      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกแก้ไขข้อมูล</button>
         <a href="{{ url('admin_meeting/setupinforoomarticle')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
        
                  
      
                      

@endsection

@section('footer')

<script>
   
    function check_article_name()
    {                         
      article_name = document.getElementById("ARTICLE_NAME").value;             
            if (article_name==null || article_name==''){
            document.getElementById("article_name").style.display = "";     
            text_article_name = "*กรุณาระบุอุปกรณ์โสต";
            document.getElementById("article_name").innerHTML = text_article_name;
            }else{
            document.getElementById("article_name").style.display = "none";
            }
    }
  
   
   </script>
   <script>      
    $('form').submit(function () {
     
      var article_name,text_article_name;
               
      article_name = document.getElementById("ARTICLE_NAME").value;
           
       
      if (article_name==null || article_name==''){
      document.getElementById("article_name").style.display = "";     
      text_article_name = "*กรุณาระบุอุปกรณ์โสด";
      document.getElementById("article_name").innerHTML = text_article_name;
      }else{
      document.getElementById("article_name").style.display = "none";
      }
     
      if(article_name==null || article_name=='')
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
  </script>


<script>



@endsection