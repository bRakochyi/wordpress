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

            TR, TD, TH {
                height: 30px;
                text-align: left; /* Выравнивание по левому краю */
                border-collapse: collapse; /* Убираем двойные линии между ячейками */
                border: none !important; /* Прячем рамку вокруг таблицы */
                background-color: rgba(255, 255, 255, 0.1);
            }
            .edit-button {
                color: #046bd2;
                transition: transform 0.3s ease,   color 0.3s ease;
            }
            .edit-button:hover {
                transform: scale(1.1);
            }
            .text-color {
                color: #046bd2;
            }
            .text-color-h4 {
                color: #0452a0;
            }
        </style>
    </head>
    <body>

    <table class="form-table">

        <tr><th><h4 class="text-color-h4"> Тут виводиться інформація про ваш профіль</h4></tr>
        <tr><th><p class="text-color" for="first_name">Ваше ім'я</p></th>
            <td><p class="text-color"> <?php echo $userdata->first_name ?></p></td>
        </tr>
        <tr><th><p class="text-color" for="last_name">Ваше прізвище</p></th>
            <td><p class="text-color"><?php echo $userdata->last_name ?></p></td>
        </tr>
        <tr><th><p class="text-color" for="email">Ваша електронна пошта</p></th>
            <td><p class="text-color"><?php echo $userdata->user_email ?></p></td>
        </tr>
        <tr><th><p class="text-color" for="phone">Ваш номер телефону</p></th>
            <td><p class="text-color"><?php echo get_user_meta($user_ID, 'phone', true) ?></p></td>
        </tr>
        <tr><th><p class="text-color">Для зміни Ваших даних натисніть кнопку "Змінити"</p></th>
            <td>
                <form class="edit-button" action="http://localhost/wordpress/index.php/edit-account">
                    <button>Змінити</button>

                </form>
            </td>
        </tr>
        <tr><th><p class="text-color">Щоб переглянути збережені (улюблені) інструкції натисніть "Перейти"</p></th>
            <td>
                <form class="edit-button" action="http://localhost/wordpress/index.php/my-favorites">
                    <button>Перейти</button>

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
//test comment
