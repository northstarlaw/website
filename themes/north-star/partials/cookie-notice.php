<<<<<<< HEAD
<div class="cookie-notice">
=======
>>>>>>> e4ad3085f526e42de2df4c67e2b6db7114fa33b2
    <?php
        $args = array( 'post_type' => 'cookie', 'posts_per_page' => 1 );
        $the_query = new WP_Query( $args );
    ?>
    <?php if ( $the_query->have_posts() ) : ?>
<<<<<<< HEAD
=======
        <div class="cookie-notice">
>>>>>>> e4ad3085f526e42de2df4c67e2b6db7114fa33b2
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
<<<<<<< HEAD
    <?php else:  ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <?php endif; ?>
</div>
=======
        </div>
    <?php else:  ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <?php endif; ?>
>>>>>>> e4ad3085f526e42de2df4c67e2b6db7114fa33b2
