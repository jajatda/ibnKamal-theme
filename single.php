<?php
get_header();
?>

<section class=" bg-neutral-50 text-neutral-600 dark:bg-neutral-900 dark:text-neutral-300 p-5">
<div class="flex flex-row flex-wrap gap-5 justify-around w-full lg:w-5/6 mx-auto">
  <div class="w-full lg:w-8/12">

    <section x-data="{post:

           <?php 

      if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      {
       title: `<?php the_title(); ?>`,
       img: {
        src:`<?php if(get_the_post_thumbnail_url()){ the_post_thumbnail_url(); }else{ echo get_theme_file_uri('/no-img.jpg');} ?>`,
        alt:`<?php the_title(); ?>`
        },
       url:`<?php the_permalink(); ?>`,
       time:`<?php the_time('d M Y'); ?>`,
       author:{name:`<?php echo get_post_meta(get_the_ID(), 'post_views_count', true);//get_the_author(); ?>`, url:`<?php echo get_the_author_meta('user_url'); ?>`},
        category:[<?php 
       foreach(get_the_category() as $category){
        echo "{name: `".htmlentities($category->name)."`, url: `".get_category_link($category->term_id)."`},";
       }
       ?>],
        tags:[<?php 
        if(get_the_tags()){
            foreach(get_the_tags() as $tag){
                echo "{name: `".htmlentities($tag->name)."`, url: `".htmlentities(get_tag_link($tag->term_id))."`},";
               }
        }

       ?>],
       content:`<?php 
                echo htmlentities(get_the_content(),ENT_QUOTES); //18 htmlentities($value) .replace(/(?:\r\n|\r|\n)/g, '</br>'),
              ?>` 
      }

