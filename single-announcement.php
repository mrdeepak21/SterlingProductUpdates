<?php
get_header();
wp_enqueue_style( 'dashicons' );

?>
<main id="announcement">
    <section class="container announcements">
        <aside class="left">
            <a class="d-flex" style="align-items: center;margin-left: -40px;" href="<?php echo home_url(); ?>/announcements/"><span class="dashicons dashicons-arrow-left-alt"></span>&nbsp;&nbsp; Back to all updates</a>
            <p class="release_date">
                <b>Date:</b> <br>
                <?php the_time(get_option('date_format')); ?>
                    </p>
        </aside>
<style>
    #announcement .content, #announcement .post img{
        width: 55vw;
    }
</style>
        <div class="content">
            <article class="card">
                <?php if (has_post_thumbnail() ){ ?>
                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumbnail' ); ?>
                    <img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
              
                <?php } ?>
                <div class="cat">
                    <ul class="post-categories">
                        <?php 
                        global $post;
                        foreach (get_the_terms( $post->ID,'announcement-cat' ) as $cat) {
                            echo '<li class="cat-'.count(get_the_category()).'"><a href="#">';
                            echo $cat->name;
                            echo "</a></li>";
                        }
                        ?>
                    </ul>
                </div>
                <div class="px-2">
                    <h2 class="post">
                            <?php the_title(); ?>
                       </h2>
                    <p><?php echo get_the_content(); ?></p>                    
                </div>
            </article>
        </div>
        <aside class="right">
            <p class="text-bold">Jump to month</p>
            <ul class="month">
                <?php global $wpdb, $table_prefix; 
                $date = $wpdb->get_col("SELECT DISTINCT DATE_FORMAT(post_date, '%M %Y') FROM $wpdb->posts WHERE post_type='announcement' AND post_status='publish' ORDER BY post_date DESC");
                foreach ($date as $date) { 
                    echo "<li><a href='".home_url()."/announcements/#".date('Y-m',strtotime($date))."'>".$date."</a></li>";   
                }
                ?>
            </ul>
        </aside>
</main>
<?php
get_footer( );