<script setup>
import { Head, Link } from '@inertiajs/vue3';
import theme from 'tailwindcss/defaultTheme';
import { useForm,usePage } from '@inertiajs/vue3'
import ResponsiveSidebar from '@/Components/ResponsiveSidebar.vue';
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

      showPagination:true,
      limit:1,
      start:-1,
      end:3,
      pageCounter:1,
      searchBar:false,
      mobileMenuOpen:false,
      showAddProducts:false,
      showUpdateProducts:false,
      deleteProducts:false,
      confirmDelete:false,
      searchQuery: '',
      productForMessage:'',
      showModal:false,
      deleteProductId:null,
      gategoryDropdown:false,
      pages: [
        { name: 'Home', url: '/' },
        { name: 'About', url: '/about' },
        { name: 'Contact', url: '/contact' },
        // Add more pages as needed
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
    filteredProducts() {
      return this.products.filter(product =>
        product.product_name.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    },
    
},
mounted(){

    this.limit = Math.ceil(this.products.length / 3)

},
    methods:{


        showshowFiltered(){

            if(this.searchQuery != ''){

                this.showPagination = false;

            }else{
                this.showPagination = true;
            }


        },


        updatePage(x){

            if(x == 'goForward'){
                if(this.pageCounter < this.limit){

                    this.pageCounter += 1        
                    this.start += 3
                    this.end += 3
                    console.log('THE PAGE COUNTER:',this.pageCounter)

                }

            }if(x == 'goBack'){

                if(this.start > 1){
                    this.pageCounter -= 1  
                    this.start -= 3
                    this.end -= 3
                    console.log('THE PAGE COUNTER:',this.pageCounter)
                }
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

        },


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


        sendData(){
            this.closeModal();
            usePage.inertia.post('productDelete',{prod_id:this.deleteProductId})
        },

    }

}
</script>


<template>
 <!-- <ResponsiveSidebar :pages = "pages" v-model="searchQuery"/> -->
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
                <l1  class="p-2 border-b border-gray-600 hover:bg-gray-600 active:bg-violet-700 text-white w-full"> <a :href="route('productsAddPage')">Add Product</a></l1>
                <l1  class="p-2 border-b border-gray-600 hover:bg-gray-600 active:bg-violet-700 text-white w-full"> <a :href="route('products.edit')">Manage Products</a></l1>
                <l1  class="p-2 border-b border-gray-600 hover:bg-gray-600 active:bg-violet-700 text-white w-full"> <a :href="route('products.edit')">Manage Products</a></l1>
                <l1  class="p-2 border-b border-gray-600 hover:bg-gray-600 active:bg-violet-700 text-white w-full"> <a :href="route('products.edit')">Manage Products</a></l1>
                <Link class="p-2 border-b border-gray-600 hover:bg-gray-600 active:bg-violet-700 text-white w-full">Login</Link>
                <div @click="toggleCatButton" class="p-2 border-b border-gray-600 hover:bg-gray-600 active:bg-violet-700 text-white w-full">Categories <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 12.18l-4.94-4.95-1.41 1.41L10 14l6.36-6.36-1.41-1.41L10 12.18z"/>ratatata</svg></div>
                <l1 v-if="gategoryDropdown" v-for="(category,index) in categories" :key="index"  class="bg-red-300 p-2 border-b border-gray-600 hover:bg-gray-600 active:bg-violet-300 text-white w-full"> <a :href="route('products.edit')">{{category}}</a></l1>
            </div>  


        <!--Filtered Results-->

        <div v-if="!this.showPagination" class="container mx-auto md:pt-20 hidden md:block">
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
                    <tbody>
                    <tr v-for="(product,index) in filteredProducts" :key="product.id">
                            <td  class="border p-4">{{ product.id }}</td>
                            <td  class="border p-4">{{ product.product_descruption }}</td>
                            <td  class="border p-4">{{ product.product_name }}</td>
                            <td  class="border p-4">
                                <a :href="route('editProduct', { prod_id: product.id })" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                            <td class="border p-4">
                                <a @click="openModal(product.id)" class="text-red-600 hover:text-indigo-900">Delete</a>
                            </td>
                    </tr>
                    </tbody>
                </table>
            </div>

         <!--Paginated Results-->
            <div v-if="this.showPagination" class="container mx-auto md:pt-20 hidden md:block">
                <table class="w-full table-auto">
                    <thead>
                    <tr>
                        <th class="border p-4 bg-slate-100">Product ID</th>
                        <th class="border p-4 bg-slate-100">Product Description</th>
                        <th class="border p-4 bg-slate-100">Price</th>
                        <th class="border p-4 bg-slate-100">Product Name</th>
                        <th class="border p-4 bg-slate-100">Edit</th>
                        <th class="border p-4 bg-slate-100">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(product,index) in filteredProducts" :key="product.id">
                            <td  v-if="(index > this.start && index < this.end)" class="border p-4">{{ product.id }}</td>
                            <td  v-if="(index > this.start && index < this.end)" class="border p-4">{{ product.product_descruption }}</td>
                            <td  v-if="(index > this.start && index < this.end)" class="border p-4">{{ product.product_name }}</td>
                            <td  v-if="(index > this.start && index < this.end)" class="border p-4">{{ product.price }}</td>
                            <td  v-if="(index > this.start && index < this.end)" class="border p-4">
                                <a :href="route('editProduct', { prod_id: product.id })" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                            <td  v-if="(index > this.start && index < this.end)" class="border p-4">
                                <a @click="openModal(product.id)" class="text-red-600 hover:text-indigo-900">Delete</a>
                            </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <!--Display Products On Small Screen Filtered-->
            <div v-if="!this.showPagination" class="container mx-auto p-4">
                <div class="flex flex-row justify-center  overflow-hidden">
                    <!-- Hidden on medium and larger screens -->
                    <div class="grid grid-cols-1 md:hidden  ">
                        <div v-for="product in filteredProducts" :key="product.id" class="border-b mt-10">
                            <div class="mt-2 border-b border-slate-300 p-2">Id:</div>
                            <div class="mt-2 border-b border-slate-300 p-2">Product Name:</div>
                            <div class="mt-2 border-b border-slate-300 p-2">Price:</div>
                            <div class="mt-2 border-b border-slate-300 p-2">Product Description:</div>
                            <div class="mt-2 border-b border-slate-300 text-green-600 p-2">
                                <a :href="route('editProduct', { prod_id: product.id })" class="text-indigo-600 hover:text-indigo-900 mt-2 p-2">Edit</a>
                            </div>
                        </div>
                    </div>
                    <!-- Hidden on medium and larger screens -->
                    <div class="grid grid-cols-1 md:hidden">
                        <div v-for="product in filteredProducts" :key="product.id" class="border-b w-full mt-10 border-b mt-10">
                            <div class="mt-2 border-b border-slate-300 text-green-600 p-2">{{ product.id }}</div>
                            <div class="mt-2 border-b border-slate-300 text-green-600 p-2">{{ product.product_descruption }}</div>
                            <div class="mt-2 border-b border-slate-300 text-green-600 p-2">{{ product.price }}</div>
                            <div class="mt-2 border-b border-slate-300 text-green-600 p-2">{{ product.product_name }}</div>
                            <div class="mt-2 border-b border-slate-300 text-green-600 p-2">
                                <a  @click="openModal(product.id)" class="text-red-600 hover:text-indigo-900 mt-2 p-2">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Display Products On Small Screen Paginated-->
            <div v-if="this.showPagination" class="container mx-auto p-4">
                <div class="flex flex-row justify-center  overflow-hidden">
                    <!-- Hidden on medium and larger screens -->
                    <div class="grid grid-cols-1 md:hidden  ">
                        <div v-for="(product,index) in filteredProducts"  :key="product.id" class="mt-10">
                            <div v-if="(index > this.start && index < this.end)" class="mt-2  p-2">Id:</div>
                            <div v-if="(index > this.start && index < this.end)" class="mt-2  p-2">Product Name:</div>
                            <div v-if="(index > this.start && index < this.end)" class="mt-2  p-2">Price:</div>
                            <div v-if="(index > this.start && index < this.end)" class="mt-2  p-2">Product Description:</div>
                            <div v-if="(index > this.start && index < this.end)" class="mt-2  text-green-600 p-2">
                                <a :href="route('editProduct', { prod_id: product.id })" class="border-b border-slate-300 text-indigo-600 hover:text-indigo-900 mt-2 p-2">Edit</a>
                            </div>
                        </div>
                    </div>
                    <!-- Hidden on medium and larger screens -->
                    <div class="grid grid-cols-1 md:hidden">
                        <div  v-for="(product,index) in filteredProducts"  :key="product.id" class="w-full  mt-10">
                            <div v-if="(index > this.start && index < this.end)" class="mt-2  text-green-600 p-2">{{ product.id }}</div>
                            <div v-if="(index > this.start && index < this.end)" class="mt-2  text-green-600 p-2">{{ product.product_descruption }}</div>
                            <div v-if="(index > this.start && index < this.end)" class="mt-2  text-green-600 p-2">{{ product.price }}</div>
                            <div v-if="(index > this.start && index < this.end)" class="mt-2  text-green-600 p-2">{{ product.product_name }}</div>
                            <div v-if="(index > this.start && index < this.end)" class="mt-2  text-green-600 p-2">
                                <a  @click="openModal(product.id)" class="border-b border-slate-300 text-red-600 hover:text-indigo-900 mt-2 p-2">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



      
      </div>



  

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


      <!-- Fixed Footer -->
    <footer class="bg-green-300 text-white py-2 fixed bottom-0 w-full">
      <div class="container mx-auto text-center">
        <!-- Your footer content goes here -->
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

        <!-- <p>&copy; 2023 Your Company</p> -->
      </div>
    </footer>

</template>
