<?php

namespace App\Search;

class SearchHandlerValidator
{
    const MINIMUM_LENGTH = 3;

    /**
     * @param string $keyword
     */
    public function validate($keyword)
    {
        if (!$keyword) {
            throw new \LogicException('Keyword must be provided');
        }

        if (strlen($keyword) < self::MINIMUM_LENGTH) {
            throw new \LogicException(sprintf("Keyword must be at least %s symbols", self::MINIMUM_LENGTH));
        }
    }
}
