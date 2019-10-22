@extends('layouts.admin-master')

@section('title')
Dashboard
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Dashboard</h1>
  </div>
  <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="far fa-user"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Devices</h4>
            </div>
            <div class="card-body">
                {{ count($devices) }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="far fa-credit-card"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Cost (Rp,)</h4>
            </div>
            <div class="card-body">
              <h6>{{ number_format($price[0]->cost2) }}</h6>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="far fa-file"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Entries</h4>
            </div>
            <div class="card-body">
              {{ count($total) }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fas fa-circle"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Online Devices</h4>
            </div>
            <div class="card-body">
              {{ count($online) }}
            </div>
          </div>
        </div>
      </div>                  
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
          <div class="card">
            <div class="card-header">
              <h4>Statistics Channel 1</h4>
              <div class="card-header-action">
                <div class="btn-group">
                  <a href="#" class="btn btn-primary">Month</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div id="amperemeter1" style="width:100%; height:400px;"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
          <div class="card">
            <div class="card-header">
              <h4>Statistics Channel 2</h4>
              <div class="card-header-action">
                <div class="btn-group">
                  <a href="#" class="btn btn-primary">Month</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div id="voltmeter1" style="width:100%; height:400px;"></div>
            </div>
          </div>
        </div>
    </div>

  <div class="section-body">
    
  </div>
</section>
@endsection


@section('scripts')
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/modules/export-data.js"></script>

<script type="text/javascript">  
  $.ajax({
    url:'/',
    method:"get",
    dataType: "JSON",
    success:function(json){
      var length = json.datas.length ;
      var kwh1_cost_r = [];
      var kwh1_cost_s = [];
      var kwh1_cost_t = [];
      var kwh2_cost_r = [];
      var kwh2_cost_s = [];
      var kwh2_cost_t = [];
      
      for (var i=0;i<length;i++){
            kwh1_cost_r.push([json.datas[i].created_at,json.datas[i].kwh1_cost_r]);
            kwh1_cost_s.push([json.datas[i].created_at,json.datas[i].kwh1_cost_s]);
            kwh1_cost_t.push([json.datas[i].created_at,json.datas[i].kwh1_cost_t]);
            
            kwh2_cost_r.push([json.datas[i].created_at,json.datas[i].kwh2_cost_r]);
            kwh2_cost_s.push([json.datas[i].created_at,json.datas[i].kwh2_cost_s]);
            kwh2_cost_t.push([json.datas[i].created_at,json.datas[i].kwh2_cost_t]);
      }
          
          // alert(kwh1_cost_s);
    // console.log(panel);

    var d = new Date()
    var n = d.getTimezoneOffset();

    kwh1_cost_r.map((elem) => {
      elem[0] = (new Date(elem[0])).getTime();
      return elem;
    });
    kwh1_cost_s.map((elem) => {
      elem[0] = (new Date(elem[0])).getTime();
      return elem;
    });
    kwh1_cost_t.map((elem) => {
      elem[0] = (new Date(elem[0])).getTime();
      return elem;
    });
    kwh2_cost_r.map((elem) => {
      elem[0] = (new Date(elem[0])).getTime();
      return elem;
    });
    kwh2_cost_s.map((elem) => {
      elem[0] = (new Date(elem[0])).getTime();
      return elem;
    });
    kwh2_cost_t.map((elem) => {
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
        inputEnabled: false,
        enabled: false,
        selected: 4,
        buttons: [{
            type: 'all',
            text: 'All'
        }]
      },

      yAxis: {
        labels: {
          formatter: function () {
              return (this.value > 0 ? ' + ' : '') + this.value + (' Rp ');
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
        data: kwh1_cost_r,
        color: '#ff6384',
        pointStart: 0,
      },{
        name: 'Data S',
        data: kwh1_cost_s,
        color: '#ffcd56'
      },{
        name: 'Data T',
        data: kwh1_cost_t,
        color: '#36a2eb'
      }]

    });

    // Create chart kwh 1 voltmeter
    Highcharts.stockChart('voltmeter1', {

      scrollbar: {
        enabled: false
      },

      rangeSelector: {
        inputEnabled: false,
        enabled: false,
        selected: 4,
        buttons: [{
            type: 'all',
            text: 'All'
        }]
      },

      yAxis: {
        labels: {
          formatter: function () {
              return (this.value > 0 ? ' + ' : '') + this.value + (' Rp ');
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
        data: kwh2_cost_r,
        color: '#ff6384',
        pointStart: 0,
      },{
        name: 'Data S',
        data: kwh2_cost_s,
        color: '#ffcd56'
      },{
        name: 'Data T',
        data: kwh2_cost_t,
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