<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Smart Restaurant</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --accent:       #C8956C;
            --accent-light: #E8B49A;
            --accent-dark:  #9B6B48;
            --dark-bg:      #0D0B0A;
            --dark-surf:    #131110;
            --dark-card:    #1A1614;
            --text:       #f2f2f2;
            --text-muted: rgba(242,237,229,0.52);
            --border:       rgba(200,149,108,0.18);
            --ff-d: 'Cormorant Garamond', Georgia, serif;
            --ff-b: 'Jost', sans-serif;
        }

        /* ══ LIGHT MODE ══ */
        html.theme-light {
    --accent:       #C0392B;
    --accent-light: #E74C3C;
    --accent-dark:  #922B21;
    --dark-bg:      #F8F5F0;
    --dark-surf:    #FFFFFF;
    --dark-card:    #F2EDE5;
    --text:         #0D0A09;
    --text-muted:   #4A3728;   /* ← ici seulement, pas dans :root */
    --border:       rgba(192,57,43,0.2);
}
        html.theme-light body { background: var(--dark-bg); color: var(--text); }
        html.theme-light .custom-navbar { background: rgba(248,245,240,0); }
        html.theme-light .custom-navbar.scrolled { background: rgba(248,245,240,0.96); backdrop-filter: blur(22px); border-bottom-color: var(--border); }
        html.theme-light #page-loader { background: var(--dark-bg); }
        html.theme-light .loader-brand { color: var(--text); }
        html.theme-light .brand-txt { color: var(--text); }
        html.theme-light .nav-links a { color: var(--text); }
        html.theme-light .parallax-divider::after { background: rgba(248,245,240,0.45); }
        html.theme-light .parallax-text { color: rgba(26,18,16,0.85); }
        html.theme-light #about { background: var(--dark-surf); }
        html.theme-light .about-txt-col { background: var(--dark-surf); }
        html.theme-light #gallary { background: var(--dark-bg); }
        html.theme-light #blog { background: var(--dark-bg); }
        html.theme-light #order-section { background: var(--dark-surf); }
        html.theme-light .order-cart { background: var(--dark-card); }
        html.theme-light .cart-item-row { background: var(--dark-card); }
        html.theme-light #testmonial { background: var(--dark-bg); }
        html.theme-light .review-card { background: var(--dark-card); }
        html.theme-light #contact { background: var(--dark-surf); }
        html.theme-light .contact-txt-col { background: var(--dark-surf); }
        html.theme-light .footer-main { background: var(--dark-surf); }
        html.theme-light .footer-copy { background: var(--dark-bg); }
        html.theme-light #toast { background: var(--dark-card); color: var(--text); }
        html.theme-light #orderConfirmModal > div { background: #F8F5F0; border-color: rgba(155,107,72,0.4); }
        html.theme-light #orderConfirmModal .confirm-number { color: #9B6B48; }
        html.theme-light .order-panel-empty { border-color: var(--border); color: var(--text-muted); }
        /* Texte muted plus lisible en mode clair */
html.theme-light { --text-muted: rgba(26,18,16,0.70); }

