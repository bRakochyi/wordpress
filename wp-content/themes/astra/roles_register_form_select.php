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
    </select>
    <br>
    <label for="select2" style="display: none;">Виберіть відділ:</label>
    <select id="select2" name="department" style="display: none;">
        <option value="">Оберіть...</option>
    </select>

    <label for="select3" style="display: none;">Виберіть посаду:</label>
    <select id="select3" name="role" style="display: none;">
        <option value="">Оберіть...</option>
    </select>
    <br>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const select1 = document.getElementById("select1");
            const select2 = document.getElementById("select2");
            const select3 = document.getElementById("select3");

            const options = {
                tov_lep: {
                    "Відділ постачання": {
                        "manager_postachaniia_vp": "Менеджер з постачання",
                        "office_admin_vp": "Офісний адміністратор",
                        "ing_comp_sys_vp": "Інженер компютерних систем",
                        "designer_graf_vp": "Дизайнер графіки",
                        "manager_zbutu_vp": "Менеджер із збуту",
                        "marketolog_vp": "Маркетолог"
                    },
                    "Відділ дистриб'юції": {
                        "manager_zbutu_vd": "Менеджер із збуту",
                        "ing_comp_sys_vd": "Інженер компютерних систем",
                        "bukhhalter_vd": "Бухгалтер",
                        "region_manager_zbutu_vd": "Регіональний менеджер із збуту"
                    },
                    "Офісний відділ": {
                        "manager_zbutu_of": "Менеджер із збуту",
                        "economist_of": "Економіст",
                        "nachalnic_viddilu_of": "Начальник відділу"
                    },
                    "Технічний відділ": {
                        "zav_po_hosp_tv": "Завідуючий по господарчій частині",
                        "el_mont_rozpod_pr_tv": "Електромонтажник розподільчих пристроїв",
                        "nachalnic_viddilu_tv": "Начальник відділу",
                        "ing_comp_sys_tv": "Інженер компютерних систем",
                        "ingener_construct_tv": "Інженер конструктор"
                    },
                    "Складський відділ": {
                        "golov_komirnuk_sv": "Головний комірник",
                        "starsh_komirnuk_sv": "Старший комірник",
                        "komirnuk_sv": "Комірник"
                    },
                    "Адміністрація": {
                        "director_ad": "Директор",
                        "zastup_directora_ad": "Заступник директора"
                    },
                    "Магазин Амперок": {
                        "manager_zbutu_ma": "Менеджер із збуту",
                        "ing_comp_sys_ma": "Інженер компютерних систем",
                        "admin_amperok_ma": "Адміністратор",
                        "paymaster_zalu_ma": "Касир залу",
                        "bukhhalter_ma": "Бухгалтер"
                    },
                    "Транспортний відділ": {
                        "vodiy_tra": "Водій",
                        "dispetcher_tra": "Диспетчер",
                        "Ingener_praci_tra": "Інженер з охорони праці",
                        "mekhanik_tra": "Механік",
                        "ekspeditor_tra": "Експедитор",
                        "medsestra_tra": "Медсестра"
                    },
                    "Бухгалтерія": {
                        "logist_bukh": "Логіст",
                        "bukhhalter_bukh": "Бухгалтер",
                        "programist_bukh": "Програміст",
                        "ing_comp_sys_bukh": "Інженер компютерних систем",
                        "economist_bukh": "Економіст",
                        "golov_bukhhalter_bukh": "Головний бухгалтер"
                    },
                    "Інтернет магазин": {
                        "manager_zbutu_int": "Менеджер із збуту"
                    },
                    "Сервісний відділ": {
                        "mont_radioel_pr_serv": "Монтажник радіоелектронних апаратів та приладів",
                        "nachalnic_viddilu_serv": "Начальник відділу"
                    }
                },
                eloter: {
                    "Елотер": {
                        "director_el": "Директор",
                        "golov_bukhhalter_el": "Головний бухгалтер",
                        "bukhhalter_el": "Бухгалтер",
                        "manager_postachaniia_el": "Менеджер з постачання",
                        "economist_el": "Економіст",
                        "ingener_el": "Інженер",
                        "manager_zbutu_el": "Менеджер із збуту",
                        "office_admin_el": "Офіс адміністратор",
                        "ekspeditor_el": "Експедитор",
                        "ing_comp_sys_el": "Інженер компютерних систем",
                        "komirnuk_el": "Комірник",
                        "starsh_komirnuk_el": "Старший комірник",
                        "manager_logist_el": "Менеджер з логістики"
                    }
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
                    populateSelect(select3, Object.values(varieties)); // Заповнюємо третій вибір
                }
            });
        });

    </script>
</p>
</body>
</html>
