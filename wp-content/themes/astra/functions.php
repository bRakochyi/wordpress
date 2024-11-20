<?php
/**
 * Astra functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Define Constants
 */
define( 'ASTRA_THEME_VERSION', '4.8.3' );
define( 'ASTRA_THEME_SETTINGS', 'astra-settings' );
define( 'ASTRA_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'ASTRA_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );

/**
 * Minimum Version requirement of the Astra Pro addon.
 * This constant will be used to display the notice asking user to update the Astra addon to the version defined below.
 */
define( 'ASTRA_EXT_MIN_VER', '4.8.2' );

/**
 * Setup helper functions of Astra.
 */
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-theme-options.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-theme-strings.php';
require_once ASTRA_THEME_DIR . 'inc/core/common-functions.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-icons.php';

define( 'ASTRA_PRO_UPGRADE_URL', astra_get_pro_url( 'https://wpastra.com/pricing/', 'dashboard', 'free-theme', 'dashboard' ) );
define( 'ASTRA_PRO_CUSTOMIZER_UPGRADE_URL', astra_get_pro_url( 'https://wpastra.com/pricing/', 'customizer', 'free-theme', 'upgrade' ) );

/**
 * Update theme
 */
require_once ASTRA_THEME_DIR . 'inc/theme-update/astra-update-functions.php';
require_once ASTRA_THEME_DIR . 'inc/theme-update/class-astra-theme-background-updater.php';

/**
 * Fonts Files
 */
require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-font-families.php';
if ( is_admin() ) {
	require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-fonts-data.php';
}

require_once ASTRA_THEME_DIR . 'inc/lib/webfont/class-astra-webfont-loader.php';
require_once ASTRA_THEME_DIR . 'inc/lib/docs/class-astra-docs-loader.php';
require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-fonts.php';

require_once ASTRA_THEME_DIR . 'inc/dynamic-css/custom-menu-old-header.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/container-layouts.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/astra-icons.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-walker-page.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-enqueue-scripts.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-gutenberg-editor-css.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-wp-editor-css.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/block-editor-compatibility.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/inline-on-mobile.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/content-background.php';
require_once ASTRA_THEME_DIR . 'inc/class-astra-dynamic-css.php';
require_once ASTRA_THEME_DIR . 'inc/class-astra-global-palette.php';

/**
 * Custom template tags for this theme.
 */
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-attr.php';
require_once ASTRA_THEME_DIR . 'inc/template-tags.php';

require_once ASTRA_THEME_DIR . 'inc/widgets.php';
require_once ASTRA_THEME_DIR . 'inc/core/theme-hooks.php';
require_once ASTRA_THEME_DIR . 'inc/admin-functions.php';
require_once ASTRA_THEME_DIR . 'inc/core/sidebar-manager.php';

/**
 * Markup Functions
 */
require_once ASTRA_THEME_DIR . 'inc/markup-extras.php';
require_once ASTRA_THEME_DIR . 'inc/extras.php';
require_once ASTRA_THEME_DIR . 'inc/blog/blog-config.php';
require_once ASTRA_THEME_DIR . 'inc/blog/blog.php';
require_once ASTRA_THEME_DIR . 'inc/blog/single-blog.php';

/**
 * Markup Files
 */
require_once ASTRA_THEME_DIR . 'inc/template-parts.php';
require_once ASTRA_THEME_DIR . 'inc/class-astra-loop.php';
require_once ASTRA_THEME_DIR . 'inc/class-astra-mobile-header.php';

/**
 * Functions and definitions.
 */
require_once ASTRA_THEME_DIR . 'inc/class-astra-after-setup-theme.php';

// Required files.
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-admin-helper.php';

require_once ASTRA_THEME_DIR . 'inc/schema/class-astra-schema.php';

/* Setup API */
require_once ASTRA_THEME_DIR . 'admin/includes/class-astra-api-init.php';

if ( is_admin() ) {
	/**
	 * Admin Menu Settings
	 */
	require_once ASTRA_THEME_DIR . 'inc/core/class-astra-admin-settings.php';
	require_once ASTRA_THEME_DIR . 'admin/class-astra-admin-loader.php';
	require_once ASTRA_THEME_DIR . 'inc/lib/astra-notices/class-astra-notices.php';
}

