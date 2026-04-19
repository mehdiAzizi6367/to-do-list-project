# To-Do List Application

A comprehensive task management system built with Laravel, featuring user authentication, role-based access control, admin dashboard, and a beautiful responsive UI.

## ✨ Features

### 🔐 **Authentication & User Management**
- User registration and login with secure password hashing
- Profile management and account settings
- Protected routes for authenticated users
- Email verification support

### ✅ **To-Do List Functionality**
- **Create Todos**: Add new tasks with title and optional description
- **View Todos**: List all your todos with completion status and creation dates
- **Edit Todos**: Update title, description, and completion status
- **Delete Todos**: Remove todos with confirmation dialogs
- **Mark Complete**: Toggle completion status with a single click
- **User Isolation**: Each user can only see and manage their own todos
- **Task Statistics**: View completion rates and task counts

### 👑 **Admin Dashboard & Management**
- **Role-Based Access Control**: Separate user and admin roles
- **Admin Auto-Redirect**: Admins are automatically redirected to admin dashboard after login
- **User Management**: View, edit, promote/demote users, and delete accounts
- **Task Oversight**: Monitor all tasks across all users
- **System Statistics**: Comprehensive dashboard with user counts, task metrics, and activity feeds
- **Admin Creation**: Create new administrator accounts
- **Security Controls**: Protected admin routes with middleware

### 🎨 **Beautiful UI Design**
- **Tailwind CSS**: Modern, responsive design with clean aesthetics
- **Admin Interface**: Dedicated admin layout with navigation and management tools
- **Interactive Elements**: Hover effects, smooth transitions, and intuitive controls
- **Mobile Responsive**: Optimized for all device sizes and screen resolutions
- **Visual Feedback**: Success/error messages, form validation, and loading states
- **Dark Mode Ready**: Built with Tailwind's design system for easy theming

## 🛠️ Tech Stack

- **Backend**: Laravel 11.x (PHP Framework)
- **Frontend**: Tailwind CSS, Vite (Build Tool)
- **Database**: MySQL with migrations and seeders
- **Authentication**: Laravel Breeze
- **Testing**: Pest (PHP Testing Framework)
- **Icons**: Heroicons (via Blade components)
- **Styling**: Custom CSS with Tailwind utilities

## 📋 Prerequisites

- PHP 8.1 or higher
- Composer (PHP dependency manager)
- Node.js 16+ and npm
- MySQL 5.7+ or MariaDB 10.3+
- Git

## 🚀 Installation

### 1. Clone the Repository
```bash
git clone <repository-url>
cd to-do-list-project
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Install Node.js Dependencies
```bash
npm install
```

### 4. Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

### 5. Database Setup
Create a MySQL database and update your `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todolist_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 6. Run Database Migrations
```bash
php artisan migrate
```

### 7. Build Frontend Assets
```bash
npm run build
# OR for development with hot reload:
npm run dev
```

### 8. Start the Development Server
```bash
php artisan serve
```

Visit `http://127.0.0.1:8000` in your browser.

## 👥 Usage Guide

### For Regular Users

#### Getting Started
1. Visit the application homepage
2. Click **"Get Started"** to create a new account
3. Fill in your registration details
4. Verify your email (if enabled)
5. Start managing your todos!

#### Managing Your Todos
- **Add Task**: Click the "Add Todo" button and fill in title and description
- **Mark Complete**: Click the checkbox next to any task
- **Edit Task**: Click the "Edit" button on any task
- **Delete Task**: Click the "Delete" button with confirmation

### For Administrators

#### Accessing Admin Dashboard
1. **Login as Admin**: Use admin credentials
2. **Auto-Redirect**: You'll be automatically redirected to `/admin/dashboard`
3. **Manual Access**: Navigate to `/admin/dashboard` if needed

#### Admin Features
- **Dashboard Overview**: View system statistics and recent activity
- **User Management**: Browse all users, view details, promote/demote admins
- **Task Management**: Monitor all tasks, edit any task, delete problematic content
- **Create Admins**: Add new administrator accounts
- **System Monitoring**: Track user engagement and task completion trends

#### Test Admin Account
```
Email: admin@example.com
Password: password
Role: admin
```

## 🧪 Testing

Run the test suite to ensure everything works correctly:
```bash
php artisan test
```

The application includes comprehensive tests for:
- User authentication and authorization
- Todo CRUD operations
- Admin functionality and access control
- Form validation and error handling

## 📁 Project Structure

```
├── app/
│   ├── Http/Controllers/
│   │   ├── AdminController.php      # Admin dashboard and management
│   │   ├── Auth/                    # Authentication controllers
│   │   └── TodoController.php       # Todo CRUD operations
│   ├── Models/
│   │   ├── User.php                 # User model with role support
│   │   └── Todo.php                 # Todo model
│   └── Http/Middleware/
│       └── AdminMiddleware.php      # Admin access control
├── database/
│   ├── factories/
│   │   └── UserFactory.php          # User factory with role states
│   └── migrations/                  # Database schema migrations
├── resources/
│   ├── views/
│   │   ├── admin/                   # Admin dashboard views
│   │   ├── auth/                    # Authentication views
│   │   ├── layouts/                 # Blade layouts
│   │   └── todos/                   # Todo management views
│   └── css/
│       └── app.css                  # Tailwind CSS entry point
├── routes/
│   ├── web.php                      # Web routes with admin middleware
│   └── auth.php                     # Authentication routes
└── tests/
    ├── Feature/                     # Feature tests
    └── Unit/                        # Unit tests
```

## 🔒 Security Features

- **CSRF Protection**: All forms protected against cross-site request forgery
- **SQL Injection Prevention**: Eloquent ORM with parameterized queries
- **XSS Protection**: Blade templating with automatic escaping
- **Authentication Middleware**: Protected routes for authenticated users
- **Admin Middleware**: Role-based access control for admin features
- **Password Hashing**: Secure bcrypt password storage
- **Input Validation**: Comprehensive form validation and sanitization

## 🎨 Customization

### Themes & Styling
- Modify `tailwind.config.js` for custom color schemes
- Update CSS in `resources/css/app.css`
- Customize Blade components in `resources/views/components/`

### Adding New Features
- Create new controllers in `app/Http/Controllers/`
- Add routes to `routes/web.php`
- Create corresponding views in `resources/views/`
- Write tests in `tests/Feature/` or `tests/Unit/`

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🆘 Support

If you encounter any issues or have questions:
1. Check the [Laravel Documentation](https://laravel.com/docs)
2. Review the test suite for expected behavior
3. Open an issue in the repository

---

**Built with ❤️ using Laravel 11.x**

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
