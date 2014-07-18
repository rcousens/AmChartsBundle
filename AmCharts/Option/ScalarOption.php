<?php

namespace RedEye\AmChartsBundle\AmCharts\Option;

class ScalarOption extends AbstractOption
{
    public function __construct($name, $value = null)
    {
        if (null === $value || is_scalar($value)) {
            parent::__construct($name, $value);
        } else {
            throw new \RuntimeException('Not a scalar value');
        }
    }

    public function setValue($value)
    {
        if (! is_scalar($value) || ! (null === $value)) {
            throw new \RuntimeException('Primitives or nulls only');
        }
        $this->_value = $value;
    }

    public function renderNameless()
    {
        if (null === $this->_value) {
            return "\"\"";
        } else {
            return json_encode($this->_value);
        }
    }

    public function renderNamed()
    {
        if (null === $this->_value) {
            return "\"{$this->_name}\": \"\"";
        } else {
            return "\"{$this->_name}\": " . json_encode($this->_value);
        }
    }
}