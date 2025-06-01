# My Todo API - Laravel Documentation

This is a Laravel conversion of the Express.js/Node.js Todo API.

## Base URL

```
http://127.0.0.1:8001/api/v1
```

## Authentication

The API uses Laravel Sanctum for authentication. Include the Bearer token in the Authorization header:

```
Authorization: Bearer YOUR_TOKEN_HERE
```

## Endpoints

### Authentication

#### Register

```http
POST /auth/register
Content-Type: application/json

{
  "username": "string (required, unique)",
  "email": "string (required, unique, valid email)",
  "password": "string (required, min: 6 characters)"
}
```

**Response (201):**

```json
{
    "accessToken": "string"
}
```

#### Login

```http
POST /auth/login
Content-Type: application/json

{
  "email": "string (required)",
  "password": "string (required)"
}
```

**Response (200):**

```json
{
    "accessToken": "string"
}
```

#### Logout

```http
DELETE /auth/logout
Authorization: Bearer TOKEN
```

**Response (200):**

```json
{
    "message": "Logged out successfully"
}
```

### Tasks

#### Create Task

```http
POST /tasks
Authorization: Bearer TOKEN
Content-Type: application/json

{
  "title": "string (required)",
  "note": "string (optional)",
  "date": "string (required)",
  "time": "string (required)",
  "colorindex": "integer (optional, 0-9)"
}
```

**Response (201):**

```json
{
    "task": {
        "id": 1,
        "user_id": 1,
        "title": "Task title",
        "note": "Task note",
        "date": "2025-06-02",
        "time": "10:00",
        "colorindex": 0,
        "created_at": "2025-06-02T10:00:00.000000Z",
        "updated_at": "2025-06-02T10:00:00.000000Z"
    }
}
```

#### Get Tasks by Date

```http
GET /tasks
Authorization: Bearer TOKEN
Content-Type: application/json

{
  "date": "string (required, format: YYYY-MM-DD)"
}
```

**Response (200):**

```json
{
    "tasks": [
        {
            "id": 1,
            "user_id": 1,
            "title": "Task title",
            "note": "Task note",
            "date": "2025-06-02",
            "time": "10:00",
            "colorindex": 0,
            "created_at": "2025-06-02T10:00:00.000000Z",
            "updated_at": "2025-06-02T10:00:00.000000Z"
        }
    ]
}
```

#### Update Task

```http
PUT /tasks/{id}
Authorization: Bearer TOKEN
Content-Type: application/json

{
  "title": "string (optional)",
  "note": "string (optional)",
  "date": "string (optional)",
  "time": "string (optional)",
  "colorindex": "integer (optional)"
}
```

**Response (200):**

```json
{
    "task": {
        "id": 1,
        "user_id": 1,
        "title": "Updated title",
        "note": "Updated note",
        "date": "2025-06-02",
        "time": "11:00",
        "colorindex": 1,
        "created_at": "2025-06-02T10:00:00.000000Z",
        "updated_at": "2025-06-02T11:00:00.000000Z"
    }
}
```

#### Delete Task

```http
DELETE /tasks/{id}
Authorization: Bearer TOKEN
```

**Response (200):**

```json
{
    "message": "Task deleted successfully"
}
```

### User Profile (Me)

#### Get Current User

```http
GET /me
Authorization: Bearer TOKEN
```

**Response (200):**

```json
{
    "user": {
        "id": 1,
        "username": "john_doe",
        "email": "john@example.com",
        "avatarIndex": 0
    }
}
```

#### Update Current User

```http
PUT /me
Authorization: Bearer TOKEN
Content-Type: application/json

{
  "username": "string (optional, unique)",
  "email": "string (optional, unique, valid email)",
  "avatarIndex": "integer (optional, 0-9)"
}
```

**Response (200):**

```json
{
    "user": {
        "id": 1,
        "username": "updated_username",
        "email": "updated@example.com",
        "avatarIndex": 2
    }
}
```

## Error Responses

### Validation Error (400)

```json
{
    "message": "Validation error message"
}
```

### Unauthorized (401)

```json
{
    "message": "Unauthenticated."
}
```

### Not Found (404)

```json
{
    "message": "Task not found"
}
```

### Server Error (500)

```json
{
    "message": "Server error"
}
```

## Database Schema

### Users Table

-   `id` (Primary Key)
-   `username` (String, Unique)
-   `email` (String, Unique)
-   `password` (String, Hashed)
-   `avatar_index` (Integer, Default: 0)
-   `created_at` (Timestamp)
-   `updated_at` (Timestamp)

### Tasks Table

-   `id` (Primary Key)
-   `user_id` (Foreign Key to users.id)
-   `title` (String)
-   `note` (Text, Nullable)
-   `date` (String)
-   `time` (String)
-   `colorindex` (Integer, Default: 0)
-   `created_at` (Timestamp)
-   `updated_at` (Timestamp)

## Running the Application

1. Make sure you have PHP 8.1+ and Composer installed
2. Install dependencies: `composer install`
3. Copy `.env.example` to `.env` and configure your database
4. Generate app key: `php artisan key:generate`
5. Run migrations: `php artisan migrate`
6. Start server: `php artisan serve --port=8001`

The API will be available at `http://127.0.0.1:8001/api/v1`
