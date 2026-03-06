<?php
/**
 * Template Name: Single post kunstwerken
 */

get_header();

$kunstwerk_link = get_field('kunstwerk-link');

// Query om de berichten op te halen
$args = array(
  'post_type' => 'kunstwerken',
  'posts_per_page' => 3,
);
$art_query = new WP_Query($args);

// Query om de kunstwerken op te halen in horizontale scroll
$args2 = array(
  'post_type' => 'kunstwerken',
  'posts_per_page' => 4,
);
$horizontalScroll_query = new WP_Query($args2);

$kunstwerken_tags = get_field('kunstwerken_tags');

?>

<!----------------->
<!-- Pageheader -->
<!----------------->

<section class="detail-parent">
  <section class="kunst-info" aria-labelledby="kunstwerk-titel" aria-describedby="kunstwerk-beschrijving">
    <h1 id="kunstwerk-titel" style="--delay:0.04s"><?php the_field('kunstwerk-titel'); ?></h1> 
    <p class="kunstenaar" style="--delay:0.10s" aria-describedby="kunstwerk-titel"><?php the_field('kunstwerk-kunstenaar'); ?></p>
    <p id="kunstwerk-beschrijving" style="--delay:0.12s"><?php the_field('kunstwerk-beschrijving'); ?></p> 
    <ul style="--delay:0.15s">
        <?php if (!empty($kunstwerken_tags)): // Check if the repeater field has rows ?>
            <?php foreach ($kunstwerken_tags as $row): // Loop through the repeater field ?>
                <li>
                    <?php
                    // Fetch subfields from the current row
                    $tags_title = $row['tags_art'];
                    ?>
                    <?php echo $tags_title ?>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
    <span><?php the_field('bronvermelding'); ?></span>
  </section>
  <section class="kunst-afbeelding <?php the_field('selecteer-achtergrond') ?>" aria-labelledby="kunstwerk-titel">
    <img src="<?php the_field('kunstwerk-afbeelding'); ?>" alt="<?php the_field('kunstwerk-titel'); ?>">
    <div class="effect"></div>
    
    <?php 
    if ($kunstwerk_link) {
        echo '<a href="' . esc_url($kunstwerk_link['url']) . '" aria-label="Meer informatie over het kunstwerk">' . esc_html($kunstwerk_link['title']) . '</a>';
    }
    ?>
  </section>
</section>

<!----------------->
<!-- Horizontale scroll -->
<!----------------->

<?php 
$kunstwerk_columns_content = get_field('kunstwerk-horizontal-scroll-group');
?>

