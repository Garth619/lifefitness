<?php
//add author social link meta
add_action( 'show_user_profile', 'ct_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'ct_show_extra_profile_fields' );
function ct_show_extra_profile_fields( $user ) { ?>
	<h3><?php esc_html_e('Social Accounts','cactus') ?></h3>
	<table class="form-table">
		<tr>
			<th><label for="twitter">Twitter</label></th>
			<td>
				<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e('Enter your Twitter profile url.','cactus')?></span>
			</td>
		</tr>
        <tr>
			<th><label for="facebook">Facebook</label></th>
			<td>
				<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e('Enter your Facebook profile url.','cactus')?></span>
			</td>
		</tr>
        <tr>
			<th><label for="linkedin">LinkedIn</label></th>
			<td>
				<input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e('Enter your linkedin profile url.','cactus')?></span>
			</td>
		</tr>
        <tr>
			<th><label for="google-plus">Google+</label></th>
			<td>
				<input type="text" name="google" id="google" value="<?php echo esc_attr( get_the_author_meta( 'google', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e('Enter your Google+ profile url.','cactus')?></span>
			</td>
		</tr>
        <tr>
			<th><label for="tumblr">Tumblr</label></th>
			<td>
				<input type="text" name="tumblr" id="tumblr" value="<?php echo esc_attr( get_the_author_meta( 'tumblr', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e('Enter your Tumblr profile url.','cactus')?></span>
			</td>
		</tr>
        <tr>
			<th><label for="pinterest">Pinterest</label></th>
			<td>
				<input type="text" name="pinterest" id="pinterest" value="<?php echo esc_attr( get_the_author_meta( 'pinterest', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e('Enter your Pinterest profile url.','cactus')?></span>
			</td>
		</tr>
        <tr>
			<th><label for="author_email">Email</label></th>
			<td>
				<input type="text" name="author_email" id="author_email" value="<?php echo esc_attr( get_the_author_meta( 'author_email', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e('Enter your Email profile url.','cactus')?></span>
			</td>
		</tr>
        
	</table>
    
    <h3><?php esc_html_e('Custom Social Accounts','cactus') ?></h3>
    <?php
	$custom_acc = get_the_author_meta( 'cactus_account', $user->ID );
	$c = 0;
	?>
    <table class="cactus-account">
        <?php if ( $custom_acc && count( $custom_acc ) > 0 ) { ?>
        <tr>
			<td><?php esc_html_e('Title','cactus') ?></td>
			<td><?php esc_html_e('Icon Class (Ex: fa-facebook)','cactus') ?></td>
            <td><?php esc_html_e('Url (include http://)','cactus') ?></td>
		</tr>
			<?php
			foreach( $custom_acc as $track ) {
				if ( (isset( $track['title'] ) && $track['title'] != '') || (isset( $track['icon'] ) && $track['icon'] != '') || (isset( $track['url'] ) && $track['url'] != '') ) {
					printf( '
					<tr>
						<th><input type="text" name="cactus_account[%1$s][title]" id="title" value="%2$s" class="" /></th>
						<td><input type="text" name="cactus_account[%1$s][icon]" id="icon" value="%3$s" class="regular-text" /></td>
						<td><input type="text" name="cactus_account[%1$s][url]" id="url" value="%4$s" class="regular-text" /></td>
						<td valign="top"><button class="custom-acc-remove button"><i class="fa fa-times"></i> Remove</button></td>
					</tr>
			', $c, $track['title'], $track['icon'], $track['url'] );
					$c = $c +1;
				}
			}
		}else{ ?>
        	<tr class="cactus-account-header hidden">
                <td><?php esc_html_e('Title','cactus') ?></td>
                <td><?php esc_html_e('Icon Class (Ex: fa-facebook)','cactus') ?></td>
                <td><?php esc_html_e('Url (include http://)','cactus') ?></td>
            </tr>
		<?php } ?>
	</table>
    
    <button class="cactua_add_account button button-large"><i class="fa fa-plus"></i> <?php esc_html_e('Add Custom Account','cactus'); ?></button>
    
<script>
var $ =jQuery.noConflict();
$(document).ready(function() {
	var count = <?php echo $c ?>;
	$(".cactua_add_account").click(function() {
		$('.cactus-account-header').removeClass('hidden');
		count = count + 1;

		$('.cactus-account').append('\
		<tr>\
			<th><input type="text" name="cactus_account['+count+'][title]" id="title" value="" class="" /></th>\
			<td><input type="text" name="cactus_account['+count+'][icon]" id="icon" value="" class="regular-text" /></td>\
            <td><input type="text" name="cactus_account['+count+'][url]" id="url" value="" class="regular-text" /></td>\
			<td valign="top"><button class="custom-acc-remove button"><i class="fa fa-times"></i> <?php esc_html_e('Remove','cactus'); ?></button></td>\
		</tr>\
		' );
		return false;
	});
	$(".custom-acc-remove").live('click', function() {
		$(this).parent().parent().remove();
	});
});
</script>
<?php }
add_action( 'personal_options_update', 'ct_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'ct_save_extra_profile_fields' );
function ct_save_extra_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;
	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
	update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
	update_user_meta( $user_id, 'linkedin', $_POST['linkedin'] );
	update_user_meta( $user_id, 'google', $_POST['google'] );
	update_user_meta( $user_id, 'tumblr', $_POST['tumblr'] );
	update_user_meta( $user_id, 'pinterest', $_POST['pinterest'] );
	update_user_meta( $user_id, 'author_email', $_POST['author_email'] );
	update_user_meta( $user_id, 'cactus_account', @$_POST['cactus_account'] );

}
