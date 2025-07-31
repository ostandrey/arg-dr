<?php
/**
 * Contact About Section Template
 */

// Get section fields
$image = get_sub_field('image');
$description = get_sub_field('description');
?>

<section class="contact-about">
    <div class="container">
        <?php if ($image) : ?>
            <div class="contact-about__image">
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
            </div>
        <?php endif; ?>

        <?php if ($description) : ?>
            <div class="contact-about__description">
                <?php echo $description; ?>
            </div>
        <?php endif; ?>
    </div>
</section>