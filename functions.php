<?php

add_action('wp_enqueue_scripts', 'theme_styles');
add_action('wp_footer', 'theme_scripts');
add_action('after_setup_theme', 'pups_setup');

function theme_styles() {
  wp_enqueue_style( 'styles', get_template_directory_uri() . '/assets/sass/index.css');
}

function theme_scripts() {
  wp_enqueue_script( 'scripts', get_template_directory_uri() . '/assets/scripts/index.js');
}

function pups_setup() {
  add_theme_support( 'woocommerce' );
  add_theme_support( 'post-thumbnail' );
  add_theme_support( 'title-tag' );

  register_nav_menus ( 
    array(
      'top-menu' => 'top_menu__top_bar',
      'bottom-menu-1' => 'bottom_menu__menu_1',
      'bottom-menu-2' => 'bottom_menu__menu_2',
      'bottom-menu-3' => 'bottom_menu__menu_3',
      'bottom-menu-4' => 'bottom_menu__menu_4',
    )
  );
}

function pups_widgets_init() {
	register_sidebar(
		array(
			'name' => esc_html__( 'Sidebar', 'pups' ),
			'id' => 'sidebar-1',
			'description' => esc_html__( 'Add widgets here.', 'pups' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
		)
	);
}

function register_tools_taxonomy() {
  $labels = array(
      'name'              => __('Инструменты', 'text-domain'),
      'singular_name'     => __('Инструмент', 'text-domain'),
      'search_items'      => __('Найти инструмент', 'text-domain'),
      'all_items'         => __('Все инструменты', 'text-domain'),
      'parent_item'       => __('Родительский инструмент', 'text-domain'),
      'edit_item'         => __('Редактировать инструмент', 'text-domain'),
      'update_item'       => __('Обновить инструмент', 'text-domain'),
      'add_new_item'      => __('Добавить новый инструмент', 'text-domain'),
      'menu_name'         => __('Инструменты', 'text-domain'),
  );

  $args = array(
      'hierarchical'      => true,
      'labels'            => $labels,
      'show_ui'           => true, // Показываем в админке
      'show_admin_column' => true, // Колонка в записях
      'query_var'         => true,
      'rewrite'           => array('slug' => 'tools'),
      'show_in_rest'      => true,
  );

  register_taxonomy('tools', array('post'), $args);
}
add_action('init', 'register_tools_taxonomy');


// Добавление поля для загрузки изображения
function tools_add_image_field($term) {
  $image_id = get_term_meta($term->term_id, 'tool_image_id', true); // ID изображения
  ?>
  <tr class="form-field">
      <th scope="row" valign="top">
          <label for="tool_image"><?php _e('Изображение инструмента', 'text-domain'); ?></label>
      </th>
      <td>
          <input type="hidden" id="tool_image_id" name="tool_image_id" value="<?php echo esc_attr($image_id); ?>">
          <div id="tool_image_wrapper">
              <?php if ($image_id) : ?>
                  <img src="<?php echo esc_url(wp_get_attachment_url($image_id)); ?>" style="max-width: 150px;">
              <?php endif; ?>
          </div>
          <button type="button" class="button" id="upload_tool_image"><?php _e('Загрузить изображение', 'text-domain'); ?></button>
          <button type="button" class="button" id="remove_tool_image"><?php _e('Удалить изображение', 'text-domain'); ?></button>
      </td>
  </tr>
  <script>
      jQuery(document).ready(function($) {
          var frame;
          $('#upload_tool_image').click(function(e) {
              e.preventDefault();
              if (frame) frame.close();
              frame = wp.media({
                  title: '<?php _e('Выберите изображение', 'text-domain'); ?>',
                  button: { text: '<?php _e('Выбрать', 'text-domain'); ?>' },
                  multiple: false
              });
              frame.on('select', function() {
                  var attachment = frame.state().get('selection').first().toJSON();
                  $('#tool_image_id').val(attachment.id);
                  $('#tool_image_wrapper').html('<img src="' + attachment.url + '" style="max-width: 150px;">');
              });
              frame.open();
          });
          $('#remove_tool_image').click(function(e) {
              e.preventDefault();
              $('#tool_image_id').val('');
              $('#tool_image_wrapper').html('');
          });
      });
  </script>
  <?php
}

// Сохранение изображения
function tools_save_image_field($term_id) {
  if (isset($_POST['tool_image_id']) && !empty($_POST['tool_image_id'])) {
      update_term_meta($term_id, 'tool_image_id', intval($_POST['tool_image_id']));
  } else {
      delete_term_meta($term_id, 'tool_image_id');
  }
}

// Подключение функций для добавления и сохранения изображения
add_action('tools_edit_form_fields', 'tools_add_image_field');
add_action('edited_tools', 'tools_save_image_field');
add_action('create_tools', 'tools_save_image_field');

function enqueue_taxonomy_media_uploader($hook) {
  // Проверяем, что мы находимся на странице редактирования таксономий
  if ('term.php' === $hook || 'edit-tags.php' === $hook) {
      wp_enqueue_media(); // Подключаем скрипты Media Uploader
      wp_enqueue_script('taxonomy-image-upload', get_template_directory_uri() . '/js/taxonomy-image-upload.js', array('jquery'), null, true);
  }
}
add_action('admin_enqueue_scripts', 'enqueue_taxonomy_media_uploader');


add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );

function custom_breadcrumbs() {
  if (!is_home()) {
      echo '<a href="' . home_url() . '">Главная</a> / ';
      
      // Архив по категории
      if (is_category()) {
          $category = get_queried_object();
          echo single_cat_title('', false);
      }
      // Архив по тегу
      elseif (is_tag()) {
          $tag = get_queried_object();
          echo single_tag_title('', false);
      }
      // Архив по кастомной таксономии (например, инструментам)
      elseif (is_tax('tools')) {
          $term = get_queried_object();
          echo single_term_title('', false);
      }
      // Страница записи
      elseif (is_single()) {
          $categories = get_the_category();
          if ($categories) {
              echo '';
              foreach ($categories as $category) {
                  echo '<a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a> ';
              }
          }
          echo ' / ';
          the_title();
      }
      // Страница
      elseif (is_page()) {
          the_title();
      }
  }
}


add_action( 'widgets_init', 'pups_widgets_init' );