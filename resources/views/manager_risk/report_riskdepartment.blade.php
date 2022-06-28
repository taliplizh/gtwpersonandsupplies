@extends('layouts.risk')   
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

 
    use App\Http\Controllers\MeetingController;

    $checkver = MeetingController::checkver($user_id);
    $countver = MeetingController::countver($user_id);

    use App\Http\Controllers\ManagerriskController;

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
?>          
<!-- Advanced Tables -->
<br>
<br>
<center>    

                <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายงานอันดับการเกิดอุบัติการณ์ความเสี่ยงขององค์กร</B></h3>   
                <div align="right ">
                    <a href="{{ url('manager_risk/report_riskdepartment_excel')}}"  class="btn btn-success btn-lg" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" ><li class="fa fa-file-excel"></li>&nbsp;Excel</a>
                    <a class="btn btn-success" href="{{url('manager_risk/report')}}" style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;"><i class="fas fa-chevron-circle-left text-white-70" style="font-size:17px;"></i>&nbsp;&nbsp;ย้อนกลับ</a> 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
                  </div>
                </div>
                <div class="block-content block-content-full">  
                {{-- <div class="row push">
                    <div class="col-sm-2 text-right" >
                        <label style="font-family:'Kanit',sans-serif;font-size:14px;">รายงานโดยใช้ :</label>
                    </div> 
                    <div class="col-lg-2 ">
                    <select name="SETUP_INCEDENCE_REPORTHEADER_NAME" id="SETUP_INCEDENCE_REPORTHEADER_NAME" class="form-control input-lg " style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;" >
                        <option value="" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">--เลือก--</option>
                            @foreach($reportheaders as $reportheader)
                                <option value="{{ $reportheader-> SETUP_INCEDENCE_REPORTHEADER_ID}}" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">{{ $reportheader-> SETUP_INCEDENCE_REPORTHEADER_NAME}}</option>
                            @endforeach
                        </select>
                    </div>
                   
                    <div class="col-sm-2 text-right" >
                        <label style="font-family:'Kanit',sans-serif;font-size:14px;">อันดับของการเกิด :</label>
                    </div> 
                    <div class="col-lg-2 ">
                        <select name="INCIDENCE_LEVELBEGIN_NAME" id="INCIDENCE_LEVELBEGIN_NAME" class="form-control input-lg " style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;" >
                            <option value="" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">--เลือก--</option> 
                            @foreach($reportlevelbegins as $reportlevelbegin)
                                <option value="{{ $reportlevelbegin-> INCIDENCE_LEVELBEGIN_ID}}" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">{{ $reportlevelbegin-> INCIDENCE_LEVELBEGIN_NAME}}</option>
                            @endforeach                                                                   
                        </select>
                    </div>
                    
                        <div class="col-sm-2 text-right" >
                            <label style="font-family:'Kanit',sans-serif;font-size:14px;">หน่วยงาน :</label>
                        </div> 
                        <div class="col-lg-2 ">
                            <select name="HR_DEPARTMENT_NAME" id="HR_DEPARTMENT_NAME" class="form-control input-sm" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">
                                <option value="">--เลือก--</option>
                                    @foreach($departsubs as $departsub)
                                        <option value="{{ $departsub-> HR_DEPARTMENT_SUB_SUB_ID}}" >{{ $departsub-> HR_DEPARTMENT_SUB_SUB_NAME}}</option>
                                    @endforeach
                            </select> 
                        </div>                                                    
                    </div>

                    <div class="row push">
                        <div class="col-sm-2 text-right" >
                            <label style="font-family:'Kanit',sans-serif;font-size:14px;">ประเภทหน่วยงาน :</label>
                        </div> 
                        <div class="col-lg-2 ">
                            <select name="CATEGORY_DEPARTMENT_NAME" id="CATEGORY_DEPARTMENT_NAME" class="form-control input-sm" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">
                                <option value="">--เลือก--</option>
                                    @foreach($categorydeparts as $categorydepart)
                                        <option value="{{ $categorydepart-> CATEGORY_DEPARTMENT_ID}}" >{{ $categorydepart-> CATEGORY_DEPARTMENT_NAME}}</option>
                                    @endforeach
                            </select> 
                        </div>
                       
                        <div class="col-sm-2 text-right" >
                            <label style="font-family:'Kanit',sans-serif;font-size:14px;">กลุ่มหน่วยงาน :</label>
                        </div> 
                        <div class="col-lg-2 ">
                            <select name="HR_DEPARTMENT_NAME" id="HR_DEPARTMENT_NAME" class="form-control input-sm" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">
                                <option value="">--เลือก--</option>
                                    @foreach($departs as $depart)
                                        <option value="{{ $depart-> HR_DEPARTMENT_ID}}" >{{ $depart-> HR_DEPARTMENT_NAME}}</option>
                                    @endforeach
                            </select> 
                        </div>
                  
                        <div class="col-sm-1" >
                                <button class="btn btn-info text-white" type="submit" style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;"><i class="fa fa-search fa-sm text-white" style="font-size:17px "></i>&nbsp;&nbsp;ค้นหา </button> 
                        </div> 
                        <div class="col-sm-1" >
                           
                        </div> 
                        <div class="col-sm-2" >
                            <div align="right ">
                                <button class="btn btn-success" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;"><i class="fas fa-file-excel text-white" style="font-size:17px"></i>&nbsp;&nbsp;Export Excel</button> 
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
                            </div>
                            </div> 
                  --}}

                  <form action="{{ route('mrisk.report_riskdepartment_search') }}" method="post">
                    @csrf

                    <div class="row">
             
                        <div class="col-sm-4 date_budget">
                            <div class="row">
                                <div class="col-sm">
                                    วันที่
                                </div>
                                <div class="col-md-4">

                                    <input name="DATE_BIGIN" id="DATE_BIGIN" class="form-control input-lg datepicker"
                                        data-date-format="mm/dd/yyyy" value="{{ formate($displaydate_bigen) }}" readonly>

                                </div>
                                <div class="col-sm">
                                    ถึง
                                </div>
                                <div class="col-md-4">

                                    <input name="DATE_END" id="DATE_END" class="form-control input-lg datepicker"
                                        data-date-format="mm/dd/yyyy" value="{{ formate($displaydate_end) }}" readonly>

                                </div>
                            </div>

                        </div>

                        <div class="col-sm-0.5">
                            &nbsp;คำค้นหา &nbsp;
                        </div>
                        <div class="col-sm-2">
                            <span>
                                <input type="search" name="search" class="form-control"
                                    style="font-family: 'Kanit', sans-serif;font-weight:normal;"
                                    value="{{ $search }}">
                            </span>
                        </div>
                      
                        <div class="col-sm-30">
                            &nbsp;
                        </div>
                        <div class="col-sm-1.5">
                            <span>
                                <button type="submit" class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i
                                        class="fas fa-search mr-2"></i>ค้นหา</button>
                            </span>
                        </div>
                    </div>



                </form>                              
     

        <div class="block-content">  
            <div class="table-responsive"> 
                <table class="gwt-table table-striped table-vcenter " style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" >ระดับความรุนแรง</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">A</th>
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">B</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">C</th>
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">D</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">E</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">F</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">G</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">H</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">I</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">1</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">2</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">3</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">4</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">5</th>                           
                            <th  class="text-font" style="border: 1px solid black;ext-align: center" width="5%">รวม</th>        
                            <th  class="text-font" style="border: 1px solid black;ext-align: center" width="5%">ร้อยละ</th> 
                        </tr >
                    </thead>
                    <tbody>
                        <?php $number = 0; ?>
                        @foreach ($items as $item)
                            <?php
                            $number++;

                                $num1 = number_format(ManagerriskController::countriskrepitem_sum($item->RISK_REPITEMS_ID,$displaydate_bigen,$displaydate_end));
                                $num2 = number_format(ManagerriskController::countriskrepitem_sumall($displaydate_bigen,$displaydate_end)); 

                            ?>
                   
                            <tr height="20">                       
                                <td class="text-font" align="center">{{$number}}</td>
                                <td class="text-font text-pedding" style="text-align: left;">  {{ $item->RISK_REPITEMS_CODE }} :: {{ $item->RISK_REPITEMS_NAME }}</td>
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskrepitem('A',$item->RISK_REPITEMS_ID,$displaydate_bigen,$displaydate_end))}}</td>
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskrepitem('B',$item->RISK_REPITEMS_ID,$displaydate_bigen,$displaydate_end))}}</td>
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskrepitem('C',$item->RISK_REPITEMS_ID,$displaydate_bigen,$displaydate_end))}}</td>
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskrepitem('D',$item->RISK_REPITEMS_ID,$displaydate_bigen,$displaydate_end))}}</td>  
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskrepitem('E',$item->RISK_REPITEMS_ID,$displaydate_bigen,$displaydate_end))}}</td>
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskrepitem('F',$item->RISK_REPITEMS_ID,$displaydate_bigen,$displaydate_end))}}</td> 
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskrepitem('G',$item->RISK_REPITEMS_ID,$displaydate_bigen,$displaydate_end))}}</td>
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskrepitem('H',$item->RISK_REPITEMS_ID,$displaydate_bigen,$displaydate_end))}}</td>  
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskrepitem('I',$item->RISK_REPITEMS_ID,$displaydate_bigen,$displaydate_end))}}</td>
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskrepitem('1',$item->RISK_REPITEMS_ID,$displaydate_bigen,$displaydate_end))}}</td> 
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskrepitem('2',$item->RISK_REPITEMS_ID,$displaydate_bigen,$displaydate_end))}}</td>
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskrepitem('3',$item->RISK_REPITEMS_ID,$displaydate_bigen,$displaydate_end))}}</td>  
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskrepitem('4',$item->RISK_REPITEMS_ID,$displaydate_bigen,$displaydate_end))}}</td>
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskrepitem('5',$item->RISK_REPITEMS_ID,$displaydate_bigen,$displaydate_end))}}</td>        
                                <td class="text-font text-pedding" >{{$num1}}</td>
                                <td class="text-font text-pedding" >{{number_format(($num1/$num2) *100,2)}} </td>
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


   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });
</script>

@endsection