/**
 * Metabox additions.
 */
require_once ASTRA_THEME_DIR . 'inc/metabox/class-astra-meta-boxes.php';

require_once ASTRA_THEME_DIR . 'inc/metabox/class-astra-meta-box-operations.php';

/**
 * Customizer additions.
 */
require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-customizer.php';

/**
 * Astra Modules.
 */
require_once ASTRA_THEME_DIR . 'inc/modules/posts-structures/class-astra-post-structures.php';
require_once ASTRA_THEME_DIR . 'inc/modules/related-posts/class-astra-related-posts.php';

/**
 * Compatibility
 */
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-gutenberg.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-jetpack.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/woocommerce/class-astra-woocommerce.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/edd/class-astra-edd.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/lifterlms/class-astra-lifterlms.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/learndash/class-astra-learndash.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-beaver-builder.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-bb-ultimate-addon.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-contact-form-7.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-visual-composer.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-site-origin.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-gravity-forms.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-bne-flyout.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-ubermeu.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-divi-builder.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-amp.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-yoast-seo.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/surecart/class-astra-surecart.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-starter-content.php';
require_once ASTRA_THEME_DIR . 'inc/addons/transparent-header/class-astra-ext-transparent-header.php';
require_once ASTRA_THEME_DIR . 'inc/addons/breadcrumbs/class-astra-breadcrumbs.php';
require_once ASTRA_THEME_DIR . 'inc/addons/scroll-to-top/class-astra-scroll-to-top.php';
require_once ASTRA_THEME_DIR . 'inc/addons/heading-colors/class-astra-heading-colors.php';
require_once ASTRA_THEME_DIR . 'inc/builder/class-astra-builder-loader.php';

// Elementor Compatibility requires PHP 5.4 for namespaces.
if ( version_compare( PHP_VERSION, '5.4', '>=' ) ) {
	require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-elementor.php';
	require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-elementor-pro.php';
	require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-web-stories.php';
}

// Beaver Themer compatibility requires PHP 5.3 for anonymous functions.
if ( version_compare( PHP_VERSION, '5.3', '>=' ) ) {
	require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-beaver-themer.php';
}

require_once ASTRA_THEME_DIR . 'inc/core/markup/class-astra-markup.php';

/**
 * Load deprecated functions
 */
require_once ASTRA_THEME_DIR . 'inc/core/deprecated/deprecated-filters.php';
require_once ASTRA_THEME_DIR . 'inc/core/deprecated/deprecated-hooks.php';
require_once ASTRA_THEME_DIR . 'inc/core/deprecated/deprecated-functions.php';


// Додавання форматів файлів для завантаження на сайт
function rmn_custom_mime_types($mines)
{
    $mines['sql'] = 'application/sql';
    return $mines;
}
add_filter('upload_mimes', 'rmn_custom_mime_types');

// Add button for log-in or log-out users.

//add_filter('wp_nav_menu_items', 'add_login_logout_link', 10, 2);
//function add_login_logout_link($items, $args)
//{
//    ob_start();
//    wp_loginout('index.php');
//    $loginoutlink = ob_get_contents() ;
//    ob_get_clean();
//    $items .= '<li>'. $loginoutlink . '</li>';
//    return $items;
//}

// додавання форм в профіль адмінки
// когда пользователь сам редактирует свой профиль
add_action( 'show_user_profile', 'true_show_profile_fields' );
// когда чей-то профиль редактируется админом например
add_action( 'edit_user_profile', 'true_show_profile_fields' );

function true_show_profile_fields( $user ) {

    // выводим заголовок для наших полей
    echo '<h3>Дополнительная информация</h3>';

    // поля в профиле находятся в рамметке таблиц <table>
    echo '<table class="form-table">';

    // добавляем поле
    $user_phone = get_the_author_meta( 'phone', $user->ID );

    echo '<tr><th><label for="phone">Телефон</label></th>
 	<td><input type="text" name="phone" id="phone" value="' . esc_attr( $user_phone ) . '" class="regular-text" /></td>
	</tr>';


    echo '</table>';
}

