<script setup>
import { Head, Link } from '@inertiajs/vue3';
import theme from 'tailwindcss/defaultTheme';
import { useForm,usePage } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue';
const user = usePage().props.auth.user;


const form = useForm({
 
     avatar: null,
     user_id: user.id,
     product_name:null,
     product_description:null,
     price:null,
//   product_id:prod_id,

})

const submit = () => {
    form.post(route('productAdd'));
    form.reset('product_name',)
    form.reset('product_description')
    form.reset('price')
};

</script>

<script>

export default {

props:{
    product:[],
},

data(){
    return {
      mobileMenuOpen:false,
      showAddProducts:false,
      showUpdateProducts:false,
      deleteProducts:false,
      imageSrc:null,
    }
},

setup(){

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

        handleFileChange(event) {
            
            const file = event.target.files[0];
            if (file) {
                // Create a FileReader object
                const reader = new FileReader();

                // Define an event listener for when the file is loaded
                reader.onload = (e) => {
                this.imageSrc = e.target.result; // Set the image source to the loaded data
                };

                // Read the file as a data URL (base64)
                reader.readAsDataURL(file);
            } else {
                this.imageSrc = null; // Reset the image source if no file is selected
            }

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


        <!-- Mobile Menu Dropdown-->
 
  
    <br>


   
<!-- Add Product Form-->

    <div class="container mx-auto p-4 bg-gray-300">
        <form @submit.prevent="submit" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="grid grid-cols-1 gap-4 md:flex md:flex-wrap justify-center">
            <!-- Input 1 -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="input1">
                Product Image
                </label>
                <!-- <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="input1" type="text" placeholder="Input 1"> -->
                <input required  class="shadow appearance-none rounded-lg border-2 border-gray-400 w-full py-1.5 px-3 text-gray-700 leading-tight" type="file"  @input="form.avatar = $event.target.files[0]"/>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="input1">
                 Product Name
                </label>
                <!-- <input class="shadow appearance-none border-none w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="input1" type="text" placeholder="Input 1"> -->
                <TextInput required  id="product_name" ref="product_name" v-model="form.product_name" type="text" placeholder="Product Name" class="shadow appearance-none rounded-lg border-2 border-gray-400 w-full py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"/>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="input1">
                 Product Desc
                </label>
                <!-- <input class="shadow appearance-none border-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="input1" type="text" placeholder="Input 1"> -->
                <TextInput required  id="product_description" ref="product_description" v-model="form.product_description" type="text" placeholder="Product Description" class="shadow appearance-none rounded-lg border-2 border-gray-400 w-full py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"/>
            </div>

            <!-- Input 2 -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="input2">
                 Price
                </label>
                <!-- <input class="shadow  border-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="input2" type="text" placeholder="Input 2"> -->
                <TextInput id="price" required ref="price" v-model="form.price" type="number" placeholder="R" class="shadow appearance-none rounded-lg border-2 border-gray-400 w-full py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"/>
            </div>

            <!-- Repeat the above structure for Input 3 to Input 8 -->
            <!-- ... -->

            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-center">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Add Product
            </button>
            </div>
        </form>
    </div>



<!-- End Product Form-->
  
</template>
