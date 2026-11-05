// Light / Dark theme switch, remembered across admin pages.
const THEME_KEY = 'admin-theme';
const lightBtn = document.getElementById('lightBtn');
const darkBtn = document.getElementById('darkBtn');

function applyTheme(theme) {
  const isDark = theme === 'dark';
  document.documentElement.classList.toggle('dark', isDark);
  lightBtn?.classList.toggle('active', !isDark);
  darkBtn?.classList.toggle('active', isDark);
}

function setTheme(theme) {
  try {
    localStorage.setItem(THEME_KEY, theme);
  } catch {
    // Storage unavailable (e.g. private mode): theme applies to this page only.
  }
  applyTheme(theme);
}

function storedTheme() {
  try {
    return localStorage.getItem(THEME_KEY) ?? 'light';
  } catch {
    return 'light';
  }
}

applyTheme(storedTheme());
lightBtn?.addEventListener('click', () => setTheme('light'));
darkBtn?.addEventListener('click', () => setTheme('dark'));
