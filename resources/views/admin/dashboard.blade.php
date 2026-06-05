<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin — Restaurant</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=Jost:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <script>
        (function(){
            var saved = localStorage.getItem('sternlicht-theme') || 'light';
            if(saved === 'dark') document.documentElement.classList.add('theme-dark');
        })();
    </script>

    <style>
    /* ─── LIGHT MODE (défaut) ─── */
    :root {
        --bg:       #F8F5F0;
        --surf:     #FFFFFF;
        --surf2:    #F2EDE5;
        --border:   #E8E1D8;
        --border2:  #D9CFC4;
        --t1:       #0D0A09;
        --t2:       #3D2B1F;
        --t3:       #7A5C4E;
        --a:        #C0392B;
        --a-l:      #E74C3C;
        --a-d:      #922B21;
        --a-bg:     rgba(192,57,43,0.08);
        --a-bg2:    rgba(192,57,43,0.16);
        --sb:       #1A1614;
        --sb2:      #252018;
        --sb3:      #2E2820;
        --green:    #12165e;
        --green-bg: rgba(45,106,79,0.1);
        --red:      #5c1c9b;
        --red-bg:   rgba(9, 188, 238, 0.09);
        --blue:     #5a1eaf;
        --blue-bg:  rgba(93, 30, 175, 0.09);
        --yellow:   #92400E;
        --yellow-bg:rgba(146,64,14,0.1);
        --ff-d: 'Cormorant Garamond', Georgia, serif;
        --ff-b: 'Jost', sans-serif;
        --r:    8px;
        --r2:   12px;
        --sh:   0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
        --sh2:  0 4px 16px rgba(0,0,0,0.09);
    }

    /* ─── DARK MODE ─── */
    html.theme-dark {
        --bg:       #0D0B0A;
        --surf:     #131110;
        --surf2:    #1A1614;
        --border:   rgba(200,149,108,0.18);
        --border2:  rgba(200,149,108,0.28);
        --t1:       #F2EDE5;
        --t2:       rgba(242,237,229,0.65);
        --t3:       rgba(242,237,229,0.38);
        --a:        #f74949;
        --a-l:      #E8B49A;
        --a-d:      #9B6B48;
        --a-bg:     rgba(200,149,108,0.10);
        --a-bg2:    rgba(200,149,108,0.20);
        --sb:       #0D0B0A;
        --sb2:      #131110;
        --sb3:      #1A1614;
        --green:   #f8ae71;
        --green-bg: rgba(74,222,128,0.1);
        --red:      #f8ae71;
        --red-bg:   rgba(248,113,113,0.1);
        --blue:     #93c5fd;
        --blue-bg:  rgba(147,197,253,0.1);
        --yellow:   #fcd34d;
        --yellow-bg:rgba(252,211,77,0.1);
        --sh:   0 1px 3px rgba(0,0,0,0.3), 0 1px 2px rgba(0,0,0,0.2);
        --sh2:  0 4px 16px rgba(0,0,0,0.4);
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html, body { height: 100%; overflow: hidden; }

    body {
        background: var(--bg);
        font-family: var(--ff-b);
        color: var(--t1);
        font-size: 14px;
        -webkit-font-smoothing: antialiased;
        transition: background .3s, color .3s;
    }

    .root { display: flex; height: 100vh; }

    /* ─── SIDEBAR ─── */
    .sb {
        width: 220px;
        background: var(--sb);
        display: flex;
        flex-direction: column;
        flex-shrink: 0;
        border-right: 1px solid rgba(255,255,255,0.04);
        transition: background .3s;
    }

    .sb-brand {
        padding: 24px 18px 20px;
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }

    .sb-brand-row { display: flex; align-items: center; gap: 11px; }

    .sb-brand-icon {
        width: 36px; height: 36px;
        background: var(--a);
        border-radius: var(--r);
        display: flex; align-items: center; justify-content: center;
        font-family: var(--ff-d); font-size: 1rem; font-weight: 600;
        color: #fff; flex-shrink: 0; letter-spacing: .02em;
    }

    .sb-brand-name {
        font-family: var(--ff-d); font-size: 0.95rem; font-weight: 500;
        color: rgba(255,255,255,0.9); letter-spacing: .02em;
    }

    .sb-brand-sub {
        font-size: 0.56rem; color: rgba(255,255,255,0.3);
        letter-spacing: .22em; text-transform: uppercase;
        margin-top: 2px; font-family: var(--ff-b);
    }

    .sb-nav {
        flex: 1; padding: 16px 10px;
        display: flex; flex-direction: column; gap: 1px;
        overflow-y: auto; scrollbar-width: none;
    }

    .sb-group {
        font-size: 0.5rem; font-weight: 600;
        color: rgba(255,255,255,0.2); letter-spacing: .22em;
        text-transform: uppercase; padding: 14px 10px 6px;
        font-family: var(--ff-b);
    }

    .sb-btn {
        display: flex; align-items: center; gap: 9px;
        padding: 9px 11px; border-radius: var(--r);
        border: none; background: none;
        color: rgba(255,255,255,0.42);
        font-size: 0.78rem; font-family: var(--ff-b); font-weight: 400;
        cursor: pointer; transition: all .15s;
        text-align: left; width: 100%; letter-spacing: .01em;
    }

    .sb-btn i { font-size: 15px; flex-shrink: 0; opacity: .8; }

    .sb-btn:hover { background: rgba(255,255,255,0.05); color: rgba(255,255,255,0.75); }

    .sb-btn.active { background: var(--a); color: #fff; font-weight: 500; }
    .sb-btn.active i { opacity: 1; }

    .sb-foot {
        padding: 14px 10px;
        border-top: 1px solid rgba(255,255,255,0.05);
    }

    .sb-user { display: flex; align-items: center; gap: 9px; }

    .sb-av {
        width: 34px; height: 34px; border-radius: 50%;
        background: var(--sb3); border: 1px solid rgba(255,255,255,0.1);
        display: flex; align-items: center; justify-content: center;
        font-family: var(--ff-d); font-size: 0.78rem;
        color: rgba(255,255,255,0.7); overflow: hidden; flex-shrink: 0;
    }

    .sb-av img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }

    .sb-uname {
        font-size: 0.75rem; color: rgba(255,255,255,0.75);
        font-family: var(--ff-b); font-weight: 500;
        flex: 1; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }

    .sb-urole { font-size: 0.57rem; color: rgba(255,255,255,0.3); font-family: var(--ff-b); margin-top: 1px; }

    .sb-logout {
        width: 28px; height: 28px;
        background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.06);
        border-radius: 6px; display: flex; align-items: center; justify-content: center;
        cursor: pointer; color: rgba(255,255,255,0.3); transition: all .15s; flex-shrink: 0;
    }

    .sb-logout:hover { background: rgba(200,149,108,0.18); color: var(--a-l); border-color: rgba(200,149,108,0.25); }

    /* ─── THEME TOGGLE ─── */
    .theme-toggle-btn {
        width: 28px; height: 28px;
        background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.06);
        border-radius: 6px; display: flex; align-items: center; justify-content: center;
        cursor: pointer; color: rgba(255,255,255,0.5); transition: all .15s;
        font-size: 0.85rem; flex-shrink: 0;
    }

    .theme-toggle-btn:hover { background: rgba(200,149,108,0.18); color: var(--a-l); border-color: rgba(200,149,108,0.25); }

    /* ─── MAIN ─── */
    .main { flex: 1; display: flex; flex-direction: column; overflow: hidden; min-width: 0; }

    /* ─── TOPBAR ─── */
    .topbar {
        height: 56px; background: var(--surf); border-bottom: 1px solid var(--border);
        display: flex; align-items: center; padding: 0 24px; gap: 14px; flex-shrink: 0;
        transition: background .3s, border-color .3s;
    }

    .topbar-title {
        font-family: var(--ff-d); font-size: 1rem; font-weight: 400;
        color: var(--t1); flex: 1; font-style: italic; letter-spacing: .01em;
    }

    .topbar-date {
        font-size: 0.7rem; color: var(--t3); font-family: var(--ff-b);
        background: var(--surf2); padding: 4px 12px; border-radius: 20px;
        border: 1px solid var(--border);
    }

    .topbar-chip {
        display: flex; align-items: center; gap: 8px;
        background: var(--sb); border-radius: 20px;
        padding: 4px 12px 4px 4px; cursor: pointer; transition: background .15s;
    }

    .topbar-chip:hover { background: var(--sb2); }

    .topbar-av {
        width: 26px; height: 26px; border-radius: 50%;
        background: var(--sb3); display: flex; align-items: center; justify-content: center;
        font-family: var(--ff-d); font-size: 0.65rem; color: rgba(255,255,255,0.7); overflow: hidden;
    }

    .topbar-av img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }
    .topbar-chip span { font-size: 0.72rem; color: rgba(255,255,255,0.8); font-family: var(--ff-b); }

    /* ─── CONTENT ─── */
    .content {
        flex: 1; overflow-y: auto; padding: 26px 28px;
        scrollbar-width: thin; scrollbar-color: var(--border2) transparent;
    }

    .sec { display: none; }
    .sec.active { display: block; }

    .sec-hd { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; }

    .sec-title {
        font-family: var(--ff-d); font-size: 1.35rem; font-weight: 400;
        color: var(--t1); letter-spacing: .01em;
    }

    /* ─── KPI ─── */
    .kpi-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 12px; margin-bottom: 24px; }

    .kpi {
        background: var(--surf); border: 1px solid var(--border);
        border-radius: var(--r2); padding: 18px 20px;
        transition: box-shadow .2s, border-color .2s, background .3s;
    }

    .kpi:hover { box-shadow: var(--sh2); border-color: var(--border2); }

    .kpi-label { font-size: 0.62rem; font-weight: 600; text-transform: uppercase; letter-spacing: .1em; color: var(--t3); font-family: var(--ff-b); margin-bottom: 10px; }
    .kpi-val { font-family: var(--ff-d); font-size: 1.85rem; font-weight: 400; color: var(--t1); line-height: 1; margin-bottom: 6px; letter-spacing: -.01em; }
    .kpi-val.accent { color: var(--a); }
    .kpi-sub { font-size: 0.63rem; color: var(--t3); font-family: var(--ff-b); }
    .kpi-bar { height: 2px; background: var(--border); border-radius: 2px; margin-bottom: 12px; overflow: hidden; }
    .kpi-bar-fill { height: 100%; border-radius: 2px; background: var(--a); }
    .kpi-bar-fill.green { background: var(--green); }
    .kpi-bar-fill.dark  { background: var(--t2); }
    .kpi-bar-fill.red   { background: var(--red); }

    /* ─── CARDS ─── */
    .charts-row   { display: grid; grid-template-columns: 3fr 2fr; gap: 16px; margin-bottom: 20px; }
    .charts-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px; }

    .card { background: var(--surf); border: 1px solid var(--border); border-radius: var(--r2); padding: 20px 22px; box-shadow: var(--sh); transition: background .3s, border-color .3s; }

    .card-hd { display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; padding-bottom: 14px; border-bottom: 1px solid var(--border); }

    .card-title { font-size: 0.62rem; font-weight: 600; text-transform: uppercase; letter-spacing: .1em; color: var(--t2); font-family: var(--ff-b); }

    .card-badge { font-size: 0.62rem; padding: 3px 10px; border-radius: 20px; background: var(--a-bg); color: var(--a); border: 1px solid var(--a-bg2); font-family: var(--ff-b); font-weight: 500; }

    /* ─── TOP FOODS ─── */
    .top-row { display: flex; align-items: center; gap: 13px; padding: 10px 0; border-bottom: 1px solid var(--border); }
    .top-row:last-child { border-bottom: none; }
    .top-rank { width: 20px; font-size: 0.65rem; color: var(--t3); font-family: var(--ff-b); font-weight: 600; text-align: center; flex-shrink: 0; }
    .top-row:nth-child(1) .top-rank { color: var(--a); }
    .top-row:nth-child(2) .top-rank { color: var(--t2); }
    .top-row:nth-child(3) .top-rank { color: var(--a-d); }
    .top-img { width: 38px; height: 38px; border-radius: var(--r); object-fit: cover; flex-shrink: 0; background: var(--surf2); border: 1px solid var(--border); }
    .top-info { flex: 1; min-width: 0; }
    .top-name { font-size: 0.8rem; color: var(--t1); font-family: var(--ff-b); font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .top-cat  { font-size: 0.6rem; color: var(--t3); font-family: var(--ff-b); margin-top: 2px; }
    .top-bar-wrap { width: 72px; height: 3px; background: var(--surf2); border-radius: 2px; flex-shrink: 0; overflow: hidden; }
    .top-bar { height: 100%; background: var(--a); border-radius: 2px; }
    .top-qty { font-size: 0.7rem; font-weight: 600; color: var(--a); font-family: var(--ff-b); min-width: 68px; text-align: right; flex-shrink: 0; }

    /* ─── MENU ─── */
    .cat-tabs { display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 16px; }

    .cat-tab {
        padding: 5px 13px; border-radius: 20px; border: 1px solid var(--border2);
        background: var(--surf); color: var(--t2); font-size: 0.7rem;
        font-family: var(--ff-b); cursor: pointer; transition: all .15s; font-weight: 500;
    }

    .cat-tab:hover { border-color: var(--a); color: var(--a); }
    .cat-tab.active { background: var(--sb); color: rgba(255,255,255,0.88); border-color: var(--sb); }

    .menu-list { display: flex; flex-direction: column; gap: 7px; }

    .menu-row {
        display: flex; align-items: center; gap: 13px;
        background: var(--surf); border: 1px solid var(--border);
        border-radius: var(--r2); padding: 11px 14px;
        transition: all .15s; box-shadow: var(--sh);
    }

    .menu-row:hover { border-color: var(--border2); box-shadow: var(--sh2); }

    .menu-img { width: 48px; height: 48px; border-radius: var(--r); object-fit: cover; flex-shrink: 0; border: 1px solid var(--border); }

    .menu-img-ph { width: 48px; height: 48px; border-radius: var(--r); background: var(--surf2); display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 1px solid var(--border); }

    .menu-info { flex: 1; min-width: 0; }

    .menu-name { font-family: var(--ff-d); font-size: 0.9rem; color: var(--t1); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-weight: 400; }

    .menu-desc { font-size: 0.67rem; color: var(--t3); margin-top: 3px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-family: var(--ff-b); }

    .menu-price { font-family: var(--ff-d); font-size: 0.92rem; color: var(--a); flex-shrink: 0; min-width: 80px; text-align: right; font-weight: 400; }

    .menu-actions { display: flex; gap: 5px; flex-shrink: 0; }

    .btn-ic { width: 30px; height: 30px; border-radius: var(--r); border: 1px solid var(--border); background: var(--surf); cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all .15s; color: var(--t2); }

    .btn-ic:hover { border-color: var(--border2); box-shadow: var(--sh); }
    .btn-ic.ed:hover { background: var(--a-bg); border-color: var(--a-bg2); color: var(--a); }
    .btn-ic.dl:hover { background: var(--red-bg); border-color: rgba(155,28,28,0.2); color: var(--red); }
    .btn-ic i { font-size: 13px; }

    /* ─── ADD FORM ─── */
    .add-card { background: var(--surf); border: 1px solid var(--border); border-radius: var(--r2); padding: 22px; margin-bottom: 18px; display: none; box-shadow: var(--sh2); }
    .add-card.open { display: block; }

    .af-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    .af-full { grid-column: 1 / -1; }

    .af-lbl { font-size: 0.58rem; font-weight: 600; text-transform: uppercase; letter-spacing: .1em; color: var(--t3); margin-bottom: 5px; font-family: var(--ff-b); }

    .af-inp { width: 100%; padding: 9px 12px; background: var(--surf2); border: 1px solid var(--border); border-radius: var(--r); color: var(--t1); font-size: 0.8rem; outline: none; transition: border-color .15s, background .15s; font-family: var(--ff-b); }

    .af-inp:focus { border-color: var(--a); background: var(--surf); }
    .af-inp::placeholder { color: var(--t3); }

    .af-file { display: flex; align-items: center; gap: 8px; padding: 9px 12px; background: var(--surf2); border: 1px dashed var(--border2); border-radius: var(--r); cursor: pointer; font-size: 0.75rem; color: var(--t2); transition: all .15s; width: 100%; font-family: var(--ff-b); }

    .af-file:hover { border-color: var(--a); color: var(--a); }
    .af-file input { display: none; }

    .af-actions { display: flex; gap: 8px; margin-top: 16px; }

    /* ─── BUTTONS ─── */
    .btn-p { padding: 9px 18px; background: var(--sb); border: none; border-radius: var(--r); color: rgba(255,255,255,0.88); font-size: 0.72rem; font-weight: 500; cursor: pointer; transition: all .15s; font-family: var(--ff-b); letter-spacing: .04em; display: inline-flex; align-items: center; gap: 6px; }
    .btn-p:hover { background: var(--sb2); }
    .btn-a { background: var(--a) !important; }
    .btn-a:hover { background: var(--a-l) !important; }

    .btn-s { padding: 9px 16px; background: var(--surf); border: 1px solid var(--border2); border-radius: var(--r); color: var(--t2); font-size: 0.75rem; cursor: pointer; font-family: var(--ff-b); transition: all .15s; font-weight: 500; }
    .btn-s:hover { border-color: var(--t2); color: var(--t1); }

    .btn-open { display: inline-flex; align-items: center; gap: 6px; padding: 7px 14px; background: var(--a); border: none; border-radius: var(--r); color: #fff; font-size: 0.7rem; cursor: pointer; transition: background .15s; font-family: var(--ff-b); font-weight: 500; letter-spacing: .04em; }
    .btn-open:hover { background: var(--a-l); }

    /* ─── TEAM ─── */
    .emp-list { display: flex; flex-direction: column; gap: 7px; }

    .emp-row { display: flex; align-items: center; gap: 13px; background: var(--surf); border: 1px solid var(--border); border-radius: var(--r2); padding: 13px 16px; transition: all .15s; box-shadow: var(--sh); }
    .emp-row:hover { border-color: var(--border2); box-shadow: var(--sh2); }

    .emp-av { width: 38px; height: 38px; border-radius: 50%; background: var(--sb); display: flex; align-items: center; justify-content: center; font-family: var(--ff-d); font-size: 0.88rem; color: rgba(255,255,255,0.7); flex-shrink: 0; letter-spacing: .02em; }

    .emp-info { flex: 1; }
    .emp-name { font-size: 0.84rem; color: var(--t1); font-family: var(--ff-b); font-weight: 500; }
    .emp-meta { font-size: 0.63rem; color: var(--t3); font-family: var(--ff-b); margin-top: 3px; }

    .badge { font-size: 0.58rem; font-weight: 600; padding: 3px 9px; border-radius: 20px; font-family: var(--ff-b); letter-spacing: .07em; text-transform: uppercase; }
    .b-emp { background: rgba(30,64,175,0.07); color: #1e40af; border: 1px solid rgba(30,64,175,0.14); }
    .b-adm { background: var(--a-bg); color: var(--a-d); border: 1px solid var(--a-bg2); }
    .b-cli { background: var(--green-bg); color: var(--green); border: 1px solid rgba(45,106,79,0.16); }

    /* ─── TABLE ─── */
    .tbl-card { background: var(--surf); border: 1px solid var(--border); border-radius: var(--r2); overflow: hidden; box-shadow: var(--sh); }

    .tbl { width: 100%; border-collapse: collapse; }

    .tbl th { font-size: 0.58rem; color: var(--t3); text-transform: uppercase; letter-spacing: .1em; padding: 11px 16px; text-align: left; background: var(--surf2); border-bottom: 1px solid var(--border); font-family: var(--ff-b); font-weight: 600; }

    .tbl td { font-size: 0.76rem; color: var(--t1); padding: 11px 16px; border-bottom: 1px solid var(--border); font-family: var(--ff-b); }

    .tbl tbody tr:last-child td { border-bottom: none; }
    .tbl tbody tr:hover td { background: var(--a-bg); }

    .st-pill { font-size: 0.6rem; font-weight: 600; padding: 3px 9px; border-radius: 20px; font-family: var(--ff-b); letter-spacing: .05em; }

    /* ─── PERIOD TABS ─── */
    .ptabs { display: flex; gap: 6px; margin-bottom: 20px; }

    .ptab { padding: 5px 16px; border-radius: 20px; border: 1px solid var(--border2); background: var(--surf); color: var(--t2); font-size: 0.7rem; font-family: var(--ff-b); cursor: pointer; transition: all .15s; font-weight: 500; }
    .ptab.active { background: var(--sb); color: rgba(255,255,255,0.88); border-color: var(--sb); }
    .ptab:hover:not(.active) { border-color: var(--t2); color: var(--t1); }

    /* ─── PROFILE ─── */
    .profile-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; max-width: 820px; }

    .pcard { background: var(--surf); border: 1px solid var(--border); border-radius: var(--r2); padding: 24px; box-shadow: var(--sh); }

    .pav { width: 74px; height: 74px; border-radius: 50%; background: var(--sb); border: 2px solid var(--border2); display: flex; align-items: center; justify-content: center; font-family: var(--ff-d); font-size: 1.8rem; color: rgba(255,255,255,0.6); overflow: hidden; cursor: pointer; position: relative; transition: border-color .2s; flex-shrink: 0; }
    .pav:hover { border-color: var(--a); }

    .pav-ov { position: absolute; inset: 0; background: rgba(0,0,0,0.4); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity .2s; border-radius: 50%; }
    .pav:hover .pav-ov { opacity: 1; }
    .pav img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }

    .p-inp { width: 100%; padding: 9px 12px; background: var(--surf2); border: 1px solid var(--border); border-radius: var(--r); color: var(--t1); font-size: 0.82rem; outline: none; font-family: var(--ff-b); transition: border-color .15s; }
    .p-inp:focus { border-color: var(--a); background: var(--surf); }

    .p-stat-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }

    .p-stat { background: var(--surf2); border-radius: var(--r); padding: 14px; text-align: center; border: 1px solid var(--border); }
    .p-stat-v { font-family: var(--ff-d); font-size: 1.5rem; color: var(--a); font-weight: 400; }
    .p-stat-l { font-size: 0.58rem; color: var(--t3); font-family: var(--ff-b); text-transform: uppercase; letter-spacing: .08em; margin-top: 3px; }

    .divider { height: 1px; background: var(--border); margin: 18px 0; }

    .section-lbl { font-size: 0.58rem; font-weight: 600; text-transform: uppercase; letter-spacing: .14em; color: var(--t3); font-family: var(--ff-b); margin-bottom: 14px; }

    /* ─── MODAL ─── */
    .mo { position: fixed; inset: 0; background: rgba(13,10,9,0.65); backdrop-filter: blur(6px); z-index: 1000; display: flex; align-items: center; justify-content: center; opacity: 0; pointer-events: none; transition: opacity .2s; }
    .mo.open { opacity: 1; pointer-events: all; }

    .mb { background: var(--surf); border: 1px solid var(--border); border-radius: var(--r2); padding: 28px; width: 100%; max-width: 500px; transform: translateY(12px); transition: transform .22s; max-height: 92vh; overflow-y: auto; box-shadow: 0 20px 60px rgba(0,0,0,0.25); }
    .mo.open .mb { transform: translateY(0); }

    .mo-title { font-family: var(--ff-d); font-size: 1.25rem; font-weight: 400; color: var(--t1); margin-bottom: 4px; }
    .mo-sub   { font-size: 0.72rem; color: var(--t3); margin-bottom: 22px; font-family: var(--ff-b); }

    /* ─── TOAST ─── */
    .toast { position: fixed; bottom: 22px; right: 22px; background: var(--sb); border: 1px solid rgba(255,255,255,0.06); border-radius: var(--r); padding: 11px 18px; font-size: 0.76rem; color: rgba(255,255,255,0.88); box-shadow: 0 8px 28px rgba(0,0,0,0.25); z-index: 2000; transform: translateY(14px); opacity: 0; transition: transform .28s, opacity .28s; display: flex; align-items: center; gap: 9px; font-family: var(--ff-b); font-weight: 500; }
    .toast.show { transform: translateY(0); opacity: 1; }
    .toast.error { background: #7f1d1d; }

    .empty-st { text-align: center; padding: 44px; color: var(--t3); font-family: var(--ff-b); }
    .empty-st-title { font-family: var(--ff-d); font-size: 1.05rem; color: var(--t2); margin-bottom: 6px; }

    .type-tag { font-size: 0.62rem; padding: 2px 8px; border-radius: 6px; background: var(--surf2); color: var(--t2); border: 1px solid var(--border); font-family: var(--ff-b); font-weight: 500; }

    .cat-tag { font-size: 0.58rem; padding: 1px 7px; border-radius: 5px; background: var(--a-bg); color: var(--a-d); border: 1px solid var(--a-bg2); font-family: var(--ff-b); font-weight: 500; margin-right: 5px; }
    </style>
</head>
<body>

@php $au = auth()->user(); $ai = strtoupper(substr($au->name, 0, 2)); @endphp

<div class="root">

    {{-- ── SIDEBAR ── --}}
    <nav class="sb">
        <div class="sb-brand">
            <div class="sb-brand-row">
                <div class="sb-brand-icon">S</div>
                <div>
                    <div class="sb-brand-name">Sternlicht</div>
                    <div class="sb-brand-sub">Administration</div>
                </div>
            </div>
        </div>

        <div class="sb-nav">
            <div class="sb-group">Principal</div>
            <button class="sb-btn active" onclick="showSec('home',this)">
                <i class="ti ti-layout-dashboard"></i> Vue d'ensemble
            </button>
            <button class="sb-btn" onclick="showSec('activite',this)">
                <i class="ti ti-activity"></i> Activité
            </button>
            <button class="sb-btn" onclick="showSec('sales',this)">
                <i class="ti ti-chart-line"></i> Ventes
            </button>

            <div class="sb-group">Gestion</div>
            <button class="sb-btn" onclick="showSec('menu',this)">
                <i class="ti ti-tools-kitchen-2"></i> Menu
            </button>
            <button class="sb-btn" onclick="showSec('employes',this)">
                <i class="ti ti-users"></i> Équipe
            </button>
            <button class="sb-btn" onclick="showSec('profil',this)">
                <i class="ti ti-user-circle"></i> Profil
            </button>
        </div>

        <div class="sb-foot">
            <div class="sb-user">
                <div class="sb-av" id="sbAv">
                    @if($au->profile_photo_path)
                        <img src="{{ asset($au->profile_photo_path) }}" alt="">
                    @else
                        {{ $ai }}
                    @endif
                </div>
                <div style="flex:1;min-width:0">
                    <div class="sb-uname">{{ $au->name }}</div>
                    <div class="sb-urole">Administrateur</div>
                </div>
                <button class="theme-toggle-btn" id="themeToggle" onclick="toggleTheme()" title="Changer le thème">
                    <span id="themeIcon">🌙</span>
                </button>
                <form method="POST" action="{{ route('logout') }}" style="margin:0">
                    @csrf
                    <button type="submit" class="sb-logout">
                        <i class="ti ti-logout" style="font-size:13px"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    {{-- ── MAIN ── --}}
    <div class="main">

        {{-- TOPBAR --}}
        <div class="topbar">
            <div class="topbar-title" id="pageTitle">Vue d'ensemble</div>
            <div class="topbar-date">{{ now()->format('d M Y') }}</div>
            <div class="topbar-chip"
                 onclick="showSec('profil', document.querySelectorAll('.sb-btn')[5])">
                <div class="topbar-av" id="topAv">
                    @if($au->profile_photo_path)
                        <img src="{{ asset($au->profile_photo_path) }}" alt="">
                    @else
                        {{ $ai }}
                    @endif
                </div>
                <span>{{ $au->name }}</span>
            </div>
        </div>

        <div class="content">

            {{-- ══ HOME ══ --}}
            <div class="sec active" id="sec-home">
                <div class="sec-hd">
                    <div class="sec-title">Vue d'ensemble</div>
                    <span style="font-size:0.68rem;color:var(--t3);font-family:var(--ff-b)">Depuis le début</span>
                </div>

                <div class="kpi-row">
                    <div class="kpi">
                        <div class="kpi-label">Revenus livrés</div>
                        <div class="kpi-bar"><div class="kpi-bar-fill" style="width:100%"></div></div>
                        <div class="kpi-val accent">{{ number_format($totalRevenue, 0) }}<span style="font-size:0.9rem"> DH</span></div>
                        <div class="kpi-sub">commandes livrées</div>
                    </div>
                    <div class="kpi">
                        <div class="kpi-label">Aujourd'hui</div>
                        <div class="kpi-bar"><div class="kpi-bar-fill green" style="width:80%"></div></div>
                        <div class="kpi-val">{{ number_format($todayRevenue, 0) }}<span style="font-size:0.9rem;color:var(--t3)"> DH</span></div>
                        <div class="kpi-sub">{{ $todayOrders }} commandes</div>
                    </div>
                    <div class="kpi">
                        <div class="kpi-label">Total commandes</div>
                        <div class="kpi-bar"><div class="kpi-bar-fill dark" style="width:70%"></div></div>
                        <div class="kpi-val">{{ $totalOrders }}</div>
                        <div class="kpi-sub">toutes périodes</div>
                    </div>
                    <div class="kpi">
                        <div class="kpi-label">En cours</div>
                        <div class="kpi-bar"><div class="kpi-bar-fill red" style="width:40%"></div></div>
                        <div class="kpi-val">{{ $pendingOrders }}</div>
                        <div class="kpi-sub">à traiter</div>
                    </div>
                    <div class="kpi">
                        <div class="kpi-label">Équipe</div>
                        <div class="kpi-bar"><div class="kpi-bar-fill dark" style="width:55%"></div></div>
                        <div class="kpi-val">{{ $totalEmployes }}</div>
                        <div class="kpi-sub">{{ $totalClients }} clients</div>
                    </div>
                    <div class="kpi">
                        <div class="kpi-label">Menu</div>
                        <div class="kpi-bar"><div class="kpi-bar-fill green" style="width:65%"></div></div>
                        <div class="kpi-val">{{ $totalFoods }}</div>
                        <div class="kpi-sub">plats actifs</div>
                    </div>
                </div>

                <div class="charts-row">
                    <div class="card">
                        <div class="card-hd">
                            <div class="card-title">Revenus — 7 derniers jours</div>
                            <span class="card-badge">DH</span>
                        </div>
                        <canvas id="chartRevenue" height="90"></canvas>
                    </div>
                    <div class="card">
                        <div class="card-hd">
                            <div class="card-title">Commandes par statut</div>
                        </div>
                        <canvas id="chartStatus" height="170"></canvas>
                    </div>
                </div>

                <div class="card">
                    <div class="card-hd">
                        <div class="card-title">Top plats commandés</div>
                        <span class="card-badge">{{ $topFoods->count() }} plats</span>
                    </div>
                    @php $mx = $topFoods->max('total_qty') ?: 1; @endphp
                    @forelse($topFoods as $idx => $f)
                    <div class="top-row">
                        <div class="top-rank">{{ $idx + 1 }}</div>
                        @if($f->image)
                            <img src="{{ asset('food_img/'.$f->image) }}" class="top-img" alt="">
                        @else
                            <div class="top-img" style="background:var(--surf2)"></div>
                        @endif
                        <div class="top-info">
                            <div class="top-name">{{ $f->Food_name }}</div>
                            <div class="top-cat">{{ $f->category ?? 'Autres' }}</div>
                        </div>
                        <div class="top-bar-wrap">
                            <div class="top-bar" style="width:{{ ($f->total_qty / $mx) * 100 }}%"></div>
                        </div>
                        <div class="top-qty">{{ $f->total_qty }}× · {{ number_format($f->total_revenue, 0) }} DH</div>
                    </div>
                    @empty
                    <div class="empty-st"><div class="empty-st-title">Aucune donnée</div></div>
                    @endforelse
                </div>
            </div>

            {{-- ══ ACTIVITÉ ══ --}}
            <div class="sec" id="sec-activite">
                <div class="sec-hd"><div class="sec-title">Activité récente</div></div>

                <div class="charts-row-2">
                    <div class="card">
                        <div class="card-hd"><div class="card-title">Commandes — 12 mois</div></div>
                        <canvas id="chartMonthly" height="140"></canvas>
                    </div>
                    <div class="card">
                        <div class="card-hd"><div class="card-title">Top plats (volume)</div></div>
                        <canvas id="chartCategories" height="140"></canvas>
                    </div>
                </div>

                <div class="tbl-card">
                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>N°</th><th>Client</th><th>Type</th>
                                <th>Items</th><th>Total</th><th>Statut</th><th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders->take(25) as $order)
                            <tr>
                                <td style="font-family:var(--ff-d);font-size:0.9rem;color:var(--a)">N° {{ $order->daily_number }}</td>
                                <td style="font-weight:500">{{ optional($order->user)->name ?? 'Anonyme' }}</td>
                                <td><span class="type-tag">{{ $order->type === 'dine_in' ? 'Sur place' : ($order->type === 'take_away' ? 'À emporter' : 'Livraison') }}</span></td>
                                <td style="color:var(--t3)">{{ $order->items->count() }}</td>
                                <td style="color:var(--a);font-weight:600">{{ number_format($order->total, 2) }} DH</td>
                                <td><span class="st-pill" style="background:{{ $order->status_color }}12;color:{{ $order->status_color }}">{{ $order->status_label }}</span></td>
                                <td style="color:var(--t3)">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="7" style="text-align:center;padding:24px;color:var(--t3)">Aucune commande</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ══ VENTES ══ --}}
            <div class="sec" id="sec-sales">
                <div class="sec-hd"><div class="sec-title">Ventes & Revenus</div></div>

                <div class="ptabs">
                    <button class="ptab active" onclick="switchP('week',this)">7 jours</button>
                    <button class="ptab" onclick="switchP('year',this)">12 mois</button>
                </div>

                <div class="kpi-row" style="margin-bottom:20px">
                    <div class="kpi">
                        <div class="kpi-label">Revenus livrés</div>
                        <div class="kpi-bar"><div class="kpi-bar-fill" style="width:100%"></div></div>
                        <div class="kpi-val accent">{{ number_format($totalRevenue, 0) }}<span style="font-size:0.9rem"> DH</span></div>
                        <div class="kpi-sub">total</div>
                    </div>
                    <div class="kpi">
                        <div class="kpi-label">Livrées</div>
                        <div class="kpi-bar"><div class="kpi-bar-fill green" style="width:75%"></div></div>
                        <div class="kpi-val">{{ $ordersByStatus['delivered']->count ?? 0 }}</div>
                        <div class="kpi-sub">commandes</div>
                    </div>
                    <div class="kpi">
                        <div class="kpi-label">Aujourd'hui</div>
                        <div class="kpi-bar"><div class="kpi-bar-fill dark" style="width:60%"></div></div>
                        <div class="kpi-val">{{ number_format($todayRevenue, 0) }}<span style="font-size:0.9rem;color:var(--t3)"> DH</span></div>
                        <div class="kpi-sub">{{ $todayOrders }} commandes</div>
                    </div>
                    <div class="kpi">
                        <div class="kpi-label">Panier moyen</div>
                        <div class="kpi-bar"><div class="kpi-bar-fill" style="width:50%"></div></div>
                        <div class="kpi-val">{{ number_format($totalRevenue / max(1, $ordersByStatus['delivered']->count ?? 1), 0) }}<span style="font-size:0.9rem;color:var(--t3)"> DH</span></div>
                        <div class="kpi-sub">par commande</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-hd">
                        <div class="card-title" id="salesTitle">Évolution revenus — 7 jours</div>
                        <span class="card-badge" id="salesTot">{{ number_format($salesByDay->sum('revenue'), 0) }} DH</span>
                    </div>
                    <canvas id="chartSales" height="100"></canvas>
                </div>
            </div>

            {{-- ══ MENU ══ --}}
            <div class="sec" id="sec-menu">
                <div class="sec-hd">
                    <div class="sec-title">Gestion du menu</div>
                    <button class="btn-open" onclick="toggleAdd()">
                        <i class="ti ti-plus" style="font-size:13px"></i> Ajouter un plat
                    </button>
                </div>

                <div class="add-card" id="addCard">
                    <div class="mo-title" style="font-size:1.05rem;margin-bottom:3px">Nouveau plat</div>
                    <div class="mo-sub">Remplissez les informations du plat</div>
                    <form action="{{ route('admin.postAddFood') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="af-grid">
                            <div><div class="af-lbl">Nom *</div><input class="af-inp" type="text" name="Food_name" placeholder="ex: Beef Burger" required></div>
                            <div><div class="af-lbl">Catégorie</div><select class="af-inp" name="category">@foreach(['Burgers','Pizza','Desserts','Boissons','Café','Jus','Pâtes','Salades','Sandwichs','Autres'] as $cat)<option value="{{ $cat }}">{{ $cat }}</option>@endforeach</select></div>
                            <div><div class="af-lbl">Prix (MAD) *</div><input class="af-inp" type="number" name="Food_price" placeholder="95.00" step="0.01" min="0" required></div>
                            <div><div class="af-lbl">Temps prép. (min)</div><input class="af-inp" type="number" name="prep_time" value="15" min="1" max="120"></div>
                            <div class="af-full"><div class="af-lbl">Description</div><input class="af-inp" type="text" name="Food_detail" placeholder="Description courte..."></div>
                            <div class="af-full"><div class="af-lbl">Ingrédients (séparés par virgules)</div><input class="af-inp" type="text" name="ingredients" placeholder="farine, œufs, lait..."></div>
                            <div class="af-full">
                                <div class="af-lbl">Photo</div>
                                <label class="af-file">
                                    <i class="ti ti-photo" style="color:var(--a)"></i>
                                    <span id="afFn">Choisir une image</span>
                                    <input type="file" name="image" accept="image/*" onchange="document.getElementById('afFn').textContent=this.files[0]?.name||'Choisir'">
                                </label>
                            </div>
                        </div>
                        <div class="af-actions">
                            <button type="submit" class="btn-p btn-a"><i class="ti ti-plus" style="font-size:12px"></i> Ajouter</button>
                            <button type="button" class="btn-s" onclick="toggleAdd()">Annuler</button>
                        </div>
                    </form>
                </div>

                <div class="cat-tabs" id="mCats">
                    <button class="cat-tab active" onclick="fMenu('all',this)">Tous ({{ $foods->count() }})</button>
                    @foreach(['Burgers','Pizza','Desserts','Boissons','Café','Jus','Pâtes','Salades','Sandwichs','Autres'] as $cat)
                        @php $c = $foods->where('category', $cat)->count(); @endphp
                        @if($c > 0)
                        <button class="cat-tab" onclick="fMenu('{{ $cat }}',this)">{{ $cat }} ({{ $c }})</button>
                        @endif
                    @endforeach
                </div>

                <div class="menu-list" id="mList">
                    @forelse($foods as $item)
                    <div class="menu-row" data-cat="{{ $item->category ?? 'Autres' }}">
                        @if($item->image)
                            <img src="{{ asset('food_img/'.$item->image) }}" class="menu-img" alt="{{ $item->Food_name }}">
                        @else
                            <div class="menu-img-ph"><i class="ti ti-bowl" style="font-size:17px;color:var(--t3)"></i></div>
                        @endif
                        <div class="menu-info">
                            <div class="menu-name">{{ $item->Food_name }}</div>
                            <div class="menu-desc"><span class="cat-tag">{{ $item->category ?? 'Autres' }}</span>{{ $item->Food_detail ?? '—' }} · {{ $item->prep_time ?? 15 }} min</div>
                        </div>
                        <div class="menu-price">{{ number_format($item->Food_price, 2) }} MAD</div>
                        <div class="menu-actions">
                            <button class="btn-ic ed" onclick="openEF({{ $item->id }},'{{ addslashes($item->Food_name) }}','{{ addslashes($item->Food_detail ?? '') }}','{{ $item->Food_price }}','{{ addslashes(implode(", ", $item->ingredients ?? [])) }}','{{ $item->prep_time ?? 15 }}','{{ $item->category ?? "Autres" }}')"><i class="ti ti-pencil"></i></button>
                            <a href="{{ route('admin.deleteFood', $item->id) }}" class="btn-ic dl" onclick="return confirm('Supprimer ce plat ?')"><i class="ti ti-trash"></i></a>
                        </div>
                    </div>
                    @empty
                    <div class="empty-st"><div class="empty-st-title">Aucun plat</div></div>
                    @endforelse
                </div>
            </div>

            {{-- ══ ÉQUIPE ══ --}}
            <div class="sec" id="sec-employes">
                <div class="sec-hd">
                    <div class="sec-title">Équipe</div>
                    <span style="font-size:0.68rem;color:var(--t3);font-family:var(--ff-b)">{{ $users->count() }} compte(s)</span>
                </div>

                <div class="cat-tabs" style="margin-bottom:14px" id="eCats">
                    <button class="cat-tab active" onclick="fEmps('all',this)">Tous</button>
                    <button class="cat-tab" onclick="fEmps('employe',this)">Employés</button>
                    <button class="cat-tab" onclick="fEmps('admin',this)">Admins</button>
                    <button class="cat-tab" onclick="fEmps('client',this)">Clients</button>
                </div>

                <div class="emp-list">
                    @forelse($users as $emp)
                    <div class="emp-row" data-role="{{ $emp->usertype }}">
                        <div class="emp-av">{{ strtoupper(substr($emp->name, 0, 2)) }}</div>
                        <div class="emp-info">
                            <div class="emp-name">{{ $emp->name }}</div>
                            <div class="emp-meta">{{ $emp->email }} · {{ $emp->created_at->format('d/m/Y') }} · {{ $emp->orders()->count() }} cmd</div>
                        </div>
                        @php $bc = $emp->usertype === 'admin' ? 'b-adm' : ($emp->usertype === 'employe' ? 'b-emp' : 'b-cli'); @endphp
                        <span class="badge {{ $bc }}">{{ $emp->usertype }}</span>
                        <div style="display:flex;gap:5px;margin-left:10px">
                            <button class="btn-ic ed" onclick="openEE({{ $emp->id }},'{{ addslashes($emp->name) }}','{{ $emp->email }}','{{ $emp->usertype }}')"><i class="ti ti-pencil"></i></button>
                            <a href="{{ route('admin.deleteEmploye', $emp->id) }}" class="btn-ic dl" onclick="return confirm('Supprimer ce compte ?')"><i class="ti ti-trash"></i></a>
                        </div>
                    </div>
                    @empty
                    <div class="empty-st"><div class="empty-st-title">Aucun compte</div></div>
                    @endforelse
                </div>
            </div>

            {{-- ══ PROFIL ══ --}}
            <div class="sec" id="sec-profil">
                <div class="sec-hd"><div class="sec-title">Mon profil</div></div>

                <div class="profile-grid">
                    <div class="pcard">
                        <div style="display:flex;align-items:center;gap:16px;margin-bottom:22px">
                            <div class="pav" onclick="document.getElementById('pPhoto').click()">
                                @if($au->profile_photo_path)
                                    <img src="{{ asset($au->profile_photo_path) }}" id="pAvImg" alt="">
                                @else
                                    <span id="pAvInit">{{ $ai }}</span>
                                @endif
                                <div class="pav-ov"><i class="ti ti-camera" style="color:#fff;font-size:18px"></i></div>
                            </div>
                            <input type="file" id="pPhoto" accept="image/*" style="display:none" onchange="prevPhoto(this)">
                            <div>
                                <div style="font-family:var(--ff-d);font-size:1.15rem;color:var(--t1);margin-bottom:3px">{{ $au->name }}</div>
                                <div style="font-size:0.72rem;color:var(--t3);font-family:var(--ff-b);margin-bottom:8px">{{ $au->email }}</div>
                                <span class="badge b-adm">Administrateur</span>
                                <div style="font-size:0.63rem;color:var(--t3);font-family:var(--ff-b);margin-top:6px">Depuis {{ $au->created_at->format('d/m/Y') }}</div>
                            </div>
                        </div>

                        <div class="divider"></div>

                        <div class="p-stat-grid" style="margin-bottom:20px">
                            <div class="p-stat"><div class="p-stat-v">{{ $totalOrders }}</div><div class="p-stat-l">Commandes</div></div>
                            <div class="p-stat"><div class="p-stat-v">{{ $totalFoods }}</div><div class="p-stat-l">Plats</div></div>
                            <div class="p-stat"><div class="p-stat-v">{{ $totalEmployes }}</div><div class="p-stat-l">Employés</div></div>
                            <div class="p-stat"><div class="p-stat-v">{{ number_format($totalRevenue, 0) }}</div><div class="p-stat-l">DH revenus</div></div>
                        </div>

                        <button class="btn-p btn-a" style="width:100%;justify-content:center" onclick="openPE()">
                            <i class="ti ti-edit" style="font-size:13px"></i> Modifier mes informations
                        </button>
                    </div>

                    <div class="pcard">
                        <div class="section-lbl">Sécurité du compte</div>
                        <div style="display:flex;flex-direction:column;gap:10px;margin-bottom:16px">
                            <div><div class="af-lbl">Mot de passe actuel</div><input class="p-inp" type="password" id="cPwd" placeholder="••••••••"></div>
                            <div><div class="af-lbl">Nouveau mot de passe</div><input class="p-inp" type="password" id="nPwd" placeholder="Minimum 8 caractères"></div>
                            <div><div class="af-lbl">Confirmer</div><input class="p-inp" type="password" id="cfPwd" placeholder="••••••••"></div>
                            <button class="btn-p" style="justify-content:center" onclick="chgPwd()"><i class="ti ti-lock" style="font-size:13px"></i> Mettre à jour</button>
                        </div>

                        <div class="divider"></div>

                        <div class="section-lbl">Informations</div>
                        <div style="display:flex;flex-direction:column;gap:0">
                            <div style="display:flex;justify-content:space-between;padding:9px 0;border-bottom:1px solid var(--border);font-size:0.76rem;font-family:var(--ff-b)"><span style="color:var(--t3)">Rôle</span><span style="color:var(--a);font-weight:600">Administrateur</span></div>
                            <div style="display:flex;justify-content:space-between;padding:9px 0;border-bottom:1px solid var(--border);font-size:0.76rem;font-family:var(--ff-b)"><span style="color:var(--t3)">Membre depuis</span><span>{{ $au->created_at->format('d/m/Y') }}</span></div>
                            <div style="display:flex;justify-content:space-between;padding:9px 0;font-size:0.76rem;font-family:var(--ff-b)"><span style="color:var(--t3)">Connexion</span><span>{{ now()->format('d/m/Y H:i') }}</span></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- ══ MODAL EDIT FOOD ══ --}}
