<?php

namespace RedEye\AmChartsBundle\AmCharts;

class SimpleOption
{
    private $option_value;

    /**
     * @param string $name
     * @param array $value
     *
     * @return $this
     */
    public function __call($name, $value)
    {
        $this->option_value = $value[0];

        return $this;
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        return $this->option_value;
    }

    /**
     *
     */
    public function __isset($name)
    {
        if (isset($this->option_value)) {
            return true;
        }
        return false;
    }
}