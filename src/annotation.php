<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

