<?php


namespace App\FrontModule\Components;


use Nette\Application\UI\Control;

class Keyboard extends Control
{
    public function render()
    {
        $this->template->setFile(__DIR__ . '/Keyboard.latte');
        $this->template->render();
    }
}

interface IKeyboard
{
    /**
     * @return Keyboard
     */
    public function create();
}