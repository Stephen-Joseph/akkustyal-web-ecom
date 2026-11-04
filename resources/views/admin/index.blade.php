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
    }

    .nav-pill.active {
      background-color: var(--primary-soft);
      color: var(--primary-text);
      font-weight: 600;
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
    }

    .kpi-card.primary {
      background: linear-gradient(135deg, #F57D50 0%, #EE855D 100%);
      color: #FFFFFF;
      border-color: transparent;
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
<body>
  <div class="dashboard-container">
    <!-- header -->
    @include('admin.layouts.header')
    
    <!-- Mobile Navigation Drawer -->
    <nav id="mobileNav" class="mobile-nav" aria-label="Mobile Navigation">
      <button type="button" class="nav-pill">Dashboard</button>
      <button type="button" class="nav-pill">Sales</button>
      <button type="button" class="nav-pill">Customer</button>
      <button type="button" class="nav-pill active">Report</button>
      <button type="button" class="nav-pill">Order</button>
    </nav>

    <!-- ==================== MAIN ==================== -->
    <main>

      <!-- Welcome Banner -->
      <section class="welcome-row" aria-label="Welcome Banner">
        <div>
          <h1 class="welcome-title">
            <span aria-hidden="true">👋</span>
            <span>Welcome, {{ auth('admin')->user()->name }}</span>
          </h1>
          <p class="welcome-subtitle">Overview of customer insights, sales performance, and revenue analytics.</p>
        </div>

        <button type="button" id="exportBtn" class="export-btn">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
          <span>Export Report</span>
        </button>
      </section>

      <!-- ==================== 4 KPI CARDS ==================== -->
      <section class="kpi-grid" aria-label="Key Performance Metrics">
        
        <!-- Card 1: Total Sales (Highlighted Coral Orange) -->
        <article class="kpi-card primary">
          <div class="kpi-top">
            <div class="kpi-label-group">
              <span class="kpi-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
              </span>
              <h2 class="kpi-title">Total Sales</h2>
            </div>
            <button type="button" class="kpi-arrow-btn" aria-label="View Total Sales">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
            </button>
          </div>
          <div class="kpi-bottom">
            <p class="kpi-value">12,847</p>
            <span class="kpi-delta">+8.2% VS Last Week</span>
          </div>
        </article>

        <!-- Card 2: Active Customer -->
        <article class="kpi-card">
          <div class="kpi-top">
            <div class="kpi-label-group">
              <span class="kpi-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
              </span>
              <h2 class="kpi-title">Active Customer</h2>
            </div>
            <button type="button" class="kpi-arrow-btn" aria-label="View Active Customer">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
            </button>
          </div>
          <div class="kpi-bottom">
            <p class="kpi-value">5,689</p>
            <span class="kpi-delta">+2.2% New Customer</span>
          </div>
        </article>

        <!-- Card 3: Total Revenue -->
        <article class="kpi-card">
          <div class="kpi-top">
            <div class="kpi-label-group">
              <span class="kpi-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 15h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 17"/><path d="m7 21 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9"/><path d="m2 16 6 6"/><circle cx="16" cy="9" r="2.9"/><circle cx="6" cy="5" r="3"/></svg>
              </span>
              <h2 class="kpi-title">Total Revenue</h2>
            </div>
            <button type="button" class="kpi-arrow-btn" aria-label="View Total Revenue">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
            </button>
          </div>
          <div class="kpi-bottom">
            <p class="kpi-value">$87,632</p>
            <span class="kpi-delta">+8.2% VS Last Week</span>
          </div>
        </article>

        <!-- Card 4: Refund Requests -->
        <article class="kpi-card">
          <div class="kpi-top">
            <div class="kpi-label-group">
              <span class="kpi-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
              </span>
              <h2 class="kpi-title">Refund Requests</h2>
            </div>
            <button type="button" class="kpi-arrow-btn" aria-label="View Refund Requests">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
            </button>
          </div>
          <div class="kpi-bottom">
            <p class="kpi-value">274</p>
            <span class="kpi-delta">+1.0% VS Last Week</span>
          </div>
        </article>

      </section>

      <!-- ==================== MIDDLE ROW ==================== -->
      <section class="middle-grid" aria-label="Profit Overview and Top Products">
        
        <!-- Total Profit Overview -->
        <article class="card-panel">
          <div>
            <div class="card-header">
              <h2 class="card-title">Total Profit Overview</h2>
              <button type="button" class="more-btn" aria-label="More options">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
              </button>
            </div>

            <div class="profit-meta-row">
              <div class="profit-main-figure">
                <span class="big-number">55,8754</span>
                <span class="badge-pill purple">
                  +8.2%
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
                </span>
              </div>

              <div class="profit-channels">
                <div class="chart-legend">
                  <div class="legend-item">
                    <span class="legend-dot sales"></span>
                    <span>Total Sales</span>
                  </div>
                  <div class="legend-item">
                    <span class="legend-dot revenue"></span>
                    <span>Total Revenue</span>
                  </div>
                </div>

                <div class="channel-item">
                  <div class="channel-icon shopify">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M15.5 6.5C15.3 4.5 13.9 3 12 3s-3.3 1.5-3.5 3.5H5v13a2 2 0 002 2h10a2 2 0 002-2v-13h-3.5zm-3.5-2c1.1 0 1.9.8 2 2h-4c.1-1.2.9-2 2-2z"/></svg>
                  </div>
                  <div>
                    <p class="channel-label">Shopify</p>
                    <p class="channel-val">308 payment</p>
                  </div>
                </div>

                <div class="channel-item">
                  <div class="channel-icon">a</div>
                  <div>
                    <p class="channel-label">Amazon</p>
                    <p class="channel-val">308 payment</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Bar Chart -->
          <div class="bar-chart-wrap">
            <div class="y-axis">
              <span>100k</span>
              <span>80k</span>
              <span>60k</span>
              <span>40k</span>
              <span>20k</span>
              <span>0k</span>
            </div>

            <div class="bars-stage">
              <div class="grid-lines">
                <div class="grid-line"></div>
                <div class="grid-line"></div>
                <div class="grid-line"></div>
                <div class="grid-line"></div>
                <div class="grid-line"></div>
                <div class="grid-line"></div>
              </div>

              <div id="barsRow" class="bars-row"></div>
            </div>
          </div>
        </article>

        <!-- Top Product -->
        <article class="card-panel">
          <div class="card-header">
            <h2 class="card-title">Top Product</h2>
            <button type="button" class="more-btn" aria-label="More options">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
            </button>
          </div>

          <ul class="product-list">
            <li class="product-item">
              <div class="product-left">
                <img class="product-thumb" src="https://images.unsplash.com/photo-1627123424574-724758594e93?auto=format&fit=crop&w=120&q=80" alt="Wellet" />
                <div>
                  <p class="product-name">Wellet</p>
                  <p class="product-cat">Wellet</p>
                </div>
              </div>
              <span class="product-price">$310</span>
            </li>

            <li class="product-item">
              <div class="product-left">
                <img class="product-thumb" src="https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=120&q=80" alt="Sungless" />
                <div>
                  <p class="product-name">Sungless</p>
                  <p class="product-cat">Sungless</p>
                </div>
              </div>
              <span class="product-price">$210</span>
            </li>

            <li class="product-item">
              <div class="product-left">
                <img class="product-thumb" src="https://images.unsplash.com/photo-1584917865442-de89df76afd3?auto=format&fit=crop&w=120&q=80" alt="Bag" />
                <div>
                  <p class="product-name">Bag</p>
                  <p class="product-cat">Woman</p>
                </div>
              </div>
              <span class="product-price">$170</span>
            </li>

            <li class="product-item">
              <div class="product-left">
                <img class="product-thumb" src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=120&q=80" alt="brand new t shirt" />
                <div>
                  <p class="product-name">brand new t shirt</p>
                  <p class="product-cat">New t shirt</p>
                </div>
              </div>
              <span class="product-price">$170</span>
            </li>

            <li class="product-item">
              <div class="product-left">
                <img class="product-thumb" src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=120&q=80" alt="Samsung Galaxy Watch 6" />
                <div>
                  <p class="product-name">Samsung Galaxy Watch 6</p>
                  <p class="product-cat">Smartwatch</p>
                </div>
              </div>
              <span class="product-price">$299</span>
            </li>

            <li class="product-item">
              <div class="product-left">
                <img class="product-thumb" src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=120&q=80" alt="Adidas Ultraboost 22" />
                <div>
                  <p class="product-name">Adidas Ultraboost 22</p>
                  <p class="product-cat">Running Sheos</p>
                </div>
              </div>
              <span class="product-price">$170</span>
            </li>
          </ul>
        </article>

      </section>

      <!-- ==================== BOTTOM ROW ==================== -->
      <section class="bottom-grid" aria-label="Customer Orders and Sales by Countries">
        
        <!-- Customer Orders -->
        <article class="card-panel orders-card">
          <div>
            <div class="card-header">
              <div>
                <h2 class="card-title">Customer Orders</h2>
                <p class="card-subtitle">5 Feb - Oct 2026</p>
              </div>
              <button type="button" class="more-btn" aria-label="More options">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
              </button>
            </div>

            <div class="orders-metric-wrap">
              <p class="big-number">55,8754</p>
              <div class="orders-delta-row">
                <span class="badge-pill green">
                  +8.2%
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
                </span>
                <span class="orders-extra">+322</span>
              </div>
            </div>
          </div>

          <div class="area-chart-box">
            <div class="floating-order-pill">43,365</div>
            <svg class="area-svg" viewBox="0 0 400 120" preserveAspectRatio="none" aria-label="Customer Orders Trend">
              <defs>
                <linearGradient id="coralAreaGrad" x1="0" y1="0" x2="0" y2="1">
                  <stop offset="0%" stop-color="#F47E52" stop-opacity="0.28" />
                  <stop offset="100%" stop-color="#F47E52" stop-opacity="0.0" />
                </linearGradient>
              </defs>
              <path fill="url(#coralAreaGrad)" d="M0,98 C25,96 40,86 65,88 C90,90 110,74 135,78 C160,82 180,66 205,68 C230,70 250,50 280,55 C305,60 325,38 355,44 C375,48 390,32 400,30 L400,120 L0,120 Z" />
              <path fill="none" stroke="#EA845E" stroke-width="2.5" stroke-linecap="round" d="M0,98 C25,96 40,86 65,88 C90,90 110,74 135,78 C160,82 180,66 205,68 C230,70 250,50 280,55 C305,60 325,38 355,44 C375,48 390,32 400,30" />
              <line x1="280" y1="55" x2="280" y2="120" stroke="#EA845E" stroke-opacity="0.45" stroke-width="1.2" stroke-dasharray="3 3" />
              <circle cx="280" cy="55" r="4.5" fill="#F47E52" stroke="#FFFFFF" stroke-width="2" />
            </svg>
          </div>
        </article>

        <!-- Sales by Countries -->
        <article class="card-panel">
          <div class="card-header">
            <div>
              <h2 class="card-title">Sales by Countries</h2>
              <p class="card-subtitle">Keep track of all orders here</p>
            </div>

            <div class="countries-filters">
              <div class="select-wrap">
                <select class="filter-select" aria-label="Filter by product">
                  <option>All Product</option>
                  <option>Wellet</option>
                  <option>Sungless</option>
                  <option>Smartwatch</option>
                </select>
                <svg class="select-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
              </div>

              <div class="select-wrap">
                <select class="filter-select" aria-label="Filter by country">
                  <option>Top country</option>
                  <option>United State</option>
                  <option>Bangladesh</option>
                </select>
                <svg class="select-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
              </div>
            </div>
          </div>

          <div class="countries-body">
            <div>
              <div class="country-stat-block">
                <p class="stat-caption">Top Performing Country</p>
                <p class="stat-amount">$2,20,000</p>
                <p class="stat-loc">United State</p>
              </div>

              <div class="country-stat-block">
                <p class="stat-caption">Revenue Growth</p>
                <p class="stat-amount">$2,20,000</p>
              </div>
            </div>

            <div class="world-map-stage">
              <svg class="world-map-svg" viewBox="0 0 650 300" fill="none" aria-label="World Map">
                <!-- Highlighted Royal Blue Americas -->
                <path class="map-continent-blue" d="M45,55 L95,42 L155,48 L195,75 L175,115 L145,132 L130,158 L150,175 L195,198 L215,235 L185,285 L155,275 L145,230 L125,185 L105,152 L75,118 L52,85 Z" />
                <path class="map-continent-blue" d="M195,22 L255,18 L270,48 L225,62 L195,45 Z" />
                <!-- Neutral Warm Grey Continents -->
                <path class="map-continent-grey" d="M295,52 L355,38 L445,35 L545,45 L605,72 L585,128 L535,155 L465,165 L415,142 L365,135 L315,115 L288,85 Z" />
                <path class="map-continent-grey" d="M295,128 L355,125 L395,155 L405,215 L372,268 L335,262 L315,212 L285,168 Z" />
                <path class="map-continent-grey" d="M505,185 L565,195 L595,235 L575,272 L520,268 L498,232 Z" />
              </svg>

              <!-- Pin 1: Top Center -->
              <div class="map-pin-card pin-top-mid">
                <span class="map-pin-flag">
                  <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="12" fill="#16A34A"/>
                    <polygon points="12,4 20,12 12,20 4,12" fill="#FACC15"/>
                    <circle cx="12" cy="12" r="4" fill="#1D4ED8"/>
                  </svg>
                </span>
                <div>
                  <p class="pin-country">Bangladesh</p>
                  <p class="pin-value">$2,365,423</p>
                </div>
              </div>

              <!-- Pin 2: Bottom Left (United State) -->
              <div class="map-pin-card pin-bottom-left">
                <span class="map-pin-flag">
                  <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="12" fill="#FFFFFF"/>
                    <rect y="2" width="24" height="3" fill="#DC2626"/>
                    <rect y="8" width="24" height="3" fill="#DC2626"/>
                    <rect y="14" width="24" height="3" fill="#DC2626"/>
                    <rect y="20" width="24" height="3" fill="#DC2626"/>
                    <rect width="12" height="12" fill="#1D4ED8"/>
                  </svg>
                </span>
                <div>
                  <p class="pin-country">United State</p>
                  <p class="pin-value">$2,365,423</p>
                </div>
              </div>

              <!-- Pin 3: Right (Bangladesh) -->
              <div class="map-pin-card pin-right">
                <span class="map-pin-flag">
                  <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="12" fill="#15803D"/>
                    <circle cx="11" cy="12" r="5.5" fill="#DC2626"/>
                  </svg>
                </span>
                <div>
                  <p class="pin-country">Bangladesh</p>
                  <p class="pin-value">$2,365,423</p>
                </div>
              </div>
            </div>
          </div>
        </article>

      </section>

    </main>
  </div>

  <script>
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

    // 2. Navigation Active Pill Switching
    const navButtons = document.querySelectorAll('.nav-pills .nav-pill');
    navButtons.forEach((btn) => {
      btn.addEventListener('click', () => {
        navButtons.forEach((b) => b.classList.remove('active'));
        btn.classList.add('active');
      });
    });

    // 3. Light / Dark Mode Switch
    const lightBtn = document.getElementById('lightBtn');
    const darkBtn = document.getElementById('darkBtn');

    lightBtn.addEventListener('click', () => {
      document.documentElement.classList.remove('dark');
      lightBtn.classList.add('active');
      darkBtn.classList.remove('active');
    });

    darkBtn.addEventListener('click', () => {
      document.documentElement.classList.add('dark');
      darkBtn.classList.add('active');
      lightBtn.classList.remove('active');
    });

    // 4. Mobile Navigation Toggle
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileNav = document.getElementById('mobileNav');
    mobileMenuBtn.addEventListener('click', () => {
      mobileNav.classList.toggle('open');
    });

    // 5. Export Button Feedback
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
  </script>
</body>
</html>