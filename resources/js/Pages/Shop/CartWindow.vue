<template>
	<div class="modal fade" ref="cartWindowRef" id="fg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div v-if="isCartData" class="modal-content">
				<div class="modal-header">
					<h1>Корзина</h1>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="starter-template">
					<p>Оформление заказа</p>
					<div class="panel">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Название</th>
									<th>Кол-во</th>
									<th>Цена</th>
									<th>Стоимость</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="cartItem in cart" :key="cartItem.id">
									<td>
										<Link @click.stop="hideCart" :href="route('products.category.product.show', [cartItem.attributes.category.slug, cartItem.id])">

											<img style="height: 56px" :src="cartItem.attributes.image">
											{{ cartItem.name }}

										</Link>
									</td>
									<td>
										<div class="btn-group">
											<form class="cart-form">

												<button :disabled="cartItem.quantity <= 1" @click="updateToCart(cartItem, '--')" class="btn btn-danger cart-button-minus" type="button">
													<span class="glyphicon glyphicon-minus" aria-hidden="true">-</span>
												</button>

												<input type="number"
													   @input="updateToCart(cartItem)"
													   v-model.number="cartItem.quantity">

												<button @click="updateToCart(cartItem, '++')" class="btn btn-success cart-button-plus" type="button">
													<span class="glyphicon glyphicon-plus" aria-hidden="true">+</span>
												</button>

											</form>
										</div>
									</td>
									<td>{{ cartItem.price }}</td>
									<td>{{ getCartProductCost(cartItem) }}</td>
								</tr>
								<tr>
									<td colspan="3">Общая стоимость: {{ cartTotalCost }}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div v-else class="modal-content">
				<div class="modal-header">
					<h1>Корзина пуста</h1>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		</div>
	</div>
</template>


<script setup>

// ======== Import ========

import useCart from "@/Composables/useCart";
import { watch, inject } from "vue";


// ======== Emits ========

const emit = defineEmits(['cartWindowRef'])


// ======== Use Cart ========

const {
    cart,
    isCartData,
    cartTotalCost,
    hideCart,
    updateToCart,
    getCartProductCost,
    cartWindowRef,
} = useCart()


watch(cartWindowRef, () => {
    emit('cartWindowRef', cartWindowRef.value)
})

</script>


<style scoped lang="scss">

	.starter-template {
		margin-left: 16px;
	}

	.badge {
		color: black;
		font-size: 20px;
	}

	.modal.fade .modal-dialog {
		transform: none;
	}

	.modal-header {
		border-bottom: none;
	}

	.align-icons {
		justify-content: center;
	}

	.cart-form {
		display: inline-block;
		position: relative;
		width: 100px;
	}

	.cart-form input[type="number"],
	.cart-form input[type="number"]:hover,
	.cart-form input[type="number"]:focus {
		display: block;
		height: 32px;
		line-height: 32px;
		width: 100%;
		padding: 0;
		margin: 0;
		box-sizing: border-box;
		text-align: center;
		-moz-appearance: textfield;
		-webkit-appearance: textfield;
		appearance: none;
		outline: none;
	}

	.cart-form input[type="number"]::-webkit-outer-spin-button,
	.cart-form input[type="number"]::-webkit-inner-spin-button {
		-webkit-appearance: none;
	}

	.cart-button-plus, .cart-button-minus {
		display: flex !important;
		justify-content: center;
		align-items: center;
		width: 20px;
		padding: 0;
	}

	.cart-button-minus {
		position: absolute;
		top: 1px;
		left: 1px;
		bottom: 1px;
	}

	.cart-button-plus {
		position: absolute;
		top: 1px;
		right: 1px;
		bottom: 1px;
	}

</style>
