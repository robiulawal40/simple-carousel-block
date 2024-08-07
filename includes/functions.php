<?php
function Alpha_sanitize_text_or_array_field( $array_or_string ) {

	if ( is_string( $array_or_string ) ) {
		$array_or_string = sanitize_text_field( $array_or_string );
	} elseif ( is_array( $array_or_string ) ) {
		foreach ( $array_or_string as $key => &$value ) {
			if ( is_array( $value ) ) {
				$value = Alpha_sanitize_text_or_array_field( $value );
			} else {
				$value = sanitize_text_field( $value );
			}
		}
	}
	return $array_or_string;
}
// add_filter(
// 'block_editor_settings',
// function ( $editor_settings ) {

// $editor_settings['__experimentalFeatures']['global']['typography']['dropCap'] = false;
// return $editor_settings;
// }
// );
