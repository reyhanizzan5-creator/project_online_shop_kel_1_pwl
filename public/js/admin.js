(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    initSidebarToggle();
    initImagePreview();
  });

  /** Sidebar admin berubah jadi off-canvas di layar sempit. */
  function initSidebarToggle() {
    var toggleBtn = document.querySelector('[data-sidebar-toggle]');
    var sidebar = document.querySelector('.admin-sidebar');
    var scrim = document.querySelector('.sidebar-scrim');
    if (!toggleBtn || !sidebar) return;

    function tutup() {
      sidebar.classList.remove('is-open');
      if (scrim) scrim.classList.remove('is-open');
    }

    toggleBtn.addEventListener('click', function () {
      sidebar.classList.toggle('is-open');
      if (scrim) scrim.classList.toggle('is-open');
    });
    if (scrim) scrim.addEventListener('click', tutup);
  }

  /** Menampilkan pratinjau gambar produk sebelum benar-benar diunggah. */
  function initImagePreview() {
    document.querySelectorAll('[data-image-input]').forEach(function (input) {
      input.addEventListener('change', function () {
        var preview = document.querySelector(input.dataset.imageInput);
        if (!preview || !input.files || !input.files[0]) return;

        var reader = new FileReader();
        reader.onload = function (e) { preview.src = e.target.result; };
        reader.readAsDataURL(input.files[0]);
      });
    });
  }
})();
