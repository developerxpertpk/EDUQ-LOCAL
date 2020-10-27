<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.3
 */
$rdtheme_footer_column = RDTheme::$options['footer_column'];
switch ($rdtheme_footer_column) {
    case '1':
        $rdtheme_footer_class = 'col-sm-12 col-xs-12';
        break;
    case '2':
        $rdtheme_footer_class = 'col-sm-6 col-xs-12';
        break;
    case '3':
        $rdtheme_footer_class = 'col-sm-4 col-xs-12';
        break;
    default:
        $rdtheme_footer_class = 'col-sm-3 col-xs-12';
        break;
}
$rdtheme_copyright_class = RDTheme::$options['payment_icons'] ? 'col-sm-8 col-xs-12' : 'col-sm-12 col-xs-12 text-center';
?>
</div><!-- #content -->
<footer>
    <?php if (RDTheme_Helper::has_footer()): ?>
        <div class="footer-top-area">
            <div class="container">
                <div class="row">
                    <?php
                    for ($i = 1; $i <= $rdtheme_footer_column; $i++) {
                        echo '<div class="' . $rdtheme_footer_class . '">';
                        dynamic_sidebar('footer-' . $i);
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>			
    <?php endif; ?>
    <?php if (RDTheme::$options['copyright_area']): ?>
        <div class="footer-bottom-area">
            <div class="container">
                <div class="row">
                    <div class="<?php echo esc_attr($rdtheme_copyright_class); ?>"><?php echo wp_kses_post(RDTheme::$options['copyright_text']); ?></div>
                    <?php if (RDTheme::$options['payment_icons']): ?>
                        <div class="col-sm-4 col-xs-12">
                            <ul class="payment-icons">
                                <?php if (RDTheme::$options['payment_img']) : ?>
                                    <?php
                                    $rdtheme_cards = explode(',', RDTheme::$options['payment_img']);
                                    ?>
                                    <?php foreach ($rdtheme_cards as $rdtheme_card): ?>
                                        <li><?php echo wp_get_attachment_image($rdtheme_card); ?></li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li><img alt="payment" src="<?php echo RDTHEME_IMG_URL; ?>payment-method1.jpg"></li>
                                    <li><img alt="payment" src="<?php echo RDTHEME_IMG_URL; ?>payment-method2.jpg"></li>
                                    <li><img alt="payment" src="<?php echo RDTHEME_IMG_URL; ?>payment-method3.jpg"></li>
                                    <li><img alt="payment" src="<?php echo RDTHEME_IMG_URL; ?>payment-method4.jpg"></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</footer>
</div> 

<?php wp_footer(); ?>
</body>
</html>