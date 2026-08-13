# Product Specification: DevShelf (Developer Resource Hub)

## Database Schema (`resources` table)
- `id`: primary key (UUID or BigInt)
- `title`: string (required)
- `url`: string (required, valid URL)
- `category`: string (required; e.g., 'Frontend', 'Backend', 'DevOps', 'AI', 'Design')
- `description`: text (nullable)
- `tags`: json or comma-separated string (nullable; e.g., "laravel, php, database")
- `is_favorite`: boolean (default: false)
- `created_at` / `updated_at`: timestamps

## Core Routes (`routes/web.php`)
- `GET /` or `GET /resources`: Display grid of resource cards + search bar + category filter.
- `GET /resources/create`: Form view to submit a new bookmark.
- `POST /resources`: Save resource to Supabase.
- `GET /resources/{resource}/edit`: Form view to edit bookmark.
- `PUT /resources/{resource}`: Update resource.
- `DELETE /resources/{resource}`: Remove resource.
- `PATCH /resources/{resource}/toggle-favorite`: Quick toggle for favoriting a card.