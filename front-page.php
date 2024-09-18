<?php
get_header();
?>
  <section class="w-full p-5 pt-0 mt-4">
    <!-- slider -->
    <div x-data="carousel({
      slides: [ 
      <?php
      if(have_posts()):
        while(have_posts()): the_post();

        $slides=get_field('home_slider');
        // var_dump($slides);
        foreach($slides as $slide):
          // echo $slide->post_title;
          // echo $slide->post_excerpt;
          // // echo $slide->post_content;
          // echo get_the_post_thumbnail_url($slide->ID);
          ?>
          {
          imgSrc: '<?php echo get_the_post_thumbnail_url($slide->ID) ?>',
          imgAlt: '<?php echo $slide->post_title ?>',  
          title: '<?php echo $slide->post_title ?>',
          link: '<?php echo get_permalink($slide->ID) ?>',
          description: `<?php 
              if(has_excerpt()){
                echo htmlentities($slide->post_excerpt);
              }else{
                echo htmlentities(wp_trim_words($slide->post_content, 20), ENT_QUOTES); //18 htmlentities($value)
              }?>`           
          },
        <?php
        endforeach;
      endwhile;
     endif;
      ?>               
          
  ],
    })" x-init="autoplay" class="relative w-full lg:w-5/6 mx-auto overflow-hidden rounded-2xl rounded-br-2xl border border-b border-neutral-300 dark:border-neutral-700">
     
      <!-- slides -->
      <!-- Change min-h-[50svh] to your preferred height size -->
      <div class="relative w-full h-96 overflow-hidden"  x-on:touchstart="handleTouchStart($event)" x-on:touchmove="handleTouchMove($event)" x-on:touchend="handleTouchEnd()">
          <template x-for="(slide, index) in slides">
              <div x-cloak x-show="currentSlideIndex == index + 1" class="absolute inset-0" x-transition.opacity.duration.1000ms>
                  
                  <!-- Title and description -->
                  <div class="lg:px-32 lg:py-14 absolute inset-0 z-10 flex flex-col items-center justify-end gap-2 bg-gradient-to-t from-neutral-950/85 to-transparent px-16 py-12 text-center">
                      
                      <h3 class="w-full lg:w-[80%] text-balance text-2xl lg:text-3xl font-bold text-white" x-bind:aria-describedby="'slide' + (index + 1) + 'Description'">
                      <a :href="slide.link" x-text="slide.title"></a>
                      </h3>
                      <p class="lg:w-1/2 w-full text-pretty text-sm text-neutral-300" x-html="slide.description" x-bind:id="'slide' + (index + 1) + 'Description'"></p>
                  </div>
  
                  <img class="absolute w-full h-full inset-0 object-cover text-neutral-600 dark:text-neutral-300" x-bind:src="slide.imgSrc" x-bind:alt="slide.imgAlt" loading="lazy" />
              </div>
          </template>
      </div>
      
      <!-- Pause/Play Button -->
      <button type="button" class="absolute bottom-5 right-5 z-10 rounded-full text-neutral-300 opacity-50 transition hover:opacity-80 focus-visible:opacity-80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white active:outline-offset-0" aria-label="pause carousel" x-on:click="(isPaused = !isPaused), setAutoplayInterval(autoplayIntervalTime)" x-bind:aria-pressed="isPaused">
          <svg x-cloak x-show="isPaused" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="size-7">
              <path fill-rule="evenodd" d="M2 10a8 8 0 1 1 16 0 8 8 0 0 1-16 0Zm6.39-2.908a.75.75 0 0 1 .766.027l3.5 2.25a.75.75 0 0 1 0 1.262l-3.5 2.25A.75.75 0 0 1 8 12.25v-4.5a.75.75 0 0 1 .39-.658Z" clip-rule="evenodd">
          </svg>
          <svg x-cloak x-show="!isPaused" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="size-7">
              <path fill-rule="evenodd" d="M2 10a8 8 0 1 1 16 0 8 8 0 0 1-16 0Zm5-2.25A.75.75 0 0 1 7.75 7h.5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-.75.75h-.5a.75.75 0 0 1-.75-.75v-4.5Zm4 0a.75.75 0 0 1 .75-.75h.5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-.75.75h-.5a.75.75 0 0 1-.75-.75v-4.5Z" clip-rule="evenodd">
          </svg>
      </button>
      
      <!-- indicators -->
      <div class="absolute rounded-md bottom-3 md:bottom-5 left-1/2 z-10 flex -translate-x-1/2 gap-4 md:gap-3 px-1.5 py-1 md:px-2" role="group" aria-label="slides" >
          <template x-for="(slide, index) in slides">
              <button class="size-2 cursor-pointer rounded-full transition" x-on:click="(currentSlideIndex = index + 1), setAutoplayInterval(autoplayIntervalTime)" x-bind:class="[currentSlideIndex === index + 1 ? 'bg-neutral-300' : 'bg-neutral-300/50']" x-bind:aria-label="'slide ' + (index + 1)"></button>
          </template>
      </div>
  </div>
  </section>

