@extends('layouts.crm')   
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

                  table, td, th {
            border: 1px solid black;
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

        
?>         

<center>    
    <div class="block mt-5" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายการบริจาค</B></h3>
                <div align="right">
                   
                    </div>
                </div>
           
            <div class="block-content block-content-full">

         
            <form action="{{ route('mcrm.persondonate_list' )}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-0.5">
                            &nbsp;&nbsp; ปีงบ &nbsp;
                        </div>
                        <div class="col-sm-1.5">
                        <span>
                                <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;">
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

            <div class="col-sm-4 date_budget">
            <div class="row">
                        <div class="col-sm">
                        วันที่
                        </div>
                    <div class="col-md-4">
             
                    <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_bigen) }}" readonly>
                    
                    </div>
                    <div class="col-sm">
                        ถึง 
                        </div>
                    <div class="col-md-4">
           
                    <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_end) }}" readonly>
                  
                    </div>
                    </div>

                </div>

<div class="col-sm-0.5">
&nbsp;ประเภท &nbsp;
</div>

<div class="col-sm-2">
<span>
<select name="SEND_STATUS" id="SEND_STATUS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">

<option value="">ทั้งหมด</option>
        @foreach ($type_checks as $type_check)
            @if($type_check->DONATIONWEALTH_ID == $status_check)
                <option value="{{ $type_check->DONATIONWEALTH_ID  }}" selected>{{ $type_check->DONATIONWEALTH_NAME}}</option>
            @else
                <option value="{{ $type_check->DONATIONWEALTH_ID  }}">{{ $type_check->DONATIONWEALTH_NAME}}</option>
            @endif                                 
        @endforeach        

</select>
</span>
</div> 

<div class="col-sm-0.5">
&nbsp;ค้นหา &nbsp;
</div>

<div class="col-sm-2">
<span>

<input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">

</span>
</div>

