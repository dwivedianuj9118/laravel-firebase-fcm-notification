<?php
    
    namespace Dwivedianuj9118\FirebaseFcmNotification;
    
    use Exception;
    use Illuminate\Support\Facades\Log;
    use Kreait\Firebase\Factory;
    use Kreait\Firebase\Messaging\CloudMessage;
    use Kreait\Firebase\Messaging\Notification;
    
    class NotificationService
    {
        private $messaging;
        
        public function __construct()
        {
            $firebase = (new Factory)
                ->withServiceAccount(public_path('firebase_credentials.json'));
            $this->messaging = $firebase->createMessaging();
        }
        
        public static function sendTokenFcm($fcm_token, $title, $body, $img = null, $sound = 'default')
        {
            try {
                if (!empty($fcm_token)) {
                    $notification = Notification::create($title, $body, $img);
                    $data = compact('title', 'body', 'img', 'sound');
                    
                    $instance = new self();
                    $message = CloudMessage::new()
                        ->withNotification($notification)
                        ->withData($data)
                        ->toToken($fcm_token);
                    
                    $res = $instance->messaging->send($message);
                    Log::info('Notification sent: ' . json_encode($res));
                    return $res;
                }
            } catch (Exception $exception) {
                Log::error('FCM Error: ' . $exception->getMessage());
                return json_encode($exception->getMessage());
            }
        }
        
        public static function sendMulticastFCM($deviceTokens, $title, $body, $img = null, $sound = 'default')
        {
            try {
                if (!empty($deviceTokens)) {
                    $notification = Notification::create($title, $body, $img);
                    $data = compact('title', 'body', 'img', 'sound');
                    
                    $instance = new self();
                    $message = CloudMessage::new()
                        ->withNotification($notification)
                        ->withData($data);
                    
                    $res = $instance->messaging->sendMulticast($message, $deviceTokens);
                    Log::info('Multicast Notification sent: ' . json_encode($res));
                    return $res;
                }
            } catch (Exception $exception) {
                Log::error('Multicast FCM Error: ' . $exception->getMessage());
                return json_encode($exception->getMessage());
            }
        }
        
        public static function sendTopicFcm($topic, $title, $body, $img = null, $sound = 'default')
        {
            try {
                if (!empty($topic)) {
                    $notification = Notification::create($title, $body, $img);
                    $data = compact('title', 'body', 'img', 'sound');
                    
                    $instance = new self();
                    $message = CloudMessage::new()
                        ->withNotification($notification)
                        ->withData($data)
                        ->toTopic($topic);
                    
                    $res = $instance->messaging->send($message);
                    Log::info('Topic Notification sent: ' . json_encode($res));
                    return $res;
                }
            } catch (Exception $exception) {
                Log::error('Topic FCM Error: ' . $exception->getMessage());
                return json_encode($exception->getMessage());
            }
        }
        
        public static function sendNotice($data, $fcmtype, $fcm_token, $type = "notification")
        {
            try {
                if (!empty($fcm_token)) {
                    $instance = new self();
                    $message = CloudMessage::new();
                    
                    if ($type == "notification") {
                        $notification = Notification::fromArray($data);
                        $message = $message->withNotification($notification);
                    } else {
                        $message = $message->withData($data);
                    }
                    
                    if ($fcmtype === 'token') {
                        $message = $message->toToken($fcm_token);
                    }else{
                        $message = $message->toTopic($fcm_token);
                    }
                    
                    
                    $res = $instance->messaging->send($message);
                    Log::info('Notice sent: ' . json_encode($res));
                    return $res;
                }
            } catch (Exception $exception) {
                Log::error('Notice FCM Error: ' . $exception->getMessage());
                return json_encode($exception->getMessage());
            }
        }
    }
