<script setup>

import { Head, Link } from '@inertiajs/vue3';

</script>

<script>

export default {

props:{
  orders:[],
},

data(){
    return {
      mobileMenuOpen:false,
      searchQuery: '',
      searchId: "",
    }
},

setup(){

},

computed: {

    filteredOrders() {
      // Filter orders based on the searchId
      if(this.searchId == ""){
        return this.orders;
      }else{
        return this.orders.filter(order => order.id === parseInt(this.searchId));
      }
   
    }

},

mounted(){
    console.log('orders',this.orders)
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
    <div class="h-full w-full bg-slate-200">
        <!--Navbar-->
        <nav class="bg-green-400 p-6">
            <div class="container flex mx-auto justify-between items-center">
                <a>DaggaJa</a>
                <ul class="hidden md:flex space-x-4">
                    <a href="">1</a>
                    <a href="">2</a>
                    <a href="">3</a>
                    <a href="">4</a>
                </ul>
                <div class="md:hidden">
                    <button id="mobile-menu-toggle"  @click="toggleButton()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </nav>
        <div v-if="mobileMenuOpen" id="mobile-menu">
            <ul class="bg-gray-800">
                <l1 class="bg-blue-500"><a :href="route('products.edit')" class="block py-1 px-4 hover:bg-gray-400">Manage Products</a></l1>
                <l1 class="bg-blue-500"><a href="" class="block py-1 px-4 hover:bg-gray-400">Home</a></l1>
                <l1 class="bg-blue-500"><a href="" class="block py-1 px-4 hover:bg-gray-400">Home</a></l1>
                <l1 class="bg-blue-500"><a href="" class="block py-1 px-4 hover:bg-gray-400">Home</a></l1>
            </ul>
       </div>

       <!--Body-->
        <div class="container mx-auto p-8">
            <div class="flex flex-col">
                <!-- <input v-model="searchQuery" class="rounded-full" type="text" placeholder="Search products..."> -->
                <input v-model="searchId" class="rounded-full" placeholder="Enter Product ID" />
            </div>
            <div class="flex flex-row justify-center border rounded-md overflow-hidden">
                <!-- Hidden on medium and larger screens -->
                <div class="grid grid-cols-1 md:hidden  ">
                    <div v-for="(item, index) in filteredOrders" :key="index" class="border-b mt-10 bg-slate-100">
                        <div class="mt-2 border-b border-slate-300 p-2">Id:</div>
                        <div class="mt-2 border-b border-slate-300 p-2">Amount:</div>
                        <div class="mt-2 border-b border-slate-300 p-2">Item Name:</div>
                    </div>
                </div>
                <!-- Hidden on medium and larger screens -->
                <div class="grid grid-cols-1 md:hidden">
                    <div v-for="(item, index) in filteredOrders" :key="index" class="border-b w-full mt-10 border-b mt-10 bg-slate-100">
                        <div class="mt-2 border-b border-slate-300 text-green-600 p-2">{{ item.id }}</div>
                        <div class="mt-2 border-b border-slate-300 text-green-600 p-2">{{ item.amount_gross }}</div>
                        <div class="mt-2 border-b border-slate-300 text-green-600 p-2">{{ item.item_name }}</div>
                    </div>
                </div>
 
            </div>
        </div>
       <!--Small screen table-->
       <!--Large Table-->
        <div class="container mx-auto p-8 hidden md:block">
            <table class="w-full table-auto">
                <thead>
                    <tr>
                        <th class="border p-4 bg-slate-100">Column 1</th>
                        <th class="border p-4 bg-slate-100">Column 2</th>
                        <th class="border p-4 bg-slate-100">Column 3</th>
                    </tr>
                </thead>
                <tbody class="bg-slate-100">
                    <tr v-for="(item, index) in filteredOrders" :key="index">
                        <td class="border p-4">
                            {{ item.id }}
                        </td>
                        <td class="border p-4">
                            {{  item.amount_gross }}
                        </td>
                        <td class="border p-4">
                            {{  item.item_name }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
