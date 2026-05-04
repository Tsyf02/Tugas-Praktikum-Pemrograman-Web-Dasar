// - "SIPEMANDIRI Main" - "JavaScript" -

document.addEventListener('DOMContentLoaded', function () {

    
          // SIDEBAR TOGGLE (mobile)
    const sidebar       = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');

    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function () {
            sidebar.classList.toggle('open');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function (e) {
            if (window.innerWidth <= 900 &&
                !sidebar.contains(e.target) &&
                !sidebarToggle.contains(e.target)) {
                sidebar.classList.remove('open');
            }
        });
    }

    
          // ACTIVE NAV HIGHLIGHT
    const currentPath = window.location.pathname.split('/').pop();
    document.querySelectorAll('.nav-item').forEach(function (link) {
        const href = link.getAttribute('href');
        if (href && href === currentPath) {
            link.classList.add('active');
        }
    });

    
            // AUTO-DISMISS ALERTS
    document.querySelectorAll('.alert').forEach(function (alert) {
        setTimeout(function () {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity    = '0';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });

    
            // TOPBAR: update date/time
    const clockEl = document.getElementById('liveClock');
    if (clockEl) {
        function updateClock() {
            const now = new Date();
            clockEl.textContent = now.toLocaleTimeString('id-ID', {
                hour: '2-digit', minute: '2-digit', second: '2-digit'
            });
        }
        updateClock();
        setInterval(updateClock, 1000);
    }


          // TABLE: Row selection highlight
    document.querySelectorAll('tbody tr').forEach(function (row) {
        row.addEventListener('click', function (e) {
            // Don't trigger on button clicks inside rows
            if (e.target.closest('button') || e.target.closest('a')) return;
            document.querySelectorAll('tbody tr').forEach(r => r.classList.remove('selected'));
            this.classList.add('selected');
        });
    });


    // CHART.JS: Load from CDN if not present
    if (typeof Chart === 'undefined' && document.querySelector('canvas')) {
        const script    = document.createElement('script');
        script.src      = 'https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js';
        script.onload   = function () { console.log('Chart.js loaded'); };
        document.head.appendChild(script);
    }

  
          // FORM: Input animation KE focus
    document.querySelectorAll('input, select, textarea').forEach(function (el) {
        el.addEventListener('focus', function () {
            this.closest('.form-group')?.classList.add('focused');
        });
        el.addEventListener('blur', function () {
            this.closest('.form-group')?.classList.remove('focused');
        });
    });

  \
            // CONFIRM DELETE on data-confirm links
    document.querySelectorAll('[data-confirm]').forEach(function (el) {
        el.addEventListener('click', function (e) {
            if (!confirm(this.dataset.confirm)) {
                e.preventDefault();
            }
        });
    });

  
                // SCROLL ANIMATION (fade-up elements)
    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.fade-up').forEach(function (el) {
            // <Bolehin> CSS animation-delay to work; just trigger "visibility."
        observer.observe(el);
    });

   
            // NIK -> "AUTO-FORMAT"
   
    const nikInput = document.getElementById('nik');
    if (nikInput) {
        nikInput.addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '').slice(0, 16);
        });
    }

          // TOOLTIP
  
    document.querySelectorAll('[title]').forEach(function (el) {
        el.addEventListener('mouseenter', function () {
            const tooltip = document.createElement('div');
            tooltip.className   = 'sipemandiri-tooltip';
            tooltip.textContent = this.title;
            tooltip.style.cssText = `
                position: fixed;
                background: #0f2554;
                color: white;
                padding: 5px 10px;
                border-radius: 6px;
                font-size: 12px;
                font-family: var(--font-body, sans-serif);
                z-index: 9999;
                pointer-events: none;
                white-space: nowrap;
                box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            `;
            document.body.appendChild(tooltip);

            const rect = this.getBoundingClientRect();
            tooltip.style.top  = (rect.bottom + 6) + 'px';
            tooltip.style.left = (rect.left + rect.width / 2 - tooltip.offsetWidth / 2) + 'px';

            this._tooltip = tooltip;
        });

        el.addEventListener('mouseleave', function () {
            if (this._tooltip) {
                this._tooltip.remove();
                this._tooltip = null;
            }
        });
    });

    console.log('%cSIPEMANDIRI v1.0', 'color:#e8a020; background:#0f2554; padding:4px 12px; border-radius:4px; font-weight:800;');
});


        // GLOBAL PENOLONG _ BAIK:)
        
        // Format angka ke format INDONESIA SIH
        // *Contoh: dari ini   1234567 → "1.234.567" ke jadi itu

function formatAngka(n) {
    return parseInt(n).toLocaleString('id-ID');
}

        // Format tanggal ke format yang INDONESIA !
        // Misal:
        //  *Contoh nya: awalnya "2024-05-01" → jadi ini sih "1 Mei 2024".
function formatTanggal(dateStr) {
    const months = ['Januari','Februari','Maret','April','Mei','Juni',
                    'Juli','Agustus','September','Oktober','November','Desember'];
    const d = new Date(dateStr);
    return d.getDate() + ' ' + months[d.getMonth()] + ' ' + d.getFullYear();
}

         // PRINNT CURRENT Page
function cetakHalaman() {
    window.print();
}
