<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import Search from '@/Components/Search.vue';
import { ref } from 'vue';

const props = defineProps({
    products: Object,
    search: Object
});

const form = useForm({
    product_name: '',
    price: '',
    product_ingredients: '',
    quantity: ''
})

function update(product) {
    form.product_name = product.product_name
    form.price = product.price
    form.product_ingredients = product.product_ingredients
    form.quantity = product.quantity

    form.put(route('products.update', product), {
        preserveScroll: true,
        preserveState: true,
    })
}

</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-100 selection:bg-red-500 selection:text-white"
    >

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-between items-center">
                <Search :search="search" placeholder="Search product..." />
                <Link
                    :href="route('products.all')"
                    class="font-semibold text-pink-500 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >Dashboard
                </Link>
            </div>

            <div class="mt-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                    <div
                        class="scale-100 group cursor-pointer p-6 bg-white from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500"
                        v-for="product in products.data" :key="product._id"
                    >
                        <div>
                            <div
                                class="w-full bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full"
                            >
                                <img :src="product.product_img" :alt="product.product_name">
                            </div>
                            
                            <input class="w-full p-0 border-0 mt-6 text-xl font-semibold text-gray-900 focus:border-0 focus:ring-0" type="text" ref="product_title" v-model="product.product_name">
                            
                            <input class="w-full p-0 border-0 mt-2 text-pink-500 text-xl leading-relaxed focus:border-0 focus:ring-0" type="text" ref="price" v-model="product.price">

                            <input class="p-0 border-0 mt-2 text-gray-700 text-xl leading-relaxed focus:border-0 focus:ring-0" type="number" ref="quantity" v-model="product.quantity">

                            <input class="w-full p-0 border-0 mt-2 text-gray-500 dark:text-gray-400 text-sm leading-relaxed focus:border-0 focus:ring-0" ref="product_ingredients" type="text" v-model="product.product_ingredients">
                        
                            <button class="w-full p-2 mt-2 bg-pink-500 text-white rounded invisible group-hover:visible" @click="update(product)">Update</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-16">
                <Pagination :pages="products.links" />
            </div>
        </div>
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
