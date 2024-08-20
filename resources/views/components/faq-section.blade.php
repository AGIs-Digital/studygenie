<section class="frequentlyAskedQuestionSection">
    <img src="{{ asset('asset/images/23.png') }}" alt="Z Design" loading="lazy">
    <h1 class="secondary-Heading">Wissenswertes über StudyGenie</h1>
    <div class="questionsContainer">
        <div class="question">
            <div class="questionContentContainer">
                <img class="plusIcon" src="{{ asset('asset/images/ic_plus.png') }}" alt="Plus Icon" loading="lazy">
                <img class="crossIcon" src="{{ asset('asset/images/ic_cross.png') }}" alt="Kreuz Icon" loading="lazy">
                Was unterscheidet StudyGenie von anderen Lern- und Karriereplattformen?
            </div>
            <div class="answerContentContainer">
                StudyGenie setzt sich durch seine KI-basierte Herangehensweise von anderen Lern- und Karriereplattformen ab. Im Gegensatz zu statischen Inhalten anderer Plattformen, bietet StudyGenie dynamische, individuell zugeschnittene Unterstützung beim Lernen und in der Karriereplanung.
            </div>

        </div>
        <div class="question">
            <div class="questionContentContainer">
                <img class="plusIcon" src="{{ asset('asset/images/ic_plus.png') }}" alt="Plus Icon" loading="lazy">
                <img class="crossIcon" src="{{ asset('asset/images/ic_cross.png') }}" alt="Kreuz Icon" loading="lazy">
                Welche Daten werden gespeichert?
            </div>
            <div class="answerContentContainer">
                Wir speichern lediglich deinen Namen, deine E-Mail-Adresse und das Passwort. Zusätzlich werden die Antworten, die du in deinem Archiv ablegst, gesichert, um sie dir jederzeit zugänglich zu machen.
            </div>

        </div>
        <div class="question">
            <div class="questionContentContainer">
                <img class="plusIcon" src="{{ asset('asset/images/ic_plus.png') }}" alt="Plus Icon" loading="lazy">
                <img class="crossIcon" src="{{ asset('asset/images/ic_cross.png') }}" alt="Kreuz Icon" loading="lazy">
                Wie sicher sind meine Daten?
            </div>
            <div class="answerContentContainer">
                Die Sicherheit deiner Daten ist uns sehr wichtig. Wir speichern nur die absolut notwendigen Daten und gewährleisten ihre Sicherheit durch modernste Verschlüsselungstechnologien. So kannst du sicher sein, dass deine Daten bei StudyGenie bestens geschützt sind.
            </div>

        </div>
        <div class="question">
            <div class="questionContentContainer">
                <img class="plusIcon" src="{{ asset('asset/images/ic_plus.png') }}" alt="Plus Icon" loading="lazy">
                <img class="crossIcon" src="{{ asset('asset/images/ic_cross.png') }}" alt="Kreuz Icon" loading="lazy">
                Wie kann ich mein Abo bei StudyGenie kündigen oder upgraden?
            </div>
            <div class="answerContentContainer">
                Um dein Abo bei StudyGenie zu kündigen oder upzugraden, navigiere einfach zu 'Mein Profil'. Unsere Abopläne sind flexibel und monatlich kündbar. In einem übersichtlichen Fenster siehst du zudem immer, wie viele Tage deines aktuellen Abos noch verbleiben.
            </div>

        </div>
        <div class="question">
            <div class="questionContentContainer">
                <img class="plusIcon" src="{{ asset('asset/images/ic_plus.png') }}" alt="Plus Icon" loading="lazy">
                <img class="crossIcon" src="{{ asset('asset/images/ic_cross.png') }}" alt="Kreuz Icon" loading="lazy">
                Wie kann ich bezahlen?
            </div>
            <div class="answerContentContainer">
                Du kannst dein Abo ganz bequem per PayPal oder Kreditkarte bezahlen. Zudem ist es jederzeit kündbar, sodass du vollste Flexibilität genießt.
            </div>
        </div>
    </div>
</section>
<script>
    document.querySelectorAll('.questionContentContainer').forEach(item => {
  item.addEventListener('click', () => {
    const answer = item.nextElementSibling;
    const plusIcon = item.querySelector('.plusIcon');
    const crossIcon = item.querySelector('.crossIcon');
    
    answer.classList.toggle('showAnswerDiv');
    plusIcon.classList.toggle('hidePlusIcon');
    crossIcon.classList.toggle('showCrossIcon');
  });
});
</script>