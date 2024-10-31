<?php
?>
<html>
<body>
<p>
    <label for="select1">Виберіть організацію:</label>
    <select id="select1" name="organization">
        <option value="">Оберіть...</option>
        <option value="tov_lep">ТОВ "ЛЕП"</option>
        <option value="eloter">ЕЛОТЕР</option>
        <option value="amperok">АМПЕРОК</option>
    </select>

    <label for="select2" style="display: none;">Виберіть відділ:</label>
    <select id="select2" name="department" style="display: none;">
        <option value="">Оберіть...</option>
    </select>

    <label for="select3" style="display: none;">Виберіть посаду:</label>
    <select id="select3" name="role" style="display: none;">
        <option value="">Оберіть...</option>
    </select>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const select1 = document.getElementById("select1");
            const select2 = document.getElementById("select2");
            const select3 = document.getElementById("select3");

            const options = {
                tov_lep: {
                    'Відділення дистриб\'юції': ["Менеджер дистриб'юції"],
                    "Відділення постачання": ["Менеджер постачання"],
                    "Офісний відділ": ["Працівник офісу"],
                    "Дирекція": ["Директор"],
                    "Бухгалтерія": ["Бухгалтер", "Касир ЛЕП"],
                    "Технічний відділ": ["Технік"],
                    "Транспортний відділ": ["Механік", "Водій"],
                    "Охорона": ["Охоронець"],
                    "Складський відділ": ["Працівник складу"]
                },
                eloter: {
                    "Елотер": ["Працівник елотер"]
                },
                amperok: {
                    "Амперок магазин": ["Адміністратор амперок магазин", "Менеджер амперок магазин", "Касир амперок магазин", "Працівник амперок магазин"],
                    "Амперок інтернет": ["Адміністратор амперок інтернет", "Менеджер амперок інтернет", "Контент менеджер амперок інтернет"]
                }
            };

            // Функція для заповнення опцій у списку
            function populateSelect(select, items) {
                select.innerHTML = '<option value="">Оберіть...</option>'; // Очищаємо попередні варіанти
                items.forEach(item => {
                    const option = document.createElement("option");
                    option.value = item;
                    option.textContent = item;
                    select.appendChild(option);
                });
            }

            // Обробник подій для першого вибору
            select1.addEventListener("change", function() {
                select2.style.display = "none"; // Приховуємо другий вибір
                select2.previousElementSibling.style.display = "none";
                select3.style.display = "none"; // Приховуємо третій вибір
                select3.previousElementSibling.style.display = "none";
                select2.innerHTML = '<option value="">Оберіть...</option>'; // Очищаємо другий вибір
                select3.innerHTML = '<option value="">Оберіть...</option>'; // Очищаємо третій вибір

                if (select1.value) {
                    select2.style.display = "block"; // Показуємо другий вибір
                    select2.previousElementSibling.style.display = "block";
                    const types = Object.keys(options[select1.value]); // Отримуємо типи
                    populateSelect(select2, types); // Заповнюємо другий вибір
                }
            });

            // Обробник подій для другого вибору
            select2.addEventListener("change", function() {
                select3.style.display = "none"; // Приховуємо третій вибір
                select3.previousElementSibling.style.display = "none";
                select3.innerHTML = '<option value="">Оберіть...</option>'; // Очищаємо третій вибір

                if (select2.value) {
                    select3.style.display = "block"; // Показуємо третій вибір
                    select3.previousElementSibling.style.display = "block";
                    const varieties = options[select1.value][select2.value]; // Отримуємо сорти
                    populateSelect(select3, varieties); // Заповнюємо третій вибір
                }
            });
        });

    </script>
</p>
</body>
</html>
