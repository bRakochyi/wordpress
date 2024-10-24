<?php
/*
 * Template name: Шаблон личного кабинета пользователя
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
            TABLE {
                border: none !important;
            }
            <style type="text/css">
            TABLE {
                width: 300px; /* Ширина таблицы */
            }
            TD, TH {
                text-align: left; /* Выравнивание по левому краю */
                border-collapse: collapse; /* Убираем двойные линии между ячейками */
                border: none !important; /* Прячем рамку вокруг таблицы */
            }
        </style>
    </head>
    <body>

    <table class="form-table">

        <tr><th><label for="first_name">Ваше ім'я</label></th>
            <td><input type="text" name="first_name" id="first_name" readonly="readonly" value="<?php echo $userdata->first_name ?>" class="regular-text" /></td>
        </tr>
        <tr><th><label for="last_name">Ваше прізвище</label></th>
            <td><input type="text" name="last_name" id="last_name" readonly="readonly" value="<?php echo $userdata->last_name ?>" class="regular-text" /></td>
        </tr>
        <tr><th><label for="email">Ваша електронна пошта</label></th>
            <td><input type="text" name="email" id="email" readonly="readonly" value="<?php echo $userdata->user_email ?>" class="regular-text" /></td>
        </tr>
        <tr><th><label for="phone">Ваш номер телефону</label></th>
            <td><input type="text" name="phone" id="phone" readonly="readonly" value="<?php echo get_user_meta($user_ID, 'phone', true) ?>" class="regular-text" /></td>
        </tr>
        <tr><th><label>Для зміни Ваших даних натисніть </label></th>
            <td>
                <form action="http://localhost/wordpress/index.php/edit-account">
                    <button>змінити</button>
                </form>
            </td>
        </tr>
    </table>
    </body>
    </html>
<?php
if ( astra_page_layout() == 'right-sidebar' ) :

    get_sidebar();

endif;

get_footer();
