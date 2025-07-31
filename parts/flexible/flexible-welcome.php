<?php
$video_or_image = get_sub_field('media');
$image = get_sub_field('image');
$module_class = get_sub_field('module_class');
$module_id = get_sub_field('module_id');
$background_graphic = get_sub_field('background_graphic');
$background_color = get_sub_field('background_color');
$title = get_sub_field('title');
$text = get_sub_field('text');
$side = get_sub_field('side');
?>
<div class="container-fluid background--<?= strtolower($background_color) ?> <?= $module_class ?>"
     id="<?= $module_id ?>">
    <div class="container">
        <div class="row welcome__container <?php echo $side ? 'd-flex flex-row-reverse' : '' ?>">
            <?php if (!empty($video_or_image)): ?>
                <div class="welcome__media col-md-12 col-lg-12 col-xl-7 col-xxxl-8">
                    <div class="welcome__video"
                         data-ratio="<?php echo esc_attr(get_post_meta(get_the_ID(), 'video_aspect_ratio', true)) ?: '16:9'; ?>">
                        <?php
                        $bg_video_url = get_sub_field('video');
                        $allowed_video_format = array(
                            'webm' => 'video/webm',
                            'mp4' => 'video/mp4',
                            'ogv' => 'video/ogg',
                        );
                        $file_info = wp_check_filetype($bg_video_url, $allowed_video_format);
                        if ($file_info['ext']): ?>
                            <div class="video video--local embed-responsive embed-responsive-16by9"
                                 style="pointer-events: auto;cursor: alias">
                                <video src="<?php echo esc_url($bg_video_url); ?>" autoplay preload="none" muted="muted"
                                       loop="loop"></video>
                            </div>
                        <?php elseif (strpos($bg_video_url, 'youtube.com') !== false || strpos($bg_video_url, 'youtu.be') !== false): ?>
                            <div class="video video--embed embed-responsive embed-responsive-16by9"
                                 style="pointer-events: auto; cursor: alias">
                                <?php
                                $video_id = '';
                                if (strpos($bg_video_url, 'youtube.com') !== false) {
                                    $query_string = parse_url($bg_video_url, PHP_URL_QUERY);
                                    parse_str($query_string, $params);
                                    if (isset($params['v'])) {
                                        $video_id = $params['v'];
                                    }
                                } elseif (strpos($bg_video_url, 'youtu.be') !== false) {
                                    $video_id = end(explode('/', parse_url($bg_video_url, PHP_URL_PATH)));
                                }

                                $youtube_embed_url = 'https://www.youtube.com/embed/' . esc_attr($video_id) . '?feature=oembed&    loop=1&playlist=' . esc_attr($video_id);
                                echo '<iframe src="' . esc_url($youtube_embed_url) . '" frameborder="0" allowfullscreen></iframe>';
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="welcome__media col-md-12 col-lg-12 col-xl-7 col-xxxl-8">
                    <?php if (!empty($image)): ?>
                        <div class="welcome__image">
                            <?php echo wp_get_attachment_image($image['ID'], 'full_hd', false, array('class' => 'ups-img__image')); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>


            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-5 col-xxxl-4">
                <div class="welcome__container-text">
                    <div class="welcome__background-image <?php echo !$side ? 'welcome__background-image-left' : '' ?>">
                        <?php echo wp_get_attachment_image($background_graphic['ID'], 'full_hd', false, array('class' => 'ups-img__image')); ?>
                    </div>
                    <?php if ($text || $title): ?>
                        <div class="welcome__wrapper">
                            <h2><?= $title; ?></h2>
                            <div class="welcome__wrapper-text">
                                <?= $text; ?>
                            </div>
                            <?php if ($link = get_sub_field('link')) :
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>
                                <a class="welcome__wrapper-link" href="<?php echo esc_url($link_url); ?>"
                                   target="<?php echo esc_attr($link_target); ?>"><?php echo $link_title; ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>