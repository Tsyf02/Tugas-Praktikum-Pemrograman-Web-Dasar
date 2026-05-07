function initDarkMode() {
    const darkMode = localStorage.getItem('darkMode') === 'true';
    if (darkMode) {
        document.body.classList.add('dark-mode');
    }
    updateDarkModeToggleUI();
}

function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
    const isDark = document.body.classList.contains('dark-mode');
    localStorage.setItem('darkMode', isDark);
    updateDarkModeToggleUI();
}

function updateDarkModeToggleUI() {
    const toggle = document.getElementById('darkModeToggle');
    const icon = document.getElementById('darkModeIcon');
    const text = document.getElementById('darkModeText');
    if (toggle) {
        const isDark = document.body.classList.contains('dark-mode');
        toggle.checked = isDark;
        if (icon) icon.textContent = isDark ? '🌙' : '☀️';
        if (text) text.textContent = isDark ? 'Dark' : 'Light';
    }
}

const translations = {
    id: {
        // Navigation
        nav_beranda: 'Beranda',
        nav_pendataan: 'Pendataan',
        nav_pemetaan: 'Pemetaan',
        nav_statistik: 'Statistik',
        nav_tentang: 'Tentang',
        nav_kelola_user: 'Kelola User',
        nav_tambah_user: '+ Tambah User',
        nav_logout: 'Logout',
        nav_login: 'Login',
        nav_daftar_akun: 'Daftar Akun',
        
        // Hero Section
        hero_title: 'Sistem Informasi Pemetaan Lokasi & Data Mandiri Penduduk Non-Permanen (Kontrak & Kost) Berbasis Web',
        hero_desc: 'Website modern berbasis PHP dan MySQL untuk membantu pendataan masyarakat non-permanen seperti penghuni kost dan rumah kontrakan secara digital.',
        btn_mulai: 'Mulai Pendataan',
        btn_tambah_data: '+ Tambah Data Penduduk',
        
        // Cards
        card_total: 'Total Penduduk',
        card_kost: 'Penghuni Kost',
        card_kontrak: 'Penghuni Kontrak',
        card_lokasi: 'Total Lokasi',
        
        // Table
        table_no: 'No',
        table_nama: 'Nama',
        table_alamat: 'Alamat',
        table_nohp: 'No HP',
        table_jenis: 'Jenis Tinggal',
        table_status: 'Status',
        table_aksi: 'Aksi',
        
        // Buttons
        btn_edit: 'Edit',
        btn_hapus: 'Hapus',
        btn_simpan: 'Simpan',
        btn_update: 'Update',
        btn_tutup: 'Tutup',
        btn_tambah: '+ Tambah Data',
        
        // Modal
        modal_tambah: 'Tambah Data Penduduk',
        modal_edit: 'Edit Data Penduduk',
        placeholder_nama: 'Nama Lengkap',
        placeholder_alamat: 'Alamat Tinggal',
        placeholder_nohp: 'Nomor HP',
        select_kost: 'Kost',
        select_kontrak: 'Kontrak',
        
        // Alert messages
        alert_tambah: 'Data berhasil ditambahkan',
        alert_update: 'Data berhasil diupdate',
        alert_hapus: 'Data berhasil dihapus',
        confirm_hapus: 'Yakin ingin menghapus data ini?',
        
        // Login
        login_title: 'Login Admin',
        login_username: 'Username',
        login_password: 'Password',
        login_button: 'Login',
        login_error: 'Username / Password salah',
        login_success: 'Login berhasil',
        
        // Register
        register_title: 'Tambah Akun Baru',
        register_nama: 'Nama Lengkap',
        register_username: 'Username',
        register_password: 'Password',
        register_role: 'Role',
        register_user: 'User',
        register_admin: 'Admin',
        register_button: 'Simpan Akun',
        register_error_username: 'Username sudah dipakai!',
        register_success: 'Akun berhasil dibuat',
        
        // Manage User
        manage_title: 'Daftar Akun User',
        manage_no: 'No',
        manage_nama: 'Nama Lengkap',
        manage_username: 'Username',
        manage_role: 'Role',
        manage_aksi: 'Aksi',
        manage_delete_confirm: 'Hapus user',
        manage_delete_self: 'Tidak bisa menghapus akun sendiri!',
        manage_delete_success: 'User dihapus',
        
        // Pemetaan
        peta_title: 'Pemetaan Lokasi Penduduk',
        peta_desc: 'Halaman ini digunakan untuk melihat persebaran lokasi penghuni kost dan kontrakan.',
        
        // Statistik
        stat_title: 'Statistik Penduduk',
        stat_total: 'Total Penduduk',
        stat_kost: 'Kost',
        stat_kontrak: 'Kontrak',
        stat_chart_title: 'Perbandingan Data Penduduk',
        stat_label: 'Jumlah',
        
        // Tentang
        about_title: 'Tentang Sistem Informasi',
        about_desc: 'Sistem Informasi Pemetaan Lokasi & Data Mandiri Penduduk Non-Permanen dibuat untuk membantu proses pendataan penghuni kost dan rumah kontrakan secara digital, modern, cepat, dan lebih terintegrasi berbasis web.',
        about_tujuan: 'Tujuan Sistem',
        about_tujuan_desc: 'Membantu pemerintah daerah maupun lingkungan RT/RW dalam melakukan pendataan penduduk non-permanen secara lebih efektif dan terstruktur.',
        about_teknologi: 'Teknologi',
        about_teknologi_desc: 'Website ini dibangun menggunakan PHP, MySQL, HTML, CSS, dan JavaScript dengan tampilan modern serta mudah digunakan.',
        about_fitur: 'Fitur Sistem',
        about_fitur_desc: 'Sistem memiliki fitur pendataan penghuni, pemetaan lokasi tempat tinggal, penyimpanan database, dan manajemen informasi penduduk.',
        about_info: 'Informasi Tambahan',
        about_info_desc: 'Sistem ini diharapkan dapat membantu proses digitalisasi pendataan masyarakat khususnya penghuni kost dan kontrakan sehingga data menjadi lebih akurat, aman, dan mudah diakses kapan saja. Selain itu sistem ini juga mendukung proses pemetaan lokasi tempat tinggal untuk mempermudah monitoring wilayah.',
        about_team: 'Tim Pengembang',
        
        // Footer
        footer_copyright: 'Sistem Informasi Penduduk Non-Permanen Berbasis Web'
    },
    en: {
        // Navigation
        nav_beranda: 'Home',
        nav_pendataan: 'Data Entry',
        nav_pemetaan: 'Mapping',
        nav_statistik: 'Statistics',
        nav_tentang: 'About',
        nav_kelola_user: 'Manage Users',
        nav_tambah_user: '+ Add User',
        nav_logout: 'Logout',
        nav_login: 'Login',
        nav_daftar_akun: 'Register',
        
        // Hero Section
        hero_title: 'Web-Based Information System for Location Mapping & Independent Data of Non-Permanent Residents (Rent & Boarding House)',
        hero_desc: 'A modern PHP and MySQL based website to help digitally record non-permanent residents such as boarding house and rental residents.',
        btn_mulai: 'Start Data Entry',
        btn_tambah_data: '+ Add Resident Data',
        
        // Cards
        card_total: 'Total Residents',
        card_kost: 'Boarding House',
        card_kontrak: 'Rent House',
        card_lokasi: 'Total Locations',
        
        // Table
        table_no: 'No',
        table_nama: 'Name',
        table_alamat: 'Address',
        table_nohp: 'Phone No',
        table_jenis: 'Residence Type',
        table_status: 'Status',
        table_aksi: 'Action',
        
        // Buttons
        btn_edit: 'Edit',
        btn_hapus: 'Delete',
        btn_simpan: 'Save',
        btn_update: 'Update',
        btn_tutup: 'Close',
        btn_tambah: '+ Add Data',
        
        // Modal
        modal_tambah: 'Add Resident Data',
        modal_edit: 'Edit Resident Data',
        placeholder_nama: 'Full Name',
        placeholder_alamat: 'Address',
        placeholder_nohp: 'Phone Number',
        select_kost: 'Boarding House',
        select_kontrak: 'Rent House',
        
        // Alert messages
        alert_tambah: 'Data successfully added',
        alert_update: 'Data successfully updated',
        alert_hapus: 'Data successfully deleted',
        confirm_hapus: 'Are you sure you want to delete this data?',
        
        // Login
        login_title: 'Admin Login',
        login_username: 'Username',
        login_password: 'Password',
        login_button: 'Login',
        login_error: 'Incorrect Username / Password',
        login_success: 'Login successful',
        
        // Register
        register_title: 'Add New Account',
        register_nama: 'Full Name',
        register_username: 'Username',
        register_password: 'Password',
        register_role: 'Role',
        register_user: 'User',
        register_admin: 'Admin',
        register_button: 'Save Account',
        register_error_username: 'Username already exists!',
        register_success: 'Account successfully created',
        
        // Manage User
        manage_title: 'User Accounts List',
        manage_no: 'No',
        manage_nama: 'Full Name',
        manage_username: 'Username',
        manage_role: 'Role',
        manage_aksi: 'Action',
        manage_delete_confirm: 'Delete user',
        manage_delete_self: 'Cannot delete your own account!',
        manage_delete_success: 'User deleted',
        
        // Pemetaan
        peta_title: 'Resident Location Mapping',
        peta_desc: 'This page is used to view the distribution of boarding house and rental residents.',
        
        // Statistik
        stat_title: 'Population Statistics',
        stat_total: 'Total Residents',
        stat_kost: 'Boarding House',
        stat_kontrak: 'Rent House',
        stat_chart_title: 'Resident Data Comparison',
        stat_label: 'Count',
        
        // Tentang
        about_title: 'About Information System',
        about_desc: 'Web-Based Information System for Location Mapping & Independent Data of Non-Permanent Residents (Rent & Boarding House) is created to help digitally record boarding house and rental residents in a modern, fast, and more integrated web-based manner.',
        about_tujuan: 'System Purpose',
        about_tujuan_desc: 'Help local governments and neighborhood units record non-permanent residents more effectively and structurally.',
        about_teknologi: 'Technology',
        about_teknologi_desc: 'This website is built using PHP, MySQL, HTML, CSS, and JavaScript with a modern and easy-to-use interface.',
        about_fitur: 'System Features',
        about_fitur_desc: 'The system features resident data entry, location mapping, database storage, and resident information management.',
        about_info: 'Additional Information',
        about_info_desc: 'This system is expected to help digitize community data collection, especially boarding house and rental residents, so that data becomes more accurate, secure, and easily accessible anytime. The system also supports location mapping to facilitate regional monitoring.',
        about_team: 'Development Team',
        
        // Footer
        footer_copyright: 'Web-Based Non-Permanent Resident Information System'
    }
};

