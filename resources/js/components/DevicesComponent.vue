<template>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Devices <span v-if="total">({{ total }})</span></h4>
                <div class="card-header-action">
                    <a v-bind:href="$parent.MakeUrl('admin/devices/create')" class="btn btn-primary">Add <i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive table-invoice" v-if="!loading">
                    <table class="table table-striped" v-if="devices.length">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Reg. By</th>
                                <th>Reg. Date</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            <tr v-for="device, index in devices">
                                <td>{{ device.dev }}</td>
                                <td>{{ device.dev_loc }}</td>
                                <td>{{ device.name }}</td>
                                <td>{{ device.created_at }}</td>
                                <td v-if="device.status === 'subscribe'"><a v-bind:href="$parent.MakeUrl('admin/devices/unsub/'+device.dev)" class="badge badge-success">subscribe</a> </td>
                                <td v-else><a v-bind:href="$parent.MakeUrl('admin/devices/sub/'+device.dev)" class="badge badge-danger">not subscribe</a> </td>
                                <td class="text-right">
                                    <button @click="deleteUser(device.id, index)" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <a  v-bind:href="$parent.MakeUrl('admin/devices/'+device.id+'/edit')" class="btn btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div v-if="!devices.length" class="text-center p-3 text-muted">
                        <h5>No Results</h5>
                        <p>Looks like you have not added any devices yet!</p>
                    </div>
                </div>
                <div class="text-center p-4 text-muted" v-else>
                    <h5>Loading</h5>
                    <p>Please wait, data is being loaded...</p>
                </div>
            </div>
        </div>
        <div class="text-center" v-if="devices.length && total > devices.length">
            <button v-bind:disabled="loading" @click="loaddevices" class="btn btn-primary"><span v-if="loading">Loading <i class="fas fa-spinner fa-spin"></i></span><span v-else>Load More</span></button>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            devices: [],
            total: 0,
            loading: false,
            loadingmore: false,
            query: '',
            url: ''
        }
    },
    mounted() {
        let query = location.search.split('query=')[1];
        if(query !== undefined) {
            this.query = query;
        }
        this.url = BaseUrl('admin/devices?q='+this.query);
        this.loaddevices();
    },
    methods: {
        loaddevices() {
            let _this = this;
            _this.loading = true;
            axios.get(_this.url).then((res) => {
                _this.devices = _this.devices.concat(res.data.data);
                _this.total = res.data.total;
                _this.loading = false;
                _this.url = res.data.next_page_url;
            }).catch((err) => {
                _this.loading = false;
            });
        },
        deleteUser(dId, index) {
            let _this = this;
            this.$iosConfirm({
                title: 'Are you sure?',
                text: 'The device and their associated data will be permanently deleted. Proceed?'
            }).then(function() {
                axios.delete(_this.$parent.MakeUrl('admin/devices/'+dId)).then((res) => {
                    _this.devices.splice(index, 1);
                    _this.total = _this.total - 1;
                    _this.loaddevices();
                }).catch(error => {
                    _this.$iosAlert({
                        'title': 'Error',
                        'text': error.response.data.message
                    });
                });
            });
        }
    }
}
</script>
