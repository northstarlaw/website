<?php
/**
 * Template Name: Home Template
 *
 * @package North Star
 */

get_header(); ?>

		<div class="hero flex flex--center-align bg-dim" style="background-image: url(<?php the_post_thumbnail_url()?>)">
		  <p class="hero__text text-center container">
		   <?php bloginfo('description'); ?>
		 </p>
		</div>
		<div class="hero__section text-center">
		  <a href="#about" class="hero__link" data-scrollTo>Read more...</a>
		</div>

		<main>

			<?php
			while ( have_posts() ) : the_post(); ?>

			<div class="loading-screen">
				<div class="logo text-center">
					<img src="<?= get_template_directory_uri(); ?>/assets/white-logo.png" alt="Loading...">
				</div>
				<div class="loading-screen__background"></div>
			</div>

			<div class="container">
				<div class="text-center text-lead home-lead" id="about">
				  <?php the_content();?>
				</div>
				<?php get_template_part('partials/star', 'separator') ?>
			</div>

			<div class="what-we-do text-center flex flex--center-align flex-column bg-dim"
           style="background-image: url(<?php the_field('what_we_do_image'); ?>); background-position-y: -100px"
      >

        <div class="what-we-do__wrap">
          <div class="what-we-do__title">
            <?php the_field('what_we_do_title'); ?>
          </div>

          <p class="what-we-do__text container">
            <?php the_field('what_we_do_strapline'); ?>
          </p>

          <a href="<?php the_field('what_we_do_link')['url']; ?>" class="button">
            Learn more
          </a>
        </div>
      </div>

      <div class="container">
       <?php get_template_part('partials/star', 'separator') ?>
      </div>



			<?php endwhile; // End of the loop.
			?>

		</main><!-- #main -->

<?php
get_footer();
