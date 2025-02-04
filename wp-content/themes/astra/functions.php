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
require_once "remove_roles.php";
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

        // Визначення ролі на основі масиву options
        $options = [
            'tov_lep' => [
                "Відділ постачання" => [
                    "manager_postachaniia_vp" => "Менеджер з постачання",
                    "office_admin_vp" => "Офісний адміністратор",
                    "ing_comp_sys_vp" => "Інженер комп'ютерних систем",
                    "designer_graf_vp" => "Дизайнер графіки",
                    "manager_zbutu_vp" => "Менеджер із збуту",
                    "marketolog_vp" => "Маркетолог"
                ],
                "Відділ дистриб'юції" => [
                    "manager_zbutu_vd" => "Менеджер із збуту",
                    "ing_comp_sys_vd" => "Інженер комп'ютерних систем",
                    "bukhhalter_vd" => "Бухгалтер",
                    "region_manager_zbutu_vd" => "Регіональний менеджер із збуту"
                ],
                "Офісний відділ" => [
                    "manager_zbutu_of" => "Менеджер із збуту",
                    "economist_of" => "Економіст",
                    "nachalnic_viddilu_of" => "Начальник відділу"
                ],
                "Технічний відділ" => [
                    "zav_po_hosp_tv" => "Завідуючий по господарчій частині",
                    "el_mont_rozpod_pr_tv" => "Електромонтажник розподільчих пристроїв",
                    "nachalnic_viddilu_tv" => "Начальник відділу",
                    "ing_comp_sys_tv" => "Інженер компютерних систем",
                    "ingener_construct_tv" => "Інженер конструктор"
                ],
                "Складський відділ" => [
                    "golov_komirnuk_sv" => "Головний комірник",
                    "starsh_komirnuk_sv" => "Старший комірник",
                    "komirnuk_sv" => "Комірник"
                ],
                "Адміністрація" => [
                    "director_ad" => "Директор",
                    "zastup_directora_ad" => "Заступник директора"
                ],
                "Магазин Амперок" => [
                    "manager_zbutu_ma" => "Менеджер із збуту",
                    "ing_comp_sys_ma" => "Інженер компютерних систем",
                    "admin_amperok_ma" => "Адміністратор",
                    "paymaster_zalu_ma" => "Касир залу",
                    "bukhhalter_ma" => "Бухгалтер"
                ],
                "Транспортний відділ" => [
                    "vodiy_tra" => "Водій",
                    "dispetcher_tra" => "Диспетчер",
                    "Ingener_praci_tra" => "Інженер з охорони праці",
                    "mekhanik_tra" => "Механік",
                    "ekspeditor_tra" => "Експедитор",
                    "medsestra_tra" => "Медсестра"
                ],
                "Бухгалтерія" => [
                    "logist_bukh" => "Логіст",
                    "bukhhalter_bukh" => "Бухгалтер",
                    "programist_bukh" => "Програміст",
                    "ing_comp_sys_bukh" => "Інженер компютерних систем",
                    "economist_bukh" => "Економіст",
                    "golov_bukhhalter_bukh" => "Головний бухгалтер"
                ],
                "Інтернет магазин" => [
                    "manager_zbutu_int" => "Менеджер із збуту"
                ],
                "Сервісний відділ" => [
                    "mont_radioel_pr_serv" => "Монтажник радіоелектронних апаратів та приладів",
                    "nachalnic_viddilu_serv" => "Начальник відділу"
                ]
            ],
            'eloter' => [
                "Елотер" => [
                    "director_el" => "Директор",
                    "golov_bukhhalter_el" => "Головний бухгалтер",
                    "bukhhalter_el" => "Бухгалтер",
                    "manager_postachaniia_el" => "Менеджер з постачання",
                    "economist_el" => "Економіст",
                    "ingener_el" => "Інженер",
                    "manager_zbutu_el" => "Менеджер із збуту",
                    "office_admin_el" => "Офіс адміністратор",
                    "ekspeditor_el" => "Експедитор",
                    "ing_comp_sys_el" => "Інженер компютерних систем",
                    "komirnuk_el" => "Комірник",
                    "starsh_komirnuk_el" => "Старший комірник",
                    "manager_logist_el" => "Менеджер з логістики"
                ]
            ]
        ];

        // Визначаємо ключ ролі
        $role = '';
        if (isset($options[$organization][$department])) {
            $roles_list = $options[$organization][$department];
            $role = array_search($selected_role, $roles_list);
        }

        // Призначаємо роль користувачу
        if ($role && array_key_exists($role, wp_roles()->roles)) {
            $user = new WP_User($user_id);
            $user->set_role($role);
        }
    }
}
add_action('user_register', 'save_user_role');

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



