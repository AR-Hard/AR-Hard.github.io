<?php

namespace YOOtheme\Builder\Joomla\Source\Type;

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\PluginHelper;
use YOOtheme\Builder\Source;

class ArticleEventType
{
    /**
     * @param Source $source
     *
     * @return array
     */
    public function __invoke(Source $source)
    {
        $fields = [

            'afterDisplayTitle' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'After Display Title',
                ],
            ],

            'beforeDisplayContent' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'Before Display Content',
                ],
            ],

            'afterDisplayContent' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'After Display Content',
                ],
            ],

        ];

        $resolvers = $source->mapResolvers($this, [
            'afterDisplayTitle' => 'resolve',
            'beforeDisplayContent' => 'resolve',
            'afterDisplayContent' => 'resolve',
        ]);

        $metadata = [
            'label' => 'Events',
        ];

        return compact('fields', 'resolvers', 'metadata');
    }

    public function resolve($article, $args, $context, $info)
    {
        $key = $info->fieldName;

        if (isset($article->event->$key)) {
            return $article->event->$key;
        }

        $marker = "<!-- article_{$article->id}_{$key} -->";

        \JEventDispatcher::getInstance()->register('onBeforeRender', function () use ($article, $key, $marker) {
            $document = Factory::getDocument();

            if (!isset($article->event->$key)) {
                $this->applyContentPlugins($article);
            }

            $document->setBuffer(str_replace($marker, $article->event->$key, $document->getBuffer('component')), 'component');
        });

        return $marker;
    }

    protected function applyContentPlugins($item)
    {
        $dispatcher = \JEventDispatcher::getInstance();

        // Process the content plugins.
        PluginHelper::importPlugin('content');

        $item->event = new \stdClass();

        $results = $dispatcher->trigger('onContentAfterTitle', ['com_content.article', &$item, &$item->params]);
        $item->event->afterDisplayTitle = trim(implode("\n", $results));

        $results = $dispatcher->trigger('onContentBeforeDisplay', ['com_content.article', &$item, &$item->params]);
        $item->event->beforeDisplayContent = trim(implode("\n", $results));

        $results = $dispatcher->trigger('onContentAfterDisplay', ['com_content.article', &$item, &$item->params]);
        $item->event->afterDisplayContent = trim(implode("\n", $results));
    }
}
