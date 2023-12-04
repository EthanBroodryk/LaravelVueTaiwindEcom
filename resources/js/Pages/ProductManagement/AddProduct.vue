<script setup>
import { Head, Link } from '@inertiajs/vue3';
import theme from 'tailwindcss/defaultTheme';
import { useForm,usePage } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue';
const user = usePage().props.auth.user;


const form = useForm({
 
     selectedCategory:null,
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
    categories:[],
},

data(){
    return {
      addProductPage:true,
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

console.log('cats',this.categories)

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


       <!--Top Nav-->
       <nav class="fixed flex flex-row justify-between items-center bg-green-300 w-full p-2 z-10">
            <!-- Side Bar Toggle -->
            <button @click="toggleButton" type="submit" class="p-2 bg-white rounded-full">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
            <!-- Search Input -->
            <input v-if="this.searchBar" @input="showshowFiltered" type="text" placeholder="Search Products..." v-model="searchQuery" class="border border-gray-300 rounded-full py-2 px-4 focus:outline-none focus:border-blue-500 mx-auto" />
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

              <!--Add product form-->
            <div class="p-4 pt-20">
                    <form @submit.prevent="submit" class="bg-gray-200 shadow-md rounded px-4 pt-6 pb-8 mb-4">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                        <!-- Input 1 -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="input1">
                                Product Image
                            </label>
                            <input required class="shadow appearance-none rounded-lg border-2 border-gray-400 w-full py-1.5 px-3 text-gray-700 leading-tight" type="file" @input="form.avatar = $event.target.files[0]"/>
                        </div>

                        <!-- Input 2 -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="product_name">
                                Product Name
                            </label>
                            <TextInput required id="product_name" ref="product_name" v-model="form.product_name" type="text" placeholder="Product Name" class="shadow appearance-none rounded-lg border-2 border-gray-400 w-full py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"/>
                        </div>

                        <!-- Input 2 -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="product_name">
                            Product Category
                            </label>
                            <select v-model="form.selectedCategory" id="category">
                                <option v-for="category in categories" :key="category.id" :value="category.name">
                                    {{ category.name }}
                                </option>
                            </select>
                        </div>

                        <!-- Input 3 -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="product_description">
                                Product Description
                            </label>
                            <TextInput required id="product_description" ref="product_description" v-model="form.product_description" type="text" placeholder="Product Description" class="shadow appearance-none rounded-lg border-2 border-gray-400 w-full py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"/>
                        </div>

                        <!-- Input 4 -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                                Price
                            </label>
                            <TextInput id="price" required ref="price" v-model="form.price" type="number" placeholder="R" class="shadow appearance-none rounded-lg border-2 border-gray-400 w-full py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"/>
                        </div>
                        <!-- Repeat the structure for Input 5, Input 6, and so on... -->
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-center mt-4">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Add Product
                        </button>
                    </div>
                </form>
            </div>

    
     

            <!--Pagination-->
            <div class="container">
                <div class="flex flex-row justify-center">
                    <button v-if="showPagination" @click="updatePage('goBack')"     class="p-2 bg-green-200 h-10 w-10 border-lg rounded-full">
                        <span>&larr;</span>
                    </button>
                    <span class="p-2">{{ this.pageCounter}}/{{   this.limit  }}</span>
                    <button v-if="showPagination" @click="updatePage('goForward')" class="p-2 bg-green-200 h-10 w-10 border-lg rounded-full">
                        <span>&rarr;</span>
                    </button>
                </div>
            </div>

      </div>

</template>
