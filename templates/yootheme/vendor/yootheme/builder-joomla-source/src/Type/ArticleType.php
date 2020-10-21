<?php

namespace YOOtheme\Builder\Joomla\Source\Type;

use Joomla\CMS\Categories\Categories;
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\TagsHelper;
use function YOOtheme\app;
use YOOtheme\Builder\Source;
use YOOtheme\Path;
use YOOtheme\View;

class ArticleType
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

            'content' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'Content',
                    'filters' => ['limit'],
                ],
            ],

            'teaser' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'Teaser',
                    'filters' => ['limit'],
                ],
            ],

            'publish_up' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'Published',
                    'filters' => ['date'],
                ],
            ],

            'created' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'Created',
                    'filters' => ['date'],
                ],
            ],

            'modified' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'Modified',
                    'filters' => ['date'],
                ],
            ],

            'metaString' => [
                'type' => 'String',
                'args' => [
                    'format' => [
                        'type' => 'String',
                    ],
                    'separator' => [
                        'type' => 'String',
                    ],
                    'link_style' => [
                        'type' => 'String',
                    ],
                    'show_publish_date' => [
                        'type' => 'Boolean',
                    ],
                    'show_author' => [
                        'type' => 'Boolean',
                    ],
                    'show_category' => [
                        'type' => 'Boolean',
                    ],
                ],
                'metadata' => [
                    'label' => 'Meta',
                    'arguments' => [

                        'format' => [
                            'label' => 'Format',
                            'description' => 'Display the meta text in a sentence or a horizontal list.',
                            'type' => 'select',
                            'default' => 'list',
                            'options' => [
                                'List' => 'list',
                                'Sentence' => 'sentence',
                            ],
                        ],
                        'separator' => [
                            'label' => 'Separator',
                            'description' => 'Set the separator between fields.',
                            'default' => '|',
                            'enable' => 'arguments.format === "list"',
                        ],
                        'link_style' => [
                            'label' => 'Link Style',
                            'description' => 'Set the link style.',
                            'type' => 'select',
                            'default' => '',
                            'options' => [
                                'Default' => '',
                                'Muted' => 'link-muted',
                                'Text' => 'link-text',
                                'Heading' => 'link-heading',
                                'Reset' => 'link-reset',
                            ],
                        ],
                        'show_publish_date' => [
                            'label' => 'Display',
                            'description' => 'Show or hide fields in the meta text.',
                            'type' => 'checkbox',
                            'default' => true,
                            'text' => 'Show date',
                        ],
                        'show_author' => [
                            'type' => 'checkbox',
                            'default' => true,
                            'text' => 'Show author',
                        ],
                        'show_category' => [
                            'type' => 'checkbox',
                            'default' => true,
                            'text' => 'Show category',
                        ],

                    ],
                ],
            ],

            'tagString' => [
                'type' => 'String',
                'args' => [
                    'separator' => [
                        'type' => 'String',
                    ],
                    'show_link' => [
                        'type' => 'Boolean',
                    ],
                    'link_style' => [
                        'type' => 'String',
                    ],
                ],
                'metadata' => [
                    'label' => 'Tags',
                    'arguments' => [

                        'separator' => [
                            'label' => 'Separator',
                            'description' => 'Set the separator between tags.',
                            'default' => ', ',
                        ],
                        'show_link' => [
                            'label' => 'Link',
                            'type' => 'checkbox',
                            'default' => true,
                            'text' => 'Show link',
                        ],
                        'link_style' => [
                            'label' => 'Link Style',
                            'description' => 'Set the link style.',
                            'type' => 'select',
                            'default' => '',
                            'options' => [
                                'Default' => '',
                                'Muted' => 'link-muted',
                                'Text' => 'link-text',
                                'Heading' => 'link-heading',
                                'Reset' => 'link-reset',
                            ],
                            'enable' => 'arguments.show_link',
                        ],

                    ],
                ],
            ],

            'images' => [
                'type' => 'ArticleImages',
                'metadata' => [
                    'label' => 'Images',
                ],
            ],

            'link' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'Link',
                ],
            ],

            'hits' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'Hits',
                ],
            ],

            'urls' => [
                'type' => 'ArticleUrls',
                'metadata' => [
                    'label' => 'Urls',
                ],
            ],

            'event' => [
                'type' => 'ArticleEvent',
                'metadata' => [
                    'label' => 'Events',
                ],
            ],

            'category' => [
                'type' => 'Category',
                'metadata' => [
                    'label' => 'Category',
                ],
            ],

            'author' => [
                'type' => 'User',
                'metadata' => [
                    'label' => 'Author',
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
                'type' => 'ArticleFields',
                'metadata' => [
                    'label' => 'Fields',
                ],
            ],

        ];

        $metadata = [
            'type' => true,
            'label' => 'Article',
        ];

        $resolvers = $source->mapResolvers($this);

        return compact('fields', 'resolvers', 'metadata');
    }

    public function content($article)
    {
        if (isset($article->text)) {
            return $article->text;
        }

        if ($article->params->get('show_intro', '1') === '1') {
            return "{$article->introtext} {$article->fulltext}";
        }

        if ($article->fulltext) {
            return $article->fulltext;
        }

        return $article->introtext;
    }

    public function teaser($article)
    {
        if (class_exists(\FieldsHelper::class)) {
            $fields = \FieldsHelper::getFields('com_content.article', $article, true);

            foreach ($fields as $field) {
                if ($field->name === 'excerpt' && $field->rawvalue) {
                    return $field->rawvalue;
                }
            }
        }

        return $article->introtext;
    }

    public function link($article)
    {
        return \ContentHelperRoute::getArticleRoute($article->id, $article->catid, $article->language);
    }

    public function images($article)
    {
        return json_decode($article->images);
    }

    public function urls($article)
    {
        return json_decode($article->urls);
    }

    public function author($article)
    {
        return Factory::getUser($article->created_by);
    }

    public function category($article)
    {
        return Categories::getInstance('content', ['countItems' => true])->get($article->catid);
    }

    public function tags($article)
    {
        if (!isset($article->tags)) {
            return (new TagsHelper())->getItemTags('com_content.article', $article->id);
        }

        return $article->tags->itemTags;
    }

    public function field($article)
    {
        return $article;
    }

    public function event($article)
    {
        return $article;
    }

    public function tagString($article, array $args)
    {
        $tags = $this->tags($article);
        $args += ['separator' => ', ', 'show_link' => true, 'link_style' => ''];

        return app(View::class)->render(Path::get('../../templates/tags'), compact('article', 'tags', 'args'));
    }

    public function metaString($article, array $args)
    {
        $args += ['format' => 'list', 'separator' => '|', 'link_style' => '', 'show_publish_date' => true, 'show_author' => true, 'show_category' => true];

        return app(View::class)->render(Path::get('../../templates/meta'), compact('article', 'args'));
    }
}
