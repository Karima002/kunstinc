<?php
/**
 * Template Name: Steun ons
 */

get_header();

?>
<?php 
    $steun_ph_group = get_field('steun-ons-pageheader-content');
    $steun_ph_tekst = $steun_ph_group['steun-ons-tekst'];
    $steun_ph_button = $steun_ph_group['steun-ons-btn']; 
    $steun_ph_image1 = $steun_ph_group['pageheader-variation-image1'];
    $steun_ph_image2 = $steun_ph_group['pageheader-variation-image2'];
    $steun_ph_image3 = $steun_ph_group['pageheader-variation-image3'];
?>

<!-- -----------------------------------
          PAGEHEADER COMPONENT
------------------------------------ -->

<section class="section-pageheader margin-top-200 normal">
    <div class="pageheader-gradient">
      <div class="content-wrapper fixed-width">
        <div class="col-left">
          <div class="content">
            <div class="text">
            <?php echo wp_kses_post($steun_ph_tekst); ?>
            <?php if ($steun_ph_button['url']) : ?>
                <a href="<?php echo $steun_ph_button['url']; ?>"><?php echo $steun_ph_button['title']; ?> <i class="fa-solid fa-arrow-right"></i></a>
            <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="col-right gallery ph-min-height">
        <?php if (!empty($steun_ph_image1)) { ?>
            <img src="<?php echo esc_url($steun_ph_image1); ?>" class="card-image" alt="testAfbeelding">
        <?php } if (!empty($steun_ph_image2)) { ?>            
            <img src="<?php echo esc_url($steun_ph_image2); ?>" class="card-image" alt="testAfbeelding">
        <?php } if (!empty($steun_ph_image3)) { ?>            
            <img src="<?php echo esc_url($steun_ph_image3); ?>" class="card-image" alt="testAfbeelding">
        <?php } ?>
        </div>
      </div>
    </div>
  </section>

<!-- ----------------------------
          CARD COMPONENT
----------------------------- -->

<?php 
    $steun_cards_group = get_field('steun-ons-cards-content');

    $steun_cards_group_sub1 = $steun_cards_group['steun-ons-card1-group'];
    $steun_cards_group_sub2 = $steun_cards_group['steun-ons-card2-group'];
    $steun_cards_group_sub3 = $steun_cards_group['steun-ons-card3-group'];
    
    $steun_card1_link1 = $steun_cards_group_sub1['steun-ons-card-link1'];
    $steun_card1_link2 = $steun_cards_group_sub1['steun-ons-card-link2'];

    $steun_card2_link = $steun_cards_group_sub2['steun-ons-card-link3'];
    $steun_card3_link = $steun_cards_group_sub3['steun-ons-card-link4'];    
?>

<section class="section-spacing section-cards fixed-width steun">
    <div class="title">
        <?php echo wp_kses_post($steun_cards_group['steun-ons-intro-text']); ?>
    </div>
    <div class="cards-wrapper">
        <div class="card 1">
            <div class="image-wrapper">
                <img src="<?php echo esc_url($steun_cards_group_sub1['steun-ons-card-img1']); ?>" class="card-image" alt="<?php echo esc_attr($steun_cards_group_sub1['steun-ons-img-alt1']); ?>">
            </div>
            <div class="content">
                <div class="card-text">
                    <?php echo wp_kses_post($steun_cards_group_sub1['steun-ons-card-text1']); ?>
                </div>
                <div class="card-footer">
                    <?php
                        $steun_card_content = get_field('steun-ons-cards-content');
                        $steun_card_media_content = $steun_card_content['steun-ons-card1-group'];

                        // Controleer de waarde van de radio button
                        $radio_value = $steun_card_media_content['steun-ons-card-radio']; // Haal de waarde van de radio button op

                        if ($radio_value == 'knop') {
                            $link = $steun_card_media_content['steun-ons-card-radio-link'];
                            echo '<a class="btn" href="' . esc_url($link['url']) . '">' . esc_html($link['title']) . '</a>';
                        } elseif ($radio_value == 'icoon') {
                            $steun_repeater = $steun_card_media_content['steun-ons-card-repeater'];

                            if (!empty($steun_repeater)): // Check if the repeater field has rows
                                foreach ($steun_repeater as $row): // Loop through the repeater field
                                    $steun_ons_icoon = $row['steun-ons-card-icon'];
                                    $steun_ons_social_link = $row['steun-ons-card-icon-link'];

                                    // Check if the social link URL is set and not empty
                                    if (!empty($steun_ons_social_link['url'])):
                                        echo '<div class="button-wrapper no-padding">';
                                            echo '<a class="social-link" href="' . esc_url($steun_ons_social_link['url']) . '">' . wp_kses_post($steun_ons_icoon) . '</a>';
                                        echo '</div>';
                                    endif;
                                endforeach;
                            endif;
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="card 2">
            <div class="image-wrapper">
                <img src="<?php echo esc_url($steun_cards_group_sub2['steun-ons-card-img2']); ?>" class="card-image" alt="<?php echo esc_attr($steun_cards_group_sub2['steun-ons-img-alt2']); ?>">
            </div>
            <div class="content">
                <div class="card-text">
                    <?php echo wp_kses_post($steun_cards_group_sub2['steun-ons-card-text2']); ?>
                </div>
                <div class="card-footer">
                <?php if ($steun_card2_link['url']) : ?>
                    <a class="btn" href="<?php echo esc_url($steun_card2_link['url']); ?>"><?php echo esc_attr($steun_card2_link['title']); ?></a>
                <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="card 3">
            <div class="image-wrapper">
                <img src="<?php echo esc_url($steun_cards_group_sub3['steun-ons-card-img3']); ?>" class="card-image" alt="<?php echo esc_attr($steun_cards_group_sub3['steun-ons-img-alt3']); ?>">
            </div>
            <div class="content">
                <div class="card-text">
                    <?php echo wp_kses_post($steun_cards_group_sub3['steun-ons-card-text3']); ?>
                </div>
                <div class="card-footer">
                <?php if ($steun_card3_link['url']) : ?>
                    <a class="btn" href="<?php echo esc_url($steun_card3_link['url']); ?>"><?php echo esc_attr($steun_card3_link['title']); ?></a>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>