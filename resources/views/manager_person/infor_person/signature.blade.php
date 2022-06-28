@extends('layouts.backend_person')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

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



<div class="content">
    <div class="block block-rounded block-bordered">
        <div class="block-content">
       

            <a href="{{ url('manager_person/signaturecreate/'.$inforpersonuserid->ID) }}"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-plus"></i> เพิ่มข้อมูลลายเซ็นต์</a>
                        <div class="block-content">
            

                <div class="block-header block-header-default" style="background-color: #FFEBCD;">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;">ข้อมูลลายเซ็นต์</h3>
                </div>
                <div class="block-content">    

                        

                       
                        <div class="row">
                        @foreach ($inforsignals as $inforsignal)
                        <div class="col-md-6 col-xl-3">
                            <!-- Story #1 -->
                            <div class="block block-rounded">
                                <div class="block-content">
                                <img src="data:image/png;base64,{{ chunk_split(base64_encode($inforsignal->IMG)) }}" height="120px" width="100%">    
                                </div>
                                <div class="block-content">
                             
                                    <p class="font-size-sm text-muted mt-1">
                                    หมายเหตุ : {{ $inforsignal -> REMARK }}
                                    </p>
                                </div>
                                <div class="block-content block-content-full bg-body-light">
                                    <div class="row no-gutters font-size-sm text-center">
                                        <div class="col-4">
                                        <a href="{{ url('manager_person/signatureedit/'.$inforsignal -> ID.'/'.$inforsignal -> PERSON_ID)}}"    class="btn btn-warning"><i class="fa fa-pencil-alt"></i></a>
                                        </div>
                                        <div class="col-4">
                                        <a href="{{ url('manager_person/signaturedes/'.$inforsignal->ID.'/'.$inforsignal->PERSON_ID)  }}" class="btn btn-danger" onclick="return confirm('ต้องการที่จะลบข้อมูลลายเซ็นต์ ?')"><i class="fa fa-times"></i></a>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                            <!-- END Story #1 -->
                        </div>
                        @endforeach 
                      </div>
      

@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script>
  $('#edit_modal').on('show.bs.modal', function(e) {
    var Id = $(e.relatedTarget).data('id');
    var VUTId = $(e.relatedTarget).data('vutid');
    $(e.currentTarget).find('input[name="ID"]').val(Id);
    $(e.currentTarget).find('select[id="VUT_ID_edit[]"]').val(VUTId);

});

$('img').bind('contextmenu', function(e){
    return false;
}); 

</script>

<script>
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,  //Set เป็นปี พ.ศ.
                autoclose: true 
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน

      
});
    
        

    $(document).ready(function () {
            
            $('.datepicker2').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true              //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });

    $(document).ready(function () {
            
            $('.datepicker3').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true              //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });

    $(document).ready(function () {
            
            $('.datepicker4').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true              //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });

    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    

    $('body').on('keydown', 'input, select, textarea', function(e) {
    var self = $(this)
      , form = self.parents('form:eq(0)')
      , focusable
      , next
      ;
    if (e.keyCode == 13) {
        focusable = form.find('input,a,select,button,textarea').filter(':visible');
        next = focusable.eq(focusable.index(this)+1);
        if (next.length) {
            next.focus();
        } else {
            form.submit();
        }
        return false;
    }
});


function readURL(input) {
        var fileInput = document.getElementById('picture');
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();    
    		
                    if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                        var reader = new FileReader();
            
                        reader.onload = function (e) {
                            $('#image_upload_preview').attr('src', e.target.result);
                        }
            
                        reader.readAsDataURL(input.files[0]);
                    }else{
        
                                alert('กรุณาอัปโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif .');
                                fileInput.value = '';
                                return false;
       
                        }
                }

            
                $("#picture").change(function () {
                    readURL(this);
                });




</script>



@endsection