// Переключення версії JQuery
function load_custom_jquery() {
    // Відключаємо стандартну версію jQuery WordPress
    wp_deregister_script('jquery');

    // Підключаємо стару версію jQuery (1.12.4)
    wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', false, null, true);
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'load_custom_jquery');




/**
 *
 * Створення механізму додавання в улюблені пости і таж їх видалення
 *
 */
function display_favorite_button($content) {
    global $post;
    $user_id = get_current_user_id();

    // Перевіряємо, чи користувач авторизований і чи є поточна сторінка постом
    if (is_single() && $user_id > 0) {
        $favorites = get_user_meta($user_id, 'customfavorites', true) ?: [];

        // Перевіряємо, чи є поточний пост в улюблених
        $is_favorite = in_array($post->ID, $favorites);

        // Кнопка для додавання або видалення
        $button_text = $is_favorite ? 'Додано' : 'Додати до улюблених';
        $button_class = $is_favorite ? 'favorite-added' : 'add-to-favorites';


        // Вставляємо HTML кнопки перед контентом
        // Оновлений HTML для кнопки
        $favorite_button = '<button class="favorite-button ' . $button_class . '" data-post-id="' . esc_attr($post->ID) . '">' . esc_html($button_text) . '</button>';

        wp_enqueue_style('add-favorites-added', get_template_directory_uri() . '/assets/css/add-favorites-added.css');

        // Додаємо кнопку перед контентом
        $content = $favorite_button . $content;
    }

    return $content;
}
add_filter('the_content', 'display_favorite_button');

// Функція для обробки AJAX запиту
// Оновлений хендлер для обробки додавання/видалення з улюблених
function handle_favorite_button_click() {
    // Перевірка, чи користувач авторизований
    if (!is_user_logged_in()) {
        wp_send_json_error(array('message' => 'Ви повинні бути авторизовані.'));
    }

    $user_id = get_current_user_id();
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;

    if (!$post_id) {
        wp_send_json_error(array('message' => 'Невірний ID поста.'));
    }

    $favorites = get_user_meta($user_id, 'customfavorites', true) ?: [];

    if (in_array($post_id, $favorites)) {
        // Видалити з улюблених
        $favorites = array_diff($favorites, array($post_id));
        update_user_meta($user_id, 'customfavorites', $favorites);
        wp_send_json_success(array('message' => 'Додати до улюблених'));
    } else {
        // Додати до улюблених
        $favorites[] = $post_id;
        update_user_meta($user_id, 'customfavorites', $favorites);
        wp_send_json_success(array('message' => 'Додано'));
    }
}

add_action('wp_ajax_toggle_favorite', 'handle_favorite_button_click');


// Додаємо скрипт для обробки AJAX запиту
function add_favorite_button_ajax_script() {
    wp_enqueue_script('add-favorite-button-ajax', get_template_directory_uri() . '/assets/js/add-favorite-button-ajax.js', array('jquery'), null, true);
    wp_localize_script('add-favorite-button-ajax', 'myFavoritesData', [
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('custom_favorites_nonce'),
    ]);
}
add_action('wp_footer', 'add_favorite_button_ajax_script'); // Підключаємо скрипт в footer




