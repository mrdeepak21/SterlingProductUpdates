<?php
get_header();
?>
<main id="announcement">
    <section class="container">
        <div class="wrapper text-center">
            <h1>Product updates</h1>
            <p class="sub">Get all the details about the latest feature releases, product improvements, and bug fixes of CoScreen. Work together, better than ever.</p>
        </div>
        <div class="navigation">
            <div class="form-container">
            
            </div>
            <ul>
                <li><a href="#">Announcements</a></li>
                <li><a href="#">Roadmap</a></li>
            </ul>
        </div>
    </section>

    <section class="container announcements">
        <sidebar class="left">
            <div class="card mt-2 p-1">
                <a href="javascript:void(0);">
                <p>Have an idea or feature request?</p>
                <h6><i class="chat"></i>Leave feedback</h6>
            </a>
            </div>
            <div class="card mt-2 p-1">
                <div class="d-flex">
                    <h5>Categories</h5>
                    <small>clear</small>
                </div>
            </div>
        </sidebar>
        <div class="content">
            <?php 

// wp-query to get all published posts without pagination
$allPostsWPQuery = new WP_Query(array('post_type'=>'announcement', 'post_status'=>'publish', 'posts_per_page'=>10)); ?>
<?php if ( $allPostsWPQuery->have_posts() ) { ?>
     <?php while ( $allPostsWPQuery->have_posts() ) { $allPostsWPQuery->the_post(); ?>            
                <p class="text-center"><?php echo get_the_date('M Y'); ?></p>                
                <article class="card" >
                <?php if (has_post_thumbnail( $allPostsWPQuery->ID ) ){ ?>
  <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $allPostsWPQuery->ID ), 'single-post-thumbnail' ); ?>
  <a class="post" href="<?php the_permalink(); ?>">
                    <img src="<?php echo $image[0]; ?>"  alt="<?php the_title(); ?>">
                    </a>
                    <?php } ?>
                    <div class="cat"><ul class="post-categories">
                        <li><a href="#">General</a></li>
                    </ul></div>
                    <div class="px-2">
                    <h2><a class="post" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p title="read more"><a class="post" href="<?php the_permalink(); ?>"><?php echo get_the_excerpt(); ?> </a></p>
                    <small class="release_date"><?php echo get_the_date(); ?></small>
                    </div>
                </article>
            <?php } ?>
            <?php wp_reset_postdata(); ?>
 <?php } else { ?>
    <div class="card mt-2 p-1"><?php _e( "There's no update to display." ); ?></div>
<?php } ?>
        </div>
        <sidebar class="right">
            <p class="text-bold">Jump to month</p>
            <ul class="month">
                <?php global $wpdb, $table_prefix; ?>
                <li><a href="#01-23">January 2023</a></li>
                <li><a href="#02-23">Febuary 2023</a></li>
                <li> <a href="#03-23">March 2023</a></li>
                <li><a href="#">April 2023</a></li>
                <li><a href="#">May 2023</a></li>
                <li><a href="#">Jun 2023</a></li>
                <li><a href="#">July 2023</a></li>
                <li><a href="#">August 2023</a></li>
                <li><a href="#">September 2023 </a></li>
                <li><a href="#">October 2023</a></li>
                <li><a href="#">November 2023</a></li>
                <li><a href="#">December 2023</a></li>
            </ul>
        </sidebar>
    </section>
</main>
<?php
get_footer( );