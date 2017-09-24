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
                    <div class="tracker-body text-center">
                        <form action="javascript:void(0);">
                            <tracker-add-select :coin-list="coinList" v-on:on-change="handleCurrencySelect"></tracker-add-select>
                            <div class="tracker-create-button">
                                <button class="btn btn-info tracker-create" type="submit" @click="stepComplete">Create</button>
                            </div>
                        </form>
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
    import { default as TrackerAddSelect } from './tracker/TrackerAddSelect.vue'

    export default {
        props: ['trackerWizard', 'coinList'],

        data: function() {
            return {
                coinListCat: {},
                selectedCoinCode: '',
                inputCoin: '',
                testKey: '',
                inputValid: false,
                inputDanger: false
            }
        },

        components: {
            TrackerAddSelect
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
                this.testKey = validationData[0].trim();

                if(typeof this.coinListCat[this.testKey] !== 'undefined') {
                    this.inputValid = true;
                } else {
                    this.inputValid = false;
                }
            },

            trackerWizard: function() {
                if(this.trackerWizard == 2) {
                    var refs = this.$refs;

                    Vue.nextTick(function() {
                        refs.selection.focus();
                    });
                }
            }
        },

        methods: {
            step2: function() {
                this.$emit('wizard-update', 2);
            },

            stepComplete: function() {
                if (this.inputValid == true) {
                    // TODO: rewrite source selection
                    for(var key in this.coinListCat[this.testKey]['uids']) {
                        var uid = key;
                    }

                    this.$emit('wizard-update', 1);
                    // TODO: rewrite code/source selection
                    this.$emit('create-tracker', uid);

                    this.inputCoin = '';
                } else {
                    this.inputDanger = true;
                }
            },

            coinLongName: function(coinKey) {
                // TODO: support multiple short codes (e.g. BTC, BTC2)
                return coinKey + ' (' + this.coinListCat[coinKey]['codes'][0] + ')';
            },

            handleCurrencySelect(item) {
                this.selectedCoinCode = item.value;
            }
        }
    }
</script>