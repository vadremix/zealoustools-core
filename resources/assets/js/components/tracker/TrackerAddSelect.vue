<template>
    <basic-select :options="options"
                  :selected-option="item"
                  :is-error="isError"
                  placeholder="select currency"
                  @select="onSelect"
                  @click.native="clearError">
    </basic-select>
</template>

<style>
    div .ui.selection.search.dropdown, div .ui.selection.dropdown:hover {
        margin: 20px auto;
        border: none;
        border-radius: 2px;
        width: 90%;
    }

    div .search, div .text {
        margin: 0;
    }

    div .item {
        margin: 0;
    }
</style>

<script>
    import { BasicSelect } from 'vue-search-select'

    export default {
        props: ['coinList', 'valid'],
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
                },
                isError: false
            }
        },

        mounted() {
            this.prepareOptions();
        },

        watch: {
            item() {
                this.$emit('on-change', this.item)
            },

            valid() {
                if (this.valid === false) {
                    this.isError = true;
                }
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
            },

            clearError() {
                this.isError = false;
                this.$emit('clear-error', this.isError);
            }
        }
    }
</script>