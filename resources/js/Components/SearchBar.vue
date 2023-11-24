<template>
    <div class="flex justify-center items-center py-8">
        <div class="relative text-gray-600">
            <input v-model="searchQuery" class="rounded-full" type="text" placeholder="Search products..." @input="$emit('update:modelValue', $event.target.value)">
            <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
                <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M15.5 14h-.79l-.28-.27a6.5 6.5 0 0 0 1.48-5.34C16.7 6.01 13.69 3 10 3a7 7 0 0 0-7 7c0 3.68 3.01 6.7 6.73 6.95A6.5 6.5 0 0 0 14 15.5h.79l4.25 4.25a1 1 0 0 0 1.41-1.41l-4.25-4.25v-.79a6.5 6.5 0 0 0-6.5-6.5zM10 13a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/></svg>
            </button>
        </div>
    </div>
</template>

<script setup>
    import { ref, defineProps } from 'vue';
    const searchQuery = ref('');
</script>