<?php
/**
 * Organizer metabox
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

?>
<script type="text/template" id="tmpl-tribe-create-organizer">
<tbody class="new-organizer">
	<tr class="organizer">
		<td><?php printf( __( '%s Name:', 'tribe-events-calendar' ), tribe_get_organizer_label_singular() ); ?></td>
		<td>
			<input tabindex="<?php tribe_events_tab_index(); ?>" type='text' name='organizer[Organizer][]' class='organizer-name' size='25' value='' />
		</td>
	</tr>
	<tr class="organizer">
		<td><?php _e( 'Phone:', 'tribe-events-calendar' ); ?></td>
		<td>
			<input tabindex="<?php tribe_events_tab_index(); ?>" type='text' name='organizer[Phone][]' class='organizer-phone' size='25' value='' />
		</td>
	</tr>
	<tr class="organizer">
		<td><?php _e( 'Website:', 'tribe-events-calendar' ); ?></td>
		<td>
			<input tabindex="<?php tribe_events_tab_index(); ?>" type='text' name='organizer[Website][]' class='organizer-website' size='25' value='' />
		</td>
	</tr>
	<tr class="organizer">
		<td>
			<?php
			_e( 'Email:', 'tribe-events-calendar' );
			if ( apply_filters( 'tribe_show_organizer_email_obfuscation_alert', true ) ) {
				?>
				<small>
					<?php _e( 'You may want to consider <a href="http://wordpress.org/plugins/tags/obfuscate">obfuscating</a> any e-mail address published on your site to best avoid it getting harvested by spammers.', 'tribe-events-calendar' ); ?>
				</small>
				<?php
			}
			?>
		</td>
		<td class="organizer-email">
			<input tabindex="<?php tribe_events_tab_index(); ?>" type='text' name='organizer[Email][]' class='organizer-email' size='25' value='' />
		</td>
	</tr>
</tbody>
</script>

<script type="text/javascript">
	(function($) {
		$('#event_organizer').on('blur', '.organizer-name', function () {
			var input = $(this);
			var group = input.parents('tbody');
			$.post(ajaxurl,
				{
					action: 'tribe_event_validation',
					nonce: '<?php echo wp_create_nonce('tribe-validation-nonce'); ?>',
					type: 'organizer',
					name: input.val()
				},
				function (result) {
					if (result == 1) {
						group.find('.tribe-organizer-error').remove();
					} else {
						group.find('.tribe-organizer-error').remove();
						input.after('<div class="tribe-organizer-error error form-invalid"><?php printf( __( '%s Name Already Exists', 'tribe-events-calendar' ), tribe_get_organizer_label_singular() ); ?></div>');
					}
				}
			);
		})
	})(jQuery);
</script>
