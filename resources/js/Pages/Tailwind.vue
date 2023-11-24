<script setup>

import { Head, Link } from '@inertiajs/vue3';
import ResponsiveSidebar from '@/Components/ResponsiveSidebar.vue';
import AnotherNav from '@/Components/AnotherNav.vue';
import SearchBar  from '@/Components/SearchBar.vue';


</script>

<script>

export default {

props:{
    products:[],
},

data(){
    return {
      mobileMenuOpen:false,
      searchQuery: '',
      pages: [
        { name: 'Home', url: '/' },
        { name: 'About', url: '/about' },
        { name: 'Contact', url: '/contact' },
        // Add more pages as needed
      ],
    }
},

setup(){

},

computed: {
    filteredProducts() {
      return this.products.filter(product =>
        product.product_name.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    },
},

mounted(){


},

    methods:{

        toggleButton(){
           if(this.mobileMenuOpen == false){
              this.mobileMenuOpen = true
           }else{
              this.mobileMenuOpen = false
           }
        }


    }

}
</script>

<template>
<div class="h-full w-full bg-black">
        <div class="fixed top-0 left-0 right-0 z-10">
            <ResponsiveSidebar :pages = "pages" v-model="searchQuery"/>
            <Link />
        </div>

     

  
           <!-- <SearchBar v-model="searchQuery"/> -->
        

        <div class="py-4 px-4">
            <div class="max-w-md mx-auto bg-orange-300 rounded-xl shadow-md overflow-hidden md:max-w-2xl">
                <div class="md:flex">
                    <div class="md:shrink-0">
                        <img class="h-24 w-24 object-cover md:h-full md:w-48" src="http://127.0.0.1:5173/public/images/IMG-20231010-WA0008.jpg" alt="Modern building architecture">
                    </div>
                    <div class="p-8">
                    <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Fast Secure Online Shopping</div>
                    <a href="#" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">We Offer the best services</a>
                        <p class="mt-2 text-slate-500">Shop arround using our navigation</p>
                    </div>
                </div>
            </div>
        </div>

        <!--PRODUCT DISPLAY-->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-3 gap-4 px-4">
            <div v-for="product in filteredProducts" :key="product.id" class="mx-auto bg-gray-200 rounded-xl shadow-md overflow-hidden md:max-w-2xl">
                <div class="md:flex">
                    <div class="md:shrink-0">
                        <img class="h-48 w-full object-cover md:h-full md:w-48 rounded-full px-4 py-4" :src="product.image_file_name" alt="Modern building architecture">
                    </div>
                    <div class="p-8">
                        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{product.product_name}}</div>
                        <a href="#" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">R{{product.price}}</a>
                        <p class="mt-2 text-slate-500">{{product.product_descruption}}</p>
                    </div>
                    <div class="p-4">
                        <button class="bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded">
                        <a :href="route('addProductToCart', { prod_id: product.id })" class="px-4 py-2 text-indigo-600 hover:text-indigo-900">Add to cart</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <footer class="fixed bottom-0 left-0 right-0 text-white p-2" style="background-color:#06ce20;">
        <!-- Your footer content here -->
            <p>&copy; 2023 Your Company</p>
        </footer>
</div>
</template>
