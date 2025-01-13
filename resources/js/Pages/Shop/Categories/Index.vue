<template>
	<div>
		<Head>
			<title> Категории </title>
		</Head>
		<div class="container">
			<div class="starter-template">
				<div v-for="category in categories" :key="category.id" class="panel">
					<Link :href="route('categories.show', category.slug)">
						<h2>{{ category.name }}</h2>
					</Link>
					<p>
						{{ category.description }}
					</p>
				</div>
			</div>
		</div>

	</div>
</template>


<script setup>

// ======== Import ========

import ShopLayout from "@/Layouts/ShopLayout.vue";
import { Head, Link } from '@inertiajs/vue3';


// ======== Options ========

defineOptions({ layout: ShopLayout })


// ======== Props ========

const props = defineProps({
    categories: Array,
})

</script>


<!--<style lang="scss" src="resources/sass/_reset.scss"></style>-->

<style scoped lang="scss">

</style>
