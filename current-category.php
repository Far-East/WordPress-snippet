	<!--Вывод публикаций из текущей категории-->
	<div class="collect-post-permalink">
		<h5 class="widget-title">Оглавление раздела</h5>
		<?php
		$infocat = get_the_category();
		$info    = $infocat[0]->cat_ID;
		$array   = "showposts=100&cat=$info";
		query_posts( $array );
		if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<a class="permalink-cat" href="<?php the_permalink() ?>"
					title="Перейти к посту: <?php the_title(); ?>"><?php the_title(); ?>
			</a>
		<?php endwhile; else: ?>
			Публикаций нет
		<?php endif;
		wp_reset_query(); ?>
	</div>
