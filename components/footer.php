</div>

<footer class="bg-dark text-white text-center py-3 mt-5">
    <small>Proxy Block Generator © <?= date("Y") ?></small>
</footer>

<script src="assets/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.querySelectorAll('.site-card').forEach(card => {
        card.addEventListener('click', function(e) {
            if (e.target.tagName !== "INPUT" && e.target.tagName !== "LABEL") {
                const checkbox = this.querySelector('input[type="checkbox"]');
                checkbox.checked = !checkbox.checked;
            }
        });
    });
    function toggleSection(sectionId, checked) {
        const section = document.getElementById(sectionId);
        if (!section) return;
        const checkboxes = section.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(cb => cb.checked = checked);
    }
</script>

</body>

</html>