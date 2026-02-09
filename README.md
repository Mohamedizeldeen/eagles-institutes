# معهد النسور للغة الإنجليزية
## Eagles Institutes - English Language Management System

A comprehensive, modern web application for managing English language courses, student enrollment, payments, certificates, and blog articles. Built with Laravel 12, featuring an intuitive admin dashboard and professional public-facing website.

---

## 📋 Table of Contents
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Configuration](#configuration)
- [Database Setup](#database-setup)
- [Running the Application](#running-the-application)
- [Project Structure](#project-structure)
- [Default Credentials](#default-credentials)
- [API Routes](#api-routes)
- [Testing](#testing)
- [Support](#support)

---

## ✨ Features

### Admin Dashboard
- **Course Management** - Create, edit, delete, and manage English language courses
  - Three proficiency levels: Beginner (مبتدئ), Intermediate (متوسط), Advanced (متقدم)
  - Course details: price, duration, maximum students, schedules
  - Image uploading and course visibility control

- **Student Management** - Complete student database with tracking
  - Student ID numbers (Sudanese format: SD-YYYY-NNN)
  - Contact information and personal details
  - Gender and date of birth tracking
  - Student status management

- **Enrollment & Payment Tracking**
  - Enroll students in courses
  - Track payment status: Paid (مدفوع), Partial (جزئي), Unpaid (غير مدفوع)
  - Manage enrollment status: Registered (مسجل), Completed (مكتمل), Withdrawn (منسحب), Deferred (مؤجل)
  - Automatic duplicate enrollment prevention

- **Certificate Management**
  - Generate certificates upon course completion
  - Auto-generated certificate numbers (CERT-YYYY-NNNN format)
  - Print-ready certificate templates with decorative styling
  - Grade tracking and notes

- **Article Management** - Blog and educational content
  - Rich article creation with image support
  - Auto-slug generation from titles
  - Publish/unpublish functionality
  - Author attribution

- **Financial Reports**
  - Monthly revenue analytics
  - Payment status distribution charts
  - Course-wise revenue breakdown
  - Level-wise enrollment statistics

### Public Website
- Professional landing page with course highlights
- Course catalog with level filtering
- Detailed course information pages
- Educational blog with article search
- Institution information page
- Contact form for inquiries
- Responsive RTL (Right-to-Left) design for Arabic

### Core Features
- Session-based authentication
- Admin-only access with middleware protection
- In-person payment tracking (no online payment integration)
- Comprehensive search and filtering
- Mobile-responsive design
- Arabic language support (complete RTL interface)
- Database relationship management with Laravel ORM

---

## 🛠 Tech Stack

| Component | Technology | Version |
|-----------|-----------|---------|
| Framework | Laravel | 12.x |
| Language | PHP | 8.2+ |
| Database | MySQL | 8.0+ |
| Frontend | Blade Templates | Latest |
| CSS Framework | Tailwind CSS | 4.0 |
| Build Tool | Vite | 7.0+ |
| Testing | Pest/PHPUnit | Latest |
| Server | Apache/Laravel Artisan | Latest |

---

## 📦 Prerequisites

Before installation, ensure you have the following installed:

- **PHP** 8.2 or higher
- **Composer** (PHP dependency manager)
- **MySQL** 8.0 or higher
- **Node.js** 18+ and npm 9+ (for frontend assets)
- **Git** (for version control)

### Optional
- **Laravel Sail** (recommended for consistent development environment)
- **Docker** (if using Sail)

---

## 🚀 Installation

### 1. Clone the Repository
```bash
git clone <repository-url>
cd eagles-institutes
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Install Node Dependencies
```bash
npm install
```

### 4. Copy Environment File
```bash
cp .env.example .env
```

---

## ⚙️ Configuration

### 1. Generate Application Key
```bash
php artisan key:generate
```

### 2. Update .env File
Edit the `.env` file and configure:

```env
APP_NAME="معهد النسور للغة الإنجليزية"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eagles_institutes
DB_USER=root
DB_PASSWORD=your_password

# App Locale
APP_LOCALE=ar
APP_FALLBACK_LOCALE=ar
FAKER_LOCALE=ar_SA

# Timezone
APP_TIMEZONE=Africa/Khartoum
```

---

## 🗄️ Database Setup

### 1. Create Database (Manual)
```bash
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS eagles_institutes CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

Or use Laravel migration with seed:

### 2. Run Migrations & Seeders
```bash
php artisan migrate:fresh --seed
```

This will:
- Create all necessary tables
- Seed database with sample data (courses, students, enrollments, certificates, articles)
- Create admin user: `admin@eagles.com` / password: `password`

### 3. Create Storage Link
```bash
php artisan storage:link
```

---

## ▶️ Running the Application

### Development Server
```bash
php artisan serve
```

The application will be available at: **http://127.0.0.1:8000**

### Frontend Development (Vite Watch Mode)
In a separate terminal:
```bash
npm run dev
```

### Production Build
```bash
npm run build
```

---

## 📁 Project Structure

```
eagles-institutes/
├── app/
│   ├── Http/
│   │   ├── Controllers/          # Application controllers
│   │   │   ├── Admin/            # Admin controllers
│   │   │   └── Auth/             # Authentication
│   │   ├── Middleware/           # Custom middleware
│   │   └── Requests/             # Form requests
│   ├── Models/                   # Database models
│   └── Providers/                # Service providers
├── database/
│   ├── factories/                # Database factories
│   ├── migrations/               # Database migrations
│   └── seeders/                  # Database seeders
├── resources/
│   ├── css/                      # Stylesheets
│   ├── js/                       # JavaScript files
│   └── views/                    # Blade templates
│       ├── admin/                # Admin panel views
│       ├── auth/                 # Authentication views
│       ├── layouts/              # Layout templates
│       └── public/               # Public website views
├── routes/
│   ├── web.php                   # Web routes
│   ├── api.php                   # API routes
│   └── console.php               # Console routes
├── storage/
│   ├── app/                      # Application storage
│   ├── framework/                # Framework storage
│   └── logs/                     # Application logs
├── tests/                        # Test files
├── public/                       # Public assets
├── config/                       # Configuration files
├── bootstrap/                    # Bootstrap files
└── composer.json                 # PHP dependencies
```

---

## 🔐 Default Credentials

**Admin Account:**
- Email: `admin@eagles.com`
- Password: `password`

**Admin Panel:** http://127.0.0.1:8000/admin

---

## 🛣️ API Routes

### Public Routes
| Method | Route | Description |
|--------|-------|-------------|
| GET | `/` | Home page |
| GET | `/about` | About page |
| GET | `/contact` | Contact page |
| GET | `/courses` | Course listing |
| GET | `/courses/{course}` | Course details |
| GET | `/articles` | Articles listing |
| GET | `/articles/{slug}` | Article details |
| POST | `/contact` | Submit contact form |

### Authentication Routes
| Method | Route | Description |
|--------|-------|-------------|
| GET | `/login` | Login form |
| POST | `/login` | Process login |
| POST | `/logout` | Logout |

### Admin Routes (`/admin`)
| Resource | Methods | Features |
|----------|---------|----------|
| Courses | CRUD | Create, read, update, delete courses |
| Students | CRUD | Manage student database |
| Enrollments | CRUD + Complete | Manage enrollments and mark as complete |
| Certificates | Create, List, Show, Print, Delete | Certificate management |
| Articles | CRUD | Blog post management |
| Reports | List | View financial reports |
| Contacts | List, Show, Delete | Manage contact form submissions |

---

## 🧪 Testing

Run the test suite:
```bash
php artisan test
```

Run tests with coverage:
```bash
php artisan test --coverage
```

---

## 📝 Database Schema

### Core Tables
- **users** - Admin accounts
- **courses** - Course information
- **students** - Student records
- **enrollments** - Course enrollments
- **certificates** - Issued certificates
- **articles** - Blog articles
- **contacts** - Contact form submissions
- **settings** - Application settings

---

## 🌐 Localization

The application is fully Arabic-localized with RTL (Right-to-Left) support. All UI elements, error messages, and content are in Arabic. No additional localization files are required.

---

## 📧 Support

For issues, feature requests, or questions:

1. Check existing documentation
2. Review the `artisan` command help: `php artisan help`
3. Contact the development team
4. Review Laravel documentation: https://laravel.com/docs

---

## 📄 License

This project is proprietary software for Eagles Institutes.

---

## 🔄 Version History

- **v1.0.0** (February 2026) - Initial release with core features

---

**Last Updated:** February 9, 2026