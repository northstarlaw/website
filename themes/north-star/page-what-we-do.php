<?php
/**
 * The template for displaying contact page
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

    <div class="banner" style="background-image: url()"></div>

    <div class="container">
		<main>

			<?php
			while ( have_posts() ) : the_post(); ?>

			  <div class="grid df-ns">
          <div class="col-10 h2">
            Our Departments
          </div>
          <div class="col-2">
            <span class="d-none d-sm-block h2">Key Contact</span>
          </div>
        </div>
        <div class="tabs grid">
          <div class="col-3 db-ns">
            <aside>
              <h1 class="sr-only">Our Departments</h1>
              <div class="tabs__links list--unstyled" role="tablist">
                <?php
                    $args = array( 'post_type' => 'departments', 'posts_per_page' => 10, 'order' => 'ASC' );
                    $loop = new WP_Query( $args );

                    while ( $loop->have_posts() ) : $loop->the_post();
                      $imageUrl = get_the_post_thumbnail_url();
                      $position = get_field('position');
                  ?>
                  <a class="tabs__link"
                     aria-controls="<?= sanitize_title(get_the_title()); ?>"
                     href="#<?= sanitize_title(get_the_title()); ?>"
                     data-img="<?= $imageUrl ?>"
                     data-text="<?php the_title(); ?>"
                     title="Active tab"
                     id="<?= sanitize_title(get_the_title()); ?>-tab"
                     role="tab"
                     itemprop="department"
                  >
                    <?php the_title(); ?>
                  </a>
                <?php endwhile; ?>
              </div>
            </aside>
          </div>
          <section class="col col-md-9">
            <?php
              while ( $loop->have_posts() ) : $loop->the_post();
                $imageUrl = get_the_post_thumbnail_url();
                $position = get_field('position');
            ?>
            <h2 class="sr-only-m tabs__mobile-head">
              <a href="#<?= sanitize_title(get_the_title()); ?>" class="tabs__link" data-primary-trigger="<?= sanitize_title(get_the_title()); ?>-tab">
                <?php the_title(); ?>
                <span class="icon-plus"></span>
                <span class="icon-minus"></span>
              </a>
            </h2>
            <div id="<?= sanitize_title(get_the_title()); ?>" class="tabs__item grid" role="tabpanel" aria-labelledby="<?= sanitize_title(get_the_title()); ?>-tab">
              <div class="col col-md-9 tabs__item-content">
                <?php the_content(); ?>
              </div>
              <div class="col col-md-3">
                <?php if (have_rows('key_contacts')) :?>
                  <h3 class="sr-only">Key Contacts</h3>
                  <?php while ( have_rows('key_contacts') ) : the_row();
                    $id = get_sub_field('person')->ID;
                  ?>
                    <div class="tabs__contact text-center text-left-md">
                    <?php if (get_field('thumbnail', $id)): ?>
                      <a href="{{site.baseurl}}/team/{{contact.name | slugify }}">
                        <img class="tabs__contact-image" src="<?php the_field('thumbnail', $id)->url; ?>" alt="">
                      </a>
                    <?php endif; ?>
                     <div class="tabs__contact-body">
                       <h4 class="tabs__contact-name"><?= get_sub_field('person')->post_title; ?></h4>
                       <h5 class="tabs__contact-position"><?php the_field('position', $id); ?></h5>
                       <?php if (have_rows('contact', $id)) :?>
                         <?php while ( have_rows('contact', $id) ) : the_row(); ?>
                           <?php if(get_sub_field('method', $id) == 'email'): ?>
                              <div class="tabs__contact-email"><?php the_sub_field('value', $id) ?></div>
                           <?php endif; ?>
                         <?php endwhile; ?>
                       <?php endif; ?>
                       <a href="<?php the_permalink($id); ?>" class="tabs__contact-link">
                         <span class="sr-only"><?php the_field('position', $id); ?>'s</span>
                         Full profile
                       </a>
                       <?php if(get_field('twitter', $id)):  ?>
                         <br/>
                         <a class="what-we-do__link" href='<?php the_field('twitter', $id); ?>'>
                           Follow us <span class='icon-twitter'></span>
                        </a>
                       <?php endif; ?>
                     </div>
                    </div>
                  <?php endwhile; ?>
                <?php endif; ?>
              </div>
            </div>
            <?php endwhile; ?>
          </section>
        </div>

        <div class="dn-ns">
          <?php get_template_part('partials/star', 'separator') ?>
        </div>

			<?php endwhile; /* End of the loop. */
			?>

		</main>
		</div>

<?php
get_footer();
