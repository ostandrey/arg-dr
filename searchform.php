<?php
/**
 * Searchform
 *
 * Custom template for search form
 */
?>
<!-- BEGIN of search form -->
<form method="get" id="searchform" class="search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="s" class="css-clip"><?php _e( 'Search', 'default' ); ?></label>
	<input type="search" name="s" id="s" class="search__input" placeholder="<?php _e( 'Search', 'default' ); ?>" value="<?php echo get_search_query(); ?>"/>
	<button type="submit" name="submit" class="search__submit  btn btn-primary" id="searchsubmit" aria-label="<?php _e('Submit search','default'); ?>"><?php _e( 'Search', 'default' ); ?></button>
</form>
<!-- END of search form -->
