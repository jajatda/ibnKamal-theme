<!doctype html>
<html lang="en" class="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./output.css" rel="stylesheet">
  <title>Template</title>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-200 dark:bg-slate-900">
  
    <header class="sticky top-0 z-20 block">
        <div class="hidden dark:text-white" x-data="{ open: false }">
            <button @click="open = ! open">Toggle Content</button>
         
            <div x-show="open">
                Content...
            </div>
        </div>
        <nav
        class=" w-full max-w-full px-4 py-2  bg-white dark:bg-slate-900/75 dark:text-white border rounded-none shadow-md h-max border-white/80 bg-opacity-80 backdrop-blur-2xl backdrop-saturate-200 lg:px-8 lg:py-4">
        <div class=" lg:w-4/5 ml-auto mr-auto flex items-center justify-between text-blue-gray-900">
          <a href="#"
            class="mr-0 block cursor-pointer py-1.5 font-sans text-base font-medium leading-relaxed text-inherit antialiased">
            Material Tailwind
          </a>
          <div class="flex items-center gap-4">
            <div class="hidden mr-4 lg:block">
              <ul class="flex flex-col gap-2 mt-2 mb-4 lg:mb-0 lg:mt-0 lg:flex-row lg:items-center lg:gap-6">
                <li class="block p-1 font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                  <a href="#" class="flex items-center">
                    Pages
                  </a>
                </li>
                <li class="block p-1 font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                  <a href="#" class="flex items-center">
                    Account
                  </a>
                </li>
                <li class="block p-1 font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                  <a href="#" class="flex items-center">
                    Blocks
                  </a>
                </li>
                <li class="block p-1 font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                  <a href="#" class="flex items-center">
                    Docs
                  </a>
                </li>
              </ul>
            </div>
            <div class="flex items-center gap-x-1">
              <button
                class="hidden px-4 py-2 font-sans text-xs font-bold text-center text-gray-900 uppercase align-middle transition-all rounded-lg select-none hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none lg:inline-block"
                type="button">
                <span>Log In</span>
              </button>
              <button
                class="hidden select-none rounded-lg bg-gradient-to-tr from-gray-900 to-gray-800 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none lg:inline-block"
                type="button">
                <span>Sign in</span>
              </button>
            </div>
            <button
              class="relative ml-auto h-6 max-h-[40px] w-6 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-inherit transition-all hover:bg-transparent focus:bg-transparent active:bg-transparent disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none lg:hidden"
              type="button">
              <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor"
                  stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
              </span>
            </button>
          </div>
        </div>
      </nav>
