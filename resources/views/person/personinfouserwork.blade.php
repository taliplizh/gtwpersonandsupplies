@extends('layouts.backend')
  
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
            font-size: 14px;
      }

      
   .text-pedding{
   padding-left:10px;
   padding-right:10px;
                    }

        .text-font {
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

  
?>

           
                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content content-full">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuserwork -> HR_PREFIX_NAME }}   {{ $inforpersonuserwork -> HR_FNAME }}  {{ $inforpersonuserwork -> HR_LNAME }}</h1>
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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ข้อมูลการทำงาน</h2>  
                        <button type="button" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target=".add" ><i class="fas fa-plus"></i> เพิ่มข้อมูลการทำงาน</button>
                        <div class="mt-3">
                        <div class="table-responsive">      
                
                  <table class="gwt-table table-striped table-vcenter" width="100%">
                  <thead style="background-color: #FFEBCD; ">
                  
                  <tr height="40">
                        <th class="text-font" width="10%" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">วันเริ่มทำงาน</th>
                        <th class="text-font" width="10%" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">วันที่ออก</th>
                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">สาเหตุที่ออก</th>       
                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ตำแหน่งที่ได้รับ</th>
                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ชื่อหน่วยงาน</th>
                        <th class="text-font" width="15%" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">เงินเดือนที่ได้รับ</th>
                        
                        <th  class="text-font" width="8%" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">คำสั่ง</th> 
                        
                      </tr>
                   </thead>
                   <tbody>
                   @foreach ($infoworks as $infowork)
                   <tr height="20">
                     <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ DateThai($infowork-> DATEDO_WORK)}} </td> 
                     <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ DateThai($infowork-> DATEDO_EXIT)}} </td> 
                     <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infowork-> BECOURSE_EXIT }}</td> 
                     <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infowork-> POSITION_WORK }}</td> 
                     <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infowork-> LOCATION_WORK }}</td> 
                     <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: right;border: 1px solid black;">{{ number_format($infowork-> SALARY,2) }}</td>             
                     
                     <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                     <div class="dropdown">
                     <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                    <a class="dropdown-item" href="#edit_modal{{ $infowork -> ID }}" data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                    <a class="dropdown-item" href="{{ url('addpersoninfouserwork/destroy/'.$infowork->ID.'/'.$infowork->PERSON_ID)  }}" onclick="return confirm('ต้องการที่จะลบข้อมูลการทำงาน ?')" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ลบข้อมูล</a>
                                                  
                                                </div>
                    </div>
                     </td>                       

                   </tr> 

                   <div id="edit_modal{{ $infowork -> ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
     
          <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">แก้ไขข้อมูลการทำงาน</h2>
        </div>
        <div class="modal-body">
        <body>
        <form  method="post" id="form_edit{{ $infowork -> ID }}" action="{{ route('addwork.edit') }}">
        @csrf
        <input type="hidden" name="ID" value="{{ $infowork -> ID }}"/>
        <div class="form-group">
        <div class="row">
      <div class="col-sm-3 text-left">
      <label >วันเริ่มทำงาน</label>
      </div>
      <div class="col-sm-9">
      <input  name = "DATEDO_WORK_edit"  id="DATEDO_WORK_edit"  class="form-control input-lg datepicker3 {{ $errors->has('DATEDO_WORK_edit') ? 'is-invalid' : '' }}" data-date-format="mm/dd/yyyy" value="{{ formate($infowork -> DATEDO_WORK) }}" style=" font-family: 'Kanit', sans-serif;font-size: 14px;" readonly>
      </div>
      </div>
      </div>
      <div class="form-group">
      <div class="row">
      <div class="col-sm-3 text-left">
      <label >วันที่หมดวาระ</label>
      </div>
      <div class="col-sm-9">
      <input  name = "DATEDO_EXIT_edit"  id="DATEDO_EXIT_edit"  class="form-control input-lg datepicker4 {{ $errors->has('DATEDO_EXIT_edit') ? 'is-invalid' : '' }}" data-date-format="mm/dd/yyyy" value="{{ formate($infowork -> DATEDO_EXIT) }}" style=" font-family: 'Kanit', sans-serif;font-size: 14px;" readonly>
      </div>
      </div>
      </div>
      <div class="form-group">
      <div class="row">
      <div class="col-sm-3 text-left">
      <label >เหตุผลที่หมดวาระ</label>
      </div>
      <div class="col-sm-9">
      <input  name = "BECOURSE_EXIT_edit"  id="BECOURSE_EXIT_edit" class="form-control input-lg {{ $errors->has('BECOURSE_EXIT_edit') ? 'is-invalid' : '' }}" value="{{ $infowork -> BECOURSE_EXIT }}" style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
      </div>
      </div>
      </div>
      <div class="form-group">
      <div class="row">
      <div class="col-sm-3 text-left">
      <label >ตำแหน่ง</label>
      </div>
      <div class="col-sm-9">
      <input  name = "POSITION_WORK_edit"  id="POSITION_WORK_edit" class="form-control input-lg {{ $errors->has('POSITION_WORK_edit') ? 'is-invalid' : '' }}" value="{{ $infowork -> POSITION_WORK }}" style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
      </div>
      </div>
      </div>
      <div class="form-group">
      <div class="row">
      <div class="col-sm-3 text-left">
      <label >สถานที่</label>
      </div>
      <div class="col-sm-9">
      <input  name = "LOCATION_WORK_edit"  id="LOCATION_WORK_edit" class="form-control input-lg {{ $errors->has('LOCATION_WORK_edit') ? 'is-invalid' : '' }}" value="{{ $infowork -> LOCATION_WORK }}" style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
      </div>
      </div>
      </div>
      <div class="form-group">
      <div class="row">
      <div class="col-sm-3 text-left">
      <label >เงินเดือน</label>
      </div>
      <div class="col-sm-9">
      <input  name = "SALARY_edit"  id="SALARY_edit" class="form-control input-lg {{ $errors->has('SALARY_edit') ? 'is-invalid' : '' }}" OnKeyPress="return chkmunny(this)" value="{{ $infowork -> SALARY }}" style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
      </div>
      </div>
      </div>

      <input type="hidden" name = "PERSON_ID"  id="PERSON_ID"  value="{{ $inforpersonuserworkid ->ID }} ">
      <input type="hidden" name = "USER_EDIT_ID"  id="USER_EDIT_ID" value="{{ $id_user }} ">

      </div>
        <div class="modal-footer">
        <div align="right">
        <span type="button"  class="btn btn-hero-sm btn-hero-info btn-submit-edit" onclick="editnumber({{ $infowork -> ID }});"><i class="fas fa-save"></i> &nbsp;บันทึกแก้ไขข้อมูล</span>
        <span type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" ><i class="fas fa-window-close"></i> &nbsp;ยกเลิก</span>
        </div>
        </div>
        </form>  
