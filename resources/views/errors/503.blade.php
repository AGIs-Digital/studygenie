<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wartungsarbeiten</title>
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #2c3e50, #bdc3c7);
            color: #ecf0f1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .background {
            background-image: url('/asset/images/503_bg.jpg');
            height: 100%;
            width: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
            filter: blur(5px);
        }

        .message {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background: rgba(0, 0, 0, 0.5);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            animation: fadeIn 2s ease-in-out;
        }

        .message h1 {
            font-size: 2.5em;
            margin: 0;
            animation: bounce 2s infinite;
        }

        .message p {
            font-size: 1.2em;
            margin-top: 10px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-30px);
            }
            60% {
                transform: translateY(-15px);
            }
        }
    </style>
</head>

<body>
    <div class="background"></div>
    <div class="message">
        <h1>Wir sind gleich zurück</h1>
        <p>Wir führen gerade Wartungsarbeiten durch. Bitte versuche es später erneut.</p>
    </div>
</body>

</html>