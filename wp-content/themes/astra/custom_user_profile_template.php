<?php
/*
 * Template name: Шаблон профиля пользователя
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

get_header();

if ( astra_page_layout() == 'left-sidebar' ) {
    get_sidebar();
}
?>

<div id="primary" <?php astra_primary_class(); ?>>
		<?php
		astra_primary_content_top();

		astra_content_loop();

		astra_pagination();

		astra_primary_content_bottom();
		?>
	</div><!-- #primary -->

<?php
global $user_ID;

// если пользователь не авторизован, отправляем его на страницу входа
if( !$user_ID ) {
    header('location:' . site_url() . '/wp-login.php');
    exit;
} else {
    $userdata = get_user_by( 'id', $user_ID );
}
?>
<html>
<body>
<?php
// после сохранения профиля и смены пароля понадобятся уведомления
// если уведомлений больше двух, то оптимальнее их будет вывести через switch
if( isset($_GET['status']) ) :
    switch( $_GET['status'] ) :
        case 'ok':{
            echo '<div class="success">Сохранено.</div>';
            break;
        }
        case 'exist':{
            echo '<div class="error">Пользователь с указанным email уже существует.</div>';
            break;
        }
        case 'short':{
            echo '<div class="error">Пароль слишком короткий.</div>';
            break;
        }
        case 'mismatch':{
            echo '<div class="error">Пароли не совпадают.</div>';
            break;
        }
        case 'wrong':{
            echo '<div class="error">Старый пароль неверен.</div>';
            break;
        }
        case 'required':{
            echo '<div class="error">Пожалуйста, заполните все обязательные поля.</div>';
            break;
        }
    endswitch;
endif;

// profile-update.php - это файл, который находится в папке с темой и обрабатывает сохранение, его содержимое будет в следующем шаге
?>
<form action="<?php echo get_stylesheet_directory_uri() ?>/profile-update.php" method="POST">
    <input type="text" name="first_name" placeholder="Имя" value="<?php echo $userdata->first_name ?>" />
    <input type="text" name="last_name" placeholder="Фамилия" value="<?php echo $userdata->last_name ?>" />
    <input type="text" name="job-title" placeholder="Должность" value="<?php echo get_user_meta($user_ID, 'job-title', true ) ?>" />
    <input type="email" name="email" placeholder="Email" value="<?php echo $userdata->user_email ?>" />
    <input type="text" name="phone" placeholder="Телефон" value="<?php echo get_user_meta($user_ID, 'phone', true)?>" />

    <input type="password" name="pwd1" placeholder="Старый пароль" />
    <input type="password" name="pwd2" placeholder="Новый пароль" />
    <input type="password" name="pwd3" placeholder="Повторите новый пароль" />

    <button>Сохранить</button>
</form>
</body>
</html>
<?php
if ( astra_page_layout() == 'right-sidebar' ) :

    get_sidebar();

endif;

get_footer();