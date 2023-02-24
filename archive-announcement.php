<?php
get_header();
?>
<main id="announcement">
    <section class="container">
        <div class="wrapper text-center">
            <h1>Product updates</h1>
            <p class="sub">Get all the details about the latest feature releases, product improvements, and bug fixes of
                Sterling Administration.</p>
        </div>
    </section>

    <section class="container announcements">
        <sidebar class="left">
            <div class="card mt-2 p-1 bg-primary">
                <a href="javascript:void(0);" id="feedback_form_toggle">
                    <p>Have an idea or feature request?</p>
                    <h6><i class="chat"></i>Leave feedback</h6>
                </a>
            </div>
            <div class="card mt-2 p-1">
                <div class="d-flex">
                    <h5>Categories</h5>
                </div>
                <div class="cat">
                    <?php         
        $terms = get_terms('announcement-cat');
        $count = count($terms);
        if ( $count > 0 ){
            foreach ( $terms as $term ) {
                $termlinks= get_term_link($term,'announcement-cat');
                ?> <a href="<?php echo $termlinks; ?>">
                        <?php echo "<span class='cat_name'>" . $term->name . "</span>"; ?>
                    </a>
                    <?php
            }
        }
?>
                </div>
            </div>
        </sidebar>

        <div class="content">
            <?php 

// wp-query to get all published posts without pagination
$allPostsWPQuery = new WP_Query(array('post_type'=>'announcement', 'post_status'=>'publish', 'posts_per_page'=>10)); ?>
            <?php if ( $allPostsWPQuery->have_posts() ) { ?>
            <?php while ( $allPostsWPQuery->have_posts() ) { $allPostsWPQuery->the_post(); ?>
            <p class="date text-center" id="<?php echo get_the_date('Y-m'); ?>">
                <?php echo get_the_date('M Y'); ?>
            </p>
            <article class="card">
                <?php if (has_post_thumbnail( $allPostsWPQuery->ID ) ){ ?>
                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $allPostsWPQuery->ID ), 'single-post-thumbnail' ); ?>
                <a class="post" href="<?php the_permalink(); ?>">
                    <img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
                </a>
                <?php } ?>
                <div class="cat">
                    <ul class="post-categories">
                        <?php 
                        foreach (get_the_terms( $allPostsWPQuery->ID,'announcement-cat' ) as $cat) {
                            echo '<li class="cat-'.count(get_the_category()).'"><a href="#">';
                            echo $cat->name;
                            echo "</a></li>";
                        }
                        ?>
                    </ul>
                </div>
                <div class="px-2">
                    <h2><a class="post" href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a></h2>
                    <p title="read more"><a class="post" href="<?php the_permalink(); ?>">
                            <?php echo get_the_excerpt(); ?>
                        </a></p>
                    <small class="release_date">
                        <?php echo get_the_date(); ?>
                    </small>
                </div>
            </article>
            <?php } ?>
            <?php wp_reset_postdata(); ?>
            <?php } else { ?>
            <div class="card mt-2 p-1">
                <?php _e( "There's no update to display." ); ?>
            </div>
            <?php } ?>
        </div>

        <sidebar class="right">
            <p class="text-bold">Jump to month</p>
            <ul class="month">
                <?php global $wpdb, $table_prefix; 
                $date = $wpdb->get_col("SELECT DISTINCT DATE_FORMAT(post_date, '%M %Y') FROM $wpdb->posts WHERE post_type='announcement' ORDER BY post_date DESC");
                foreach ($date as $date) { 
                    echo "<li><a href='#".date('Y-m',strtotime($date))."'>".$date."</a></li>";   
                }
                ?>
            </ul>
        </sidebar>
    </section>
</main>
<div class="feedback_form" id="feedback_form" style="display: none;">
    <form method="post" id="feedback" class="card">
        <label for="user_name">Name</label>
        <input type="text" name="user_name" id="user_name" class="input-box">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="input-box">
        <label for="feedback_area">Feedback</label>
        <textarea name="feedback" id="feedback_area" cols="10" rows="2" class="input-box textarea"></textarea>
        <button type="button" class="button" id="submit">Submit</button>
    </form>
</div>
<script>
    $ = jQuery.noConflict();
    $('#feedback_form_toggle').click(()=>{$('#feedback_form').slideToggle('slow')});
    $('#submit').click(()=>{$('#feedback_form').slideToggle('slow')});
</script>
<?php
get_footer( );