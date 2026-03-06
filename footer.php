</main>
<footer>
  <section class="parent">
    <section class="colofonFooter">

      <!-- Footer Widget Area -->
      <?php if (is_active_sidebar('footer-1')) : ?>
        <?php dynamic_sidebar('footer-1'); ?>
      <?php endif; ?>
      <img src="https://kunstinc.nl/wp-content/uploads/2024/06/KIC_logo_zw.png" alt="Kunst in C logo zwart-wit">
    </section>
    <section class="imgFooter">
      <?php if (is_active_sidebar('footer-image')) : ?>
        <?php dynamic_sidebar('footer-image'); ?>
      <?php endif; ?>
    </section>
  </section>
  <div class="sub-footer fixed-width">
    <?php if (is_active_sidebar('prefooter-1')) : ?>
      <?php dynamic_sidebar('prefooter-1'); ?>
    <?php endif; ?>
  </div>
</footer>

<?php wp_enqueue_script("script", get_template_directory_uri() . '/assets/js/script.js'); ?>
<?php wp_enqueue_script("archive", get_template_directory_uri() . '/assets/js/archive.js'); ?>
<?php wp_enqueue_script("route", get_template_directory_uri() . '/assets/js/route-animatie.js'); ?>
<?php wp_enqueue_script("collectie", get_template_directory_uri() . '/assets/js/index.js'); ?>
<?php wp_enqueue_script("mapdetail", get_template_directory_uri() . '/assets/js/mapdetail.js'); ?>
<?php wp_footer(); ?>
</body>
</html>
