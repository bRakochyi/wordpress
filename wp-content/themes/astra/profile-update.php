<?php
// $_SERVER['HTTP_REFERER'] - повний URL сторінки, звідки прийшов користувач
// $url[0] - без GET параметрів
// це для правильних редіректів
$url = explode("?",$_SERVER['HTTP_REFERER']);

// підключання WordPress
// тут вказаний правильний шлях, якщо profile-update.php знаходится безпосередньо в папці з темою
require_once( dirname(__FILE__) . '/../../../wp-load.php' );

// якщо користувач не авторизований то виходить з файлу
if( !is_user_logged_in() ) exit;

// отримання об'єків даних користувача
$user_ID = get_current_user_id();
$user = get_user_by( 'id', $user_ID );

// сначала обработаем пароли, ведь если при сохранении пользователь ничего не указал ни в одном поле пароля, то пропускаем эту часть
if( $_POST['pwd2'] || $_POST['pwd3'] ) {

    // при этом пользователь должен заполнить все поля
    if( $_POST['pwd2'] && $_POST['pwd3'] ) {

        // сначала проверяем соответствие нового пароля и его подтверждения
        if( $_POST['pwd2'] == $_POST['pwd3'] ){

            // пароль из двух символов нам не нужен, минимум 4
            if( strlen( $_POST['pwd2'] ) < 4 ) {
                // если слишком короткий - перенаправляем
                header('location:' . $url[0] . '?status=short');
                exit;
            }

            // и самое главное - проверяем, правильно ли указан старый пароль
            if( wp_check_password( $_POST['pwd1'], $user->data->user_pass, $user->ID) ) {
                // если да, меняем на новый и заново авторизуем пользователя
                wp_set_password( $_POST['pwd2'], $user_ID );
                $creds['user_login'] = $user->user_login;
                $creds['user_password'] = $_POST['pwd2'];
                $creds['remember'] = true;
                $user = wp_signon( $creds, false );
            } else {
                // если нет, перенаправляем на ошибку
                header('location:' . $url[0] . '?status=wrong');
                exit;
            }

        } else {
            // новый пароль и его подтверждение не соответствуют друг другу
            header('location:' . $url[0] . '?status=mismatch');
            exit;
        }

    } else {
        // не все поля заполнены - перенеправляем
        header('location:' . $url[0] . '?status=required');
        exit;
    }
}

// допустим, что Имя, Фамилия и Емайл - обязательные поля
if( $_POST['first_name'] && $_POST['last_name'] && is_email($_POST['email']) ) {

    // если пользователь указал новый емайл, а кто-то уже под ним зареган - отправляем на ошибку
    if( email_exists( $_POST['email'] ) && $_POST['email'] != $user->user_email ) {
        header('location:' . $url[0] . '?status=exist');
        exit;
    }


    // обновляем данные пользователя
    wp_update_user( array(
        'ID' => $user_ID,
        'user_email' => $_POST['email'],
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'display_name' => $_POST['first_name'] . ' ' . $_POST['last_name'] ));

    // ну не забываем обновить
    update_user_meta($user_ID, 'phone', $_POST['phone']);
} else {
    // не все поля заполнены - перенеправляем
    header('location:' . $url[0] . '?status=required');
    exit;
}


// если выполнение кода дошло до сюда, то следовательно всё ок
header('location:' . $url[0] . '?status=ok');
exit;