
export const strNumberToNumber = (fields) => {

    for(let name in fields) {

        if (Array.isArray(fields[name]))
            fields[name] = strNumberToNumber(fields[name])

        if ((typeof fields[name] === "string") && !isNaN(fields[name])) {
            fields[name] = Number(fields[name])
        }
    }

    return fields
}
