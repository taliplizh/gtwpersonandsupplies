@extends('layouts.personcheck')
<!-- Page JS Plugins CSS -->

<link rel="stylesheet" href="{{ asset('asset/ets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
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

       .text-pedding{
   padding-left:10px;
}

.text-font {
    font-size: 13px;
}   
</style>

@section('content')
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

  function RemoveDateThairetire($strDate)
{

  $strMonth= date("n",strtotime($strDate));
  if($strMonth  > 9){
    $strYear = date("Y",strtotime($strDate))+543+61;
  }else{
    $strYear = date("Y",strtotime($strDate))+543+60;
  }

  return "30 ต.ค. $strYear";
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
           
        <center>
                   
                <div style="width:95%;" >
          <div class="block block-rounded block-bordered">
          <div class="block-content">    
          <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
          <div class="row">
         
          </div>
          </h2>  
                                
             <form action="{{ route('mpersoncheck.search') }}" method="get">
            
             <div class="row">
           
                   <div class="col-md-8">
                    
                  </div>  
                  <div class="col-md-3">
                  <span>
                 <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" >
                </span>
                 </div>
                 <div class="col-md-1">
                 <span>
                     <button type="submit" class="btn btn-info" >ค้นหา</button>
                 </span> 
                 </div>
               
          
                  </div>  
             </form>
            
         
        <div class="panel-body" style="overflow-x:auto;">     
        <table class="gwt-table table-striped table-vcenter js-dataTable-simple" width="100%">
        <thead style="background-color: #FFEBCD;">
                  
        <tr height="40">    
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%" >ลำดับ</th>       
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%" >CID</th>
      
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="18%">ชื่อ นามสกุล</th>
            
     
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="3%">เพศ</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">วันเกิด</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="3%">อายุ</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">วันเกษียณ</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="8%">คงเหลือ</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">สถานะ</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">ตำแหน่ง</th>
      
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">หน่วยงาน</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">ฝ่าย/แผนก</th>
       
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;"width="8%">คำสั่ง</th>
        
      </tr>
                   </tr>
                   </thead>
                   <tbody>
                   <?php $number = 0; ?>
                   @foreach ($persons as $person)
                   <?php $number++; 
                   if( $person->HR_STATUS_ID == 5 || $person->HR_STATUS_ID == 6 || $person->HR_STATUS_ID == 7 || $person->HR_STATUS_ID == 8){
                   $color = 'background-color: #FFF0F5;';

                    }else{
                    $color = '';
                   }
                   ?> 
                   <tr style="{{$color}}" height="20">
                   <td class="text-font" align="center"> {{ $number }}</td>  
                     <td class="text-font" align="center"> {{ $person -> HR_CID }}</td>  
                     <td class="text-pedding text-font">{{ $person -> HR_PREFIX_NAME }}{{ $person -> HR_FNAME }} {{ $person -> HR_LNAME }}</td>                     
                     <td class="text-pedding text-font"> {{ $person -> SEX_NAME }}</td> 
                     <td class="text-font" align="center"> {{ DateThai($person -> HR_BIRTHDAY) }}</td>  
                     <td class="text-font" align="center"> {{ getAge($person -> HR_BIRTHDAY) }} </td> 
                     <td class="text-font" align="center"> {{ DateThairetire($person -> HR_BIRTHDAY) }}</td>  
                     <td class="text-font" align="center"> {{getAgeretire($person -> HR_BIRTHDAY) }} </td> 
                     <td class="text-pedding text-font"> {{ $person -> HR_STATUS_NAME }}</td>   
                     <td class="text-pedding text-font"> {{ $person -> POSITION_IN_WORK }}</td>   
                   
                     <td class="text-pedding text-font"> {{ $person -> HR_DEPARTMENT_SUB_SUB_NAME }}</td> 
                     <td class="text-pedding text-font"> {{ $person -> HR_DEPARTMENT_SUB_NAME }}</td>     
                      
                     <td align="center">
                     <div class="dropdown">
                     <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                    <a class="dropdown-item" href="{{ url('manager_personcheck/time/'.$person -> ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  >การลงเวลา</a>
                                                    
                                                </div>
                    </div>
                     </td>                        

                   </tr>

                   @endforeach 
                   </tbody>
                  </table>
                      

@endsection
@section('footer')
    
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