//збереження даних в профілі в абмінці
// когда пользователь сам редактирует свой профиль
add_action( 'personal_options_update', 'true_save_profile_fields' );
// когда чей-то профиль редактируется админом например
add_action( 'edit_user_profile_update', 'true_save_profile_fields' );

function true_save_profile_fields( $user_id ) {

    update_user_meta( $user_id, 'phone', sanitize_text_field( $_POST[ 'phone' ] ) );
}

/**
 *
 * Cтворення кастомної ролі для сайту (без доступу в адмінку)
 *
 */

$result = add_role('user', __('Користувач'),
    array(
        'read' => false,
        'delete_posts' => false,
        'edit_posts' => false,
        'delete_published_posts' => false,
        'edit_published_posts' => false,
        'publish_posts' => false,
        'upload_files' => false,
        'delete_others_pages' => false,
        'delete_others_posts' => false,
        'delete_pages' => false,
        'delete_private_pages' => false,
        'delete_private_posts' => false,
        'delete_published_pages' => false,
        'edit_others_pages' => false,
        'edit_others_posts' => false,
        'edit_pages' => false,
        'edit_private_pages' => false,
        'edit_private_posts' => false,
        'edit_published_pages' => false,
        'manage_categories' => false,
        'manage_links' => false,
        'moderate_comments' => false,
        'publish_pages' => false,
        'read_private_pages' => false,
        'read_private_posts' => false,
        'unfiltered_html' => false,
        'activate_plugins' => false,
        'create_users' => false,
        'deactivate_plugins' => false,
        'delete_plugins' => false,
        'delete_themes' => false,
        'delete_users' => false,
        'edit_dashboard' => false,
        'edit_files' => false,
        'edit_plugins' => false,
        'edit_theme_options' => false,
        'edit_themes' => false,
        'edit_users' => false,
        'export' => false,
        'import' => false,
        'install_languages' => false,
        'install_plugins' => false,
        'install_themes' => false,
        'list_users' => false,
        'manage_options' => false,
        'promote_users' => false,
        'remove_users' => false,
        'switch_themes' => false,
        'update_core' => false,
        'update_languages' => false,
        'update_plugins' => false,
        'update_themes' => false,
        'unfiltered_upload' => false,
        'manage_network_options' => false,
        'manage_network_plugins' => false,
        'manage_network_themes' => false,
        'manage_network_users' => false,
        'manage_network' => false,
        'manage_sites' => false,
        'setup_network' => false,
        'upgrade_network' => false
    ));

$result = add_role('director', __('Директор'),
    array(
        'read' => false,
        'delete_posts' => false,
        'edit_posts' => false,
        'delete_published_posts' => false,
        'edit_published_posts' => false,
        'publish_posts' => false,
        'upload_files' => false,
        'delete_others_pages' => false,
        'delete_others_posts' => false,
        'delete_pages' => false,
        'delete_private_pages' => false,
        'delete_private_posts' => false,
        'delete_published_pages' => false,
        'edit_others_pages' => false,
        'edit_others_posts' => false,
        'edit_pages' => false,
        'edit_private_pages' => false,
        'edit_private_posts' => false,
        'edit_published_pages' => false,
        'manage_categories' => false,
        'manage_links' => false,
        'moderate_comments' => false,
        'publish_pages' => false,
        'read_private_pages' => false,
        'read_private_posts' => false,
        'unfiltered_html' => false,
        'activate_plugins' => false,
        'create_users' => false,
        'deactivate_plugins' => false,
        'delete_plugins' => false,
        'delete_themes' => false,
        'delete_users' => false,
        'edit_dashboard' => false,
        'edit_files' => false,
        'edit_plugins' => false,
        'edit_theme_options' => false,
        'edit_themes' => false,
        'edit_users' => false,
        'export' => false,
        'import' => false,
        'install_languages' => false,
        'install_plugins' => false,
        'install_themes' => false,
        'list_users' => false,
        'manage_options' => false,
        'promote_users' => false,
        'remove_users' => false,
        'switch_themes' => false,
        'update_core' => false,
        'update_languages' => false,
        'update_plugins' => false,
        'update_themes' => false,
        'unfiltered_upload' => false,
        'manage_network_options' => false,
        'manage_network_plugins' => false,
        'manage_network_themes' => false,
        'manage_network_users' => false,
        'manage_network' => false,
        'manage_sites' => false,
        'setup_network' => false,
        'upgrade_network' => false
    ));

