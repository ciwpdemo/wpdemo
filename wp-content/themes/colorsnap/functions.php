<?php
add_action('after_setup_theme', 'colorsnap_setup');
function colorsnap_setup(){
load_theme_textdomain('colorsnap', get_template_directory() . '/languages');
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-header' );
add_theme_support( 'custom-background' );
global $content_width;
if ( ! isset( $content_width ) ) $content_width = 640;

// Add nav menus
	register_nav_menu( 'primary', __('Primary Menu','colorsnap') );
	register_nav_menu( 'social', __('Social Menu','colorsnap') );

}

// Register and enqueue Javascript files
add_action( 'wp_enqueue_scripts', 'colorsnap_load_javascript_files' );

function colorsnap_load_javascript_files() {
	if ( !is_admin() ) {	
		wp_enqueue_script( 'colorsnap_flexslider', get_template_directory_uri().'/js/flexslider.min.js', array('jquery'), '', true );	
		wp_enqueue_script( 'colorsnap_doubletap', get_template_directory_uri().'/js/doubletaptogo.min.js', array('jquery'), '', true );
		wp_enqueue_script( 'colorsnap_global', get_template_directory_uri().'/js/global.js', array('jquery'), '', true );
        wp_enqueue_script('colorsnap-videos', get_template_directory_uri().'/js/videos.js', array('jquery'), '', true);
		if ( is_singular() ) wp_enqueue_script( "comment-reply" );
	}
}

// Register and enqueue styles
add_action('wp_print_styles', 'colorsnap_load_style');

function colorsnap_load_style() {
	if ( !is_admin() ) {
	    wp_enqueue_style( 'colorsnap_googleFonts', '//fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic|Merriweather:700,900,400italic' );
	    wp_enqueue_style( 'colorsnap_fontawesome', get_stylesheet_directory_uri() . '/fa/css/font-awesome.min.css' );
	    wp_enqueue_style( 'colorsnap_style', get_stylesheet_uri() );
	}
}

require_once (get_template_directory() . '/setup/options.php');
add_action('wp_enqueue_scripts','colorsnap_load_scripts');

