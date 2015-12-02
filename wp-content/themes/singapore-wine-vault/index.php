<?php
/************
 * Silence is good, but hey why waste a good page!
 *
 * This serves a the default template and is use for
 * pages that has no specific template assigned.
 **************************************************/

 get_header(); ?>

 <div id="main-content">

	<div class="container">

		<!-- section -->
		<section>

			<?php get_template_part('loop'); ?>

			<?php get_template_part('pagination'); ?>

		</section>
		<!-- /section -->
		
	</div>   
	
	<?php get_sidebar(); ?>  
  
 </div>

 <?php get_footer(); ?>