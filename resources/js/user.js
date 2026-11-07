(function () {
  'use strict';

  var STORAGE_KEY = 'ascend_membership_choice'; // 'declined' | 'requested'

  var overlay = document.querySelector('[data-membership-modal]');
  if (!overlay) return;

  var askStep = overlay.querySelector('[data-modal-step="ask"]');
  var yesStep = overlay.querySelector('[data-modal-step="yes"]');

  function openModal() { overlay.classList.add('is-open'); }
  function closeModal() { overlay.classList.remove('is-open'); }

  function getChoice() {
    try { return localStorage.getItem(STORAGE_KEY); } catch (e) { return null; }
  }
  function setChoice(value) {
    try { localStorage.setItem(STORAGE_KEY, value); } catch (e) {}
  }

  // Only prompt if the server says there's no linked member AND the user hasn't answered before.
  if (overlay.getAttribute('data-show-if-unanswered') === '1' && !getChoice()) {
    openModal();
  }

  var noBtn = overlay.querySelector('[data-modal-answer="no"]');
  var yesBtn = overlay.querySelector('[data-modal-answer="yes"]');
  var doneBtn = overlay.querySelector('[data-modal-done]');

  if (noBtn) {
    noBtn.addEventListener('click', function () {
      setChoice('declined');
      closeModal();
    });
  }

  if (yesBtn) {
    yesBtn.addEventListener('click', function () {
      if (askStep) askStep.style.display = 'none';
      if (yesStep) yesStep.style.display = 'block';
    });
  }

  if (doneBtn) {
    doneBtn.addEventListener('click', function () {
      setChoice('requested');
      closeModal();
    });
  }
})();