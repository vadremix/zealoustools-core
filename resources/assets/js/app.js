
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

Vue.component('app-tracker-add', require('./components/TrackerAdd.vue'));
Vue.component('app-tracker-box', require('./components/TrackerBox.vue'));
Vue.component('app-tracker', require('./components/Tracker.vue'));

const app = new Vue({
    el: '#app',

    data: {
        coinSaved: {},
        coinList: [],
        coinData: [],
        // used for wizard
        coinAll: [],
        trackerWizard: 1,
        value: new Intl.NumberFormat('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(0),
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

                    var i = 0;
                    var currentObject;

                    for(var uid in app.coinSaved) {
                        currentObject = app.coinData[i];
                        currentObject['amount'] = app.coinSaved[uid];
                        app.coinData[i] = currentObject;
                        i++;
                    }
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

        loadCoins: function() {
            this.coinList = [];

            for(coin in this.coinSaved) {
                this.coinList.push(coin);
            }

            if (this.coinList.length > 0) {
                this.getPrices(this.coinList);
            } else {
                this.getAllPrices();
            }
        },

        updateValues: function(coinValues) {
            this.coinValues = coinValues;

            var value = 0;

            for(var coin in this.coinValues) {
                value = value + this.coinValues[coin];
            }

            this.value = value.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        },

        updateWizardStep: function(step) {
            this.trackerWizard = step;
        },

        createTracker: function(uid) {
            Vue.set(this.coinSaved, uid, 0);

            localStorage.setItem('coinSaved', JSON.stringify(this.coinSaved));
        }
    },

    watch: {
        coinSaved: function() {
            this.loadCoins();
        }
    },

    created: function() {
        this.coinSaved = JSON.parse(localStorage.getItem('coinSaved'));

        this.loadCoins();
    },

    mounted: function() {
        this.mounted = true;

        axios.get('/api/coins/list')
            .then(function (response) {
                app.coinAll = response.data;
            }).catch(function (error) {
                return error;
            })
    }
});
