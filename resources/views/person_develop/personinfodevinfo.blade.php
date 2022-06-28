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
   padding-right:10px;
                    }

        .text-font {
    font-size: 13px;
                  }
                  table, th, td {
    border: 1px solid #A9A9A9;
}

</style>
<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;

            }
            .form-control {
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



use App\Http\Controllers\PerdevController;
$checkapp = PerdevController::checkapp($user_id);
$checkver = PerdevController::checkver($user_id);

$countapp = PerdevController::countapp($user_id);
$countver = PerdevController::countver($user_id);


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
                    <div class="bg-body-light">
                    <div class="content">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                <div class="row">
                                        <div>
                                                <a href="{{ url('person_dev/persondevindex/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">
                                                  
                                                    <span class="nav-main-link-name">Dashboard</span>
                                                </a>
                                            </div>
                                        <div>&nbsp;</div>

                                    <div>
                                        <a href="{{ url('person_dev/personmeetinginside/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ประชุมภายใน</a>
                                        </div>
                                    <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('person_dev/persondevinfo/'.$inforpersonuserid -> ID)}}" class="btn btn-primary loadscreen" >ประชุมอบรมภายนอก</a>
                                </div>
                                <div>&nbsp;</div>
                                @if($checkver != 0)
                                <div>
                                <a href="{{ url('person_dev/persondevver/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ตรวจสอบ
                                @if($countver!=0)
                                    <span class="badge badge-light" >{{$countver}}</span>
                                @endif
                                </a>
                                </div>
                                <div>&nbsp;</div>
                                @endif

                                @if($checkapp!=0)
                                <div>
                                <a href="{{ url('person_dev/persondevapp/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">อนุมัติ
                                @if($countapp!=0)
                                    <span class="badge badge-light" >{{$countapp}}</span>
                                @endif
                                </a>
                                </div>
                                <div>&nbsp;</div>
                                @endif
                                </div>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="content">

                             <!-- Dynamic Table Simple -->
                             <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลการฝึกอบรม</B></h3>
                            <a href="{{ url('person_dev/persondevadd/'.$inforpersonuserid -> ID)}}"  class="btn btn-info" ><i class="fas fa-plus"></i> เพิ่มการอบรม</a>&nbsp;&nbsp;
                          
                        </div>
                        <div class="block-content block-content-full">
                                       
                        <form action="{{ route('perdev.searchinfo',['iduser'=>  $inforpersonuserid->ID]) }}" method="post">
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
                                &nbsp;สถานะ &nbsp;
                            </div>                                
                            <div class="col-sm-2">
                                <span>                                
                                <select name="STATUS_CODE" id="STATUS_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">--ทั้งหมด--</option>                       
                                     @foreach ($grecordstatuss as $grecordstatus)
                                                @if($grecordstatus->ID_STATUS == $status_check)
                                                    <option value="{{ $grecordstatus->ID_STATUS  }}" selected>{{ $grecordstatus->STATUS_NAME}}</option>
                                                @else
                                                    <option value="{{ $grecordstatus->ID_STATUS  }}" >{{ $grecordstatus->STATUS_NAME}}</option>
                                                @endif
                                            @endforeach  

                                </select>
                                </span>
                            </div>                   
                            <div class="col-sm-0.5">
                                &nbsp;คำค้นหา &nbsp;
                            </div>                            
                            <div class="col-sm-2">
                                <span>                            
                                    <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">
                                </span>
                            </div>     
                            <div class="col-sm-30">
                            &nbsp;
                        </div>                   
                            <div class="col-sm-1">
                                <span>
                                    <button type="submit" class="btn btn-info" >ค้นหา</button>
                                </span> 
                            </div>              
                        </div>  



             </form>
             <div class="table-responsive">
                            <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                <thead style="background-color: #FFEBCD;">
                                    <tr height="40">
                                        <th style="border-color:#A9A9A9;text-align: center;" width="5%">ลำดับ</th>

                                        <th style="border-color:#A9A9A9;text-align: center;" width="10%">สถานะ</th>
                                        <th  style="border-color:#A9A9A9;text-align: center;" width="5%">สรุป</th>
                                        <th  class="text-font" class="text-font" style="border-color:#A9A9A9;text-align: center;" width="12%">วันที่ไป</th>
                                        <th  class="text-font" class="text-font" style="border-color:#A9A9A9;text-align: center;" width="22%">ประเภทการไป</th>
                                        <th  class="text-font" style="border-color:#A9A9A9;text-align: center;" width="22%">เรื่อง</th>
                                        <th  class="text-font" class="text-font" style="A9A9A9-color:#A9A9A9;text-align: center;" width="15%">สถานที่</th>
                                        <th  class="text-font" style="border-color:#A9A9A9;text-align: center;" width="18%">ชื่อผู้บันทึก</th>
                                        <th  class="text-font" style="border-color:#A9A9A9;text-align: center"  width="12%">คำสั่ง</th>


                                    </tr >
                                </thead>
                                <tbody>
                                <?php $number = 0; ?>
                                @foreach ($inforrecordindexs as $inforrecordindex)
                                <?php $number++;

                                $status =  $inforrecordindex -> STATUS;
                                if( $status === 'APPLY'){
                                    $statuscol =  "badge badge-warning";

                                }else if($status === 'EDIT'){
                                   $statuscol =  "badge badge-danger";

                                }else if($status === 'RECEIVE'){
                                    $statuscol =  "badge badge-info";
                                }else if($status === 'SUCCESS'){
                                    $statuscol =  "badge badge-success";
                                }else{
                                    $statuscol =  "badge badge-secondary";
                                }



                                ?>

                                    <tr height="20">
                                        <td align="center">{{$number}}</td>

                                        <td align="center"><span class="{{$statuscol}}" >{{ $inforrecordindex->STATUS_NAME}}</span></td>
                                        @if($inforrecordindex->SAVE_BACK == True)

                                            <td align="center"><a href="{{ url('person_dev/persondevconcludeedit/'.$inforrecordindex -> ID.'/'.$inforpersonuserid -> ID)}}"  class="btn btn-success"><i class="fa fa-check"></i></a></td>
                                        @elseif($inforrecordindex->STATUS == 'SUCCESS')
                                            <td align="center"><a href="{{ url('person_dev/persondevconclude/'.$inforrecordindex -> ID.'/'.$inforpersonuserid -> ID)}}"  class="btn btn-warning"><i class="fa fa-edit"></i></a></td>

                                        @else
                                        <td align="center"><i class="fa fa-sync-alt"> </i></td>
                                        @endif
                                        <td class="text-font text-pedding" align="center">{{ DateThai($inforrecordindex->DATE_GO)}}<br>{{ DateThai($inforrecordindex->DATE_BACK)}}</td>
                                        <td class="text-font text-pedding" >{{ $inforrecordindex->RECORD_TYPE_NAME}} </td>
                                        
                                        <td class="text-font text-pedding" >{{ $inforrecordindex->RECORD_HEAD_USE}}</td>
                                        <td class="text-font text-pedding" >{{ $inforrecordindex->LOCATION_ORG_NAME}}</td>
                                        <td class="text-font text-pedding" >{{ $inforrecordindex->USER_POST_NAME}}</td>

                                        <td align="center">
                                        <div class="dropdown">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                    <a class="dropdown-item"  href="#detail_modal{{ $inforrecordindex -> ID }}"  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">รายละเอียด</a>
                                                    @if($status !== 'SUCCESS')
                                                    <a class="dropdown-item"  href="{{ url('person_dev/persondevedit/'.$inforrecordindex -> ID.'/'.$inforpersonuserid -> ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                    @endif


                                                            @if ($codes == '10999')
                                                            <a class="dropdown-item" href="{{ url('formpdf/personperdev_10999/'.$inforrecordindex -> ID.'/'.$inforpersonuserid -> ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank">พิมพ์ใบขอไปราชการ</a>
                                                            @else
                                                            <a class="dropdown-item"  href="{{ url('person_dev/persondevpdfgovernment_outside/'.$inforrecordindex -> ID.'/'.$inforpersonuserid -> ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank">พิมพ์ใบขอไปราชการ</a>
                                                            @endif

                                                    
                                                   
                                                   
                                                   
                                                    <a class="dropdown-item"  href="{{ url('person_dev/persondevcancel/'.$inforrecordindex -> ID.'/'.$inforpersonuserid -> ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แจ้งยกเลิก</a>
                                                    
                                                    @if($inforrecordindex->RECORD_TYPE_ID == 3)
                                                    -------------------
                                                    <a class="dropdown-item"  href="{{ url('person_dev/persondevaccept/'.$inforrecordindex -> ID.'/'.$inforpersonuserid -> ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" >ตอบรับวิทยากร</a>
                                                    <a class="dropdown-item"  href="{{ url('person_dev/persondevpdfallow/'.$inforrecordindex -> ID.'/'.$inforpersonuserid -> ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank">พิมพ์ใบขออนญาต</a>
                                                    <a class="dropdown-item"  href="{{ url('person_dev/persondevpdfaccept/'.$inforrecordindex -> ID.'/'.$inforpersonuserid -> ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank">พิมพ์ใบตอบรับวิทยากร</a>
                                                    @endif
                                                </div>
                                        </div>
                                        </td>


                                    </tr>

                                    <div id="detail_modal{{ $inforrecordindex -> ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
    <div class="modal-header">

    <div class="row">
    <div>รายละเอียดคำขอเลขที่ {{ $inforrecordindex -> ID }} &nbsp;&nbsp;&nbsp;&nbsp;</div>
    <div>
    <button  class="btn btn-info" >ยืมเงิน</button>
    <a href=""  class="btn btn-info" >พิมพ์สรุปรายงาน</a>
    </div>

    </div>
        </div>
        <div class="modal-body">


        <div class="row">

       <div class="col-sm-2">
           <div class="form-group">
           <label >หัวข้อประชุม :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group" >
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> RECORD_HEAD_USE }}</h1>
           </div>
       </div>

       <div class="col-sm-2">
           <div class="form-group">
           <label >สถานที่จัดประชุม :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> LOCATION_ORG_NAME }}</h1>
           </div>
       </div>

       </div>

       <div class="row">
       <div class="col-sm-2">
           <div class="form-group">
           <label >ระดับ :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> RECORD_LEVEL_NAME}}</h1>
           </div>
       </div>
       <div class="col-sm-2">
           <div class="form-group">
           <label >หน่วยงานที่จัด :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> RECORD_ORG_NAME }}</h1>
           </div>
       </div>
       </div>


       <div class="row">
       <div class="col-sm-2">
           <div class="form-group">
           <label>ประเภทสถานที่ประชุม :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> LOCATION_NAME }}</h1>
           </div>
       </div>
       <div class="col-sm-2">
           <div class="form-group">
           <label>ระหว่างวันที่ :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ DateThai($inforrecordindex -> DATE_GO) }} ถึง {{ DateThai($inforrecordindex -> DATE_BACK) }}</h1>
           </div>
       </div>
      </div>



       <div class="row">
       <div class="col-sm-2">
           <div class="form-group">
           <label >หมายเหตุ :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> RECORD_COMMENT }}</h1>
           </div>
       </div>
       <div class="col-sm-2">
           <div class="form-group">
           <label >ลักษณะ :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> RECORD_GO_NAME }}</h1>
           </div>
       </div>

       </div>

       <div class="row">
       <div class="col-sm-2">
           <div class="form-group">
           <label > พาหนะเดินทาง :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> RECORD_VEHICLE_NAME }}</h1>
           </div>
       </div>
       <div class="col-sm-2">
           <div class="form-group">
           <label>การเบิกเงิน :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> WITHDRAW_NAME }}</h1>
           </div>
       </div>

       </div>

       <div class="row">
       <div class="col-sm-2">
           <div class="form-group">
           <label >หัวหน้าฝ่าย :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> LEADER_HR_NAME }}</h1>
           </div>
       </div>
       <div class="col-sm-2">
           <div class="form-group">
           <label >มอบหมายงานให้ :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> OFFER_WORK_HR_NAME }}</h1>
           </div>
       </div>
       </div>


      </div>
        <div class="modal-footer">
        <div align="right">
        <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal" >ปิดหน้าต่าง</button>
        </div>
        </div>
        </form>
</body>


    </div>
  </div>
</div>
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


</script>



@endsection