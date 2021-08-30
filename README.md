# Webpress Notification Package

Notification channel for laravel webpress core

- [Webpress Notification Package](#webpress-notification-package)
  - [Installation](#installation)
  - [Configuration](#configuration)
  - [Environment](#environment)
  - [Notification Channels](#notification-channels)
    - [Webpress notification channel](#webpress-notification-channel)
  - [APIs List](#apis-list)

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
WEBPRESS_NOTIFICATION_BASE_URL=https://api.dev.webpress.vn/communication
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

# APIs List

Here is the list of APIs provided by the package.

| Verb   | URI                                               | Action                               |
| ------ | ------------------------------------------------- | ------------------------------------ |
| GET    | `/api/{namespace}/notification-setting/configable`| get configable notifications of user |
| GET    | `/api/{namespace}/notification-setting`           | get user notification settings       |
| PUT    | `/api/{namespace}/notification-setting/sync`      | update user notification settings    |
| ------ | ------                                            | ------                               |
| GET    | `/api/{namespace}/admin/notifications`            | get list notifications               |
| GET    | `/api/{namespace}/admin/notifications/{id}`       | get a notification                   |
| POST   | `/api/{namespace}/admin/notifications`            | create a notification                |
| PUT    | `/api/{namespace}/admin/notifications/{id}`       | update a notification                |
| DELETE | `/api/{namespace}/admin/notifications/{id}`       | delete a notification                |
| ------ | ------                                            | ------                               |
| GET    | `/api/{namespace}/admin/template-variants`        | get list template variants           |
| GET    | `/api/{namespace}/admin/template-variants/{id}`   | get a template variant               |
| POST   | `/api/{namespace}/admin/template-variants`        | create a template variant            |
| PUT    | `/api/{namespace}/admin/template-variants/{id}`   | update a template variant            |
| DELETE | `/api/{namespace}/admin/template-variants/{id}`   | delete a template variant            |
| ------ | ------                                            | ------                               |
| GET    | `/api/{namespace}/admin/notification-setting/role/{role_id}`| get role notification settings|
| PUT    | `/api/{namespace}/admin/notification-setting`     | update role template variant         |