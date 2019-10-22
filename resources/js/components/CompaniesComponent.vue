<template>
<div class="row" v-if="$parent.userCan('manage-companies')">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Companies <span v-if="total">({{ total }})</span></h4>
                <div class="card-header-action">
                    <a v-if="$parent.userCan('create-companies')" v-bind:href="$parent.MakeUrl('admin/companies/create')" class="btn btn-primary">Add <i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive table-invoice" v-if="!loading">
                    <table class="table table-striped" v-if="companies.length">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <th>Location</th>
                                <th>address</th>
                                <th>status</th>
                                <th>Reg. Date</th>
                                <th></th>
                            </tr>
                            <tr v-for="user, index in companies">
                                <td>{{ user.com_name }}</td>
                                <td>{{ user.com_location }}</td>
                                <td>{{ user.com_address }}</td>
                                <td v-if="user.com_status === '1'"><span class="badge badge-success">Active</span></td><td v-else><span class="badge badge-danger">Deactive</span></td>
                                <td>{{ user.created_at }}</td>
                                <td class="text-right">
                                    <button v-if="$parent.userCan('delete-companies') && !user.isme" @click="deleteUser(user.cid, index)" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <a v-if="$parent.userCan('edit-companies')" v-bind:href="'/admin/companies/'+user.cid+'/edit'" class="btn btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div v-if="!companies.length" class="text-center p-3 text-muted">
                        <h5>No Results</h5>
                        <p>Looks like you have not added any companies yet!</p>
                    </div>
                </div>
                <div class="text-center p-4 text-muted" v-else>
                    <h5>Loading</h5>
                    <p>Please wait, data is being loaded...</p>
                </div>
            </div>
        </div>
        <div class="text-center" v-if="companies.length && total > companies.length">
            <button v-bind:disabled="loading" @click="loadcompanies" class="btn btn-primary"><span v-if="loading">Loading <i class="fas fa-spinner fa-spin"></i></span><span v-else>Load More</span></button>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            companies: [],
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
        this.url = BaseUrl('admin/companies?q='+this.query);
        this.loadcompanies();
    },
    methods: {
        loadcompanies() {
            let _this = this;
            _this.loading = true;
            axios.get(_this.url).then((res) => {
                _this.companies = _this.companies.concat(res.data.data);
                _this.total = res.data.total;
                _this.loading = false;
                _this.url = res.data.next_page_url;
            }).catch((err) => {
                _this.loading = false;
            });
        },
        deleteUser(userId, index) {
            let _this = this;
            this.$iosConfirm({
                title: 'Are you sure?',
                text: 'The user and their associated data will be permanently deleted. Proceed?'
            }).then(function() {
                axios.delete(_this.$parent.MakeUrl('admin/companies/'+userId)).then((res) => {
                    _this.companies.splice(index, 1);
                    _this.total = _this.total - 1;
                    _this.loadcompanies();
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
