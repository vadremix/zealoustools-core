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
        props: ['trackerWizard'],

        methods: {
            step2: function() {
                this.$emit('wizard-update', 2);
            }
        }
    }
</script>