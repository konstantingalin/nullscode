<?php get_header() ?>

<?php  if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<section class="post_page section" id="post_page">
    <div class="section__content">
			<div class="shop__breadcrumb">
				<?php custom_breadcrumbs(); ?>
				</div>
			<div class="post_page__content">
				<div class="post_page__left top_article">
					<?php if(has_post_thumbnail()):?>
						<?php the_post_thumbnail(); ?>
					<?php else: ?>
						<img src="https://picsum.photos/1000/1000" alt="Картинка поста">
					<?php endif; ?>
					<ul class="category_title">
						<?php
						$categories = get_the_category();
						if (!empty($categories)) :
							foreach ($categories as $category) : ?>
								<li>#<?php echo esc_html($category->name); ?></li>
							<?php endforeach;
						endif; ?>
					</ul>
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
					<div class="hashtags">
						<ul> <!-- Добавим ul для списка -->
							<?php
							$posttags = get_the_tags();
							if ($posttags) {
								foreach ($posttags as $tag) {
								echo '<li><a href="' . get_tag_link($tag->term_id) . '">#' . $tag->name . '</a></li>';
								}
							}
							?>
						</ul>
					</div>
					<div class="info_post">
						<div class="info_post__date">
							<img src="<?php echo get_template_directory_uri() . '/assets/public/icons/date_icon.svg'; ?>" alt="иконка даты">
							<p><?php echo get_the_date(); ?></p>
						</div>
						<div class="info_post__views">
							<img src="<?php echo get_template_directory_uri() . '/assets/public/icons/view_icon.svg'; ?>" alt="иконка количества просмотров">
							<p>
								<?php
								$views = get_post_meta(get_the_ID(), 'post_views_count', true);
								echo $views ? esc_html($views) : '0';
								?>
							</p>
						</div>
					</div>
					<!-- <div class="comments">
						<?php
							// if(comments_open() || get_comments_number()){
							// 	comments_template();	
							// }
						?>
					</div> -->
				</div>
				<div class="post_page__right">
				<aside>
						<div class="genre_sidebar">
								<h3>Категории записей</h3>
								<ul>
										<?php
												$genre = get_categories();
												if ( $genre ) {
														foreach( $genre as $link ) {
																echo '<li><a href="' . get_category_link($link->term_id) . '">' . $link->name . '<span> ' . $link->category_count . '</span></a></li>';
														}
												}
										?>
								</ul>
						</div>
						
				</aside>
					<?php endwhile; else: ?>
							Записей нет.
						<?php endif; ?>
				</div>
			</div>
		</div>

		</section>

<?php get_footer() ?>