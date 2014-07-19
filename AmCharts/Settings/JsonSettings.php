<?php

namespace RC\AmChartsBundle\AmCharts\Settings;

use RC\AmChartsBundle\AmCharts\JsonTypes\JsonObject;

class JsonSettings implements \JsonSerializable
{
    protected $rootObject;

    public function __construct()
    {
        $this->rootObject = new JsonObject();
    }

    public function __get($name)
    {
        return $this->rootObject;
    }

    public function __call($name, $value)
    {
        $this->rootObject->{$name}($value[0]);
    }

    public function jsonSerialize()
    {
        return $this->rootObject;
    }
}
