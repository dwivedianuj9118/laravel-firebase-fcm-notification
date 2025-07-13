# Firebase FCM Notification for Laravel

A Laravel wrapper to send Firebase Cloud Messaging (FCM) notifications via tokens, topics, or multicast using the [kreait/firebase-php](https://github.com/kreait/firebase-php) SDK.
## Required Dependency
```bash
composer require "kreait/firebase-php:^7.0" 
```
## 📦 Installation
Install the package via Composer:
```bash
composer require dwivedianuj9118/firebase-fcm-notification
or 
composer require dwivedianuj9118/firebase-fcm-notification:dev-main
```
### Vendor Publish
```bash
php artisan vendor:publish --tag=papaya-fcm-config
```
## 🔐 Setup
Add your Firebase credentials:

Download your firebase_credentials.json from Firebase Console.

Place the file at the following location in your Laravel project:
```php
/public/firebase_credentials.json
```
### ✅ Features
Send push notifications to:

1. Individual device tokens
2. Topics
3. Multiple devices (Multicast)
4. Send both notification and data payloads
5. Logs notifications via Laravel logging

## 🚀 Usage
Import the NotificationService class:
```php
use Dwivedianuj9118\FirebaseFcmNotification\NotificationService;
```
### 🔹 Send Notification to Device Token
```php
NotificationService::sendTokenFcm(
    $fcmToken,
    'Welcome!', // Title
    'You have a new message.', // body Description
    'https://example.com/image.jpg' // Optional image
    'sound url' //Optional Sound 
);
```
### 🔹 Send Notification to Topic
```php
NotificationService::sendTopicFcm(
    'news', // topic name
    'Breaking News!', // Title
    'Check out our latest update', // body Description
    null, // Optional image
    'default' //Optional Sound 
);

```
### 🔹 Send Multicast Notification (Multiple Devices)
```php
NotificationService::sendMulticastFCM(
    [$token1, $token2], // multiple token separated by ,(commas)
    'Group Message', //Title 
    'This is sent to multiple devices.' // Body
);
```
## Send Custom Notice (Flexible)
```php
$data = [
    'title' => 'Custom Title',
    'body' => 'This is a custom message body',
    'custom_key' => 'custom_value'
];

// For notification
NotificationService::sendNotice($data, 'token', $fcmToken, 'notification');

// For data only
NotificationService::sendNotice($data, 'token', $fcmToken, 'data');

```

## 📝 Logging
All notifications and errors are automatically logged via Laravel’s Log::info and Log::error.

## 🛠 Dependencies
* kreait/firebase-php
* Laravel 8+


### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email dwivedianuj9118@gmail.com instead of using the issue tracker.

## Credits

-   [Anuj Dwivedi](https://github.com/dwivedianuj9118)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

