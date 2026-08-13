# DevShelf Project Conventions

## Stack
- Framework: Laravel 12 / PHP 8.2+
- Database: PostgreSQL (Supabase) via Eloquent ORM
- UI: Blade Templates + Tailwind CSS + daisyUI
- Icons: Blade Lucide Icons or Inline SVGs

## Guidelines
1. Always use Eloquent models (`App\Models\Resource`) for DB operations.
2. Form validation must be handled via Dedicated Form Request classes (`StoreResourceRequest`, `UpdateResourceRequest`).
3. Views must use a shared master layout (`resources/views/layouts/app.blade.php`).
4. Ensure CSRF (`@csrf`) and Method directives (`@method('PUT')`, `@method('DELETE')`) are included in forms.
5. Use daisyUI utility components (`card`, `badge`, `btn`, `input`, `modal`) to ensure dark/light mode compatibility and a modern aesthetic.