// встановлення ролей з файлу (операція виконується тільки один раз)
require_once "roles_lep.php";

/**
 *
 * Редірект на головну сторінку сайту після авторизації
 *
 */

function redirect_users_after_login() {
    $user = wp_get_current_user();
    $roles = ( array ) $user->roles;


    // Редiрект для ролей на гол стор сайту крім адміна (в нього редірект як на гол стор так і в адмінку, в залежності від ситуації)
    if ( $roles[0] !== 'administrator' && $roles[0] !== 'editor' && $roles[0] !== 'author') {
        wp_redirect( home_url() );
        exit;
    }


}
add_action( 'wp_login', 'redirect_users_after_login' );

//Закриття доступу до сайту для не авторизованих користувачів і редірект для них на сторінку авторизації,
//крім тих хто вручну її вводить
add_action( 'template_redirect',
    function() {
    if ( ! is_user_logged_in() && ! is_page( 'wp-login' ) ) {
        auth_redirect();
    }
});

/**
 *
 * Закриття(переадресацiя) сторінки авторизації для вже авторизованих користувачів
 *
 */
function restrict_access_for_logged_in_users() {
    // Замените 'your-page-slug' на слаг вашей страницы
    if (is_user_logged_in() && (strpos($_SERVER['REQUEST_URI'], 'wp-login.php') !== false)) {
        wp_redirect( home_url('index.php') );
    }
}
add_action('init', 'restrict_access_for_logged_in_users');


// додавання вибору ролей на сторынку реэстрации
// Добавляем поле выбора роли на страницу регистрации
function add_role_to_registration_form() {
    require "roles_register_form_select.php";
}
add_action( 'register_form', 'add_role_to_registration_form' );

// Сохраняем выбранную роль при регистрации
function save_user_role( $user_id ) {
    if (isset($_POST['organization']) && isset($_POST['department']) && isset($_POST['role'])) {
        $organization = sanitize_text_field($_POST['organization']);
        $department = sanitize_text_field($_POST['department']);
        $selected_role = sanitize_text_field($_POST['role']);

        // Призначаємо ролі відповідно до вибору


        if ($organization === 'tov_lep') {
            if ($department === 'Відділення дистриб\'юції') {
                $role = 'distribution_manager';
            } elseif ($department === 'Відділення постачання') {
                $role = 'postachannya_manager';
            } elseif ($department === 'Офісний відділ') {
                $role = 'office_worker';
            } elseif ($department === 'Дирекція') {
                $role = 'director';
            } elseif ($department === 'Бухгалтерія') {
                if ($selected_role === 'Бухгалтер') {
                    $role = 'bukhhalter';
                } elseif ($selected_role === 'Касир ЛЕП') {
                    $role = 'paymaster_lep';
                }
            } elseif ($department === 'Технічний відділ') {
                $role = 'technik';
            } elseif ($department === 'Транспортний відділ') {
                if ($selected_role === 'Механік') {
                    $role = 'mekhanik';
                } elseif ($selected_role === 'Водій') {
                    $role = 'vodij';
                }
            } elseif ($department === 'Охорона') {
                $role = 'security';
            } elseif ($department === 'Складський відділ') {
                $role = 'sklad_worker';
            }
        } elseif ($organization === 'eloter') {
            if ($department === 'Елотер') {
                $role = 'eloter_worker';
            }
        } elseif ($organization === 'amperok') {
            if ($department === 'Амперок магазин') {
                if ($selected_role === 'Адміністратор амперок магазин') {
                    $role = 'admin_amperok_store';
                } elseif ($selected_role === 'Менеджер амперок магазин') {
                    $role = 'manager_amperok_store';
                } elseif ($selected_role === 'Касир амперок магазин') {
                    $role = 'paymaster_amperok_store';
                } elseif ($selected_role === 'Працівник амперок магазин') {
                    $role = 'amperok_worker_store';
                }

            } elseif ($department === 'Амперок інтернет') {
                if ($selected_role === 'Адміністратор амперок інтернет') {
                    $role = 'admin_amperok_internet';
                } elseif ($selected_role === 'Менеджер амперок інтернет') {
                    $role = 'manager_amperok_internet';
                } elseif ($selected_role === 'Контент менеджер амперок інтернет') {
                    $role = 'content_manager_amperok_internet';
                }
            }
        }
    }


    if (array_key_exists($role, wp_roles()->roles)) {
        $user = new WP_User($user_id);
        $user->set_role($role);

    } else {
        $user = new WP_User($user_id);
        $user->set_role('distribution_manager');
    }

}
add_action( 'user_register', 'save_user_role');

