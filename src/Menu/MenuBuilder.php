<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;

class MenuBuilder
{
    private $factory;

    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(array $options): ItemInterface
    {
        $options = [ 'childrenAttributes' => [ 'class' => 'nav justify-content-center' ], 'currentClass' => 'active'];
        $menu = $this->factory->createItem('root', $options);
        $menu->addChild('Home', [
            'route' => 'home',
            'attributes' => ['class'=>'nav-item text-dark'],
            'linkAttributes' => ['class'=>'nav-link px-3 text-dark'],
        ]);
        $menu->addChild('Market', [
            'route' => 'market_index',
            'attributes' => ['class'=>'nav-item text-dark'],
            'linkAttributes' => ['class'=>'nav-link px-3 text-dark'],
        ]);
        return $menu;
    }
}