<div class="mo" id="mFood">
    <div class="mb">
        <div class="mo-title">Modifier le plat</div>
        <div class="mo-sub">Mettez à jour les informations</div>
        <form id="fFood" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="af-grid">
                <div><div class="af-lbl">Nom *</div><input class="af-inp" type="text" id="efN" name="Food_name" required></div>
                <div><div class="af-lbl">Catégorie</div><select class="af-inp" id="efC" name="category">@foreach(['Burgers','Pizza','Desserts','Boissons','Café','Jus','Pâtes','Salades','Sandwichs','Autres'] as $cat)<option value="{{ $cat }}">{{ $cat }}</option>@endforeach</select></div>
                <div><div class="af-lbl">Prix (MAD) *</div><input class="af-inp" type="number" id="efP" name="Food_price" step="0.01" min="0" required></div>
                <div><div class="af-lbl">Temps prép. (min)</div><input class="af-inp" type="number" id="efT" name="prep_time" min="1" max="120"></div>
                <div class="af-full"><div class="af-lbl">Description</div><input class="af-inp" type="text" id="efD" name="Food_detail"></div>
                <div class="af-full"><div class="af-lbl">Ingrédients</div><input class="af-inp" type="text" id="efI" name="ingredients" placeholder="farine, œufs..."></div>
                <div class="af-full">
                    <div class="af-lbl">Photo (optionnel)</div>
                    <label class="af-file">
                        <i class="ti ti-photo" style="color:var(--a)"></i>
                        <span id="efFn2">Choisir une image</span>
                        <input type="file" name="image" accept="image/*" onchange="document.getElementById('efFn2').textContent=this.files[0]?.name||'Choisir'">
                    </label>
                </div>
            </div>
            <div class="af-actions" style="margin-top:16px">
                <button type="submit" class="btn-p btn-a"><i class="ti ti-check" style="font-size:12px"></i> Sauvegarder</button>
                <button type="button" class="btn-s" onclick="closeEF()">Annuler</button>
            </div>
        </form>
    </div>
