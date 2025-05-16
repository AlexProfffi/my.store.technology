<template>
    <form @submit.prevent="onSubmit" class="price-from-to form-list">
        <div class="form-group">
            <label for="price-from-to-input-1" class="label">
                Цена от
            </label>
            <input id="price-from-to-input-1" class="input" v-model.number="price_from" />
            <div>{{errors.price_from}}</div>
        </div>
        <div class="form-group">
            <label for="price-from-to-input-2" class="label">
                до
            </label>
            <input id="price-from-to-input-2" class="input" v-model.number="price_to" />
            <div>{{errors.price_to}}</div>
        </div>
        <button type="submit" class="btn btn-primary button-ok">OK</button>
    </form>
</template>


<script setup>

import {useFilter} from "@/Composables/filter.js";

// -------- Use Filter --------

const { errors, submitFilter, useField, handleSubmit, beforeSubmit } = useFilter('products');
const {value: price_from} = useField('price_from')
const {value: price_to} = useField('price_to')

beforeSubmit((params) => {

    return {
        ignoredFieldsOfErrors: {price_from: undefined, price_to: undefined}
    }
})

const onSubmit = handleSubmit(submitFilter)

</script>


<style>

.price-from-to .form-group+.form-group {
    margin-left: 16px;
}

.price-from-to .button-ok {
    margin-left: 1rem;
    font-size: 0.8rem;
}

</style>
