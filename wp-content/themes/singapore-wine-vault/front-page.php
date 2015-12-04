<?php
/*********
 * Front page template.
 ***********************/
 global $wp_query;
 
 get_header(); ?>
 <div id="main-content">
        <?php
        $sections = (array) swv_site_option( 'section', array(), array(
                1 => array(),
                2 => array()
                ) );
        $sections = array_filter( $sections );
        
        /***************
         * Section 1
         *****************/
        if( isset( $sections[1] ) && count( $sections[1] ) > 0 ):
                $section1 = (object) $sections[1];
                $img = '';
                if( isset($section1->portrait) && (int) $section1->portrait > 0 ):
                        $img_ = wp_get_attachment_image_src( (int) $section1->portrait, 'full' );
                        $img = $img_[0];
                endif;
        ?>
        <section id="home-section-1" class="drop" data-image="<?php echo esc_url($img); ?>" data-video="">
                <span class="bg-overlay"></span>
                <div class="container">
                        <div class="page-header">
                                <h1 class="page-title"><?php echo $section1->heading; ?></h1>
                                <p class="description tagline"><?php echo $section1->tagline; ?></p>
                        </div>
                        <div class="text-right section-1-buttons">
                                <p>
                                        <a href="<?php echo esc_url($section1->contact_link); ?>" rel="bookmark" class="btn btn-primary btn-md"><?php _e('Contact Us', 'swv'); ?></a>
                                </p>
                                <p>
                                        <a href="<?php echo esc_url($section1->more_link); ?>" rel="bookmark" class="btn btn-primary btn-md"><?php _e('Find out more', 'swv'); ?></a>
                                </p>
                        </div>
                </div>
        </section>
        <?php
        endif;
        
        /************
         * Section 2
         * Refer to Appearance -> Customizer -> Front Page -> Section 2
         **************************************************************/
        if( isset( $sections[2] ) && count( $sections[2] ) > 0 ):
                $section2 = $sections[2];
        ?>
        <section id="home-section-2">
                <div class="container">
                        <div class="row">
                        <?php
                        foreach( $section2 as $section ):
                                $section = (object) $section;
                                $featured_image = ''; // Add default image
                                $alt = $section->heading;
                                
                                if( (int) $section->img > 0 ){
                                        $img = wp_get_attachment_image_src( (int) $section->img, 'medium' );
                                        $alt = get_post_meta( (int) $section->img, '_wp_attachment_image_alt', true );
                                        $featured_image = $img[0];
                                }
                        ?>
                        <div class="col-sm-4 text-center div-cell">
                                <img src="<?php echo $featured_image; ?>" alt="<?php echo esc_attr( $alt ); ?>" />
                                <h2><?php echo $section->heading; ?></h2>
                                <p><?php echo $section->tagline; ?></p>
                        </div>
                        <?php
                        endforeach;
                        ?>
                        </div>
                </div>
        </section>
        <?php endif;
        
        /**********
         * Section 3: The Vault
         ***********************/
        if( isset($sections[3]) && count( $sections[3] ) > 0 ):
                $section3 = (object) $sections[3];
        ?>
        <section id="home-section-3">
                <span class="bg-overlay"></span>
                <div class="container">
                        <div class="row">
                                <div class="col-xs-6 div-left">
                                        <h2><?php echo $section3->heading; ?></h2>
                                </div>
                                <div class="col-xs-6 div-right">
                                        <p><?php echo $section3->tagline; ?></p>
                                        <p class="more-buttons">
                                                <a href="" class="btn btn-primary btn-md"><?php _e('Explore The Vault', 'swv'); ?></a>
                                        </p>
                                </div>
                        </div>
                </div>
        </section>
        <?php endif;
        
        /*************
         * Section 4: Wine Vault App
         ****************************/
        if( isset( $sections[4]) && count( $sections[4]) > 0 ):
                $section4 = (object) $sections[4];
                $permalink = (int) $section4->page_id > 0 ? get_permalink( (int) $section4->page_id ) : '#';
        ?>
        <section id="home-section-4">
                <div class="container">
                        <div class="row">
                                <div class="col-xs-6 col-sm-4">
                                </div>
                                <div class="col-xs-6 col-sm-4 col-sm-push-4">
                                        <h2><?php echo $section4->heading; ?></h2>
                                </div>
                                <div class="col-sm-4 col-sm-pull-4">
                                        <p><?php echo $section->tagline; ?></p>
                                        <p class="text-center"><a href="<?php echo esc_url($permalink); ?>" class="btn btn-primary btn-md"><?php _e('Learn More', 'swv'); ?></a></p>
                                </div>
                        </div>
                </div>
        </section>
        <?php endif;
        
        /**********
         * Section 5: Inquiry
         ********************/ ?>
        <section id="home-section-5">
                <div class="container text-center">
                        <h2><?php _e('Ready to open a Wine Account?', 'swv'); ?></h2>
                        <p><a href="" class="btn btn-primary btn-md"><?php _e('Send Inquiry Form', 'swv'); ?></a></p>
                </div>
        </section>
        
        <?php
        /*************
         * Section 6: Latest Blogs
         *************************/?>
        <section id="home-section-6">
                <div class="container">
                        <div class="row">
                                <?php
                                if( have_posts() ):
                                        while( have_posts() ):
                                                the_post();
                                        ?>
                                        <div class="col-sm-4">
                                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                                        <?php if( has_post_thumbnail() ): ?>
                                                        <div class="featured-image">
                                                                <?php the_post_thumbnail( 'medium', array('class' => 'img-responsive') ); ?>
                                                        </div>
                                                        <?php endif; 
                                                        the_title(
                                                                sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
                                                                '</a></h2>'
                                                        );
                                                        ?>
                                                        <p class="author-meta text-center">
                                                                By <?php the_author(); ?>
                                                        </p>
                                                        <p class="text-center category-meta"><?php the_category(' | '); ?></p>
                                                </article>
                                        </div>
                                        <?php
                                        endwhile;
                                endif;
                                ?>
                                <div class="co-sm-12">
                                        <p class="text-center"><a href="<?php echo home_url( '/blog/' ); ?>" class="btn btn-primary btn-md"><?php _e('More Stories', 'swv'); ?></a></p>
                                </div>
                        </div>
                </div>
        </section>
 </div>
 <?php get_footer(); ?>