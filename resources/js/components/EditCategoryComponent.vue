<template>
    <div>
        <div v-for="category in categories" class="form-check form-check-inline" v-show="selected==category.field_id">
            <input class="form-check-input" type="checkbox" name="categories[]" v-bind:value="category.id" v-model="checkedCategories">
            <label class="form-check-label">{{ category.category_name }}</label>
            <input class="form-control form-control-sm" type="text" v-bind:name="'remarks['+category.id+']'" v-bind:value="iniRemarks[category.id]" v-if="category.enterable==true && checkedCategories.indexOf(category.id) >= 0">
        </div>
    </div>
</template>

<script>
    export default {
        props:[
            "categories",
            "iniChecked",
            "iniRemarks",
            "selected",
            "checked",
        ],
        data: function() {
            return {
                checkedCategories: this.iniChecked
            }
        },
        watch: {
            checked: function(val) {
                this.checkedCategories = val;
            }
        },
    }
</script>
