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
        font-size: 13px;
       
        }

        label{
                font-family: 'Kanit', sans-serif;
                font-size: 13px;
           
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
<br>

<center>
<div class="block" style="width: 95%;" >
<div class="block block-rounded block-bordered">

            
<div class="block-content">    
<h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">3.&nbsp; ให้วิเคราะห์ว่าขั้นตอนหรือกระบวนการปฏิบัติจริง (จากข้อ 2) ในขณะประเมินปฏิบัติอย่างไร</h2> 
<div class="block-content block-content-full" align="left">
    <form  method="post" action="{{ route('mrisk.internalcontrol_subsub_detailadd_save') }}" enctype="multipart/form-data">
    @csrf

      <input type="hidden" class="form-control input-sm" id="INTERNALCONTROL_ID" name="INTERNALCONTROL_ID" value="{{$internalcontrol->INTERNALCONTROL_ID}}">
      <input type="hidden" class="form-control input-sm" id="INTERNALCONTROL_SUBSUB_ID" name="INTERNALCONTROL_SUBSUB_ID" value="{{$internalcontrol_subsub_details->INTERNALCONTROL_SUBSUB_ID}}">




<!-- <div class="row push">
<div class="col-sm-0.5 ">
<div align="center" style=" font-family:'Kanit', sans-serif;font-size: 14px;font-weight:normal;">&nbsp;&nbsp; &nbsp;&nbsp;เรื่อง :
 </div>
</div> 

<div class="col-lg-11 ">
<div align="left" style=" font-family:'Kanit', sans-serif;font-size: 14px;font-weight:normal;">
{{$internalcontrol_subsub_details->INTERNALCONTROL_SUBSUB_NAME}}
</div>
</div> 
</div> -->

<div class="row push">
<div class="col-lg-12">
<table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                        <thead style="background-color: #FFEBCD;">
                            <tr height="40">
                                <!-- <td style="text-align: center;font-size: 14px;font-weight:normal;" width="5%">ลำดับ</td> -->
                                <td style="text-align: center;font-size: 14px;font-weight:normal;" width="25%">รายละเอียด</td>
                                <td style="text-align: center;font-size: 14px;font-weight:normal;">เพื่อลดความเสี่ยงอะไร </td>
                                <td style="text-align: center;font-size: 14px;font-weight:normal;">กิจกรรมที่ปฎิบัติ</td>
                               
                                <td style="text-align: center;" width="5%">
                                    <a  class="btn btn-hero-sm btn-hero-success fa fa-plus-square addRow2" style="color:#FFFFFF;"></a>
                                </td>
                            </tr>
                        </thead>
                        <tbody class="tbody2">
                        <?php $checkdetail = 0; ?>
                        @foreach ($risk_subsub_detail_subs as $risk_subsub_detail_sub)
                          
                            <tr height="20"> 
                           
                                <!-- <td style="text-align: center;font-size: 14px;font-weight:normal;"> {{$checkdetail}} </td>  -->
                                <td>
                                    <textarea name="INTERNALCONTROL_SUBSUB_DETAIL_SUB_NAME[]" id="INTERNALCONTROL_SUBSUB_DETAIL_SUB_NAME{{$checkdetail}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 14px;font-weight:normal;" rows="4">{{$risk_subsub_detail_sub->INTERNALCONTROL_SUBSUB_DETAIL_SUB_NAME}}</textarea>
                                </td>
                                <td>
                                    <textarea name="INTERNALCONTROL_SUBSUB_DETAIL_SUB_DOWN[]" id="INTERNALCONTROL_SUBSUB_DETAIL_SUB_DOWN{{$checkdetail}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 14px;font-weight:normal;" rows="4" >{{$risk_subsub_detail_sub->INTERNALCONTROL_SUBSUB_DETAIL_SUB_DOWN}}</textarea>
                                </td>
                                 <td>
                                    <textarea name="INTERNALCONTROL_SUBSUB_DETAIL_SUB_MAKE[]" id="INTERNALCONTROL_SUBSUB_DETAIL_SUB_MAKE{{$checkdetail}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 14px;font-weight:normal;" rows="4">{{$risk_subsub_detail_sub->INTERNALCONTROL_SUBSUB_DETAIL_SUB_MAKE}}</textarea>
                                </td>
                                
                                <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                            </tr>
                            <?php $checkdetail++; ?>
                            @endforeach
                        </tbody>
                    </table>


                    </div> 
</div>
</div>





<div class="modal-footer">
<div align="right">

<button type="submit" id="button"  class="btn btn-hero-sm btn-hero-info savebtn"><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
<a href="{{ url('manager_risk/internalcontrol_subsub_add/'.$internalcontrol->INTERNALCONTROL_ID)  }}" onclick="return confirm('ต้องการที่จะยกเลิกข้อมูล ?')" class="btn btn-hero-sm btn-hero-danger cancel"><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
</div>

</div>
</form>
<!-- <button  class="btn btn-warning savebtn" >Add Alert</button> -->
    
  
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

$('.addRow2').on('click',function(){
        addRow2();
    });
    function addRow2(){
    var count = $('.tbody2').children('tr').length;
        var tr =   '<tr>'+  
        // '<td style="text-align: center;">'+
        //         (count+1)+
        //         '</td>'+             
                '<td>'+
                '<textarea name="INTERNALCONTROL_SUBSUB_DETAIL_SUB_NAME[]" id="INTERNALCONTROL_SUBSUB_DETAIL_SUB_NAME[]" class="form-control input-sm" style=" font-family:\'Kanit\',sans-serif;" rows="4"></textarea>'+
                '</td>'+
                '<td>'+
                '<textarea name="INTERNALCONTROL_SUBSUB_DETAIL_SUB_DOWN[]" id="INTERNALCONTROL_SUBSUB_DETAIL_SUB_DOWN[]" class="form-control input-sm" style=" font-family:\'Kanit\',sans-serif;" rows="4"></textarea>'+
                '</td>'+
                '<td>'+
                '<textarea name="INTERNALCONTROL_SUBSUB_DETAIL_SUB_MAKE[]" id="INTERNALCONTROL_SUBSUB_DETAIL_SUB_MAKE[]" class="form-control input-sm" style=" font-family:\'Kanit\',sans-serif;" rows="4"></textarea>'+
                '</td>'+               
                '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
                '</tr>';
    $('.tbody2').append(tr);
    };

    $('.tbody2').on('click','.remove', function(){
        $(this).parent().parent().remove();
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