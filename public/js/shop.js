(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    initStepper();
    initAddToCartForms();
    initCartRows();
    initMobileNav();
  });

  /** Menu navbar toko yang berubah jadi dropdown di layar sempit. */
  function initMobileNav() {
    var toggleBtn = document.querySelector('[data-shop-nav-toggle]');
    var links = document.querySelector('.shop-nav-links');
    if (!toggleBtn || !links) return;

    toggleBtn.addEventListener('click', function () {
      links.classList.toggle('is-open');
    });
  }

  function csrfToken() {
    var meta = document.querySelector('meta[name="csrf-token"]');
    return meta ? meta.content : '';
  }

  function toast(message, tone) {
    var wrap = document.querySelector('.toast-wrap');
    if (!wrap) {
      wrap = document.createElement('div');
      wrap.className = 'toast-wrap';
      document.body.appendChild(wrap);
    }
    var el = document.createElement('div');
    el.className = 'toast';
    el.textContent = message;
    if (tone === 'error') el.style.background = 'var(--color-bahaya)';
    wrap.appendChild(el);
    setTimeout(function () {
      el.style.transition = 'opacity .25s ease';
      el.style.opacity = '0';
      setTimeout(function () { el.remove(); }, 250);
    }, 2800);
  }

  function updateCartBadge(jumlah) {
    document.querySelectorAll('[data-cart-badge]').forEach(function (badge) {
      if (jumlah > 0) {
        badge.textContent = jumlah;
        badge.classList.remove('hidden');
      } else {
        badge.classList.add('hidden');
      }
    });
  }

  /** Tombol +/- pada input jumlah (halaman detail produk & keranjang). */
  function initStepper() {
    document.querySelectorAll('.input-stepper').forEach(function (stepper) {
      var input = stepper.querySelector('input');
      if (!input) return;
      var min = parseInt(input.min || '1', 10);
      var max = parseInt(input.max || '999999', 10);

      stepper.querySelectorAll('button').forEach(function (btn) {
        btn.addEventListener('click', function () {
          var val = parseInt(input.value || '1', 10);
          if (isNaN(val)) val = min;
          val = btn.dataset.step === 'up' ? Math.min(max, val + 1) : Math.max(min, val - 1);
          input.value = val;
          input.dispatchEvent(new Event('change', { bubbles: true }));
        });
      });
    });
  }

  function initAddToCartForms() {
    document.querySelectorAll('form[data-add-cart]').forEach(function (form) {
      form.addEventListener('submit', function (e) {
        e.preventDefault();
        var btn = form.querySelector('button[type="submit"]');
        var originalHtml = btn ? btn.innerHTML : '';
        if (btn) {
          btn.disabled = true;
          btn.innerHTML = 'Menambahkan…';
        }

        fetch(form.action, {
          method: 'POST',
          headers: { 'X-CSRF-TOKEN': csrfToken(), 'Accept': 'application/json' },
          body: new FormData(form),
        })
          .then(function (res) {
            return res.json().then(function (data) { return { ok: res.ok, data: data }; });
          })
          .then(function (result) {
            toast(result.data.pesan, result.ok ? 'success' : 'error');
            if (result.ok) updateCartBadge(result.data.jumlah_item_keranjang);
          })
          .catch(function () {
            toast('Terjadi kesalahan, silakan coba lagi.', 'error');
          })
          .finally(function () {
            if (btn) {
              btn.disabled = false;
              btn.innerHTML = originalHtml;
            }
          });
      });
    });
  }

  function initCartRows() {
    document.querySelectorAll('[data-cart-row]').forEach(function (row) {
      var updateForm = row.querySelector('form[data-cart-update-form]');
      var deleteForm = row.querySelector('form[data-cart-delete-form]');
      var stepperInput = row.querySelector('.input-stepper input');
      var debounceTimer = null;

      function kirimUpdate(jumlah) {
        if (!updateForm) return;
        row.classList.add('is-updating');

        fetch(updateForm.action, {
          method: 'PATCH',
          headers: {
            'X-CSRF-TOKEN': csrfToken(),
            'Accept': 'application/json',
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({ jumlah: jumlah }),
        })
          .then(function (res) {
            return res.json().then(function (data) { return { ok: res.ok, data: data }; });
          })
          .then(function (result) {
            if (!result.ok) {
              toast(result.data.pesan, 'error');
              return;
            }
            var subtotalEl = row.querySelector('[data-row-subtotal]');
            if (subtotalEl) subtotalEl.textContent = result.data.subtotal_format;
            document.querySelectorAll('[data-cart-total]').forEach(function (el) {
              el.textContent = result.data.total_format;
            });
          })
          .catch(function () {
            toast('Gagal memperbarui jumlah barang.', 'error');
          })
          .finally(function () {
            row.classList.remove('is-updating');
          });
      }

      if (stepperInput) {
        stepperInput.addEventListener('change', function () {
          clearTimeout(debounceTimer);
          debounceTimer = setTimeout(function () { kirimUpdate(stepperInput.value); }, 350);
        });
      }

      if (updateForm) {
        updateForm.addEventListener('submit', function (e) {
          e.preventDefault();
          clearTimeout(debounceTimer);
          kirimUpdate(stepperInput ? stepperInput.value : 1);
        });
      }

      if (deleteForm) {
        deleteForm.addEventListener('submit', function (e) {
          e.preventDefault();
          var removeBtn = deleteForm.querySelector('[data-cart-remove]');
          if (removeBtn) removeBtn.disabled = true;

          fetch(deleteForm.action, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': csrfToken(), 'Accept': 'application/json' },
          })
            .then(function (res) { return res.json(); })
            .then(function (data) {
              row.style.transition = 'opacity .2s ease';
              row.style.opacity = '0';
              setTimeout(function () {
                row.remove();
                document.querySelectorAll('[data-cart-total]').forEach(function (el) {
                  el.textContent = data.total_format;
                });
                if (data.keranjang_kosong) {
                  window.location.reload();
                }
              }, 200);
            })
            .catch(function () {
              toast('Gagal menghapus barang dari keranjang.', 'error');
              if (removeBtn) removeBtn.disabled = false;
            });
        });
      }
    });
  }
})();
