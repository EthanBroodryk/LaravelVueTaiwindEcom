<template>
    <header>
        <div class="container">
            <nav class="site-nav" :class="{ 'site-nav--open': isMenuOpen }">
                <ul>
                    <li><a href=""><i class="fa fa-home site-nav--icon"></i>Home</a></li> 
                    <li><a href=""><i class="fa fa-info site-nav--icon"></i>About</a></li>
                    <li><a href=""><i class="fa fa-pencil site-nav--icon"></i>Blog</a></li>
                    <li><a href=""><i class="fa fa-usd site-nav--icon"></i>Pricing</a></li>
                    <li><a href=""><i class="fa fa-envelope site-nav--icon"></i>Contact</a></li>
                </ul> 
            </nav>
            <div class="menu-toggle" @click="toggleMenu">
                <div class="hamburger" ></div>
            </div>
        </div>
    </header>
</template>
  
  <script setup>

    import { ref } from 'vue';

    const isMenuOpen = ref(false);

    const toggleMenu = () => {
         isMenuOpen.value = !isMenuOpen.value;
    };
   
  </script>
  
  <style scoped>

  /* colors -> https://coolors.co/e54b4b-ebebd3-464655-e4b363-e8e9eb */

@import url('https://fonts.googleapis.com/css?family=Quicksand:400,700');

body {
  background: #F0F8EA;
  font-family: 'Quicksand', sans-serif;
}

.container {
  width: 95%;
  max-width: 1000px;
  margin: 0 auto;
}

header {
  background: #06ce21;
  color: #EBEBD3;
  padding: 1em 0;
  position: relative;
}

header::after {
  content: '';
  clear: both;
  display: block;
}

.logo {
  float: left;
  font-size: 1rem;
  margin: 0;
  text-transform: uppercase;
  font-weight: 700;
}

.logo span {
  font-weight: 400;
}

.site-nav {
  position: absolute;
  top: 100%;
  right: 0%;
  background: #464655;
  clip-path: circle(0px at top right);
  transition: clip-path ease-in-out 700ms;
/*   display: none; */
}

.site-nav--open {
  clip-path: circle(250% at top right);
/*   display: block; */
}

.site-nav ul {
  margin: 0;
  padding: 0;
  list-style: none;
}

.site-nav li {
  border-bottom: 1px solid #575766;
}

.site-nav li:last-child {
  border-bottom: none;
}

.site-nav a {
  color: #EBEBD3;
  display: block;
  padding: 2em 4em 2em 1.5em;
  text-transform: uppercase;
  text-decoration: none;
}

.site-nav a:hover,
.site-nav a:focus {
  background: #E4B363;
  color: #464655;
}

.site-nav--icon {
  display: inline-block;
  font-size: 1.5em;
  margin-right: 1em;
  width: 1.1em;
  text-align: right;
  color: rgba(255,255,255,.4);
}

.menu-toggle {
  padding: 1em;
  position: absolute;
  top: .5em;
  right: .5em;
  cursor: pointer;
}

.hamburger,
.hamburger::before,
.hamburger::after {
  content: '';
  display: block;
  background: #EBEBD3;
  height: 3px;
  width: 1.75em;
  border-radius: 3px;
  transition: all ease-in-out 500ms;
}

.hamburger::before {
  transform: translateY(-6px);
}

.hamburger::after {
  transform: translateY(3px);
}

.open .hamburger {
  transform: rotate(45deg);
}

.open .hamburger::before {
  opacity: 0;
}

.open .hamburger::after {
  transform: translateY(-3px) rotate(-90deg);
}

@media (min-width: 700px) {
  
  .menu-toggle {
    display: none;
  }
  
  .site-nav {
    height: auto;
    position: relative;
    background: transparent;
    float: right;
    clip-path: initial;
  }
  
  .site-nav li {
    display: inline-block;
    border: none;
  }
  
  .site-nav a {
    padding: 0;
    margin-left: 3em;
  }
  
  .site-nav a:hover,
  .site-nav a:focus {
    background: transparent;
  }
  
  .site-nav--icon {
    display: none;
  }
  
}
  
  
  </style>
  