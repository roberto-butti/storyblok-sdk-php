<?php

declare(strict_types=1);

namespace StoryblokApi\Client\Endpoint\Params;

/**
 * @author Roberto Butti <roberto.butti@gmail.com>
 */
class StoriesParams extends BaseParams
{
    public static function make(): self
    {
        return new self();
    }


    public function findBy(string $findBy): parent
    {
        return $this->addParams("find_by", $findBy);
    }



    public function searchTerm(string $searchTerm): self
    {
        $this->params["search_term"] = $searchTerm;
        return $this;
    }
}
