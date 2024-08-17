<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
<script>
    window.MathJax = {
        tex: {
            inlineMath: [
                ['$', '$'],
                ['\\(', '\\)']
            ],
            displayMath: [
                ['$$', '$$'],
                ['\\[', '\\]']
            ],
            processEscapes: true, // Vermeidet unnötige Verarbeitung
            tags: 'ams' // Schnelleres Rendern von Gleichungen
        },
        svg: {
            fontCache: 'global'
        },
        options: {
            renderActions: {
                addMenu: [0, '', ''],
                checkLoading: [0, '', ''],
                checkStixFonts: [0, '', ''],
                checkWebFonts: [0, '', '']
            },
            skipHtmlTags: ['script', 'noscript', 'style', 'textarea', 'pre'], // Vermeidet unnötige Verarbeitung
            ignoreHtmlClass: 'tex2jax_ignore', // Vermeidet unnötige Verarbeitung
            processHtmlClass: 'tex2jax_process' // Vermeidet unnötige Verarbeitung
        }
    };
</script>