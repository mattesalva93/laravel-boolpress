window.Vue = require('vue');

//Axios per front
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import App from './App.vue';

const app = new Vue({
    el: '#app',
    render: h => h(App)
});
