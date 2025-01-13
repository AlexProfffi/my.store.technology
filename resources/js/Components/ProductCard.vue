<template>
	<div class="product-card col-sm-6 col-md-4">
		<div class="thumbnail">
			<div class="labels">
				<div v-for="label in product.labels"
					 :key="label.id"
					 :class="[label.class, 'badge']">
					{{ label.name }}
				</div>
			</div>
			<img class="img-fluid" :src="product.image">
			<div class="caption">
				<h3>
					<Link :href="route('products.show', [category.slug, product.id])">
						{{ product.name }}
					</Link>
				</h3>
				<div style="margin-bottom: 5px">
					{{ product.price }} руб.
				</div>
                <div style="margin-bottom: 5px">
                    {{ product.id }}
                </div>
				<h5>
					<form v-if="cart[product.id]" @submit.prevent="showCart">
						<button type="submit" class="btn btn-primary" role="button">В корзинe</button>
					</form>
					<form v-else @submit.prevent="addToCart(cartForm, category, product)">
						<button type="submit" class="btn btn-success" role="button">В корзинy</button>
					</form>
				</h5>
				<br>
			</div>
		</div>
	</div>
</template>


<script setup>

import {Link, useForm} from '@inertiajs/vue3';
import {storeToRefs} from "pinia";
import {useCartStore} from "@/stores/cart";


// ======== Props ========

const props = defineProps({
    category: Object,
    product: Object,
})


// ======== Use Cart Store ========

const { cart } = storeToRefs(useCartStore());
const { showCart, addToCart } = useCartStore()


// ======== Product Card ========

// ------ Data -------

const cartForm = useForm({
    quantity: 1
})

</script>


<style scoped lang="scss">

    .labels {
        position: absolute;
    }

    .labels .badge {
        display: block;
    }

    .badge.badge-success {
        color: #fff;
        background-color: #28a745;
    }

    .badge.badge-warning {
        color: #fff;
        background-color: #dc3545;
    }

    .badge.badge-danger {
        color: #212529;
        background-color: #ffc107;
    }

</style>
