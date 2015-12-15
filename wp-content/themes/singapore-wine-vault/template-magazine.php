<?php
/**
 * Template Name: Magazine Template
 *
 */

if ( $query->have_posts() ) { $count = 0; $column_count_1 = 0; $column_count_2 = 0;

 get_header();

?>

    <div id="main-content" class="col-full magazine">

	<div class="container">

		<div class="block<?php if ( $column_count_1 > 1 ) { echo esc_attr( ' last' ); $column_count_1 = 0; } ?>">
		<?php
			woo_get_template_part( 'content', 'magazine-grid' );
		?>
		</div><!--/.block-->
<?php

		if ( $column_count_1 == 0 ) { ?><div class="fix"></div><?php } // End IF Statement
	} // End WHILE Loop
} else {
	get_template_part( 'content', 'noposts' );
}

wp_reset_query();

		?>

	</div>

	<?php get_sidebar(); ?>

    </div><!-- /#content -->

<?php get_footer(); ?>

