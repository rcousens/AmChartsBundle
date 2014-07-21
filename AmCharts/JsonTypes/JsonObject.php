<?php

namespace RC\AmChartsBundle\AmCharts\JsonTypes;

class JsonObject implements \JsonSerializable
{
    protected $propertyContainer;

    public function __construct($propertyContainer = null)
    {
        if (is_object($propertyContainer)) {
            $this->propertyContainer = $propertyContainer;
        } else {
            $this->propertyContainer = new \stdClass();
        }
    }

    public function __call($name, $value)
    {
        // create properties appropriately
        if (!isset($this->propertyContainer->{$name})) {
            if (is_array($value[0])) {
                $this->setProperty($name, new JsonArray($value[0]));
            }
            if (is_scalar($value[0])) {
                $this->setProperty($name, $value[0]);
            }
            if (is_object($value[0])) {
                $this->setProperty($name, new JsonObject($value[0]));
            }
        } else {
            // if call on prop of array
            if ($this->getProperty($name) instanceof JsonArray) {
                if (is_array($value[0])) {
                    // overwrite with new array values
                    $this->getProperty($name)->setElements($value[0]);
                } else {
                    // add elements to it for objects/scalars
                    $this->getProperty($name)->addElement($value[0]);
                }

            }

            // allow replacement of existing objects
            if ($this->getProperty($name) instanceof JsonObject) {
                if (is_object($value[0])) {
                    $this->getProperty($name)->setPropertyContainer($value[0]);
                }
            }

            // allow updating of scalar values
            if (is_scalar($this->getProperty($name)) && is_scalar($value[0])) {
                $this->setProperty($name, $value[0]);
            }
        }
    }

    public function __get($name)
    {
        return $this->propertyContainer->{$name};
    }

    public function setProperty($name, $value)
    {
        $this->propertyContainer->{$name} = $value;
    }

    public function getProperty($name)
    {
        return $this->propertyContainer->{$name};
    }

    public function setPropertyContainer($propertyContainer)
    {
        if (is_object($propertyContainer)) {
            $this->propertyContainer = $propertyContainer;
        }
    }

    public function getPropertyContainer()
    {
        return $this->propertyContainer;
    }

    public function jsonSerialize()
    {
        return $this->propertyContainer;
    }
}
