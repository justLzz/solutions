<?php


namespace Justlzz\Solutions\DesignPattern\Facade;


class Facade
{
    private $dvd;

    private $popcorn;

    private $projector;

    private $screen;

    private $stereo;

    public function __construct()
    {
        $this->dvd = DvdPlayer::getInstance();
        $this->popcorn = Popcorn::getInstance();
        $this->projector = Projector::getInstance();
        $this->screen = Screen::getInstance();
        $this->stereo = Stereo::getInstance();
    }

    //开幕
    public function start()
    {
        $this->dvd->on();
        $this->stereo->on();
        $this->screen->up();
        $this->projector->on();
        $this->popcorn->on();

    }

    //闭幕
    public function close()
    {
        $this->dvd->off();
        $this->stereo->off();
        $this->popcorn->off();
        $this->projector->off();
        $this->screen->down();
    }

}