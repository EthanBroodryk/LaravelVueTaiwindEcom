

<template>
    <div class="h-full w-full bg-white">
        <nav class="bg-green-400 p-4"  style="position: fixed; top: 0; left: 0; right: 0; z-index: 999;">
            <div class="container mx-auto flex justify-between items-center">
                <a>My website</a>
                <!-- Navigation Menu (Desktop)-->
                <div class="flex justify-center">
                    <img src="http://127.0.0.1:5173/public/images/roundshoppingcart.png" class="card-img-top w-10 h-10 rounded-full  mb-8">
                    <span v-if="this.cartItemCount > 0" class="mr-5">{{this.cartItemCount}}</span>
                    <span v-if="this.totalPrice > 0" class="mr-5">{{this.totalPrice}}</span>
                </div>
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

<!--Search Button-->
        <div class="flex justify-center items-center mt-40">
            <div class="relative text-gray-600">
                <!-- <input v-model="searchQuery" type="search" name="search" placeholder="Search..." class="bg-white h-10 px-5 pr-10 rounded-full text-sm focus:outline-none w-64 border-gray-200"> -->
                <input v-model="searchQuery" class="rounded-full" type="text" placeholder="Search products...">
                <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
                    <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M15.5 14h-.79l-.28-.27a6.5 6.5 0 0 0 1.48-5.34C16.7 6.01 13.69 3 10 3a7 7 0 0 0-7 7c0 3.68 3.01 6.7 6.73 6.95A6.5 6.5 0 0 0 14 15.5h.79l4.25 4.25a1 1 0 0 0 1.41-1.41l-4.25-4.25v-.79a6.5 6.5 0 0 0-6.5-6.5zM10 13a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/></svg>
                </button>
            </div>
        </div>
<!--End Of Search Button-->

        <div class="flex justify-center p-8 border-2 mx-8 md:mx-40 mt-20 bg-green-200">
            <div class="grid grid-cols-1 md:grid-cols-4 md:gap-40 gap-4">
                <div  v-for="(item, index) in productArray" :key="index" class="bg-white rounded-lg border-2">
                    <div class="p-4">
                        <img  v-bind:src="item.image_file_name" class="card-img-top w-30 h-30  mb-8">
                            <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{item.product_name}}</div>
                        <div class="flex">
                            <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Item Total:</div>
                            <p v-if="item.individualItemCount > 0" class="ml-2">{{item.individualItemCount}}</p>
                        </div>
                        <a href="#" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">R{{item.price}}</a>
                        <p class="mt-2 text-slate-500">{{item.product_descruption}}</p>
                        <button  @click="addIndividualItemPrice(item.price,item.id)" class="inline-flex items-center px-4 py-2 mt-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">+</button>
                        <button  @click="deductIndividualItemPrice(item.price,item.id)" class="inline-flex items-center px-4 py-2 mt-2 ml-4 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">-</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {ref} from 'vue'
export default {

    props:{
        product:[],
    },
    
    data(){
        return {
            cartTotal: 0,
            cart:[],
            productArray:[],
            itemCount: 0,
            totalPrice:0,
            cartItemCount:0,
            individualItemCount:0,
       
        }
    },

    setup(){
        const count = ref(0)
        return {
            count
        }
    },
    mounted(){
        console.log('the prod',this.product)
        this.product.quantity = 1
        this.getItemFromLocalStorage();
        const storedProducts = localStorage.getItem('productArray');
        if(storedProducts){
            this.productArray = JSON.parse(storedProducts)
        }
            for (let i = 0; i <  this.productArray.length ; i++) {
                if(this.productArray[i].id == this.product.id){
                   this.itemCount += 1
                }
            }
            if(this.itemCount > 0){

            }else{
                this.product.individualItemCount = 1;
                this.productArray.push(this.product)
                this.totalPrice += parseInt(this.product.price)
                localStorage.setItem('totalPrice',JSON.stringify(this.totalPrice))
                this.cartItemCount +=  this.product.individualItemCount
                localStorage.setItem('cartItemCount',JSON.stringify(this.cartItemCount))
                console.log('target',this.totalPrice)
            }
            localStorage.setItem('productArray',JSON.stringify(this.productArray))
    },

    methods:{
        saveItemToLocalStorage(x,type){
           if(type == 'totalPrice'){
              localStorage.setItem('totalPrice',x)
            }
            if(type == 'cartItemCount'){
              localStorage.setItem('cartItemCount',x)
            }
        },
        getItemFromLocalStorage(){
            const storedTotal = localStorage.getItem('cartTotal');
            const cartItemCountTotal = localStorage.getItem('cartItemCount');
            const totalPriceTotal =  localStorage.getItem('totalPrice');
            if(cartItemCountTotal){
                this.cartItemCount = parseInt(cartItemCountTotal)
            }
            if(storedTotal){
                this.cartTotal = parseInt(storedTotal)
            }
            if(totalPriceTotal){
                this.totalPrice = parseInt(totalPriceTotal)
            }
        },



   //GrandTotals
       addIndividualItemPriceTotal(itemPrice,product_id){
            console.log('the price', this.totalPrice);
            for(let i = 0;i < this.productArray.length;i++){
                if(product_id == this.productArray[i].id){
                    this.productArray[i].individualItemCount = (parseInt(this.productArray[i].individualItemCount) || 0) +1;
                    this.cartItemCount += 1;
                    this.totalPrice += parseInt(itemPrice);
                    localStorage.setItem('totalPrice',JSON.stringify(this.totalPrice))
                    localStorage.setItem('productArray',JSON.stringify(this.productArray))
                    this.saveItemToLocalStorage(this.totalPrice,'totalPrice');
                    this.saveItemToLocalStorage(this.cartItemCount,'cartItemCount');
                }
            }
    },
    deductIndividualItemPriceTotal(itemPrice,product_id){
        for(let i = 0;i < this.productArray.length;i++){
            if(product_id == this.productArray[i].id){
                console.log('the pricefdgre', this.totalPrice);
                this.productArray[i].individualItemCount = (parseInt(this.productArray[i].individualItemCount)) - 1;
                localStorage.setItem('productArray',JSON.stringify(this.productArray))
                this.cartItemCount -= 1;
                localStorage.setItem('cartItemCount',JSON.stringify(this.cartItemCount))
                if( this.totalPrice > 0){
                    this.totalPrice -=  parseInt(itemPrice);
                    localStorage.setItem('totalPrice',JSON.stringify(this.totalPrice))
                }
              
            }
        }
    
  },
    addIndividualItemPrice(itemPrice, product_id) {
        for (let i = 0; i < this.productArray.length; i++) {
            if (product_id == this.productArray[i].id) {
                this.productArray[i].itemTotal = (parseInt(this.productArray[i].itemTotal) || 0) + parseInt(itemPrice);
                console.log('this.productArray[i].itemTotal',this.productArray[i].itemTotal)
            }
        }

        this.addIndividualItemPriceTotal(itemPrice,product_id);
    },  

    deductIndividualItemPrice(itemPrice, product_id) {
        for (let i = 0; i < this.productArray.length; i++) {
            if (product_id == this.productArray[i].id) {
                console.log('hog')
                if(this.productArray[i].individualItemCount > 0){
                    this.productArray[i].itemTotal = (parseInt(this.productArray[i].itemTotal) || 0) - parseInt(itemPrice);
                    this.deductIndividualItemPriceTotal(itemPrice,product_id)
                }
            }
        }
    },  


    }

}

</script>