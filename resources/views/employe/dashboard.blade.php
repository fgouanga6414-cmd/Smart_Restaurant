<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Employe — Sternlicht</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=Jost:wght@300;400;500;600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Syne:wght@400;600;700&display=swap" rel="stylesheet">

    <script>
        (function(){
            var saved = localStorage.getItem('sternlicht-theme') || 'dark';
            if(saved === 'light') document.documentElement.classList.add('theme-light');
        })();
    </script>

    <style>
    :root {
        --red:       #c43535;
        --red-dk:    #9B6B48;
        --red-lt:    rgba(200,149,108,0.12);
        --red-md:    rgba(200,149,108,0.28);
        --bg:        #0D0B0A;
        --surf:      #131110;
        --surf2:     #1A1614;
        --border:    rgba(200,149,108,0.18);
        --border2:   rgba(200,149,108,0.28);
        --text:      #F2EDE5;
        --text2:     rgba(242,237,229,0.65);
        --text3:     rgba(242,237,229,0.38);
        --success:   #16A34A;
        --warn:      #D97706;
        --danger:    #C8956C;
        --ff-h:      'Cormorant Garamond', Georgia, serif;
        --ff-b:      'Jost', sans-serif;
        --r:         12px;
        --shadow:    0 1px 4px rgba(0,0,0,0.3), 0 1px 2px rgba(0,0,0,0.2);
        --shadow-md: 0 4px 20px rgba(0,0,0,0.4);
    }

    /* ══ LIGHT MODE ══ */
    html.theme-light {
        --red:       #C0392B;
        --red-dk:    #922B21;
        --red-lt:    rgba(192,57,43,0.10);
        --red-md:    rgba(192,57,43,0.25);
        --bg:        #F8F5F0;
        --surf:      #FFFFFF;
        --surf2:     #F2EDE5;
        --border:    rgba(192,57,43,0.18);
        --border2:   rgba(192,57,43,0.28);
        --text:      #0D0A09;
        --text2:     #3D2B1F;
        --text3:     #7A5C4E;
        --shadow:    0 1px 4px rgba(0,0,0,0.07), 0 1px 2px rgba(0,0,0,0.04);
        --shadow-md: 0 4px 20px rgba(0,0,0,0.09);
    }

    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
    html,body{height:100%;overflow:hidden;}
    body{background:var(--bg);font-family:var(--ff-b);color:var(--text);}
    .emp-root{display:flex;height:100vh;overflow:hidden;}

    /* SIDEBAR */
    .emp-sb{width:70px;background:var(--surf);border-right:1px solid var(--border);display:flex;flex-direction:column;align-items:center;padding:18px 0;gap:4px;flex-shrink:0;z-index:10;box-shadow:2px 0 8px rgba(0,0,0,0.04);}
    .emp-sb-logo{width:44px;height:44px;background:var(--red);border-radius:14px;display:flex;align-items:center;justify-content:center;font-family:var(--ff-h);font-size:1.2rem;font-weight:700;color:#fff;margin-bottom:20px;box-shadow:0 4px 12px rgba(200,149,108,0.3);}
    .emp-nav{width:48px;height:48px;border-radius:var(--r);border:none;background:none;color:var(--text3);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .18s;position:relative;text-decoration:none;}
    .emp-nav:hover{background:var(--red-lt);color:var(--red);}
    .emp-nav.active{background:var(--red);color:#fff;box-shadow:0 4px 12px rgba(200,149,108,0.3);}
    .emp-nav i{font-size:20px;}
    .emp-nav .tip{position:absolute;left:62px;background:var(--text);color:var(--bg);font-size:0.72rem;white-space:nowrap;padding:5px 11px;border-radius:8px;opacity:0;pointer-events:none;transition:opacity .15s;z-index:999;font-family:var(--ff-b);font-weight:600;}
    .emp-nav:hover .tip{opacity:1;}
    .emp-nav .notif-dot{position:absolute;top:8px;right:8px;width:8px;height:8px;border-radius:50%;background:var(--red);border:2px solid var(--surf);}
    .emp-sb-foot{margin-top:auto;}

    /* THEME TOGGLE */
    .theme-toggle-btn{width:36px;height:36px;border-radius:var(--r);border:1.5px solid var(--border2);background:var(--surf2);cursor:pointer;font-size:1rem;display:flex;align-items:center;justify-content:center;transition:all .18s;flex-shrink:0;}
    .theme-toggle-btn:hover{border-color:var(--red);background:var(--red-lt);}

    /* MAIN */
    .emp-main{flex:1;display:flex;flex-direction:column;overflow:hidden;}

    /* TOPBAR */
    .emp-topbar{height:64px;background:var(--surf);border-bottom:1px solid var(--border);display:flex;align-items:center;padding:0 24px;gap:14px;flex-shrink:0;box-shadow:0 1px 4px rgba(0,0,0,0.04);}
    .emp-topbar-title{font-family:var(--ff-h);font-size:1.1rem;font-weight:700;color:var(--text);flex:1;letter-spacing:-.02em;}
    .emp-topbar-title span{color:var(--red);}
    .emp-topbar-right{display:flex;align-items:center;gap:10px;}
    .emp-chip{display:flex;align-items:center;gap:9px;background:var(--surf2);border:1.5px solid var(--border2);border-radius:26px;padding:4px 16px 4px 4px;font-size:0.8rem;font-family:var(--ff-b);font-weight:600;color:var(--text);}
    .emp-avatar{width:30px;height:30px;border-radius:50%;background:var(--red);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.72rem;color:#fff;}
    .emp-logout-btn{display:flex;align-items:center;gap:6px;padding:7px 14px;border-radius:var(--r);border:1.5px solid var(--red-md);background:var(--red-lt);color:var(--red);font-size:0.76rem;cursor:pointer;transition:all .15s;text-decoration:none;font-family:var(--ff-b);font-weight:700;}
    .emp-logout-btn:hover{background:var(--red);color:#fff;}

    /* CONTENT */
    .emp-content{flex:1;overflow-y:auto;padding:24px;scrollbar-width:thin;scrollbar-color:var(--border2) transparent;}
    .emp-section{display:none;}
    .emp-section.active{display:block;}

    /* SECTION HEADER */
    .sec-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;}
    .sec-title{font-family:var(--ff-h);font-size:1.3rem;font-weight:700;color:var(--text);letter-spacing:-.02em;}

    /* STATS */
    .emp-stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(155px,1fr));gap:14px;margin-bottom:24px;}
    .emp-stat{background:var(--surf);border:1.5px solid var(--border);border-radius:var(--r);padding:18px 20px;box-shadow:var(--shadow);transition:box-shadow .18s;}
    .emp-stat:hover{box-shadow:var(--shadow-md);}
    .emp-stat-label{font-size:0.62rem;color:var(--text3);text-transform:uppercase;letter-spacing:.1em;margin-bottom:8px;font-family:var(--ff-b);font-weight:700;}
    .emp-stat-val{font-family:var(--ff-h);font-size:1.9rem;font-weight:700;color:var(--text);line-height:1;}
    .emp-stat-sub{font-size:0.68rem;color:var(--red);margin-top:5px;font-family:var(--ff-b);font-weight:600;}

    /* MENU LIST */
    .menu-list{display:flex;flex-direction:column;gap:10px;}
    .menu-row{display:flex;align-items:center;gap:14px;background:var(--surf);border:1.5px solid var(--border);border-radius:var(--r);padding:12px 16px;transition:all .18s;box-shadow:var(--shadow);}
    .menu-row:hover{border-color:var(--red-md);box-shadow:var(--shadow-md);}
    .menu-row-img{width:50px;height:50px;border-radius:10px;object-fit:cover;flex-shrink:0;}
    .menu-row-img-placeholder{width:50px;height:50px;border-radius:10px;background:var(--red-lt);border:1.5px dashed var(--red-md);display:flex;align-items:center;justify-content:center;flex-shrink:0;}
    .menu-row-img-placeholder i{font-size:20px;color:var(--red);}
    .menu-row-info{flex:1;min-width:0;}
    .menu-row-name{font-family:var(--ff-h);font-size:0.95rem;font-weight:700;color:var(--text);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
    .menu-row-desc{font-size:0.7rem;color:var(--text3);margin-top:3px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-family:var(--ff-b);}
    .menu-row-price{font-family:var(--ff-h);font-size:0.95rem;font-weight:700;color:var(--red);flex-shrink:0;min-width:75px;text-align:right;}
    .menu-row-actions{display:flex;gap:7px;flex-shrink:0;}
    .btn-icon{width:34px;height:34px;border-radius:10px;border:1.5px solid var(--border2);background:var(--surf2);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .15s;}
    .btn-icon.edit{color:var(--text2);}
    .btn-icon.edit:hover{background:var(--surf);border-color:var(--text2);color:var(--text);}
    .btn-icon.del{color:var(--red);}
    .btn-icon.del:hover{background:var(--red-lt);border-color:var(--red-md);}
    .btn-icon i{font-size:14px;}

    /* FORM AJOUT */
    .add-food-card{background:var(--surf);border:1.5px solid var(--border);border-radius:var(--r);padding:22px;margin-bottom:20px;display:none;box-shadow:var(--shadow);}
    .add-food-card.open{display:block;}
    .af-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
    .af-grid-full{grid-column:1/-1;}
    .af-label{font-size:0.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--text3);margin-bottom:5px;font-family:var(--ff-b);}
    .af-inp{width:100%;padding:10px 14px;background:var(--surf2);border:1.5px solid var(--border2);border-radius:10px;color:var(--text);font-size:0.82rem;outline:none;transition:border-color .15s,box-shadow .15s;font-family:var(--ff-b);}
    .af-inp:focus{border-color:var(--red);box-shadow:0 0 0 3px rgba(200,149,108,0.12);}
    .af-inp::placeholder{color:var(--text3);}
    .af-file-label{display:flex;align-items:center;gap:9px;padding:10px 14px;background:var(--red-lt);border:1.5px dashed var(--red-md);border-radius:10px;cursor:pointer;font-size:0.78rem;color:var(--red);transition:all .15s;width:100%;font-family:var(--ff-b);font-weight:600;}
    .af-file-label:hover{background:var(--red);color:#fff;}
    .af-file-label i{font-size:16px;}
    .af-file-label input{display:none;}
    .af-actions{display:flex;gap:10px;margin-top:16px;}
    .btn-primary{padding:10px 22px;background:var(--red);border:none;border-radius:10px;color:#fff;font-size:0.76rem;font-weight:700;cursor:pointer;transition:all .15s;font-family:var(--ff-b);letter-spacing:.06em;text-transform:uppercase;display:inline-flex;align-items:center;gap:7px;box-shadow:0 4px 12px rgba(200,149,108,0.3);}
    .btn-primary:hover{background:var(--red-dk);transform:translateY(-1px);}
    .btn-cancel{padding:10px 22px;background:var(--surf2);border:1.5px solid var(--border2);border-radius:10px;color:var(--text2);font-size:0.78rem;cursor:pointer;transition:all .15s;font-family:var(--ff-b);font-weight:600;}
    .btn-cancel:hover{border-color:var(--red);color:var(--red);}
    .btn-open-add{display:flex;align-items:center;gap:7px;padding:9px 18px;background:var(--red-lt);border:1.5px solid var(--red-md);border-radius:var(--r);color:var(--red);font-size:0.76rem;font-weight:700;cursor:pointer;transition:all .15s;font-family:var(--ff-b);letter-spacing:.06em;text-transform:uppercase;}
    .btn-open-add:hover{background:var(--red);color:#fff;}
    .btn-open-add i{font-size:15px;}

    /* COMMANDES */
    .order-list{display:flex;flex-direction:column;gap:12px;}
    .order-card{background:var(--surf);border:1.5px solid var(--border);border-radius:var(--r);padding:16px 18px;box-shadow:var(--shadow);}
    .order-card-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;}
    .order-id{font-size:0.76rem;color:var(--text3);font-family:var(--ff-b);}
    .order-badge{font-size:0.65rem;font-weight:700;padding:4px 12px;border-radius:20px;letter-spacing:.07em;text-transform:uppercase;font-family:var(--ff-b);}
    .order-items-list{display:flex;flex-direction:column;gap:4px;margin-bottom:12px;}
    .order-item-row{display:flex;justify-content:space-between;font-size:0.78rem;color:var(--text2);font-family:var(--ff-b);}
    .order-item-row span:last-child{color:var(--red);font-weight:700;}
    .order-total-row{display:flex;justify-content:space-between;font-size:0.86rem;font-weight:700;color:var(--text);padding-top:10px;border-top:1.5px solid var(--border);font-family:var(--ff-b);}
    .order-total-row span:last-child{color:var(--red);font-family:var(--ff-h);}
    .order-meta{font-size:0.7rem;color:var(--text3);margin-bottom:10px;font-family:var(--ff-b);}
    .status-select{background:var(--surf2);border:1.5px solid var(--border2);border-radius:10px;color:var(--text);font-size:0.76rem;padding:7px 12px;cursor:pointer;outline:none;font-family:var(--ff-b);transition:border-color .15s;}
    .status-select:focus{border-color:var(--red);}
    .btn-update-status{padding:7px 16px;background:var(--red);border:none;border-radius:10px;color:#fff;font-size:0.72rem;font-weight:700;cursor:pointer;transition:all .15s;font-family:var(--ff-b);letter-spacing:.07em;text-transform:uppercase;box-shadow:0 3px 8px rgba(200,149,108,0.25);}
    .btn-update-status:hover{background:var(--red-dk);}

    /* PROFIL */
    .profile-card{background:var(--surf);border:1.5px solid var(--border);border-radius:var(--r);padding:26px;max-width:440px;box-shadow:var(--shadow);}
    .profile-top{display:flex;align-items:center;gap:18px;margin-bottom:22px;}
    .profile-avatar{width:60px;height:60px;border-radius:50%;background:var(--red);display:flex;align-items:center;justify-content:center;font-family:var(--ff-h);font-size:1.5rem;font-weight:700;color:#fff;flex-shrink:0;box-shadow:0 4px 12px rgba(200,149,108,0.3);}
    .profile-name{font-family:var(--ff-h);font-size:1.2rem;font-weight:700;color:var(--text);}
    .profile-email{font-size:0.76rem;color:var(--text3);margin-top:3px;font-family:var(--ff-b);}
    .profile-role{display:inline-flex;align-items:center;gap:5px;margin-top:7px;font-size:0.65rem;font-weight:700;padding:4px 12px;border-radius:20px;background:var(--red-lt);border:1.5px solid var(--red-md);color:var(--red);font-family:var(--ff-b);letter-spacing:.08em;text-transform:uppercase;}
    .profile-stats{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
    .profile-stat{background:var(--surf2);border-radius:10px;padding:14px;text-align:center;border:1.5px solid var(--border);}
    .profile-stat-val{font-family:var(--ff-h);font-size:1.5rem;font-weight:700;color:var(--red);}
    .profile-stat-label{font-size:0.65rem;color:var(--text3);margin-top:3px;font-family:var(--ff-b);font-weight:700;letter-spacing:.08em;text-transform:uppercase;}

    /* MODAL */
    .modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,0.6);backdrop-filter:blur(4px);z-index:1000;display:flex;align-items:center;justify-content:center;opacity:0;pointer-events:none;transition:opacity .22s;}
    .modal-overlay.open{opacity:1;pointer-events:all;}
    .modal-box{background:var(--surf);border-radius:var(--r);padding:28px;width:100%;max-width:460px;box-shadow:0 20px 60px rgba(0,0,0,0.3);transform:translateY(16px);transition:transform .22s;border:1px solid var(--border);}
    .modal-overlay.open .modal-box{transform:translateY(0);}
    .modal-title{font-family:var(--ff-h);font-size:1.3rem;font-weight:700;color:var(--text);margin-bottom:18px;letter-spacing:-.02em;}

    /* TOAST */
    .emp-toast{position:fixed;bottom:26px;right:26px;background:var(--surf2);color:var(--text);border:1px solid var(--border);border-radius:var(--r);padding:13px 20px;font-size:0.82rem;font-weight:600;box-shadow:0 8px 28px rgba(0,0,0,0.2);z-index:2000;transform:translateY(14px);opacity:0;transition:transform .28s,opacity .28s;display:flex;align-items:center;gap:10px;font-family:var(--ff-b);}
    .emp-toast.show{transform:translateY(0);opacity:1;}
    .emp-toast.success{background:var(--success);color:#fff;border-color:var(--success);}
    .emp-toast.error{background:var(--red);color:#fff;border-color:var(--red);}

    /* EMPTY */
    .empty-state{text-align:center;padding:42px;color:var(--text3);font-size:0.84rem;font-family:var(--ff-b);}
    .empty-state .lbl{font-family:var(--ff-h);font-size:1.1rem;font-weight:700;color:var(--text);margin-bottom:8px;}

    /* CUISINE */
    .cat-tabs{display:flex;flex-wrap:wrap;gap:7px;margin-bottom:20px;}
    .cat-tab{padding:7px 16px;border-radius:24px;border:1.5px solid var(--border2);background:var(--surf);color:var(--text2);font-size:0.76rem;font-family:var(--ff-b);font-weight:600;cursor:pointer;transition:all .18s;}
    .cat-tab:hover{border-color:var(--red-md);color:var(--red);background:var(--red-lt);}
    .cat-tab.active{background:var(--red);border-color:var(--red);color:#fff;box-shadow:0 4px 12px rgba(200,149,108,0.25);}
    .cat-tab .cnt{display:inline-flex;align-items:center;justify-content:center;width:18px;height:18px;border-radius:50%;background:rgba(255,255,255,0.25);color:#fff;font-size:0.6rem;font-weight:700;margin-left:5px;}
    .cat-tab:not(.active) .cnt{background:var(--red-lt);color:var(--red);}
    .cuisine-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:14px;}
    .cuisine-cat-card{background:var(--surf);border:1.5px solid var(--border);border-radius:var(--r);overflow:hidden;box-shadow:var(--shadow);}
    .cuisine-cat-header{padding:14px 16px;border-bottom:1.5px solid var(--border);display:flex;align-items:center;justify-content:space-between;background:var(--surf2);}
    .cuisine-cat-title{font-family:var(--ff-h);font-size:0.95rem;font-weight:700;color:var(--text);}
    .cuisine-item-row{padding:12px 16px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:12px;cursor:pointer;transition:background .15s;}
    .cuisine-item-row:last-child{border-bottom:none;}
    .cuisine-item-row:hover{background:var(--red-lt);}
    .cuisine-item-row.prepared{opacity:0.45;}
    .cuisine-item-check{width:24px;height:24px;border-radius:50%;border:2px solid var(--border2);display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all .2s;}
    .cuisine-item-check.done{background:var(--success);border-color:var(--success);}
    .cuisine-item-check.done i{color:#fff;}
    .cuisine-item-check i{font-size:12px;color:var(--text3);}
    .cuisine-item-info{flex:1;}
    .cuisine-item-name{font-size:0.84rem;color:var(--text);font-family:var(--ff-b);font-weight:600;}
    .cuisine-item-order{font-size:0.69rem;color:var(--text3);font-family:var(--ff-b);margin-top:2px;}
    .cuisine-item-qty{font-size:0.76rem;font-weight:700;color:var(--red);font-family:var(--ff-b);}
    .cuisine-go-order{font-size:0.64rem;padding:4px 10px;border-radius:8px;background:var(--red-lt);border:1.5px solid var(--red-md);color:var(--red);cursor:pointer;transition:all .15s;font-family:var(--ff-b);font-weight:700;white-space:nowrap;}
    .cuisine-go-order:hover{background:var(--red);color:#fff;}

    /* ITEMS CLIQUABLES */
    .order-item-clickable{display:flex;justify-content:space-between;align-items:center;font-size:0.78rem;color:var(--text2);font-family:var(--ff-b);padding:8px 10px;border-radius:10px;cursor:pointer;transition:background .15s;margin-bottom:3px;}
    .order-item-clickable:hover{background:var(--red-lt);}
    .order-item-clickable.prepared{opacity:0.5;}
    .order-item-clickable.prepared .item-name{text-decoration:line-through;}
    </style>
</head>
<body>

@if(session('success'))
<div class="emp-toast success show" id="empToast" style="opacity:1;transform:translateY(0)">
    <i class="ti ti-circle-check"></i> {{ session('success') }}
</div>
@endif

@php $totalActiveItems = array_sum(array_map('count', $itemsByCategory)); @endphp

<div class="emp-root">

    <nav class="emp-sb">
        <div class="emp-sb-logo">S</div>
        <button class="emp-nav active" onclick="showSec('dashboard',this)">
            <i class="ti ti-layout-dashboard"></i><span class="tip">Dashboard</span>
        </button>
        <button class="emp-nav" onclick="showSec('menu',this)">
            <i class="ti ti-tools-kitchen-2"></i><span class="tip">Menu</span>
        </button>
        <button class="emp-nav" onclick="showSec('commandes',this)">
            <i class="ti ti-clipboard-list"></i><span class="tip">Commandes</span>
        </button>
        <button class="emp-nav" onclick="showSec('cuisine',this)">
            <i class="ti ti-chef-hat"></i>
            @if($totalActiveItems > 0)<span class="notif-dot"></span>@endif
            <span class="tip">Cuisine</span>
        </button>
        <button class="emp-nav" onclick="showSec('profil',this)">
            <i class="ti ti-user"></i><span class="tip">Profil</span>
        </button>
        <div class="emp-sb-foot">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="emp-nav" style="color:var(--red)">
                    <i class="ti ti-logout"></i><span class="tip">Déconnexion</span>
                </button>
            </form>
        </div>
    </nav>

    <div class="emp-main">
        <div class="emp-topbar">
            <div class="emp-topbar-title"><span>Sternlicht</span> — Espace Employé</div>
            <div class="emp-topbar-right">
                <div class="emp-chip">
                    <div class="emp-avatar">{{ strtoupper(substr(auth()->user()->name,0,2)) }}</div>
                    <span>{{ auth()->user()->name }}</span>
                </div>
                <button class="theme-toggle-btn" id="themeToggle" onclick="toggleTheme()" title="Changer le thème">
                    <span id="themeIcon">☀️</span>
                </button>
                <form method="POST" action="{{ route('logout') }}" style="margin:0">
                    @csrf
                    <button type="submit" class="emp-logout-btn">
                        <i class="ti ti-logout"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="emp-content">

            {{-- DASHBOARD --}}
            <div class="emp-section active" id="sec-dashboard">
                <div class="emp-stats">
                    <div class="emp-stat">
                        <div class="emp-stat-label">Plats au menu</div>
                        <div class="emp-stat-val">{{ $foods->count() }}</div>
                        <div class="emp-stat-sub">items actifs</div>
                    </div>
                    <div class="emp-stat">
                        <div class="emp-stat-label">Commandes totales</div>
                        <div class="emp-stat-val">{{ $orders->count() }}</div>
                        <div class="emp-stat-sub">toutes périodes</div>
                    </div>
                    <div class="emp-stat">
                        <div class="emp-stat-label">En attente</div>
                        <div class="emp-stat-val">{{ $orders->where('status','pending')->count() }}</div>
                        <div class="emp-stat-sub">à traiter</div>
                    </div>
                    <div class="emp-stat">
                        <div class="emp-stat-label">En préparation</div>
                        <div class="emp-stat-val">{{ $orders->whereIn('status',['confirmed','preparing'])->count() }}</div>
                        <div class="emp-stat-sub">en cours</div>
                    </div>
                </div>
                <div class="sec-header">
                    <div class="sec-title">Dernières commandes</div>
                    <button class="btn-open-add" onclick="showSec('commandes',document.querySelectorAll('.emp-nav')[2])">
                        <i class="ti ti-arrow-right"></i> Toutes les commandes
                    </button>
                </div>
                <div class="order-list">
                    @forelse($orders->take(5) as $order)
                    <div class="order-card">
                        <div class="order-card-top">
                            <div class="order-id">
                                <span style="font-size:1.05rem;font-weight:700;color:var(--red);font-family:var(--ff-h)">#{{ $order->daily_number }}</span>
                                — {{ $order->created_at->format('d/m H:i') }}
                                — {{ $order->type === 'dine_in' ? 'Sur place' : ($order->type === 'take_away' ? 'À emporter' : 'Livraison') }}
                            </div>
                            <span class="order-badge" style="background:{{ $order->status_color }}18;color:{{ $order->status_color }}">{{ $order->status_label }}</span>
                        </div>
                        <div class="order-items-list">
                            @foreach($order->items as $item)
                            <div class="order-item-row">
                                <span>{{ optional($item->food)->Food_name ?? 'Plat supprimé' }} × {{ $item->quantity }}</span>
                                <span>{{ $item->subtotal }} DH</span>
                            </div>
                            @endforeach
                        </div>
                        <div class="order-total-row">
                            <span>{{ optional($order->user)->name ?? 'Client anonyme' }}</span>
                            <span>{{ $order->total }} DH</span>
                        </div>
                    </div>
                    @empty
                    <div class="empty-state"><div class="lbl">Aucune commande</div>Les commandes apparaîtront ici.</div>
                    @endforelse
                </div>
            </div>

            {{-- MENU --}}
            <div class="emp-section" id="sec-menu">
                <div class="sec-header">
                    <div class="sec-title">Gestion du menu</div>
                    <button class="btn-open-add" onclick="toggleAddForm()">
                        <i class="ti ti-plus"></i> Ajouter un plat
                    </button>
                </div>
                <div class="add-food-card" id="addFoodCard">
                    <div class="modal-title" style="margin-bottom:16px;font-size:1.1rem">Nouveau plat</div>
                    <form action="{{ route('employe.addFood') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="af-grid">
                            <div><div class="af-label">Nom du plat</div><input class="af-inp" type="text" name="Food_name" placeholder="ex: Tagine Poulet" required></div>
                            <div><div class="af-label">Prix (MAD)</div><input class="af-inp" type="number" name="Food_price" placeholder="95" step="0.01" min="0" required></div>
                            <div><div class="af-label">Temps de préparation (min)</div><input class="af-inp" type="number" name="prep_time" value="15" min="1" max="120" placeholder="15"></div>
                            <div>
                                <div class="af-label">Catégorie</div>
                                <select class="af-inp" name="category">
                                    @foreach(['Burgers','Pizza','Desserts','Boissons','Café','Jus','Pâtes','Salades','Sandwichs','Autres'] as $cat)
                                    <option value="{{ $cat }}">{{ $cat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="af-grid-full"><div class="af-label">Description</div><input class="af-inp" type="text" name="Food_detail" placeholder="Ingrédients, goût..."></div>
                            <div class="af-grid-full">
                                <div class="af-label">Ingrédients (séparés par virgules)</div>
                                <input class="af-inp" type="text" name="ingredients" placeholder="farine, oeufs, lait, noix, gluten...">
                                <div style="font-size:0.62rem;color:var(--text3);margin-top:4px;font-family:var(--ff-b)">Utilisés pour détecter les allergies clients.</div>
                            </div>
                            <div class="af-grid-full">
                                <div class="af-label">Photo</div>
                                <label class="af-file-label">
                                    <i class="ti ti-photo"></i>
                                    <span id="afFileName">Choisir une image</span>
                                    <input type="file" name="image" accept="image/*" onchange="document.getElementById('afFileName').textContent=this.files[0]?.name||'Choisir une image'">
                                </label>
                            </div>
                        </div>
                        <div class="af-actions">
                            <button type="submit" class="btn-primary"><i class="ti ti-plus" style="font-size:13px"></i> Confirmer</button>
                            <button type="button" class="btn-cancel" onclick="toggleAddForm()">Annuler</button>
                        </div>
                    </form>
                </div>
                <div class="menu-list">
                    @forelse($foods as $item)
                    <div class="menu-row" id="food-row-{{ $item->id }}">
                        @if($item->image)
                            <img src="{{ asset('food_img/'.$item->image) }}" class="menu-row-img" alt="{{ $item->Food_name }}">
                        @else
                            <div class="menu-row-img-placeholder"><i class="ti ti-bowl"></i></div>
                        @endif
                        <div class="menu-row-info">
                            <div class="menu-row-name">{{ $item->Food_name }}</div>
                            <div class="menu-row-desc">
                                <span style="color:var(--red);font-size:0.63rem;padding:2px 8px;border-radius:8px;background:var(--red-lt);margin-right:6px;font-weight:700">{{ $item->category ?? 'Autres' }}</span>
                                {{ $item->Food_detail ?? '—' }} — <span style="color:var(--red);font-weight:600">{{ $item->prep_time ?? 15 }} min</span>
                            </div>
                        </div>
                        <div class="menu-row-price">{{ number_format($item->Food_price,2) }} MAD</div>
                        <div class="menu-row-actions">
                            <button class="btn-icon edit" title="Modifier"
                                onclick="openEdit({{ $item->id }},'{{ addslashes($item->Food_name) }}','{{ addslashes($item->Food_detail ?? '') }}','{{ $item->Food_price }}','{{ addslashes(implode(", ", $item->ingredients ?? [])) }}','{{ $item->prep_time ?? 15 }}','{{ $item->category ?? 'Autres' }}')">
                                <i class="ti ti-pencil"></i>
                            </button>
                            <a href="{{ route('employe.deleteFood', $item->id) }}" class="btn-icon del" title="Supprimer" onclick="return confirm('Supprimer ce plat ?')">
                                <i class="ti ti-trash"></i>
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="empty-state"><div class="lbl">Aucun plat</div>Ajoutez votre premier plat au menu.</div>
                    @endforelse
                </div>
            </div>

            {{-- COMMANDES --}}
            <div class="emp-section" id="sec-commandes">
                <div class="sec-header"><div class="sec-title">Toutes les commandes</div></div>
                <div class="order-list">
                    @forelse($orders as $order)
                    <div class="order-card" id="order-card-{{ $order->id }}">
                        <div class="order-card-top">
                            <div>
                                <div class="order-id"><span style="font-size:1.05rem;font-weight:700;color:var(--red);font-family:var(--ff-h)">#{{ $order->daily_number }}</span></div>
                                <div class="order-meta">{{ $order->created_at->format('d/m/Y H:i') }} &mdash; {{ $order->type === 'dine_in' ? 'Sur place' : ($order->type === 'take_away' ? 'À emporter' : 'Livraison') }} &mdash; {{ optional($order->user)->name ?? 'Client anonyme' }}</div>
                            </div>
                            <span class="order-badge" id="badge-{{ $order->id }}" style="background:{{ $order->status_color }}18;color:{{ $order->status_color }}">{{ $order->status_label }}</span>
                        </div>
                        <div style="margin-bottom:12px">
                            @foreach($order->items as $item)
                            <div class="order-item-clickable {{ $item->prepared ? 'prepared' : '' }}" id="item-row-{{ $item->id }}" onclick="toggleItemPrepared({{ $item->id }})">
                                <span>
                                    <span id="item-check-{{ $item->id }}" style="margin-right:6px;color:{{ $item->prepared ? 'var(--success)' : 'var(--text3)' }}">{{ $item->prepared ? '✓' : '○' }}</span>
                                    <span class="item-name">{{ optional($item->food)->Food_name ?? 'Plat supprimé' }} × {{ $item->quantity }}</span>
                                    @if($item->food && $item->food->category)
                                    <span style="font-size:0.62rem;color:var(--red);margin-left:6px;padding:2px 7px;border-radius:7px;background:var(--red-lt);font-weight:700">{{ $item->food->category }}</span>
                                    @endif
                                </span>
                                <span style="color:var(--red);font-weight:700">{{ $item->subtotal }} DH</span>
                            </div>
                            @endforeach
                        </div>
                        <div class="order-total-row" style="margin-bottom:12px"><span>Total</span><span>{{ $order->total }} DH</span></div>
                        <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap">
                            <select class="status-select" id="sel-{{ $order->id }}">
                                @foreach(['pending'=>'En attente','confirmed'=>'Confirmée','preparing'=>'En préparation','ready'=>'Prête','delivered'=>'Livrée','cancelled'=>'Annulée'] as $val => $lbl)
                                <option value="{{ $val }}" {{ $order->status === $val ? 'selected' : '' }}>{{ $lbl }}</option>
                                @endforeach
                            </select>
                            <button class="btn-update-status" onclick="updateStatus({{ $order->id }})">Mettre à jour</button>
                        </div>
                    </div>
                    @empty
                    <div class="empty-state"><div class="lbl">Aucune commande</div>Les commandes des clients apparaîtront ici.</div>
                    @endforelse
                </div>
            </div>

            {{-- CUISINE --}}
            <div class="emp-section" id="sec-cuisine">
                <div class="sec-header"><div class="sec-title">Cuisine — Items en cours</div></div>
                @if(count($itemsByCategory) === 0)
                <div class="empty-state"><div class="lbl">Aucun item en cours</div>Les items des commandes actives apparaîtront ici.</div>
                @else
                <div class="cat-tabs">
                    <button class="cat-tab active" onclick="filterCat('all',this)">Tout <span class="cnt">{{ $totalActiveItems }}</span></button>
                    @foreach($itemsByCategory as $cat => $items)
                    <button class="cat-tab" onclick="filterCat('{{ Str::slug($cat) }}',this)">{{ $cat }} <span class="cnt">{{ count($items) }}</span></button>
                    @endforeach
                </div>
                <div class="cuisine-grid" id="cuisineGrid">
                    @foreach($itemsByCategory as $cat => $items)
                    <div class="cuisine-cat-card" data-cat="{{ Str::slug($cat) }}">
                        <div class="cuisine-cat-header">
                            <span class="cuisine-cat-title">{{ $cat }}</span>
                            <span style="font-size:0.7rem;color:var(--text3);font-family:var(--ff-b);font-weight:600">{{ count($items) }} item(s)</span>
                        </div>
                        @foreach($items as $item)
                        <div class="cuisine-item-row {{ $item['prepared'] ? 'prepared' : '' }}" id="cuisine-item-{{ $item['item_id'] }}">
                            <div class="cuisine-item-check {{ $item['prepared'] ? 'done' : '' }}" id="cuisine-check-{{ $item['item_id'] }}" onclick="toggleItemPrepared({{ $item['item_id'] }})">
                                <i class="ti {{ $item['prepared'] ? 'ti-check' : 'ti-circle' }}"></i>
                            </div>
                            <div class="cuisine-item-info">
                                <div class="cuisine-item-name">{{ $item['food_name'] }}</div>
                                <div class="cuisine-item-order">N° {{ $item['daily_number'] }} <span style="color:{{ $item['status_color'] }}">— {{ $item['status_label'] }}</span></div>
                            </div>
                            <div class="cuisine-item-qty">×{{ $item['quantity'] }}</div>
                            <button class="cuisine-go-order" onclick="goToOrder({{ $item['order_id'] }})">Voir</button>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            {{-- PROFIL --}}
            <div class="emp-section" id="sec-profil">
                <div class="sec-header"><div class="sec-title">Mon profil</div></div>
                <div class="profile-card">
                    <div class="profile-top">
                        <div class="profile-avatar">{{ strtoupper(substr(auth()->user()->name,0,2)) }}</div>
                        <div>
                            <div class="profile-name">{{ auth()->user()->name }}</div>
                            <div class="profile-email">{{ auth()->user()->email }}</div>
                            <div class="profile-role"><i class="ti ti-briefcase" style="font-size:11px"></i> Employé</div>
                        </div>
                    </div>
                    <div class="profile-stats">
                        <div class="profile-stat"><div class="profile-stat-val">{{ $foods->count() }}</div><div class="profile-stat-label">Plats gérés</div></div>
                        <div class="profile-stat"><div class="profile-stat-val">{{ $orders->where('status','delivered')->count() }}</div><div class="profile-stat-label">Commandes livrées</div></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- MODAL EDIT --}}
<div class="modal-overlay" id="editModal">
    <div class="modal-box">
        <div class="modal-title">Modifier le plat</div>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="af-grid">
                <div><div class="af-label">Nom du plat</div><input class="af-inp" type="text" id="editName" name="Food_name" required></div>
                <div><div class="af-label">Prix (MAD)</div><input class="af-inp" type="number" id="editPrice" name="Food_price" step="0.01" min="0" required></div>
                <div><div class="af-label">Temps de préparation (min)</div><input class="af-inp" type="number" id="editPrepTime" name="prep_time" min="1" max="120" placeholder="15"></div>
                <div>
                    <div class="af-label">Catégorie</div>
                    <select class="af-inp" id="editCategory" name="category">
                        @foreach(['Burgers','Pizza','Desserts','Boissons','Café','Jus','Pâtes','Salades','Sandwichs','Autres'] as $cat)
                        <option value="{{ $cat }}">{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="af-grid-full"><div class="af-label">Description</div><input class="af-inp" type="text" id="editDetail" name="Food_detail"></div>
                <div class="af-grid-full"><div class="af-label">Ingrédients</div><input class="af-inp" type="text" id="editIngredients" name="ingredients" placeholder="farine, oeufs, lait..."></div>
                <div class="af-grid-full">
                    <div class="af-label">Nouvelle photo (optionnel)</div>
                    <label class="af-file-label">
                        <i class="ti ti-photo"></i>
                        <span id="editFileName">Choisir une image</span>
                        <input type="file" name="image" accept="image/*" onchange="document.getElementById('editFileName').textContent=this.files[0]?.name||'Choisir une image'">
                    </label>
                </div>
            </div>
            <div class="af-actions" style="margin-top:16px">
                <button type="submit" class="btn-primary"><i class="ti ti-check" style="font-size:13px"></i> Sauvegarder</button>
                <button type="button" class="btn-cancel" onclick="closeEdit()">Annuler</button>
            </div>
        </form>
    </div>
</div>

<div class="emp-toast" id="empToastJs"></div>

<script>
/* ══ THEME ══ */
function updateThemeIcon(){
    var icon = document.getElementById('themeIcon');
    if(!icon) return;
    icon.textContent = document.documentElement.classList.contains('theme-light') ? '🌙' : '☀️';
}
function toggleTheme(){
    var isLight = document.documentElement.classList.toggle('theme-light');
    localStorage.setItem('sternlicht-theme', isLight ? 'light' : 'dark');
    updateThemeIcon();
}
updateThemeIcon();

const CSRF = document.querySelector('meta[name="csrf-token"]').content;

function showSec(id, btn) {
    document.querySelectorAll('.emp-section').forEach(s => s.classList.remove('active'));
    document.querySelectorAll('.emp-nav').forEach(b => b.classList.remove('active'));
    document.getElementById('sec-' + id).classList.add('active');
    if (btn) btn.classList.add('active');
}

function toggleAddForm() { document.getElementById('addFoodCard').classList.toggle('open'); }

function openEdit(id, name, detail, price, ingredients, prepTime, category) {
    document.getElementById('editName').value        = name;
    document.getElementById('editDetail').value      = detail;
    document.getElementById('editPrice').value       = price;
    document.getElementById('editIngredients').value = ingredients || '';
    document.getElementById('editPrepTime').value    = prepTime || 15;
    document.getElementById('editCategory').value    = category || 'Autres';
    document.getElementById('editForm').dataset.id   = id;
    document.getElementById('editModal').classList.add('open');
}

function closeEdit() { document.getElementById('editModal').classList.remove('open'); }

document.getElementById('editForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = this.dataset.id;
    fetch('/employe/updateFood/' + id, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF },
        body: new FormData(this),
    })
    .then(r => r.json())
    .then(data => { closeEdit(); showToast(data.message || 'Plat modifié.', 'success'); setTimeout(() => location.reload(), 1200); })
    .catch(() => showToast('Erreur réseau', 'error'));
});

document.getElementById('editModal').addEventListener('click', function(e) { if (e.target === this) closeEdit(); });

function filterCat(cat, btn) {
    document.querySelectorAll('.cat-tab').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.cuisine-cat-card').forEach(card => {
        card.style.display = (cat === 'all' || card.dataset.cat === cat) ? '' : 'none';
    });
}

function toggleItemPrepared(itemId) {
    fetch('/employe/item/' + itemId + '/prepared', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF, 'Content-Type': 'application/json' },
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            const row = document.getElementById('item-row-' + itemId);
            const chk = document.getElementById('item-check-' + itemId);
            if (row) row.classList.toggle('prepared', data.prepared);
            if (chk) { chk.textContent = data.prepared ? '✓' : '○'; chk.style.color = data.prepared ? 'var(--success)' : 'var(--text3)'; }
            const cuisineRow = document.getElementById('cuisine-item-' + itemId);
            const cuisineChk = document.getElementById('cuisine-check-' + itemId);
            if (cuisineRow) cuisineRow.classList.toggle('prepared', data.prepared);
            if (cuisineChk) { cuisineChk.classList.toggle('done', data.prepared); cuisineChk.innerHTML = data.prepared ? '<i class="ti ti-check"></i>' : '<i class="ti ti-circle"></i>'; }
            showToast(data.prepared ? 'Item marqué préparé ✓' : 'Item retiré', 'success');
        }
    })
    .catch(() => showToast('Erreur réseau', 'error'));
}

function goToOrder(orderId) {
    showSec('commandes', document.querySelectorAll('.emp-nav')[2]);
    setTimeout(() => {
        const card = document.getElementById('order-card-' + orderId);
        if (card) card.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }, 100);
}

const statusColors = { pending:'#f59e0b', confirmed:'#3b82f6', preparing:'#C8956C', ready:'#16A34A', delivered:'#6b7280', cancelled:'#ef4444' };
const statusLabels = { pending:'En attente', confirmed:'Confirmée', preparing:'En préparation', ready:'Prête', delivered:'Livrée', cancelled:'Annulée' };

function updateStatus(orderId) {
    const status = document.getElementById('sel-' + orderId).value;
    fetch(`/orders/${orderId}/status`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify({ status }),
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            const badge = document.getElementById('badge-' + orderId);
            const col = statusColors[status] || '#6b7280';
            if (badge) { badge.textContent = statusLabels[status] || status; badge.style.color = col; badge.style.background = col + '18'; }
            showToast('Statut mis à jour : ' + (statusLabels[status] || status), 'success');
        } else { showToast('Erreur lors de la mise à jour', 'error'); }
    })
    .catch(() => showToast('Erreur réseau', 'error'));
}

const t = document.getElementById('empToast');
if (t) setTimeout(() => { t.style.opacity='0'; t.style.transform='translateY(16px)'; }, 3200);

function showToast(msg, type = 'success') {
    const el = document.getElementById('empToastJs');
    el.textContent = msg;
    el.className = 'emp-toast ' + type + ' show';
    setTimeout(() => el.classList.remove('show'), 3400);
}
</script>
</body>
</html>