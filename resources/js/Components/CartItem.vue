
<template>
    <tr>
        <td>
            <Link @click.stop="hideCart" :href="route('products.show', [cartItem.attributes.category.slug, cartItem.id])">
                <img style="height: 56px" :src="cartItem.attributes.image">
                {{ cartItem.name }}
            </Link>
        </td>
        <td>
            <div class="btn-group">
                <form class="cart-form">
                    <button :disabled="cartForm.quantity <= 1" @click="updateToCart(cartForm, 'decrement', cartItem)" class="btn btn-danger cart-button-minus" type="button">
                        <span class="glyphicon glyphicon-minus" aria-hidden="true">-</span>
                    </button>

                    <input type="number"
                           @input="updateToCart(cartForm, 'input', cartItem)"
                           v-model.number="cartForm.quantity">

                    <button @click="updateToCart(cartForm, 'increment', cartItem)" class="btn btn-success cart-button-plus" type="button">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true">+</span>
                    </button>
<!--                    <div v-if="cartForm.errors.quantity">{{cartForm.errors.quantity}}</div>-->
                </form>
            </div>
        </td>
        <td>{{ cartItem.price }}</td>
        <td>{{ getCartProductCost(cartItem) }}</td>
    </tr>
</template>


<script setup>

import {useCartStore} from "@/stores/cart";
import {Link, useForm} from "@inertiajs/vue3";
import {toRefs} from "vue";


// ======== Props ========

const props = defineProps({
    cartItem: Object
})

const { cartItem } = toRefs(props)


// ======== Use Cart Store ========

const {
    hideCart,
    updateToCart,
    getCartProductCost,

} = useCartStore()


// ======== Cart Item ========

// ------ Data -------

const cartForm = useForm({
    quantity: cartItem.value.quantity,
})


</script>


<style>

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
