<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

// Debugging statements
error_log('Attributes: ' . print_r($attributes, true));

$wrapper_attributes = get_block_wrapper_attributes();
$question = isset($attributes['question']) ? $attributes['question'] : '';
$answer = isset($attributes['answer']) ? $attributes['answer'] : '';
?>
<div <?php echo $wrapper_attributes; ?>>
    <h4 class="faq-question" onclick="this.nextElementSibling.classList.toggle('open');">
        <?php echo wp_kses_post($question); ?>
    </h4>
    <div class="faq-paragraph">
        <p><?php echo wp_kses_post($answer); ?></p>
    </div>
</div>
