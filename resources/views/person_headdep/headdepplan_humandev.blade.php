@extends('layouts.headdep')   
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

    
    use App\Http\Controllers\MeetingController;
    $checkver = MeetingController::checkver($user_id);
    $countver = MeetingController::countver($user_id);
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
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>แผนพัฒนาบุคลากร</B></h3>
                <a href="{{ url('person_headdep/humandev_add') }}"    class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-plus"></i> เพิ่มข้อมูล</a>
            </div>
            <div class="block-content block-content-full">

            
            <form action="" method="post">
@csrf

                            <div class="row">
                            <div class="col-sm-0.5">
                                                        &nbsp;&nbsp; ปีงบ &nbsp;
                                                    </div>
                                                    <div class="col-sm-1.5">
                                                    <span>
                                                            <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;">
                                                            <option value="">2563</option>                       
                                                            </select>
                                                        </span>
                                                    </div>

                                                    <div class="col-sm-0.5">
                            &nbsp;ประเภทแผน &nbsp;
                            </div>

                            <div class="col-sm-2">
                            <span>
                            <select name="SEND_STATUS" id="SEND_STATUS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--ทั้งหมด--</option>
                            <option value="">ทีมประสาน</option>
                            <option value="">หน่วยงาน</option>
                            </select>
                            </span>
                            </div> 

                            <div class="col-sm-0.5">
                            &nbsp;ค้นหา &nbsp;
                            </div>

                            <div class="col-sm-2">
                            <span>

                            <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="">

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
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ปีงบ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ประเภท</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >รหัส</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ทีมประสาน/หน่วยงาน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >	ประเภทการฝึกอบรม	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >	หลักสูตร /เรื่องที่จะไปฝึกอบรม	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >	กลุ่มเป้าหมาย	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >	สถานที่	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >	เริ่มต้น	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >	สิ้นสุด	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >	งบประมาณ	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >	แหล่งงบประมาณ	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >	ใช้จริง	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >	ผู้รับผิดชอบ	</th>



                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center" width="10%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>
                

                    <?php $number = 0; ?>
                                @foreach ($infohumandevs as $infohumandev)
                    <?php $number++; ?>

                        <tr height="20">
                                <td class="text-font" align="center">{{$number}}</td>
                                <td class="text-font text-pedding" >{{$infohumandev->BUDGET_YEAR}}</td>
                                <td class="text-font text-pedding" >{{$infohumandev->HUM_TYPE}}</td>
                                <td class="text-font text-pedding" >{{$infohumandev->HUM_NUMBER}}</td>
                                <td class="text-font text-pedding" >{{$infohumandev->HUM_TEAM_NAME}}</td>
                                <td class="text-font text-pedding" >{{$infohumandev->HUM_TYPE_NAME}}</td>
                                <td class="text-font text-pedding" >{{$infohumandev->HUM_NAME}}</td>
                                <td class="text-font text-pedding" >{{$infohumandev->HUM_GROUP}}</td>
                                <td class="text-font text-pedding" >{{$infohumandev->HUM_LOCATION}}</td>
                                <td class="text-font text-pedding" >{{DateThai($infohumandev->BEGIN_DATE)}}</td>
                                <td class="text-font text-pedding" >{{DateThai($infohumandev->END_DATE)}}</td>
           
                                <td class="text-font text-pedding" >{{$infohumandev->BUDGET_PICE}}</td>
                                <td class="text-font text-pedding" >{{$infohumandev->BUDGET_ID}}</td>
                                <td class="text-font text-pedding" ></td>
                              
                               
                                <td align="center" width="10%">
                  
                                </td> 
                                <td align="center">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                <a class="dropdown-item"  href="#detail_repaircom"  data-toggle="modal"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" >รายละเอียด</a>   
                                              
                                                </div>
                                            </div>
                                </td>     
                        
                        </tr>

                     
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
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });
</script>

@endsection