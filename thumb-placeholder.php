
<?php if(has_post_thumbnail()) : ?>
	<?php the_post_thumbnail('catalog-size') ?>
<?php else : ?>
	<img src="/wp-content/" alt="placeholder">
<?php endif; ?>
