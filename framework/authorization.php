<?php

namespace Framework;

use Framework\Session;

class Authorization
{
    /**
     * Check if logged in user owns a listing
     * @param int $resourceId
     * @return bool
     */
    public static function isOwner($resourceId)
    {
        $userId = Session::get('user_id');

        if ($userId !== null) {
            return (int)$userId === (int)$resourceId;
        }

        return false;
    }
}
