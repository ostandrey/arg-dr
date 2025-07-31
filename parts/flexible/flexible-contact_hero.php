<?php
/**
 * Contact Hero Section Template
 */

// Get section fields
$title = get_sub_field('title');
$contact_blocks = get_sub_field('contact_blocks');
?>

<section class="contact-hero">
    <div class="container">
        <?php get_template_part('parts/breadcrumbs'); ?>

        <?php if ($title) : ?>
            <h3 class="contact-hero__title"><?php echo esc_html($title); ?></h3>
        <?php endif; ?>

        <?php if ($contact_blocks && is_array($contact_blocks)) : ?>
            <div class="contact-hero__row">
                <?php foreach ($contact_blocks as $block) : ?>
                    <div class="contact-hero__block">
                        <?php if (!empty($block['tag'])) : ?>
                            <div class="contact-hero__tag">
                                <span class="contact-hero__tag-text"><?php echo esc_html($block['tag']); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($block['contact_items'])) : ?>
                            <div class="contact-hero__items">
                                <?php foreach ($block['contact_items'] as $item) : ?>
                                    <div class="contact-hero__item contact-hero__item--<?php echo esc_attr($item['type']); ?>">
                                        <?php
                                        $text = $item['text'];
                                        $type = $item['type'];

                                        switch($type) {
                                            case 'email':
                                                echo '<a href="mailto:' . esc_attr($text) . '" class="contact-link contact-link--email">';
                                                echo esc_html($text);
                                                echo '</a>';
                                                break;

                                            case 'phone':
                                                $phone_clean = preg_replace('/[^+\d]/', '', $text);
                                                echo '<a href="tel:' . esc_attr($phone_clean) . '" class="contact-link contact-link--phone">';
                                                echo esc_html($text);
                                                echo '</a>';
                                                break;

                                            case 'address':
                                                $address_encoded = urlencode($text);
                                                echo '<a href="https://maps.google.com/?q=' . esc_attr($address_encoded) . '" target="_blank" class="contact-link contact-link--address">';
                                                echo esc_html($text);
                                                echo '</a>';
                                                break;

                                            default:
                                                echo '<span class="contact-text">' . esc_html($text) . '</span>';
                                        }
                                        ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>