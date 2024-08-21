<!DOCTYPE html>
<html lang="de">

<head>
    @section('title', 'Datenschutz')
    @include('components.head')
    <link rel="stylesheet" href="{{ asset('asset/css/HomePage.css') }}"> 
</head>
@include('components.navbar')
@include('components.feedback')
<body class="MainContainer">
@include('components.login-modal')
    @include('components.signup-modal')
    @include('components.forget-modal')
    @include('components.tooglePasswordVisibility')
    <div class="headerSpacer"></div>

@include('components.arrowupbutton')

    <section class="blog_sec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h1>Datenschutzerklärung</h1>
                    <h2>1. Datenschutz auf einen Blick</h2>
                    <h3>Allgemeine Hinweise</h3>
                    <p>Die folgenden Hinweise geben einen einfachen Überblick darüber, was mit Ihren personenbezogenen
                        Daten passiert, wenn Sie diese Website besuchen. Personenbezogene Daten sind alle Daten, mit
                        denen Sie persönlich identifiziert werden können. Ausführliche Informationen zum Thema
                        Datenschutz entnehmen Sie unserer unter diesem Text aufgeführten Datenschutzerklärung.</p>
                    <h3>Datenerfassung auf dieser Website</h3>
                    <h4>Wer ist verantwortlich für die Datenerfassung auf dieser Website?</h4>
                    <p>Die Datenverarbeitung auf dieser Website erfolgt durch den Websitebetreiber. Dessen Kontaktdaten
                        können Sie dem Abschnitt „Hinweis zur Verantwortlichen Stelle“ in dieser Datenschutzerklärung
                        entnehmen.</p>
                    <h4>Wie erfassen wir Ihre Daten?</h4>
                    <p>Ihre Daten werden zum einen dadurch erhoben, dass Sie uns diese mitteilen. Hierbei kann es sich
                        z. B. um Daten handeln, die Sie in ein Kontaktformular eingeben.</p>
                    <p>Andere Daten werden automatisch oder nach Ihrer Einwilligung beim Besuch der Website durch unsere
                        IT-Systeme erfasst. Das sind vor allem technische Daten (z. B. Internetbrowser, Betriebssystem
                        oder Uhrzeit des Seitenaufrufs). Die Erfassung dieser Daten erfolgt automatisch, sobald Sie
                        diese Website betreten.</p>
                    <h4>Wofür nutzen wir Ihre Daten?</h4>
                    <p>Ein Teil der Daten wird erhoben, um eine fehlerfreie Bereitstellung der Website zu gewährleisten.
                        Andere Daten können zur Analyse Ihres Nutzerverhaltens verwendet werden.</p>
                    <h4>Welche Rechte haben Sie bezüglich Ihrer Daten?</h4>
                    <p>Sie haben jederzeit das Recht, unentgeltlich Auskunft über Herkunft, Empfänger und Zweck Ihrer
                        gespeicherten personenbezogenen Daten zu erhalten. Sie haben außerdem ein Recht, die
                        Berichtigung oder Löschung dieser Daten zu verlangen. Wenn Sie eine Einwilligung zur
                        Datenverarbeitung erteilt haben, können Sie diese Einwilligung jederzeit für die Zukunft
                        widerrufen. Außerdem haben Sie das Recht, unter bestimmten Umständen die Einschränkung der
                        Verarbeitung Ihrer personenbezogenen Daten zu verlangen. Des Weiteren steht Ihnen ein
                        Beschwerderecht bei der zuständigen Aufsichtsbehörde zu.</p>
                    <p>Hierzu sowie zu weiteren Fragen zum Thema Datenschutz können Sie sich jederzeit an uns wenden.
                    </p>
                    <h3>Analyse-Tools und Tools von Drittanbietern</h3>
                    <p>Beim Besuch dieser Website kann Ihr Surf-Verhalten statistisch ausgewertet werden. Das geschieht
                        vor allem mit sogenannten Analyseprogrammen.</p>
                    <p>Detaillierte Informationen zu diesen Analyseprogrammen finden Sie in der folgenden
                        Datenschutzerklärung.</p>
                    <br />
                    <h2>2. Hosting</h2>
                    <p>Wir hosten die Inhalte unserer Website bei folgendem Anbieter:</p>
                    <h3>IONOS</h3>
                    <p>Anbieter ist die IONOS SE, Elgendorfer Str. 57, 56410 Montabaur (nachfolgend IONOS). Wenn Sie
                        unsere Website besuchen, erfasst IONOS verschiedene Logfiles inklusive Ihrer IP-Adressen.
                        Details entnehmen Sie der Datenschutzerklärung von IONOS: <a
                            href="https://www.ionos.de/terms-gtc/terms-privacy" target="_blank"
                            rel="noopener noreferrer">https://www.ionos.de/terms-gtc/terms-privacy</a>.</p>
                    <p>Die Verwendung von IONOS erfolgt auf Grundlage von Art. 6 Abs. 1 lit. f DSGVO. Wir haben ein
                        berechtigtes Interesse an einer möglichst zuverlässigen Darstellung unserer Website. Sofern eine
                        entsprechende Einwilligung abgefragt wurde, erfolgt die Verarbeitung ausschließlich auf
                        Grundlage von Art. 6 Abs. 1 lit. a DSGVO und § 25 Abs. 1 TDDG, soweit die Einwilligung die
                        Speicherung von Cookies oder den Zugriff auf Informationen im Endgerät des Nutzers (z. B.
                        Device-Fingerprinting) im Sinne des TDDG umfasst. Die Einwilligung ist jederzeit widerrufbar.
                    </p>
                    <h4>Auftragsverarbeitung</h4>
                    <p>Wir haben einen Vertrag über Auftragsverarbeitung (AVV) zur Nutzung des oben genannten Dienstes
                        geschlossen. Hierbei handelt es sich um einen datenschutzrechtlich vorgeschriebenen Vertrag, der
                        gewährleistet, dass dieser die personenbezogenen Daten unserer Websitebesucher nur nach unseren
                        Weisungen und unter Einhaltung der DSGVO verarbeitet.</p>
                    <br />
                    <h2>3. Allgemeine Hinweise und Pflichtinformationen</h2>
                    <h3>Datenschutz</h3>
                    <p>Die Betreiber dieser Seiten nehmen den Schutz Ihrer persönlichen Daten sehr ernst. Wir behandeln
                        Ihre personenbezogenen Daten vertraulich und entsprechend den gesetzlichen
                        Datenschutzvorschriften sowie dieser Datenschutzerklärung.</p>
                    <p>Wenn Sie diese Website benutzen, werden verschiedene personenbezogene Daten erhoben.
                        Personenbezogene Daten sind Daten, mit denen Sie persönlich identifiziert werden können. Die
                        vorliegende Datenschutzerklärung erläutert, welche Daten wir erheben und wofür wir sie nutzen.
                        Sie erläutert auch, wie und zu welchem Zweck das geschieht.</p>
                    <p>Wir weisen darauf hin, dass die Datenübertragung im Internet (z. B. bei der Kommunikation per
                        E-Mail) Sicherheitslücken aufweisen kann. Ein lückenloser Schutz der Daten vor dem Zugriff durch
                        Dritte ist nicht möglich.</p>
                    <h3>Hinweis zur verantwortlichen Stelle</h3>
                    <p>Die verantwortliche Stelle für die Datenverarbeitung auf dieser Website ist:</p>
                    <p>Abeln Goltz GbR<br />Adalbert-Stifter-Straße 14<br />30655 Hannover</p>
                    <p>Telefon: +49 155 60106486<br />E-Mail: info@agis.digital</p>
                    <p>Verantwortliche Stelle ist die natürliche oder juristische Person, die allein oder gemeinsam mit
                        anderen über die Zwecke und Mittel der Verarbeitung von personenbezogenen Daten (z. B. Namen,
                        E-Mail-Adressen o. Ä.) entscheidet.</p>
                    <h3>Speicherdauer</h3>
                    <p>Soweit innerhalb dieser Datenschutzerklärung keine speziellere Speicherdauer genannt wurde,
                        verbleiben Ihre personenbezogenen Daten bei uns, bis der Zweck für die Datenverarbeitung
                        entfällt. Wenn Sie ein berechtigtes Löschersuchen geltend machen oder eine Einwilligung zur
                        Datenverarbeitung widerrufen, werden Ihre Daten gelöscht, sofern wir keine anderen rechtlich
                        zulässigen Gründe für die Speicherung Ihrer personenbezogenen Daten haben (z. B. steuer- oder
                        handelsrechtliche Aufbewahrungsfristen); im letztgenannten Fall erfolgt die Löschung nach
                        Fortfall dieser Gründe.</p>
                    <h3>Allgemeine Hinweise zu den Rechtsgrundlagen der Datenverarbeitung auf dieser Website</h3>
                    <p>Sofern Sie in die Datenverarbeitung eingewilligt haben, verarbeiten wir Ihre personenbezogenen
                        Daten auf Grundlage von Art. 6 Abs. 1 lit. a DSGVO bzw. Art. 9 Abs. 2 lit. a DSGVO, sofern
                        besondere Datenkategorien nach Art. 9 Abs. 1 DSGVO verarbeitet werden. Im Falle einer
                        ausdrücklichen Einwilligung in die Übertragung personenbezogener Daten in Drittstaaten erfolgt
                        die Datenverarbeitung außerdem auf Grundlage von Art. 49 Abs. 1 lit. a DSGVO. Sofern Sie in die
                        Speicherung von Cookies oder in den Zugriff auf Informationen in Ihr Endgerät (z. B. via
                        Device-Fingerprinting) eingewilligt haben, erfolgt die Datenverarbeitung zusätzlich auf
                        Grundlage von § 25 Abs. 1 TDDG. Die Einwilligung ist jederzeit widerrufbar. Sind Ihre Daten zur
                        Vertragserfüllung oder zur Durchführung vorvertraglicher Maßnahmen erforderlich, verarbeiten wir
                        Ihre Daten auf Grundlage des Art. 6 Abs. 1 lit. b DSGVO. Des Weiteren verarbeiten wir Ihre
                        Daten, sofern diese zur Erfüllung einer rechtlichen Verpflichtung erforderlich sind auf
                        Grundlage von Art. 6 Abs. 1 lit. c DSGVO. Die Datenverarbeitung kann ferner auf Grundlage
                        unseres berechtigten Interesses nach Art. 6 Abs. 1 lit. f DSGVO erfolgen. Über die jeweils im
                        Einzelfall einschlägigen Rechtsgrundlagen wird in den folgenden Absätzen dieser
                        Datenschutzerklärung informiert.</p>
                    <h3>Hinweis zur Datenweitergabe in datenschutzrechtlich nicht sichere Drittstaaten sowie die
                        Weitergabe an US-Unternehmen, die nicht DPF-zertifiziert sind</h3>
                    <p>Wir verwenden unter anderem Tools von Unternehmen mit Sitz in datenschutzrechtlich nicht sicheren
                        Drittstaaten sowie US-Tools, deren Anbieter nicht nach dem EU-US-Data Privacy Framework (DPF)
                        zertifiziert sind. Wenn diese Tools aktiv sind, können Ihre personenbezogene Daten in diese
                        Staaten übertragen und dort verarbeitet werden. Wir weisen darauf hin, dass in
                        datenschutzrechtlich unsicheren Drittstaaten kein mit der EU vergleichbares Datenschutzniveau
                        garantiert werden kann.</p>
                    <p>Wir weisen darauf hin, dass die USA als sicherer Drittstaat grundsätzlich ein mit der EU
                        vergleichbares Datenschutzniveau aufweisen. Eine Datenübertragung in die USA ist danach
                        zulässig, wenn der Empfänger eine Zertifizierung unter dem „EU-US Data Privacy Framework“ (DPF)
                        besitzt oder über geeignete zusätzliche Garantien verfügt. Informationen zu Übermittlungen an
                        Drittstaaten einschließlich der Datenempfänger finden Sie in dieser Datenschutzerklärung.</p>
                    <h3>Empfänger von personenbezogenen Daten</h3>
                    <p>Im Rahmen unserer Geschäftstätigkeit arbeiten wir mit verschiedenen externen Stellen zusammen.
                        Dabei ist teilweise auch eine Übermittlung von personenbezogenen Daten an diese externen Stellen
                        erforderlich. Wir geben personenbezogene Daten nur dann an externe Stellen weiter, wenn dies im
                        Rahmen einer Vertragserfüllung erforderlich ist, wenn wir gesetzlich hierzu verpflichtet sind
                        (z. B. Weitergabe von Daten an Steuerbehörden), wenn wir ein berechtigtes Interesse nach Art. 6
                        Abs. 1 lit. f DSGVO an der Weitergabe haben oder wenn eine sonstige Rechtsgrundlage die
                        Datenweitergabe erlaubt. Beim Einsatz von Auftragsverarbeitern geben wir personenbezogene Daten
                        unserer Kunden nur auf Grundlage eines gültigen Vertrags über Auftragsverarbeitung weiter. Im
                        Falle einer gemeinsamen Verarbeitung wird ein Vertrag über gemeinsame Verarbeitung geschlossen.
                    </p>
                    <h3>Widerruf Ihrer Einwilligung zur Datenverarbeitung</h3>
                    <p>Viele Datenverarbeitungsvorgänge sind nur mit Ihrer ausdrücklichen Einwilligung möglich. Sie
                        können eine bereits erteilte Einwilligung jederzeit widerrufen. Die Rechtmäßigkeit der bis zum
                        Widerruf erfolgten Datenverarbeitung bleibt vom Widerruf unberührt.</p>
                    <h3>Widerspruchsrecht gegen die Datenerhebung in besonderen Fällen sowie gegen Direktwerbung (Art.
                        21 DSGVO)</h3>
                    <p>WENN DIE DATENVERARBEITUNG AUF GRUNDLAGE VON ART. 6 ABS. 1 LIT. E ODER F DSGVO ERFOLGT, HABEN SIE
                        JEDERZEIT DAS RECHT, AUS GRÜNDEN, DIE SICH AUS IHRER BESONDEREN SITUATION ERGEBEN, GEGEN DIE
                        VERARBEITUNG IHRER PERSONENBEZOGENEN DATEN WIDERSPRUCH EINZULEGEN; DIES GILT AUCH FÜR EIN AUF
                        DIESE BESTIMMUNGEN GESTÜTZTES PROFILING. DIE JEWEILIGE RECHTSGRUNDLAGE, AUF DENEN EINE
                        VERARBEITUNG BERUHT, ENTNEHMEN SIE DIESER DATENSCHUTZERKLÄRUNG. WENN SIE WIDERSPRUCH EINLEGEN,
                        WERDEN WIR IHRE BETROFFENEN PERSONENBEZOGENEN DATEN NICHT MEHR VERARBEITEN, ES SEI DENN, WIR
                        KÖNNEN ZWINGENDE SCHUTZWÜRDIGE GRÜNDE FÜR DIE VERARBEITUNG NACHWEISEN, DIE IHRE INTERESSEN,
                        RECHTE UND FREIHEITEN ÜBERWIEGEN ODER DIE VERARBEITUNG DIENT DER GELTENDMACHUNG, AUSÜBUNG ODER
                        VERTEIDIGUNG VON RECHTSANSPRÜCHEN (WIDERSPRUCH NACH ART. 21 ABS. 1 DSGVO).</p>
                    <p>WERDEN IHRE PERSONENBEZOGENEN DATEN VERARBEITET, UM DIREKTWERBUNG ZU BETREIBEN, SO HABEN SIE DAS
                        RECHT, JEDERZEIT WIDERSPRUCH GEGEN DIE VERARBEITUNG SIE BETREFFENDER PERSONENBEZOGENER DATEN ZUM
                        ZWECKE DERARTIGER WERBUNG EINZULEGEN; DIES GILT AUCH FÜR DAS PROFILING, SOWEIT ES MIT SOLCHER
                        DIREKTWERBUNG IN VERBINDUNG STEHT. WENN SIE WIDERSPRECHEN, WERDEN IHRE PERSONENBEZOGENEN DATEN
                        ANSCHLIESSEND NICHT MEHR ZUM ZWECKE DER DIREKTWERBUNG VERWENDET (WIDERSPRUCH NACH ART. 21 ABS. 2
                        DSGVO).</p>
                    <h3>Beschwerderecht bei der zuständigen Aufsichtsbehörde</h3>
                    <p>Im Falle von Verstößen gegen die DSGVO steht den Betroffenen ein Beschwerderecht bei einer
                        Aufsichtsbehörde, insbesondere in dem Mitgliedstaat ihres gewöhnlichen Aufenthalts, ihres
                        Arbeitsplatzes oder des Orts des mutmaßlichen Verstoßes zu. Das Beschwerderecht besteht
                        unbeschadet anderweitiger verwaltungsrechtlicher oder gerichtlicher Rechtsbehelfe.</p>
                    <h3>Recht auf Datenübertragbarkeit</h3>
                    <p>Sie haben das Recht, Daten, die wir auf Grundlage Ihrer Einwilligung oder in Erfüllung eines
                        Vertrags automatisiert verarbeiten, an sich oder an einen Dritten in einem gängigen,
                        maschinenlesbaren Format aushändigen zu lassen. Sofern Sie die direkte Übertragung der Daten an
                        einen anderen Verantwortlichen verlangen, erfolgt dies nur, soweit es technisch machbar ist.</p>
                    <h3>Auskunft, Berichtigung und Löschung</h3>
                    <p>Sie haben im Rahmen der geltenden gesetzlichen Bestimmungen jederzeit das Recht auf
                        unentgeltliche Auskunft über Ihre gespeicherten personenbezogenen Daten, deren Herkunft und
                        Empfänger und den Zweck der Datenverarbeitung und ggf. ein Recht auf Berichtigung oder Löschung
                        dieser Daten. Hierzu sowie zu weiteren Fragen zum Thema personenbezogene Daten können Sie sich
                        jederzeit an uns wenden.</p>
                    <h3>Recht auf Einschränkung der Verarbeitung</h3>
                    <p>Sie haben das Recht, die Einschränkung der Verarbeitung Ihrer personenbezogenen Daten zu
                        verlangen. Hierzu können Sie sich jederzeit an uns wenden. Das Recht auf Einschränkung der
                        Verarbeitung besteht in folgenden Fällen:</p>
                    <ul>
                        <li>Wenn Sie die Richtigkeit Ihrer bei uns gespeicherten personenbezogenen Daten bestreiten,
                            benötigen wir in der Regel Zeit, um dies zu überprüfen. Für die Dauer der Prüfung haben Sie
                            das Recht, die Einschränkung der Verarbeitung Ihrer personenbezogenen Daten zu verlangen.
                        </li>
                        <li>Wenn die Verarbeitung Ihrer personenbezogenen Daten unrechtmäßig geschah/geschieht, können
                            Sie statt der Löschung die Einschränkung der Datenverarbeitung verlangen.</li>
                        <li>Wenn wir Ihre personenbezogenen Daten nicht mehr benötigen, Sie sie jedoch zur Ausübung,
                            Verteidigung oder Geltendmachung von Rechtsansprüchen benötigen, haben Sie das Recht, statt
                            der Löschung die Einschränkung der Verarbeitung Ihrer personenbezogenen Daten zu verlangen.
                        </li>
                        <li>Wenn Sie einen Widerspruch nach Art. 21 Abs. 1 DSGVO eingelegt haben, muss eine Abwägung
                            zwischen Ihren und unseren Interessen vorgenommen werden. Solange noch nicht feststeht,
                            wessen Interessen überwiegen, haben Sie das Recht, die Einschränkung der Verarbeitung Ihrer
                            personenbezogenen Daten zu verlangen.</li>
                    </ul>
                    <p>Wenn Sie die Verarbeitung Ihrer personenbezogenen Daten eingeschränkt haben, dürfen diese Daten –
                        von ihrer Speicherung abgesehen – nur mit Ihrer Einwilligung oder zur Geltendmachung, Ausübung
                        oder Verteidigung von Rechtsansprüchen oder zum Schutz der Rechte einer anderen natürlichen oder
                        juristischen Person oder aus Gründen eines wichtigen öffentlichen Interesses der Europäischen
                        Union oder eines Mitgliedstaats verarbeitet werden.</p>
                    <h3>SSL- bzw. TLS-Verschlüsselung</h3>
                    <p>Diese Seite nutzt aus Sicherheitsgründen und zum Schutz der Übertragung vertraulicher Inhalte,
                        wie zum Beispiel Bestellungen oder Anfragen, die Sie an uns als Seitenbetreiber senden, eine
                        SSL- bzw. TLS-Verschlüsselung. Eine verschlüsselte Verbindung erkennen Sie daran, dass die
                        Adresszeile des Browsers von „http://“ auf „https://“ wechselt und an dem Schloss-Symbol in
                        Ihrer Browserzeile.</p>
                    <p>Wenn die SSL- bzw. TLS-Verschlüsselung aktiviert ist, können die Daten, die Sie an uns
                        übermitteln, nicht von Dritten mitgelesen werden.</p>
                    <h3>Verschlüsselter Zahlungsverkehr auf dieser Website</h3>
                    <p>Besteht nach dem Abschluss eines kostenpflichtigen Vertrags eine Verpflichtung, uns Ihre
                        Zahlungsdaten (z. B. Kontonummer bei Einzugsermächtigung) zu übermitteln, werden diese Daten zur
                        Zahlungsabwicklung benötigt.</p>
                    <p>Der Zahlungsverkehr über die gängigen Zahlungsmittel (Visa/MasterCard, Lastschriftverfahren)
                        erfolgt ausschließlich über eine verschlüsselte SSL- bzw. TLS-Verbindung. Eine verschlüsselte
                        Verbindung erkennen Sie daran, dass die Adresszeile des Browsers von „http://“ auf „https://“
                        wechselt und an dem Schloss-Symbol in Ihrer Browserzeile.</p>
                    <p>Bei verschlüsselter Kommunikation können Ihre Zahlungsdaten, die Sie an uns übermitteln, nicht
                        von Dritten mitgelesen werden.</p>
                    <br />
                    <h2>4. Datenerfassung auf dieser Website</h2>
                    <h3>Cookies</h3>
                    <p>Unsere Internetseiten verwenden so genannte „Cookies“. Cookies sind kleine Datenpakete und
                        richten auf Ihrem Endgerät keinen Schaden an. Sie werden entweder vorübergehend für die Dauer
                        einer Sitzung (Session-Cookies) oder dauerhaft (permanente Cookies) auf Ihrem Endgerät
                        gespeichert. Session-Cookies werden nach Ende Ihres Besuchs automatisch gelöscht. Permanente
                        Cookies bleiben auf Ihrem Endgerät gespeichert, bis Sie diese selbst löschen oder eine
                        automatische Löschung durch Ihren Webbrowser erfolgt.</p>
                    <p>Cookies können von uns (First-Party-Cookies) oder von Drittunternehmen stammen (sog.
                        Third-Party-Cookies). Third-Party-Cookies ermöglichen die Einbindung bestimmter Dienstleistungen
                        von Drittunternehmen innerhalb von Webseiten (z. B. Cookies zur Abwicklung von
                        Zahlungsdienstleistungen).</p>
                    <p>Cookies haben verschiedene Funktionen. Zahlreiche Cookies sind technisch notwendig, da bestimmte
                        Webseitenfunktionen ohne diese nicht funktionieren würden (z. B. die Warenkorbfunktion oder die
                        Anzeige von Videos). Andere Cookies können zur Auswertung des Nutzerverhaltens oder zu
                        Werbezwecken verwendet werden.</p>
                    <p>Cookies, die zur Durchführung des elektronischen Kommunikationsvorgangs, zur Bereitstellung
                        bestimmter, von Ihnen erwünschter Funktionen (z. B. für die Warenkorbfunktion) oder zur
                        Optimierung der Website (z. B. Cookies zur Messung des Webpublikums) erforderlich sind
                        (notwendige Cookies), werden auf Grundlage von Art. 6 Abs. 1 lit. f DSGVO gespeichert, sofern
                        keine andere Rechtsgrundlage angegeben wird. Der Websitebetreiber hat ein berechtigtes Interesse
                        an der Speicherung von notwendigen Cookies zur technisch fehlerfreien und optimierten
                        Bereitstellung seiner Dienste. Sofern eine Einwilligung zur Speicherung von Cookies und
                        vergleichbaren Wiedererkennungstechnologien abgefragt wurde, erfolgt die Verarbeitung
                        ausschließlich auf Grundlage dieser Einwilligung (Art. 6 Abs. 1 lit. a DSGVO und § 25 Abs. 1
                        TDDDG); die Einwilligung ist jederzeit widerrufbar.</p>
                    <p>Sie können Ihren Browser so einstellen, dass Sie über das Setzen von Cookies informiert werden
                        und Cookies nur im Einzelfall erlauben, die Annahme von Cookies für bestimmte Fälle oder generell
                        ausschließen sowie das automatische Löschen der Cookies beim Schließen des Browsers aktivieren.
                        Bei der Deaktivierung von Cookies kann die Funktionalität dieser Website eingeschränkt sein.
                    </p>
                    <p>Welche Cookies und Dienste auf dieser Website eingesetzt werden, können Sie dieser
                        Datenschutzerklärung entnehmen.</p>
                    <h3>Anfrage per E-Mail, Telefon oder Telefax</h3>
                    <p>Wenn Sie uns per E-Mail, Telefon oder Telefax kontaktieren, wird Ihre Anfrage inklusive aller
                        daraus hervorgehenden personenbezogenen Daten (Name, Anfrage) zum Zwecke der Bearbeitung Ihres
                        Anliegens bei uns gespeichert und verarbeitet. Diese Daten geben wir nicht ohne Ihre Einwilligung
                        weiter.</p>
                    <p>Die Verarbeitung dieser Daten erfolgt auf Grundlage von Art. 6 Abs. 1 lit. b DSGVO, sofern Ihre
                        Anfrage mit der Erfüllung eines Vertrags zusammenhängt oder zur Durchführung vorvertraglicher
                        Maßnahmen erforderlich ist. In allen übrigen Fällen beruht die Verarbeitung auf unserem
                        berechtigten Interesse an der effektiven Bearbeitung der an uns gerichteten Anfragen (Art. 6 Abs.
                        1 lit. f DSGVO) oder auf Ihrer Einwilligung (Art. 6 Abs. 1 lit. a DSGVO) sofern diese abgefragt
                        wurde; die Einwilligung ist jederzeit widerrufbar.</p>
                    <p>Die von Ihnen an uns per Kontaktanfragen übersandten Daten verbleiben bei uns, bis Sie uns zur
                        Löschung auffordern, Ihre Einwilligung zur Speicherung widerrufen oder der Zweck für die
                        Datenspeicherung entfällt (z. B. nach abgeschlossener Bearbeitung Ihres Anliegens). Zwingende
                        gesetzliche Bestimmungen – insbesondere gesetzliche Aufbewahrungsfristen – bleiben unberührt.
                    </p>
                    <h3>Registrierung auf dieser Website</h3>
                    <p>Sie können sich auf dieser Website registrieren, um zusätzliche Funktionen auf der Seite zu
                        nutzen. Die dazu eingegebenen Daten verwenden wir nur zum Zwecke der Nutzung des jeweiligen
                        Angebotes oder Dienstes, für den Sie sich registriert haben. Die bei der Registrierung
                        abgefragten Pflichtangaben müssen vollständig angegeben werden. Anderenfalls werden wir die
                        Registrierung ablehnen.</p>
                    <p>Für wichtige Änderungen etwa beim Angebotsumfang oder bei technisch notwendigen Änderungen nutzen
                        wir die bei der Registrierung angegebene E-Mail-Adresse, um Sie auf diesem Wege zu informieren.
                    </p>
                    <p>Die Verarbeitung der bei der Registrierung eingegebenen Daten erfolgt zum Zwecke der Durchführung
                        des durch die Registrierung begründeten Nutzungsverhältnisses und ggf. zur Anbahnung weiterer
                        Verträge (Art. 6 Abs. 1 lit. b DSGVO).</p>
                    <p>Die bei der Registrierung erfassten Daten werden von uns gespeichert, solange Sie auf dieser
                        Website registriert sind und werden anschließend gelöscht. Gesetzliche Aufbewahrungsfristen
                        bleiben unberührt.</p>
                    <h3>Registrierung mit Google</h3>
                    <p>Statt einer direkten Registrierung auf dieser Website können Sie sich mit Google registrieren.
                        Anbieter dieses Dienstes ist die Google Ireland Limited („Google”), Gordon House, Barrow Street,
                        Dublin 4, Irland.</p>
                    <p>Um sich mit Google zu registrieren, müssen Sie ausschließlich Ihre Google-Namen und Ihr Passwort
                        eingeben. Google wird Sie identifizieren und unserer Website Ihre Identität bestätigen.</p>
                    <p>Wenn Sie sich mit Google anmelden, ist es uns ggf. möglich bestimmte Informationen auf Ihrem
                        Konto zu nutzen, um Ihr Profil bei uns zu vervollständigen. Ob und welche Informationen das sind,
                        entscheiden Sie im Rahmen Ihrer Google-Sicherheitseinstellungen, die Sie hier finden: <a
                            href="https://myaccount.google.com/security" target="_blank"
                            rel="noopener noreferrer">https://myaccount.google.com/security</a> und <a
                            href="https://myaccount.google.com/permissions" target="_blank"
                            rel="noopener noreferrer">https://myaccount.google.com/permissions</a>.</p>
                    <p>Die Datenverarbeitung, die mit der Google-Registrierung einhergeht beruht auf unserem berechtigten
                        Interesse, unseren Nutzern einen möglichst einfachen Registrierungsprozess zu ermöglichen (Art.
                        6 Abs. 1 lit. f DSGVO). Da die Nutzung der Registrierungsfunktion freiwillig ist und die Nutzer
                        selbst über die jeweiligen Zugriffsmöglichkeiten entscheiden können, sind keine
                        entgegenstehenden überwiegenden Rechte der Betroffenen ersichtlich.</p>
                    <p>Das Unternehmen verfügt über eine Zertifizierung nach dem „EU-US Data Privacy Framework“ (DPF).
                        Der DPF ist ein Übereinkommen zwischen der Europäischen Union und den USA, der die Einhaltung
                        europäischer Datenschutzstandards bei Datenverarbeitungen in den USA gewährleisten soll. Jedes
                        nach dem DPF zertifizierte Unternehmen verpflichtet sich, diese Datenschutzstandards
                        einzuhalten. Weitere Informationen hierzu erhalten Sie vom Anbieter unter folgendem Link: <a
                            href="https://www.dataprivacyframework.gov/participant/5780" target="_blank"
                            rel="noopener noreferrer">https://www.dataprivacyframework.gov/participant/5780</a>.</p>
                            <br />
                    <h2>5. Analyse-Tools und Werbung</h2>
                    <h3>IONOS WebAnalytics</h3>
                    <p>Diese Website nutzt die Analysedienste von IONOS WebAnalytics (im Folgenden: IONOS). Anbieter ist
                        die 1&1 IONOS SE, Elgendorfer Straße 57, D – 56410 Montabaur. Im Rahmen der Analysen mit IONOS
                        können u. a. Besucherzahlen und –verhalten (z. B. Anzahl der Seitenaufrufe, Dauer eines
                        Webseitenbesuchs, Absprungraten), Besucherquellen (d. h., von welcher Seite der Besucher kommt),
                        Besucherstandorte sowie technische Daten (Browser- und Betriebssystemversionen) analysiert
                        werden. Zu diesem Zweck speichert IONOS insbesondere folgende Daten:</p>
                    <ul>
                        <li>Referrer (zuvor besuchte Webseite)</li>
                        <li>angeforderte Webseite oder Datei</li>
                        <li>Browsertyp und Browserversion</li>
                        <li>verwendetes Betriebssystem</li>
                        <li>verwendeter Gerätetyp</li>
                        <li>Uhrzeit des Zugriffs</li>
                        <li>IP-Adresse in anonymisierter Form (wird nur zur Feststellung des Orts des Zugriffs
                            verwendet)</li>
                    </ul>
                    <p>Die Datenerfassung erfolgt laut IONOS vollständig anonymisiert, sodass sie nicht zu einzelnen
                        Personen zurückverfolgt werden kann. Cookies werden von IONOS WebAnalytics nicht gespeichert.
                    </p>
                    <p>Die Speicherung und Analyse der Daten erfolgt auf Grundlage von Art. 6 Abs. 1 lit. f DSGVO. Der
                        Websitebetreiber hat ein berechtigtes Interesse an der statistischen Analyse des Nutzerverhaltens,
                        um sowohl sein Webangebot als auch seine Werbung zu optimieren. Sofern eine entsprechende
                        Einwilligung abgefragt wurde, erfolgt die Verarbeitung ausschließlich auf Grundlage von Art. 6
                        Abs. 1 lit. a DSGVO und § 25 Abs. 1 TDDDG, soweit die Einwilligung die Speicherung von Cookies
                        oder den Zugriff auf Informationen im Endgerät des Nutzers (z. B. Device-Fingerprinting) im Sinne
                        des TDDDG umfasst. Die Einwilligung ist jederzeit widerrufbar.</p>
                    <p>Weitere Informationen zur Datenerfassung und Verarbeitung durch IONOS WebAnalytics entnehmen Sie
                        der Datenschutzerklärung von IONOS unter folgendem Link: <a
                            href="https://www.ionos.de/terms-gtc/datenschutzerklaerung/" target="_blank"
                            rel="noopener noreferrer">https://www.ionos.de/terms-gtc/datenschutzerklaerung/</a></p>

                    <h4>Auftragsverarbeitung</h4>
                    <p>Wir haben einen Vertrag über Auftragsverarbeitung (AVV) zur Nutzung des oben genannten Dienstes
                        geschlossen. Hierbei handelt es sich um einen datenschutzrechtlich vorgeschriebenen Vertrag, der
                        gewährleistet, dass dieser die personenbezogenen Daten unserer Websitebesucher nur nach unseren
                        Weisungen und unter Einhaltung der DSGVO verarbeitet.</p>
                        <br />
                    <h2>6. Plugins und Tools</h2>
                    <h3>Google Fonts (lokales Hosting)</h3>
                    <p>Diese Seite nutzt zur einheitlichen Darstellung von Schriftarten so genannte Google Fonts, die von
                        Google bereitgestellt werden. Die Google Fonts sind lokal installiert. Eine Verbindung zu Servern
                        von Google findet dabei nicht statt.</p>
                    <p>Weitere Informationen zu Google Fonts finden Sie unter <a
                            href="https://developers.google.com/fonts/faq" target="_blank"
                            rel="noopener noreferrer">https://developers.google.com/fonts/faq</a> und in der
                        Datenschutzerklärung von Google: <a href="https://policies.google.com/privacy?hl=de"
                            target="_blank" rel="noopener noreferrer">https://policies.google.com/privacy?hl=de</a>.</p>
                    <h3>Font Awesome (lokales Hosting)</h3>
                    <p>Diese Seite nutzt zur einheitlichen Darstellung von Schriftarten Font Awesome. Font Awesome ist
                        lokal installiert. Eine Verbindung zu Servern von Fonticons, Inc. findet dabei nicht statt.</p>
                    <p>Weitere Informationen zu Font Awesome finden Sie in der Datenschutzerklärung für Font Awesome
                        unter: <a href="https://fontawesome.com/privacy" target="_blank"
                            rel="noopener noreferrer">https://fontawesome.com/privacy</a>.</p>
                    <h3>ChatGPT</h3>
                    <p>Wir nutzen ChatGPT für unsere Kundenkommunikation. Anbieter ist die OpenAI, 3180 18th St, San
                        Francisco, CA 94110, USA, <a href="https://openai.com" target="_blank"
                            rel="noopener noreferrer">https://openai.com</a>. Wir nutzen ChatGPT für folgende Tools:
                    </p>
                    <ul>
                        <li>Die Anwendung basiert auf ChatGPT</li>
                    </ul>
                    <p>Wenn Sie über unsere Website ein Gespräch mit uns beginnen und ChatGPT aktiviert wird, werden Ihre
                        Eingaben inklusive Metadaten an die Server von ChatGPT übertragen und dort verarbeitet, um eine
                        passende Antwort zu generieren.</p>
                    <p>Es ist sichergestellt, dass die eingegebenen personenbezogenen Daten nicht zum Trainieren des Algorithmus von ChatGPT benutzt werden. Wir verwenden die Daten, die Sie uns zur Verfügung stellen, ausschließlich zur Bereitstellung und Verbesserung der Funktionen unserer Anwendung. Ihre über die OpenAI API verarbeiteten Daten werden ausschließlich zur Beantwortung Ihrer Anfragen genutzt und nicht für das Training der ChatGPT-Modelle verwendet.
                    </p>
                    <p>Die Verwendung von ChatGPT erfolgt auf Grundlage von Art. 6 Abs. 1 lit. f DSGVO. Der
                        Websitebetreiber hat ein berechtigtes Interesse an einer möglichst effizienten Kundenkommunikation
                        unter Einsatz moderner technischer Lösungen. Sofern eine entsprechende Einwilligung abgefragt
                        wurde, erfolgt die Verarbeitung ausschließlich auf Grundlage von Art. 6 Abs. 1 lit. a DSGVO und §
                        25 Abs. 1 TDDDG. Die Einwilligung ist jederzeit widerrufbar.</p>
                    <p>Weitere Informationen erhalten Sie hier: <a href="https://openai.com/policies/privacy-policy"
                            target="_blank" rel="noopener noreferrer">https://openai.com/policies/privacy-policy</a>.
                    </p>
                    <br />
                    <h2>7. eCommerce und Zahlungsanbieter</h2>
                    <h3>Verarbeiten von Kunden- und Vertragsdaten</h3>
                    <p>Wir erheben, verarbeiten und nutzen personenbezogene Kunden- und Vertragsdaten zur Begründung,
                        inhaltlichen Ausgestaltung und Änderung unserer Vertragsbeziehungen. Personenbezogene Daten über
                        die Inanspruchnahme dieser Website (Nutzungsdaten) erheben, verarbeiten und nutzen wir nur,
                        soweit dies erforderlich ist, um dem Nutzer die Inanspruchnahme des Dienstes zu ermöglichen oder
                        abzurechnen. Rechtsgrundlage hierfür ist Art. 6 Abs. 1 lit. b DSGVO.</p>
                    <p>Die erhobenen Kundendaten werden nach Abschluss des Auftrags oder Beendigung der Geschäftsbeziehung
                        und Ablauf der ggf. bestehenden gesetzlichen Aufbewahrungsfristen gelöscht. Gesetzliche
                        Aufbewahrungsfristen bleiben unberührt.</p>
                    <h3>Datenübermittlung bei Vertragsschluss für Dienstleistungen und digitale Inhalte</h3>
                    <p>Wir übermitteln personenbezogene Daten an Dritte nur dann, wenn dies im Rahmen der Vertragsabwicklung
                        notwendig ist, etwa an das mit der Zahlungsabwicklung beauftragte Kreditinstitut.</p>
                    <p>Eine weitergehende Übermittlung der Daten erfolgt nicht bzw. nur dann, wenn Sie der Übermittlung
                        ausdrücklich zugestimmt haben. Eine Weitergabe Ihrer Daten an Dritte ohne ausdrückliche
                        Einwilligung, etwa zu Zwecken der Werbung, erfolgt nicht.</p>
                    <p>Grundlage für die Datenverarbeitung ist Art. 6 Abs. 1 lit. b DSGVO, der die Verarbeitung von Daten
                        zur Erfüllung eines Vertrags oder vorvertraglicher Maßnahmen gestattet.</p>
                    <h3>Zahlungsdienste</h3>
                    <p>Wir binden Zahlungsdienste von Drittunternehmen auf unserer Website ein. Wenn Sie einen Kauf bei uns
                        tätigen, werden Ihre Zahlungsdaten (z. B. Name, Zahlungssumme, Kontoverbindung, Kreditkartennummer)
                        vom Zahlungsdienstleister zum Zwecke der Zahlungsabwicklung verarbeitet. Für diese Transaktionen
                        gelten die jeweiligen Vertrags- und Datenschutzbestimmungen der jeweiligen Anbieter. Der Einsatz
                        der Zahlungsdienstleister erfolgt auf Grundlage von Art. 6 Abs. 1 lit. b DSGVO
                        (Vertragsabwicklung) sowie im Interesse eines möglichst reibungslosen, komfortablen und sicheren
                        Zahlungsvorgangs (Art. 6 Abs. 1 lit. f DSGVO). Soweit für bestimmte Handlungen Ihre Einwilligung
                        abgefragt wird, ist Art. 6 Abs. 1 lit. a DSGVO Rechtsgrundlage der Datenverarbeitung; Einwilligungen
                        sind jederzeit für die Zukunft widerrufbar.</p>
                    <p>Folgende Zahlungsdienste / Zahlungsdienstleister setzen wir im Rahmen dieser Website ein:</p>
                    <h4>PayPal</h4>
                    <p>Anbieter dieses Zahlungsdienstes ist PayPal (Europe) S.à.r.l. et Cie, S.C.A., 22-24 Boulevard Royal,
                        L-2449 Luxembourg (im Folgenden „PayPal“).</p>
                    <p>Die Datenübertragung in die USA wird auf die Standardvertragsklauseln der EU-Kommission gestützt.
                        Details finden Sie hier: <a href="https://www.paypal.com/de/webapps/mpp/ua/pocpsa-full"
                            target="_blank" rel="noopener noreferrer">https://www.paypal.com/de/webapps/mpp/ua/pocpsa-full</a>.
                    </p>
                    <p>Details entnehmen Sie der Datenschutzerklärung von PayPal: <a
                            href="https://www.paypal.com/de/webapps/mpp/ua/privacy-full" target="_blank"
                            rel="noopener noreferrer">https://www.paypal.com/de/webapps/mpp/ua/privacy-full</a>.</p>
                            <h4>VISA</h4>
                            <p>Anbieter dieses Zahlungsdienstes ist die Visa Europe Services Inc., Zweigniederlassung London, 1 Sheldon Square, London W2 6TT, Gro&szlig;britannien (im Folgenden &bdquo;VISA&ldquo;).</p>
                            <p>Gro&szlig;britannien gilt als datenschutzrechtlich sicherer Drittstaat. Das bedeutet, dass Gro&szlig;britannien ein Datenschutzniveau aufweist, das dem Datenschutzniveau in der Europ&auml;ischen Union entspricht.</p>
                            <p>VISA kann Daten an seine Muttergesellschaft in die USA &uuml;bertragen. Die Daten&uuml;bertragung in die USA wird auf die Standardvertragsklauseln der EU-Kommission gest&uuml;tzt. Details finden Sie hier: <a href="https://www.visa.de/nutzungsbedingungen/visa-globale-datenschutzmitteilung/mitteilung-zu-zustandigkeitsfragen-fur-den-ewr.html" target="_blank" rel="noopener noreferrer">https://www.visa.de/nutzungsbedingungen/visa-globale-datenschutzmitteilung/mitteilung-zu-zustandigkeitsfragen-fur-den-ewr.html</a>.</p>
                            <p>Weitere Informationen entnehmen Sie der Datenschutzerkl&auml;rung von VISA: <a href="https://www.visa.de/nutzungsbedingungen/visa-privacy-center.html" target="_blank" rel="noopener noreferrer">https://www.visa.de/nutzungsbedingungen/visa-privacy-center.html</a>.</p>
                        
                </div>
            </div>
        </div>
    </section>

    @include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('asset/js/toast.js') }}"></script>
</body>

</html>
