<div class="top-header">
        <div class="container">
                <div class="social-container">
                <?php
                $social_links = swv_site_option( 'socials', array(), array(
                        'linkedin'    => '#',
                        'google-plus' => '#',
                        'facebook'    => '#',
                        'twitter'     => '#',
                        'youtube'     => '#',
                        'instagram'   => '#'
                        ) );
                $social_links = array_filter($social_links);                
                $html = '';
                
                foreach( $social_links as $social => $link ){
                        if( $social == 'facebook' ) $social = 'facebook-official';
                        
                        $icon  = "fa fa-{$social}";
                        printf('<a href="%1$s" class="social-link social-%2$s"><i class="fa fa-%2$s"></i></a>',
                                esc_url($link), $social );
                }
                ?>
                </div>
        </div>
</div>