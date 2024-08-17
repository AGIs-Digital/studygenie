async function typeText() {
    if (currentChar < textToType.length) {
        // Füge den nächsten Block von Zeichen hinzu
        let nextBlock = textToType.substring(currentChar, currentChar + blockSize);
        currentChar += blockSize;

        // Überprüfe, ob der Block ein HTML-Tag enthält
        if (nextBlock.includes('<')) {
            let endTagIndex = textToType.indexOf('>', currentChar);
            if (endTagIndex !== -1) {
                nextBlock = textToType.substring(currentChar - blockSize, endTagIndex + 1);
                currentChar = endTagIndex + 1;
            }
        }

        typedTextElement.innerHTML += nextBlock;

        await MathJax.typesetPromise([typedTextElement]); // Render MathJax content after each block
        typedTextElement.scrollTop = typedTextElement.scrollHeight; // Scroll to the bottom
        setTimeout(typeText, 20); // Adjust the typing speed (in milliseconds)
    } else {
        // Füge den gesamten Text hinzu und formatiere ihn
        alltext += textToType + " ";
        typedTextElement.innerHTML = alltext;
        currentChar = 0;
        curloop++;
        await MathJax.typesetPromise([typedTextElement]); // Final render of MathJax content
        typedTextElement.scrollTop = typedTextElement.scrollHeight; // Ensure final scroll to the bottom
        typeFun();
    }
}

async function typeFun() {
    if (curloop < textarray.length) {
        textToType = textarray[curloop];
        typeText();
    } else {
        alltext = '';
        textToType = [];
        curloop = 0;
        await MathJax.typesetPromise([typedTextElement]); // Ensure final MathJax rendering
        typedTextElement.scrollTop = typedTextElement.scrollHeight; // Ensure final scroll to the bottom
    }
}