<?php
namespace RestBeer;

use Dflydev\FigCookies\SetCookie;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use PSR7Session\Http\SessionMiddleware;
use PSR7Session\Time\SystemCurrentTime;

class Session
{
    public function get()
    {
        $sessionMiddleware = new SessionMiddleware(
            new Sha256(),
            'c9UA8QKLSmDEn4DhNeJIad/4JugZd/HvrjyKrS0jOes=', // signature key (important: change this to your own)
            'c9UA8QKLSmDEn4DhNeJIad/4JugZd/HvrjyKrS0jOes=', // verification key (important: change this to your own)
            SetCookie::create('an-example-cookie-name')
                ->withSecure(false) // false on purpose, unless you have https locally
                ->withHttpOnly(true)
                ->withPath('/'),
            new Parser(),
            1200, // 20 minutes
            new SystemCurrentTime()
        );
        return $sessionMiddleware;
    }
}