function get_user_favorite_posts() {
    $user_id = get_current_user_id();

    if ($user_id === 0) {
        echo '<p>Ви не авторизовані.</p>';
        exit;
    }

    // Отримуємо улюблені пости з мета-даних користувача
    $favorites = get_user_meta($user_id, 'customfavorites', true) ?: [];

    if (empty($favorites)) {
        echo '<p style="font-size:20px; color: #046BD2;">У вас немає улюблених постів.</p>';
    } else {
        echo '<p style="font-size:20px; color: #046BD2;">Мої улюблені пости</p>';
    }

    // Формуємо HTML для улюблених постів
    $favorite_posts_html = '<div class="favorite-posts">';
    foreach ($favorites as $post_id) {
        $post = get_post($post_id);

        if ($post) {
            $favorite_posts_html .= '<div class="favorite-post" id="favorite-post-' . esc_attr($post_id) . '">';
            $favorite_posts_html .= '<a href="' . esc_url(get_permalink($post)) . '">';
            $favorite_posts_html .= '<p>' . esc_html(get_the_title($post)) . '</p>';
            $favorite_posts_html .= '</a>';
            $favorite_posts_html .= '<span class="remove-favorite" data-post-id="' . esc_attr($post_id) . '">&times;</span>';
            $favorite_posts_html .= '</div>';
        }
    }
    $favorite_posts_html .= '</div>';
    wp_enqueue_script('remove-all-posts', get_template_directory_uri() . '/assets/js/remove-all-posts.js', array('jquery'), null, true);
    wp_localize_script('remove-all-posts', 'myFavoritesData', [
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('custom_favorites_nonce'),
    ]);
    wp_enqueue_style('favorites-posts-list', get_template_directory_uri() . '/assets/css/favorites-posts-list.css');

    // Виводимо HTML
    echo $favorite_posts_html;
}

add_action('wp_ajax_get_user_favorite_posts', 'get_user_favorite_posts');


function favorite_remove_all_button(): string {
    // Перевіряємо, чи є користувач авторизованим
    $user_id = get_current_user_id();
    if ($user_id === 0) {
        return '<p>Ви не авторизовані.</p>';
    }

    // Отримуємо улюблені пости користувача
    $favorites = get_user_meta($user_id, 'customfavorites', true) ?: [];

    // Якщо немає улюблених постів, не виводимо кнопку
    if (empty($favorites)) {
        return '';
    }

    // HTML для кнопки "Все видалити"
    $button_html = '<button class="remove-all-favorites-button" id="remove-all-favorites">Все видалити</button>';

    // Підключаємо стилі через wp_enqueue_style
    wp_enqueue_style('remove-all-favorites-style', get_template_directory_uri() . '/assets/css/remove-all-favorites.css');

    return $button_html;
}

add_shortcode('remove_all_favorites', 'favorite_remove_all_button');





function custom_user_favorites_shortcode() {
    if (is_admin()) {
        return ''; // Не виводити нічого в адмінці
    }
    ob_start();
    get_user_favorite_posts(); // Виводить HTML
    return ob_get_clean(); // Повертає результат виведення
}
add_shortcode('custom_user_favorites', 'custom_user_favorites_shortcode');


// Локалізуємо ajaxurl
function custom_favorites_scripts() {
    wp_enqueue_script('custom-favorites', get_template_directory_uri() . '/assets/js/custom_favorites.js', ['jquery'], null, true);
    wp_localize_script('custom-favorites', 'myFavoritesData', [
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('custom_favorites_nonce'),
    ]);
}
add_action('wp_enqueue_scripts', 'custom_favorites_scripts');

// Функція для додавання постів до улюблених
function add_to_favorites() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['post_id']) || $_POST['action'] !== 'add_favorite') {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
        wp_die();
    }

    check_ajax_referer('custom_favorites_nonce', 'security');

    $post_id = intval($_POST['post_id']);
    $user_id = get_current_user_id();

    if ($user_id === 0) {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
        wp_die();
    }

    $favorites = get_user_meta($user_id, 'customfavorites', true);

    if (!$favorites || !is_array($favorites)) {
        $favorites = [];
    }

    if (!in_array($post_id, $favorites)) {
        $favorites[] = $post_id;
        update_user_meta($user_id, 'customfavorites', $favorites);
        echo json_encode(['status' => 'success', 'message' => 'Post added to favorites']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Post is already in favorites']);
    }

    wp_die();
}
add_action('wp_ajax_add_favorite', 'add_to_favorites');

