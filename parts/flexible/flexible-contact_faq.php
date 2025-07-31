<?php
/**
 * Contact FAQ Section Template
 */

// Get section fields
$tag = get_sub_field('tag');
$title = get_sub_field('title');
$faq_items = get_sub_field('faq_items');
?>

<section class="contact-faq">
    <div class="container">
        <div class="contact-faq__header">
            <?php if ($tag) : ?>
                <div class="contact-faq__tag">
                    <span class="contact-faq__tag-text"><?php echo esc_html($tag); ?></span>
                </div>
            <?php endif; ?>

            <?php if ($title) : ?>
                <h2 class="contact-faq__title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
        </div>

        <?php if ($faq_items && is_array($faq_items)) : ?>
            <div class="contact-faq__content">
                <div class="faq-list">
                    <?php foreach ($faq_items as $index => $item) :
                        $is_first = ($index === 0);
                        ?>
                        <div class="faq-list__item <?php echo $is_first ? 'active' : ''; ?>">
                            <div class="faq-list__question">
                                <?php echo esc_html($item['question']); ?>
                            </div>
                            <div class="faq-list__answer" <?php echo $is_first ? '' : 'style="display: none;"'; ?>>
                                <?php echo $item['answer']; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>