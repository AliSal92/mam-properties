<?php get_header(); ?>
    <main id="content">
        <div class="archive-property-header archive-single-property-header">
            <div class="archive-single-property-header-inner">
                <h1><?php the_title(); ?></h1>
                <h3><?php the_excerpt(); ?></h3>
            </div>
            <?php
            $image = get_the_post_thumbnail_url(get_the_ID(), 'full');
            if (!$image) {
                $image = 'https://via.placeholder.com/1920x600';
            }
            ?>
            <img src="<?php echo $image; ?>" alt="<?php the_title(); ?>" width="100%" height="auto"/>
        </div>
        <div class="mam-single-property-attributes">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mam-single-property-attribute">
                            <span class="mam-single-property-attribute-icon"><i class="fas fa-expand-arrows-alt"></i></span>
                            <span class="mam-single-property-attribute-unit"><?php _e('Units', 'mam-properties'); ?></span>
                            <span class="mam-single-property-attribute-value"><?php echo get_field('size'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mam-single-property-attribute">
                            <span class="mam-single-property-attribute-icon"><i class="fas fa-building"></i></span>
                            <span class="mam-single-property-attribute-unit"><?php _e('Building', 'mam-properties'); ?></span>
                            <span class="mam-single-property-attribute-value"><?php echo get_field('building'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mam-single-property-attribute">
                            <span class="mam-single-property-attribute-icon"><i class="fas fa-sort-numeric-up"></i></span>
                            <span class="mam-single-property-attribute-unit"><?php _e('Floor', 'mam-properties'); ?></span>
                            <span class="mam-single-property-attribute-value"><?php echo get_field('floor'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="mam-single-property-content-inner">
                <div class="container">
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="entry-content">
                            <?php
                            $images = get_field('gallery');
                            if ($images) {
                                ?>
                                <div class="mam-property-gallery">
                                    <?php foreach ($images as $imageURL) { ?>
                                        <div class="image-item">
                                            <a href="<?php echo $imageURL; ?>" data-fancybox="mam-property-gallery" data-caption="<?php the_title(); ?>">
                                                <img alt="<?php the_title(); ?>" src="<?php echo $imageURL; ?>" width="100%" height="auto"/>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <div class="mam-single-property-the-content">
                                <?php the_content(); ?>
                            </div>
                            <div class="mam-single-property-content-request-details">
                                <a href="#request-details-form" class="btn btn-primary btn-request-details" data-fancybox>Request Details</a>
                                <div style="display: none;">
                                    <div id="request-details-form">
                                        <h2><?php echo the_title(); ?></h2>
                                        <div class="request-details-form-img">
                                            <img src="<?php echo $image; ?>" alt="<?php the_title(); ?>" width="100%" height="auto"/>
                                        </div>
                                        <?php echo do_shortcode('[quform id="5" name="Request details"]'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="mam-single-property-map-container">
                    <?php
                    $location = get_field('map');
                    if ($location): ?>
                        <div class="acf-map" data-zoom="16">
                            <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
                        </div>
                    <?php endif; ?>

                </div>
                <div class="mam-single-property-footer">
                    <div class="container g-to-call">
                        <div class="col-md-4 g-call">
                            <div class="g-phone">
                                <i class="fas fa-phone"></i>
                                <a herf="tel:012-123-468">
                                    <?php _e('contact by phone', 'mam-properties'); ?>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 g-call">
                            <div class="g-phone">
                                <i class="fas fa-envelope"></i>
                                <a href="mailto:info@kingsroadpropoerty.com">
                                    <?php _e('Request an email enquiry', 'mam-properties'); ?>

                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 g-call">
                            <div class="g-phone">
                                <i class="fas fa-share-alt"></i>
                                <a herf="#">
                                    <?php _e('Share this project', 'mam-properties'); ?>
                                </a>
                                <div class="so-icon">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.kingsroadproperty.com/properties/spacious-petfriendly-215sqm-condo-phra-kanong-ficus-lane-rental/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                    <a href="https://twitter.com/home?status=https://www.kingsroadproperty.com/properties/spacious-petfriendly-215sqm-condo-phra-kanong-ficus-lane-rental/" target="_blank"><i class="fab fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        <?php endwhile; endif; ?>
    </main>

    <style type="text/css">
        .acf-map {
            width: 100%;
            height: 400px;
            border: #ccc solid 1px;
            margin: 20px 0;
        }

        /
        /
        Fixes potential theme css conflict.
        .acf-map img {
            max-width: inherit !important;
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC_HjGT2znOV9G3FO7anLIbRyRQfRvTE-M"></script>
    <script type="text/javascript">
        (function ($) {

            /**
             * initMap
             *
             * Renders a Google Map onto the selected jQuery element
             *
             * @date    22/10/19
             * @since   5.8.6
             *
             * @param   jQuery $el The jQuery element.
             * @return  object The map instance.
             */
            function initMap($el) {

                // Find marker elements within map.
                var $markers = $el.find('.marker');

                // Create gerenic map.
                var mapArgs = {
                    zoom: $el.data('zoom') || 16,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                var map = new google.maps.Map($el[0], mapArgs);

                // Add markers.
                map.markers = [];
                $markers.each(function () {
                    initMarker($(this), map);
                });

                // Center map based on markers.
                centerMap(map);

                // Return map instance.
                return map;
            }

            /**
             * initMarker
             *
             * Creates a marker for the given jQuery element and map.
             *
             * @date    22/10/19
             * @since   5.8.6
             *
             * @param   jQuery $el The jQuery element.
             * @param   object The map instance.
             * @return  object The marker instance.
             */
            function initMarker($marker, map) {

                // Get position from marker.
                var lat = $marker.data('lat');
                var lng = $marker.data('lng');
                var latLng = {
                    lat: parseFloat(lat),
                    lng: parseFloat(lng)
                };

                // Create marker instance.
                var marker = new google.maps.Marker({
                    position: latLng,
                    map: map
                });

                // Append to reference for later use.
                map.markers.push(marker);

                // If marker contains HTML, add it to an infoWindow.
                if ($marker.html()) {

                    // Create info window.
                    var infowindow = new google.maps.InfoWindow({
                        content: $marker.html()
                    });

                    // Show info window when marker is clicked.
                    google.maps.event.addListener(marker, 'click', function () {
                        infowindow.open(map, marker);
                    });
                }
            }

            /**
             * centerMap
             *
             * Centers the map showing all markers in view.
             *
             * @date    22/10/19
             * @since   5.8.6
             *
             * @param   object The map instance.
             * @return  void
             */
            function centerMap(map) {

                // Create map boundaries from all map markers.
                var bounds = new google.maps.LatLngBounds();
                map.markers.forEach(function (marker) {
                    bounds.extend({
                        lat: marker.position.lat(),
                        lng: marker.position.lng()
                    });
                });

                // Case: Single marker.
                if (map.markers.length == 1) {
                    map.setCenter(bounds.getCenter());

                    // Case: Multiple markers.
                } else {
                    map.fitBounds(bounds);
                }
            }

// Render maps on page load.
            $(document).ready(function () {
                $('.acf-map').each(function () {
                    var map = initMap($(this));
                });
            });

        })(jQuery);
    </script>

<?php get_footer(); ?>