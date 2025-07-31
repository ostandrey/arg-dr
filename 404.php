<?php
/**
 * The template for displaying 404 pages (Not Found)
 */

get_header(); ?>
	<!-- BEGIN of 404 page -->
	<div class="container not-found <?php echo is_front_page() ? '' : 'space-top'; ?>">
		<div class="grid-x">
			<div class="col-12 text-center">
				<h1><?php _e( '404: Page Not Found', 'default' ); ?></h1>
				<h3><?php _e( 'Keep on looking...', 'default' ); ?></h3>
				<p><?php printf( __( 'Double check the URL or head back to the <a class="label" href="%1s">HOMEPAGE</a>', 'default' ), get_bloginfo( 'url' ) ); ?></p>
			</div>
		</div>
	</div>
	<!-- END of 404 page -->
<?php get_footer(); ?>
