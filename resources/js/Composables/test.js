import {ref} from "vue";


export default function tuo() {


    let rt = ref(3)

    const updRt = (value) => {
        rt = value
    }

    const getRt = () => {
        return rt
    }



    return {getRt, updRt, rt}
}
