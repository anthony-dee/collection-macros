<?php

namespace AnthonyDee\CollectionMacros\Tests;

use AnthonyDee\CollectionMacros\CollectionMacrosServiceProvider;
use PHPUnit\Framework\TestCase as BaseTestCase;
use ReflectionClass;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        $this->createReflectedProvider()->register();
    }

    protected function createReflectedProvider(): CollectionMacrosServiceProvider
    {
        $reflectionClass = new ReflectionClass(CollectionMacrosServiceProvider::class);
        return $reflectionClass->newInstanceWithoutConstructor();
    }
}