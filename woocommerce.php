<?php
/**
 * WooCommerce Page. Shop / Product Category / Single Product view
 */
get_header(); ?>

<main class="main-content">
	<div class="container">
		<div class="row">
			<!-- BEGIN of page content -->
			<div class="col-12">
				<?php woocommerce_content(); ?>
			</div>
			<!-- END of page content -->
		</div>
	</div>
</main>

<?php get_footer(); ?>
