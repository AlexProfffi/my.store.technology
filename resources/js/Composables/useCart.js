
import {computed} from "vue"
import { useForm, usePage } from '@inertiajs/vue3'



export default function useCart() {


    // ------ Data -------

    // const cartForm = useForm({
    //     quantity: 1,
    // })


    // ------ Computed -------

    // const cart = computed(() => {    // Get cart on a server
    //
    //      return usePage().props.value.cart;
    // })





    // ------ Methods -------

    // const showCart = () => {
    //
    //     $(cartWindowRef.value).modal('show');
    // }
    //
    //
    // const hideCart = () => {
    //
    //     $(cartWindowRef.value).modal('hide');
    // }
    //
    //
    // const addToCart = (category, product) => {
    //
    //     cartForm.post(route('cart.store', [category.slug, product.id]), {
    //
    //         preserveScroll: true,
    //
    //         onSuccess: () => {
    //             if(!$(cartWindowRef.value).hasClass('show'))
    //                 $(cartWindowRef.value).modal('show');
    //         }
    //     });
    //
    // }
    //
    //
    // const updateToCart = (cartItem, symbol) => {
    //
    //     if (quantityValidation(cartItem.quantity)) {
    //
    //         switch (symbol) {
    //             case '--':
    //                 cartItem.quantity--;
    //                 break;
    //             case '++':
    //                 cartItem.quantity++;
    //                 break;
    //         }
    //     }
    //     else
    //         cartItem.quantity = 1;
    //
    //     cartForm.quantity = cartItem.quantity;
    //
    //     cartForm.patch(route('cart.update', cartItem.id), {
    //         preserveScroll: true,
    //     });
    // }
    //
    //
    // const quantityValidation = quantity => {
    //
    //     const isInteger = (number) =>
    //         (number % 1) === 0;
    //
    //     const isInRange = (number, start, end) =>
    //         number >= start && number <= end;
    //
    //
    //     return isInteger(quantity)
    //         && isInRange(quantity, 1, 10000)
    // }
    //
    //
    // const getCartProductCost = (cartItem) => {
    //
    //     cartItem.cost = cartItem.quantity * cartItem.price;
    //
    //     return cartItem.cost;
    // }


    // return {
    //     cartForm,
    //     cart,
    //     isCartData,
    //     cartTotalCost,
    //     showCart,
    //     hideCart,
    //     addToCart,
    //     updateToCart,
    //     getCartProductCost,
    //     cartWindowRef,
    // }

};
