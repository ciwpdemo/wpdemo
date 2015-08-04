<div class="entry-summary">
<?php the_excerpt( sprintf(__( 'continue reading %s', 'colorsnap' ), '<span class="meta-nav">&rarr;</span>' )  ); ?>
<?php if(is_search()) {
wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'colorsnap' ) . '&after=</div>');
}
?>
</div> 