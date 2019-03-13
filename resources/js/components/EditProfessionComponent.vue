<template>
    <div class="form-row">
        <div class="form-group col-md-6">
            <select v-model="selectedProfession" id="profession" class="form-control" name="profession" required>
                <option v-for="(profession, key) in professions" v-bind:value="key">{{ profession.name }}</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <input class="form-control" type="text" name="profession_remark" v-bind:value="iniRemark" v-if="professions[selectedProfession].enterable==true">
        </div>
    </div>
</template>

<script>
    export default {
        props:[
            "professions",
            "selected",
            "iniRemark",
        ],
        data: function() {
            return {
                selectedProfession: this.selected? this.selected: 1
            }
        },
    }
</script>
