@extends('layouts.backend')

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

    
      .form-control {
    font-size: 13px;
                  }  

        table {
            border-collapse: collapse;
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



use App\Http\Controllers\ManagerplanController;
    $refnumber = ManagerplanController::refnumberPt();

$m_budget = date("m");
if($m_budget>9){
  $yearbudget = date("Y")+544;
}else{
  $yearbudget = date("Y")+543;
}


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


?>


                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content content-full">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                <div class="row">
                                <div >
                                    <a href="{{ url('general_plan/plan_dashboard/'.$inforpersonuserid -> ID)}}" class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">Dashboard</a>
                                </div>
                                    <div>&nbsp;</div>

                                <div >
                                <a href="{{ url('general_plan/plan_project/'.$inforpersonuserid -> ID)}}" class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">แผนงานโครงการ</a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_plan/plan_humandev/'.$inforpersonuserid -> ID)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">แผนพัฒนาบุคลากร</a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_plan/plan_durable/'.$inforpersonuserid -> ID)}}" class="btn btn-info" >แผนซื้อครุภัณฑ์</a>
                                </div>
                                <div>&nbsp;</div>
                                <a href="{{ url('general_plan/plan_repair/'.$inforpersonuserid -> ID)}}" class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">แผนซ่อมบำรุง</a>
                                </div>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <center>
                <div class="content">
                <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B><i class="fas fa-plus"></i> เพิ่มข้อมูลแผนจัดซื้อครุภัณฑ์</B></h3>
               
            </div>
            <div class="block-content block-content-full">

            
            <form  method="post" action="{{ route('guest.geninfodurable_save') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="DUR_SAVE_HR_ID" id="DUR_SAVE_HR_ID" value="{{$id_user}}">

        <div class="col-sm-12">
        <div class="row push">
        <div class="col-lg-2" style="text-align: left">
        <label >                           
        ปีงบประมาณ :              
        </label>
        </div> 
        <div class="col-lg-2">
        <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;">   
                     @foreach ($budgets as $budget)
                             @if($budget->LEAVE_YEAR_ID== $year_id)
            <option value="{{ $budget->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}</option>
                            @else
            <option value="{{ $budget->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                                @endif                                 
                            @endforeach                         
            </select>
        </div> 

        <div class="col-lg-2" style="text-align: left">
        <label >                           
        ประเภทแผนงาน :              
        </label>
        </div> 
        <div class="col-lg-6">
        <select name="PLAN_TYPE_ID" id="PLAN_TYPE_ID" class="form-control input-sm js-example-basic-single"  style=" font-family: 'Kanit', sans-serif;">   
        <option value="">กรุณาเลือกแผนงาน</option>                         
                @foreach ($infoplantypes as $infoplantype)      
                    <option value="{{ $infoplantype->PLAN_TYPE_ID  }}">{{ $infoplantype->PLAN_TYPE_NAME}}</option>                                      
                @endforeach                         
                                </select>
        </div>
  
        </div>  

        <div class="row push">

        <div class="col-lg-2" style="text-align: left">
        <label >                           
        ตามยุทธศาสตร์ :              
        </label>
        </div> 
        <div class="col-lg-10">
        <select name="STRATEGIC_ID" id="STRATEGIC_ID" class="form-control input-lg js-example-basic-single strategic" style=" font-family: 'Kanit', sans-serif;" onclick="checkhrdepartment()">
                        <option value="" >--กรุณาเลือกยุทธศาสตร์--</option>
                                @foreach ($infostrategics as $infostrategic) 
                                                                                                  
                                    <option value="{{ $infostrategic ->STRATEGIC_ID  }}">{{ $infostrategic->STRATEGIC_NAME }}</option>
                                                                       
                        @endforeach 
        </select>
        </div> 
   
        </div>
        <div class="row push">
        <div class="col-lg-2" style="text-align: left">
        <label >                           
        เป้าประสงค์ :              
        </label>
        </div> 
        <div class="col-lg-10">
        <select name="TARGET_ID" id="TARGET_ID" class="form-control input-lg js-example-basic-single goal" style=" font-family: 'Kanit', sans-serif;" onclick="checkhrdepartmentsub()">
        <option value="" >--กรุณาเลือกเป้าประสงค์--</option>
        </select>
        </div> 

        </div> 
        <div class="row push">
        <div class="col-lg-2" style="text-align: left">
        <label >                           
        ตัวชี้วัด :              
        </label>
        </div> 
        <div class="col-lg-10">
        <select name="KPI_ID" id="KPI_ID" class="form-control input-lg js-example-basic-single metric" style=" font-family: 'Kanit', sans-serif;" onclick="checkhrdepartmentsubsub()">
        <option value="" >--กรุณาเลือกตัวชี้วัด--</option>
        </select>
        </div> 
   
        </div>

        <div class="row push">
        <div class="col-lg-2" style="text-align: left">
        <label >                           
        รหัสโครงการ :              
        </label>
        </div> 
        <div class="col-lg-2">
        <input name="DUR_NUMBER" id="DUR_NUMBER" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$refnumber}}" >
        </div>

        <div class="col-lg-1" style="text-align: left">
        <label >                           
        Service Plan :              
        </label>
        </div> 
        <div class="col-lg-2">
        <input name="DUR_SERVICE" id="DUR_SERVICE" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
        </div>
        <div class="col-lg-2" style="text-align: left">
        <label >                           
        งบประมาณ:              
        </label>
        </div> 
        <div class="col-lg-3">
       <select name="BUDGET_ID" id="BUDGET_ID" class="form-control input-sm js-example-basic-single"  style=" font-family: 'Kanit', sans-serif;" required>   
        <option value="">กรุณาเลือกแผนงาน</option>                         
                @foreach ($infobudgettypes as $infobudgettype)      
                    <option value="{{ $infobudgettype->BUDGET_ID  }}">{{ $infobudgettype->BUDGET_NAME}}</option>                                      
                @endforeach                         
        </select>
        </div> 

        </div>
        <div class="row push">
        <div class="col-lg-2" style="text-align: left">
        <label >                           
        ครุภัณฑ์ :              
        </label>
        </div> 
        <div class="col-lg-5 detali_asset">
        <input name="DUR_ASS_NAME" id="DUR_ASS_NAME" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
        </div>
        <div class="col-lg-1">
        <button type="button" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target=".addfsn"  >เลือก</button>
        </div>
     
        <div class="col-lg-1" style="text-align: left">
        <label >                           
        เลขครุภัณฑ์  :              
        </label>
        </div> 
        <div class="col-lg-3 detali_fsn">
        <input name="DUR_FSN" id="DUR_FSN" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
        </div>

        <div class="col-lg-2" style="text-align: left">
        <label >                           
        อ้างอิง  :              
        </label>
        </div> 
        <div class="col-lg-2">
        <select name="DUR_REF" id="DUR_REF" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" required >
        <option value="กบรส" >กบรส</option>
        <option value="สำนักงบฯ" >สำนักงบฯ</option>
        </select>
        </div>

        <div class="col-lg-1" style="text-align: left">
        <label >                           
       รหัสรายการ  :              
        </label>
        </div> 
        <div class="col-lg-2">
        <input name="DUR_REF_CODE" id="DUR_REF_CODE" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
        </div>
        <div class="col-lg-2">
        <label>                           
        ลำดับความเร่งด่วน  :              
        </label>
        </div> 
        <div class="col-lg-3">
        <input name="DUR_HASTE" id="DUR_HASTE" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
        </div>
        </div>
        <div class="row push">
        
        <div class="col-lg-2">
        <label>                           
        เหตุผล  :              
        </label>
        </div> 
        <div class="col-lg-2">
        <select name="DUR_REASON_ID" id="DUR_REASON_ID" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" required>
        <option value="1" >ทดแทนของเก่า</option>
        <option value="2" >จัดซื้อของใหม่</option>
        </select>
       
        </div>

        <div class="col-lg-1">
        <label>                           
    ครุภัณฑ์เดิม  :              
        </label>
        </div> 
        <div class="col-lg-6 detali_ass">
        <input name="DUR_ASS_OLD" id="DUR_ASS_OLD" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
        </div>
        <div class="col-lg-1 ">
        <button type="button" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target=".addass"  >เลือก</button>
        </div> 
        </div>

        <div class="row push">
    
        <div class="col-lg-2" style="text-align: left">
        <label >                           
        จำนวน :            
        </label>
        </div> 
        <div class="col-lg-2">
        <input name="DUR_ASS_AMOUNT" id="DUR_ASS_AMOUNT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  OnKeyPress="return chkmunny(this)">
        </div> 

        <div class="col-lg-1" style="text-align: left">
        <label >                           
        ราคาต่อหน่วย :              
        </label>
        </div> 
        <div class="col-lg-2">
        <input name="DUR_ASS_PICE_UNIT" id="DUR_ASS_PICE_UNIT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  OnKeyPress="return chkmunny(this)">
        </div>
        <div class="col-lg-1" style="text-align: left">
        <label >                           
        บาท            
        </label>
        </div>

        <div class="col-lg-1" style="text-align: left">
        <label >                           
        ใช้จริง :            
        </label>
        </div> 
        <div class="col-lg-2">
        <input name="BUDGET_PICE_REAL" id="BUDGET_PICE_REAL" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  OnKeyPress="return chkmunny(this)">
        </div> 
        <div class="col-lg-0.5">
        <label > 
         บาท
         </label > 
        </div> 

      

        </div>

        <div class="row push">
        <div class="col-lg-2" style="text-align: left">
        <label >                           
        วันที่เริ่มต้น :              
        </label>
        </div> 
        <div class="col-lg-2">
        <input  name = "DUR_ASS_BEGIN_DATE"  id="DUR_ASS_BEGIN_DATE" class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;" readonly required>
        </div> 
        <div class="col-lg-1" style="text-align: left">
        <label>                           
        ถึงวันที่            
        </label>
        </div> 
        <div class="col-lg-2">
        <input  name = "DUR_ASS_END_DATE"  id="DUR_ASS_END_DATE" class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;" readonly required>
        </div> 

        </div>

        <div class="row push">
       
       
        

        </div>

  
        <div class="row push">
        <div class="col-lg-2" style="text-align: left">
        <label >                           
        ประเภทแผนงาน :              
        </label>
        </div> 
        <div class="col-lg-4">
        <select name="DUR_TYPE" id="DUR_TYPE" class="form-control input-sm js-example-basic-single plantype"  style=" font-family: 'Kanit', sans-serif;" required>   
                    <option value="team">ทีมประสาน</option>  
                    <option value="dep">หน่วยงาน</option>                       
        </select>
        </div>

        <div class="col-lg-2" style="text-align: left">
        <label >                           
        ทีมประสาน/หน่วยงาน :              
        </label>
        </div> 
        <div class="col-lg-4">
        <select name="DUR_TEAM_NAME" id="DUR_TEAM_NAME" class="form-control input-sm js-example-basic-single teamunit"  style=" font-family: 'Kanit', sans-serif;" required>   
        <option value="">กรุณาเลือก</option>                         
                @foreach ($infotreams as $infotream)      
                    <option value="{{ $infotream->HR_TEAM_NAME  }}">{{ $infotream->HR_TEAM_NAME}} : {{ $infotream->HR_TEAM_DETAIL}}</option>                                      
                @endforeach                         
                                </select>
        </div>
       
       
        </div> 
 

 
        <div class="row push">
                    <div class="col-lg-2" style="text-align: left">
                    <label >                           
                    ผู้รับผิดชอบ :              
                    </label>
                    </div> 
                    <div class="col-lg-4">
                    <select name="DUR_TEAM_HR_ID" id="DUR_TEAM_HR_ID" class="form-control input-sm js-example-basic-single headperson"  style=" font-family: 'Kanit', sans-serif;" required>   
                    <option value="" >กรุณาเลือก</option>    
                    </select>
                    </div>
            
                    <div class="col-lg-2" style="text-align: left">
                    <label >                           
                    หมายเหตุ :            
                    </label>
                    </div> 
                    <div class="col-lg-4">
                    <input name="DUR_COMMENT" id="DUR_COMMENT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  required>
                    </div> 

     
   
        </div>
     
       </div>
       <br>
 
       



        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึก</button>
        <a href="{{ url('general_plan/plan_durable/'.$inforpersonuserid -> ID)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
        </div>

       
        </div>
        </form>  

            <!--    เมนูเลือก   -->
       
            <div class="modal fade addfsn" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalfsn">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">          
                            <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">เลือกครุภัณฑ์</h2>
                        </div>
                    <div class="modal-body">
                <body>
                    <div class="container mt-3">
                        <input class="form-control" id="myInput" type="text" placeholder="ค้นหา..">
                <br>
                        <div style='overflow:scroll; height:300px;'>
                        <table class="table">
                            <thead>
                      
                                <tr>
                                    <td style="text-align: center;" width="20%">เลข FSN</td>
                                    <td style="text-align: center;">ชื่อพัสดุ</th>
                                
                                    <td style="text-align: center;" width="5%">เลือก</td>
                                </tr>

                            </thead>
                            <tbody id="myTable">
                            @foreach ($suppliesprops as $suppliesprop)
                                    <tr>
                                        <td >{{$suppliesprop->NUM}}</td>
                                        <td >{{$suppliesprop->PROPOTIES_NAME}}</td>
                                                                
                                        <td >
                                             <button type="button" class="btn btn-hero-sm btn-hero-info"    onclick="selectasset({{$suppliesprop->PROPOTIES_ID}})">เลือก</button> 
                                          
                                        </td>
                                    </tr>

                                    @endforeach 
                           
                            </tbody>
                        </table>    
                    </div>
                </div>
                </div>
                    <div class="modal-footer">
                        <div align="right">
                                <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" >ปิดหน้าต่าง</button>
                        </div>
                    </div>
                </body>
            </div>
          </div>
        </div>


               <!--    เมนูเลือก   -->
       
               <div class="modal fade addass" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalass">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">          
                            <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">เลือกครุภัณฑ์</h2>
                        </div>
                    <div class="modal-body">
                <body>
                    <div class="container mt-3">
                        <input class="form-control" id="myInput02" type="text" placeholder="ค้นหา..">
                <br>
                        <div style='overflow:scroll; height:300px;'>
                        <table class="table">
                            <thead>
                      
                                <tr>
                                    <td style="text-align: center;" width="20%">เลขพัสดุ</td>
                                    <td style="text-align: center;">ชื่อพัสดุ</th>
                                
                                    <td style="text-align: center;" width="5%">เลือก</td>
                                </tr>

                            </thead>
                            <tbody id="myTable02">

                            @foreach ($assetarticles as $assetarticle)
                                    <tr>
                                        <td >{{$assetarticle->ARTICLE_NUM}}</td>
                                        <td >{{$assetarticle->ARTICLE_NAME}}</td>                                                            
                                        <td>
                                             <button type="button" class="btn btn-hero-sm btn-hero-info"    onclick="selectass({{$assetarticle->ARTICLE_ID}})">เลือก</button> 
                                        </td>
                                    </tr>

                                    @endforeach 
                           
                            </tbody>
                        </table>    
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                        <div align="right">
                                <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" >ปิดหน้าต่าง</button>
                        </div>
                    </div>
                </body>
            </div>
          </div>
    </div>
               
                      

  
