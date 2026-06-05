@extends('main')
@section('home')

<style>
    /* ════════════════════════════════
       MENU CAROUSEL
    ════════════════════════════════ */
    .menu-carousel-wrap {
        position: relative;
        padding: 0 52px;
    }

    .menu-carousel {
        display: flex;
        gap: 24px;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        padding-bottom: 10px;
        cursor: grab;
    }

    .menu-carousel::-webkit-scrollbar { display: none; }
    .menu-carousel.grabbing { cursor: grabbing; user-select: none; }

    .menu-card {
        flex: 0 0 270px;
        scroll-snap-align: start;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 14px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform .28s, box-shadow .28s, border-color .28s;
    }

    .menu-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 44px rgba(0,0,0,0.5);
        border-color: rgba(242,101,34,0.5);
    }

    .menu-card-img {
        width: 100%;
        height: 195px;
        object-fit: cover;
        display: block;
        flex-shrink: 0;
    }

    .menu-card-body {
        padding: 16px 15px 18px;
        display: flex;
        flex-direction: column;
        flex: 1;
        gap: 8px;
    }

    .menu-card-price {
        display: inline-block;
        background: #f26522;
        color: #fff;
        font-size: 0.88rem;
        font-weight: 700;
        border-radius: 20px;
        padding: 3px 13px;
        align-self: center;
    }

    .menu-card-name {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text);          /* ← s'adapte dark/light */
    line-height: 1.3;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    min-height: 2.6em;
    margin: 0;
}

.menu-card-desc {
    font-size: 0.79rem;
    color: var(--text-muted);    /* ← s'adapte dark/light */
    line-height: 1.55;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    flex: 1;
}

.qty-value {
    min-width: 28px;
    text-align: center;
    color: var(--text);          /* ← s'adapte dark/light */
    font-size: 0.88rem;
    font-weight: 600;
    pointer-events: none;
    transition: color .2s;
}

/* Fond de carte adapté au mode clair */
.menu-card {
    flex: 0 0 270px;
    scroll-snap-align: start;
    background: var(--dark-card);          /* ← utilise la variable */
    border: 1px solid var(--border);       /* ← utilise la variable */
    border-radius: 14px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: transform .28s, box-shadow .28s, border-color .28s;
}

.menu-card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    margin-top: 6px;
    padding-top: 10px;
    border-top: 1px solid var(--border);   /* ← utilise la variable */
}

