<?php
$content = get_field('content');

$media_reviews_section = null;
if ($content && is_array($content)) {
    foreach ($content as $section) {
        if (isset($section['acf_fc_layout']) && $section['acf_fc_layout'] === 'media_reviews') {
            $media_reviews_section = $section;
            break;
        }
    }
}

if ($media_reviews_section) {
    $media_reviews_tag = $media_reviews_section['media_reviews_tag'] ?? 'Відео та фото відгуки';
    $media_reviews_title = $media_reviews_section['media_reviews_title'] ?? 'Реальні історії, реальні результати';
    $media_reviews_gallery = $media_reviews_section['media_reviews_gallery'] ?? [];
} else {
    $media_reviews_tag = 'Відео та фото відгуки';
    $media_reviews_title = 'Реальні історії, реальні результати';
    $media_reviews_gallery = [];
}
?>

<section class="media-reviews">
    <div class="container">
        <div class="media-reviews__text">
            <div class="media-reviews__tag"><?php echo esc_html($media_reviews_tag); ?></div>
            <h3 class="media-reviews__title"><?php echo esc_html($media_reviews_title); ?></h3>
        </div>

        <?php if (!empty($media_reviews_gallery) && is_array($media_reviews_gallery)) : ?>
            <div class="media-reviews__gallery">
                <?php foreach ($media_reviews_gallery as $item) :
                    $type = isset($item['type']) ? $item['type'] : 'image';
                    $is_video = ($type === 'video');

                    $thumbnail = '';
                    $video_url = '';
                    $alt_text = '';
                    
                    // Handle thumbnail (for both images and videos)
                    if (isset($item['thumbnail'])) {
                        if (is_array($item['thumbnail']) && isset($item['thumbnail']['url'])) {
                            $thumbnail = $item['thumbnail']['url'];
                            $alt_text = $item['thumbnail']['alt'] ?? 'Review media';
                        } elseif (is_numeric($item['thumbnail'])) {
                            $thumbnail = wp_get_attachment_url($item['thumbnail']);
                            $alt_text = get_post_meta($item['thumbnail'], '_wp_attachment_image_alt', true) ?: 'Review media';
                        } else {
                            $thumbnail = $item['thumbnail'];
                            $alt_text = 'Review media';
                        }
                    }
                    
                    // Handle video URL
                    if ($is_video && isset($item['video'])) {
                        if (is_array($item['video']) && isset($item['video']['url'])) {
                            $video_url = $item['video']['url'];
                        } elseif (is_numeric($item['video'])) {
                            $video_url = wp_get_attachment_url($item['video']);
                        } else {
                            $video_url = $item['video'];
                        }
                        
                        // For videos without thumbnail, use a default video thumbnail
                        if (empty($thumbnail)) {
                            $thumbnail = get_template_directory_uri() . '/assets/images/placeholder.jpg';
                            $alt_text = 'Video thumbnail';
                        }
                    }

                    $fancybox_url = $is_video && !empty($video_url) ? $video_url : $thumbnail;
                    $fancybox_type = $is_video ? 'video' : 'image';

                    // Skip if no thumbnail (for images) or no video URL (for videos)
                    if (empty($thumbnail) || ($is_video && empty($video_url))) continue;
                    ?>
                    <div class="media-reviews__item">
                        <a href="<?php echo esc_url($fancybox_url); ?>"
                           class="media-reviews__link <?php echo $is_video ? 'media-reviews__link--video' : ''; ?>"
                           data-fancybox="media-reviews"
                           data-type="<?php echo $fancybox_type; ?>"
                           <?php if ($is_video): ?>
                           data-width="800"
                           data-height="600"
                           <?php endif; ?>>
                            <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($alt_text); ?>" class="media-reviews__image">
                            <?php if ($is_video) : ?>
                                <div class="media-reviews__play-icon">
                                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="24" cy="24" r="24" fill="white" fill-opacity="0.8"/>
                                        <path d="M32 24L20 31.4641L20 16.5359L32 24Z" fill="#FF7B00"/>
                                    </svg>
                                </div>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section> 
