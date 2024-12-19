<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #2D3E4E;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #E8ECEB;
            padding: 30px;
            text-align: center;
        }
        .logo {
            width: 180px;
            height: auto;
        }
        .content-wrapper {
            padding: 40px 30px;
        }
        h1 {
            color: #2D3E4E;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .content {
            line-height: 1.6;
            color: #2D3E4E;
            margin-bottom: 30px;
        }
        .button {
            display: inline-block;
            padding: 12px 25px;
            background-color: #E09E50;
            color: #2D3E4E !important;
            text-decoration: none;
            border-radius: 9px;
            font-weight: 600;
            margin: 20px 0;
        }
        .footer {
            background-color: #2D3E4E;
            padding: 10px 20px;
            border-top: 1px solid #edf2f7;
            font-size: 12px;
            color: #FEFEFE;
            text-align: center;
        }
        .footer a {
            color: #FEFEFE;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://studygenie.de/asset/images/Logo_(2).png" alt="StudyGenie Logo" class="logo">
        </div>
        
        <div class="content-wrapper">
            <h1>{{ $subject }}</h1>
            
            <div class="content">
                {!! $content !!}
            </div>
            
            <a href="{{ config('app.url') }}" class="button">Zu StudyGenie</a>
        </div>
        
        <div class="footer">
            <p>Mit besten Grüßen,<br>Dein StudyGenie Team</p>
            <p>Du erhältst diese E-Mail als registrierter Nutzer von StudyGenie.<br>
            <a href="{{ route('newsletter.unsubscribe', ['token' => $unsubscribe_token]) }}">Newsletter abbestellen</a></p>
        </div>
    </div>
</body>
</html> 