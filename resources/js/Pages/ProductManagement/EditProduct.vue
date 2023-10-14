<script setup>
import { Head, Link } from '@inertiajs/vue3';
import theme from 'tailwindcss/defaultTheme';
import { useForm,usePage } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue';
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
    <div class="h-full w-full ">
        <nav class="bg-orange-500 p-6">
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


   
<!-- Update Product Form-->
    <div class="flex flex-row justify-center w-full">
        <form @submit.prevent="submit" class="bg-gray-100 shadow-md rounded px-4 pt-6 pb-8 mb-4 drop-shadow-2xl rounded-xl">
            <div class="mb-4">
                <label style="color: rgb(20, 20, 1);" class="block text-gray-700 text-sm font-bold mb-4" for="username">
                    Current Product Image
                </label>
                <img class="w-20 h-20" :src="product.image_file_name" alt="CurrentProduct Image">
            </div>
            <div class="mb-4">
                <!--INPUT NEW FILE IMAGE-->
                <label style="color: rgb(20, 20, 1);" class="block text-gray-700 text-sm font-bold mb-4" for="username">
                    New Product Image
                </label>
                <img class="w-20 h-20" :src="imageSrc" alt="Add New Product Image">
            </div>
            <div class="mb-4">
                <label style="color: rgb(20, 20, 1);" class="block text-gray-700 text-sm font-bold mb-4" for="username">
                    Product Image
                </label>
                <input style="color:red" type="file"  @input="form.avatar = $event.target.files[0]" @change="handleFileChange" />
                <!-- <input style="color:red" type="file" required @change="handleFileChange" /> -->
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
        </form>
    </div>
</template>
