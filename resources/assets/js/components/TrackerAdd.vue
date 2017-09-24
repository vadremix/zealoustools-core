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
                            <tracker-add-select
                                    :coin-list="coinList"
                                    :valid="selectedCoinValid"
                                    @on-change="handleCurrencySelect"
                                    @clear-error="handleClearError"
                                    >
                            </tracker-add-select>
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
                selectedCoinCode: '',
                selectedCoinValid: true,
            }
        },

        components: {
            TrackerAddSelect
        },

        methods: {
            step2: function() {
                this.$emit('wizard-update', 2);
            },

            stepComplete: function() {
                if (this.validateCurrencySelection()) {
                    let uid;

                    for (let i = 0; i < this.coinList.length; i++) {
                        if (this.coinList[i].code === this.selectedCoinCode) {
                            uid = this.coinList[i].uid;
                        }
                    }

                    this.$emit('wizard-update', 1);
                    this.$emit('create-tracker', uid);

                    this.selectedCoinCode = '';
                }
            },

            validateCurrencySelection() {
                this.selectedCoinValid = (this.selectedCoinCode !== '');

                return this.selectedCoinValid;
            },

            handleCurrencySelect(item) {
                this.selectedCoinCode = item.value;
            },

            handleClearError(isError) {
                this.selectedCoinValid = (!isError);
            }
        }
    }
</script>