# Webpress Notification Package

Notification channel for laravel webpress core

- [Webpress Notification Package](#webpress-notification-package)
  - [Installation](#installation)
  - [Configuration](#configuration)
  - [Environment](#environment)
  - [Notification Channels](#notification-channels)
    - [Webpress notification channel](#webpress-notification-channel)

## Installation

To include the package in your project, Please run following command.

```
composer require webpress/notification
```

## Configuration

Run the following commands to publish configuration and migration files.

```
php artisan vendor:publish --provider="VCComponent\Laravel\Notification\Providers\NotificationServiceProvider"
```

## Environment

In `.env` file, we need some configuration.

```
// Communication microservice url
WEBPRESS_NOTIFICATION_BASE_URL=http://localhost:3000/api
```

## Notification Channels

### Webpress notification channel

A notification channel to support send email via Webpress Communication microservice (Currently using Mailchimp Transactional Api).

Use this channel in notification class similar to other default laravel notification channel.

```php
use VCComponent\Laravel\Notification\Notifications\Channels\WebpressChannel;

public function via($notifiable)
{
    return [WebpressChannel::class];
}
```

Define the message in `toWebpress()` method.

```php
use VCComponent\Laravel\Notification\Notifications\Messages\WebpressMessage;

public function toWebpress($notifiable)
{
    return (new WebpressMessage())
        ->to($notifiable->email)
        ->subject('Reset Password')
        ->template('WEBPRESS 01 - reset your password')
        ->mergeFields([
            [
                'name'    => 'RESET_PASSWORD_URL',
                'content' => "{$reset_password_url}?token={$this->token}",
            ],
        ]);
}
```