</div>

{{-- ══ MODAL EDIT EMPLOYÉ ══ --}}
<div class="mo" id="mEmp">
    <div class="mb" style="max-width:360px">
        <div class="mo-title">Modifier le compte</div>
        <div class="mo-sub" id="mEmpSub"></div>
        <div style="display:flex;flex-direction:column;gap:10px;margin-bottom:20px">
            <div><div class="af-lbl">Nom complet</div><input class="af-inp" type="text" id="eEN"></div>
            <div><div class="af-lbl">Email</div><input class="af-inp" type="email" id="eEE"></div>
            <div><div class="af-lbl">Rôle</div><select class="af-inp" id="eER"><option value="employe">Employé</option><option value="client">Client</option><option value="admin">Admin</option></select></div>
        </div>
        <div class="af-actions">
            <button class="btn-p btn-a" onclick="saveEE()"><i class="ti ti-check" style="font-size:12px"></i> Sauvegarder</button>
            <button class="btn-s" onclick="closeEE()">Annuler</button>
        </div>
    </div>
</div>

{{-- ══ MODAL PROFIL ══ --}}
<div class="mo" id="mProfil">
    <div class="mb" style="max-width:400px">
        <div class="mo-title">Modifier le profil</div>
        <div class="mo-sub">Mettez à jour vos informations</div>

        <div style="display:flex;align-items:center;gap:13px;margin-bottom:20px;padding:14px;background:var(--surf2);border-radius:var(--r);border:1px solid var(--border)">
            <div id="mPAv" style="width:50px;height:50px;border-radius:50%;overflow:hidden;border:1px solid var(--border2);flex-shrink:0;background:var(--sb);display:flex;align-items:center;justify-content:center;font-family:var(--ff-d);font-size:1.1rem;color:rgba(255,255,255,0.6)">
                @if($au->profile_photo_path)
                    <img src="{{ asset($au->profile_photo_path) }}" style="width:100%;height:100%;object-fit:cover">
                @else
                    {{ $ai }}
                @endif
            </div>
            <label style="display:inline-flex;align-items:center;gap:5px;padding:6px 12px;background:var(--sb);border-radius:var(--r);color:rgba(255,255,255,0.8);font-size:0.68rem;cursor:pointer;font-family:var(--ff-b);font-weight:500;transition:background .15s">
                <i class="ti ti-camera" style="font-size:12px"></i> Changer la photo
                <input type="file" id="mPhoto" accept="image/*" style="display:none" onchange="prevMPhoto(this)">
            </label>
        </div>

        <div style="display:flex;flex-direction:column;gap:10px;margin-bottom:20px">
            <div><div class="af-lbl">Nom complet</div><input class="af-inp" type="text" id="pName" value="{{ $au->name }}"></div>
            <div><div class="af-lbl">Email</div><input class="af-inp" type="email" id="pEmail" value="{{ $au->email }}"></div>
        </div>

        <div class="af-actions">
            <button class="btn-p btn-a" style="flex:2;justify-content:center" onclick="saveProfil()"><i class="ti ti-check" style="font-size:12px"></i> Sauvegarder</button>
            <button class="btn-s" onclick="closePE()">Annuler</button>
        </div>
    </div>
