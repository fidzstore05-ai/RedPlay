<style>
    /* ===== HERO SECTION ===== */
    .hero {
        position: relative;
        height: 88vh;
        min-height: 560px;
        overflow: hidden;
        margin: -2rem -5% 0;
        display: flex;
        align-items: center;
        background: #0a0a0a;
    }

    .hero-ambient {
        position: absolute;
        inset: -30px;
        background-size: cover;
        background-position: center top;
        filter: blur(60px) brightness(0.25) saturate(1.8);
        transform: scale(1.2);
        transition: background-image 1s ease-in-out, opacity 1s;
    }

    .hero-slides {
        position: absolute;
        inset: 0;
        display: flex;
        transition: none;
    }

    .hero-slide {
        position: absolute;
        inset: 0;
        opacity: 0;
        transition: opacity 0.9s ease-in-out;
        display: flex;
        align-items: center;
    }

    .hero-slide.active { opacity: 1; }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to right,
            #0a0a0a 0%,
            #0a0a0a 30%,
            rgba(10,10,10,0.85) 50%,
            rgba(10,10,10,0.3) 75%,
            rgba(10,10,10,0.05) 100%
        );
        z-index: 2;
    }

    .hero-gradient {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 220px;
        background: linear-gradient(to top, #0a0a0a 0%, transparent 100%);
        z-index: 3;
    }

    .hero-poster-wrap {
        position: absolute;
        right: 0; top: 0; bottom: 0;
        width: 55%;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        z-index: 1;
        overflow: hidden;
    }

    .hero-poster-img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        object-position: center top;
        transition: transform 8s ease-out, opacity 0.9s;
        transform: scale(1.06);
        opacity: 0.9;
    }

    .hero-slide.active .hero-poster-img { transform: scale(1); }

    .hero-poster-fade {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to right,
            #0a0a0a 0%,
            rgba(10,10,10,0.6) 20%,
            rgba(10,10,10,0.1) 50%,
            transparent 100%
        );
        z-index: 2;
    }

    .hero-content {
        position: relative;
        z-index: 10;
        padding: 0 3% 2rem 5%;
        max-width: 580px;
        width: 48%;
        animation: heroFadeUp 0.8s ease-out;
    }

    @keyframes heroFadeUp {
        from { opacity: 0; transform: translateY(30px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: rgba(229,9,20,0.25);
        border: 1px solid rgba(229,9,20,0.5);
        color: #ff6b6b;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 1rem;
    }

    .hero-badge::before {
        content: '';
        width: 6px; height: 6px;
        border-radius: 50%;
        background: #e50914;
        animation: pulse 1.5s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50%       { opacity: 0.5; transform: scale(1.3); }
    }

    .hero-title {
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 700;
        line-height: 1.1;
        margin: 0 0 1rem;
        color: #fff;
        text-shadow: 0 2px 20px rgba(0,0,0,0.5);
    }

    .hero-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
        font-size: 0.9rem;
        color: rgba(255,255,255,0.7);
    }

    .hero-rating { color: #f5c518; font-weight: 700; font-size: 1rem; }

    .hero-genres {
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem;
        margin-bottom: 1.2rem;
    }

    .genre-pill {
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        padding: 0.2rem 0.7rem;
        border-radius: 20px;
        font-size: 0.75rem;
        color: rgba(255,255,255,0.8);
    }

    .hero-desc {
        font-size: 0.95rem;
        color: rgba(255,255,255,0.65);
        line-height: 1.7;
        margin-bottom: 2rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .hero-actions { display: flex; gap: 1rem; flex-wrap: wrap; }

    .btn-hero-play {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        background: #e50914;
        color: white;
        padding: 0.9rem 2rem;
        border-radius: 8px;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s;
        box-shadow: 0 4px 20px rgba(229,9,20,0.4);
        text-decoration: none;
    }

    .btn-hero-play:hover {
        background: #ff1f2c;
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(229,9,20,0.6);
        color: white;
    }

    .btn-hero-info {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        background: rgba(255,255,255,0.12);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
        color: white;
        padding: 0.9rem 1.8rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s;
        text-decoration: none;
    }

    .btn-hero-info:hover {
        background: rgba(255,255,255,0.22);
        border-color: rgba(255,255,255,0.4);
        color: white;
    }

    .hero-dots {
        position: absolute;
        bottom: 2rem; right: 5%;
        z-index: 20;
        display: flex;
        gap: 0.5rem;
    }

    .hero-dot {
        width: 8px; height: 8px;
        border-radius: 50%;
        background: rgba(255,255,255,0.3);
        cursor: pointer;
        transition: all 0.3s;
        border: none; padding: 0;
    }

    .hero-dot.active {
        width: 28px;
        border-radius: 4px;
        background: #e50914;
    }

    /* ===== SEARCH BAR ===== */
    .search-bar-wrapper {
        position: relative;
        margin: 2.5rem 0 3rem;
        z-index: 5;
    }

    .search-bar {
        display: flex;
        gap: 0.8rem;
        background: rgba(31,31,31,0.9);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,0.08);
        padding: 0.8rem 1rem;
        border-radius: 14px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.4);
        transition: border-color 0.3s;
    }

    .search-bar:focus-within {
        border-color: rgba(229,9,20,0.5);
        box-shadow: 0 8px 30px rgba(229,9,20,0.15);
    }

    .search-bar .search-icon {
        display: flex;
        align-items: center;
        padding: 0 0.5rem;
        color: var(--gray);
    }

    .search-bar input {
        flex: 2;
        background: transparent;
        border: none;
        color: white;
        font-size: 0.95rem;
        font-family: 'Outfit', sans-serif;
        outline: none;
        padding: 0.3rem 0;
    }

    .search-bar input::placeholder { color: #555; }

    .search-bar select {
        flex: 1;
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 8px;
        color: white;
        font-size: 0.85rem;
        font-family: 'Outfit', sans-serif;
        padding: 0.4rem 0.8rem;
        min-width: 120px;
        cursor: pointer;
    }

    .search-bar select option { background: #1f1f1f; color: white; }

    .btn-search {
        background: linear-gradient(135deg, #e50914, #c8000f);
        color: white;
        border: none;
        padding: 0.7rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        font-family: 'Outfit', sans-serif;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s;
        white-space: nowrap;
    }

    .btn-search:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(229,9,20,0.4);
    }

    /* ===== SECTION HEADERS ===== */
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .section-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: white;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .section-title::before {
        content: '';
        width: 4px; height: 1.4rem;
        background: #e50914;
        border-radius: 2px;
        display: inline-block;
    }

    .section-link {
        color: var(--gray);
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
        transition: color 0.3s;
    }

    .section-link:hover { color: #e50914; }

    /* ===== FILM GRID ===== */
    .film-section { margin-bottom: 3.5rem; }

    .film-row {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(170px, 1fr));
        gap: 1.2rem;
    }

    .film-card {
        border-radius: 10px;
        overflow: hidden;
        background: #181818;
        transition: transform 0.3s, box-shadow 0.3s;
        cursor: pointer;
        position: relative;
    }

    .film-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0,0,0,0.6);
        z-index: 2;
    }

    .film-card:hover .film-card-overlay { opacity: 1; }
    .film-card:hover .film-card-actions { opacity: 1; transform: translateY(0); }

    .film-poster {
        width: 100%;
        aspect-ratio: 2/3;
        object-fit: cover;
        display: block;
        background: #1f1f1f;
    }

    .film-poster-placeholder {
        width: 100%;
        aspect-ratio: 2/3;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        font-size: 2.5rem;
        gap: 0.5rem;
    }

    .film-poster-placeholder span {
        font-size: 0.65rem;
        color: rgba(255,255,255,0.4);
        text-align: center;
        padding: 0 0.5rem;
    }

    .film-card-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.2) 60%, transparent 100%);
        opacity: 0;
        transition: opacity 0.3s;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 1rem;
    }

    .film-card-actions {
        display: flex;
        gap: 0.5rem;
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.3s 0.1s;
    }

    .card-btn {
        flex: 1;
        background: #e50914;
        color: white;
        border: none;
        padding: 0.5rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        cursor: pointer;
        font-family: 'Outfit', sans-serif;
        text-align: center;
        text-decoration: none;
        transition: background 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.3rem;
    }

    .card-btn:hover { background: #ff1f2c; color: white; }

    .film-card-info { padding: 0.8rem; }

    .film-card-title {
        font-size: 0.88rem;
        font-weight: 600;
        margin: 0 0 0.3rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: white;
    }

    .film-card-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.75rem;
        color: var(--gray);
    }

    .film-card-rating { color: #f5c518; font-weight: 700; font-size: 0.8rem; }
    .film-card-year   { color: #666; }

    .rating-badge {
        position: absolute;
        top: 0.6rem; right: 0.6rem;
        background: rgba(0,0,0,0.75);
        backdrop-filter: blur(5px);
        border-radius: 5px;
        padding: 0.2rem 0.5rem;
        font-size: 0.72rem;
        font-weight: 700;
        color: #f5c518;
        display: flex;
        align-items: center;
        gap: 0.2rem;
    }

    /* ===== STATS BAR ===== */
    .stats-bar {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-bottom: 3rem;
        padding: 1.5rem;
        background: rgba(31,31,31,0.6);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 14px;
    }

    .stat-item {
        text-align: center;
        border-right: 1px solid rgba(255,255,255,0.05);
    }

    .stat-item:last-child { border-right: none; }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        background: linear-gradient(135deg, #e50914, #ff6b6b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .stat-label {
        font-size: 0.78rem;
        color: var(--gray);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* ===== GENRE SECTION ===== */
    .genre-section { margin-bottom: 3.5rem; }

    .genre-row {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        gap: 1rem;
    }

    .genre-card {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        padding: 1.8rem 1rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        min-height: 100px;
    }

    .genre-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.5);
        color: white;
    }

    .genre-card .genre-icon  { font-size: 2rem; }
    .genre-card .genre-name  { font-weight: 700; font-size: 0.9rem; color: white; }
    .genre-card .genre-count { font-size: 0.75rem; opacity: 0.7; color: rgba(255,255,255,0.7); }

    /* ===== FEATURED CARDS ===== */
    .featured-row {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        gap: 1.2rem;
        margin-bottom: 3.5rem;
    }

    .featured-card {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        cursor: pointer;
        transition: transform 0.3s, box-shadow 0.3s;
        text-decoration: none;
    }

    .featured-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.5);
    }

    .featured-card-img {
        width: 100%;
        height: 100%;
        min-height: 240px;
        object-fit: cover;
        display: block;
    }

    .featured-card-placeholder {
        width: 100%;
        min-height: 240px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        background: linear-gradient(135deg, #1a1a2e, #16213e, #0f3460);
    }

    .featured-card-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, transparent 60%);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 1.5rem;
    }

    .featured-play-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: rgba(229,9,20,0.9);
        color: white;
        padding: 0.4rem 0.9rem;
        border-radius: 5px;
        font-size: 0.78rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        width: fit-content;
    }

    .featured-card-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: white;
        margin: 0 0 0.3rem;
    }

    .featured-card-meta        { font-size: 0.78rem; color: rgba(255,255,255,0.6); }
    .featured-card-metarating  { color: #f5c518; font-weight: 600; }

    /* ===== SCROLLABLE ROW ===== */
    .film-scroll-row {
        display: flex;
        gap: 1rem;
        overflow-x: auto;
        padding-bottom: 0.8rem;
        scroll-behavior: smooth;
        scrollbar-width: thin;
        scrollbar-color: #333 transparent;
    }

    .film-scroll-row::-webkit-scrollbar        { height: 4px; }
    .film-scroll-row::-webkit-scrollbar-track  { background: transparent; }
    .film-scroll-row::-webkit-scrollbar-thumb  { background: #333; border-radius: 2px; }

    .film-scroll-card {
        flex: 0 0 170px;
        border-radius: 10px;
        overflow: hidden;
        background: #181818;
        transition: transform 0.3s, box-shadow 0.3s;
        cursor: pointer;
        position: relative;
    }

    .film-scroll-card:hover {
        transform: translateY(-6px) scale(1.03);
        box-shadow: 0 15px 30px rgba(0,0,0,0.5);
        z-index: 2;
    }

    .film-scroll-card:hover .film-card-overlay  { opacity: 1; }
    .film-scroll-card:hover .film-card-actions  { opacity: 1; transform: translateY(0); }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        grid-column: 1/-1;
        text-align: center;
        padding: 5rem 2rem;
        color: var(--gray);
    }

    .empty-state .empty-icon { font-size: 4rem; margin-bottom: 1rem; opacity: 0.4; }
    .empty-state h3          { font-size: 1.2rem; margin-bottom: 0.5rem; color: #555; }

    /* ===== PAGINATION ===== */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 3rem;
    }

    .pagination {
        display: flex;
        list-style: none;
        gap: 0.4rem;
        padding: 0; margin: 0;
    }

    .pagination li a,
    .pagination li span {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px; height: 38px;
        border-radius: 8px;
        background: rgba(31,31,31,0.9);
        border: 1px solid rgba(255,255,255,0.08);
        color: white;
        font-size: 0.85rem;
        transition: all 0.2s;
        font-family: 'Outfit', sans-serif;
    }

    .pagination li.active span {
        background: #e50914;
        border-color: #e50914;
        font-weight: 700;
    }

    .pagination li a:hover {
        background: rgba(229,9,20,0.2);
        border-color: rgba(229,9,20,0.4);
        color: white;
    }

    /* ===== SEARCH RESULTS ===== */
    .results-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(255,255,255,0.06);
    }

    .results-title         { font-size: 1.3rem; font-weight: 700; }
    .results-title span    { color: #e50914; }

    .results-count {
        font-size: 0.85rem;
        color: var(--gray);
        background: rgba(255,255,255,0.05);
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
    }

    /* ===== ANIMATIONS ===== */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .film-card, .genre-card, .featured-card {
        animation: fadeInUp 0.5s ease-out both;
    }

    .film-card:nth-child(1) { animation-delay: 0.05s; }
    .film-card:nth-child(2) { animation-delay: 0.10s; }
    .film-card:nth-child(3) { animation-delay: 0.15s; }
    .film-card:nth-child(4) { animation-delay: 0.20s; }
    .film-card:nth-child(5) { animation-delay: 0.25s; }
    .film-card:nth-child(6) { animation-delay: 0.30s; }
</style>
