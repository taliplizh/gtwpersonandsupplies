@extends('layouts.backend_admin')




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

          .text-pedding{
       padding-left:10px;
                        }

            .text-font {
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

if($status=='USER' and $user_id != $id_user  ){
    echo "You do not have access to data.";
    exit();
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

                <div class="content">
                <div class="block block-rounded block-bordered">


                <div class="block-content">
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ตั้งค่าฟังก์ชันงานซ่อม</h2>
                     
                        <div class="block-content">
                        <div class="table-responsive">

                  <table class="gwt-table table-striped table-vcenter" width="100%">
                  <thead style="background-color: #FFEBCD;">

                   <tr height="40">
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">รหัส</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">ฟังก์ชัน</th>
        <th class="text-font" width="5%" style="border-color:#F0FFFF;text-align: center;">เปิดใช้</th>
 



      </tr>
                   </tr>
                   </thead>
                   <tbody>
                   @foreach ($inforepairfunctions as $inforepairfunction)
                   <tr height="40">
                     <td class="text-font" align="center">{{ $inforepairfunction-> REPAIRFUNCTION_ID }}</td>
                     <td class="text-font text-pedding">{{ $inforepairfunction-> REPAIRFUNCTION_NAME }}</td>

                     <td align="center" width="10%">
                     <div class="custom-control custom-switch custom-control-lg ">
                    @if($inforepairfunction-> ACTIVE == 'True' )
                    <input type="checkbox" class="custom-control-input" id="{{ $inforepairfunction-> REPAIRFUNCTION_ID }}" name="{{ $inforepairfunction-> REPAIRFUNCTION_ID }}" onchange="switchactive({{ $inforepairfunction-> REPAIRFUNCTION_ID }});" checked>
                    @else
                    <input type="checkbox" class="custom-control-input" id="{{ $inforepairfunction-> REPAIRFUNCTION_ID }}" name="{{ $inforepairfunction-> REPAIRFUNCTION_ID }}" onchange="switchactive({{ $inforepairfunction-> REPAIRFUNCTION_ID}});">
                    @endif
                    <label class="custom-control-label" for="{{ $inforepairfunction-> REPAIRFUNCTION_ID }}"></label>
                    </div>
                    </td> 



                   </tr>
                   @endforeach
                   </tbody>
                  </table>
                  <br>

@endsection

@section('footer')

<script>
 
 function switchactive(idfunc){
      // alert(budget);
      var checkBox=document.getElementById(idfunc);
      var onoff;

      if (checkBox.checked == true){
        onoff = "True";
  } else {
        onoff = "False";
  }
 //alert(onoff);

 var _token=$('input[name="_token"]').val();
      $.ajax({
              url:"{{route('setup.setupinforepairPDFswitch')}}",
              method:"GET",
              data:{onoff:onoff,idfunc:idfunc,_token:_token}
      })
      }        
  
</script>



@endsection
