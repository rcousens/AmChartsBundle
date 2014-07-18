<?php

namespace RedEye\AmChartsBundle\AmCharts\Option;

class ObjectOption extends AbstractOption
{
    public function __construct($name, $value = null)
    {
        if (($value instanceof ArrayOption && null === $value->getName()) || $name instanceof ArrayOption && null === $name->getName()) {
            throw new \RuntimeException('Array options nested inside object options must have a name');
        }

        if ($name instanceof OptionInterface || is_array($name)) {
            parent::__construct(null, $name);
        } else {
            parent::__construct($name, $value);
        }
    }

    public function setValue($value)
    {
        if ($value instanceof ArrayOption && null === $value->getName()) {
            throw new \RuntimeException('Array options nested inside object options must have a name');
        }
        parent::setValue($value);
    }

    public function renderNameless()
    {
        $render = "{";
        if (is_array($this->_value))  {
            foreach ($this->_value as $prop => $value) {
                if ($value instanceof OptionInterface) {
                    $render .= $value->render() . ',';
                } else {
                    $render .= json_encode($prop) . ':' . json_encode($value) . ',';
                }
            }
            $render = rtrim($render, ',');
        } elseif ($this->_value instanceof OptionInterface) {
            $render .= $this->_value->render();
        } elseif (! (null === $this->_value)) {
            $render .= json_encode($this->_value);
        }
        $render .=  '}';
        return $render;
    }

    public function renderNamed()
    {
        $render = "\"$this->_name\": {";
        if (is_array($this->_value)) {
            foreach ($this->_value as $prop => $value) {
                if ($value instanceof OptionInterface) {
                    $render .= $value->render() . ',';
                } else {
                    $render .= json_encode($prop) . ':' . json_encode($value) . ',';
                }
            }
            $render = rtrim($render, ',');
        } elseif ($this->_value instanceof OptionInterface) {
            $render .= $this->_value->render();
        } elseif (! (null === $this->_value)) {
            $render .= json_encode($this->_value);
        }
        $render .=  '}';
        return $render;
    }

}