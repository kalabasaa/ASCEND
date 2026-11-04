(function () {
  'use strict';

  // Password show/hide toggle, reusable across any number of password fields.
  // Usage: <button type="button" data-toggle-password="password"
  //                 data-show-label="Show password" data-hide-label="Hide password"
  //                 aria-label="Show password">...</button>
  document.querySelectorAll('[data-toggle-password]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var targetId = btn.getAttribute('data-toggle-password');
      var input = document.getElementById(targetId);
      if (!input) return;

      var willShow = input.type === 'password';
      input.type = willShow ? 'text' : 'password';

      var showLabel = btn.getAttribute('data-show-label') || 'Show password';
      var hideLabel = btn.getAttribute('data-hide-label') || 'Hide password';
      btn.setAttribute('aria-label', willShow ? hideLabel : showLabel);
    });
  });
})();