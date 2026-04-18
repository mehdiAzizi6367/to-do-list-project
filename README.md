# To-Do List Application

A beautiful, modern to-do list application built with Laravel, featuring user authentication, responsive design, and a clean user interface.

## Features

### 🔐 **Authentication System**
- User registration and login
- Secure password hashing
- Protected routes for authenticated users
- Profile management

### ✅ **To-Do List Functionality**
- **Create Todos**: Add new tasks with title and optional description
- **View Todos**: List all your todos with completion status
- **Edit Todos**: Update title, description, and completion status
- **Delete Todos**: Remove todos with confirmation
- **Mark Complete**: Toggle completion status with a single click
- **User Isolation**: Each user can only see and manage their own todos

### 🎨 **Beautiful UI Design**
- **Tailwind CSS**: Modern, responsive design with dark mode support
- **Clean Interface**: Intuitive layout with proper spacing and typography
- **Interactive Elements**: Hover effects, buttons, and form styling
- **Mobile Responsive**: Works perfectly on all device sizes
- **Visual Feedback**: Success messages, form validation, and loading states

## Tech Stack

- **Backend**: Laravel 11.x
- **Frontend**: Tailwind CSS, Vite
- **Database**: MySQL
- **Authentication**: Laravel Breeze
- **Testing**: Pest

## Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd to-do-list-project
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database Setup**
   - Create a MySQL database named `todolist_db`
   - Update `.env` file with your database credentials:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=todolist_db
     DB_USERNAME=your_username
     DB_PASSWORD=your_password
     ```

6. **Run Migrations**
   ```bash
   php artisan migrate
   ```

7. **Build Assets**
   ```bash
   npm run build
   ```

8. **Start the Development Server**
   ```bash
   php artisan serve
   ```

   Visit `http://127.0.0.1:8000` in your browser.

## Usage

### For New Users
1. Visit the homepage
2. Click "Get Started" to register
3. Create your account
4. Start adding your first to-do items

### For Existing Users
1. Log in with your credentials
2. You'll be automatically redirected to your todos page
3. Add, edit, complete, or delete your todos

### Managing Todos
- **Add Todo**: Click "Add New Todo" button
- **Mark Complete**: Click the circle icon next to a todo
- **Edit Todo**: Click "Edit" next to any todo
- **Delete Todo**: Click "Delete" and confirm

## Testing

Run the test suite with Pest:

```bash
php artisan test
```

## Project Structure

```
├── app/
│   ├── Http/Controllers/
│   │   ├── TodoController.php
│   │   └── ProfileController.php
│   └── Models/
│       ├── Todo.php
│       └── User.php
├── database/
│   ├── factories/
│   │   └── TodoFactory.php
│   └── migrations/
│       ├── create_todos_table.php
│       └── create_users_table.php
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   └── app.js
│   └── views/
│       ├── auth/
│       ├── layouts/
│       ├── todos/
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── index.blade.php
│       ├── dashboard.blade.php
│       └── welcome.blade.php
├── routes/
│   └── web.php
└── tests/
    └── Feature/
        └── TodoTest.php
```

## Features in Detail

### Authentication
- Secure user registration and login
- Password reset functionality
- Email verification (configurable)
- Session management

### Todo Management
- CRUD operations for todos
- User-specific todo isolation
- Real-time completion status updates
- Form validation and error handling

### UI/UX
- Responsive design for all devices
- Dark mode support
- Smooth animations and transitions
- Accessible form controls
- Loading states and feedback

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests for new features
5. Submit a pull request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
