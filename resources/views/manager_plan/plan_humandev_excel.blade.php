<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="HUMAN_PLAN.xls"');//ชื่อไฟล์
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
               
            </div>
            <div class="block-content block-content-full">

         
            
             <div class="table-responsive"> 
             <div align="right">งบประมาณรวม {{number_format($sumbudget,2)}}  บาท</div>
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="10%">	สถานะ	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >ปีงบ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >ประเภท</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >รหัส</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >ทีม/หน่วยงาน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	ประเภทการฝึกอบรม	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	หลักสูตร /เรื่องที่จะไปฝึกอบรม	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	เริ่มต้น	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	สิ้นสุด	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	ประเภทงบ	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	งบประมาณ	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	ใช้จริง	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	ผู้รับผิดชอบ	</th>



                            
                        </tr >
                    </thead>
                    <tbody>
                

                    <?php $number = 0; ?>
                                @foreach ($infohumandevs as $infohumandev)
                    <?php $number++; ?>

                        <tr height="20">
                                <td class="text-font" align="center">{{$number}}</td>
                                <td align="center" >
                                   @if($infohumandev->HUM_STATUS == 'WAIT')
                                   <span class="badge badge-info"> รอพิจารณา </span>
                                   @elseif($infohumandev->HUM_STATUS == 'APP')
                                         <span class="badge badge-success"> อนุมัติ </span>
                                   @elseif($infohumandev->HUM_STATUS == 'NOTAPP')
                                        <span class="badge badge-warning"> ไม่อนุมัติ </span>
                                   @else
                                  
                                   @endif                  
                                  </td> 
                                <td class="text-font text-pedding" >{{$infohumandev->BUDGET_YEAR}}</td>
                                  
                                @if( $infohumandev->HUM_TYPE == 'team')
                                <td class="text-font text-pedding" >ทีมประสาน</td>
                                @else
                                <td class="text-font text-pedding" >หน่วยงาน</td>
                                @endif
                               
                                
                                <td class="text-font text-pedding" >{{$infohumandev->HUM_NUMBER}}</td>
                                <td class="text-font text-pedding" >{{$infohumandev->HUM_TEAM_NAME}}</td>
                                <td class="text-font text-pedding" >{{$infohumandev->PLAN_HUMANDEV_TYPE_NAME}}</td>
                                <td class="text-font text-pedding" >{{$infohumandev->HUM_NAME}}</td>
                                <td class="text-font text-pedding" >{{DateThai($infohumandev->HUM_BEGIN_DATE)}}</td>
                                <td class="text-font text-pedding" >{{DateThai($infohumandev->HUM_END_DATE)}}</td>
                                <td class="text-font text-pedding" >{{$infohumandev->BUDGET_NAME}}</td>
                                <td class="text-font text-pedding" align="right">{{number_format($infohumandev->BUDGET_PICE,2)}}</td>
                                <td class="text-font text-pedding" align="right">{{number_format($infohumandev->BUDGET_PICE_REAL,2)}}</td>
                                <td class="text-font text-pedding" >{{$infohumandev->HUM_TEAM_HR_NAME}}</td>
                             
                        
                        </tr>

                     
                        </tr>
                        
                        @endforeach

                    </tbody>
                </table>
       