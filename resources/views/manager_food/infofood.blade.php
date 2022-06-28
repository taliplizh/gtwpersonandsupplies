@extends('layouts.food')
   
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
      font-size: 10px;
      font-size: 1.0rem;
      }

      label{
            font-family: 'Kanit', sans-serif;
            font-size: 10px;
            font-size: 1.0rem;
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
      
      
      .form-control{
    font-size: 13px;
                  }  

            .text-pedding{
    padding-left:10px;
    padding-right:10px;
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

  
  function Removeformatetime($strtime)
{
  $H = substr($strtime,0,5);
  return $H;
  }


  date_default_timezone_set("Asia/Bangkok");
  $date = date('Y-m-d');

  use App\Http\Controllers\ManagersuppliesController;
?>

           
                    <!-- Advanced Tables -->
                    <br>
<br>
<center>    
     <div class="block" style="width: 95%;">

                             <!-- Dynamic Table Simple -->
                             <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลวัตถุดิบ</B></h3>
                            <div align="right">

<a href="{{ url('manager_food/infofood_add')}}"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;" ><i class="fas fa-plus mr-2"></i> เพิ่มข้อมูล</a>
</div>
                </div>
                        <div class="block-content block-content-full">
                        <form action="{{ route('mfood.infofood') }}" method="post">
@csrf

<div class="row">



                <div class="col-sm-0.5">
                &nbsp;ค้นหา &nbsp;
                </div>

                <div class="col-sm-5">
                <span>

                <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">

                </span>
                </div>

                <div class="col-sm-30">
                &nbsp;
                </div> 
                <div class="col-sm-1.5">
                <span>
                <button type="submit"  type="button" class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;" ><i class="fas fa-search mr-2"></i>ค้นหา</button>
                </span> 
                </div>


              
                  </div>  
             </form>
             <div class="table-responsive"> 
                            <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                <thead style="background-color: #FFEBCD;">
                                    <tr height="40">
                                        <th class="text-font" style="text-align: center;" width="5%">ลำดับ</th>
                                        <th  class="text-font" style="text-align: center;" width="10%">เลขวัตถุดิบ</th>
                                        <th  class="text-font" style="text-align: center;">วัตถุดิบ</th> 
                                        <th  class="text-font" style="text-align: center;" width="10%">รายการพัสดุ</th> 
                                        <th  class="text-font" style="text-align: center;" width="10%">หมวดพัสดุ</th> 
                                        <th  class="text-font" style="text-align: center;" width="20%">คุณลักษณะ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">ราคาสืบ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >หน่วย</th>
                                        <th  class="text-font" width="5%" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">เปิดใช้</th> 
                                                                                                                 
                                        <th  class="text-font" style="text-align: center"  width="5%">คำสั่ง</th>  
                                    </tr >
                                </thead>
                                <tbody>

                                
                                        <?php $number = 0; ?>
                                    @foreach ($infosups as $infosup)

                                            <?php $number++;?>
                               
                                            <tr height="20">
                                                <td class="text-font" align="center" width="5%">{{$number}}</td>
                                                <td class="text-font" align="center">{{$infosup->SUP_FSN_NUM}}</td>
                                                <td class="text-font text-pedding" align="left">{{$infosup->SUP_NAME}}</td> 
                                                <td class="text-font text-pedding" align="left" width="10%">วัสดุสิ้นเปลือง</td> 
                                                <td class="text-font text-pedding" align="left" width="10%">วัสดุบริโภค</td>
                                                <td class="text-font text-pedding" align="left">{{$infosup->SUP_PROP}}</td>                                                
                                                <td class="text-font text-pedding" width="10%">{{$infosup->CONTINUE_PRICE_NAME}}</td>
                                                <td class="text-font text-pedding">{{ManagersuppliesController::unitname($infosup ->ID)}}</td>
                                                <td align="center" width="5%">
                                                    <div class="custom-control custom-switch custom-control-lg ">
                                                     @if($infosup->ACTIVE == 'True')
                                                         <input type="checkbox" class="custom-control-input" id="{{ $infosup-> ID }}" name="{{ $infosup-> ID }}" onchange="switchactive({{ $infosup-> ID }});" checked>
                                                     @else
                                                        <input type="checkbox" class="custom-control-input" id="{{ $infosup-> ID }}" name="{{ $infosup-> ID }}" onchange="switchactive({{ $infosup-> ID }});">
                                                     @endif
                                                        <label class="custom-control-label" for="{{ $infosup-> ID }}"></label>
                                                    </div>
        
                                                </td>                      
                                                                                              
                                                <td align="center" width="5%">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                            ทำรายการ
                                                        </button>
                                                    <div class="dropdown-menu" style="width:10px">
                                                            <a class="dropdown-item"  href="{{ url('manager_food/infofood_edit/'.$infosup->ID)}}"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไข</a>
                                                           
                                                        </div>
                                                    </div>
                                                </td> 
                                            </tr>
                                            @endforeach  
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>


               
                </div>

                
                 
                  
      
                      

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
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });


    function switchactive(id){
      // alert(budget);
      var checkBox=document.getElementById(id);
      var onoff;

      if (checkBox.checked == true){
        onoff = "True";
  } else {
        onoff = "False";
  }
 //alert(onoff);

 var _token=$('input[name="_token"]').val();
      $.ajax({
              url:"{{route('msupplies.switchactivesup')}}",
              method:"GET",
              data:{onoff:onoff,id:id,_token:_token}
      })
      } 
   

    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}

  $('.budget').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('admin.selectbudget')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.date_budget').html(result);
                        datepick();
                     }
             })
            // console.log(select);
             }        
     });   
  
</script>



@endsection