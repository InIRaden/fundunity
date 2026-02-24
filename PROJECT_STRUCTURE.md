# 📋 Struktur Project Fundunity

## 🎯 Overview
Project Laravel untuk landing page **Komunitas Ruang Berbagi** dengan sistem autentikasi lengkap.

---

## 📁 Struktur Direktori Utama

```
fundunity/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── LandingController.php  ← Controller untuk semua landing pages
│   └── Models/
│       └── User.php
├── resources/
│   └── views/
│       ├── landing/                    ← 9 Halaman Landing Page
│       │   ├── home.blade.php
│       │   ├── about.blade.php
│       │   ├── programs.blade.php
│       │   ├── focus-areas.blade.php
│       │   ├── gallery.blade.php
│       │   ├── partners.blade.php
│       │   ├── contact.blade.php
│       │   ├── faq.blade.php
│       │   └── get-involved.blade.php
│       │
│       ├── components/                 ← Komponen Reusable
│       │   └── landing/
│       │       ├── navbar.blade.php
│       │       └── footer.blade.php
│       │
│       ├── layouts/                    ← Template Layouts
│       │   ├── landing.blade.php       (Landing page layout)
│       │   ├── app.blade.php           (Dashboard layout)
│       │   ├── guest.blade.php         (Auth layout)
│       │   └── navigation.blade.php    (Dashboard navbar)
│       │
│       ├── auth/                       ← Laravel Breeze Auth
│       │   ├── login.blade.php
│       │   ├── register.blade.php
│       │   ├── forgot-password.blade.php
│       │   ├── reset-password.blade.php
│       │   ├── verify-email.blade.php
│       │   └── confirm-password.blade.php
│       │
│       ├── profile/                    ← User Profile (Breeze)
│       │   ├── edit.blade.php
│       │   └── partials/
│       │
│       ├── dashboard.blade.php         ← Dashboard authenticated user
│       └── welcome.blade.php           ← Welcome page
│
├── routes/
│   ├── web.php                         ← Semua route web
│   └── auth.php                        ← Route autentikasi (Breeze)
│
├── public/
│   └── index.php                       ← Entry point
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── .env                                ← Environment configuration
└── composer.json
```

---

## 🌐 Route Map

### Landing Pages (Public)
| URL | Route Name | Controller Method | View |
|-----|-----------|-------------------|------|
| `/` | home | LandingController@index | landing.home |
| `/about` | about | LandingController@about | landing.about |
| `/allprograms` | programs | LandingController@programs | landing.programs |
| `/focusareas` | focus-areas | LandingController@focusAreas | landing.focus-areas |
| `/moregallery` | gallery | LandingController@gallery | landing.gallery |
| `/partners` | partners | LandingController@partners | landing.partners |
| `/contact` | contact | LandingController@contact | landing.contact |
| `/faqs` | faq | LandingController@faq | landing.faq |
| `/getinvolved` | get-involved | LandingController@getInvolved | landing.get-involved |

### Authentication (Laravel Breeze)
| URL | Route Name | Description |
|-----|-----------|-------------|
| `/login` | login | Login page |
| `/register` | register | Registration page |
| `/forgot-password` | password.request | Password reset request |
| `/reset-password/{token}` | password.reset | Password reset form |
| `/verify-email` | verification.notice | Email verification |
| `/logout` | logout | Logout (POST) |

### Protected Routes (Auth Required)
| URL | Route Name | Description |
|-----|-----------|-------------|
| `/dashboard` | dashboard | User dashboard |
| `/profile` | profile.edit | User profile edit |

---

## 🎨 Design System

### Color Palette
- **Primary**: Green (`bg-green-600`, `text-green-600`)
- **Secondary**: Emerald (`bg-emerald-500`)
- **Accent**: Teal/Cyan (`bg-teal-600`)
- **Neutral**: Gray scales

### Typography
- **Font**: System fonts (font-sans)
- **Headings**: Bold weight (font-bold)
- **Body**: Regular weight (font-normal)

### Components
1. **Navbar** (`x-landing.navbar`)
   - Responsive dengan mobile menu
   - Fixed top positioning
   - Shadow on scroll

2. **Footer** (`x-landing.footer`)
   - 4 kolom (About, Quick Links, Contact, Newsletter)
   - Social media icons
   - Copyright notice

---

## 🚀 Getting Started

### Prerequisites
- PHP 8.1+
- Composer
- MySQL/PostgreSQL
- Node.js & NPM (opsional)

### Installation
```bash
# Clone repository
git clone <repo-url>
cd fundunity

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database
php artisan migrate

# Start server
php artisan serve
```

### Development
```bash
# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Run tests
php artisan test
```

---

## 📝 File Organization Rules

### Views
- **Landing pages** → `resources/views/landing/`
- **Reusable components** → `resources/views/components/`
- **Layouts** → `resources/views/layouts/`
- **Auth views** → `resources/views/auth/`

### Controllers
- **Landing pages** → `app/Http/Controllers/LandingController.php`
- **Dashboard** → Inline in routes atau dedicated controller
- **Auth** → Laravel Breeze controllers

### Routes
- **Public routes** → `routes/web.php`
- **Auth routes** → `routes/auth.php` (auto-loaded)

---

## ✅ Checklist Features

### ✅ Completed
- [x] 9 Landing pages dengan design responsive
- [x] Navbar component dengan mobile menu
- [x] Footer component dengan newsletter
- [x] Laravel Breeze authentication
- [x] User dashboard
- [x] Profile management
- [x] Route structure
- [x] File organization
- [x] Environment configuration

### 🔄 Pending
- [ ] Replace placeholder images dengan assets asli
- [ ] Implement form submission handlers
- [ ] Database models untuk dynamic content
- [ ] Admin panel untuk content management
- [ ] Payment gateway integration
- [ ] Email notifications
- [ ] SEO optimization
- [ ] Performance optimization

---

## 📞 Contact & Support

**Komunitas Ruang Berbagi**
- Phone: 0821-1677-1146
- Email: komunitasruangberbagi@gmail.com
- Location: Bandung, Indonesia

---

*Generated: {{ date('Y-m-d H:i:s') }}*
