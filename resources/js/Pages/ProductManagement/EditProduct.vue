<script setup>
import { Head, Link } from '@inertiajs/vue3';
import theme from 'tailwindcss/defaultTheme';
import { useForm,usePage } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue';
import ResponsiveSidebar from '@/Components/ResponsiveSidebar.vue';

const user = usePage().props.auth.user;
const prod_id = usePage().props.product.id;
const product_name = usePage().props.product.product_name;
const product_description = usePage().props.product.product_descruption;
const price  = usePage().props.product.price;
const image = usePage().props.product.image_file_name;

const form = useForm({
 
  avatar: image,
  user_id: user.id,
  product_name:product_name,
  product_description:product_description,
  price:price,
  product_id:prod_id,

})

const submit = () => {
    form.post(route('productUpdate'));
    form.reset('product_name',)
    form.reset('product_description')
    form.reset('price')
};

const  cancel = () => {
    post(route('productEdit'));
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
<ResponsiveSidebar :pages="pages"/>



<!-- SIDENAV -->
<div class="hidden md:flex h-screen">

    <div class="container pl-40 pt-20">
        <form @submit.prevent="submit" class="shadow-md rounded px-4 pt-6 pb-8 mb-4 drop-shadow-2xl rounded-xl">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                <div class="mb-4">
                    <label style="color: rgb(20, 20, 1);" class="block text-gray-700 text-sm font-bold mb-4" for="username">
                        Current Product Image
                    </label>
                    <img class="w-20 h-20" :src="product.image_file_name" alt="CurrentProduct Image">
                </div>
                <div class="mb-4">
                    <label style="color: rgb(20, 20, 1);" class="block text-gray-700 text-sm font-bold mb-4" for="username">
                        Choose New Product Image
                    </label>
                    <input style="color:red" type="file"  @input="form.avatar = $event.target.files[0]" @change="handleFileChange" />
            
                    <input type="hidden" @input="form.user_id = user.id"/>
                    <input type="hidden" @input="form.product_id = prod_id"/>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="product_name">
                        Product Name
                    </label>
                    <TextInput
                        id="current_password"
                        ref="currentPasswordInput"
                        v-model="form.product_name"
                        type="text"
                        
                        :placeholder="product.product_name"
                        class="mt-1 block w-full"

                    />
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Product Description
                    </label>
                    <TextInput
                        id="current_password"
                        ref="currentPasswordInput"
                        v-model="form.product_description"
                        :placeholder="product.product_descruption"
                        type="text"
                        
                        class="mt-1 block w-full"

                    />
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Product Price
                    </label>
                    <span class="p-1">R</span>
                    <input class="rounded" type="number"  required :placeholder="product.price" id="price"   v-model="form.price"/>
                </div>
                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit"
                        >
                        Update
                    </button>
                    <button
                        @click="cancel"
                        class="bg-yellow-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit"
                        >
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- SIDENAV -->

<!--SMALL SCREEN DISPLAY-->
<form @submit.prevent="submit" class="bg-gray-100 shadow-md rounded px-4 pt-20 pb-8 mb-4 drop-shadow-2xl rounded-xl">

<div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
    <div class="mb-4">
        <label style="color: rgb(20, 20, 1);" class="block text-gray-700 text-sm font-bold mb-4" for="username">
        Current Product Image
        </label>
        <img class="w-20 h-20" :src="product.image_file_name" alt="CurrentProduct Image">
    </div>
    <div class="mb-4">
        <label style="color: rgb(20, 20, 1);" class="block text-gray-700 text-sm font-bold mb-4" for="username">
        Choose New Product Image
        </label>
        <input style="color:red" type="file"  @input="form.avatar = $event.target.files[0]" @change="handleFileChange" />

        <input type="hidden" @input="form.user_id = user.id"/>
        <input type="hidden" @input="form.product_id = prod_id"/>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="product_name">
        Product Name
        </label>
        <TextInput id="current_password" ref="currentPasswordInput" v-model="form.product_name" type="text" :placeholder="product.product_name" class="mt-1 block w-full"/>
    </div>
    <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
        Product Description
        </label>
        <TextInput id="current_password" ref="currentPasswordInput" v-model="form.product_description" :placeholder="product.product_descruption" type="text" class="mt-1 block w-full" />
    </div>
    <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
        Product Price
        </label>
        <span class="p-1">R</span>
        <input class="rounded" type="number"  required :placeholder="product.price" id="price"   v-model="form.price"/>
    </div>
    <div class="flex items-center justify-between">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
        Update
        </button>
        <button @click="cancel" class="bg-yellow-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
        Cancel
        </button>
    </div>
</div>
</form>


   
<!-- Update Product Form-->

</template>
