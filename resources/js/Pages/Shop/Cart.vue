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
								<CartItem
                                    v-for="cartItem in cart"
                                    :key="cartItem.id"
                                    :cartItem="cartItem"
                                />
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

import {useCartStore} from "@/stores/cart";
import {storeToRefs} from "pinia";
import CartItem from "@/Components/CartItem.vue";


// ======== Use Cart Store ========

const {
    cart,
    isCartData,
    cartTotalCost,
    cartWindowRef,

} = storeToRefs(useCartStore())



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

</style>
