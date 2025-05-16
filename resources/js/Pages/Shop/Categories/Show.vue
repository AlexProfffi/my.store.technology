<template>
	<div>

		<Head>
			<title> Категория </title>
		</Head>

		<div class="category container">

            <h1> {{ category.name }} </h1>
            <p> {{ category.description }} </p>

            <ProductFilter :labels="labels" :backendFilter="backendFilter"></ProductFilter>

            <div class="row">
                <product-card
                    v-for="product in category.products.data" :key="product.id"
                    :category="category" :product="product"
                />
            </div>

			<pagination :links="category.products.links" />
		</div>
	</div>
</template>


<script setup>

// ======== Import ========

import ProductCard from "@/Components/ProductCard.vue";
import Pagination from "@/Components/Pagination.vue";
import ProductFilter from "@/Components/ProductFilter/ProductFilter.vue";
import ShopLayout from "@/Layouts/ShopLayout.vue";
import {Head} from '@inertiajs/vue3';


// ======== Options ========

defineOptions({ layout: ShopLayout })


// ======== Props ========

const props = defineProps({
    backendFilter: Object,
    category: Object,
    labels: Array
})


</script>


<style lang="scss">

	.category {

		p {
			margin-bottom: 0;
		}
	}

</style>
