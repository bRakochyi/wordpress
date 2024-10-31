<?php
$allowed_roles = [
    'distribution_manager', 'postachannya_manager', 'office_worker', 'bukhhalter', 'paymaster_lep', 'technik',
    'mekhanik', 'vodij', 'security', 'sklad_worker', 'eloter_worker', 'admin_amperok_store', 'manager_amperok_store',
    'paymaster_amperok_store', 'amperok_worker_store', 'admin_amperok_internet', 'manager_amperok_internet',
    'content_manager_amperok_internet'
];

$tov_lep = ['distribution_manager', 'postachannya_manager', 'office_worker', 'bukhhalter', 'paymaster_lep', 'technik',
    'mekhanik', 'vodij', 'security', 'sklad_worker'];

$eloter = ['eloter_worker'];

$amperok = ['admin_amperok_store', 'manager_amperok_store',
    'paymaster_amperok_store', 'amperok_worker_store', 'admin_amperok_internet', 'manager_amperok_internet',
    'content_manager_amperok_internet'];
?>
<html lang="">
    <head>
        <title> Test </title>

    </head>
    <body>




    <div id="clock"></div>
    <script>
        function updateClock() {
            const now = new Date(); // Отримуємо поточний час
            const hours = String(now.getHours()).padStart(2, '0'); // Години
            const amPm = now.getHours() >= 12;
            const minutes = String(now.getMinutes()).padStart(2, '0'); // Хвилини
            const seconds = String(now.getSeconds()).padStart(2, '0'); // Секунди

            // Формат часу
            const timeString = `${hours}:${minutes}:${seconds}`;

            // Виводимо на екран
            document.getElementById('clock').textContent = timeString;
        }

        // Оновлюємо годинник щосекунди
        setInterval(updateClock, 1000);

        // Запускаємо годинник відразу після завантаження сторінки
        updateClock();
    </script>
    <br>
    <br>
    <br>
    <canvas id="clockCanvas" width="200" height="200"></canvas>
    <script>
        const canvas = document.getElementById('clockCanvas');
        const ctx = canvas.getContext('2d');
        const radius = canvas.width / 2;
        ctx.translate(radius, radius); // Переміщуємо початок координат до центру

        function drawClock() {
            drawFace(ctx, radius);
            drawNumbers(ctx, radius);
            drawTime(ctx, radius);
        }

        function drawFace(ctx, radius) {
            ctx.beginPath();
            ctx.arc(0, 0, radius, 0, 2 * Math.PI);
            ctx.fillStyle = 'white';
            ctx.fill();

            // Край циферблату
            ctx.strokeStyle = '#333';
            ctx.lineWidth = radius * 0.02;
            ctx.stroke();

            // Центральна точка
            ctx.beginPath();
            ctx.arc(0, 0, radius * 0.05, 0, 2 * Math.PI);
            ctx.fillStyle = '#333';
            ctx.fill();
        }

        function drawNumbers(ctx, radius) {
            ctx.font = `${radius * 0.15}px Arial`;
            ctx.textBaseline = 'middle';
            ctx.textAlign = 'center';
            for (let num = 1; num <= 12; num++) {
                const ang = num * Math.PI / 6;
                ctx.rotate(ang);
                ctx.translate(0, -radius * 0.85);
                ctx.rotate(-ang);
                ctx.fillText(num.toString(), 0, 0);
                ctx.rotate(ang);
                ctx.translate(0, radius * 0.85);
                ctx.rotate(-ang);
            }
        }

        function drawTime(ctx, radius) {
            const now = new Date();
            const hour = now.getHours() % 12;
            const minute = now.getMinutes();
            const second = now.getSeconds();

            // Годинникова стрілка
            const hourAngle = (hour * Math.PI / 6) + (minute * Math.PI / 360);
            drawHand(ctx, hourAngle, radius * 0.5, radius * 0.07);

            // Хвилинна стрілка
            const minuteAngle = (minute * Math.PI / 30);
            drawHand(ctx, minuteAngle, radius * 0.75, radius * 0.05);

            // Секундна стрілка
            const secondAngle = (second * Math.PI / 30);
            drawHand(ctx, secondAngle, radius * 0.85, radius * 0.02, 'red');
        }

        function drawHand(ctx, pos, length, width, color = '#333') {
            ctx.beginPath();
            ctx.lineWidth = width;
            ctx.lineCap = 'round';
            ctx.strokeStyle = color;
            ctx.moveTo(0, 0);
            ctx.rotate(pos);
            ctx.lineTo(0, -length);
            ctx.stroke();
            ctx.rotate(-pos);
        }

        // Оновлюємо годинник щосекунди
        setInterval(drawClock, 1000);
        drawClock();
    </script>
    </body>
</html>
