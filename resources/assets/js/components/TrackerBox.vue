<template>
    <div>
        <div v-for="coin in coins" class="col-sm-4 col-md-3">
            <app-tracker :coin="coin"></app-tracker>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['coinData'],

        data: function() {
            return {
                coins: this.coinData
            }
        },

        watch: {
            coinData: function() {
                this.coins = this.coinData;
            }
        }
    }
</script>