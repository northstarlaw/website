<?php
/**
 * The template for displaying team page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package north-star
 */

get_header(); ?>

    <div class="container">
		<main>
			<?php
			while ( have_posts() ) : the_post(); ?>

			  <h1>Meet the Team</h1>

        <?php the_content(); ?>

        <div class="team-list">
          <div class="grid">
            <?php
              $args = array( 'post_type' => 'people', 'posts_per_page' => 10 );
              $loop = new WP_Query( $args );
              while ( $loop->have_posts() ) : $loop->the_post();
                $imageUrl = get_the_post_thumbnail_url();
                $position = get_field('position');
            ?>
              <div class="col-6 col-lg-4 col-md-6">
                <a href="<?php the_permalink(); ?>" class="team-list__item" itemprop="employee" itemscope itemtype="http://schema.org/Person">
                  <img class="team-list__image" src="<?= $imageUrl  ?>" alt="" itemprop="image">
                  <div class="team-list__content">
                    <div class="team-list__title" itemprop="name"><?php the_title(); ?></div>
                    <small class="team-list__subtitles">
                      <span class="team-list__position" itemprop="jobTitle"><?= $position ?></span>
                      <?php if (have_rows('contact')) :?>
                        <?php while ( have_rows('contact') ) : the_row(); ?>
                          <?php if(get_sub_field('method') == 'email'): ?>
                            <span itemprop="email" class="team-list__email"><?php the_sub_field('value') ?></span>
                          <?php endif; ?>
                        <?php endwhile; ?>
                      <?php endif; ?>
                    </small>
                  </div>
                </a>
              </div>
            <?php endwhile; ?>
          </div>
        </div>

        <div class="dn-ns">
          <div class="section">
            <?php get_template_part('partials/star', 'separator') ?>
          </div>
        </div>

			<?php endwhile; /* End of the loop. */
			?>

		</main>
		</div>

<?php
get_footer();
