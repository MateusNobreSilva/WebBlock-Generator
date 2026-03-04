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
</script>

</body>

</html>