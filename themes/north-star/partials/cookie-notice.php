<div class="cookie-notice">
    <?php
        $args = array( 'post_type' => 'cookie', 'posts_per_page' => 1 );
        $the_query = new WP_Query( $args );
    ?>
    <?php if ( $the_query->have_posts() ) : ?>
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="container">
                <?php the_content(); ?>

                <button class="cookie-notice-close js-cookie-close" type="button">
                    <span class="sr-only">Close Cookie</span>
                    X
                </button>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endwhile; ?>
    <?php else:  ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <?php endif; ?>
</div>