<template>
    <div>
        <div v-for="coin in coins" class="col-sm-4 col-md-3">
            <app-tracker :coin="coin" :visible="false" v-on:value-update="valueUpdate" :coins-loaded="coinsLoadedData"></app-tracker>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['coinData', 'coinsLoaded'],

        data: function() {
            return {
                coins: this.coinData,
                coinsLoadedData: this.coinsLoaded,
                coinValues: {}
            }
        },

        methods: {
            valueUpdate: function(value) {
                Object.assign(this.coinValues, value);
                this.$emit('value-update', this.coinValues);
            }
        },


        watch: {
            coinData: function() {
                this.coins = this.coinData;
            }
        }
    }
</script>