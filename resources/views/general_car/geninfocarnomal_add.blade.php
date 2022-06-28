@extends('layouts.backend')

<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />


@section('content')


<?php
$status = Auth::user()->status; 
$id_user = Auth::user()->PERSON_ID; 
$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos); 


?>

<style>
    body {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;

    }

    .form-control {
        font-family: 'Kanit', sans-serif;
        font-size: 13px;
    }

    .table-fixed tbody {
        height: 300px;
        overflow-y: auto;
        width: 100%;
    }

    .table-fixed thead,
    .table-fixed tbody,
    .table-fixed tr,
    .table-fixed td,
    .table-fixed th {
        display: block;
    }

    .table-fixed tbody td,
    .table-fixed tbody th,
    .table-fixed thead>tr>th {
        float: left;
        position: relative;

        &::after {
            content: '';
            clear: both;
            display: block;
        }
    }
    .font-content-select{
        font-family: 'Kanit', sans-serif; 
        font-size:13px;
    }
</style>

<body onload="run01();">

    <!-- Advanced Tables -->
    <div class="bg-body-light">
        <div class="content">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">
                    {{ $inforpersonuser -> HR_PREFIX_NAME }} {{ $inforpersonuser -> HR_FNAME }}
                    {{ $inforpersonuser -> HR_LNAME }}</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">

                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="block block-rounded block-bordered">
            <div class="block-content">
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i>
                    เพิ่มข้อมูลขอใช้รถยนต์ทั่วไป</h2>

                <form method="post" action="{{ route('car.carnomalsave') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row push">
                        <div class="col-sm-2">
                            <label>ตามหนังสือ :</label>
                        </div>
                        <div class="col-lg-8 detali_bookname">
                            <input type="hidden" name="BOOK_ID" id="BOOK_ID" class="form-control input-lg"
                                style=" font-family: \'Kanit\', sans-serif;">
                            <input name="BOOK_NAME" id="BOOK_NAME" class="form-control input-lg"
                                style=" font-family: 'Kanit', sans-serif;" required>
                        </div>
                        <div class="col-lg-2">
                            <button type="button" class="btn btn-hero-sm btn-hero-info" data-toggle="modal"
                                data-target=".addbook">หนังสืออ้างถึง</button>
                        </div>
                    </div>

                    <div class="row push">
                        <div class="col-sm-2">
                            <label>เลขที่หนังสือ :</label>
                        </div>
                        <div class="col-lg-3 detali_booknum">
                            <input name="BOOK_NUM" id="BOOK_NUM" class="form-control input-lg"
                                style=" font-family: 'Kanit', sans-serif;" required>
                        </div>
                        <div class="col-sm-1">
                            <label>ลงวันที่ :</label>
                        </div>
                        <div class="col-lg-2 detali_bookdate">
                            <input name="BOOK_DATE_REG" id="BOOK_DATE_REG" class="form-control input-lg datepicker"
                                data-date-format="mm/dd/yyyy" style=" font-family: 'Kanit', sans-serif;" readonly>
                        </div>
                        <div class="col-sm-2">
                            <label>ความเร่งด่วน :</label>
                        </div>
                        <div class="col-lg-2">
                            <select name="PRIORITY_ID" id="PRIORITY_ID"
                                class="form-control input-lg js-example-basic-single"
                                style=" font-family: 'Kanit', sans-serif;">

                                @foreach ($prioritys as $priority)
                                <option value="{{ $priority ->PRIORITY_ID  }}">{{ $priority->PRIORITY_NAME}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row push detali_car">
                        <input type="hidden" name="CAR_REQUEST_ID" id="CAR_REQUEST_ID" class="form-control input-lg"
                            style=" font-family: 'Kanit', sans-serif;" value="">
                        <div class="col-sm-2">
                            <label>รถโรงพยาบาลทะเบียน :</label>
                        </div>
                        <div class="col-lg-3">
                            <input name="" id="" class="form-control input-lg"
                                style=" font-family: 'Kanit', sans-serif;" required>
                        </div>
                        <div class="col-sm-1">
                            <label>รายละเอียด :</label>
                        </div>
                        <div class="col-lg-4">
                            <input name="" id="" class="form-control input-lg"
                                style=" font-family: 'Kanit', sans-serif;" readonly>
                        </div>
                        <div class="col-lg-2">
                            <button type="button" class="btn btn-hero-sm btn-hero-info" data-toggle="modal"
                                data-target=".add">เลือกรถที่ต้องการใช้</button>
                        </div>
                    </div>

                    <div class="row push">
                        <div class="col-sm-2">
                            <label>รถยนต์ส่วนตัวทะเบียน :</label>
                        </div>
                        <div class="col-lg-3">
                            <input name="CAR_OWNER" id="CAR_OWNER" class="form-control input-lg"
                                style=" font-family: 'Kanit', sans-serif;">
                        </div>
                        <div class="col-sm-7">
                            <label style="color:red;">*หากใช้รถยนต์ส่วนตัวกรุณากรอกเลขทะเบียนรถของท่าน</label>
                        </div>
                    </div>

                    <div class="row push">
                        <div class="col-sm-2">
                            <label>เหตุผลขอใช้รถ :</label>
                        </div>
                        <div class="col-lg-10">
                            <input name="RESERVE_NAME" id="RESERVE_NAME" class="form-control input-sm"
                                onkeyup="checkreservename()" required>
                            <div style="color: red;" id="reservename"></div>
                        </div>
                    </div>

                    <div class="row push">
                        <div class="col-sm-2">
                            <label>สถานที่ไป :</label>
                        </div>
                        <div class="col-lg-4">
                            <select name="RESERVE_LOCATION_ID" id="RESERVE_LOCATION_ID"
                                class="form-control input-lg js-example-basic-single org_re"
                                style=" font-family: 'Kanit', sans-serif;" onchange="checkreservelocationid()" required>
                                <option value="">--กรุณาเลือกสถานที่ไป--</option>
                                @foreach ($locations as $location)
                                <option value="{{ $location ->LOCATION_ID  }}">{{ $location->LOCATION_ORG_NAME}}
                                </option>
                                @endforeach
                            </select>
                            <div style="color: red;" id="reservelocationid"></div>
                        </div>
                        <div class="col-sm-4">
                            <input name="ADD_RECORD_ORG" id="ADD_RECORD_ORG" class="form-control input-lg"
                                style=" font-family: 'Kanit', sans-serif; background-color: #CCFFFF;"
                                placeholder="ระบุสถานที่หากต้องการเพิ่ม">
                        </div>
                        <div class="col-lg-2">
                            <a class="btn btn-hero-sm btn-hero-info"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;color:#FFFFFF;"
                                onclick="addorg();"> เพิ่ม</a>
                        </div>
                    </div>

                    <div class="row ">
                        <div class="col-sm-8">
                            <div style="color: #DC143C; text-align: center;" class="checkdat"></div>
                        </div>
                        <div class="col-lg-4">
                        </div>
                    </div>

                    <div class="row push">
                        <div class="col-sm-2">
                            <label>วันที่ :</label>
                        </div>
                        <div class="col-lg-2">
                            <input name="RESERVE_BEGIN_DATE" id="RESERVE_BEGIN_DATE"
                                class="form-control input-sm datepicker" data-date-format="mm/dd/yyyy"
                                onchange="checkreservebegindate();carcallcheckdate();" readonly required>
                            <div style="color: red;" id="reservebegindate"></div>
                        </div>
                        <div class="col-sm-1">
                            <label>เวลา :</label>
                        </div>
                        <div class="col">
                            <input type="text" class="js-masked-time form-control" id="RESERVE_BEGIN_TIME"
                                name="RESERVE_BEGIN_TIME" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00"
                                onkeyup="checkreservebegintime();">
                            <div style="color: red;" id="reservebegintime"></div>
                        </div>
                        <div class="col-sm-1">
                            <label>ถึงวันที่ :</label>
                        </div>
                        <div class="col-lg-2">
                            <input name="RESERVE_END_DATE" id="RESERVE_END_DATE"
                                class="form-control input-sm datepicker" data-date-format="mm/dd/yyyy"
                                onchange="checkreserveenddate();carcallcheckdate();" readonly required>
                            <div style="color: red;" id="reserveenddate"></div>
                        </div>
                        <div class="col-sm-1">
                            <label>เวลา :</label>
                        </div>
                        <div class="col">

                            <input type="text" class="js-masked-time form-control" id="RESERVE_END_TIME"
                                name="RESERVE_END_TIME" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00"
                                onkeyup="checkreserveendtime()">
                            <div style="color: red;" id="reserveendtime"></div>
                        </div>
                    </div>

                    <div class="row push">
                        <div class="col-sm-2">
                            <label>พนักงานขับ :</label>
                        </div>
                        <div class="col-lg-4">
                            <select name="CAR_DRIVER_ID" id="CAR_DRIVER_ID"
                                class="form-control input-lg js-example-basic-single"
                                style=" font-family: 'Kanit', sans-serif;" required>
                                <option value="">--กรุณาเลือกพนักงานขับ--</option>
                                @foreach ($drivers as $driver)
                                <option value="{{ $driver ->PERSON_ID  }}">{{ $driver->HR_FNAME}} {{$driver->HR_LNAME}}
                                </option>
                                @endforeach
                            </select>
                            <div style="color: red;" id="cardriverid"></div>
                        </div>

                        <div class="col-sm-2">
                            <label>หมายเหตุ :</label>
                        </div>
                        <div class="col-sm-4">
                            <input name="RESERVE_COMMENT" id="RESERVE_COMMENT" class="form-control input-sm">
                        </div>

                    </div>

                    <div class="row push">
                        <div class="col-sm-2">
                            <label>ผู้ร้องขอ :</label>
                        </div>
                        <div class="col-lg-4">
                            <input type="hidden" name="RESERVE_PERSON_ID" id="RESERVE_PERSON_ID"
                                class="form-control input-sm" value="{{$inforpersonuserid -> ID}}">
                            {{ $inforpersonuser -> HR_PREFIX_NAME }} {{ $inforpersonuser -> HR_FNAME }}
                            {{ $inforpersonuser -> HR_LNAME }}
                        </div>
                        <div class="col-sm-2">
                            <label>หัวหน้างานรับรอง :</label>
                        </div>
                        <div class="col-lg-4">
                            <select name="LEADER_PERSON_ID" id="LEADER_PERSON_ID"
                                class="form-control input-lg js-example-basic-single"
                                style=" font-family: 'Kanit', sans-serif;" required>
                                <option value="">--กรุณาเลือกหัวหน้างานรับรอง--</option>
                                @foreach ($LEADERS as $LEADER)
                                <option value="{{ $LEADER ->ID  }}">{{ $LEADER->HR_FNAME}} {{$LEADER->HR_LNAME}}
                                </option>
                                @endforeach
                            </select>
                            <div style="color: red;" id="leaderpersonid"></div>
                        </div>
                    </div>

                    <div class="row push">
                        <div class="col-lg-12">
                            <!-- Block Tabs Default Style -->
                            <div class="block block-rounded block-bordered">
                                <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist"
                                    style="background-color: #FFEBCD;">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#object1"
                                            style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ผู้ร่วมเดินทาง</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object2"
                                            style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">บุคคลอื่นร่วมเดินทาง</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#object3"
                                            style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">งานมอบหมาย</a>
                                    </li>
                                </ul>
                                <div class="block-content tab-content">
                                    <div class="tab-pane active" id="object1" role="tabpanel">

                                        <table class="table gwt-table">
                                            <thead>
                                                <tr>
                                                    <td style="text-align: center;">ชื่อ สกุล</td>
                                                    <td style="text-align: center;" width="30%">ตำแหน่ง</td>
                                                    <td style="text-align: center;" width="15%">ระดับ</td>
                                                    <td style="text-align: center;" width="12%"><a
                                                            class="btn btn-hero-sm btn-hero-success addRow"
                                                            style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                                </tr>
                                            </thead>
                                            <tbody class="tbody1">
                                                <tr>
                                                    <td class="text-font">
                                                        <select name="PERSON_ID[]" id="PERSON_ID[]"
                                                            class="form-control input-lg font-content-select"
                                                            style="font-family: 'Kanit', sans-serif"
                                                            onchange="checkposition(0);checklevel(0)">
                                                            <option value="">--กรุณาเลือกผู้ร่วมเดินทาง--</option>
                                                            @foreach ($PERSONALLs as $PERSONALL)
                                                            @if($PERSONALL ->ID == $user_id )
                                                            <span style="font-size:13px;">
                                                                <option value="{{ $PERSONALL ->ID  }}" selected>
                                                                    {{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}
                                                                </option>
                                                            </span>
                                                            @else
                                                            <span style="font-size:13px;">
                                                                <option value="{{ $PERSONALL ->ID  }}">
                                                                    {{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}
                                                                </option>
                                                            </span>
                                                            @endif

                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class="showposition0"></div>
                                                    </td>
                                                    <td>
                                                        <div class="showlevel0"></div>
                                                    </td>
                                                    <td style="text-align: center;"><a
                                                            class="btn btn-hero-sm btn-hero-danger remove"
                                                            style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>


                                    </div>

                                    <div class="tab-pane" id="object2" role="tabpanel">
                                        <table class="table gwt-table">
                                            <thead>
                                                <tr>
                                                    <td style="text-align: center;">บุคคลอื่นร่วมเดินทาง</td>

                                                    <td style="text-align: center;" width="15%"><a
                                                            class="btn btn-hero-sm btn-hero-success addRow2"
                                                            style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                                </tr>
                                            </thead>
                                            <tbody class="tbody2">
                                                <tr>
                                                    <td>
                                                        <input name="PERSON_OTHER[]" id="PERSON_OTHER[]"
                                                            class="form-control input-sm">
                                                    </td>

                                                    <td style="text-align: center;"><a
                                                            class="btn btn-hero-sm btn-hero-danger remove2"
                                                            style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    <div class="tab-pane" id="object3" role="tabpanel">
                                        <table class="table gwt-table">
                                            <thead>
                                                <tr>
                                                    <td style="text-align: center;" width="40%">สถานที่</td>
                                                    <td style="text-align: center;">รายละเอียดงาน</td>

                                                    <td style="text-align: center;" width="15%"><a
                                                            class="btn btn-hero-sm btn-hero-success addRow3"
                                                            style="color:#FFFFFF;"><i class="fa fa-plus"></i>
                                                        </a></td>
                                                </tr>
                                            </thead>
                                            <tbody class="tbody3">
                                                <tr>
                                                    <td>

                                                        <input name="CARWORK_LOCATION_ID[]" id="CARWORK_LOCATION_ID[]"
                                                            class="form-control input-sm">
                                                    </td>
                                                    <td>
                                                        <input name="CARWORK_DETAIL[]" id="CARWORK_DETAIL[]"
                                                            class="form-control input-sm">
                                                    </td>

                                                    <td style="text-align: center;"><a
                                                            class="btn btn-hero-sm btn-hero-danger remove3"
                                                            style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <div align="right">
                            <button type="submit" class="btn btn-hero-sm btn-hero-info"><i
                                    class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                            <a href="{{ url('general_car/gencartype/'.$inforpersonuserid -> ID)  }}"
                                class="btn btn-hero-sm btn-hero-danger"
                                onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')"><i
                                    class="fas fa-window-close mr-2"></i>ยกเลิก</a>
                        </div>
                    </div>

                </form>

                <div class="modal fade addbook" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                    aria-hidden="true" id="modalbook">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title"
                                    style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">
                                    เลือกหนังสืออ้างถึง</h2>
                            </div>
                            <div class="modal-body">

                                <body>
                                    <div class="container mt-3">
                                        <input class="form-control" id="myInput" type="text" placeholder="Search..">
                                        <br>
                                        <div style='overflow:scroll; height:300px;'>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <td style="text-align: center;" width="20%">เลขที่หนังสือ</td>
                                                        <td style="text-align: center;">หนังสือ</th>
                                                        <td style="text-align: center;" width="15%">ลงวันที่</td>


                                                        <td style="text-align: center;" width="5%">เลือก</td>
                                                    </tr>
                                                </thead>
                                                <tbody id="myTable">

                                                    @foreach ($books as $book)

                                                    <tr>
                                                        <td>{{$book->BOOK_NUMBER}}</td>
                                                        <td>{{$book->BOOK_NAME}}</td>
                                                        <td>{{DateThai($book->BOOK_DATE)}}</td>

                                                        <td>
                                                            <button type="button" class="btn btn-hero-sm btn-hero-info"
                                                                onclick="selectbook({{$book->BOOK_ID}});">เลือก</button>
                                                        </td>
                                                    </tr>

                                                    @endforeach
                                                </tbody>
                                            </table>
                                            </table>

                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <div align="right">

                                    <button type="button" class="btn btn-hero-sm btn-hero-danger"
                                        data-dismiss="modal"><i
                                            class="fas fa-window-close mr-2"></i>ปิดหน้าต่าง</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>




<div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
    id="modalwindow">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">

                <h2 class="modal-title"
                    style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">
                    เลือกรถที่ต้องการใช้</h2>
            </div>
            <div class="modal-body">
                <body>
                    <div class="row">
                        @foreach ($cars as $car)
                        <div class="col-md-2 col-xl-2">
                            <!-- Story #1 -->
                            <a class="block block-rounded" onclick="selectcar({{$car->CAR_ID}});">
                                <div class="block-content"
                                    style="background-image:url(data:image/png;base64,{{ chunk_split(base64_encode($car->CAR_IMG)) }});">
                                    <p>
                                        <span class="badge badge-info font-w2000 p-2 text-uppercase">
                                            {{$car->CAR_REG}}
                                        </span>
                                    </p>
                                    <div
                                        class="mb-3 mb-sm-3 d-sm-flex justify-content-sm-between align-items-sm-center">
                                        <img src="data:image/png;base64,{{ chunk_split(base64_encode($car->CAR_IMG)) }}"
                                            width="100%">
                                    </div>
                                </div>
                            </a>
                            <!-- END Story #1 -->
                        </div>
                        @endforeach
                    </div>
            </div>
            <div class="modal-footer">
                <div align="right">
                    <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal"><i
                            class="fas fa-window-close mr-2"></i>ปิดหน้าต่าง</button>
                </div>
            </div>
            </body>
        </div>
    </div>
</div>




@endsection

@section('footer')

<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>
    jQuery(function () {
        Dashmix.helpers(['masked-inputs']);
    });
</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>




<script>
    // $(document).ready(function() {
    //     $('.js-example-basic-single').select2();
    // });
    $(document).ready(function () {
        $('select').select2({
            width: '100%'
        });
    });


    //===============================เพิ่มหน่วยงาน====================================
    function addorg() {

        var record_org = document.getElementById("ADD_RECORD_ORG").value;

        //alert(record_location);

        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{route('car.addorglocation')}}",
            method: "GET",
            data: {
                record_org: record_org,
                _token: _token
            },
            success: function (result) {
                $('.org_re').html(result);
            }
        })

    }

    function run01() {
        var count = $('.tbody1').children('tr').length;
        //alert(count);
        var number;
        for (number = 0; number < count; number++) {
            checkposition(number);
            checklevel(number);

        }

    }


    $('.addRow').on('click', function () {
        addRow();
        $('select').select2();
    });

    function addRow() {
        var count = $('.tbody1').children('tr').length;
        var tr = '<tr>' +
            '<td class="text-font">' +
            '<select name="PERSON_ID[]" id="PERSON_ID' + count +
            '" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" onchange="checkposition(' +
            count + ');checklevel(' + count + ');">' +
            '<option value="">--กรุณาเลือกผู้ร่วมเดินทาง--</option>' +
            '@foreach ($PERSONALLs as $PERSONALL)' +
            '<option value="{{ $PERSONALL ->ID  }}">{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}</option>' +
            '@endforeach' +
            '</select>' +
            '</td>' +
            '<td><div class="showposition' + count + '"></div></td>' +
            '<td><div class="showlevel' + count + '"></div></td>' +
            '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>' +
            '</tr>';
        $('.tbody1').append(tr);
    };

    function testaddRow() {
        var count = $('.tbody1').children('tr').length;
        var tr = '<tr>' +
            '<td>' +
            '<select name="PERSON_ID[]" id="PERSON_ID'+count+'"' +
            'class="form-control input-lg"' +
            'style=" font-family: \'Kanit\', sans-serif;"' +
            'onchange="checkposition(0);checklevel(0)">' +
            '<option value="">--กรุณาเลือกผู้ร่วมเดินทาง--</option>' +
            '@foreach ($PERSONALLs as $PERSONALL)' +
            '@if($PERSONALL ->ID == $user_id )' +
            '<option value="{{ $PERSONALL ->ID  }}" selected>' +
            '{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}' +
            '</option>' +
            '@else' +
            '<option value="{{ $PERSONALL ->ID  }}">' +
            '{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}' +
            '</option>' +
            '@endif' +

            '@endforeach' +
            '</select>' +
            '</td>' +
            '<td>' +
            '<div class="showposition0"></div>' +
            '</td>' +
            '<td>' +
            '<div class="showlevel0"></div>' +
            '</td>' +
            '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a>' +
            '</td>' +
            '</tr>';
        $('.tbody1').append(tr);
    };

    $('.tbody1').on('click', '.remove', function () {
        $(this).parent().parent().remove();
    });

    //-------------------------------------------------

    $('.addRow2').on('click', function () {
        addRow2();
    });

    function addRow2() {
        var tr = '<tr>' +
            '<td>' +

            '<input name="PERSON_OTHER[]" id="PERSON_OTHER[]" class="form-control input-sm"  >' +
            '</td>' +
            '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove2" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>' +
            '</tr>';
        $('.tbody2').append(tr);
    };

    $('.tbody2').on('click', '.remove2', function () {
        $(this).parent().parent().remove();
    });

    //-------------------------------------------------

    $('.addRow3').on('click', function () {
        addRow3();
    });

    function addRow3() {
        var tr = '<tr>' +
            '<td>' +
            '<input name="CARWORK_LOCATION_ID[]" id="CARWORK_LOCATION_ID[]" class="form-control input-sm"  >' +
            '</td>' +
            '<td>' +
            '<input name="CARWORK_DETAIL[]" id="CARWORK_DETAIL[]" class="form-control input-sm">' +
            '</td>' +
            '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove3" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>' +
            '</tr>';
        $('.tbody3').append(tr);
    };

    $('.tbody3').on('click', '.remove3', function () {
        $(this).parent().parent().remove();
    });
    //======================หาตำแหน่งผู้เดินทาง===========================

    function checkposition(number) {


        var PERSON_ID = document.getElementById("PERSON_ID" + number).value;

        //alert(PERSON_ID);

        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{route('perdev.checkposition')}}",
            method: "GET",
            data: {
                PERSON_ID: PERSON_ID,
                _token: _token
            },
            success: function (result) {
                $('.showposition' + number).html(result);
            }
        })



    }

    function checklevel(number) {


        var PERSON_ID = document.getElementById("PERSON_ID" + number).value;

        //alert(PERSON_ID);

        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{route('perdev.checklevel')}}",
            method: "GET",
            data: {
                PERSON_ID: PERSON_ID,
                _token: _token
            },
            success: function (result) {
                $('.showlevel' + number).html(result);
            }
        })

    }


    function selectcar(car_id) {

        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{route('car.selectcarno')}}",
            method: "GET",
            data: {
                car_id: car_id,
                _token: _token
            },
            success: function (result) {
                $('.detali_car').html(result);
            }
        })

        $('#modalwindow').modal('hide');

    }


    function selectbook(book_id) {

        var _token = $('input[name="_token"]').val();

        $.ajax({
            url: "{{route('car.selectbookname')}}",
            method: "GET",
            data: {
                book_id: book_id,
                _token: _token
            },
            success: function (result) {
                $('.detali_bookname').html(result);
            }
        })

        $.ajax({
            url: "{{route('car.selectbooknum')}}",
            method: "GET",
            data: {
                book_id: book_id,
                _token: _token
            },
            success: function (result) {
                $('.detali_booknum').html(result);
            }
        })

        $.ajax({
            url: "{{route('car.selectbookdate')}}",
            method: "GET",
            data: {
                book_id: book_id,
                _token: _token
            },
            success: function (result) {
                $('.detali_bookdate').html(result);
            }
        })

        $('#modalbook').modal('hide');

    }



    $(document).ready(function () {

        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: true,
            language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
            thaiyear: true,
            autoclose: true //Set เป็นปี พ.ศ.
        }); //กำหนดเป็นวันปัจุบัน
    });





    function chkNumber(ele) {
        var vchar = String.fromCharCode(event.keyCode);
        if ((vchar < '0' || vchar > '9')) return false;
        ele.onKeyPress = vchar;
    }

    function chkmunny(ele) {
        var vchar = String.fromCharCode(event.keyCode);
        if ((vchar < '0' || vchar > '9') && (vchar != '.')) return false;
        ele.onKeyPress = vchar;
    }


    $('body').on('keydown', 'input, select, textarea', function (e) {
        var self = $(this),
            form = self.parents('form:eq(0)'),
            focusable, next;
        if (e.keyCode == 13) {
            focusable = form.find('input,a,select,button,textarea').filter(':visible');
            next = focusable.eq(focusable.index(this) + 1);
            if (next.length) {
                next.focus();
            } else {
                form.submit();
            }
            return false;
        }
    });
