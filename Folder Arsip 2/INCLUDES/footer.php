<?=
// BIAR BISA SHARING footer and scripts for all pages
?>
    </main><!-- end .main-content -->
</div><!-- end .main-wrap -->
</div><!-- end .layout -->

<!-- Leaflet JS (only on map pages) -->
<?php if (isset($use_map) && $use_map): ?>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<?php endif; ?>

<!-- Main JS -->
<script src="assets/main.js"></script>

<?php if (isset($page_scripts)): ?>
<script><?php echo $page_scripts; ?></script>
<?php endif; ?>

</body>
</html>
