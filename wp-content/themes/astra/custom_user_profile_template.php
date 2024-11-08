<?php
/*
 * Template name: Шаблон редактирования профиля пользователя
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

get_header();

if ( astra_page_layout() == 'left-sidebar' ) {
    get_sidebar();
}
?>

<?php
astra_primary_content_top();

astra_content_loop();

astra_pagination();

astra_primary_content_bottom();
		?>

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
<head>
    <style type="text/css">
        .background-form{
            padding: 20px; /* щоб забезпечити внутрішні відступи */
            border-radius: 10px; /* заокруглені кути, опціонально */
        }
        .edit-page-buttons {
            transition: transform 0.3s ease,   color 0.3s ease;
        }
        .edit-page-buttons:hover {
            transform: scale(1.2);
        }
        .edit-page-form {
            transition: transform 0.3s ease,   color 0.3s ease;
        }
        .edit-page-form:hover {
            transform: scale(1.03);
        }
        .text-color-h5 {
            color: #0452a0;
        }
    </style>
</head>
<body>
<?php
// после сохранения профиля и смены пароля понадобятся уведомления
// если уведомлений больше двух, то оптимальнее их будет вывести через switch
if( isset($_GET['status']) ) :
    switch( $_GET['status'] ) :
        case 'ok':{
            echo '<div style="color: blue" class="success">Збережено.</div>';
            break;
        }
        case 'exist':{
            echo '<div style="color: red" class="error">Користувач з вказаним email вже існує.</div>';
            break;
        }
        case 'short':{
            echo '<div style="color: red" class="error">Пароль занадто короткий.</div>';
            break;
        }
        case 'mismatch':{
            echo '<div style="color: red" class="error">Паролі не співпадають.</div>';
            break;
        }
        case 'required':{
            echo '<div style="color: red" class="error">Будь-ласка, заповніть всі обов\'язкові поля.</div>';
            break;
        }
    endswitch;
endif;

// profile-update.php - это файл, который находится в папке с темой и обрабатывает сохранение, его содержимое будет в следующем шаге
?>
<form class="background-form" action="<?php echo get_stylesheet_directory_uri() ?>/profile-update.php" method="POST">
    <h5 class="text-color-h5"> Для редагування, клацніть курсором мишки в будь-яке поле вводу і
        відредагуйте. </h5><br>
    <input type="text" class="edit-page-form" style="background-color: rgba(255, 255, 255, 0); color: #046bd2; "
           name="first_name" placeholder="Ім'я" value="<?php echo $userdata->first_name ?>"/>
    <p> </p>
    <input type="text" class="edit-page-form" style="background-color: rgba(255, 255, 255, 0); color: #046bd2; "
           name="last_name" placeholder="Прізвище" value="<?php echo $userdata->last_name ?>"/>
    <p> </p>
    <input type="email" class="edit-page-form" style="background-color: rgba(255, 255, 255, 0); color: #046bd2; "
           name="email" placeholder="Email" value="<?php echo $userdata->user_email ?>"/>
    <p> </p>
    <input type="text" class="edit-page-form" style="background-color: rgba(255, 255, 255, 0); color: #046bd2; "
           name="phone" placeholder="Телефон" value="<?php echo get_user_meta($user_ID, 'phone', true) ?>"/>
    <p> </p>
    <input type="password" class="edit-page-form" style="background-color: rgba(255, 255, 255, 0); color: #046bd2; "
           name="pwd2" placeholder="Новий пароль"/>
    <p> </p>
    <input type="password" class="edit-page-form" style="background-color: rgba(255, 255, 255, 0); color: #046bd2; "
           name="pwd3" placeholder="Повторіть новий пароль"/>

    <p> </p>
    <button class="edit-page-buttons" style="margin-right: 15px;">Зберегти</button>
    <input class="edit-page-buttons" type="button"
           onclick="window.location.href = 'http://localhost/wordpress/index.php/account'" value="Назад">
</form>
</body>
</html>
<?php
if ( astra_page_layout() == 'right-sidebar' ) :

    get_sidebar();

endif;

get_footer();