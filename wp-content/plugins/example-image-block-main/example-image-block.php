<?php
/**
 * Plugin Name:       Double Image Slider
 * Description:       Double Image Slider
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Brian Coords & Alowa Studio
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       double-image
 *
 * @package           wpdev
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function wpdev_double_image_block_init() {
	register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'wpdev_double_image_block_init' );
