<?php 
/**
 * Template Name: archive of events
 */
get_header(); 

// Query om de berichten op te halen
$args = array(
  'post_type' => 'evenementen',
  'posts_per_page' => -1,
  'meta_key' => 'single-event-datetime-group_single-event-date', // Combined meta key for the nested field
  'orderby' => 'meta_value',
  'order' => 'ASC',
  'meta_type' => 'DATE', // Specify that the meta value is a date
);
$evenementen_query = new WP_Query($args);

?>

<section class="event_container fixed-width margin-top-150" aria-labelledby="agenda-title">
  <section class="event_header">
    <h1 id="agenda-title">Archief evenementen </h1>
  </section>

<?php
// The Loop
if ($evenementen_query->have_posts()) {
    while ($evenementen_query->have_posts()) {
      $evenementen_query->the_post();
        
        $time_group_field = get_field('single-event-datetime'); // Group field
        $column_group_field = get_field('single-event-columns'); // Group field
        $title_event = get_field('single-event-title'); // Title field
        $event_permalink = get_the_permalink(); // Permalink

        $event_date_group = get_field('single-event-datetime-group'); // Group field
        $event_date = $event_date_group['single-event-date']; // Title field

        // Retrieve all subfields
        $event_column_text = $column_group_field['single-event-text'];

        echo '<section class="events">';
          echo '<article class="event">';
            echo '<div>';
              echo '<h3>' . esc_html($title_event) . '</h3>';
              echo '<p class="event-date">' . esc_html($event_date) . '</p>';
              echo '<p>' . strip_tags($event_column_text) . '</p>';
            echo '</div>';
            echo '<a href="' . esc_url($event_permalink) . '" class="arrow-link" aria-label="Meer informatie over dit kunstevent"><i class="fa-solid fa-arrow-right"></i></a>';
          echo '</article>';
        echo '</section>';
    
    }
    /* Restore original Post Data */
    wp_reset_postdata();
} else {
    // no posts found
    echo '<p>Geen evenementen gevonden!</p>';
}
?>

</section>

<?php get_footer(); ?>
