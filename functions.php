<?php
 
// adding the CSS and JS files
 
function kunstinc_setup(){
    wp_enqueue_style('style', get_stylesheet_uri(), NULL, microtime(), 'all');
    wp_enqueue_script("leaflet-map", get_theme_file_uri('/assets/js/leaflet-map.js'), NULL, microtime(), true);
    wp_enqueue_script('font-awesome', 'https://kit.fontawesome.com/a6e62f9472.js', NULL, microtime(), true);
	wp_enqueue_script('lenis', 'https://cdn.jsdelivr.net/gh/studio-freight/lenis@1.0.19/bundled/lenis.min.js', NULL, microtime(), true);
	wp_enqueue_script('scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', NULL, microtime(), true);
	wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js', NULL, microtime(), true);
	wp_enqueue_script('gsap-min', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', NULL, microtime(), true);

	// Localize the script with the kunstwerken data
    $kunstwerken_data = array();
    $uitgelichten_events = array();

    $args = array(
        'post_type' => 'kunstwerken',
        'posts_per_page' => -1,
    );
    $kunstwerken_query = new WP_Query($args);

    if ($kunstwerken_query->have_posts()):
        while ($kunstwerken_query->have_posts()): $kunstwerken_query->the_post();
            $latitude = get_field('kunstwerk_latitude');
            $longitude = get_field('kunstwerk_longitude');
			$image = get_field('map_afbeelding_kunstwerk');
			$knop_detail = get_field('map_knop_detailpagina');
			$knop_route = get_field('map_knop_route');
			$description = get_field('map-omschrijving');
            $title = get_the_title();
            $excerpt = get_the_excerpt();
            if ($latitude && $longitude) {
                $kunstwerken_data[] = array(
                    'lat' => $latitude,
                    'lng' => $longitude,
                    'title' => $title,
                    'excerpt' => $excerpt,
					'image' => $image,
					'knop_detail' => $knop_detail['url'],
					'knop_route' => $knop_route,
					'description' => $description,
                );
            }
        endwhile;
        wp_reset_postdata();
    endif;

    $args2 = array(
        'post_type' => 'evenementen',
        'posts_per_page' => -1,
    );
    $uitgelichten_query = new WP_Query($args2);

    if ($uitgelichten_query->have_posts()):
        while ($uitgelichten_query->have_posts()): $uitgelichten_query->the_post();
        $event_date_group = get_field('single-event-datetime-group'); // Group field
        $event_date = $event_date_group['single-event-date']; // Title field
            if ($event_date) {
                $uitgelichten_events[] = array(
                    'date' => $event_date,
                );
            }
        endwhile;
        wp_reset_postdata();
    endif;

    wp_localize_script('leaflet-map', 'kunstwerkenData', $kunstwerken_data);
    wp_localize_script('leaflet-map', 'uitgelichtDate', $uitgelichten_events);
}
add_action('wp_enqueue_scripts', 'kunstinc_setup');

function create_custom_post_types() {
    // Register Kunstwerken CPT
    $labels_kunstwerken = array(
        'name'                  => _x('Kunstwerken', 'Post Type General Name', 'textdomain'),
        'singular_name'         => _x('Kunstwerk', 'Post Type Singular Name', 'textdomain'),
        'menu_name'             => __('Kunstwerken', 'textdomain'),
        'name_admin_bar'        => __('Kunstwerk', 'textdomain'),
        'archives'              => __('Kunstwerk archieven', 'textdomain'),
        'attributes'            => __('Kunstwerk attributen', 'textdomain'),
        'parent_item_colon'     => __('Bovenliggend kunstwerk:', 'textdomain'),
        'all_items'             => __('Alle kunstwerken', 'textdomain'),
        'add_new_item'          => __('Nieuw kunstwerk toevoegen', 'textdomain'),
        'add_new'               => __('Nieuw kunstwerk', 'textdomain'),
        'new_item'              => __('Nieuw kunstwerk', 'textdomain'),
        'edit_item'             => __('Kunstwerk bewerken', 'textdomain'),
        'update_item'           => __('Kunstwerk bijwerken', 'textdomain'),
        'view_item'             => __('Kunstwerk bekijken', 'textdomain'),
        'view_items'            => __('Kunstwerken bekijken', 'textdomain'),
        'search_items'          => __('Zoek kunstwerk', 'textdomain'),
        'not_found'             => __('Niet gevonden', 'textdomain'),
        'not_found_in_trash'    => __('Niet gevonden in prullenbak', 'textdomain'),
        'featured_image'        => __('Uitgelichte afbeelding', 'textdomain'),
        'set_featured_image'    => __('Stel uitgelichte afbeelding in', 'textdomain'),
        'remove_featured_image' => __('Verwijder uitgelichte afbeelding', 'textdomain'),
        'use_featured_image'    => __('Gebruik als uitgelichte afbeelding', 'textdomain'),
        'insert_into_item'      => __('Invoegen in kunstwerk', 'textdomain'),
        'uploaded_to_this_item' => __('Geüpload naar dit kunstwerk', 'textdomain'),
        'items_list'            => __('Kunstwerken lijst', 'textdomain'),
        'items_list_navigation' => __('Navigatie kunstwerken lijst', 'textdomain'),
        'filter_items_list'     => __('Filter kunstwerken lijst', 'textdomain'),
    );
    
    $args_kunstwerken = array(
        'label'                 => __('Kunstwerk', 'textdomain'),
        'labels'                => $labels_kunstwerken,
        'supports'              => array('title', 'editor', 'custom-fields'),
        'taxonomies'            => array('category', 'post_tag'),
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-format-image',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,        
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true, // Enable Gutenberg editor
    );
    
    register_post_type('kunstwerken', $args_kunstwerken);

    // Register Jaaropgaves CPT
    $labels_jaaropgaves = array(
        'name'                  => _x('Jaaropgaven', 'Post Type General Name', 'textdomain'),
        'singular_name'         => _x('Jaaropgave', 'Post Type Singular Name', 'textdomain'),
        'menu_name'             => __('Jaaropgaven', 'textdomain'),
        'name_admin_bar'        => __('Jaaropgave', 'textdomain'),
        'archives'              => __('Jaaropgave archieven', 'textdomain'),
        'attributes'            => __('Jaaropgave attributen', 'textdomain'),
        'parent_item_colon'     => __('Bovenliggend jaaropgave:', 'textdomain'),
        'all_items'             => __('Alle jaaropgaven', 'textdomain'),
        'add_new_item'          => __('Nieuwe jaaropgave toevoegen', 'textdomain'),
        'add_new'               => __('Nieuwe jaaropgave', 'textdomain'),
        'new_item'              => __('Nieuwe jaaropgave', 'textdomain'),
        'edit_item'             => __('Jaaropgave bewerken', 'textdomain'),
        'update_item'           => __('Jaaropgave bijwerken', 'textdomain'),
        'view_item'             => __('Jaaropgave bekijken', 'textdomain'),
        'view_items'            => __('Jaaropgaven bekijken', 'textdomain'),
        'search_items'          => __('Zoek jaaropgave', 'textdomain'),
        'not_found'             => __('Niet gevonden', 'textdomain'),
        'not_found_in_trash'    => __('Niet gevonden in prullenbak', 'textdomain'),
        'featured_image'        => __('Uitgelichte afbeelding', 'textdomain'),
        'set_featured_image'    => __('Stel uitgelichte afbeelding in', 'textdomain'),
        'remove_featured_image' => __('Verwijder uitgelichte afbeelding', 'textdomain'),
        'use_featured_image'    => __('Gebruik als uitgelichte afbeelding', 'textdomain'),
        'insert_into_item'      => __('Invoegen in jaaropgave', 'textdomain'),
        'uploaded_to_this_item' => __('Geüpload naar deze jaaropgave', 'textdomain'),
        'items_list'            => __('Jaaropgaven lijst', 'textdomain'),
        'items_list_navigation' => __('Navigatie jaaropgaven lijst', 'textdomain'),
        'filter_items_list'     => __('Filter jaaropgaven lijst', 'textdomain'),
    );
    
    $args_jaaropgaves = array(
        'label'                 => __('Jaaropgave', 'textdomain'),
        'labels'                => $labels_jaaropgaves,
        'supports'              => array('title', 'editor', 'custom-fields'),
        'taxonomies'            => array('category', 'post_tag'),
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-text-page',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,        
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true, // Enable Gutenberg editor
    );
    
    register_post_type('jaaropgaves', $args_jaaropgaves);

	// Register Routes CPT
    $labels_routes = array(
        'name'                  => _x('Routes', 'Post Type General Name', 'textdomain'),
        'singular_name'         => _x('Route', 'Post Type Singular Name', 'textdomain'),
        'menu_name'             => __('Routes', 'textdomain'),
        'name_admin_bar'        => __('Route', 'textdomain'),
        'archives'              => __('Route archieven', 'textdomain'),
        'attributes'            => __('Route attributen', 'textdomain'),
        'parent_item_colon'     => __('Bovenliggende route:', 'textdomain'),
        'all_items'             => __('Alle routes', 'textdomain'),
        'add_new_item'          => __('Nieuwe route toevoegen', 'textdomain'),
        'add_new'               => __('Nieuwe route', 'textdomain'),
        'new_item'              => __('Nieuwe route', 'textdomain'),
        'edit_item'             => __('Route bewerken', 'textdomain'),
        'update_item'           => __('Route bijwerken', 'textdomain'),
        'view_item'             => __('Route bekijken', 'textdomain'),
        'view_items'            => __('Routes bekijken', 'textdomain'),
        'search_items'          => __('Zoek route', 'textdomain'),
        'not_found'             => __('Niet gevonden', 'textdomain'),
        'not_found_in_trash'    => __('Niet gevonden in prullenbak', 'textdomain'),
        'featured_image'        => __('Uitgelichte afbeelding', 'textdomain'),
        'set_featured_image'    => __('Stel uitgelichte afbeelding in', 'textdomain'),
        'remove_featured_image' => __('Verwijder uitgelichte afbeelding', 'textdomain'),
        'use_featured_image'    => __('Gebruik als uitgelichte afbeelding', 'textdomain'),
        'insert_into_item'      => __('Invoegen in route', 'textdomain'),
        'uploaded_to_this_item' => __('Geüpload naar deze route', 'textdomain'),
        'items_list'            => __('Routes lijst', 'textdomain'),
        'items_list_navigation' => __('Navigatie routes lijst', 'textdomain'),
        'filter_items_list'     => __('Filter routes lijst', 'textdomain'),
    );
    
    $args_routes = array(
        'label'                 => __('Route', 'textdomain'),
        'labels'                => $labels_routes,
        'supports'              => array('title', 'editor', 'custom-fields'),
        'taxonomies'            => array('category', 'post_tag'),
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-location',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,        
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true, // Enable Gutenberg editor
    );
    
    register_post_type('routes', $args_routes);

    // Register Evenementen CPT
    $labels_evenementen = array(
        'name'                  => _x('Agenda', 'Post Type General Name', 'textdomain'),
        'singular_name'         => _x('Agenda', 'Post Type Singular Name', 'textdomain'),
        'menu_name'             => __('Agenda', 'textdomain'),
        'name_admin_bar'        => __('Agenda', 'textdomain'),
        'archives'              => __('Agenda archieven', 'textdomain'),
        'attributes'            => __('Agenda attributen', 'textdomain'),
        'parent_item_colon'     => __('Bovenliggend Agenda:', 'textdomain'),
        'all_items'             => __('Alle Agenda', 'textdomain'),
        'add_new_item'          => __('Nieuw agenda-item toevoegen', 'textdomain'),
        'add_new'               => __('Nieuw agenda-item', 'textdomain'),
        'new_item'              => __('Nieuw agenda-item', 'textdomain'),
        'edit_item'             => __('agenda-item bewerken', 'textdomain'),
        'update_item'           => __('agenda-item bijwerken', 'textdomain'),
        'view_item'             => __('agenda-item bekijken', 'textdomain'),
        'view_items'            => __('agenda bekijken', 'textdomain'),
        'search_items'          => __('Zoek agenda-item', 'textdomain'),
        'not_found'             => __('Niet gevonden', 'textdomain'),
        'not_found_in_trash'    => __('Niet gevonden in prullenbak', 'textdomain'),
        'featured_image'        => __('Uitgelichte afbeelding', 'textdomain'),
        'set_featured_image'    => __('Stel uitgelichte afbeelding in', 'textdomain'),
        'remove_featured_image' => __('Verwijder uitgelichte afbeelding', 'textdomain'),
        'use_featured_image'    => __('Gebruik als uitgelichte afbeelding', 'textdomain'),
        'insert_into_item'      => __('Invoegen in agenda-item', 'textdomain'),
        'uploaded_to_this_item' => __('Geüpload naar dit agenda-item', 'textdomain'),
        'items_list'            => __('Agenda lijst', 'textdomain'),
        'items_list_navigation' => __('Navigatie agenda lijst', 'textdomain'),
        'filter_items_list'     => __('Filter agenda lijst', 'textdomain'),
    );
    
    $args_evenementen = array(
        'label'                 => __('Agenda', 'textdomain'),
        'labels'                => $labels_evenementen,
        'supports'              => array('title', 'editor', 'custom-fields'),
        'taxonomies'            => array('category', 'post_tag'),
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-calendar-alt',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,        
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true, // Enable Gutenberg editor
    );
    
    register_post_type('evenementen', $args_evenementen);
}
add_action('init', 'create_custom_post_types', 0);

function my_custom_footer_widgets() {
  register_sidebar( array(
      'name'          => __( 'Pre-Footer Widget Area', 'your-theme-textdomain' ),
      'id'            => 'prefooter-1',
      'description'   => __( 'Widgets in this area will be shown above the footer.', 'your-theme-textdomain' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
  ) );

  register_sidebar( array(
      'name'          => __( 'Footer Widget Area', 'your-theme-textdomain' ),
      'id'            => 'footer-1',
      'description'   => __( 'Widgets in this area will be shown in the footer.', 'your-theme-textdomain' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4 class="widget-title">',
      'after_title'   => '</h4>',
  ) );

  register_sidebar( array(
      'name'          => __( 'Footer Image Area', 'your-theme-textdomain' ),
      'id'            => 'footer-image',
      'description'   => __( 'Widget area for footer image.', 'your-theme-textdomain' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4 class="widget-title">',
      'after_title'   => '</h4>',
  ) );
}
add_action( 'widgets_init', 'my_custom_footer_widgets' );

add_filter( 'use_widgets_block_editor', '__return_false' );

// Adding theme Support
 
function kunstinc_init() {
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5',
        array('comment-list', 'comment-form', 'search-form')
    );
}
 
add_action('after_setup_theme', 'kunstinc_init');
 
function register_my_menus() {
    register_nav_menus(
      array(
        'header-menu' => __( 'Header Menu' ),
        'extra-menu' => __( 'Extra Menu' )
       )
     );
   }
add_action( 'init', 'register_my_menus' );

// add_filter( 'show_admin_bar', '__return_true' );

function disable_admin_bar() {
	if (current_user_can('administrator') || current_user_can('contributor') ) {
	  // user can view admin bar
	  show_admin_bar(true); // this line isn't essentially needed by default...
	} else {
	  // hide admin bar
	  show_admin_bar(false);
	}
 }
 add_action('after_setup_theme', 'disable_admin_bar');


// Hier moet je wijzigen 

add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group_665860557af35',
	'title' => 'homepage',
	'fields' => array(
		array(
			'key' => 'field_6658605558b6a',
			'label' => 'test',
			'name' => 'test',
			'aria-label' => '',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
			'delay' => 0,
		),
		array(
			'key' => 'field_6658a31d49fa3',
			'label' => 'afbeelding test',
			'name' => '',
			'aria-label' => '',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 1,
			'selected' => 0,
		),
		array(
			'key' => 'field_6658a25bc7d87',
			'label' => 'selecteer achtergrond',
			'name' => 'selecteer_achtergrond',
			'aria-label' => '',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'castricum-aan-zee' => 'Castricum aan Zee',
				'akkersloot' => 'Akkersloot',
				'bakkum' => 'Bakkum',
			),
			'default_value' => '',
			'return_format' => 'value',
			'allow_null' => 0,
			'other_choice' => 0,
			'layout' => 'vertical',
			'save_other_choice' => 0,
		),
		array(
			'key' => 'field_6658a2e936c9e',
			'label' => 'test 2',
			'name' => 'test_2',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_6658a3ba7d2a7',
			'label' => 'afbeelding test',
			'name' => 'afbeelding_test',
			'aria-label' => '',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'url',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
			'preview_size' => 'medium',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'page',
				'operator' => '==',
				'value' => '19',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
) );
} );

