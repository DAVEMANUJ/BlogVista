# BlogVista - Blog Management System

BlogVista is a full-stack Laravel-based blog management system designed with a beautiful, modern admin panel and a seamless public reading experience. It was built with a focus on ease of use, robust content creation, and excellent performance.

## Features

### 1. Modern Admin Dashboard
- **Live Statistics:** Animated stat cards showing total blogs, published blogs, drafts, and categories.
- **AJAX Refresh:** System stats and metrics automatically refresh without reloading the page.
- **Recent Activity:** A quick-view table displaying the latest blog posts created in the system.

### 2. Advanced Blog Management
- **Live Search & Filtering:** The "All Blogs" page features instant AJAX-powered search by title, along with category and status dropdown filters.
- **One-Click Publishing:** Toggle a post's status between "Draft" and "Published" directly from the listing page without page reloads.
- **Detailed Table:** View thumbnail images, reading time estimates, categories, and published dates at a glance.

### 3. Rich Content Creation
- **TinyMCE Integration:** A fully featured WYSIWYG editor for writing beautiful, formatted blog content including headers, lists, code blocks, and embedded images.
- **Drag-and-Drop Image Uploads:** Easily upload featured images by dragging them onto the upload zone, or provide a direct image URL as a fallback.
- **Live Character Counter:** Real-time feedback for the short description excerpt to keep it concise and SEO-friendly.
- **Two-Column Layout:** A professional, split-pane design separating content writing from metadata and publish settings.

## Technical Setup & Deployment

- **Environment:** PHP 8.1+, Laravel 10+, MySQL
- **Docker Ready:** Includes a `Dockerfile` for seamless deployment to platforms like Render.
- **Deployment Optimizations:** 
  - Automated `start.sh` script to handle package discovery, cache clearing, and database migrations on startup.
  - Development tools (like Collision) are stripped out during production builds to ensure stability.
  - Unnecessary cache files (`bootstrap/cache/`) are properly ignored to prevent cross-environment crashes.

## Running Locally

1. Clone the repository and run `composer install`.
2. Copy `.env.example` to `.env` and set up your local MySQL credentials.
3. Run `php artisan key:generate`.
4. Run `php artisan migrate:fresh --seed` to generate the tables and initial admin account.
5. Start the server: `php artisan serve`.
6. Access the admin panel at `http://127.0.0.1:8000/admin/login` (Default login: `admin@example.com` / `password`).
