<?php
/**
 * @author  RadiusTheme
 * @since   1.5
 * @version 3.5
 */

$primary_color         = RDTheme::$options['primary_color']; // #002147
$secondery_color       = RDTheme::$options['secondery_color']; // #fdc800
$primary_rgb           = RDTheme_Helper::hex2rgb( $primary_color ); // 0, 33, 71

$rdtheme_typo_body     = RDTheme::$options['typo_body'];
$rdtheme_typo_h1       = RDTheme::$options['typo_h1'];
$rdtheme_typo_h2       = RDTheme::$options['typo_h2'];
$rdtheme_typo_h3       = RDTheme::$options['typo_h3'];
$rdtheme_typo_h4       = RDTheme::$options['typo_h4'];
$rdtheme_typo_h5       = RDTheme::$options['typo_h5'];
$rdtheme_typo_h6       = RDTheme::$options['typo_h6'];
?>

body,
gtnbg_root,
p {
	font-family: <?php echo esc_html( $rdtheme_typo_body['font-family'] ); ?>, sans-serif;;
	font-size: <?php echo esc_html( $rdtheme_typo_body['font-size'] ); ?>;
	line-height: <?php echo esc_html( $rdtheme_typo_body['line-height'] ); ?>;
	font-weight : <?php echo esc_html( $rdtheme_typo_body['font-weight'] ); ?>;
	font-style: <?php echo empty( $rdtheme_typo_body['font-style'] ) ? 'normal' : $rdtheme_typo_body['font-style']; ?>;
}
h1 {
	font-family: <?php echo esc_html( $rdtheme_typo_h1['font-family'] ); ?>;
	font-size: <?php echo esc_html( $rdtheme_typo_h1['font-size'] ); ?>;
	line-height: <?php echo esc_html( $rdtheme_typo_h1['line-height'] ); ?>;
	font-weight : <?php echo esc_html( $rdtheme_typo_h1['font-weight'] ); ?>;
	font-style: <?php echo empty( $rdtheme_typo_h1['font-style'] ) ? 'normal' : $rdtheme_typo_h1['font-style']; ?>;
}
h2 {
	font-family: <?php echo esc_html( $rdtheme_typo_h2['font-family'] ); ?>, sans-serif;;
	font-size: <?php echo esc_html( $rdtheme_typo_h2['font-size'] ); ?>;
	line-height: <?php echo esc_html( $rdtheme_typo_h2['line-height'] ); ?>;
	font-weight : <?php echo esc_html( $rdtheme_typo_h2['font-weight'] ); ?>;
	font-style: <?php echo empty( $rdtheme_typo_h2['font-style'] ) ? 'normal' : $rdtheme_typo_h2['font-style']; ?>;
}
h3 {
	font-family: <?php echo esc_html( $rdtheme_typo_h3['font-family'] ); ?>, sans-serif;;
	font-size: <?php echo esc_html( $rdtheme_typo_h3['font-size'] ); ?>;
	line-height: <?php echo esc_html( $rdtheme_typo_h3['line-height'] ); ?>;
	font-weight : <?php echo esc_html( $rdtheme_typo_h3['font-weight'] ); ?>;
	font-style: <?php echo empty( $rdtheme_typo_h3['font-style'] ) ? 'normal' : $rdtheme_typo_h3['font-style']; ?>;
}
h4 {
	font-family: <?php echo esc_html( $rdtheme_typo_h4['font-family'] ); ?>, sans-serif;;
	font-size: <?php echo esc_html( $rdtheme_typo_h4['font-size'] ); ?>;
	line-height: <?php echo esc_html( $rdtheme_typo_h4['line-height'] ); ?>;
	font-weight : <?php echo esc_html( $rdtheme_typo_h4['font-weight'] ); ?>;
	font-style: <?php echo empty( $rdtheme_typo_h4['font-style'] ) ? 'normal' : $rdtheme_typo_h4['font-style']; ?>;
}
h5 {
	font-family: <?php echo esc_html( $rdtheme_typo_h5['font-family'] ); ?>, sans-serif;;
	font-size: <?php echo esc_html( $rdtheme_typo_h5['font-size'] ); ?>;
	line-height: <?php echo esc_html( $rdtheme_typo_h5['line-height'] ); ?>;
	font-weight : <?php echo esc_html( $rdtheme_typo_h5['font-weight'] ); ?>;
	font-style: <?php echo empty( $rdtheme_typo_h5['font-style'] ) ? 'normal' : $rdtheme_typo_h5['font-style']; ?>;
}
h6 {
	font-family: <?php echo esc_html( $rdtheme_typo_h6['font-family'] ); ?>, sans-serif;;
	font-size: <?php echo esc_html( $rdtheme_typo_h6['font-size'] ); ?>;
	line-height: <?php echo esc_html( $rdtheme_typo_h6['line-height'] ); ?>;
	font-weight : <?php echo esc_html( $rdtheme_typo_h6['font-weight'] ); ?>;
	font-style: <?php echo empty( $rdtheme_typo_h6['font-style'] ) ? 'normal' : $rdtheme_typo_h6['font-style']; ?>;
}

a,a:link,a:visited {
	color: <?php echo esc_html( $primary_color ); ?>;
}

a:hover,
a:focus,
a:active {
	color: <?php echo esc_html( $secondery_color );?>;
}
.wp-block-quote::before {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

.wp-block-pullquote {
    border-color: <?php echo esc_html( $primary_color ); ?>;
}