//Створення AJAX-функції для видалення постів із улюблених
function remove_favorite_post() {
    if (!check_ajax_referer('custom_favorites_nonce', 'security', false)) {
        wp_send_json_error(['message' => 'Неправильний нонсе.'], 403);
    }

    $post_id = intval($_POST['post_id']);
    $user_id = get_current_user_id();

    if (!$user_id || !$post_id) {
        wp_send_json_error(['message' => 'Некоректні дані.'], 400);
    }

    $favorites = get_user_meta($user_id, 'customfavorites', true) ?: [];
    if (!in_array($post_id, $favorites)) {
        wp_send_json_error(['message' => 'Цього посту немає в улюблених.']);
    }

    // Видаляємо пост з масиву улюблених
    $favorites = array_diff($favorites, [$post_id]);
    update_user_meta($user_id, 'customfavorites', $favorites);

    // Якщо улюблених постів більше немає, очищаємо customfavorites
    if (empty($favorites)) {
        delete_user_meta($user_id, 'customfavorites');
    }

    wp_send_json_success(['message' => 'Пост успішно видалено.']);
}


add_action('wp_ajax_remove_favorite_post', 'remove_favorite_post');


function remove_all_favorites() {
    if (!check_ajax_referer('custom_favorites_nonce', 'security', false)) {
        wp_send_json_error(['message' => 'Неправильний нонсе.'], 403);
    }

    $user_id = get_current_user_id();
    if ($user_id === 0) {
        wp_send_json_error(['message' => 'Ви не авторизовані.']);
    }

    // Очищуємо улюблені пости
    delete_user_meta($user_id, 'customfavorites');

    wp_send_json_success(['message' => 'Усі пости видалено.']);
}

add_action('wp_ajax_remove_all_favorites', 'remove_all_favorites');


// Функція для виведення кількості улюблених постів
function favorite_count_shortcode()
{
    $user_id = get_current_user_id();

    // Якщо користувач авторизований
    if ($user_id !== 0) {
        // Отримуємо улюблені пости користувача
        $favorites = get_user_meta($user_id, 'customfavorites', true) ?: [];
        // Кількість улюблених постів
        $favorite_count = count($favorites);
    } else {
        // Якщо користувач не авторизований, кількість = 0
        $favorite_count = 0;
    }
    wp_enqueue_script('favorite-count', get_template_directory_uri() . '/assets/js/favorite-count.js', array('jquery'), null, true);
    wp_localize_script('favorite-count', 'myFavoritesData', [
        'ajaxurl' => admin_url('admin-ajax.php')
    ]);
//     Повертаємо кількість улюблених постів
    return $favorite_count;
}

// Реєстрація шорткоду [favorite_count]
add_shortcode('favorite_count', 'favorite_count_shortcode');


function update_favorite_count() {
    $user_id = get_current_user_id();

    // Перевіряємо, чи користувач авторизований
    if ($user_id !== 0) {
        // Отримуємо улюблені пости користувача
        $favorites = get_user_meta($user_id, 'customfavorites', true) ?: [];

        // Повертаємо кількість улюблених постів
        echo count($favorites);
    } else {
        echo 0;
    }

    wp_die(); // Завершуємо виконання після AJAX запиту
}

add_action('wp_ajax_update_favorite_count', 'update_favorite_count');



/**
 *
 * Створення шорткоду для статичних постів
 *
 */
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
    wp_enqueue_style('custom-post-style', get_template_directory_uri() . '/assets/css/custom-post-style.css');
}
add_action('wp_head', 'custom_post_styles');


