<p align="center">
  <img src="public/devshelf-logo.svg" width="80" alt="devshelf logo">
</p>

<h1 align="center">devshelf</h1>

<p align="center">
  Your personal developer bookmark dashboard.<br>
  Organize, categorize, and access your favorite developer resources instantly.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-13-FF2D20?style=flat-square&logo=laravel&logoColor=white" alt="Laravel 13">
  <img src="https://img.shields.io/badge/PHP-8.4-777BB4?style=flat-square&logo=php&logoColor=white" alt="PHP 8.4">
  <img src="https://img.shields.io/badge/PostgreSQL-Supabase-4169E1?style=flat-square&logo=postgresql&logoColor=white" alt="PostgreSQL">
  <img src="https://img.shields.io/badge/Tailwind_CSS-4-06B6D4?style=flat-square&logo=tailwindcss&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/daisyUI-5-5A0EF8?style=flat-square&logo=daisyui&logoColor=white" alt="daisyUI">
  <img src="https://img.shields.io/badge/Alpine.js-3-8BC0D0?style=flat-square&logo=alpinedotjs&logoColor=white" alt="Alpine.js">
</p>

---

## ✨ Features

- **Bookmark Management** — Save, edit, and delete developer resources (docs, tools, APIs) with titles, URLs, descriptions, categories, and tags.
- **Auto Metadata Fetching** — Paste a URL and devshelf automatically fetches the page title, description, and favicon for you.
- **Smart Filtering** — Real-time search and category-based pill tabs to instantly find what you need.
- **Favorites** — One-click heart toggle to mark your most-used resources.
- **One-Click Copy** — Copy any resource URL to your clipboard with a single click.
- **Multi-User Auth** — Lightweight username/password authentication with strict per-user data isolation.
- **Bento Grid Dashboard** — Ultra-clean, minimalist UI with stat cards, category breakdowns, and animated resource cards.
- **Loading Overlays** — Smooth loading spinners on every form submission.
- **Flash Toasts** — Auto-dismissing success notifications with Alpine.js.
- **Delete Confirmation Modals** — daisyUI modals prevent accidental deletions.
- **Landing Page** — Public marketing page with hero section, live preview, and feature grid.

---

## 🛠 Tech Stack

