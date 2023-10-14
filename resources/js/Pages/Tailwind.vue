<script setup>

import { Head, Link } from '@inertiajs/vue3';

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

  console.log('THE PROPS',this.products)

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
<div class="h-full w-full bg-slate-100">
    <nav class="bg-green-400 p-6">
        <div class="container mx-auto flex justify-between items-center">
            <a>My website</a>
            <!-- Navigation Menu (Desktop)-->
            <ul class="hidden md:flex space-x-4">
                <li><a  class="text-white hover:text-blue-200">Home</a></li>
                <li><a  class="text-white hover:text-blue-200">About</a></li>
                <li><a  class="text-white hover:text-blue-200">Service</a></li>
                <li><a  class="text-white hover:text-blue-200">Contact</a></li>
            </ul>
            <!-- Mobile menu (hamburger icon)--->
            <div class="md:hidden">
                <button id="mobile-menu-toggle"  @click="toggleButton()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Dropdown-->
    <div v-if="mobileMenuOpen" id="mobile-menu" class="md:hidden bg-blue-500 text-white " >
        <ul class="bg-gray-800">
            <l1 class="bg-blue-500"> <a :href="route('products.edit')" class="block py-1 px-4 hover:bg-gray-400">Manage Products</a></l1>
            <l1 class="bg-blue-500"><a href="" class="block py-1 px-4 hover:bg-gray-400">Home</a></l1>
            <l1 class="bg-blue-500"><a href="" class="block py-1 px-4 hover:bg-gray-400">Home</a></l1>
            <l1 class="bg-blue-500"><a href="" class="block py-1 px-4 hover:bg-gray-400">Home</a></l1>
        </ul>
    </div>



    <div class="py-8 px-8">
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
        <div class="flex justify-center items-center">
          <div class="relative text-gray-600">
              <!-- <input v-model="searchQuery" type="search" name="search" placeholder="Search..." class="bg-white h-10 px-5 pr-10 rounded-full text-sm focus:outline-none w-64 border-gray-200"> -->
              <input v-model="searchQuery" class="rounded-full" type="text" placeholder="Search products...">
              <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
                  <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M15.5 14h-.79l-.28-.27a6.5 6.5 0 0 0 1.48-5.34C16.7 6.01 13.69 3 10 3a7 7 0 0 0-7 7c0 3.68 3.01 6.7 6.73 6.95A6.5 6.5 0 0 0 14 15.5h.79l4.25 4.25a1 1 0 0 0 1.41-1.41l-4.25-4.25v-.79a6.5 6.5 0 0 0-6.5-6.5zM10 13a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/></svg>
              </button>
          </div>
      </div>


    <!-- Replace this with your item content -->
        <!-- <div class="bg-gray-200 p-4">Item 1</div>
        <div class="bg-gray-200 p-4">Item 2</div>
        <div class="bg-gray-200 p-4">Item 3</div>
        <div class="bg-gray-200 p-4">Item 3</div> -->
    <!-- Add more items here as needed -->


    <!-- <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
  <div class="md:flex">
    <div class="md:shrink-0">
      <img class="h-48 w-full object-cover md:h-full md:w-48" src="/img/building.jpg" alt="Modern building architecture">
    </div>
    <div class="p-8">
      <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Company retreats</div>
      <a href="#" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">Incredible accommodation for your team</a>
      <p class="mt-2 text-slate-500">Looking to take your team away on a retreat to enjoy awesome food and take in some sunshine? We have a list of places to do just that.</p>
    </div>
  </div>
</div> -->


<!-- <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
  <div class="md:flex">
    <div class="md:shrink-0">
      <img class="h-48 w-full object-cover md:h-full md:w-48" src="/img/building.jpg" alt="Modern building architecture">
    </div>
    <div class="p-8">
      <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Company retreats</div>
      <a href="#" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">Incredible accommodation for your team</a>
      <p class="mt-2 text-slate-500">Looking to take your team away on a retreat to enjoy awesome food and take in some sunshine? We have a list of places to do just that.</p>
    </div>
  </div>
</div> -->


<div v-for="product in filteredProducts" :key="product.id" class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
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






</div>

 
    

</template>