</header>
<main class="flex flex-col justify-between sm:ml-auto sm:mr-auto h-full  border-0">
  <section>
    <div x-data="{            
      // Sets the time between each slides in milliseconds
      autoplayIntervalTime: 4000,
      slides: [                
          {
              imgSrc: 'https://penguinui.s3.amazonaws.com/component-assets/carousel/default-slide-1.webp',
              imgAlt: 'Vibrant abstract painting with swirling blue and light pink hues on a canvas.',  
              title: 'Front end developers',
              description: 'The architects of the digital world, constantly battling against their mortal enemy – browser compatibility.',           
          },                
          {                    
              imgSrc: 'https://penguinui.s3.amazonaws.com/component-assets/carousel/default-slide-2.webp',                    
              imgAlt: 'Vibrant abstract painting with swirling red, yellow, and pink hues on a canvas.',  
              title: 'Back end developers',
              description: 'Because not all superheroes wear capes, some wear headphones and stare at terminal screens',            
          },                
          {                    
              imgSrc: 'https://penguinui.s3.amazonaws.com/component-assets/carousel/default-slide-3.webp',                    
              imgAlt: 'Vibrant abstract painting with swirling blue and purple hues on a canvas.',    
              title: 'Full stack developers',
              description: 'Where &quot;burnout&quot; is just a fancy term for &quot;Tuesday&quot;.',       
          },            
      ],            
      currentSlideIndex: 1,
      isPaused: false,
      autoplayInterval: null,
      previous() {                
          if (this.currentSlideIndex > 1) {                    
              this.currentSlideIndex = this.currentSlideIndex - 1                
          } else {   
              // If it's the first slide, go to the last slide           
              this.currentSlideIndex = this.slides.length                
          }            
      },            
      next() {                
          if (this.currentSlideIndex < this.slides.length) {                    
              this.currentSlideIndex = this.currentSlideIndex + 1                
          } else {                 
              // If it's the last slide, go to the first slide    
              this.currentSlideIndex = 1                
          }            
      },    
      autoplay() {
          this.autoplayInterval = setInterval(() => {
              if (! this.isPaused) {
                  this.next()
              }
          }, this.autoplayIntervalTime)
      },
      // Updates interval time   
      setAutoplayInterval(newIntervalTime) {
          clearInterval(this.autoplayInterval)
          this.autoplayIntervalTime = newIntervalTime
          this.autoplay()
      },    
  }" x-init="autoplay" class="relative w-full overflow-hidden">
     
      <!-- slides -->
      <!-- Change min-h-[50svh] to your preferred height size -->
      <div class="relative min-h-[50svh] w-full">
          <template x-for="(slide, index) in slides">
              <div x-cloak x-show="currentSlideIndex == index + 1" class="absolute inset-0" x-transition.opacity.duration.1000ms>
                  
                  <!-- Title and description -->
                  <div class="lg:px-32 lg:py-14 absolute inset-0 z-10 flex flex-col items-center justify-end gap-2 bg-gradient-to-t from-neutral-950/85 to-transparent px-16 py-12 text-center">
                      <h3 class="w-full lg:w-[80%] text-balance text-2xl lg:text-3xl font-bold text-white" x-text="slide.title" x-bind:aria-describedby="'slide' + (index + 1) + 'Description'"></h3>
                      <p class="lg:w-1/2 w-full text-pretty text-sm text-neutral-300" x-text="slide.description" x-bind:id="'slide' + (index + 1) + 'Description'"></p>
                  </div>
  
                  <img class="absolute w-full h-full inset-0 object-cover text-neutral-600 dark:text-neutral-300" x-bind:src="slide.imgSrc" x-bind:alt="slide.imgAlt" />
              </div>
          </template>
      </div>
      
      <!-- Pause/Play Button -->
      <button type="button" class="absolute bottom-5 right-5 z-20 rounded-full text-neutral-300 opacity-50 transition hover:opacity-80 focus-visible:opacity-80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white active:outline-offset-0" aria-label="pause carousel" x-on:click="(isPaused = !isPaused), setAutoplayInterval(autoplayIntervalTime)" x-bind:aria-pressed="isPaused">
          <svg x-cloak x-show="isPaused" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="size-7">
              <path fill-rule="evenodd" d="M2 10a8 8 0 1 1 16 0 8 8 0 0 1-16 0Zm6.39-2.908a.75.75 0 0 1 .766.027l3.5 2.25a.75.75 0 0 1 0 1.262l-3.5 2.25A.75.75 0 0 1 8 12.25v-4.5a.75.75 0 0 1 .39-.658Z" clip-rule="evenodd">
          </svg>
          <svg x-cloak x-show="!isPaused" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="size-7">
              <path fill-rule="evenodd" d="M2 10a8 8 0 1 1 16 0 8 8 0 0 1-16 0Zm5-2.25A.75.75 0 0 1 7.75 7h.5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-.75.75h-.5a.75.75 0 0 1-.75-.75v-4.5Zm4 0a.75.75 0 0 1 .75-.75h.5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-.75.75h-.5a.75.75 0 0 1-.75-.75v-4.5Z" clip-rule="evenodd">
          </svg>
      </button>
      
      <!-- indicators -->
      <div class="absolute rounded-md bottom-3 md:bottom-5 left-1/2 z-20 flex -translate-x-1/2 gap-4 md:gap-3 px-1.5 py-1 md:px-2" role="group" aria-label="slides" >
          <template x-for="(slide, index) in slides">
              <button class="size-2 cursor-pointer rounded-full transition" x-on:click="(currentSlideIndex = index + 1), setAutoplayInterval(autoplayIntervalTime)" x-bind:class="[currentSlideIndex === index + 1 ? 'bg-neutral-300' : 'bg-neutral-300/50']" x-bind:aria-label="'slide ' + (index + 1)"></button>
          </template>
      </div>
  </div>
  </section>
  <section class="grid grid-cols-2 lg:grid-cols-3 grid-rows-3 gap-0.5 min-h-[500px]">
    <!-- <h1 class="inline-block font-bold text-lg">Fiqih Islam 1</h1>
    <h1 class="inline-block font-bold text-lg">Fiqih Islam 1</h1> -->
    <div class="first:col-span-2 first:row-span-2 bg-slate-600">tes</div>
    <div class="first:col-span-2 first:row-span-2 inline-block bg-slate-600">tes</div>
    <div class="first:col-span-2 first:row-span-2 inline-block bg-slate-600">tes</div>
    <div class="first:col-span-2 first:row-span-2 inline-block bg-slate-600">tes</div>
    <div class="first:col-span-2 first:row-span-2 inline-block bg-slate-600">tes</div>
    <div class="first:col-span-2 first:row-span-2 inline-block bg-slate-600">tes</div>
    


  </section>
  <section class="min-h-screen border-2 border-blue-700 first:border-2 first:border-black">
    <div class="w-full lg:w-2/3 h-80 block relative float-left border-2">
      <div class="w-full h-full bg-slate-400 block">tes</div>
    </div>
    <div class="block h-0 ">
      <div class="w-1/3 min-w-48 h-40 bg-slate-400 inline-block relative float-left">a</div>
      <div class="w-1/3 min-w-48 h-40 bg-slate-400 inline-block relative float-left">b</div>
      <div class="w-1/3 min-w-48 h-40 bg-slate-400 inline-block relative float-left">c</div>
    </div>

  </section>

  <section class="grid grid-cols-1 lg:grid-cols-3 gap-4 min-h-screen w-full">
    <!-- Card -->
    <div class="block rounded-lg bg-white shadow-lg dark:bg-neutral-700 text-left">

      <!-- Card image -->
      <a href="#!">
        <img class="rounded-t-lg" src="https://tecdn.b-cdn.net/img/new/standard/nature/184.jpg" alt="" />
      </a>

      <!-- Card body -->
      <div class="p-6">

        <!-- Title -->
        <h5 class="mb-2 text-xl font-bold tracking-wide text-neutral-800 dark:text-neutral-50">
          Explore the hidden beauty
        </h5>

        <!-- Text -->
        <p class="mb-2 text-base text-neutral-500 dark:text-neutral-300">
          Explore the captivating beauty of Antelope Canyon's red sandstone formations and intricate play of light and
          shadows.
        </p>

      </div>

    </div>
    <!-- Card -->
    <!-- Card -->
    <div class="block rounded-lg bg-white shadow-lg dark:bg-neutral-700 text-left">

      <!-- Card image -->
      <a href="#!">
        <img class="rounded-t-lg" src="https://tecdn.b-cdn.net/img/new/standard/nature/184.jpg" alt="" />
      </a>

      <!-- Card body -->
      <div class="p-6">

        <!-- Title -->
        <h5 class="mb-2 text-xl font-bold tracking-wide text-neutral-800 dark:text-neutral-50">
          Explore the hidden beauty
        </h5>

        <!-- Text -->
        <p class="mb-2 text-base text-neutral-500 dark:text-neutral-300">
          Explore the captivating beauty of Antelope Canyon's red sandstone formations and intricate play of light and
          shadows.
        </p>

      </div>

    </div>
    <!-- Card -->
    <!-- Card -->
    <div class="block rounded-lg bg-white shadow-lg dark:bg-neutral-700 text-left">

      <!-- Card image -->
      <a href="#!">
        <img class="rounded-t-lg" src="https://tecdn.b-cdn.net/img/new/standard/nature/184.jpg" alt="" />
      </a>

      <!-- Card body -->
      <div class="p-6">

        <!-- Title -->
        <h5 class="mb-2 text-xl font-bold tracking-wide text-neutral-800 dark:text-neutral-50">
          Explore the hidden beauty
        </h5>

        <!-- Text -->
        <p class="mb-2 text-base text-neutral-500 dark:text-neutral-300">
          Explore the captivating beauty of Antelope Canyon's red sandstone formations and intricate play of light and
          shadows.
        </p>

      </div>

    </div>
    <!-- Card -->
    <!-- Card -->
    <div class="block rounded-lg bg-white shadow-lg dark:bg-neutral-700 text-left">

      <!-- Card image -->
      <a href="#!">
        <img class="rounded-t-lg" src="https://tecdn.b-cdn.net/img/new/standard/nature/184.jpg" alt="" />
      </a>

      <!-- Card body -->
      <div class="p-6">

        <!-- Title -->
        <h5 class="mb-2 text-xl font-bold tracking-wide text-neutral-800 dark:text-neutral-50">
          Explore the hidden beauty
        </h5>

        <!-- Text -->
        <p class="mb-2 text-base text-neutral-500 dark:text-neutral-300">
          Explore the captivating beauty of Antelope Canyon's red sandstone formations and intricate play of light and
          shadows.
        </p>

      </div>

    </div>
    <!-- Card -->
    <!-- Card -->
    <div class="block rounded-lg bg-white shadow-lg dark:bg-neutral-700 text-left">

      <!-- Card image -->
      <a href="#!">
        <img class="rounded-t-lg" src="https://tecdn.b-cdn.net/img/new/standard/nature/184.jpg" alt="" />
      </a>

      <!-- Card body -->
      <div class="p-6">

        <!-- Title -->
        <h5 class="mb-2 text-xl font-bold tracking-wide text-neutral-800 dark:text-neutral-50">
          Explore the hidden beauty
        </h5>

        <!-- Text -->
        <p class="mb-2 text-base text-neutral-500 dark:text-neutral-300">
          Explore the captivating beauty of Antelope Canyon's red sandstone formations and intricate play of light and
          shadows.
        </p>

      </div>

    </div>
    <!-- Card -->

  </section>
  <section class="m-2 grid grid-cols-1 lg:grid-cols-2 gap-2">
    <article class="group grid rounded-md max-w-2xl grid-cols-1 md:grid-cols-8 overflow-hidden border border-neutral-300 bg-neutral-50 text-neutral-600 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
      <!-- image -->
      <div class="col-span-3 overflow-hidden">
          <img src="https://penguinui.s3.amazonaws.com/component-assets/card-img-4.webp" class="h-52 md:h-full w-full object-cover transition duration-700 ease-out group-hover:scale-105" alt="a men wearing VR goggles" />
      </div>
      <!-- body -->
      <div class="flex flex-col justify-center p-6 col-span-5">
          <small class="mb-4 font-medium">Artificial Intelligence</small>
          <h3 class="text-balance text-xl font-bold text-neutral-900 lg:text-2xl dark:text-white" aria-describedby="articleDescription">AI-Powered VR Goggles Redefine Reality: Augmented Vision for Al</h3>
          <p id="articleDescription" class="my-4 max-w-lg text-pretty text-sm">
              Experience the next level of augmented reality with smart
              goggles integrating cutting-edge AI for seamless interaction
              with the world around you.
          </p>
          <a href="#" class="w-fit font-medium text-black underline-offset-2 hover:underline focus:underline focus:outline-none dark:text-white">
             Read full story
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2.5" aria-hidden="true" class="inline size-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
              </svg>
          </a>
      </div>
  </article>
    <article class="group grid rounded-md max-w-2xl grid-cols-1 md:grid-cols-8 overflow-hidden border border-neutral-300 bg-neutral-50 text-neutral-600 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
      <!-- image -->
      <div class="col-span-3 overflow-hidden">
          <img src="https://penguinui.s3.amazonaws.com/component-assets/card-img-4.webp" class="h-52 md:h-full w-full object-cover transition duration-700 ease-out group-hover:scale-105" alt="a men wearing VR goggles" />
      </div>
      <!-- body -->
      <div class="flex flex-col justify-center p-6 col-span-5">
          <small class="mb-4 font-medium">Artificial Intelligence</small>
          <h3 class="text-balance text-xl font-bold text-neutral-900 lg:text-2xl dark:text-white" aria-describedby="articleDescription">AI-Powered VR Goggles Redefine Reality: Augmented Vision for Al</h3>
          <p id="articleDescription" class="my-4 max-w-lg text-pretty text-sm">
              Experience the next level of augmented reality with smart
              goggles integrating cutting-edge AI for seamless interaction
              with the world around you.
          </p>
          <a href="#" class="w-fit font-medium text-black underline-offset-2 hover:underline focus:underline focus:outline-none dark:text-white">
             Read full story
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2.5" aria-hidden="true" class="inline size-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
              </svg>
          </a>
      </div>
  </article>
    <article class="group grid rounded-md max-w-2xl grid-cols-1 md:grid-cols-8 overflow-hidden border border-neutral-300 bg-neutral-50 text-neutral-600 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
      <!-- image -->
      <div class="col-span-3 overflow-hidden">
          <img src="https://penguinui.s3.amazonaws.com/component-assets/card-img-4.webp" class="h-52 md:h-full w-full object-cover transition duration-700 ease-out group-hover:scale-105" alt="a men wearing VR goggles" />
      </div>
      <!-- body -->
      <div class="flex flex-col justify-center p-6 col-span-5">
          <small class="mb-4 font-medium">Artificial Intelligence</small>
          <h3 class="text-balance text-xl font-bold text-neutral-900 lg:text-2xl dark:text-white" aria-describedby="articleDescription">AI-Powered VR Goggles Redefine Reality: Augmented Vision for Al</h3>
          <p id="articleDescription" class="my-4 max-w-lg text-pretty text-sm">
              Experience the next level of augmented reality with smart
              goggles integrating cutting-edge AI for seamless interaction
              with the world around you.
          </p>
          <a href="#" class="w-fit font-medium text-black underline-offset-2 hover:underline focus:underline focus:outline-none dark:text-white">
             Read full story
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2.5" aria-hidden="true" class="inline size-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
              </svg>
          </a>
      </div>
  </article>
    <article class="group grid rounded-md max-w-2xl grid-cols-1 md:grid-cols-8 overflow-hidden border border-neutral-300 bg-neutral-50 text-neutral-600 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
      <!-- image -->
      <div class="col-span-3 overflow-hidden">
          <img src="https://penguinui.s3.amazonaws.com/component-assets/card-img-4.webp" class="h-52 md:h-full w-full object-cover transition duration-700 ease-out group-hover:scale-105" alt="a men wearing VR goggles" />
      </div>
      <!-- body -->
      <div class="flex flex-col justify-center p-6 col-span-5">
          <small class="mb-4 font-medium">Artificial Intelligence</small>
          <h3 class="text-balance text-xl font-bold text-neutral-900 lg:text-2xl dark:text-white" aria-describedby="articleDescription">AI-Powered VR Goggles Redefine Reality: Augmented Vision for Al</h3>
          <p id="articleDescription" class="my-4 max-w-lg text-pretty text-sm">
              Experience the next level of augmented reality with smart
              goggles integrating cutting-edge AI for seamless interaction
              with the world around you.
          </p>
          <a href="#" class="w-fit font-medium text-black underline-offset-2 hover:underline focus:underline focus:outline-none dark:text-white">
             Read full story
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2.5" aria-hidden="true" class="inline size-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
              </svg>
          </a>
      </div>
  </article>
  </section>