@endsection

@section('footer')

<script src="{{ asset('select2/select2.min.js') }}"></script>

<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>

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

$('.strategic').change(function(){
     if($(this).val()!=''){
     var select=$(this).val();
     var _token=$('input[name="_token"]').val();
     $.ajax({
             url:"{{route('plandropdown.strategic')}}",
             method:"GET",
             data:{select:select,_token:_token},
             success:function(result){
                $('.goal').html(result);
             }
     })
    
     }        
});

$('.goal').change(function(){
     if($(this).val()!=''){
     var select=$(this).val();
     var _token=$('input[name="_token"]').val();
     $.ajax({
             url:"{{route('plandropdown.goal')}}",
             method:"GET",
             data:{select:select,_token:_token},
             success:function(result){
                $('.metric').html(result);
             }
     })
   
     }        
});





$('.plantype').change(function(){
     if($(this).val()!=''){
     var select=$(this).val();
     var _token=$('input[name="_token"]').val();
     $.ajax({
             url:"{{route('plandropdown.plantype')}}",
             method:"GET",
             data:{select:select,_token:_token},
             success:function(result){
                $('.teamunit').html(result);
             }
     })
   
     }        
});


$('.teamunit').change(function(){
     if($(this).val()!=''){
     var select=$(this).val();
     var PROTYPE=document.getElementById("DUR_TYPE").value;
     var _token=$('input[name="_token"]').val();
     $.ajax({
             url:"{{route('plandropdown.teamunit')}}",
             method:"GET",
             data:{select:select,PROTYPE:PROTYPE,_token:_token},
             success:function(result){
                $('.headperson').html(result);
             }
     })
   
     }        
});


