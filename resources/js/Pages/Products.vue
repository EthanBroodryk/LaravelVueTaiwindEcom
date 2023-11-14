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

    <!--NAVBAR-->
<nav class="bg-gray-800 p-4 fixed top-0 w-full z-10">
        <div class="container flex mx-auto justify-between items-center">
            <a class="text-white">DaggaJa</a>
  <!--SEARCH BAR-->
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
    <!--SEARCH BAR-->
            <ul class="hidden md:flex space-x-4 text-white">
                <a :href="route('profile.edit')">Profile</a>
                <a href=""></a>
                <a href=""></a>
                <a href=""></a>
            </ul>
            <div class="md:hidden">
                <button id="mobile-menu-toggle" class="text-white"  @click="toggleButton()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <div v-if="mobileMenuOpen" id="mobile-menu" class="md:hidden">
        <ul class="bg-gray-800">
            <l1 class="bg-blue-500"><a :href="route('products.edit')" class="block py-1 px-4 hover:bg-gray-400">Manage Products</a></l1>
            <l1 class="bg-blue-500"><a href="" class="block py-1 px-4 hover:bg-gray-400">Home</a></l1>
            <l1 class="bg-blue-500"><a href="" class="block py-1 px-4 hover:bg-gray-400">Home</a></l1>
            <l1 class="bg-blue-500"><a href="" class="block py-1 px-4 hover:bg-gray-400">Home</a></l1>
        </ul>
    </div>
    <!--NAVBAR---->


    <!-- SIDENAV -->
<div class="hidden md:flex h-screen bg-gray-200">
  <aside class="w-40 h-full bg-gray-800 text-white fixed">
    <div class="p-4 text-2xl font-semibold">Sidebar</div>
    <ul>
      <li class="p-4 font-semibold hover:bg-gray-700"> <a :href="route('productsAddPage')">Add Product</a></li>
    </ul>
  </aside>

  <!-- Display on medium and large screens -->

  <div class="w-full">
    <div class="container mx-auto md:pl-40 pt-20">
      <table class="w-full table-auto">
        <thead>
          <tr>
            <th class="border p-4 bg-slate-100">Product ID</th>
            <th class="border p-4 bg-slate-100">Product Description</th>
            <th class="border p-4 bg-slate-100">Product Name</th>
            <th class="border p-4 bg-slate-100">Edit</th>
            <th class="border p-4 bg-slate-100">Delete</th>
          </tr>
        </thead>
        <tbody class="bg-slate-100">
          <tr v-for="product in filteredProducts" :key="product.id">
            <td class="border p-4">{{ product.id }}</td>
            <td class="border p-4">{{ product.product_descruption }}</td>
            <td class="border p-4">{{ product.product_name }}</td>
            <td class="border p-4">
              <a :href="route('editProduct', { prod_id: product.id })" class="text-indigo-600 hover:text-indigo-900">Edit</a>
            </td>
            <td class="border p-4">
              <a @click="openModal(product.id)" class="text-red-600 hover:text-indigo-900">Delete</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- Display on medium and large screens -->
  </div>
</div>
<!-- SIDENAV -->




 

    <!--Display Products On Small Screen-->
    <br>
    <br>
    <div class="container mx-auto p-4">
        <div class="flex flex-row justify-center  overflow-hidden">
            <!-- Hidden on medium and larger screens -->
            <div class="grid grid-cols-1 md:hidden  ">
                <div v-for="product in filteredProducts" :key="product.id" class="border-b mt-10 bg-gray-100">
                    <div class="mt-2 border-b border-slate-300 p-2">Id:</div>
                    <div class="mt-2 border-b border-slate-300 p-2">Product Name:</div>
                    <div class="mt-2 border-b border-slate-300 p-2">Product Description:</div>
                    <div class="mt-2 border-b border-slate-300 text-green-600 p-2">
                            <a :href="route('editProduct', { prod_id: product.id })" class="text-indigo-600 hover:text-indigo-900 mt-2 p-2">Edit</a>
                    </div>
                </div>
            </div>
            <!-- Hidden on medium and larger screens -->
            <div class="grid grid-cols-1 md:hidden">
                <div v-for="product in filteredProducts" :key="product.id" class="border-b w-full mt-10 border-b mt-10 bg-slate-100">
                    <div class="mt-2 border-b border-slate-300 text-green-600 p-2">{{ product.id }}</div>
                    <div class="mt-2 border-b border-slate-300 text-green-600 p-2">{{ product.product_descruption }}</div>
                    <div class="mt-2 border-b border-slate-300 text-green-600 p-2">{{ product.product_name }}</div>
                    <div class="mt-2 border-b border-slate-300 text-green-600 p-2">
                        <a  @click="openModal(product.id)" class="text-red-600 hover:text-indigo-900 mt-2 p-2">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!--Display Products On Small Screen-->

    <!--MODAL-->
    <div v-if="showModal" class="fixed flex items-center justify-center fixed top-0 w-full z-10 ">
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

</template>
