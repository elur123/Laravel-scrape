<template>
    <form @submit.prevent="search" class="w-1/2">

        <input class="w-full border-2 border-pink-500 focus:ring-pink-500 focus:border-pink-500 rounded-md" type="search" v-model="form.s" :placeholder="placeholder">

    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

let props = defineProps({
    search: {
        type: Object,
        required: true
    },
    placeholder: {
        type: String,
        default: 'Enter keyword'
    }
})

const form = useForm({
    s: props.search.keyword,
})

function search() {
    form.get(props.search.url, {
        preserveScroll: true,
        preserveState: true,
    })
}
</script>
