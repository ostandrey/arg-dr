<?php
$section_type = get_sub_field('section_type');

switch ($section_type) {
    case 'contact_form':
        get_template_part('parts/contact-form');
        break;
    case 'drone_order_form':
        get_template_part('parts/custom-drone-form');
        break;
    case 'cta':
        get_template_part('parts/cta-section');
        break;
    default:
        echo '<!-- Error section: ' . esc_html($section_type) . ' -->';
        break;
}
?>