document.addEventListener('DOMContentLoaded', function () {
    const favoritePostsContainer = document.querySelector('.favorite-posts');

    if (favoritePostsContainer) {
        favoritePostsContainer.addEventListener('click', function (event) {
            // Перевіряємо, чи натиснуто хрестик
            if (event.target.classList.contains('remove-favorite')) {
                event.preventDefault();

                const postId = event.target.getAttribute('data-post-id');
                const security = myFavoritesData.nonce;

                // AJAX-запит для видалення посту
                fetch(myFavoritesData.ajaxurl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        action: 'remove_favorite_post', // PHP-обробник
                        post_id: postId, // ID посту
                        security: security, // Нонсе
                    }),
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Видаляємо HTML посту
                            const postElement = document.getElementById(`favorite-post-${postId}`);
                            if (postElement) {
                                postElement.remove();
                                updateFavoriteCount();
                            }

                            // Перевіряємо, чи залишилися ще пости
                            const remainingPosts = favoritePostsContainer.querySelectorAll('.favorite-post');
                            if (remainingPosts.length === 0) {
                                // Перезавантажуємо сторінку
                                window.location.reload();
                            }
                        } else {
                            alert(data.message || 'Не вдалося виконати дію.');
                        }
                    })
                    .catch(error => {
                        console.error('Помилка:', error);
                        alert('Сталася помилка.');
                    });
            }
        });
    }
});




