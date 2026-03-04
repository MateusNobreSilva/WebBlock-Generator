</div>

<footer class="bg-dark text-white text-center py-3 mt-5">
    <small>Proxy Block Generator © <?= date("Y") ?></small>
</footer>

<script src="assets/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.querySelectorAll('.site-card').forEach(card => {
        card.addEventListener('click', function(e) {
            if (e.target.closest('.form-check')) return;
            const checkbox = this.querySelector('input[type="checkbox"]');
            checkbox.checked = !checkbox.checked;
        });
    });

    function toggleSection(sectionId, checked) {
        const section = document.getElementById(sectionId);
        if (!section) return;
        section.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = checked);
    }


    function normalizeDomainClient(s) {
        s = (s || '').trim().toLowerCase();
        if (!s) return '';
        s = s.replace(/^https?:\/\//i, '');
        s = s.split('/')[0].trim();
        if (!s) return '';
        if (!s.startsWith('.')) s = '.' + s;
        return s;
    }

    async function carregarBloqueios() {
        try {
            const resp = await fetch('carregar.php', {
                cache: 'no-store'
            });
            const bloqueados = await resp.json();

            const set = new Set((bloqueados || []).map(d => normalizeDomainClient(d)));


            document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);


            document.querySelectorAll('input[type="checkbox"]').forEach(cb => {
                const dom = normalizeDomainClient(cb.value);
                if (set.has(dom)) cb.checked = true;
            });

            alert("Bloqueios carregados do Squid!");
        } catch (err) {
            console.error(err);
            alert("Não consegui carregar o arquivo atual. Verifique o carregar.php e permissões.");
        }
    }

    function abrirSeletorArquivo() {
        const input = document.getElementById('filePicker');
        input.value = ''; // permite escolher o mesmo arquivo de novo
        input.click();
    }

    function normalizeDomainClient(s) {
        s = (s || '').trim().toLowerCase();
        if (!s) return '';

        // ignora comentários tipo "# alguma coisa"
        if (s.startsWith('#')) return '';

        // remove http/https
        s = s.replace(/^https?:\/\//i, '');

        // pega só antes de /
        s = s.split('/')[0].trim();

        if (!s) return '';

        // garante ponto no começo
        if (!s.startsWith('.')) s = '.' + s;

        return s;
    }

    function aplicarBloqueiosNaTela(lista) {
        const set = new Set(lista.map(normalizeDomainClient).filter(Boolean));

        // desmarca tudo
        document.querySelectorAll('input[type="checkbox"]').forEach(cb => {
            cb.checked = false;
        });

        // marca o que existe no arquivo
        document.querySelectorAll('input[type="checkbox"]').forEach(cb => {
            const dom = normalizeDomainClient(cb.value);
            if (set.has(dom)) cb.checked = true;
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        const input = document.getElementById('filePicker');
        if (!input) return;

        input.addEventListener('change', async (e) => {
            const file = e.target.files && e.target.files[0];
            if (!file) return;

            const text = await file.text();

            const linhas = text
                .split(/\r?\n/)
                .map(l => l.trim())
                .filter(l => l.length > 0);

            aplicarBloqueiosNaTela(linhas);

            alert(`Arquivo carregado! Itens lidos: ${linhas.length}`);
        });
    });
</script>

</body>

</html>