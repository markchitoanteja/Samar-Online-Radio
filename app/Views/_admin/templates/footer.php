            <footer class="app-footer">
                <div class="float-end d-none d-sm-inline">Version 1.5.0</div>
                <strong>
                    Copyright &copy; 2023-<span id="current_year"></span>
                    <a href="<?= base_url() ?>" target="_blank" rel="noopener noreferrer" class="text-decoration-none">Samar Online Radio</a>.
                </strong>
                All rights reserved.
            </footer>
        </div>

        <script>
            const base_url = <?= json_encode(base_url()) ?>;
            const user_id = <?= json_encode(session()->get("user_id")) ?>;
            const current_tab = <?= json_encode(session()->get("current_tab")) ?>;
            const notification = <?= json_encode(session()->get("notification") ?? null) ?>;
        
            let existingPlaylists = null;
            
            <?php if (session()->get("current_tab") === "playlists"): ?>
                existingPlaylists = <?= json_encode($playlists) ?>;
            <?php endif; ?>
        </script>

        <?php if (is_internet_available()): ?>
            <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" integrity="sha384-k5vbMeKHbxEZ0AEBTSdR7UjAgWCcUfrS8c0c5b2AfIh7olfhNkyCZYwOfzOQhauK" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/jsmediatags/dist/jsmediatags.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
        <?php else: ?>
            <script src="../public/admin/dist/js/overlayscrollbars.browser.es6.min.js"></script>
            <script src="../public/admin/dist/js/popper.min.js"></script>
            <script src="../public/admin/dist/js/bootstrap.min.js"></script>
            <script src="../public/admin/dist/js/apexcharts.min.js"></script>
            <script src="../public/admin/dist/js/jquery-3.7.1.min.js"></script>
            <script src="../public/admin/dist/js/sweetalert2@11.js"></script>
            <script src="../public/admin/dist/js/jquery.dataTables.min.js"></script>
            <script src="../public/admin/dist/js/jsmediatags.min.js"></script>
            <script src="../public/admin/dist/js/Sortable.min.js"></script>
        <?php endif ?>

        <script src="../public/admin/dist/js/adminlte.js"></script>
        <script src="../public/admin/dist/js/script.js?v=4.1.1"></script>
    </body>
</html>