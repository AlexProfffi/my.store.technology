<template>
	<div>
		<Head>
			<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
		</Head>
		<div v-if="currentRouteName != 'login'" class="shop-layout container pt-4">
			<div class="d-flex justify-content-end">
				<ul class="d-flex" style="list-style: none">
					<li>
						<Link :href="route('products.index')" class="ml-4 text-muted">
							Главная
						</Link>
					</li>

					<li>
						<Link :href="route('categories.index')" class="ml-4 text-muted">
							Категории
						</Link>
					</li>
					<li>
						<a href="#" @click.prevent="showCart" class="ml-4 text-muted">Корзина</a>
						<Cart></Cart>
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
                        <div @click="++gg">{{gg}}</div>
					</template>
				</ul>
			</div>
		</div>

        <div class="container">
            <messages></messages>
        </div>

		<slot></slot>
	</div>
</template>


<script setup>

// ======== Import ========

import Messages from "@/Components/Messages.vue";

import 'bootstrap';
import Cart from "@/Pages/Shop/Cart.vue";
import {computed, ref} from "vue";
import { useForm, usePage } from '@inertiajs/vue3';
import { Link, Head } from '@inertiajs/vue3';
import {can} from "@/helpers";
import {useCartStore} from "@/stores/cart";

const gg = ref(0)
// ======== Use Cart Store ========

const { showCart } = useCartStore()


// ======== Shop Layout ========

// ------ Data -------

const logOutForm = useForm({})


// ------ Computed -------

const guest = computed(() => {

    return usePage().props.guest;
})

const currentRouteName = computed(() => {

    return usePage().props.currentRouteName;
})



</script>


<style lang="scss">

	@import 'bootstrap/scss/bootstrap';
	@import "/resources/css/Plugins/reset";

</style>
