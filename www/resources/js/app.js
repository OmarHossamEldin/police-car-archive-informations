/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/*
|----------------------------------------------------------------
| Vue 2
|----------------------------------------------------------------
*/

import { App, plugin } from '@inertiajs/inertia-vue'
import Vue from 'vue'

//vuetify
import Vuetify from 'vuetify';
Vue.use(Vuetify)
//vuetify

Vue.config.devtools=true;

//progress bar
import { InertiaProgress } from '@inertiajs/progress'
InertiaProgress.init({
    // The delay after which the progress bar will
    // appear during navigation, in milliseconds.
    delay: 250,
  
    // The color of the progress bar.
    color: '#29d',
  
    // Whether to include the default NProgress styles.
    includeCSS: true,
  
    // Whether the NProgress spinner will be shown.
    showSpinner: false,
  })
//progress bar

Vue.use(plugin)

const el = document.getElementById('app')

new Vue({
  vuetify: new Vuetify(),
  render: h => h(App, {
    props: {
      initialPage: JSON.parse(el.dataset.page),
      resolveComponent: name => import(`./pages/${name}`).then(module => module.default),
    },
  }),
}).$mount(el)