<?php
/*
Enqueue PhotoSwipe script and styles
*/
function enqueue_photoswipe() {
    wp_enqueue_script('photoswipe', 'https://cdnjs.cloudflare.com/ajax/libs/photoswipe/5.3.6/photoswipe.min.js', array(), '5.3.6', true);
    wp_enqueue_script('photoswipe-ui', 'https://cdnjs.cloudflare.com/ajax/libs/photoswipe/5.3.6/photoswipe-ui-default.min.js', array('photoswipe'), '5.3.6', true);
    wp_enqueue_style('photoswipe-css', 'https://cdnjs.cloudflare.com/ajax/libs/photoswipe/5.3.6/photoswipe.min.css', array(), '5.3.6');
    wp_enqueue_style('photoswipe-default-skin', 'https://cdnjs.cloudflare.com/ajax/libs/photoswipe/5.3.6/default-skin/default-skin.min.css', array(), '5.3.6');
    // wp_enqueue_style('custom-photoswipe-css', plugins_url('custom-photoswipe.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'enqueue_photoswipe');

/*
Initialize PhotoSwipe for WooCommerce product gallery images
*/
function initialize_photoswipe() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            var pswpElement = document.querySelectorAll('.pswp')[0];

            // Build items array
            var items = [];
            $('.woocommerce-product-gallery__image a').each(function() {
                var $link = $(this);
                var size = $link.data('size');

                if (size) {
                    var sizeParts = size.split('x');
                    if (sizeParts.length === 2) {
                        var item = {
                            src: $link.attr('href'),
                            w: parseInt(sizeParts[0], 10),
                            h: parseInt(sizeParts[1], 10),
                            title: $link.attr('title') || ''
                        };
                        items.push(item);
                    } else {
                        console.warn('Invalid data-size format for:', $link.attr('href'));
                    }
                } else {
                    console.log('Missing data-size attribute for:', $link.attr('href'));
                }
            });

            // Bind click event to gallery links
            $('.woocommerce-product-gallery__image a').on('click', function(event) {
                event.preventDefault();

                var index = $('.woocommerce-product-gallery__image a').index(this);

                // Define PhotoSwipe options
                var options = {
                    index: index,
                    bgOpacity: 0.7,
                    showHideOpacity: true
                };

                // Initialize PhotoSwipe
                var gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
                gallery.init();
            });
        });
    </script>
    <?php
}
add_action('wp_footer', 'initialize_photoswipe', 20);

/*
Add PhotoSwipe markup to the footer
*/
function add_photoswipe_markup() {
    ?>
    <!-- PhotoSwipe -->
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="pswp__bg"></div>
        <div class="pswp__scroll-wrap">
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>
            <div class="pswp__ui pswp__ui--hidden">
                <div class="pswp__top-bar">
                    <div class="pswp__counter"></div>
                    <button class="pswp__button pswp__button--close pe_pswp_close" title="Close (Esc)" style="position: absolute;height: 2em;"></button>
                    <button class="pswp__button pswp__button--share pe_pswp_share" title="Share"></button>
                    <button class="pswp__button pswp__button--fs pe_pswp_fs" title="Toggle fullscreen" style="position: absolute;height: 2em;right: 6em;"></button>
                    <button class="pswp__button pswp__button--zoom pe_pswp_zoom" title="Zoom in/out" style="position: absolute;height: 2em;right: 3em;"></button>
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div>
                <button class="pswp__button--arrow--left" title="Previous (arrow left)"></button>
                <button class="pswp__button--arrow--right" title="Next (arrow right)"></button>
                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
add_action('wp_footer', 'add_photoswipe_markup');

/*
Add data-size attribute to WooCommerce product gallery images
*/
function add_data_size_to_product_gallery( $content, $attachment_id ) {
    $image = wp_get_attachment_image_src( $attachment_id, 'full' );
    if ($image) {
        // Ensure we only modify anchor tags
        if (strpos($content, '<a ') !== false) {
            $content = str_replace('<a ', '<a data-size="' . $image[1] . 'x' . $image[2] . '" ', $content);
        }
    }
    return $content;
}
add_filter('woocommerce_single_product_image_thumbnail_html', 'add_data_size_to_product_gallery', 10, 2);