| Layer        | Technology                                                       |
| ------------ | ---------------------------------------------------------------- |
| **Framework**| [Laravel 13](https://laravel.com) (PHP 8.4+)                     |
| **Database** | [PostgreSQL](https://www.postgresql.org/) via Supabase            |
| **ORM**      | Eloquent                                                         |
| **Views**    | Blade Templates                                                  |
| **Styling**  | [Tailwind CSS 4](https://tailwindcss.com) + [daisyUI 5](https://daisyui.com) |
| **JS**       | [Alpine.js 3](https://alpinejs.dev)                              |
| **Build**    | [Vite](https://vite.dev)                                         |
| **Hosting**  | [Railway](https://railway.app)                                   |

---

## 📁 Project Structure

```
devshelf/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php        # Login, Register, Logout
│   │   │   └── ResourceController.php    # CRUD + Favorites + Filtering
│   │   └── Requests/
│   │       ├── StoreResourceRequest.php  # Create validation
│   │       └── UpdateResourceRequest.php # Update validation
│   ├── Models/
│   │   ├── User.php                      # User model (hasMany resources)
│   │   └── Resource.php                  # Resource model (belongsTo user)
│   └── Services/
│       └── MetadataFetcher.php           # Auto-fetch title/description/favicon
├── database/
│   ├── factories/
│   │   ├── UserFactory.php
│   │   └── ResourceFactory.php           # 12 realistic dev resources
│   ├── migrations/
│   │   ├── *_create_users_table.php      # Users + username column
│   │   └── *_create_resources_table.php  # Resources + user_id FK
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── ResourceSeeder.php            # Seeds 12 bookmarks
├── resources/views/
│   ├── layouts/app.blade.php             # Main layout (navbar, toast, loader)
│   ├── landing.blade.php                 # Public landing page
│   ├── auth/
│   │   ├── login.blade.php
│   │   └── register.blade.php
│   └── resources/
│       ├── index.blade.php               # Dashboard with bento grid
│       ├── create.blade.php              # Add resource form
│       └── edit.blade.php                # Edit resource form
├── routes/web.php                        # All routes (guest, auth, resource)
├── nixpacks.toml                         # Railway/Nixpacks build config
├── railway.toml                          # Railway deployment config
└── .env.railway                          # Railway env variable template
```

---

## 🚀 Getting Started

### Prerequisites

- **PHP 8.4+** with extensions: pgsql, pdo_pgsql, mbstring, xml, curl, fileinfo
- **Composer 2+**
- **Node.js 20+** and npm
- **PostgreSQL** database (local or [Supabase](https://supabase.com))

### Installation

```bash
# 1. Clone the repository
git clone https://github.com/your-username/devshelf.git
cd devshelf

# 2. Install PHP dependencies
composer install

# 3. Install JS dependencies
npm install

# 4. Set up environment
cp .env.example .env
php artisan key:generate
```

### Database Setup

Update your `.env` file with your PostgreSQL credentials:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=devshelf
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Then run migrations and seed:

```bash
php artisan migrate --seed
```

This creates a test user and 12 realistic developer resources:

| Field    | Value              |
| -------- | ------------------ |
| Username | `testuser`         |
| Email    | `test@example.com` |
| Password | `password`         |

### Running Locally

```bash
# Terminal 1: Vite dev server (hot reload)
npm run dev

# Terminal 2: Laravel dev server
php artisan serve
```

Visit **http://localhost:8000** to see the landing page.

---

## 🚢 Deploying to Railway

1. Push your code to a **GitHub repository**.
2. In [Railway](https://railway.app), create a **New Project → Deploy from GitHub Repo**.
3. Add a **PostgreSQL** plugin to your Railway project.
4. Go to your app's **Variables** tab and add the following:

   ```env
   APP_NAME=devshelf
   APP_ENV=production
   APP_KEY=base64:YOUR_KEY_HERE       # Generate with: php artisan key:generate --show
   APP_DEBUG=false
   APP_URL=https://your-app.up.railway.app

   DB_CONNECTION=pgsql
   DB_HOST=${{Postgres.PGHOST}}
   DB_PORT=${{Postgres.PGPORT}}
   DB_DATABASE=${{Postgres.PGDATABASE}}
   DB_USERNAME=${{Postgres.PGUSER}}
   DB_PASSWORD=${{Postgres.PGPASSWORD}}

   LOG_CHANNEL=stderr
   SESSION_DRIVER=database
   CACHE_STORE=database
   QUEUE_CONNECTION=database
   ```

5. In **Settings → Deploy**, set the **Release Command** to:

   ```bash
   php artisan migrate --force
   ```

6. In **Settings → Networking**, click **Generate Domain** to expose your app.

The included `nixpacks.toml` automatically configures **PHP 8.4**, **Node.js 22**, **Nginx**, and all required extensions.

---

## 📐 Database Schema

### `users` table

| Column              | Type      | Constraints          |
| ------------------- | --------- | -------------------- |
| `id`                | bigint    | Primary Key          |
| `name`              | string    | Required             |
| `username`          | string    | Required, Unique     |
| `email`             | string    | Nullable, Unique     |
| `password`          | string    | Hashed               |
| `created_at`        | timestamp |                      |
| `updated_at`        | timestamp |                      |

### `resources` table

| Column              | Type      | Constraints                     |
| ------------------- | --------- | ------------------------------- |
| `id`                | bigint    | Primary Key                     |
| `user_id`           | bigint    | Foreign Key → users (cascade)   |
| `title`             | string    | Required                        |
| `url`               | string    | Required, Valid URL              |
| `category`          | string    | Required                        |
| `description`       | text      | Nullable                        |
| `tags`              | json      | Nullable                        |
| `is_favorite`       | boolean   | Default: false                  |
| `favicon_url`       | string    | Nullable (auto-fetched)         |
| `created_at`        | timestamp |                                 |
| `updated_at`        | timestamp |                                 |

---

## 🛣 Routes

| Method   | URI                              | Action                          | Middleware |
| -------- | -------------------------------- | ------------------------------- | ---------- |
| GET      | `/`                              | Landing page (or redirect)      | —          |
| GET      | `/login`                         | Login form                      | guest      |
| POST     | `/login`                         | Authenticate user               | guest      |
| GET      | `/register`                      | Registration form               | guest      |
| POST     | `/register`                      | Create user                     | guest      |
| POST     | `/logout`                        | Log out                         | auth       |
| GET      | `/dashboard`                     | Resource index (bento grid)     | auth       |
| GET      | `/resources/create`              | Create resource form            | auth       |
| POST     | `/resources`                     | Store resource                  | auth       |
| GET      | `/resources/{resource}/edit`     | Edit resource form              | auth       |
| PUT      | `/resources/{resource}`          | Update resource                 | auth       |
| DELETE   | `/resources/{resource}`          | Delete resource                 | auth       |
| PATCH    | `/resources/{resource}/favorite` | Toggle favorite                 | auth       |

---

## 📄 License

This project is open-sourced software licensed under the [MIT License](https://opensource.org/licenses/MIT).
