# 📧 Email Welcome System - Laravel

## Quick Setup

### 1. Configure .env
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

### 2. Create Mailable
```bash
php artisan make:mail WelcomeEmail
```

### 3. Edit WelcomeEmail.php
```php
<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class WelcomeEmail extends Mailable
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to ' . config('app.name'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome',
            with: ['user' => $this->user],
        );
    }
}
```

### 4. Create Email Template
Create `resources/views/emails/welcome.blade.php`:
```blade
<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial; max-width: 600px; margin: 0 auto; }
        .header { background: #007bff; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f8f9fa; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Welcome!</h1>
    </div>
    <div class="content">
        <h2>Hello {{ $user->name }}!</h2>
        <p>Thank you for joining us!</p>
        <a href="{{ url('/dashboard') }}" style="background: #28a745; color: white; padding: 10px 20px; text-decoration: none;">Go to Dashboard</a>
    </div>
</body>
</html>
```

### 5. Send Email
```php
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

// In your controller or service
Mail::to($user->email)->send(new WelcomeEmail($user));
```

### 6. Test Route
```php
// Add to routes/web.php for testing
Route::get('/test-email', function () {
    $user = \App\Models\User::first();
    if ($user) {
        Mail::to($user->email)->send(new \App\Mail\WelcomeEmail($user));
        return 'Email sent!';
    }
    return 'No user found';
});
```

## Usage Examples

### Send on Registration
```php
// In registration controller
$user = User::create([...]);
Mail::to($user->email)->send(new WelcomeEmail($user));
```

### Send to Multiple Users
```php
$users = User::where('created_at', '>=', now()->subDays(1))->get();
foreach ($users as $user) {
    Mail::to($user->email)->send(new WelcomeEmail($user));
}
```

## Common Issues

### Gmail Setup
1. Enable 2FA on Gmail
2. Generate App Password
3. Use App Password in MAIL_PASSWORD

### Test with Log Driver
```env
MAIL_MAILER=log
```
This saves emails to `storage/logs/laravel.log`

### Clear Cache
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

---

> **Created by Ahmed Mohamed Abubakr** [@https://abubakr.rf.gd/] 