<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Botón de Ayuda por WhatsApp</title>
    <style>
        .btn-whatsapp {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #25d366;
            color: white;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            text-decoration: none;
            z-index: 1000;
        }
        .btn-whatsapp svg {
            width: 30px;
            height: 30px;
        }
        .btn-filter {
            background-color: #4CAF50; /* Color verde */
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 2px;
            cursor: pointer;
            border-radius: 5px;
        }
        #results {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <button class="btn-filter">Filtrar</button>

    <div id="results"></div>

    <a href="https://wa.me/524471103795?text=Buen%20dia%20apreciable%20alumno.%20%C2%BFEn%20que%20podemos%20ayudarte%3F%2C%20te%20recordamos%20que%20el%20horario%20de%20atencion%20es%20de%208%20de%20la%20ma%C3%B1ana%20a%203%20de%20la%20tarde%2C%20agradecemos%20tu%20entendimiento." class="btn-whatsapp" target="_blank" rel="noreferrer">
        <!-- WhatsApp SVG icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M3 21l1.65 -4.75a9 9 0 1 1 3.1 3.1l-4.75 1.65m10.5 -11.65a3 3 0 1 0 -4 4l1 1l-1 3l3 -1l1 -1a3 3 0 0 0 1 -4"/>
        </svg>
    </a>
</body>
</html>

