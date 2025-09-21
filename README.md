# Blog API

Laravel REST API for Blog (Posts, Categories, Tags) with Sanctum authentication.

# Authentication (Sanctum)
- Register
    POST /api/register
    Body: name, email, password, password_confirmation
- Login
    POST /api/login
    Returns token.
    Protected routes:
    Add header Authorization: Bearer <token>

# Endpoints
## Posts
-  GET /api/posts — List all posts
-  GET /api/posts/{id} — Show single post
-  POST /api/posts — Create post (auth required)
-  PUT /api/posts/{id} — Update post (owner only)
-  DELETE /api/posts/{id} — Delete post (owner only)
-  GET /api/my-posts — Authenticated user posts
## Categories
-  GET /api/categories — List categories
-  GET /api/categories/{id} — Show category
-  GET /api/categories/{id}/posts — Posts by category
## Tags
-  GET /api/tags — List tags
-  GET /api/tags/{id} — Show tag
-  GET /api/tags/{id}/posts — Posts by tag