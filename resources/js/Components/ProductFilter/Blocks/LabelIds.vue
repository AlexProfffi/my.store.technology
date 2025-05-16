<template>
    <div class="label-ids form-list">
        <div class="form-group" v-for="label in labels" :key="label.id">
            <Checkbox
                class="checkbox"
                :inputId="`label-ids-checkbox-${label.id}`"
                v-model="label_ids"
                :value="label.id"
            >
                <template #icon>
                    <svg class="checkbox-icon p-icon p-checkbox-icon" xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'>
                        <path fill='#fff' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/>
                    </svg>
                </template>
            </Checkbox>
            <label :for="`label-ids-checkbox-${label.id}`" class="label">
                {{ label.name }}
            </label>
        </div>
    </div>
</template>


<script setup>

import Checkbox from "primevue/checkbox";
import {watch} from "vue";
import {useFilter} from "@/Composables/filter.js";



// -------- Props --------

const props = defineProps({
    labels: Array
})


// -------- Use Filter --------

const { submitFilter, getField } = useFilter('products');
const label_ids = getField('label_ids')


// -------- Watch ---------

watch(label_ids, submitFilter)

</script>


<style>

.label-ids .form-group+.form-group {
    margin-left: 24px;
}

.label-ids .label {
    cursor: pointer;
    padding-left: 8px;
}

</style>
