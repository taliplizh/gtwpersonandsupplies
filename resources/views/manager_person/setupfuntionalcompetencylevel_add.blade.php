@extends('layouts.person')   
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
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B><i class="fas fa-plus"></i> เพิ่มรายการชุดระดับ</B></h3>

            </div>
            <div class="block-content block-content-full">




            <br>
            <form  method="post" action="{{route('mperson.setupfuntionalcompetencylevel_save')}}"  enctype="multipart/form-data">
        @csrf
       
        <div class="col-sm-12">

        <input type="hidden" name="FUNTION_ID" id="FUNTION_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$idref}}" >
  
        <div class="row push">
        <div class="col-lg-1" style="text-align: left">
        <label >                           
        ชุดระดับ :              
        </label>
        </div> 
        <div class="col-lg-6">
        <input name="FUNTION_LEVEL_DETAIL" id="FUNTION_LEVEL_DETAIL" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
        </div> 
        </div>

        
        
        
            
        <div class="row push">
        <div class="col-lg-1" style="text-align: left">
            <label >                           
            ตัวเลือก :              
            </label>
            </div> 
                    <div class="col-lg-6">
                    <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                        <thead style="background-color: #FFEBCD;">
                            <tr height="40">
                                <td style="text-align: center;" width="15%">ข้อ</td>
                                <td style="text-align: center;">รายละเอียด</td>
                                <td style="text-align: center;">ชุดคะแนน</td>
                                <td style="text-align: center;" width="12%">
                                    <a  class="btn btn-success fa fa-plus-square addRow" style="color:#FFFFFF;"></a>
                                </td>
                            </tr>
                        </thead>
                        <tbody class="tbody1">
                            <tr height="20">
                        
                            
                                <td>
                                    <input name="FUNTION_LEVEL_SUB_NUMBER[]" id="FUNTION_LEVEL_SUB_NUMBER[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                                </td>
                                <td>
                                    <input name="FUNTION_LEVEL_SUB_DETAIL[]" id="FUNTION_LEVEL_SUB_DETAIL[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                                </td>
                                <td>
                                  
                                
                                    <select name="TYPE_SCORE_ID[]" id="TYPE_SCORE_ID[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                        <option value="" selected>--กรุณาเลือกชุดคะแนน-</option>
                                            @foreach ($infoscoretypes as $infoscoretype)
                                                            
                                            <option value=" {{ $infoscoretype -> TYPE_SCORE_ID }}">{{ $infoscoretype -> TYPE_SCORE_NAME }}</option>                   
                                        
                                            @endforeach 
                                    </select> 
                                
                                
                                </td>
                            
                                <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                            </tr>
                        </tbody>
                    </table>
                    </div> 
                    </div>
        </div>
 
      
       </div>
       <br>
 
       



        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึก</button>
        <a href="{{ url('manager_person/setupfuntionalcompetencylevel/'.$idref)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
        </div>

       
        </div>
        </form>  

            
        



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

$('.addRow').on('click',function(){
        addRow();
    });

    function addRow(){
    var count = $('.tbody1').children('tr').length;
        var tr =   '<tr>'+
                '<td>'+
                 '<input name="FUNTION_LEVEL_SUB_NUMBER[]" id="FUNTION_LEVEL_SUB_NUMBER[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                 '</td>'+
                 '<td>'+
                 '<input name="FUNTION_LEVEL_SUB_DETAIL[]" id="FUNTION_LEVEL_SUB_DETAIL[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                 '</td>'+
                '<td>'+  
                '<select name="TYPE_SCORE_ID[]" id="TYPE_SCORE_ID[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+
                '<option value="" selected>--กรุณาเลือกชุดคะแนน-</option>'+
                '@foreach ($infoscoretypes as $infoscoretype)'+                   
                '<option value=" {{ $infoscoretype -> TYPE_SCORE_ID }}">{{ $infoscoretype -> TYPE_SCORE_NAME }}</option>'+                                      
                '@endforeach'+ 
                '</select>'+ 
                '</td>'+
                '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
                '</tr>';
    $('.tbody1').append(tr);
    };

    $('.tbody1').on('click','.remove', function(){
        $(this).parent().parent().remove();
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