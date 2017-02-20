<?php

namespace App\Services;

use Aura\Session\SessionFactory;

class Session
{
    const SEGMENT_NAME = 'CHECON_SESSION';

    private static $service;
    private $factory;
    private $session;
    public function __construct()
    {
        $this->factory = new SessionFactory();
        $this->session = $this->factory->newInstance($_COOKIE);
    }
    /**
     * Get a Segment instance.
     * @param $name
     * @return \Aura\Session\Segment
     */
    public static function getSegment()
    {
        return self::getInstance()->session->getSegment(self::SEGMENT_NAME);
    }
    /**
     * Get an instance of the SessionService.
     * @return Session
     */
    public static function getInstance()
    {
        if (!self::$service) {
            self::$service = new self();
        }
        return self::$service;
    }

    public static function set(array $attributes)
    {
        $segment = self::getSegment();
        foreach ($attributes as $key => $value) {
            $segment->set($key, $value);
        }
    }

    public static function get($key)
    {
        return self::getSegment()->get($key);
    }

    /**
     * Removes session data, effectively logging out the user.
     */
    public static function clear()
    {
        self::getSegment()->clear();
    }
}