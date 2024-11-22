// Функція для оновлення лічильника улюблених постів
function updateFavoriteCount() {
    jQuery.ajax({
        url: myFavoritesData.ajaxurl, // Вбудована змінна WordPress для AJAX
        type: 'POST',
        data: {
            action: 'update_favorite_count' // Вказуємо дію для AJAX
        },
        success: function(response) {
            // Оновлюємо лічильник на сторінці
            jQuery('.sub-superscript').text(response);
        },
        error: function() {
            console.log("Помилка при виконанні AJAX запиту");
        }
    });
}
/// Викликаємо функцію для оновлення лічильника при додаванні або видаленні поста з улюблених
jQuery(document).on('click', '.add-to-favorites, .favorite-added', function() {
    updateFavoriteCount(); // Оновлюємо лічильник після додавання або видалення поста
});

jQuery(document).on('click', '.remove_favorite', function() {
    updateFavoriteCount(); // Оновлюємо лічильник після видалення поста
});


