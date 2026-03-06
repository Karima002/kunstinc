<?php
get_header();

$query_args = array(
  'post_type' => 'jaaropgaves', // Use lowercase to match the post type registration
  'posts_per_page' => -1,
);

// The Query
$the_query = new WP_Query($query_args);
?>

<?php
$anbi_group = get_field('anbi_group');
$anbi_contact_group = get_field('anbi_contact_group');
$anbi_jaaropgave_group = get_field('anbi_jaaropgave_group');
?>

<section class="pageheader-anbi margin-top-150 fixed-width">
    <section>
        <?php
        // Display main group title
        if ($anbi_group && !empty($anbi_group['anbi_titel_1'])) {
            echo wp_kses_post($anbi_group['anbi_titel_1']);
        }
        ?>
    </section>
    
    <?php if ($anbi_contact_group): // Ensure contact group exists ?>
        <section class="content_wrapper">
            <section class="content">
                <section class="art-details">
                    <?php
                    // Display contact group title
                    if (!empty($anbi_contact_group['anbi-contact-titel'])) {
                        echo '<h4>' . esc_html($anbi_contact_group['anbi-contact-titel']) . '</h4>';
                    }
                    ?>

                    <?php if (!empty($anbi_contact_group['anbi_tabel'])): // Check if the repeater field has rows ?>
                        <?php foreach ($anbi_contact_group['anbi_tabel'] as $row): // Loop through the repeater field ?>
                            <section class="detail-group">
                                <?php
                                // Fetch subfields from the current row
                                $anbi_titel = $row['item_naam_anbi'];
                                $anbi_invoer = $row['item_invoerveld_anbi'];
                                ?>
                                <?php if ($anbi_titel) echo wp_kses_post($anbi_titel); ?>
                                <?php if ($anbi_invoer) echo wp_kses_post($anbi_invoer); ?>
                            </section>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </section>
            </section>
        </section>
    <?php endif; ?>
</section>

<section class="annual-statement fixed-width">
  <section class="annual-info">
    <h2><?php echo esc_html($anbi_jaaropgave_group['anbi-jaaropgaves-titel']); ?></h2>
    <p><?php echo esc_html($anbi_jaaropgave_group['anbi-jaaropgaves-tekst']); ?></p>

    <?php
    // The Loop
    if ($the_query->have_posts()) {
      echo '<section class="annual-data">';
      while ($the_query->have_posts()) {
        $the_query->the_post();

        // Retrieve ACF fields for the current post
        $image_jaaropgave = get_field('jaartal-achtergrond-foto');
        $image_jaaropgave_alt = get_field('jaartal-achtergrond-foto-alt');
        $year_jaaropgave = get_field('jaartal-jaaropgave');
        $download_jaaropgave = get_field('downloaden');

        echo '<section class="annual-item">';

        if ($image_jaaropgave) {
          echo '<img src="' . esc_url($image_jaaropgave['url']) . '" alt="' . esc_attr($image_jaaropgave_alt) . '">';
        }

        echo '<div class="annual-text-container">';
        if ($year_jaaropgave) {
          echo '<h4>' . esc_html($year_jaaropgave) . '</h4>';
          echo '<a href="' . esc_url($download_jaaropgave) . '" download>Downloaden</a>';
        }
        echo '</div>';

        echo '</section>';
      }
      echo '</section>';
      /* Restore original Post Data */
      wp_reset_postdata();
    } else {
      // no posts found
      echo '<p>Geen jaaropgaves gevonden!</p>';
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