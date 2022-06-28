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
             <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1> 
             <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                <div class="row">
                                <div>
                                <a href="{{ url('general_asset/dashboard/'.$inforpersonuserid -> ID)}}" class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">Dashboard</a> 
                                </div>
                                <div>&nbsp;</div>     
                                <div>
                                <a href="{{ url('general_asset/genassetindex/'.$inforpersonuserid -> ID)}}" class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนครุภัณฑ์</a> 
                                </div>
                                <div>&nbsp;</div>                      
                                <div>
                                <a href="{{ url('general_asset/genassetdisburseindex/'.$inforpersonuserid -> ID)}}" class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนเบิกครุภัณฑ์  
                                </a> 
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_asset/infolendindex/'.$inforpersonuserid -> ID)}}" class="btn btn-info" >ทะเบียนยืม
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
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ทะเบียนขอยืมครุภัณฑ์ | หน่วยงาน</B></h3>
            {{-- <a href="{{ url('person_dev/persondevadd/'.$inforpersonuserid -> ID)}}"  class="btn btn-info" ><i class="fas fa-plus"></i> เพิ่มการอบรม</a> 
            <a href="{{ url('general_asset/infolendadd/'.$inforpersonuserid -> ID)}}"  class="btn btn-info" >ออกทะเบียนขอยืม </a>--}}
            <button type="button" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target=".add" >ออกทะเบียนขอยืม</button>
        </div>
        <div class="block-content block-content-full">
        <form action="{{ route('asset.infolendindexsearch',[ 'iduser'=>$inforpersonuserid->ID ]) }}" method="post">
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
                    @if($info_sendstatus->STATUS == $status_check)
                    <option value="{{ $info_sendstatus->STATUS }}" selected>{{ $info_sendstatus->STATUS_NAME}}</option>
                    @else
                    <option value="{{ $info_sendstatus->STATUS  }}">{{ $info_sendstatus->STATUS_NAME}}</option>
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
                <div class="col-sm-1">
                <span>
                <button type="submit" class="btn btn-info" >ค้นหา</button>
                </span> 
                </div>
                    </div>  
            </form>
        <div class="table-responsive">
        <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">                          
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">สถานะ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">วันที่ต้องการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >เหตุผลยืมเพื่อ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">หน่วยงานที่ถูกยืม</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">เจ้าหน้าที่ผู้ร้องขอ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>     
                    <?php $number = 0; ?>
                    @foreach ($inforequests as $inforequest)  

                    <?php $number++;
                    


                    ?>
                        <tr height="20">
                        <td class="text-font" align="center">{{$number}}</td>
                            <td class="text-font" align="center">
                                    
                                @if($inforequest -> STATUS == 'REQUEST')
                                <span class="badge badge-info">ร้องขอ</span>
                                @elseif($inforequest -> STATUS == 'APPROVE')
                                <span class="badge badge-success">อนุมัติ</span>
                                @elseif($inforequest -> STATUS == 'NOTAPPROVE')
                                <span class="badge badge-danger">ไม่อนุมัติ</span>
                                @elseif($inforequest -> STATUS == 'CANCEL')
                                <span class="badge badge-secondary">ยกเลิก</span>
                                @else
                                <span class="badge badge-secondary"></span>
                                @endif
                                    


                            </td>
                            <td class="text-font text-pedding" >{{ DateThai($inforequest -> DATE_WANT) }}</td>
                            <td class="text-font text-pedding" >{{ $inforequest -> REQUEST_FOR }}</td> 
                            <td class="text-font text-pedding" >{{ $inforequest -> GIVE_DEP_SUB_SUB_NAME  }}</td> 
                            <td class="text-font text-pedding" >{{ $inforequest -> SAVE_HR_NAME }}</td> 
                            <td align="center">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                ทำรายการ
                                            </button>
                                            <div class="dropdown-menu" style="width:10px">
                                                <a class="dropdown-item"  href="{{ url('general_asset/infolendindexdetail/'.$inforpersonuserid -> ID.'/'.$inforequest -> ID)}}"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">รายละเอียด</a>
                                                <a class="dropdown-item"  href="{{ url('general_asset/infolendindexedit/'.$inforpersonuserid -> ID.'/'.$inforequest -> ID)}}"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                <a class="dropdown-item"  href="{{ url('general_asset/infolendindexcancel/'.$inforpersonuserid -> ID.'/'.$inforequest -> ID)}}"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แจ้งยกเลิก</a> 

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




<div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    <div class="modal-header">
          
          <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">เลือกหน่วยงานที่ต้องการยืม</h2>
        </div>
        <div class="modal-body">
        <body>
        <form  method="post" action="{{ route('asset.infolendindexsenddep',[ 'iduser'=>$inforpersonuserid->ID ]) }}"  onSubmit="return check()">
        @csrf
      <div class="form-group">
      <div class="row">
      <div class="col-sm-4">
      <label >กรุณาเลือกหน่วยงานที่ต้องการยืม</label>
      </div>
      <div class="col-sm-8">
      <select name="HR_DEPARTMENT_SUB_SUB_ID" id="HR_DEPARTMENT_SUB_SUB_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
      <option value="">--กรุณาเลือกหน่วยงาน--</option>
        @foreach ($dep_sub_subs as $dep_sub_sub) 
                                   
            <option value="{{ $dep_sub_sub ->HR_DEPARTMENT_SUB_SUB_ID  }}">{{ $dep_sub_sub->HR_DEPARTMENT_SUB_SUB_NAME }}</option>
                                      
        @endforeach 
        </select> 
                                                        
    
      </select>
      <div style="color: red;" id="text"></div>
      </div>
      </div>
      </div>

   
      <input type="hidden" name = "userid"  id="userid"  value="{{$inforpersonuserid->ID}}">
 

      </div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >ออกทะเบียน</button>
        <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" >ยกเลิก</button>
        </div>
        </div>
        </form>  
</body>
     
     
    </div>
  </div>
</div>
<br>

                       
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

  function check() {
          var  text;
          var  DEP = document.getElementById("HR_DEPARTMENT_SUB_SUB_ID").value;
   

       

       if(DEP==null || DEP==''){
  
            
        document.getElementById("text").style.display = "";     
            text = "*กรุณาระบุหน่วยงานที่จะขอยืม";
            document.getElementById("text").innerHTML = text;
            

            return false; 
          }

          }

        </script>


@endsection