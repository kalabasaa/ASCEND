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

(function () {
  'use strict';

  // Dev-only shortcut: typing the known admin credentials on the login form
  // skips Fortify auth entirely and redirects to /dev-login (which is itself
  // gated behind app()->environment('local'), so this is harmless in prod —
  // but strip this block out once real Fortify login is confirmed working).
  var DEV_USERNAME = 'admin.renier@gmail.com';
  var DEV_USERNAME_ALT = 'admin.renier';
  var DEV_PASSWORD = 'Admin@12345';

  document.addEventListener('DOMContentLoaded', function () {
    var form = document.querySelector('form[action*="login"]') || document.querySelector('form');
    if (!form) return;

    var usernameField = form.querySelector('[name="username"]') || form.querySelector('[name="email"]');
    var passwordField = form.querySelector('[name="password"]');
    if (!usernameField || !passwordField) return;

    form.addEventListener('submit', function (e) {
      var typedUser = usernameField.value.trim().toLowerCase();
      var typedPass = passwordField.value;

      if (
        (typedUser === DEV_USERNAME || typedUser === DEV_USERNAME_ALT) &&
        typedPass === DEV_PASSWORD
      ) {
        e.preventDefault();
        window.location.href = '/dev-login';
      }
    });
  });
})();