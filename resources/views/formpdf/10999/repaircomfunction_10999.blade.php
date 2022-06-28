@extends('layouts.repaircom')   
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
      font-size: 10px;
      font-size: 1.0rem;
      }

      label{
            font-family: 'Kanit', sans-serif;
            font-size: 10px;
            font-size: 1.0rem;
      } 
        @media only screen and (min-width: 1200px) {
    label {
        /* float:right; */
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


                        table, td, th {
            border: 1px solid black;
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

<center>    
    <div class="block mt-2" style="width: 75%;">
        <div class="block block-rounded block-bordered">
           
   

              <div class="block-header block-header-default">
                <h3 class="block-title text-left" style="font-family: 'Kanit', sans-serif;"><B>เปิดฟังก์ชั่นฟอร์ม</B></h3>
                &nbsp;&nbsp;
          
               
                <button type="button" class="btn btn-hero-sm btn-hero-info foo14" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-plus mr-2"></i>                                                  
                    เพิ่มข้อมูล
                  </button>
            </div>  
    <div class="block-content">
            <div class="table-responsive">    
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="gwt-table table-striped table-vcenter js-dataTable-full" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="7%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="25%">รหัสฟังก์ชั่นฟอร์ม</th>    
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >ชื่อฟังก์ชันฟอร์ม</th>                                                  
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="7%">สถานะ</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="7%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody id="myTable">
                   
                    <?php $number = 0; ?>
                        @foreach ($openforms as $openform)
                        <?php $number++; ?>
                            <tr height="20" id="sid{{$openform->FUNCT_REPCOM_ID}}">
                                <td class="text-font" align="center" width="7%">{{$number}}</td>                        
                                <td class="text-font text-pedding" width="25%">{{$openform->FUNCT_REPCOM_CODE}}</td>  
                                <td class="text-font text-pedding" >{{$openform->FUNCT_REPCOM_NAME}}</td>  
                                <td align="center" width="7%">
                                    <div class="custom-control custom-switch custom-control-lg ">
                                        @if($openform-> FUNCT_REPCOM_STATUS == 'True' )
                                            <input type="checkbox" class="custom-control-input" id="{{ $openform-> FUNCT_REPCOM_ID }}" name="{{ $openform-> FUNCT_REPCOM_ID }}" onchange="switch_med_active({{ $openform-> FUNCT_REPCOM_ID }});" checked>
                                        @else
                                            <input type="checkbox" class="custom-control-input" id="{{ $openform-> FUNCT_REPCOM_ID }}" name="{{ $openform-> FUNCT_REPCOM_ID }}" onchange="switch_med_active({{ $openform-> FUNCT_REPCOM_ID}});">
                                        @endif
                                            <label class="custom-control-label" for="{{ $openform-> FUNCT_REPCOM_ID }}"></label>
                                   </div>
                                   </td>              
                                <td align="center" width="7%">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family:'Kanit',sans-serif;font-size:10px;font-weight:normal;">
                                            ทำรายการ
                                        </button>
                                    <div class="dropdown-menu" style="width:10px">                                           
                                            <button class="dropdown-item edit_repirecom" value="{{$openform->FUNCT_REPCOM_ID}}" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">แก้ไข</button>
                                            <button class="dropdown-item "  onclick="repaircomfunction_10999_destroy({{$openform->FUNCT_REPCOM_ID}})"  style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;" onclick="return confirm('คุณต้องการที่จะลบ {{ $openform->FUNCT_REPCOM_CODE}} ใช่หรือไม่ ?')">ลบ</button>
                                        </div>
                                    </div>
                                </td> 
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</div>
   
    </div>
</center>

<!--Add  Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">เพิ่มฟังก์ชั่น</h5>
        
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body shadow-lg">
          
          <form action="{{route('form.repaircomfunction_10999_save')}}" method="POST" id="insert_formrepaircom">  
           
            @csrf
            
            <div class="form-group">
              <label for="FUNCT_REPCOM_CODE">รหัส</label>
              <input type="text" class="form-control" id="FUNCT_REPCOM_CODE" name="FUNCT_REPCOM_CODE" placeholder="รหัสโรงพยาบาล" required>
            </div>

            <div class="form-group">
                <label for="FUNCT_REPCOM_NAME">ชื่อ</label>
                <input type="text" class="form-control" id="FUNCT_REPCOM_NAME" name="FUNCT_REPCOM_NAME" placeholder="ชื่อโรงพยาบาล" required>
              </div>
                      
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-hero-sm btn-hero-info">
            <i class="fas fa-save mr-2"></i>บันทึกข้อมูล
          </button>
          <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal">
            <i class="fas fa-window-close mr-2"></i>ยกเลิก
          </button>
         
        </div>
      </form>
      </div>
    </div>
</div>   

  <!--Edit  Modal -->
<div class="modal fade" id="exampleEditModal" tabindex="-1" aria-labelledby="exampleEditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleEditModalLabel">แก้ไขฟังก์ชั่น</h5>
        
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body shadow-lg">
                  
            <form action="{{route('form.repaircomfunction_10999_update')}}" method="POST" id="update_formrepaircom">             
            @csrf
            <input type="hidden" class="form-control" id="edit_id" name="FUNCT_REPCOM_ID">

            <div class="form-group">
              <label for="FUNCT_REPCOM_CODE">รหัส</label>
              <input type="text" class="form-control" id="edit_code" name="FUNCT_REPCOM_CODE" placeholder="รหัสโรงพยาบาล" required>
            </div>

            <div class="form-group">
                <label for="FUNCT_REPCOM_NAME">ชื่อ</label>
                <input type="text" class="form-control" id="edit_name" name="FUNCT_REPCOM_NAME" placeholder="ชื่อโรงพยาบาล" required>
              </div>
                      
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-hero-sm btn-hero-info">
            <i class="fas fa-save mr-2"></i>บันทึกข้อมูล
          </button>
          <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal">
            <i class="fas fa-window-close mr-2"></i>ยกเลิก
          </button>
         
        </div>
      </form>
      </div>
    </div>
</div> 

@endsection

@section('footer')

<script src="{{ asset('select2/select2.min.js') }}"></script>
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
    // alert('ok');
     $(document).ready(function(){
        //********** บันทึก  ********************//        
        $('#insert_formrepaircom').on('submit',function(e){
            e.preventDefault();

            var form = this;
            // alert('OJJJJOL');
            $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data:new FormData(form),
                processData:false,
                dataType:'json',
                contentType:false,               
                success:function(data){
                    // alert('OK');  
                        window.location.reload();
                        $('#exampleModal').modal('hide') 
                
                }
            });
        });
    });
       //********** แก้ไข ดึงข้อมูลขึ้นโชว์ Modal เพื่อทำการ Update ********************//
   $(document).on('click','.edit_repirecom',function(e){
        e.preventDefault();        
        var FUNCT_REPCOM_ID = $(this).val();
        $('#exampleEditModal').modal('show');
            //    alert(FUNCT_REPCOM_ID);
            $.ajax({
                type:"GET",
                // url:"/formpdf/formrepairmedical_edit/"+FUNCT_REPCOM_ID,
                url:"{{url('/formpdf/repaircomfunction_10999_edit/')}}"+"/"+FUNCT_REPCOM_ID,
                success: function(response){
                console.log(response.data.FUNCT_REPCOM_NAME);       
                $('#edit_code').val(response.data.FUNCT_REPCOM_CODE);
                $('#edit_name').val(response.data.FUNCT_REPCOM_NAME);
                $('#edit_id').val(FUNCT_REPCOM_ID);
                }
            })
        });

        $('#update_formrepaircom').on('submit',function(e){
            e.preventDefault();

            var form = this;
            $.ajax({
            url:$(form).attr('action'),
            method:$(form).attr('method'),
            data:new FormData(form),
            processData:false,
            dataType:'json',
            contentType:false,
            success:function(data){
                // alert('OK');  
                window.location.reload();
                $('#exampleEditModal').modal('hide') 
            }
        });
  });
  function repaircomfunction_10999_destroy(FUNCT_REPCOM_ID)
  {
    
    // alert('คุณต้องการที่จะลบ รหัส' + FUNCT_REPMEDICAL_ID );
  
        $.ajax({
        url:'/formpdf/repaircomfunction_10999_destroy/'+FUNCT_REPCOM_ID,
        type:'DELETE',
        data:{
            _token : $("input[name=_token]").val()
        },
        success:function(response)
        {     
            $("#sid"+FUNCT_REPCOM_ID).remove(); 
            window.location.reload();   
        }              
    });
}

</script>
 <script>
      $(document).ready(function() {
            $('select').select2();
        });
   function switch_med_active(idfunc){
         // alert(budget);
         var checkBox=document.getElementById(idfunc);
         var onoff;
   
         if (checkBox.checked == true){
           onoff = "True";
     } else {
           onoff = "False";
     } 
    var _token=$('input[name="_token"]').val();
         $.ajax({
                 url:"{{route('form.repaircomfunction_10999_switchactive')}}",
                 method:"GET",
                 data:{onoff:onoff,idfunc:idfunc,_token:_token}
         })
    }   
</script>


@endsection