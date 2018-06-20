<?php

namespace ZF\Doctrine\GraphQL;

use Exception;

/**
 * Enable caching of build() resources
 */
abstract class AbstractAbstractFactory
{
    private $services = [];

    protected function isCached($requestedName, array $options = null)
    {
        foreach ($this->services as $service) {
            if ($service['requestedName'] == $requestedName && $service['options'] == $options) {
                return true;
            }
        }

        return false;
    }

    protected function getCache($requestedName, array $options = null)
    {
        foreach ($this->services as $service) {
            if ($service['requestedName'] == $requestedName && $service['options'] == $options) {
                return $service['instance'];
            }
        }

        throw new Exception('Cache not found for ' . $requestedName);
    }

    protected function cache($requestedName, array $options = null, $instance)
    {
        foreach ($this->services as $service) {
            if ($service['requestedName'] == $requestedName && $service['options'] == $options) {
                return;
            }
        }

        $this->services[] = [
            'requestedName' => $requestedName,
            'options' => $options,
            'instance' => $instance,
        ];
    }
}