</div>

<div class="toast" id="toast"></div>

<script>
/* ══ THEME ══ */
function updateThemeIcon(){
    var icon = document.getElementById('themeIcon');
    if(!icon) return;
    icon.textContent = document.documentElement.classList.contains('theme-dark') ? '☀️' : '🌙';
}
function toggleTheme(){
    var isDark = document.documentElement.classList.toggle('theme-dark');
    localStorage.setItem('sternlicht-theme', isDark ? 'dark' : 'light');
    updateThemeIcon();
    updateChartsTheme();
}
updateThemeIcon();

const CSRF    = document.querySelector('meta[name="csrf-token"]').content;
let pendPhoto = null;

const titles = {
    home: 'Vue d\'ensemble', activite: 'Activité récente',
    sales: 'Ventes & Revenus', menu: 'Gestion du menu',
    employes: 'Équipe', profil: 'Mon profil',
};

function showSec(id, btn) {
    document.querySelectorAll('.sec').forEach(s   => s.classList.remove('active'));
    document.querySelectorAll('.sb-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('sec-' + id).classList.add('active');
    if (btn) btn.classList.add('active');
    document.getElementById('pageTitle').textContent = titles[id] || id;
    if (id === 'home')     { chartRevenue.resize(); chartStatus.resize(); }
    if (id === 'activite') { chartMonthly.resize(); chartCategories.resize(); }
    if (id === 'sales')    { chartSales.resize(); }
}

function toggleAdd() { document.getElementById('addCard').classList.toggle('open'); }

function fMenu(cat, btn) {
    document.querySelectorAll('#mCats .cat-tab').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('#mList .menu-row').forEach(r => {
        r.style.display = (cat === 'all' || r.dataset.cat === cat) ? '' : 'none';
    });
}

function fEmps(role, btn) {
    document.querySelectorAll('#eCats .cat-tab').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.emp-row').forEach(r => {
        r.style.display = (role === 'all' || r.dataset.role === role) ? '' : 'none';
    });
}

