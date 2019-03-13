<template>
    <select v-model="selectedType" v-on:change="onChanged" id="type" class="form-control" name="type">
        <option v-for="(type, index) in types" v-bind:value="index">{{ type.display }}</option>
    </select>
</template>

<script>
    export default {
        props:[
            "types",
            "selected",
        ],
        data: function() {
            return {
                selectedType: this.selected
            }
        },
        methods: {
            onChanged: function() {
                this.$root.selectedType = this.selectedType;
                this.$root.checkedPurposes = [];
            }
        },
        created: function() {
            this.$root.selectedType = this.selectedType;
        },
    }
</script>
