@extends('layouts.plan')   
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
                        }

            .text-font {
        font-size: 13px;
                    }   
                    .form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
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
    $refnumber = ManagerplanController::refnumberPj();
    
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
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B> เพิ่มข้อมูลแผนงานโครงการ</B></h3>

            </div>
            <div class="block-content block-content-full">




            <br>
        <form  method="post" action="{{ route('mplan.project_save') }}" enctype="multipart/form-data">
        @csrf


        <input type="hidden" name="PRO_SAVE_HR_ID" id="PRO_SAVE_HR_ID" value="{{$id_user}}">
      

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
        <select name="PLAN_TYPE_ID" id="PLAN_TYPE_ID" class="form-control input-sm js-example-basic-single"  style=" font-family: 'Kanit', sans-serif;" required>   
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
            <select name="STRATEGIC_ID" id="STRATEGIC_ID" class="form-control input-lg js-example-basic-single strategic" style=" font-family: 'Kanit', sans-serif;" onchange="checkhrdepartment()">
                            <option value="" >กรุณาเลือกยุทธศาสตร์</option>
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
        <div class="col-lg-4">
        <select name="TARGET_ID" id="TARGET_ID" class="form-control input-lg js-example-basic-single goal" style=" font-family: 'Kanit', sans-serif;" onchange="checkhrdepartmentsub()">
        <option value="" >กรุณาเลือกเป้าประสงค์</option>
        </select>
        </div> 
        <div class="col-lg-1" style="text-align: left">
        <label >                           
        ตัวชี้วัด :              
        </label>
        </div> 
        <div class="col-lg-5">
        <select name="KPI_ID" id="KPI_ID" class="form-control input-lg js-example-basic-single metric" style=" font-family: 'Kanit', sans-serif;" onchange="checkhrdepartmentsubsub()">
        <option value="" >กรุณาเลือกตัวชี้วัด</option>
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
        <input name="PRO_NUMBER" id="PRO_NUMBER" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$refnumber}}" >
        </div>

        <div class="col-lg-2" style="text-align: left">
        <label >                           
         ชื่อโครงการ :              
        </label>
        </div> 
        <div class="col-lg-6">
        <input name="PRO_NAME" id="PRO_NAME" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
        </div> 

        </div>

        <div class="row push">
        

        <div class="col-lg-2" style="text-align: left">
        <label >                           
        ประเภทงบประมาณ :              
        </label>
        </div> 
        <div class="col-lg-2">
        <select name="BUDGET_ID" id="BUDGET_ID" class="form-control input-sm js-example-basic-single"  style=" font-family: 'Kanit', sans-serif;">   
        <option value="">กรุณาเลือกประเภท</option>                         
                @foreach ($infobudgettypes as $infobudgettype)      
                    <option value="{{ $infobudgettype->BUDGET_ID  }}">{{ $infobudgettype->BUDGET_NAME}}</option>                                      
                @endforeach                         
        </select>
        </div>
       


        <div class="col-lg-2" style="text-align: left">
        <label >                           
        งบประมาณ :            
        </label>
        </div> 
        <div class="col-lg-2">
        <input name="BUDGET_PICE" id="BUDGET_PICE" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  OnKeyPress="return chkmunny(this)">
        </div>
        <div class="col-lg-0.5">
        บาท
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
        บาท
        </div> 


        </div>

        

        <div class="row push">
        <div class="col-lg-2" style="text-align: left">
        <label >                           
        วันที่เริ่มต้น :              
        </label>
        </div> 
        <div class="col-lg-2">
        <input  name = "PRO_BEGIN_DATE"  id="PRO_BEGIN_DATE" class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
        </div> 
        <div class="col-lg-2" style="text-align: left">
        <label >                           
        ถึงวันที่            
        </label>
        </div> 
        <div class="col-lg-2">
        <input  name = "PRO_END_DATE"  id="PRO_END_DATE" class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
        </div> 

   
        </div>


        <div class="row push">
        <div class="col-lg-2" style="text-align: left">
        <label >                           
        ประเภทแผนงาน :              
        </label>
        </div> 
        <div class="col-lg-4">
        <select name="PRO_TYPE" id="PRO_TYPE" class="form-control input-sm js-example-basic-single plantype"  style=" font-family: 'Kanit', sans-serif;">   
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
        <select name="PRO_TEAM_NAME" id="PRO_TEAM_NAME" class="form-control input-sm js-example-basic-single teamunit"  style=" font-family: 'Kanit', sans-serif;">   
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
                    ผู้รับผิดชอบโครงการ :              
                    </label>
                    </div> 
                    <div class="col-lg-4">
                    <select name="PRO_TEAM_HR_ID" id="PRO_TEAM_HR_ID" class="form-control input-sm js-example-basic-single headperson"  style=" font-family: 'Kanit', sans-serif;">   
                    <option value="" >กรุณาเลือก</option>    
                    </select>
                    </div>
            
                    <div class="col-lg-2" style="text-align: left">
                    <label >                           
                    ลิงก์โครงการ :     
                    </label>
                    </div> 
                    <div class="col-lg-4">
                    <input name="PRO_COMMENT" id="PRO_COMMENT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  placeholder="ลิ้งค์โครงการจาก Google Drive"  >
                    </div> 

     
   
        </div>

        <div class="row push">
                <div class="col-lg-2" sytle="text-align: left">
                    <label>
                        การติดตาม
                    </label>
                </div>
                <div class="col-lg-4" >
                    <select name="" id="" class="form-control input-sm js-example-basic-single teamunit"  style=" font-family: 'Kanit', sans-serif;">   
                        <option value="">กรุณาเลือกการติดตาม</option>                         
                                @foreach ($infotrackings as $infotracking)      
                                    <option value="{{ $infotracking->PLAN_TRACKING_ID  }}">{{ $infotracking->PLAN_TRACKING_NAME}}</option>                                      
                                @endforeach                         
                    </select>
                
                </div>
        </div>
     
       </div>
       <br>
 
       



        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info f-kanit" ><i class="fas fa-save mr-2"></i>บันทึก</button>
        <a href="{{ url('manager_plan/project')  }}" class="btn btn-hero-sm btn-hero-danger f-kanit" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
        </div>

       
        </div>
        </form>  

            
        



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

function chkmunny(ele) {
                var vchar = String.fromCharCode(event.keyCode);
                if ((vchar < '0' || vchar > '9') && (vchar != '.')) return false;
                ele.onKeyPress = vchar;
        }

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
     var PROTYPE=document.getElementById("PRO_TYPE").value;
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
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });
</script>

@endsection