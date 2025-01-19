<?php
/*
Template Name: blog
*/
get_header(); 
?>

<section class="news_page section" id="news_page">
    <div class="section__content">
        <div class="shop__breadcrumb">
            <?php custom_breadcrumbs(); ?>
		</div>
        <div class="news_page__content">
            <div class="news_page__left">
            <?php
                // Получаем текущую страницу
                $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

                // Настройки запроса
                $args = array(
                    'post_status'    => 'publish',
                    'posts_per_page' => 6, // Количество постов на одной странице
                    'paged'          => $paged,
                );

                $news_query = new WP_Query($args);

                if ($news_query->have_posts()) :
                    while ($news_query->have_posts()) : $news_query->the_post(); ?>
                        <a href='<?php the_permalink(); ?>' class="news_page__items__item">
                            <div class="news_page__items__img">
                                <?php the_post_thumbnail(); ?>
                            </div>
                            <ul>
                                <?php
                                $categories = get_the_category();
                                if (!empty($categories)) :
                                    foreach ($categories as $category) : ?>
                                        <li>#<?php echo esc_html($category->name); ?></li>
                                    <?php endforeach;
                                endif; ?>
                            </ul>
                            <div class="news_page__items__texts">
                                <h2 class="news__items__main_text">
                                    <?php the_title(); ?>
                                </h2>
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
                        </a>
                    <?php endwhile; ?>

                    <!-- Вывод пагинации -->
                    <div class="pagination">
                        <?php
                        echo paginate_links(array(
                            'total'   => $news_query->max_num_pages,
                            'current' => $paged,
                            'format'  => '?paged=%#%',
                            'prev_text' => '← Предыдущая',
                            'next_text' => 'Следующая →',
                        ));
                        ?>
                    </div>

                <?php
                else :
                    echo '<p>Публикаций не найдено.</p>';
                endif;

                // Сбрасываем глобальную переменную $post
                wp_reset_postdata();
            ?>
            </div>
            <div class="news_page__right">
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
                    <div class="instrumentals_sidebar">
                        <h3>Фильтр по инструменту</h3>
                        <ul class="tools-filter">
                            <?php
                            $terms = get_terms(array(
                                'taxonomy' => 'tools',
                                'hide_empty' => true, // Показывать только те термины, у которых есть связанные посты
                            ));

                            if (!empty($terms) && !is_wp_error($terms)) :
                                foreach ($terms as $term) :
                                    $image_id = get_term_meta($term->term_id, 'tool_image_id', true); // Получаем ID изображения
                                    $image_url = $image_id ? wp_get_attachment_url($image_id) : ''; // URL изображения
                                    ?>
                                    <li class="tools-filter__item">
                                        <a href="<?php echo esc_url(get_term_link($term)); ?>" class="tools-filter__link">
                                            <?php if ($image_url) : ?>
                                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($term->name); ?>" class="tools-filter__image">
                                            <?php else : ?>
                                                <span class="tools-filter__placeholder"><?php echo esc_html($term->name); ?></span>
                                            <?php endif; ?>
                                        </a>
                                    </li>
                                <?php
                                endforeach;
                            else :
                                echo '<li>Инструменты не найдены.</li>';
                            endif;
                            ?>
                        </ul>
                    </div>

                    <div class="hashtags_sidebar">
                        <h3>Облако тегов</h3>
                        <ul>
                            <?php
                                $posttags = get_tags();
                                if ( $posttags ) {
                                    foreach( $posttags as $tag ) {
                                        echo '<li><a href="' . get_category_link($tag->term_id) . '">#' . $tag->name . '</a></li>';
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>