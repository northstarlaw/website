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


			<?php endwhile; // End of the loop.
			?>

		</main><!-- #main -->

<?php
get_footer();
