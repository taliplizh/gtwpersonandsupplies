@extends('layouts.risk')   
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
            font-size: 13px;            
            }
        label{
            font-family: 'Kanit', sans-serif;
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

    function timeformate($strtime)
  {   
    list($a,$b) = explode(':',$strtime);
    return $a.":".$b;
    }

    
    
?>

    <center>    
            <div class="block shadow-lg mt-5" style="width: 95%;">
                <div class="block block-rounded block-bordered">
                    <div class="block-header block-header-default">                        
                        <div align="left">
                            <h2 class="block-title" style="font-family:'Kanit',sans-serif;font-size:17px;font-weight:normal;"><B>รายละเอียดสถานที่เกิดเหตุ</B></h2>
                        </div> 
                        <div align="left">                       
                           <button class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target="#addModal" style="font-family:'Kanit',sans-serif;font-size:17px;font-weight:normal;"><i class="fas fa-plus mr-2"></i>เพิ่มข้อมูล</button> 
                        </div>       
                    </div>
                <div class="block-content block-content-full">
                  <div class="table-responsive"> 
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #C39BD3;">
                        <tr height="40">
                            <th class="text-font" style="text-align: center;" width="7%">ลำดับ</th>
                            <th class="text-font" style="text-align: center;" width="15%">รหัส</th>
                            <th class="text-font" style="text-align: center;" width="20%">ชื่อห้อง</th>
                            <th class="text-font" style="text-align: center;" width="20%">สถานที่</th>
                            <th class="text-font" style="text-align: center;" width="20%">ชนิดสถานที่</th>
                            <th class="text-font" style="text-align: center;" width="7%" >คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>
                    <?php $number = 0; ?>
                        @foreach ($riskinfocidence_origins as $riskinfocidence_origin)
                            <?php $number++;  ?>
                                <tr height="20">
                                    <td class="text-font" style="text-align: center;" width="7%">{{ $number}}</td>
                                    <td class="text-font text-pedding" width="15%">&nbsp;&nbsp;{{$riskinfocidence_origin->INCIDENCE_ORIGIN_CODE}}</td>
                                    <td class="text-font text-pedding" width="20%">&nbsp;&nbsp;{{$riskinfocidence_origin->LOCATION_NAME}}</td>
                                    <td class="text-font text-pedding" width="20%">&nbsp;&nbsp;{{$riskinfocidence_origin->INCIDENCE_ORIGIN_NAME}}</td>
                                    <td class="text-font text-pedding" width="20%">&nbsp;&nbsp;{{$riskinfocidence_origin->RISK_LOCATION_NAME}}</td>
                                    <td align="center" width="7%">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;">
                                                ทำรายการ
                                            </button>
                                            <div class="dropdown-menu fo13" style="width:10px">      
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#editModal{{$riskinfocidence_origin->INCIDENCE_ORIGIN_ID}}"><i class="fas fa-edit text-warning mr-2"></i>แก้ไขข้อมูล</a>
                                                    <a class="dropdown-item" href="{{ url('manager_risk/risklocationuse_destroy/'.$riskinfocidence_origin->INCIDENCE_ORIGIN_ID)}}" onclick="return confirm('ต้องการที่จะยกเลิกการลบข้อมูล ?')"><i class="fas fa-trash text-danger mr-2"></i>ลบข้อมูล</a>
                                                </div>
                                            </div>
                                    </td>                                    
                                </tr>

                                {{-- Modal editriskleModal--}}
                                <div class="modal fade" id="editModal{{$riskinfocidence_origin->INCIDENCE_ORIGIN_ID}}" tabindex="-1" aria-labelledby="addModalModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info shadow-lg">
                                                <h5 class="modal-title text-white" id="addModalModalLabel" style="font-family:'Kanit',sans-serif;font-size:17px;font-weight:normal;">แก้ไขข้อมูลสถานที่เกิดเหตุ</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form  method="post" action="{{ route('mrisk.risklocationuse_update') }}" enctype="multipart/form-data">
                                                    @csrf
                                                        <input type="hidden" name="risk_id" id="risk_id" value="{{$riskinfocidence_origin->INCIDENCE_ORIGIN_ID}}">
                                                    <div class="row text-left">
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">รหัส :</label>
                                                                <input type="text" class="form-control fo13" name="INCIDENCE_ORIGIN_CODE" id="INCIDENCE_ORIGIN_CODE" value="{{$riskinfocidence_origin->INCIDENCE_ORIGIN_CODE}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">   
                                                            <div class="form-group">
                                                                <label for="message-text" class="col-form-label">ชื่อห้อง :</label>
                                                                <input type="text" class="form-control fo13" name="LOCATION_NAME" id="LOCATION_NAME" value="{{$riskinfocidence_origin->LOCATION_NAME}}" required>
                                                               
                                                            </div>
                                                        </div>   
                                                        
                                                        <div class="col-md-3">   
                                                            <div class="form-group">
                                                                <label for="message-text" class="col-form-label">สถานที่ :</label>
                                                              
                                                                <select name="LOCATION_ID" id="LOCATION_ID" class="form-control" style="width: 100%" required>
                                                                <option value="">--กรุณาเลือก--</option>
                                                                    @foreach ($infolocations as $infolocation)
                                                                         @if($infolocation->LOCATION_ID == $riskinfocidence_origin->LOCATION_ID)
                                                                         <option value="{{ $infolocation->LOCATION_ID }}" selected> {{ $infolocation->LOCATION_NAME }}</option>
                                                                         @else
                                                                         <option value="{{ $infolocation->LOCATION_ID }}" > {{ $infolocation->LOCATION_NAME }}</option>
                                                                         @endif
                                                                       
                                                                    @endforeach
                                                                 </select>
                                                            
                                                            </div>
                                                        </div>  
                                                        
                                                        
                                                        
                                                        <div class="col-md-3">   
                                                            <div class="form-group">
                                                                <label for="message-text" class="col-form-label">ชนิดสถานที่ :</label>
                                                             
                                                            
                                                                <select name="ORIGIN_DEPART_ID" id="ORIGIN_DEPART_ID" class="form-control" style="width: 100%" required>
                                                                    <option value="">--กรุณาเลือก--</option>
                                                                        @foreach ($infolocationtypes as $infolocationtype)
                                                                        @if($infolocationtype->RISK_LOCATION_ID == $riskinfocidence_origin->ORIGIN_DEPART_ID)
                                                                            <option value="{{ $infolocationtype->RISK_LOCATION_ID }}" selected> {{ $infolocationtype->RISK_LOCATION_NAME }}</option>
                                                                        @else
                                                                            <option value="{{ $infolocationtype->RISK_LOCATION_ID }}" > {{ $infolocationtype->RISK_LOCATION_NAME }}</option>
                                                                        @endif
                                                                            @endforeach
                                                                </select>
                                                            
                                                            
                                                            </div>
                                                    </div>
                                                </div>  
                                         
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-hero-sm btn-hero-info foo15" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                <a href="{{ url('manager_risk/risklocationuse')  }}" onclick="return confirm('ต้องการที่จะยกเลิกข้อมูล ?')" class="btn btn-hero-sm btn-hero-danger foo15" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>

                        @endforeach   
                    </tbody>
                </table>
                </div>        
            </div>


            {{-- Modal addriskleModal--}}
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header bg-info shadow-lg">
                            <h5 class="modal-title text-white" id="addModalModalLabel" style="font-family:'Kanit',sans-serif;font-size:17px;font-weight:normal;">เพิ่มข้อมูลสถานที่เกิดเหตุ</h5>
                        </div>
                        <div class="modal-body">
                             <form method="post" action="{{ route('mrisk.risklocationuse_save') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row text-left">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">รหัส :</label>
                                            <input type="text" class="form-control fo13" name="INCIDENCE_ORIGIN_CODE" id="INCIDENCE_ORIGIN_CODE" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">   
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">ชื่อห้อง :</label>
                                            <input type="text" class="form-control fo13" name="LOCATION_NAME" id="LOCATION_NAME"  required>
                                           
                                        </div>
                                    </div>   
                                    <div class="col-md-3">   
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">สถานที่ :</label>
                                          
                                            <select name="LOCATION_ID" id="LOCATION_ID" class="form-control" style="width: 100%" required>
                                            <option value="">--กรุณาเลือก--</option>
                                                @foreach ($infolocations as $infolocation)
                                                    <option value="{{ $infolocation->LOCATION_ID }}" > {{ $infolocation->LOCATION_NAME }}</option>
                                                @endforeach
                                             </select>
                                        
                                        </div>
                                    </div>  
                                    
                                    
                                    
                                    <div class="col-md-3">   
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">ชนิดสถานที่ :</label>
                                         
                                        
                                            <select name="ORIGIN_DEPART_ID" id="ORIGIN_DEPART_ID" class="form-control" style="width: 100%" required>
                                                <option value="">--กรุณาเลือก--</option>
                                                    @foreach ($infolocationtypes as $infolocationtype)
                                                        <option value="{{ $infolocationtype->RISK_LOCATION_ID }}" > {{ $infolocationtype->RISK_LOCATION_NAME }}</option>
                                                    @endforeach
                                            </select>
                                        
                                        
                                        </div>
                                    </div>          
                                </div>
                               
                     
                               
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-hero-sm btn-hero-info foo15" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                            <a href="{{ url('manager_risk/risklocationuse')  }}" onclick="return confirm('ต้องการที่จะยกเลิกข้อมูล ?')" class="btn btn-hero-sm btn-hero-danger foo15" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
                        </div>
                    </div>
                     </form>
                </div>
            </div>

             
  
  
@endsection

@section('footer')

<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script src="{{ asset('select2/select2.min.js') }}"></script>
<script>
    // $(document).ready(function() {
    //     $('select').select2();
    // });
</script> 

<script>
    
      
        $(document).ready(function () {            
                $('.datepicker').datepicker({
                    format: 'dd/mm/yyyy',
                    todayBtn: true,
                    language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                    thaiyear: true,
                    autoclose: true //Set เป็นปี พ.ศ.
                });  //กำหนดเป็นวันปัจุบัน
        });

      
</script>

@endsection