// видалення запису перед таблицею коментаря
function remove_logged_in_message() {
    return '';
}
add_filter( 'comment_form_logged_in', 'remove_logged_in_message' );


//приховування панелы адмыныстратора у вверху сайту у всіх крім адміна, редактора, автора
if ( !current_user_can('administrator') && !current_user_can('editor') && !current_user_can('author') ) {
    add_filter('show_admin_bar', '__return_false');
}


// видалення тексту 'підтвердження буде надіслано на вашу ел пошту
add_filter('registration_errors', 'remove_registration_message', 20, 3);
function remove_registration_message($translated_text, $text, $domain) {
    if ($text === 'Подтверждение регистрации будет отправлено на ваш email.') {
        $translated_text = ''; // Залиште порожнім, щоб видалити текст
        // Або змінити на інший текст:
    }
    return $translated_text;
}

// додавання іконки сейвс в хедер
function favorites_count() {
    if (function_exists('get_user_favorites_count')) {
        return get_user_favorites_count();
    }
    return 0;
}
add_shortcode('favorites_count', 'favorites_count');


// Додавання нових розмірів зображень
function custom_image_sizes() {
    add_image_size('custom-size', 50, 50, true); // 600px ширина, 400px висота, обрізається по центру
}
add_action('after_setup_theme', 'custom_image_sizes');


// Локалізуємо ajaxurl
//function enqueue_favorites_js() {
//    // Підключаємо ваш JavaScript
//    wp_enqueue_script('favorites-js',  '/wp-content/plugins/favorites/assets/js/favorites.js', array('jquery'), null, true);
//
//    // Локалізуємо ajaxurl, щоб він був доступний у вашому JS
//    wp_localize_script('favorites-js', 'Ajax_fav', array(
//        'admin_url' => esc_url( admin_url('admin-ajax.php') ) // Підключаємо повний URL до admin-ajax.php
//    )); // передаємо ajaxurl в JS
//}
//add_action('wp_enqueue_scripts', 'enqueue_favorites_js');

// Переключення версії JQuery
function load_custom_jquery() {
    // Відключаємо стандартну версію jQuery WordPress
    wp_deregister_script('jquery');

    // Підключаємо стару версію jQuery (1.12.4)
    wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', false, null, true);
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'load_custom_jquery');

//додавання можливості видалити окремий запис зі сторінки "Мої улюблені"

