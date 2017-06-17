<template>
    <transition name="fade">
        <div v-if="seen" class="tracker">
            <div class="tracker-heading">{{ coin.name + ' (' + coin.code + ')' }}</div>
            <div class="tracker-subtext">BTC: 1</div>
            <div class="tracker-subtext">USD: {{ coin.price }}</div>
            <div class="tracker-subtext">Apx. Value: 0</div>
            <input class="tracker-input" type="number" value="0">
            <div class="tracker-note">Source: {{ coin.provider }}</div>
        </div>
    </transition>
</template>

<script>
    export default {
        props: ['coin', 'visible'],

        data: function() {
            return {
                seen: this.$props.visible
            }
        },

        mounted: function() {
            this.$data.seen = true;
        }
    }
</script>