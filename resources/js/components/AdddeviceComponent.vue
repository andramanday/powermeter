<template>
<div class="row">
    <div class="col-12">
        <div class="alert alert-primary" v-if="message">
            {{ message }}
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Add a New Device</h4>
            </div>
            <div class="card-body">
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Code</label>
                    <div class="col-sm-12 col-md-7">
                        <input v-bind:class="{'is-invalid': errors.dev}" type="text" v-model="dev" class="form-control" placeholder="Full dev of the user.">
                        <div class="invalid-feedback" v-if="errors.dev">
                            <p>{{ errors.dev[0] }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Location</label>
                    <div class="col-sm-12 col-md-7">
                        <input v-bind:class="{'is-invalid': errors.dev_loc}" type="text" v-model="dev_loc" class="form-control" placeholder="dev_loc address (should be unique).">
                        <div class="invalid-feedback" v-if="errors.dev_loc">
                            <p>{{ errors.dev_loc[0] }}</p>
                        </div>
                    </div>
                </div>
               <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                    <div class="col-sm-12 col-md-7">
                        <button v-bind:disabled="loading" @click="addDevice" class="btn btn-primary"><span v-if="loading">Adding</span><span v-else>Add</span></button>
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
            dev: '',
            dev_loc: '',
            errors: [],
            message: '',
            loading: false
        }
    },
    methods: {
        addDevice() {
            let _this = this;
            _this.errors = [];
            _this.message = '';
            _this.loading = true;
            axios.post(this.$parent.MakeUrl('admin/devices'), {
                    dev: this.dev, 
                    dev_loc: this.dev_loc
                }
            ).then((res) => {
                    console.log(this.uid)
                    _this.loading = false;
                    _this.resetForm();
                    _this.message = 'User account has been successfully created!';
                }
            ).catch((err) => {
                    _this.errors = err.response.data.errors;
                    _this.loading = false;
                }
            );
        },
        resetForm() {
            this.uid = '';
            this.dev = '';
            this.dev_loc = '';
            this.status = '';
        }
    }
}
</script>
