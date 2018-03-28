<?php
/**
 * The template for displaying all single people
 *
 *
 * @package north-star
 */

get_header(); ?>

    <div class="container">
      <main>

        <?php
        while ( have_posts() ) : the_post(); ?>

          <div class="breadcrumb">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
            <a href="<?php the_permalink(get_page_by_title('The Team')->ID); ?>">Team</a>
            <?php the_title(); ?>
          </div>

          <div class="team-member">
            <h1 class="dn-m"><?php the_title(); ?></h1>

            <?php if ( has_post_thumbnail() ) : ?>
              <img
                src="<?php the_post_thumbnail_url(); ?>"
                alt=""
                class="team-member__image"
              >
            <?php endif; ?>

            <div class="team-member__body">
              <span class="h1 db-ns"><?php the_title(); ?></span>

              <?php if (get_field('contact')) : ?>
              <ul class="team-member__contact-details">
                <?php while ( have_rows('contact') ) : the_row(); ?>
                <li>
                    <span class="team-member__contact-method"><?php the_sub_field('method'); ?></span>:
                    <?php if(strtolower(get_sub_field('method')) == 'email') { ?><a href="mailto:<?php the_sub_field('value'); ?>"><?php } ?>
                    <?php the_sub_field('value'); ?>
                    <?php if(strtolower(get_sub_field('method')) == 'email') { ?></a><?php } ?>
                </li>
                 <?php endwhile; ?>
              </ul>
               <?php endif; ?>

              <?php if (get_field('linkedin_profile')) : ?>
              <p>
                <a href="<?php the_field('linkedin_profile'); ?>" target="_blank" class="team-member__link">
                  <span class="icon-linkedin"></span>
                  LinkedIn
                </a>
              </p>
              <?php endif; ?>

              <?php if (get_field('vcard')) : ?>
              <a href="<?= get_field('vcard')['url']; ?>" download class="team-member__vcard">
                <span class="icon-user"></span>
                Download vCard
              </a>
              <?php endif; ?>

              <?php the_content(); ?>

              <?php if (get_field('qualifications')) : ?>
              <h2>Qualifications</h2>
              <ul>
                <?php while ( have_rows('qualifications') ) : the_row(); ?>
                  <li><?php the_sub_field('qualification') ?></li>
                <?php endwhile; ?>
              </ul>
              <?php endif; ?>
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