function openEF(id, name, detail, price, ing, prep, cat) {
    document.getElementById('efN').value = name;
    document.getElementById('efD').value = detail;
    document.getElementById('efP').value = price;
    document.getElementById('efI').value = ing  || '';
    document.getElementById('efT').value = prep || 15;
    document.getElementById('efC').value = cat  || 'Autres';
    document.getElementById('fFood').action = '/admin/editFood/' + id;
    document.getElementById('mFood').classList.add('open');
}

function closeEF() { document.getElementById('mFood').classList.remove('open'); }
document.getElementById('mFood').addEventListener('click', e => { if (e.target === document.getElementById('mFood')) closeEF(); });

let curEId = null;

function openEE(id, name, email, role) {
    curEId = id;
    document.getElementById('mEmpSub').textContent = email;
    document.getElementById('eEN').value  = name;
    document.getElementById('eEE').value  = email;
    document.getElementById('eER').value  = role;
    document.getElementById('mEmp').classList.add('open');
}

function closeEE() { document.getElementById('mEmp').classList.remove('open'); }
document.getElementById('mEmp').addEventListener('click', e => { if (e.target === document.getElementById('mEmp')) closeEE(); });

function saveEE() {
    fetch('/admin/employe/' + curEId + '/role', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify({ usertype: document.getElementById('eER').value }),
    })
    .then(r => r.json())
    .then(d => { closeEE(); showToast(d.message || 'Rôle mis à jour.', 'success'); setTimeout(() => location.reload(), 1200); })
    .catch(() => showToast('Erreur réseau', 'error'));
}

