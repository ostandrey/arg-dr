<?php
/**
 * The template for displaying drone archive
 *
 * @package YourTheme
 */

get_header();
?>

    <section class="services">
        <div class="container">
            <!-- Breadcrumbs -->
            <div class="bc">
                <a href="<?php echo home_url(); ?>" class="bc-item">Головна</a>
                <span class="bc-separator">/</span>
                <span class="bc-item">
                <?php echo get_field('archive_page_title', 'option') ?: 'Дрони'; ?>
            </span>
            </div>

            <h1 class="heading">
                <?php echo get_field('archive_page_title', 'option') ?: 'Дрони'; ?>
            </h1>

            <div class="content">
                <!-- Drones by Size -->
                <div class="drones-by-size">
                    <h2 class="section-heading">
                        <?php echo get_field('size_section_title', 'option') ?: 'Дрони за Розмірами'; ?>
                    </h2>

                    <div class="filters-container">
                        <?php
                        // Get all parent terms from Size taxonomy
                        $size_terms = get_terms([
                            'taxonomy' => 'size',
                            'parent' => 0,
                            'hide_empty' => false,
                        ]);

                        if (!empty($size_terms)) {
                            foreach ($size_terms as $size_term) {
                                // Get child terms for each parent
                                $child_terms = get_terms([
                                    'taxonomy' => 'size',
                                    'parent' => $size_term->term_id,
                                    'hide_empty' => false,
                                ]);

                                if (!empty($child_terms)) {
                                    ?>
                                    <div class="filter-group">
                                        <div class="filter-group-title"><?php echo $size_term->name; ?></div>
                                        <div class="filters">
                                            <?php
                                            $first_term = true;
                                            foreach ($child_terms as $child_term) {
                                                $active_class = $first_term ? 'active' : '';
                                                ?>
                                                <button class="filter-button <?php echo $active_class; ?>"
                                                        data-term-id="<?php echo $child_term->term_id; ?>"
                                                        data-parent="size"
                                                        data-parent-id="<?php echo $size_term->term_id; ?>">
                                                    <?php echo $child_term->name; ?>
                                                </button>
                                                <?php
                                                $first_term = false;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>

                    <!-- Drone Display Area -->
                    <div class="drone-display">
                        <div class="drone-image">
                            <!-- Image will be loaded via AJAX -->
                            <div class="drone-image-container"></div>
                            <a href="#" class="drone-link">
                                <div class="drone-link-button">
                                    <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22.32 20.83L35.71 34.22M35.71 20.83V34.22H22.32" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </a>
                        </div>

                        <div class="drone-specs">
                            <!-- Specs will be loaded via AJAX -->
                        </div>
                    </div>
                </div>

                <!-- Drones by Task Type -->
                <div class="drones-by-task">
                    <h2 class="section-heading">
                        <?php echo get_field('task_section_title', 'option') ?: 'Дрони за Типом Завдань'; ?>
                    </h2>

                    <div class="filters-container">
                        <?php
                        // Get all terms from Task Type taxonomy
                        $task_terms = get_terms([
                            'taxonomy' => 'task_type',
                            'hide_empty' => false,
                        ]);

                        if (!empty($task_terms)) {
                            foreach ($task_terms as $index => $task_term) {
                                // Get drones for this task type
                                $drones = get_posts([
                                    'post_type' => 'drone',
                                    'numberposts' => -1,
                                    'tax_query' => [
                                        [
                                            'taxonomy' => 'task_type',
                                            'field' => 'term_id',
                                            'terms' => $task_term->term_id,
                                        ]
                                    ]
                                ]);

                                if (!empty($drones)) {
                                    ?>
                                    <div class="filter-group">
                                        <div class="filter-group-title"><?php echo $task_term->name; ?></div>
                                        <div class="filters">
                                            <?php
                                            $first_drone = true;
                                            foreach ($drones as $drone) {
                                                $active_class = $first_drone ? 'active' : '';
                                                ?>
                                                <button class="filter-button <?php echo $active_class; ?>"
                                                        data-post-id="<?php echo $drone->ID; ?>"
                                                        data-parent="task"
                                                        data-parent-id="<?php echo $task_term->term_id; ?>">
                                                    <?php echo $drone->post_title; ?>
                                                </button>
                                                <?php
                                                $first_drone = false;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>

                    <!-- Drone Display Area -->
                    <div class="drone-display">
                        <div class="drone-image">
                            <!-- Image will be loaded via AJAX -->
                            <div class="drone-image-container"></div>
                            <a href="#" class="drone-link">
                                <div class="drone-link-button">
                                    <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22.32 20.83L35.71 34.22M35.71 20.83V34.22H22.32" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </a>
                        </div>

                        <div class="drone-specs">
                            <!-- Specs will be loaded via AJAX -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        jQuery(document).ready(function($) {
            // Initial load of the first drone in each section
            loadInitialDrones();

            // Handle filter button clicks
            $('.filter-button').on('click', function() {
                const $this = $(this);
                const parent = $this.data('parent');
                const parentId = $this.data('parent-id');

                // Remove active class from siblings
                $this.siblings().removeClass('active');
                // Add active class to clicked button
                $this.addClass('active');

                if (parent === 'size') {
                    const termId = $this.data('term-id');
                    loadDroneByTerm(termId, parentId);
                } else if (parent === 'task') {
                    const postId = $this.data('post-id');
                    loadDroneById(postId, parentId);
                }
            });

            function loadInitialDrones() {
                // Load first drone for each size category
                $('.drones-by-size .filter-group').each(function() {
                    const $firstButton = $(this).find('.filter-button.active');
                    if ($firstButton.length) {
                        const termId = $firstButton.data('term-id');
                        const parentId = $firstButton.data('parent-id');
                        loadDroneByTerm(termId, parentId);
                    }
                });

                // Load first drone for each task category
                $('.drones-by-task .filter-group').each(function() {
                    const $firstButton = $(this).find('.filter-button.active');
                    if ($firstButton.length) {
                        const postId = $firstButton.data('post-id');
                        const parentId = $firstButton.data('parent-id');
                        loadDroneById(postId, parentId);
                    }
                });
            }

            function loadDroneByTerm(termId, parentId) {
                $.ajax({
                    url: drone_ajax.url,
                    type: 'POST',
                    data: {
                        action: 'load_drone_by_term',
                        term_id: termId,
                        parent_id: parentId,
                        nonce: drone_ajax.nonce
                    },
                    success: function(response) {
                        if (response.success) {
                            updateDroneDisplay(response.data, parentId, 'size');
                        }
                    }
                });
            }

            function loadDroneById(postId, parentId) {
                $.ajax({
                    url: drone_ajax.url,
                    type: 'POST',
                    data: {
                        action: 'load_drone_by_id',
                        post_id: postId,
                        parent_id: parentId,
                        nonce: drone_ajax.nonce
                    },
                    success: function(response) {
                        if (response.success) {
                            updateDroneDisplay(response.data, parentId, 'task');
                        }
                    }
                });
            }

            function updateDroneDisplay(data, parentId, type) {
                const selector = type === 'size' ? '.drones-by-size' : '.drones-by-task';
                const $container = $(selector);

                // Update image
                $container.find('.drone-image-container').html(data.image);

                // Update link
                $container.find('.drone-link').attr('href', data.link);

                // Update specs
                $container.find('.drone-specs').html(data.specs);
            }
        });
    </script>

<?php
get_footer();