function remove_media_button() {
    remove_action('media_buttons', 'media_buttons');
}
add_action('admin_head', 'remove_media_button');

function disable_content_editor() {
    // Controleer of we in de admin zijn en bewerkingsrechten hebben
    if (is_admin()) {
        // Huidige scherminformatie ophalen
        $screen = get_current_screen();

        // De editor uitschakelen voor alle post types
        remove_post_type_support($screen->post_type, 'editor');
    }
}
add_action('admin_head', 'disable_content_editor');

// Verwijder 'Berichten' menu item voor alle gebruikers
function remove_posts_menu_item() {
    remove_menu_page( 'edit.php' ); // Dit verwijdert het 'Berichten' menu item
}
add_action( 'admin_menu', 'remove_posts_menu_item' );

function custom_admin_menu_styles() {
    echo '<style>
        #adminmenu #menu-media {
            margin-top: 10px;
        }
    </style>';
}
add_action('admin_print_styles', 'custom_admin_menu_styles');

// Functie om menu rechten aan te passen voor redacteur rol
function modify_menu_for_editor() {
    // Haal de redacteur rol op
    $role = get_role('editor');

    // Voeg toegang toe voor thema-opties
    $role->add_cap('edit_theme_options');
}

// Actie om de functie toe te passen
add_action('admin_init', 'modify_menu_for_editor');
