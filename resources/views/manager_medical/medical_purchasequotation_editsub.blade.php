@extends('layouts.medical')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />

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

  
  function Removeformate($strDate)
  {
    $strYear = date("Y",strtotime($strDate));
    $strMonth= date("m",strtotime($strDate));
    $strDay= date("d",strtotime($strDate));
  
    return $strDay."/".$strMonth."/".$strYear;
    }
  

    $yearbudget = date("Y")+543;

    $yearnow = date("Y")+543;
    $monthnow = date("m");
    $datenow1 = date("d");
    $timenow = date(" H:i:s");

    $datenow = $datenow1.'/'.$monthnow.'/'.$yearnow.' '.$timenow;

  
  //echo $yearbudget;

?>

<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
           
            }

            .text-pedding{
   padding-left:10px;
                    }

        .text-font {
    font-size: 13px;
                  }   
      }


  
#pages{
    text-align: center;
}
.page{
    width: 90%;
    margin: 10px;
    box-shadow: 0px 0px 5px #000;
    animation: pageIn 1s ease;
    transition: all 1s ease, width 0.2s ease;
}
@keyframes pageIn{
  0%{
      transform: translateX(-300px);
      opacity: 0;
  }
  100%{
      transform: translateX(0px);
      opacity: 1;
  }
}
#zoom-in{
    
}
#zoom-percent{
    display: inline-block;
}
#zoom-percent::after{
    content: "%";
}
#zoom-out{
    
}

.form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
            }
      
       
</style>

<center>

<!-- Dynamic Table Simple -->
<div class="block" style="width: 95%;">
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขใบเสนอราคา รายการเลขทะเบียน {{$CON_NUM}}</B></h3>

</div>
<form  method="post" action="{{ route('mmedical.purchasequotationsubupdate') }}"  enctype="multipart/form-data"  class="needs-validation" novalidate>      
    @csrf

<div class="block-content block-content-full">
<div class="row">
   <div class="col-md-7" style="text-align: center">
   
  
   <input type="file" id="pdfupload" name="pdfupload" accept="application/pdf" style="width:75%;"/>
  
   <div id="zoom-percent" style="text-align: right;background-color: #E6E6FA;">90</div>
   
   <a id="zoom-in" class="btn btn-info" style="color:#F0FFFF"><i class="fa fa-search-plus"></i></a>
  <a id="zoom-out" class="btn btn-info" style="color:#F0FFFF"><i class="fa fa-search-minus"></i></a>
  <a id="zoom-reset" class="btn btn-info" style="color:#F0FFFF"><i class="fa fa-search"></i></a>
 
<br>
<br>
<div style='overflow:scroll; width:auto;height:900px;  background-color: #404040;' id="pages">

@if($detailquotation->QUOTATION_VENDOR_FILE_NAME == '' || $detailquotation->QUOTATION_VENDOR_FILE_NAME == null)
      ไม่มีข้อมูลไฟล์อัปโหลด 
@else
<?php list($a,$b,$c,$d) = explode('/',$url); ?>
<iframe src="{{ asset('storage/app/public/suppdf/'.$detailquotation->QUOTATION_VENDOR_FILE_NAME ) }}" height="100%" width="100%"></iframe>

@endif
</div>




   </div>
   

   <div class="col-md-5">
   <div class="row">
   <div class="col">
   <h5 style=" font-family: 'Kanit', sans-serif;text-align: left;">รายละเอียด</h5>
   </div>
   <div class="col">
   วันที่บันทึก  {{$datenow}}
   </div>
   </div>
   
   <input  type="hidden" name = "QUOTATION_CON_NUM"  id="QUOTATION_CON_NUM" class="form-control input-lg" value="{{$CON_NUM}}" >
   <input  type="hidden" name = "ID"  id="ID" class="form-control input-lg" value="{{$IDCON}}" >

   <input  type="hidden" name = "IDREF"  id="IDREF" class="form-control input-lg" value="{{$IDREF}}" >
        <div class="row">
        <div class="col">
            <p style="text-align: left">เลขที่ใบเสนอราคา</p>
            </div>
            <div class="col-md-9">
        <input  name = "QUOTATION_NUMBER"  id="QUOTATION_NUMBER" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$detailquotation->QUOTATION_NUMBER}}">
        </div> 
        </div>
        <div class="row">
        <div class="col">
        <p style="text-align: left">บริษัท</p>
        </div>
        <div class="col-md-9">
    
            <select name="QUOTATION_VENDOR_ID" id="QUOTATION_VENDOR_ID" class="form-control input-lg vendor" style=" font-family: 'Kanit', sans-serif;">
            
            <option value="">--กรุณาเลือกบริษัท--</option>
             @foreach ($vendors as $vendor)
                @if($detailquotation->QUOTATION_VENDOR_ID == $vendor ->VENDOR_ID)
                     <option value="{{ $vendor ->VENDOR_ID  }}" selected>{{ $vendor->VENDOR_NAME}}</option>
                @else
                     <option value="{{ $vendor ->VENDOR_ID  }}">{{ $vendor->VENDOR_NAME}}</option>
                @endif

             
           
            @endforeach 
        </select>   
        
        </div>
        </div>

    <div class="detailvendor">

        <div class="row">
        <div class="col">
        <p style="text-align: left">ที่อยู่</p>
        </div>
        <div class="col-md-9">
            <input  name = "QUOTATION_VENDOR_ADD"  id="QUOTATION_VENDOR_ADD" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$detailquotation->QUOTATION_VENDOR_ADD}}">
        </div>
        </div>
        <div class="row">
        <div class="col">
        <p style="text-align: left">เลขภาษี</p>  
        </div>
        <div class="col-md-9">
            <input  name = "QUOTATION_VENDOR_TAXNUM"  id="QUOTATION_VENDOR_TAXNUM" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$detailquotation->QUOTATION_VENDOR_TAXNUM}}">
        </div>
        </div>

    </div>

        <div class="row">
        <div class="col">
        <p style="text-align: left">ยอดนำเสนอ</p>
        </div>
        <div class="col-md-7">
            <input  name = "QUOTATION_VENDOR_PICE"  id="QUOTATION_VENDOR_PICE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" OnKeyPress="return chkmunny(this)" value="{{$detailquotation->QUOTATION_VENDOR_PICE}}">
        </div>
        <div class="col-md-2">
        <p style="text-align: left">บาท</p>
        </div>
        </div>
        <div class="row">
        <div class="col">
        <p style="text-align: left">สถานะประมูล</p>
        </div>
        <div class="col-md-9" style="text-align: left">
         @if($detailquotation->QUOTATION_WIN == 1)
         <input name="QUOTATION_WIN" id="QUOTATION_WIN" type="checkbox" class="form-check-input" value="1" checked>เป็นผู้ชนะ
        
         @else
         <input name="QUOTATION_WIN" id="QUOTATION_WIN" type="checkbox" class="form-check-input" value="1">เป็นผู้ชนะ
        
         @endif
       
        </div>
        </div>

        </div>

