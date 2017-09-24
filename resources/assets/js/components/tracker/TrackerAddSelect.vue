<template>
    <basic-select :options="options"
                  :selected-option="item"
                  placeholder="select currency"
                  @select="onSelect">
    </basic-select>
</template>

<script>
    import { BasicSelect } from 'vue-search-select'

    export default {
        props: ['coinList'],
        components: {
            BasicSelect
        },

        data() {
            return {
                options: [],
                searchText: '',
                item: {
                    value: '',
                    text: ''
                }
            }
        },

        mounted() {
            this.prepareOptions();
        },

        watch: {
            item() {
                this.$emit('on-change', this.item)
            }
        },

        methods: {
            prepareOptions() {
                for (let i = 0; i < this.coinList.length; i++) {
                    this.options[i] = {
                        value: this.coinList[i].code,
                        text: this.coinList[i].name + ' (' + this.coinList[i].code + ')'
                    }
                }
            },

            onSelect(item) {
                this.item = item
            },

            reset() {
                this.item = {}
            },

            selectOption() {
                this.item = this.options[0]
            }
        }
    }
</script>