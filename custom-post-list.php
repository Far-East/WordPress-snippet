<?php //начало выборки терминов для таксономии animal_cat
$terms = get_terms('tovar_tax', array(
	'orderby' => 'count',
	'hide_empty' => true
));

// теперь выполняется запрос для каждого семейства животных
foreach ($terms as $term) {
	
	// Определение запроса
	$args = array(
		'post_type' => 'tovar',
		'tovar_tax' => $term->slug
	);
	$query = new WP_Query($args); ?>

	<h2><?php echo $term->name ?></h2>

	<ul>
		<?php
		while ($query->have_posts()) : $query->the_post(); ?>

			<li class="animal-listing" id="post-<?php the_ID(); ?>">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<?php the_post_thumbnail('catalog-size') ?>
			</li>
		
		<?php endwhile; ?>

	</ul>
	
	<?php wp_reset_postdata();
}
?>
