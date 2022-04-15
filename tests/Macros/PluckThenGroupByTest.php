<?php

namespace AnthonyDee\CollectionMacros\Tests\Macros;

use Illuminate\Support\Collection;
use AnthonyDee\CollectionMacros\Tests\TestCase;

class PluckThenGroupByTest extends TestCase
{
    /** @test */
    public function it_can_group_a_collection_by_given_key()
    {
        $testCollection = $this->getDummyCollection()->pluckThenGroupBy('module', 'reward', 'name');
        $testGroups = $testCollection->keys();
        $expected = $this->getExpected();
        $expectedGroups = array_keys($expected);

        $this->assertCount(3, $testGroups);

        foreach ($expectedGroups as $i => $expectedGroupName) {
            $this->assertEquals($expectedGroupName, $testGroups->get($i));
            $this->assertEqualS($expected[$expectedGroupName], $testCollection->get($expectedGroupName)->toArray());
        }
    }

    protected function getDummyCollection(): Collection
    {
        return Collection::make([
            ['id' => 1, 'name' => 'Lesson 1', 'module' => 'Basics', 'reward' => 'gold'],
            ['id' => 2, 'name' => 'Lesson 2', 'module' => 'Basics', 'reward' => 'silver'],
            ['id' => 3, 'name' => 'Lesson 3', 'module' => 'Advanced', 'reward' => 'silver'],
            ['id' => 4, 'name' => 'Lesson 4', 'module' => 'Medium', 'reward' => 'gold'],
            ['id' => 5, 'name' => 'Lesson 5', 'module' => 'Advanced', 'reward' => 'silver'],
        ]);
    }

    protected function getExpected(): array
    {
        return [
              'Basics' => [
                'Lesson 1' => 'gold',
                'Lesson 2' => 'silver'
              ],
              'Advanced' => [
                'Lesson 3' => 'silver',
                'Lesson 5' => 'silver',
              ],
              "Medium" => [
                'Lesson 4' => 'gold'
              ]
        ];
    }
}