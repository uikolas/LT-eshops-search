<?php

namespace App\Search;

class SearcherValidator
{
    const MINIMUM_LENGTH = 3;

    /**
     * @param string $keyword
     */
    public function validate(string $keyword)
    {
        if (!$keyword) {
            throw new \LogicException('Keyword must be provided');
        }

        if (strlen($keyword) < self::MINIMUM_LENGTH) {
            throw new \LogicException(sprintf("Keyword must be at least %s symbols", self::MINIMUM_LENGTH));
        }
    }
}
