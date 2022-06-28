<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="รายงานการขอใช้รถทั่วไป.xls"');//ชื่อไฟล์

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

  date_default_timezone_set("Asia/Bangkok");
  $date = date('Y-m-d');


?>
   
                        
รายงานการขอใช้รถทั่วไป

                            <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table  width="100%">
<thead >
                                    <tr height="40">
                                    <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">วันที่ไป</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">ทะเบียน</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ผู้ใช้รถ</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >สถานที่ไป</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">ระยะทางเมื่อรถออกเดินทาง</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">กลับถึงสำนักงานวันที่</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">ระยะทางเมื่อรถกลับสำนักงาน</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">ระยะทาง กม.</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >พนักงานขับรถ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >หมายเหตุ</th>
                                      
                                    </tr >
                                </thead>
                                <tbody>
                                

                                <?php $number = 0; ?>
                                @foreach ($infocars as $infocar)
                                <?php $number++; ?>

                                    <tr height="20">
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >{{$number}}</td>


                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >{{ DateThai($infocar->RESERVE_BEGIN_DATE) }}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infocar->CAR_REG }}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infocar->RESERVE_PERSON_NAME }}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infocar->LOCATION_ORG_NAME }}</td>
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  width="10%">{{ number_format($infocar->CAR_NUMBER_BEGIN) }}</td>
                                        @if($infocar->BACK_DATE != '' || $infocar->BACK_DATE != NUll)
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >{{  DateThai($infocar->BACK_DATE)}}</td>
                                        @else
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"></td>
                                        @endif
                                       
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%" >{{ number_format($infocar->CAR_NUMBER_BACK) }}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" >{{(number_format($infocar->CAR_NUMBER_BACK - $infocar->CAR_NUMBER_BEGIN))}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infocar->HR_FNAME }} {{ $infocar->HR_LNAME }}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infocar->COMMENT }}</td>
                                     
                                     

                                    </tr>


                                    @endforeach   
                             
                                </tbody>
                            </table>

                   

                
                 
                  
      
                      

