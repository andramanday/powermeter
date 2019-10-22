@extends('layouts.admin-master')

@section('title')
Sensor Graphical
@endsection

@section('style')
<style>
  .preload {
    margin:0;
    position:fixed;
    top:50%;
    left:57%;
    margin-right: -40%;
    transform:translate(-50%, -50%);
  }  

  .main-footer {
      display:none;
    }
  .section {
      display:none;
    }
</style>
@endsection

@section('content')
<div class="preload">
    <div class="text-center p-3 text-muted">
        
        <h5><img src="{{ asset('assets/img/loading.gif') }}" width="50" /> Please wait <img src="{{ asset('assets/img/loading.gif') }}" width="50" /></h5>
    </div>
</div>
<section class="section">
  <div class="section-header">
    <h1>Sensor Graphical ({{$datas[0]->dev}})</h1>
    <div class="section-header-breadcrumb">
      <form action="edit" method="get">
          <div class="input-group mb-3">
      <input type="month" class="form-control" name="datess" value="{{$request->datess}}">
      <div class="input-group-append">
        <button type="submit" class="btn btn-primary">Search <i class="fas fa-luv"></i></button>
      </div>
          </div>
      </form>
    </div>
  </div>
  <div class="section-body">
    @if (count($datas) === 0)
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
              <div class="card-body">
                  <div class="text-center p-3 text-muted">
                      <h5>No Results</h5>
                      <p>Looks like you not selected right month yet!</p>
                  </div>
              </div>
          </div>
        </div>
    </div>        
    @else
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>CHANNEL 1</h4>
              <div class="card-header-action">
                  <a data-collapse="#mycard-amperemeter1" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                </div>
            </div>
            <div class="collapse show" id="mycard-amperemeter1">
              <div class="card-body">

                  <div class="row">
                      <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                          <div class="card-header">
                            <h4>AMPERE METER</h4>
                          </div>
                            <div class="card-body">
                              <div id="amperemeter1" style="width:100%; height:400px;"></div>
                            </div>
                        </div>
                      </div>
                      <div class="col-12 col-md-6 col-lg-6">
                          <div class="card">
                              <div class="card-header">
                                <h4>VOLT METER</h4>
                              </div>
                                <div class="card-body">
                                  <div id="voltmeter1" style="width:100%; height:400px;"></div>
                                </div>
                            </div>
                      </div>
                    </div>
              </div>
              <div class="card-footer pt-0">
                  <div class="row text-center">
                    <div class="col-3 text-danger font-weight-bold">
                      R : Rp, {{ number_format($prices[0]->kwh1_cost_r, 2) }}
                    </div>
                    <div class="col-3 text-warning font-weight-bold">
                      S : Rp, {{ number_format($prices[0]->kwh1_cost_s, 2) }}
                    </div>
                    <div class="col-3 text-info font-weight-bold">
                      T : Rp, {{ number_format($prices[0]->kwh1_cost_t, 2) }}
                    </div>
                    <div class="col-3 font-weight-bold">
                      TOTAL : {{ number_format($prices[0]->kwh1_cost_r+$prices[0]->kwh1_cost_s+$prices[0]->kwh1_cost_t, 2) }}
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
          <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4>CHANNEL 2</h4>
                <div class="card-header-action">
                    <a data-collapse="#mycard-amperemeter2" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
                  </div>
              </div>
              <div class="collapse" id="mycard-amperemeter2">
                <div class="card-body">
  
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                          <div class="card">
                            <div class="card-header">
                              <h4>AMPERE METER</h4>
                            </div>
                              <div class="card-body">
                                <div id="amperemeter2" style="width:100%; height:400px;"></div>
                              </div>
                          </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                  <h4>VOLT METER</h4>
                                </div>
                                  <div class="card-body">
                                    <div id="voltmeter2" style="width:100%; height:400px;"></div>
                                  </div>
                              </div>
                        </div>
                      </div>
                </div>
                <div class="card-footer pt-0">
                  <div class="row text-center ">
                    <div class="col-3 text-danger font-weight-bold">
                      R : Rp, {{ number_format($prices[0]->kwh2_cost_r, 2) }}
                    </div>
                    <div class="col-3 text-warning font-weight-bold">
                      S : Rp, {{ number_format($prices[0]->kwh2_cost_s, 2) }}
                    </div>
                    <div class="col-3 text-info font-weight-bold">
                      T : Rp, {{ number_format($prices[0]->kwh2_cost_t, 2) }}
                    </div>
                    <div class="col-3 font-weight-bold">
                      TOTAL : {{ number_format($prices[0]->kwh2_cost_r+$prices[0]->kwh2_cost_s+$prices[0]->kwh2_cost_t, 2) }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>HISTORIES DATA ({{count($datas)}})</h4>
            <div class="card-header-action">
              <a data-collapse="#mycard-histories" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
            </div>
          </div>
          <div class="collapse" id="mycard-histories">
            <div class="card-body">
              
                <div class="table-responsive">
                    <table class="table table-striped" id="table-2">
                      <thead>
                        <tr>
                          <th rowspan="2">Date</th>
                          <th colspan="6">Channel 1</th>
                          <th colspan="6">Channel 2</th>
                        </tr>
                          <th>AR</th>
                          <th>AS</th>
                          <th>AT</th>
                          <th>VR</th>
                          <th>VS</th>
                          <th>VT</th>
                          <th>AR</th>
                          <th>AS</th>
                          <th>AT</th>
                          <th>VR</th>
                          <th>VS</th>
                          <th>VT</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($datas as $data)
                        <tr>
                          <td>{{ $data->created_at }}</td>
                          <td>{{ $data->kwh1_ar }}</td>
                          <td>{{ $data->kwh1_as }}</td>
                          <td>{{ $data->kwh1_at }}</td>
                          <td>{{ $data->kwh1_vr }}</td>
                          <td>{{ $data->kwh1_vs }}</td>
                          <td>{{ $data->kwh1_vt }}</td>
                          <td>{{ $data->kwh2_ar }}</td>
                          <td>{{ $data->kwh2_as }}</td>
                          <td>{{ $data->kwh2_at }}</td>
                          <td>{{ $data->kwh2_vr }}</td>
                          <td>{{ $data->kwh2_vs }}</td>
                          <td>{{ $data->kwh2_vt }}</td>
                        </tr>                            
                        @endforeach
                      </tbody>
                    </table>
                  </div>
            
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
  </div>
</section>
@endsection

@section('scripts')
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/modules/export-data.js"></script>

<script>
    $(function() {
      $(".preload").fadeOut(1000, function() {
        $(".section").fadeIn(1500);
        $(".main-footer").fadeIn(1500);
      });
    });
  </script> 

<script type="text/javascript">  
  $.ajax({
    url:'',
    method:"get",
    dataType: "JSON",
    success:function(json){

      var pengukuran = 'amperemeter';
      var panel = 'kwh1';

      var length = json.datas.length ;
      $("#temp").text(length);
      var panjang = $("#temp").text();
      var arr_ar1 = [];
      var arr_as1 = [];
      var arr_at1 = [];
      var arr_vr1 = [];
      var arr_vs1 = [];
      var arr_vt1 = [];
      
      var arr_ar2 = [];
      var arr_as2 = [];
      var arr_at2 = [];
      var arr_vr2 = [];
      var arr_vs2 = [];
      var arr_vt2 = [];

      var arr_ep = [];
      var label = [];
      var hours = [];
      var minutes = [];
      var t_ar1 = [];
      var t_ar1;
      var t_ar1;
      var dtt;
      var start = parseInt(panjang)-20;
      for (var i=0;i<length;i++){
            arr_ar1.push([json.datas[i].created_at,json.datas[i].kwh1_ar]);
            arr_as1.push([json.datas[i].created_at,json.datas[i].kwh1_as]);
            arr_at1.push([json.datas[i].created_at,json.datas[i].kwh1_at]);
            
            arr_vr1.push([json.datas[i].created_at,json.datas[i].kwh1_vr]);
            arr_vs1.push([json.datas[i].created_at,json.datas[i].kwh1_vs]);
            arr_vt1.push([json.datas[i].created_at,json.datas[i].kwh1_vt]);
            
            arr_ar2.push([json.datas[i].created_at,json.datas[i].kwh2_ar]);
            arr_as2.push([json.datas[i].created_at,json.datas[i].kwh2_as]);
            arr_at2.push([json.datas[i].created_at,json.datas[i].kwh2_at]);
            
            arr_vr2.push([json.datas[i].created_at,json.datas[i].kwh2_vr]);
            arr_vs2.push([json.datas[i].created_at,json.datas[i].kwh2_vs]);
            arr_vt2.push([json.datas[i].created_at,json.datas[i].kwh2_vt]);
      }
          
          // alert(arr_as1);
    // console.log(panel);

    var d = new Date()
    var n = d.getTimezoneOffset();

    arr_ar1.map((elem) => {
      elem[0] = (new Date(elem[0])).getTime();
      return elem;
    });
    arr_as1.map((elem) => {
      elem[0] = (new Date(elem[0])).getTime();
      return elem;
    });
    arr_at1.map((elem) => {
      elem[0] = (new Date(elem[0])).getTime();
      return elem;
    });
    arr_vr1.map((elem) => {
      elem[0] = (new Date(elem[0])).getTime();
      return elem;
    });
    arr_vs1.map((elem) => {
      elem[0] = (new Date(elem[0])).getTime();
      return elem;
    });
    arr_vt1.map((elem) => {
      elem[0] = (new Date(elem[0])).getTime();
      return elem;
    });

    arr_ar2.map((elem) => {
      elem[0] = (new Date(elem[0])).getTime();
      return elem;
    });
    arr_as2.map((elem) => {
      elem[0] = (new Date(elem[0])).getTime();
      return elem;
    });
    arr_at2.map((elem) => {
      elem[0] = (new Date(elem[0])).getTime();
      return elem;
    });
    arr_vr2.map((elem) => {
      elem[0] = (new Date(elem[0])).getTime();
      return elem;
    });
    arr_vs2.map((elem) => {
      elem[0] = (new Date(elem[0])).getTime();
      return elem;
    });
    arr_vt2.map((elem) => {
      elem[0] = (new Date(elem[0])).getTime();
      return elem;
    });

    Highcharts.setOptions({
      time: {
          timezoneOffset: n
      }
    });

    // Create the chart
    var chart = Highcharts.stockChart('amperemeter1', {

      scrollbar: {
        enabled: false
      },

      rangeSelector: {
        inputEnabled: true,
        enabled: true,
        selected: 4,
        buttons: [{
            type: 'all',
            text: 'All'
        }]
      },

      yAxis: {
        labels: {
          formatter: function () {
              return (this.value > 0 ? ' + ' : '') + this.value + (pengukuran == 'amperemeter' ? ' A ' : ' V ');
          }
        },
        plotLines: [{
          value: 0,
          width: 2,
          color: 'silver'
        }]
      },

      plotOptions: {
        series: {
          compare: 'decimal',
          showInNavigator: true
        }
      },

      tooltip: {
        valueDecimals: 2,
        split: true
      },

      legend: {
        align: 'left',
        verticalAlign: 'top',
        borderWidth: 0, 
      },

      series: [{
        name: 'Data R',
        data: arr_ar1,
        color: '#ff6384',
        pointStart: 0,
      },{
        name: 'Data S',
        data: arr_as1,
        color: '#ffcd56'
      },{
        name: 'Data T',
        data: arr_at1,
        color: '#36a2eb'
      }]

    });

    // Create chart kwh 1 voltmeter
    Highcharts.stockChart('voltmeter1', {

      scrollbar: {
        enabled: false
      },

      rangeSelector: {
        inputEnabled: true,
        enabled: true,
        selected: 4,
        buttons: [{
            type: 'all',
            text: 'All'
        }]
      },

      yAxis: {
        labels: {
          formatter: function () {
              return (this.value > 0 ? ' + ' : '') + this.value + (' V ');
          }
        },
        plotLines: [{
          value: 0,
          width: 2,
          color: 'silver'
        }]
      },

      plotOptions: {
        series: {
          compare: 'decimal',
          showInNavigator: true
        }
      },

      tooltip: {
        valueDecimals: 2,
        split: true
      },

      legend: {
        align: 'left',
        verticalAlign: 'top',
        borderWidth: 0, 
      },

      series: [{
        name: 'Data R',
        data: arr_vr1,
        color: '#ff6384',
        pointStart: 0,
      },{
        name: 'Data S',
        data: arr_vs1,
        color: '#ffcd56'
      },{
        name: 'Data T',
        data: arr_vt1,
        color: '#36a2eb'
      }]

    });

    //Create Chart Amperemeter 2
    Highcharts.stockChart('amperemeter2', {

      scrollbar: {
        enabled: false
      },

      rangeSelector: {
        inputEnabled: true,
        enabled: true,
        selected: 4,
        buttons: [{
            type: 'all',
            text: 'All'
        }]
      },

      yAxis: {
        labels: {
          formatter: function () {
              return (this.value > 0 ? ' + ' : '') + this.value + (pengukuran == 'amperemeter' ? ' A ' : ' V ');
          }
        },
        plotLines: [{
          value: 0,
          width: 2,
          color: 'silver'
        }]
      },

      plotOptions: {
        series: {
          compare: 'decimal',
          showInNavigator: true
        }
      },

      tooltip: {
        valueDecimals: 2,
        split: true
      },

      legend: {
        align: 'left',
        verticalAlign: 'top',
        borderWidth: 0, 
      },

      series: [{
        name: 'Data R',
        data: arr_ar2,
        color: '#ff6384',
        pointStart: 0,
      },{
        name: 'Data S',
        data: arr_as2,
        color: '#ffcd56'
      },{
        name: 'Data T',
        data: arr_at2,
        color: '#36a2eb'
      }]

      });

      // Create chart kwh 2 voltmeter
    Highcharts.stockChart('voltmeter2', {

      scrollbar: {
        enabled: false
      },

      rangeSelector: {
        inputEnabled: true,
        enabled: true,
        selected: 4,
        buttons: [{
            type: 'all',
            text: 'All'
        }]
      },

      yAxis: {
        labels: {
          formatter: function () {
              return (this.value > 0 ? ' + ' : '') + this.value + (' V ');
          }
        },
        plotLines: [{
          value: 0,
          width: 2,
          color: 'silver'
        }]
      },

      plotOptions: {
        series: {
          compare: 'decimal',
          showInNavigator: true
        }
      },

      tooltip: {
        valueDecimals: 2,
        split: true
      },

      legend: {
        align: 'left',
        verticalAlign: 'top',
        borderWidth: 0, 
      },

      series: [{
        name: 'Data R',
        data: arr_vr2,
        color: '#ff6384',
        pointStart: 0,
      },{
        name: 'Data S',
        data: arr_vs2,
        color: '#ffcd56'
      },{
        name: 'Data T',
        data: arr_vt2,
        color: '#36a2eb'
      }]

      });

  },
    error:function (xhr, ajaxOptions){
      if(xhr.status==404) {
        Swal.fire(
        'Gagal',
        'History Tidak Tersedia',
        'error'
        )
      }
    }
});
</script>
    
@endsection