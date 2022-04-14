<?php

namespace AnthonyDee\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/**
 * @mixin Collection
 */
class PluckThenGroupBy {
    public function __invoke(): \Closure
    {
        return function ($groupBy, $pluckValue, $pluckKey = null) {
            $groupNameRetriever = $this->valueRetriever($groupBy);
            $pluckValueRetriever = $this->valueRetriever($pluckValue);

            if (!is_null($pluckKey)) {
                $pluckKeyRetriever = $this->valueRetriever($pluckKey);
            }

            $results = new Collection();

            foreach($this->items as $item) {
                $groupName = $groupNameRetriever($item);
                $pluckedVal = $pluckValueRetriever($item);

                if (!is_null($pluckKey)) {
                    $pluckedKey = $pluckKeyRetriever($item);
                }

                if (!$results->has($groupName)) {
                    $results->offsetSet($groupName, new Collection());
                }

                if (!is_null($pluckKey)) {
                    $results->get($groupName)->put($pluckedKey, $pluckedVal);
                } else {
                    $results->get($groupName)->push($pluckedVal);
                }
            }

            return $results;
        };
    }
}