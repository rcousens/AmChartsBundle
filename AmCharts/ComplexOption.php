<?php

namespace RedEye\AmChartsBundle\AmCharts;

class ComplexOption
{
    private $option_name;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->option_name = $name;
        $this->{$name} = new \stdClass();
    }

    /**
     * @param string $name
     * @param array $value
     *
     * @return $this
     */
    public function __call($name, $value)
    {
        $option_name = $this->option_name;
        $this->{$option_name}->{$name} = $value[0];

        return $this;
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        $option_name = $this->option_name;
        $value = $this->{$option_name}->{$name};

        return $value;
    }

    /**
     *
     */
    public function __isset($name)
    {
        $option_name = $this->option_name;
        if (isset($this->{$option_name}->{$name})) {
            return true;
        }
        return false;
    }
}