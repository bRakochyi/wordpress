<?php
?>
<html lang="">
    <head>
        <title> Test </title>

    </head>
    <body>
    <label for="main-select">Виберіть організацію:</label>
    <select id="main-select">
        <option value="">Виберіть...</option>
        <option value="option1">ТОВ "ЛЕП"</option>
        <option value="option2">ЕЛОТЕР</option>
        <option value="option3">АМПЕРОК</option>
    </select>
    <label for="sub-select1" id="label1" style="display: none;">Виберіть відділення для ТОВ "ЛЕП":</label>
    <select id="sub-select1" style="display: none;">
        <option value="">Виберіть...</option>
        <option value="sub1-1">Відділення дистрибюції</option>
        <option value="sub1-2">Відділення постачання</option>
        <option value="sub1-3">Офісний відділ</option>
        <option value="sub1-4">Бухгалтерія</option>
        <option value="sub1-5">Технічний відділ</option>
        <option value="sub1-6">Транспортний відділ</option>
        <option value="sub1-7">Охорона</option>
        <option value="sub1-2">Складський відділ</option>
    </select>
    <label for="sub-select2" id="label2" style="display: none;">Виберіть відділення для ЕЛОТЕР:</label>
    <select id="sub-select2" style="display: none;">
        <option value="">Виберіть...</option>
        <option value="sub2-1" style="color: red">Елотер</option>
    </select>
    <label for="sub-select3" id="label3" style="display: none;">Виберіть відділення для АМПЕРОК:</label>
    <select id="sub-select3" style="display: none;">
        <option value="">Виберіть...</option>
        <option value="sub3-1">Амперок магазин</option>
        <option value="sub3-2">Амперок інтернет</option>
    </select>

    <br>
    <script>
        document.getElementById('main-select').addEventListener('change', function () {
            var value = this.value;

            // Сховати всі підполя
            document.getElementById('sub-select1').style.display = 'none';
            document.getElementById('sub-select2').style.display = 'none';
            document.getElementById('sub-select3').style.display = 'none';
            document.getElementById('label1').style.display = 'none';
            document.getElementById('label2').style.display = 'none';
            document.getElementById('label3').style.display = 'none';

            // Показати відповідне підполе
            if (value === 'option1') {
                document.getElementById('sub-select1').style.display = 'block';
                document.getElementById('label1').style.display = 'block';
            } else if (value === 'option2') {
                document.getElementById('sub-select2').style.display = 'block';
                document.getElementById('label2').style.display = 'block';
            } else {
                document.getElementById('sub-select3').style.display = 'block';
                document.getElementById('label3').style.display = 'block';
            }
        });
    </script>
    <br>
    <br>
    <br>

<!--    <div id="clock"></div>-->
<!--    <script>-->
<!--        function updateClock() {-->
<!--            const now = new Date(); // Отримуємо поточний час-->
<!--            const hours = String(now.getHours()).padStart(2, '0'); // Години-->
<!--            const amPm = now.getHours() >= 12;-->
<!--            const minutes = String(now.getMinutes()).padStart(2, '0'); // Хвилини-->
<!--            const seconds = String(now.getSeconds()).padStart(2, '0'); // Секунди-->
<!---->
<!--            // Формат часу-->
<!--            const timeString = `${hours}:${minutes}:${seconds}`;-->
<!---->
<!--            // Виводимо на екран-->
<!--            document.getElementById('clock').textContent = timeString;-->
<!--        }-->
<!---->
<!--        // Оновлюємо годинник щосекунди-->
<!--        setInterval(updateClock, 1000);-->
<!---->
<!--        // Запускаємо годинник відразу після завантаження сторінки-->
<!--        updateClock();-->
<!--    </script>-->
<!--    <br>-->
<!--    <br>-->
<!--    <br>-->
<!--    <canvas id="clockCanvas" width="200" height="200"></canvas>-->
<!--    <script>-->
<!--        const canvas = document.getElementById('clockCanvas');-->
<!--        const ctx = canvas.getContext('2d');-->
<!--        const radius = canvas.width / 2;-->
<!--        ctx.translate(radius, radius); // Переміщуємо початок координат до центру-->
<!---->
<!--        function drawClock() {-->
<!--            drawFace(ctx, radius);-->
<!--            drawNumbers(ctx, radius);-->
<!--            drawTime(ctx, radius);-->
<!--        }-->
<!---->
<!--        function drawFace(ctx, radius) {-->
<!--            ctx.beginPath();-->
<!--            ctx.arc(0, 0, radius, 0, 2 * Math.PI);-->
<!--            ctx.fillStyle = 'white';-->
<!--            ctx.fill();-->
<!---->
<!--            // Край циферблату-->
<!--            ctx.strokeStyle = '#333';-->
<!--            ctx.lineWidth = radius * 0.02;-->
<!--            ctx.stroke();-->
<!---->
<!--            // Центральна точка-->
<!--            ctx.beginPath();-->
<!--            ctx.arc(0, 0, radius * 0.05, 0, 2 * Math.PI);-->
<!--            ctx.fillStyle = '#333';-->
<!--            ctx.fill();-->
<!--        }-->
<!---->
<!--        function drawNumbers(ctx, radius) {-->
<!--            ctx.font = `${radius * 0.15}px Arial`;-->
<!--            ctx.textBaseline = 'middle';-->
<!--            ctx.textAlign = 'center';-->
<!--            for (let num = 1; num <= 12; num++) {-->
<!--                const ang = num * Math.PI / 6;-->
<!--                ctx.rotate(ang);-->
<!--                ctx.translate(0, -radius * 0.85);-->
<!--                ctx.rotate(-ang);-->
<!--                ctx.fillText(num.toString(), 0, 0);-->
<!--                ctx.rotate(ang);-->
<!--                ctx.translate(0, radius * 0.85);-->
<!--                ctx.rotate(-ang);-->
<!--            }-->
<!--        }-->
<!---->
<!--        function drawTime(ctx, radius) {-->
<!--            const now = new Date();-->
<!--            const hour = now.getHours() % 12;-->
<!--            const minute = now.getMinutes();-->
<!--            const second = now.getSeconds();-->
<!---->
<!--            // Годинникова стрілка-->
<!--            const hourAngle = (hour * Math.PI / 6) + (minute * Math.PI / 360);-->
<!--            drawHand(ctx, hourAngle, radius * 0.5, radius * 0.07);-->
<!---->
<!--            // Хвилинна стрілка-->
<!--            const minuteAngle = (minute * Math.PI / 30);-->
<!--            drawHand(ctx, minuteAngle, radius * 0.75, radius * 0.05);-->
<!---->
<!--            // Секундна стрілка-->
<!--            const secondAngle = (second * Math.PI / 30);-->
<!--            drawHand(ctx, secondAngle, radius * 0.85, radius * 0.02, 'red');-->
<!--        }-->
<!---->
<!--        function drawHand(ctx, pos, length, width, color = '#333') {-->
<!--            ctx.beginPath();-->
<!--            ctx.lineWidth = width;-->
<!--            ctx.lineCap = 'round';-->
<!--            ctx.strokeStyle = color;-->
<!--            ctx.moveTo(0, 0);-->
<!--            ctx.rotate(pos);-->
<!--            ctx.lineTo(0, -length);-->
<!--            ctx.stroke();-->
<!--            ctx.rotate(-pos);-->
<!--        }-->
<!---->
<!--        // Оновлюємо годинник щосекунди-->
<!--        setInterval(drawClock, 1000);-->
<!--        drawClock();-->
<!--    </script>-->
    </body>
</html>
