<template>
    <div class="price-from-to form-list">
        <div class="form-group">
            <label for="price-from-to-input-1" class="label">
                Цена от
            </label>
            <input id="price-from-to-input-1" class="input" v-model.number="price_from" />
            <div>{{errors}}</div>
        </div>
        <div class="form-group">
            <label for="price-from-to-input-2" class="label">
                до
            </label>
            <input id="price-from-to-input-2" class="input" v-model.number="price_to" />
        </div>
        <button @click.prevent="storeFilter" class="btn btn-primary button-ok">OK</button>
    </div>
</template>


<script setup>

import {useFilterStore} from "@/stores/filter";
import {storeToRefs} from "pinia";


// ======== Use Filter Store ========

const { price_from, price_to, errors } = storeToRefs(useFilterStore());
const { storeFilter } = useFilterStore();

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
