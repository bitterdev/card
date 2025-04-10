<?php

namespace Bitter\Card\Routing;

use Bitter\Card\API\V1\Middleware\FractalNegotiatorMiddleware;
use Bitter\Card\API\V1\Configurator;
use Concrete\Core\Routing\RouteListInterface;
use Concrete\Core\Routing\Router;

class RouteList implements RouteListInterface
{
    public function loadRoutes(Router $router)
    {
        $router
            ->buildGroup()
            ->setNamespace('Concrete\Package\Card\Controller\Dialog\Support')
            ->setPrefix('/ccm/system/dialogs/card')
            ->routes('dialogs/support.php', 'card');
    }
}