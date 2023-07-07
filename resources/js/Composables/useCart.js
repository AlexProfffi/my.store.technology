
import {computed, ref} from "vue";
import { useForm, usePage } from '@inertiajs/inertia-vue3';


// ------ Global Data -------

const cartWindowRef = ref(null)

// --------------------------


export default function useCart() {


    // ------ Data -------

    const cartForm = useForm({
        quantity: 1,
        _method: 'patch'
    })


    // ------ Computed -------

    const cart = computed(() => {    // Get cart on a server

        return usePage().props.value.cart;
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


    // ------ Methods -------

    const showCart = () => {

        $(cartWindowRef.value).modal('show');
    }


    const hideCart = () => {

        $(cartWindowRef.value).modal('hide');
    }


    const addToCart = (category, product) => {

        cartForm.post(route('cart.category.product.addToCart', [category.slug, product.id]), {

            preserveScroll: true,

            onFinish: () => {
                if(!$(cartWindowRef.value).hasClass('show'))
                    $(cartWindowRef.value).modal('show');
            }
        });

    }


    const updateToCart = (cartItem, symbol) => {

        switch (symbol) {
            case '--':
                cartItem.quantity--;
                break;
            case '++':
                cartItem.quantity++;
                break;
        }

        if(cartItem.quantity == '') {

            cartItem.quantity = "''";
            return;
        }

        cartForm.quantity = cartItem.quantity;


        cartForm.post(route('cart.product.updateToCart', cartItem.id), {

            preserveScroll: true,
        });
    }


    const getCartProductCost = (cartItem) => {

        cartItem.cost = cartItem.quantity * cartItem.price;

        return cartItem.cost;
    }


    return {
        cartForm,
        cart,
        isCartData,
        cartTotalCost,
        showCart,
        hideCart,
        addToCart,
        updateToCart,
        getCartProductCost,
        cartWindowRef
    }

};