let currentLang = localStorage.getItem('language') || 'id';

function initLanguage() {
    currentLang = localStorage.getItem('language') || 'id';
    updateLanguageUI();
    updateLanguageToggleUI();
}

function toggleLanguage() {
    currentLang = currentLang === 'id' ? 'en' : 'id';
    localStorage.setItem('language', currentLang);
    updateLanguageUI();
    updateLanguageToggleUI();
}

function updateLanguageToggleUI() {
    const toggle = document.getElementById('langToggle');
    const icon = document.getElementById('langIcon');
    const text = document.getElementById('langText');
    if (toggle) {
        const isEn = currentLang === 'en';
        toggle.checked = isEn;
        if (icon) icon.textContent = isEn ? '🇬🇧' : '🇮🇩';
        if (text) text.textContent = isEn ? 'EN' : 'ID';
    }
}

function t(key) {
    return translations[currentLang]?.[key] || key;
}

function updateLanguageUI() {
    // Update all elements with data-i18n attribute
    document.querySelectorAll('[data-i18n]').forEach(el => {
        const key = el.getAttribute('data-i18n');
        if (translations[currentLang] && translations[currentLang][key]) {
            if (el.tagName === 'INPUT' && el.placeholder) {
                el.placeholder = translations[currentLang][key];
            } else if (el.tagName === 'BUTTON' && el.value) {
                el.value = translations[currentLang][key];
            } else {
                el.innerHTML = translations[currentLang][key];
            }
        }
    });
    
    // Update buttons that have specific text content
    const saveBtn = document.getElementById('btnSubmit');
    if (saveBtn && saveBtn.innerText !== 'Update') {
        saveBtn.innerText = t('btn_simpan');
    }
    
    const closeBtn = document.querySelector('.close');
    if (closeBtn) closeBtn.innerText = t('btn_tutup');
    
    // Update table headers if they exist
    const tableHeaders = document.querySelectorAll('th');
    if (tableHeaders.length > 0) {
        const thKeys = ['table_no', 'table_nama', 'table_alamat', 'table_nohp', 'table_jenis', 'table_status', 'table_aksi'];
        tableHeaders.forEach((th, idx) => {
            if (thKeys[idx]) th.innerText = t(thKeys[idx]);
        });
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    initDarkMode();
    initLanguage();
});