<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página expirada</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: url('{{ asset("images/fondo-bosque.jpg") }}') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .error-container {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 50px;
            border-radius: 20px;
            text-align: center;
            color: white;
            position: relative;
            max-width: 600px;
            width: 90%;
            backdrop-filter: blur(5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
            animation: fadeIn 1s ease-out;
        }

        .error-code {
            font-size: 120px;
            font-weight: bold;
            color: #ff4f4f;
            margin: 0;
            text-shadow: 0 0 15px rgba(255, 79, 79, 0.8);
            animation: float 3s ease-in-out infinite;
        }

        .error-message {
            font-size: 30px;
            font-weight: 600;
            margin: 15px 0;
        }

        .error-details {
            font-size: 16px;
            opacity: 0.85;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .btn-back {
            background-color: #28a745;
            color: white;
            padding: 14px 28px;
            border-radius: 50px;
            text-decoration: none;
            font-size: 18px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
        }

        .btn-back:hover {
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(33, 136, 56, 0.5);
        }

        .leaf {
            position: absolute;
            width: 70px;
            opacity: 0.9;
        }

        .leaf.top-left {
            top: -35px;
            left: -35px;
            animation: rotateLeaf 8s linear infinite;
        }

        .leaf.bottom-right {
            bottom: -35px;
            right: -35px;
            animation: rotateLeaf 10s linear infinite reverse;
        }

        /* Animaciones */
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes rotateLeaf {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <img src="{{ asset('images/hoja.png') }}" class="leaf top-left" alt="Hoja">
        <div class="error-code">419</div>
        <div class="error-message">La página ha expirado</div>
        <div class="error-details">
            Por seguridad, tu sesión ha caducado o el formulario fue enviado dos veces.
        </div>
        <a href="{{ url()->previous() }}" class="btn-back">Volver</a>
        <img src="{{ asset('images/hoja.png') }}" class="leaf bottom-right" alt="Hoja">
    </div>
</body>
</html>
