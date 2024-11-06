<section class="frequentlyAskedQuestionSection">
    <img src="{{ asset('asset/images/fragezeichen.svg') }}" alt="fragezeichen" loading="lazy">
    <h2>Wissenswertes über StudyGenie</h2>
    <div class="questionsContainer">
    <div class="question">
            <div class="questionContentContainer">
                <img class="plusIcon" src="{{ asset('asset/images/ic_plus.png') }}" alt="Plus Icon" loading="lazy">
                <img class="crossIcon" src="{{ asset('asset/images/ic_cross.png') }}" alt="Kreuz Icon" loading="lazy">
                Wieso StudyGenie und keine LLMs (KI) wie ChatGPT und co?
            </div>
            <div class="answerContentContainer">
            Bei StudyGenie haben wir die komplexen KI-Einstellungen bereits für dich optimiert. Ohne diese Einstellungen liefern KI-Tools oft ungenaue Ergebnisse. Bei uns kannst du dir sicher sein, immer die neuesten KI-Modelle zu nutzen. Zudem ist unser Diamant-Abo kostengünstiger als vergleichbare Abos bei anderen KI-Tools.
            </div>

        </div>
        <div class="question">
            <div class="questionContentContainer">
                <img class="plusIcon" src="{{ asset('asset/images/ic_plus.png') }}" alt="Plus Icon" loading="lazy">
                <img class="crossIcon" src="{{ asset('asset/images/ic_cross.png') }}" alt="Kreuz Icon" loading="lazy">
                Was unterscheidet StudyGenie von anderen Lern- und Karriereplattformen?
            </div>
            <div class="answerContentContainer">
            StudyGenie hebt sich durch seine Herangehensweise von anderen Lern- und Karriereplattformen ab. Im Gegensatz zu den statischen Inhalten anderer Plattformen bietet StudyGenie durch die Verwendung von künstlicher Intelligenz dynamische und individuell zugeschnittene Unterstützung beim Lernen und in der Karriereplanung.
            </div>

        </div>
        <div class="question">
            <div class="questionContentContainer">
                <img class="plusIcon" src="{{ asset('asset/images/ic_plus.png') }}" alt="Plus Icon" loading="lazy">
                <img class="crossIcon" src="{{ asset('asset/images/ic_cross.png') }}" alt="Kreuz Icon" loading="lazy">
                Welche Daten werden gespeichert?
            </div>
            <div class="answerContentContainer">
            Wir speichern lediglich den Namen, den du dir hier aussuchst, deine E-Mail-Adresse und das verschlüsselte Passwort. Zusätzlich werden die Antworten, die du in deinem Archiv ablegst, gespeichert, um sie dir jederzeit zugänglich zu machen.
            </div>

        </div>
        <div class="question">
            <div class="questionContentContainer">
                <img class="plusIcon" src="{{ asset('asset/images/ic_plus.png') }}" alt="Plus Icon" loading="lazy">
                <img class="crossIcon" src="{{ asset('asset/images/ic_cross.png') }}" alt="Kreuz Icon" loading="lazy">
                Wie sicher sind meine Daten?
            </div>
            <div class="answerContentContainer">
            Die Sicherheit deiner Daten ist uns sehr wichtig. Deine Daten, Fragen und Antworten werden nicht zum Training für künstliche Intelligenzen benutzt. Deine Daten werden mit modernsten Technologien verschlüsselt. So kannst du sicher sein, dass deine Daten bei StudyGenie bestens geschützt sind.
            </div>
        </div>
        <div class="question">
            <div class="questionContentContainer">
                <img class="plusIcon" src="{{ asset('asset/images/ic_plus.png') }}" alt="Plus Icon" loading="lazy">
                <img class="crossIcon" src="{{ asset('asset/images/ic_cross.png') }}" alt="Kreuz Icon" loading="lazy">
                Wie kann ich mein Abo bei StudyGenie kündigen oder ändern?
            </div>
            <div class="answerContentContainer">
            Um dein Abo bei StudyGenie zu kündigen oder zu ändern, navigiere einfach zu 'Profil'. Unsere Abopläne sind flexibel und monatlich kündbar.
            </div>

        </div>
        <div class="question">
            <div class="questionContentContainer">
                <img class="plusIcon" src="{{ asset('asset/images/ic_plus.png') }}" alt="Plus Icon" loading="lazy">
                <img class="crossIcon" src="{{ asset('asset/images/ic_cross.png') }}" alt="Kreuz Icon" loading="lazy">
                Wie kann ich bezahlen?
            </div>
            <div class="answerContentContainer">
            Du kannst dein Abo ganz bequem per PayPal oder Kreditkarte bezahlen. Zudem ist es jederzeit kündbar, sodass du volle Flexibilität genießt.
            </div>
        </div>
    </div>
</section>
<script>
    document.querySelectorAll('.question').forEach(item => {
  item.addEventListener('click', (event) => {
    const question = event.currentTarget;
    const answer = question.querySelector('.answerContentContainer');
    const plusIcon = question.querySelector('.plusIcon');
    const crossIcon = question.querySelector('.crossIcon');
    
    answer.classList.toggle('showAnswerDiv');
    plusIcon.classList.toggle('hidePlusIcon');
    crossIcon.classList.toggle('showCrossIcon');
  });
});

document.querySelectorAll('.plusIcon, .crossIcon').forEach(icon => {
  icon.addEventListener('click', (event) => {
    event.stopPropagation();
    const question = icon.closest('.question');
    const answer = question.querySelector('.answerContentContainer');
    const plusIcon = question.querySelector('.plusIcon');
    const crossIcon = question.querySelector('.crossIcon');
    
    answer.classList.toggle('showAnswerDiv');
    plusIcon.classList.toggle('hidePlusIcon');
    crossIcon.classList.toggle('showCrossIcon');
  });
});
</script>