<?php

declare(strict_types=1);

namespace StoryblokApi\Client\Endpoint\Params;

/**
 * @author Roberto Butti <roberto.butti@gmail.com>
 */
class Sort
{
    /**
     * @var array<string,SortAttribute>
     */
    protected array $sorts;

    public function __construct()
    {
        $this->sorts = [];
    }


    public function getQueryString(): string
    {
        $path = "";
        $separator = "";
        foreach ($this->sorts as $sortAttribute) {
            $path .= $separator.$sortAttribute->getAsQueryString();
            $separator = ",";
        }
        return $path;
    }

    public function sortBy(
        string $field,
        string $direction=SortAttribute::ASCENDING,
        string $type= SortAttribute::SORT_TYPE_DEFAULT
    ): self {
        $this->sorts[$field] = new SortAttribute($field, $direction, $type);
        return $this;
    }


    /**
     * @return array|SortAttribute[]
     */
    public function getSorts(): array
    {
        return $this->sorts;
    }

    public function merge(Sort|null $sorts): self
    {
        if (! is_null($sorts)) {
            $this->sorts = array_merge($this->sorts, $sorts->getSorts());
        }
        return $this;
    }



}
