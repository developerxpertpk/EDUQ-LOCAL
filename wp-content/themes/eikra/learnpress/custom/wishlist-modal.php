<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.3
 */
?>
<div class="modal fade" id="rt-wishlist-modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></div>
			</div>
			<div class="modal-body text-center"><?php printf(__( 'You must be logged in before using WishList. To login click <a href="%s">here</a>', 'eikra' ), wp_login_url() );?></div>
		</div>
	</div>
</div>