<section id="section_to-pin" class="grid-container full section section_to-pin four section-detail-scroll fixed-width">
  <div id="section_pin" class="section_pin">
    <div class="content_wrapper ">
      <div id="text-wrapper" class="text-wrapper">
        <?php 
        echo wp_kses_post($kunstwerk_columns_content['kunstwerk-horizontal-scroll-text']);

        if (!empty($kunstwerk_columns_content['kunstwerk-horizontal-scroll-table'])): // Check if the repeater field has rows ?>
          <ul class="art-details">
            <?php foreach ($kunstwerk_columns_content['kunstwerk-horizontal-scroll-table'] as $row): // Loop through the repeater field ?>
            <?php
              // Fetch subfields from the current row
              $kunstwerk_scroll_titel = $row['kunstwerk-horizontal-scroll-table-title'];
              $kunstwerk_scroll_description = $row['kunstwerk-horizontal-scroll-table-description'];
            ?>
            <li class="detail-group">
              <?php if ($kunstwerk_scroll_titel) echo '<p>' . $kunstwerk_scroll_titel . '</p>'?>
              <?php if ($kunstwerk_scroll_description) echo '<p>' . $kunstwerk_scroll_description . '</p>'?>
            </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </div>
    </div>
    <section class="parent_wrapper">
        <?php
        $kunstwerk_media = $kunstwerk_columns_content['kunstwerk-horizontal-scroll-media'];
        foreach ($kunstwerk_media as $item) {
          // Controleren of de radio keuze is ingesteld
          if (isset($item["kunstwerk-horizontal-scroll-radio"])) {
            $radio_choice = $item["kunstwerk-horizontal-scroll-radio"];
            
            echo '<div class="image_wrapper artworks">';
              // Afbeelding of video laten zien op basis van de keuze
              if ($radio_choice == "Afbeelding" && isset($item["kunstwerk-horizontal-scroll-image"])) {
                  $afbeelding_url = $item["kunstwerk-horizontal-scroll-image"];
                  $afbeelding_alt = $item["kunstwerk-horizontal-scroll-image-alt"];
                  $afbeelding_bron = $item["bronvermelding"];

                  echo "<img src='$afbeelding_url' class='image' alt='$afbeelding_alt' />";
                  echo '<span>' . esc_html($afbeelding_bron) . '</span>';
              } elseif ($radio_choice == "Video" && isset($item["kunstwerk-horizontal-scroll-video"])) {
                  $video_url = $item["kunstwerk-horizontal-scroll-video"];
                  parse_str( parse_url($video_url, PHP_URL_QUERY ), $query_vars );
                  $video_id = $query_vars['v'];
                  $afbeelding_bron = $item["bronvermelding"];
              
                  // Creëer de embed URL
                  $embed_url = 'https://www.youtube.com/embed/' . $video_id;
                  echo "<iframe class='image' src='$embed_url' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
                  echo '<span>' . esc_html($afbeelding_bron) . '</span>';
              }
            echo '</div>';
          }
        } ?>
      </div>
    </section>
  </div>
</section>


<!----------------->
<!-- Duo columns -->
<!----------------->

<?php 
$kunstwerk_columns_content = get_field('kunstwerk-columns');
?>

<section class="section-duo-columns fixed-width">
    <div class="col-left">
        <?php echo wp_kses_post($kunstwerk_columns_content['kunstwerk-column-left']) ?>
    </div>
    <div class="col-right">
        <?php echo wp_kses_post($kunstwerk_columns_content['kunstwerk-column-right']) ?>
    </div>
</section>


<!----------------->
<!-- Cards -->
<!----------------->

<section class="section-cards section-spacing fixed-width">
<?php
// The Loop
if ($art_query->have_posts()) {
    echo '<div class="cards-wrapper">';
    while ($art_query->have_posts()) {
        $art_query->the_post();

        $title_kunstwerk = get_the_title();
        $image_kunstwerk = get_field('map_afbeelding_kunstwerk');
        $image_desc = get_field('map-omschrijving');
        $image_link = get_field('map_knop_detailpagina');
        $kunstwerk_author = get_field('kunstenaar_kunstwerk');
        $image_alt = get_field('afbeelding_alt_tekst_kunstwerk');

        echo '<div class="card">';
          echo '<div class="image-wrapper">';
            echo '<img class="card-image" src="' . esc_url($image_kunstwerk) . '" alt="' . esc_attr($image_alt) . '">';
          echo '</div>';
          echo '<div class="content">';
            echo '<div class="card-text">';
              echo '<h3>' . esc_html($title_kunstwerk) . '</h3>';
              echo '<p>' . esc_html($kunstwerk_author) . '</p>'; // hie rmoet de kunstenaar nog worden toegevoegd
              echo '<p class="thumbnail-description">' . wp_kses_post($image_desc) . '</p>';
            echo '</div>';
            echo '<div class="card-footer">';

            echo '<a class="btn" href="' . esc_url(get_permalink()) . '"> ' . esc_html($image_link['title']) . ' <i class="fa-solid fa-arrow-right"></i></a>';
            echo '</div>';
          echo '</div>';
        echo '</div>';
        
    }
    echo '</div>';
    /* Restore original Post Data */
    wp_reset_postdata();
} else {
    // no posts found
    echo '<p>Geen kunstwerken gevonden!</p>';
}
?>


<!----------------->
<!-- Steun ons knop -->
<!----------------->

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
