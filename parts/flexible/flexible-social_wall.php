<?php
$background_icon = get_sub_field('background_icon ');
$content = get_sub_field('content');
?>

<?php if($content):?>
    <div class="container-fluid <?php bg($background_icon, 'full_hd')?>">
        <div class="container">
            <div class="row social__container">
                <?php echo $content; ?>
            </div>
        </div>
    </div>
<?php endif;?>

