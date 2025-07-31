<?php
$module_id = get_sub_field('module_id');
$module_class = get_sub_field('module_class');
$image = get_sub_field('image');
$size = get_sub_field('size');
$video = get_sub_field('video');
$media = get_sub_field('media');
$text = get_sub_field('full_text_editor');
$side = get_sub_field('side');

$media = $media ? 'video' : 'image';
$image_size = !$size ? 'fit' : 'full';
$text_background = !$size ? 'text-bg' : '';
$text_wrapper = !$size ? 'text-wrapper' : '';
?>

<section class="position-relative text-img-video <?= $module_class ?>" id="<?= $module_id ?>">
    <div class="<?php echo !$size ? '' : 'container location-container'; ?>">
        <div class="d-flex align-items-center <?php echo !$size ? 'contain-text' : 'py-5'; ?> <?php echo $side ? 'content__wrapper--reverse' : ''; ?> content__wrapper">

            <div class="col-12 col-md-6 text-img-video__text">
                <?php if ($text) :
                    echo $text;
                endif ?>
            </div>

            <div class="col-12 col-md-6 text-img-video__img-video-wrapper d-flex <?php echo !$side ? 'justify-content-end' : 'justify-content-start'; ?>">
                <div class="text-img-video__img-video">
                    <?php if ($media === 'video') { ?>
                        <div class="text-img-video__video-wrapper">
                            <?php
                            $allowed_video_format = array(
                                'webm' => 'video/webm',
                                'mp4' => 'video/mp4',
                                'ogv' => 'video/ogg',
                            );
                            $file_info            = wp_check_filetype( $video, $allowed_video_format );
                            if ( $file_info['ext'] ): ?>
                                <video src="<?php echo $video; ?>" autoplay preload="none" muted="muted" loop="loop" class="video video--local"></video>
                            <?php elseif ( is_embed_video( $video ) ): ?>

                                <?php echo wp_oembed_get( $video ); ?>

                            <?php endif; ?>
                        </div>
                    <?php } else { ?>
                        <?php if ($image) { ?>
                            <div class="text-img-video__image-wrapper">
                                <?php echo wp_get_attachment_image($image['id'], 'full'); ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>
</section>
