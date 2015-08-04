<?php
function colorsnap_get_option_defaults() {
$defaults = array(
'colorscheme' => '',
);
return $defaults;
}
add_action( 'admin_init', 'colorsnap_options_init' );
function colorsnap_options_init(){
register_setting( 'colorsnap_options', 'colorsnap_options', 'colorsnap_options_validate' );
}
add_action( 'admin_menu', 'colorsnap_options_add_page' );
function colorsnap_options_add_page() {
global $colorsnap_theme_page;
$colorsnap_theme_page = add_theme_page( __( 'Theme Color', 'colorsnap' ), __( 'Theme Color', 'colorsnap' ), 'edit_theme_options', 'theme_options', 'colorsnap_options_do_page' );
add_action( 'admin_print_scripts-' . $colorsnap_theme_page, 'colorsnap_enqueue_admin_scripts' );
}
function colorsnap_options_do_page() {
global $select_options;
$options = wp_parse_args( get_option( 'colorsnap_options', array() ), colorsnap_get_option_defaults() );
if ( ! isset( $_REQUEST['settings-updated'] ) )
$_REQUEST['settings-updated'] = false;
?>
<div class="wrap">
<?php global $colorsnap_theme_page; ?>
<?php $current_theme = wp_get_theme(); ?>
<?php echo "<h2>" . sprintf( __( 'Theme Color', 'colorsnap' )) . "</h2>"; ?>
<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
<div class="updated fade"><p><strong><?php _e( 'Theme Color Saved', 'colorsnap' ); ?></strong></p></div>
<?php endif; ?>
<form method="post" action="options.php">
<?php settings_fields( 'colorsnap_options' ); ?>
<p>
<?php
?>
<?php _e( 'Set Color:', 'colorsnap' ); ?><br /><small><em>(<?php printf( __( 'do not add #', 'colorsnap' ) ); ?>)</em></small>
<input id="colorsnap_options[colorscheme]" class="color {required:false}" type="text" name="colorsnap_options[colorscheme]" value="<?php echo esc_attr( $options['colorscheme'] ); ?>" />
</p>
<p class="submit"><input type="submit" class="button-primary" value="<?php _e( 'Save', 'colorsnap' ); ?>" /></p>
</form>
</div>
<?php
?>
<?php
}
function colorsnap_options_validate( $input ) {
$valid_input = wp_parse_args( get_option( 'colorsnap_options', array() ), colorsnap_get_option_defaults() );
if ( ! isset( $input['colorscheme'] ) || '' == $input['colorscheme'] ) {
$valid_input['colorscheme'] = '';
} else {
$input['colorscheme'] = ltrim( trim( $input['colorscheme' ] ), '#' );
$input['colorscheme'] = ( 6 == strlen( $input['colorscheme'] ) || 3 == strlen( $input['colorscheme'] ) ? $input['colorscheme'] : false );
$valid_input['colorscheme'] = ( ctype_xdigit( $input['colorscheme'] ) ? $input['colorscheme'] : $valid_input['colorscheme'] );
}
return $valid_input;
}