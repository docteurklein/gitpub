<?php

namespace App\Serializer\Handler;

use Generator;
use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\VisitorInterface;
use JMS\Serializer\Handler\SubscribingHandlerInterface;

class GeneratorHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods()
    {
        $methods = array();
        $formats = array('json', 'xml', 'yml');
        foreach ($formats as $format) {
            $methods[] = array(
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'type' => 'Generator',
                'format' => $format,
                'method' => 'serializeCollection',
            );
        }

        return $methods;
    }

    public function serializeCollection(VisitorInterface $visitor, Generator $generator, array $type, Context $context)
    {
        $type['name'] = 'array';

        return $visitor->visitArray($generator, $type, $context);
    }
}
