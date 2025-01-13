import {defineStore} from "pinia";
import {toRefs} from "vue";
import {getUrlParamsAsObject, getIntersectionOfObjectsByProperties} from "@/helpers";


// state:

let filterForm = undefined
let options = undefined


// actions:

let storeFilter = undefined

export const initFilterForm = (FilterForm, StoreFilter, Options = {}) => {

    filterForm = FilterForm
    storeFilter = StoreFilter
    options = Options

    // exclude unnecessary url parameters
    const intersectionObject = getIntersectionOfObjectsByProperties
    (
        getUrlParamsAsObject(location.search.substring(1)),
        filterForm
    )

    Object.assign(filterForm, intersectionObject) // assign the values of the necessary URL parameters
}


export const useFilterStore = defineStore('filter', () => {

    return {
        ...toRefs(filterForm),
        storeFilter,
        errors: options.validation?.errors
    }
})




