
import {ref, toRefs} from "vue";
import {getUrlWithoutQuery} from "@/helpers";
import {useForm} from "@inertiajs/vue3";


export default function useProductFilter() {

    // ------- Data --------

    const filterForm = useForm({
        label_ids: [],
        price_from: undefined,
        price_to: undefined,
    })

    const url = ref(getUrlWithoutQuery())


    // ------- Methods --------

    const storeFilter = () => {
        console.log(filterForm)
        filterForm.get(url.value, {

            preserveState: true,
            preserveScroll: true,
        });
    }


    return {
        ...toRefs(filterForm),
        storeFilter
    }
}
