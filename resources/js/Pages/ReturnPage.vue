<script setup>

import { Head, Link } from '@inertiajs/vue3';

</script>

<script>

export default {

props:{

},

data(){
    return {

      searchBar:false,
      gategoryDropdown:false,
      mobileMenuOpen:false,
      searchQuery: '',
      routes:[
        'profile.edit',
        'profile.update',
        'profile.destroy',
      ],
      categories:[
        'Indoor',
        'Outdoor',
        'Edibles',
      ]
 
    }
},

setup(){

},

computed: {

    
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
        },

        toggleSearchButton(){

            if(this.searchBar == false){
                this.searchBar = true
            }else{
                this.searchBar = false
            }

        },

        toggleCatButton(){

            if(this.gategoryDropdown == false){
                this.gategoryDropdown = true
            }else{
                this.gategoryDropdown = false
            }

        }




    }

}
</script>

<template>
               <!--Top Nav-->
               <nav class="fixed flex flex-row justify-between items-center bg-green-300 w-full p-2 z-10">
                <!-- Side Bar Toggle -->
                <button @click="toggleButton" type="submit" class="p-2 bg-white rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
                <!-- Search Input -->
                <input v-if="this.searchBar" type="text" placeholder="Search Products..." v-model="searchQuery" class="border border-gray-300 rounded-full py-2 px-4 focus:outline-none focus:border-blue-500 mx-auto" />
                <!-- Right Top Search Button -->
                <button @click="toggleSearchButton" type="submit" class="absolute right-0 top-0 mt-3 mr-4">
                    <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path class="heroicon-ui" d="M15.5 14h-.79l-.28-.27a6.5 6.5 0 0 0 1.48-5.34C16.7 6.01 13.69 3 10 3a7 7 0 0 0-7 7c0 3.68 3.01 6.7 6.73 6.95A6.5 6.5 0 0 0 14 15.5h.79l4.25 4.25a1 1 0 0 0 1.41-1.41l-4.25-4.25v-.79a6.5 6.5 0 0 0-6.5-6.5zM10 13a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
                    </svg>
                </button>
            </nav>
            <!--SideNavbar-->
        <div class="flex flex-col">
            <div v-if="this.mobileMenuOpen" class="h-screen fixed bg-green-300 flex flex-col w-40 items-center py-8 mt-10">
                <l1  class="p-2 border-b border-gray-600 hover:bg-gray-600 active:bg-violet-700 text-white w-full"> <a :href="route('products.edit')">Manage Products</a></l1>
                <l1  class="p-2 border-b border-gray-600 hover:bg-gray-600 active:bg-violet-700 text-white w-full"> <a :href="route('products.edit')">Manage Products</a></l1>
                <l1  class="p-2 border-b border-gray-600 hover:bg-gray-600 active:bg-violet-700 text-white w-full"> <a :href="route('products.edit')">Manage Products</a></l1>
                <l1  class="p-2 border-b border-gray-600 hover:bg-gray-600 active:bg-violet-700 text-white w-full"> <a :href="route('products.edit')">Manage Products</a></l1>
                <Link class="p-2 border-b border-gray-600 hover:bg-gray-600 active:bg-violet-700 text-white w-full">Login</Link>
                <div @click="toggleCatButton" class="p-2 border-b border-gray-600 hover:bg-gray-600 active:bg-violet-700 text-white w-full">Categories <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 12.18l-4.94-4.95-1.41 1.41L10 14l6.36-6.36-1.41-1.41L10 12.18z"/>ratatata</svg></div>
                <l1 v-if="gategoryDropdown" v-for="(category,index) in categories" :key="index"  class="bg-red-300 p-2 border-b border-gray-600 hover:bg-gray-600 active:bg-violet-300 text-white w-full"> <a :href="route('products.edit')">{{category}}</a></l1>
            </div>  
    
            <!--DISPLAY PRODUCTS-->
            <div class="container mx-auto py-10 bg-local">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-3 gap-2 px-4">
         
                </div>
            </div>
      </div>

</template>
