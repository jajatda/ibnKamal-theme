<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link href="./output.css" rel="stylesheet"> -->
<link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_uri() ); ?>" type="text/css" />
  <title><?php wp_title( '|', true, 'right' ); ?></title>
  <!-- Alpine Plugins -->
  <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
  <!-- Alpine Core -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <?php wp_head(); ?>
</head>
<body class="bg-neutral-50 dark:bg-neutral-900">

<?php
// if(is_front_page()):
if(false):
?>
<header x-data="{ atTop: false }" class="fixed top-0 z-20 block w-full" @scroll.window="atTop = (window.pageYOffset < 50) ? false: true">
      <nav x-data="{ 
        mobileMenuIsOpen: false,
        siteName:'<?php bloginfo( 'name' ); ?>',
        siteUrl:'<?php echo site_url();?>',
        menu:[
            <?php $menu= wp_get_nav_menu_items("Navbar"); 
                foreach($menu as $item){
                // echo "$item->url";
                echo "{title:'$item->title', url:'$item->url', current:false},";

                }
                ?>

        ],
      
      }"
       @click.away="mobileMenuIsOpen = false"
      :class="{ 'bg-slate-50 dark:bg-green-950/75 dark:text-white border-0 rounded-none shadow-md h-max border-white/80 bg-opacity-80 backdrop-blur-2xl backdrop-saturate-200': atTop, 'text-white' : !atTop }"
      class=" flex items-center justify-between w-full max-w-full px-4 py-3   lg:px-4 lg:py-5">
      <div class="flex items-center justify-between w-full lg:w-4/5 mx-auto">
      <!-- Brand Logo -->
      <a :href="siteUrl" class="text-xl font-medium">
        <span x-text="siteName"></span>
        <!-- <img src="./your-logo.svg" alt="brand logo" class="w-10" /> -->
      </a>
      <!-- Desktop Menu -->
      <ul class="hidden items-center gap-4 sm:flex">
        <template x-for="item in menu">
          <li><a :href="item.url" x-text="item.title" x-bind:class="{
            'text-white': !atTop,
            'text-neutral-900 dark:text-white dark:hover:text-white': atTop,
            'font-normal': !item.current,
            'font-medium': item.current,
          }" class="  underline-offset-2 hover:text-black focus:outline-none focus:underline text-base " ></a></li>
        </template>
        <!-- CTA Button -->
        <li>
          <!-- <a href="#" class="rounded-md bg-black px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-100 hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:bg-white dark:text-black dark:focus-visible:outline-white">Sign Up</a> -->
          <div class="border rounded-full p-1 flex " 
          :class="{ 'bg-neutral-200 dark:bg-neutral-900' : !atTop, '' : atTop, }">
            <button x-data
                    @click="$store.darkMode.light()"
                    class="rounded-full h-6 w-6 
                           text-gray-500 hover:text-gray-900 dark:hover:text-gray-300 
                           hover:bg-gray-100 dark:hover:bg-gray-700 
                           flex items-center justify-center 
                           focus:outline-none"
                    :class="$store.darkMode.mode == 'light' ? 'bg-gray-100 text-gray-900' : ''"
            >
                <svg name="Light Mode" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="h-5 w-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"></path>
              </svg>
            </button>
            <!-- <button x-data
                    @click="$store.darkMode.system()"
                    class="rounded-full h-8 w-8 
                           text-gray-500 hover:text-gray-900 dark:hover:text-gray-300 
                           hover:bg-gray-100 dark:hover:bg-gray-700 
                           flex items-center justify-center 
                           focus:outline-none"
                    :class="$store.darkMode.mode == 'system' ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-300' : ''"
            >
              <span class="text-base material-symbols-outlined">desktop_windows</span>
            </button> -->
            <button x-data
                    @click="$store.darkMode.dark()"
                    class="rounded-full h-6 w-6
                           text-gray-500 hover:text-gray-900 dark:hover:text-gray-300 
                           hover:bg-gray-100 dark:hover:bg-gray-700 
                           flex items-center justify-center 
                           focus:outline-none"
                    :class="$store.darkMode.mode == 'dark' ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-300' : ''"
                     >
                <svg x-show="!$store.darkMode.on" name="Dark Mode" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"></path>
                </svg>
    
            </button>
          </div>
        </li>
      </ul>
      
      <!-- Mobile Menu Button -->
      <button @click="mobileMenuIsOpen = !mobileMenuIsOpen" :aria-expanded="mobileMenuIsOpen" :class="mobileMenuIsOpen ? 'fixed top-6 right-6 z-20 text-slate-900/75 dark:text-white' : null" 
      :class="atTop && mobileMenuIsOpen ? 'text-slate-900/75 dark:text-white':'' "
      type="button" class="flex sm:hidden" aria-label="mobile menu" aria-controls="mobileMenu">
        <svg x-cloak x-show="!mobileMenuIsOpen" xmlns="http://www.w3.org/2000/svg" fill="none" aria-hidden="true" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
        <svg x-cloak x-show="mobileMenuIsOpen" xmlns="http://www.w3.org/2000/svg" fill="none" aria-hidden="true" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
      </button>
      <!-- Mobile Menu -->
      <ul x-cloak x-show="mobileMenuIsOpen" x-transition:enter="transition motion-reduce:transition-none ease-out duration-300" x-transition:enter-start="-translate-y-full" x-transition:enter-end="translate-y-0" x-transition:leave="transition motion-reduce:transition-none ease-out duration-300" x-transition:leave-start="translate-y-0" x-transition:leave-end="-translate-y-full" id="mobileMenu" class="fixed max-h-svh overflow-y-auto inset-x-0 top-0 z-10 flex flex-col divide-y divide-neutral-300 rounded-b-md border-b border-neutral-300  px-6 pb-6 pt-20 dark:divide-neutral-700 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-900 sm:hidden">
        <li class="flex justify-left -mt-14 mb-4">
          <div class="border rounded-full p-1 flex " 
          :class="{ 'bg-neutral-200 dark:bg-neutral-900' : !atTop, '' : atTop, }">
            <button x-data
                    @click="$store.darkMode.light()"
                    class="rounded-full h-6 w-6 
                           text-gray-500 hover:text-gray-900 dark:hover:text-gray-300 
                           hover:bg-gray-100 dark:hover:bg-gray-700 
                           flex items-center justify-center 
                           focus:outline-none"
                    :class="$store.darkMode.mode == 'light' ? 'bg-gray-100 text-gray-900' : ''"
            >
                <svg name="Light Mode" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="h-5 w-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"></path>
              </svg>
            </button>

            <button x-data
                    @click="$store.darkMode.dark()"
                    class="rounded-full h-6 w-6
                           text-gray-500 hover:text-gray-900 dark:hover:text-gray-300 
                           hover:bg-gray-100 dark:hover:bg-gray-700 
                           flex items-center justify-center 
                           focus:outline-none"
                    :class="$store.darkMode.mode == 'dark' ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-300' : ''"
                     >
                <svg x-show="!$store.darkMode.on" name="Dark Mode" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"></path>
                </svg>
    
            </button>
          </div>
         </li>
        <template x-for="item in menu">
          <li class="py-4"><a href="item.url" x-text="item.title" x-bind:class="{
            'font-normal': !item.current,
            'font-bold': item.current,
          }" class="w-full  text-neutral-900 focus:underline dark:text-white text-base"></a></li>
        </template>

        <!-- CTA Button -->
        <!-- <li class="mt-4 w-full border-none"><a href="#" class="rounded-md bg-black px-4 py-2 block text-center font-medium tracking-wide text-neutral-100 hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:bg-white dark:text-black dark:focus-visible:outline-white">Sign Up</a></li> -->

      </ul>
      </div>  

      </nav>
      
