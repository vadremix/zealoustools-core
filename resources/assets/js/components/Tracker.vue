<template>
    <transition name="fade">
        <div v-if="seen" class="tracker">
            <div class="tracker-heading">
                {{ coin.name + ' (' + coin.code + ')' }}
                <span class="pull-right tracker-options-button" :class="{ 'tracker-options-open': optionsToggle }" @click="toggleOptions()"><i class="glyphicon glyphicon-chevron-down"></i></span>
            </div>
            <div class="tracker-subtext">BTC: 1</div>
            <div class="tracker-subtext">USD: {{ coin.price }}</div>
            <div class="tracker-subtext">Apx. Value: {{ value() }}</div>
            <input :class="{ 'tracker-input' : true, 'input-danger': hasError }" type="number" v-model="amount" value="0">
            <div class="tracker-note">Source: {{ coin.provider }}</div>

            <div v-if="optionsToggle" class="tracker-options">
                <ul>
                    <li>Delete Tracker</li>
                </ul>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        props: ['coin', 'visible'],

        data: function() {
            return {
                seen: this.$props.visible,
                amount: this.coin.amount,
                hasError: false,
                optionsToggle: false,
            }
        },

        methods: {
            value: function() {
                var returnValue;
                var eventValue = {};
                var coinUid = this.coin.uid;

                if(!isNaN(this.amount) && this.amount >= 0) {
                    this.hasError = false;
                    returnValue = [];
                    returnValue.push(this.amount * this.coin.price);
                    returnValue.push(parseFloat(this.amount));
                } else {
                    this.hasError = true;
                    returnValue = [0, 0];
                }

                eventValue[coinUid] = returnValue;

                this.$emit('value-update', eventValue);
                returnValue = returnValue[0].toLocaleString('en-US', { style: 'currency', currency: 'usd' });
                return returnValue;
            },

            toggleOptions() {
                if(this.optionsToggle === true) {
                    this.optionsToggle = false;
                } else {
                    this.optionsToggle = true;
                }
            }
        },

        watch: {
            'coin.amount': function() {
                console.log('hello');
            }
        },

        mounted: function() {
            this.$data.seen = true;
        }
    }
</script>