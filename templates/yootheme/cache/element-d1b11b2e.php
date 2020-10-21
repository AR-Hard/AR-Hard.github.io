<?php // $file = /var/www/html/joomla/templates/yootheme/vendor/yootheme/builder/elements/alert/element.json

return [
  '@import' => $filter->apply('path', './element.php', $file), 
  'name' => 'alert', 
  'title' => 'Alert', 
  'group' => 'basic', 
  'icon' => $filter->apply('url', 'images/icon.svg', $file), 
  'iconSmall' => $filter->apply('url', 'images/iconSmall.svg', $file), 
  'element' => true, 
  'width' => 500, 
  'placeholder' => [
    'props' => [
      'title' => '', 
      'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
    ]
  ], 
  'templates' => [
    'render' => $filter->apply('path', './templates/template.php', $file), 
    'content' => $filter->apply('path', './templates/content.php', $file)
  ], 
  'fields' => [
    'title' => [
      'label' => 'Title', 
      'source' => true
    ], 
    'content' => [
      'label' => 'Content', 
      'type' => 'editor', 
      'source' => true
    ], 
    'alert_style' => [
      'label' => 'Style', 
      'type' => 'select', 
      'default' => '', 
      'options' => [
        'Default' => '', 
        'Primary' => 'primary', 
        'Success' => 'success', 
        'Warning' => 'warning', 
        'Danger' => 'danger'
      ]
    ], 
    'alert_size' => [
      'type' => 'checkbox', 
      'text' => 'Larger padding'
    ], 
    'position' => $config->get('builder.position'), 
    'position_left' => $config->get('builder.position_left'), 
    'position_right' => $config->get('builder.position_right'), 
    'position_top' => $config->get('builder.position_top'), 
    'position_bottom' => $config->get('builder.position_bottom'), 
    'position_z_index' => $config->get('builder.position_z_index'), 
    'margin' => $config->get('builder.margin'), 
    'margin_remove_top' => $config->get('builder.margin_remove_top'), 
    'margin_remove_bottom' => $config->get('builder.margin_remove_bottom'), 
    'maxwidth' => $config->get('builder.maxwidth'), 
    'maxwidth_breakpoint' => $config->get('builder.maxwidth_breakpoint'), 
    'block_align' => $config->get('builder.block_align'), 
    'block_align_breakpoint' => $config->get('builder.block_align_breakpoint'), 
    'block_align_fallback' => $config->get('builder.block_align_fallback'), 
    'animation' => $config->get('builder.animation'), 
    '_parallax_button' => $config->get('builder._parallax_button'), 
    'visibility' => $config->get('builder.visibility'), 
    'name' => $config->get('builder.name'), 
    'status' => $config->get('builder.status'), 
    'source' => $config->get('builder.source'), 
    'id' => $config->get('builder.id'), 
    'class' => $config->get('builder.cls'), 
    'css' => [
      'label' => 'CSS', 
      'description' => 'Enter your own custom CSS. The following selectors will be prefixed automatically for this element: <code>.el-element</code>, <code>.el-title</code>, <code>.el-content</code>', 
      'type' => 'editor', 
      'editor' => 'code', 
      'mode' => 'css', 
      'attrs' => [
        'debounce' => 500
      ]
    ]
  ], 
  'fieldset' => [
    'default' => [
      'type' => 'tabs', 
      'fields' => [[
          'title' => 'Content', 
          'fields' => ['title', 'content']
        ], [
          'title' => 'Settings', 
          'fields' => [[
              'label' => 'Alert', 
              'type' => 'group', 
              'divider' => true, 
              'fields' => ['alert_style', 'alert_size']
            ], [
              'label' => 'General', 
              'type' => 'group', 
              'fields' => ['position', 'position_left', 'position_right', 'position_top', 'position_bottom', 'position_z_index', 'margin', 'margin_remove_top', 'margin_remove_bottom', 'maxwidth', 'maxwidth_breakpoint', 'block_align', 'block_align_breakpoint', 'block_align_fallback', 'animation', '_parallax_button', 'visibility']
            ]]
        ], $config->get('builder.advanced')]
    ]
  ]
];
