
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


export const getUrlParamsAsObject = (urlParams) => {

    let re = /([^&=]+)=?([^&]*)/g;
    let decodeRE = /\+/g;

    let decode = function (str) {
        return decodeURIComponent(str.replace(decodeRE, " "));
    };

    let params = {}, e;

    while (e = re.exec(urlParams)) {

        let k = decode(e[1]), v = decode(e[2]);

        if(!isNaN(v)) v = parseInt(v);

        if (k.substring(k.length - 2) === '[]') {
            k = k.substring(0, k.length - 2);
            (params[k] || (params[k] = [])).push(v);
        }
        else params[k] = v;

    }

    let assign = function (obj, keyPath, value) {

        let lastKeyIndex = keyPath.length - 1;

        for (let i = 0; i < lastKeyIndex; ++i) {
            let key = keyPath[i];
            if (!(key in obj))
                obj[key] = []
            obj = obj[key];
        }

        obj[keyPath[lastKeyIndex]] = value;
    }

    for (let prop in params) {

        let structure = prop.split('[');

        if (structure.length > 1) {

            let levels = [];

            structure.forEach(function (item, i) {
                let key = item.replace(/[?[\]\\ ]/g, '');
                levels.push(key);
            });

            assign(params, levels, params[prop]);
            delete(params[prop]);
        }
    }

    return params;
};


export const getIntersectionOfObjectsByProperties = (obj1, obj2) => {

    return Object.fromEntries(
        intersectionWith
        (
            Object.entries(obj1), Object.entries(obj2),
            (innerArrObj1, innerArrObj2) => innerArrObj1[0] === innerArrObj2[0]
        )
    )
}


export const getUrlWithoutQuery = () => {

    return location.origin+location.pathname;
}
