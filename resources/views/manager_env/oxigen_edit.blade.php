@extends('layouts.env')
   
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
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
    date_default_timezone_set("Asia/Bangkok");
    $date = date('Y-m-d');
?>
<br>
<br><br>
<center>    
     <div class="block" style="width: 95%;" >
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <div align="left">
                    <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขการตรวจเช็คออกซิเจนเหลว</B></h3>
                </div>
               
               

            </div>
        <div class="block-content block-content-full">
            <form action="{{ route('menv.oxigen_update') }}" method="post">
                @csrf       
                <input value="{{$oxis->OXIGEN_ID}}" type="hidden" name="OXIGEN_ID" id="OXIGEN_ID" class="form-control input-lg" >
                <div class="row push">
                    <div class="col-sm-2 text-left">
                    <label>OXIGEN_NO :</label>
                    </div> 
                    <div class="col-lg-2">              
                    <input value="{{ $oxis->OXIGEN_BILL_NO}}"  name="OXIGEN_BILL_NO" id="OXIGEN_BILL_NO"  class="form-control input-lg fo13" readonly>
                    </div> 
                    <div class="col-sm-1 ">
                        <label>วันที่บันทึก :</label>
                        </div> 
                        <div class="col-lg-2 ">              
                        <input value="{{formate($oxis->OXIGEN_DATE)}}"  name="OXIGEN_DATE" id="OXIGEN_DATE" class="form-control input-lg datepicker fo13" data-date-format="mm/dd/yyyy" readonly >
                        </div>
                        <div class="col-sm-1 ">
                            <label>เวลา :</label>
                            </div> 
                            <div class="col-lg-1 ">              
                            <input value="{{ $oxis->OXIGEN_TIME}}"  name="OXIGEN_TIME" id="OXIGEN_TIME" class="js-masked-time form-control fo13">
                            </div> 
                    <div class="col-sm-1 ">
                    <label>ปี :</label>
                    </div> 
                    <div class="col-lg-1 "> 
                        <span>
                            <select name="OXIGEN_YEAR" id="OXIGEN_YEAR" class="form-control input-lg fo13">
                            @foreach ($budgets as $budget)
                            @if($budget->LEAVE_YEAR_ID == $oxis->OXIGEN_YEAR)
                                <option value="{{ $budget->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}</option>
                            @else
                                <option value="{{ $budget->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                            @endif                                 
                        @endforeach                         
                            </select>
                        </span> 
                    </div> 
                 
                        </div>

                        <div class="row push">                           
                            <div class="col-sm-2 text-left">
                                <label>ผู้ตรวจสอบ :</label>
                                </div> 
                                <div class="col-lg-4 ">
                                <span>
                                <select name="OXIGEN_CHECK" id="OXIGEN_CHECK" class="form-control input-lg js-example-basic-single fo13">
                                    <option value="">--เลือก--</option>
                                    @foreach ($infopers as $infoper)
                                    @if($infoper->ID == $oxis->OXIGEN_CHECK)
                                    <option value="{{ $infoper->ID  }}" selected>{{ $infoper->HR_FNAME}}  {{ $infoper->HR_LNAME}}</option>
                                    @else
                                    <option value="{{ $infoper->ID  }}">{{ $infoper->HR_FNAME}}  {{ $infoper->HR_LNAME}}</option>
                                @endif
                                @endforeach 
                                    </select>
                                </span> 
                                </div> 
                               
                        <div class="col-sm-1 ">
                            <label>ผู้บันทึก :</label>
                            </div> 
                            <div class="col-lg-4 ">
                                <select name="OXIGEN_USER" id="OXIGEN_USER" class="form-control input-lg js-example-basic-single fo13">
                                    <option value="">--เลือก--</option>
                                    @foreach ($infopers as $infoper)
                                   
                                    @if($infoper->ID == $oxis->OXIGEN_USER)
                                    <option value="{{ $infoper->ID  }}" selected>{{ $infoper->HR_FNAME}}  {{ $infoper->HR_LNAME}}</option>
                                    @else
                                    <option value="{{ $infoper->ID  }}">{{ $infoper->HR_FNAME}}  {{ $infoper->HR_LNAME}}</option>
                                @endif
                                @endforeach 
                                    </select>
                            </div> 
                            </div>


                        <div class="row push">
                            <div class="col-sm-2 text-left">
                                <div  style=" font-family:'Kanit', sans-serif;font-size: 13px;font-weight:bold;">
                                    รายการตรวจเช็ค :
                                </div>
                            </div>
                            <div class="col-lg-9 ">
                                <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                                    <thead style="background-color: #BDFBC9;">
                                        <tr height="40">
                                            <td style="text-align: center;font-family: 'Kanit', sans-serif;font-size: 14px;font-family: 'Kanit', sans-serif;font-size: 13px;" width="5%">ลำดับ</td>
                                            <td style="text-align: center;font-family: 'Kanit', sans-serif;font-size: 14px;font-family: 'Kanit', sans-serif;font-size: 13px;" >รายการตรวจเช็ค</td> 
                                            <td style="text-align: center;font-family: 'Kanit', sans-serif;font-size: 14px;font-family: 'Kanit', sans-serif;font-size: 13px;" width="15%">ค่าวัด</td>   
                                            <td style="text-align: center;font-family: 'Kanit', sans-serif;font-size: 14px;font-family: 'Kanit', sans-serif;font-size: 13px;" width="15%">หน่วย</td>                                         
                                            
                                        </tr>
                                    </thead>
                                    <tbody class="tbody">
                                        <?php $number = 0; ?>
                                        @foreach($oxi_subs as $oxi_sub)
                                        <?php $number++;  ?>
                                        <tr height="20"> 
                                            
                                            <td style="text-align: center;font-family: 'Kanit', sans-serif;font-size: 13px;"> {{ $number}}  </td>                                           
                                           <td>
                                            <input value="{{ $oxi_sub->OXIGEN_SUB_SET_OXIGEN_NAME }}" name="OXIGEN_SUB_SET_OXIGEN_NAME[]" id="OXIGEN_SUB_SET_OXIGEN_NAME[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" readonly>
                                            
                                           </td>
                                            <td>
                                                <input value="{{ $oxi_sub->OXIGEN_SUB_SET_OXIGEN_QTY }}" name="OXIGEN_SUB_SET_OXIGEN_QTY[]" id="OXIGEN_SUB_SET_OXIGEN_QTY[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                            </td>   
                                            <td>
                                                <input value="{{ $oxi_sub->OXIGEN_SUB_SET_OXIGEN_UNIT }}" name="OXIGEN_SUB_SET_OXIGEN_UNIT[]" id="OXIGEN_SUB_SET_OXIGEN_UNIT[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" readonly>
                                            </td>                               
                                           
                                           
                                        </tr>
                                        @endforeach 
                                    </tbody>
                                </table>   
                            </div> 
                        </div>
                        <hr>

                <div class="footer">
                    <div align="right">
                        <button type="submit" class="btn btn-hero-sm btn-hero-info foo15" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                            <a href="{{ url('manager_env/oxigen')}}" class="btn btn-hero-sm btn-hero-danger foo15" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
                    </div>
                </div>
        </div>
    </div>


