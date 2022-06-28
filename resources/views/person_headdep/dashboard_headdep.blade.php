@extends('layouts.headdep')

@section('css_before')
<link rel="stylesheet" href="{{asset('css/1.10.24.css.jquery.dataTables.css')}}">
<?php
  $status = Auth::user()->status; 
  $id_user = Auth::user()->PERSON_ID; 
  $url = Request::url();
  $pos = strrpos($url, '/') + 1;
  $user_id = substr($url, $pos); 
use App\Http\Controllers\ManagerleaveController;
    $m_budget = date("m");
    if($m_budget>9){
    $yearbudget = date("Y")+544;
    }else{
    $yearbudget = date("Y")+543;
    }
?>
<style>
</style>
@endsection
@section('content')
<div class="block mt-5 my-3 shadow" style="width: 95%;margin:auto">
      
        <div class="block-content">
        <h3 class="fs-18 fw-5">ข้อมูลแผนภูมิการลา</h3>
            <div class="row">
                <div class="col-md-6 mb-2">
                    <div class="panel p-1 bg-sl-b2">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">จำนวนการลาทั้งหมด</div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="columnchart_leave" style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel p-1 bg-sl2-r2">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">จำนวนการลาป่วย</div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="sick_curve_chart" style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel p-1 bg-sl2-sb2">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">จำนวนการลากิจ</div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="business_curve_chart" style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel p-1 bg-sl2-g2">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">จำนวนการลาพักผ่อน</div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="curve_chart" style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{-- <div class="block my-4" style="width: 95%;margin:auto;">
    <div class="block block-content">
        <h3 class="block-title fs-18">สรุปข้อมูลการลาประจำปีงบประมาณ {{$budgetyear}} (ครั้ง)</h3>
        <div class="table-responsive my-3" style="margin:auto">
            <table id="table" class=" table table-sl-border table-sl-header-center table-striped" style="width:100%">
                <thead class="bg-sl2-b4 text-white" style="border:1px solid #000">
                    <tr height="40">
                        <th width="20%" class="text-center py-1" style="width: 150px;">ปรเะเภทการลา</th>
                        <th class="text-center py-1">ต.ค.</th>
                        <th class="text-center py-1">พ.ย.</th>
                        <th class="text-center py-1">ธ.ค.</th>
                        <th class="text-center py-1">ม.ค.</th>
                        <th class="text-center py-1">ก.พ.</th>
                        <th class="text-center py-1">มี.ค.</th>
                        <th class="text-center py-1">เม.ย.</th>
                        <th class="text-center py-1">พ.ค.</th>
                        <th class="text-center py-1">มิ.ย.</th>
                        <th class="text-center py-1">ก.ค.</th>
                        <th class="text-center py-1">ส.ค.</th>
                        <th class="text-center py-1">ก.ย.</th>
                        <th class="text-center py-1">รวม</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach($Leaveperson as $row)
                    <tr height="20">
                        <td class="text-font text-left py-1">{{$row['name']}}</td>
                        <td class="text-font text-center py-1">{{$row[10]}}</td>
                        <td class="text-font text-center py-1">{{$row[11]}}</td>
                        <td class="text-font text-center py-1">{{$row[12]}}</td>
                        <td class="text-font text-center py-1">{{$row[1]}}</td>
                        <td class="text-font text-center py-1">{{$row[2]}}</td>
                        <td class="text-font text-center py-1">{{$row[3]}}</td>
                        <td class="text-font text-center py-1">{{$row[4]}}</td>
                        <td class="text-font text-center py-1">{{$row[5]}}</td>
                        <td class="text-font text-center py-1">{{$row[6]}}</td>
                        <td class="text-font text-center py-1">{{$row[7]}}</td>
                        <td class="text-font text-center py-1">{{$row[8]}}</td>
                        <td class="text-font text-center py-1">{{$row[9]}}</td>
                        <td class="text-font text-center py-1">{{$row['total']}}</td>
                    </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div> --}}
@endsection
@section('footer')
<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('google/Charts.js?v='.time()) }}"></script>
<script type="text/javascript" charset="utf8" src="{{asset('js/1.10.24.js.jquery.dataTables.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#table').DataTable({
            info: false,
            "order": [[ 13, "desc" ]],
            // "bPaginate": false,
            // "bLengthChange": false,
            "iDisplayLength": 25,
            // "bFilter": false,
            // "bInfo": false,
            // "bAutoWidth": false,
            // "paging": false,
        });
    });
</script>
<script type="text/javascript">
    google.load("visualization", "1", {
        packages: ["corechart"]
    });
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ['เดือน','จำนวนครั้ง'],
        ['ต.ค', <?php echo $sickLeaveperson[10];?>],
        ['พ.ย', <?php echo $sickLeaveperson[11]; ?>],
        ['ธ.ค', <?php echo  $sickLeaveperson[12];?>],
        ['ม.ค', <?php echo $sickLeaveperson[1]; ?>],
        ['ก.พ', <?php echo $sickLeaveperson[2]; ?>],
        ['มี.ค', <?php echo $sickLeaveperson[3];?>],
        ['เม.ย', <?php echo $sickLeaveperson[4];?>],
        ['พ.ค', <?php echo $sickLeaveperson[5];?>],
        ['มิ.ย', <?php echo $sickLeaveperson[6];?>],
        ['ก.ค', <?php echo $sickLeaveperson[7];?>],
        ['ส.ค', <?php echo $sickLeaveperson[8];?>],
        ['ก.ย', <?php echo $sickLeaveperson[9];?>]
        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            }
        ]);
      var options = {
            fontName: 'Kanit',
            fontSize: 16,
            width: "100%",
            height: '100%',
            legend: {
                position: 'center'
            },
            bar: {
                groupWidth: "80%"
            },
            vAxis: {
                title: 'จำนวนครั้ง',
                titleTextStyle: {
                    italic: false
                }
            },
            hAxis: {
                title: 'เดือน',
                fontName: 'Kanit',
                titleTextStyle: {
                    italic: false
                }
            }
        }; 
        var chart = new google.visualization.ColumnChart(document.getElementById('sick_curve_chart'));
        chart.draw(view, options);
    }
