<template>
    <div>
        <div class="col-sm-4 col-md-3">
            <div class="tracker">
                <span v-if="trackerWizard == 1" id="tracker-add-1">
                    <div class="tracker-heading text-center">Add Tracker</div>
                    <div class="tracker-add-button">
                        <button @click="step2">+</button>
                    </div>
                </span>

                <span v-if="trackerWizard == 2" id="tracker-add-2">
                    <div class="tracker-heading text-center">Choose Currency</div>
                    <div class="tracker-body">
                        <input type="text" class="tracker-coin" placeholder="Select currency..." list="coins">
                        <datalist id="coins">
                            <option v-for="(coin, coinName) in coinListCat">{{ coinLongName(coinName) }}</option>
                        </datalist>
                    </div>
                </span>

                <span v-if="trackerWizard == 3" id="tracker-add-3">
                    <div class="tracker-heading text-center">Choose Source</div>
                </span>

                <span v-if="trackerWizard == 0" id="tracker-add-finished">
                    <div class="tracker-heading text-center">Success</div>
                </span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['trackerWizard', 'coinList'],

        data: function() {
            return {
                coinListCat: {}
            }
        },

        watch: {
            coinList: function() {
                for(var i = 0; i < this.coinList.length; i++) {
                    var coinItem = this.coinList[i];

                    if(!this.coinListCat[coinItem.name]) {
                        Vue.set(this.coinListCat, coinItem.name, { uids: {}, codes: []});
                    }

                    this.coinListCat[coinItem.name]['uids'][coinItem.uid] =
                        this.coinList[i].provider;

                    this.coinListCat[coinItem.name]['codes'].push(coinItem.code);
                }
            }
        },

        methods: {
            step2: function() {
                this.$emit('wizard-update', 2);
            },

            coinLongName: function(coinKey) {
                // TODO: support multiple short codes (e.g. BTC, BTC2)
                return coinKey + ' (' + this.coinListCat[coinKey]['codes'][0] + ')';
            }
        }
    }
</script>