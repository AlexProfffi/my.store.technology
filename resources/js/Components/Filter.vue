
<template>
    <form class="filter row">

        <div class="form-group">
            <TextInput type="text" v-bind="textInput.price_from" class="text-input" v-model="filterForm.price_from"
                        :error="filterForm.errors.price_from"
            />
            <TextInput type="text" v-bind="textInput.price_to" class="text-input" v-model="filterForm.price_to"/>
            <button @click.prevent="storeFilter" class="btn btn-primary button-ok">OK</button>
        </div>
        <div class="form-group">
            <checkbox-input class="checkbox-input"
                            v-for="(label, i) in labels" :key="label.id"
                            :value="label.id" v-model="filterForm.label_ids"
                            :label="{
                                name: this.labels[i].name,
                                nameLocation: 'right'
                            }"
            />
            <array-errors class="array-errors errors" array-name="label_ids" :errors="filterForm.errors" />
        </div>

    </form>
</template>


<script setup>

// ======== Import ========

import CheckboxInput from '@/Components/Checkbox';
import TextInput from '@/Components/Input'
import ArrayErrors from "@/Components/ArrayErrors";
import {toRefs, watch} from "vue";
import { useForm } from '@inertiajs/inertia-vue3';


// ======== Props ========

const props = defineProps({
    url: String,
    labels: Array,
})

const { url } = toRefs(props)


// ======== Filter ========

// ------- Data --------

const filterForm = useForm({
    label_ids: [],
    price_from: undefined,
    price_to: undefined,
})

const textInput = {
    price_from: {
        label: { text: 'Цена от' },
        input: { class: 'input-category' }
    },
    price_to: {
        label: { text: 'до' },
        input: { class: 'input-category' }
    },
}
const form = {
    email: ''
}


// ------- Methods --------

const storeFilter = () => {

    filterForm.get(url.value, {

        preserveState: true,
        preserveScroll: true,
    });
}


// ------- Watch --------

watch(() => filterForm.label_ids, storeFilter, {deep: true})


</script>


<style scoped lang="scss">

	.filter {
        padding: 0 15px;
        align-items: center;
    }

    .checkbox-input {
        display: inline-block;
    }

    .checkbox-input+.checkbox-input {
        margin-left: 1.5rem;
    }

    .text-input+.text-input {
        margin-left: 0.5rem;
    }

    .form-group {
        display: flex;
        align-items: center;
        margin-top: 1rem;
    }

    .form-group+.form-group {
        margin-left: 1.5rem;
    }

    .button-ok {
        margin-left: 1rem;
        font-size: 0.8rem;
    }

    .errors {
        margin-top: .25rem;
        font-size: .875em;
        color: #dc3545;
    }
</style>
