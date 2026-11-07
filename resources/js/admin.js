(function () {
  'use strict';

  const shell = document.querySelector('[data-admin-shell]');
  if (!shell) return;

  const storageKey = 'ascend_admin_activity';
  const desktop = window.matchMedia('(min-width: 1280px)');

  const readPref = () => {
    try { return localStorage.getItem(storageKey); } catch (e) { return null; }
  };
  const writePref = (value) => {
    try { localStorage.setItem(storageKey, value); } catch (e) {}
  };

  const sidebarToggle = document.querySelector('[data-sidebar-toggle]');
  const sidebarClose = document.querySelector('[data-sidebar-close]');
  const sidebarOverlay = document.querySelector('[data-overlay="sidebar"]');

  const setSidebar = (open) => {
    shell.classList.toggle('is-sidebar-open', open);
    if (sidebarToggle) sidebarToggle.setAttribute('aria-expanded', String(open));
    if (!open && sidebarToggle && document.activeElement === sidebarClose) sidebarToggle.focus();
  };

  if (sidebarToggle) sidebarToggle.addEventListener('click', () => setSidebar(!shell.classList.contains('is-sidebar-open')));
  if (sidebarClose) sidebarClose.addEventListener('click', () => setSidebar(false));
  if (sidebarOverlay) sidebarOverlay.addEventListener('click', () => setSidebar(false));

  document.querySelectorAll('[data-dismiss]').forEach((button) => {
    button.addEventListener('click', () => button.parentElement.remove());
  });

  document.querySelectorAll('form[data-loading-form]').forEach((form) => {
    form.addEventListener('submit', () => {
      const button = form.querySelector('button[type="submit"]');
      if (!button || button.disabled) return;
      button.dataset.label = button.textContent;
      button.textContent = button.dataset.loadingLabel || 'Saving…';
      button.disabled = true;
    });
  });

  document.querySelectorAll('form[data-confirm]').forEach((form) => {
    form.addEventListener('submit', (event) => {
      if (!window.confirm(form.dataset.confirm)) event.preventDefault();
    });
  });

  window.addEventListener('pageshow', () => {
    document.querySelectorAll('button[data-label]').forEach((button) => {
      button.textContent = button.dataset.label;
      button.disabled = false;
    });
  });

  const rows = Array.from(document.querySelectorAll('[data-record]'));
  const search = document.querySelector('[data-table-search]');
  const filter = document.querySelector('[data-table-filter]');
  const noResults = document.querySelector('[data-no-results]');

  const applyFilters = () => {
    const query = search ? search.value.trim().toLowerCase() : '';
    const status = filter ? filter.value : '';
    let visible = 0;

    rows.forEach((row) => {
      const match = (!query || row.textContent.toLowerCase().includes(query))
        && (!status || row.dataset.filterValue === status);
      row.hidden = !match;
      if (match) visible += 1;
    });

    if (noResults) noResults.hidden = visible !== 0;
  };

  if (search) search.addEventListener('input', applyFilters);
  if (filter) filter.addEventListener('change', applyFilters);

  const panel = document.querySelector('[data-activity-panel]');

  if (!panel) {
    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') setSidebar(false);
    });
    return;
  }

  const activityToggle = document.querySelector('[data-activity-toggle]');
  const activityOverlay = document.querySelector('[data-overlay="activity"]');
  const tabs = Array.from(panel.querySelectorAll('[data-activity-tab]'));
  const views = Array.from(panel.querySelectorAll('[data-activity-view]'));
  const titleKey = panel.dataset.titleKey;
  const updateUrl = panel.dataset.updateUrl;
  const destroyUrl = panel.dataset.destroyUrl;
  const editForm = panel.querySelector('[data-edit-form]');
  const deleteForm = panel.querySelector('[data-delete-form]');
  const createForm = panel.querySelector('[data-create-form]');

  const isOpen = () => (desktop.matches
    ? !shell.classList.contains('is-activity-collapsed')
    : shell.classList.contains('is-activity-open'));

  const setOpen = (open, moveFocus) => {
    if (desktop.matches) {
      shell.classList.toggle('is-activity-collapsed', !open);
      writePref(open ? 'open' : 'closed');
    } else {
      shell.classList.toggle('is-activity-open', open);
    }

    if (activityToggle) activityToggle.setAttribute('aria-expanded', String(open));
    if (!moveFocus) return;
    if (open && !desktop.matches) panel.focus();
    if (!open && activityToggle) activityToggle.focus();
  };

  const setTab = (name) => {
    tabs.forEach((tab) => {
      const active = tab.dataset.activityTab === name;
      tab.classList.toggle('is-active', active);
      tab.setAttribute('aria-selected', String(active));
    });
    views.forEach((view) => {
      view.hidden = view.dataset.activityView !== name;
    });
  };

  const openActivity = (name) => {
    const tab = tabs.find((item) => item.dataset.activityTab === name && !item.disabled);
    setTab(tab ? name : 'details');
    setOpen(true, true);
  };

  const display = (value) => (value === null || value === undefined || value === '' ? '—' : value);

  const selectRecord = (row) => {
    const record = JSON.parse(row.dataset.record);

    rows.forEach((item) => item.classList.toggle('is-selected', item === row));

    panel.querySelectorAll('[data-empty]').forEach((el) => { el.hidden = true; });
    panel.querySelectorAll('[data-record-content]').forEach((el) => { el.hidden = false; });
    panel.querySelectorAll('[data-record-title]').forEach((el) => { el.textContent = display(record[titleKey]); });
    panel.querySelectorAll('[data-field]').forEach((el) => { el.textContent = display(record[el.dataset.field]); });

    if (editForm) {
      editForm.querySelectorAll('[name]').forEach((field) => {
        if (field.name.charAt(0) === '_') return;
        if (Object.prototype.hasOwnProperty.call(record, field.name)) {
          field.value = record[field.name] === null ? '' : record[field.name];
        }
      });
      editForm.querySelector('[name="_record_id"]').value = record.id;
      if (updateUrl) editForm.action = updateUrl.replace('__ID__', encodeURIComponent(record.id));
    }

    if (deleteForm && destroyUrl) {
      deleteForm.action = destroyUrl.replace('__ID__', encodeURIComponent(record.id));
    }

    return record;
  };

  rows.forEach((row) => {
    const open = () => {
      selectRecord(row);
      openActivity('details');
    };
    row.addEventListener('click', open);
    row.addEventListener('keydown', (event) => {
      if (event.key === 'Enter' || event.key === ' ') {
        event.preventDefault();
        open();
      }
    });
  });

  tabs.forEach((tab) => {
    tab.addEventListener('click', () => { if (!tab.disabled) setTab(tab.dataset.activityTab); });
  });

  document.querySelectorAll('[data-activity-open]').forEach((button) => {
    button.addEventListener('click', () => openActivity(button.dataset.activityOpen));
  });

  panel.querySelector('[data-activity-close]').addEventListener('click', () => setOpen(false, true));
  if (activityToggle) activityToggle.addEventListener('click', () => setOpen(!isOpen(), true));
  if (activityOverlay) activityOverlay.addEventListener('click', () => setOpen(false, true));

  document.addEventListener('keydown', (event) => {
    if (event.key !== 'Escape') return;
    setSidebar(false);
    if (!desktop.matches && isOpen()) setOpen(false, true);
  });

  desktop.addEventListener('change', () => {
    shell.classList.remove('is-activity-open');
    shell.classList.toggle('is-activity-collapsed', desktop.matches && readPref() === 'closed');
    if (activityToggle) activityToggle.setAttribute('aria-expanded', String(isOpen()));
  });

  let oldInput = {};
  try { oldInput = JSON.parse(panel.dataset.old || '{}'); } catch (e) {}

  if (createForm && oldInput._activity === 'create') {
    createForm.querySelectorAll('[name]').forEach((field) => {
      if (field.name.charAt(0) !== '_' && Object.prototype.hasOwnProperty.call(oldInput, field.name)) {
        field.value = oldInput[field.name];
      }
    });
  }

  if (desktop.matches && readPref() === 'closed') shell.classList.add('is-activity-collapsed');
  if (activityToggle) activityToggle.setAttribute('aria-expanded', String(isOpen()));

  const initialRecordId = panel.dataset.initialRecord;
  if (initialRecordId) {
    const initialRow = rows.find((row) => row.dataset.recordId === initialRecordId);
    if (initialRow) selectRecord(initialRow);
  }

  const initialTab = panel.dataset.initialTab || 'details';
  setTab(initialTab);
  if (initialTab !== 'details') setOpen(true, false);
})();