</header>
<?php
else:
?>

<header x-data="{ atTop: false }" class="sticky <?php echo is_user_logged_in() ? 'top-8' : 'top-0'; ?>  z-20 block w-full" @scroll.window="atTop = (window.pageYOffset < 50) ? false: true">
      <nav x-data="{ 
        mobileMenuIsOpen: false,
        siteName:'<?php bloginfo( 'name' ); ?>',
        siteUrl:'<?php echo site_url();?>',
        menu:[
            <?php $menu= wp_get_nav_menu_items("Navbar"); 
                foreach($menu as $item){
                // echo "$item->url";
                echo "{title:'$item->title', url:'$item->url', current:false},";

                }
                ?>

        ],
      
      }"
       @click.away="mobileMenuIsOpen = false"
      :class="{ 'bg-neutral-50 dark:bg-green-950/30 dark:text-white border-0 rounded-none shadow-md h-max border-white/80 bg-opacity-80 backdrop-blur-2xl backdrop-saturate-200': true, '' : !atTop }"
      class="bg-slate-50 flex items-center justify-between w-full max-w-full px-4 py-3   lg:px-4 lg:py-5">
      <div class="flex items-center justify-between w-full lg:w-4/5 mx-auto">
      <!-- Brand Logo -->
      <a :href="siteUrl" class="text-xl font-medium">
        <span x-text="siteName"></span>
        <!-- <img src="./your-logo.svg" alt="brand logo" class="w-10" /> -->
      </a>
      <!-- Desktop Menu -->
      <ul class="hidden items-center gap-4 sm:flex">
        <template x-for="item in menu">
          <li><a :href="item.url" x-text="item.title" x-bind:class="{
            '': !atTop,
            'text-neutral-900 dark:text-white dark:hover:text-white': atTop,
            'font-normal': !item.current,
            'font-medium': item.current,
          }" class="  underline-offset-2 hover:text-black focus:outline-none focus:underline text-base " ></a></li>
        </template>
        <!-- CTA Button -->
        <li>
          <!-- <a href="#" class="rounded-md bg-black px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-100 hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:bg-white dark:text-black dark:focus-visible:outline-white">Sign Up</a> -->
          <div class="border rounded-full p-1 flex " 
          :class="{ 'bg-neutral-200 dark:bg-neutral-900' : !atTop, '' : atTop, }">
            <button x-data
                    @click="$store.darkMode.light()"
                    class="rounded-full h-6 w-6 
                           text-gray-500 hover:text-gray-900 dark:hover:text-gray-300 
                           hover:bg-gray-100 dark:hover:bg-gray-700 
                           flex items-center justify-center 
                           focus:outline-none"
                    :class="$store.darkMode.mode == 'light' ? 'bg-gray-100 text-gray-900' : ''"
            >
                <svg name="Light Mode" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="h-5 w-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"></path>
              </svg>
            </button>
            <!-- <button x-data
                    @click="$store.darkMode.system()"
                    class="rounded-full h-8 w-8 
                           text-gray-500 hover:text-gray-900 dark:hover:text-gray-300 
                           hover:bg-gray-100 dark:hover:bg-gray-700 
                           flex items-center justify-center 
                           focus:outline-none"
                    :class="$store.darkMode.mode == 'system' ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-300' : ''"
            >
              <span class="text-base material-symbols-outlined">desktop_windows</span>
            </button> -->
            <button x-data
                    @click="$store.darkMode.dark()"
                    class="rounded-full h-6 w-6
                           text-gray-500 hover:text-gray-900 dark:hover:text-gray-300 
                           hover:bg-gray-100 dark:hover:bg-gray-700 
                           flex items-center justify-center 
                           focus:outline-none"
                    :class="$store.darkMode.mode == 'dark' ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-300' : ''"
                     >
                <svg x-show="!$store.darkMode.on" name="Dark Mode" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"></path>
                </svg>
    
            </button>
          </div>
        </li>
      </ul>
      
      <!-- Mobile Menu Button -->
      <button @click="mobileMenuIsOpen = !mobileMenuIsOpen" :aria-expanded="mobileMenuIsOpen" :class="mobileMenuIsOpen ? 'fixed top-6 right-6 z-20 text-slate-900/75 dark:text-white' : null" 
      :class="atTop && mobileMenuIsOpen ? 'text-slate-900/75 dark:text-white':'' "
      type="button" class="flex sm:hidden" aria-label="mobile menu" aria-controls="mobileMenu">
        <svg x-cloak x-show="!mobileMenuIsOpen" xmlns="http://www.w3.org/2000/svg" fill="none" aria-hidden="true" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
        <svg x-cloak x-show="mobileMenuIsOpen" xmlns="http://www.w3.org/2000/svg" fill="none" aria-hidden="true" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
      </button>
      <!-- Mobile Menu -->
      <ul x-cloak x-show="mobileMenuIsOpen" x-transition:enter="transition motion-reduce:transition-none ease-out duration-300" x-transition:enter-start="-translate-y-full" x-transition:enter-end="translate-y-0" x-transition:leave="transition motion-reduce:transition-none ease-out duration-300" x-transition:leave-start="translate-y-0" x-transition:leave-end="-translate-y-full" id="mobileMenu" class="fixed max-h-svh overflow-y-auto inset-x-0 top-0 z-10 flex flex-col divide-y divide-neutral-300 rounded-b-md border-b border-neutral-300  px-6 pb-6 pt-20 dark:divide-neutral-700 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-900 sm:hidden">
        <li class="flex justify-left -mt-14 mb-4">
          <div class="border rounded-full p-1 flex " 
          :class="{ 'bg-neutral-200 dark:bg-neutral-900' : !atTop, '' : atTop, }">
            <button x-data
                    @click="$store.darkMode.light()"
                    class="rounded-full h-6 w-6 
                           text-gray-500 hover:text-gray-900 dark:hover:text-gray-300 
                           hover:bg-gray-100 dark:hover:bg-gray-700 
                           flex items-center justify-center 
                           focus:outline-none"
                    :class="$store.darkMode.mode == 'light' ? 'bg-gray-100 text-gray-900' : ''"
            >
                <svg name="Light Mode" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="h-5 w-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"></path>
              </svg>
            </button>

            <button x-data
                    @click="$store.darkMode.dark()"
                    class="rounded-full h-6 w-6
                           text-gray-500 hover:text-gray-900 dark:hover:text-gray-300 
                           hover:bg-gray-100 dark:hover:bg-gray-700 
                           flex items-center justify-center 
                           focus:outline-none"
                    :class="$store.darkMode.mode == 'dark' ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-300' : ''"
                     >
                <svg x-show="!$store.darkMode.on" name="Dark Mode" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"></path>
                </svg>
    
            </button>
          </div>
         </li>
        <template x-for="item in menu">
          <li class="py-4"><a href="item.url" x-text="item.title" x-bind:class="{
            'font-normal': !item.current,
            'font-bold': item.current,
          }" class="w-full  text-neutral-900 focus:underline dark:text-white text-base"></a></li>
        </template>

        <!-- CTA Button -->
        <!-- <li class="mt-4 w-full border-none"><a href="#" class="rounded-md bg-black px-4 py-2 block text-center font-medium tracking-wide text-neutral-100 hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:bg-white dark:text-black dark:focus-visible:outline-white">Sign Up</a></li> -->

      </ul>
      </div>  

      </nav>
      
</header>

<?php
endif;
?>


<main class="flex flex-col justify-between sm:ml-auto sm:mr-auto h-full  border-0">