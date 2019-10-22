<template>
<div class="row">
   <div class="col-md-4" v-for="sensor, index in sensors">
     <div class="card">
       <div class="card-header text-center text-muted p-0">
             <h4 class="col-12 text-muted"><i class="fas fa-tablet"></i> {{sensor.dev}}<br><i class="fas fa-map-pin"></i> {{sensor.dev_loc}}</h4>
       </div>
       <div class="card-body pl-1 pr-1 pt-0">
         <div v-if="!loading">
            <table class="table table-striped table-sm" v-if="sensors.length">
                <thead class="text-muted">
                  <th scope="col">TYPE</th>
                  <th scope="col" style="color:#f05050">R</th>
                  <th scope="col" style="color:#ff902b">S</th>
                  <th scope="col" style="color:#36a2eb">T</th>
                </thead>
                <tBody class="text-muted">
                  <tr>
                    <td class="center">Ampere(1)</td>
                    <td style="color:#f05050">{{ formatPrice(sensor.kwh1_ar) }}</td>
                    <td style="color:#ff902b">{{ formatPrice(sensor.kwh1_as) }}</td>
                    <td style="color:#36a2eb">{{ formatPrice(sensor.kwh1_at) }}</td>
                  </tr>
                  <tr>
                    <td>Voltmeter(1)</td>
                    <td style="color:#f05050">{{ sensor.kwh1_vr }}</td>
                    <td style="color:#ff902b">{{ sensor.kwh1_vs }}</td>
                    <td style="color:#36a2eb">{{ sensor.kwh1_vt }}</td>
                  </tr>
                  <tr>
                    <td>Ampere(2)</td>
                    <td style="color:#f05050">{{ formatPrice(sensor.kwh2_ar) }}</td>
                    <td style="color:#ff902b">{{ formatPrice(sensor.kwh2_as) }}</td>
                    <td style="color:#36a2eb">{{ formatPrice(sensor.kwh2_at) }}</td>
                  </tr>
                  <tr>
                    <td>Voltmeter(2)</td>
                    <td style="color:#f05050">{{ sensor.kwh2_vr }}</td>
                    <td style="color:#ff902b">{{ sensor.kwh2_vs }}</td>
                    <td style="color:#36a2eb">{{ sensor.kwh2_vt }}</td>
                  </tr>
                </tbody>
            </table>
            <div v-if="!sensors.length" class="text-center p-3 text-muted">
                <h5>No Results</h5>
                <p>Looks like you have not added any sensors yet!</p>
            </div>
         </div>
         <div class="text-center p-4 text-muted" v-else>
              <h5>Loading</h5>
              <p>Please wait, data is being loaded...</p>
          </div>
       </div>
       <div class="card-footer text-center p-0 pb-3">
         updated at: <span class="badge badge-success"> {{ sensor.updated_at }}</span> <span v-if="sensor.status=='subscribe'" class="badge badge-success">{{ sensor.status }} </span><span v-else class="badge badge-danger">{{ sensor.status }} </span>
         
         <a class="badge badge-primary"  v-bind:href="$parent.MakeUrl('admin/sensors/'+sensor.dev+'/edit')">detail</a>
         <!-- <button class="btn btn-danger"> test </button> -->
       </div>
     </div>
   </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            sensors: [],
            total: 0,
            loading: false,
            loadingmore: false,
            query: '',
            url: '',
            timer: ''
        }
    },
    mounted: function () {
      let query = location.search.split('query=')[1];
      if(query !== undefined) {
          this.query = query;
      }
      this.url = BaseUrl('admin/sensors?q='+this.query);
      this.loadsensors();
      this.interval = setInterval(function () {
          this.loadsensors();
      }.bind(this), 3000);
    },    
    methods: {
        loadsensors: function() {
            let _this = this;
            _this.loading = true;
            axios.get(_this.url).then((res) => {
                _this.sensors = _this.sensors.concat(res.data.data);
                _this.total = res.data.total;
                _this.loading = false;
                _this.url = res.data.next_page_url;
            }).catch((err) => {
                _this.loading = false;
            });
        },
        deleteUser(sensorId, index) {
            let _this = this;
            this.$iosConfirm({
                title: 'Are you sure?',
                text: 'The sensor and their associated data will be permanently deleted. Proceed?'
            }).then(function() {
                axios.delete(_this.$parent.MakeUrl('admin/sensors/'+sensorId)).then((res) => {
                    _this.sensors.splice(index, 1);
                    _this.total = _this.total - 1;
                    _this.loadsensors();
                }).catch(error => {
                    _this.$iosAlert({
                        'title': 'Error',
                        'text': error.response.data.message
                    });
                });
            });
        },
        formatPrice(value) {
            let val = (value/1).toFixed(2).replace('.', ',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        }
    }
}
</script>
