<div class="block static lg:sticky <?php echo is_user_logged_in() ? 'top-28' : 'top-20'; ?> h-full  w-full lg:w-3/12">
    <div class="popular flex flex-col gap-2"
    x-data="{popularPosts:[
        <?php
        $popularPosts  = new WP_Query(array(
            'posts_per_page' => 5,
            'meta_key' => 'post_views_count',
            'orderby' => 'meta_value_num',
            'order' => 'DESC'
        ));
        while($popularPosts->have_posts()):
            $popularPosts->the_post();
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
                echo htmlentities(wp_trim_words(get_the_content(), 5), ENT_QUOTES); //18 htmlentities($value)
              }?>`
        },
        
        <?php
        endwhile;
        wp_reset_postdata();
        ?>
        
 
      
      ]}">
          <!-- title -->
          <div class="flex gap-2 overflow-x-auto w-full mx-auto p-1 border-b border-neutral-300 dark:border-neutral-700">
            <h3 class="border-l-4 border-orange-600 dark:border-orange-600/75 pl-3 text-lg font-medium text-neutral-900 lg:text-xl dark:text-white">Populer</h3>
          </div>
    <!-- title -->

    <template x-for="(post, index) in popularPosts">
      <article class="group grid grid-cols-1 md:grid-cols-8 gap-2">
        <div class="bg-slate-300  w-full col-span-1 md:col-span-2 lg:col-span-3 overflow-hidden aspect-square">
          <img :src="post.img.src" :alt="post.img.alt" loading="lazy" class="w-full h-full">
        </div>
        <div class="col-span-1 md:col-span-6 lg:col-span-5">
          <h3 class=" text-lg font-medium text-neutral-900 lg:text-xs dark:text-white" aria-describedby="articleDescription">
          <a :href="post.url"  x-text="post.title"></a>
          </h3>
          <!-- <p class="text-xs font-medium " x-text="post.author.name">penulis</p> -->
          <small class="block font-medium text-xs my-2" x-data='{category: post.category.map((item)=> ` <a href="${item.url}">${item.name}</a>`)}' x-html="category"></small>
          <small id="articleDescription" class=" block lg:hidden text-pretty text-sm" x-html="post.excerpt">
          </small>  
          <small id="articleDescription" class="block my-2 text-pretty text-xs" x-html="post.time">
            </small>
        </div>
      </article>
    </template>



    </div>

    <div x-data="{
      catExpanded:false,
      }" class="categories  my-4 text-center">
                <!-- title -->
          <div class="flex gap-2 overflow-x-auto w-full mx-auto mb-2 p-1 border-b border-neutral-300 dark:border-neutral-700">
            <h3 class="border-l-4 border-orange-600 dark:border-orange-600/75 pl-3 text-lg font-medium text-neutral-900 lg:text-xl dark:text-white">Kategori</h3>
          </div>
    <!-- title -->
     <div x-data="{
      categories:[
        <?php
        $categories = get_categories(['orderby' => 'category_count']);
        foreach($categories as $category) {
           echo "{title:'$category->name ($category->category_count)',url:'".get_category_link($category->term_id)."',},";
        }    
        ?>

      ],

     }" class="flex flex-row flex-wrap justify-center gap-2 overflow-hidden" :class="{'h-52': !catExpanded, '':catExpanded}">
     <template x-for="item in categories">
      <a :href="item.url" x-text="item.title" class="px-2 py-1 max-h-min font-normal text-xs  rounded-full bg-neutral-200 hover:bg-neutral-100 dark:bg-neutral-700 dark:hover:bg-neutral-600"></a>
     </template>

     </div>
     <div class="border-t border-slate-200/80 dark:border-neutral-700/50  ">
     <button x-on:click="catExpanded = !catExpanded" x-text=" catExpanded != true ? 'Selengkapnya': 'Tutup' " class="mt-2 mx-auto px-2 py-1 max-h-min text-sm font-medium  rounded-full bg-neutral-200 hover:bg-neutral-100 dark:bg-neutral-700 dark:hover:bg-neutral-600"></button>
     </div>

    </div>

    
    

  </div>