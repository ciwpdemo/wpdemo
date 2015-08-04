<div class="clear"></div>
</div>
<footer>
<div id="copyright">
<span><?php echo sprintf( __( '%1$s %2$s %3$s. All Rights Reserved.', 'colorsnap' ), '&copy;', date('Y'), esc_html(get_bloginfo('name')) ); ?>
</span><br/>
<span> <?php if(is_home() AND !is_paged()) { ?><a href="http://thememags.com/colorsnap/" >Colorsnap</a> by ThemeMags. <?php }  else { ?>Colorsnap by ThemeMags<?php  } ?> </span></p>
</div>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>