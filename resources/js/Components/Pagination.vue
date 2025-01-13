<template>
	<div v-if="links.length > 3" class="pagination">
        <template v-for="(link, key) in links">
            <div
                 v-if="link.url === null"
                 class="pagination-arrow"
                 :key="key"
                 v-html="link.label"
            >
            </div>
            <Link
                  v-else
                  :class="['pagination-link', { 'active': link.active }]"
                  :key="`link-${key}`"
                  v-html="link.label"
                  :href="link.url"
                  preserve-state
            >
            </Link>
        </template>
	</div>
</template>


<script setup>

import { Link } from '@inertiajs/vue3';


// ======== Props ========

const props = defineProps({
    links: [Object]
})

</script>



<style lang="scss">

.pagination {
    display: flex;
    justify-content: center;
    margin-bottom: 1.5rem;
}

.pagination-link, .pagination-arrow {
    padding: .75rem 1rem;
    margin-right: .25rem;
    font-size: .875rem;
    line-height: 1rem;
    border: 1px solid #e2e8f0;
    border-radius: .25rem;
    color: rgb(51, 65, 85);
}

.pagination-link:hover, .pagination-link.active {
    background-color: rgba(255,255,255, 1);
    text-decoration: none;
}

.pagination-arrow {
    color: rgba(148,163,184, 1);
}

</style>
