
import {inject, provide, ref, toRef, watch} from "vue";
import {getIntersectionByKeysForObj1} from "@/utils/getIntersectionByKeysForObj1.js";


export function initFilter(name, params = {}) {

    // ---- Data ----

    const methods = {}

    let errors = ref({}),
        backendErrors = ref({})


    // ---- Methods ----

    function setMethods() {

        let beforeSubmit = null

        methods.beforeSubmit = (cb) => {
            beforeSubmit = cb
        }

        methods.submitFilter = () => {

            let objectOfFields = {}
            let resBeforeSubmit = {}

            if(beforeSubmit)
                resBeforeSubmit = beforeSubmit(params)

            if(resBeforeSubmit.ignoredFieldsOfErrors && !params.validation?.backendErrors) {

                let intersection = getIntersectionByKeysForObj1(resBeforeSubmit.ignoredFieldsOfErrors, errors.value)

                resBeforeSubmit.ignoredFieldsOfErrors =
                    Object.keys(intersection).length ? resBeforeSubmit.ignoredFieldsOfErrors : {}
            } else {
                resBeforeSubmit.ignoredFieldsOfErrors = {}
            }

            if(params.fields)
                objectOfFields = {...params.fields}

            if(params.validation?.fields) {

                objectOfFields = {
                    ...objectOfFields,
                    ...params.validation.fields,
                    ...resBeforeSubmit.ignoredFieldsOfErrors
                }

            }

            objectOfFields =
                params.prefix ? {[params.prefix]: objectOfFields} : objectOfFields

            params.methods.submitFilter(objectOfFields)
        }

        methods.getField = (name) => toRef(params.fields, name)

        if(params.validation?.methods?.useField)
        {
            methods.useField = params.validation.methods.useField
        }

        if(!params.validation?.backendErrors && params.validation?.methods?.handleSubmit)
        {
            methods.handleSubmit = params.validation.methods.handleSubmit
        }
        else if(params.validation?.backendErrors && params.validation?.methods?.handleSubmit)
        {
            methods.handleSubmit = (submitFilter) => submitFilter
        }
    }


    function setErrors() {

        if(params.validation?.backendErrors)
        {
            backendErrors = params.validation.backendErrors
        }
        else if(params.validation?.errors)
        {
            errors = params.validation.errors
        }
    }


    // ---- Init ----

    setMethods()
    setErrors()

    watch(backendErrors, () => {

        errors.value = Object.fromEntries(
            Object.entries(backendErrors.value).map(([key, value]) =>
            [
                key.replace(params.prefix+'.',''),
                value.replace(params.prefix+'.', '')
            ])
        );
    })

    provide(name, {
        errors,
        ...methods
    })
}


export const useFilter = (name) => {

    return inject(name)
}