</body>
     
     
    </div>
  </div>
</div>



                   @endforeach 
                   </tbody>
                  </table>

                      <br> 
                      <br> 
                      <br> 
                   </div>
               
                </div>

                <div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    <div class="modal-header">
          
          <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"> เพิ่มข้อมูลการทำงาน</h2>
        </div>
        <div class="modal-body">
        <body>
        <form  method="post" id="form_add" action="{{ route('addwork.save') }}" >
        @csrf
       
        <div class="form-group">
        <div class="row">
      <div class="col-sm-3 text-left">
      <label >วันเริ่มทำงาน</label>
      </div>
      <div class="col-sm-9">
      <input  name = "DATEDO_WORK"  id="DATEDO_WORK"  class="form-control input-lg datepicker {{ $errors->has('DATEDO_WORK') ? 'is-invalid' : '' }}" data-date-format="mm/dd/yyyy" value="" style=" font-family: 'Kanit', sans-serif;font-size: 14px;" readonly>
      </div>
      </div>
      </div>
      <div class="form-group">
      <div class="row">
      <div class="col-sm-3 text-left">
      <label >วันที่หมดวาระ</label>
      </div>
      <div class="col-sm-9">
      <input  name = "DATEDO_EXIT"  id="DATEDO_EXIT"  class="form-control input-lg datepicker2 {{ $errors->has('DATEDO_EXIT') ? 'is-invalid' : '' }}" data-date-format="mm/dd/yyyy" value="" style=" font-family: 'Kanit', sans-serif;font-size: 14px;" readonly>
      </div>
      </div>
      </div>
      <div class="form-group">
      <div class="row">
      <div class="col-sm-3 text-left">
      <label >เหตุผลที่หมดวาระ</label>
      </div>
      <div class="col-sm-9">
      <input  name = "BECOURSE_EXIT"  id="BECOURSE_EXIT" class="form-control input-lg {{ $errors->has('BECOURSE_EXIT') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
      </div>
      </div>
      </div>
      <div class="form-group">
      <div class="row">
      <div class="col-sm-3 text-left">
      <label >ตำแหน่ง</label>
      </div>
      <div class="col-sm-9">
      <input  name = "POSITION_WORK"  id="POSITION_WORK" class="form-control input-lg {{ $errors->has('POSITION_WORK') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
      </div>
      </div>
      </div>
      <div class="form-group">
      <div class="row">
      <div class="col-sm-3 text-left">
      <label >สถานที่</label>
      </div>
      <div class="col-sm-9">
      <input  name = "LOCATION_WORK"  id="LOCATION_WORK" class="form-control input-lg {{ $errors->has('LOCATION_WORK') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
      </div>
      </div>
      </div>
      <div class="form-group">
      <div class="row">
      <div class="col-sm-3 text-left">
      <label >เงินเดือน</label>
      </div>
      <div class="col-sm-9">
      <input  name = "SALARY"  id="SALARY" class="form-control input-lg {{ $errors->has('SALARY') ? 'is-invalid' : '' }}" OnKeyPress="return chkmunny(this)" style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
      </div>
      </div>
      </div>
     
   
      <input type="hidden" name = "PERSON_ID"  id="PERSON_ID"  value="{{ $inforpersonuserworkid ->ID }} ">
      <input type="hidden" name = "USER_EDIT_ID"  id="USER_EDIT_ID" value="{{ $id_user }} ">

      </div>
        <div class="modal-footer">
        <div align="right">
        <span type="button"  class="btn btn-hero-sm btn-hero-info btn-submit-add" ><i class="fas fa-save"></i> &nbsp;บันทึกข้อมูล</span>
        <span type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" ><i class="fas fa-window-close"></i> &nbsp;ยกเลิก</span>
        </div>
        </div>
        </form>  
</body>
     
  
    </div>
  </div>
</div>
<br>            
</div>
               
               </div>            
      
                      

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

</script>

<script>
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                        //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });

    $(document).ready(function () {
            
            $('.datepicker2').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                        //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });

    $(document).ready(function () {
            
            $('.datepicker3').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                        //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });

    $(document).ready(function () {
            
            $('.datepicker4').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                        //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });

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




$('.btn-submit-add').click(function (e) { 



var form = $('#form_add');
formSubmit(form)
       
});



function editnumber(number){ 
            var form = $('#form_edit'+number);
            formSubmit(form)      
            }
            
</script>



@endsection