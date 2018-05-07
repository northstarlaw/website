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

<div class="container">

		<main>

			<?php
			while ( have_posts() ) : the_post(); ?>

			  <div class="grid flex--col-reverse-ns">
          <div class="col col-md-8">
            <div id="map"></div>
          </div>
          <div class="col col-md-4 contact__details">
            <h1>Contact Us</h1>

            <?php
             if( have_rows('location') ):
                 while ( have_rows('location') ) : the_row();
                     $lat = get_sub_field('latitude');
                     $long = get_sub_field('longitude');
                 endwhile;
             endif;
            ?>

            <h2>Address</h2>
            <?= do_shortcode('[contact-card show_name=0 show_get_directions=0 show_phone=0 show_contact=0 show_opening_hours=0 show_map=0 show_email=0]'); ?>
            <a href="https://www.google.co.uk/maps/place/North+Star+Law/@<?= $lat.','.$long ?>,15z/data=!4m2!3m1!1s0x0:0x631abfb9a1fa593c?sa=X&ved=0ahUKEwiV8qjBkeTZAhUS66QKHe3rDGsQ_BIIqAEwDg" target="_blank">Open in Goople Maps</a>

            <h2>Contact</h2>
            <p>
              <?php if(get_field('phone_number')): ?>
                <abbr title="telephone" class="bold">Telephone</abbr>:
                <span class="dn di-ns"><?php the_field('phone_number'); ?></span>
                <a href="tel:<?php the_field('phone_number'); ?>" class="dn-ns"><?php the_field('phone_number'); ?></a>
              <?php endif; ?>
              <?php if(get_field('fax_number')): ?>
                <br/>
                <span class="bold">Fax:</span> <?php the_field('fax_number'); ?>
              <?php endif; ?>
            </p>

            <p>
              <a href="mailto:<?php bloginfo('admin_email') ?>"><?php bloginfo('admin_email') ?></a>
            </p>

              <?php if(get_field('linkedin_profile')) : ?>
                <p>
                  <a href="<?php the_field('linkedin_profile'); ?>" target="_blank" class="dib">
                    <i class="icon-linkedin icon-left"></i>
                    LinkedIn
                  </a>
                </p>
              <?php endif; ?>
          </div>
        </div>

        <div class="dn-ns">
          <div class="container">
            <?php get_template_part('partials/star', 'separator') ?>
          </div>
        </div>
      <?php
			endwhile; /* End of the loop. */
			?>

		</main>

		<script>
      var initMap = function () {
        var latLong = {lat: 51.5002375, lng: -0.1892626};
        var blue = '#0d2333';
        var lightGrey = '#e6e6e6';
        var grey = '#4a4a4a';
        var gold = '#d7b377';
        var image = '//raw.githubusercontent.com/northstarlaw/website/0150045b51d5d6197a1fea9186385d782f576c31/docs/assets/images/pointer-gold-med.png';

        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: <?= $lat ?>, lng: <?= $long ?>},
          zoom: 16.62,
          styles: [
            { elementType: 'geometry', stylers: [{color: '#ffffff' }] },
            { elementType: 'labels.text.stroke', stylers: [{color: lightGrey}] },
            { elementType: 'labels.text.fill', stylers: [{color: grey}] },
            { elementType: 'labels.text', stylers: [{weight: 5}]},
            { featureType: 'poi.park', elementType: 'geometry', stylers: [{color: blue}] },
            { featureType: 'road', elementType: 'geometry', stylers: [{color: lightGrey}] },
            { featureType: 'road', elementType: 'geometry.stroke', stylers: [{color: blue}] },
            { featureType: "poi.attraction", elementType: "labels", stylers: [{ visibility: "off" }]},
            { featureType: "poi.business", elementType: "labels", stylers: [{ visibility: "off" }]},
            { featureType: "poi.school", elementType: "labels", stylers: [{ visibility: "off" }]}
          ]
        });

        function toggleBounce() {
          if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
          } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
          }
        }

        var marker = new google.maps.Marker({
          position: latLong,
          map: map,
          animation: google.maps.Animation.DROP,
          title: 'North Star Law Ltd.',
          icon: image
        });

        marker.addListener('click', toggleBounce);
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-zUfvMzP6xnVE_jsV-9nUV-ID68OWcVs&callback=initMap"
            async defer></script>

</div>

<?php
get_footer();
