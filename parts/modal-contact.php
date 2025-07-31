<?php
$gravity_form_id = 3;
?>

<!-- Custom Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custom-modal">
            <div class="modal-header custom-modal__header">
                <h5 class="modal-title custom-modal__title" id="contactModalLabel">
                    Зв'язатися з нами
                </h5>
                <button type="button" class="btn-close custom-modal__close" data-bs-dismiss="modal" aria-label="Close">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body custom-modal__body">
                <?php
                if (function_exists('gravity_form')) {
                    gravity_form($gravity_form_id, false, false, false, '', true);
                }
                ?>
            </div>
        </div>
    </div>
</div>