function custom_user_favorites() {
    $user_id = get_current_user_id();
    $favorites = get_user_meta($user_id, 'simplefavorites', true);

    if ($favorites && !is_array($favorites)) {
        $favorites = unserialize($favorites);
    }

    $posts_per_page = 2;
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;

    // Отримуємо улюблені пости з пагінацією
    $favorite_posts = array_slice($favorites, ($paged - 1) * $posts_per_page, $posts_per_page);

// Перевіряємо, чи є улюблені пости
    if (!empty($favorites[0]['posts'])) {
        echo '<p class="posts-title-text">Мої улюблені пости</p>';
        echo '<div class="favorite-posts">';

        // Проходимо через кожен улюблений пост
        foreach ($favorites[0]['posts'] as $post_id) {
            $post = get_post($post_id);

            if ($post) {
                echo '<div class="favorite-post" id="favorite-post-' . esc_attr($post_id) . '">';
                echo '<a href="' . esc_url(get_permalink($post)) . '">';
                echo get_the_post_thumbnail($post, 'thumbnail'); // Зображення
                echo '<p>' . esc_html(get_the_title($post)) . '</p>';
                echo '</a>';
                echo '<span class="remove-favorite" data-post-id="' . esc_attr($post_id) . '">&times;</span>';
                echo '</div>';
            }
        }

        ?>

        <head>
            <style type="text/css">
                .favorite-posts {
                    display: flex;
                    grid-template-columns: repeat(3, 1fr);
                    gap: 10px; /* Відстань між постами */
                    order: 0;
                }

                .favorite-post {
                    position: relative;
                    width: 200px; /* Ширина кожного блоку з постом */
                    padding: 10px;
                    border: 1px solid #ddd;
                    box-sizing: border-box;
                    transition: transform 0.3s ease,   color 0.3s ease;
                    text-align: center;
                }

                .favorite-post:hover {
                    transform: scale(1.05);
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                }

                .favorite-post img {
                    max-width: 100%; /* Масштабує зображення до ширини контейнера */
                    height: auto;
                }

                .remove-favorite {
                    display: none;
                    position: absolute;
                    top: 1px;
                    right: 1px;
                    font-size: 29px;
                    color: #ff4d4d;
                    cursor: pointer;
                    font-weight: bold;
                    transition: transform 0.3s ease,   color 0.3s ease;
                }
                .remove-favorite:hover {
                    transform: scale(1.2);
                }

                .favorite-post:hover .remove-favorite {
                    display: inline;
                }

                .posts-title-text {
                    font-size: 19px;
                    color: #046BD2;
                }
            </style>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const favoritePostsContainer = document.querySelector('.favorite-posts');

                    if (favoritePostsContainer) {
                        favoritePostsContainer.addEventListener('click', function (event) {
                            if (event.target.classList.contains('remove-favorite')) {
                                event.stopPropagation();
                                const postId = event.target.getAttribute('data-post-id');

                                if (event.target.classList.contains('processing')) {
                                    return;
                                }

                                event.target.classList.add('processing');

                                const xhr = new XMLHttpRequest();
                                xhr.open('POST', 'http://localhost/wordpress/wp-admin/admin-ajax.php', true);
                                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                                // Очікуємо відповідь у форматі JSON
                                xhr.responseType = 'json';  // Це встановлює формат відповіді як JSON

                                xhr.onreadystatechange = function () {
                                    if (xhr.readyState === XMLHttpRequest.DONE) {
                                        event.target.classList.remove('processing');

                                        if (xhr.status === 200) {
                                            try {
                                                // Якщо відповідь у форматі JSON, вона автоматично розпарситься
                                                const data = xhr.response;

                                                if (data.status === 'success') {
                                                    event.target.closest('.favorite-post').remove();

                                                    const favoriteCountElement = document.querySelector('#favorite-count');
                                                    if (favoriteCountElement) {
                                                        let currentCount = parseInt(favoriteCountElement.textContent, 10);
                                                        favoriteCountElement.textContent = currentCount - 1;
                                                    }
                                                } else {
                                                    alert(data.message || 'Не вдалося видалити пост.');
                                                }
                                            } catch (e) {
                                                console.error('Помилка парсингу JSON:', e);
                                                alert('Сталася помилка під час обробки відповіді сервера.');
                                            }
                                        } else {
                                            console.error('Помилка сервера:', xhr.status);
                                            alert('Сталася помилка під час видалення поста.');
                                        }
                                    }
                                };

                                // Формування тіла запиту
                                const params = `action=remove_favorite&post_id=${encodeURIComponent(postId)}`;
                                xhr.send(params);
                            }
                        });
                    }
                });

            </script>
        </head>

        <?php


        echo '</div>';
    } else {
        echo 'У вас немає улюблених постів.';
    }

}
add_shortcode('custom_user_favorites', 'custom_user_favorites');

