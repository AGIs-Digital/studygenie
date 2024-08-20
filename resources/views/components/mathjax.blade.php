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
            processEscapes: true,
            tags: 'ams'
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
            skipHtmlTags: ['script', 'noscript', 'style', 'textarea', 'pre'],
            ignoreHtmlClass: 'tex2jax_ignore',
            processHtmlClass: 'tex2jax_process'
        },
        startup: {
            ready: () => {
                MathJax.startup.defaultReady();
                MathJax.startup.promise.then(() => {
                    console.log('MathJax initialisiert');
                });
            }
        }
    };
</script>