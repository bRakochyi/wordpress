document.addEventListener('DOMContentLoaded', function () {
    const removeAllButton = document.getElementById('remove-all-favorites');
    const favoritePostsContainer = document.querySelector('.favorite-posts');

    if (removeAllButton) {
        removeAllButton.addEventListener('click', function () {
            // Забороняємо повторний запит
            if (removeAllButton.disabled) return;

            const security = myFavoritesData.nonce;
            removeAllButton.disabled = true; // Вимикаємо кнопку під час запиту

            // AJAX-запит для видалення всіх постів
            fetch(myFavoritesData.ajaxurl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'remove_all_favorites', // PHP-обробник
                    security: security, // Нонсе
                }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Очищуємо контейнер з постами
                        favoritePostsContainer.innerHTML = '';
                        removeAllButton.style.display = 'none'; // Ховаємо кнопку

                        // Перезавантажуємо сторінку після успішного запиту
                        window.location.reload();
                    }
                })
                .catch(error => {
                    console.error('Помилка:', error);
                })
                .finally(() => {
                    removeAllButton.disabled = false; // Увімкнути кнопку після завершення запиту
                });
        });
    }
});