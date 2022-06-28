@extends('layouts.backend')

<style>
    .table-cont {
        /**make table can scroll**/
        max-height: 300px;
        overflow: auto;
        /** add some style**/
        /*padding: 2px;*/
        background: #ddd;
        margin: 20px 10px;
        box-shadow: 0 0 1px 3px #ddd;
    }


    .text-pedding {
        padding-left: 10px;
    }

    .text-font {
        font-size: 14px;
    }

</style>

@section('content')
    <script>
        function checklogin() {
            window.location.href = '{{ route('index') }}';
        }
    </script>
    <?php
    if (Auth::check()) {
        $status = Auth::user()->status;
        $id_user = Auth::user()->PERSON_ID;
    } else {
        echo "<body onload=\"checklogin()\"></body>";
        exit();
    }
    $NAME_USER = Auth::user()->name;
    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    
    if ($status == 'ADMIN') {
        $user_id = substr($url, $pos);
    } else {
        $user_id = $id_user;
    }
    
    use App\Http\Controllers\DashboardController;
    
    $checkbook = DashboardController::checkbook($user_id);
    $checkhr = DashboardController::checkhr($user_id);
    $checkcar = DashboardController::checkcar($user_id);
    $checksafe = DashboardController::checksafe($user_id);
    $checkrenomal = DashboardController::checkrenomal($user_id);
    $checkrecom = DashboardController::checkrecom($user_id);
    $checkremedical = DashboardController::checkremedical($user_id);
    $checkleave = DashboardController::checkleave($user_id);
    $checkmeet = DashboardController::checkmeet($user_id);
    
    $checkasset = DashboardController::checkasset($user_id);
    $checksuplies = DashboardController::checksuplies($user_id);
    $checkin = DashboardController::checkin($user_id);
    
    $checkhorg = DashboardController::checkhorg($user_id);
    $checkhdep = DashboardController::checkhdep($user_id);
    $checkhgroupdep = DashboardController::checkhgroupdep($user_id);
    $checkhhealth = DashboardController::checkhhealth($user_id);
    
    //---------com
    
    $checkrisk = DashboardController::checkrisk($user_id);
    $checkaccount = DashboardController::checkaccount($user_id);
    $checkplan = DashboardController::checkplan($user_id);
    $checkwherehouse = DashboardController::checkwherehouse($user_id);
    $checkmpay = DashboardController::checkmpay($user_id);
    $checklaunder = DashboardController::checklaunder($user_id);
    $checkguesthouse = DashboardController::checkguesthouse($user_id);
    $checkenv = DashboardController::checkenv($user_id);
    $checkfood = DashboardController::checkfood($user_id);
    $checkcrm = DashboardController::checkcrm($user_id);
    $checkcompensation = DashboardController::checkcompensation($user_id);
    $checkmedical = DashboardController::checkmedical($user_id);
    
    function Removeformatetime($strtime)
    {
        $H = substr($strtime, 0, 5);
        return $H;
    }
    
    function getMac()
    {
        $d = explode('Physical Address. . . . . . . . .', shell_exec('ipconfig/all'));
        $d1 = explode(':', $d[1]);
        $d2 = explode(' ', $d1[1]);
        return $d2[1];
    }
    ?>
    {{-- <?php echo getMac(); ?> --}}
    <div class="bg-body-light">

        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"></h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <div class="row">


                            @if ($checkhorg != 0)
                                <div>
                                    <a href="{{ url('person_headorg/dashboard') }}" class="btn btn-success"
                                        target="_blank">ผู้อำนวยการ</a>
                                </div>
                                <div>&nbsp;</div>
                                @endif

                                @if($checkhgroupdep != 0)
                                <div >
                                    <a href="{{ url('person_headgroupdep/dashboard')}}" class="btn btn-secondary"  target="_blank">หัวหน้ากลุ่มงาน</a> 
                                    </div>
                                    <div>&nbsp;</div>

                                    @endif
                                
                                 
                            @if($checkhdep != 0)
                              <div >
                                <a href="{{ url('person_headdep/dashboard')}}" class="btn btn-warning"  target="_blank">หัวหน้างาน</a> 
                                </div>
                                <div>&nbsp;</div>
                               
                                @endif
                                <div >
                                <a href="{{ url('person_checkin/personcheckin/'.$id_user)}}" class="btn btn-info" >ลงเวลาปฎิบัติงาน</a> 
                            </div>
                                <div>&nbsp;</div>
                               
                       
                