</script>
<script type="text/javascript">
    google.load("visualization", "1", {
        packages: ["corechart"]
    });
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ['เดือน','จำนวนครั้ง'],
        ['ต.ค', <?php echo $businessLeaveperson[10];?>],
        ['พ.ย', <?php echo $businessLeaveperson[11]; ?>],
        ['ธ.ค', <?php echo  $businessLeaveperson[12];?>],
        ['ม.ค', <?php echo $businessLeaveperson[1]; ?>],
        ['ก.พ', <?php echo $businessLeaveperson[2]; ?>],
        ['มี.ค', <?php echo $businessLeaveperson[3];?>],
        ['เม.ย', <?php echo $businessLeaveperson[4];?>],
        ['พ.ค', <?php echo $businessLeaveperson[5];?>],
        ['มิ.ย', <?php echo $businessLeaveperson[6];?>],
        ['ก.ค', <?php echo $businessLeaveperson[7];?>],
        ['ส.ค', <?php echo $businessLeaveperson[8];?>],
        ['ก.ย', <?php echo $businessLeaveperson[9];?>]
        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            }
        ]);
      var options = {
            fontName: 'Kanit',
            fontSize: 16,
            width: "100%",
            height: '100%',
            legend: {
                position: 'center'
            },
            bar: {
                groupWidth: "80%"
            },
            vAxis: {
                title: 'จำนวนครั้ง',
                titleTextStyle: {
                    italic: false
                }
            },
            hAxis: {
                title: 'เดือน',
                fontName: 'Kanit',
                titleTextStyle: {
                    italic: false
                }
            }
        }; 
        var chart = new google.visualization.ColumnChart(document.getElementById('business_curve_chart'));
        chart.draw(view, options);
    }
</script>
<script type="text/javascript">
    google.load("visualization", "1", {
        packages: ["corechart"]
    });
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ['เดือน','จำนวนครั้ง'],
        ['ต.ค', <?php echo $leaveperson[10];?>],
        ['พ.ย', <?php echo $leaveperson[11]; ?>],
        ['ธ.ค', <?php echo  $leaveperson[12];?>],
        ['ม.ค', <?php echo $leaveperson[1]; ?>],
        ['ก.พ', <?php echo $leaveperson[2]; ?>],
        ['มี.ค', <?php echo $leaveperson[3];?>],
        ['เม.ย', <?php echo $leaveperson[4];?>],
        ['พ.ค', <?php echo $leaveperson[5];?>],
        ['มิ.ย', <?php echo $leaveperson[6];?>],
        ['ก.ค', <?php echo $leaveperson[7];?>],
        ['ส.ค', <?php echo $leaveperson[8];?>],
        ['ก.ย', <?php echo $leaveperson[9];?>]
        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            }
        ]);
      var options = {
            fontName: 'Kanit',
            fontSize: 16,
            width: "100%",
            height: '100%',
            legend: {
                position: 'center'
            },
            bar: {
                groupWidth: "80%"
            },
            vAxis: {
                title: 'จำนวนครั้ง',
                titleTextStyle: {
                    italic: false
                }
            },
            hAxis: {
                title: 'เดือน',
                fontName: 'Kanit',
                titleTextStyle: {
                    italic: false
                }
            }
        }; 
        var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_leave'));
        chart.draw(view, options);
    }
</script>
<script type="text/javascript">
    google.load("visualization", "1", {
        packages: ["corechart"]
    });
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ['เดือน','จำนวนครั้ง'],
        ['ต.ค', <?php echo $SummerLeaveperson[10];?>],
        ['พ.ย', <?php echo $SummerLeaveperson[11]; ?>],
        ['ธ.ค', <?php echo  $SummerLeaveperson[12];?>],
        ['ม.ค', <?php echo $SummerLeaveperson[1]; ?>],
        ['ก.พ', <?php echo $SummerLeaveperson[2]; ?>],
        ['มี.ค', <?php echo $SummerLeaveperson[3];?>],
        ['เม.ย', <?php echo $SummerLeaveperson[4];?>],
        ['พ.ค', <?php echo $SummerLeaveperson[5];?>],
        ['มิ.ย', <?php echo $SummerLeaveperson[6];?>],
        ['ก.ค', <?php echo $SummerLeaveperson[7];?>],
        ['ส.ค', <?php echo $SummerLeaveperson[8];?>],
        ['ก.ย', <?php echo $SummerLeaveperson[9];?>]
        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            }
        ]);
      var options = {
            fontName: 'Kanit',
            fontSize: 16,
            width: "100%",
            height: '100%',
            legend: {
                position: 'center'
            },
            bar: {
                groupWidth: "80%"
            },
            vAxis: {
                title: 'จำนวนครั้ง',
                titleTextStyle: {
                    italic: false
                }
            },
            hAxis: {
                title: 'เดือน',
                fontName: 'Kanit',
                titleTextStyle: {
                    italic: false
                }
            }
        }; 
        var chart = new google.visualization.ColumnChart(document.getElementById('curve_chart'));
        chart.draw(view, options);
    }
</script>
@endsection