// Shared behaviour for admin forms, alerts and confirmations.

// ---------- Character counters: <span class="form-counter" data-counter-for="fieldId"> ----------
document.querySelectorAll('[data-counter-for]').forEach((counter) => {
  const field = document.getElementById(counter.dataset.counterFor);
  const max = Number(field?.getAttribute('maxlength'));

  if (!field || !max) {
    return;
  }

  const update = () => {
    const length = field.value.length;
    counter.textContent = `${length} / ${max}`;
    counter.classList.toggle('is-near', length >= max * 0.9 && length < max);
    counter.classList.toggle('is-over', length >= max);
  };

  field.addEventListener('input', update);
  update();
});

// ---------- Themed confirm dialog for <form data-confirm="..."> ----------
let dialog;

function buildDialog() {
  dialog = document.createElement('dialog');
  dialog.className = 'confirm-dialog';
  dialog.setAttribute('aria-labelledby', 'confirmDialogTitle');
  dialog.setAttribute('aria-describedby', 'confirmDialogText');
  dialog.innerHTML = `
    <form method="dialog">
      <div class="confirm-dialog-body">
        <div class="confirm-dialog-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
        </div>
        <h2 id="confirmDialogTitle" class="confirm-dialog-title"></h2>
        <p id="confirmDialogText" class="confirm-dialog-text"></p>
      </div>
      <div class="confirm-dialog-actions">
        <button type="submit" value="cancel" class="btn btn-secondary">Cancel</button>
        <button type="submit" value="confirm" class="btn btn-danger" data-confirm-accept></button>
      </div>
    </form>
  `;
  document.body.append(dialog);
}

function confirmAction({ title, message, confirmLabel }) {
  if (typeof HTMLDialogElement === 'undefined') {
    return Promise.resolve(window.confirm(message));
  }

  if (!dialog) {
    buildDialog();
  }

  dialog.querySelector('.confirm-dialog-title').textContent = title;
  dialog.querySelector('.confirm-dialog-text').textContent = message;
  dialog.querySelector('[data-confirm-accept]').textContent = confirmLabel;
  dialog.returnValue = '';
  dialog.showModal();
  dialog.querySelector('[value="cancel"]').focus();

  return new Promise((resolve) => {
    dialog.addEventListener('close', () => resolve(dialog.returnValue === 'confirm'), { once: true });
  });
}

document.addEventListener('submit', async (event) => {
  const form = event.target;

  if (!(form instanceof HTMLFormElement) || !form.dataset.confirm || form.dataset.confirmed === 'true') {
    return;
  }

  event.preventDefault();

  const confirmed = await confirmAction({
    title: form.dataset.confirmTitle ?? 'Are you sure?',
    message: form.dataset.confirm,
    confirmLabel: form.dataset.confirmButton ?? 'Confirm',
  });

  if (confirmed) {
    form.dataset.confirmed = 'true';
    form.requestSubmit(event.submitter ?? undefined);
  }
});

// ---------- Loading state for <form data-loading="Saving..."> ----------
document.addEventListener('submit', (event) => {
  const form = event.target;

  if (event.defaultPrevented || !(form instanceof HTMLFormElement) || !form.hasAttribute('data-loading')) {
    return;
  }

  const button = event.submitter ?? form.querySelector('[type="submit"]');

  if (!button) {
    return;
  }

  const label = button.querySelector('[data-loading-label]');
  button.dataset.originalLabel = label?.textContent ?? '';
  button.disabled = true;
  button.classList.add('is-loading');
  button.querySelector('svg')?.setAttribute('hidden', '');
  button.insertAdjacentHTML('afterbegin', '<span class="btn-spinner" aria-hidden="true"></span>');

  if (label) {
    label.textContent = form.dataset.loading || 'Saving...';
  }
});

// Restore buttons when the page is shown again from the back/forward cache.
window.addEventListener('pageshow', (event) => {
  if (!event.persisted) {
    return;
  }

  document.querySelectorAll('.btn.is-loading').forEach((button) => {
    button.disabled = false;
    button.classList.remove('is-loading');
    button.querySelector('.btn-spinner')?.remove();
    button.querySelector('svg[hidden]')?.removeAttribute('hidden');

    const label = button.querySelector('[data-loading-label]');
    if (label && button.dataset.originalLabel) {
      label.textContent = button.dataset.originalLabel;
    }
  });

  document.querySelectorAll('form[data-confirmed]').forEach((form) => delete form.dataset.confirmed);
});

// ---------- Dismissible alerts: <button data-dismiss="alert"> ----------
document.addEventListener('click', (event) => {
  const button = event.target.closest('[data-dismiss="alert"]');
  button?.closest('.alert')?.remove();
});

// ---------- Clear server-side error styling once the user edits the field ----------
document.addEventListener('input', (event) => {
  const field = event.target.closest('.form-input');

  if (!field) {
    return;
  }

  field.classList.remove('is-invalid');
  field.removeAttribute('aria-invalid');
  field.closest('.input-affix')?.classList.remove('is-invalid');
});

// ---------- Submit filter forms as soon as a [data-auto-submit] control changes ----------
document.addEventListener('change', (event) => {
  const control = event.target.closest('[data-auto-submit]');
  control?.form?.requestSubmit();
});
