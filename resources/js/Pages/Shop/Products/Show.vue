<template>
	<div>

		<Head>
			<title> Продукт </title>
		</Head>

		<div class="container">
			<div class="starter-template">
				<h1>{{ product.name }}</h1>
				<p>Цена: <b>{{ product.price }}.</b></p>
				<h4>
					<Link :href="route('categories.show', category.slug)">
						{{ category.name }}
					</Link>
				</h4>
				<div class="row">
					<div class="col-md-8">
						<img class="img-fluid" :src="product.image">
					</div>
				</div>
				<p>{{ product.description }}</p>
				<form v-if="cart[product.id]" @submit.prevent="showCart">
					<button type="submit" class="btn btn-primary" role="button">Уже в корзинe</button>
				</form>
				<form v-else @submit.prevent="addToCart(cartForm, category, product)">
					<button type="submit" class="btn btn-success">Добавить в корзину</button>
				</form>
			</div>
		</div>

	</div>
</template>


<script setup>

import ShopLayout from "@/Layouts/ShopLayout.vue";
import { Link, Head, useForm } from '@inertiajs/vue3';
import {storeToRefs} from "pinia";
import {useCartStore} from "@/stores/cart";



// ======== Options ========

defineOptions({ layout: ShopLayout })


// ======== Props ========

const props = defineProps({
    category: Object,
    product: Object
})


// ======== Use Cart Store ========

const { cart } = storeToRefs(useCartStore());
const { showCart, addToCart } = useCartStore();


// ======== Show ========

// ------ Data -------

const cartForm = useForm({
    quantity: 1
})

</script>

