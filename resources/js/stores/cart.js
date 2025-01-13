
import {defineStore} from "pinia";
import {computed, ref} from "vue";
import { usePage } from '@inertiajs/vue3'


export const useCartStore = defineStore('cart', () => {

// state:

    const cartWindowRef = ref(null)


// getters:

    const cart = computed(() => {

        return usePage().props.cart;
    })

    const cartKeys = computed(() => {

        return Object.keys(cart.value);
    })

    const isCartData = computed(() => {

        return cartKeys.value.length;
    })

    const cartTotalCost = computed(() =>

        cartKeys.value.reduce(

            (total, key) =>
                total + cart.value[key].cost,
            0
        )
    )


// actions:

    function showCart() {

        $(cartWindowRef.value).modal('show');
    }

    function hideCart() {

        $(cartWindowRef.value).modal('hide');
    }

    function addToCart(cartForm, category, product) {

        cartForm.post(route('cart.store', [category.slug, product.id]), {

            preserveScroll: true,

            onSuccess: () => {
                if(!$(cartWindowRef.value).hasClass('show'))
                    $(cartWindowRef.value).modal('show');
            }
        });

    }

    function updateToCart(cartForm, quantityMode, cartItem) {

        if (quantityValidation(cartForm.quantity)) {

            switch (quantityMode) {
                case 'decrement':
                    cartForm.quantity--;
                    break;
                case 'increment':
                    cartForm.quantity++;
                    break;
            }
        }
        else
            cartForm.quantity = 1;


        cartForm.patch(route('cart.update', cartItem.id), {
            preserveScroll: true,
        });
    }

    function quantityValidation(quantity) {

        const isInteger = (number) =>
            (number % 1) === 0;

        const isInRange = (number, start, end) =>
            number >= start && number <= end;


        return isInteger(quantity)
            && isInRange(quantity, 1, 10000)
    }

    function getCartProductCost(cartItem) {

        cartItem.cost = cartItem.quantity * cartItem.price;

        return cartItem.cost;
    }


    return {
        cart,
        cartWindowRef,
        cartKeys,
        isCartData,
        cartTotalCost,
        showCart,
        hideCart,
        addToCart,
        updateToCart,
        quantityValidation,
        getCartProductCost
    }
})




