<?php
/************
 * Silence is good, but hey why waste a good page!
 *
 * This serves a the default template and is use for
 * pages that has no specific template assigned.
 **************************************************/

 get_header(); ?>
 <div id="main-content">
        <?php
        if( have_posts() ):
                while( have_posts() ):
                        the_post();
                endwhile;
        endif;
        ?>
 </div>
 <?php get_footer(); ?>