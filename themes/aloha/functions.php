<?php
// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

  global $wp_version;
  if ( $wp_version !== '4.7.1' ) {
     return $data;
  }

  $filetype = wp_check_filetype( $filename, $mimes );

  return [
      'ext'             => $filetype['ext'],
      'type'            => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];

}, 10, 4 );

function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

function fix_svg() {
  echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action( 'admin_head', 'fix_svg' );


// barba.js enqueue
function alowa_enqueue_scripts() {
  // Charger Barba.js
  wp_enqueue_script('barba', 'https://unpkg.com/@barba/core', array(), null, true);
  // Charger le script personnalisé
  wp_enqueue_script('alowa-transitions', get_stylesheet_directory_uri() . '/assets/js/app.js', array('barba'), null, true);
}
add_action('wp_enqueue_scripts', 'alowa_enqueue_scripts');

// barba.js add body attributes tag info
function alowa_modify_body_tag($buffer) {
  $buffer = str_replace('<body ', '<body data-barba="wrapper" ', $buffer);
  return $buffer;
}
function alowa_start_buffer2() {
  ob_start('alowa_modify_body_tag');
}
function alowa_end_buffer2() {
  ob_end_flush();
}
add_action('template_redirect', 'alowa_start_buffer2');
add_action('shutdown', 'alowa_end_buffer2');

// barba.js add main content tag attributes info
// Ajoute les attributs barba.js à la div wp-site-blocks
function alowa_modify_container_tag($buffer) {
  // Utilisation d'une regex pour trouver la div wp-site-blocks et y ajouter les attributs
  $buffer = preg_replace('/<div class="wp-site-blocks"/', '<div class="wp-site-blocks" data-barba="container" data-barba-namespace="home"', $buffer, 1);
  return $buffer;
}
// Active le buffer pour capturer et modifier le HTML avant affichage
function alowa_start_buffer() {
  ob_start('alowa_modify_container_tag');
}
// Termine le buffer et envoie la page modifiée
function alowa_end_buffer() {
  ob_end_flush();
}
// Hook pour capturer le rendu final avant l'affichage
add_action('template_redirect', 'alowa_start_buffer');
add_action('shutdown', 'alowa_end_buffer');






// The proper way to enqueue GSAP script in WordPress
// wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
function theme_gsap_script(){
    // The core GSAP library
    wp_enqueue_script( 'gsap-js', 'https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js', array(), false, true );
    // ScrollTrigger - with gsap.js passed as a dependency
    wp_enqueue_script( 'gsap-st', 'https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/ScrollTrigger.min.js', array('gsap-js'), false, true );
    // Your animation code file - with gsap.js passed as a dependency
    wp_enqueue_script( 'gsap-js2', get_template_directory_uri() . '/assets/js/app.js', array('gsap-js'), false, true );
    
}
add_action( 'wp_enqueue_scripts', 'theme_gsap_script' );


// Enqueue styles style.css
function aloha_enqueue_styles() {
    wp_enqueue_style('aloha-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'aloha_enqueue_styles');

function aloha_register_blocks() {
    // Debug output
    error_log('Starting FAQ block registration');
    error_log('Theme directory: ' . __DIR__);
    error_log('Block directory exists: ' . (is_dir(__DIR__ . '/blocks/faq-item') ? 'Yes' : 'No'));
    error_log('Block.json exists: ' . (file_exists(__DIR__ . '/blocks/faq-item/block.json') ? 'Yes' : 'No'));
    error_log('Build directory exists: ' . (is_dir(__DIR__ . '/blocks/faq-item/build') ? 'Yes' : 'No'));
    
    // Register the block
    $registered = register_block_type( __DIR__ . '/blocks/faq-item' );
    
  
}
add_action( 'init', 'aloha_register_blocks' );

function aloha_render_faq_item($attributes, $content) {
    return $content;
}

?>