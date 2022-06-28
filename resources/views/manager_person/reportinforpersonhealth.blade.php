@extends('layouts.personhealth')
<!-- Page JS Plugins CSS -->

<link rel="stylesheet" href="{{ asset('asset/ets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

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

.text-pedding {
    padding-left: 10px;
}

.text-font {
    font-size: 13px;
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

function Removeformate($strDate)
  {
  $strYear = date("Y",strtotime($strDate));
  $strMonth= date("m",strtotime($strDate));
  $strDay= date("d",strtotime($strDate));

  return $strDay."/".$strMonth."/".$strYear;
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

  function RemoveDateThairetire($strDate)
{

  $strMonth= date("n",strtotime($strDate));
  if($strMonth  > 9){
    $strYear = date("Y",strtotime($strDate))+543+61;
  }else{
    $strYear = date("Y",strtotime($strDate))+543+60;
  }

  return "30 ก.ย. $strYear";
  }

  function RemovegetAge($birthday) {
    $then = strtotime($birthday);
    return(floor((time()-$then)/31556926));
}

function RemovegetAgeretire($birthday) {
  $then = strtotime($birthday);

  return(60-(floor((time()-$then)/31556926)));
}



?>

<body>
    <br>
    <br>
    <center>

        <div style="width:95%;">
            <div class="block block-rounded block-bordered">
                <div class="block-header block-header-default">
                    <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายงานระบบสุขภาพ</B></h3>

                </div>
                <div class="block-content block-content-full">
<!-- 
                    <div class="row">
                    <a class="btn btn-primary" style=" font-family: 'Kanit', sans-serif;" href="https://datastudio.google.com/reporting/9b0b975f-ef8c-4059-b08d-c88f17a38ba9/page/U9BtB?fbclid=IwAR1qwXvP8uhBcBOaWXYe7l13rdDr7cjBFfcoRFEx2LM5FDFanVpNf6ngeBo" role="button" target="_blank">รายงานการตรวจสุขภาพประจำปี บุคลากร โรงพยาบาลสมเด็จพระยุพราช ปี 2563</a>
                    </div> -->
                </div>
            </div>
        </div>
</body>

@endsection
@section('footer')

<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>
jQuery(function() {
    Dashmix.helpers(['masked-inputs']);
});
</script>


<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

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


@endsection