@endsection

@section('footer')

<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
 <script>
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });

   

    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    
$('.addRow').on('click',function(){
        addRow();
    });

    function addRow(){
    var count = $('.tbody').children('tr').length;
        var tr =   '<tr>'+
                '<td style="text-align: center;">'+
                (count+1)+
                '</td>'+
                '<td>'+
                '<select name="OXIGEN_SUB_SET_OXIGEN_NAME[]" id="OXIGEN_SUB_SET_OXIGEN_NAME[]" class="form-control  input-lg" style=" font-family: \'Kanit\', sans-serif;font-size: 13px;">'+
                '<option value="">--เลือก--</option>'+
                '@foreach ($set_oxigens as $set_oxigen)'+
                '<option value="{{ $set_oxigen->SET_OXIGEN_ID  }}">{{ $set_oxigen->SET_OXIGEN_NAME}}</option>'+
                '@endforeach'+ 
                '</select>'+
                '</td>'+   
                '<td>'+
                '<input name="OXIGEN_SUB_SET_OXIGEN_QTY[]" id="OXIGEN_SUB_SET_OXIGEN_QTY[]" class="form-control input-sm" style=" font-family:\'Kanit\', sans-serif;font-size: 13px;">'+
                '</td>'+   
                '<td>'+
                '<input name="OXIGEN_SUB_SET_OXIGEN_UNIT[]" id="OXIGEN_SUB_SET_OXIGEN_UNIT[]" class="form-control input-sm" style=" font-family:\'Kanit\', sans-serif;font-size: 13px;">'+
                '</td>'+
                '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
                '</tr>';
    $('.tbody').append(tr);
    };

    $('.tbody').on('click','.remove', function(){
        $(this).parent().parent().remove();
});  
</script>



@endsection