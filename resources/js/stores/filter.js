import {defineStore} from "pinia";
import {parseQueryString, getIntersectionByKeysForObj1} from "@/helpers";



// state:

let filterForm = undefined
let errors = undefined


// actions:

let storeFilter = undefined

export const initFilter = (FilterForm, StoreFilter, Options = {}) => {

    filterForm = FilterForm
    storeFilter = StoreFilter
    errors = Options.validation.errors

    if(urlParams) // exclude unnecessary url parameters
        intersectionObject = getIntersectionByKeysForObj1(urlParams, fields)

    Object.assign(filterForm, intersectionObject) // assign the values of the necessary URL parameters
}


export const useFilterStore = defineStore('filter', () => {

    function getFields(...fieldNames) {

        const fields = {}

        fieldNames.forEach((name) => {
            fields[name] = filterForm[name]
        })
        console.log(fields)
        return fields
    }

    function getErrors(...fieldNames) {

        const Errors = {}

        fieldNames.forEach((name) => {
            Errors[name] = errors[name]
        })

        return Errors
    }

    return {
        getErrors,
        getFields,
        storeFilter
    }
})




