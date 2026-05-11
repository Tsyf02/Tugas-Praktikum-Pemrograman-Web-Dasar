/* ===== DARK MODE ===== */

function initDarkMode() {
    const isDark = localStorage.getItem('darkMode') === 'true';
    if (isDark) document.body.classList.add('dark-mode');
    updateDarkModeUI();
}

function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
    const isDark = document.body.classList.contains('dark-mode');
    localStorage.setItem('darkMode', isDark);
    updateDarkModeUI();
}

function updateDarkModeUI() {
    const toggle = document.getElementById('darkModeToggle');
    const icon   = document.getElementById('darkModeIcon');
    const text   = document.getElementById('darkModeText');
    if (!toggle) return;
    const isDark = document.body.classList.contains('dark-mode');
    toggle.checked = isDark;
    if (icon) icon.textContent = isDark ? '🌙' : '☀️';
    if (text) text.textContent = isDark ? 'Dark' : 'Light';
}

/* ===== LANGUAGE ===== */

const translations = {
    id: {
        nav_beranda: 'Beranda', nav_pendataan: 'Pendataan', nav_pemetaan: 'Pemetaan',
        nav_statistik: 'Statistik', nav_tentang: 'Tentang', nav_kelola_user: 'Kelola User',
        nav_tambah_user: '+ Tambah User', nav_logout: 'Logout', nav_login: 'Login',
        nav_profil: 'Profil',
        hero_title: 'Sistem Informasi Pemetaan Lokasi & Data Mandiri Penduduk Non-Permanen (Kontrak & Kost) Berbasis Web',
        hero_desc: 'Website modern berbasis PHP dan MySQL untuk membantu pendataan masyarakat non-permanen seperti penghuni kost dan rumah kontrakan secara digital.',
        btn_mulai: 'Mulai Pendataan', btn_tambah_data: '+ Tambah Data Penduduk',
        card_total: 'Total Penduduk', card_kost: 'Penghuni Kost', card_kontrak: 'Penghuni Kontrak', card_lokasi: 'Total Lokasi',
        table_no: 'No', table_nama: 'Nama', table_alamat: 'Alamat', table_nohp: 'No HP',
        table_jenis: 'Jenis Tinggal', table_status: 'Status', table_aksi: 'Aksi',
        btn_edit: 'Edit', btn_hapus: 'Hapus', btn_simpan: 'Simpan', btn_update: 'Update', btn_tutup: 'Tutup', btn_tambah: '+ Tambah Data',
        modal_tambah: 'Tambah Data Penduduk', modal_edit: 'Edit Data Penduduk',
        placeholder_nama: 'Nama Lengkap', placeholder_alamat: 'Alamat Tinggal', placeholder_nohp: 'Nomor HP',
        peta_title: 'Pemetaan Lokasi Penduduk', peta_desc: 'Halaman ini digunakan untuk melihat persebaran lokasi penghuni kost dan kontrakan.',
        stat_chart_title: 'Perbandingan Data Penduduk', stat_label: 'Jumlah',
        about_title: 'Tentang Sistem Informasi',
        manage_title: 'Daftar Akun User',
        footer_text: '© 2026 Sistem Informasi Penduduk Non-Permanen Berbasis Web'
    },
    en: {
        nav_beranda: 'Home', nav_pendataan: 'Data Entry', nav_pemetaan: 'Mapping',
        nav_statistik: 'Statistics', nav_tentang: 'About', nav_kelola_user: 'Manage Users',
        nav_tambah_user: '+ Add User', nav_logout: 'Logout', nav_login: 'Login',
        nav_profil: 'Profile',
        hero_title: 'Web-Based Information System for Location Mapping & Data of Non-Permanent Residents (Rent & Boarding)',
        hero_desc: 'A modern PHP & MySQL website to help digitally record non-permanent residents such as boarding house and rental residents.',
        btn_mulai: 'Start Data Entry', btn_tambah_data: '+ Add Resident Data',
        card_total: 'Total Residents', card_kost: 'Boarding House', card_kontrak: 'Rent House', card_lokasi: 'Total Locations',
        table_no: 'No', table_nama: 'Name', table_alamat: 'Address', table_nohp: 'Phone No',
        table_jenis: 'Residence Type', table_status: 'Status', table_aksi: 'Action',
        btn_edit: 'Edit', btn_hapus: 'Delete', btn_simpan: 'Save', btn_update: 'Update', btn_tutup: 'Close', btn_tambah: '+ Add Data',
        modal_tambah: 'Add Resident Data', modal_edit: 'Edit Resident Data',
        placeholder_nama: 'Full Name', placeholder_alamat: 'Address', placeholder_nohp: 'Phone Number',
        peta_title: 'Resident Location Mapping', peta_desc: 'This page is used to view the distribution of boarding house and rental residents.',
        stat_chart_title: 'Resident Data Comparison', stat_label: 'Count',
        about_title: 'About Information System',
        manage_title: 'User Accounts List',
        footer_text: '© 2026 Web-Based Non-Permanent Resident Information System'
    }
};

let currentLang = localStorage.getItem('language') || 'id';

function t(key) {
    return (translations[currentLang] && translations[currentLang][key]) ? translations[currentLang][key] : key;
}

function initLanguage() {
    currentLang = localStorage.getItem('language') || 'id';
    applyTranslations();
    updateLangToggleUI();
}

function toggleLanguage() {
    currentLang = currentLang === 'id' ? 'en' : 'id';
    localStorage.setItem('language', currentLang);
    applyTranslations();
    updateLangToggleUI();
}

function updateLangToggleUI() {
    const toggle = document.getElementById('langToggle');
    const icon   = document.getElementById('langIcon');
    const text   = document.getElementById('langText');
    if (!toggle) return;
    const isEn = currentLang === 'en';
    toggle.checked = isEn;
    if (icon) icon.textContent = isEn ? '🇬🇧' : '🇮🇩';
    if (text) text.textContent = isEn ? 'EN' : 'ID';
}

function applyTranslations() {
    document.querySelectorAll('[data-i18n]').forEach(el => {
        const key = el.getAttribute('data-i18n');
        const val = t(key);
        if (!val || val === key) return;
        if (el.tagName === 'INPUT' && el.hasAttribute('placeholder')) {
            el.placeholder = val;
        } else {
            el.textContent = val;
        }
    });
}

/* ===== TOAST NOTIFICATION ===== */
function showToast(message, type = 'info', duration = 3500) {
    let toast = document.getElementById('globalToast');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'globalToast';
        toast.className = 'toast';
        document.body.appendChild(toast);
    }
    const icons = { success: '✅', error: '❌', info: 'ℹ️' };
    toast.innerHTML = `<span>${icons[type] || 'ℹ️'}</span><span>${message}</span>`;
    toast.className = `toast ${type}`;
    requestAnimationFrame(() => {
        requestAnimationFrame(() => { toast.classList.add('show'); });
    });
    clearTimeout(toast._timer);
    toast._timer = setTimeout(() => {
        toast.classList.remove('show');
    }, duration);
}

/* ===== INIT ===== */
document.addEventListener('DOMContentLoaded', () => {
    initDarkMode();
    initLanguage();
});
