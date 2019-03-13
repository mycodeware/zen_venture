<template>
    <div class="oppor_checkbox">
        <div v-for="(purpose, index) in purposes" class="form-check form-check-inline" v-show="show[index]">
            <input class="form-check-input" type="checkbox" name="purposes[]" v-bind:value="index" v-model="checkedPurposes">
            <label class="form-check-label">{{ purpose }}</label>
        </div>
    </div>
</template>

<script>
    export default {
        props:[
            "showFlags",
            "purposes",
            "iniChecked",
            "selected",
            "checked",
        ],
        data: function() {
            return {
                show: [],
                checkedPurposes: this.iniChecked
            }
        },
        watch: {
            selected: function(val) {
                this.show = this.showFlags[val];
            },
            checked: function(val) {
                this.checkedPurposes = val;
            }
        },
    }
</script>
