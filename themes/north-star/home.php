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
		  <a href="#about" class="hero__link" data-scrollTo>
        Read more
        <span class="icon-chevron"></span>
      </a>
		</div>

		<main>

			<?php
			while ( have_posts() ) : the_post(); ?>

			<div class="loading-screen">
				<div class="logo text-center">
				  <svg xmlns="http://www.w3.org/2000/svg"
               viewBox="0 0 136 130.83"
               width="55px"
               height="55px"
               class="star-logo"
               itemprop="logo"
          >
              <g id="Layer_1-2" data-name="Layer 1">
                  <polygon points="65.67 0 68.17 1.17 95.17 47 109.67 49.5 112.17 51.83 83.17 51.83 65.67 0"/>
                  <polygon
                          points="136 45.17 90.67 77.17 98.83 104.33 100.17 101.83 98.5 86.83 135.17 48.17 136 45.17"/>
                  <polygon
                          points="68.5 93.67 45 110 47.67 110.5 62.33 103.33 110.33 126.33 113.33 126.33 68.5 93.67"/>
                  <polygon points="24 62 47.17 79.5 28.83 131 27.33 128.83 35.58 75.67 25 65 24 62"/>
                  <polygon
                          points="55.33 50.83 0 51.17 1.83 49.17 55.33 38.67 61.83 25.92 64.5 24.17 55.33 50.83"/>
              </g>
          </svg>
          <div>North Star Law</div>
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
