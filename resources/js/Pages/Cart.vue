<script setup>
import { Head, Link } from '@inertiajs/vue3';
import theme from 'tailwindcss/defaultTheme';
import { useForm,usePage } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue';
import ResponsiveSidebar from '@/Components/ResponsiveSidebar.vue';
</script>
<script>
export default {
    
    props:{
        product:[],
    },
    
    data(){
        return {

            searchBarNotApplicable:true,
            searchBar:false,
            gategoryDropdown:false,
            mobileMenuOpen:false,
            cartTotal: 0,
            cart:[],
            productArray:[],
            itemCount: 0,
            totalPrice:0,
            cartItemCount:0,
            individualItemCount:0,
            pages: [

                { name: 'Home', url: '/' },
                { name: 'About', url: '/about' },
                { name: 'Contact', url: '/contact' },
                // Add more pages as needed
            ],
            routes:[

                'profile.edit',
                'profile.update',
                'profile.destroy',
            ],

            categories:[

                'Indoor',
                'Outdoor',
                'Edibles',

            ],
       
        }
    },

    setup(){
        
        const count = ref(0)
        return {
            count
        }
    },
    mounted(){

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
        //toggle buttons

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

        },

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
                this.productArray[i].itemCount = (parseInt(this.productArray[i].itemTotal) || 0) + 1;
                localStorage.setItem('individualItemCount',JSON.stringify(this.productArray[i].itemTotal))
                console.log('this.productArray[i].itemTotal',this.productArray[i].itemTotal)
            }
        }

        this.addIndividualItemPriceTotal(itemPrice,product_id);
    },  

    deductIndividualItemPrice(itemPrice, product_id) {
        for (let i = 0; i < this.productArray.length; i++) {
            if (product_id == this.productArray[i].id) {
                if(this.productArray[i].individualItemCount > 1){
                    this.productArray[i].itemTotal = (parseInt(this.productArray[i].itemTotal) || 0) - parseInt(itemPrice);
                    localStorage.setItem('individualItemCount',JSON.stringify(this.productArray[i].itemTotal))
                    this.deductIndividualItemPriceTotal(itemPrice,product_id)
                }else{
                    let indexToRemove = this.productArray[i]
                    this.productArray = this.productArray.filter(item => item !== indexToRemove)
                    localStorage.setItem('productArray',JSON.stringify(this.productArray))
                    this.totalPrice -=  parseInt(itemPrice);
                    localStorage.setItem('totalPrice',JSON.stringify(this.totalPrice))
                    this.cartItemCount -= 1;
                    localStorage.setItem('cartItemCount',JSON.stringify(this.cartItemCount))
                
                }
            }
        }
    },  


    }

}

</script>

<template>

    <div class="h-full w-full bg-white">
            <!--Top Nav-->
        <nav class="fixed flex flex-row justify-between items-center bg-green-300 w-full p-2 z-10">
            <!-- Side Bar Toggle -->
            <button @click="toggleButton" type="submit" class="p-2 bg-white rounded-full">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
            <!--Checkout-->
            <div class="flex justify-center">
                <img src="http://127.0.0.1:5173/public/images/roundshoppingcart.png" class="card-img-top w-10 h-10 rounded-full">
                <span v-if="this.cartItemCount > 0" class="mr-5">{{this.cartItemCount}}</span>
                <Link class="text-red-600 hover:text-indigo-900 mr-4" :href="route('checkout')" method="get">Checkout</Link>
            </div>
            <div>
            </div>
         
     
        </nav>
            <!--SideNavbar-->
        <div class="flex h-screen">
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
            <div class="container mx-auto py-10  mt-20">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-3 gap-2 px-4">
                    <div  v-for="(item, index) in productArray" :key="index" class="bg-white rounded-lg border-2">
                        <div class="p-4">
                        <img  v-bind:src="item.image_file_name" class="card-img-top w-20 h-20  mb-8">
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
    </div>
</template>


