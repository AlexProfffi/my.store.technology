<template>
    <div>
        <div v-for="zip in zips">
            <slot name="zip" :zip="{...zip}">
                <div>default name: {{zip.name}} and clan: {{zip.clan}}</div>
            </slot>
        </div>

    </div>
</template>

<script>

    export default {

        data() {
            return {
                zips: [
                    {
                        name: 'Alex',
                        clan: 'Degtyarovi'
                    },
                ]
            }
        }
    }

</script>

<style scoped>

</style>