</main>
    <footer class="bg-white border-t-2 rounded-none h-max border-white/80 bg-opacity-80 backdrop-blur-2xl backdrop-saturate-200 shadow-[4px_0_6px_-1px_rgba(0,0,0,0.1)] ">
        <div class="lg:w-4/5 p-4 m-auto">
            <footer class="relative w-full">
                <div class="w-full px-8 mx-auto max-w-7xl">
                  <div class="grid justify-between grid-cols-1 gap-4 md:grid-cols-2">
                    <h5 class="block text-center sm:text-left mb-6 font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-inherit">
                      Material Tailwind
                    </h5>
                    <div class="grid justify-between grid-cols-2 sm:grid-cols-3 text-center sm:text-left gap-4">
                      <ul>
                        <p
                          class="block mb-3 font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900 opacity-40">
                          Product
                        </p>
                        <li>
                          <a href="#"
                            class="block py-1.5 font-sans text-base font-normal leading-relaxed text-gray-700 antialiased transition-colors hover:text-blue-gray-900">
                            Overview
                          </a>
                        </li>
                        <li>
                          <a href="#"
                            class="block py-1.5 font-sans text-base font-normal leading-relaxed text-gray-700 antialiased transition-colors hover:text-blue-gray-900">
                            Features
                          </a>
                        </li>
                        <li>
                          <a href="#"
                            class="block py-1.5 font-sans text-base font-normal leading-relaxed text-gray-700 antialiased transition-colors hover:text-blue-gray-900">
                            Solutions
                          </a>
                        </li>
                        <li>
                          <a href="#"
                            class="block py-1.5 font-sans text-base font-normal leading-relaxed text-gray-700 antialiased transition-colors hover:text-blue-gray-900">
                            Tutorials
                          </a>
                        </li>
                      </ul>
                      <ul>
                        <p
                          class="block mb-3 font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900 opacity-40">
                          Company
                        </p>
                        <li>
                          <a href="#"
                            class="block py-1.5 font-sans text-base font-normal leading-relaxed text-gray-700 antialiased transition-colors hover:text-blue-gray-900">
                            About us
                          </a>
                        </li>
                        <li>
                          <a href="#"
                            class="block py-1.5 font-sans text-base font-normal leading-relaxed text-gray-700 antialiased transition-colors hover:text-blue-gray-900">
                            Careers
                          </a>
                        </li>
                        <li>
                          <a href="#"
                            class="block py-1.5 font-sans text-base font-normal leading-relaxed text-gray-700 antialiased transition-colors hover:text-blue-gray-900">
                            Press
                          </a>
                        </li>
                        <li>
                          <a href="#"
                            class="block py-1.5 font-sans text-base font-normal leading-relaxed text-gray-700 antialiased transition-colors hover:text-blue-gray-900">
                            News
                          </a>
                        </li>
                      </ul>
                      <ul>
                        <p
                          class="block mb-3 font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900 opacity-40">
                          Resource
                        </p>
                        <li>
                          <a href="#"
                            class="block py-1.5 font-sans text-base font-normal leading-relaxed text-gray-700 antialiased transition-colors hover:text-blue-gray-900">
                            Blog
                          </a>
                        </li>
                        <li>
                          <a href="#"
                            class="block py-1.5 font-sans text-base font-normal leading-relaxed text-gray-700 antialiased transition-colors hover:text-blue-gray-900">
                            Newsletter
                          </a>
                        </li>
                        <li>
                          <a href="#"
                            class="block py-1.5 font-sans text-base font-normal leading-relaxed text-gray-700 antialiased transition-colors hover:text-blue-gray-900">
                            Events
                          </a>
                        </li>
                        <li>
                          <a href="#"
                            class="block py-1.5 font-sans text-base font-normal leading-relaxed text-gray-700 antialiased transition-colors hover:text-blue-gray-900">
                            Help center
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div
                    class="flex flex-col items-center justify-center w-full py-4 mt-12 border-t border-blue-gray-50 md:flex-row md:justify-between">
                    <p
                      class="block mb-4 font-sans text-sm antialiased font-normal leading-normal text-center text-blue-gray-900 md:mb-0">
                      © 2023{" "}
                      <a href="https://material-tailwind.com/">Material Tailwind</a>. All
                      Rights Reserved.
                    </p>
                    <div class="flex gap-4 text-blue-gray-900 sm:justify-center">
                      <a href="#"
                        class="block font-sans text-base antialiased font-light leading-relaxed transition-opacity text-inherit opacity-80 hover:opacity-100">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                          <path fill-rule="evenodd"
                            d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                            clip-rule="evenodd"></path>
                        </svg>
                      </a>
                      <a href="#"
                        class="block font-sans text-base antialiased font-light leading-relaxed transition-opacity text-inherit opacity-80 hover:opacity-100">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                          <path fill-rule="evenodd"
                            d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                            clip-rule="evenodd"></path>
                        </svg>
                      </a>
                      <a href="#"
                        class="block font-sans text-base antialiased font-light leading-relaxed transition-opacity text-inherit opacity-80 hover:opacity-100">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                          <path
                            d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                          </path>
                        </svg>
                      </a>
                      <a href="#"
                        class="block font-sans text-base antialiased font-light leading-relaxed transition-opacity text-inherit opacity-80 hover:opacity-100">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                          <path fill-rule="evenodd"
                            d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                            clip-rule="evenodd"></path>
                        </svg>
                      </a>
                      <a href="#"
                        class="block font-sans text-base antialiased font-light leading-relaxed transition-opacity text-inherit opacity-80 hover:opacity-100">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                          <path fill-rule="evenodd"
                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z"
                            clip-rule="evenodd"></path>
                        </svg>
                      </a>
                    </div>
                  </div>
                </div>
              </footer>
    </div>
    </footer>
</body>
</html>