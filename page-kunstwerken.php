<?php

/**
 * Template Name: Archive of Kunstwerken
 */

get_header();

// Query om de berichten op te halen
$args = array(
    'post_type' => 'kunstwerken',
    'posts_per_page' => -1,
);
$allekunstwerken_query = new WP_Query($args);

$args = array(
    'post_type' => 'kunstwerken',
    'posts_per_page' => 1,
    'category_name' => 'uitgelicht-kunstwerk',
);
$uitgelicht_Kunstwerk_query = new WP_Query($args);
?>

<?php
$alle_kunstwerken_group = get_field('alle_kunstwerken_group');
$alle_kunstwerken_knop = $alle_kunstwerken_group['alle_kunstwerken_knop'];
?>

<section class="collection-header margin-top-150 fixed-width">
    <div class="content-wrapper">
        <?php echo wp_kses_post($alle_kunstwerken_group['alle_kunstwerken_text']); ?>
        <div class="button-wrapper">
            <?php if ($alle_kunstwerken_knop) : ?>
                <a class="btn" href="<?php echo esc_url($alle_kunstwerken_knop['url']); ?>" aria-label="Meer informatie over de kunstwerken"> <?php echo esc_attr($alle_kunstwerken_knop['title']); ?></a>
            <?php endif; ?>
        </div>
    </div>


    <?php
    if ($uitgelicht_Kunstwerk_query->have_posts()) {
        while ($uitgelicht_Kunstwerk_query->have_posts()) {
            $uitgelicht_Kunstwerk_query->the_post();


            $kunstwerk_afbeelding = get_field('map_afbeelding_kunstwerk');
            $kunstwerk_afbeelding_alt = get_field('afbeelding_alt_tekst_kunstwerk');
            $kunstwerk_title = get_the_title();
            $kunstwerk_author = get_field('kunstenaar_kunstwerk');
            $kunstwerk_bouwjaar = get_field('bouwjaar_kunstwerk'); // ACF veld voor bouwjaar
            $kunstwerk_materiaal = get_field('materiaal_kunstwerk'); // ACF veld voor materiaal
            $kunstwerk_desc = get_field('kunstwerk-beschrijving'); // ACF veld voor beschrijving
            $kunstwerk_bronvermelding = get_field('bronvermelding');
            $kunstwerk_link = get_the_permalink();


            echo '<div class="image-wrapper">';
            echo '<a href="' . esc_url($kunstwerk_link) . '">';
            if ($kunstwerk_afbeelding) {
                echo '<img class="image" src="' . esc_url($kunstwerk_afbeelding) . '" alt="' . esc_attr($kunstwerk_afbeelding_alt) . '">';
                echo '<span>' . esc_html($kunstwerk_bronvermelding) . '</span>';
            }
            echo '<div class="dark-overlay">';
            echo '<div class="link-wrapper">';
            echo '<h3>' . esc_html($kunstwerk_title) . '</h3>';
            echo '<i class="fa-solid fa-arrow-right"></i>';
            echo '</div>';
            echo '<div class="filter-items">';
            echo '<p>' . esc_html($kunstwerk_author) . '</p>';
            echo '<div class="details-wrap">';
            if ($kunstwerk_bouwjaar) {
                echo '<p>' . esc_html($kunstwerk_bouwjaar) . '</p>';
            }
            if ($kunstwerk_materiaal) {
                echo '<p>' . esc_html($kunstwerk_materiaal) . '</p>';
            }
            if ($kunstwerk_desc) {
                echo '<p class="kunst-desc">' . wp_kses_post($kunstwerk_desc) . '</p>';
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
        }
        wp_reset_postdata();
    } else {
        echo '<p>Geen kunstwerken gevonden!</p>';
    }
    ?>
</section>



<!-- Grid met overview-->
<section class="collection-overview margin-top-150">
    <?php
    if ($allekunstwerken_query->have_posts()) {
        echo '<section class="collection-overview-header fixed-width">';
        echo '<div>';
            echo '<h2 class="collection-title">Overzicht van kunstwerken</h2>';
            echo '<p class="collection-results">Resultaten: ' . $allekunstwerken_query->found_posts . '</p>';
        echo '</div>';
        echo '<aside class="kunst-view">';
            echo '<label for="lg-grid class="lg-tog"><input id="lg-grid" name="lg-tog" type="radio" class="lg-grid"><i class="fa-solid fa-border-all"></i></label>';
            echo '<label for="lg-list" class="lg-tog"><input id="lg-list" name="lg-tog" type="radio" class="lg-list"><i class="fa-solid fa-list"></i></label>';
            // echo '<input id="lg-list" name="lg-tog" type="radio" class="lg-list"> <input id="lg-grid" name="lg-tog" type="radio" class="lg-grid">';
        echo '</aside>';
        echo '</section>';

        echo '<ul class="collection-overview-wrap fixed-width">';
        while ($allekunstwerken_query->have_posts()) {
            $allekunstwerken_query->the_post();


            $kunstwerk_afbeelding = get_field('map_afbeelding_kunstwerk');
            $kunstwerk_afbeelding_alt = get_field('afbeelding_alt_tekst_kunstwerk');
            $kunstwerk_title = get_the_title();
            $kunstwerk_author = get_field('kunstenaar_kunstwerk');
            $kunstwerk_bouwjaar = get_field('bouwjaar_kunstwerk'); // ACF veld voor bouwjaar
            $kunstwerk_materiaal = get_field('materiaal_kunstwerk'); // ACF veld voor materiaal
            $kunstwerk_desc = get_field('kunstwerk-beschrijving'); // ACF veld voor beschrijving
            $kunstwerk_bronvermelding = get_field('bronvermelding');
            $kunstwerk_link = get_the_permalink();


            echo '<li class="image-wrapper">';
            echo '<a href="' . esc_url($kunstwerk_link) . '">';
            if ($kunstwerk_afbeelding) {
                echo '<img class="image" src="' . esc_url($kunstwerk_afbeelding) . '" alt="' . esc_attr($kunstwerk_afbeelding_alt) . '">';
                echo '<span>' . esc_html($kunstwerk_bronvermelding) . '</span>';
            }
            echo '<div class="dark-overlay">';
            echo '<div class="link-wrapper">';
            echo '<h3>' . esc_html($kunstwerk_title) . '</h3>';
            echo '<i class="fa-solid fa-arrow-right"></i>';
            echo '</div>';
            echo '<div class="filter-items">';
            echo '<p>' . esc_html($kunstwerk_author) . '</p>';
            echo '<div class="details-wrap">';
            if ($kunstwerk_bouwjaar) {
                echo '<p>' . esc_html($kunstwerk_bouwjaar) . '</p>';
            }
            if ($kunstwerk_materiaal) {
                echo '<p>' . esc_html($kunstwerk_materiaal) . '</p>';
            }
            if ($kunstwerk_desc) {
                echo '<p class="kunst-desc">' . wp_kses_post($kunstwerk_desc) . '</p>';
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
            echo '</li>';
        }
        echo '</ul>';
        wp_reset_postdata();
    } else {
        echo '<p>Geen kunstwerken gevonden!</p>';
    }
    ?>

</section>


<a href="/steun-ons">
    <div class="help-btn-wrapper">
        <div class="col-left">
            <i class="fa-solid fa-heart fa-2x"></i>
        </div>
        <div class="col-right">
            <p>Steun ons!</p>
        </div>
    </div>
</a>


<?php get_footer(); ?>