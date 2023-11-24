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
      mobileMenuOpen:false,
      showAddProducts:false,
      showUpdateProducts:false,
      deleteProducts:false,
      confirmDelete:false,
      searchQuery: '',
      productForMessage:'',
      showModal:false,
      deleteProductId:null,
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
 <ResponsiveSidebar :pages = "pages" v-model="searchQuery"/>

 <div class="container mx-auto md:pt-20 hidden md:block">
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


    <div v-if="mobileMenuOpen" id="mobile-menu" class="pt-20 bg-gray-800 md:hidden ">
        <ul class="bg-gray-800">
            <li class="bg-gray-500"><a :href="route('products.edit')" class="block py-1 px-4 hover:bg-gray-400">Manage Products</a></li>
            <li class="bg-gray-500"><a href="" class="block py-1 px-4 hover:bg-gray-400">Home</a></li>
            <li class="bg-gray-500"><a href="" class="block py-1 px-4 hover:bg-gray-400">Home</a></li>
            <li class="bg-gray-500"><a href="" class="block py-1 px-4 hover:bg-gray-400">Home</a></li>
        </ul>
    </div>
    <!--NAVBAR-->

    <!--Display Products On Small Screen-->
    <div class="container mx-auto p-4">
        <div class="flex flex-row justify-center  overflow-hidden">
            <!-- Hidden on medium and larger screens -->
            <div class="grid grid-cols-1 md:hidden  ">
                <div v-for="product in filteredProducts" :key="product.id" class="border-b mt-10">
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
                <div v-for="product in filteredProducts" :key="product.id" class="border-b w-full mt-10 border-b mt-10">
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
