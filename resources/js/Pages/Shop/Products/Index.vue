<template>
	<div>
		<Head>
			<title> Главная </title>
		</Head>

		<div class="container">
            <div @click="++label_ids[0]">{{label_ids}}</div>
            <div @click="storeKort">test</div>
            <Test></Test>
            <template v-for="category in categories" :key="category.id">
                <h3 class="pb-2">{{ category.name }}</h3>
                <div class="row">
                    <product-card
                        v-for="product in category.products" :key="product.id"
                        :category="category" :product="product"
                    />
                </div>
            </template>
		</div>

	</div>
</template>


<script setup>

// ======== Import ========

import ShopLayout from "@/Layouts/ShopLayout.vue";
import ProductCard from '@/Components/ProductCard.vue';
import Test from "@/Components/ProductFilter/Blocks/Test.vue";
import {Head} from '@inertiajs/vue3';

import {useKortStore, initKort} from "@/stores/kort";
import {storeToRefs} from "pinia";

initKort({label_ids: [3,2]})
const { label_ids } = storeToRefs(useKortStore());
const { storeKort } = useKortStore();

// ======== Options ========

defineOptions({ layout: ShopLayout })


// let str = "2019-04-30, 2021-12-08";
// let regexp = /(?<year>\d{4})-(?<month>\d{2})-(?<day>\d{2})/g;
// str = str.replace(regexp, '$<day>-$<month>-$<year>')
// console.log(str);


// ======== Props ========

const props = defineProps({
    categories: Object,
})


</script>


<style scoped lang="scss">

    .products {
        margin-bottom: 1.5rem;
    }

</style>
