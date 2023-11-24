<script setup>
    import { Head, Link } from '@inertiajs/vue3';
    import theme from 'tailwindcss/defaultTheme';
    import { useForm,usePage } from '@inertiajs/vue3'
    import TextInput from '@/Components/TextInput.vue';
    import ResponsiveSidebar from '@/Components/ResponsiveSidebar.vue';

const form = useForm({

    cartTotal:"", 
    merchant_id:10023678,
    merchant_key:'u9um30l9rwmkc',
    return_url:"http://127.0.0.1:8000/dashboard",
    cancel_url:"",
    notify_url:"",

    name_first:"",
    name_last:"",
    email_address:"",

})

const submit = () => {
    form.post(route('generateSignature'));
    // form.post(route('productAdd'));
    // form.reset('product_name',)
    // form.reset('product_description')
    // form.reset('price')
};
</script>
<script>

import { router } from '@inertiajs/vue3'

export default {
    props:{
    product:[],
    data:[],
},

data(){
    return {
        isLoading:false,
        email:"",
        first_name:"",
        last_name:"",
        valid_email:false,
        showPay:false,
        merchant_id:10031446,
        merchant_key:'u9um30l9rwmkc',
        hasSignature:false,
        cartItemCount:0,
        productArray:[],
        totalPrice:0, 
        mobileMenuOpen:false,
        selectedProvince:'', // This will store the selected province
        provinceIsSelected:false,
        provinces: ['Eastern Cape',
        'Free State',
        'Gauteng',
        'KwaZulu-Natal',
        'Limpopo',
        'Mpumalanga',
        'North West',
        'Northern Cape',
        'Western Cape',
        ],
        pages: [

            { name: 'Home', url: '/' },
            { name: 'About', url: '/about' },
            { name: 'Contact', url: '/contact' },
            // Add more pages as needed
        ],

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
        ],
    }
},

setup(){


},
mounted(){

    if(this.data){
        console.log('THE DATA',this.data);
    }

    const totalPriceTotal =  localStorage.getItem('totalPrice');
    const getCartItemCount = localStorage.getItem('cartItemCount');
    const prodArr = localStorage.getItem('productArray');
    if(prodArr){
        this.productArray =  JSON.parse(prodArr)
        console.log('awe',this.productArray)

    }
    if(totalPriceTotal){
        this.totalPrice = parseInt(totalPriceTotal)
        this.cartTotal = this.totalPrice
        console.log(this.totalPrice)
    }
    if(getCartItemCount){
        this.cartItemCount = parseInt(getCartItemCount);
        console.log(this.cartItemCount)
    }


},

methods:{


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

    test(){
        this.isLoading = true
        const url = 'https://f9b7-197-90-70-167.ngrok-free.app/checkout2'
        
        router.visit(url, {
            method: 'post',
            data: {cartTotal:this.totalPrice,email:this.email,first_name:this.first_name,last_name:this.last_name},
            replace: false,
            preserveState: false,
            preserveScroll: true,
            only: [],
            headers: {},
            errorBag: null,
            forceFormData: false,
            onCancelToken: cancelToken => {},
            onCancel: () => {},
            onBefore: visit => {},
            onStart: visit => {},
            onProgress: progress => {},
            onSuccess: page => {},
            onError: errors => {},
            onFinish: visit => {},
        }).then = () =>{
            this.isLoading = false
        }

    },

    isValidEmail(email) {
    // Regular expression for a basic email validation
    const emailRegex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i;

    if(emailRegex.test(email)){
        this.valid_email = true
        console.log('valid',this.valid_email)
    }
        return emailRegex.test(email);
    },

    isValidName(first_name){
        const nameRegex = /^[A-Za-z\s'-]+$/;
        return nameRegex.test(first_name);
    },

    selectedProvince(selectedProvince){
        console('selectedProvince',this.selectedProvince)
        if(selectedProvince){
            this.provinceIsSelected = true
        }

    },
    checkFormData(){
        form.apart_suite_unit
    },
    toggleButton(){
        if(this.mobileMenuOpen == false){
            this.mobileMenuOpen = true
        }else{
            this.mobileMenuOpen = false
        }
    },
    startTimer(){

    },
    stopTimer(){

    },


}

}

</script>

