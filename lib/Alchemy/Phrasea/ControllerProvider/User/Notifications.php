<?php

/*
 * This file is part of Phraseanet
 *
 * (c) 2005-2016 Alchemy
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Alchemy\Phrasea\ControllerProvider\User;

use Alchemy\Phrasea\ControllerProvider\ControllerProviderTrait;
use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ServiceProviderInterface;

class Notifications implements ControllerProviderInterface, ServiceProviderInterface
{
    use ControllerProviderTrait;

    public function register(Application $app)
    {
        /* remove in favor of existing /session/ route
        *
        $app['controller.user.notifications'] = $app->share(function (PhraseaApplication $app) {
            return (new UserNotificationController($app));
        });
        */
    }

    public function boot(Application $app)
    {
        // no-op
    }

    /**
     * {@inheritDoc}
     */
    public function connect(Application $app)
    {
        $controllers = $this->createAuthenticatedCollection($app);
        $firewall = $this->getFirewall($app);

        $controllers->before(function () use ($firewall) {
            $firewall->requireNotGuest();
        });

        /* remove in favor of existing /session/ route
        *
        /** @uses  UserNotificationController::listNotifications * /
        $controllers->get('/', 'controller.user.notifications:listNotifications')
            ->bind('get_notifications');

        /** @uses  UserNotificationController::readNotifications() * /
        $controllers->post('/read/', 'controller.user.notifications:readNotifications')
            ->bind('set_notifications_readed');
        */

        return $controllers;
    }
}
