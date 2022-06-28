@extends('layouts.launder')   
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
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายละเอียดรับผ้า</B></h3>
                <div align="right">
                <a  href="{{ url('manager_launder/laundergetback_add/null/null')  }}" class="btn btn-info " style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-plus"></i> เพิ่มรายการ</a>
                    </div>
                </div>
           
                <div class="block-content block-content-full">
                <form action="{{ route('launder.launder_getback') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-0.5">
                            &nbsp;&nbsp; ปีงบ &nbsp;
                        </div>
                        <div class="col-sm-1.5">
                        <span>
                        <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;">
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
                                        
                                                <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" style=" font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;" value="{{ formate($displaydate_bigen) }}" readonly>
                                                
                                                </div>
                                                <div class="col-sm">
                                                    ถึง 
                                                    </div>
                                                <div class="col-md-4">
                                    
                                                <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" style=" font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;" value="{{ formate($displaydate_end) }}" readonly>
                                            
                                                </div>
                                                </div>

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
                <div class="col-sm-1 text-left">
                <span>
                <button type="submit" class="btn btn-sm btn-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;">ค้นหา</button>
                </span> 
                </div>


          
              
</div>  
             </form>
             <div class="table-responsive"> 
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;text-align: center;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;text-align: center;" width="10%">รหัสรายการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;text-align: center;" width="10%">วันที่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;text-align: center;" width="8%">เวลา</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;text-align: center;" width="8%">รอบ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;text-align: center;" width="8%" >จำนวนผ้า<br>เปื้อน(ก.ก.)</th>  
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;text-align: center;" width="8%" >จำนวนผ้า<br>ติดเชื้อ(ก.ก.)</th>   
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;text-align: center;"  >หน่วยงาน</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;text-align: center;" width="15%" >เจ้าหน้าที่เก็บ</th>                                             
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;text-align: center;" width="8%">ทำรายการ</th>
                        </tr >
                    </thead>
                    <tbody>
                  
                    <?php $number = 0; ?>
             @foreach ($infogetbacks as $infogetback)
                    <?php $number++;  ?>
                        <tr height="20">
                            <td class="text-font" align="center">{{$number}}</td>
                            <td class="text-font text-pedding" >{{$infogetback->LAUNDER_GETBACK_CODE}}</td>
                            <td class="text-font text-pedding" >{{DateThai($infogetback->LAUNDER_GETBACK_DATE)}}</td>
                            <td class="text-font text-pedding" >{{$infogetback->LAUNDER_GETBACK_TIME}}</td>
                            <td class="text-font text-pedding" >{{$infogetback->LAUNDER_GETBACK_ROUND}}</td>
                            <td class="text-font text-pedding" >{{$infogetback->LAUNDER_GETBACK_STAIN}}</td>
                            <td class="text-font text-pedding" >{{$infogetback->LAUNDER_GETBACK_INFECTIOUS}}</td>
                            <td class="text-font text-pedding" >{{$infogetback->HR_DEPARTMENT_SUB_SUB_NAME}}</td>        
                            <td class="text-font text-pedding" >{{$infogetback->LAUNDER_GETBACK_HR_NAME}}</td>                 
                            <td align="center">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                        ทำรายการ
                                    </button>
                                    <div class="dropdown-menu" style="width:10px">                           
                                        <a class="dropdown-item"  href="{{ url('manager_launder/laundergetback_edit/null/null/'.$infogetback->LAUNDER_GETBACK_ID)  }}" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">แก้ไขรายละเอียด</a>
                                        
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