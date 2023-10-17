<script setup>
import { Head, Link } from '@inertiajs/vue3';
import theme from 'tailwindcss/defaultTheme';
import { useForm,usePage } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue';



const form = useForm({
 
// first_name:"",
// last_name:"",
// company_name:"",
// street_address:"",
// town_city:"",
// province:[],
// zip_code:
//   product_id:prod_id,

})

const submit = () => {
    // form.post(route('productAdd'));
    // form.reset('product_name',)
    // form.reset('product_description')
    // form.reset('price')
};



</script>
<script>
export default {
    
    props:{
        product:[],
    },
    
    data(){
        return {
            cartItemCount:0,
            productArray:[],
            totalPrice:0, 
            mobileMenuOpen:false,
            selectedProvince: '', // This will store the selected province
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
    
       
        }
    },

    setup(){
    
    },
    mounted(){
        const totalPriceTotal =  localStorage.getItem('totalPrice');
        const getCartItemCount = localStorage.getItem('cartItemCount');
        const prodArr = localStorage.getItem('productArray');
        if(prodArr){
            this.productArray =  JSON.parse(prodArr)
            console.log('awe',this.productArray)

        }
        if(totalPriceTotal){
            this.totalPrice = parseInt(totalPriceTotal)
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
        }


}

}

</script>

<template>
    <div class="h-full w-full bg-gray100">
        <nav  style="position: fixed; top: 0; left: 0; right: 0; z-index: 999;" class="bg-green-400 p-4">
            <div class="contaner mx-auto flex justify-between items-center">
                <a>My website</a>
          
                <ul class="hidden md:flex space-x-8 mr-3">
                    <li><a  class="text-white hover:text-blue-200">Home</a></li>
                    <li><a  class="text-white hover:text-blue-200">About</a></li>
                    <li><a  class="text-white hover:text-blue-200">Service</a></li>
                    <li><a  class="text-white hover:text-blue-200">Contact</a></li>
                </ul>
                <div class="md:hidden">
                    <button id="mobile-menu-toggle"  @click="toggleButton()">
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
                <l1 class="bg-blue-500"> <a :href="route('products.edit')" class="block py-1 px-4 hover:bg-gray-400">Manage Products</a></l1>
                <l1 class="bg-blue-500"><a href="" class="block py-1 px-4 hover:bg-gray-400">Home</a></l1>
                <l1 class="bg-blue-500"><a href="" class="block py-1 px-4 hover:bg-gray-400">Home</a></l1>
                <l1 class="bg-blue-500"><a href="" class="block py-1 px-4 hover:bg-gray-400">Home</a></l1>
            </ul>
        </div>


        <!--Address Form-->
        <div class="flex justify-center mt-40">
                <form @submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-1 gap-2" action="/process-address" method="POST">
                    <!-- Street Address -->
                    <label class="mb-5 font-bold text-xl" for="street">Billing details</label>
                    <!-- <label for="street">First Name</label> -->
                    <!-- <input type="text" id="street" name="street" required> -->
                    <TextInput class="shadow appearance-none rounded-lg border-1 border-gray-400 w-full py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required  id="first_name" ref="product_name" v-model="form.first_name" type="text" placeholder="First Name" />
                    <TextInput class="shadow appearance-none rounded-lg border-1 border-gray-400 w-full py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  required  id="last_name" ref="product_name" v-model="form.last_name" type="text" placeholder="Last Name" />
                    <TextInput class="shadow appearance-none rounded-lg border-1 border-gray-400 w-full py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required  id="company_name" ref="product_name" v-model="form.company_name" type="text" placeholder="Company Name (Optional)" />
                    <TextInput class="shadow appearance-none rounded-lg border-1 border-gray-400 w-full py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mt-5" required  id="product_name" ref="product_name" v-model="form.street_address" type="text" placeholder="Street Address" />
                    <TextInput class="shadow appearance-none rounded-lg border-1 border-gray-400 w-full py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"   required  id="apart_suite_unit" ref="product_name" v-model="form.apart_suite_unit" type="text" placeholder="Apartment,suite (Optional)" />
                    <!-- City -->
                    <!-- <label for="city">City:</label>
                    <input type="text" id="city" name="city" required> -->  
                    <div>
                        <label for="city">Select Province:</label>
                        <select class="shadow appearance-none rounded-lg border-1 border-gray-400 w-full py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="form.selectedProvince" id="province">
                            <option value="" disabled selected>Select a Province</option> <!-- Placeholder option -->
                            <option v-for="province in provinces" :value="province">{{ province }}</option>
                        </select>
                    </div>
                    <TextInput class="shadow appearance-none rounded-lg border-1 border-gray-400 w-full py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"   required  id="postal" ref="product_name" v-model="form.postal" type="text" placeholder="Postal / ZIP" />
                    <input class="shadow appearance-none rounded-lg border-1 border-gray-400 w-full py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required type="email" id="email" placeholder="Email (Required!)" v-model="form.email" >
                    <label class="mb-5 mt-5 font-bold text-xl" for="street">Order details</label>
                    <div v-for="(product, index) in productArray" :key="index"  class="flex justify-center">
                        <p class="shadow appearance-none rounded-lg border-none border-gray-400 w-full py-2 px-1 text-black leading-tight focus:outline-none focus:shadow-outline">{{ product.product_name }}:{{ product.individualItemCount }}</p>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-2 gap-2">
                        <label class="mb-5 mt-5 font-bold text-lg" for="street">Sub Total:</label>
                        <p class="mb-5 mt-5 font-bold ">R{{ this.totalPrice }}</p>
                    </div>
                    <button type="submit">Submit</button>
                </form>
            </div>
        <!--End Of Address Form-->
    </div>
</template>