<section class=" bg-neutral-50 text-neutral-600 dark:bg-neutral-900 dark:text-neutral-300 p-5">
<div class="flex flex-row flex-wrap gap-5 justify-around w-full lg:w-5/6 mx-auto">
  <div class="w-full lg:w-8/12">

    <section x-data="{newPosts:[
      
    <?php 
                  $newPosts = new WP_Query(array(
                    'posts_per_page' => 5,
                  ));
      if ( $newPosts->have_posts() ) : while ( $newPosts->have_posts() ) : $newPosts->the_post(); ?>
      {
       title: `<?php the_title(); ?>`,
       img: {
        src:`<?php if(get_the_post_thumbnail_url()){ the_post_thumbnail_url(); }else{ echo get_theme_file_uri('/no-img.jpg');} ?>`,
        alt:`<?php the_title(); ?>`
        },
       url:`<?php the_permalink(); ?>`,
       time:`<?php the_time('d M Y'); ?>`,
       author:{name:`<?php echo get_the_author(); ?>`, url:`<?php echo get_the_author_meta('user_url'); ?>`},
        category:[<?php 
       foreach(get_the_category() as $category){
        echo "{'name': '$category->name', 'url': '".get_category_link($category->term_id)."'},";
       }
       ?>],
       excerpt:`<?php 
              if(has_excerpt()){
                echo htmlentities(get_the_excerpt());
              }else{
                echo htmlentities(wp_trim_words(get_the_content(), 70)); //18 htmlentities($value)
              }?>`
      },

