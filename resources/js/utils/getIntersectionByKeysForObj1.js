import {intersectionWith} from "lodash/array.js";

export const getIntersectionByKeysForObj1 = (obj1, obj2) => {

    return Object.fromEntries(
        intersectionWith
        (
            Object.entries(obj1), Object.entries(obj2),
            (innerArrObj1, innerArrObj2) => innerArrObj1[0] === innerArrObj2[0]
        )
    )
}
