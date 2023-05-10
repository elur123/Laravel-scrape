<script setup>
import { ref } from 'vue';
import { Link, Head } from '@inertiajs/vue3';
import BarChart from '@/Components/BarChart.vue'


const chartData = {
        labels: [ 'January', 'February', 'March' ],
        datasets: [{ 
            label: 'Data One',
            backgroundColor: '#f87979',
            data: [40, 20, 12] 
        }]
}

const props = defineProps({
    data: Object,
});

console.log(props.data);

</script>

<template>
    <Head title="Dashboard" />

     <div>
        <div class="min-h-screen bg-gray-100">
            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="w-full py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Product Statistics</h2>
                     <Link
                        :href="route('products')"
                        class="font-semibold text-pink-500 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                        >Products
                    </Link>
                </div>
            </header>

            <!-- Page Content -->
            <div class="py-12">
                <div class="w-full sm:px-6 lg:px-8">
                    <div class="h-5/6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <BarChart
                                id="my-chart-id"
                                :chartData="data"
                            />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
