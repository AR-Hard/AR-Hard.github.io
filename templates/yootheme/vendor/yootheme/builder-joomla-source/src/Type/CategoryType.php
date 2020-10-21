<?php

namespace YOOtheme\Builder\Joomla\Source\Type;

use Joomla\CMS\Categories\CategoryNode;
use Joomla\CMS\Helper\TagsHelper;
use function YOOtheme\app;
use YOOtheme\Builder\Source;
use YOOtheme\Path;
use YOOtheme\View;

class CategoryType
{
    /**
     * @param Source $source
     *
     * @return array
     */
    public function __invoke(Source $source)
    {
        $fields = [

            'title' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'Title',
                    'filters' => ['limit'],
                ],
            ],

            'description' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'Description',
                    'filters' => ['limit'],
                ],
            ],

            'numitems' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'Items Count',
                ],
            ],

            'params' => [
                'type' => 'CategoryParams',
                'metadata' => [
                    'label' => 'Params',
                ],
            ],

            'link' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'Link',
                ],
            ],

            'tagString' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'Tags',
                ],
            ],

            'parent' => [
                'type' => 'Category',
                'metadata' => [
                    'label' => 'Parent Category',
                ],
            ],

            'categories' => [
                'type' => [
                    'listOf' => 'Category',
                ],
                'metadata' => [
                    'label' => 'Child Categories',
                ],
            ],

            'tags' => [
                'type' => [
                    'listOf' => 'Tag',
                ],
                'metadata' => [
                    'label' => 'Tags',
                ],
            ],

            'field' => [
                'type' => 'CategoryFields',
                'metadata' => [
                    'label' => 'Fields',
                ],
            ],

        ];

        $metadata = [
            'type' => true,
            'label' => 'Category',
        ];

        $resolvers = $source->mapResolvers($this);

        return compact('fields', 'resolvers', 'metadata');
    }

    public function params($category)
    {
        return is_string($category->params) ? json_decode($category->params) : $category->params;
    }

    public function link($category)
    {
        return \ContentHelperRoute::getCategoryRoute($category->id, $category->language);
    }

    /**
     * @param CategoryNode $category
     *
     * @return CategoryNode
     */
    public function parent($category)
    {
        return $category->getParent();
    }

    /**
     * @param CategoryNode $category
     *
     * @return CategoryNode[]
     */
    public function categories($category)
    {
        return $category->getChildren();
    }

    public function tags($category)
    {
        if (!isset($category->tags)) {
            return (new TagsHelper())->getItemTags('com_content.category', $category->id);
        }

        return $category->tags->itemTags;
    }

    public function field($category)
    {
        return $category;
    }

    public function tagString($category, array $args)
    {
        $tags = $this->tags($category);

        return app(View::class)->render(Path::get('../../templates/tags'), compact('category', 'tags', 'args'));
    }
}
