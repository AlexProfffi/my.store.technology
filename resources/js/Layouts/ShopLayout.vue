<template>
	<div>
		<Head>
			<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
		</Head>
		<div v-if="currentRouteName != 'login'" class="shop-layout container pt-4">
			<div class="d-flex justify-content-end">
				<ul class="d-flex" style="list-style: none">
					<li>
						<Link :href="route('welcome')" class="ml-4 text-muted">
							Главная
						</Link>
					</li>

					<li>
						<Link :href="route('categories')" class="ml-4 text-muted">
							Категории
						</Link>
					</li>
					<li>
						<a href="#" @click.prevent="showCart" class="ml-4 text-muted">Корзина</a>
						<cart-window @cartWindowRef="cartWindowRef=$event"></cart-window>
					</li>
					<li v-if="can('logout')">
						<a @click.prevent="logOutForm.post(route('logout.store'))" href="#" class="ml-4 text-muted">
							Log Out
						</a>
					</li>
					<template v-if="guest">
						<li>
							<Link :href="route('login.create')" class="ml-4 text-muted">
								Log in
							</Link>
						</li>
						<li>
							<Link :href="route('register.create')" class="ml-4 text-muted">
								Register
							</Link>
						</li>
					</template>
				</ul>
			</div>
		</div>
		<slot></slot>
	</div>
</template>


<script setup>

// ======== Import ========

require('bootstrap');
import useCart from "@/Composables/useCart";
import CartWindow from "@/Pages/Shop/CartWindow";
import {computed, provide} from "vue";
import { useForm, usePage } from '@inertiajs/inertia-vue3';


// ======== Use Cart ========

const { showCart, cartWindowRef } = useCart()

provide('cartWindowRef', cartWindowRef)


// ======== Shop Layout ========

// ------ Data -------

const logOutForm = useForm({})


// ------ Computed -------

const guest = computed(() => {

    return usePage().props.value.guest;
})

const currentRouteName = computed(() => {

    return usePage().props.value.currentRouteName;
})


</script>


<style lang="scss">

	@import '~bootstrap/scss/bootstrap';
	@import "resources/sass/Plugins/reset";

</style>
