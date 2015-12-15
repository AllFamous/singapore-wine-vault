<?php
/***********
 * Single Template
 ******************/

 get_header(); ?>
 <div id="main-content">
	<div class="single-header">
		<span class="bg-overlay"></span>
		<div class="container">
			<div class="page-header">
				<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-sm-8" class="main-content">
				<?php
				if( have_posts() ):
					while( have_posts() ):
						the_post();
						get_template_part( 'content' );
					endwhile;
				endif;
				?>
			</div>
			<div class="col-sm-4" class="right-sidebar">
				<?php
				if( is_active_sidebar( 'right-sidebar') ):
					dynamic_sidebar( 'right-sidebar' );
				endif; ?>
			</div>
		</div>
	</div>
 </div>
 <?php get_footer(); ?>