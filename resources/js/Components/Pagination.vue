<template>
	<div :class="$attrs.class">
		<div v-if="paginate" class="d-flex">

			<template v-for="(link, key) in products.links">
				<div v-if="link.url === null" class="pagination-arrow" :key="key" v-html="link.label"></div>
				<Link v-else :class="['pagination-link', { 'active': link.active }]" :key="`link-${key}`" :href="link.url" v-html="link.label" preserve-state></Link>
			</template>

		</div>
		<div v-else-if="simplePaginate" class="d-flex">

			<div v-if="products.prev_page_url === null" class="pagination-arrow">&laquo; Previous</div>
			<Link v-else class="pagination-link" :href="products.prev_page_url" preserve-state>&laquo; Previous</Link>
			<div v-if="products.next_page_url === null" class="pagination-arrow">Next &raquo;</div>
			<Link v-else class="pagination-link" :href="products.next_page_url" preserve-state>Next &raquo;</Link>

		</div>
	</div>
</template>


<script setup>

// ======== Import ========

import {computed, toRefs} from "vue";
import { Link } from '@inertiajs/inertia-vue3';


// ======== Options ========

defineOptions({ inheritAttrs: false })


// ======== Props ========

const props = defineProps({
    products: [Array, Object]
})

const { products } = toRefs(props)


// ======== Pagination ========

// ------ Computed -------

const paginate = computed(() => {

    return products.value.links &&
        products.value.links.length > 3;
})

const simplePaginate = computed(() => {

    return products.value.links === undefined;
})

</script>



<style lang="scss">

	.pagination {

		.pagination-link, .pagination-arrow {
			padding: .75rem 1rem;
			margin-right: .25rem;
			font-size: .875rem;
			line-height: 1rem;
			border: 1px solid #e2e8f0;
			border-radius: .25rem;
			color: rgb(51, 65, 85);
		}

		.pagination-link:hover, .active {
			background-color: rgba(255,255,255, 1);
			text-decoration: none;
		}

		.pagination-arrow {
			color: rgba(148,163,184, 1);
		}
	}

</style>
