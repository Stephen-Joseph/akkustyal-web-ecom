// 1. Render 12-Month Profit Bars (June 2025 active in Coral Orange)
const monthsData = [
  { month: 'Jan', height: 22, sales: '32,140', revenue: '$312,40,00' },
  { month: 'Feb', height: 84, sales: '84,920', revenue: '$842,10,00' },
  { month: 'Mar', height: 67, sales: '67,400', revenue: '$690,55,00' },
  { month: 'Apr', height: 50, sales: '51,230', revenue: '$518,90,00' },
  { month: 'May', height: 88, sales: '89,110', revenue: '$910,20,00' },
  { month: 'Jun', height: 43, sales: '98,365', revenue: '$987,98,45' },
  { month: 'Jul', height: 76, sales: '76,540', revenue: '$780,12,00' },
  { month: 'Aug', height: 94, sales: '94,800', revenue: '$954,60,00' },
  { month: 'Sep', height: 60, sales: '60,150', revenue: '$615,80,00' },
  { month: 'Oct', height: 81, sales: '81,490', revenue: '$825,40,00' },
  { month: 'Nov', height: 65, sales: '65,300', revenue: '$660,15,00' },
  { month: 'Dec', height: 75, sales: '75,900', revenue: '$772,00,00' }
];

const barsRow = document.getElementById('barsRow');

function renderBars(activeIdx) {
  barsRow.innerHTML = '';
  monthsData.forEach((item, index) => {
    const isActive = index === activeIdx;
    const col = document.createElement('div');
    col.className = 'bar-col' + (isActive ? ' active' : '');
    col.innerHTML = `
      <div class="bar-tooltip" style="bottom: calc(${item.height}% + 30px);">
        <p class="tooltip-date">${item.month} 2025</p>
        <div class="tooltip-row">
          <span class="tooltip-dot" style="background: var(--bar-inactive-cap);"></span>
          <span>${item.sales}</span>
        </div>
        <div class="tooltip-row strong">
          <span class="tooltip-dot" style="background: var(--primary);"></span>
          <span>${item.revenue}</span>
        </div>
      </div>
      <div class="bar-stack" style="height: ${item.height}%;">
        <div class="bar-cap"></div>
        <div class="bar-body"></div>
      </div>
      <span class="bar-month">${item.month}</span>
    `;
    col.addEventListener('click', () => renderBars(index));
    barsRow.appendChild(col);
  });
}

renderBars(5);

// 2. Export Button Feedback
const exportBtn = document.getElementById('exportBtn');
exportBtn.addEventListener('click', () => {
  const label = exportBtn.querySelector('span');
  const original = label.textContent;
  label.textContent = 'Exporting...';
  setTimeout(() => {
    label.textContent = 'Report Downloaded';
    setTimeout(() => {
      label.textContent = original;
    }, 1200);
  }, 500);
});
