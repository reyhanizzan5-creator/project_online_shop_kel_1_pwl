(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    initConfirmModal();
    initFlashMessages();
    initPasswordToggle();
    initDoubleSubmitGuard();
    initAutoSubmitSearch();
  });

  function initConfirmModal() {
    var overlay = document.getElementById('confirm-modal');
    var forms = document.querySelectorAll('form[data-confirm]');
    if (!overlay || forms.length === 0) return;

    var titleEl = overlay.querySelector('.modal-title');
    var textEl = overlay.querySelector('.modal-text');
    var btnYes = overlay.querySelector('[data-confirm-yes]');
    var btnNo = overlay.querySelector('[data-confirm-no]');
    var formTarget = null;

    forms.forEach(function (form) {
      form.addEventListener('submit', function (e) {
        if (form.dataset.confirmed === 'true') return;
        e.preventDefault();
        formTarget = form;
        titleEl.textContent = form.dataset.confirmTitle || 'Konfirmasi Tindakan';
        textEl.textContent = form.dataset.confirm;
        overlay.classList.add('is-open');
        btnYes.focus();
      });
    });

    function tutup() {
      overlay.classList.remove('is-open');
      formTarget = null;
    }

    btnYes.addEventListener('click', function () {
      overlay.classList.remove('is-open');
      if (formTarget) {
        formTarget.dataset.confirmed = 'true';
        var btn = formTarget.querySelector('button[type="submit"]');
        if (btn) btn.disabled = true;
        if (formTarget.requestSubmit) {
          formTarget.requestSubmit();
        } else {
          formTarget.submit();
        }
      }
    });
    btnNo.addEventListener('click', tutup);
    overlay.addEventListener('click', function (e) {
      if (e.target === overlay) tutup();
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && overlay.classList.contains('is-open')) tutup();
    });
  }

  /** Flash message (.alert) otomatis hilang setelah beberapa detik + tombol tutup manual. */
  function initFlashMessages() {
    document.querySelectorAll('.alert[data-autohide]').forEach(function (alert) {
      setTimeout(function () {
        fadeOutRemove(alert);
      }, 4500);
    });
    document.querySelectorAll('.alert-close').forEach(function (btn) {
      btn.addEventListener('click', function () {
        fadeOutRemove(btn.closest('.alert'));
      });
    });
  }

  function fadeOutRemove(el) {
    if (!el) return;
    el.style.transition = 'opacity .3s ease, transform .3s ease';
    el.style.opacity = '0';
    el.style.transform = 'translateY(-6px)';
    setTimeout(function () { el.remove(); }, 300);
  }

  /** Tombol "Lihat/Sembunyikan" pada input password. */
  function initPasswordToggle() {
    document.querySelectorAll('.password-toggle').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var input = document.getElementById(btn.dataset.target);
        if (!input) return;
        var showing = input.type === 'text';
        input.type = showing ? 'password' : 'text';
        btn.textContent = showing ? 'Lihat' : 'Sembunyikan';
      });
    });
  }

  /** Menonaktifkan tombol submit setelah diklik supaya form tidak terkirim dua kali. */
  function initDoubleSubmitGuard() {
    document.querySelectorAll('form:not([data-confirm])').forEach(function (form) {
      form.addEventListener('submit', function () {
        if (form.dataset.noGuard === 'true') return;
        var btn = form.querySelector('button[type="submit"]');
        if (btn) {
          window.setTimeout(function () { btn.disabled = true; }, 0);
        }
      });
    });
  }

  /** Form pencarian (toolbar admin/produk) otomatis submit setelah berhenti mengetik. */
  function initAutoSubmitSearch() {
    document.querySelectorAll('[data-autosubmit]').forEach(function (input) {
      var timer = null;
      input.addEventListener('input', function () {
        clearTimeout(timer);
        timer = setTimeout(function () {
          if (!input.form) return;
          input.form.requestSubmit ? input.form.requestSubmit() : input.form.submit();
        }, 450);
      });
    });
  }
})();
