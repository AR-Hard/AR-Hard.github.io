<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

use Joomla\Utilities\ArrayHelper;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;

extract($displayData);
/**
 * Layout variables
 * -----------------
 * @var   string   $autocomplete    Autocomplete attribute for the field.
 * @var   boolean  $autofocus       Is autofocus enabled?
 * @var   string   $class           Classes for the input.
 * @var   string   $description     Description of the field.
 * @var   boolean  $disabled        Is this field disabled?
 * @var   string   $group           Group the field belongs to. <fields> section in form XML.
 * @var   boolean  $hidden          Is this field hidden in the form?
 * @var   string   $hint            Placeholder for the field.
 * @var   string   $id              DOM id of the field.
 * @var   string   $label           Label of the field.
 * @var   string   $labelclass      Classes to apply to the label.
 * @var   boolean  $multiple        Does this field support multiple values?
 * @var   string   $name            Name of the input field.
 * @var   string   $onchange        Onchange attribute for the field.
 * @var   string   $onclick         Onclick attribute for the field.
 * @var   string   $pattern         Pattern (Reg Ex) of value of the form field.
 * @var   boolean  $readonly        Is this field read only?
 * @var   boolean  $repeat          Allows extensions to duplicate elements.
 * @var   boolean  $required        Is this field required?
 * @var   integer  $size            Size attribute of the input.
 * @var   boolean  $spellcheck      Spellcheck state for the form field.
 * @var   string   $validate        Validation rules to apply.
 * @var   string   $value           Value attribute of the field.
 * @var   string   $userName        The user name
 * @var   mixed    $groups          The filtering groups (null means no filtering)
 * @var   mixed    $excluded        The users to exclude from the list of users
 */

if (!$readonly) {
    HTMLHelper::_('behavior.modal', 'a.modal_' . $id);
    HTMLHelper::_('script', 'jui/fielduser.min.js', array('version' => 'auto', 'relative' => true));
}

$uri = new Uri('index.php?option=com_users&view=users&layout=modal&tmpl=component&required=0');

$uri->setVar('field', $this->escape($id));

if ($required) {
    $uri->setVar('required', 1);
}

if (!empty($groups)) {
    $uri->setVar('groups', base64_encode(json_encode($groups)));
}

if (!empty($excluded)) {
    $uri->setVar('excluded', base64_encode(json_encode($excluded)));
}

// Invalidate the input value if no user selected
if ($this->escape($userName) === Text::_('JLIB_FORM_SELECT_USER')) {
    $userName = '';
}

$inputAttributes = ['type' => 'text', 'id' => $id, 'value' => $this->escape($userName), 'class' => 'uk-input'];

if ($size) {
    $inputAttributes['size'] = (int)$size;
}

if ($required) {
    $inputAttributes['required'] = 'required';
}

if (!$readonly) {
    $inputAttributes['placeholder'] = Text::_('JLIB_FORM_SELECT_USER');
}

$anchorAttributes = ['class' => 'uk-button uk-button-primary modal_' . $id, 'title' => Text::_('JLIB_FORM_CHANGE_USER'), 'rel' => '{handler: \'iframe\', size: {x: 800, y: 500}}'];

?>
<div class="uk-button-group uk-width">
    <input <?php echo ArrayHelper::toString($inputAttributes); ?> readonly />
    <?php
    if (!$readonly) {
        echo HTMLHelper::_('link', (string)$uri, '<span data-uk-icon="icon:user"></span>', $anchorAttributes);
    }
    ?>
</div>
<?php if (!$readonly) { ?>
    <input type="hidden" id="<?php echo $id; ?>_id" name="<?php echo $name; ?>" value="<?php echo (int)$value; ?>" data-onchange="<?php echo $this->escape($onchange); ?>" />
<?php }