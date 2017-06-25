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
                        <input type="text" class="tracker-coin" v-model="inputCoin" placeholder="Select currency..." list="coins">
                        <datalist id="coins">
                            <option v-for="(coin, coinName) in coinListCat">{{ coinLongName(coinName) }}</option>
                        </datalist>
                        <div class="tracker-create-button">
                            <button @click="stepComplete">Create</button>
                        </div>
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
                coinListCat: {},
                inputCoin: '',
                testKey: '',
                inputValid: false,
                inputDanger: false
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
            },

            inputCoin: function() {
                this.inputDanger = false;

                // match until '('
                var pattern = /([^\(]*)/g;
                var validationData = pattern.exec(this.inputCoin);

                // remove ' ' that regex would've selected
                this.testKey = validationData[0].substr(0, validationData[0].length - 1);

                if(typeof this.coinListCat[this.testKey] !== 'undefined') {
                    this.inputValid = true;
                } else {
                    this.inputValid = false;
                }
            }
        },

        methods: {
            step2: function() {
                this.$emit('wizard-update', 2);
            },

            stepComplete: function() {
                if (this.inputValid = true) {
                    // TODO: rewrite source selection
                    for(var key in this.coinListCat[this.testKey]['uids']) {
                        var uid = key;
                    }

                    this.$emit('wizard-update', 1);
                    // TODO: rewrite code/source selection
                    this.$emit('create-tracker', uid);
                } else {
                    this.inputDanger = false;
                }
            },

            coinLongName: function(coinKey) {
                // TODO: support multiple short codes (e.g. BTC, BTC2)
                return coinKey + ' (' + this.coinListCat[coinKey]['codes'][0] + ')';
            }
        }
    }
</script>