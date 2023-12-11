<template>
    <Head :title="title + ' | SISA - HG'" />
    <v-app app class="w-100 h-screen d-flex justify-center align-center">
        <slot />
    </v-app>
</template>

<script setup lang="ts">
import { Head } from "@inertiajs/vue3";

defineProps({
    title: String,
});
</script>
