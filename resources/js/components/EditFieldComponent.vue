<template>
    <select v-model="selectedField" v-on:change="onChanged" id="field" class="form-control" name="field">
        <option v-for="field in fields" v-bind:value="field.id">{{ field.field_name }}</option>
    </select>
</template>

<script>
    export default {
        props:[
            "fields",
            "selected",
        ],
        data: function() {
            return {
                selectedField: this.selected
            }
        },
        methods: {
            onChanged: function() {
                this.$root.selectedField = this.selectedField;
                this.$root.checkedCategories = [];
            }
        },
        created: function() {
            this.$root.selectedField = this.selectedField;
        },
    }
</script>
