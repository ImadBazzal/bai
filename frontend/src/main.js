// main.js
import Vue from 'vue';
import Vuelidate from 'vuelidate';
import App from './App.vue';
import vuetify from './plugins/vuetify';
import i18n from './i18n';

import store from './store';
import router from './router';

Vue.config.productionTip = false;

Vue.use(Vuelidate);

new Vue({
  router,
  store,
  i18n,
  vuetify,
  render: h => h(App)
}).$mount('#app');