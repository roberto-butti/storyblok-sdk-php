<?php

declare(strict_types=1);

namespace StoryblokApi\Client\Endpoint\Params;

/**
 * @author Roberto Butti <roberto.butti@gmail.com>
 */
class SortAttribute
{
    public const ASCENDING = 'asc';
    public const DESCENDING = 'desc';

    public const SORT_TYPE_DEFAULT = "";
    public const SORT_TYPE_INT = "int";
    public const SORT_TYPE_FLOAT = "float";


    public function __construct(
        public string $fieldname,
        public string $direction = self::ASCENDING,
        public string $type = self::SORT_TYPE_DEFAULT
    ) {
    }

    public function getAsQueryString(): string
    {
        $string = "";
        $string = $this->fieldname . ":" . $this->direction .
            (($this->type == self::SORT_TYPE_DEFAULT) ?
                "" :
                ":" . $this->type);
        return $string;
    }


}
