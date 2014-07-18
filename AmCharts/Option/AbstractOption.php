<?php

namespace RedEye\AmChartsBundle\AmCharts\Option;

abstract class AbstractOption implements OptionInterface
{
    protected $_value;
    protected $_name;

    public function __construct($name = null, $value = null)
    {
        $this->_name = $name;
        $this->_value = $value;
    }

    public function setValue($value)
    {
            $this->_value = $value;
    }

    public function getValue()
    {
        return $this->_value;
    }

    public function render()
    {
        if (null === $this->_name) {
            return $this->renderNameless();
        } else {
            return $this->renderNamed();
        }
    }

    public function renderNamed()
    {
        echo "rendering $this->_name: ";
        if ($this->_value instanceof OptionInterface && ! $this->_value instanceof ScalarOption) {
            return "\"{$this->_name}\": " . $this->_value->render();
        }

    }

    public function renderNameless()
    {
        echo "rendering noname: ";
        if ($this->_value instanceof OptionInterface) {
            echo "nameless other option\n";
            return $this->_value->render();
        }
    }

    public function getName()
    {
        return $this->_name;
    }

    public function __call($name, $value) {
        if (! is_array($this->_value) && $this->_name === $name) {
            $this->_value = $value;
        } elseif (is_array($this->_value)) {
            foreach ($this->_value as $element) {
                if ($element instanceof OptionInterface && $element->getName() === $name) {
                    $element->setValue($value[0]);
                } else {
                    echo ('.');
                    $element->{$name}($value[0]);
                }
            }
        }
    }
}