<?php
/**
 * Template Name: Blank Template
 *
 * @package North Star
 */

get_header(); ?>

    <div class="container">

      <main>

        <?php
        while ( have_posts() ) : the_post();

          the_content();

        endwhile; /* End of the loop. */
        ?>

      </main>

    </div>

<?php
get_footer();
