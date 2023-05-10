<template>
  <div class="flex justify-start">
    <nav class="inline-flex">
      <ul class="flex flex-row">
        <li v-for="(page, index) in pages" :key="index">
          <Link :href="page.url" :class="{ 'bg-pink-500 text-white': page.active, 'bg-white text-pink-500': !page.active }" class="px-4 py-2 border border-gray-300 hover:border-pink-500">{{ index === 0 ? 'Previous' : (index === (pages.length - 1) ? 'Next' : page.label) }}</Link>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    pages: Array,
});



</script>