//Створення AJAX-функції для видалення постів із улюблених
function remove_favorite_post() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['post_id']) || $_POST['action'] !== 'remove_favorite') {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
        wp_die();
    }

    $post_id = intval($_POST['post_id']);
    $user_id = get_current_user_id();

    if ($user_id === 0) {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
        wp_die();
    }

    $favorites = get_user_meta($user_id, 'simplefavorites', true);

    if ($favorites && !is_array($favorites)) {
        $favorites = unserialize($favorites);
    }

    if (!$favorites) {
        echo json_encode(['status' => 'error', 'message' => 'No favorites found']);
        wp_die();
    }

    // Зберігаємо стару копію для відповіді
    $old_favorites = $favorites;

    // Видаляємо пост з масиву
    if (isset($favorites[0]['posts']) && is_array($favorites[0]['posts'])) {
        $key = array_search($post_id, $favorites[0]['posts']);
        if ($key !== false) {
            unset($favorites[0]['posts'][$key]);
            $favorites[0]['posts'] = array_values($favorites[0]['posts']);
        }
    }

    // Видаляємо пост з груп
    if (isset($favorites[0]['groups']) && is_array($favorites[0]['groups'])) {
        foreach ($favorites[0]['groups'] as &$group) {
            if (isset($group['posts']) && is_array($group['posts'])) {
                $key = array_search($post_id, $group['posts']);
                if ($key !== false) {
                    unset($group['posts'][$key]);
                    $group['posts'] = array_values($group['posts']);
                }
            }
        }
        unset($group);
    }

    // Оновлюємо метаінформацію
    $updated_favorites = serialize($favorites);
    $update_success = update_user_meta($user_id, 'simplefavorites', $updated_favorites);

    if ($update_success) {
        // Формуємо `preview` та `response` у потрібному форматі
        $response = [
            'status' => 'success',
            'old_favorites' => $old_favorites,
            'favorites' => $favorites
        ];
        echo json_encode($response);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update favorites']);
    }

    wp_die();
}
add_action('wp_ajax_remove_favorite', 'remove_favorite_post');


// створення шорткоду для статичних постів
function custom_post_shortcode($atts) {
    // Атрибути шорткоду з дефолтними значеннями
    $atts = shortcode_atts(array(
        'id' => '',  // ID посту, який ви хочете відобразити
    ), $atts);

    // Перевірка, чи заданий ID
    if (!$atts['id']) {
        return 'ID посту не вказано!';
    }

    // Отримання посту за його ID
    $post_id = intval($atts['id']);
    $post = get_post($post_id);

    // Якщо пост існує, вивести його контент у вказаному форматі
    if ($post) {
        $content = '<div class="custom-post" id="custom-post-' . esc_attr($post_id) . '">';
        $content .= '<a href="' . esc_url(get_permalink($post)) . '">';
        $content .= get_the_post_thumbnail($post, 'thumbnail'); // Зображення
        $content .= '<p>' . esc_html(get_the_title($post)) . '</p>'; // Заголовок
        $content .= '</a>';
        $content .= '</div>';

        return $content;
    }

    return 'Пост не знайдений.';
}
add_shortcode('custom_post', 'custom_post_shortcode');


function custom_post_styles() {
    echo '
    <style type="text/css">
    .custom-post {
        display: flex; /* Flexbox для горизонтального вирівнювання елементів */
        justify-content: flex-start; /* Вирівнює елементи по горизонталі на ліво */
        align-items: center; /* Вирівнювання елементів по вертикалі (зображення та текст) */
        margin-bottom: 15px; /* Відстань між постами */
        padding: 10px;
        border: 1px solid #ddd; /* Рамка навколо кожного посту */
        border-radius: 5px; /* Краї з округленими кутами (опційно) */
        transition: transform 0.3s ease, color 0.3s ease;
        background-color: rgba(4, 107, 210, 0.07);
    }

    .custom-post:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(4, 107, 210, 0.3);
    }

    .custom-post img {
        max-width: 100px; /* Зображення меншого розміру */
        height: auto;
        margin-right: 15px; /* Відступ між зображенням і текстом */
        order: -1; /* Переміщає зображення вліво */
    }

    .custom-post p {
        margin: 0;
        font-size: 16px; /* Розмір шрифта для заголовка */
    }
    </style>
    ';
}
add_action('wp_head', 'custom_post_styles');


