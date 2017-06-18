
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

Vue.component('app-tracker-box', require('./components/TrackerBox.vue'));
Vue.component('app-tracker', require('./components/Tracker.vue'));

const app = new Vue({
    el: '#app',

    data: {
        coinSaved: {Awjp27: 0.8, LEc69S: 0, cgSvK4: 0},
        coinList: [],
        coinData: [],
        value: 0,
        coinValues: {},
        mounted: false
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
        },

        updateValues: function(coinValues) {
            this.coinValues = coinValues;

            var value = 0;

            for(var coin in this.coinValues) {
                value = value + this.coinValues[coin];
            }

            this.value = value;
        }
    },

    created: function() {
        for(coin in this.coinSaved) {
            this.coinList.push(coin);
        }

        if (this.coinList.length > 0) {
            this.getPrices(this.coinList);
        } else {
            this.getAllPrices();
        }
    },

    mounted: function() {
        this.mounted = true;
    }
});
