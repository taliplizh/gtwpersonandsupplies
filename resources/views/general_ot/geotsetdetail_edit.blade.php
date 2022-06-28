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

    label {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;

    }

    @media only screen and (min-width: 1200px) {
        label {
            float: right;
        }

    }

    .text-pedding {
        padding-left: 10px;
    }

    .text-font {
        font-size: 13px;
    }

    .form-control {
        font-size: 13px;
    }


    table,
    td,
    th {
        border: 1px solid black;
    }
</style>

<script>
    function checklogin() {
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


  function Monththai($strtime)
  {
    if($strtime == '1'){
        $month = 'มกราคม';
    }else if($strtime == '2'){
        $month = 'กุมภาพันธ์';
    }else if($strtime == '3'){
        $month = 'มีนาคม';
    }else if($strtime == '4'){
        $month = 'เมษายน';
    }else if($strtime == '5'){
        $month = 'พฤษภาคม';
    }else if($strtime == '6'){
        $month = 'มิถุนายน';
    }else if($strtime == '7'){
        $month = 'กรกฎาคม';
    }else if($strtime == '8'){
        $month = 'สิงหาคม';
    }else if($strtime == '9'){
        $month = 'กันยายน';
    }else if($strtime == '10'){
        $month = 'ตุลาคม';
    }else if($strtime == '11'){
        $month = 'พฤศจิกายน';
    }else if($strtime == '12'){
        $month = 'ธันวาคม';
    }else{
        $month = '';
    }

    return $month;
    }

    function Yearthai($strtime)
    {
      $year = $strtime+543;
      return $year;
    }

?>

<!-- Advanced Tables -->
<div class="bg-body-light">
    <div class="content">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">
                {{ $inforpersonuser -> HR_PREFIX_NAME }} {{ $inforpersonuser -> HR_FNAME }}
                {{ $inforpersonuser -> HR_LNAME }}</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    {{-- <div>
                        <a href="{{ url('general_operate/genoperateindex/'.$inforpersonuserid -> ID)}}" class="btn loadscreen"
                            style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ตารางเวรปฏิบัติงาน
                        </a>
                    </div>
                    <div>&nbsp;</div>
                    <div>
                        <a href="{{ url('general_operate/genoperateindexset/'.$inforpersonuserid -> ID)}}"
                            class="btn btn-warning loadscreen"
                            >

                        </a>
                    </div>
                    <div>&nbsp;</div>

              
                    <div>&nbsp;</div> --}}
                </ol>
            </nav>
        </div>
    </div>
</div>


    <!-- Dynamic Table Simple -->
 
        <div class="block-header block-header-default">
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขข้อมูลการจัดสรร OT</B></h3>
         
        </div>
        
        <form  method="post" action="{{ route('ot.geotsetdetail_update') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="idrefot" id="idrefot" value="{{$idref}}">
            <div style="background-color: #FFFFFF;">
       <center>   
         <br>  
           <div class="row">
            <div class="col-sm-1">
                ปี : 
            </div>
            <div class="col-sm-1">
                <select name="OT_YEAR" id="OT_YEAR" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" >
                    <option value="2564">2564</option>
                    <option value="2565">2565</option>   
                    <option value="2566">2566</option>   
                    <option value="2567">2567</option>   
                    <option value="2568">2568</option>   
                    <option value="2569">2569</option>   
                    <option value="2569">2570</option> 
                </select>    
            </div>
            <div class="col-sm-1">
            เดือน : 
            </div>
            <div class="col-sm-2">
            <select name="OT_MONTH" id="OT_MONTH" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" >
                <option value="">--กรุณาเลือกเดือน--</option>
                @if($infomationot->OT_MONTH == 1)<option value="1" selected>มกราคม</option> @else <option value="1">มกราคม</option> @endif   
                @if($infomationot->OT_MONTH == 2)<option value="2"selected>กุมภาพันธ์</option>@else <option value="2">กุมภาพันธ์</option>   @endif 
                @if($infomationot->OT_MONTH == 3)<option value="3"selected>มีนาคม</option>  @else <option value="3">มีนาคม</option> @endif 
                @if($infomationot->OT_MONTH == 4)<option value="4"selected>เมษายน</option> @else  <option value="4">เมษายน</option> @endif 
                @if($infomationot->OT_MONTH == 5)<option value="5"selected>พฤษภาคม</option>@else<option value="5">พฤษภาคม</option>    @endif 
                @if($infomationot->OT_MONTH == 6)<option value="6"selected>มิถุนายน</option>  @else <option value="6">มิถุนายน</option> @endif 
                @if($infomationot->OT_MONTH == 7)<option value="7"selected>กรกฎาคม</option> @else <option value="7">กรกฎาคม</option>  @endif 
                @if($infomationot->OT_MONTH == 8)<option value="8"selected>สิงหาคม</option>  @else <option value="8">สิงหาคม</option>  @endif 
                @if($infomationot->OT_MONTH == 9)<option value="9"selected>กันยายน</option>  @else<option value="9">กันยายน</option>  @endif 
                @if($infomationot->OT_MONTH == 10)<option value="10"selected>ตุลาคม</option> @else <option value="10">ตุลาคม</option>  @endif 
                @if($infomationot->OT_MONTH == 11)<option value="11"selected>พฤศจิกายน</option> @else <option value="11">พฤศจิกายน</option>   @endif 
                @if($infomationot->OT_MONTH == 12)<option value="12"selected>ธันวาคม</option>  @else <option value="12">ธันวาคม</option>   @endif 
                
            </select>    
        </div>
        <div class="col-sm-0.5">
            หน่วยงาน :
        </div>
        <div class="col-sm-2">
            <select name="OT_DEP_SUB_SUB" id="OT_DEP_SUB_SUB" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" >
                <option value="">--กรุณาเลือกหน่วยงาน--</option>
                    @foreach ($hrdsubsubs as $hrdsubsub) 
                        @if($infomationot->OT_DEP_SUB_SUB == $hrdsubsub->HR_DEPARTMENT_SUB_SUB_ID)
                        <option value="{{$hrdsubsub->HR_DEPARTMENT_SUB_SUB_ID}}" selected>{{$hrdsubsub->HR_DEPARTMENT_SUB_SUB_NAME}}</option>
                        @else
                        <option value="{{$hrdsubsub->HR_DEPARTMENT_SUB_SUB_ID}}">{{$hrdsubsub->HR_DEPARTMENT_SUB_SUB_NAME}}</option>
                        @endif
                   
                    
                    @endforeach 
            </select> 
        </div>  
        <div class="col-sm-0.5"> 
            ประเภท OT :
        </div>
        <div class="col-sm-2">
            <select name="OT_TYPE" id="OT_TYPE" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" >
                <option value="0">--กรุณาเลือกประเภท--</option>
                  
                @if($infomationot->OT_TYPE == 1)<option value="1" selected>งานประจำ</option>@else<option value="1" >งานประจำ</option> @endif 
                @if($infomationot->OT_TYPE == 2)<option value="2" selected>งานเสริมฉุกเฉิน</option>@else<option value="2" >งานเสริมฉุกเฉิน</option> @endif  
                @if($infomationot->OT_TYPE == 3)<option value="3" selected>งาน REFER</option>@else<option value="3" >งาน REFER</option> @endif   
                @if($infomationot->OT_TYPE == 4)<option value="4" selected>งานตรวจการ</option>@else<option value="4" >งานตรวจการ</option> @endif   
                
            </select>  
        </div> 
        <div class="col-sm-2"> 
         
            ผู้บันทึก :  {{ $inforpersonuser -> HR_PREFIX_NAME }}{{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}
          
            <input type="hidden" name="OT_INDEX_PERSON_ID" id="OT_INDEX_PERSON_ID" value="{{$inforpersonuserid -> ID}}">
            <input type="hidden" name="OT_PERSON_NAME" id="OT_PERSON_NAME" value="{{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}">
        </div>
        </div>
        </center>
        <br>
            </div>
            <div style="overflow-x:auto;">
            <table border="1" style="border-color: #000000;"  width="120%">
                <thead style="background-color: #FFEBCD;">
                    <tr>
                        <th class="text-center" width="1%">ลำดับ</th>
                        <th class="text-center" width="20%">ชื่อ-นามสกุล</th>
                        <th class="text-center" width="10%">เวร</th>
                        <th class="text-center"  width="5%">อัตรา</th>
                        <th class="text-center" width="1%">1</th>
                        <th class="text-center" width="1%">2</th>
                        <th class="text-center" width="1%">3</th>
                        <th class="text-center" width="1%">4</th>
                        <th class="text-center" width="1%">5</th>
                        <th class="text-center" width="1%">6</th>
                        <th class="text-center" width="1%">7</th>
                        <th class="text-center" width="1%">8</th>
                        <th class="text-center" width="1%">9</th>
                        <th class="text-center" width="1%">10</th>
                        <th class="text-center" width="1%">11</th>
                        <th class="text-center" width="1%">12</th>
                        <th class="text-center" width="1%">13</th>
                        <th class="text-center" width="1%">14</th>
                        <th class="text-center" width="1%">15</th>
                        <th class="text-center" width="1%">16</th>
                        <th class="text-center" width="1%">17</th>
                        <th class="text-center" width="1%">18</th>
                        <th class="text-center" width="1%">19</th>
                        <th class="text-center" width="1%">20</th>
                        <th class="text-center" width="1%">21</th>
                        <th class="text-center" width="1%">22</th>
                        <th class="text-center" width="1%">23</th>
                        <th class="text-center" width="1%">24</th>
                        <th class="text-center" width="1%">25</th>
                        <th class="text-center" width="1%">26</th>
                        <th class="text-center" width="1%">27</th>
                        <th class="text-center" width="1%">28</th>
                        <th class="text-center" width="1%">29</th>
                        <th class="text-center" width="1%">30</th>
                        <th class="text-center" width="1%">31</th>
                        {{-- <th class="text-center" width="5%">จำนวนเงิน</th> --}}
                        <td style="text-align: center;border: 1px solid black;" width="12%"><a  class="btn btn-success addRow" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>




                    </tr>
                </thead>
                <tbody class="tbody1">
                    <?php $number = 0; ?>
                    @foreach ($infomationotsubs as $infomationotsub)
                    <?php $number++;  ?>
                    <tr>
                    <td class="text-font" align="center" >{{$number}}</td>
                    <td class="text-font" align="center" >   
                    <select name="OT_PERSON_ID[]" id="OT_PERSON_ID0" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" >
                        <option value="">--กรุณาเลือกบุคคล--</option>
                            @foreach ($PERSONALLs as $PERSONALL) 
                                    @if($infomationotsub->OT_PERSON_ID == $PERSONALL ->ID)
                                    <option value="{{ $PERSONALL ->ID  }}" selected>{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}</option>   
                            
                                    @else
                                    <option value="{{ $PERSONALL ->ID  }}">{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}</option>   
                                    @endif
                                @endforeach 
                    </select>    
                    </td>
                    <td class="text-font" align="center" >
                        <select name="OT_JOB[]" id="่OT_JOB0" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" >
                            <option value="">--เวร--</option>
                                @foreach ($operats as $operat) 
                                    @if($infomationotsub->OT_JOB == $operat ->OPERATE_JOB_ID )
                                    <option value="{{ $operat ->OPERATE_JOB_ID  }}" selected>{{$operat->OPERATE_JOB_NAME}}</option>   
                                    @else
                                    <option value="{{ $operat ->OPERATE_JOB_ID  }}">{{$operat->OPERATE_JOB_NAME}}</option>   
                                    @endif
                                    @endforeach 
                        </select>    

                    </td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_RATE0" name="OT_RATE[]" style="font-size: 13px;width: 100px;" value="{{$infomationotsub->OT_RATE }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_1DAY0" name="OT_1DAY[]" style="font-size: 13px;width: 30px;"  value="{{$infomationotsub->OT_1DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_2DAY0" name="OT_2DAY[]" style="font-size: 13px;width: 30px;"  value="{{$infomationotsub->OT_2DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_3DAY0" name="่OT_3DAY[]" style="font-size: 13px;width: 30px;"  value="{{$infomationotsub->OT_3DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_4DAY0" name="OT_4DAY[]" style="font-size: 13px;width: 30px;"  value="{{$infomationotsub->OT_4DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_5DAY0" name="OT_5DAY[]" style="font-size: 13px;width: 30px;"  value="{{$infomationotsub->OT_5DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_6DAY0" name="OT_6DAY[]" style="font-size: 13px;width: 30px;"  value="{{$infomationotsub->OT_6DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_7DAY0" name="OT_7DAY[]" style="font-size: 13px;width: 30px;"  value="{{$infomationotsub->OT_7DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_8DAY0" name="OT_8DAY[]" style="font-size: 13px;width: 30px;"  value="{{$infomationotsub->OT_8DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_9DAY0" name="OT_9DAY[]" style="font-size: 13px;width: 30px;"  value="{{$infomationotsub->OT_9DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_10DAY0" name="่OT_10DAY[]" style="font-size: 13px;width: 30px;" value="{{$infomationotsub->OT_10DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_11DAY0" name="OT_11DAY[]" style="font-size: 13px;width: 30px;" value="{{$infomationotsub->OT_11DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_12DAY0" name="OT_12DAY[]" style="font-size: 13px;width: 30px;" value="{{$infomationotsub->OT_12DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_13DAY0" name="OT_13DAY[]" style="font-size: 13px;width: 30px;" value="{{$infomationotsub->OT_13DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_14DAY0" name="OT_14DAY[]" style="font-size: 13px;width: 30px;" value="{{$infomationotsub->OT_14DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_15DAY0" name="OT_15DAY[]" style="font-size: 13px;width: 30px;" value="{{$infomationotsub->OT_15DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_16DAY0" name="OT_16DAY[]" style="font-size: 13px;width: 30px;" value="{{$infomationotsub->OT_16DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_17DAY0" name="OT_17DAY[]" style="font-size: 13px;width: 30px;" value="{{$infomationotsub->OT_17DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_18DAY0" name="OT_18DAY[]" style="font-size: 13px;width: 30px;" value="{{$infomationotsub->OT_18DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_19DAY0" name="OT_19DAY[]" style="font-size: 13px;width: 30px;" value="{{$infomationotsub->OT_19DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_20DAY0" name="OT_20DAY[]" style="font-size: 13px;width: 30px;" value="{{$infomationotsub->OT_20DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_21DAY0" name="OT_21DAY[]" style="font-size: 13px;width: 30px;" value="{{$infomationotsub->OT_21DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_22DAY0" name="OT_22DAY[]" style="font-size: 13px;width: 30px;" value="{{$infomationotsub->OT_22DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_23DAY0" name="OT_23DAY[]" style="font-size: 13px;width: 30px;" value="{{$infomationotsub->OT_23DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_24DAY0" name="OT_24DAY[]" style="font-size: 13px;width: 30px;" value="{{$infomationotsub->OT_24DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_25DAY0" name="OT_25DAY[]" style="font-size: 13px;width: 30px;" value="{{$infomationotsub->OT_25DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_26DAY0" name="OT_26DAY[]" style="font-size: 13px;width: 30px;" value="{{$infomationotsub->OT_26DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_27DAY0" name="OT_27DAY[]" style="font-size: 13px;width: 30px;" value="{{$infomationotsub->OT_27DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_28DAY0" name="OT_28DAY[]" style="font-size: 13px;width: 30px;" value="{{$infomationotsub->OT_28DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_29DAY0" name="OT_29DAY[]" style="font-size: 13px;width: 30px;" value="{{$infomationotsub->OT_29DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_30DAY0" name="OT_30DAY[]" style="font-size: 13px;width: 30px;" value="{{$infomationotsub->OT_30DAY }}"></td>
                    <td class="text-font" align="center" ><input type="text"  id="่OT_31DAY0" name="OT_31DAY[]" style="font-size: 13px;width: 30px;" value="{{$infomationotsub->OT_31DAY }}"></td>
                    {{-- <td class="text-font" align="center" ><input type="text"  id="่OT_SUM0" name="่OT_SUM[]" style="font-size: 13px;width: 30px;"></td>  --}}
                    {{-- <td class="text-font" align="center" ></td> --}}
                    <td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>

                    </tr>

                    @endforeach 
                     </tbody>
                 </table>
                 </div> 
                 <br> 
                 <div align="center">
                    <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
                    <a href="{{ url('general_ot/geotindex/'.$inforpersonuserid -> ID)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
                </div>       
</div>

@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<!-- Page JS Plugins -->
<script src="{{ asset('asset/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<!-- Page JS Code -->
<script src="{{ asset('asset/js/pages/be_comp_charts.min.js') }}"></script>
<script>
    jQuery(function() {
        Dashmix.helpers(['easy-pie-chart', 'sparkline']);
    });
</script>

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

$(document).ready(function() {
    $('select').select2({ width: '100%' });     
});


$('.addRow').on('click',function(){
         addRow();
         $('select').select2({ width: '100%' });     
     });

     function addRow(){
        var count = $('.tbody1').children('tr').length;
        var number = count+1;
         var tr =  
         '<tr>'+
         '<td class="text-font" align="center" >'+number+'</td>'+
         '<td class="text-font" align="center" > '+  
            '<select name="OT_PERSON_ID[]" id="OT_PERSON_ID'+count+'" class="form-control input-lg js-example-basic-single" style=" font-family: \'Kanit\', sans-serif;" >'+
                '<option value="">--กรุณาเลือกบุคคล--</option>'+
                ' @foreach ($PERSONALLs as $PERSONALL)'+ 
                '<option value="{{ $PERSONALL ->ID  }}">{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}</option>'+   
                '@endforeach'+ 
                '</select>'+    
                '</td>'+
                '<td class="text-font" align="center" >'+
                    '<select name="OT_JOB[]" id="่OT_JOB'+count+'" class="form-control input-lg js-example-basic-single" style=" font-family: \'Kanit\', sans-serif;" >'+
                        '<option value="">--เวร--</option>'+
                        '@foreach ($operats as $operat)'+ 
                        '<option value="{{ $operat ->OPERATE_JOB_ID  }}">{{$operat->OPERATE_JOB_NAME}}</option>'+   
                        '@endforeach'+  
                        '</select>'+     
                        '</td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_RATE0" name="OT_RATE[]" style="font-size: 13px;width: 100px;"></td>'+
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_1DAY0" name="่OT_1DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_2DAY0" name="OT_2DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_3DAY0" name="่OT_3DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_4DAY0" name="OT_4DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_5DAY0" name="OT_5DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_6DAY0" name="OT_6DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_7DAY0" name="OT_7DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_8DAY0" name="OT_8DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_9DAY0" name="OT_9DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_10DAY0" name="่OT_10DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_11DAY0" name="OT_11DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_12DAY0" name="OT_12DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_13DAY0" name="OT_13DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_14DAY0" name="OT_14DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_15DAY0" name="OT_15DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_16DAY0" name="OT_16DAY[]" style="font-size: 13px;width: 30px;" ></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_17DAY0" name="OT_17DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_18DAY0" name="OT_18DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_19DAY0" name="OT_19DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_20DAY0" name="OT_20DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_21DAY0" name="OT_21DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_22DAY0" name="OT_22DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_23DAY0" name="OT_23DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_24DAY0" name="OT_24DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_25DAY0" name="OT_25DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_26DAY0" name="OT_26DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_27DAY0" name="OT_27DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_28DAY0" name="OT_28DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_29DAY0" name="OT_29DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_30DAY0" name="OT_30DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 
                        '<td class="text-font" align="center" ><input type="text"  id="่OT_31DAY0" name="OT_31DAY[]" style="font-size: 13px;width: 30px;"></td>'+ 

                    
                        '<td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                        '</tr>';

        $('.tbody1').append(tr);
     };

     $('.tbody1').on('click','.remove', function(){
            $(this).parent().parent().remove();
     });
//-------------------------------------------------


    function chkmunny(ele) {
        var vchar = String.fromCharCode(event.keyCode);
        if ((vchar < '0' || vchar > '9') && (vchar != '.')) return false;
        ele.onKeyPress = vchar;
    }
</script>

@endsection