function openPE()  { document.getElementById('mProfil').classList.add('open'); }
function closePE() { document.getElementById('mProfil').classList.remove('open'); }
document.getElementById('mProfil').addEventListener('click', e => { if (e.target === document.getElementById('mProfil')) closePE(); });

function prevPhoto(inp) {
    if (!inp.files || !inp.files[0]) return;
    pendPhoto = inp.files[0];
    const url = URL.createObjectURL(inp.files[0]);
    document.querySelector('.pav').innerHTML = '<img src="' + url + '" style="width:100%;height:100%;object-fit:cover;border-radius:50%"><div class="pav-ov"><i class="ti ti-camera" style="color:#fff;font-size:18px"></i></div>';
    ['sbAv','topAv'].forEach(function(id) {
        const el = document.getElementById(id);
        if (el) el.innerHTML = '<img src="' + url + '" style="width:100%;height:100%;object-fit:cover;border-radius:50%">';
    });
}

function prevMPhoto(inp) {
    if (!inp.files || !inp.files[0]) return;
    pendPhoto = inp.files[0];
    const url = URL.createObjectURL(inp.files[0]);
    document.getElementById('mPAv').innerHTML = '<img src="' + url + '" style="width:100%;height:100%;object-fit:cover;border-radius:50%">';
}

