<?php

namespace Dwivedianuj9118\FirebaseFcmNotification;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Dwivedianuj9118\FirebaseFcmNotification\Skeleton\SkeletonClass
 */
class FirebaseFcmNotificationFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'firebase-fcm-notification';
    }
}
