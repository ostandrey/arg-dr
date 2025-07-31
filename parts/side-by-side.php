<?php
$strip_bg   = get_field( 'strip_background' );
$main_color = get_field( 'main_color' );
$sub_color  = get_field( 'sub_color' );
?>
<?php if ( have_rows( 'sbs_blocks' ) ): ?>
	<section class="sbs-blocks">
		<?php while ( have_rows( 'sbs_blocks' ) ): the_row(); ?>
			<?php $row_color = get_row_index() % 2 ? $main_color : $sub_color; ?>
			<div class="sbs-block <?php echo get_row_index() % 2 ? '' : 'sbs-block--reverse'; ?>"
				<?php echo $strip_bg ? "style='background-color:{$row_color}'" : ''; ?>>

				<div class="container">
					<div class="row align-content-center <?php echo ( get_row_index() % 2 ) ? '' : 'flex-row-reverse'; ?>">
						<div class="col-12 col-md-6 sbs-block__img-wrap">
							<?php $block_image = get_sub_field( 'block_image' ); ?>
							<?php echo wp_get_attachment_image( $block_image['ID'], 'medium_large', false, array( 'class' => 'sbs-block__img of-cover' ) ); ?>
						</div>
						<div class="col-12 col-md-6 sbs-block__content-wrap">
							<div class="sbs-block__content">
								<div class="sbs-block__content-inner">
									<?php the_sub_field( 'block_content' ); ?>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		<?php endwhile; ?>
	</section>
<?php endif; ?>
