@extends('layouts.admin-master')

@section('title')
Manage Sensor
@endsection

@section('content')
<section class="section">
  
  <div class="section-body">
      <div class="row">
          <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
              <form name="search" action="{{ url()->current() }}">
              <div class="card-header">
                <h4>Sensor List</h4>
                  {{-- <a href="phonebook/create" class="btn btn-sm btn-success mr-2"><i class="fa fa-plus"></i> Tambah</a>
                  <button type="button" class="btn btn-sm btn-danger mr-2" id="bulk_delete_contact"><i class="fa fa-trash"></i> Delete</button> --}}
                  
                  <h4></h4>
                  <div class="card-header-form">
                      <div class="input-group">
                        <div class="float-left ml-2">
                        </div>
                        <input type="text" class="form-control" placeholder="Search" id="keyword" name="keyword">
                        <div class="input-group-btn">
                          <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                          
                          <div class="float-right ml-2">
                              <select class="form-control-sm" style=" width:80px" name="total" id="total" onchange="getval(this);"> 
                                  <option value="20">20</option>
                                  <option value="50">50</option>
                                  <option value="100">100</option>
                                  <option value="250">250</option>
                                  <option value="500">500</option>
                                </select>
                            </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
      </div>
    <div class="row">
      
        @foreach ($sensors as $item)
      <div class="col-12 mb-2">
          <a href="sensor/{{$item->dev}}/detail" class="btn btn-outline btn-block btn-white bg-white"  style="border-color:#5d9cec;">
            <div class="row">
              <div class="col-12 col-md-4">
                <table class="table table-sm">
                  <thead>
                    <tr> 
                      <th rowspan="2">Devices</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td style="padding:28px">{{$item->dev}}<br>{{$item->loc}}<br>Status : ON</td>
                    </tr>
                    <tr>
                  </table>
              </div>  
              <div class="col-12 col-md-4">
                <table class="table table-sm">
                    <thead>
                        <tr>
                          <th colspan="5">KWH 1</th>
                        </tr>
                        <tr>
                            <th scope="col">TYPE</th>
                            <th scope="col" style="color:#f05050">R</th>
                            <th scope="col" style="color:#ff902b">S</th>
                            <th scope="col" style="color:#36a2eb">T</th>
                          </tr>
                      </thead>
                  <tbody>
                      <tr>
                        <td>Amperemeter</td>
                        <td style="color:#f05050">{{$item->kwh1_ar}}</td>
                        <td style="color:#ff902b">{{$item->kwh1_as}}</td>
                        <td style="color:#36a2eb">{{$item->kwh1_at}}</td>
                      </tr>
                      <tr>
                        <td>Amperemeter</td>
                        <td style="color:#f05050">{{$item->kwh1_vr}}</td>
                        <td style="color:#ff902b">{{$item->kwh1_vs}}</td>
                        <td style="color:#36a2eb">{{$item->kwh1_vt}}</td>
                      </tr>    
                      <tr>
                        <td>Biaya (Rp).</td>
                        <td style="color:#f05050">{{number_format($item->kwh1_cost_r, 2)}}</td>
                        <td style="color:#ff902b">{{number_format($item->kwh1_cost_s, 2)}}</td>
                        <td style="color:#36a2eb">{{number_format($item->kwh1_cost_t, 2)}}</td>
                      </tr>
                  </table>
              </div>  
              <div class="col-12 col-md-4">
                  <table class="table table-sm">
                      <thead>
                          <tr>
                            <th colspan="5">KWH 2</th>
                          </tr>
                          <tr>
                              <th scope="col">TYPE</th>
                              <th scope="col" style="color:#f05050">R</th>
                              <th scope="col" style="color:#ff902b">S</th>
                              <th scope="col" style="color:#36a2eb">T</th>
                            </tr>
                        </thead>
                    <tbody>
                        <tr>
                          <td>Amperemeter</td>
                          <td style="color:#f05050">{{$item->kwh2_ar}}</td>
                          <td style="color:#ff902b">{{$item->kwh2_as}}</td>
                          <td style="color:#36a2eb">{{$item->kwh2_at}}</td>
                        </tr>
                        <tr>
                          <td>Amperemeter</td>
                          <td style="color:#f05050">{{$item->kwh2_vr}}</td>
                          <td style="color:#ff902b">{{$item->kwh2_vs}}</td>
                          <td style="color:#36a2eb">{{$item->kwh2_vt}}</td>
                        </tr>    
                        <tr>
                          <td>Biaya (Rp).</td>
                          <td style="color:#f05050">{{number_format($item->kwh2_cost_r, 2)}}</td>
                          <td style="color:#ff902b">{{number_format($item->kwh2_cost_s, 2)}}</td>
                          <td style="color:#36a2eb">{{number_format($item->kwh2_cost_t, 2)}}</td>
                        </tr>
                    </table>
              </div>  
            </div>  
          </a>
      </div>
      @endforeach
        </div>
          {{-- <div class="text-center" v-if="users.length && total > users.length">
              <button v-bind:disabled="loading" @click="loadUsers" class="btn btn-primary"><span v-if="loading">Loading <i class="fas fa-spinner fa-spin"></i></span><span v-else>Load More</span></button>
          </div> --}}
      </div>
    </div>
  </div>
  
  <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4></h4>
                <div class="card-header-form">
                    <div class="input-group">
                      <div class="float-left ml-2">
                      </div>
                      {{-- <input type="text" class="form-control" placeholder="Search" id="keyword" name="keyword"> --}}
                      <div class="input-group-btn">
                        {{-- <button class="btn btn-primary"><i class="fas fa-search"></i></button> --}}
                        
                        <div class="float-right ml-2">
                            <nav class="d-inline-block">
                                {{ $sensors->links() }}
                            </nav>
                          </div>
                      </div>
                    </div>
                </div>
              </div>
  </div>

</section>
@endsection


@section('scripts')
  <script>
    $(document).ready(function(){
        setInterval(function(){
          $.ajax({
              url:"{{route('admin.sensor')}}",
              type:'GET',
              dataType:'json',
              success:function(response){
                if(response.tasks.length>0){
                    var tasks ='';
                    for(var i=0;i<response.tasks.length;i++){
                      sensors=sensors+'<li>'+response.sensors[i]['body']+'</li>';
                    }
                    $('#tabellist').empty();
                    $('#tabellist').append(tasks);
                }
              },error:function(err){

              }
          })
        }, 5000);
    });

    function getval(sel)
    {
        document.search.submit();
    }
    $("#total option[value={{$request->total}}]").attr('selected', 'selected');
  </script>
@endsection