<?php
/*
 * Plugin Name: Custom plugin
 * Description: custom plugin for snippers
 * Version: 1.1.1
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * Text Domain: localhost
 * Domain Path: /languages
 *
 * Network: true
 */


/**
 * @snippet       Change logotype on store wp-login.php
 */
add_action( 'login_head', 'true_change_login_logo' );

function true_change_login_logo() {
    echo '<style>
	#login h1 a{
		background-image : url(http://localhost/wordpress/wp-content/uploads/2024/10/141174_company_logo_1.png);
		width: 200px;
		height: 100px;
	}
	</style>';
}

add_filter( 'login_headerurl', 'wpspec_custom_login_logo_url' );

function wpspec_custom_login_logo_url() {
    return 'http://localhost/wordpress/';
}

add_filter( 'login_headertext', 'wpspec_custom_login_logo_url_title' );

function wpspec_custom_login_logo_url_title() {
    return 'ТОВ ЛЕП';
}

// ДОДАВАННЯ ПОЛІВ РЕЄСТРАЦІЇ
/**
 * @snippet       Add fields in registration's form
 */
add_action( 'register_form', 'true_show_fields' );

function true_show_fields() {

    $first_name = ! empty( $_POST[ 'first_name' ] ) ? $_POST[ 'first_name' ] : '';
    $last_name = ! empty( $_POST[ 'last_name' ] ) ? $_POST[ 'last_name' ] : '';
    $phone = ! empty( $_POST[ 'phone' ] ) ? $_POST[ 'phone' ] : '';
    ?>
    <p>
        <label for="first_name">Ваше ім'я</label>
        <input type="text" id="first_name" name="first_name" class="input" value="<?php echo esc_attr( $first_name ) ?>" size="25" />
    </p>
    <p>
        <label for="last_name">Ваше прізвище</label>
        <input type="text" id="last_name" name="last_name" class="input" value="<?php echo esc_attr( $last_name ) ?>" size="25" />
    </p>
    <p>
        <label for="password">Пароль<br/>
            <input id="password" class="input" type="password" tabindex="30" size="25" value="" name="password"/>
        </label>
    </p>
    <p>
        <label for="repeat_password">Подтверждение пароля<br/>
            <input id="repeat_password" class="input" type="password" tabindex="40" size="25" value=""
                   name="repeat_password"/>
        </label>
    </p>
    <p>
        <label for="phone">Телефон</label>
        <input type="text" id="phone" name="phone" class="input" value="<?php echo esc_attr( $phone ) ?>" size="25" />
    </p>
    <?php
}

// Додавання валідації у поля форми

add_filter( 'registration_errors', 'true_check_fields', 25, 3 );

function true_check_fields( $errors, $sanitized_user_login, $user_email ) {

    if ( $_POST['password'] !== $_POST['repeat_password'] )
    {
        $errors->add( 'passwords_not_matched', "<strong>Помилка:</strong>: Паролі мають збігатися" );
    }
    if ( strlen( $_POST['password'] ) < 4 )
    {
        $errors->add( 'password', "<strong>Помилка:</strong>: Довжина паролів має бути не менше чотирьох символів" );
    }
    /*
     * Функція перевірки полів, щоб вони були заповнені
     */

    if( empty( $_POST[ 'phone' ] ) &&  empty( $_POST[ 'first_name' ] ) && empty( $_POST[ 'last_name' ] )) {
        $errors->add( 'empty_phone', '<strong>Помилка:</strong> Будь ласка, вкажіть номер телефону.' );
        $errors->add( 'empty_first_name', '<strong>Помилка:</strong> Будь ласка, вкажіть ваше ім\'я.' );
        $errors->add( 'empty_last_name', '<strong>Помилка:</strong> Будь ласка, вкажіть ваше прізвище.' );
    }

    return $errors;

}
add_action( 'register_post', 'true_check_fields', 10, 3 );

// Записування значень полів в метадані, для вже створених користувачів

add_action( 'user_register', 'true_register_fields', 100 );

function true_register_fields( $user_id ) {
    $userdata       = [];
    $userdata['ID'] = $user_id;
    if ( $_POST['password'] !== '' ) {
        $userdata['user_pass'] = $_POST['password'];
    }
    wp_update_user( $userdata );
    wp_set_auth_cookie( $user_id );
    update_user_meta( $user_id, 'phone', sanitize_text_field( $_POST[ 'phone' ] ) );
    update_user_meta( $user_id, 'first_name', sanitize_text_field( $_POST[ 'first_name' ] ) );
    update_user_meta( $user_id, 'last_name', sanitize_text_field( $_POST[ 'last_name' ] ) );

}


// ДОДАВАННЯ ПОЛІВ РЕЄСТРАЦІЇ В АДМІНКУ САЙТУ

/**
 * @snippet       Додавання полів реєстрації в адмінку сайту.
 */
add_action( 'user_new_form', 'true_admin_registration_form' );

function true_admin_registration_form( $operation ) {

    if ( 'add-new-user' !== $operation ) {
        // $operation може також приймати значення 'add-existing-user' для мультисайту
        return;
    }

    $phone = ! empty( $_POST[ 'phone' ] ) ? $_POST[ 'phone' ] : '';

    ?>
    <h3>Дополнительная информация</h3>

    <table class="form-table">
        <tr class="form-field">
            <th><label for="phone">Телефон</label></th>
            <td><input id="phone" name="phone" class="input" type="text" placeholder="Телефон" value="<?php echo esc_attr( $phone ) ?>" /></td>
        </tr>
    </table>
    <?php
}

// Валідація полів в адмінці

add_action( 'user_profile_update_errors', 'true_validate_fields_in_admin', 10, 3 );

function true_validate_fields_in_admin( $errors, $update, $user ) {

    if ( $update ) {
        return;
    }


    if( empty( $_POST[ 'phone' ] ) ) {
        $errors->add( 'empty_phone', '<strong>ОШИБКА:</strong> Пожалуйста, укажите номер телефона.' );
    }
}

// Збереження даних полів введення

add_action( 'edit_user_created_user', 'save_register_fields' );
// add_action( 'user_register', 'save_register_fields' );

function save_register_fields( $user_id ) {

    update_user_meta( $user_id, 'phone', sanitize_text_field( $_POST[ 'phone' ] ) );

}

// відключення відправки емейл після реєстрації
if (!function_exists('wp_new_user_notification')) {
    function wp_new_user_notification($user_id, $deprecated = null, $notify = '') {
        return; // Відключає відправку листа
    }
}
add_filter('send_password_change_email', '__return_false');
