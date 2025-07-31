<?php
/**
 * Statistics Section
 */
$section_title = get_sub_field('section_title');
$statistics_items = get_sub_field('statistics_items');
?>

<section class="statistics">
    <div class="container">
        <?php if ($section_title): ?>
            <?php echo wp_kses_post($section_title); ?>
        <?php endif; ?>

        <?php if ($statistics_items && count($statistics_items) > 0): ?>
            <div class="statistics__cards">
                <?php
                $items_count = count($statistics_items);
                $rows = [];
                $current_row = [];
                $row_index = 0;

                foreach ($statistics_items as $index => $item) {
                    $current_row[] = $item;
                    if (($row_index === 0 && count($current_row) === 3) || ($row_index > 0 && count($current_row) === 2)) {
                        $rows[] = $current_row;
                        $current_row = [];
                        $row_index++;
                    }
                }

                if (!empty($current_row)) {
                    $rows[] = $current_row;
                }

                foreach ($rows as $row_index => $row):
                    ?>
                    <div class="statistics__row">
                        <?php foreach ($row as $item): ?>
                            <div class="statistics__card <?php echo $row_index > 0 ? 'statistics__card--wide' : ''; ?>">
                                <div class="statistics__number"><?php echo esc_html($item['number']); ?></div>
                                <div class="statistics__description"><?php echo esc_html($item['text']); ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>