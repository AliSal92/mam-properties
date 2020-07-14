<?php get_header(); ?>
    <main id="content">
        <div class="archive-property-header">
            <h1><?php _e('PROPERTIES', 'mam-properties'); ?></h1>
            <h3><?php _e('For Sale/Rent in Thailand', 'mam-properties'); ?></h3>
            <div class="customer-search-form">
                <div class="container">
                    <h2><?php _e('FIND A PROPERTY', 'mam-properties'); ?></h2>
                    <?php echo do_shortcode('[mam-property-form]'); ?>
                </div>
            </div>
        </div>
        <?php
        $the_query = apply_filters('mam-property-filtered-posts', $_GET);
        ?>
        <?php if ($the_query->have_posts()): ?>
            <div class="mam-properties-list">
                <div class="container">
                    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                        <div class="mam-property-item">
                            <a href="<?php echo get_the_permalink(); ?>" class="mam-property-link"></a>
                            <div class="mam-property-item-inner">
                                <div class="mam-property-featured-image">
                                    <?php
                                    $image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                    if (!$image) {
                                        $image = 'https://via.placeholder.com/1920x600';
                                    }
                                    ?>
                                    <img src="<?php echo $image; ?>" alt="<?php the_title(); ?>" width="100%" height="auto"/>
                                </div>
                                <div class="mam-property-content">
                                    <h2><?php the_title(); ?></h2>
                                    <h3><i class="fas fa-map-marker-alt"></i> <?php echo get_field('location'); ?></h3>
                                    <h3 class="text text-info"><span class="mam-property-attribute"><i class="fas fa-bed"></i> <?php echo get_field('bedrooms'); ?></span> <span class="mam-property-attribute"><i class="fas fa-expand-arrows-alt"></i> <?php echo get_field('size'); ?></span></h3>
                                    <div class="mam-property-excerpt">
                                        <?php the_excerpt(); ?>
                                    </div>
                                    <div class="btn btn-search btn-primary"><?php _e('View Property', 'mam-properties'); ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php wp_reset_query();     // Restore global post data stomped by the_post(). ?>
    </main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>