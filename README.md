# 📍 SIPeManDiRi
    Folder file at FINAL FILE

**Sistem Informasi Pemetaan Lokasi & Data Mandiri Penduduk Non-Permanen (Kontrak & Kost) Berbasis Web**

SIPeManDiRi is a web-based information system built with PHP and MySQL to help digitally record non-permanent residents such as boarding house (Kost) and rental (Kontrak) occupants. The system provides features for data entry, location mapping, statistics, user management, and a modern responsive UI with dark mode and bilingual (ID/EN) support.

---

## ✨ Features

- **Authentication** – Login with role-based access (Admin/User).
- **Resident Data Management** – Add, edit, delete, and view resident data.
- **Location Mapping** – Interactive Google Maps iframe to search and view resident locations.
- **Statistics** – Bar chart visualization comparing Kost vs Kontrak residents.
- **User Management (Admin only)** – Create, view, and delete user accounts.
- **Dark Mode** – Toggle between light and dark theme (persists via localStorage).
- **Bilingual (ID/EN)** – Switch between Indonesian and English (persists via localStorage).
- **Responsive Design** – Works on desktop and mobile devices.

---

## 🖼️ Screenshots

*(Add our own screenshots here, for example:)*

| Homepage | Data Entry | Mapping | Statistics |
|----------|------------|---------|------------|
| ![Homepage](screenshots/home.png) | ![Data Entry](screenshots/pendataan.png) | ![Mapping](screenshots/pemetaan.png) | ![Statistics](screenshots/statistik.png) |

| User Management | Dark Mode | Bilingual |
|----------------|-----------|------------|
| ![Manage User](screenshots/manage_user.png) | ![Dark Mode](screenshots/darkmode.png) | ![Bilingual](screenshots/bilingual.png) |

---

## 🛠️ Tech Stack

- **Backend:** PHP (native, no framework)
- **Database:** MySQL
- **Frontend:** HTML5, CSS3, JavaScript
- **Libraries:**
  - [Chart.js](https://www.chart.js/) – for statistics chart
  - Google Fonts (Poppins)
  - Google Maps Embed API

---

## 📥 Installation Guide

### Requirements
- PHP >= 7.4
- MySQL (or MariaDB)
- Web server (Apache recommended, e.g., XAMPP/Laravel)

### Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/sipemandiri.git
