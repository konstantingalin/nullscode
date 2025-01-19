<?php get_header() ?>
<section class="cart_page section" id="cart_page">
    <div class="section__content">
			<div class="shop__breadcrumb">
				<?php woocommerce_breadcrumb(); ?>
			</div>
			<?php  if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<!-- Вывод постов, функции цикла: the_title() и т.д. -->
			<?php the_content(); ?>
			<?php endwhile; else: ?>
				Записей нет.
			<?php endif; ?>
		</div>
</section>

<?php get_footer() ?>