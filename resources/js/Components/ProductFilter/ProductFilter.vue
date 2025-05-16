
<template>
    <div class="product-filter row">
        <PriceFromTo />
        <LabelIds :labels="labels" />
    </div>
</template>


<script setup>

import PriceFromTo from "@/Components/ProductFilter/Blocks/PriceFromTo.vue";
import LabelIds from "@/Components/ProductFilter/Blocks/LabelIds.vue";

import {useForm, useField} from 'vee-validate';
import {object, number} from 'zod';
import { toTypedSchema } from '@vee-validate/zod';

import {router} from "@inertiajs/vue3";

import {reactive} from "vue";

import {initFilter} from "@/Composables/filter.js";
import {strNumberToNumber} from "@/utils/strNumberToNumber.js";


// -------- Props --------

const props = defineProps({
    backendFilter: Object,
    labels: Array
})

const backendFields =
    strNumberToNumber(props.backendFilter.fields)

console.log(backendFields)


// -------- Validation --------

const { values: validationFields, handleSubmit, errors } = useForm({
    validationSchema: toTypedSchema(
        object({
            price_from: number().default(backendFields.price_from),
            price_to: number().default(backendFields.price_to)
        })
    )
});


// -------- Init Filter --------

const filterFields = reactive({
    label_ids: backendFields.label_ids ?? []
})

initFilter('products',{
    prefix: props.backendFilter.prefix,
    fields: filterFields,
    methods: {
        submitFilter: fields => {
            router.get(location.pathname+location.hash, fields, {
                preserveScroll: true,
                preserveState: true,
            })
        },
    },
    validation: {
        fields: validationFields,
        methods: { handleSubmit, useField },
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
