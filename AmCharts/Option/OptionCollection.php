<?php

namespace RedEye\AmChartsBundle\AmCharts\Option;

class OptionCollection
{
    private $_options;

    public function __construct(array $options = array())
    {
        $this->_options = $options;
    }

    public function toArray()
    {
        return $this->_options;
    }

    public function add(OptionInterface $option)
    {
        $this->_options[$option->getName()] = $option;
        return true;
    }

    public function has($name)
    {
        return isset($this->_options[$name]);
    }

    public function addScalarOption($name, $value = null)
    {
        $option = new ScalarOption($name, $value);
        $this->add($option);
    }

    public function addObjectOption($name, $value = null)
    {
        $option = new ObjectOption($name, $value);
        $this->add($option);
    }

    public function addArrayOption($name, $value = null)
    {
        $option = new ArrayOption($name, $value);
        $this->add($option);
    }

    public function render()
    {
        $render = "{\n";
        if (count($this->_options)) {
            foreach ($this->_options as $option) {
                $render .= str_pad($option->render() . ",\n", 2, " ", STR_PAD_LEFT);
            }
        } else {
            return $render = rtrim($render, "\n") . "}";
        }
        return $render = rtrim($render, ",\n") . "\n" . "}";
    }

    public function __call($name, $value) {
        if ($this->has($name)) {
            $this->_options[$name]->setValue($value[0]);
        }
    }

    public function __get($name) {
        if ($this->has($name)) {
            if ($this->_options[$name] instanceof ScalarOption) {
                return $this->_options[$name]->getValue();
            }
            return $this->_options[$name];
        }
    }
}

