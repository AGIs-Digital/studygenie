<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lebenslauf PDF</title>
    <style>
        @page {
            size: A4;
            margin: 20mm;
            @top-right {
                content: element(side-panel);
            }
        }

        @page :not(:first) {
            margin-top: 55px;
        }

        html, body {
            height: auto;
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
            height: auto;
            padding: 20px;
            box-sizing: border-box;
            background-color: #f4f4f4;
            margin: 0 auto;
            max-width: 800px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
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

        .section {
            margin-bottom: 20px;
        }

        .section h2 {
            font-size: 18px;
            color: #2D3E4E;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        .section p {
            margin: 0;
            padding: 5px 0;
            color: #555555;
        }

        .entry {
            margin-bottom: 10px;
        }

        .entry h3 {
            font-size: 16px;
            margin-bottom: 5px;
            color: #333333;
        }

        .entry p {
            margin: 0;
            color: #777777;
        }

        .side-panel {
            position: running(side-panel);
            width: 230px;
            background-color: {{ $side_panel_color ?? '#E09E50' }};
            color: {{ $side_panel_text_color ?? '#ffffff' }};
            padding: 55px 30px 50px 30px;
            box-sizing: border-box;
            border-bottom-left-radius: 200px;
            height: 100%;
            right: 0;
            top: 0;
            bottom: 0;
            display: flex;
            flex-direction: column;
        }

        .side-panel h2 {
            font-size: 18px;
            border-bottom: 1px solid var(--side-panel-text-color, #ffffff);
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        .side-panel p {
            margin: 0;
            padding: 5px 0;
        }

        .skill {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
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
                    @if (!empty($name))
                        <h1>{{ $name }}</h1>
                    @endif
                </div>
            </div>
            <div class="main">
                @if (!empty($experience_company) && (array_filter($experience_company) || array_filter($experience_position) || array_filter($experience_period) || array_filter($experience_description)))
                    <div class="section">
                        <h2>Berufliche Erfahrungen</h2>
                        @foreach ($experience_company as $index => $company)
                            <div class="entry">
                                @if (!empty($experience_position[$index]))
                                    <h3>{{ $experience_position[$index] }}</h3>
                                @endif
                                @if (!empty($experience_period[$index]))
                                    <p>{{ $experience_period[$index] }} || {{ $company }}</p>
                                @endif
                                @if (!empty($experience_description[$index]))
                                    <ul>
                                        <li>{{ $experience_description[$index] }}</li>
                                    </ul>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif

                @if (!empty($school_form) && (array_filter($school_form) || array_filter($school_grade) || array_filter($school_start) || array_filter($school_end)))
                    <div class="section">
                        <h2>Schulbildung</h2>
                        @foreach ($school_form as $index => $school)
                            <div class="entry">
                                @if (!empty($school))
                                    <h3>{{ $school }}</h3>
                                @endif
                                @if (!empty($school_start[$index]) || !empty($school_end[$index]))
                                    <p>
                                        @if (!empty($school_start[$index]))
                                            {{ \Carbon\Carbon::parse($school_start[$index])->format('d.m.Y') }}
                                        @endif
                                        @if (!empty($school_end[$index]))
                                            - {{ \Carbon\Carbon::parse($school_end[$index])->format('d.m.Y') }}
                                        @endif
                                    </p>
                                @endif
                                @if (!empty($school_grade[$index]))
                                    <p>Abschluss: {{ $school_grade[$index] }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div style="position: absolute; bottom: 50px; width: 100%;">
                <p>
                    @if (!empty($signature_town))
                        {{ $signature_town }}
                    @endif
                    @if (!empty($signature_date))
                        {{ \Carbon\Carbon::parse($signature_date)->format('d.m.Y') }}
                    @endif
                </p>
            </div>
        </div>
        <div class="side-panel">
            @if (!empty($name) || !empty($city) || !empty($street) || !empty($phone) || !empty($email) || !empty($birthdate))
                <h2>Persönliche Daten</h2>
                @if (!empty($name))
                    <p><strong>Name</strong><br /> {{ $name }}</p><br />
                @endif
                @if (!empty($birthdate))
                    <p><strong>Geburtsdatum</strong><br />{{ \Carbon\Carbon::parse($birthdate)->format('d.m.Y') }}</p><br />
                @endif
                @if (!empty($street))
                    <p><strong>Adresse</strong><br />{{ $street }}<br />{{ $postal_city }} {{ $city }}</p><br />
                @endif
                @if (!empty($phone))
                    <p><strong>Telefon</strong><br />{{ $phone }}</p><br />
                @endif
                @if (!empty($email))
                    <p><strong>E-Mail</strong><br />{{ $email }}</p><br />
                @endif
            @endif

            @if (!empty($skill_type) && array_filter($skill_type))
                <h2>Fähigkeiten</h2>
                @foreach ($skill_type as $index => $skill)
                    <div class="skill">
                        @if (!empty($skill))
                            <p>{{ $skill }}</p>
                        @endif
                    </div>
                @endforeach
                <br />
            @endif

            @if (!empty($language_type) && (array_filter($language_type) || array_filter($language_level)))
                <h2>Sprachkenntnisse</h2>
                @foreach ($language_type as $index => $language)
                    <div class="skill">
                        @if (!empty($language))
                            <p>{{ $language }} @if (!empty($language_level[$index])) - {{ $language_level[$index] }} @endif</p>
                        @endif
                    </div>
                @endforeach
                <br />
            @endif

            @if (!empty($volunteer_company) && (array_filter($volunteer_company) || array_filter($volunteer_task) || array_filter($volunteer_period)))
                <h2>Ehrenämter</h2>
                @foreach ($volunteer_company as $index => $volunteer)
                    <div class="skill">
                        @if (!empty($volunteer_task[$index]))
                            <p>{{ $volunteer_task[$index] }}</p>
                        @endif
                        @if (!empty($volunteer))
                            <p>{{ $volunteer }} - {{ $volunteer_period[$index] }}</p>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</body>

</html>
