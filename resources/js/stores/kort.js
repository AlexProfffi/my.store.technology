
import {defineStore} from "pinia";
import {toRefs} from "vue";
import {useForm} from "@inertiajs/vue3";


// state:

const kort = useForm({

})


// actions:

export const initKort = (form) => {
    Object.assign(kort, form)
}

export const useKortStore = defineStore('kort', () => {

    function storeKort() {

        Object.assign(kort, {
            label_ids: [8,2],
        })

    }

    return {
        ...toRefs(kort),
        storeKort
    }
})




