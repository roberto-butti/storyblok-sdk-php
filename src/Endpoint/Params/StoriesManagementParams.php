<?php

namespace StoryblokApi\Client\Endpoint\Params;

class StoriesManagementParams extends BaseParams
{
    public static function make(): self
    {
        return new self();
    }

    public function findBy(string $findBy): parent
    {
        return $this->addParams("find_by", $findBy);
    }
}
