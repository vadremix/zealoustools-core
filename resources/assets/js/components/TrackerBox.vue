<template>
    <div>
        <div v-for="coin in coins" :key="coin.uid" class="col-sm-4 col-md-3">
            <app-tracker :coin="coin" :visible="false" v-on:value-update="valueUpdate" v-on:tracker-delete="deleteTracker"></app-tracker>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['coinData'],

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
            },

            deleteTracker: function(uid) {
                this.$emit('tracker-delete', uid);
            }
        },


        watch: {
            coinData: function() {
                this.coins = this.coinData;
            }
        }
    }
</script>