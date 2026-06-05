@extends('admin.maindesign')
@section('showFood')

<style>
  @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:wght@600;700&display=swap');

  .sf-wrap {
    padding: 2.4rem 2rem 3rem;
    font-family: 'DM Sans', sans-serif;
    animation: sf-rise 0.55s cubic-bezier(0.22,1,0.36,1) both;
  }

  @keyframes sf-rise {
    from { opacity:0; transform:translateY(20px); }
    to   { opacity:1; transform:translateY(0); }
  }

  /* ── Toast notification ── */
  .sf-toast {
    position: fixed;
    top: 1.5rem;
    right: 1.5rem;
    z-index: 9999;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    background: #12181f;
    border: 1px solid rgba(52,211,153,0.35);
    border-left: 3px solid #6634d3;
    border-radius: 12px;
    padding: 0.9rem 1.2rem;
    min-width: 260px;
    max-width: 360px;
    box-shadow: 0 16px 48px rgba(0,0,0,0.55), 0 0 0 1px rgba(255,255,255,0.03);
    animation: sf-toast-in 0.45s cubic-bezier(0.22,1,0.36,1) both;
  }

  @keyframes sf-toast-in {
    from { opacity:0; transform: translateX(30px) scale(0.96); }
    to   { opacity:1; transform: translateX(0) scale(1); }
  }

  .sf-toast-out {
    animation: sf-toast-fade 0.5s cubic-bezier(0.4,0,1,1) forwards !important;
  }

  @keyframes sf-toast-fade {
    to { opacity:0; transform: translateX(20px) scale(0.95); }
  }

  .sf-toast-icon {
    width: 32px;
    height: 32px;
    background: rgba(52,211,153,0.12);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .sf-toast-icon svg {
    width: 15px; height: 15px;
    stroke: #8e34d3;
    fill: none;
    stroke-width: 2.2;
    stroke-linecap: round;
    stroke-linejoin: round;
  }

  .sf-toast-body {
    flex: 1;
  }

  .sf-toast-body strong {
    display: block;
    font-size: 0.82rem;
    font-weight: 600;
    color: #e2e8f0;
    margin-bottom: 0.1rem;
  }

  .sf-toast-body span {
    font-size: 0.75rem;
    color: #4a5a6e;
  }

  .sf-toast-close {
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
    color: #3d4a5e;
    display: flex;
    align-items: center;
    transition: color .2s;
  }

  .sf-toast-close:hover { color: #e2e8f0; }

  .sf-toast-close svg {
    width: 14px; height: 14px;
    stroke: currentColor;
    fill: none;
    stroke-width: 2;
    stroke-linecap: round;
  }

  .sf-toast-bar {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 2px;
    background: linear-gradient(90deg, #9934d3, rgba(52,211,153,0.2));
    border-radius: 0 0 0 12px;
    animation: sf-toast-bar 3s linear forwards;
  }

  @keyframes sf-toast-bar {
    from { width: 100%; }
    to   { width: 0%; }
  }

  /* ── Top bar ── */
  .sf-topbar {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    margin-bottom: 2rem;
    gap: 1rem;
    flex-wrap: wrap;
  }

  .sf-eyebrow {
    display: flex;
    align-items: center;
    gap: 0.45rem;
    margin-bottom: 0.55rem;
  }

  .sf-eyebrow span {
    display: block;
    width: 22px;
    height: 2.5px;
    background: #e05252;
    border-radius: 2px;
  }

  .sf-eyebrow em {
    font-style: normal;
    font-size: 0.68rem;
    font-weight: 600;
    letter-spacing: 0.13em;
    text-transform: uppercase;
    color: #e05252;
  }

  .sf-title-block h2 {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem;
    color: #f0f4f8;
    margin: 0;
    line-height: 1.15;
  }

  .sf-topbar-right {
    display: flex;
    align-items: center;
    gap: 0.9rem;
    flex-wrap: wrap;
  }

  .sf-count {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    background: rgba(224,82,82,0.1);
    border: 1px solid rgba(224,82,82,0.2);
    color: #e05252;
    border-radius: 20px;
    padding: 0.38rem 0.95rem;
    font-size: 0.76rem;
    font-weight: 600;
    letter-spacing: 0.06em;
  }

  /* ── Search ── */
  .sf-search-wrap {
    position: relative;
  }

  .sf-search-wrap .sf-search-ico {
    position: absolute;
    left: 11px;
    top: 50%;
    transform: translateY(-50%);
    width: 14px; height: 14px;
    stroke: #3d4a5e;
    fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    pointer-events: none;
    transition: stroke .2s;
  }

  .sf-search-wrap:focus-within .sf-search-ico { stroke: #e05252; }

  #sfSearch {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 9px;
    color: #dde4ef;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.84rem;
    padding: 0.6rem 1rem 0.6rem 2.25rem;
    outline: none;
    width: 200px;
    transition: border-color .2s, box-shadow .2s, background .2s;
  }

  #sfSearch:focus {
    border-color: rgba(224,82,82,.4);
    background: rgba(224,82,82,.04);
    box-shadow: 0 0 0 3px rgba(224,82,82,.1);
  }

  #sfSearch::placeholder { color: #2a3445; }

  /* ── Table container ── */
  .sf-table-box {
    background: linear-gradient(160deg, #1e2330 0%, #181c28 100%);
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 24px 64px rgba(0,0,0,0.45), inset 0 1px 0 rgba(255,255,255,0.05);
  }

  .sf-table-scroll { overflow-x: auto; }

  table.sf-table {
    width: 100%;
    border-collapse: collapse;
  }

  /* ── Head ── */
  thead.sf-thead tr {
    background: rgba(255,255,255,0.025);
    border-bottom: 1px solid rgba(255,255,255,0.06);
  }

  thead.sf-thead th {
    padding: 1rem 1.25rem;
    text-align: left;
    font-size: 0.65rem;
    font-weight: 700;
    letter-spacing: 0.13em;
    text-transform: uppercase;
    color: #3d4a5e;
    white-space: nowrap;
  }

  thead.sf-thead th:first-child { padding-left: 1.6rem; }
  thead.sf-thead th:last-child  { padding-right: 1.6rem; text-align: center; }

  /* ── Body ── */
  tbody tr {
    border-bottom: 1px solid rgba(255,255,255,0.035);
    transition: background .18s;
    animation: sf-rise 0.4s cubic-bezier(0.22,1,0.36,1) both;
  }

  tbody tr:nth-child(1)  { animation-delay: .04s; }
  tbody tr:nth-child(2)  { animation-delay: .08s; }
  tbody tr:nth-child(3)  { animation-delay: .12s; }
  tbody tr:nth-child(4)  { animation-delay: .16s; }
  tbody tr:nth-child(5)  { animation-delay: .20s; }
  tbody tr:nth-child(6)  { animation-delay: .24s; }
  tbody tr:nth-child(7)  { animation-delay: .28s; }
  tbody tr:nth-child(8)  { animation-delay: .32s; }
  tbody tr:nth-child(9)  { animation-delay: .36s; }
  tbody tr:nth-child(10) { animation-delay: .40s; }

  tbody tr:last-child { border-bottom: none; }
  tbody tr:hover { background: rgba(255,255,255,0.022); }

  tbody td {
    padding: 1rem 1.25rem;
    vertical-align: middle;
    font-size: 0.88rem;
    color: #c8d0dc;
  }

  tbody td:first-child { padding-left: 1.6rem; }
  tbody td:last-child  { padding-right: 1.6rem; text-align: center; }

  /* ── Image ── */
  .sf-img {
    width: 50px;
    height: 50px;
    border-radius: 11px;
    object-fit: cover;
    border: 1px solid rgba(255,255,255,0.07);
    background: #1a1f2e;
    display: block;
    transition: transform .2s, box-shadow .2s;
  }

  .sf-img:hover {
    transform: scale(1.08);
    box-shadow: 0 6px 20px rgba(0,0,0,0.5);
  }

  .sf-img-placeholder {
    width: 50px;
    height: 50px;
    border-radius: 11px;
    background: rgba(224,82,82,0.07);
    border: 1px dashed rgba(224,82,82,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .sf-img-placeholder svg {
    width: 18px; height: 18px;
    stroke: rgba(224,82,82,0.35);
    fill: none;
    stroke-width: 1.6;
    stroke-linecap: round;
    stroke-linejoin: round;
  }

  /* ── Name ── */
  .sf-name {
    font-weight: 600;
    color: #e8edf5;
    font-size: 0.92rem;
  }

  /* ── Description ── */
  .sf-detail {
    max-width: 230px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    color: #4a5a70;
    font-size: 0.81rem;
    font-style: italic;
  }

  /* ── Price badge ── */
  .sf-price {
    display: inline-flex;
    align-items: center;
    background: rgba(52,211,153,0.07);
    border: 1px solid rgba(52,211,153,0.18);
    color: #3a0736;
    border-radius: 8px;
    padding: 0.3rem 0.75rem;
    font-size: 0.82rem;
    font-weight: 600;
    letter-spacing: 0.04em;
    white-space: nowrap;
  }

  /* ── Actions ── */
  .sf-actions {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.45rem;
  }

  .sf-btn-edit,
  a.sf-btn-del {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 33px;
    height: 33px;
    border-radius: 8px;
    border: 1px solid transparent;
    cursor: pointer;
    transition: background .18s, border-color .18s, transform .15s, box-shadow .18s;
    background: transparent;
    padding: 0;
    text-decoration: none;
  }

  .sf-btn-edit {
    border-color: rgba(99,179,237,0.2);
    color: #63b3ed;
  }

  .sf-btn-edit:hover {
    background: rgba(99,179,237,0.1);
    border-color: rgba(99,179,237,0.4);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(99,179,237,0.15);
  }

  a.sf-btn-del {
    border-color: rgba(224,82,82,0.2);
    color: #e05252;
  }

  a.sf-btn-del:hover {
    background: rgba(224,82,82,0.1);
    border-color: rgba(224,82,82,0.4);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(224,82,82,0.18);
  }

  .sf-btn-edit svg,
  a.sf-btn-del svg {
    width: 14px; height: 14px;
    stroke: currentColor;
    fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
    pointer-events: none;
  }

  /* ── Empty state ── */
  .sf-empty {
    padding: 4.5rem 2rem;
    text-align: center;
  }

  .sf-empty-icon {
    width: 64px;
    height: 64px;
    background: rgba(224,82,82,0.07);
    border: 1px dashed rgba(224,82,82,0.2);
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.3rem;
  }

  .sf-empty-icon svg {
    width: 28px; height: 28px;
    stroke: rgba(224,82,82,0.35);
    fill: none;
    stroke-width: 1.5;
    stroke-linecap: round;
    stroke-linejoin: round;
  }

  .sf-empty h3 {
    font-family: 'Playfair Display', serif;
    font-size: 1.15rem;
    color: #3d4a5e;
    margin: 0 0 0.4rem;
  }

  .sf-empty p {
    font-size: 0.8rem;
    color: #28334a;
    margin: 0;
  }

  /* ── No results row ── */
  .sf-no-results {
    text-align: center;
    padding: 3rem;
    color: #3d4a5e;
    font-size: 0.85rem;
    font-style: italic;
    display: none;
  }
</style>

{{-- Toast --}}
@if(session('success'))
<div class="sf-toast" id="sfToast">
  <div class="sf-toast-icon">
    <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
  </div>
  <div class="sf-toast-body">
    <strong>Success</strong>
    <span>{{ session('success') }}</span>
  </div>
  <button class="sf-toast-close" onclick="sfDismissToast()">
    <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
  </button>
  <div class="sf-toast-bar"></div>
</div>
@endif

<div class="sf-wrap">

  {{-- Top bar --}}
  <div class="sf-topbar">
    <div class="sf-title-block">
      <div class="sf-eyebrow">
        <span></span>
        <em>Menu Items</em>
      </div>
      <h2>Food List</h2>
    </div>

    <div class="sf-topbar-right">
      <span class="sf-count">
        {{ $foods->count() }} {{ Str::plural('item', $foods->count()) }}
      </span>
      <div class="sf-search-wrap">
        <svg class="sf-search-ico" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input id="sfSearch" type="text" placeholder="Search food…" oninput="sfFilter(this.value)">
      </div>
    </div>
  </div>

  {{-- Table --}}
  <div class="sf-table-box">
    @if($foods->isEmpty())
      <div class="sf-empty">
        <div class="sf-empty-icon">
          <svg viewBox="0 0 24 24"><path d="M3 11l19-9-9 19-2-8-8-2z"/></svg>
        </div>
        <h3>No food items yet</h3>
        <p>Head over to Add Food to create your first menu item.</p>
      </div>
    @else
      <div class="sf-table-scroll">
        <table class="sf-table" id="sfTable">
          <thead class="sf-thead">
            <tr>
              <th>Photo</th>
              <th>Name</th>
              <th>Description</th>
              <th>Price</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($foods as $food)
            <tr>
              <td>
                @if($food->image)
                  <img class="sf-img" src="{{ asset('food_img/' . $food->image) }}" alt="{{ $food->Food_name }}">
                @else
                  <div class="sf-img-placeholder">
                    <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                  </div>
                @endif
              </td>
              <td><span class="sf-name">{{ $food->Food_name }}</span></td>
              <td><span class="sf-detail" title="{{ $food->Food_detail }}">{{ $food->Food_detail }}</span></td>
              <td><span class="sf-price">DH {{ number_format($food->Food_price, 2) }}</span></td>
              <td>
                <div class="sf-actions">
                    <a href="{{ route('admin.editFood', $food->id) }}" class="sf-btn-edit" title="Edit">
                        <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    </a>
                  <a href="{{ route('admin.deleteFood', $food->id) }}"
                     onclick="return confirm('Are you sure you want to delete this item?')"
                     class="sf-btn-del"
                     title="Delete">
                    <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                  </a>
                </div>
              </td>
            </tr>
            @endforeach
            <tr class="sf-no-results" id="sfNoResults">
              <td colspan="5">No results found.</td>
            </tr>
          </tbody>
        </table>
      </div>
    @endif
  </div>

</div>

<script>
  // ── Search filter ──
  function sfFilter(query) {
    const rows    = document.querySelectorAll('#sfTable tbody tr:not(#sfNoResults)');
    const noRes   = document.getElementById('sfNoResults');
    const q       = query.toLowerCase().trim();
    let   visible = 0;

    rows.forEach(row => {
      const match = row.innerText.toLowerCase().includes(q);
      row.style.display = match ? '' : 'none';
      if (match) visible++;
    });

    if (noRes) noRes.style.display = visible === 0 ? 'table-row' : 'none';
  }

  // ── Toast auto-dismiss ──
  const toast = document.getElementById('sfToast');
  let toastTimer;

  function sfDismissToast() {
    if (!toast) return;
    clearTimeout(toastTimer);
    toast.classList.add('sf-toast-out');
    setTimeout(() => toast && toast.remove(), 500);
  }

  if (toast) {
    toastTimer = setTimeout(sfDismissToast, 3500);
  }
</script>

@endsection