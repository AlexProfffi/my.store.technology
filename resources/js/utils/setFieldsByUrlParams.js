
import {getIntersectionByKeysForObj1, parseQueryString} from "@/utils";
import {isRef} from "vue";


export function setFieldsByUrlParams(fields, prefix) {

    let urlParams =
        parseQueryString(location.search.substring(1))

    if(Object.keys(urlParams).length !== 0) {

        if(prefix)
            urlParams = urlParams[prefix]

        if(urlParams && Object.keys(fields).length !== 0) {

            let intersectionObject =
                getIntersectionByKeysForObj1(urlParams, fields) // exclude unnecessary url parameters

            Object.keys(intersectionObject).forEach((name) => {

                if(isRef(fields[name].value))
                    fields[name].value.value = intersectionObject[name]
                else
                    fields[name].value = intersectionObject[name]
            })
        }
    }
}
