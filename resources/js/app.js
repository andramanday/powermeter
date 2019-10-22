require('./bootstrap');

window.Vue = require('vue');

import iosAlertView from 'vue-ios-alertview';
Vue.use(iosAlertView);

import UsersComponent from './components/UsersComponent';
import SuperadminsComponent from './components/SuperadminsComponent';
import ProfileComponent from './components/ProfileComponent';
import AdduserComponent from './components/AdduserComponent';
import CompaniesComponent from './components/CompaniesComponent';
import AddcompanyComponent from './components/AddcompanyComponent';
import DevicesComponent from './components/DevicesComponent';
import AdddeviceComponent from './components/AdddeviceComponent';
import SensorsComponent from './components/SensorsComponent';
import EditcompanyComponent from './components/EditcompanyComponent';
import EditdeviceComponent from './components/EditdeviceComponent';
Vue.component('users-component', UsersComponent);
Vue.component('superadmin-component', SuperadminsComponent);
Vue.component('profile-component', ProfileComponent);
Vue.component('adduser-component', AdduserComponent);
Vue.component('companies-component', CompaniesComponent);
Vue.component('addcompany-component', AddcompanyComponent);
Vue.component('devices-component', DevicesComponent);
Vue.component('adddevice-component', AdddeviceComponent);
Vue.component('sensors-component', SensorsComponent);
Vue.component('editcompany-component', EditcompanyComponent);
Vue.component('editdevice-component', EditdeviceComponent);

const app = new Vue({
    el: '#app',
    data() {
        return {
            user: AuthUser
        }
    },
    methods: {
        userCan(permission) {
            if(this.user && this.user.allPermissions.includes(permission)) {
                return true;
            }
            return false;
        },
        superCan(roles) {
            if(this.user && this.user.roles) {
                return true;
            }
            return false;
        },
        MakeUrl(path) {
            return BaseUrl(path);
        }
    }
});
