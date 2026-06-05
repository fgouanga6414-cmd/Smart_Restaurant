<x-app-layout>

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Syne:wght@400;600;700&display=swap');

    [class*="navigation-menu"],
    nav.bg-white,
    nav.border-b,
    header.bg-white {
        display: none !important;
    }

    .min-h-screen {
        background: #F5F5F7 !important;
        padding: 0 !important;
    }

    .bg-gray-100 {
        background: #F5F5F7 !important;
    }

    :root {
        --red:       #E8203A;
        --red-dk:    #C0182F;
        --red-lt:    #FDEAEC;
        --red-md:    #F9C0C8;
        --bg:        #F5F5F7;
        --surf:      #FFFFFF;
        --surf2:     #F9F9FB;
        --border:    #EBEBF0;
        --border2:   #DDDDE8;
        --text:      #111118;
        --text2:     #5A5A72;
        --text3:     #9999B0;
        --success:   #16A34A;
        --warn:      #D97706;
        --ff-h:      'Syne', sans-serif;
        --ff-b:      'Plus Jakarta Sans', sans-serif;
        --r:         12px;
        --r-lg:      18px;
        --shadow:    0 1px 4px rgba(0,0,0,0.07), 0 1px 2px rgba(0,0,0,0.04);
        --shadow-md: 0 4px 20px rgba(0,0,0,0.09);
        --shadow-lg: 0 8px 32px rgba(0,0,0,0.12);
    }

    /* ══ DARK MODE ══ */
    html.theme-dark {
        --bg:         #1A1614;
        --surf:    #1A1614;
        --surf2:   #22222E;
        --border:  rgba(200,149,108,0.18);
        --border2:  rgba(200,149,108,0.18);
        --text:    #F0F0F8;
        --text2:   #A0A0B8;
        --text3:   #606075;
        --red-lt:  #2E1015;
        --red-md:  #793944;
    }
    html.theme-dark .pos-root    { background: var(--bg); color: var(--text); }
    html.theme-dark .pos-sidebar { background: var(--surf); border-color: var(--border); }
    html.theme-dark .pos-logo    { background: var(--red); }
    html.theme-dark .pos-topbar  { background: var(--surf); border-color: var(--border); }
    html.theme-dark .pos-topbar-title { color: var(--text); }
    html.theme-dark .pos-panel-left   { background: var(--bg); }
    html.theme-dark .pos-panel-right  { background: var(--surf); border-color: var(--border); }
    html.theme-dark .pos-card         { background: var(--surf); border-color: var(--border); color: var(--text); }
    html.theme-dark .menu-card        { background: var(--surf); border-color: var(--border); }
    html.theme-dark .menu-card-name   { color: var(--text); }
    html.theme-dark .menu-card-desc   { color: var(--text3); }
    html.theme-dark .menu-card-footer { border-color: var(--border); }
    html.theme-dark .hist-card        { background: var(--surf); border-color: var(--border); }
    html.theme-dark .hist-items       { color: var(--text); }
    html.theme-dark .review-card      { background: var(--surf); border-color: var(--border); }
    html.theme-dark .section-header h2 { color: var(--text); }
    html.theme-dark .pos-search       { background: var(--surf2); border-color: var(--border); }
    html.theme-dark .pos-search input { color: var(--text); }
    html.theme-dark .pos-user-chip    { background: var(--surf2); border-color: var(--border); color: var(--text); }
    html.theme-dark .cat-tab          { background: var(--surf); border-color: var(--border2); color: var(--text2); }
    html.theme-dark .cat-tab .cat-count { background: var(--surf2); color: var(--text3); }
    html.theme-dark .menu-search-wrap { background: var(--surf); border-color: var(--border2); }
    html.theme-dark .menu-search-wrap input { color: var(--text); }
    html.theme-dark .qty-ctrl         { background: var(--surf2); border-color: var(--border2); }
    html.theme-dark .qty-num          { color: var(--text); }
    html.theme-dark .cart-top         { border-color: var(--border); }
    html.theme-dark .cart-label       { color: var(--text3); }
    html.theme-dark .cart-name        { color: var(--text); }
    html.theme-dark .order-type-tabs  { background: var(--surf2); border-color: var(--border2); }
    html.theme-dark .ot-tab           { color: var(--text2); }
    html.theme-dark .cart-item        { border-color: var(--border); }
    html.theme-dark .cart-item-name   { color: var(--text); }
    html.theme-dark .cart-totals      { border-color: var(--border); }
    html.theme-dark .cart-row         { color: var(--text2); }
    html.theme-dark .cart-row.grand   { border-color: var(--border2); color: var(--text); }
    html.theme-dark .cart-empty       { color: var(--text3); }
    html.theme-dark .cart-empty-icon  { background: var(--surf2); }
    html.theme-dark .modal-overlay    { background: rgba(0,0,0,0.7); }
    html.theme-dark .modal-box        { background: var(--surf); color: var(--text); }
    html.theme-dark .modal-title      { color: var(--text); }
    html.theme-dark .modal-sub        { color: var(--text3); }
    html.theme-dark .modal-textarea   { background: var(--surf2); border-color: var(--border2); color: var(--text); }
    html.theme-dark .btn-modal-cancel { background: var(--surf2); border-color: var(--border2); color: var(--text2); }
    html.theme-dark .profile-input    { background: var(--surf2) !important; border-color: var(--border2) !important; color: var(--text) !important; }
    html.theme-dark .stat-card        { background: var(--surf2); border-color: var(--border); }
    html.theme-dark .info-row         { border-color: var(--border); color: var(--text2); }
    html.theme-dark .info-row span:last-child { color: var(--text); }
    html.theme-dark .toast            { background: var(--surf2); color: var(--text); }
    html.theme-dark .step-dot         { background: var(--surf2); border-color: var(--border2); color: var(--text); }
    html.theme-dark .progress-track   { background: var(--border2); }
    html.theme-dark .loyalty-bar-track { background: var(--border2); }
    html.theme-dark .level-chip       { border-color: var(--border2); }
    html.theme-dark #allergenDropdown { background: var(--surf); border-color: var(--border2); }
    html.theme-dark .pos-nav-btn      { color: var(--text3); }
    html.theme-dark .pos-nav-btn:hover { background: var(--red-lt); color: var(--red); }
    html.theme-dark .pos-nav-btn.active { background: var(--red); color: #fff; }
    html.theme-dark .pos-nav-btn .tip { background: var(--text); color: var(--bg); }

    /* Bouton toggle */
    .theme-toggle-btn-dash {
        width: 36px;
        height: 36px;
        border-radius: var(--r);
        border: 1.5px solid var(--border2);
        background: var(--surf2);
        cursor: pointer;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all .18s;
        flex-shrink: 0;
    }
    .theme-toggle-btn-dash:hover {
        border-color: var(--red);
        background: var(--red-lt);
    }

    *,
    *::before,
    *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .pos-root {
        display: flex;
        height: 100vh;
        overflow: hidden;
        background: var(--bg);
        font-family: var(--ff-b);
        color: var(--text);
    }

    /* ── SIDEBAR ── */
    .pos-sidebar {
        width: 76px;
        background: var(--surf);
        border-right: 1px solid var(--border);
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px 0;
        gap: 4px;
        flex-shrink: 0;
        z-index: 10;
        box-shadow: 2px 0 8px rgba(0,0,0,0.04);
    }

    .pos-logo {
        width: 44px;
        height: 44px;
        background: var(--red);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--ff-h);
        font-size: 1.2rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 20px;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(232,32,58,0.3);
    }

    .pos-nav-btn {
        width: 48px;
        height: 48px;
        border-radius: var(--r);
        border: none;
        background: none;
        color: var(--text3);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all .18s;
        position: relative;
        text-decoration: none;
    }

    .pos-nav-btn:hover {
        background: var(--red-lt);
        color: var(--red);
    }

    .pos-nav-btn.active {
        background: var(--red);
        color: #fff;
        box-shadow: 0 4px 12px rgba(232,32,58,0.3);
    }

    .pos-nav-btn svg {
        width: 21px;
        height: 21px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .pos-nav-btn .tip {
        position: absolute;
        left: 62px;
        background: var(--text);
        color: #fff;
        font-size: 0.72rem;
        white-space: nowrap;
        padding: 5px 11px;
        border-radius: 8px;
        opacity: 0;
        pointer-events: none;
        transition: opacity .15s;
        z-index: 999;
        font-family: var(--ff-b);
        font-weight: 600;
    }

    .pos-nav-btn:hover .tip {
        opacity: 1;
    }

    .pos-sidebar-bottom {
        margin-top: auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
    }

    /* ── MAIN ── */
    .pos-main {
        flex: 1;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    /* ── TOPBAR ── */
    .pos-topbar {
        height: 66px;
        background: var(--surf);
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        padding: 0 24px;
        gap: 16px;
        flex-shrink: 0;
        box-shadow: 0 1px 4px rgba(0,0,0,0.04);
    }

    .pos-topbar-title {
        font-family: var(--ff-h);
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text);
        letter-spacing: -.02em;
    }

    .pos-search {
        flex: 1;
        max-width: 300px;
        background: var(--surf2);
        border: 1.5px solid var(--border);
        border-radius: 24px;
        display: flex;
        align-items: center;
        padding: 0 16px;
        gap: 9px;
        transition: border-color .18s;
    }

    .pos-search:focus-within {
        border-color: var(--red);
        box-shadow: 0 0 0 3px rgba(232,32,58,0.08);
    }

    .pos-search svg {
        width: 15px;
        height: 15px;
        stroke: var(--text3);
        fill: none;
        stroke-width: 2;
        flex-shrink: 0;
    }

    .pos-search input {
        flex: 1;
        background: none;
        border: none;
        outline: none;
        color: var(--text);
        font-size: 0.84rem;
        font-family: var(--ff-b);
        padding: 9px 0;
    }

    .pos-search input::placeholder {
        color: var(--text3);
    }

    .pos-topbar-right {
        margin-left: auto;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .pos-badge-chip {
        font-size: 0.66rem;
        font-weight: 700;
        padding: 4px 13px;
        border-radius: 20px;
        letter-spacing: .07em;
        text-transform: uppercase;
        font-family: var(--ff-b);
    }

    .pos-user-chip {
        display: flex;
        align-items: center;
        gap: 9px;
        background: var(--surf2);
        border: 1.5px solid var(--border);
        border-radius: 26px;
        padding: 4px 16px 4px 4px;
        font-size: 0.8rem;
        font-family: var(--ff-b);
        font-weight: 600;
        color: var(--text);
    }

    .pos-user-chip .avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: var(--red);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.72rem;
        color: #fff;
        overflow: hidden;
    }

    /* ── CONTENT ── */
    .pos-content {
        flex: 1;
        display: flex;
        overflow: hidden;
    }

    .pos-panel-left {
        flex: 1;
        overflow-y: auto;
        padding: 24px;
        scrollbar-width: thin;
        scrollbar-color: var(--border2) transparent;
    }

    .pos-panel-right {
        width: 320px;
        background: var(--surf);
        border-left: 1px solid var(--border);
        display: flex;
        flex-direction: column;
        flex-shrink: 0;
        overflow-y: auto;
        scrollbar-width: thin;
        box-shadow: -2px 0 8px rgba(0,0,0,0.04);
    }

    /* ── SECTIONS ── */
    .pos-section {
        display: none;
    }

    .pos-section.active {
        display: block;
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 22px;
    }

    .section-header h2 {
        font-family: var(--ff-h);
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--text);
        letter-spacing: -.02em;
    }

    .section-header-icon {
        width: 38px;
        height: 38px;
        border-radius: 11px;
        background: var(--red-lt);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .section-header-icon svg {
        width: 18px;
        height: 18px;
        stroke: var(--red);
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
    }

    /* ── CAT TABS ── */
    .cat-scroll {
        display: flex;
        gap: 8px;
        overflow-x: auto;
        margin-bottom: 20px;
        padding-bottom: 2px;
        scrollbar-width: none;
    }

    .cat-scroll::-webkit-scrollbar {
        display: none;
    }

    .cat-tab {
        display: flex;
        align-items: center;
        gap: 7px;
        padding: 8px 18px;
        border-radius: 24px;
        border: 1.5px solid var(--border2);
        background: var(--surf);
        color: var(--text2);
        font-size: 0.8rem;
        font-family: var(--ff-b);
        font-weight: 600;
        cursor: pointer;
        white-space: nowrap;
        transition: all .18s;
        flex-shrink: 0;
    }

    .cat-tab .cat-count {
        font-size: 0.66rem;
        font-weight: 700;
        background: var(--surf2);
        color: var(--text3);
        padding: 2px 7px;
        border-radius: 10px;
        transition: all .18s;
    }

    .cat-tab:hover {
        border-color: var(--red-md);
        color: var(--red);
        background: var(--red-lt);
    }

    .cat-tab.active {
        background: var(--red);
        border-color: var(--red);
        color: #fff;
        box-shadow: 0 4px 12px rgba(232,32,58,0.25);
    }

    .cat-tab.active .cat-count {
        background: rgba(255,255,255,0.2);
        color: #fff;
    }

    /* ── MENU SEARCH ── */
    .menu-search-wrap {
        background: var(--surf);
        border: 1.5px solid var(--border2);
        border-radius: 24px;
        display: flex;
        align-items: center;
        padding: 0 16px;
        gap: 9px;
        margin-bottom: 20px;
        transition: border-color .18s;
    }

    .menu-search-wrap:focus-within {
        border-color: var(--red);
        box-shadow: 0 0 0 3px rgba(232,32,58,0.08);
    }

    .menu-search-wrap svg {
        width: 15px;
        height: 15px;
        stroke: var(--text3);
        fill: none;
        stroke-width: 2;
        flex-shrink: 0;
    }

    .menu-search-wrap input {
        flex: 1;
        background: none;
        border: none;
        outline: none;
        color: var(--text);
        font-size: 0.84rem;
        font-family: var(--ff-b);
        padding: 11px 0;
    }

    .menu-search-wrap input::placeholder {
        color: var(--text3);
    }

    /* ── MENU GRID ── */
    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 18px;
    }

    .menu-card {
        background: var(--surf);
        border: 1.5px solid var(--border);
        border-radius: var(--r-lg);
        overflow: hidden;
        cursor: pointer;
        transition: transform .22s, border-color .22s, box-shadow .22s;
        position: relative;
        box-shadow: var(--shadow);
    }

    .menu-card:hover {
        transform: translateY(-5px);
        border-color: var(--red-md);
        box-shadow: var(--shadow-lg);
    }

    .menu-card.in-cart {
        border-color: var(--red);
        box-shadow: 0 0 0 3px rgba(232,32,58,0.12);
    }

    .menu-card.allergic {
        border-color: rgba(234,88,12,0.5);
    }

    .allergy-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: #EA580C;
        color: #fff;
        font-size: 0.6rem;
        font-weight: 700;
        padding: 4px 9px;
        border-radius: 9px;
        letter-spacing: .07em;
        text-transform: uppercase;
        z-index: 2;
        font-family: var(--ff-b);
        box-shadow: 0 2px 8px rgba(234,88,12,0.4);
    }

    .menu-card-img {
        width: 100%;
        height: 170px;
        object-fit: cover;
        display: block;
        transition: transform .3s;
    }

    .menu-card:hover .menu-card-img {
        transform: scale(1.03);
    }

    .menu-card-body {
        padding: 16px;
    }

    .menu-card-cat {
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .09em;
        color: var(--red);
        font-family: var(--ff-b);
        margin-bottom: 6px;
    }

    .menu-card-name {
        font-family: var(--ff-h);
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 6px;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .menu-card-desc {
        font-size: 0.76rem;
        color: var(--text3);
        margin-bottom: 14px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.55;
    }

    .menu-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding-top: 12px;
        border-top: 1.5px solid var(--border);
    }

    .menu-card-price {
        font-family: var(--ff-h);
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--red);
    }

    .qty-ctrl {
        display: flex;
        align-items: center;
        background: var(--surf2);
        border: 1.5px solid var(--border2);
        border-radius: 10px;
        overflow: hidden;
    }

    .qty-btn {
        width: 32px;
        height: 32px;
        background: none;
        border: none;
        color: var(--red);
        font-size: 1.15rem;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background .15s;
        flex-shrink: 0;
    }

    .qty-btn:hover {
        background: var(--red-lt);
    }

    .qty-num {
        min-width: 30px;
        text-align: center;
        font-size: 0.86rem;
        font-weight: 700;
        color: var(--text);
        font-family: var(--ff-b);
    }

    .btn-add-to-cart {
        flex: 1;
        background: var(--red);
        border: none;
        border-radius: 10px;
        color: #fff;
        font-size: 0.74rem;
        font-weight: 700;
        letter-spacing: .06em;
        text-transform: uppercase;
        padding: 9px 12px;
        cursor: pointer;
        transition: background .2s, transform .15s;
        font-family: var(--ff-b);
        white-space: nowrap;
    }

    .btn-add-to-cart:hover {
        background: var(--red-dk);
        transform: scale(1.02);
    }

    .btn-add-to-cart.added {
        background: var(--success);
    }

    /* ── CART ── */
    .cart-top {
        padding: 20px 18px 16px;
        border-bottom: 1px solid var(--border);
    }

    .cart-label {
        font-size: 0.62rem;
        font-weight: 700;
        letter-spacing: .15em;
        text-transform: uppercase;
        color: var(--text3);
        font-family: var(--ff-b);
        margin-bottom: 2px;
    }

    .cart-name {
        font-family: var(--ff-h);
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 14px;
    }

    .order-type-tabs {
        display: flex;
        background: var(--surf2);
        border: 1.5px solid var(--border2);
        border-radius: 26px;
        padding: 3px;
        gap: 2px;
    }

    .ot-tab {
        flex: 1;
        padding: 7px;
        border: none;
        background: none;
        border-radius: 22px;
        color: var(--text2);
        font-size: 0.68rem;
        font-weight: 700;
        cursor: pointer;
        transition: all .18s;
        letter-spacing: .05em;
        text-transform: uppercase;
        font-family: var(--ff-b);
    }

    .ot-tab.active {
        background: var(--red);
        color: #fff;
        box-shadow: 0 3px 8px rgba(240, 188, 75, 0.25);
    }

    .cart-items-list {
        flex: 1;
        padding: 14px 18px;
        overflow-y: auto;
        scrollbar-width: thin;
    }

    .cart-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid var(--border);
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .cart-item-img {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .cart-item-info {
        flex: 1;
        min-width: 0;
    }

    .cart-item-name {
        font-weight: 700;
        font-size: 0.88rem;
        color: var(--text);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-family: var(--ff-b);
    }

    .cart-item-meta {
        font-size: 0.72rem;
        color: var(--text3);
        margin-top: 2px;
        font-family: var(--ff-b);
    }

    .cart-item-total {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--red);
        flex-shrink: 0;
        font-family: var(--ff-h);
    }

    .cart-item-del {
        background: none;
        border: none;
        color: var(--text3);
        cursor: pointer;
        font-size: 1rem;
        padding: 4px 6px;
        transition: all .15s;
        border-radius: 7px;
    }

    .cart-item-del:hover {
        color: var(--red);
        background: var(--red-lt);
    }

    .cart-empty {
        text-align: center;
        padding: 36px 16px;
        color: var(--text3);
        font-size: 0.83rem;
        line-height: 1.8;
        font-family: var(--ff-b);
    }

    .cart-empty-icon {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        background: var(--surf2);
        margin: 0 auto 14px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .cart-empty-icon svg {
        width: 24px;
        height: 24px;
        stroke: var(--text3);
        fill: none;
        stroke-width: 1.5;
    }

    .cart-totals {
        padding: 14px 18px;
        border-top: 1px solid var(--border);
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .cart-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.8rem;
        color: var(--text2);
        font-family: var(--ff-b);
    }

    .cart-row.grand {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--text);
        margin-top: 6px;
        padding-top: 12px;
        border-top: 2px solid var(--border2);
    }

    .cart-row.grand span:last-child {
        color: var(--red);
        font-family: var(--ff-h);
        font-size: 1.15rem;
    }

    .btn-place {
        margin: 0 18px 18px;
        width: calc(100% - 36px);
        padding: 14px;
        background: var(--red);
        border: none;
        border-radius: var(--r);
        color: #fff;
        font-family: var(--ff-b);
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
        cursor: pointer;
        transition: background .2s, transform .15s, box-shadow .2s;
        box-shadow: 0 4px 14px rgba(232,32,58,0.3);
    }

    .btn-place:hover {
        background: var(--red-dk);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(232,32,58,0.35);
    }

    .btn-place:disabled {
        background: #E0E0E8;
        color: var(--text3);
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    /* ── CARDS ── */
    .pos-card {
        background: var(--surf);
        border: 1.5px solid var(--border);
        border-radius: var(--r-lg);
        padding: 20px 22px;
        margin-bottom: 16px;
        box-shadow: var(--shadow);
    }

    /* ── STATUS ── */
    .status-steps {
        display: flex;
        align-items: center;
        margin: 18px 0 14px;
    }

    .status-step {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 7px;
        position: relative;
    }

    .status-step:not(:last-child)::after {
        content: '';
        position: absolute;
        top: 14px;
        left: 55%;
        width: 90%;
        height: 2px;
        background: var(--border2);
        z-index: 0;
    }

    .status-step.done:not(:last-child)::after {
        background: var(--red);
    }

    .step-dot {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: var(--surf2);
        border: 2px solid var(--border2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
        font-weight: 700;
        z-index: 1;
        transition: all .3s;
        font-family: var(--ff-b);
    }

    .status-step.done .step-dot {
        background: var(--red);
        border-color: var(--red);
        color: #fff;
    }

    .status-step.current .step-dot {
        background: #fff;
        border-color: var(--red);
        color: var(--red);
        box-shadow: 0 0 0 4px rgba(232,32,58,0.12);
    }

    .step-lbl {
        font-size: 0.61rem;
        font-weight: 700;
        color: var(--text3);
        text-align: center;
        font-family: var(--ff-b);
        letter-spacing: .04em;
        text-transform: uppercase;
    }

    .status-step.done .step-lbl,
    .status-step.current .step-lbl {
        color: var(--red);
    }

    .progress-track {
        background: var(--border2);
        border-radius: 6px;
        height: 6px;
        overflow: hidden;
        margin-top: 12px;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--red), var(--red-dk));
        border-radius: 6px;
        transition: width 1s ease;
    }

    /* ── LOYALTY ── */
    .loyalty-pts {
        font-family: var(--ff-h);
        font-size: 2.4rem;
        font-weight: 700;
        color: var(--red);
        line-height: 1;
    }

    .loyalty-bar-track {
        background: var(--border2);
        border-radius: 6px;
        height: 7px;
        overflow: hidden;
    }

    .loyalty-bar-fill {
        height: 100%;
        border-radius: 6px;
        background: linear-gradient(90deg, var(--red), var(--red-dk));
        transition: width .6s ease;
    }

    .level-chips {
        display: flex;
        gap: 7px;
        margin-top: 14px;
    }

    .level-chip {
        flex: 1;
        text-align: center;
        padding: 8px 4px;
        border-radius: var(--r);
        font-size: 0.62rem;
        font-weight: 700;
        border: 1.5px solid var(--border2);
        opacity: 0.4;
        font-family: var(--ff-b);
        letter-spacing: .05em;
        text-transform: uppercase;
        transition: opacity .3s;
    }

    .level-chip.earned {
        opacity: 1;
    }

    /* ── HISTORY ── */
    .hist-card {
        background: var(--surf);
        border: 1.5px solid var(--border);
        border-radius: var(--r-lg);
        padding: 16px 18px;
        margin-bottom: 12px;
        display: flex;
        align-items: flex-start;
        gap: 14px;
        box-shadow: var(--shadow);
        transition: box-shadow .18s;
    }

    .hist-card:hover {
        box-shadow: var(--shadow-md);
    }

    .hist-id {
        font-size: 0.72rem;
        color: var(--text3);
        font-family: var(--ff-b);
        margin-bottom: 4px;
    }

    .hist-items {
        font-family: var(--ff-h);
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .hist-total {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--red);
        font-family: var(--ff-b);
    }

    .status-pill {
        font-size: 0.67rem;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 20px;
        font-family: var(--ff-b);
        letter-spacing: .06em;
        text-transform: uppercase;
        white-space: nowrap;
    }

    /* ── REVIEWS ── */
    .review-card {
        background: var(--surf);
        border: 1.5px solid var(--border);
        border-radius: var(--r-lg);
        padding: 16px 18px;
        margin-bottom: 12px;
        box-shadow: var(--shadow);
    }

    .review-stars {
        color: var(--red);
        font-size: 0.95rem;
        letter-spacing: 2px;
    }

    /* ── MODALS ── */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        backdrop-filter: blur(4px);
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        pointer-events: none;
        transition: opacity .22s;
    }

    .modal-overlay.open {
        opacity: 1;
        pointer-events: all;
    }

    .modal-box {
        background: var(--surf);
        border-radius: var(--r-lg);
        padding: 30px;
        width: 100%;
        max-width: 440px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        transform: translateY(16px);
        transition: transform .22s;
    }

    .modal-overlay.open .modal-box {
        transform: translateY(0);
    }

    .modal-title {
        font-family: var(--ff-h);
        font-size: 1.35rem;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 4px;
    }

    .modal-sub {
        font-size: 0.8rem;
        color: var(--text3);
        margin-bottom: 22px;
        font-family: var(--ff-b);
    }

    .star-row {
        display: flex;
        gap: 7px;
        margin-bottom: 18px;
    }

    .star-btn {
        background: none;
        border: none;
        font-size: 1.7rem;
        cursor: pointer;
        color: var(--border2);
        transition: color .15s, transform .12s;
        line-height: 1;
    }

    .star-btn.active,
    .star-btn:hover {
        color: var(--red);
        transform: scale(1.2);
    }

    .modal-textarea {
        width: 100%;
        background: var(--surf2);
        border: 1.5px solid var(--border2);
        border-radius: var(--r);
        color: var(--text);
        font-family: var(--ff-b);
        font-size: 0.85rem;
        padding: 13px;
        resize: vertical;
        min-height: 92px;
        outline: none;
        transition: border-color .18s;
        margin-bottom: 18px;
    }

    .modal-textarea:focus {
        border-color: var(--red);
        box-shadow: 0 0 0 3px rgba(232,32,58,0.08);
    }

    .modal-textarea::placeholder {
        color: var(--text3);
    }

    .modal-actions {
        display: flex;
        gap: 10px;
    }

    .btn-modal-cancel {
        flex: 1;
        padding: 12px;
        background: var(--surf2);
        border: 1.5px solid var(--border2);
        border-radius: var(--r);
        color: var(--text2);
        cursor: pointer;
        font-size: 0.82rem;
        font-family: var(--ff-b);
        font-weight: 700;
        transition: all .18s;
    }

    .btn-modal-cancel:hover {
        border-color: var(--red);
        color: var(--red);
    }

    .btn-modal-submit {
        flex: 2;
        padding: 12px;
        background: var(--red);
        border: none;
        border-radius: var(--r);
        color: #fff;
        font-size: 0.82rem;
        font-weight: 700;
        cursor: pointer;
        font-family: var(--ff-b);
        letter-spacing: .07em;
        text-transform: uppercase;
        transition: background .18s;
        box-shadow: 0 4px 12px rgba(232,32,58,0.25);
    }

    .btn-modal-submit:hover {
        background: var(--red-dk);
    }

    /* ── PROFILE ── */
    .profile-input {
        width: 100%;
        padding: 11px 15px;
        background: var(--surf2);
        border: 1.5px solid var(--border2);
        border-radius: var(--r);
        color: var(--text);
        font-size: 0.86rem;
        outline: none;
        font-family: var(--ff-b);
        transition: border-color .15s;
    }

    .profile-input:focus {
        border-color: var(--red);
        box-shadow: 0 0 0 3px rgba(232,32,58,0.08);
    }

    .stat-card {
        background: var(--surf2);
        border-radius: var(--r);
        padding: 16px;
        text-align: center;
        border: 1.5px solid var(--border);
    }

    .stat-val {
        font-family: var(--ff-h);
        font-size: 1.7rem;
        font-weight: 700;
        color: var(--red);
    }

    .stat-lbl {
        font-size: 0.68rem;
        color: var(--text3);
        margin-top: 3px;
        font-family: var(--ff-b);
        font-weight: 600;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    /* ── TOAST ── */
    .toast {
        position: fixed;
        bottom: 26px;
        right: 26px;
        background: var(--text);
        color: #fff;
        border-radius: var(--r);
        padding: 13px 22px;
        font-size: 0.83rem;
        font-weight: 600;
        box-shadow: 0 8px 28px rgba(0,0,0,0.2);
        z-index: 2000;
        transform: translateY(12px);
        opacity: 0;
        transition: transform .28s, opacity .28s;
        display: flex;
        align-items: center;
        gap: 10px;
        font-family: var(--ff-b);
        max-width: 340px;
    }

    .toast.show {
        transform: translateY(0);
        opacity: 1;
    }

    .toast.success::before {
        content: '✓';
        font-weight: 700;
        color: #4ade80;
    }

    .toast.error::before {
        content: '✕';
        font-weight: 700;
        color: #f87171;
    }

    .allergen-tag {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 5px 11px;
        border-radius: 20px;
        background: rgba(234,88,12,0.1);
        color: #C2410C;
        border: 1px solid rgba(234,88,12,0.3);
        font-size: 0.73rem;
        font-family: var(--ff-b);
        font-weight: 600;
    }

    .allergen-tag button {
        background: none;
        border: none;
        color: #C2410C;
        cursor: pointer;
        font-size: 0.95rem;
        padding: 0 0 0 2px;
        line-height: 1;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 9px 0;
        border-bottom: 1px solid var(--border);
        font-size: 0.82rem;
        font-family: var(--ff-b);
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-row span:first-child {
        color: var(--text3);
    }

    .info-row span:last-child {
        color: var(--text);
        font-weight: 600;
    }
    </style>

    <script>
        /* ══ THEME INIT — avant rendu pour éviter le flash ══ */
        (function(){
            var saved = localStorage.getItem('sternlicht-theme') || 'light';
            if(saved === 'dark') document.documentElement.classList.add('theme-dark');
        })();
    </script>

    <div class="pos-root">

        {{-- ── SIDEBAR ── --}}
        <nav class="pos-sidebar">

            <div class="pos-logo">R</div>

            <a href="{{ url('/') }}" class="pos-nav-btn" style="text-decoration:none">
                <svg viewBox="0 0 24 24">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
                <span class="tip">Accueil</span>
            </a>

            <button class="pos-nav-btn active" onclick="showSection('menu',this)">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7"/>
                    <rect x="14" y="3" width="7" height="7"/>
                    <rect x="3" y="14" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/>
                </svg>
                <span class="tip">Menu</span>
            </button>

            <button class="pos-nav-btn" onclick="showSection('status',this)">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 6 12 12 16 14"/>
                </svg>
                <span class="tip">Statut commande</span>
            </button>

            <button class="pos-nav-btn" onclick="showSection('loyalty',this)">
                <svg viewBox="0 0 24 24">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                </svg>
                <span class="tip">Fidélité</span>
            </button>

            <button class="pos-nav-btn" onclick="showSection('history',this)">
                <svg viewBox="0 0 24 24">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                </svg>
                <span class="tip">Historique</span>
            </button>

            <button class="pos-nav-btn" onclick="showSection('reviews',this)">
                <svg viewBox="0 0 24 24">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                </svg>
                <span class="tip">Mes avis</span>
            </button>

            <div class="pos-sidebar-bottom">

                <button class="pos-nav-btn" onclick="showSection('profile',this)">
                    <svg viewBox="0 0 24 24">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                    <span class="tip">Profil</span>
                </button>

                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();document.getElementById('lf').submit();"
                   class="pos-nav-btn"
                   style="text-decoration:none">
                    <svg viewBox="0 0 24 24">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    <span class="tip">Déconnexion</span>
                </a>

                <form id="lf" action="{{ route('logout') }}" method="POST" style="display:none">
                    @csrf
                </form>

            </div>
        </nav>

        {{-- ── MAIN ── --}}
        <div class="pos-main">

            {{-- TOPBAR --}}
            <header class="pos-topbar">

                <span class="pos-topbar-title" id="topbarTitle">Menu</span>

                <div class="pos-topbar-right">
                    @php
                        $u      = auth()->user();
                        $badge  = $u->loyalty_badge ?? 'Nouveau';
                        $bColors = [
                            'Gold'    => '#D97706',
                            'Silver'  => '#6B7280',
                            'Bronze'  => '#92400E',
                            'Nouveau' => '#6B7280',
                        ];
                        $bBg = [
                            'Gold'    => '#FEF3C7',
                            'Silver'  => '#F3F4F6',
                            'Bronze'  => '#FEF3C7',
                            'Nouveau' => '#F3F4F6',
                        ];
                        $bc  = $bColors[$badge] ?? '#6B7280';
                        $bBc = $bBg[$badge]     ?? '#F3F4F6';
                    @endphp

                    <span class="pos-badge-chip"
                          style="background:{{ $bBc }};color:{{ $bc }};border:1.5px solid {{ $bc }}40">
                        {{ $badge }}
                    </span>

                    <div class="pos-user-chip">
                        <div class="avatar">
                            @if($u->profile_photo_path)
                                <img src="{{ asset($u->profile_photo_path) }}"
                                     style="width:100%;height:100%;object-fit:cover;display:block;border-radius:50%">
                            @else
                                {{ strtoupper(substr($u->name, 0, 1)) }}
                            @endif
                        </div>
                        <span>{{ $u->name }}</span>
                    </div>

                    {{-- THEME TOGGLE --}}
                    <button class="theme-toggle-btn-dash" id="themeToggle" onclick="toggleTheme()" title="Changer le thème">
                        <span id="themeIcon">🌙</span>
                    </button>

                </div>
            </header>

            <div class="pos-content">

                {{-- ── PANEL LEFT ── --}}
                <div class="pos-panel-left">

                    {{-- ══ MENU ══ --}}
                    <div class="pos-section active" id="section-menu">

                        <div class="section-header">
                            <div class="section-header-icon">
                                <svg viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="7" height="7"/>
                                    <rect x="14" y="3" width="7" height="7"/>
                                    <rect x="3" y="14" width="7" height="7"/>
                                    <rect x="14" y="14" width="7" height="7"/>
                                </svg>
                            </div>
                            <h2>Notre Menu</h2>
                        </div>

                        <div class="cat-scroll">
                            <button class="cat-tab active" onclick="filterCat('all',this)">
                                Tout <span class="cat-count">{{ $foods->count() }}</span>
                            </button>
                            @foreach(['Burgers','Pizza','Desserts','Boissons','Café','Jus','Pâtes','Salades','Sandwichs','Autres'] as $cat)
                                @php $catCount = $foods->where('category', $cat)->count(); @endphp
                                @if($catCount > 0)
                                <button class="cat-tab" onclick="filterCat('{{ $cat }}',this)">
                                    {{ $cat }} <span class="cat-count">{{ $catCount }}</span>
                                </button>
                                @endif
                            @endforeach
                        </div>

                        <div class="menu-search-wrap">
                            <svg viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="8"/>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                            </svg>
                            <input type="text" placeholder="Chercher un plat..." oninput="filterMenu(this.value)">
                        </div>

                        <div class="menu-grid" id="menuGrid">
                            @foreach($foods as $food)
                                @php $isAllergic = in_array($food->id, $allergicFoodIds); @endphp
                                <div class="menu-card {{ $isAllergic ? 'allergic' : '' }}"
                                     data-id="{{ $food->id }}"
                                     data-allergic="{{ $isAllergic ? '1' : '0' }}"
                                     data-name="{{ strtolower($food->Food_name) }}"
                                     data-category="{{ $food->category ?? 'Autres' }}"
                                     data-price="{{ $food->Food_price }}"
                                     data-img="{{ asset('food_img/'.$food->image) }}">

                                    @if($isAllergic)
                                    <div class="allergy-badge">Allergène</div>
                                    @endif

                                    <img src="{{ asset('food_img/'.$food->image) }}"
                                         alt="{{ $food->Food_name }}"
                                         class="menu-card-img"
                                         loading="lazy">

                                    <div class="menu-card-body">
                                        @if($food->category)
                                        <div class="menu-card-cat">{{ $food->category }}</div>
                                        @endif
                                        <div class="menu-card-name">{{ $food->Food_name }}</div>
                                        <div class="menu-card-desc">{{ $food->Food_detail }}</div>
                                        <div class="menu-card-footer">
                                            <span class="menu-card-price">{{ $food->Food_price }} DH</span>
                                            <div style="display:flex;gap:8px;align-items:center">
                                                <div class="qty-ctrl">
                                                    <button class="qty-btn" onclick="changeQty({{ $food->id }},-1)">−</button>
                                                    <span class="qty-num" id="qty-{{ $food->id }}">0</span>
                                                    <button class="qty-btn" onclick="changeQty({{ $food->id }},1)">+</button>
                                                </div>
                                                <button class="btn-add-to-cart"
                                                        id="addbtn-{{ $food->id }}"
                                                        onclick="addToCart({{ $food->id }})">
                                                    Ajouter
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- ══ STATUT ══ --}}
                    <div class="pos-section" id="section-status">

                        <div class="section-header">
                            <div class="section-header-icon">
                                <svg viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                            </div>
                            <h2>Statut de votre commande</h2>
                        </div>

                        @if($activeOrder)
                            @php
                                $steps  = ['pending','confirmed','preparing','ready','delivered'];
                                $curIdx = array_search($activeOrder->status, $steps);
                                $curIdx = $curIdx === false ? 0 : $curIdx;
                                $labels = ['En attente','Confirmée','En préparation','Prête','Livrée'];
                            @endphp

                            <div class="pos-card">

                                <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:12px">
                                    <div>
                                        <div style="font-size:0.72rem;color:var(--text3);font-family:var(--ff-b);font-weight:600;margin-bottom:4px">
                                            Votre numéro
                                        </div>
                                        <div style="font-family:var(--ff-h);font-size:2rem;font-weight:700;color:var(--red);line-height:1">
                                            #{{ $activeOrder->daily_number }}
                                        </div>
                                    </div>
                                    <span id="statusBadge"
                                          class="status-pill"
                                          style="background:{{ $activeOrder->status_color }}18;color:{{ $activeOrder->status_color }}">
                                        {{ $activeOrder->status_label }}
                                    </span>
                                </div>

                                <div class="status-steps">
                                    @foreach($steps as $i => $s)
                                    <div class="status-step {{ $i < $curIdx ? 'done' : ($i == $curIdx ? 'current' : '') }}">
                                        <div class="step-dot">{{ $i < $curIdx ? '✓' : ($i+1) }}</div>
                                        <div class="step-lbl">{{ $labels[$i] }}</div>
                                    </div>
                                    @endforeach
                                </div>

                                <div id="progressWrap"
                                     style="display:{{ $activeOrder->status === 'preparing' ? 'block' : 'none' }}">
                                    <div class="progress-track">
                                        <div class="progress-fill"
                                             id="orderProgress"
                                             style="width:{{ $activeOrder->status === 'preparing' ? $activeOrder->progress_percent : 0 }}%">
                                        </div>
                                    </div>
                                    <div id="orderTimer"
                                         style="font-size:0.78rem;color:var(--text3);margin-top:8px;font-family:var(--ff-b)">
                                        Temps restant :
                                        <strong style="color:var(--red)">{{ $activeOrder->remaining_minutes }} min</strong>
                                    </div>
                                </div>

                                <div style="margin-top:18px;padding-top:16px;border-top:1.5px solid var(--border)">
                                    @foreach($activeOrder->items as $item)
                                    <div style="display:flex;justify-content:space-between;font-size:0.8rem;margin-bottom:6px;font-family:var(--ff-b)">
                                        <span style="color:var(--text2)">
                                            {{ optional($item->food)->Food_name }} × {{ $item->quantity }}
                                        </span>
                                        <span style="font-weight:700;color:var(--red)">{{ $item->subtotal }} DH</span>
                                    </div>
                                    @endforeach
                                    <div style="display:flex;justify-content:space-between;font-size:0.92rem;font-weight:700;margin-top:12px;padding-top:12px;border-top:2px solid var(--border2);font-family:var(--ff-b)">
                                        <span>Total</span>
                                        <span style="color:var(--red);font-family:var(--ff-h)">{{ $activeOrder->total }} DH</span>
                                    </div>
                                </div>

                            </div>

                        @else
                            <div class="pos-card" style="text-align:center;padding:50px 20px">
                                <div style="width:64px;height:64px;background:var(--red-lt);border-radius:18px;display:flex;align-items:center;justify-content:center;margin:0 auto 18px">
                                    <svg viewBox="0 0 24 24"
                                         style="width:28px;height:28px;stroke:var(--red);fill:none;stroke-width:1.8;stroke-linecap:round">
                                        <circle cx="12" cy="12" r="10"/>
                                        <polyline points="12 6 12 12 16 14"/>
                                    </svg>
                                </div>
                                <div style="font-family:var(--ff-h);font-size:1.15rem;font-weight:700;color:var(--text);margin-bottom:8px">
                                    Aucune commande en cours
                                </div>
                                <div style="font-size:0.82rem;color:var(--text3);margin-bottom:20px">
                                    Passez votre commande depuis le menu.
                                </div>
                                <button onclick="showSection('menu',null)"
                                        style="background:var(--red);border:none;border-radius:var(--r);color:#fff;padding:10px 24px;cursor:pointer;font-size:0.8rem;font-family:var(--ff-b);font-weight:700;letter-spacing:.07em;text-transform:uppercase;box-shadow:0 4px 12px rgba(232,32,58,0.3)">
                                    Voir le menu
                                </button>
                            </div>
                        @endif
                    </div>

                    {{-- ══ FIDÉLITÉ ══ --}}
                    <div class="pos-section" id="section-loyalty">

                        <div class="section-header">
                            <div class="section-header-icon">
                                <svg viewBox="0 0 24 24">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                </svg>
                            </div>
                            <h2>Programme de fidélité</h2>
                        </div>

                        @php
                            $u2      = $u;
                            $pts     = $u2->loyalty_points  ?? 0;
                            $badge2  = $u2->loyalty_badge   ?? 'Nouveau';
                            $nextPts = $u2->next_level_points ?? 50;
                            $pct     = $nextPts > 0 ? min(100, ($pts / $nextPts) * 100) : 100;
                            $col     = $bColors[$badge2] ?? '#6b7280';
                        @endphp

                        <div class="pos-card">

                            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:18px">
                                <div>
                                    <div style="font-size:0.63rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--text3);font-family:var(--ff-b);margin-bottom:6px">
                                        Points accumulés
                                    </div>
                                    <div class="loyalty-pts">{{ $pts }}</div>
                                    <div style="font-size:0.74rem;color:var(--text3);font-family:var(--ff-b);margin-top:6px">
                                        {{ $pts }} / {{ $nextPts }} pts pour le prochain niveau
                                    </div>
                                </div>
                                <div style="text-align:right">
                                    <span class="pos-badge-chip"
                                          style="background:{{ $bBc }};color:{{ $bc }};border:1.5px solid {{ $bc }}40">
                                        {{ $badge2 }}
                                    </span>
                                    <div style="margin-top:10px;font-size:0.72rem;color:var(--text3);font-family:var(--ff-b)">
                                        Total dépensé
                                    </div>
                                    <div style="font-family:var(--ff-h);font-size:1.15rem;font-weight:700;color:var(--text)">
                                        {{ number_format($u2->total_spent ?? 0, 2) }} DH
                                    </div>
                                </div>
                            </div>

                            <div class="loyalty-bar-track">
                                <div class="loyalty-bar-fill" style="width:{{ $pct }}%"></div>
                            </div>

                            <div class="level-chips">
                                <div class="level-chip {{ $pts >= 0 ? 'earned' : '' }}"
                                     style="color:#6B7280;border-color:#6B728040">
                                    Nouveau<br><small style="font-size:0.58rem">0 pts</small>
                                </div>
                                <div class="level-chip {{ $pts >= 50 ? 'earned' : '' }}"
                                     style="color:#92400E;border-color:#92400E40">
                                    Bronze<br><small style="font-size:0.58rem">50 pts</small>
                                </div>
                                <div class="level-chip {{ $pts >= 200 ? 'earned' : '' }}"
                                     style="color:#6B7280;border-color:#6B728060">
                                    Silver<br><small style="font-size:0.58rem">200 pts</small>
                                </div>
                                <div class="level-chip {{ $pts >= 500 ? 'earned' : '' }}"
                                     style="color:#D97706;border-color:#D9770640">
                                    Gold<br><small style="font-size:0.58rem">500 pts</small>
                                </div>
                            </div>

                            <div style="margin-top:16px;padding:14px 16px;background:var(--red-lt);border-radius:var(--r);font-size:0.78rem;color:#9B1C2E;font-family:var(--ff-b);line-height:1.7;border:1.5px solid var(--red-md)">
                                Gagnez <strong>1 point</strong> par <strong>50 DH</strong> consommés.
                                Chaque <strong>10 points</strong> = <strong>20 DH</strong> de remise.
                            </div>

                        </div>
                    </div>

                    {{-- ══ HISTORIQUE ══ --}}
                    <div class="pos-section" id="section-history">

                        <div class="section-header">
                            <div class="section-header-icon">
                                <svg viewBox="0 0 24 24">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                    <polyline points="14 2 14 8 20 8"/>
                                </svg>
                            </div>
                            <h2>Historique des commandes</h2>
                        </div>

                        @forelse($orderHistory as $order)
                        <div class="hist-card">
                            <div style="flex:1;min-width:0">
                                <div class="hist-id">N° {{ $order->daily_number }} — {{ $order->created_at->format('d/m/Y H:i') }}</div>
                                <div class="hist-items">
                                    {{ $order->items->map(fn($i) => optional($i->food)->Food_name.' x'.$i->quantity)->implode(', ') }}
                                </div>
                                <div class="hist-total">
                                    {{ $order->total }} DH
                                    <span style="font-size:0.7rem;font-weight:500;color:var(--text3)">
                                        +{{ $order->loyalty_points_earned }} pts
                                    </span>
                                </div>
                            </div>
                            <div style="display:flex;flex-direction:column;gap:8px;align-items:flex-end">
                                <span class="status-pill"
                                      style="background:{{ $order->status_color }}18;color:{{ $order->status_color }}">
                                    {{ $order->status_label }}
                                </span>
                                @if($order->status === 'delivered' && !$order->review)
                                    <button class="btn-add-to-cart"
                                            style="font-size:0.68rem;padding:7px 14px;border-radius:var(--r)"
                                            onclick="openReview({{ $order->id }})">
                                        Laisser un avis
                                    </button>
                                @elseif($order->review)
                                    <div style="text-align:right">
                                        <div class="review-stars">
                                            @for($i=1;$i<=5;$i++){{ $i <= $order->review->rating ? '★' : '☆' }}@endfor
                                        </div>
                                        <div style="font-size:0.69rem;color:var(--text3);margin-top:2px;max-width:140px;text-align:right;line-height:1.4;font-family:var(--ff-b)">
                                            {{ Str::limit($order->review->comment, 40) }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="pos-card" style="text-align:center;padding:44px 20px">
                            <div style="font-family:var(--ff-h);font-size:1.1rem;font-weight:700;color:var(--text);margin-bottom:8px">
                                Aucune commande passée
                            </div>
                            <div style="font-size:0.82rem;color:var(--text3)">Vos commandes apparaîtront ici.</div>
                        </div>
                        @endforelse
                    </div>

                    {{-- ══ AVIS ══ --}}
                    <div class="pos-section" id="section-reviews">

                        <div class="section-header">
                            <div class="section-header-icon">
                                <svg viewBox="0 0 24 24">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                                </svg>
                            </div>
                            <h2>Mes avis</h2>
                        </div>

                        @forelse($reviewHistory as $review)
                        <div class="review-card">
                            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px">
                                <span style="font-size:0.72rem;color:var(--text3);font-family:var(--ff-b);font-weight:500">
                                    Commande #{{ $review->order_id }} — {{ $review->created_at->format('d/m/Y') }}
                                </span>
                                <div style="text-align:right">
                                    <div class="review-stars">
                                        @for($i=1;$i<=5;$i++){{ $i <= $review->rating ? '★' : '☆' }}@endfor
                                    </div>
                                    <div style="font-size:0.66rem;color:var(--text3);font-family:var(--ff-b)">
                                        {{ $review->rating }}/5
                                    </div>
                                </div>
                            </div>
                            <div style="font-size:0.82rem;color:var(--text2);line-height:1.65;font-family:var(--ff-b)">
                                {{ $review->comment }}
                            </div>
                        </div>
                        @empty
                        <div class="pos-card" style="text-align:center;padding:44px 20px">
                            <div style="font-family:var(--ff-h);font-size:1.1rem;font-weight:700;color:var(--text);margin-bottom:8px">
                                Aucun avis
                            </div>
                            <div style="font-size:0.82rem;color:var(--text3)">
                                Vos avis apparaîtront ici après une commande livrée.
                            </div>
                        </div>
                        @endforelse
                    </div>

                    {{-- ══ PROFIL ══ --}}
                    <div class="pos-section" id="section-profile">

                        <div class="section-header">
                            <div class="section-header-icon">
                                <svg viewBox="0 0 24 24">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            </div>
                            <h2>Mon profil</h2>
                        </div>

                        @php $pu = auth()->user(); @endphp

                        <div style="max-width:560px">

                            <div class="pos-card" style="margin-bottom:16px">

                                <div style="display:flex;align-items:center;gap:20px;margin-bottom:22px">
                                    <div style="position:relative;flex-shrink:0;cursor:pointer"
                                         onclick="document.getElementById('photoInput').click()">
                                        <div id="profileAvatarWrap"
                                             style="width:78px;height:78px;border-radius:50%;border:2.5px solid var(--border2);overflow:hidden;position:relative;transition:border-color .2s">
                                            @if($pu->profile_photo_path)
                                                <img src="{{ asset($pu->profile_photo_path) }}"
                                                     style="width:100%;height:100%;object-fit:cover;display:block">
                                            @else
                                                <div style="width:100%;height:100%;background:var(--red);display:flex;align-items:center;justify-content:center;font-family:var(--ff-h);font-size:2.1rem;font-weight:700;color:#fff">
                                                    {{ strtoupper(substr($pu->name, 0, 1)) }}
                                                </div>
                                            @endif
                                        </div>
                                        <input type="file" id="photoInput" accept="image/*" style="display:none">
                                    </div>

                                    <div style="flex:1;min-width:0">
                                        <div style="font-family:var(--ff-h);font-size:1.35rem;font-weight:700;color:var(--text)">
                                            {{ $pu->name }}
                                        </div>
                                        <div style="font-size:0.78rem;color:var(--text3);font-family:var(--ff-b);margin-top:4px">
                                            {{ $pu->email }}
                                        </div>
                                        <div style="margin-top:9px">
                                            @php
                                                $pb  = $pu->loyalty_badge ?? 'Nouveau';
                                                $pbc = $bColors[$pb]      ?? '#6B7280';
                                                $pbBg = $bBg[$pb]         ?? '#F3F4F6';
                                            @endphp
                                            <span class="pos-badge-chip"
                                                  style="background:{{ $pbBg }};color:{{ $pbc }};border:1.5px solid {{ $pbc }}40">
                                                {{ $pb }}
                                            </span>
                                        </div>
                                    </div>

                                    <button onclick="openProfileEdit()"
                                            style="padding:9px 20px;background:var(--red-lt);border:1.5px solid var(--red-md);border-radius:var(--r);color:var(--red);font-size:0.76rem;font-weight:700;cursor:pointer;font-family:var(--ff-b);letter-spacing:.06em;text-transform:uppercase;transition:background .18s;white-space:nowrap">
                                        Modifier
                                    </button>
                                </div>

                                <div style="height:1.5px;background:var(--border);margin-bottom:20px"></div>

                                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
                                    <div class="stat-card">
                                        <div class="stat-val">{{ $pu->loyalty_points ?? 0 }}</div>
                                        <div class="stat-lbl">Points fidélité</div>
                                    </div>
                                    <div class="stat-card">
                                        <div class="stat-val">{{ number_format($pu->total_spent ?? 0, 0) }}</div>
                                        <div class="stat-lbl">DH dépensés</div>
                                    </div>
                                    <div class="stat-card">
                                        <div class="stat-val">{{ $pu->orders()->count() }}</div>
                                        <div class="stat-lbl">Commandes</div>
                                    </div>
                                    <div class="stat-card">
                                        <div class="stat-val">{{ $pu->reviews()->count() }}</div>
                                        <div class="stat-lbl">Avis donnés</div>
                                    </div>
                                </div>

                            </div>

                            <div class="pos-card">

                                <div style="font-size:0.62rem;letter-spacing:.18em;text-transform:uppercase;color:var(--text3);font-family:var(--ff-b);font-weight:700;margin-bottom:16px">
                                    Informations du compte
                                </div>

                                <div style="margin-bottom:18px">
                                    <div style="font-size:0.66rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--text3);font-family:var(--ff-b);margin-bottom:9px">
                                        Mes allergènes
                                    </div>
                                    @php $allergenes = $pu->allergenes ?? []; @endphp
                                    @if(count($allergenes))
                                        <div style="display:flex;flex-wrap:wrap;gap:7px;margin-bottom:12px">
                                            @foreach($allergenes as $al)
                                            <span class="allergen-tag">{{ $al }}</span>
                                            @endforeach
                                        </div>
                                    @else
                                        <div style="font-size:0.78rem;color:var(--text3);margin-bottom:12px;font-family:var(--ff-b)">
                                            Aucun allergène enregistré.
                                        </div>
                                    @endif
                                    <button onclick="openProfileEdit()"
                                            style="padding:7px 16px;background:var(--red-lt);border:1.5px solid var(--red-md);border-radius:var(--r);color:var(--red);font-size:0.72rem;font-weight:700;cursor:pointer;font-family:var(--ff-b);letter-spacing:.06em;text-transform:uppercase">
                                        Modifier mes allergènes
                                    </button>
                                </div>

                                <div class="info-row">
                                    <span>Membre depuis</span>
                                    <span>{{ $pu->created_at->format('d/m/Y') }}</span>
                                </div>
                                <div class="info-row">
                                    <span>Statut</span>
                                    <span style="color:var(--success);font-weight:700">Client actif</span>
                                </div>
                                <div class="info-row">
                                    <span>Prochain niveau</span>
                                    <span>{{ $pu->next_level_points ?? 50 }} pts</span>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>{{-- fin panel-left --}}

                {{-- ── PANIER ── --}}
                <aside class="pos-panel-right">

                    <div class="cart-top">
                        <div class="cart-label">Votre commande</div>
                        <div class="cart-name">{{ auth()->user()->name }}</div>
                        <div class="order-type-tabs">
                            <button class="ot-tab active" onclick="setType('dine_in',this)">Sur place</button>
                            <button class="ot-tab" onclick="setType('take_away',this)">À emporter</button>
                            <button class="ot-tab" onclick="setType('delivery',this)">Livraison</button>
                        </div>
                    </div>

                    <div class="cart-items-list" id="cartItems">
                        <div class="cart-empty">
                            <div class="cart-empty-icon">
                                <svg viewBox="0 0 24 24">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                                    <line x1="3" y1="6" x2="21" y2="6"/>
                                    <path d="M16 10a4 4 0 0 1-8 0"/>
                                </svg>
                            </div>
                            Votre panier est vide.<br>Ajoutez des plats depuis le menu.
                        </div>
                    </div>

                    <div class="cart-totals" id="cartTotals" style="display:none">

                        <div class="cart-row">
                            <span>Sous-total</span>
                            <span id="cartSubtotal">0.00 DH</span>
                        </div>

                        <div class="cart-row" id="discountRow" style="display:none;color:var(--success)">
                            <span>Remise fidélité</span>
                            <span id="cartDiscount">- 0.00 DH</span>
                        </div>

                        <div class="cart-row grand">
                            <span>Total</span>
                            <span id="cartTotal">0.00 DH</span>
                        </div>

                        <div style="font-size:0.72rem;color:var(--text3);font-family:var(--ff-b)">
                            + <span id="pointsPreview">0</span> points fidélité
                        </div>

                        @php
                            $pts = auth()->user()->loyalty_points ?? 0;
                            $dh  = $pts * 2;
                        @endphp

                        @if($pts >= 5)
                        <div style="margin-top:12px;padding:14px;background:var(--red-lt);border-radius:var(--r);border:1.5px solid var(--red-md)">
                            <div style="font-size:0.72rem;color:#9B1C2E;font-family:var(--ff-b);font-weight:600;margin-bottom:10px">
                                Vous avez <strong>{{ $pts }} pts</strong> = <strong>{{ $dh }} DH</strong> disponibles
                            </div>
                            <div style="display:flex;align-items:center;gap:8px;margin-bottom:10px">
                                <input type="range"
                                       id="discountSlider"
                                       min="0"
                                       max="{{ $dh }}"
                                       step="2"
                                       value="0"
                                       style="flex:1;accent-color:var(--red)"
                                       oninput="applyDiscount(parseInt(this.value))">
                                <span id="sliderVal"
                                      style="font-size:0.82rem;color:var(--red);font-family:var(--ff-b);font-weight:700;min-width:44px;text-align:right">
                                    0 DH
                                </span>
                            </div>
                            <div style="display:flex;gap:7px">
                                <button onclick="applyDiscount(Math.min({{ $dh }}, parseFloat(document.getElementById('cartTotal').textContent)))"
                                        style="flex:1;padding:7px;background:var(--red);border:none;border-radius:var(--r);color:#fff;font-size:0.7rem;font-weight:700;cursor:pointer;font-family:var(--ff-b);letter-spacing:.06em;text-transform:uppercase">
                                    Tout utiliser
                                </button>
                                <button onclick="applyDiscount(0)"
                                        style="padding:7px 13px;background:var(--surf);border:1.5px solid var(--border2);border-radius:var(--r);color:var(--text2);font-size:0.7rem;cursor:pointer;font-family:var(--ff-b);font-weight:600">
                                    Annuler
                                </button>
                            </div>
                        </div>
                        @endif

                    </div>

                    <button class="btn-place" id="btnPlaceOrder" disabled onclick="placeOrder()">
                        Passer la commande
                    </button>

                </aside>

            </div>
        </div>
    </div>

    {{-- ══ MODAL REVIEW ══ --}}
    <div class="modal-overlay" id="reviewModal">
        <div class="modal-box">
            <div class="modal-title">Votre avis</div>
            <div class="modal-sub">Comment était votre expérience ?</div>
            <input type="hidden" id="reviewOrderId">
            <div class="star-row">
                @for($i=1;$i<=5;$i++)
                <button class="star-btn" data-val="{{ $i }}" onclick="setRating({{ $i }})">★</button>
                @endfor
            </div>
            <textarea class="modal-textarea" id="reviewComment" placeholder="Décrivez votre expérience..."></textarea>
            <div class="modal-actions">
                <button class="btn-modal-cancel" onclick="closeReview()">Annuler</button>
                <button class="btn-modal-submit" onclick="submitReview()">Envoyer l'avis</button>
            </div>
        </div>
    </div>

    {{-- ══ MODAL PROFIL ══ --}}
    <div class="modal-overlay" id="profileModal">
        <div class="modal-box" style="max-width:480px">

            <div class="modal-title">Modifier le profil</div>
            <div class="modal-sub">Mettez à jour vos informations personnelles</div>

            <div style="display:flex;align-items:center;gap:16px;margin-bottom:22px;padding:16px;background:var(--surf2);border-radius:var(--r);border:1.5px solid var(--border)">
                <div id="modalAvatarWrap"
                     style="width:58px;height:58px;border-radius:50%;overflow:hidden;flex-shrink:0;border:2px solid var(--border2)">
                    @if(auth()->user()->profile_photo_path)
                        <img src="{{ asset(auth()->user()->profile_photo_path) }}"
                             style="width:100%;height:100%;object-fit:cover;display:block">
                    @else
                        <div style="width:100%;height:100%;background:var(--red);display:flex;align-items:center;justify-content:center;font-family:var(--ff-h);font-size:1.5rem;font-weight:700;color:#fff">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <div style="flex:1">
                    <div style="font-size:0.74rem;color:var(--text3);font-family:var(--ff-b);font-weight:500;margin-bottom:7px">
                        Photo de profil
                    </div>
                    <label style="display:inline-flex;align-items:center;gap:6px;padding:7px 16px;background:var(--red-lt);border:1.5px solid var(--red-md);border-radius:var(--r);color:var(--red);font-size:0.72rem;font-weight:700;cursor:pointer;font-family:var(--ff-b);letter-spacing:.06em;text-transform:uppercase">
                        Choisir une photo
                        <input type="file" id="photoInputModal" accept="image/*" style="display:none">
                    </label>
                </div>
            </div>

            <div style="margin-bottom:14px">
                <div style="font-size:0.63rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--text3);font-family:var(--ff-b);margin-bottom:6px">
                    Nom complet
                </div>
                <input id="profileName" type="text" class="profile-input" value="{{ auth()->user()->name }}">
            </div>

            <div style="margin-bottom:20px">
                <div style="font-size:0.63rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--text3);font-family:var(--ff-b);margin-bottom:6px">
                    Adresse email
                </div>
                <input id="profileEmail" type="email" class="profile-input" value="{{ auth()->user()->email }}">
            </div>

            <div style="margin-bottom:22px">
                <div style="font-size:0.63rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--text3);font-family:var(--ff-b);margin-bottom:9px">
                    Mes allergènes
                </div>
                <div id="allergenTags" style="display:flex;flex-wrap:wrap;gap:7px;margin-bottom:10px;min-height:8px"></div>
                <div style="position:relative">
                    <input id="profileAllergenes" type="hidden"
                           value="{{ implode(', ', auth()->user()->allergenes ?? []) }}">
                    <input id="allergenInput" type="text" class="profile-input"
                           placeholder="Saisir ou choisir ci-dessous..."
                           autocomplete="off">
                    <div id="allergenDropdown"
                         style="display:none;position:absolute;top:100%;left:0;right:0;background:var(--surf);border:1.5px solid var(--border2);border-radius:var(--r);z-index:50;margin-top:4px;overflow:hidden;box-shadow:var(--shadow-md)">
                    </div>
                </div>
                <div style="margin-top:12px">
                    <div style="font-size:0.61rem;color:var(--text3);font-family:var(--ff-b);letter-spacing:.1em;text-transform:uppercase;margin-bottom:8px;font-weight:700">
                        Sélection rapide
                    </div>
                    <div style="display:flex;flex-wrap:wrap;gap:6px" id="allergenQuickList"></div>
                </div>
            </div>

            <div class="modal-actions">
                <button class="btn-modal-cancel" onclick="closeProfileEdit()">Annuler</button>
                <button class="btn-modal-submit" onclick="saveProfile()">Sauvegarder</button>
            </div>

        </div>
    </div>

    <div class="toast" id="toast"></div>

    <script>
    /* ══ THEME TOGGLE ══ */
    function updateThemeIcon(){
        var icon = document.getElementById('themeIcon');
        if(!icon) return;
        icon.textContent = document.documentElement.classList.contains('theme-dark') ? '☀️' : '🌙';
    }
    function toggleTheme(){
        var isDark = document.documentElement.classList.toggle('theme-dark');
        localStorage.setItem('sternlicht-theme', isDark ? 'dark' : 'light');
        updateThemeIcon();
    }
    updateThemeIcon();

    const cart        = {};
    let orderType     = 'dine_in';
    let reviewRating  = 0;
    let pendingPhotoFile = null;
    let discountDH    = 0;

    const sectionTitles = {
        menu:    'Menu',
        status:  'Statut commande',
        loyalty: 'Programme fidélité',
        history: 'Historique',
        reviews: 'Mes avis',
        profile: 'Mon profil',
    };

    function showSection(id, btn) {
        document.querySelectorAll('.pos-section').forEach(s => s.classList.remove('active'));
        document.querySelectorAll('.pos-nav-btn').forEach(b => b.classList.remove('active'));
        document.getElementById('section-' + id).classList.add('active');
        if (btn) btn.classList.add('active');
        const t = document.getElementById('topbarTitle');
        if (t) t.textContent = sectionTitles[id] || '';
    }

    function filterMenu(q) {
        q = q.toLowerCase();
        document.querySelectorAll('.menu-card').forEach(card => {
            card.style.display = card.dataset.name.includes(q) ? '' : 'none';
        });
    }

    function filterCat(cat, btn) {
        document.querySelectorAll('.cat-tab').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        document.querySelectorAll('.menu-card').forEach(card => {
            card.style.display = (cat === 'all' || card.dataset.category === cat) ? '' : 'none';
        });
    }

    function setType(type, btn) {
        orderType = type;
        document.querySelectorAll('.ot-tab').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
    }

    function changeQty(id, delta) {
        const el = document.getElementById('qty-' + id);
        let val  = parseInt(el.textContent) + delta;
        if (val < 0) val = 0;
        el.textContent = val;
        if (cart[id]) {
            cart[id].qty = val;
            if (val === 0) delete cart[id];
            renderCart();
        }
    }

    function addToCart(id) {
        const card = document.querySelector('.menu-card[data-id="' + id + '"]');
        if (card.dataset.allergic === '1') {
            if (!confirm('Ce plat contient un de vos allergènes. Voulez-vous quand même l\'ajouter ?')) return;
        }
        const qty = parseInt(document.getElementById('qty-' + id).textContent);
        const n   = qty > 0 ? qty : 1;
        if (qty === 0) document.getElementById('qty-' + id).textContent = 1;
        if (cart[id]) {
            cart[id].qty += n;
        } else {
            cart[id] = {
                id,
                name:  card.querySelector('.menu-card-name').textContent,
                price: parseFloat(card.dataset.price),
                img:   card.dataset.img,
                qty:   n,
            };
        }
        card.classList.add('in-cart');
        const btn = document.getElementById('addbtn-' + id);
        btn.textContent = 'Ajouté ✓';
        btn.classList.add('added');
        setTimeout(() => { btn.textContent = 'Ajouter'; btn.classList.remove('added'); }, 1400);
        renderCart();
    }

    function renderCart() {
        const el   = document.getElementById('cartItems');
        const keys = Object.keys(cart);
        if (!keys.length) {
            el.innerHTML = '<div class="cart-empty"><div class="cart-empty-icon"><svg viewBox="0 0 24 24" style="width:24px;height:24px;stroke:var(--text3);fill:none;stroke-width:1.5"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg></div>Votre panier est vide.<br>Ajoutez des plats depuis le menu.</div>';
            document.getElementById('cartTotals').style.display = 'none';
            document.getElementById('btnPlaceOrder').disabled   = true;
            discountDH = 0;
            return;
        }
        let sub = 0, html = '';
        keys.forEach(id => {
            const item = cart[id];
            const line = item.price * item.qty;
            sub += line;
            html += '<div class="cart-item">'
                + '<img src="' + item.img + '" class="cart-item-img" alt="">'
                + '<div class="cart-item-info">'
                + '<div class="cart-item-name">' + item.name + '</div>'
                + '<div class="cart-item-meta">' + item.price.toFixed(2) + ' DH × ' + item.qty + '</div>'
                + '</div>'
                + '<span class="cart-item-total">' + line.toFixed(2) + ' DH</span>'
                + '<button class="cart-item-del" onclick="removeFromCart(' + id + ')" aria-label="Retirer">✕</button>'
                + '</div>';
        });
        el.innerHTML = html;
        updateTotals(sub);
        document.getElementById('cartTotals').style.display = 'flex';
        document.getElementById('btnPlaceOrder').disabled   = false;
    }

    function updateTotals(sub) {
        discountDH = Math.min(discountDH, sub);
        const total = Math.max(0, sub - discountDH);
        const pts   = Math.floor(total / 50);
        document.getElementById('cartSubtotal').textContent  = sub.toFixed(2) + ' DH';
        document.getElementById('cartTotal').textContent     = total.toFixed(2) + ' DH';
        document.getElementById('pointsPreview').textContent = pts;
        const discRow = document.getElementById('discountRow');
        const discEl  = document.getElementById('cartDiscount');
        if (discountDH > 0 && discRow && discEl) {
            discRow.style.display = '';
            discEl.textContent    = '- ' + discountDH.toFixed(2) + ' DH';
        } else if (discRow) {
            discRow.style.display = 'none';
        }
    }

    function applyDiscount(dh) {
        let sub = 0;
        Object.values(cart).forEach(item => { sub += item.price * item.qty; });
        const maxDH = {{ auth()->user()->loyalty_points * 2 ?? 0 }};
        discountDH  = Math.max(0, Math.min(dh, sub, maxDH));
        const slider = document.getElementById('discountSlider');
        const slVal  = document.getElementById('sliderVal');
        if (slider) slider.value = discountDH;
        if (slVal)  slVal.textContent = discountDH.toFixed(0) + ' DH';
        updateTotals(sub);
    }

    function removeFromCart(id) {
        delete cart[id];
        const qEl  = document.getElementById('qty-' + id);
        const card = document.querySelector('.menu-card[data-id="' + id + '"]');
        if (qEl)  qEl.textContent = 0;
        if (card) card.classList.remove('in-cart');
        renderCart();
    }

    async function placeOrder() {
        const btn = document.getElementById('btnPlaceOrder');
        btn.disabled = true;
        btn.textContent = 'Traitement...';
        const items = Object.values(cart).map(i => ({ food_id: i.id, quantity: i.qty }));
        try {
            const res = await fetch('{{ route("order.place") }}', {
                method: 'POST',
                headers: {
                    'Content-Type':  'application/json',
                    'X-CSRF-TOKEN':  '{{ csrf_token() }}',
                    'Accept':        'application/json',
                },
                body: JSON.stringify({ type: orderType, items, discount_used: discountDH }),
            });
            const data = await res.json();
            if (data.success) {
                showToast(data.message, 'success');
                Object.keys(cart).forEach(id => {
                    delete cart[id];
                    const qEl  = document.getElementById('qty-' + id);
                    const card = document.querySelector('.menu-card[data-id="' + id + '"]');
                    if (qEl)  qEl.textContent = 0;
                    if (card) card.classList.remove('in-cart');
                });
                renderCart();
                setTimeout(() => { location.href = '{{ route("dashboard") }}'; }, 1800);
            } else {
                showToast(data.message, 'error');
                btn.disabled = false;
                btn.textContent = 'Passer la commande';
            }
        } catch(e) {
            showToast('Erreur réseau', 'error');
            btn.disabled = false;
            btn.textContent = 'Passer la commande';
        }
    }

    function openReview(orderId) {
        document.getElementById('reviewOrderId').value = orderId;
        reviewRating = 0;
        document.querySelectorAll('.star-btn').forEach(b => b.classList.remove('active'));
        document.getElementById('reviewComment').value = '';
        document.getElementById('reviewModal').classList.add('open');
    }

    function closeReview() {
        document.getElementById('reviewModal').classList.remove('open');
    }

    function setRating(val) {
        reviewRating = val;
        document.querySelectorAll('.star-btn').forEach(b => {
            b.classList.toggle('active', parseInt(b.dataset.val) <= val);
        });
    }

    async function submitReview() {
        if (!reviewRating) { showToast('Choisissez une note', 'error'); return; }
        try {
            const res = await fetch('{{ route("review.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept':       'application/json',
                },
                body: JSON.stringify({
                    order_id: document.getElementById('reviewOrderId').value,
                    rating:   reviewRating,
                    comment:  document.getElementById('reviewComment').value.trim(),
                }),
            });
            const data = await res.json();
            closeReview();
            showToast(data.message, data.success ? 'success' : 'error');
            if (data.success) setTimeout(() => location.reload(), 1500);
        } catch(e) {
            showToast('Erreur réseau', 'error');
        }
    }

    function previewPhoto(input) {
        if (!input.files || !input.files[0]) return;
        pendingPhotoFile = input.files[0];
        const url = URL.createObjectURL(input.files[0]);
        ['profileAvatarWrap', 'modalAvatarWrap'].forEach(function(wid) {
            const w = document.getElementById(wid);
            if (w) w.innerHTML = '<img src="' + url + '" style="width:100%;height:100%;object-fit:cover;display:block;border-radius:50%">';
        });
    }

    function openProfileEdit()  { document.getElementById('profileModal').classList.add('open'); }
    function closeProfileEdit() { document.getElementById('profileModal').classList.remove('open'); }

    async function saveProfile() {
        const name      = document.getElementById('profileName').value.trim();
        const email     = document.getElementById('profileEmail').value.trim();
        const allergenes = document.getElementById('profileAllergenes')?.value.trim() || '';
        if (!name)  { showToast('Le nom est requis', 'error'); return; }
        if (!email) { showToast("L'email est requis", 'error'); return; }
        const fd = new FormData();
        fd.append('name',      name);
        fd.append('email',     email);
        fd.append('allergenes', allergenes);
        if (pendingPhotoFile) fd.append('photo', pendingPhotoFile);
        try {
            const res = await fetch('{{ route("profile.update") }}', {
                method:  'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                body:    fd,
            });
            const data = await res.json();
            if (data.success) {
                closeProfileEdit();
                showToast(data.message, 'success');
                setTimeout(() => location.reload(), 1400);
            } else {
                showToast(data.message || 'Erreur', 'error');
            }
        } catch(e) {
            showToast('Erreur réseau', 'error');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {

        document.getElementById('photoInput').addEventListener('change', function() { previewPhoto(this); });
        document.getElementById('photoInputModal').addEventListener('change', function() { previewPhoto(this); });
        document.getElementById('profileModal').addEventListener('click', function(e) { if (e.target === this) closeProfileEdit(); });
        document.getElementById('reviewModal').addEventListener('click',  function(e) { if (e.target === this) closeReview(); });

        const ALLERGENS_LIST = [
            'Gluten','Lait','Oeufs','Arachides','Noix','Soja',
            'Poisson','Crustacés','Sésame','Moutarde','Céleri',
            'Lupin','Mollusques','Sulfites',
        ];

        let selectedAllergens = '{{ implode(", ", auth()->user()->allergenes ?? []) }}'
            .split(',')
            .map(a => a.trim())
            .filter(a => a.length > 0);

        function renderAllergenTags() {
            const tags = document.getElementById('allergenTags');
            if (!tags) return;
            tags.innerHTML = selectedAllergens.map(a =>
                '<span class="allergen-tag">' + a
                + '<button onclick="removeAllergen(\'' + a + '\')">&times;</button>'
                + '</span>'
            ).join('');
            const hidden = document.getElementById('profileAllergenes');
            if (hidden) hidden.value = selectedAllergens.join(', ');
        }

        function renderQuickList() {
            const list = document.getElementById('allergenQuickList');
            if (!list) return;
            list.innerHTML = ALLERGENS_LIST.map(a => {
                const active = selectedAllergens.includes(a);
                return '<button onclick="toggleAllergen(\'' + a + '\')" style="'
                    + 'padding:5px 13px;border-radius:20px;font-size:0.72rem;font-family:var(--ff-b);font-weight:600;cursor:pointer;transition:all .15s;'
                    + (active
                        ? 'background:rgba(234,88,12,0.12);color:#C2410C;border:1.5px solid rgba(234,88,12,0.35)'
                        : 'background:var(--surf2);color:var(--text3);border:1.5px solid var(--border2)')
                    + '">' + a + '</button>';
            }).join('');
        }

        window.toggleAllergen = function(a) {
            if (selectedAllergens.includes(a)) {
                selectedAllergens = selectedAllergens.filter(x => x !== a);
            } else {
                selectedAllergens.push(a);
            }
            renderAllergenTags();
            renderQuickList();
        };

        window.removeAllergen = function(a) {
            selectedAllergens = selectedAllergens.filter(x => x !== a);
            renderAllergenTags();
            renderQuickList();
        };

        const allergenInput    = document.getElementById('allergenInput');
        const allergenDropdown = document.getElementById('allergenDropdown');

        if (allergenInput) {
            allergenInput.addEventListener('input', function() {
                const q = this.value.trim().toLowerCase();
                if (!q) { allergenDropdown.style.display = 'none'; return; }
                const matches = ALLERGENS_LIST.filter(a => a.toLowerCase().includes(q) && !selectedAllergens.includes(a));
                if (!matches.length) { allergenDropdown.style.display = 'none'; return; }
                allergenDropdown.innerHTML = matches.map(a =>
                    '<div onclick="selectAllergenFromDropdown(\'' + a + '\')"'
                    + ' style="padding:11px 15px;font-size:0.82rem;font-family:var(--ff-b);font-weight:500;color:var(--text);cursor:pointer;transition:background .12s"'
                    + ' onmouseover="this.style.background=\'var(--red-lt)\'"'
                    + ' onmouseout="this.style.background=\'none\'">'
                    + a + '</div>'
                ).join('');
                allergenDropdown.style.display = 'block';
            });

            allergenInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const val = this.value.trim();
                    if (val && !selectedAllergens.includes(val)) {
                        selectedAllergens.push(val);
                        renderAllergenTags();
                        renderQuickList();
                    }
                    this.value = '';
                    allergenDropdown.style.display = 'none';
                }
            });

            document.addEventListener('click', function(e) {
                if (!allergenInput.contains(e.target) && !allergenDropdown.contains(e.target)) {
                    allergenDropdown.style.display = 'none';
                }
            });
        }

        window.selectAllergenFromDropdown = function(a) {
            if (!selectedAllergens.includes(a)) {
                selectedAllergens.push(a);
                renderAllergenTags();
                renderQuickList();
            }
            if (allergenInput) allergenInput.value = '';
            allergenDropdown.style.display = 'none';
        };

        renderAllergenTags();
        renderQuickList();
    });

    @if($activeOrder)
    let remainingSeconds = 0;

    function updateStatusUI(data) {
        remainingSeconds = data.remaining_seconds;
        const badge = document.getElementById('statusBadge');
        if (badge) {
            badge.textContent      = data.status_label;
            badge.style.color      = data.status_color;
            badge.style.background = data.status_color + '18';
        }
        const steps = ['pending','confirmed','preparing','ready','delivered'];
        const idx   = steps.indexOf(data.status);
        document.querySelectorAll('#section-status .status-step').forEach((el, i) => {
            el.classList.remove('done', 'current');
            if (i < idx)        el.classList.add('done');
            else if (i === idx) el.classList.add('current');
            const dot = el.querySelector('.step-dot');
            if (dot) dot.textContent = i < idx ? '✓' : (i + 1);
        });
        const progressWrap = document.getElementById('progressWrap');
        if (progressWrap) progressWrap.style.display = data.status === 'preparing' ? 'block' : 'none';
        if (data.status === 'ready') showToast('Votre commande est prête !', 'success');
    }

    fetch('{{ route("order.status", $activeOrder->id) }}')
        .then(r => r.json())
        .then(data => updateStatusUI(data))
        .catch(() => {});

    setInterval(function() {
        if (remainingSeconds <= 0) return;
        remainingSeconds--;
        const timerEl = document.getElementById('orderTimer');
        const prog    = document.getElementById('orderProgress');
        if (timerEl) {
            const m = Math.floor(remainingSeconds / 60);
            const s = remainingSeconds % 60;
            timerEl.innerHTML = 'Temps restant : <strong style="color:var(--red)">'
                + (m > 0 ? m + 'min ' : '') + s + 's</strong>';
        }
        if (prog) {
            const totalSecs = {{ ($activeOrder->estimated_prep_minutes ?? 15) * 60 }};
            const elapsed   = totalSecs - remainingSeconds;
            prog.style.width = totalSecs > 0
                ? Math.min(99, Math.floor((elapsed / totalSecs) * 100)) + '%'
                : '0%';
        }
    }, 1000);

    setInterval(async function() {
        try {
            const res  = await fetch('{{ route("order.status", $activeOrder->id) }}');
            const data = await res.json();
            updateStatusUI(data);
        } catch(e) {}
    }, 10000);
    @endif

    function showToast(msg, type) {
        type = type || 'success';
        const t = document.getElementById('toast');
        t.textContent = msg;
        t.className   = 'toast ' + type + ' show';
        setTimeout(function() { t.classList.remove('show'); }, 3500);
    }

    const hash = location.hash.replace('#', '');
    if (hash && document.getElementById('section-' + hash)) showSection(hash, null);
    </script>

</x-app-layout>