<?php

namespace YOOtheme;

use Joomla\CMS\Pagination\PaginationObject;

return [

    'transforms' => [

        'render' => function ($node, $params) {

            if (!isset($params['pagination'])) {

                $article = isset($params['item'])
                    ? $params['item']
                    : (
                        isset($params['article'])
                            ? $params['article']
                            : false
                    );

                if (!$article) {
                    return false;
                }

                if (!isset($article->pagination)) {

                    $p = clone $article->params;
                    $p->set('show_item_navigation', true);

                    jimport('plugins.content.pagenavigation', JPATH_ROOT);
                    $dispatcher = \JEventDispatcher::getInstance();
                    $plugin = new \PlgContentPagenavigation($dispatcher, ['params' => ['display' => 0]]);
                    $plugin->onContentBeforeDisplay('com_content.article', $article, $p, 0);
                }

                if (isset($article->pagination)) {
                    $list = [
                        'previous' => [
                            'active' => (bool) $article->prev,
                            'data' => new PaginationObject($article->prev_label, '', null, $article->prev, true),
                        ],
                        'next' => [
                            'active' => (bool) $article->next,
                            'data' => new PaginationObject($article->next_label, '', null, $article->next, true),
                        ],
                    ];
                } else {
                    return false;
                }

                $node->props['pagination_type'] = 'previous/next';

            } else {

                if ($params['pagination']->pagesTotal < 2) {
                    return false;
                }

                $list = $params['pagination']->getPaginationPages();

            }

            $list['all']['active'] = false;
            if (!$node->props['pagination_start_end']) {
                $list['start']['active'] = false;
                $list['end']['active'] = false;
            }

            $pages = [];
            foreach ($list as $key => $page) {
                if ($key === 'pages') {

                    $range = 3;
                    $currentId = 0;

                    foreach ($list['pages'] as $id => $p) {
                        if (!$p['active']) {
                            $currentId = $id;
                        }
                    }

                    $pages = array_merge($pages, array_slice($list['pages'], max(0, $currentId - $range), $range * 2 + 1));
                } elseif ($page['active']) {
                    $pages[$key] = $page;
                }
            }

            $node->props['pagination'] = array_map(function ($page) { return $page['data']; }, $pages);

        },

    ],

];
