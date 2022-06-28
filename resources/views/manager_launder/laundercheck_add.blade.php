@extends('layouts.launder')
  
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

label{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
       
      } 

      .form-control{
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


function Removeformate($strDate)
{
  $strYear = date("Y",strtotime($strDate));
  $strMonth= date("m",strtotime($strDate));
  $strDay= date("d",strtotime($strDate));

  
  return $strDay."/".$strMonth."/".$strYear;
  }

  use App\Http\Controllers\ManagerlaunderController;
  $refcheck = ManagerlaunderController::refcheck();
?>
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B><i class="fas fa-plus"></i> เพิ่มข้อมูลตรวจรับผ้า</B></h3>
                <div align="right">
            
                    </div>
                </div>
                </div>
                

                <div class="block-content block-content-full" style="width: 95%;">


    
        <form  method="post" action="{{ route('launder.laundercheck_update') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
                <div class="col-lg-1">
                    <label >เลขที่รับ</label>
                </div>
                    <div class="col-lg-2">
                        <input  name = "LAUNDER_CHECK_CODE"  id="LAUNDER_CHECK_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$refcheck}}">
                    </div>
                
                <div class="col-lg-1">
                    <label >วันที่</label>
                </div>
                    <div class="col-lg-2">
                        <input  name = "LAUNDER_CHECK_DATE"  id="LAUNDER_CHECK_DATE" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;" value="{{formate(date('Y-m-d'))}}" readonly>
                    </div>
                <div class="col-lg-1">
                    <label >เวลา</label>
                </div>
                    <div class="col-lg-2">
                        <input  name = "LAUNDER_CHECK_TIME"  id="LAUNDER_CHECK_TIME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{date('H:i')}}">
                    </div>

                    <div class="col-lg-1">
                    <label >หน่วยงาน</label>
                </div>
                    <div class="col-lg-2">

                    @if($infodep == '')
                                <select name="LAUNDER_CHECK_DEP" id="LAUNDER_CHECK_DEP" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;">
                                <option value="">เลือก</option>
                                @foreach ($infodepselects as $infodepselect)
                                    <option value="{{ $infodepselect->LAUNDER_DEP_CODE  }}">{{ $infodepselect->LAUNDER_DEP_NAME}}</option>
                                    @endforeach          
                                </select>        
                    @else
                        {{$infodep->HR_DEPARTMENT_SUB_SUB_NAME}}
                        <input type="hidden"  name = "LAUNDER_CHECK_DEP"  id="LAUNDER_CHECK_DEP" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infodep->HR_DEPARTMENT_SUB_SUB_ID}}" >
                    
                    @endif
                    
                    </div>

           

          

      </div>
      <div class="row push">

           
               

                    <div class="col-lg-1">
                    <label >เจ้าหน้าที่</label>
                </div>
                    <div class="col-lg-2">
 
                        {{$infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}
                        <input type="hidden"  name = "LAUNDER_CHECK_HR_ID"  id="LAUNDER_CHECK_HR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoperson->ID}}">
                        <input type="hidden"  name = "LAUNDER_CHECK_HR_NAME"  id="LAUNDER_CHECK_HR_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}">
                    </div>

                    <div class="col-lg-1">
                    <label >รับจาก</label>
                    </div>
                    <div class="col-lg-2">
                    
                        <select name="LAUNDER_CHECK_FROM" id="LAUNDER_CHECK_FROM" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                <option value="0" >--กรุณาเลือก--</option>
                                <option value="1" >ภายในองค์กร</option>
                                <option value="2" >ภายนอกองค์กร</option>
                              
                        </select>
                    </div>

                    <div class="col-lg-1">
                        <label >ระบุสถานที่</label>
                    </div>
                    <div class="col-lg-4">
                        <input  name = "LAUNDER_CHECK_ACCEPT"  id="LAUNDER_CHECK_ACCEPT" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                    </div>
                    


                    </div>


                
                        
                    <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                                        <thead style="background-color: #F0F8FF;">
                                            <tr>
                                                <td style="text-align: center;border: 1px solid black;">รายการผ้า</td>
                                                <td style="text-align: center;border: 1px solid black;" width="15%">จำนวน</td>
                                             
                                           
                                                <td style="text-align: center;border: 1px solid black;" width="12%"><a  class="btn btn-success fa fa-plus addRow1" style="color:#FFFFFF;"></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody1"> 
                                     
                                           <div >

                                                <tr>         
                                                    <td style="border: 1px solid black;"> 
                                                    <select name="LAUNDER_CHECK_SUB_TYPE[]" id="LAUNDER_CHECK_SUB_TYPE[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                                        <option value="" >--กรุณาเลือก--</option>
                                                        @foreach ($infotypes as $infotype)
                                                        <option value="{{ $infotype->LAUNDER_TYPE_ID}}" >{{$infotype->LAUNDER_TYPE_NAME}}</option>
                                                        @endforeach   
                                                    </select>
                                                    </td>
                                                    <td style="border: 1px solid black;"> 
                                                    <input   name="LAUNDER_CHECK_SUB_AMOUNT[]" id="LAUNDER_CHECK_SUB_AMOUNT[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                                                    </td>       
                                                
                                                    <td style="text-align: center;border: 1px solid black;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                                                </tr>

                                         </div>

                                        </tbody>   
                    </table>
                       
              
      </div>
   

        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif; font-weight: normal;">บันทึกข้อมูล</button>
         <a href="{{ url('manager_launder/launder_getre')  }}" class="btn btn-hero-sm btn-hero-danger" style="font-family: 'Kanit', sans-serif; font-weight: normal;" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script>

$(document).ready(function() {
$('select').select2();
});

   
  function check_record_branch_name()
  {                         
    record_branch_name = document.getElementById("RECORD_BRANCH_NAME").value;             
          if (record_branch_name==null || record_branch_name==''){
          document.getElementById("record_branch_name").style.display = "";     
          text_record_branch_name = "*กรุณาระบุชื่อสาขา";
          document.getElementById("record_branch_name").innerHTML = text_record_branch_name;
          }else{
          document.getElementById("record_branch_name").style.display = "none";
          }
  } 
 
 </script>
 <script>      
  $('form').submit(function () {
   
    var record_branch_name,text_record_branch_name;
        
    record_branch_name = document.getElementById("RECORD_BRANCH_NAME").value;
     
    if (record_branch_name==null || record_branch_name==''){
    document.getElementById("record_branch_name").style.display = "";     
    text_record_branch_name = "*กรุณาระบุชื่อสาขา";
    document.getElementById("record_branch_name").innerHTML = text_record_branch_name;
    }else{
    document.getElementById("record_branch_name").style.display = "none";
    }
   
   

    if(record_branch_name==null || record_branch_name==''
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




$('.addRow1').on('click',function(){
        addRow1();
        $('select').select2();
        });

    function addRow1(){
        var count = $('.tbody1').children('tr').length;
            var tr =  '<tr>'+         
                         '<td style="border: 1px solid black;">'+ 
                        '<select name="LAUNDER_CHECK_SUB_TYPE[]" id="LAUNDER_CHECK_SUB_TYPE[]" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
                        '<option value="" >--กรุณาเลือก--</option>'+
                        '@foreach ($infotypes as $infotype)'+
                        '<option value="{{ $infotype->LAUNDER_TYPE_ID}}" >{{$infotype->LAUNDER_TYPE_NAME}}</option>'+
                        '@endforeach'+   
                        '</select>'+
                        '</td>'+
                         '<td style="border: 1px solid black;">'+ 
                        '<input   name="LAUNDER_CHECK_SUB_AMOUNT[]" id="LAUNDER_CHECK_SUB_AMOUNT[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                        '</td>'+       
                        '<td style="text-align: center;border: 1px solid black;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
                        '</tr>';
        $('.tbody1').append(tr);
    };

    $('.tbody1').on('click','.remove', function(){
        $(this).parent().parent().remove();
});  
  

    

</script>



@endsection