.qty-control {
    display: flex;
    align-items: center;
    background: rgba(128,128,128,0.1);
    border: 1px solid var(--border);       /* ← utilise la variable */
    border-radius: 8px;
    overflow: hidden;
}
    .qty-value.changed { color: #f26522; }

    /* Bouton ajouter */
    .btn-add-cart {
        flex: 1;
        background: linear-gradient(130deg, #f26522, #c0392b);
        border: none;
        border-radius: 8px;
        color: #ffffff;
        font-size: 0.78rem;
        font-weight: 600;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        padding: 7px 10px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: opacity .2s, transform .15s, background .3s;
    }

    .btn-add-cart:hover  { opacity: 0.88; transform: scale(1.03); }
    .btn-add-cart:active { transform: scale(0.97); }
    .btn-add-cart.added  { background: linear-gradient(130deg,#27ae60,#1e8449); }

    .btn-add-cart svg {
        width: 14px; height: 14px;
        stroke: currentColor; fill: none;
        stroke-width: 2.2; stroke-linecap: round;
    }

    /* Badge panier (coin haut droit) */
    .cart-badge-wrap {
        position: fixed;
        top: 80px;
        right: 20px;
        z-index: 9999;
        display: none;
    }

    .cart-badge {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(20,20,20,0.92);
        border: 1px solid rgba(242,101,34,0.4);
        border-radius: 30px;
        padding: 8px 16px 8px 12px;
        color: #ffffff;
        font-size: 0.85rem;
        font-weight: 600;
        backdrop-filter: blur(8px);
        box-shadow: 0 6px 24px rgba(0,0,0,0.4);
        cursor: pointer;
        transition: border-color .2s, transform .2s;
        text-decoration: none;
    }

    .cart-badge:hover { border-color: #f26522; transform: translateY(-2px); }

    .cart-badge svg {
        width: 18px; height: 18px;
        stroke: #f26522; fill: none;
        stroke-width: 2; stroke-linecap: round;
    }

    .cart-count {
        background: #f26522;
        color: #561111;
        border-radius: 50%;
        width: 20px; height: 20px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.72rem;
        font-weight: 700;
        animation: badgePop .3s cubic-bezier(.22,1,.36,1);
    }

    @keyframes badgePop { from { transform:scale(0); } to { transform:scale(1); } }

    /* Flèches carousel */
    .carousel-nav-btn {
        position: absolute; top: 50%; transform: translateY(-50%);
        width: 40px; height: 40px; border-radius: 50%;
        background: rgba(242,101,34,0.82); border: none;
        color: #fff; font-size: 1rem;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; z-index: 5;
        transition: background .2s, transform .2s;
        box-shadow: 0 4px 14px rgba(0,0,0,0.4);
    }

    .carousel-nav-btn:hover { background: #f26522; transform: translateY(-50%) scale(1.1); }
    .carousel-nav-btn.prev { left: 0; }
    .carousel-nav-btn.next { right: 0; }

    .carousel-dots {
        display: flex; justify-content: center;
        gap: 8px; margin-top: 20px;
    }

    .carousel-dot {
        width: 7px; height: 7px; border-radius: 50%;
        background: rgba(255,255,255,0.2); border: none;
        cursor: pointer; padding: 0;
        transition: background .25s, transform .25s;
    }

    .carousel-dot.active { background: #f26522; transform: scale(1.5); }

    @media (max-width: 576px) {
        .menu-carousel-wrap { padding: 0 38px; }
        .menu-card { flex: 0 0 240px; }
    }
</style>

{{-- ✅ Badge panier flottant — clique pour descendre à la section Order --}}
<div class="cart-badge-wrap" id="cartBadgeWrap">
    <a class="cart-badge" href="#order-section" title="Voir la commande">
        <svg viewBox="0 0 24 24">
            <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
        </svg>
        <span id="badgeQty">0</span> article(s) —
        <span id="badgePrice">0.00</span> DH
        <div class="cart-count" id="badgeCount">0</div>
    </a>
</div>

{{-- ── Menu Carousel ── --}}
<div class="menu-carousel-wrap">
    <button class="carousel-nav-btn prev" id="menuPrev">&#8592;</button>

    <div class="menu-carousel" id="menuCarousel">
        @foreach($foods as $food)
        {{--
            ✅ data-id       → identifiant unique de l'article
            ✅ data-price     → prix en DH (utilisé par window.CART)
            ✅ data-name      → nom (utilisé par window.CART si pas trouvé dans le DOM)
            ✅ data-img       → url de l'image (passée au panier Order)
        --}}
        <div class="menu-card"
             data-id="{{ $food->id }}"
             data-price="{{ $food->Food_price }}"
             data-name="{{ $food->Food_name }}"
             data-img="{{ asset('food_img/'.$food->image) }}">

            <img
                src="{{ asset('food_img/'.$food->image) }}"
                alt="{{ $food->Food_name }}"
                class="menu-card-img"
                loading="lazy"
            >
            <div class="menu-card-body">
                <span class="menu-card-price">{{ $food->Food_price }} DH</span>
                <h4 class="menu-card-name">{{ $food->Food_name }}</h4>
                <p class="menu-card-desc">{{ $food->Food_detail }}</p>

                <div class="menu-card-footer">
                    {{-- Compteur +/- (quantité locale à la carte) --}}
                    <div class="qty-control">
                        <button class="qty-btn qty-minus" type="button" aria-label="Diminuer">−</button>
                        <span class="qty-value">0</span>
                        <button class="qty-btn qty-plus"  type="button" aria-label="Augmenter">+</button>
                    </div>

                    {{-- ✅ Bouton AJOUTER → appelle window.CART.set() --}}
                    <button class="btn-add-cart" type="button">
                        <svg viewBox="0 0 24 24">
                            <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                        </svg>
                        Ajouter
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <button class="carousel-nav-btn next" id="menuNext">&#8594;</button>
</div>

<div class="carousel-dots" id="menuDots"></div>

<script>
(function () {

    /* ══════════════════════════════════════════════
       CAROUSEL
    ══════════════════════════════════════════════ */
    const carousel = document.getElementById('menuCarousel');
    const prevBtn  = document.getElementById('menuPrev');
    const nextBtn  = document.getElementById('menuNext');
    const dotsWrap = document.getElementById('menuDots');
    const cards    = carousel.querySelectorAll('.menu-card');
    const GAP      = 24;
    const cardW    = () => cards[0] ? cards[0].offsetWidth + GAP : 294;
    const visible  = () => Math.max(1, Math.floor(carousel.offsetWidth / cardW()));
    const total    = cards.length;
    let   cur      = 0;

    function buildDots() {
        dotsWrap.innerHTML = '';
        const pages = Math.ceil(total / visible());
        for (let i = 0; i < pages; i++) {
            const d = document.createElement('button');
            d.className = 'carousel-dot' + (i === 0 ? ' active' : '');
            d.addEventListener('click', () => scrollToIdx(i * visible()));
            dotsWrap.appendChild(d);
        }
    }

    function updateDots() {
        cur = Math.round(carousel.scrollLeft / cardW());
        const page = Math.floor(cur / visible());
        dotsWrap.querySelectorAll('.carousel-dot')
            .forEach((d, i) => d.classList.toggle('active', i === page));
    }

    function scrollToIdx(idx) {
        idx = Math.max(0, Math.min(idx, total - 1));
        carousel.scrollTo({ left: idx * cardW(), behavior: 'smooth' });
    }

    prevBtn.addEventListener('click', () => scrollToIdx(cur - visible()));
    nextBtn.addEventListener('click', () => scrollToIdx(cur + visible()));
    carousel.addEventListener('scroll', updateDots, { passive: true });
    window.addEventListener('resize', () => { buildDots(); updateDots(); });

    /* Drag */
    let isDown = false, startX, sLeft;
    carousel.addEventListener('mousedown', e => {
        isDown = true; carousel.classList.add('grabbing');
        startX = e.pageX - carousel.offsetLeft; sLeft = carousel.scrollLeft;
    });
    ['mouseleave', 'mouseup'].forEach(ev =>
        carousel.addEventListener(ev, () => { isDown = false; carousel.classList.remove('grabbing'); })
    );
    carousel.addEventListener('mousemove', e => {
        if (!isDown) return; e.preventDefault();
        carousel.scrollLeft = sLeft - (e.pageX - carousel.offsetLeft - startX) * 1.5;
    });

    buildDots();

    /* ══════════════════════════════════════════════
       BADGE FLOTTANT (synchronisé avec window.CART)
    ══════════════════════════════════════════════ */
    const badgeWrap  = document.getElementById('cartBadgeWrap');
    const badgeQty   = document.getElementById('badgeQty');
    const badgePrice = document.getElementById('badgePrice');
    const badgeCount = document.getElementById('badgeCount');

    /* Expose la fonction de sync au layout (appelée après +/- dans Order) */
    window.CART_syncBadge = function () {
        if (!window.CART) return;
        const t = window.CART.totals();
        if (t.qty > 0) {
            badgeWrap.style.display = 'block';
            badgeQty.textContent    = t.qty;
            badgePrice.textContent  = t.sub.toFixed(2);
            badgeCount.textContent  = t.qty;
        } else {
            badgeWrap.style.display = 'none';
        }
    };

    /* ══════════════════════════════════════════════
       BOUTONS PAR CARTE
       ─────────────────────────────────────────────
       qty-plus / qty-minus : modifient le compteur LOCAL de la carte
       btn-add-cart         : envoie la qté choisie vers window.CART
                              → met à jour "Your Selected Items" + totaux
    ══════════════════════════════════════════════ */
    cards.forEach(card => {
        const id       = card.dataset.id;
        const price    = parseFloat(card.dataset.price);
        const name     = card.dataset.name  || card.querySelector('.menu-card-name').textContent.trim();
        const img      = card.dataset.img   || card.querySelector('.menu-card-img').src;
        const qtyEl    = card.querySelector('.qty-value');
        const minusBtn = card.querySelector('.qty-minus');
        const plusBtn  = card.querySelector('.qty-plus');
        const addBtn   = card.querySelector('.btn-add-cart');

        /* Qté locale (affichée dans la carte, pas encore dans le panier) */
        let localQty = 0;

        plusBtn.addEventListener('click', () => {
            localQty++;
            qtyEl.textContent = localQty;
            qtyEl.classList.add('changed');
            setTimeout(() => qtyEl.classList.remove('changed'), 400);
        });

        minusBtn.addEventListener('click', () => {
            if (localQty > 0) {
                localQty--;
                qtyEl.textContent = localQty;
            }
        });

        /* ✅ AJOUTER → envoie localQty (min 1) vers window.CART */
        addBtn.addEventListener('click', () => {
            const qty = localQty > 0 ? localQty : 1;

            /* Attend que window.CART soit prêt (layout chargé avant le yield) */
            if (!window.CART) {
                console.warn('window.CART non disponible — layout non chargé ?');
                return;
            }

            /* ✅ Ajoute la quantité choisie dans le panier partagé */
            window.CART.add(id, name, price, img, qty);

            /* Met à jour le badge flottant */
            window.CART_syncBadge();

            /* Feedback visuel sur le bouton */
            addBtn.classList.add('added');
            addBtn.innerHTML = '✓ Ajouté !';
            setTimeout(() => {
                addBtn.classList.remove('added');
                addBtn.innerHTML = `
                    <svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2.2;stroke-linecap:round">
                        <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                    </svg> Ajouter`;
            }, 1600);

            /* Feedback visuel sur la carte */
            card.style.transition = 'box-shadow .3s';
            card.style.boxShadow  = '0 0 0 2px #27ae60';
            setTimeout(() => { card.style.boxShadow = ''; }, 700);
        });
    });

})();
</script>

@endsection