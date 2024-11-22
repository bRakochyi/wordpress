jQuery(document).ready(function($) {
    // Обробник кліку по кнопці "Додати до улюблених"
    $('body').on('click', '.favorite-button', function() {
        var button = $(this);
        var post_id = button.data('post-id');

        // Відправка AJAX запиту
        $.ajax({
            url: myFavoritesData.ajaxurl,
            type: 'POST',
            data: {
                action: 'toggle_favorite',
                post_id: post_id,
            },
            success: function(response) {
                if (response.success) {
                    // Оновлення тексту кнопки
                    button.text(response.data.message);
                    // Зміна класу кнопки
                    if (button.hasClass('add-to-favorites')) {
                        button.removeClass('add-to-favorites').addClass('favorite-added');
                    } else {
                        button.removeClass('favorite-added').addClass('add-to-favorites');
                    }

                    // Оновлюємо список улюблених постів
                    update_favorite_posts();
                } else {
                    alert(response.data.message);
                }
            },
            error: function() {
                alert('Сталася помилка при обробці запиту.');
            }
        });
    });

    // Оновлення списку улюблених постів
    function update_favorite_posts() {
        $.ajax({
            url: myFavoritesData.ajaxurl,
            type: 'POST',
            data: {
                action: 'get_user_favorite_posts',
            },

            success: function(response) {
                // Виводимо відповідь як HTML
                $('.favorite-posts').html(response);
            },
        });
    }
});