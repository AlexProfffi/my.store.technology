<template>
    <div>
        {{label_ids}}
    </div>
</template>

<script setup>

import {useKortStore} from "@/stores/kort";
import {storeToRefs} from "pinia";

const { label_ids, kort } = storeToRefs(useKortStore());


</script>

<style scoped lang="scss">

</style>
