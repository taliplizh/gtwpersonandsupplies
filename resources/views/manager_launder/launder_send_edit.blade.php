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
  $refsend = ManagerlaunderController::refsend();

?>
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขข้อมูลส่งผ้า</B></h3>
               
                </div>
                </div>
                

                <div class="block-content block-content-full" style="width: 95%;">


    
                <form  method="post" action="{{ route('launder.launderdisburse_updateedit') }}" enctype="multipart/form-data">
        @csrf
             <input type="hidden" name="LAUNDER_DIS_ID" id="LAUNDER_DIS_ID" value="{{$infocheck->LAUNDER_DIS_ID}}">
        <div class="row push">
                <div class="col-lg-1">
                    <label >เลขที่รับ</label>
                </div>
                    <div class="col-lg-2">
                        <input  name = "LAUNDER_DIS_CODE"  id="LAUNDER_DIS_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infocheck->LAUNDER_DIS_CODE}}">
                    </div>
                
                <div class="col-lg-1">
                    <label >วันที่</label>
                </div>
                    <div class="col-lg-2">
                        <input  name = "LAUNDER_DIS_DATE"  id="LAUNDER_DIS_DATE" value="{{formate($infocheck->LAUNDER_DIS_DATE)}}" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;" value="{{formate(date('Y-m-d'))}}" readonly>
                    </div>
                <div class="col-lg-1">
                    <label >เวลา</label>
                </div>
                    <div class="col-lg-4">
                        <input  name = "LAUNDER_DIS_TIME"  id="LAUNDER_DIS_TIME" value="{{$infocheck->LAUNDER_DIS_TIME}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{date('H:i')}}">
                    </div>

      </div>
      <div class="row push">
      <div class="col-lg-1">
                    <label >อ้างอิง</label>
                </div>
                
                <div class="col-lg-2 ref_number">
                                 <select name="LAUNDER_CHECK_REF" id="LAUNDER_CHECK_REF" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" required>
                                        <option value="" >--กรุณาเลือก--</option>
                                        @foreach ($inforefs as $inforef)
                                        @if($inforef->LAUNDER_WITHDROW_ID == $infocheck->LAUNDER_DIS_REF)
                                        <option value="{{ $inforef->LAUNDER_WITHDROW_ID}}" selected>{{$inforef->LAUNDER_WITHDROW_CODE}}</option>
                                        @else
                                        <option value="{{ $inforef->LAUNDER_WITHDROW_ID}}" >{{$inforef->LAUNDER_WITHDROW_CODE}}</option>
                                        @endif
                                     
                                        @endforeach   
                                </select>
                   
                </div>

                <div class="col-lg-1">
                    <label >หน่วยงาน</label>
                </div>
                    <div class="col-lg-2 ref_dep">

                    @if($infodep == '')
                                <select name="LAUNDER_DIS_DEP" id="LAUNDER_DIS_DEP" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;">
                                <option value="">เลือก</option>
                                @foreach ($infodepselects as $infodepselect)
                                    <option value="{{ $infodepselect->LAUNDER_DEP_CODE  }}">{{ $infodepselect->LAUNDER_DEP_NAME}}</option>
                                    @endforeach          
                                </select>        
                    @else
                        {{$infodep->HR_DEPARTMENT_SUB_SUB_NAME}}
                        <input type="hidden"  name = "LAUNDER_DIS_DEP"  id="LAUNDER_DIS_DEP" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infodep->HR_DEPARTMENT_SUB_SUB_ID}}" >
                    
                    @endif


                   
                    
                    </div>

                    <div class="col-lg-1">
                    <label >เจ้าหน้าที่</label>
                </div>
                    <div class="col-lg-2">
 
                        {{$infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}
                        <input type="hidden"  name = "LAUNDER_DIS_HR_ID"  id="LAUNDER_DIS_HR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoperson->ID}}">
                        <input type="hidden"  name = "LAUNDER_DIS_HR_NAME"  id="LAUNDER_DIS_HR_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}">
                    </div>
            
                    <br><br>

                        
                <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                        <thead style="background-color: #F0F8FF;">
                                            <tr>
                                                <td style="text-align: center;border: 1px solid black;">รายการผ้า</td>
                                              
                                                <td style="text-align: center;border: 1px solid black;" width="15%">จำนวนจ่าย</td>
                                           
                                                <td style="text-align: center;border: 1px solid black;" width="12%"><a  class="btn btn-success fa fa-plus addRow1" style="color:#FFFFFF;"></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody1"> 
                                    @foreach ($infochecksubs as $infochecksub)
                                                <tr>         
                                                    <td style="border: 1px solid black;"> 
                                                    <select name="LAUNDER_DIS_SUB_TYPE[]" id="LAUNDER_DIS_SUB_TYPE[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                                        <option value="" >--กรุณาเลือก--</option>
                                                        @foreach ($infotypes as $infotype)
                                                        @if($infotype->LAUNDER_TYPE_ID == $infochecksub->LAUNDER_DIS_SUB_TYPE)
                                                        <option value="{{ $infotype->LAUNDER_TYPE_ID}}" selected>{{$infotype->LAUNDER_TYPE_NAME}}</option>
                                                        @else
                                                        <option value="{{ $infotype->LAUNDER_TYPE_ID}}" >{{$infotype->LAUNDER_TYPE_NAME}}</option>
                                                        @endif
                                                        @endforeach   
                                                    </select>
                                                    </td>
                                                    
                                                    <td style="border: 1px solid black;"> 
                                                    <input  name="LAUNDER_DIS_SUB_AMOUNT[]" id="LAUNDER_DIS_SUB_AMOUNT[]" value="{{$infochecksub->LAUNDER_DIS_SUB_AMOUNT}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                                                    </td>       
                                                
                                                    <td style="text-align: center;border: 1px solid black;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                                                </tr>
                     
                                                @endforeach  
                            
                                    </tbody>   
                                    </table>
                  
                
              
      </div>

        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;">บันทึกข้อมูล</button>
         <a href="{{ url('manager_launder/launder_send')  }}" class="btn btn-hero-sm btn-hero-danger" style="font-family: 'Kanit', sans-serif;font-weight:normal;" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a> 
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
            '<select name="LAUNDER_DIS_SUB_TYPE[]" id="LAUNDER_DIS_SUB_TYPE[]" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
            '<option value="" >--กรุณาเลือก--</option>'+
            '@foreach ($infotypes as $infotype)'+
            '<option value="{{ $infotype->LAUNDER_TYPE_ID}}" >{{$infotype->LAUNDER_TYPE_NAME}}</option>'+
            '@endforeach'+   
            '</select>'+
            '</td>'+
     
            '<td style="border: 1px solid black;">'+ 
            '<input  name="LAUNDER_DIS_SUB_AMOUNT[]" id="LAUNDER_DIS_SUB_AMOUNT[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;"  >'+
            '</td>'+  
                
            '<td style="text-align: center;border: 1px solid black;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
            '</tr>';
        $('.tbody1').append(tr);
    };

    $('.tbody1').on('click','.remove', function(){
        $(this).parent().parent().remove();
});  
  


  

function selectref(ref_id){
      
      var _token=$('input[name="_token"]').val();



           $.ajax({
                   url:"{{route('mlaunder.selectrefnumber')}}",
                   method:"GET",
                   data:{ref_id:ref_id,_token:_token},
                   success:function(result){
                    $('.ref_number').html(result);
                    list();
                   }
           })

           $.ajax({
                   url:"{{route('mlaunder.selectrefdep')}}",
                   method:"GET",
                   data:{ref_id:ref_id,_token:_token},
                   success:function(result){
                    $('.ref_dep').html(result);
                   }
           })

           $('#modalref').modal('hide');

          

}






    

</script>



@endsection