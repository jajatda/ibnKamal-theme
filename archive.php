<?php
get_header();
?>

<section class=" bg-neutral-50 text-neutral-600 dark:bg-neutral-900 dark:text-neutral-300 p-5">
<div class="flex flex-row flex-wrap gap-5 justify-around w-full lg:w-5/6 mx-auto">
  <div class="w-full lg:w-8/12">

    <section x-data="{newPosts:[
      
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
                echo htmlentities(wp_trim_words(get_the_content(), 70),ENT_QUOTES); //18 htmlentities($value)
              }?>`.replace(/(?:\r\n|\r|\n)/g, '</br>')
      },

<?php endwhile;
wp_reset_postdata(); ?>
<?php endif; ?>
 
      
      ]}" class="news">
              <!-- title -->
        <div x-data="{
        title:'<?php echo get_the_archive_title() ?>',
        url:'<?php echo site_url('/blog');?>',
        }" class="flex justify-between gap-2 overflow-x-auto w-full mx-auto p-1 border-b border-neutral-300 dark:border-neutral-700">
          <h3 x-html="title" class="border-l-4 border-orange-600 dark:border-orange-600/75 pl-3 text-lg font-medium text-neutral-900 lg:text-xl dark:text-white"></h3>
          <!-- <a class="" :href="url">Lebih banyak
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2.5" aria-hidden="true" class="inline size-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
          </svg>
          </a> -->
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
     <?php
      
      echo paginate_links();
      ?>
    

    </section> 




  </div>

  <?php
get_sidebar();
?>


</section>


<br>




<?php
get_footer();
?>