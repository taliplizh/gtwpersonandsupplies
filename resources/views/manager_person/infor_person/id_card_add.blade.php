@extends('layouts.backend_person')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

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
?>
           
                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content content-full">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size: 1.3rem;font-weight:normal;">{{ $inforpersonusercard -> HR_PREFIX_NAME }}   {{ $inforpersonusercard -> HR_FNAME }}  {{ $inforpersonusercard -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="content">
                <div class="block block-rounded block-bordered">

            
                <div class="block-content">    
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"> เพิ่มข้อมูลบัตรประจำตัว</h2> 
                        
        <form  method="post" action="{{ route('mperson.card_save') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
        <div class="col-lg-4">
        <div class="form-group">
        <img id="image_upload_preview"   height="250px" width="100%"/>
        </div>                             
        <div class="form-group">
        <input style="font-family: 'Kanit', sans-serif;" type="file" name="picture" id="picture" class="form-control">
        </div>
         </div>
       
    <div class="col-lg-4">
      <div class="form-group">
      <div class="row">
       <div class="col-sm-3 text-left">
      <label >เลขบัตร</label>
      </div>
       <div class="col-sm-9"> 
      <input  name = "CARD_CODE"  id="CARD_CODE" class="form-control input-lg" OnKeyPress="return chkNumber(this)" maxlength="13" style=" font-family: 'Kanit', sans-serif;" >
      </div>
      </div>
      </div>

      <div class="form-group">
      <div class="row">
       <div class="col-sm-4">
      <label >วันที่รับ</label>
      </div>
       <div class="col-sm-8"> 
      <input  name = "DATE_RECEIVE"  id="DATE_RECEIVE"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" readonly>
      </div>
      </div>
      </div>

      <div class="form-group">
      <div class="row">
       <div class="col-sm-4">
      <label >วันที่หมดอายุ</label>
      </div>
       <div class="col-sm-8"> 
      <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" style=" font-family: 'Kanit', sans-serif;" readonly>
      </div>
      </div>
      </div>
      
      <div class="form-group">
      <div class="row">
       <div class="col-sm-4">
      <label >หมายเหตุ</label>
    
      </div>
       <div class="col-sm-8"> 
      <input  name = "COMMENT"  id="COMMENT" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
      </div>
      </div>
      </div>
   
      <input type="hidden" name = "PERSON_ID"  id="PERSON_ID"  value="{{ $inforpersonusercardid ->ID }} ">
      <input type="hidden" name = "USER_EDIT_ID"  id="USER_EDIT_ID" value="{{ $id_user }} ">

      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save"></i> &nbsp;บันทึกข้อมูล</button>
        <a href="{{ url('manager_person/inforperson/view/idcard/'.$inforpersonusercardid -> ID)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close"></i> &nbsp;ยกเลิก</a>
        </div>

       
        </div>
        </form>  


               
                      

@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script>
  $('#edit_modal').on('show.bs.modal', function(e) {
    var Id = $(e.relatedTarget).data('id');
    var VUTId = $(e.relatedTarget).data('vutid');
    $(e.currentTarget).find('input[name="ID"]').val(Id);
    $(e.currentTarget).find('select[id="VUT_ID_edit[]"]').val(VUTId);

});

$('img').bind('contextmenu', function(e){
    return false;
}); 

</script>

<script>
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                    //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });

    $(document).ready(function () {
            
            $('.datepicker2').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true              //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });

    $(document).ready(function () {
            
            $('.datepicker3').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true              //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });

    $(document).ready(function () {
            
            $('.datepicker4').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true              //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });

function chkNumber(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9')) return false;
ele.onKeyPress=vchar;
}

function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    

    $('body').on('keydown', 'input, select, textarea', function(e) {
    var self = $(this)
      , form = self.parents('form:eq(0)')
      , focusable
      , next
      ;
    if (e.keyCode == 13) {
        focusable = form.find('input,a,select,button,textarea').filter(':visible');
        next = focusable.eq(focusable.index(this)+1);
        if (next.length) {
            next.focus();
        } else {
            form.submit();
        }
        return false;
    }
});


    

function readURL(input) {
        var fileInput = document.getElementById('picture');
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();    
        var numb = input.files[0].size/1024;
   
                    if(numb > 64){
                        alert('กรุณาอัปโหลดไฟล์ขนาดไม่เกิน 64KB');
                            fileInput.value = '';
                            return false;
                        }
    		
                    if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                        var reader = new FileReader();
            
                        reader.onload = function (e) {
                            $('#image_upload_preview').attr('src', e.target.result);
                        }
            
                        reader.readAsDataURL(input.files[0]);
                    }else{
        
                                alert('กรุณาอัปโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif .');
                                fileInput.value = '';
                                return false;
       
                    }

                   


                }

            
                $("#picture").change(function () {
                    readURL(this);
                });


                function checkcancel() {
               
               var r = confirm("ต้องการยกเลิกการเพิ่มข้อมูล");
               if (r == true) {
                       window.location.href = "{{ url('person/personinfousercid')}}"
                 } else {
                       return false;   
                 }
                       }    
                  

  
</script>



@endsection