<?php
/**
 * Index
 *
 * Standard loop for the front-page
 */
get_header(); ?>
	<main class="main-content">
		<div class="container">
			<div class="row posts-list">
				<!-- BEGIN of main content -->
				<div class="col-lg-8 col-md-8 col-sm-12 col-12">
					
					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'parts/loop', 'post' ); // Post item ?>
						<?php endwhile; ?>
					<?php endif; ?>
					<!-- BEGIN of pagination -->
					<?php bootstrap_pagination(); ?>
					<!-- END of pagination -->
				
				</div>
				<!-- END of main content -->
				
				<!-- BEGIN of sidebar -->
				<div class="col-lg-4 col-md-4 col-sm-12 col-12 sidebar">
					<?php get_sidebar( 'right' ); ?>
				</div>
				<!-- END of sidebar -->
			</div>
		</div>
	</main>

<?php get_footer(); ?>