<template>
    <div class="h-full w-full">
  
        <nav class="fixed flex flex-row justify-between items-center bg-green-300 w-full p-2 z-10">
                <!-- Side Bar Toggle -->
                <button @click="toggleButton" type="submit" class="p-2 bg-white rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
                <!-- Search Input -->
                <input v-if="this.searchBar" type="text" placeholder="Search Products..." v-model="searchQuery" class="border border-gray-300 rounded-full py-2 px-4 focus:outline-none focus:border-blue-500 mx-auto" />
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
       </div>
      

        <!--Address Form-->
        <label class="mb-5 font-bold text-xl" for="street">{{errors}}</label>
        <label v-for="(item,index) in errors" :key="index" class="mb-5 font-bold text-xl" for="street">{{ item }}</label>
        <div class="mx-auto justify-center mt-10 p-8 md:px-40">
            <form  @submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-1 gap-2" action="/process-address" method="POST"> 

                <span v-if="!isValidName(first_name)" class="text-red-500 mt-5">Vaild Name is Required</span>
                <TextInput class="shadow appearance-none rounded-lg border-1 border-gray-400 w-full py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required  id="first_name" ref="product_name" v-model="first_name" type="text" placeholder="First Name" />
                <TextInput class="shadow appearance-none rounded-lg border-1 border-gray-400 w-full py-2 px-1 mt-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  required  id="last_name" ref="product_name" v-model="last_name" type="text" placeholder="Last Name" />
                <TextInput class="shadow appearance-none rounded-lg border-1 border-gray-400 w-full py-2 px-1  mt-1  text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required  id="company_name" ref="product_name" v-model="form.company_name" type="text" placeholder="Company Name (Optional)" />
                <span v-if="selectedProvince == ''" class="text-red-500 mt-5" >Province Required</span>
                <select class="shadow appearance-none rounded-lg border-1 border-gray-400 w-full py-2 px-4 mt-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" @change="selectedProvince(selectedProvince)" v-model="selectedProvince" id="province">
                    <option class="px-4" value="" disabled selected>Select a Province</option> Placeholder option 
                <option v-for="province in provinces" :value="province">{{ province }}</option>
                </select> 
                <TextInput class="shadow appearance-none rounded-lg border-1 border-gray-400 w-full py-2 px-1  mt-1  text-gray-700 leading-tight focus:outline-none focus:shadow-outline mt-5" required  id="product_name" ref="product_name" v-model="form.street_address" type="text" placeholder="Street Address" />
                <span v-if="!isValidEmail(form.email_address)" class="text-red-500 mt-5">Vaild Email is Required</span>
                <TextInput class="shadow appearance-none rounded-lg border-1 border-gray-400 w-full py-2 px-1  mt-1  text-gray-700 leading-tight focus:outline-none focus:shadow-outline mt-1" required  id="product_name" ref="product_name" v-model="email" type="email" placeholder="email Address" />
                <TextInput class="shadow appearance-none rounded-lg border-1 border-gray-400 w-full py-2 px-1  mt-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"   required  id="apart_suite_unit" ref="product_name" v-model="form.apart_suite_unit" type="text" placeholder="Apartment,suite (Optional)" />
                <TextInput class="shadow appearance-none rounded-lg border-1 border-gray-400 w-full py-2 px-1  mt-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"   required  id="apart_suite_unit" ref="product_name" v-model="form.apart_suite_unit" type="text" placeholder="Apartment,suite (Optional)" /> 
            </form>
            
        <!--data -->
            <form  class="grid grid-cols-1 md:grid-cols-1 gap-2"  action="https://sandbox.payfast.co.za/eng/process" method="post">
                <input  v-if="data"  type="hidden" name="merchant_id" :value="data.merchant_id">
                <input  v-if="data"  type="hidden" name="merchant_key" :value="data.merchant_key">
                <input  v-if="data"  type="hidden" name="return_url" :value="data.return_url">
                <input  v-if="data"  type="hidden" name="cancel_url" :value="data.cancel_url">
                <input  v-if="data"  type="hidden" name="notify_url" :value="data.notify_url">
                <h1 v-if="data">{{data.notify_url}}</h1>
                <input  v-if="data"  name="name_first" :value="data.name_first">
                <input  v-if="data"  name="name_last" :value="data.name_last">
                <input  v-if="data"  name="email_address" :value="data.email_address">
                <input  v-if="data"  type="number" name="m_payment_id" :value="data.m_payment_id">
                <input  v-if="data"  type="number" name="amount" :value="data.amount">
                <input  v-if="data"  type="hidden" name="item_name" :value="data.item_name">
                <input  v-if="data" type="hidden" name="signature" :value="data.signature">
                <!-- <input type="hidden" name="signature" :value="signature"/> -->
                <!-- Street Address -->
                <label class="shadow appearance-none rounded-lg border-1 border-gray-400 w-full py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" for="street">Billing details</label>
                <label class="font-bold text-xl" for="street">Order details</label>
                <div v-for="(product, index) in productArray" :key="index"  class="flex justify-center bg-green-200">
                <p>{{ product.product_name }}:{{ product.individualItemCount }}</p>
                </div>
                <div>
                    <label  class="mb-5 mt-5 font-bold text-lg" for="street">Sub Total:</label>
                    <p class="mb-5 mt-5 font-bold ">R{{ this.totalPrice }}</p>
                </div>
                <button v-if="data" type="submit"  class="bg-green-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-300 ease-in-out" value="Pay Now">pay</button>
                <!-- <Link   v-if ="isValidEmail(email) && !data" class="w-20 bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-2 rounded-lg transition-colors duration-300 ease-in-out" :href="route('generateSignature')" method="post"  :data="{cartTotal:this.totalPrice,merchant_key:this.merchant_key, first_name:form.name_first,last_name:form.name_last,email:form.email_address
                }">Confirm</Link> -->
                <button v-if ="isValidEmail(email) && !data" class="w-20 bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-2 rounded-lg transition-colors duration-300 ease-in-out" type="button" @click="test">Confirm</button>
                <div v-if="this.isLoading" class="flex items-center justify-center">
                    <div class="loader"></div>
                </div>
            </form>
        </div>
    <!--End Of Address Form-->
    </div>
</template>


<style>
  .loader {
    border: 4px solid rgba(0, 0, 0, 0.2);
    border-top: 4px solid #3490dc; /* Change this color to your desired color */
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }

    100% { transform: rotate(360deg); }
  }
</style>
