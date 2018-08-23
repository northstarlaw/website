<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package north-star
 */

?>

	</div><!-- #content -->

	<footer>
    <section class="footer">
      <div class="container">

        <img src="<?= get_template_directory_uri(); ?>/assets/white-logo.png" alt="" class="footer__image-small">
        <div class="grid">
          <div class="col col-md footer__row">
            <nav>
              <?php
                wp_nav_menu( array(
                  'theme_location' => 'menu-2',
                  'menu_id'        => 'footer-menu',
                  'menu_class' => 'list--unstyled footer__pages',
                  'items_wrap' => '<ul class="%2$s">%3$s</ul>'
                ) );
              ?>
            </nav>
          </div>
          <div class="col col-md text-right-md footer__row">
            <?= do_shortcode('[contact-card show_name=0 show_get_directions=0 show_email=0 show_phone=0 show_contact=0 show_opening_hours=0 show_map=0]'); ?>

            <ul class="list--unstyled">
              <li>
								<tel class="desktop-only"itemprop="telephone"><?= do_shortcode('[contact-card show_email=0 show_address=0 show_name=0 show_get_directions=0 show_contact=0 show_opening_hours=0 show_map=0]'); ?></tel>
								<a class="mobile-only" href="tel:0203-355-9610"><?= do_shortcode('[contact-card show_email=0 show_address=0 show_name=0 show_get_directions=0 show_contact=0 show_opening_hours=0 show_map=0]'); ?></a>
							</li>
            </ul>
          </div>
        </div>
        <div class="grid footer__meta">
          <div class="col col-md-8 flex--self-end-md">
            © <?= date('Y'); ?> <?= get_bloginfo('name'); ?><br>
            <a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Legal and Regulatory' ) ) ); ?>">
              Legal and Regulatory Information
            </a>
              <a href="/privacy-policy">Privacy Policy</a>
          </div>
          <div class="col-md-4 text-right">
            <img src="<?= get_template_directory_uri(); ?>/assets/white-logo.png" class="footer__image-large" itemprop="logo">
          </div>
        </div>
      </div>
    </section>
  </footer>

  <div class="mobile-menu">
    <button class="js-mobile-menu-close mobile-menu__close icon-close" type="button">
      <span class="sr-only">Close</span>
    </button>

    <?php
      wp_nav_menu( array(
        'theme_location' => 'menu-1',
        'menu_id'        => 'mobile-menu',
        'menu_class' => 'list--unstyled',
        'items_wrap' => '<ul class="%2$s">%3$s</ul>',
        'walker'     => new WPDocs_Walker_Nav_Menu()
      ) );
    ?>
  </div>



<?php wp_footer(); ?>

</body>
</html>
