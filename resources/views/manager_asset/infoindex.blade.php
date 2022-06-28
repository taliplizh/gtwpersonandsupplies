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

  function getAge($day) {
    $then = strtotime($day);
    return(floor((time()-$then)/31556926));
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
                                <a href="{{ url('general_asset/dashboard/'.$inforpersonuserid -> ID)}}" class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">Dashboard</a> 
                                </div>
                                <div>&nbsp;</div>     
                                <div>
                                <a href="{{ url('general_asset/genassetindex/'.$inforpersonuserid -> ID)}}" class="btn btn-success" >ทะเบียนครุภัณฑ์</a> 
                                </div>
                                <div>&nbsp;</div>                      
                                <div>
                                <a href="{{ url('general_asset/genassetdisburseindex/'.$inforpersonuserid -> ID)}}" class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนเบิกครุภัณฑ์  
                                </a> 
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_asset/infolendindex/'.$inforpersonuserid -> ID)}}" class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนยืม
                                </a>   
                                </div>           
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_asset/infogiveindex/'.$inforpersonuserid -> ID)}}" class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนถูกยืม
                                </a>   
                                </div>    
                         
                                
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
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ทะเบียนครุภัณฑ์ | หน่วยงาน</B></h3>
            <a href="#detail_giveasset"  data-toggle="modal"   class="btn btn-success" >ครุภัณฑ์ที่ยืม</a>

        </div>
        <div class="block-content block-content-full">
        <form action="{{ route('asset.infoindexsearch',[ 'iduser'=>$inforpersonuserid->ID ]) }}" method="post">
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
                <select name="SEND_STATUS" id="SEND_STATUS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                <option value="">--ทั้งหมด--</option>
                @foreach ($info_sendstatuss as $info_sendstatus)
                    @if($info_sendstatus->STATUS_ID == $status_check)
                    <option value="{{ $info_sendstatus->STATUS_ID  }}" selected>{{ $info_sendstatus->STATUS_NAME}}</option>
                    @else
                    <option value="{{ $info_sendstatus->STATUS_ID  }}">{{ $info_sendstatus->STATUS_NAME}}</option>
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

                <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif; font-weight:normal;" value="{{$search}}">

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
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                    <tr height="40">
                                      <th style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="5%">ลำดับ</th>
                                       
                                       <th  class="text-font"  style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="5%">ปีงบ</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="10%">เลขครุภัณฑ์</th>    
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"  width="5%">วันที่รับเข้า</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"  width="18%">ประเภทครุภัณฑ์</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"  >ชื่อ</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="8%"> ประจำอยู่หน่วยงาน</th> 
                                       <!--<th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="10%">สถานที่ตั้ง</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="10%">ที่อยู่ชั้น</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="10%">ที่ตั้งห้อง</th>--> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="6%">อายุใช้</th> 
                                        <!--<th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="5%">วันหมดสภาพ</th>-->  
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="8%"> สถานะ</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"  width="12%">คำสั่ง</th>   
                                </tr>
                    </thead>
                    <tbody>     
                    <?php $number = 0; ?>
                                @foreach ($infoassets as $infoasset)
                                <?php $number++; ?>

                                    <tr height="20">
                                        <td class="text-font" align="center">{{$number}}</td>
                                        <td class="text-font" align="center">{{ $infoasset->YEAR_ID }}</td>
                                        <td class="text-font" align="center">{{ $infoasset->ARTICLE_NUM }}</td>
                                        <td class="text-font" align="center">{{ DateThai($infoasset->RECEIVE_DATE) }}</td>
                                        <td class="text-font text-pedding">{{ $infoasset->DECLINE_NAME }}</td>
                                        <td class="text-font text-pedding">{{ $infoasset->ARTICLE_NAME }}</td>
                                        <td class="text-font text-pedding" >{{ $infoasset->HR_DEPARTMENT_SUB_SUB_NAME }}</td>
                                         <!--<td class="text-font text-pedding">{{ $infoasset->LOCATION_NAME }}</td>
                                        <td class="text-font text-pedding">{{ $infoasset->LOCATION_LEVEL_NAME }}</td>
                                        <td class="text-font text-pedding">{{ $infoasset->LEVEL_ROOM_NAME }}</td>-->
                                        <td class="text-font" align="center">{{ getAge($infoasset->RECEIVE_DATE) }}</td>
                                        
                                        @if($infoasset->STATUS_ID == 4)
                                        <td class="text-font" align="center">ถูกยืม</td>
                                        @elseif($infoasset->STATUS_ID == 3)
                                        <td class="text-font" align="center">รอจำหน่าย</td>
                                        @elseif($infoasset->STATUS_ID == 2)
                                        <td class="text-font" align="center">จำหน่ายแล้ว</td>
                                        @else
                                        <td class="text-font" align="center">ปกติ</td>
                                        @endif
                                       
                                        
                                         <!--<td class="text-font " align="center">{{ DateThai($infoasset->EXPIRE_DATE)  }}</td>-->
                                   
                            <td align="center">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                ทำรายการ
                                            </button>
                                            <div class="dropdown-menu" style="width:10px">
                                                <a class="dropdown-item"  href="{{ url('general_asset/infoasset/'.$inforpersonuserid->ID.'/'.$infoasset -> ARTICLE_ID)}}"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">รายละเอียด</a>
                                                <a class="dropdown-item"  href="{{ url('general_asset/inforeceive/'.$inforpersonuserid->ID.'/'.$infoasset -> ARTICLE_ID)}}"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" onclick="return confirm('รับคืนครุภัณฑ์ {{ $infoasset->ARTICLE_NUM }} ::  {{ $infoasset->ARTICLE_NAME }} ?')">รับคืนครุภัณฑ์</a>
                      
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



                            <div id="detail_giveasset" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                            
                                            <div class="row">
                                            <div><h3  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;รายละเอียดครุภัณฑ์ที่ยืม&nbsp;&nbsp;</h3></div>
                                            </div>
                                                </div>
                                                <div class="modal-body" >
                                                    
                                                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                    <tr height="40">
                                      <th style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="5%">ลำดับ</th>
                                       
                                       <th  class="text-font"  style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="5%">ปีงบ</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="10%">เลขครุภัณฑ์</th>    
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"  width="5%">วันที่รับเข้า</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"  width="18%">ประเภทครุภัณฑ์</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"  >ชื่อ</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="8%"> ประจำอยู่หน่วยงาน</th> 
                                       <!--<th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="10%">สถานที่ตั้ง</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="10%">ที่อยู่ชั้น</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="10%">ที่ตั้งห้อง</th>--> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="6%">อายุใช้</th> 
                                        <!--<th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="5%">วันหมดสภาพ</th>-->  
                                    
                                    
                                </tr>
                    </thead>
                    <tbody>     
                    <?php $number = 0; ?>
                                @foreach ($infoasset_res as $infoasset_re)
                                <?php $number++; ?>

                                    <tr height="20">
                                        <td class="text-font" align="center">{{$number}}</td>
                                        <td class="text-font" align="center">{{ $infoasset_re->YEAR_ID }}</td>
                                        <td class="text-font" align="center">{{ $infoasset_re->ARTICLE_NUM }}</td>
                                        <td class="text-font" align="center">{{ DateThai($infoasset_re->RECEIVE_DATE) }}</td>
                                        <td class="text-font text-pedding">{{ $infoasset_re->DECLINE_NAME }}</td>
                                        <td class="text-font text-pedding">{{ $infoasset_re->ARTICLE_NAME }}</td>
                                        <td class="text-font text-pedding" >{{ $infoasset_re->HR_DEPARTMENT_SUB_SUB_NAME }}</td>
                                      
                                        <td class="text-font" align="center">{{ getAge($infoasset_re->RECEIVE_DATE) }}</td>
                                        
                    
                

                        @endforeach  
                    </tbody>
                </table>
                                        
                                                            
                                                
                                                    
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
            }).datepicker();  //กำหนดเป็นวันปัจุบัน
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
</script>



@endsection