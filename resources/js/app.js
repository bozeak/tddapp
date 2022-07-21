require('./bootstrap');
//
// window.Vue = require('vue');
//
// Vue.component('theme-switcher', require('./components/ThemeSwitcher.vue').default);
//
// const app = new Vue({
//     el: '#app'
// });

import Vue from 'vue';
import VModal from 'vue-js-modal'

Vue.use(VModal)

// import Vue from 'vue';

// const app = createApp({});

Vue.component('theme-switcher', require('./components/ThemeSwitcher.vue').default)
Vue.component('new-project-modal', require('./components/NewProjectModal').default)

// app.mount('#app');

new Vue({
    el: '#app'
});
