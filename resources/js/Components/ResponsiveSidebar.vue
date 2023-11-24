<template>
  <div>
    <!-- Top Navbar -->
    <div class="topnav">
      <a @click="openNav" href="#">SideNav</a>
      <a href="#">About</a>

      <Link href="/logout" method="post" as="button">Logout</Link>
      <Link
                v-if="$page.props.auth.user"
                :href="route('orders')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >orders</Link
            >
            <Link
                v-if="$page.props.auth.user"
                :href="route('profile.edit')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >profile</Link
            >
            <Link
                v-if="$page.props.auth.user"
                :href="route('productAdd')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >  productAdd</Link
            >
            <a :href="route('productAdd')" method="post" class="block py-1 px-4 hover:bg-gray-400">ferfe</a>

          
      <a href="#">Contact</a>
      <div class="hidden md:flex justify-start items-between p-2">
            <div class="relative text-gray-600">
              <input v-model="searchQuery" class="rounded-full" type="text" placeholder="Search products..." @input="$emit('update:modelValue', $event.target.value)">
                <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
                    <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M15.5 14h-.79l-.28-.27a6.5 6.5 0 0 0 1.48-5.34C16.7 6.01 13.69 3 10 3a7 7 0 0 0-7 7c0 3.68 3.01 6.7 6.73 6.95A6.5 6.5 0 0 0 14 15.5h.79l4.25 4.25a1 1 0 0 0 1.41-1.41l-4.25-4.25v-.79a6.5 6.5 0 0 0-6.5-6.5zM10 13a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/></svg>
                </button>
            </div>
        </div> 
    </div>
    <div class="top-right">
      <button id="mobile-menu-toggle"  @click="openNav" class="text-white">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
      </button>
    </div>
    
    <div :style="{ width: navWidth }" class="sidenav">
      <a href="javascript:void(0)" class="closebtn" @click="closeNav">x</a>
      <a v-for="(page, index) in pages" :key="index" @click="navigateTo(page.url)">
        {{ page.name }}
      </a>
    </div>
  </div>
</template>

<script setup>

  import { ref, defineProps } from 'vue';

import { Head, Link } from '@inertiajs/vue3';

  const showSearch = ref('false');

  const toggleSearch = () => {

    console.log(showSearch);


  }


  const searchQuery = ref('');
  const props = defineProps(['pages']);
  const navWidth = ref("0");
  const openNav = () => {
    navWidth.value = "250px";
  };
  const closeNav = () => {
    navWidth.value = "0";
  };
  const navigateTo = (url) => {
    console.log(`Navigating to: ${url}`);
  };

</script>

<style scoped>

/*button*/
.top-right {
  position: absolute;
  top:0;
  right: 0;
  padding: 14px;
}

/* Top Navbar Styles */
.topnav {
  background-color: #04d323;
  overflow: hidden;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* side nav */


.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  right: 0;
  background-color: #6b7a6d;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #ebe3e3;
  display: block;
  
  
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {
    padding-top: 15px;
  }
  .sidenav a {
    font-size: 18px;
  }
}
</style>