async function saveProfil() {
    const name  = document.getElementById('pName').value.trim();
    const email = document.getElementById('pEmail').value.trim();
    if (!name || !email) { showToast('Champs requis', 'error'); return; }
    const fd = new FormData();
    fd.append('name', name);
    fd.append('email', email);
    if (pendPhoto) fd.append('photo', pendPhoto);
    try {
        const res = await fetch('{{ route("profile.update") }}', {
            method: 'POST', headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }, body: fd,
        });
        const d = await res.json();
        if (d.success) { closePE(); showToast('Profil mis à jour !', 'success'); setTimeout(() => location.reload(), 1400); }
        else { showToast(d.message || 'Erreur', 'error'); }
    } catch(e) { showToast('Erreur réseau', 'error'); }
}

async function chgPwd() {
    const cur = document.getElementById('cPwd').value;
    const np  = document.getElementById('nPwd').value;
    const cp  = document.getElementById('cfPwd').value;
    if (!cur || !np) { showToast('Champs requis', 'error'); return; }
    if (np !== cp)   { showToast('Mots de passe différents', 'error'); return; }
    if (np.length < 8) { showToast('Minimum 8 caractères', 'error'); return; }
    try {
        const res = await fetch('/admin/change-password', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
            body: JSON.stringify({ current_password: cur, password: np, password_confirmation: cp }),
        });
        const d = await res.json();
        if (d.success) { showToast('Mot de passe mis à jour !', 'success'); ['cPwd','nPwd','cfPwd'].forEach(id => document.getElementById(id).value = ''); }
        else { showToast(d.message || 'Erreur', 'error'); }
    } catch(e) { showToast('Erreur réseau', 'error'); }
}

