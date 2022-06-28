@extends('layouts.person')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />


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

      .form-control{
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
            }

label{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
            
      }   

      input::-webkit-calendar-picker-indicator{ 
  
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


?>
<?php

  use App\Http\Controllers\PerdevController;
    $refnumber = PerdevController::refnuminside();
     $datenow = date('Y-m-d');


?>  
<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
          
            }
            .form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
            }

                .table-fixed tbody {
        height: 300px;
        overflow-y: auto;
        width: 100%;
    }
</style>

<center>

 <center>
            
         <div style="width:95%;" >
   <div class="block block-rounded block-bordered">
   <div class="block-content">    
   <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
    
    
     <div class="row">
             <div class="col-md-10" align="left">
                เพิ่มข้อมูลการประชุมภายใน
                     </div>
             <div class="col-md-2">
                
             </div>
         </div>
             </h2>   
                                     
        <form  method="post" action="{{ route('mperson.inforperson_meetinginside_save') }}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="iduser" id="iduser" value="{{ $id_user }}">

        <div class="row push">
        <div class="col-sm-2">
        <label>รหัสประชุม :</label>
        </div> 
        <div class="col-lg-2 ">                
                <input name="MEETING_INSIDE_CODE" id="MEETING_INSIDE_CODE" class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif;" value="{{$refnumber}} ">                
        </div> 
        <div class="col-sm-1 text-right">
            <label>ครั้งที่ :</label>
            </div> 
        <div class="col-lg-1">
            <input name="MEETING_INSIDE_NO" id="MEETING_INSIDE_NO" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >  
        </div> 
        <div class="col-sm-0.5 text-right">
            <label>ปีงบ :</label>
            </div> 
        <div class="col-lg-2">
            <span>
                <select name="MEETING_INSIDE_BUDGET" id="MEETING_INSIDE_BUDGET" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;">
                    @foreach ($budgets as $budget)
                        @if($budget->LEAVE_YEAR_ID== $year_id)
                            <option value="{{ $budget->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}</option>
                        @else
                            <option value="{{ $budget->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                        @endif                                 
                    @endforeach                         
                </select>
            </span> 
        </div> 
        <div class="col-sm-1">
            <label>วันที่ประชุม :</label>
        </div> 
        <div class="col-lg-2">
            <input name="MEETING_INSIDE_DATE" id="MEETING_INSIDE_DATE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" style=" font-family: 'Kanit', sans-serif;" value="{{formate($datenow)}}" readonly>
            </div> 
        </div>
       
        <div class="row push">
            <div class="col-sm-2">
                <label>ห้องประชุม :</label>
            </div> 
            <div class="col-lg-4">
                <select name="ROOM_ID" id="ROOM_ID" class="form-control input-lg budget {{ $errors->has('ROOM_ID') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;">
                    <option value="" selected>--กรุณาเลือก--</option>
                    @foreach ($rooms as $room)
                    <option value="{{ $room->ROOM_ID  }}">{{ $room->ROOM_NAME}}</option>
                @endforeach     
                    </select> 
        </div> 
        <div class="col-sm-0.5 text-right">
        <label>เวลา :</label>
       
        </div>
        <div class="col-lg-2">
            <input name="MEETING_INSIDE_STARTTIME" id="MEETING_INSIDE_STARTTIME" class="js-masked-time form-control input-lg " style=" font-family: 'Kanit', sans-serif;" >
          
        </div> 
        <div class="col-sm-1 text-right">
            <label>ถึง :</label>
            </div> 
            <div class="col-lg-2">
                <input name="MEETING_INSIDE_ENDTIME" id="MEETING_INSIDE_ENDTIME" class="js-masked-time form-control input-lg " style=" font-family: 'Kanit', sans-serif;" >
           
        </div> 
       </div>
       <div class="row push">
       <div class="col-sm-2">
        <label>หัวข้อประชุม :</label>
        </div> 
        <div class="col-lg-10">
        <input name="MEETING_INSIDE_TITLE" id="MEETING_INSIDE_TITLE" class="form-control input-lg {{ $errors->has('MEETING_INSIDE_TITLE') ? 'is-invalid' : '' }}" value="{{ old('MEETING_INSIDE_TITLE') }}" style=" font-family: 'Kanit', sans-serif;" >
       
    </div> 
       </div>
       <div class="row push">
        <div class="col-sm-2">
         <label>ประธาน :</label>
         </div> 
         <div class="col-lg-2">
            <select name="MEETING_INSIDE_PRESIDENT" id="MEETING_INSIDE_PRESIDENT" class="form-control input-lg {{ $errors->has('MEETING_INSIDE_PRESIDENT') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;">
                <option value="" selected>--กรุณาเลือก--</option>
                @foreach ($infopresidents as $infopresident)
                <option value="{{ $infopresident->ID  }}">{{ $infopresident->HR_FNAME}}&nbsp;&nbsp;  {{ $infopresident->HR_LNAME}}</option>
            @endforeach     
                </select> 
       
        </div> 
        <div class="col-sm-2">
            <label>ประเภทการประชุม :</label>
            </div> 
            <div class="col-lg-3">
                <select name="MEETING_INSIDE_TYPE" id="MEETING_INSIDE_TYPE" class="form-control input-lg addtype" style=" font-family: 'Kanit', sans-serif;" >
                    <option value="" selected>--กรุณาเลือก--</option>
                        @foreach ($meetting_inside_types as $meetting_inside_type)
                            <option value="{{ $meetting_inside_type->MEETTINGSIDE_ID  }}">{{ $meetting_inside_type->MEETTINGSIDE_NAME}}</option>
                        @endforeach             
                </select> 
            <div style="color: red; font-size: 16px;" id="record_location_id"></div> 
            </div>
            <div class="col-lg-2">
                <input type="text" class="form-control input-lg" id="ADD_RECORD_TYPE" name="ADD_RECORD_TYPE" style=" font-family: 'Kanit', sans-serif; background-color: #CCFFFF;" placeholder="ระบุประเภทการประชุม" >
            </div> 
            <div class="col-lg-1.2">
              
                <a class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;color:#FFFFFF;" onclick="addtype();"><i class="fas fa-plus"></i>&nbsp;&nbsp;เพิ่ม&nbsp;&nbsp;</a>
            </div> 
        </div>
      
   
        <div class="row push">
            <div class="col-sm-2">
                <label>ลิงก์ Google Drive :</label>
            </div> 
               
            <div class="col-lg-10">
                <input  name="MEETING_INSIDE_LOCATION" id="MEETING_INSIDE_LOCATION" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;">
            </div>
    </div>


        <hr>
            <div class="row push">
                <div class="col-lg-12">               
                    <div class="block block-rounded block-bordered">
                        <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #FFEBCD;">
                            <li class="nav-item">
                                <a class="nav-link active" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">บุคลากร</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#object2" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">บุคคลอื่น</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#object3" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">สมรรถนะที่ได้</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#object4" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">วิชาชีพ</a>
                            </li>
                        
                        
                        </ul>
                        <div class="block-content tab-content">
                            <div class="tab-pane active" id="object1" role="tabpanel">
                                <table class="gwt-table table-vcenter" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <td style="text-align: center;" width="7%" >ลำดับ</td>
                                            <td style="text-align: center;">ผู้เข้าร่วมประชุม</td>                                                                       
                                            <td style="text-align: center;" width="7%"><a  class="btn btn-hero-sm btn-hero-success addRow1" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                        </tr>
                                    </thead> 
                                    <tbody class="tbody1">   
                                        <tr>
                                            <td style="text-align: center;">1</td>
                                            <td> 
                                                <select name="MEETING_INSIDE_USER[]" id="MEETING_INSIDE_USER[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                    <option value="">--กรุณาเลือก--</option>
                                                        @foreach ($infopresidents as $infopresident)
                                                            <option value="{{ $infopresident->ID  }}">{{ $infopresident->HR_FNAME}}&nbsp;&nbsp;  {{ $infopresident->HR_LNAME}}</option>
                                                        @endforeach      
                                                </select>
                                            </td>    
                                            <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove1" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                        </tr>
                                    </tbody>   
                                </table>  
                                <br> 
                            </div>
                            
                            <div class="tab-pane" id="object2" role="tabpanel">
                                <table class="gwt-table table-vcenter" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <td style="text-align: center;" width="7%" >ลำดับ</td>
                                            <td style="text-align: center;" >บุคคลอื่น</td>
                                            <td style="text-align: center;" width="7%"><a  class="btn btn-hero-sm btn-hero-success addRow2" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                        </tr>
                                    </thead> 
                                    <tbody class="tbody2">                              
                                        <tr>
                                            <td style="text-align: center;">1</td>                                    
                                            <td> <input name="MEETING_INSIDE_USEROUT[]" id="MEETING_INSIDE_USEROUT[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"></td>                                        
                                          
                                            <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove2" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                        </tr>                                
                                    </tbody>   
                                </table> 
                                <br>                     
                            </div>
                        
                            <div class="tab-pane" id="object3" role="tabpanel">
                                <table class="gwt-table table-vcenter" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <td style="text-align: center;" width="7%" >ลำดับ</td>                                    
                                            <td style="text-align: center;" >สมรรถนะที่ได้</td>
                                            <td style="text-align: center;" width="7%"><a  class="btn btn-hero-sm btn-hero-success addRow3" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                        </tr>
                                    </thead> 
                                    <tbody class="tbody3">   
                                        <tr>
                                            <td style="text-align: center;">1</td>
                                            <td> <input name="MEETING_INSIDE_PERFORMANCE[]" id="MEETING_INSIDE_PERFORMANCE[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"></td>
                                            <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove3" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                        </tr>
                                    </tbody>   
                                </table> 
                                <br>
                            </div>
                        
                            <div class="tab-pane" id="object4" role="tabpanel">
                                <table class="gwt-table table-vcenter" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <td style="text-align: center;" width="7%" >ลำดับ</td>                                    
                                            <td style="text-align: center;" >วิชาชีพ</td>
                                            <td style="text-align: center;" width="7%"><a  class="btn btn-hero-sm btn-hero-success addRow4" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                        </tr>
                                    </thead> 
                                    <tbody class="tbody4">   
                                        <tr>
                                            <td style="text-align: center;">1</td>
                                            <td> <input name="MEETING_INSIDE_PROFESSION[]" id="MEETING_INSIDE_PROFESSION[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"></td>
                                            <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove4" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                        </tr>
                                    </tbody>   
                                </table> 
                                <br>
                            </div>

                        
                        </div>
                    </div>                    
                </div> 
            </div> 
                <div class="row push">
                    <div class="col-lg-12">  
                        <label>ไฟล์วาระการประชุมครั้งนี้ || เพื่อแจ้งไห้ผู้ประชุมทราบ</label> <br>                     
                        <input type="file" id="pdfupload" name="pdfupload" accept="application/pdf" style="font-family: 'Kanit', sans-serif; font-size:12px;width:100%;" />        
                        <div id="zoom-percent" style="text-align: right;background-color: #E6E6FA;">90</div>
                        
                        <a id="zoom-in" class="btn btn-hero-sm btn-hero-info" style="color:#F0FFFF"><i class="fa fa-search-plus"></i></a>
                        <a id="zoom-out" class="btn btn-hero-sm btn-hero-info" style="color:#F0FFFF"><i class="fa fa-search-minus"></i></a>
                        <a id="zoom-reset" class="btn btn-hero-sm btn-hero-info" style="color:#F0FFFF"><i class="fa fa-search"></i></a>
                    
                        <br>
                        <br>
                        <div style='overflow:scroll; width:auto;height:600px;  background-color: #404040;' id="pages"></div>                  
                </div>             
                
            </div>   
        <hr>

                <div align="right">
                  
                    <button type="submit" class="btn btn-hero-sm btn-hero-info"><i class="fas fa-save"></i> &nbsp; บันทึกข้อมูล&nbsp;&nbsp; </button>
                    <a href="{{url('manager_person/inforperson_meetinginside')}}" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close"></i> &nbsp; ยกเลิก&nbsp;&nbsp; </a>
                
                </div>    
            </div>         
        </div>
               