function colorsnap_enqueue_admin_scripts()
{
global $colorsnap_theme_page;
if ( $colorsnap_theme_page != get_current_screen()->id ) { return; }
wp_enqueue_script('colorsnap-admin-color', get_template_directory_uri().'/js/color-picker/color.js');
}
add_action('wp_enqueue_scripts','colorsnap_load_styles');
function colorsnap_load_styles()
{
$options = get_option('colorsnap_options');
}
add_action('wp_head', 'colorsnap_print_custom_styles');
function colorsnap_print_custom_styles()
{
if(!is_admin()){
$options = get_option('colorsnap_options');
if ( false != $options['colorscheme']) { 
$custom_css = '<style type="text/css">';
$custom_css .= 'a, h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, code, nav .current-menu-item a, nav .current_page_item a, #wrapper nav #s{';
if ( '' != $options['colorscheme'] ) { $custom_css .= 'color:#'.sanitize_text_field($options['colorscheme']).''; }
$custom_css .= '}';
$custom_css .= 'body, nav, #content input[type="submit"], #content input[type="reset"], #container #searchsubmit, .button, #wrapper nav #s, nav li ul a{';
if ( '' != $options['colorscheme'] ) { $custom_css .= 'background-color:#'.sanitize_text_field($options['colorscheme']).''; }
$custom_css .= '}';
$custom_css .= 'blockquote, input, textarea, #content input[type="submit"], #content input[type="reset"], #container #searchsubmit, .button, nav ul li a, nav ul li:hover ul li a, nav ul ul li:hover ul li a, nav ul ul ul li:hover ul li a{';
if ( '' != $options['colorscheme'] ) { $custom_css .= 'border-color:#'.sanitize_text_field($options['colorscheme']).''; }
$custom_css .= '}';
$custom_css .= '</style>';
echo $custom_css; }
}
}
add_action('wp_head', 'colorsnap_print_custom_scripts', 99);
function colorsnap_print_custom_scripts()
{
if(!is_admin()){
$options = get_option('colorsnap_options');
?>
<script type="text/javascript">
jQuery(document).ready(function($){
$("#wrapper").vids();
});
</script>
<?php
}
}
add_action('comment_form_before', 'colorsnap_enqueue_comment_reply_script');
function colorsnap_enqueue_comment_reply_script()
{
if(get_option('thread_comments')) { wp_enqueue_script('comment-reply'); }
}
add_filter('the_title', 'colorsnap_title');
function colorsnap_title($title) {
if ($title == '') {
return 'Untitled';
} else {
return $title;
}
}
add_filter('wp_title', 'colorsnap_filter_wp_title');
function colorsnap_filter_wp_title($title)
{
return $title . esc_attr(get_bloginfo('name'));
}
add_filter('comment_form_defaults', 'colorsnap_comment_form_defaults');
function colorsnap_comment_form_defaults( $args )
{
$req = get_option( 'require_name_email' );
$required_text = sprintf( ' ' . __('Required fields are marked %s', 'colorsnap'), '<span class="required">*</span>' );
$args['comment_notes_before'] = '<p class="comment-notes">' . __('Your email is kept private.', 'colorsnap') . ( $req ? $required_text : '' ) . '</p>';
$args['title_reply'] = __('Post a Comment', 'colorsnap');
$args['title_reply_to'] = __('Post a Reply to %s', 'colorsnap');
return $args;
}
add_action( 'widgets_init', 'colorsnap_widgets_init' );
function colorsnap_widgets_init() {
register_sidebar( array (
'name' => __('Sidebar Widget Area', 'colorsnap'),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
$preset_widgets = array (
'primary-aside'  => array( 'search', 'pages', 'categories', 'archives' ),
);
function colorsnap_get_page_number() {
if (get_query_var('paged')) {
print ' | ' . __( 'Page ' , 'colorsnap') . get_query_var('paged');
}
}
function colorsnap_catz($glue) {
$current_cat = single_cat_title( '', false );
$separator = "\n";
$cats = explode( $separator, get_the_category_list($separator) );
foreach ( $cats as $i => $str ) {
if ( strstr( $str, ">$current_cat<" ) ) {
unset($cats[$i]);
break;
}
}
if ( empty($cats) )
return false;
return trim(join( $glue, $cats ));
}
function colorsnap_tag_it($glue) {
$current_tag = single_tag_title( '', '',  false );
$separator = "\n";
$tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );
foreach ( $tags as $i => $str ) {
if ( strstr( $str, ">$current_tag<" ) ) {
unset($tags[$i]);
break;
}
}
if ( empty($tags) )
return false;
return trim(join( $glue, $tags ));
}
function colorsnap_commenter_link() {
$commenter = get_comment_author_link();
if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
$commenter = preg_replace( '/(<a[^>]* class=[\'"]?)/', '\\1url ' , $commenter );
} else {
$commenter = preg_replace( '/(<a )/', '\\1class="url "' , $commenter );
}
$avatar_email = get_comment_author_email();
$avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 80 ) );
echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
}
function colorsnap_custom_comments($comment, $args, $depth) {
$GLOBALS['comment'] = $comment;
$GLOBALS['comment_depth'] = $depth;
?>
<li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
<div class="comment-author vcard"><?php colorsnap_commenter_link() ?></div>
<div class="comment-meta"><?php printf(__('Posted %1$s at %2$s', 'colorsnap' ), get_comment_date(), get_comment_time() ); ?><span class="meta-sep"> | </span> <a href="#comment-<?php echo get_comment_ID(); ?>" title="<?php _e('Permalink to this comment', 'colorsnap' ); ?>"><?php _e('Permalink', 'colorsnap' ); ?></a>
<?php edit_comment_link(__('Edit', 'colorsnap'), ' <span class="meta-sep"> | </span> <span class="edit-link">', '</span>'); ?></div>
<?php if ($comment->comment_approved == '0') { echo '\t\t\t\t\t<span class="unapproved">'; _e('Your comment is awaiting moderation.', 'colorsnap'); echo '</span>\n'; } ?>
<div class="comment-content">
<?php comment_text() ?>
</div>
<?php
if($args['type'] == 'all' || get_comment_type() == 'comment') :
comment_reply_link(array_merge($args, array(
'reply_text' => __('Reply','colorsnap'),
'login_text' => __('Login to reply.', 'colorsnap'),
'depth' => $depth,
'before' => '<div class="comment-reply-link">',
'after' => '</div>'
)));
endif;
?>
<?php }
function colorsnap_custom_pings($comment, $args, $depth) {
$GLOBALS['comment'] = $comment;
?>
<li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
<div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'colorsnap'),
get_comment_author_link(),
get_comment_date(),
get_comment_time() );
edit_comment_link(__('Edit', 'colorsnap'), ' <span class="meta-sep"> | </span> <span class="edit-link">', '</span>'); ?></div>
<?php if ($comment->comment_approved == '0') { echo '\t\t\t\t\t<span class="unapproved">'; _e('Your trackback is awaiting moderation.', 'colorsnap'); echo '</span>\n'; } ?>
<div class="comment-content">
<?php comment_text() ?>
</div>
<?php }