<div class="col-sm-30">
&nbsp;
</div> 
<div class="col-sm-1.5 text-left">
<span>
<button type="submit" class="btn btn-hero-sm btn-hero-info foo14 loadscreen" ><i class="fas fa-search mr-2"></i> ค้นหา</button>
</span> 
</div>


              
                  </div>  
             </form>
             <div align="right">
             มูลค่า {{number_format($sumpice,2)}} บาท  จำนวน {{$counttotal}} ครั้ง
             </div>
             <div class="table-responsive"> 
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="5%">ลำดับ</th>
                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="6%" >ปี พศ.</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="8%">เล่มที่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="8%">เลขที่</th>
                           
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;"width="10%" >บริจาคในงาน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="7%" >ประเภท</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="7%">วันที่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="12%">รายการบริจาค</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="5%">จำนวน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="5%">หน่วย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="8%">ราคา</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="15%">รายชื่อผู้บริจาค</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="15%">หมายเหตุ</th> 
                                            
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="8%">ทำรายการ</th>
                        </tr >
                    </thead>
                    <tbody>
                    <?php $number = 0; ?>
                        @foreach ($donatedetail_lists as $donatedetail_list)
                        <?php $number++; ?>

                        <tr height="20">
                        <td class="text-font" align="center">{{$number}}</td>
                        <td class="text-font text-pedding" >{{$donatedetail_list->PERSON_DONATE_SUB_YEAR}}</td>
                        <td class="text-font text-pedding" >{{$donatedetail_list->PERSON_DONATE_SUB_BOOKNO}}</td>
                        <td class="text-font text-pedding" >{{$donatedetail_list->PERSON_DONATE_SUB_NO}}</td>
                       
                        <td class="text-font text-pedding" >{{$donatedetail_list->PERSON_DONATE_SUB_WORK}}</td>
                        <td class="text-font text-pedding" >{{$donatedetail_list->DONATIONWEALTH_NAME}}</td>
                        <td class="text-font text-pedding" >{{DateThai($donatedetail_list->PERSON_DONATE_SUB_DATE)}}</td>                       
                        <td class="text-font text-pedding" >{{$donatedetail_list->PERSON_DONATE_SUB_DETAIL}}</td>
                        <td class="text-font text-pedding" >{{$donatedetail_list->PERSON_DONATE_SUB_QTY}}</td>
                        <td class="text-font text-pedding" >{{$donatedetail_list->DONATIONUNIT_NAME}}</td>
                        <td class="text-font text-right" >{{number_format($donatedetail_list->PERSON_DONATE_SUB_PRICE,2)}}</td>
                    
                        <td class="text-font text-pedding" >{{$donatedetail_list->DONATE_PERSON_NAME}}</td>
                        <td class="text-font text-pedding" >{{$donatedetail_list->PERSON_DONATE_SUB_COMENT}}</td>
                        <td align="center">
                            <div class="dropdown">
                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                    ทำรายการ
                                </button>
                            <div class="dropdown-menu" style="width:10px">
                           
                                    <a class="dropdown-item"  href="#detail_modal{{ $donatedetail_list -> PERSON_DONATE_SUB_ID }}" data-toggle="modal" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">รายละเอียด</a>
                                    <a class="dropdown-item"  href="{{ url('manager_crm/persondonate_list_edit/'.$donatedetail_list->PERSON_DONATE_SUB_ID)}}"  style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"  target="_blank">แก้ไข</a>
                                    
                                @if ( $codes == '10999' )
                                <a class="dropdown-item"  href="{{ url('formpdf/pdfcongrat_10999/'.$donatedetail_list->PERSON_DONATE_SUB_ID)}}"  style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"  target="_blank">พิมพ์ใบรับเงินบริจาค</a>
                                @else
                                <a class="dropdown-item"  href="{{ url('manager_crm/congrat/export_pdfcongrat/'.$donatedetail_list->PERSON_DONATE_SUB_ID)}}"  style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"  target="_blank">พิมพ์ใบรับเงินบริจาค</a>
                                @endif
                                
                                </div>
                            </div>
                        </td> 
                        <div id="detail_modal{{ $donatedetail_list-> PERSON_DONATE_SUB_ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="editsafe_modalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">           
                                        <div class="row">
                                            <div><h3  style="font-family:'Kanit',sans-serif;font-size:22px;font-weight:normal;">&nbsp;&nbsp;&nbsp;&nbsp;รายการบริจาคลำดับที่&nbsp; {{ $donatedetail_list -> PERSON_DONATE_SUB_ID }}&nbsp;&nbsp;</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                              
                                        <body> 
                                           
                                            <div class="form-group">                                               
                                                <div class="row push">
                                                    <div class="col-sm-2">
                                                    <label>เล่มที่ :</label>
                                                    </div> 
                                                    <div class="col-lg-2 text-left">              
                                                    {{ $donatedetail_list->PERSON_DONATE_SUB_BOOKNO }}
                                                    </div> 
                                                    <div class="col-sm-2">
                                                    <label>เลขที่ :</label>
                                                    </div> 
                                                    <div class="col-lg-2 text-left">
                                                   {{ $donatedetail_list->PERSON_DONATE_SUB_NO }}
                                                    </div>
                                                    <div class="col-sm-2">
                                                    <label>ปี พศ. :</label>
                                                    </div> 
                                                    <div class="col-lg-2 text-left ">
                                                  {{ $donatedetail_list->PERSON_DONATE_SUB_YEAR }}
                                                    </div>  
                                                    </div>

                                                    <div class="row push">
                                                    <div class="col-sm-2">
                                                    <label>รายชื่อผู้บริจาค :</label>
                                                    </div> 
                                                    <div class="col-lg-2 text-left">
                                                    {{$donatedetail_list->DONATE_PERSON_NAME }} 
                                                    </div> 
                                                    <div class="col-sm-2">
                                                    <label>บริจาคในงาน :</label>
                                                    </div> 
                                                    <div class="col-lg-2 text-left ">
                                                  {{ $donatedetail_list->PERSON_DONATE_SUB_WORK }}
                                                    </div> 
                                                   
                                                    <div class="col-sm-2">
                                                    <label>วันที่ :</label>
                                                    </div> 
                                                    <div class="col-lg-2 text-left ">
                                                  {{DateThai($donatedetail_list->PERSON_DONATE_SUB_DATE) }}
                                                    </div> 
                                                    </div>

                                                    <div class="row push">
                                                    <div class="col-sm-2">
                                                    <label>รายการบริจาค :</label>
                                                    </div> 
                                                    <div class="col-lg-2 text-left ">
                                                  {{ $donatedetail_list->PERSON_DONATE_SUB_DETAIL }}
                                                    </div> 
                                                    <div class="col-sm-2">
                                                    <label>จำนวน :</label>
                                                    </div> 
                                                    <div class="col-lg-2 text-left">
                                                    {{ $donatedetail_list->PERSON_DONATE_SUB_QTY }}
                                                    </div>
                                                    <div class="col-sm-2">
                                                    <label>หน่วย :</label>
                                                    </div> 
                                                    <div class="col-lg-2 text-left ">
                                                  {{$donatedetail_list->DONATIONUNIT_NAME }}
                                                    </div> 
                                                    </div>

                                                  

                                                    <div class="row push">
                                                    <div class="col-sm-2">
                                                    <label>ราคา :</label>
                                                    </div> 
                                                    <div class="col-lg-2 text-left">
                                                    {{ number_format($donatedetail_list->PERSON_DONATE_SUB_PRICE,2) }}
                                                    </div>
                                                    <div class="col-sm-2">
                                                    <label>ประเภท :</label>
                                                    </div> 
                                                    <div class="col-lg-2 text-left">
                                                    {{ $donatedetail_list->DONATIONWEALTH_NAME }}
                                                    </div>
                                                    <div class="col-sm-2">
                                                    <label>หมายเหตุ :</label>
                                                    </div> 
                                                    <div class="col-lg-2 text-left ">
                                                  {{$donatedetail_list->PERSON_DONATE_SUB_COMENT }}
                                                    </div>                                                   
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div align="right">
                                                     
                                                        <a href="" data-dismiss="modal"  class="btn btn-hero-sm btn-hero-secondary" ><i class="fas fa-window-close mr-2"></i>Close</a>
                                                        </div>
                                                        
                                                        </div>     
                                  
                            </body>

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


function detail(id){

$.ajax({
           url:"{{route('suplies.detailapp')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#detail').html(result);
             
         
              //alert("Hello! I am an alert box!!");
           }
            
   })
    
}
datepick()
function datepick() {
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: true,
        language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
        thaiyear: true,
        autoclose: true                         //Set เป็นปี พ.ศ.
    });  //กำหนดเป็นวันปัจุบัน
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

function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
</script>

@endsection