<?php
$content = get_field('content');
$content_parts = get_extended($content);
$post_id = get_the_ID();
$has_extended_content = strpos($content, '<!--more-->') !== false;
$author = get_field('author');

if ($has_extended_content) {
    $content_parts = explode('<!--more-->', $content);
    $main_content = $content_parts[0];
    $extended_content = $content_parts[1];
} else {
    $main_content = $content;
    $extended_content = '';
} ?>

<article id="post-<?php echo $post_id ?>" class='reviews__post-item'>
    <div class='post_container'>
        <div aria-expanded="false">
            <?php echo $main_content; ?>
        </div>
        <?php if ($has_extended_content) : ?>
            <div class="extended-content" id="extended-content-<?php echo $post_id; ?>" style="display: none;">
                <?php echo $extended_content; ?>
                <div class="reviews__post-author"><?php echo $author; ?></div>
            </div>
            <button class="toggle-extended-content reviews__button reviews__button--plus" id="toggle-button-<?php echo $post_id; ?>" data-target="#extended-content-<?php echo $post_id; ?>"></button>
        <?php endif; ?>
        <?php if (!$has_extended_content) { ?>
            <div class="reviews__post-author"><?php echo $author; ?></div>
        <?php } ?>
    </div>
</article>
