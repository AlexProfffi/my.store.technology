
<template>
    <form class="product-filter row">
        <PriceFromTo />
        <LabelIds :labels="labels" />
    </form>
</template>


<script setup>

import PriceFromTo from "@/Components/ProductFilter/Blocks/PriceFromTo.vue";
import LabelIds from "@/Components/ProductFilter/Blocks/LabelIds.vue";

import {initFilterForm} from "@/stores/filter";

import {useForm} from 'vee-validate';
import {object, array, number} from 'zod';
import { toTypedSchema } from '@vee-validate/zod';
import {getValidationFields} from "@/utils/ValidationFields.js";

import {router} from "@inertiajs/vue3";

import {getUrlWithoutQuery} from "@/helpers.js";
import {reactive} from "vue";


// -------- Props --------

const props = defineProps({
    labels: Array
})


// -------- Validation --------

const { values, errors, handleSubmit } = useForm({
    validationSchema: toTypedSchema(
        object({
            label_ids: array(number()).default([]),
            price_from: number(),
            price_to: number(),
        }),
    )
});


// -------- Init Filter Form --------

// Data

const filterForm = reactive(getValidationFields(values))


initFilterForm(filterForm, handleSubmit(() => {

    router.get(getUrlWithoutQuery(), filterForm, {
        preserveScroll: true,
        preserveState: true,
    })
}), {
    validation: {
        errors
    }
})

</script>


<style>

.product-filter {
    padding: 0 15px;
    align-items: center;
}

.product-filter .form-list{
    align-items: center;
    margin: 16px 0 16px 0;
}

.product-filter .form-list+.form-list {
    margin-left: 32px;
}

.product-filter .form-group {
    align-items: center;
    margin: 0;
}

.product-filter .input {
    margin-left: 8px;
}

</style>
