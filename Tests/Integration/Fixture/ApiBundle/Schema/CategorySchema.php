<?php

namespace Plehatron\LimoncelloBundle\Tests\Integration\Fixture\ApiBundle\Schema;

use Neomerx\JsonApi\Schema\SchemaProvider;
use Plehatron\LimoncelloBundle\Tests\Integration\Fixture\ApiBundle\Entity\Category;

class CategorySchema extends SchemaProvider
{
    /**
     * @inheritdoc
     */
    protected $resourceType = 'category';

    /**
     * @inheritdoc
     */
    protected $selfSubUrl = '/api/category/';

    /**
     * @inheritdoc
     */
    public function getId($category)
    {
        /** @var Category $category */
        return $category->getId();
    }

    /**
     * @inheritdoc
     */
    public function getAttributes($category)
    {
        /** @var Category $category */
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getRelationships($category, array $includeRelationships = [])
    {
        /** @var Category $category */
        return [];
    }
}
