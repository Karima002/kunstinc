<?php
/**
 * Template Name: Ontdekken
 */

get_header();

// SVGs ophalen uit assets map
$svgs = [
    get_template_directory() . '/assets/images/fietsroute.svg',
    get_template_directory() . '/assets/images/wandelroute.svg',
];

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
    $route_index = 0;
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

        // SVG ophalen uit assets map
        $svg = isset($svgs[$route_index]) && file_exists($svgs[$route_index])
            ? file_get_contents($svgs[$route_index])
            : '';
        
        echo '<a class="route-card" href="' . esc_url($link_route) . '">';
     
        
       
        
        echo '<div class="route-info">';
    
  
        echo '</div>';
                        
        echo '<div class="background-gradient">' . $svg . '</div>';

        echo '</a>';

        $route_index++;
    }
    echo '</section>';
    /* Restore original Post Data */
    wp_reset_postdata();
} else {
    // no posts found
    echo '<p>Geen routes gevonden!</p>';
}
?>

<?php echo '<section id="" class="route-detail-window popup-hidden">'; ?>
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