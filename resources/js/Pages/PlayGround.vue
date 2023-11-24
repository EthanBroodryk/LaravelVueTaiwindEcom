<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed, defineProps } from 'vue';

    defineProps({
        products:[],
    });

    const currentPage = ref(1);
    const itemsPerPage = 6;

    const totalPages = computed(() => Math.ceil(this.products.length / itemsPerPage));
    const slicedProducts = computed(() =>{

        const start = (currentPage.value - 1) * itemsPerPage;



    });






</script>









<script>
import { Head, Link } from '@inertiajs/vue3';
import theme from 'tailwindcss/defaultTheme';


export default {

props:{
    products:[],
},

data(){
    return {
     
      pageCounter:1,
      pages:1,
      showPagination:true,
      newArray:[],
      limit:1,
      start:-1,
      end:3,
      searchBar:false,
      gategoryDropdown:false,
      mobileMenuOpen:false,
      searchQuery: '',
      routes:[
        'profile.edit',
        'profile.update',
        'profile.destroy',
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
    let pageNumbers = this.limit
    console.log('THE FUCKING LIMIT:', this.limit)


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

        toggleButton(){
           if(this.mobileMenuOpen == false){
              this.mobileMenuOpen = true
           }else{
              this.mobileMenuOpen = false
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

        }


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
    
            <!--DISPLAY PRODUCTS-->
            <div class="container mx-auto py-10 bg-local mt-20">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-3 gap-2 px-4">
                    <div v-if="!this.showPagination" v-for="(product, index)  in filteredProducts" :key="index" class="mx-auto  rounded-xl shadow-md overflow-hidden md:max-w-2xl">
                        <div>
                            <div>
                                <img class="w-40 object-cover md:h-full md:w-48 rounded-full px-4 py-4" :src="product.image_file_name" alt="Modern building architecture">
                            </div>
                            <div class="p-8">
                                <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{product.product_name}}</div>
                                <a href="#" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">R{{product.price}}</a>
                                <p class="mt-2 text-slate-500">{{product.product_descruption}}</p>
                            </div>
                            <div class="p-4">
                                <button class="bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded">
                                <a :href="route('addProductToCart', { prod_id: product.id })" class="px-4 py-2 text-indigo-600 hover:text-indigo-900">Add to cart</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                    <!--Paginated Results-->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-2 px-4">
                    <div v-if="this.showPagination"  v-for="(product, index)  in filteredProducts" :key="index" class="mx-auto  rounded-xl shadow-md overflow-hidden md:max-w-2xl">
                     <div v-if="(index > this.start && index < this.end)">
                         <div>
                             <img class="w-40 object-cover md:h-full md:w-48 rounded-full px-4 py-4" :src="product.image_file_name" alt="Modern building architecture">
                         </div>
                         <div class="p-8">
                            <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{product.product_name}}</div>
                            <a href="#" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">R{{product.price}}</a>
                            <p class="mt-2 text-slate-500">{{product.product_descruption}}</p>
                        </div>
                        <div class="p-4">
                            <button class="bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded">
                            <a :href="route('addProductToCart', { prod_id: product.id })" class="px-4 py-2 text-indigo-600 hover:text-indigo-900">Add to cart</a>
                            </button>
                        </div>
                    </div>
                </div>
              </div>
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
   <!-- <div v-if="this.mobileMenuOpen" class="bg-green-300 flex flex-col w-40 h-screen items-center py-8">
        <Link v-for="(page, index) in routes" :key="index" :href="route(page)" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ page }}</Link>
    </div> -->
<style>

.sidebar {
  position: absolute;
  left: 0;
  top: 1;
  z-index: 1; /* Ensure the sidebar appears above the content */
}

.togbut {
    z-index: 1;
}

</style>















<!-- 
<template> -->
    <!-- ... existing template ... -->
  
    <!-- Pagination -->
    <!-- <div class="flex justify-center mt-4">
      <button
        v-for="pageNumber in totalPages"
        :key="pageNumber"
        @click="changePage(pageNumber)"
        :class="{ 'bg-green-500': currentPage === pageNumber, 'text-white': currentPage === pageNumber }"
        class="m-1 py-2 px-4 border rounded cursor-pointer"
      >
        {{ pageNumber }}
      </button>
    </div>
  </template>
  
  <script setup>
  import { ref, computed, defineProps } from 'vue';
  
  defineProps({
    products: Array,
  });
  
  const currentPage = ref(1);
  const itemsPerPage = 6;
  
  const totalPages = computed(() => Math.ceil(props.products.length / itemsPerPage));
  
  const slicedProducts = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    return props.products.slice(start, end);
  });
  
  const changePage = (pageNumber) => {
    currentPage.value = pageNumber;
  };
  </script>
   -->