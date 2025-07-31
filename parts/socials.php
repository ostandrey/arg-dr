<?php if ( have_rows( 'socials', 'options' ) ): ?>
	<ul class="stay-tuned">
		<?php while ( have_rows( 'socials', 'options' ) ): the_row(); ?>
		<?php $social_network = get_sub_field('social_network'); ?>
			<li class="stay-tuned__item">
				<a class="stay-tuned__link "
				   href="<?php the_sub_field( 'social_profile' ); ?>"
				   target="_blank"
				   aria-label="<?php echo $social_network['label']; ?>"
				   rel="noopener"><span aria-hidden="true" class="fab fa-<?php echo $social_network['value']; ?>"></span>
				</a>
			</li>
		<?php endwhile; ?>
	</ul>
<?php endif; ?>
