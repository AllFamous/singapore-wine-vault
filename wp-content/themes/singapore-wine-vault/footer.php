<?php
/*************
 * Footer template.
 **************************/
?>
        <footer id="main-footer" role="contentinfo">
                <?php
                /*************
                 * Footer Widgets
                 **************************/
                $footer_widgets = 4;
                $columns = array(1 => 12, 2 => 6, 3 => 4, 4=>3); 
                ?>
                        <div id="footer-widgets-area">
                                <div class="container">
                                <?php for($i=1; $i <= $footer_widgets; $i++ ): ?>
                                        <div class="col-sm-<?php echo $columns[$footer_widgets]; ?>">
                                                <?php dynamic_sidebar( "footer-{$i}" ); ?>
                                        </div>
                                <?php endfor; ?>
                                </div>
                        </div>
                <?php
                /*************
                 * Include top-bar template
                 *****************************/
                get_template_part( 'header-top' );
                ?>
        </footer>
</div><!-- end #page //-->
<?php wp_footer(); ?>
</body>
</html>