{{-- 
                                <div >
                                    <a href="{{ url('e_learning/dashboard/')}}" class="btn btn-warning"   target="_blank">E-learning</a> 
                                    </div>
                                    <div>&nbsp;</div>  

                                    <div >
                                <a  type="button"  class="btn btn-success push" href="{{ url('person_happynet/insert_modal_day_user') }}"  target="_blank">ความสุขของบุคลากร</a>
                            </div>
                            <div>&nbsp;</div> --}}

           
                                



                        

                                </div>
                    </ol>
                </nav>
            </div>
        </div>
    </div>   


    <center>
        <div style="max-width:90%;">



            <div class="row">

                @if ($checkhr != 0)
                    <div class="col-6 col-md-4 col-xl-2">
                        <a class="block block-link-pop text-center" href="{{ url('manager_person/dashboard') }}"
                            target="_blank">
                            <div
                                class="block-content block-content-full aspect-ratio-4-3 d-flex justify-content-center align-items-center">
                                <div>
                                    <i class="fa fa-3x fa-users text-info"></i>
                                    <div class="font-w600 mt-2 text-dark" style="font-size: 15px;">บุคลากร</div>
                                </div>
                            </div>
                        </a>
                    </div>

                @endif

                @if ($checkasset != 0)
                    <div class="col-6 col-md-4 col-xl-2">
                        <a class="block block-link-pop text-center" href="{{ url('manager_asset/dashboard') }}"
                            target="_blank">
                            <div
                                class="block-content block-content-full aspect-ratio-4-3 d-flex justify-content-center align-items-center">
                                <div>

                                    <i class="fa fa-3x fa-boxes text-info"></i>
                                    <div class="font-w600 mt-2 text-dark" style="font-size: 15px;">งานทรัพย์สิน</div>
                                </div>
                            </div>
                        </a>
                    </div>

                @endif
            </div>

            <div style="max-width:100%;">
                @foreach ($imgpresents as $imgpresent)
                    <img class="mySlides"
                        src="data:image/png;base64,{{ chunk_split(base64_encode($imgpresent->IMG)) }}"
                        style="width:100%;height: 300px;">
                @endforeach
            </div>
            <br>

            <div class="row">
                <div class="col-sm-6">
                    <div class="block block-themed">
                        <div class="block-header bg-warning">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;">ประชุมวันนี้</h3>
                            <div class="block-options">

                            </div>
                        </div>
                        <div class="block-content">
                            <div class='table-cont' id='table-cont'>
                                <table class="table table-striped ">
                                    <thead style="background-color: #FFEBCD;">
                                        <tr height="40">
                                            <th class="text-font" style="border-color:#F0FFFF;text-align: center;">
                                                เรื่อง</th>
                                            <th class="text-font" style="border-color:#F0FFFF;text-align: center;">
                                                ห้อง</th>
                                            <th class="text-font" style="border-color:#F0FFFF;text-align: center;"
                                                width="25%">
                                                เวลา</th>
                                            <th class="text-font" style="border-color:#F0FFFF;text-align: center;"
                                                width="10%">
                                                สถานะ</th>
                                        </tr>
                                    </thead>



                                    <tbody>

                                        @foreach ($meetingrooms as $meetingroom)
                                            <?php
                                            $status = $meetingroom->STATUS;
                                            if ($status === 'REQUEST') {
                                                $statuscol = 'badge badge-warning';
                                                $STATUS_NAME = 'ร้องขอ';
                                            } elseif ($status === 'SUCCESS') {
                                                $statuscol = 'badge badge-success';
                                                $STATUS_NAME = 'อนุมัติ';
                                            } elseif ($status === 'NOTSUCCESS') {
                                                $statuscol = 'badge badge-danger';
                                                $STATUS_NAME = 'ไม่อนุมัติ';
                                            } elseif ($status === 'INFORM') {
                                                $statuscol = 'badge badge-dark';
                                                $STATUS_NAME = 'แจ้งยกเลิก';
                                            } elseif ($status === 'LASTAPP') {
                                                $statuscol = 'badge badge-success';
                                                $STATUS_NAME = 'ผอ.อนุมัติ';
                                            } elseif ($status === 'NOTLASTAPP') {
                                                $statuscol = 'badge badge-secondary';
                                                $STATUS_NAME = 'ผอ.ไม่อนุมัติ';
                                            } elseif ($status === 'CANCEL') {
                                                $statuscol = 'badge badge-secondary';
                                                $STATUS_NAME = 'ยกเลิก';
                                            }
                                            
                                            ?>
                                            <tr height="40">
                                                <td class="text-font text-pedding">{{ $meetingroom->SERVICE_STORY }}</td>
                                                <td class="text-font text-pedding">{{ $meetingroom->ROOM_NAME }}</td>
                                                <td class="text-font text-pedding">
                                                    {{ formatetime($meetingroom->TIME_BEGIN) }}-{{ formatetime($meetingroom->TIME_END) }}
                                                </td>

                                                <td align="center"><span
                                                        class="{{ $statuscol }}">{{ $STATUS_NAME }}</span></td>


                                            </tr>
                                        @endforeach



                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="block block-themed">
                        <div class="block-header bg-info">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;">การใช้รถยนต์</h3>
                            <div class="block-options">

                            </div>
                        </div>
                        <div class="block-content">
                            <div class='table-cont' id='table-cont2'>
                                <table class="table table-striped">

                                    <thead style="background-color: #FFEBCD;">
                                        <tr height="40">
                                            <th class="text-font" style="border-color:#F0FFFF;text-align: center;">
                                                ทะเบียน</th>
                                            <th class="text-font" style="border-color:#F0FFFF;text-align: center;">
                                                สถานที่ไป
                                            </th>
                                            <th class="text-font" style="border-color:#F0FFFF;text-align: center;">
                                                คนขับ</th>
                                            <th class="text-font" style="border-color:#F0FFFF;text-align: center;"
                                                width="25%">
                                                เวลา</th>
                                            <th class="text-font" style="border-color:#F0FFFF;text-align: center;"
                                                width="10%">
                                                สถานะ</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @foreach ($meetingcars as $meetingcar)
                                            <tr height="40">
                                                <td class="text-font text-pedding">{{ $meetingcar->CAR_REG }}</td>
                                                <td class="text-font text-pedding">{{ $meetingcar->LOCATION_ORG_NAME }}
                                                </td>
                                                <td class="text-font text-pedding">{{ $meetingcar->CAR_DRIVER_NAME }}</td>
                                                <td class="text-font text-pedding">
                                                    {{ formatetime($meetingcar->RESERVE_BEGIN_TIME) }}-{{ formatetime($meetingcar->RESERVE_END_TIME) }}
                                                </td>
                                                @if ($meetingcar->STATUS == 'CANCEL')
                                                    <td align="center"><span class="badge badge-danger">ยกเลิก</span></td>
                                                @elseif($meetingcar->STATUS == 'RECERVE')
                                                    <td align="center"><span class="badge badge-warning">ร้องขอ</span></td>
                                                @elseif($meetingcar->STATUS == 'REGROUP')
                                                    <td align="center"><span class="badge badge-info">อนุมัติร่วม</span>
                                                    </td>
                                                @elseif($meetingcar->STATUS == 'SUCCESS')
                                                    <td align="center"><span class="badge badge-success">อนุมัติ</span>
                                                    </td>
                                                @else
                                                    <td class="text-font" align="center"></td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="block">
                        <div class="block-header bg-success">
                            <div class="block-title fw-4" style="color: rgba(255, 255, 255, 0.9);">
                                ข่าวประชาสัมพันธ์
                            </div>
                        </div>
                        <div class="block-content">
                            @if (!empty($publicize))
                                @foreach ($publicize as $row)
                                    <a class="block block-rounded block-link-pop py-3 shadow" target="_blank"
                                        href="{{ $row->IPUB_LINK }}">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-2 p-1 d-flex justify-content-center align-items-center">
                                                    <div class="card" width="100%">
                                                        <div class="text-sl-r3 fw-b fs-16">
                                                            {{ shortMonthThai(date('m', strtotime($row->IPUB_DATE))) }}
                                                        </div>
                                                        <hr class="m-1">
                                                        <div class="fw-b fs-20">
                                                            {{ date('d', strtotime($row->IPUB_DATE)) }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3" style="over-flow:hidden">
                                                    @if (empty($row->IPUB_IMG))
                                                        <img id="image_upload_preview"
                                                            src="{{ asset('image/information_publicize.png') }}"
                                                            width="100%">
                                                    @else
                                                        <img id="image_upload_preview"
                                                            src="data:image/jpeg;base64,{{ chunk_split(base64_encode($row->IPUB_IMG)) }}"
                                                            width="100%">
                                                    @endif
                                                </div>
                                                <div class="col-7 text-left">
                                                    <h3 class="mb-1 fw-b">{{ $row->IPUB_NAME }}</h3>
                                                    <p>
                                                        {{ $row->IPUB_DETAIL }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                @if (!empty($page_facebook->IFP_DATASHOW))
                    <div class="col-sm-4">
                        <div class="block">
                            <div class="block-content pb-4" id="reload_page_face">
                                <?= $page_facebook->IFP_DATASHOW ?>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        </ceneter>

        <script>
            $(window).resize(function() {
                $('#reload_page_face').html('<?= $page_facebook ? $page_facebook->IFP_DATASHOW : '' ?>');
                FB.XFBML.parse();
            });
        </script>
        <?= $page_facebook ? $page_facebook->IFP_PLUGIN : '' ?>
        <script>
            var myIndex = 0;
            carousel();

            function carousel() {
                var i;
                var x = document.getElementsByClassName("mySlides");
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                myIndex++;
                if (myIndex > x.length) {
                    myIndex = 1
                }
                x[myIndex - 1].style.display = "block";
                setTimeout(carousel, 5000); // Change image every 2 seconds
            }
        </script>
        <script>
            // Code goes here

            window.onload = function() {
                var tableCont = document.querySelector('#table-cont')
                var tableCont2 = document.querySelector('#table-cont2')
                /**
                 * scroll handle
                 * @param {event} e -- scroll event
                 */
                function scrollHandle(e) {
                    var scrollTop = this.scrollTop;
                    this.querySelector('thead').style.transform = 'translateY(' + scrollTop + 'px)';
                }

                tableCont.addEventListener('scroll', scrollHandle)
                tableCont2.addEventListener('scroll', scrollHandle)
            }
        </script>
    @endsection
