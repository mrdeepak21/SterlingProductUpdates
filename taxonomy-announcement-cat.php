<?php
get_header();
wp_enqueue_style( 'dashicons' );
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
?>
<main id="announcement">
    <section class="container">
        <div class="empty-space">

        </div>
        <div class="wrapper text-center">
            <h1>Category -
                <?php echo apply_filters( 'the_title', $term->name ); ?>
            </h1>

        </div>
    </section>

    <section class="container announcements">
        <aside class="left">
            <div class="card mt-2 p-1 bg-primary">
                <a href="javascript:void(0);" id="feedback_form_toggle">
                    <p>Have an idea or feature request?</p>
                    <h6><span class="dashicons dashicons-format-chat"></span> Leave feedback</h6>
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
        </aside>

        <div class="content">
            <?php if ( have_posts() ): while ( have_posts() ): the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class('card mt-2'); ?>>
                <?php if (has_post_thumbnail() ){ ?>
                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumbnail' ); ?>
                    <a class="post" href="<?php the_permalink(); ?>">
                        <img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
                    </a>
                    <?php } ?>
                <h2 class="post-title px-2"><a href="<?php the_permalink(); ?>" rel="bookmark">
                        <?php the_title(); ?>
                    </a></h2>
                <div class="px-2">
                    <div class="post">
                        <?php echo the_excerpt(); ?>
                    </div>
                    <small class="release_date">
                        <?php the_time(get_option('date_format')); ?>
                    </small>
                </div>
            </article>
            <?php endwhile; else: ?>
<div class="card px-2">
            <h2 class="post-title">No Update in
                <?php echo apply_filters( 'the_title', $term->name ); ?>
            </h2>
            <div class="">
                <div class="">
                    <p>It seems there isn't anything happening in <strong>
                            <?php echo apply_filters( 'the_title', $term->name ); ?>
                        </strong> right now. Check back later, something is bound to happen soon.</p>
                </div>
            </div>
</div>
            <?php endif; ?>

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
    </section>
    <div class="feedback_form" id="feedback_form" style="display: none;">
        <form method="post" id="feedback" class="card">
            <h2 class="text-center">Share your thoughts
            </h2>
            <h4 class="text-center font-small">
                What kind of feedback do you have?
            </h4>
            <span class="close" id="close">x</span>
            <label for="feedback_area">Short summary of your feedback: *</label>
            <textarea name="feedback" id="feedback_area" cols="10" rows="5" class="input-box textarea"></textarea>
            <label for="">How important is this to you? *</label>
            <div class="d-flex imp">
                <label for="" class="radio-btn">
                    <span class="dashicons dashicons-arrow-up-alt2"></span>
                    Nice to have
                    <input type="radio" id="nice" name="imp">
                </label>
                <label for="" class="radio-btn">
                    <span class="dashicons dashicons-arrow-up-alt2"></span>
                    <span class="dashicons dashicons-arrow-up-alt2"></span>
                    Somewhat
                    <input type="radio" id="Somewhat" name="imp">
                </label>
                <label for="" class="radio-btn">
                    <span class="dashicons dashicons-arrow-up-alt2"></span>
                    <span class="dashicons dashicons-arrow-up-alt2"></span>
                    <span class="dashicons dashicons-arrow-up-alt2"></span>
                    Extremely

                    <input type="radio" id="Extremely" name="imp">
                </label>
            </div>

            <label for="email">What's your email address? *</label>
            <input type="email" name="email" id="email" class="input-box">
            <small class="text-small">
                Verify your email to send the team your feedback
            </small>

            <button type="button" class="button mt-1" id="submit">Submit</button>
            <small>By clicking submit, you accept the our <a href="/privacy/" target="_blank">privacy policy</a> and
                terms & conditions</small>
        </form>
    </div>
</main>
<script>
    $ = jQuery.noConflict();
    $('#feedback_form_toggle').click(() => { $('#feedback_form').slideToggle('slow') });
    $('#close, #submit').click(() => { $('#feedback_form').slideToggle('slow') });
    $(':radio').on('change', function () {
        console.log(this.id);
    });

    $.each($('.radio-btn'), function (key, value) {
        $(this).click(function (e) {
            $('.radio-btn-selected')
                .removeClass('radio-btn-selected')
                .addClass('radio-btn');

            $(this)
                .removeClass('radio-btn')
                .addClass('radio-btn-selected');

        });
    });
</script>
<?php
get_footer( );