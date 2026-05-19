<?php

namespace Framework\Middleware;

use Framework\Session;
use Framework\Authorization;

class Authorize
{
    /**
     * Handle middleware actions like 'auth' and 'guest'
     * @param string $middleware
     * @return void
     */
    public function handle($middleware)
    {
        Session::start();

        $userId = Session::get('user_id');

        if ($middleware === 'auth') {
            if ($userId === null) {
                header('Location: /auth/login');
                exit;
            }
        }

        if ($middleware === 'guest') {
            if ($userId !== null) {
                header('Location: /');
                exit;
            }
        }
    }
}
