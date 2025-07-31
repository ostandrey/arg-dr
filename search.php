<?php
/**
 * Index
 *
 * Standard loop for the search result page
 */
get_header(); ?>

	<div class="container <?php echo is_front_page() ? '' : 'space-top'; ?>">
		<div class="row posts-list">
			<div class="col-12 col-sm-12">
				<!-- BEGIN of search results -->
				<main class="main-content">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'default' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
					<?php get_search_form(); ?>
					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'parts/loop', 'post' ); // Post item ?>
						<?php endwhile; ?>
					<?php else: ?>
						<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'default' ); ?></p>
					<?php endif; ?>
					<!-- BEGIN of pagination -->
					<?php bootstrap_pagination(); ?>
					<!-- END of pagination -->
				</main>
			</div>
			<!-- END of search results -->
		</div>
	</div>

<?php get_footer(); ?>