<?php endwhile;
wp_reset_postdata(); ?>
<?php endif; ?>
 
      
      ]}" class="news">
              <!-- title -->
        <div x-data="{
        title:'Terbaru',
        url:'<?php echo site_url('/blog');?>',
        }" class="flex justify-between gap-2 overflow-x-auto w-full mx-auto p-1 border-b border-neutral-300 dark:border-neutral-700">
          <h3 x-text="title" class="border-l-4 border-orange-600 dark:border-orange-600/75 pl-3 text-lg font-medium text-neutral-900 lg:text-xl dark:text-white"></h3>
          <a class="" :href="url">Lebih banyak
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2.5" aria-hidden="true" class="inline size-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
          </svg>
          </a>
        </div>
    <!-- title -->
     <template x-for="post in newPosts">
      <article class="group grid max-w-full grid-cols-1 md:grid-cols-8 overflow-hidden border-0 border-neutral-300 bg-neutral-50 text-neutral-600 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
        <!-- image -->
         <template x-if=" true  ">
        <div class="col-span-2 lg:col-span-3 overflow-hidden p-2 aspect-square">
            <img :src="post.img.src" class="h-min w-full object-cover transition duration-700 ease-out group-hover:scale-105" :alt="post.img.alt" />
        </div>
         </template>

        <!-- body -->
        <div class="flex flex-col justify-center p-2 " :class=" post.img.src != '' ? 'col-span-6 lg:col-span-5':'col-span-8' ">
            <h3 class=" text-xl font-medium text-neutral-900 lg:text-2xl dark:text-white" aria-describedby="articleDescription"> <a :href="post.url"  x-text="post.title"></a></h3>
            <p id="articleDescription" class="my-2 text-pretty text-sm" x-html="post.excerpt">
            </p>
            <small class=" font-medium" x-data='{category: post.category.map((item)=> ` <a href="${item.url}">${item.name}</a>`)}' x-html="category"></small>
            <small id="articleDescription" class="mb-2 text-pretty text-sm" x-html="post.time">
            </small>

        </div>
      </article>
     </template>
    

    </section> 



    <section x-data="{secondPosts:[
    <?php
              $secondPosts = new WP_Query(array(
                'posts_per_page' => 5,
                'cat' => get_cat_ID('fikih')
              ));
              while($secondPosts->have_posts()):
                $secondPosts->the_post();
    ?>
      {
       title: `<?php the_title(); ?>`,
       img: {
        src:`<?php if(get_the_post_thumbnail_url()){ the_post_thumbnail_url(); }else{ echo get_theme_file_uri('/no-img.jpg');} ?>`,
        alt:`<?php the_title(); ?>`
        },
       url:`<?php the_permalink(); ?>`,
       time:`<?php the_time('d M Y'); ?>`,
       author:{name:`<?php echo get_the_author(); ?>`, url:`<?php echo get_the_author_meta('user_url'); ?>`},
       category:[<?php 
       foreach(get_the_category() as $category){
        echo "{'name': '$category->name', 'url': '".get_category_link($category->term_id)."'},";
       }
       ?>],
       excerpt:`<?php 
              if(has_excerpt()){
                echo htmlentities(get_the_excerpt());
              }else{
                echo htmlentities(wp_trim_words(get_the_content(), 8), ENT_QUOTES); //18 htmlentities($value)
              }?>`
      },
      
      <?php
      endwhile;
      wp_reset_postdata();
      ?>

 
      
      ]}"
      class="fiqh my-8 grid gap-4">

                   <!-- title -->
                   <div x-data="{
        title:'Fiqih',
        url:'<?php echo get_category_link(get_cat_ID('fikih'));?>',
        }" class="flex justify-between gap-2 overflow-x-auto w-full mx-auto p-1 border-b border-neutral-300 dark:border-neutral-700">
          <h3 x-text="title" class="border-l-4 border-orange-600 dark:border-orange-600/75 pl-3 text-lg font-medium text-neutral-900 lg:text-xl dark:text-white"></h3>
          <a class="" :href="url">Lebih banyak
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2.5" aria-hidden="true" class="inline size-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
          </svg>
          </a>
        </div>
    <!-- title -->
        <div class="grid grid-cols-1 lg:grid-cols-2 lg:grid-rows-4 gap-4 w-full h-full">

          <template x-for="(post, index) in secondPosts">
            <article :class=" index == 0  ? 'grid grid-cols-1 md:grid-cols-8 lg:flex lg:flex-col  gap-2 col-span-2 lg:col-span-1 row-span-full w-full' : 'group grid grid-cols-1 md:grid-cols-8 gap-2 col-span-2 lg:col-span-1' " class="">
         <template x-if=" post.img.src != '' ">  
            <div x-bind:class="index == 0  ? 
               'w-full overflow-hidden col-span-1 md:col-span-2 lg:col-span-1':
               ' w-full col-span-1 md:col-span-2 lg:col-span-3 overflow-hidden' " class="bg-slate-300 aspect-auto">
                <img :src="post.img.src" :alt="post.img.alt" loading="lazy" class="w-full h-full object-cover transition duration-700 ease-out group-hover:scale-105">
              </div>
         </template>
              <div x-bind:class="
              index == 0 ? 'gap-0 col-span-1 md:col-span-6 lg:col-span-1' : 'col-span-1 md:col-span-6 lg:col-span-5'"
              :class="{'col-span-full': !post.img.src, 'col-span-5': post.img.src}"
               class="">
                <h3 :class=" index == 0 ? 'text-lg font-medium md:text-lg lg:text-2xl' : 'text-lg font-medium  lg:text-sm' " class="  text-neutral-900  dark:text-white" aria-describedby="articleDescription">
                    <a :href="post.url"  x-text="post.title"></a>
                </h3>
                <small id="articleDescription" class=" text-pretty text-sm" x-html="post.excerpt">
                </small>
                <small class="block text-xs mt-2" x-text="post.time"></small>
              </div>
            </article>
          </template>
              


        </div>

        
    </section>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 my-8">

      <section x-data="{thirdPosts:[
    <?php
              $secondPosts = new WP_Query(array(
                'posts_per_page' => 5,
                'cat' => get_cat_ID('Kisah Inspiratif Islami')
              ));
              while($secondPosts->have_posts()):
                $secondPosts->the_post();
    ?>
      {
       title: `<?php the_title(); ?>`,
       img: {
        src:`<?php if(get_the_post_thumbnail_url()){ the_post_thumbnail_url(); }else{ echo get_theme_file_uri('/no-img.jpg');} ?>`,
        alt:`<?php the_title(); ?>`
        },
       url:`<?php the_permalink(); ?>`,
       time:`<?php the_time('d M Y'); ?>`,
       author:{name:`<?php echo get_the_author(); ?>`, url:`<?php echo get_the_author_meta('user_url'); ?>`},
       category:[<?php 
       foreach(get_the_category() as $category){
        echo "{'name': '$category->name', 'url': '".get_category_link($category->term_id)."'},";
       }
       ?>],
       excerpt:`<?php 
              if(has_excerpt()){
                echo htmlentities(get_the_excerpt());
              }else{
                echo htmlentities(wp_trim_words(get_the_content(), 8), ENT_QUOTES); //18 htmlentities($value)
              }?>`
      },
      
      <?php
      endwhile;
      wp_reset_postdata();
      ?>

 
      
      ]}" class="flex flex-col gap-4">
                   <!-- title -->
                   <div x-data="{
        title:'Kisah Inspiratif Islami',
        url:'<?php echo get_category_link(get_cat_ID('Kisah Inspiratif Islami'));?>',
        }" class="flex justify-between gap-2 overflow-x-auto w-full mx-auto p-1 border-b border-neutral-300 dark:border-neutral-700">
          <h3 x-text="title" class="border-l-4 border-orange-600 dark:border-orange-600/75 pl-3 text-lg font-medium text-neutral-900 lg:text-xl dark:text-white"></h3>
          <a class="" :href="url">Lebih banyak
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2.5" aria-hidden="true" class="inline size-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
          </svg>
          </a>
        </div>
    <!-- title -->

                  <template x-for="(post, index) in thirdPosts">
                    <article :class=" index == 0  ? 
                    'grid grid-cols-1 md:grid-cols-8 lg:grid-cols-1 gap-2' :
                     'group grid grid-cols-1 md:grid-cols-8 gap-2' 
                     " class="">
                      <div x-bind:class="index == 0  ? 
                       'bg-slate-300  w-full overflow-hidden col-span-1 md:col-span-2 lg:col-span-1 ':
                       'bg-slate-300  w-full col-span-1 md:col-span-2 lg:col-span-3 overflow-hidden' " class="aspect-auto">
                        <img :src="post.img.src" :alt="post.img.alt" loading="lazy" class="w-full h-full object-cover transition duration-700 ease-out group-hover:scale-105">
                      </div>
                      <div x-bind:class="
                      index == 0 ? 'col-span-1 md:col-span-6 lg:col-span-1' : 'col-span-1 md:col-span-6 lg:col-span-5'
                      " class="">
                        <h3 :class=" index == 0 ? 'text-xl font-medium text-neutral-900 md:text-lg lg:text-2xl dark:text-white' : ' text-lg font-medium text-neutral-900 lg:text-sm dark:text-white' " class="  text-neutral-900  dark:text-white" aria-describedby="articleDescription">
                            <a :href="post.url"  x-text="post.title"></a>
                        </h3>
                        <small id="articleDescription" class=" text-pretty text-sm" x-html="post.excerpt">
                        </small>
                        <small id="articleDescription" class="block my-2 text-pretty text-xs" x-html="post.time">
                        </small>
                      </div>
                    </article>

                  </template>

      </section>
      <section x-data="{thirdPosts:[
    <?php
              $secondPosts = new WP_Query(array(
                'posts_per_page' => 5,
                'cat' => get_cat_ID('Keluarga Islami')
              ));
              while($secondPosts->have_posts()):
                $secondPosts->the_post();
    ?>
      {
       title: `<?php the_title(); ?>`,
       img: {
        src:`<?php if(get_the_post_thumbnail_url()){ the_post_thumbnail_url(); }else{ echo get_theme_file_uri('/no-img.jpg');} ?>`,
        alt:`<?php the_title(); ?>`
        },
       url:`<?php the_permalink(); ?>`,
       time:`<?php the_time('d M Y'); ?>`,
       author:{name:`<?php echo get_the_author(); ?>`, url:`<?php echo get_the_author_meta('user_url'); ?>`},
       category:[<?php 
       foreach(get_the_category() as $category){
        echo "{'name': '$category->name', 'url': '".get_category_link($category->term_id)."'},";
       }
       ?>],
       excerpt:`<?php 
              if(has_excerpt()){
                echo htmlentities(get_the_excerpt());
              }else{
                echo htmlentities(wp_trim_words(get_the_content(), 8), ENT_QUOTES); //18 htmlentities($value)
              }?>`
      },
      
      <?php
      endwhile;
      wp_reset_postdata();
      ?>

 
      
      ]}" class="flex flex-col gap-4">
                   <!-- title -->
                   <div x-data="{
        title:'Keluarga Islami',
        url:'<?php echo get_category_link(get_cat_ID('Keluarga Islami'));?>',
        }" class="flex justify-between gap-2 overflow-x-auto w-full mx-auto p-1 border-b border-neutral-300 dark:border-neutral-700">
          <h3 x-text="title" class="border-l-4 border-orange-600 dark:border-orange-600/75 pl-3 text-lg font-medium text-neutral-900 lg:text-xl dark:text-white"></h3>
          <a class="" :href="url">Lebih banyak
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2.5" aria-hidden="true" class="inline size-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
          </svg>
          </a>
        </div>
    <!-- title -->

                  <template x-for="(post, index) in thirdPosts">
                    <article :class=" index == 0  ? 
                    'grid grid-cols-1 md:grid-cols-8 lg:grid-cols-1 gap-2' :
                     'group grid grid-cols-1 md:grid-cols-8 gap-2' 
                     " class="">
                      <div x-bind:class="index == 0  ? 
                       'bg-slate-300  w-full overflow-hidden col-span-1 md:col-span-2 lg:col-span-1 ':
                       'bg-slate-300  w-full col-span-1 md:col-span-2 lg:col-span-3 overflow-hidden' " class="aspect-auto">
                        <img :src="post.img.src" :alt="post.img.alt" loading="lazy" class="w-full h-full object-cover transition duration-700 ease-out group-hover:scale-105">
                      </div>
                      <div x-bind:class="
                      index == 0 ? 'col-span-1 md:col-span-6 lg:col-span-1' : 'col-span-1 md:col-span-6 lg:col-span-5'
                      " class="">
                        <h3 :class=" index == 0 ? 'text-xl font-medium text-neutral-900 md:text-lg lg:text-2xl dark:text-white' : ' text-lg font-medium text-neutral-900 lg:text-sm dark:text-white' " class="  text-neutral-900  dark:text-white" aria-describedby="articleDescription">
                        <a :href="post.url"  x-text="post.title"></a>
                        </h3>
                        <small id="articleDescription" class=" text-pretty text-sm" x-html="post.excerpt">
                        </small>
                        <small id="articleDescription" class="block my-2 text-pretty text-xs" x-html="post.time">
                        </small>
                        
                      </div>
                    </article>

                  </template>

      </section>


    </div>


  </div>

<?php
get_sidebar();
?>


</section>


<br>



<?php
get_footer();
?>