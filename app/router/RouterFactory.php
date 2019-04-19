<?php

namespace App;

use Nette;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	/**
	 * @return Nette\Application\IRouter
	 */
	public static function createRouter()
	{
		$router = new RouteList;

        $frontRouter = new RouteList('Front');
        $frontRouter[] = new Route('<presenter>/<action>[/<id>]', 'Homepage:default');

        $adminRouter = new RouteList('Admin');
        $adminRouter[] = new Route('admin/<presenter>/<action>[/<id>]', 'Default:default');

        $router[] = $adminRouter;
        $router[] = $frontRouter;

        return $router;
	}
}
