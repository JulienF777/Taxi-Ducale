<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>


<!-- gives access to interactivity api: data-wp-interactive -->
<div data-wp-interactive="create-block">
<button data-wp-on--click="actions.test">click</button>

<p <?php echo get_block_wrapper_attributes(); ?>>
	<?php esc_html_e( 'Aloha Slider – hello from a dynamic block!', 'aloha-slider' ); ?>
</p>

<?php
$upload_dir = wp_get_upload_dir();
$image_url = $upload_dir['baseurl'] . '/2025/02/titlesoupeAsset-4.svg';
?>
<img src="<?php echo esc_url($image_url); ?>" alt="Aloha Slider" />




</div>
