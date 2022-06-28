@extends('layouts.backend')
   
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

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

      @media only screen and (min-width: 1200px) {
label {
    float:right;
  }

      }

      .text-pedding{
   padding-left:10px;
                    }

        .text-font {
    font-size: 13px;
                  }   
                  .form-control {
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
<!-- Advanced Tables -->
<div class="bg-body-light">
    <div class="content">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
             <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1> 
             <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                                            <div class="row">
                                            <!--<div>
                                             <a href="{{ url('general_mpay/dashboard_mpay/'.$inforpersonuserid -> ID) }}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">Dashboard</a>
                                            </div>
                                            <div>&nbsp;</div>

                                            <div>
                                            <a href="{{ url('general_mpay/stockcard_mpay/'.$inforpersonuserid -> ID) }}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">คลังย่อย

                                                <span class="badge badge-light" ></span>

                                            </a>
                                            </div>
                                            <div>&nbsp;</div>-->

                                            <div>
                                             <a href="{{ url('general_mpay/withdraw_mpay/'.$inforpersonuserid -> ID) }}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">เบิกอุปกรณ์</a>
                                            </div>
                                            <div>&nbsp;</div>

                                            <div>
                                             <a href="{{ url('general_mpay/pay_mpay/'.$inforpersonuserid -> ID) }}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">จ่ายออก</a>
                                            </div>
                                            <div>&nbsp;</div>

                                            <div>
                                             <a href="{{ url('general_mpay/return_mpay/'.$inforpersonuserid -> ID) }}" class="btn btn-info" >ส่งคืน</a>
                                            </div>
                                            <div>&nbsp;</div>

                                            </ol>

                </nav>
        </div>
    </div>
    </div>
    <div class="content">
    <!-- Dynamic Table Simple -->
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ส่งคืน | หน่วยงาน</B></h3>
            <br>
        </div>
        <br>
<form  method="post" action="" enctype="multipart/form-data">
@csrf

    
        <div class="col-sm-12" style="text-align: left">
        <div class="row">
        <div class="col-lg-1" style="text-align: left">
        <label >                           
                            รหัส :              
        </label>
        </div> 
        <div class="col-lg-2">
        <input name="LAUNDER_WITHDROW_CODE" id="LAUNDER_WITHDROW_CODE" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
        </div> 
        <div class="col-lg-1" style="text-align: left">
        <label >                           
                            ปีงบประมาณ          
        </label>
        </div> 
        <div class="col-lg-2">
        <select name="LAUNDER_WITHDROW_YEAR" id="LAUNDER_WITHDROW_YEAR" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
        <option value="" >--เลือกปีงบประมาณ  --</option>  

                    @foreach ($budgets as $budget)   
                    @if($budget -> LEAVE_YEAR_ID == $year_id )
                    <option value="{{ $budget -> LEAVE_YEAR_ID }}" selected>{{ $budget -> LEAVE_YEAR_ID }}</option>                    
                    @else
                    <option value="{{ $budget -> LEAVE_YEAR_ID }}" >{{ $budget -> LEAVE_YEAR_ID }}</option>                    
                    @endif

                                                                                                                                       
                    @endforeach  
                                                                            
        </select> 
        </div> 
        <div class="col-lg-1" style="text-align: left">
        <label >                           
                            เหตุผล :              
        </label>
        </div> 
        <div class="col-lg-4" >
        <input name="LAUNDER_WITHDROW_COMMENT" id="LAUNDER_WITHDROW_COMMENT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div> 
        </div>

        <br>

      
        <div class="row">
        <div class="col-lg-1" style="text-align: left">
        <label >                           
        วันที่           
        </label>
        </div> 
        <div class="col-lg-2">
        <input name="LAUNDER_WITHDROW_DATE" id="LAUNDER_WITHDROW_DATE" class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;" value="{{formate($date)}}" readonly>
        </div> 
        <div class="col-lg-1" style="text-align: left">
        <label >                           
         หน่วยงาน :            
        </label>
        </div> 
        <div class="col-lg-2">
        <select name="LAUNDER_WITHDROW_DEP_SUB_SUB_ID" id="LAUNDER_WITHDROW_DEP_SUB_SUB_ID" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
        <option value="" >--เลือกหน่วยงาน--</option>  

                    @foreach ($departmentsubsubs as $departmentsubsub)   
                    @if($departmentsubsub -> HR_DEPARTMENT_SUB_SUB_ID == $inforpersonuserid->HR_DEPARTMENT_SUB_SUB_ID)
                    <option value="{{ $departmentsubsub -> HR_DEPARTMENT_SUB_SUB_ID }}" selected>{{ $departmentsubsub -> HR_DEPARTMENT_SUB_SUB_NAME }}</option>                                                                                                                        
                    @else
                    <option value="{{ $departmentsubsub -> HR_DEPARTMENT_SUB_SUB_ID }}" >{{ $departmentsubsub -> HR_DEPARTMENT_SUB_SUB_NAME }}</option>                                                                                                                        
                    @endif                                                              
                                   
                    @endforeach  
                                                                            
        </select> 
        </div>

           
        <div class="col-lg-1" style="text-align: left">
        <label>ผู้บันทึกส่ง :</label>
        </div> 
        <div class="col-lg-2">
      {{$inforpersonuser->HR_FNAME}} {{$inforpersonuser->HR_LNAME}}
        
      <input type="hidden" name="LAUNDER_WITHDROW_HR_ID" id="LAUNDER_WITHDROW_HR_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value=" {{$inforpersonuserid->ID}}">

        
        
        </div> 
       

        </div>
        <br>


       <div class="row">
       <div class="col-lg-1" style="text-align: left">
        <label >                           
       เวลา        
        </label>
        </div> 
        <div class="col-lg-2">
        <input name="LAUNDER_WITHDROW_TIME" id="LAUNDER_WITHDROW_TIME" class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;" value="{{date('H:i')}}">
        </div> 
      
       
       </div>
       <br>
 
       <div class="col-sm-12 row"  align="right">
                               

       <table class="gwt-table table-striped table-vcenter " style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                                     
                                            <tr>
                                            <td style="text-align: center; font-size: 13px;" width="5%">ลำดับ</td>
                                                <td style="text-align: center; font-size: 13px;" >รายการ</td>
                                                <td style="text-align: center; font-size: 13px;" width="30%">จำนวน</td>
                                               
                                                
                                             
                                                <td style="text-align: center; font-size: 13px;" width="5%"><a  class="btn btn-success fa fa-plus addRow" style="color:#FFFFFF;"></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody1"> 
                                        
                                      
                                                <tr style="text-align: center; font-size: 13px;">
                                                    <td style="text-align: center; font-size: 13px;">
                                                        1
                                                    </td>
                                                    <td style="text-align: left;" class="text-pedding">

                                                    <select name="LAUNDER_WITHDROW_SUB_TYPE[]" id="LAUNDER_WITHDROW_SUB_TYPE[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                                                    <option value="" >--กรุณาเลือก--</option>
                                                                   
                                                    </select>
                                                
                                                    </td>
                                                
                                                    <td style="text-align: left;" class="text-pedding">
                                                    <input style="text-align: center; " name="LAUNDER_WITHDROW_SUB_AMOUNT[]" id="LAUNDER_WITHDROW_SUB_AMOUNT[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
                                                </td>
                                                
                        
                                                <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                                            </tr>
                             
                                    </tbody>   
                                    </table>


                                    </div>

        <div class="modal-footer">
        <div align="right">
        <button type="submit" name = "SUBMIT"  class="btn btn-hero-sm btn-hero-info" value="approved" >บันทึก</button>
        <a href="{{ url('general_mpay/return_mpay/'.$inforpersonuserid->ID)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการขอเบิก ?')" >ยกเลิก</a>
        </div>

       
        </div>
        </form>  


       
       
@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>



 <!-- Page JS Plugins -->
<script src="{{ asset('asset/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<!-- Page JS Code -->
<script src="{{ asset('asset/js/pages/be_comp_charts.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['easy-pie-chart', 'sparkline']); });</script>


 <!-- Page JS Plugins -->
 <script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>
<!-- Page JS Code -->
 <script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>

 <script>
        $(document).ready(function(){
          $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
        </script>

<script>

function datepicker(number){
        
        $('.datepicker'+number).datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
   }


$('.addRow').on('click',function(){
        addRow();
        var count = $('.tbody1').children('tr').length;
        var number =  (count).valueOf();
        datepicker(number);
    });

   


    function addRow(){
    var count = $('.tbody1').children('tr').length;
    var number =  (count + 1).valueOf();

    
        var tr =   '<tr style="text-align: center; font-size: 13px;">'+
                '<td style="text-align: center; font-size: 13px;">'+
                +number+
                '</td>'+
                '<td style="text-align: left;" class="text-pedding">'+
                '<select name="LAUNDER_WITHDROW_SUB_TYPE[]" id="LAUNDER_WITHDROW_SUB_TYPE[]" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
                '<option value="" >--กรุณาเลือก--</option>'+ 
                '</select>'+
                '</td>'+
                '<td style="text-align: left;" class="text-pedding">'+
                '<input style="text-align: center; " name="LAUNDER_WITHDROW_SUB_AMOUNT[]" id="LAUNDER_WITHDROW_SUB_AMOUNT[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;"  >'+
                '</td>'+
                '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
                '</tr>';
                                  
    $('.tbody1').append(tr);
    };

    $('.tbody1').on('click','.remove', function(){
        $(this).parent().parent().remove();
});




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




function detail(id){


$.ajax({
           url:"{{route('warehouse.detailappall')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#detail').html(result);


              //alert("Hello! I am an alert box!!");
           }

   })

}


   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            }).datepicker();  //กำหนดเป็นวันปัจุบัน
    });

 //------------------------------------------function-----------------

 function detailsupselect(count){
  
  var idinven = document.getElementById("WAREHOUSE_INVEN_ID").value;

$.ajax({
           url:"{{route('warehouse.detailsupselect')}}",
          method:"GET",
           data:{idinven:idinven,count:count},
           success:function(result){
               $('#detailsupselect').html(result);
           }

   })
   

}





function selectsupreq(idinven,count){

var _token=$('input[name="_token"]').val();



$.ajax({
               url:"{{route('warehouse.selectsupreq')}}",
               method:"GET",
               data:{idinven:idinven,_token:_token},
               success:function(result){
                $('.infoselectsupreq'+count).html(result);
               }
       })



       $.ajax({
                   url:"{{route('warehouse.selectsupunitname')}}",
                   method:"GET",
                   data:{idinven:idinven,_token:_token},
                   success:function(result){
                    $('.infounitname'+count).html(result);
                   }
           })

        
    
     
       $('#modeladdsup').modal('hide');

}



//-----------------------------------------------------

  


</script>



@endsection