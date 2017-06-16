
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


// Vue.component('example', require('./components/Example.vue'));

Vue.component('app-tracker', require('./components/Tracker.vue'));

const app = new Vue({
    el: '#app-canvas',

    data: {
        coinSaved: ['Awjp27', 'LEc69S', 'cgSvK4'],
        coinData: []
    },

    methods: {
        getPrices: function(coinUids) {
            return axios.post('/api/coins/prices', {
                coins: coinUids
            })
                .then(function (response) {
                    app.coinData = response.data;
                }).catch(function (error) {
                    return error;
                })
        },

        getAllPrices: function() {
            return axios.get('/api/coins/prices')
                .then(function (response) {
                    app.coinData = response.data;
                }).catch(function (error) {
                    return error;
                })
        }
    },

    created: function() {
        if (this.coinSaved.length > 0) {
            this.getPrices(this.coinSaved);
        } else {
            this.getAllPrices();
        }
    }
});
