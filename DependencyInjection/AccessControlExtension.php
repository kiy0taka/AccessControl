<?php

namespace Plugin\AccessControl\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

class AccessControlExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container)
    {
    }

    public function prepend(ContainerBuilder $container)
    {
        $extensionConfigsRefl = new \ReflectionProperty(ContainerBuilder::class, 'extensionConfigs');
        $extensionConfigsRefl->setAccessible(true);
        $extensionConfigs = $extensionConfigsRefl->getValue($container);

        foreach($extensionConfigs["security"] as $key => $security) {
            if (isset($security["access_control"])) {
                $access_control = $security["access_control"];
                $access_control[] = [
                    'path' => '^/myplugin/login',
                    'roles' => 'IS_AUTHENTICATED_ANONYMOUSLY',
                    'requires_channel' => 'https'
                ];
                $extensionConfigs["security"][$key]["access_control"] = $access_control;
            }
        }

        $extensionConfigsRefl->setValue($container, $extensionConfigs);
    }
}