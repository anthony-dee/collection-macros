<?php

namespace AnthonyDee\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/**
 * @mixin \Illuminate\Support\Collection
 */
class PluckThenGroupBy {
    public function __invoke(): \Closure
    {
        return function ($groupBy, $pluckValue, $pluckKey) {
            $groupNameRetriever = $this->valueRetriever($groupBy);
            $pluckValueRetriever = $this->valueRetriever($pluckValue);
            $pluckKeyRetriever = $this->valueRetriever($pluckKey);

            $results = new Collection();

            foreach($this->items as $key => $value) {
                $groupName = $groupNameRetriever($value);
                $pluckedVal = $pluckValueRetriever($value);
                $pluckedKey = $pluckKeyRetriever($value);

                if (!$results->has($groupName)) {
                    $results->offsetSet($groupName, new Collection([$pluckedKey => $pluckedVal]));
                } else {
                    $results->get($groupName)->offsetSet($pluckedKey, $pluckedVal);
                }
            }

            return $results;
        };
    }
}