<?php endwhile;
wp_reset_postdata(); ?>
<?php endif; ?>
      }" class="news">

      <!-- <nav class="text-sm font-medium text-neutral-600 dark:text-neutral-300 mb-2" aria-label="breadcrumb">
        <ol class="flex flex-wrap items-center gap-1">
          <li class="flex items-center gap-1.5">
            <a href="#" aira-label="home" class="hover:text-neutral-900 dark:hover:text-white">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true" class="size-4">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.293 2.293a1 1 0 0 1 1.414 0l7 7A1 1 0 0 1 17 11h-1v6a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6H3a1 1 0 0 1-.707-1.707l7-7Z" />
              </svg>	
            </a>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true" stroke-width="2" stroke="currentColor" class="size-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
          </li>
          <li class="flex items-center gap-1">
            <a href="#" class="hover:text-neutral-900 dark:hover:text-white">Blog</a>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true" stroke-width="2" stroke="currentColor" class="size-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
          </li>
          <li class="flex items-center gap-1 font-bold text-neutral-900 dark:text-white" aria-current="page">Breadcrumb</li>
        </ol>
      </nav> -->
     
      <article class="flex flex-col max-w-full grid-cols-1 md:grid-cols-8 overflow-hidden border-0 border-neutral-300 bg-neutral-50 text-neutral-600 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
       <!-- header -->
        <div class="border-b border-neutral-300 dark:border-neutral-700 mb-2">
          <h3 class="text-pretty text-4xl font-bold text-neutral-900 lg:text-2xl dark:text-white " aria-describedby="articleDescription" x-text="post.title"></h3>
          <div class="text-sm flex flex-row justify-center md:justify-between items-center flex-wrap mt-2 border-t border-neutral-300 dark:border-neutral-700">
            <div class="flex flex-row flex-wrap justify-center md:justify-normal gap-x-2">
              <p>Oleh: <span class="font-medium" x-text="post.author.name"></span></p>
              
              <p>Pada: <span class="font-medium" x-text="post.time"></span></p>
              <!-- <p>Kategori: <span class="font-medium" x-data='{category: post.category.map((item)=> ` <a href="${item.url}">${item.name}</a>`)}' x-html="category"></span> </p> -->
            </div>
            <ul class="flex flex-row items-center  gap-2 h-10 text-neutral-600 dark:text-neutral-300 mx-2 md:ml-auto">
                    <li>
                        <p>
                            Bagikan:
                      </p>
                    </li>
                    <li>
                        <a :href="'https://api.whatsapp.com/send?phone=&amp;text='+ post.url" target="popup" x-on:click="window.open('https://api.whatsapp.com/send?phone=&amp;text='+ post.url+'?utm_source=WhatsApp&amp;utm_medium=Share_Widget','popup','width=600,height=600'); return false;">
                          <span class="[&>svg]:h-5 [&>svg]:w-5">
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              fill="currentColor"
                              viewBox="0 0 448 512">
                              <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc. -->
                              <path
                                d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                            </svg>
                          </span>
                        </a>
                    </li>
  
                    <li>
                        <a :href="'https://web.facebook.com/sharer.php?u='+ post.url +'?utm_source=Facebook&amp;utm_medium=Share_Widget'" target="popup" x-on:click="window.open('https://web.facebook.com/sharer.php?u='+ post.url +'?utm_source=Facebook&amp;utm_medium=Share_Widget','popup','width=600,height=600'); return false;">
                          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                              d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                              clip-rule="evenodd"></path>
                          </svg>
                        </a>
                    </li>
  
                    <li>
                        <a :href="'https://twitter.com/intent/tweet?url='+ post.url +'?utm_source=Twitter&amp;utm_medium=Share_Widget'" target="popup" x-on:click="window.open('https://twitter.com/intent/tweet?url='+ post.url +'?utm_source=Twitter&amp;utm_medium=Share_Widget','popup','width=600,height=600'); return false;">
                          <span class="[&>svg]:h-5 [&>svg]:w-5">
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              fill="currentColor"
                              viewBox="0 0 512 512">
                              <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc. -->
                              <path
                                d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
                            </svg>
                          </span>
                        </a>
                    </li>
  
                    <li>
                        <a :href="'https://telegram.me/share/url?url='+ post.url +'?utm_source=Telegram&amp;utm_medium=Share_Widget' " target="popup" x-on:click="window.open('https://telegram.me/share/url?url='+ post.url +'?utm_source=Telegram&amp;utm_medium=Share_Widget','popup','width=600,height=600'); return false;">
                          <span class="[&>svg]:h-5 [&>svg]:w-5">
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              fill="currentColor"
                              viewBox="0 0 496 512">
                              <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc. -->
                              <path
                                d="M248 8C111 8 0 119 0 256S111 504 248 504 496 393 496 256 385 8 248 8zM363 176.7c-3.7 39.2-19.9 134.4-28.1 178.3-3.5 18.6-10.3 24.8-16.9 25.4-14.4 1.3-25.3-9.5-39.3-18.7-21.8-14.3-34.2-23.2-55.3-37.2-24.5-16.1-8.6-25 5.3-39.5 3.7-3.8 67.1-61.5 68.3-66.7 .2-.7 .3-3.1-1.2-4.4s-3.6-.8-5.1-.5q-3.3 .7-104.6 69.1-14.8 10.2-26.9 9.9c-8.9-.2-25.9-5-38.6-9.1-15.5-5-27.9-7.7-26.8-16.3q.8-6.7 18.5-13.7 108.4-47.2 144.6-62.3c68.9-28.6 83.2-33.6 92.5-33.8 2.1 0 6.6 .5 9.6 2.9a10.5 10.5 0 0 1 3.5 6.7A43.8 43.8 0 0 1 363 176.7z" />
                            </svg>
                          </span>
                          
                        </a>
                    </li>
  
            </ul>
          </div>
        </div>       

        <!-- image -->
        <div class="col-span-3 overflow-hidden aspect-auto">
            <img :src="post.img.src" class="h-full w-full object-cover transition duration-700 ease-out group-hover:scale-105" :alt="post.img.alt" />
        </div>
        <!-- body -->
        <div class="block col-span-5">
            <div class="main-content text-pretty font-normal text-lg whitespace-normal" x-html="post.content">
            </div>
        </div>
        <!-- footer -->
        <div class="w-full mt-10">
        <!-- tags -->
          <div class="flex flex-row flex-wrap justify-start gap-2 border-b border-t border-neutral-300 dark:border-neutral-700 py-2 text-wrap whitespace-normal">
           <span class="font-bold">Tags: </span>
           <template x-for="item in post.tags">
            <a :href="item.url" x-text="item.name" class="px-2 py-1 max-h-min font-normal text-sm text-wrap rounded-full bg-neutral-200 hover:bg-neutral-100 dark:bg-neutral-700 dark:hover:bg-neutral-600"></a>
           </template>
           </div>

           <!-- Comments -->
           <div class="">
            
           </div>

        </div>
        

      </article>

    

    </section> 




  </div>

<?php
get_sidebar();
?>


</section>


<?php
get_footer();
?>