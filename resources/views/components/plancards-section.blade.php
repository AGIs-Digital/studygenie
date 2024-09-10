<div class="planCardsContainer">
    <img id="upperDesign" src="{{ asset('asset/images/patterns.png') }}" alt="Oberes Design" loading="lazy">
    
    <div class="planCard">
        <div class="headerPlanCard">
            <img class="crownImg" src="{{ asset('asset/images/landingpage/silber.png') }}" alt="Kronenbild Silber" loading="lazy">
            <h1 class="secondary-Heading" style="color: #fff">Silber</h1>
        </div>
        <div class="contentPlanCard contentPlanCard1">
            <span class="highWeightSpan">Kostenlos<span class="lowWeightSpan"><span><br />Du bekommst:</span></span>
            <p class="planCardParagraph">

                <span class="textmarker">✓ Intelligente Soforthilfe</span><br />
                <span class="textmarker">✓ Traumberuf finden</span><br />
                <span class="textmarker">✓ Berufsinformationen</span><br /> 
            </p>
            </span>
        </div>
        @guest
            <button data-bs-toggle="modal" data-bs-target="#loginModal" class="plancardButton">Kostenlos</button>
        @else
            @if(auth()->user()->subscription_name == 'silber')
                <button class="plancardButton" disabled>Aktueller Status</button>
            @else
                <button class="plancardButton" id="silberButton" data-paypal-plan="silber" data-paypal-route="{{ route('subscription.updateSilberSubscription') }}">Kostenlos</button>
            @endif
        @endguest
    </div>
    
    <div class="planCard">
        <div class="headerPlanCard">
            <img class="crownImg" src="{{ asset('asset/images/landingpage/gold.png') }}" alt="Kronenbild Gold" loading="lazy">
            <h1 class="secondary-Heading" style="color: #fff">Gold</h1>
        </div>
        <div class="contentPlanCard contentPlanCard1">
            <span class="highWeightSpan">10 € <span class="lowWeightSpan">/ Monat<span><br />Alles aus Silber +</span></span>
                <p class="planCardParagraph">
                <span class="blue-textmarker">✓ Textinspirationen</span><br /> 
                <span class="blue-textmarker">✓ Textanalysen</span><br /> 
                <span class="blue-textmarker">✓ Bewerbungsunterlagen</span><br /> 
                </p>
            </span>
            @guest
                <button data-bs-toggle="modal" data-bs-target="#loginModal" class="plancardButton">Hol dir Gold</button>
            @else
                @if(auth()->user()->subscription_name == 'gold')
                    <button class="plancardButton" disabled>Aktueller Status</button>
                @else
                    <button class="plancardButton" data-paypal-route="{{ route('paypal.createSubscription') }}" data-paypal-plan="P-5XT70630D04889123M2LLU5A" data-is-subscription="true">Hol dir Gold</button>
                @endif
            @endguest
        </div>
        <br />
    </div>
    
    <div class="planCard">
        <div class="headerPlanCard">
            <div class="ribbon ribbon-top-left"><span>Empfohlen</span></div>
            <img class="crownImg" src="{{ asset('asset/images/landingpage/diamant.png') }}" alt="Kronenbild Diamant" loading="lazy">
            <h1 class="secondary-Heading" style="color: #fff">Diamant</h1>
        </div>
        <div class="contentPlanCard contentPlanCard1">
            <span class="highWeightSpan">20 € <span class="lowWeightSpan">/ Monat<span><br />Alles aus Gold +</span></span>
            <p class="planCardParagraph">
                <span class="green-textmarker">✓ Tutor</span><br /> 
                <span class="green-textmarker">✓ Karriere Mentor</span>
                <br /><br />
            </p>
            </span>
            @guest
                <button data-bs-toggle="modal" data-bs-target="#loginModal" class="plancardButton">Hol dir Diamant</button>
            @else
                @if(auth()->user()->subscription_name == 'diamant')
                    <button class="plancardButton" disabled>Aktueller Status</button>
                @else
                    <button class="plancardButton" data-paypal-route="{{ route('paypal.createSubscription') }}" data-paypal-plan="P-73N16093HM5621830M2LLU5I" data-is-subscription="true">Hol dir Diamant</button>
                @endif
            @endguest
        </div>
    </div>
    
    <img id="lowerDesign" src="{{ asset('asset/images/patterns1.png') }}" alt="Unteres Design" loading="lazy">
</div>