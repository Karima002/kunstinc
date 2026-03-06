<?php
/**
 * Template Name: Ontdekken
 */

get_header();

// Query om de berichten op te halen
$args = array(
    'post_type' => 'routes',
    'posts_per_page' => 2,
);
$routes_query = new WP_Query($args);
?>

<div id="map"></div>

<?php
// The Loop
if ($routes_query->have_posts()) {
    echo '<section class="route-maps">';
    while ($routes_query->have_posts()) {
        $routes_query->the_post();
        
        $route_group_field = get_field('routes'); // Group field

        // Retrieve all subfields
        $route_name = $route_group_field['route_naam'] ?? '';
        $duration_route = $route_group_field['duration_route'] ?? '';
        $miles_route = $route_group_field['miles_route'] ?? '';
        $icoon_route = $route_group_field['icoon_route'] ?? '';
        $link_route = $route_group_field['link_route'] ?? '';
        $foto_route = $route_group_field['foto_route'] ?? '';
        $route_afbeelding_alt = $route_group_field['route_afbeelding_alt'] ?? '';
        
        // First Route
        echo '<a class="route-card" href="' . esc_url($link_route) . '">';
        if ($foto_route) {
            echo '<img src="' . esc_url($foto_route) . '" alt="' . esc_attr($route_afbeelding_alt) . '">';
        }
        
        echo '<div class="route-icon">' . wp_kses_post($icoon_route) . '</div>';
        
        echo '<div class="route-info">';
        echo '<h3 class="route-title">' . esc_html($route_name) . '</h3>';
        echo '<div class="route-type">';
        echo '<p><i class="fa-solid fa-clock"></i> ' . esc_html($duration_route) . '</p>';
        echo '<p><i class="fa-solid fa-route"></i> ' . esc_html($miles_route) . '</p>';
        echo '</div>';
        echo '</div>';
                        
        echo '<div class="background-gradient"></div>';
        echo '</a>';
    }
    echo '</section>';
    /* Restore original Post Data */
    wp_reset_postdata();
} else {
    // no posts found
    echo '<p>Geen routes gevonden!</p>';
}
?>

<?php 

echo '<section id="" class="route-detail-window popup-hidden">'

?>
  <nav>
    <a href="#" id="prev-button"><i class="fa-solid fa-arrow-up"></i></a>
    <a href="#" id="next-button"><i class="fa-solid fa-arrow-down"></i></a>
  </nav>
  <section id="popup-content">
    <img id="popup-image" src="" alt="afbeelding van kunstwerk">
    <h2 id="popup-title"></h2>
    <p id="popup-desc"></p>
    <div>
    <a id="popup-btn1" href="#">Meer weten?</a>
    <a id="popup-btn2" href="#">Route</a>
    </div>
  </section>
</section>

<?php get_footer(); ?>