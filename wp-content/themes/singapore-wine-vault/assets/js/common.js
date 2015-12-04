/********
 * Google Fonts
 ****************/
 WebFontConfig = {
    google: { families: [ 'Lora::latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
 })();
  
+function($){
        var imgBackground = function(){
                var div = $(this),
                        src = div.data('image');
                        
                if ( src && src != '' ) {
                        div.css({
                                'background-image' : 'url(' + src + ')'
                        });
                }
        };

$(document).ready(function(){
        /*******
         * Autoload image background
         ****************************/
        $('[data-image]').each(imgBackground);
        
        
        /**********
        * Lazyload all images
        *********************/
        $('img').lazyload({delay:20});});
}(jQuery);