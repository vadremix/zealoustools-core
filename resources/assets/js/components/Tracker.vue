<template>
    <transition name="fade">
        <div v-if="seen" class="tracker">
            <div class="tracker-heading">{{ coin.name + ' (' + coin.code + ')' }}</div>
            <div class="tracker-subtext">BTC: 1</div>
            <div class="tracker-subtext">USD: {{ coin.price }}</div>
            <div class="tracker-subtext">Apx. Value: {{ value() }}</div>
            <input :class="{ 'tracker-input' : true, 'input-danger': hasError }" type="number" v-model="amount" value="0">
            <div class="tracker-note">Source: {{ coin.provider }}</div>
        </div>
    </transition>
</template>

<script>
    export default {
        props: ['coin', 'visible'],

        data: function() {
            return {
                seen: this.$props.visible,
                amount: 0,
                hasError: false
            }
        },

        methods: {
            value: function() {
                console.log(this.amount);
                if(!isNaN(this.amount)) {
                    this.hasError = false;
                    return this.amount * this.coin.price;
                } else {
                    this.hasError = true;
                    return 0;
                }
            },
        },

        mounted: function() {
            this.$data.seen = true;
        }
    }
</script>