</script>

<script>


function detail(id){

$.ajax({
           url:"{{route('suplies.detailapp')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#detail').html(result);
             
         
             
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
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });



    function selectasset(id){
      
    
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('mplan.selectasset')}}",
                   method:"GET",
                   data:{id:id,_token:_token},
                   success:function(result){
                    $('.detali_asset').html(result);
                    selectfsn(id);
                   }
           })

           $('#modalfsn').modal('hide');

  }

  

  $(document).ready(function(){
          $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });




 $(document).ready(function(){
          $("#myInput02").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable02 tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });



        function selectfsn(id){
      
    
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('mplan.selectfsn')}}",
                   method:"GET",
                   data:{id:id,_token:_token},
                   success:function(result){
                    $('.detali_fsn').html(result);
                   }
           })

         

  }
   

  function chkmunny(ele){
    var vchar = String.fromCharCode(event.keyCode);
    if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
    ele.onKeyPress=vchar;
    }



  function selectass(id){
    

    var _token=$('input[name="_token"]').val();
       $.ajax({
               url:"{{route('mplan.selectass')}}",
               method:"GET",
               data:{id:id,_token:_token},
               success:function(result){
                $('.detali_ass').html(result);
               }
       })

       $('#modalass').modal('hide');

}

</script>

@endsection