/* Cartes menu en mode clair */
html.theme-light .menu-card { background: #FFFFFF; box-shadow: 0 2px 12px rgba(0,0,0,0.08); }
html.theme-light .menu-card:hover { border-color: rgba(192,57,43,0.5); box-shadow: 0 12px 32px rgba(192,57,43,0.15); }
html.theme-light .menu-card-footer { border-top-color: rgba(26,18,16,0.1); }
html.theme-light .qty-control { background: rgba(26,18,16,0.06); border-color: rgba(26,18,16,0.15); }
html.theme-light .qty-btn { color: #C0392B; }
html.theme-light .carousel-dot { background: rgba(26,18,16,0.18); }
        /* ══ LIGHT MODE — lisibilité du texte ══ */

/* Texte principal et muted */
html.theme-light .hero-sub,
html.theme-light .nav-links a,
html.theme-light .brand-txt { color: var(--text); }

/* Sections et contenus généraux */
html.theme-light .about-txt-col p,
html.theme-light .contact-txt-col p,
html.theme-light .contact-info-row span,
html.theme-light .footer-main p { color: rgba(26,18,16,0.72); }

/* Titres de section */
html.theme-light .sec-ttl,
html.theme-light .about-txt-col h2,
html.theme-light .contact-txt-col h3 { color: #1A1210; }

/* Carte reviews */
html.theme-light .review-text { color: rgba(26,18,16,0.72); }
html.theme-light .review-meta strong { color: #1A1210; }
html.theme-light .review-meta span { color: rgba(26,18,16,0.55); }

/* Panier et commande */
html.theme-light .cart-item-name { color: #1A1210; }
html.theme-light .cart-item-uprice,
html.theme-light .cart-empty-msg,
html.theme-light .panel-label,
html.theme-light .order-type-label { color: rgba(26,18,16,0.55); }
html.theme-light .ctr { color: rgba(26,18,16,0.55); }
html.theme-light .ctr.final { color: #1A1210; }
html.theme-light .cart-title { color: #1A1210; }

/* Totaux et résumé panier */
html.theme-light .cart-summary-line { color: rgba(26,18,16,0.65); }
html.theme-light .cart-summary-line .csp { color: #1A1210; }

/* Footer copyright */
html.theme-light .footer-copy { color: rgba(26,18,16,0.55); }

/* Boutons quantité */
html.theme-light .cqb { color: #1A1210; border-color: rgba(155,107,72,0.35); }

/* Texte du héro (reste blanc sur photo) */
html.theme-light .hero-title { color: #fff; }
html.theme-light .hero-sub   { color: rgba(255,255,255,0.75); }
/* ── Texte visible en mode clair ── */
html.theme-light .about-txt-col p,
html.theme-light .contact-txt-col p,
html.theme-light .contact-info-row span,
html.theme-light .footer-main p,
html.theme-light .review-text,
html.theme-light .review-meta span,
html.theme-light .cart-item-uprice,
html.theme-light .cart-empty-msg,
html.theme-light .panel-label,
html.theme-light .order-type-label,
html.theme-light .ctr,
html.theme-light .cart-summary-line,
html.theme-light .footer-copy,
html.theme-light .menu-card-desc { 
   
}

html.theme-light .menu-card-name,
html.theme-light .cart-title,
html.theme-light .review-meta strong,
html.theme-light .ctr.final,
html.theme-light .sec-ttl,
html.theme-light .contact-txt-col h3,
html.theme-light .cart-item-name { 

}

        /* Bouton toggle */
        .theme-toggle-btn {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--text);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .3s;
            margin-left: .5rem;
            flex-shrink: 0;
        }
        .theme-toggle-btn:hover {
            border-color: var(--accent);
            background: rgba(200,149,108,0.1);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body { background: var(--dark-bg); color: var(--text); font-family: var(--ff-b); font-weight: 300; overflow-x: hidden; }

        /* PAGE LOADER */
        #page-loader {
            position: fixed; inset: 0; z-index: 9999; background: var(--dark-bg);
            display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 1.5rem;
            transition: opacity .6s ease, visibility .6s ease;
        }
        #page-loader.hidden { opacity: 0; visibility: hidden; pointer-events: none; }
        .loader-brand { font-family: var(--ff-d); font-size: 2.8rem; font-weight: 300; letter-spacing: .08em; color: var(--text); animation: loaderPulse 1.4s ease-in-out infinite alternate; }
        @keyframes loaderPulse { from { opacity:.6; } to { opacity:1; } }
        .loader-bar-wrap { width: 160px; height: 1px; background: var(--border); }
        .loader-bar { height: 100%; width: 0%; background: var(--accent); animation: loaderGrow 1.4s cubic-bezier(.22,1,.36,1) forwards; }
        @keyframes loaderGrow { to { width: 100%; } }

        /* NAVBAR */
        .custom-navbar {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            background: rgba(13,11,10,0); backdrop-filter: blur(0px);
            border-bottom: 1px solid transparent; padding: 0 2rem;
            display: flex; align-items: center; justify-content: space-between;
            transition: background .5s, backdrop-filter .5s, border-color .5s;
        }
        .custom-navbar.scrolled { background: rgba(13,11,10,0.94); backdrop-filter: blur(22px); border-bottom-color: var(--border); }
        .nav-links { display: flex; list-style: none; align-items: center; }
        .nav-links a {
            color: var(--text); text-decoration: none; font-size: .69rem; font-weight: 500;
            letter-spacing: .14em; text-transform: uppercase; padding: 1.5rem 1rem;
            display: block; position: relative; transition: color .3s;
        }
        .nav-links a::after {
            content:''; position:absolute; bottom:1rem; left:1rem; right:1rem;
            height:1px; background:var(--accent); transform:scaleX(0); transform-origin:left; transition:transform .35s;
        }
        .nav-links a:hover, .nav-links a.active-nav { color: var(--accent); }
        .nav-links a:hover::after, .nav-links a.active-nav::after { transform: scaleX(1); }
        .brand-txt { font-family: var(--ff-d); font-size: 1.7rem; font-weight: 300; letter-spacing: .06em; color: var(--text); text-decoration: none; transition: color .3s; }
        .brand-txt:hover { color: var(--accent); }

        /* HERO */
        .header { position: relative; overflow: hidden; min-height: 100vh; }
        .header-slides { position: absolute; inset: 0; z-index: 0; }
        .header-slide { position: absolute; inset: 0; background-size: cover; background-position: center; opacity: 0; transition: opacity 1.8s ease-in-out; }
        .header-slide.active { opacity: 1; }
        .header-slide:nth-child(1) { background-image: url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1800&q=95'); }
        .header-slide:nth-child(2) { background-image: url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=1800&q=95'); }
        .header-slide:nth-child(3) { background-image: url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1800&q=95'); }
        .header-slide:nth-child(4) { background-image: url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=1800&q=95'); }
        .header-overlay {
            position: absolute; inset: 0; z-index: 1;
            background: linear-gradient(to bottom, rgba(13,11,10,.25) 0%, rgba(13,11,10,.0) 38%, rgba(13,11,10,.65) 100%);
        }
        .header .overlay {
            position: relative; z-index: 2; min-height: 100vh;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            text-align: center; padding: 2rem;
        }
        .hero-label {
            display: inline-block; font-size: .64rem; font-weight: 500; letter-spacing: .28em; text-transform: uppercase;
            color: var(--accent-light); border: 1px solid rgba(200,149,108,.5); padding: .45rem 1.6rem; margin-bottom: 2rem;
            opacity: 0; animation: heroUp .9s cubic-bezier(.22,1,.36,1) .5s forwards;
        }
        .hero-title {
            font-family: var(--ff-d); font-size: clamp(3.8rem,9vw,8rem); font-weight: 300; line-height: 1;
            letter-spacing: .02em; color: #fff; text-shadow: 0 4px 60px rgba(0,0,0,.3), 0 2px 40px rgba(200,149,108,.2);
            opacity: 0; animation: heroUp .9s cubic-bezier(.22,1,.36,1) .72s forwards; margin-bottom: 1rem;
        }
        .hero-sub {
            font-size: .88rem; font-weight: 300; letter-spacing: .22em; text-transform: uppercase;
            color: rgba(255,255,255,.6); margin-bottom: 2.8rem;
            opacity: 0; animation: heroUp .9s cubic-bezier(.22,1,.36,1) .92s forwards;
        }
        .hero-btn {
            display: inline-block; font-size: .7rem; font-weight: 500; letter-spacing: .22em; text-transform: uppercase;
            color: #0D0B0A; background: var(--accent); padding: 1rem 3rem; text-decoration: none;
            opacity: 0; animation: heroUp .9s cubic-bezier(.22,1,.36,1) 1.12s forwards;
            transition: background .3s, transform .25s, box-shadow .3s;
        }
        .hero-btn:hover { background: var(--accent-light); color: #0D0B0A; transform: translateY(-3px); box-shadow: 0 12px 36px rgba(200,149,108,.35); }
        @keyframes heroUp { from { opacity:0; transform:translateY(32px); } to { opacity:1; transform:translateY(0); } }
        .slide-dots { position: absolute; bottom: 2rem; left: 50%; transform: translateX(-50%); z-index: 3; display: flex; gap: 8px; }
        .slide-dot { width: 28px; height: 2px; background: rgba(255,255,255,.28); border: none; cursor: pointer; padding: 0; transition: background .35s, transform .35s; }
        .slide-dot.active { background: var(--accent); transform: scaleX(1.35); }
        .scroll-hint { position: absolute; bottom: 3.5rem; right: 2rem; z-index: 3; display: flex; flex-direction: column; align-items: center; gap: 6px; opacity: 0; animation: heroUp .9s .9s forwards; }
        .scroll-hint span { font-size: .58rem; letter-spacing: .22em; text-transform: uppercase; color: rgba(255,255,255,.4); writing-mode: vertical-rl; }
        .scroll-hint-line { width: 1px; height: 48px; background: linear-gradient(to bottom, rgba(200,149,108,.6), transparent); animation: scrollLine 1.8s ease-in-out infinite; }
        @keyframes scrollLine { 0%,100% { transform:scaleY(1);opacity:1; } 50% { transform:scaleY(.5);opacity:.4; } }

        /* SCROLL REVEAL */
        .reveal { opacity: 0; transform: translateY(40px); transition: opacity .9s cubic-bezier(.22,1,.36,1), transform .9s cubic-bezier(.22,1,.36,1); }
        .reveal.from-left  { transform: translateX(-40px); }
        .reveal.from-right { transform: translateX(40px); }
        .reveal.scale-in   { transform: scale(.94); }
        .reveal.d1 { transition-delay: .12s; }
        .reveal.d2 { transition-delay: .24s; }
        .reveal.d3 { transition-delay: .36s; }
        .reveal.d4 { transition-delay: .48s; }
        .reveal.on { opacity: 1; transform: translate(0) scale(1); }

        /* Shimmer on labels */
        @keyframes shimmerSlide { 0% { background-position:-200% center; } 100% { background-position:200% center; } }
        .sec-lbl-anim {
            background: linear-gradient(90deg, var(--accent) 25%, var(--accent-light) 50%, var(--accent) 75%);
            background-size: 200% auto; -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            animation: shimmerSlide 3s linear infinite;
        }

        /* SECTION HELPERS */
        .sec-lbl { display: block; font-size: .62rem; font-weight: 500; letter-spacing: .3em; text-transform: uppercase; color: var(--accent); margin-bottom: .7rem; }
        .sec-ttl { font-family: var(--ff-d); font-size: clamp(2.2rem,4vw,3.4rem); font-weight: 300; letter-spacing: .03em; line-height: 1.12; }
        .divline { width: 48px; height: 1px; background: var(--accent); margin: 1.4rem 0; }
        .divline.c { margin: 1.4rem auto; }

        /* ABOUT */
        #about { background: var(--dark-surf); }
        .about-row { display: flex; flex-wrap: wrap; min-height: 520px; }
        .about-img-col { flex: 0 0 50%; background: url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=900&q=92') center/cover no-repeat; min-height: 520px; position: relative; overflow: hidden; }
        .about-img-col::after { content:''; position:absolute; inset:0; background:linear-gradient(135deg,rgba(200,149,108,.06) 0%,transparent 60%); }
        .about-txt-col { flex: 0 0 50%; background: var(--dark-surf); display: flex; align-items: center; padding: 5rem 4.5rem; }
        .about-txt-col p { font-size: .93rem; font-weight: 300; line-height: 1.95; color: var(--text-muted); margin-bottom: 1rem; }
        .about-txt-col strong { color: var(--accent-light); font-weight: 400; }
        @media(max-width:768px) { .about-img-col { flex:0 0 100%;min-height:280px; } .about-txt-col { flex:0 0 100%;padding:3rem 2rem; } }

        /* MENU */
        #gallary { background: var(--dark-bg); padding: 5rem 2rem 3rem; text-align: center; border-top: 1px solid var(--border); }
        #blog { background: var(--dark-bg); padding: 0 2rem 5rem; }

        /* ORDER SECTION */
        #order-section { background: var(--dark-surf); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); padding: 6rem 2rem; }
        .order-hd { text-align: center; margin-bottom: 3rem; }
        .order-type-label { display: block; font-size: .62rem; font-weight: 500; letter-spacing: .26em; text-transform: uppercase; color: var(--text-muted); margin-bottom: 1rem; text-align: center; }
        .order-type-tabs { display: flex; justify-content: center; border: 1px solid var(--border); border-radius: 50px; overflow: hidden; width: fit-content; margin: 0 auto 2.5rem; background: rgba(242,237,229,.04); }
        .order-type-btn { font-family: var(--ff-b); font-size: .7rem; font-weight: 500; letter-spacing: .14em; text-transform: uppercase; padding: .75rem 1.8rem; border: none; background: transparent; color: var(--text-muted); cursor: pointer; border-radius: 50px; transition: all .3s; }
        .order-type-btn.active { background: var(--accent); color: #0D0B0A; }
        .order-type-btn:hover:not(.active) { color: var(--text); }

        .order-wrap { display: flex; gap: 2rem; max-width: 1000px; margin: 0 auto; align-items: flex-start; }
        .order-panel { flex: 1; min-width: 0; }
        .panel-label { font-size: .62rem; font-weight: 500; letter-spacing: .26em; text-transform: uppercase; color: var(--text-muted); margin-bottom: 1rem; display: block; }

        .order-panel-empty {
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            padding: 3rem 1rem; text-align: center; color: var(--text-muted);
            border: 1px dashed var(--border); border-radius: 3px; min-height: 180px;
            transition: all .4s;
        }
        .order-panel-empty .empty-icon { font-size: 2.2rem; margin-bottom: .8rem; opacity: .4; }
        .order-panel-empty p { font-size: .8rem; line-height: 1.6; }

        .cart-item-row {
            display: flex; align-items: center; gap: 1rem;
            background: var(--dark-card); border: 1px solid var(--border);
            padding: .85rem 1rem; margin-bottom: .6rem; border-radius: 3px;
            animation: slideInLeft .35s cubic-bezier(.22,1,.36,1) both;
            transition: border-color .25s, background .25s;
        }
        .cart-item-row:hover { border-color: rgba(200,149,108,.4); background: rgba(200,149,108,.04); }
        @keyframes slideInLeft { from { opacity:0; transform:translateX(-18px); } to { opacity:1; transform:translateX(0); } }
        .cart-item-img { width: 52px; height: 52px; border-radius: 3px; object-fit: cover; flex-shrink: 0; background: var(--dark-bg); }
        .cart-item-info { flex: 1; min-width: 0; }
        .cart-item-name { font-family: var(--ff-d); font-size: 1rem; font-weight: 400; color: var(--text); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: .15rem; }
        .cart-item-uprice { font-size: .72rem; color: var(--text-muted); }
        .cart-item-controls { display: flex; align-items: center; gap: 6px; flex-shrink: 0; }
        .cqb { width: 24px; height: 24px; border: 1px solid var(--border); background: transparent; color: var(--text); font-size: 1rem; cursor: pointer; border-radius: 2px; display: flex; align-items: center; justify-content: center; transition: background .2s, color .2s, border-color .2s, transform .15s; }
        .cqb:hover { background: var(--accent); color: #0D0B0A; border-color: var(--accent); transform: scale(1.12); }
        .cqb.del:hover { background: #c0392b; border-color: #c0392b; color: #fff; }
        .cqn { font-size: .85rem; min-width: 20px; text-align: center; font-weight: 500; }
        .cart-item-total { font-size: .9rem; color: var(--accent); font-weight: 500; min-width: 76px; text-align: right; flex-shrink: 0; }

        .order-cart { width: 280px; flex-shrink: 0; background: var(--dark-card); border: 1px solid var(--border); border-radius: 3px; padding: 1.5rem; position: sticky; top: 90px; }
        .cart-title { font-family: var(--ff-d); font-size: 1.3rem; font-weight: 400; color: var(--text); padding-bottom: 1rem; margin-bottom: .8rem; border-bottom: 1px solid var(--border); }
        .cart-type-badge { display: inline-block; font-size: .6rem; font-weight: 500; letter-spacing: .18em; text-transform: uppercase; color: #0D0B0A; background: var(--accent); padding: .2rem .7rem; border-radius: 50px; margin-bottom: 1rem; }
        .cart-summary-line { display: flex; justify-content: space-between; align-items: center; padding: .35rem 0; border-bottom: 1px solid rgba(200,149,108,.07); font-size: .78rem; color: var(--text-muted); animation: slideInRight .3s ease both; }
        @keyframes slideInRight { from { opacity:0; transform:translateX(10px); } to { opacity:1; transform:translateX(0); } }
        .cart-summary-line .csn { flex:1; }
        .cart-summary-line .csq { color: var(--accent); margin: 0 .4rem; font-weight:500; }
        .cart-summary-line .csp { font-weight: 500; color: var(--text); }
        .cart-empty-msg { text-align: center; color: var(--text-muted); font-size: .8rem; padding: 1.5rem 0; }
        .cart-totals { margin: 1rem 0 0; }
        .ctr { display: flex; justify-content: space-between; font-size: .78rem; color: var(--text-muted); padding: .28rem 0; }
        .ctr.final { font-size: .95rem; color: var(--text); font-weight: 500; border-top: 1px solid var(--border); margin-top: .5rem; padding-top: .7rem; }
        .ctr.final .amt { color: var(--accent); font-size: 1.1rem; }
        .cart-place-btn { width: 100%; padding: .95rem; background: var(--accent); border: none; color: #0D0B0A; font-family: var(--ff-b); font-size: .7rem; font-weight: 500; letter-spacing: .18em; text-transform: uppercase; cursor: pointer; margin-top: 1rem; transition: background .3s, transform .2s, box-shadow .3s; }
        .cart-place-btn:hover { background: var(--accent-light); transform: translateY(-2px); box-shadow: 0 8px 28px rgba(200,149,108,.3); }
        .cart-place-btn:disabled { background: rgba(200,149,108,.18); color: var(--text-muted); cursor: not-allowed; transform: none; box-shadow: none; }

        @keyframes numFlash { 0% { color:var(--accent-light); } 100% { color:var(--accent); } }
        .num-flash { animation: numFlash .4s ease; }

        /* Toast */
        #toast { position: fixed; bottom: 2rem; left: 50%; transform: translateX(-50%) translateY(20px); background: var(--dark-card); border: 1px solid var(--border); color: var(--text); padding: .8rem 2rem; border-radius: 2px; font-size: .78rem; letter-spacing: .1em; opacity: 0; transition: opacity .35s, transform .35s; z-index: 9998; pointer-events: none; }
        #toast.show { opacity: 1; transform: translateX(-50%) translateY(0); }

        @media(max-width:768px) { .order-wrap { flex-direction:column; } .order-cart { width:100%;position:static; } }

        /* REVIEWS */
        #testmonial { background: var(--dark-bg); padding: 6rem 0; border-top: 1px solid var(--border); }
        .reviews-hd { text-align: center; padding: 0 2rem 3.5rem; }
        .reviews-wrap { position: relative; padding: 0 4rem; }
        .reviews-carousel { display: flex; gap: 1.5rem; overflow-x: auto; scroll-snap-type: x mandatory; -webkit-overflow-scrolling: touch; scrollbar-width: none; cursor: grab; }
        .reviews-carousel::-webkit-scrollbar { display: none; }
        .reviews-carousel.grabbing { cursor: grabbing; user-select: none; }
        .review-card { flex: 0 0 290px; scroll-snap-align: start; background: var(--dark-card); border: 1px solid var(--border); padding: 1.8rem 1.6rem; display: flex; flex-direction: column; gap: .9rem; border-radius: 2px; transition: transform .35s, border-color .35s, box-shadow .35s; }
        .review-card:hover { transform: translateY(-8px); border-color: rgba(200,149,108,.5); box-shadow: 0 16px 40px rgba(0,0,0,.3); }
        .review-hrow { display: flex; align-items: center; gap: 12px; }
        .review-av { width: 42px; height: 42px; border-radius: 50%; background: linear-gradient(135deg,var(--accent-dark),var(--accent)); display: flex; align-items: center; justify-content: center; font-weight: 500; font-size: .88rem; color: #fff; flex-shrink: 0; }
        .review-meta strong { display: block; color: var(--text); font-size: .88rem; font-weight: 500; }
        .review-meta span { font-size: .7rem; color: var(--text-muted); }
        .review-stars { color: var(--accent); font-size: .82rem; letter-spacing: 2px; }
        .review-text { font-size: .82rem; font-weight: 300; color: var(--text-muted); line-height: 1.72; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; overflow: hidden; }
        .carousel-nav { position: absolute; top: 50%; transform: translateY(-50%); width: 40px; height: 40px; background: transparent; border: 1px solid var(--border); color: var(--text); font-size: 1rem; display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 5; transition: background .25s, border-color .25s, color .25s, transform .25s; }
        .carousel-nav:hover { background: var(--accent); border-color: var(--accent); color: #0D0B0A; transform: translateY(-50%) scale(1.08); }
        .carousel-nav.prev { left: 0; }
        .carousel-nav.next { right: 0; }
        .carousel-dots { display: flex; justify-content: center; gap: 8px; margin-top: 2rem; }
        .carousel-dot { width: 24px; height: 2px; background: rgba(242,237,229,.18); border: none; cursor: pointer; padding: 0; transition: background .3s, transform .3s; }
        .carousel-dot.active { background: var(--accent); transform: scaleX(1.4); }

        /* CONTACT */
        #contact { background: var(--dark-surf); border-top: 1px solid var(--border); }
        .contact-row { display: flex; flex-wrap: wrap; min-height: 420px; }
        .contact-map-col { flex: 0 0 50%; min-height: 420px; overflow: hidden; }
        #map { width: 100%; height: 100%; min-height: 420px; display: block; filter: grayscale(40%) contrast(1.05); }
        .contact-txt-col { flex: 0 0 50%; background: var(--dark-surf); padding: 4.5rem 4rem; display: flex; flex-direction: column; justify-content: center; }
        .contact-txt-col h3 { font-family: var(--ff-d); font-size: 2rem; font-weight: 300; letter-spacing: .06em; margin: 1rem 0 .5rem; }
        .contact-txt-col p { font-size: .88rem; color: var(--text-muted); font-weight: 300; line-height: 1.9; }
        .contact-info-row { margin-top: 1rem; display: flex; flex-direction: column; gap: .6rem; }
        .contact-info-row span { display: flex; align-items: center; gap: .6rem; font-size: .88rem; color: var(--text-muted); }
        .contact-icon { color: var(--accent); font-size: 1rem; }
        @media(max-width:767px) { .contact-map-col { flex:0 0 100%;min-height:260px; } .contact-txt-col { flex:0 0 100%;padding:3rem 1.5rem; } }

        /* FOOTER */
        .footer-main { background: var(--dark-surf); border-top: 1px solid var(--border); padding: 3.5rem 0; }
        .footer-grid { display: flex; justify-content: center; flex-wrap: wrap; }
        .footer-col { padding: 1rem 3rem; text-align: center; }
        .footer-col + .footer-col { border-left: 1px solid var(--border); }
        .fhl { font-size: .6rem; font-weight: 500; letter-spacing: .26em; text-transform: uppercase; color: var(--accent); margin-bottom: .5rem; }
        .footer-main p { font-size: .82rem; color: var(--text-muted); font-weight: 300; }
        .footer-copy { background: var(--dark-bg); border-top: 1px solid var(--border); padding: 1.2rem 2rem; text-align: center; font-size: .72rem; color: var(--text-muted); }
        .footer-copy a { color: var(--accent); text-decoration: none; }

        /* PARALLAX */
        .parallax-divider { height: 220px; background: url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1600&q=80') center/cover fixed; position: relative; overflow: hidden; }
        .parallax-divider::after { content:''; position:absolute; inset:0; background:rgba(13,11,10,.58); }
        .parallax-text { position:absolute; inset:0; z-index:1; display:flex; align-items:center; justify-content:center; font-family:var(--ff-d); font-size:clamp(1.6rem,4vw,3rem); font-weight:300; letter-spacing:.12em; color:rgba(255,255,255,.85); text-align:center; }

        /* Menu card hover animation */
        .menu-card { transition: transform .35s cubic-bezier(.22,1,.36,1), box-shadow .35s !important; }
        .menu-card:hover { transform: translateY(-6px) !important; box-shadow: 0 20px 50px rgba(0,0,0,.4) !important; }
    </style>

    <script>
        /* ══ THEME INIT — avant rendu pour éviter le flash ══ */
        (function(){
            var saved = localStorage.getItem('sternlicht-theme') || 'dark';
            if(saved === 'light') document.documentElement.classList.add('theme-light');
        })();
    </script>
</head>
<body id="home">

<div id="page-loader">
    <div class="loader-brand">Sternlicht</div>
    <div class="loader-bar-wrap"><div class="loader-bar"></div></div>
</div>

<div id="toast"></div>

<!-- NAVBAR -->
<nav class="custom-navbar" id="navbar">
    <ul class="nav-links">
        <li><a href="#home"          data-section="home">Home</a></li>
        <li><a href="#about"         data-section="about">About</a></li>
        <li><a href="#gallary"       data-section="gallary">Menu</a></li>
        <li><a href="#order-section" data-section="order-section">Order</a></li>
    </ul>
    <a class="brand-txt" href="#">Sternlicht Haus</a>
    <ul class="nav-links">
        <li><a href="#testmonial"    data-section="testmonial">Reviews</a></li>
        <li><a href="#contact"       data-section="contact">Contact Us</a></li>
        @if (Route::has('login'))
            @auth
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            @else
                <li><a href="{{ route('login') }}">Log in</a></li>
                <li><a href="{{ route('register') }}">Sign up</a></li>
            @endauth
        @endif
        <li>
            <button class="theme-toggle-btn" id="themeToggle" onclick="toggleTheme()" title="Changer le thème">
                <span id="themeIcon">☀️</span>
            </button>
        </li>
    </ul>
</nav>

<!-- HERO -->
<header class="header">
    <div class="header-slides">
        <div class="header-slide active"></div>
        <div class="header-slide"></div>
        <div class="header-slide"></div>
        <div class="header-slide"></div>
        <div class="header-slide" id="cSlide1"></div>
        <div class="header-slide" id="cSlide2"></div>
        <div class="header-slide" id="cSlide3"></div>
        <div class="header-slide" id="cSlide4"></div>
    </div>
    <div class="header-overlay"></div>
    <div class="overlay">
        <span class="hero-label">Fine Dining — Since 2024</span>
        <h1 class="hero-title">Sternlicht Haus</h1>
        <p class="hero-sub">Always fresh &amp; Delightful</p>
        <a class="hero-btn" href="#gallary">View Our Menu</a>
    </div>
    <div class="slide-dots" id="slideDots"></div>
    <div class="scroll-hint"><div class="scroll-hint-line"></div><span>scroll</span></div>
</header>

<!-- ABOUT -->
<div id="about">
    <div class="about-row">
        <div class="about-img-col reveal from-left"></div>
        <div class="about-txt-col">
            <div class="reveal">
                <span class="sec-lbl sec-lbl-anim">Our Story</span>
                <h2 class="sec-ttl">About Us</h2>
                <div class="divline"></div>
                <p>Welcome to Sternlicht, where technology meets elegance, and every dining experience shines like starlight.</p>
                <p><strong>Our concept: offer our guests an intelligent, modern, and unforgettable dining journey.</strong></p>
                <p>Sternlicht is proudly founded by Fatimaezzahra GOUANGA, a student in FST.</p>
                <p>At Sternlicht, every detail matters " because you deserve nothing less than starlight."</p>
            </div>
        </div>
    </div>
</div>

<div class="parallax-divider">
    <div class="parallax-text reveal">"Every dish tells a story"</div>
</div>

<!-- MENU -->
<div id="gallary" class="reveal" style="padding:5rem 2rem 3rem;text-align:center;border-top:1px solid var(--border);">
    <span class="sec-lbl sec-lbl-anim">Discover</span>
    <h2 class="sec-ttl">Our Menu</h2>
    <div class="divline c"></div>
</div>
<div id="blog" style="background:var(--dark-bg);padding:0 2rem 5rem;">
    <div class="tab-content">
        <div class="tab-pane fade show active">
            @yield('home')
        </div>
    </div>
</div>

<!-- ORDER SECTION -->
<div id="order-section">
    <div class="order-hd reveal">
        <span class="sec-lbl sec-lbl-anim" style="text-align:center;display:block;">Quick Order</span>
        <h2 class="sec-ttl" style="text-align:center">Place Your Order</h2>
        <div class="divline c"></div>
    </div>

    <span class="order-type-label">Select order type</span>
    <div class="order-type-tabs reveal d1" id="orderTypeTabs">
        <button class="order-type-btn active" data-type="dine_in">🍽 Dine In</button>
        <button class="order-type-btn" data-type="take_away">🥡 Take Away</button>
        <button class="order-type-btn" data-type="delivery">🚚 Delivery</button>
    </div>
    <input type="hidden" id="selectedOrderType" name="type" value="dine_in">

    <div class="order-wrap">
        <div class="order-panel reveal d2" id="itemsList">
            <span class="panel-label">Your selected items</span>
            <div class="order-panel-empty" id="panelEmpty">
                <div class="empty-icon">🛒</div>
                <p>No items selected yet.<br>Add dishes from the menu above.</p>
            </div>
        </div>

        <div class="order-cart reveal d3" id="orderCart">
            <div class="cart-title">Your Order</div>
            <span class="cart-type-badge" id="cartTypeBadge">Dine In</span>
            <div id="cartSummary">
                <div class="cart-empty-msg" id="cartEmpty">No items yet — add something!</div>
            </div>
            <div class="cart-totals" id="cartTotals" style="display:none">
                <div class="ctr final"><span>Total</span><span class="amt" id="cTotal">0.00 DH</span></div>
            </div>
            <button class="cart-place-btn" id="placeBtn" disabled>Place Order</button>
        </div>
    </div>
</div>

<!-- REVIEWS -->
<div id="testmonial">
    <div class="reviews-hd reveal">
        <span class="sec-lbl sec-lbl-anim" style="text-align:center;display:block;">Testimonials</span>
        <h2 class="sec-ttl" style="text-align:center">What Our Guests Say</h2>
        <div class="divline c"></div>
    </div>
    <div class="reviews-wrap">
        <button class="carousel-nav prev" id="revPrev">&#8592;</button>
        <div class="reviews-carousel" id="revCarousel">

            @if(isset($reviews) && $reviews->count())
                @foreach($reviews as $r)
                <div class="review-card">
                    <div class="review-hrow">
                        <div class="review-av" style="overflow:hidden;padding:0">
                            @if(isset($r->user) && $r->user && $r->user->profile_photo_path)
                                <img src="{{ asset($r->user->profile_photo_path) }}"
                                     style="width:100%;height:100%;object-fit:cover;display:block">
                            @else
                                {{ strtoupper(substr($r->name ?? 'A', 0, 1)) }}
                            @endif
                        </div>
                        <div class="review-meta">
                            <strong>{{ $r->name }}</strong>
                            <span>{{ $r->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="review-stars">
                        @for($i=1;$i<=5;$i++){{ $i <= $r->rating ? '★' : '☆' }}@endfor
                    </div>
                    <p class="review-text">{{ $r->comment }}</p>
                </div>
                @endforeach

            @else
                @php $demo = [
                    ['name'=>'Sofia M.',    'date'=>'2 days ago',  'stars'=>5, 'text'=>'Experience incroyable ! La nourriture etait delicieuse et le service impeccable.'],
                    ['name'=>'Karim B.',    'date'=>'5 days ago',  'stars'=>5, 'text'=>'Le meilleur restaurant de la ville. Les plats sont frais et presentes avec elegance.'],
                    ['name'=>'Laila R.',    'date'=>'1 week ago',  'stars'=>4, 'text'=>'Ambiance chaleureuse et accueil parfait. Les desserts sont a tomber.'],
                    ['name'=>'Adam T.',     'date'=>'2 weeks ago', 'stars'=>5, 'text'=>'Un vrai regal du debut a la fin. La carte est variee et les prix raisonnables.'],
                    ['name'=>'Nadia H.',    'date'=>'3 weeks ago', 'stars'=>5, 'text'=>'Je viens ici chaque semaine. La qualite reste constante et le personnel est attentionne.'],
                    ['name'=>'Youssef E.', 'date'=>'1 month ago', 'stars'=>4, 'text'=>'Cadre magnifique, plats copieux. Le tajine est exceptionnel.'],
                    ['name'=>'Rim A.',      'date'=>'1 month ago', 'stars'=>5, 'text'=>'Service rapide et souriant, portions genereueses. Le couscous du vendredi est delicieux !'],
                ]; @endphp
                @foreach($demo as $r)
                <div class="review-card">
                    <div class="review-hrow">
                        <div class="review-av">{{ substr($r['name'], 0, 1) }}</div>
                        <div class="review-meta">
                            <strong>{{ $r['name'] }}</strong>
                            <span>{{ $r['date'] }}</span>
                        </div>
                    </div>
                    <div class="review-stars">
                        @for($i=1;$i<=5;$i++){{ $i <= $r['stars'] ? '★' : '☆' }}@endfor
                    </div>
                    <p class="review-text">{{ $r['text'] }}</p>
                </div>
                @endforeach
            @endif

        </div>
        <button class="carousel-nav next" id="revNext">&#8594;</button>
    </div>
    <div class="carousel-dots" id="revDots"></div>
</div>

<!-- CONTACT -->
<div id="contact">
    <div class="contact-row">
        <div class="contact-map-col">
            <iframe id="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3398.0!2d-8.0!3d31.63!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzHCsDM3JzQ4LjAiTiA4wrAwMCcwMC4wIlc!5e0!3m2!1sfr!2sma!4v1620000000000" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="contact-txt-col reveal">
            <span class="sec-lbl sec-lbl-anim">Find Us</span>
            <h3>Visit Us</h3>
            <div class="divline"></div>
            <p>The best restaurant in Marrakech</p>
            <div class="contact-info-row">
                <span><span class="contact-icon">📍</span> FST MARRAKECH</span>
                <span><span class="contact-icon">📞</span> (123) 456-7890</span>
                <span><span class="contact-icon">✉️</span> fatigouanga@website.com</span>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER -->
<div class="footer-main">
    <div class="footer-grid">
        <div class="footer-col reveal"><p class="fhl">Email Us</p><p>fatiGouanga@website.com</p></div>
        <div class="footer-col reveal d1"><p class="fhl">Call Us</p><p>(123) 456-7890</p></div>
        <div class="footer-col reveal d2"><p class="fhl">Find Us</p><p>FST Marrakech</p></div>
    </div>
</div>
<div class="footer-copy">
    &copy; <script>document.write(new Date().getFullYear())</script>
    Made with care by <a href="#">Fatimaezzahra GOUANGA</a>
</div>

<script>
/* ══ THEME TOGGLE ══ */
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

/* ══ PAGE LOADER ══ */
(function(){
    function hide(){ var l=document.getElementById('page-loader'); if(l) l.classList.add('hidden'); }
    if(document.readyState==='loading'){ document.addEventListener('DOMContentLoaded',function(){ setTimeout(hide,1500); }); }
    else { setTimeout(hide,1500); }
    setTimeout(hide,2500);
})();

/* ══ SLIDESHOW ══ */
(function(){
    var customSrcs = [
        "{{ asset('images/image1.webp') }}",
        "{{ asset('images/image2.webp') }}",
        "{{ asset('images/image3.jpeg') }}",
        "{{ asset('images/image4.jpg') }}"
    ];
    ['cSlide1','cSlide2','cSlide3','cSlide4'].forEach(function(id,i){
        var el = document.getElementById(id);
        if(el) el.style.backgroundImage = "url('"+customSrcs[i]+"')";
    });

    var slides   = document.querySelectorAll('.header-slide');
    var dotsWrap = document.getElementById('slideDots');
    var total    = slides.length;
    var cur=0, timer;

    for(var i=0;i<total;i++){
        var d=document.createElement('button');
        d.className='slide-dot'+(i===0?' active':'');
        d.dataset.index=i;
        dotsWrap.appendChild(d);
    }
    var dots=dotsWrap.querySelectorAll('.slide-dot');

    function go(i){
        slides[cur].classList.remove('active'); dots[cur].classList.remove('active');
        cur=(i+total)%total;
        slides[cur].classList.add('active'); dots[cur].classList.add('active');
    }
    function start(){ clearInterval(timer); timer=setInterval(function(){ go(cur+1); },4500); }
    dots.forEach(function(d){ d.addEventListener('click',function(){ go(+d.dataset.index); start(); }); });
    go(0); start();
})();

/* ══ NAVBAR SCROLL ══ */
window.addEventListener('scroll',function(){
    document.getElementById('navbar').classList.toggle('scrolled',window.scrollY>60);
},{passive:true});

/* ══ NAVBAR ACTIVE ══ */
(function(){
    var navLinks = document.querySelectorAll('.nav-links a[data-section]');

    function setActive(id){
        navLinks.forEach(function(a){
            a.classList.toggle('active-nav', a.dataset.section===id);
        });
    }

    var io = new IntersectionObserver(function(entries){
        entries.forEach(function(e){
            if(e.isIntersecting) setActive(e.target.dataset.navId || e.target.id);
        });
    },{threshold:0.4, rootMargin:'-60px 0px -40% 0px'});

    var sectionIds=['about','gallary','order-section','testmonial','contact'];
    sectionIds.forEach(function(id){
        var el=document.getElementById(id);
        if(el){ el.dataset.navId=id; io.observe(el); }
    });

    var hero=document.querySelector('header.header');
    if(hero){
        new IntersectionObserver(function(entries){
            if(entries[0].isIntersecting) setActive('home');
        },{threshold:0.1}).observe(hero);
    }

    setActive('home');
})();

/* ══ SCROLL REVEAL ══ */
(function(){
    var io=new IntersectionObserver(function(entries){
        entries.forEach(function(e){ if(e.isIntersecting){ e.target.classList.add('on'); io.unobserve(e.target); } });
    },{threshold:.1});
    document.querySelectorAll('.reveal').forEach(function(el){ io.observe(el); });
})();

/* ══ TOAST ══ */
function showToast(msg){
    var t=document.getElementById('toast');
    t.textContent=msg; t.classList.add('show');
    setTimeout(function(){ t.classList.remove('show'); },2200);
}

/* ══ ORDER TYPE ══ */
(function(){
    var btns=document.querySelectorAll('.order-type-btn');
    var inp=document.getElementById('selectedOrderType');
    var badge=document.getElementById('cartTypeBadge');
    var labels={dine_in:'Dine In',take_away:'Take Away',delivery:'Delivery'};
    btns.forEach(function(btn){
        btn.addEventListener('click',function(){
            btns.forEach(function(b){ b.classList.remove('active'); });
            btn.classList.add('active');
            inp.value=btn.dataset.type;
            badge.textContent=labels[btn.dataset.type]||btn.dataset.type;
        });
    });
})();

/* ══ PANIER — window.CART ══ */
window.CART = (function(){

    var data = {};

    var itemsList   = document.getElementById('itemsList');
    var panelEmpty  = document.getElementById('panelEmpty');
    var cartSummary = document.getElementById('cartSummary');
    var cartEmpty   = document.getElementById('cartEmpty');
    var cartTotals  = document.getElementById('cartTotals');
    var cTotal      = document.getElementById('cTotal');
    var placeBtn    = document.getElementById('placeBtn');

    function render() {
        var entries = Object.entries(data).filter(function(e){ return e[1].qty > 0; });

        itemsList.querySelectorAll('.cart-item-row').forEach(function(r){ r.remove(); });

        if (!entries.length) {
            panelEmpty.style.display = '';
        } else {
            panelEmpty.style.display = 'none';
            entries.forEach(function(entry, idx) {
                var id = entry[0], d = entry[1];
                var row = document.createElement('div');
                row.className = 'cart-item-row';
                row.style.animationDelay = (idx * 0.055) + 's';
                row.innerHTML =
                    '<img class="cart-item-img" src="' + d.img + '" alt="' + d.name + '" onerror="this.style.display=\'none\'">' +
                    '<div class="cart-item-info">' +
                        '<div class="cart-item-name">' + d.name + '</div>' +
                        '<div class="cart-item-uprice">' + d.price.toFixed(2) + ' DH / unité</div>' +
                    '</div>' +
                    '<div class="cart-item-controls">' +
                        '<button class="cqb del" data-id="' + id + '" data-a="m">−</button>' +
                        '<span class="cqn">' + d.qty + '</span>' +
                        '<button class="cqb" data-id="' + id + '" data-a="p">+</button>' +
                    '</div>' +
                    '<div class="cart-item-total">' + (d.price * d.qty).toFixed(2) + ' DH</div>';
                itemsList.appendChild(row);
            });
        }

        cartSummary.querySelectorAll('.cart-summary-line').forEach(function(r){ r.remove(); });

        if (!entries.length) {
            cartEmpty.style.display  = 'block';
            cartTotals.style.display = 'none';
            placeBtn.disabled = true;
        } else {
            cartEmpty.style.display  = 'none';
            cartTotals.style.display = 'block';
            placeBtn.disabled = false;

            var sub = 0;
            entries.forEach(function(entry) {
                var d = entry[1];
                sub += d.price * d.qty;
                var line = document.createElement('div');
                line.className = 'cart-summary-line';
                line.innerHTML =
                    '<span class="csn">' + d.name + '</span>' +
                    '<span class="csq">×' + d.qty + '</span>' +
                    '<span class="csp">' + (d.price * d.qty).toFixed(2) + ' DH</span>';
                cartSummary.insertBefore(line, cartEmpty);
            });

            if (cTotal) {
                cTotal.classList.remove('num-flash');
                void cTotal.offsetWidth;
                cTotal.classList.add('num-flash');
                cTotal.textContent = sub.toFixed(2) + ' DH';
            }
        }
    }

    var api = {
        add: function(id, name, price, img, qty) {
            qty = qty || 1;
            if (!data[id]) data[id] = { name: name, price: parseFloat(price), qty: 0, img: img || '' };
            data[id].qty += qty;
            render();
        },
        set: function(id, name, price, img, qty) {
            if (!data[id]) data[id] = { name: name, price: parseFloat(price), qty: 0, img: img || '' };
            data[id].qty = Math.max(0, qty);
            if (data[id].qty === 0) delete data[id];
            render();
        },
        remove: function(id) {
            delete data[id];
            render();
        },
        clear: function() {
            data = {};
            render();
        },
        getQty: function(id) {
            return data[id] ? data[id].qty : 0;
        },
        totals: function() {
            var qty = 0, sub = 0;
            Object.values(data).forEach(function(d){ qty += d.qty; sub += d.qty * d.price; });
            return { qty: qty, sub: sub, total: sub };
        }
    };

    itemsList.addEventListener('click', function(e) {
        var btn = e.target.closest('.cqb');
        if (!btn) return;
        var id = btn.dataset.id;
        if (!data[id]) return;
        if (btn.dataset.a === 'p') {
            data[id].qty++;
        } else {
            data[id].qty--;
            if (data[id].qty <= 0) delete data[id];
        }
        var card = document.querySelector('#menuCarousel .menu-card[data-id="' + id + '"]');
        if (card) {
            var qv = card.querySelector('.qty-value');
            if (qv) qv.textContent = data[id] ? data[id].qty : 0;
        }
        render();
        if (window.CART_syncBadge) window.CART_syncBadge();
    });

    placeBtn.addEventListener('click', function() {
        var entries = Object.entries(data).filter(function(e){ return e[1].qty > 0; });
        if (!entries.length) return;
        var type  = document.getElementById('selectedOrderType').value;
        var items = entries.map(function(e){ return { id: e[0], name: e[1].name, price: e[1].price, qty: e[1].qty }; });
        fetch('/commandes', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ type: type, items: items })
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            if (data.success) {
                showOrderConfirm(data.order_number);
            } else {
                showToast('Erreur : ' + (data.message || 'Erreur inconnue'));
            }
            api.clear();
            document.querySelectorAll('#menuCarousel .qty-value').forEach(function(el){ el.textContent = '0'; });
            if (window.CART_syncBadge) window.CART_syncBadge();
        })
        .catch(function(err) {
            showToast('Erreur reseau');
            console.error(err);
        });
    });

    return api;
})();

/* ══ REVIEWS CAROUSEL ══ */
(function(){
    var carousel=document.getElementById('revCarousel');
    if(!carousel) return;
    var prev=document.getElementById('revPrev'), next=document.getElementById('revNext'), dotsEl=document.getElementById('revDots');
    var cards=carousel.querySelectorAll('.review-card');
    var GAP=24;
    var cw=function(){ return cards[0]?cards[0].offsetWidth+GAP:314; };
    var vis=function(){ return Math.max(1,Math.floor(carousel.offsetWidth/cw())); };
    var total=cards.length, cur=0;

    function buildDots(){
        dotsEl.innerHTML='';
        var pages=Math.ceil(total/vis());
        for(var i=0;i<pages;i++){(function(i){
            var d=document.createElement('button');
            d.className='carousel-dot'+(i===0?' active':'');
            d.addEventListener('click',function(){ scrollTo(i*vis()); });
            dotsEl.appendChild(d);
        })(i);}
    }
    function updDots(){ cur=Math.round(carousel.scrollLeft/cw()); var p=Math.floor(cur/vis()); dotsEl.querySelectorAll('.carousel-dot').forEach(function(d,i){ d.classList.toggle('active',i===p); }); }
    function scrollTo(idx){ idx=Math.max(0,Math.min(idx,total-1)); carousel.scrollTo({left:idx*cw(),behavior:'smooth'}); }
    prev.addEventListener('click',function(){ scrollTo(cur-vis()); });
    next.addEventListener('click',function(){ scrollTo(cur+vis()); });
    carousel.addEventListener('scroll',updDots,{passive:true});
    window.addEventListener('resize',function(){ buildDots(); updDots(); });
    var isDown=false,startX,sLeft;
    carousel.addEventListener('mousedown',function(e){ isDown=true; carousel.classList.add('grabbing'); startX=e.pageX-carousel.offsetLeft; sLeft=carousel.scrollLeft; });
    ['mouseleave','mouseup'].forEach(function(ev){ carousel.addEventListener(ev,function(){ isDown=false; carousel.classList.remove('grabbing'); }); });
    carousel.addEventListener('mousemove',function(e){ if(!isDown)return; e.preventDefault(); carousel.scrollLeft=sLeft-(e.pageX-carousel.offsetLeft-startX)*1.5; });
    buildDots();
})();

function showOrderConfirm(number) {
    document.getElementById('confirmNumber').textContent = number || '?';
    document.getElementById('orderConfirmModal').style.display = 'flex';
}
</script>

<!-- MODALE CONFIRMATION COMMANDE -->
<div id="orderConfirmModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.8);backdrop-filter:blur(6px);z-index:9999;align-items:center;justify-content:center">
    <div style="background:var(--dark-card);border:1px solid var(--border);border-radius:12px;padding:40px 36px;max-width:380px;width:90%;text-align:center">
        <div style="font-family:'Cormorant Garamond',serif;font-size:1rem;color:var(--accent);letter-spacing:.2em;text-transform:uppercase;margin-bottom:8px">Commande confirmee</div>
        <div style="font-family:'Cormorant Garamond',serif;font-size:1rem;color:var(--text-muted);margin-bottom:16px">Votre numero de commande</div>
        <div id="confirmNumber" class="confirm-number" style="font-family:'Cormorant Garamond',serif;font-size:5rem;font-weight:300;color:#C8956C;line-height:1;margin-bottom:8px">—</div>
        <div style="font-size:0.78rem;color:var(--text-muted);font-family:'Jost',sans-serif;margin-bottom:28px;line-height:1.6">
            Retenez ce numero.<br>Il sera annonce quand votre commande sera prete.
        </div>
        <button onclick="document.getElementById('orderConfirmModal').style.display='none'"
                style="background:#C8956C;border:none;color:#0D0B0A;font-family:'Jost',sans-serif;font-size:0.72rem;font-weight:600;letter-spacing:.14em;text-transform:uppercase;padding:12px 36px;cursor:pointer;transition:background .2s">
            Compris
        </button>
    </div>
</div>

</body>
</html>