// require('./bootstrap');
//
// window.Vue = require('vue');
//
// Vue.component('theme-switcher', require('./components/ThemeSwitcher.vue').default);
//
// const app = new Vue({
//     el: '#app'
// });

// import Vue from 'vue';
import {createApp} from 'vue';

const app = createApp({});

app.component('theme-switcher', require('./components/ThemeSwitcher.vue').default)

app.mount('#app');
