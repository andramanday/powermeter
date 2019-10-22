<template>
<div class="row">
    <div class="col-12">
        <div class="alert alert-primary" v-if="message">
            {{ message }}
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Add a New Company</h4>
            </div>
            <div class="card-body">
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Company Name</label>
                    <div class="col-sm-12 col-md-7">
                        <input v-bind:class="{'is-invalid': errors.com_name}" type="text" v-model="com_name" class="form-control" placeholder="Full Name of the Company.">
                        <div class="invalid-feedback" v-if="errors.com_name">
                            <p>{{ errors.com_name[0] }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Company Location</label>
                    <div class="col-sm-12 col-md-7">
                        <input v-bind:class="{'is-invalid': errors.com_location}" type="text" v-model="com_location" class="form-control" placeholder="Location.">
                        <div class="invalid-feedback" v-if="errors.com_location">
                            <p>{{ errors.com_location[0] }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Company Address</label>
                    <div class="col-sm-12 col-md-7">
                        <input v-bind:class="{'is-invalid': errors.com_address}" type="text" v-model="com_address" class="form-control" placeholder="Address.">
                        <div class="invalid-feedback" v-if="errors.com_address">
                            <p>{{ errors.com_address[0] }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Company Status</label>
                    <div class="col-sm-12 col-md-7">
                        <select class="form-control" v-model="com_status" v-bind:class="{'is-invalid': errors.com_status}">
                            <option v-bind:value="0">Deactive</option>
                            <option v-bind:value="1">Active</option>
                        </select>
                        <div class="invalid-feedback" v-if="errors.com_status">
                            <p>{{ errors.com_status[0] }}</p>
                        </div>
                    </div>
                </div>
               <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                    <div class="col-sm-12 col-md-7">
                        <button v-bind:disabled="loading" @click="addCompany" class="btn btn-primary"><span v-if="loading">Adding</span><span v-else>Add</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    mounted() {
            console.log('Component mounted.')
        },
    data() {
        return {
            com_name: '',
            com_location: '',
            com_address: '',
            com_status: '',
            errors: [],
            message: '',
            loading: false
        }
    },
    methods: {
        addCompany() {
            let _this = this;
            _this.errors = [];
            _this.message = '';
            _this.loading = true;
            axios.post(this.$parent.MakeUrl('admin/companies'), {
                    com_name: this.com_name,
                    com_location: this.com_location,
                    com_address: this.com_address,
                    com_status: this.com_status
                }
            ).then((res) => {
                    console.log(this.uid)
                    _this.loading = false;
                    _this.resetForm();
                    _this.message = 'Company has been successfully created!';
                }
            ).catch((err) => {
                    _this.errors = err.response.data.errors;
                    _this.loading = false;
                }
            );
        },
        resetForm() {
            this.com_name = '';
            this.com_location = '';
            this.com_address = '';
            this.com_status = '';
        }
    }
}
</script>
