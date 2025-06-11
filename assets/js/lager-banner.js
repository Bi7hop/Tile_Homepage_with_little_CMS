document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
        setupLagerBanner();
    }, 100);
});

function setupLagerBanner() {
    if (localStorage.getItem('lagerBannerClosed') === 'true' || 
        localStorage.getItem('lagerBannerClosed') === 'permanent') {
        return; 
    }
    
    if (document.getElementById('lager-banner')) {
        return; 
    }
    
    createLagerBanner();
    
    showLagerBanner();
    
    setupBannerEvents();
}

function createLagerBanner() {
    if (document.getElementById('lager-banner')) {
        return;
    }
    
    const banner = document.createElement('div');
    banner.id = 'lager-banner';
    banner.className = 'lager-banner';
    
    banner.innerHTML = `
        <div class="lager-banner-content">
            <span class="lager-banner-icon">🛍️</span>
            <span class="lager-banner-text">
                LAGERVERKAUF FREITAG 13-18 UHR | Sonderposten & Auslaufserien
            </span>
            <span class="lager-banner-icon">🔥</span>
        </div>
        <button class="lager-banner-close" id="lager-banner-close" aria-label="Banner schließen">
            ×
        </button>
    `;
    
    document.body.appendChild(banner);
}

function showLagerBanner() {
    const banner = document.getElementById('lager-banner');
    const body = document.body;
    
    if (banner) {
        body.classList.add('lager-banner-active');
        
        setTimeout(() => {
            banner.style.display = 'flex';
        }, 100);
    }
}

function hideLagerBanner() {
    const banner = document.getElementById('lager-banner');
    const body = document.body;
    
    if (banner) {
        banner.classList.add('hidden');
        
        body.classList.remove('lager-banner-active');
        
        setTimeout(() => {
            if (banner.parentNode) {
                banner.parentNode.removeChild(banner);
            }
        }, 300);
        
        localStorage.setItem('lagerBannerClosed', 'true');
        
        setTimeout(() => {
            localStorage.removeItem('lagerBannerClosed');
        }, 24 * 60 * 60 * 1000);
    }
}

function setupBannerEvents() {
    document.addEventListener('click', function(e) {
        if (e.target && e.target.id === 'lager-banner-close') {
            hideLagerBanner();
        }
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const banner = document.getElementById('lager-banner');
            if (banner && !banner.classList.contains('hidden')) {
                hideLagerBanner();
            }
        }
    });
    
    // Optional: Banner nach bestimmter Zeit automatisch ausblenden
    // setTimeout(() => {
    //     hideLagerBanner();
    // }, 30000); // 30 Sekunden
}

function showLagerBannerManual() {
    localStorage.removeItem('lagerBannerClosed');
    
    const existingBanner = document.getElementById('lager-banner');
    if (existingBanner) {
        existingBanner.remove();
        document.body.classList.remove('lager-banner-active');
    }
    
    createLagerBanner();
    showLagerBanner();
    setupBannerEvents();
}

function hideLagerBannerPermanent() {
    const banner = document.getElementById('lager-banner');
    if (banner) {
        hideLagerBanner();
    }
    localStorage.setItem('lagerBannerClosed', 'permanent');
}

window.showLagerBannerManual = showLagerBannerManual;
window.hideLagerBannerPermanent = hideLagerBannerPermanent;