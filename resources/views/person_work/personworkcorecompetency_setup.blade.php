@extends('layouts.general.person_work')
@section('css_after_infowork')
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
        padding-right: 10px;
    }

    .text-font {
        font-size: 13px;
    }

    body {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;
    }

    .form-control {
        font-family: 'Kanit', sans-serif;
        font-size: 13px;
    }
</style>
@endsection
@section('content_infowork')
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
    // date_default_timezone_set("Asia/Bangkok");
?>
<div class="content">
    <!-- Dynamic Table Simple -->
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ตั้งระดับ Core competency</B></h3>
        </div>
        <div class="block-content block-content-full">
            <br>
            <form method="post" action="{{route('abi.personworkcorecompetency_setupupdate')}}"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-1">
                        ปีงบประมาณ
                    </div>
                    <div class="col-sm-2">
                        <select style=" font-family: 'Kanit', sans-serif;" name="COR_COM_SET_YEAR" id="COR_COM_SET_YEAR"
                            class="form-control">

                            budgetyears
                            @foreach($budgetyears as $budgetyear)
                                <option value="{{$budgetyear->LEAVE_YEAR_ID}}">{{$budgetyear->LEAVE_YEAR_ID}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-sm-12">
                        <div class="row push">
                            <div class="col-lg-1" style="text-align: left">
                                <label>
                                </label>
                            </div>
                            <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                                <thead style="background-color: #FFEBCD;">
                                    <tr height="40">
                                        <td style="text-align: center;">สมรรถนะ</td>
                                        <td style="text-align: center;">ระดับสูงสุด</td>

                                        <td style="text-align: center;" width="12%">
                                            <a class="btn btn-success fa fa-plus-square addRow"
                                                style="color:#FFFFFF; font-family: 'Font Awesome 5 Free' !important;"></a>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody class="tbody1">
                                    <tr height="20">
                                        <td>
                                            <select style=" font-family: 'Kanit', sans-serif;"
                                                name="COR_COM_SET_LEVEL_ID[]" id="COR_COM_SET_LEVEL_ID[]"
                                                class="form-control">
                                                <option value="0">--เลือกทักษะ--</option>
                                                @foreach ($infocoms as $infocom)
                                                <option value="{{$infocom->COR_COM_ID}}">{{$infocom->COR_COM_NAME}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select style=" font-family: 'Kanit', sans-serif;"
                                                name="COR_COM_SET_LEVEL_SUB_MAX[]" id="COR_COM_SET_LEVEL_SUB_MAX[]"
                                                class="form-control">
                                                <option value="0">--เลือกระดับสูงสุด--</option>
                                                <option value="1">ระดับ 1</option>
                                                <option value="2">ระดับ 2</option>
                                                <option value="3">ระดับ 3</option>
                                                <option value="4">ระดับ 4</option>
                                            </select>
                                        </td>
                                        <td style="text-align: center;"><a
                                                class="btn btn-danger fa fa-trash-alt remove "
                                                style="color:#FFFFFF;font-family: 'Font Awesome 5 Free' !important;"></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <br>
                <input type="hidden" name="COR_COM_SET_PERSON_ID" id="COR_COM_SET_PERSON_ID"
                    class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"
                    value="{{$inforpersonuserid -> ID}}">
                <div class="modal-footer">
                    <div align="right">
                        <button type="submit" class="btn btn-hero-sm btn-hero-info">บันทึก</button>
                        <a href="{{ url('person_work/personworkcorecompetency_detail/'.$inforpersonuserid -> ID)}}"
                            class="btn btn-hero-sm btn-hero-danger"
                            onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')">ยกเลิก</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('footer_infowork')
<script>
    function checklogin() {
        window.location.href = '{{route("index")}}';
    }
</script>
<script>jQuery(function(){ Dashmix.helpers(['easy-pie-chart', 'sparkline']); });</script>
<script>
    $('.addRow').on('click', function () {
        addRow();
    });

    function addRow() {
        var count = $('.tbody1').children('tr').length;
        var tr = '<tr height="20">' +
            '<td>' +
            '<select style=" font-family: \'Kanit\', sans-serif;" name="COR_COM_SET_LEVEL_ID[]" id="COR_COM_SET_LEVEL_ID[]" class="form-control" > ' +
            '<option value="0">--เลือกทักษะ--</option>' +
            '@foreach ($infocoms as $infocom)' +
            '<option value="{{$infocom->COR_COM_ID}}">{{$infocom->COR_COM_NAME}}</option>' +
            '@endforeach' +
            '</select>' +
            '</td>' +
            '<td>' +
            '<select style=" font-family: \'Kanit\', sans-serif;" name="COR_COM_SET_LEVEL_SUB_MAX[]" id="COR_COM_SET_LEVEL_SUB_MAX[]" class="form-control" > ' +
            '<option value="0">--เลือกระดับสูงสุด--</option>' +
            '<option value="1">ระดับ 1</option>' +
            '<option value="2">ระดับ 2</option>' +
            '<option value="3">ระดับ 3</option>' +
            '<option value="4">ระดับ 4</option>' +
            '</select>' +
            '</td>' +
            '<td style="text-align: center;"> <a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;font-family:\'Font Awesome 5 Free\' !important;"></a></td > ' +
            '</tr>';
        $('.tbody1').append(tr);
    };

    $('.tbody1').on('click', '.remove', function () {
        $(this).parent().parent().remove();
    });
    $(document).ready(function () {

        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: true,
            language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
            thaiyear: true,
            autoclose: true //Set เป็นปี พ.ศ.
        }); //กำหนดเป็นวันปัจุบัน
    });

    function chkmunny(ele) {
        var vchar = String.fromCharCode(event.keyCode);
        if ((vchar < '0' || vchar > '9') && (vchar != '.')) return false;
        ele.onKeyPress = vchar;
    }
</script>
@endsection
