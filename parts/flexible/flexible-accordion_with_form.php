<?php

$module_id = get_sub_field('module_id');
$module_class = get_sub_field('module_class');
$accordion = get_sub_field('accordion');
$form = get_sub_field('form');
?>


<section class="container-fluid py-md-5 contact <?= $module_class ?>" id="<?= $module_id ?>">
    <div class="container">
        <div class="row">
            <?php if ($accordion): ?>
                <div class="col-12 col-lg-8">
                    <div class="accordion" id="accordion-example">
                        <?php for ($i = 0; $i < count($accordion); $i++): ?>
                            <div class="accordion-item">
                                <h5 class="accordion-item__title"
                                    data-toggle="collapse"
                                    data-target="#collapse-<?php echo $i ?>"
                                    aria-expanded="<?php echo $i == 0 ? 'true' : 'false'; ?>"
                                    aria-controls="collapse-<?php echo $i ?>"><?php echo $accordion[$i]["title"]; ?></h5>
                                <div id="collapse-<?php echo $i ?>"
                                     class="accordion-item__body collapse p-2 <?php echo $i == 0 ? 'show' : ''; ?>"
                                     aria-labelledby="heading-<?php echo $i ?>"
                                     data-parent="#accordion-example">
                                    <?php if (is_array($accordion[$i]["content"])): ?>
                                        <?php foreach ($accordion[$i]["content"] as $accordion_content):
                                            $text = $accordion_content['text'];
                                            $location = $accordion_content['location'];
                                            ?>
                                            <div class="col-12 column d-flex justify-content-between py-2 accordion-item__text">
                                                <?php echo $text; ?>
                                                <span class="accordion-item__location"><?php echo $location; ?></span>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (is_array($form)): ?>
                <div class="col-12 col-lg-4 contact__form">
                    <?php echo do_shortcode("[gravityform id='{$form['id']}' title='false' description='false' ajax='true']"); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