</form>


            <!-- Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style=" font-family: 'Kanit', sans-serif;">ประเภทการประชุม</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('perdev.personmeetinginside_type') }}" method="post">           
                            @csrf
                        <input type="hidden" name="ID_USER" id="ID_USER" value="{{ $id_user }}">
                        <div class="form-group row">
                            <label for="MEETTINGSIDE_NAME" class="col-sm-2 col-form-label">ประเภทการประชุม</label>
                            <div class="col-sm-10">
                            <input class="form-control input-lg" id="MEETTINGSIDE_NAME" name="MEETTINGSIDE_NAME" style=" font-family: 'Kanit', sans-serif;">
                            
                            </div>
                        </div>
                    
                    
                    </div>
                    <div class="modal-footer">
                    
                    <button type="submit" class="btn btn-hero-sm btn-hero-info"><i class="fas fa-save mr-2"></i>บันทึก&nbsp;&nbsp; </button>
                    <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal"><i class="fas fa-window-close mr-2"></i>ปิด &nbsp;&nbsp;</button>
                    </div>
                </div>
                </form>
                </div>
            </div>


@endsection

@section('footer')

<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script src="{{ asset('pdfupload/pdf_up.js') }}"></script>

<script>

$(document).ready(function() {
    $("select").select2();
});

function addtype(){
      
      var record_type=document.getElementById("ADD_RECORD_TYPE").value;
    
      //alert(record_location);
      
          var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('perdev.addtype')}}",
                   method:"GET",
                   data:{record_type:record_type,_token:_token},
                   success:function(result){
                      $('.addtype').html(result);
                   }
           })

  }



