<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motivationsschreiben PDF</title>
    <style>
        @page {
            size: A4;
        }
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
        }
        .container {
            display: flex;
            width: 100%;
            height: 100%;
            padding: 20px;
            box-sizing: border-box;
            background-color: #ffffff;
            margin: 0 auto;
            max-width: 800px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .main-content {
            flex: 1;
            padding-right: 20px;
            padding-bottom: 50px;
            display: flex;
            flex-direction: column;
            margin: 20px 250px 40px 20px;
        }
        .header {
            width: calc(100% - 230px);
            padding-bottom: 20px;
        }
        .header h1 {
            font-size: 30px;
            color: #2D3E4E;
        }
        .page-break {
            page-break-before: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="main-content">
            <div class="header">
                <div>
                    <h1>Profilpräsentation</h1>
                </div>
            </div>
            <div class="main">
                {!! $motivational_letter !!} <!-- Interpretiert den Inhalt als HTML -->
            </div>
        </div>
    </div>
</body>
</html>