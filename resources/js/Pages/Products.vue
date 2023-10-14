<script setup>
import { Head, Link } from '@inertiajs/vue3';
import theme from 'tailwindcss/defaultTheme';
import { useForm,usePage } from '@inertiajs/vue3'

import TextInput from '@/Components/TextInput.vue';
const user = usePage().props.auth.user;

const form = useForm({
  name: null,
  avatar: null,
  user_id: user.id,
  product_name:null,
  product_description:null,
  price:null,
})



</script>

<script>

export default {

props:{
    products:[],
},

data(){
    return {
      mobileMenuOpen:false,
      showAddProducts:false,
      showUpdateProducts:false,
      deleteProducts:false,
      confirmDelete:false,
      searchQuery: '',
      productForMessage:'',
      showModal:false,
      deleteProductId:null,
    
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

        openModal(id){
            this.showModal = true;
            this.deleteProductId = id;
        },
        closeModal() {
            this.showModal = false;
        },

        toggleButton(){
           if(this.mobileMenuOpen == false){
              this.mobileMenuOpen = true
           }else{
              this.mobileMenuOpen = false
           }
        },
        confirmDeleteButton(id){
            for(let i = 0;i < this.products.length;i++){
                console.log(this.products[i].id,'and ',id)
                if(this.products[i].id == id){
                    console.log('targer')
                    this.products[i].confirmed = true
                    this.productForMessage = this.products[i].product_name
                }
         
            }
        },
        changeModal(x){
            switch(x){
                case 'showAddProducts':
                    if(this.showAddProducts == false){
                        this.showAddProducts = true
                    }else{
                        this.showAddProducts = false
                    }
                break;
                case 'showUpdateProducts':
                    if(this.showUpdateProducts == false){
                        this.showUpdateProducts = true
                    }else{
                        this.showUpdateProducts = false
                    }
                break;
                case 'deleteProducts':
                    if(this.deleteProducts == false){
                            this.deleteProducts = true
                    }else{
                        this.deleteProducts = false
                    }
                break;

                default:

            }

        },

        sendData(){
            this.closeModal();
            usePage.inertia.post('productDelete',{prod_id:this.deleteProductId})

        },

    }

}
</script>
<template>
<div class="h-full w-full bg-gradient-to-r from-gray-500">
    <nav class="bg-gradient-to-r from-green-700 via-green-200 to-green-700 p-6">
            <div class="container mx-auto flex justify-between items-center">
                <a>Manage Products</a>
                <!-- Navigation Menu (Desktop)-->
                <ul class="hidden md:flex space-x-4">
                    <li><a  class="text-white hover:text-blue-200">Home</a></li>
                    <li><a  class="text-white hover:text-blue-200">About</a></li>
                    <li><a  class="text-white hover:text-blue-200">Service</a></li>
                    <li><a  class="text-white hover:text-blue-200">Contact</a></li>
                </ul>
                <!-- Mobile menu (hamburger icon)--->
                <div class="md:hidden">
                    <button id="mobile-menu-toggle" class="text-white" @click="toggleButton()">
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
                <l1 class="bg-blue-500"><Link :href="route('products.edit')" class="block py-1 px-4 hover:bg-gray-400" >Dashboard</Link></l1>
                <l1 class="bg-blue-500"><a href="" class="block py-1 px-4 hover:bg-gray-400">Home</a></l1>
                <l1 class="bg-blue-500"><a href="" class="block py-1 px-4 hover:bg-gray-400">Home</a></l1>
                <l1 class="bg-blue-500"><a href="" class="block py-1 px-4 hover:bg-gray-400">Home</a></l1>
            </ul>
        </div>
    </div>
    <br>
    <div class="flex justify-center items-center">
        <div class="relative text-gray-600">
            <!-- <input v-model="searchQuery" type="search" name="search" placeholder="Search..." class="bg-white h-10 px-5 pr-10 rounded-full text-sm focus:outline-none w-64 border-gray-200"> -->
            <input v-model="searchQuery" class="rounded-full" type="text" placeholder="Search products...">
            <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
                <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M15.5 14h-.79l-.28-.27a6.5 6.5 0 0 0 1.48-5.34C16.7 6.01 13.69 3 10 3a7 7 0 0 0-7 7c0 3.68 3.01 6.7 6.73 6.95A6.5 6.5 0 0 0 14 15.5h.79l4.25 4.25a1 1 0 0 0 1.41-1.41l-4.25-4.25v-.79a6.5 6.5 0 0 0-6.5-6.5zM10 13a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/></svg>
            </button>
        </div>
    </div>
    <br>
    <br>
    <!--PRODUCTS TABLE-->
    <!-- <div class="overflow-x-auto px-4 sm:px-8"> 
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="px-3 sm:px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">Product ID</th>
                    <th class="px-3 sm:px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">Product Name</th>
                    <th class="px-3 sm:px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">Description</th>
                    <th class="hidden sm:table-cell px-3 sm:px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">PRODUCT IMAGE</th>
                    <th class="px-3 sm:px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">PRICE</th>
                    <th class="px-3 sm:px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">ADD</th>
                    <th class="px-3 sm:px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">EDIT</th>
                    <th class="px-3 sm:px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">DELETE</th>
                </tr>
            </thead>
            <tbody>
             
                <tr v-for="product in filteredProducts" :key="product.id">
                    <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-no-wrap border-b border-gray-200">{{product.id}}</td>
                    <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-no-wrap border-b border-gray-200">{{product.product_name}}</td>
                    <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-no-wrap border-b border-gray-200">{{product.product_descruption}}</td>
                    <td class="hidden sm:table-cell px-3 sm:px-6 py-2 sm:py-4 whitespace-no-wrap border-b border-gray-200">
                        <img class="w-10 h-10" :src="product.image_file_name" alt="Product Image">
                    </td>
                    <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-no-wrap border-b border-gray-200">{{product.price}}</td>
                    <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-no-wrap border-b border-gray-200">
                        <a :href="route('productsAddPage')" class="text-green-600 hover:text-indigo-900">Add</a>
                    </td>
                    <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-no-wrap border-b border-gray-200">
                        <a :href="route('editProduct', { prod_id: product.id })" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                    </td>
                    <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-no-wrap border-b border-gray-200">
                        <a  @click="openModal(product.id)" class="text-red-600 hover:text-indigo-900">Delete</a>
                    </td>
                </tr>
           
            </tbody>
        </table>
    </div>  -->
    <!--END OF PRODUCTS TABLE-->
    <!--MODAL-->
    <div v-if="showModal" class=" inset-0 flex items-center justify-center ">
    <!-- Modal backdrop -->
        <div class="fixed  bg-black opacity-50"></div>
    <!-- Modal content -->
        <div class="bg-white p-4 rounded shadow-lg">
            <h2 class="text-red-600 text-lg font-semibold mb-4">Warning!</h2>
            <!-- <Link  class="text-red-600 hover:text-indigo-900" :href="route('productDelete')">Are You Sure?</Link> -->
            <button @click="sendData()" class="text-yellow-600  font-bold">Are You Sure?</button>

            <div class="mt-1 flex justify-center">
                <Link @click="closeModal()" class="text-red-600 hover:text-indigo-900 mr-4" :href="route('productDelete')" method="post"  :data="{prod_id:this.deleteProductId}">Yes</Link>
                <button @click="closeModal()" class="text-blue-600 hover:text-red-800 ml-4">Close</button>
            </div>
        </div>
    </div>
     <!--END OF MODAL -->


     <!---->
    <div class="flex justify-center items-center ">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"><a :href="route('productsAddPage')" >Add New Product</a></button>
    </div>
     <div class="container mx-auto p-8 bg-white rounded">
        <form @submit.prevent="submit" class="bg-gray-100 shadow-md border-1 border-slate-500 rounded  pt-2 pb-2 mb-1">
        <div class="grid grid-cols-2 gap-4 md:flex md:flex-wrap justify-center" v-for="product in filteredProducts" :key="product.id">
            <!-- Input 1 -->
            <div class="mb-4">
                <label class="block text-dark text-sm font-bold mb-2" for="input1">
                PRODUCT ID
                </label>
                <!-- <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="input1" type="text" placeholder="Input 1"> -->
                <input required  class="shadow appearance-none rounded-lg border-2 border-gray-400 w-24 py-1.5 px-3 text-gray-700 leading-tight" type="text" disabled :placeholder="product.id"/>
            </div>
            <div class="mb-4">
                <label class="block text-dark  text-sm font-bold mb-2" for="input1">
                PRODUCT NAME
                </label>
                <!-- <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="input1" type="text" placeholder="Input 1"> -->
                <input required  class="shadow appearance-none rounded-lg border-2 border-gray-400 w-full py-1.5 px-3 text-gray-700 leading-tight" type="text" disabled :placeholder="product.product_name"/>
            </div>
            <div>
            <div class="mb-4">
                <label class="block text-dark  text-sm font-bold mb-2" for="input1">
                DESCRIPTION
                </label>
                <!-- <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="input1" type="text" placeholder="Input 1"> -->
                <textarea class="shadow appearance-none rounded-lg border-2 border-gray-400 w- py-1.5 px-3 text-gray-700 leading-tight" type="text" disabled >{{  product.product_descruption}}</textarea>
            </div>
            </div>
            <div class="mb-4">
                <label class="block  text-dark  font-bold mb-2" for="input1">
                PRICE
                </label>
                <!-- <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="input1" type="text" placeholder="Input 1"> -->
                <input required  class="shadow appearance-none rounded-lg border-2 border-gray-400 w-24 py-1.5 px-3 text-gray-700 leading-tight" type="number" disabled :placeholder="product.price"/>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="input1">
                  
                </label>
                  <a :href="route('editProduct', { prod_id: product.id })" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                <!-- <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="input1" type="text" placeholder="Input 1"> -->
                <div class="px-3 sm:px-6 py-3"></div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="input1">
                    <a  @click="openModal(product.id)" class="text-red-600 hover:text-indigo-900">Delete</a>
                </label>
                <!-- <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="input1" type="text" placeholder="Input 1"> -->
          
            </div>
            </div>
        </form>
    </div>




</template>