$(document).ready(function () {

var i = 1;
$('#add').click(function(){
    i++;
    $('dynamic_fileld').append('<tr id="row'+i+'"><td> <input name="name[]" id="name[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" ></td><td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
});
$(document).on('click','.btn_remove', function(){
    var button_id = $(this).attr("id");
    $('row'+button_id+'').remove();
});

});

$(document).ready(function () {
    
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: true,
        language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
        thaiyear: true,
        autoclose: true                    //Set เป็นปี พ.ศ.
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

//===============================เพิ่มสถานที่====================================
function addlocation(){

var record_location=document.getElementById("ADD_RECORD_LOCATION").value;

//alert(record_location);

var _token=$('input[name="_token"]').val();
$.ajax({
        url:"{{route('perdev.addlocation')}}",
        method:"GET",
        data:{record_location:record_location,_token:_token},
        success:function(result){
            $('.location_re').html(result);
        }
})

}

    
    $('.addRow1').on('click',function(){
             addRow1();
         });
    
         function addRow1(){
            var count = $('.tbody1').children('tr').length;
                var tr = '<tr>'+
                    '<td style="text-align: center;">'+
                        (count+1)+
                    '</td>'+
                        '<td>'+ 
                        '<select name="MEETING_INSIDE_USER[]" id="MEETING_INSIDE_USER[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+
                        '<option value="">--กรุณาเลือก--</option>'+
                        '@foreach ($infopresidents as $infopresident)'+
                        '<option value="{{ $infopresident->ID  }}">{{ $infopresident->HR_FNAME}}&nbsp;&nbsp;  {{ $infopresident->HR_LNAME}}</option>'+
                        '@endforeach'+      
                        '</select>'+
                        '</td>'+ 
                        '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove1" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                    '</tr>';
            $('.tbody1').append(tr);
         };
         $('.tbody1').on('click','.remove1', function(){
                $(this).parent().parent().remove();       
    });
    //==================================================================================
    $('.addRow2').on('click',function(){
             addRow2();
         });
    
         function addRow2(){
            var count = $('.tbody2').children('tr').length;
                var tr = '<tr>'+
                    '<td style="text-align: center;">'+
                        (count+1)+
                    '</td>'+
                        '<td>'+ 
                        '<input name="MEETING_INSIDE_USEROUT[]" id="MEETING_INSIDE_USEROUT[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;">'+                   
                        '</td>'+ 
                        '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove2" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                    '</tr>';
            $('.tbody2').append(tr);
         };
         $('.tbody2').on('click','.remove2', function(){
                $(this).parent().parent().remove();       
    });
    //==================================================================================
    $('.addRow3').on('click',function(){
             addRow3();
         });
    
         function addRow3(){
            var count = $('.tbody3').children('tr').length;
                var tr = '<tr>'+
                        '<td style="text-align: center;">'+
                            (count+1)+
                        '</td>'+
                        '<td>'+ 
                        '<input name="MEETING_INSIDE_PERFORMANCE[]" id="MEETING_INSIDE_PERFORMANCE[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;">'+                   
                        '</td>'+ 
                        '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove3" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                    '</tr>';
            $('.tbody3').append(tr);
         };
         $('.tbody3').on('click','.remove3', function(){
                $(this).parent().parent().remove();       
    });
    //==================================================================================
    $('.addRow4').on('click',function(){
             addRow4();
         });
    
         function addRow4(){
            var count = $('.tbody4').children('tr').length;
                var tr = '<tr>'+
                        '<td style="text-align: center;">'+
                            (count+1)+
                        '</td>'+
                        '<td>'+ 
                        '<input name="MEETING_INSIDE_PROFESSION[]" id="MEETING_INSIDE_PROFESSION[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;">'+                   
                        '</td>'+ 
                        '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove4" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                    '</tr>';
            $('.tbody4').append(tr);
         };
         $('.tbody4').on('click','.remove4', function(){
                $(this).parent().parent().remove();       
    });
    </script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc =
    "{{ asset('pdfupload/pdf_upwork.js') }}";
    
      document.querySelector("#pdfupload").addEventListener("change", function(e){
      document.querySelector("#pages").innerHTML = "";
    
        var file = e.target.files[0]
        if(file.type != "application/pdf"){
            alert(file.name + " is not a pdf file.")
            return
        }
        
        var fileReader = new FileReader();  
    
        fileReader.onload = function() {
            var typedarray = new Uint8Array(this.result);
        
            pdfjsLib.getDocument(typedarray).promise.then(function(pdf) {
                // you can now use *pdf* here
                console.log("the pdf has", pdf.numPages, "page(s).");
          for (var i = 0; i < pdf.numPages; i++) {
            (function(pageNum){
            pdf.getPage(i+1).then(function(page) {
              // you can now use *page* here
              var viewport = page.getViewport(2.0);
              var pageNumDiv = document.createElement("div");
              pageNumDiv.className = "pageNumber";
              pageNumDiv.innerHTML = "Page " + pageNum;
              var canvas = document.createElement("canvas");
              canvas.className = "page";
              canvas.title = "Page " + pageNum;
              document.querySelector("#pages").appendChild(pageNumDiv);
              document.querySelector("#pages").appendChild(canvas);
              canvas.height = viewport.height;
              canvas.width = viewport.width;
    
    
              page.render({
                canvasContext: canvas.getContext('2d'),
                viewport: viewport
              }).promise.then(function(){
                console.log('Page rendered');
              });
              page.getTextContent().then(function(text){
                  console.log(text);
              });
            });
            })(i+1);
          }
    
            });
        };
     
        fileReader.readAsArrayBuffer(file);  
    
    });
    
    var curWidth = 90;
    function zoomIn(){
        if (curWidth < 150) {
            curWidth += 10;
            document.querySelector("#zoom-percent").innerHTML = curWidth;
            document.querySelectorAll(".page").forEach(function(page){
    
                page.style.width = curWidth + "%";
            });
        }
    }
    function zoomOut(){
        if (curWidth > 20) {
            curWidth -= 10;
            document.querySelector("#zoom-percent").innerHTML = curWidth;
            document.querySelectorAll(".page").forEach(function(page){
    
                page.style.width = curWidth + "%";
            });
        }
    }
    function zoomReset(){
    
        curWidth = 90;
        document.querySelector("#zoom-percent").innerHTML = curWidth;
       
        document.querySelectorAll(".page").forEach(function(page){
          page.style.width = curWidth + "%";
        });
    }
    document.querySelector("#zoom-in").onclick = zoomIn;
    document.querySelector("#zoom-out").onclick = zoomOut;
    document.querySelector("#zoom-reset").onclick = zoomReset;
    window.onkeypress = function(e){
        if (e.code == "Equal") {
            zoomIn();
        }
        if (e.code == "Minus") {
            zoomOut();
        }
    };
    
    </script>

@endsection