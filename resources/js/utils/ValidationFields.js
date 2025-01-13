
import { useField } from 'vee-validate'

export const getValidationFields = (values) => {

    const fields = {}

    Object.keys(values).forEach((name) => {
        fields[name] = useField(name).value
    })

    return fields
}
