<template>
	<div>
		<Head>
			<title> Главная </title>
		</Head>

		<div class="container">
            <template v-for="category in categories" :key="category.id">
                <h3 class="pb-2">{{ category.name }}</h3>
                <div class="row">
                    <product-card :category="category"/>
                </div>
            </template>
		</div>

	</div>
</template>


<script setup>

// ======== Import ========

import ShopLayout from "@/Layouts/ShopLayout";
import ProductCard from '@/Components/ProductCard';
import { Head } from '@inertiajs/inertia-vue3';


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
