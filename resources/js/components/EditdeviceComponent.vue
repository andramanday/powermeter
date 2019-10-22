<template>
<div class="row">
    <div class="col-12">
        <div class="alert alert-primary" v-if="message">
            {{ message }}
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Update Profile</h4>
            </div>
            <div class="card-body">
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Company Name</label>
                    <div class="col-sm-12 col-md-7">
                        <input v-bind:class="{'is-invalid': errors.dev}" type="text" v-model="dev" class="form-control" disabled>
                        <div class="invalid-feedback" v-if="errors.dev">
                            <p>{{ errors.dev[0] }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Location</label>
                    <div class="col-sm-12 col-md-7">
                        <input v-bind:class="{'is-invalid': errors.dev_loc}" type="text" v-model="dev_loc" class="form-control">
                        <div class="invalid-feedback" v-if="errors.dev_loc">
                            <p>{{ errors.dev_loc[0] }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                    <div class="col-sm-12 col-md-7">
                        <button v-bind:disabled="loading" @click="updateDevice" class="btn btn-primary"><span v-if="loading">Updating</span><span v-else>Update</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['device'],
    data() {
        return {
            dev: this.getDevicedata('dev'),
            dev_loc: this.getDevicedata('dev_loc'),
            errors: [],
            message: '',
            loading: false
        }
    },
    methods: {
        getDevicedata(key) {
            return JSON.parse(this.device)[key];
        },
        updateDevice() {
            let _this = this;
            _this.errors = [];
            _this.message = '';
            _this.loading = true;
            axios.post(this.$parent.MakeUrl('admin/devices/'+this.getDevicedata('id')), {'dev': this.dev, 'dev_loc': this.dev_loc, '_method': 'PATCH'}).then((res) => {
                _this.loading = false;
                _this.message = 'Company details have been updated successfully!';
            }).catch((err) => {
                _this.errors = err.response.data.errors;
                _this.loading = false;
            });
        }
    }
}
</script>
