@extends('layouts.guesthouse')   
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

<center>    
    <div class="block mt-5 shadow-lg" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายการแจ้งปัญหาบ้านพัก</B></h3>
               
            </div>
            <div class="block-content block-content-full">
                <form action="{{ route('mguesthouse.guesthouseproblem') }}" method="post">
            @csrf

<div class="row">
<div class="col-sm-0.5">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ปีงบ &nbsp;&nbsp;&nbsp;
                        </div>
                        <div class="col-sm-1.5">
                        <span>
                                <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;">
                                @foreach ($budgets as $budget)
                                @if($budget->LEAVE_YEAR_ID== $year_id)
                                    <option value="{{ $budget->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}</option>
                                @else
                                    <option value="{{ $budget->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                                @endif                                 
                            @endforeach                         
                                </select>
                            </span>
                        </div>

                                    <div class="col-sm-4 date_budget">
                                    <div class="row">
                                                <div class="col-sm">
                                                วันที่
                                                </div>
                                            <div class="col-md-4">
                                    
                                            <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" style=" font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;" value="{{ formate($displaydate_bigen) }}" readonly>
                                            
                                            </div>
                                            <div class="col-sm">
                                                ถึง 
                                                </div>
                                            <div class="col-md-4">
                                
                                            <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" style=" font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;" value="{{ formate($displaydate_end) }}" readonly>
                                        
                                            </div>
                                            </div>

                                        </div>

                            <div class="col-sm-0.5">
                            &nbsp;สถานะ &nbsp;
                            </div>

                            <div class="col-sm-2">
                            <span>
                            <select name="SEND_STATUS" id="SEND_STATUS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;">

                            <option value="">ทั้งหมด</option>

                            @foreach ($infostatuss as $infostatus)  
                                 @if($infostatus->PROBLEM_STATUS == $status_check)
                                    <option value="{{$infostatus->PROBLEM_STATUS}}" selected>{{ $infostatus->PROBLEM_NAME}}</option>
                                @else
                                    <option value="{{$infostatus->PROBLEM_STATUS}}" >{{ $infostatus->PROBLEM_NAME}}</option>
                                @endif
                            @endforeach 
                            


                            </select>
                            </span>
                            </div> 

                            <div class="col-sm-0.5">
                            &nbsp;ค้นหา &nbsp;
                            </div>

                            <div class="col-sm-2">
                            <span>

                            <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">

                            </span>
                            </div>

                            <div class="col-sm-30">
                            &nbsp;
                            </div> 
                            <div class="col-sm-1.5">
                            <span>
                            <button type="submit" class="btn btn-hero-sm btn-hero-info foo15 loadscreen" ><i class="fas fa-search mr-2"></i>ค้นหา</button>
                            </span> 
                            </div>


                                        
                                            </div>  
             </form>
            <div class="table-responsive">
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple text-center"  style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">                          
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;" width="4%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;" width="4%">สถานะ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;" width="5%">วันที่แจ้ง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;" width="6%">ประเภทปัญหา</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;" width="7%">ผู้ร้องแจ้ง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;" width="5%">ติดต่อ</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;" width="10%">ชื่ออาคาร</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;" width="5%">ชั้น</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;" width="6%">ชื่อห้อง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;" width="10%">ปัญหา</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;" width="7%">เจ้าหน้าที่</th>                        
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;" width="4%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>  
                

                        <?php $number = 0; ?>
                        @foreach ($infoproblems as $infoproblem)

                        <?php $number++;?>
            
                                    <tr height="40">
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;vertical-align: text-top;" >{{$number}}</td>                                      
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;vertical-align: text-top;" >
                                        @if( $infoproblem->PROBLEM_STATUS == 'SUCCESS')
                                        <span class="badge badge-success" >เรียบร้อย</span>
                                        @elseif( $infoproblem->PROBLEM_STATUS == 'CANCEL')
                                        <span class="badge badge-danger" >ยกเลิก</span>
                                        @else
                                        <span class="badge badge-warning" >แจ้งปัญหา</span>
                                        @endif                                  
                                        </td>                                     

                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;vertical-align: text-top;" >{{DateThai($infoproblem->created_at)}}</td>

                                            @if($infoproblem->PROBLEM_TYPE == '1')
                                           <?php $nametype = 'ไฟฟ้า' ?>
                                            @elseif($infoproblem->PROBLEM_TYPE == '2')
                                            <?php $nametype = 'ประปา' ?>
                                            @elseif($infoproblem->PROBLEM_TYPE == '3')
                                            <?php $nametype = 'อินเทอร์เน็ต' ?>
                                            @elseif($infoproblem->PROBLEM_TYPE == '4')
                                            <?php $nametype = 'โครงสร้างอาคาร' ?>
                                            @elseif($infoproblem->PROBLEM_TYPE == '5')
                                            <?php $nametype = 'เหตุรำคาญ' ?>
                                            @elseif($infoproblem->PROBLEM_TYPE == '6')
                                            <?php $nametype = 'โจรกรรม' ?>
                                            @elseif($infoproblem->PROBLEM_TYPE == '7')
                                            <?php $nametype = 'อื่นๆ' ?>
                                            @else
                                            <?php $nametype = '' ?>
                                            @endif

                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;vertical-align: text-top;" >{{$nametype}}</td>
                                       
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;vertical-align: text-top;" >{{$infoproblem->HR_FNAME}} {{$infoproblem->HR_LNAME}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;vertical-align: text-top;" >{{$infoproblem->PROBLEM_HR_TEL}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;vertical-align: text-top;" >{{$infoproblem->INFMATION_NAME}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;vertical-align: text-top;" >{{$infoproblem->LOCATION_LEVEL_NAME}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;vertical-align: text-top;" >{{$infoproblem->LEVEL_ROOM_NAME}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;vertical-align: text-top;">{{$infoproblem->PROBLEM_NAME}}</td>

                                      
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;vertical-align: text-top;" >{{$infoproblem->INFMATION_HR_NAME}}</td>
            
                                        <td style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;" >
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;">
                                                        ทำรายการ
                                                </button>
                                                    <div class="dropdown-menu" style="width:10px">
                                                        <a class="dropdown-item"  href="#detail_modal{{ $infoproblem -> PROBLEM_ID }}"  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;">รายละเอียด</a>
                                                        @if($infoproblem->PROBLEM_STATUS == 'REQUEST')
                                                        <a class="dropdown-item loadscreen"  href="{{ url('manager_guesthouse/guesthouseproblem_succes/'.$infoproblem->PROBLEM_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ยืนยันการแก้ปัญหา</a>                                                       
                                                        <a class="dropdown-item loadscreen"  href="{{ url('manager_guesthouse/guesthouseproblem_edit/'.$infoproblem->PROBLEM_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                        <a class="dropdown-item loadscreen"  href="{{ url('manager_guesthouse/guesthouseproblem_cancel/'.$infoproblem->PROBLEM_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ยกเลิก</a>
                                                        @endif
                                                    </div>
                                            </div>
                                        </td>  
                                    </tr>                                                                                     
                                                                    
                                    <div id="detail_modal{{ $infoproblem -> PROBLEM_ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                    
                                        <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:13px;font-size: 1.2rem;font-weight:normal;">รายละเอียดปัญหา</h2>
                                        </div>
                                        <div class="modal-body">                                   

                                    <div class="row">                       
                                        <div class="col-sm-8">
                                                    <div class="row">                       
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                        <label >วันที่แจ้ง :</label>
                                                        </div>                               
                                                    </div> 
                                                    <div class="col-sm-3 text-left">
                                                        <div class="form-group" >
                                                        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{DateThai($infoproblem->created_at)}}</h1>
                                                        </div>                               
                                                    </div>                            
                                                    <div class="col-sm-2 ">
                                                        <div class="form-group">
                                                        <label >ประเภทปัญหา  :</label>
                                                        </div>                               
                                                    </div>  
                                                    <div class="col-sm-3 text-left">
                                                        <div class="form-group">
                                                        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$nametype}}</h1>
                                                        </div>                               
                                                    </div> 
                                                    </div>
                        
                                                      
                                                    <div class="row">                               
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                            <label >ปัญหาที่แจ้ง :</label>
                                                            </div>                               
                                                        </div>
                                                        <div class="col-sm-10 text-left ">
                                                            <div class="form-group">
                                                            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$infoproblem->PROBLEM_NAME}}</h1>
                                                            </div>                               
                                                        </div> 
                                                    </div>
                                                                             
                                                    <div class="row">
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                        <label>ชื่ออาคาร :</label>
                                                        </div>                               
                                                    </div>  
                                                    <div class="col-sm-3 text-left">
                                                        <div class="form-group">
                                                        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$infoproblem->LOCATION_NAME}}</h1>
                                                        </div>                               
                                                    </div>  
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                        <label>ชั้น :</label>
                                                        </div>                               
                                                    </div>  
                                                    <div class="col-sm-3 text-left">
                                                        <div class="form-group">
                                                        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$infoproblem->LOCATION_LEVEL_NAME}}</h1>
                                                        </div>                               
                                                    </div>    
                                                    </div>
                                                    
                                                    
                                                    
                                                    <div class="row">
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                        <label >ชื่อห้อง :</label>
                                                        </div>                               
                                                    </div>
                                                    <div class="col-sm-3 text-left">
                                                        <div class="form-group">
                                                        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$infoproblem->LEVEL_ROOM_NAME}}</h1>
                                                        </div>                               
                                                    </div> 
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                        <label > เจ้าหน้าที่ :</label>
                                                        </div>                               
                                                    </div>
                                                    <div class="col-sm-3 text-left">
                                                        <div class="form-group">
                                                        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$infoproblem->INFMATION_HR_NAME}}</h1>
                                                        </div>                               
                                                    </div> 
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                            <label > ผู้แจ้ง :</label>
                                                            </div>                               
                                                        </div>
                                                        <div class="col-sm-3 text-left">
                                                            <div class="form-group">
                                                            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$infoproblem->HR_FNAME}} {{$infoproblem->HR_LNAME}}</h1>
                                                            </div>                               
                                                        </div> 
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                        <label > โทร :</label>
                                                        </div>                               
                                                    </div>
                                                    <div class="col-sm-3 text-left">
                                                        <div class="form-group">
                                                        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$infoproblem->PROBLEM_HR_TEL}}</h1>
                                                        </div>                               
                                                    </div> 
                                                    </div> 
                        
                                        </div>  
                                        <div class="col-sm-4">
                                                                   
                                                @if($infoproblem->PROBLEM_IMG == '' || $infoproblem->PROBLEM_IMG ==null)
                                                        <img src="{{ asset('image/default.jpg')}}" alt="Image" class="img-thumbnail" id="image_upload_preview" alt="กรุณาเพิ่มรูปภาพ" height="250px" width="250px"/>
                                                @else
                                                        <img src="data:image/png;base64,{{ chunk_split(base64_encode($infoproblem->PROBLEM_IMG)) }}" id="image_upload_preview"   height="250px" width="250px"/>
                                                @endif
                                                            
                                        </div> 
                                    </div> 

                                    </div>
                                        <div class="modal-footer">
                                        <div align="right">
                                        <button type="button" class="btn btn-hero-sm btn-hero-secondary" data-dismiss="modal" ><i class="fas fa-window-close text-white mr-2"></i>ปิดหน้าต่าง</button>
                                        </div>
                                        </div>
                                        </form>  
                                </body>
                                    
                                    
                                    </div>
                                </div>
                                </div>




                        @endforeach  
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


            <div id="detail_modal" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="row">
                                            <div>&nbsp;&nbsp;รายละเอียด  &nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>
                                    <div class="modal-body">
                                        <form  method="post" action="" enctype="multipart/form-data">
                                            @csrf
                                                <input type="hidden"  name="ID" value=""/>

                                        <div class="row">
                                            <div class="col-sm-2">
                                                <label>ทดสอบ :</label>
                                            </div> 
                                            <div class="col-lg-3"> 
                                                <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;"></h1>         
                                            </div>
                                            <div class="col-sm-1 text-right">                    
                                                <label>ทดสอบ :</label>
                                            </div> 
                                            <div class="col-lg-2"> 
                                            
                                                <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;"></h1> 
                                            </div>
                                            <div class="col-sm-2 text-right">
                                                <label>ทดสอบ :</label>
                                            </div>         
                                            <div class="col-lg-2">  
                                            <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;"></h1>       
                                        
                                            </div>
                                        </div>
                                        <br> 
                                        <div class="modal-footer">
                                            <div align="right">                    
                                                <!-- <button type="submit"  name = "SUBMIT"  class="btn btn-hero-sm btn-hero-danger" value="not_approved" >แจ้งยกเลิก</button> -->
                                                <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal" >ปิดหน้าต่าง</button>
                                            </div>
                                        </div>
                                    </form>
                                </body>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                        
                  
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

datepick()
   function datepick() {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    }


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