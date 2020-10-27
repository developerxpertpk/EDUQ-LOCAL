<?php
/**
 * @author  RadiusTheme
 * @since   2.3
 * @version 2.3
 */
?>
<div id="tophead">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="tophead-left">
					<?php if ( is_active_sidebar( 'top5-left' ) ) dynamic_sidebar( 'top5-left' );?>
				</div>
				<div class="tophead-right">
					<?php if ( is_active_sidebar( 'top5-right' ) ) dynamic_sidebar( 'top5-right' );?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>