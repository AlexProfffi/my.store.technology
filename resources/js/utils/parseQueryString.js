
export const parseQueryString = (queryString) => {

    const params = new URLSearchParams(queryString);
    const result = {};

    for (const [key, value] of params.entries()) {
        const keyParts = key.replace(/\[\]/g, '[]').split(/\[|\]/g).filter(part => part !== '');

        function setValue(obj, parts, val) {
            const currentKey = parts.shift();

            if (parts.length === 0) {
                let parsedValue = val; // Значение по умолчанию - строка

                if (!isNaN(val) && val !== "") {  // Проверка, является ли значение числом
                    parsedValue = Number(val); // Преобразуем в число
                } else if (value.includes(',')) {
                    const splitValues = value.split(',');
                    parsedValue = splitValues.map(item => {
                        if (!isNaN(item) && item !== "") {
                            return Number(item);
                        }
                        return item;
                    });
                }

                if (currentKey === '') {
                    if (!Array.isArray(obj)) {
                        obj = [];
                    }
                    obj.push(parsedValue);
                } else if (obj[currentKey] && Array.isArray(obj[currentKey])) {
                    if (!obj[currentKey].includes(parsedValue)) { // Используем parsedValue здесь
                        obj[currentKey].push(parsedValue);
                    }
                } else if (obj[currentKey] && typeof obj[currentKey] === 'object' && !Array.isArray(obj[currentKey])) {
                    obj[currentKey] = [obj[currentKey], parsedValue]; // И здесь
                } else if (obj[currentKey] && !Array.isArray(obj[currentKey]) && typeof obj[currentKey] !== 'object') {
                    obj[currentKey] = [obj[currentKey], parsedValue]; // И здесь
                } else {
                    obj[currentKey] = parsedValue; // И здесь
                }
                return;
            }

            if (currentKey === '') {
                if (!Array.isArray(obj)) {
                    obj = [];
                }
                setValue(obj, parts, val);
            } else {
                if (typeof obj[currentKey] !== 'object' || obj[currentKey] === null) {
                    obj[currentKey] = {};
                }
                setValue(obj[currentKey], parts, val);
            }
        }

        setValue(result, keyParts, value);
    }

    function convertIndexedObjectsToArray(obj) {

        for(const key in obj)
        {
            if (typeof obj[key] === 'object')
            {
                if(isIndexedObject(obj[key]))
                    obj[key] = Object.values(obj[key])
                else
                    convertIndexedObjectsToArray(obj[key])
            }

        }

        return obj
    }

    function isIndexedObject(obj) {

        if(typeof obj !== 'object') return false

        const keys = Object.keys(obj);

        for (let i = 0; i < keys.length; i++) {
            if (String(i) !== keys[i]) {
                return false;
            }
        }
        return true;
    }


    return convertIndexedObjectsToArray(result);
}