/* ══ CHARTS ══ */
function getChartColors() {
    const dark = document.documentElement.classList.contains('theme-dark');
    return {
        accent:    dark ? '#C8956C' : '#C0392B',
        accentBg:  dark ? 'rgba(200,149,108,0.10)' : 'rgba(192,57,43,0.08)',
        border:    dark ? 'rgba(200,149,108,0.18)' : '#E8E1D8',
        text:      dark ? 'rgba(242,237,229,0.38)' : '#7A5C4E',
        dark:      dark ? '#1A1614' : '#1A1614',
        darkBg:    dark ? 'rgba(242,237,229,0.06)' : 'rgba(26,22,20,0.06)',
        palette:   dark
            ? ['#C8956C','#F2EDE5','#9B6B48','#4ade80','rgba(242,237,229,0.38)','#f87171']
            : ['#C0392B','#1A1614','#9B6B48','#2D6A4F','#7A5C4E','#7f1d1d'],
    };
}

const salesDays    = @json($salesByDay->pluck('date'));
const salesRevs    = @json($salesByDay->pluck('revenue'));
const monthLabels  = @json($monthLabels);
const monthCounts  = @json($salesByMonth->pluck('count'));
const monthRevs    = @json($salesByMonth->pluck('revenue'));
const topNames     = @json($topFoods->pluck('Food_name')->take(7));
const topQtys      = @json($topFoods->pluck('total_qty')->take(7));
const statusLabels = @json($ordersByStatus->keys());
const statusCounts = @json($ordersByStatus->pluck('count'));

function applyDefaults() {
    const C = getChartColors();
    Chart.defaults.color       = C.text;
    Chart.defaults.borderColor = C.border;
    Chart.defaults.font.family = 'Jost, Inter, system-ui, sans-serif';
    Chart.defaults.font.size   = 11;
    Chart.defaults.plugins.tooltip.backgroundColor = '#1A1614';
    Chart.defaults.plugins.tooltip.titleColor      = 'rgba(255,255,255,0.88)';
    Chart.defaults.plugins.tooltip.bodyColor       = 'rgba(255,255,255,0.6)';
    Chart.defaults.plugins.tooltip.padding         = 10;
    Chart.defaults.plugins.tooltip.cornerRadius    = 6;
    Chart.defaults.plugins.tooltip.displayColors   = false;
}

applyDefaults();

let C = getChartColors();

const chartRevenue = new Chart(document.getElementById('chartRevenue'), {
    type: 'line',
    data: { labels: salesDays, datasets: [{ data: salesRevs, borderColor: C.accent, backgroundColor: C.accentBg, fill: true, tension: 0.42, pointBackgroundColor: C.accent, pointBorderColor: '#fff', pointBorderWidth: 2, pointRadius: 4, pointHoverRadius: 6, borderWidth: 2 }] },
    options: { responsive: true, plugins: { legend: { display: false } }, scales: { x: { grid: { display: false }, ticks: { maxTicksLimit: 7 } }, y: { grid: { color: C.border }, beginAtZero: true, ticks: { maxTicksLimit: 5 } } } },
});

const chartStatus = new Chart(document.getElementById('chartStatus'), {
    type: 'doughnut',
    data: { labels: statusLabels, datasets: [{ data: statusCounts, backgroundColor: C.palette, borderWidth: 0, hoverOffset: 6 }] },
    options: { responsive: true, plugins: { legend: { position: 'right', labels: { font: { size: 11 }, padding: 14, usePointStyle: true, pointStyleWidth: 8 } } }, cutout: '64%' },
});

const chartMonthly = new Chart(document.getElementById('chartMonthly'), {
    type: 'bar',
    data: { labels: monthLabels, datasets: [{ data: monthCounts, backgroundColor: C.darkBg, borderColor: C.dark, borderWidth: 1, borderRadius: 5, hoverBackgroundColor: C.dark }] },
    options: { responsive: true, plugins: { legend: { display: false } }, scales: { x: { grid: { display: false } }, y: { grid: { color: C.border }, beginAtZero: true, ticks: { maxTicksLimit: 5 } } } },
});

const chartCategories = new Chart(document.getElementById('chartCategories'), {
    type: 'bar',
    data: { labels: topNames, datasets: [{ data: topQtys, backgroundColor: C.palette, borderRadius: 5 }] },
    options: { indexAxis: 'y', responsive: true, plugins: { legend: { display: false } }, scales: { x: { grid: { color: C.border }, beginAtZero: true, ticks: { maxTicksLimit: 5 } }, y: { grid: { display: false } } } },
});

const chartSales = new Chart(document.getElementById('chartSales'), {
    type: 'line',
    data: { labels: salesDays, datasets: [{ data: salesRevs, borderColor: C.accent, backgroundColor: C.accentBg, fill: true, tension: 0.42, pointBackgroundColor: C.accent, pointBorderColor: '#fff', pointBorderWidth: 2, pointRadius: 4, borderWidth: 2 }] },
    options: { responsive: true, plugins: { legend: { display: false } }, scales: { x: { grid: { display: false }, ticks: { maxTicksLimit: 7 } }, y: { grid: { color: C.border }, beginAtZero: true, ticks: { maxTicksLimit: 5 } } } },
});

function updateChartsTheme() {
    C = getChartColors();
    applyDefaults();
    [chartRevenue, chartSales].forEach(ch => {
        ch.data.datasets[0].borderColor      = C.accent;
        ch.data.datasets[0].backgroundColor  = C.accentBg;
        ch.data.datasets[0].pointBackgroundColor = C.accent;
        ch.options.scales.y.grid.color       = C.border;
        ch.update();
    });
    chartStatus.data.datasets[0].backgroundColor = C.palette;
    chartStatus.update();
    chartMonthly.data.datasets[0].backgroundColor  = C.darkBg;
    chartMonthly.data.datasets[0].borderColor      = C.dark;
    chartMonthly.data.datasets[0].hoverBackgroundColor = C.dark;
    chartMonthly.options.scales.y.grid.color = C.border;
    chartMonthly.update();
    chartCategories.data.datasets[0].backgroundColor = C.palette;
    chartCategories.options.scales.x.grid.color = C.border;
    chartCategories.update();
}

function switchP(p, btn) {
    document.querySelectorAll('.ptab').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    const d = p === 'week'
        ? { labels: salesDays,   data: salesRevs,  title: '7 jours',  tot: salesRevs.reduce((a,b) => a + parseFloat(b||0), 0) }
        : { labels: monthLabels, data: monthRevs,  title: '12 mois',  tot: monthRevs.reduce((a,b) => a + parseFloat(b||0), 0) };
    chartSales.data.labels             = d.labels;
    chartSales.data.datasets[0].data  = d.data;
    chartSales.update();
    document.getElementById('salesTitle').textContent = 'Évolution revenus — ' + d.title;
    document.getElementById('salesTot').textContent   = Math.round(d.tot).toLocaleString() + ' DH';
}

function showToast(msg, type = 'success') {
    const el = document.getElementById('toast');
    el.textContent = msg;
    el.className   = 'toast ' + type + ' show';
    setTimeout(() => el.classList.remove('show'), 3500);
}
</script>

</body>
</html>