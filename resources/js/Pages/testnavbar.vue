<script setup>

import { Head, Link } from '@inertiajs/vue3';

</script>

<script>

export default {

props:{
    
},

data(){
    return {

        navWidth: "0",
     
    }
},

setup(){

},

computed: {

},

mounted(){


},

    methods:{

        openNav() {
            this.navWidth = "250px";
        },
        closeNav() {
            this.navWidth = "0";
        },

   
 }

}
</script>
<template>

    <div id="mySidenav" :style="{ width: navWidth }" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" @click="closeNav()">x</a>
        <a>home</a>
        <a>home</a>
        <a>home</a>
        <a>home</a>
        <a>home</a>
    </div>
    
</template>

<style>

.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index:1;
    top:0;
    left:0;
    background-color:#111;
    overflow-x:hidden;
    transition: 0.5s;
    padding-top:60px;
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s;
}

.sidenav a:hover {
    color:#f1f1f1;
}

.sidenav .closebtn {
    position: absolute;
    top:0;
    right: 25px;
    font-size: 36px;
    margin-left:50px;
}

@media screen and (max-height:450px){

  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}

}

</style>
