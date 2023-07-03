<template>
	<div>

		<Head>
			<title> Категория </title>
		</Head>

		<div class="category container">
			<div>
				<h1> {{ category.name }} </h1>
				<p> {{ category.description }} </p>

				<Filter :url="route('categories.category.show', category.slug)" :labels="labels"></Filter>

                <div class="row">
                    <product-card :category="category"/>
                </div>
			</div>

			<pagination class="pagination" :products="category.products"></pagination>
		</div>

	</div>
</template>


<script>

import ShopLayout from "@/Layouts/ShopLayout";

export default {
    layout: ShopLayout
}

</script>


<script setup>

// ======== Import ========

import ProductCard from "@/Components/ProductCard";
import Pagination from "@/Components/Pagination";
import Filter from "@/Components/Filter";


// ======== Props ========

const props = defineProps({
    category: Object,
    labels: Array
})

</script>


<style lang="scss">

	.category {

		// Pagination

		.pagination {
			justify-content: center;
			margin-bottom: 1.5rem;
		}

		p {
			margin-bottom: 0;
		}
	}

</style>