</div>
<br>
<div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
        <a href="{{ url('manager_medical/medical_purchasequotation_add/'.$IDCON)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
        </div>

</form>



 
@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script src="{{ asset('pdfupload/pdf_up.js') }}"></script>

<script>


$(document).ready(function() {
    $('select').select2();
});
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });
</script>



<script>

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


//---------------------------------------------------------------------------------
pdfjsLib.GlobalWorkerOptions.workerSrc =
"{{ asset('pdfupload/pdf_upwork.js') }}";

  document.querySelector("#pdfupload").addEventListener("change", function(e){
  document.querySelector("#pages").innerHTML = "";

	var file = e.target.files[0]
	if(file.type != "application/pdf"){
		alert(file.name + " is not a pdf file.")
		return
	}
	
	var fileReader = new FileReader();  

	fileReader.onload = function() {
		var typedarray = new Uint8Array(this.result);
    
		pdfjsLib.getDocument(typedarray).promise.then(function(pdf) {
			// you can now use *pdf* here
			console.log("the pdf has", pdf.numPages, "page(s).");
      for (var i = 0; i < pdf.numPages; i++) {
        (function(pageNum){
        pdf.getPage(i+1).then(function(page) {
          // you can now use *page* here
          var viewport = page.getViewport(2.0);
          var pageNumDiv = document.createElement("div");
          pageNumDiv.className = "pageNumber";
          pageNumDiv.innerHTML = "Page " + pageNum;
          var canvas = document.createElement("canvas");
          canvas.className = "page";
          canvas.title = "Page " + pageNum;
          document.querySelector("#pages").appendChild(pageNumDiv);
          document.querySelector("#pages").appendChild(canvas);
          canvas.height = viewport.height;
          canvas.width = viewport.width;


          page.render({
            canvasContext: canvas.getContext('2d'),
            viewport: viewport
          }).promise.then(function(){
            console.log('Page rendered');
          });
          page.getTextContent().then(function(text){
              console.log(text);
          });
        });
        })(i+1);
      }

		});
	};
 
	fileReader.readAsArrayBuffer(file);
   

});




var curWidth = 90;
function zoomIn(){
    if (curWidth < 150) {
        curWidth += 10;
        document.querySelector("#zoom-percent").innerHTML = curWidth;
        document.querySelectorAll(".page").forEach(function(page){

            page.style.width = curWidth + "%";
        });
    }
}
function zoomOut(){
    if (curWidth > 20) {
        curWidth -= 10;
        document.querySelector("#zoom-percent").innerHTML = curWidth;
        document.querySelectorAll(".page").forEach(function(page){

            page.style.width = curWidth + "%";
        });
    }
}
function zoomReset(){

    curWidth = 90;
    document.querySelector("#zoom-percent").innerHTML = curWidth;
   
    document.querySelectorAll(".page").forEach(function(page){
      page.style.width = curWidth + "%";
    });
}
document.querySelector("#zoom-in").onclick = zoomIn;
document.querySelector("#zoom-out").onclick = zoomOut;
document.querySelector("#zoom-reset").onclick = zoomReset;
window.onkeypress = function(e){
    if (e.code == "Equal") {
        zoomIn();
    }
    if (e.code == "Minus") {
        zoomOut();
    }
};

//-------------------------------------------------------------------------

$('.vendor').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('msupplies.fetchvendor')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.detailvendor').html(result);
                     }
             })
            // console.log(select);
             }        
     });
</script>
@endsection