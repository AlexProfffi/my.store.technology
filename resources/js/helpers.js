
import { usePage } from '@inertiajs/vue3';
import {intersectionWith} from "lodash/array";


export const getImageUrl = (path) =>  {

    // Get img-category-name/img-name.extension in the /resources/images path.
    path = path.replace(/^(\/)?((resources)?(\/)?(images\/)?)?/i, '')

    return new URL(`/resources/images/${path}`, import.meta.url).href;
}


export const can = (permission) => {

    const DBPermissions = usePage().props.permissions;

    for(let DBPermission of DBPermissions) {

        if(DBPermission.name == permission) {
            return true;
        }
    }

    return false
}


export const __ = (key, params = {}) => {

    const translations = usePage().props.translations;

    let translation = translations[key] ?? key;

    Object.keys(params).forEach(paramName => {

        translation = translation.replace(':' + paramName, params[paramName]);
    });

    return translation;
}


