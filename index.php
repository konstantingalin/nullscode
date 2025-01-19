<?php get_header(); ?>

<section class="index_cubics section" id="index_cubics">
	<div class="section__content">
    <div class="index_cubics__top_items">
      <div class="index_cubics__item index_cubics__item1">
        <h2>
          ВЕБ <br>
          РАЗРАБОТКА
        </h2>
        <h3>
          Сайты. Веб-приложения. Интернет-магазины.
        </h3>
        <ul class="list_intruments">
          <li><img src="<?php echo get_template_directory_uri() . "/assets/public/imgs/" . "bubble_logo.png"?>" alt="Bubble логотип"></li>
          <li><img src="<?php echo get_template_directory_uri() . "/assets/public/imgs/" . "wordpress_logo.png"?>" alt="wordpress логотип"></li>
          <li><img src="<?php echo get_template_directory_uri() . "/assets/public/imgs/" . "webflow_logo.png"?>" alt="webflow логотип"></li>
        </ul>
      </div>
      <div class="index_cubics__items2">
        <div class="index_cubics__item index_cubics__item2">
          <h2>
            Мобильные <br>
            приложения
          </h2>
          <h3>
            Мобильные приложения на Android и iOS. 
          </h3>
          <ul class="list_intruments">
            <li><img src="<?php echo get_template_directory_uri() . "/assets/public/imgs/" . "flutterflow_logo.png"?>" alt="flutterflow логотип"></li>
            <li><img src="<?php echo get_template_directory_uri() . "/assets/public/imgs/" . "supabase_logo.png"?>" alt="supabase логотип"></li>
          </ul>
        </div>
        <div class="index_cubics__item index_cubics__item3">
          <h2>
            Автоматизация <br>
            Процессов
          </h2>
          <h3>
            Связки из инструментов для вашего бизнеса.
          </h3>
          <ul class="list_intruments">
            <li><img src="<?php echo get_template_directory_uri() . "/assets/public/imgs/" . "make_logo.png"?>" alt="make логотип"></li>
            <li><img src="<?php echo get_template_directory_uri() . "/assets/public/imgs/" . "n8n_logo.png"?>" alt="n8n логотип"></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="index_cubics__bottom_items">
      <div class="index_cubics__item index_cubics__item4">
        <h2>
          Чат-боты <br> И MiniApps
        </h2>
        <h3>
          Бизнес. Приложения. Игры.
        </h3>
        <ul class="list_intruments">
          <li><img src="<?php echo get_template_directory_uri() . "/assets/public/imgs/" . "telegram_logo.png"?>" alt="telegram логотип"></li>
        </ul>
      </div>
      <div class="index_cubics__item index_cubics__item5">
        <h2>
          Нейросети
        </h2>
        <h3>
          Бизнес. Образование. Связки.
        </h3>
        <ul class="list_intruments">
          <li><img src="<?php echo get_template_directory_uri() . "/assets/public/imgs/" . "chatGPT_logo.png"?>" alt="chatGPT_logo логотип"></li>
          <li><img src="<?php echo get_template_directory_uri() . "/assets/public/imgs/" . "perplexity_logo.png"?>" alt="perplexity логотип"></li>
        </ul>
        <ul class="list_intruments list_intruments2">
          <li><img src="<?php echo get_template_directory_uri() . "/assets/public/imgs/" . "runway_logo.png"?>" alt="runway логотип"></li>
          <li><img src="<?php echo get_template_directory_uri() . "/assets/public/imgs/" . "midjourney_logo.png"?>" alt="midjourney логотип"></li>
        </ul>
      </div>
      <div class="index_cubics__item index_cubics__item6">
        <h2>
          Мобильные <br>
          и веб игры
        </h2>
        <h3>
          Яндекс. Google Play. Apple Store.
        </h3>
        <ul class="list_intruments">
          <li><img src="<?php echo get_template_directory_uri() . "/assets/public/imgs/" . "construct_3_logo.png"?>" alt="construct 3 логотип"></li>
          <li><img src="<?php echo get_template_directory_uri() . "/assets/public/imgs/" . "gamemaker_logo.png"?>" alt="gamemaker логотип"></li>
        </ul>
      </div>
    </div>
  </div>
</section>
<section class="index_blog section" id="index_blog">
	<div class="section__content">
    <div class="top_header">
      <h4>Блог</h4>
      <a href="<?php echo get_home_url() . "/" ."blog/" ; ?>">перейти в блог</a>
    </div>
    <?php
    $posts = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => 3, 
    ));

    if ($posts->have_posts()) : ?>
        <div class="posts">
            <?php while ($posts->have_posts()) : $posts->the_post(); ?>
                <div class="posts__post">
                    <?php if (has_post_thumbnail()) : ?>
                      <a href="<?php the_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="posts__img"></a>
                    <?php else : ?>
                      <a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri() . '/assets/public/icons/default_image.svg'; ?>" alt="Default image" class="posts__img"></a>
                    <?php endif; ?>

                    <ul>
                        <?php
                        $categories = get_the_category();
                        if (!empty($categories)) :
                            foreach ($categories as $category) : ?>
                                <li>#<?php echo esc_html($category->name); ?></li>
                            <?php endforeach;
                        endif; ?>
                    </ul>

                    <a href="<?php the_permalink(); ?>">
                      <h2><?php the_title(); ?></h2>
                    </a>

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
                </div>
            <?php endwhile; ?>
        </div>
        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <p>Постов не найдено.</p>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>