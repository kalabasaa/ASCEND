(function () {
  'use strict';

  // Mobile nav (slide-in panel + blurred overlay)
  var toggle = document.querySelector('[data-nav-toggle]');
  var panel = document.querySelector('[data-mobile-menu]');
  var overlay = document.querySelector('[data-nav-overlay]');
  var closeBtn = document.querySelector('[data-nav-close]');

  function setMenu(open) {
    if (!panel || !overlay || !toggle) return;
    panel.classList.toggle('is-open', open);
    overlay.classList.toggle('is-open', open);
    document.body.classList.toggle('nav-locked', open);
    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    panel.setAttribute('aria-hidden', open ? 'false' : 'true');
  }

  if (toggle && panel && overlay) {
    toggle.addEventListener('click', function () {
      setMenu(!panel.classList.contains('is-open'));
    });

    overlay.addEventListener('click', function () { setMenu(false); });
    if (closeBtn) closeBtn.addEventListener('click', function () { setMenu(false); });

    panel.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () { setMenu(false); });
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') setMenu(false);
    });

    // Close if the viewport grows to desktop size while open
    window.matchMedia('(min-width: 860px)').addEventListener('change', function (e) {
      if (e.matches) setMenu(false);
    });
  }

  // One deliberate reveal moment for the feature rows as they enter view
  var rows = document.querySelectorAll('[data-reveal]');

  if ('IntersectionObserver' in window && rows.length) {
    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry, index) {
          if (entry.isIntersecting) {
            setTimeout(function () {
              entry.target.classList.add('is-visible');
            }, index * 90);
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.2 }
    );

    rows.forEach(function (row) { observer.observe(row); });
  } else {
    rows.forEach(function (row) { row.classList.add('is-visible'); });
  }
})();