</script>

<script>
    $(document).ready(function () {
        $("#myInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });


    //-------------------------------------------------------------------------------------------------------------------------------------------
    function checkreservename() {
        reservename = document.getElementById("RESERVE_NAME").value;
        if (reservename == null || reservename == '') {
            document.getElementById("reservename").style.display = "";
            text_reservename = "*กรุณาระบุเหตุผลขอใช้รถ ";
            document.getElementById("reservename").innerHTML = text_reservename;

        } else {
            document.getElementById("reservename").style.display = "none"
        }
    }


    function checkreservelocationid() {
        reservelocation = document.getElementById("RESERVE_LOCATION_ID").value;
        if (reservelocation == null || reservelocation == '') {
            document.getElementById("reservelocationid").style.display = "";
            text_reservelocation = "*กรุณาระบุสถานที่ไป ";
            document.getElementById("reservelocationid").innerHTML = text_reservelocation;

        } else {
            document.getElementById("reservelocationid").style.display = "none"
        }
    }




    function checkreservebegindate() {
        reservebegindate = document.getElementById("RESERVE_BEGIN_DATE").value;
        if (reservebegindate == null || reservebegindate == '') {
            document.getElementById("reservebegindate").style.display = "";
            text_reservebegindate = "*กรุณาระบุวันที่";
            document.getElementById("reservebegindate").innerHTML = text_reservebegindate;

        } else {
            document.getElementById("reservebegindate").style.display = "none"
        }
    }

    function checkreservebegintime() {
        reservebegintime = document.getElementById("RESERVE_BEGIN_TIME").value;
        if (reservebegintime == null || reservebegintime == '') {
            document.getElementById("reservebegintime").style.display = "";
            text_reservebegintime = "*กรุณาระบุเวลา ";
            document.getElementById("reservebegintime").innerHTML = text_reservebegintime;

        } else {
            document.getElementById("reservebegintime").style.display = "none"
        }
    }



    function checkreserveenddate() {
        reserveenddate = document.getElementById("RESERVE_END_DATE").value;
        if (reserveenddate == null || reserveenddate == '') {
            document.getElementById("reserveenddate").style.display = "";
            text_reserveenddate = "*กรุณาระบุวันที่";
            document.getElementById("reservebegindate").innerHTML = text_reserveenddate;

        } else {
            document.getElementById("reserveenddate").style.display = "none"
        }
    }

    function checkreserveendtime() {
        reserveendtime = document.getElementById("RESERVE_END_TIME").value;
        if (reserveendtime == null || reserveendtime == '') {
            document.getElementById("reserveendtime").style.display = "";
            text_reserveendtime = "*กรุณาระบุเวลา ";
            document.getElementById("reserveendtime").innerHTML = text_reserveendtime;

        } else {
            document.getElementById("reserveendtime").style.display = "none"
        }
    }



    function checkcardriverid() {
        cardriverid = document.getElementById("CAR_DRIVER_ID").value;
        if (cardriverid == null || cardriverid == '') {
            document.getElementById("cardriverid").style.display = "";
            text_cardriverid = "*กรุณาระบุพนักงานขับ";
            document.getElementById("cardriverid").innerHTML = text_cardriverid;

        } else {
            document.getElementById("cardriverid").style.display = "none"
        }
    }

    function checkleaderpersonid() {
        leaderpersonid = document.getElementById("LEADER_PERSON_ID").value;
        if (leaderpersonid == null || leaderpersonid == '') {
            document.getElementById("leaderpersonid").style.display = "";
            text_leaderpersonid = "*กรุณาระบุหัวหน้างานรับรอง ";
            document.getElementById("leaderpersonid").innerHTML = text_leaderpersonid;

        } else {
            document.getElementById("leaderpersonid").style.display = "none"
        }
    }



    $('form').submit(function () {

        var dateFrom = document.getElementById("RESERVE_BEGIN_DATE").value;
        var dateTo = document.getElementById("RESERVE_END_DATE").value;

        var d1 = dateFrom.split("/");
        var d2 = dateTo.split("/");
        var from = new Date(d1[2] - 543 + '-' + d1[1] + '-' + d1[0]);
        var to = new Date(d2[2] - 543 + '-' + d2[1] + '-' + d2[0]);

        // var  result =  console.log(from > to);
        // alert(result);

        if (from > to) {
            alert("กรุณาตรวจสอบความถูกต้องของข้อมูลวันที่ขอใช้รถ !!");
            return false;
        }


    });


    function carcallcheckdate() {
        var date_bigen = document.getElementById("RESERVE_BEGIN_DATE").value;
        var date_end = document.getElementById("RESERVE_END_DATE").value;


        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{route('car.carcallcheckdate')}}",
            method: "GET",
            data: {
                date_bigen: date_bigen,
                date_end: date_end,
                _token: _token
            },
            success: function (result) {
                $('.checkdat').html(result);
            }
        })
    }
</script>


@endsection