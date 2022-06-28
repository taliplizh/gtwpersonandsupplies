@extends('layouts.account')   
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
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายการสมุดบัญชี</B></h3>
                <div align="right">
               <!-- <a  href="{{ url('manager_mpay/mpay_stickersmall')}}"  class="btn btn-success " >ย้อนกลับ</a>-->

                <!-- <a  href="javascript:history.back()"  class="btn btn-success " >ย้อนกลับ</a>-->
                    </div>
                </div>
                </div>
                </div>

                <div class="block-content" style="width: 95%;">
<div class="row">
                        <div class="col-6 col-md-4 col-xl-2">
                        <a class="block block-link-pop text-center" href="{{ url('manager_account/account_type_sub/revenue')}}"  > 
                                <div class="block-content block-content-full aspect-ratio-4-3 d-flex justify-content-center align-items-center text-center bg-info">
                                    <div>
                                    <span>
                                 
                                        </span>
                                        <div class="font-w600 mt-2 text-dark" style="font-size: 18px;">สมุดบัญชีรายรับ</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                     

                        <div class="col-6 col-md-4 col-xl-2">
                        <a class="block block-link-pop text-center" href="{{ url('manager_account/account_type_sub/expenditure')}}" > 
                                <div class="block-content block-content-full aspect-ratio-4-3 d-flex justify-content-center align-items-center text-center bg-success">
                                    <div>
                                        <span>
                                       
                                        </span>
                                        <div class="font-w600 mt-2 text-dark" style="font-size: 18px;">	สมุดบัญชีรายจ่าย</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                     

                        <div class="col-6 col-md-4 col-xl-2">
                        <a class="block block-link-pop text-center" href="{{ url('manager_account/account_type_sub/general')}}"> 
                                <div class="block-content block-content-full aspect-ratio-4-3 d-flex justify-content-center align-items-center ">
                                    <div>
                                        <span>
                                       
                                        </span>
                                        <div class="font-w600 mt-2 text-dark" style="font-size: 18px;">	สมุดบัญชีทั่วไป</div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-6 col-md-4 col-xl-2">
                        <a class="block block-link-pop text-center" href="{{ url('manager_account/account_type_sub/debtor')}}"> 
                                <div class="block-content block-content-full aspect-ratio-4-3 d-flex justify-content-center align-items-center text-center bg-danger">
                                    <div>
                                        <span>
                                        
                                        </span>
                                        <div class="font-w600 mt-2 text-dark" style="font-size: 18px;">	สมุดรายวันลูกหนี้</div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-6 col-md-4 col-xl-2">
                        <a class="block block-link-pop text-center" href="{{ url('manager_account/account_type_sub/daily')}}"> 
                                <div class="block-content block-content-full aspect-ratio-4-3 d-flex justify-content-center align-items-center text-center bg-warning">
                                    <div>
                                        <span>
                                       
                                        </span>
                                        <div class="font-w600 mt-2 text-dark" style="font-size: 18px;">	สมุดรายวันซื้อ</div>
                                    </div>
                                </div>
                            </a>
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