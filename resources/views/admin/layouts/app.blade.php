<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $APP_NAME ?? 'CodeLuxeStudio Admin' }}</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    /* ==================== COLOR PALETTE (ORIGINAL DESIGN) ==================== */
    :root {
      --bg-canvas: #EDEAE4;
      --bg-card: #F7F6F3;
      --bg-pill-bar: #E5E2DC;
      --bg-subtle: #ECEAE4;
      --bg-subtle-hover: #E0DDD6;

      /* Coral / Orange Brand Accents */
      --primary: #F47E52;
      --primary-soft: #E98864;
      --primary-hover: #E06D42;
      --primary-text: #FFFFFF;

      /* Typography Colors */
      --text-main: #141414;
      --text-secondary: #4E4E4E;
      --text-muted: #7C7A76;

      /* Borders & Shadows */
      --border-color: #E2DFD9;
      --shadow-card: 0 2px 10px rgba(20, 20, 20, 0.03), 0 1px 2px rgba(20, 20, 20, 0.02);
      --shadow-float: 0 12px 26px rgba(20, 20, 20, 0.12), 0 4px 10px rgba(20, 20, 20, 0.06);

      /* Chart & Status Accents */
      --bar-inactive-body: #DCDAD5;
      --bar-inactive-cap: #D0CECA;
      --badge-purple-bg: #EFEBF9;
      --badge-purple-text: #9474DF;
      --badge-green-bg: #DDF0E4;
      --badge-green-text: #3B9B64;
      --shopify-bg: #E6EFE3;
      --shopify-green: #5E943A;
      --map-blue: #3563F6;
      --map-land: #DAD7D1;
    }

    html.dark {
      --bg-canvas: #111113;
      --bg-card: #1A1A1D;
      --bg-pill-bar: #232327;
      --bg-subtle: #26262B;
      --bg-subtle-hover: #323238;

      --primary: #F47E52;
      --primary-soft: #E98864;
      --primary-hover: #F7906A;
      --primary-text: #FFFFFF;

      --text-main: #F5F5F7;
      --text-secondary: #B8B8BF;
      --text-muted: #85858E;

      --border-color: #2A2A30;
      --shadow-card: 0 4px 16px rgba(0, 0, 0, 0.35);
      --shadow-float: 0 14px 30px rgba(0, 0, 0, 0.6);

      --bar-inactive-body: #2C2C32;
      --bar-inactive-cap: #3A3A42;
      --badge-purple-bg: rgba(148, 116, 223, 0.18);
      --badge-purple-text: #B59BF0;
      --badge-green-bg: rgba(59, 155, 100, 0.18);
      --badge-green-text: #5CD18E;
      --shopify-bg: rgba(94, 148, 58, 0.2);
      --shopify-green: #79B851;
      --map-blue: #4672FF;
      --map-land: #2E2E35;
    }

    /* ==================== RESET & BASE ==================== */
    *, *::before, *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background-color: var(--bg-canvas);
      color: var(--text-main);
      min-height: 100vh;
      margin: 0;
      padding: 0;
      -webkit-font-smoothing: antialiased;
      transition: background-color 0.25s ease, color 0.25s ease;
    }

    button, select {
      font: inherit;
      color: inherit;
      background: none;
      border: none;
      cursor: pointer;
    }

    img {
      display: block;
      max-width: 100%;
    }

    ul {
      list-style: none;
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    /* ==================== FULL-BLEED ADMIN CONTAINER ==================== */
    .dashboard-container {
      width: 100%;
      max-width: 1600px;
      margin: 0 auto;
      padding: 24px 32px 40px;
    }

    /* ==================== HEADER ==================== */
    .top-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      margin-bottom: 28px;
    }

    .brand-logo {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-size: 20px;
      font-weight: 800;
      letter-spacing: -0.02em;
      color: var(--text-main);
    }

    .brand-icon {
      width: 34px;
      height: 34px;
      border-radius: 50%;
      border: 2.2px solid var(--primary);
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      transition: transform 0.2s ease;
    }

    .brand-logo:hover .brand-icon {
      transform: scale(1.06);
    }

    .brand-icon-inner {
      width: 18px;
      height: 18px;
      border-radius: 50%;
      border: 2.2px solid var(--primary);
      border-right-color: transparent;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .brand-icon-dot {
      width: 5px;
      height: 5px;
      border-radius: 50%;
      background-color: var(--primary);
    }

    /* Center Nav Pills */
    .nav-pills {
      display: flex;
      align-items: center;
      gap: 6px;
      background-color: var(--bg-pill-bar);
      padding: 5px;
      border-radius: 999px;
    }

    .nav-pill {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      padding: 8px 16px;
      border-radius: 999px;
      font-size: 13px;
      font-weight: 500;
      color: var(--text-secondary);
      background-color: var(--bg-card);
      transition: all 0.2s ease;
    }

    .nav-pill:hover {
      color: var(--text-main);
      transform: translateY(-1px);
    }

    .nav-pill.active {
      background-color: var(--primary-soft);
      color: var(--primary-text);
      font-weight: 600;
      box-shadow: 0 3px 10px rgba(233, 136, 100, 0.35);
    }

    .nav-pill svg {
      width: 15px;
      height: 15px;
      stroke-width: 2;
    }

    /* Right Header Actions */
    .header-actions {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .theme-switch {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      background-color: var(--bg-card);
      padding: 4px;
      border-radius: 999px;
      border: 1px solid var(--border-color);
    }

    .theme-btn {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--text-secondary);
      transition: all 0.2s ease;
    }

    .theme-btn.active {
      background-color: var(--primary-soft);
      color: var(--primary-text);
      box-shadow: 0 2px 6px rgba(233, 136, 100, 0.35);
    }

    .theme-btn svg {
      width: 15px;
      height: 15px;
    }

    .icon-circle-btn {
      width: 38px;
      height: 38px;
      border-radius: 50%;
      background-color: var(--bg-card);
      border: 1px solid var(--border-color);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--text-main);
      position: relative;
      transition: background-color 0.2s ease, transform 0.2s ease;
    }

    .icon-circle-btn:hover {
      background-color: var(--bg-subtle-hover);
      transform: translateY(-1px);
    }

    .icon-circle-btn svg {
      width: 16px;
      height: 16px;
    }

    .avatar-btn {
      width: 38px;
      height: 38px;
      border-radius: 50%;
      overflow: hidden;
      border: 2px solid var(--bg-card);
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      flex-shrink: 0;
      transition: transform 0.2s ease;
    }

    .avatar-btn:hover {
      transform: scale(1.05);
    }

    .avatar-btn img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .mobile-menu-btn {
      display: none;
    }

    .mobile-nav {
      display: none;
      margin-bottom: 20px;
      background-color: var(--bg-card);
      border: 1px solid var(--border-color);
      border-radius: 18px;
      padding: 10px;
      gap: 8px;
      flex-wrap: wrap;
    }

    .mobile-nav.open {
      display: flex;
    }

    /* ==================== WELCOME ROW ==================== */
    .welcome-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      margin-bottom: 24px;
      flex-wrap: wrap;
    }

    .welcome-title {
      font-size: 22px;
      font-weight: 700;
      letter-spacing: -0.02em;
      display: flex;
      align-items: center;
      gap: 8px;
      color: var(--text-main);
    }

    .welcome-subtitle {
      font-size: 13px;
      color: var(--text-muted);
      margin-top: 5px;
    }

    .export-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background-color: var(--primary-soft);
      color: var(--primary-text);
      padding: 11px 20px;
      border-radius: 999px;
      font-size: 13px;
      font-weight: 600;
      box-shadow: 0 4px 12px rgba(233, 136, 100, 0.3);
      transition: background-color 0.2s ease, transform 0.15s ease;
    }

    .export-btn:hover {
      background-color: var(--primary-hover);
      transform: translateY(-1px);
    }

    .export-btn:active {
      transform: translateY(0);
    }

    .export-btn svg {
      width: 15px;
      height: 15px;
    }

    /* ==================== KPI CARDS (4 COLUMNS) ==================== */
    .kpi-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 18px;
      margin-bottom: 20px;
    }

    .kpi-card {
      background-color: var(--bg-card);
      border: 1px solid var(--border-color);
      border-radius: 22px;
      padding: 22px 24px;
      min-height: 152px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      box-shadow: var(--shadow-card);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .kpi-card:hover {
      transform: translateY(-2px);
    }

    .kpi-card.primary {
      background: linear-gradient(135deg, #F57D50 0%, #EE855D 100%);
      color: #FFFFFF;
      border-color: transparent;
      box-shadow: 0 8px 20px rgba(244, 126, 82, 0.25);
    }

    .kpi-top {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
    }

    .kpi-label-group {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .kpi-icon {
      width: 34px;
      height: 34px;
      border-radius: 50%;
      background-color: var(--bg-subtle);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--text-main);
      flex-shrink: 0;
    }

    .kpi-card.primary .kpi-icon {
      background-color: rgba(255, 255, 255, 0.2);
      color: #FFFFFF;
    }

    .kpi-icon svg {
      width: 16px;
      height: 16px;
    }

    .kpi-title {
      font-size: 14px;
      font-weight: 600;
    }

    .kpi-arrow-btn {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      background-color: var(--bg-subtle);
      color: var(--text-main);
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background-color 0.2s ease, transform 0.2s ease;
    }

    .kpi-arrow-btn:hover {
      background-color: var(--bg-subtle-hover);
      transform: scale(1.06);
    }

    .kpi-card.primary .kpi-arrow-btn {
      background-color: rgba(255, 255, 255, 0.18);
      color: #FFFFFF;
    }

    .kpi-arrow-btn svg {
      width: 14px;
      height: 14px;
    }

    .kpi-bottom {
      display: flex;
      align-items: baseline;
      justify-content: space-between;
      gap: 8px;
      padding-top: 24px;
    }

    .kpi-value {
      font-size: 30px;
      font-weight: 800;
      letter-spacing: -0.03em;
      line-height: 1;
    }

    .kpi-delta {
      font-size: 11px;
      font-weight: 500;
      color: var(--text-muted);
      white-space: nowrap;
    }

    .kpi-card.primary .kpi-delta {
      color: rgba(255, 255, 255, 0.88);
    }

    /* ==================== MIDDLE ROW (PROFIT + TOP PRODUCT) ==================== */
    .middle-grid {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 18px;
      margin-bottom: 20px;
    }

    .card-panel {
      background-color: var(--bg-card);
      border: 1px solid var(--border-color);
      border-radius: 24px;
      padding: 24px 26px;
      box-shadow: var(--shadow-card);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .card-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      margin-bottom: 16px;
    }

    .card-title {
      font-size: 17px;
      font-weight: 700;
      letter-spacing: -0.01em;
      color: var(--text-main);
    }

    .more-btn {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background-color: var(--bg-subtle);
      color: var(--text-secondary);
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background-color 0.2s ease;
    }

    .more-btn:hover {
      background-color: var(--bg-subtle-hover);
      color: var(--text-main);
    }

    .more-btn svg {
      width: 16px;
      height: 16px;
    }

    /* Profit Subheader */
    .profit-meta-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 16px;
      margin-bottom: 22px;
    }

    .profit-main-figure {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .big-number {
      font-size: 28px;
      font-weight: 800;
      letter-spacing: -0.03em;
      color: var(--text-main);
    }

    .badge-pill {
      display: inline-flex;
      align-items: center;
      gap: 3px;
      padding: 4px 10px;
      border-radius: 999px;
      font-size: 11px;
      font-weight: 600;
    }

    .badge-pill.purple {
      background-color: var(--badge-purple-bg);
      color: var(--badge-purple-text);
    }

    .badge-pill.green {
      background-color: var(--badge-green-bg);
      color: var(--badge-green-text);
    }

    .badge-pill svg {
      width: 11px;
      height: 11px;
    }

    .profit-channels {
      display: flex;
      align-items: center;
      flex-wrap: wrap;
      gap: 24px;
    }

    .chart-legend {
      display: flex;
      flex-direction: column;
      gap: 5px;
      font-size: 12px;
      color: var(--text-secondary);
    }

    .legend-item {
      display: flex;
      align-items: center;
      gap: 7px;
    }

    .legend-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
    }

    .legend-dot.sales {
      background-color: var(--bar-inactive-cap);
    }

    .legend-dot.revenue {
      background-color: var(--primary);
    }

    .channel-item {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .channel-icon {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background-color: var(--bg-subtle);
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 800;
      font-size: 15px;
      color: var(--text-main);
    }

    .channel-icon.shopify {
      background-color: var(--shopify-bg);
      color: var(--shopify-green);
    }

    .channel-icon svg {
      width: 17px;
      height: 17px;
    }

    .channel-label {
      font-size: 11px;
      color: var(--text-muted);
      line-height: 1.2;
    }

    .channel-val {
      font-size: 13px;
      font-weight: 700;
      color: var(--text-main);
      margin-top: 2px;
    }

    /* Bar Chart Layout */
    .bar-chart-wrap {
      display: flex;
      align-items: stretch;
      gap: 14px;
      height: 225px;
      padding-top: 8px;
      user-select: none;
    }

    .y-axis {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding-bottom: 26px;
      font-size: 11px;
      font-weight: 500;
      color: var(--text-muted);
      text-align: right;
      width: 30px;
      flex-shrink: 0;
    }

    .bars-stage {
      position: relative;
      flex: 1;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
    }

    .grid-lines {
      position: absolute;
      inset: 0 0 26px 0;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      pointer-events: none;
    }

    .grid-line {
      width: 100%;
      border-bottom: 1px dashed var(--border-color);
    }

    .grid-line:last-child {
      border-bottom-style: solid;
    }

    .bars-row {
      position: relative;
      z-index: 2;
      display: grid;
      grid-template-columns: repeat(12, 1fr);
      gap: 12px;
      align-items: end;
      height: 100%;
      padding-top: 14px;
    }

    .bar-col {
      position: relative;
      height: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-end;
      cursor: pointer;
    }

    .bar-stack {
      width: 100%;
      max-width: 36px;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      gap: 2px;
      transition: transform 0.2s ease;
    }

    .bar-col:hover .bar-stack {
      transform: translateY(-2px);
    }

    .bar-cap {
      width: 100%;
      height: 10px;
      border-radius: 6px 6px 2px 2px;
      background-color: var(--bar-inactive-cap);
      transition: background-color 0.2s ease;
    }

    .bar-body {
      width: 100%;
      flex: 1;
      border-radius: 2px 2px 6px 6px;
      background-color: var(--bar-inactive-body);
      transition: background-color 0.2s ease;
    }

    .bar-col.active .bar-cap,
    .bar-col:hover .bar-cap {
      background-color: #EC7347;
    }

    .bar-col.active .bar-body,
    .bar-col:hover .bar-body {
      background-color: var(--primary);
    }

    .bar-month {
      margin-top: 8px;
      font-size: 11px;
      font-weight: 500;
      color: var(--text-muted);
      height: 18px;
    }

    .bar-col.active .bar-month {
      font-weight: 700;
      color: var(--text-main);
    }

    /* Floating Bar Tooltip */
    .bar-tooltip {
      position: absolute;
      left: 50%;
      transform: translateX(-50%) translateY(4px);
      background-color: #FFFFFF;
      border: 1px solid var(--border-color);
      border-radius: 12px;
      padding: 9px 11px;
      box-shadow: var(--shadow-float);
      min-width: 110px;
      z-index: 20;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.2s ease, transform 0.2s ease;
      text-align: left;
    }

    html.dark .bar-tooltip {
      background-color: #232329;
    }

    .bar-col.active .bar-tooltip,
    .bar-col:hover .bar-tooltip {
      opacity: 1;
      transform: translateX(-50%) translateY(0);
    }

    .tooltip-date {
      font-size: 11px;
      font-weight: 600;
      color: var(--text-muted);
      margin-bottom: 4px;
    }

    .tooltip-row {
      display: flex;
      align-items: center;
      gap: 6px;
      font-size: 10px;
      color: var(--text-muted);
      line-height: 1.45;
    }

    .tooltip-row.strong {
      font-weight: 700;
      color: var(--text-main);
    }

    .tooltip-dot {
      width: 6px;
      height: 6px;
      border-radius: 50%;
      flex-shrink: 0;
    }

    /* Top Products List (Full Color) */
    .product-list {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      gap: 12px;
      flex: 1;
    }

    .product-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      padding: 4px 6px;
      margin: 0 -6px;
      border-radius: 12px;
      transition: background-color 0.15s ease;
      cursor: pointer;
    }

    .product-item:hover {
      background-color: var(--bg-subtle);
    }

    .product-left {
      display: flex;
      align-items: center;
      gap: 12px;
      min-width: 0;
    }

    .product-thumb {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      object-fit: cover;
      border: 1px solid var(--border-color);
      flex-shrink: 0;
      background-color: #FFFFFF;
    }

    .product-name {
      font-size: 13px;
      font-weight: 600;
      color: var(--text-main);
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .product-cat {
      font-size: 11px;
      color: var(--text-muted);
      margin-top: 1px;
    }

    .product-price {
      font-size: 13px;
      font-weight: 700;
      color: var(--text-main);
      flex-shrink: 0;
    }

    /* ==================== BOTTOM ROW (ORDERS + COUNTRIES) ==================== */
    .bottom-grid {
      display: grid;
      grid-template-columns: 1fr 2fr;
      gap: 18px;
    }

    .orders-card {
      padding-bottom: 0;
      overflow: hidden;
    }

    .card-subtitle {
      font-size: 11px;
      color: var(--text-muted);
      margin-top: 3px;
    }

    .orders-metric-wrap {
      margin-top: 6px;
    }

    .orders-delta-row {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-top: 8px;
    }

    .orders-extra {
      font-size: 12px;
      font-weight: 600;
      color: var(--text-secondary);
    }

    .area-chart-box {
      position: relative;
      margin: 22px -26px 0;
      padding-top: 22px;
    }

    .floating-order-pill {
      position: absolute;
      top: 2px;
      right: 23%;
      background-color: #FFFFFF;
      border: 1px solid var(--border-color);
      box-shadow: var(--shadow-float);
      padding: 4px 10px;
      border-radius: 8px;
      font-size: 11px;
      font-weight: 700;
      color: var(--text-main);
      z-index: 5;
    }

    html.dark .floating-order-pill {
      background-color: #232329;
    }

    .area-svg {
      width: 100%;
      height: 128px;
      display: block;
    }

    /* Sales by Countries */
    .countries-filters {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .select-wrap {
      position: relative;
      display: inline-flex;
      align-items: center;
    }

    .filter-select {
      appearance: none;
      -webkit-appearance: none;
      background-color: transparent;
      border: 1px solid transparent;
      border-radius: 999px;
      padding: 6px 26px 6px 12px;
      font-size: 12px;
      font-weight: 600;
      color: var(--text-main);
      transition: background-color 0.2s ease, border-color 0.2s ease;
    }

    .filter-select:hover {
      background-color: var(--bg-subtle);
      border-color: var(--border-color);
    }

    .select-chevron {
      position: absolute;
      right: 9px;
      pointer-events: none;
      width: 13px;
      height: 13px;
      color: var(--text-muted);
    }

    .countries-body {
      display: grid;
      grid-template-columns: 220px 1fr;
      gap: 24px;
      align-items: center;
      margin-top: 8px;
    }

    .country-stat-block + .country-stat-block {
      margin-top: 20px;
      padding-top: 16px;
      border-top: 1px solid var(--border-color);
    }

    .stat-caption {
      font-size: 12px;
      color: var(--text-muted);
    }

    .stat-amount {
      font-size: 24px;
      font-weight: 800;
      letter-spacing: -0.02em;
      color: var(--text-main);
      margin-top: 4px;
    }

    .stat-loc {
      font-size: 11px;
      color: var(--text-muted);
      margin-top: 2px;
    }

    /* World Map Container */
    .world-map-stage {
      position: relative;
      min-height: 195px;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      border-radius: 16px;
    }

    .world-map-svg {
      width: 100%;
      max-height: 195px;
      height: auto;
    }

    .map-continent-blue {
      fill: var(--map-blue);
    }

    .map-continent-grey {
      fill: var(--map-land);
    }

    .map-pin-card {
      position: absolute;
      background-color: #161618;
      color: #FFFFFF;
      padding: 7px 12px;
      border-radius: 12px;
      box-shadow: var(--shadow-float);
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 11px;
      line-height: 1.25;
      transition: transform 0.2s ease;
      cursor: pointer;
    }

    .map-pin-card:hover {
      transform: scale(1.06);
    }

    .map-pin-flag {
      width: 22px;
      height: 22px;
      border-radius: 50%;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .map-pin-flag svg {
      width: 100%;
      height: 100%;
      display: block;
    }

    .pin-country {
      font-weight: 500;
      color: rgba(255, 255, 255, 0.85);
    }

    .pin-value {
      font-weight: 700;
      color: #FFFFFF;
    }

    .pin-top-mid {
      top: 16%;
      left: 33%;
    }

    .pin-bottom-left {
      bottom: 12%;
      left: 14%;
    }

    .pin-right {
      bottom: 22%;
      right: 11%;
    }

    /* ==================== RESPONSIVE BREAKPOINTS ==================== */
    @media (max-width: 1180px) {
      .kpi-grid {
        grid-template-columns: repeat(2, 1fr);
      }
      .middle-grid,
      .bottom-grid {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 920px) {
      .dashboard-container {
        padding: 20px;
      }
      .nav-pills {
        display: none;
      }
      .mobile-menu-btn {
        display: flex;
      }
      .countries-body {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 600px) {
      .dashboard-container {
        padding: 16px;
      }
      .kpi-grid {
        grid-template-columns: 1fr;
      }
      .bars-row {
        gap: 5px;
      }
      .pin-top-mid {
        left: 22%;
      }
      .pin-bottom-left {
        left: 4%;
      }
      .pin-right {
        right: 4%;
      }
    }
  </style>
</head>