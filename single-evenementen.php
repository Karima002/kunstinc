<?php
/**
 * Template Name: Evenement detailpagina
 */

get_header();

$single_events_group = get_field('single-event-datetime-group');

// Accessing sub-fields correctly
$single_event_date = $single_events_group['single-event-date'];
$single_event_time = $single_events_group['single-event-time'];
$single_event_location = $single_events_group['single-event-locatie'];

$single_event_columns = get_field('single-event-columns');
$single_event_text = $single_event_columns['single-event-text'];
$single_event_img = $single_event_columns['single-event-image'];
$single_event_alt_text = $single_event_columns['single-event-alt-text'];
$single_event_bron = $single_event_columns['bronvermelding'];
?>

<h1>
<?php the_field('single-event-date'); ?>
</h1>

<section class="section-event-detail section-spacing fixed-width">

<?php
if ( function_exists('yoast_breadcrumb') ) {
  yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
}
?>
    <div class="section-intro">
        <div class="col-left">
            <h1><?php the_field('single-event-title'); ?></h1>
        </div>
        <div class="col-right">
            <p><?php echo esc_html($single_event_date); ?></p>
            <p><?php echo esc_html($single_event_time); ?></p>
            <p><?php echo esc_html($single_event_location); ?></p>
        </div>
    </div>
    <div class="content">
        <div class="col-left">
            <?php echo $single_event_text ?>
        </div>
        <div class="col-right">
            <img src="<?php echo esc_url($single_event_img); ?>" class="card-image" alt="<?php echo esc_attr($single_event_alt_text); ?>">
            <?php if ($single_event_img) : ?>
              <span> <?php echo esc_html($single_event_bron) ?></span>
            <?php endif ?>
        </div>  
    </div>    
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
