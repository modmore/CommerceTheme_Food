<?php
/* Get the core config */
if (!file_exists(dirname(dirname(__FILE__)).'/config.core.php')) {
    die('ERROR: missing '.dirname(dirname(__FILE__)).'/config.core.php file defining the MODX core path.');
}

/* Boot up MODX */
echo "Loading modX...\n";
require_once dirname(dirname(__FILE__)) . '/config.core.php';
require_once MODX_CORE_PATH . 'model/modx/modx.class.php';
$modx = new modX();
echo "Initializing manager...\n";
$modx->initialize('mgr');
$modx->getService('error','error.modError', '', '');
$modx->setLogTarget('HTML');

$componentPath = dirname(dirname(__FILE__));

/** @var Commerce $commerce */
//$modx->setOption('commerce.core_path', $componentPath.'/core/components/commerce/');
//$commerce = $modx->getService('commerce','Commerce', $componentPath.'/core/components/commerce/model/commerce/');


$elements = [
    'modTemplate' => [
        'Food - Home' => $componentPath . '/core/components/commercetheme_food/elements/templates/home.tpl',
        'Food - Cart' => $componentPath . '/core/components/commercetheme_food/elements/templates/cart.tpl',
        'Food - Group' => $componentPath . '/core/components/commercetheme_food/elements/templates/group.tpl',
//        'Food - Checkout' => $componentPath . '/core/components/commercetheme_food/elements/templates/checkout.tpl',
//        'Food - Product' => $componentPath . '/core/components/commercetheme_food/elements/templates/product.tpl',
//        'Food - Account' => $componentPath . '/core/components/commercetheme_food/elements/templates/account.tpl',
//        'Food - Account login' => $componentPath . '/core/components/commercetheme_food/elements/templates/account_login.tpl',
//        'Food - Account register' => $componentPath . '/core/components/commercetheme_food/elements/templates/account_register.tpl',
//        'Food - Account activate registration' => $componentPath . '/core/components/commercetheme_food/elements/templates/account_activate_registration.tpl',
//        'Food - Account thank you registration' => $componentPath . '/core/components/commercetheme_food/elements/templates/account_thank_you_registration.tpl',
//        'Food - Account forgot password' => $componentPath . '/core/components/commercetheme_food/elements/templates/account_password.tpl',
//        'Food - Account Order' => $componentPath . '/core/components/commercetheme_food/elements/templates/account_order.tpl',
//        'Food - Account Orders' => $componentPath . '/core/components/commercetheme_food/elements/templates/account_orders.tpl',
//        'Food - Account Edit profile' => $componentPath . '/core/components/commercetheme_food/elements/templates/account_edit_pofile.tpl',
    ],

    'modChunk' => [
        'ctfood.list_groups' => $componentPath . '/core/components/commercetheme_food/elements/chunks/list_groups.tpl',
        'ctfood.list_product' => $componentPath . '/core/components/commercetheme_food/elements/chunks/list_product.tpl',
//        'ctfood.category_list_home_outer_chunk' => $componentPath . '/core/components/commercetheme_food/elements/chunks/category_list_home_outer_chunk.tpl',
//        'ctfood.category_list_home_chunk' => $componentPath . '/core/components/commercetheme_food/elements/chunks/category_list_home_chunk.tpl',
//        'ctfood.category_list_chunk' => $componentPath . '/core/components/commercetheme_food/elements/chunks/category_list_chunk.tpl',
//        'ctfood.category_list_outer_chunk' => $componentPath . '/core/components/commercetheme_food/elements/chunks/category_list_outer_chunk.tpl',
//        'ctfood.related_list' => $componentPath . '/core/components/commercetheme_food/elements/chunks/related_list.tpl',
//        'ctfood.related_outer' => $componentPath . '/core/components/commercetheme_food/elements/chunks/related_outer.tpl',
//        'ctfood.related_outer_list' => $componentPath . '/core/components/commercetheme_food/elements/chunks/related_outer_list.tpl',
//        'ctfood.login_form' => $componentPath . '/core/components/commercetheme_food/elements/chunks/login_form.tpl',
//        'ctfood.logout_form' => $componentPath . '/core/components/commercetheme_food/elements/chunks/logout_form.tpl',
//        'ctfood.forgot_pass' => $componentPath . '/core/components/commercetheme_food/elements/chunks/forgot_pass.tpl',
//        'ctfood.account_form' => $componentPath . '/core/components/commercetheme_food/elements/chunks/account_form.tpl',
//        'ctfood.register_form' => $componentPath . '/core/components/commercetheme_food/elements/chunks/register_form.tpl',
//        'ctfood.register_email' => $componentPath . '/core/components/commercetheme_food/elements/chunks/register_email.tpl',
//        'ctfood.update_profile_form' => $componentPath . '/core/components/commercetheme_food/elements/chunks/update_profile_form.tpl',
//        'ctfood.profile_details' => $componentPath . '/core/components/commercetheme_food/elements/chunks/profile_details.tpl',
//        'ctfood.login_chunk' => $componentPath . '/core/components/commercetheme_food/elements/chunks/login_chunk.tpl',
//        'ctfood.tag_list_chunk' => $componentPath . '/core/components/commercetheme_food/elements/chunks/tag_list_chunk.tpl',
//        'ctfood.tag_outer_chunk' => $componentPath . '/core/components/commercetheme_food/elements/chunks/tag_outer_chunk.tpl',
//        'ctfood.profile_menu' => $componentPath . '/core/components/commercetheme_food/elements/chunks/profile_menu.tpl',
        'ctfood.footer' => $componentPath . '/core/components/commercetheme_food/elements/chunks/footer.tpl',
        'ctfood.header' => $componentPath . '/core/components/commercetheme_food/elements/chunks/header.tpl',
    ],
];

if (!createObject('modCategory', [
    'category' => 'CTFood'
], 'category', true)) {
    echo "Error creating category; halting.\n";
    exit(1);
}

$category = $modx->getObject('modCategory', ['category' => 'CTFood']);
$categoryId = $category ? $category->get('id') : 0;

foreach ($elements as $type => $records) {
    $nameFld = $type === 'modTemplate' ? 'templatename' : 'name';
    foreach ($records as $name => $file) {
        if (!createObject($type, [
            $nameFld => $name,
            'static' => true,
            'static_file' => $file,
            'category' => $categoryId,
        ],$nameFld, true)) {
            echo "Error creating {$type} {$name}.\n";
        }
    }
}
//ctfood.assets_url
if (!createObject('modSystemSetting', [
    'key' => 'ctfood.assets_url',
    'value' => '/assets/components/commercetheme_food/'
], 'key', false)) {
    echo "Error creating ctfood.assets_url system setting.\n";
}

////ctfood.account_page_id
//if (!createObject('modSystemSetting', [
//    'key' => 'ctfood.account_page_id',
//    'value' => ''
//], 'key', false)) {
//    echo "Error creating ctfood.account_page_id system setting.\n";
//}
//
////ctfood.edit_profile_page_id
//if (!createObject('modSystemSetting', [
//    'key' => 'ctfood.edit_profile_page_id',
//    'value' => ''
//], 'key', false)) {
//    echo "Error creating ctfood.edit_profile_page_id system setting.\n";
//}
//
////ctfood.password_reset_page_id
//if (!createObject('modSystemSetting', [
//    'key' => 'ctfood.password_reset_page_id',
//    'value' => ''
//], 'key', false)) {
//    echo "Error creating ctfood.password_reset_page_id system setting.\n";
//}
//
////ctfood.registration_please_activate_page_id
//if (!createObject('modSystemSetting', [
//    'key' => 'ctfood.registration_please_activate_page_id',
//    'value' => ''
//], 'key', false)) {
//    echo "Error creating ctfood.registration_please_activate_page_id system setting.\n";
//}
//
////ctfood.registration_activation_page_id
//if (!createObject('modSystemSetting', [
//    'key' => 'ctfood.registration_activation_page_id',
//    'value' => ''
//], 'key', false)) {
//    echo "Error creating ctfood.registration_activation_page_id system setting.\n";
//}
//
////ctfood.registration_thank_you_page_id
//if (!createObject('modSystemSetting', [
//    'key' => 'ctfood.registration_thank_you_page_id',
//    'value' => ''
//], 'key', false)) {
//    echo "Error creating ctfood.registration_thank_you_page_id system setting.\n";
//}
//
////ctfood.you_are_logout_page_id
//if (!createObject('modSystemSetting', [
//    'key' => 'ctfood.you_are_logout_page_id',
//    'value' => ''
//], 'key', false)) {
//    echo "Error creating ctfood.you_are_logout_page_id system setting.\n";
//}
//
////ctfood.edit_profile_page_id
//if (!createObject('modSystemSetting', [
//    'key' => 'ctfood.edit_profile_page_id',
//    'value' => ''
//], 'key', false)) {
//    echo "Error creating ctfood.edit_profile_page_id system setting.\n";
//}
//
////ctfood.account_page_id
//if (!createObject('modSystemSetting', [
//    'key' => 'ctfood.account_page_id',
//    'value' => ''
//], 'key', false)) {
//    echo "Error creating ctfood.account_page_id system setting.\n";
//}
////ctfood.forgot_password_page_id
//if (!createObject('modSystemSetting', [
//    'key' => 'ctfood.forgot_password_page_id',
//    'value' => ''
//], 'key', false)) {
//    echo "Error creating ctfood.forgot_password_page_id system setting.\n";
//}
//
////ctfood.footer_header_one
//if (!createObject('modSystemSetting', [
//    'key' => 'ctfood.footer_header_one',
//    'value' => 'Pages'
//], 'key', false)) {
//    echo "Error creating ctfood.footer_header_one system setting.\n";
//}
//
////ctfood.footer_header_two
//if (!createObject('modSystemSetting', [
//    'key' => 'ctfood.footer_header_two',
//    'value' => 'Quick links'
//], 'key', false)) {
//    echo "Error creating ctfood.footer_header_two system setting.\n";
//}
//
////ctfood.footer_content
//if (!createObject('modSystemSetting', [
//    'key' => 'ctfood.footer_content',
//    'value' => '<p>Theme #1 for Commerce, dubbed "Food" even though its accent color is food. Bootstrap based.</p>'
//], 'key', false)) {
//    echo "Error creating ctfood.footer_content system setting.\n";
//}
//
////ctfood.footer_bottom_row_content
//if (!createObject('modSystemSetting', [
//    'key' => 'ctfood.footer_bottom_row_content',
//    'value' => '<p>Powered by <a href="https://modmore.com/commerce/" target="_blank" rel="noopener">Commerce</a>.</p><p>&copy; All rights reserved.</p>'
//], 'key', false)) {
//    echo "Error creating ctfood.footer_bottom_row_content system setting.\n";
//}
//
////ctfood.quick_link_01_text
//if (!createObject('modSystemSetting', [
//    'key' => 'ctfood.quick_link_01_text',
//    'value' => 'Account'
//], 'key', false)) {
//    echo "Error creating ctfood.quick_link_01_text system setting.\n";
//}
//
////ctfood.quick_link_01_url
//if (!createObject('modSystemSetting', [
//    'key' => 'ctfood.quick_link_01_url',
//    'value' => '[[~[[++ctfood.account_page_id]]]]'
//], 'key', false)) {
//    echo "Error creating ctfood.quick_link_01_url system setting.\n";
//}
//
////ctfood.quick_link_02_text
//if (!createObject('modSystemSetting', [
//    'key' => 'ctfood.quick_link_02_text',
//    'value' => 'Profile'
//], 'key', false)) {
//    echo "Error creating ctfood.quick_link_02_text system setting.\n";
//}
//
////ctfood.quick_link_02_url
//if (!createObject('modSystemSetting', [
//    'key' => 'ctfood.quick_link_02_url',
//    'value' => '[[~[[++ctfood.edit_profile_page_id]]]]'
//], 'key', false)) {
//    echo "Error creating ctfood.quick_link_02_url system setting.\n";
//}
//
////ctfood.quick_link_03_text
//if (!createObject('modSystemSetting', [
//    'key' => 'ctfood.quick_link_03_text',
//    'value' => ''
//], 'key', false)) {
//    echo "Error creating ctfood.quick_link_03_text system setting.\n";
//}
//
////ctfood.quick_link_03_url
//if (!createObject('modSystemSetting', [
//    'key' => 'ctfood.quick_link_03_url',
//    'value' => ''
//], 'key', false)) {
//    echo "Error creating ctfood.quick_link_03_url system setting.\n";
//}
//
////ctfood.quick_link_04_text
//if (!createObject('modSystemSetting', [
//    'key' => 'ctfood.quick_link_04_text',
//    'value' => ''
//], 'key', false)) {
//    echo "Error creating ctfood.quick_link_04_text system setting.\n";
//}
//
////ctfood.quick_link_04_url
//if (!createObject('modSystemSetting', [
//    'key' => 'ctfood.quick_link_04_url',
//    'value' => ''
//], 'key', false)) {
//    echo "Error creating ctfood.quick_link_04_url system setting.\n";
//}
//
////ctfood.quick_link_05_text
//if (!createObject('modSystemSetting', [
//    'key' => 'ctfood.quick_link_05_text',
//    'value' => ''
//], 'key', false)) {
//    echo "Error creating ctfood.quick_link_05_text system setting.\n";
//}
//
////ctfood.quick_link_05_url
//if (!createObject('modSystemSetting', [
//    'key' => 'ctfood.quick_link_05_url',
//    'value' => ''
//], 'key', false)) {
//    echo "Error creating ctfood.quick_link_05_url system setting.\n";
//}
//
////ctfood.quick_link_06_text
//if (!createObject('modSystemSetting', [
//    'key' => 'ctfood.quick_link_06_text',
//    'value' => ''
//], 'key', false)) {
//    echo "Error creating ctfood.quick_link_06_text system setting.\n";
//}
//
////ctfood.quick_link_06_url
//if (!createObject('modSystemSetting', [
//    'key' => 'ctfood.quick_link_06_url',
//    'value' => ''
//], 'key', false)) {
//    echo "Error creating ctfood.quick_link_06_url system setting.\n";
//}
//
//if (!createObject('modTemplateVar', [
//    'type' => 'commerce_matrix',
//    'name' => 'product_matrix',
//    'caption' => 'Products',
//], 'name', false)) {
//    echo "Error creating modTemplateVar system setting.\n";
//}
//
//if (!createObject('modTemplateVar', [
//    'type' => 'richtext',
//    'name' => 'ctfood.hero_content',
//    'caption' => 'Hero content',
//], 'name', false)) {
//    echo "Error creating modTemplateVar system setting.\n";
//}
//
//if (!createObject('modTemplateVar', [
//    'type' => 'textfield',
//    'name' => 'ctfood_featufood_product',
//    'caption' => 'Featufood product',
//    'description' => 'Make this product a featufood product.',
//], 'name', false)) {
//    echo "Error creating modTemplateVar system setting.\n";
//}
//
//if (!createObject('modTemplateVar', [
//    'type' => 'image',
//    'name' => 'ctfood.hero_image',
//    'caption' => 'Hero background image',
//], 'name', false)) {
//    echo "Error creating modTemplateVar system setting.\n";
//}
//
//if (!createObject('modTemplateVar', [
//    'type' => 'image',
//    'name' => 'ctfood_category_image',
//    'caption' => 'Category image',
//    'description' => 'The image to display for this category.',
//], 'name', false)) {
//    echo "Error creating modTemplateVar system setting.\n";
//}
//
//if (!createObject('modTemplateVar', [
//    'type' => 'textfield',
//    'name' => 'ctfood.product_tab_show',
//    'caption' => 'Show tab section',
//    'description' => 'Enter true to show the tabs.',
//], 'name', false)) {
//    echo "Error creating modTemplateVar system setting.\n";
//}
//
//if (!createObject('modTemplateVar', [
//    'type' => 'richtext',
//    'name' => 'ctfood.product_tab_1_content',
//    'caption' => 'Tab 1 content',
//], 'name', false)) {
//    echo "Error creating modTemplateVar system setting.\n";
//}
//
//if (!createObject('modTemplateVar', [
//    'type' => 'textfield',
//    'name' => 'ctfood.product_tab_1_title',
//    'caption' => 'Tab 1 title',
//    'description' => 'Leave blank to not show the tab.',
//], 'name', false)) {
//    echo "Error creating modTemplateVar system setting.\n";
//}
//
//if (!createObject('modTemplateVar', [
//    'type' => 'richtext',
//    'name' => 'ctfood.product_tab_2_content',
//    'caption' => 'Tab 2 content',
//], 'name', false)) {
//    echo "Error creating modTemplateVar system setting.\n";
//}
//
//if (!createObject('modTemplateVar', [
//    'type' => 'textfield',
//    'name' => 'ctfood.product_tab_2_title',
//    'caption' => 'Tab 2 title',
//    'description' => 'Leave blank to not show the tab.',
//], 'name', false)) {
//    echo "Error creating modTemplateVar system setting.\n";
//}
//
//if (!createObject('modTemplateVar', [
//    'type' => 'richtext',
//    'name' => 'ctfood.product_tab_3_content',
//    'caption' => 'Tab 3 content',
//], 'name', false)) {
//    echo "Error creating modTemplateVar system setting.\n";
//}
//
//if (!createObject('modTemplateVar', [
//    'type' => 'textfield',
//    'name' => 'ctfood.product_tab_3_title',
//    'caption' => 'Tab 3 title',
//    'description' => 'Leave blank to not show the tab.',
//], 'name', false)) {
//    echo "Error creating modTemplateVar system setting.\n";
//}
//
//$tv = $modx->getObject('modTemplateVar', ['name' => 'product_matrix']);
//$tvId = $tv ? $tv->get('id') : 0;
//$tmpl = $modx->getObject('modTemplate', ['templatename' => 'Food - Product']);
//$tmplId = $tmpl ? $tmpl->get('id') : 0;
//if (!createObject('modTemplateVarTemplate', [
//    'tmplvarid' => $tvId,
//    'templateid' => $tmplId,
//], ['tmplvarid', 'templateid'], false)) {
//    echo "Error creating modTemplateVar system setting.\n";
//}
//
//$tv = $modx->getObject('modTemplateVar', ['name' => 'ctfood_featufood_product']);
//$tvId = $tv ? $tv->get('id') : 0;
//$tmpl = $modx->getObject('modTemplate', ['templatename' => 'Food - Product']);
//$tmplId = $tmpl ? $tmpl->get('id') : 0;
//if (!createObject('modTemplateVarTemplate', [
//    'tmplvarid' => $tvId,
//    'templateid' => $tmplId,
//], ['tmplvarid', 'templateid'], false)) {
//    echo "Error creating modTemplateVar system setting.\n";
//}
//
//$tv = $modx->getObject('modTemplateVar', ['name' => 'ctfood.hero_content']);
//$tvId = $tv ? $tv->get('id') : 0;
//$tmpl = $modx->getObject('modTemplate', ['templatename' => 'Food - Home']);
//$tmplId = $tmpl ? $tmpl->get('id') : 0;
//if (!createObject('modTemplateVarTemplate', [
//    'tmplvarid' => $tvId,
//    'templateid' => $tmplId,
//], ['tmplvarid', 'templateid'], false)) {
//    echo "Error creating modTemplateVar system setting.\n";
//}
//
//$tv = $modx->getObject('modTemplateVar', ['name' => 'ctfood.hero_image']);
//$tvId = $tv ? $tv->get('id') : 0;
//$tmpl = $modx->getObject('modTemplate', ['templatename' => 'Food - Home']);
//$tmplId = $tmpl ? $tmpl->get('id') : 0;
//if (!createObject('modTemplateVarTemplate', [
//    'tmplvarid' => $tvId,
//    'templateid' => $tmplId,
//], ['tmplvarid', 'templateid'], false)) {
//    echo "Error creating modTemplateVar system setting.\n";
//}
//
//$tv = $modx->getObject('modTemplateVar', ['name' => 'ctfood.product_tab_show']);
//$tvId = $tv ? $tv->get('id') : 0;
//$tmpl = $modx->getObject('modTemplate', ['templatename' => 'Food - Product']);
//$tmplId = $tmpl ? $tmpl->get('id') : 0;
//if (!createObject('modTemplateVarTemplate', [
//    'tmplvarid' => $tvId,
//    'templateid' => $tmplId,
//], ['tmplvarid', 'templateid'], false)) {
//    echo "Error creating modTemplateVar system setting.\n";
//}
//
//$tv = $modx->getObject('modTemplateVar', ['name' => 'ctfood.product_tab_1_title']);
//$tvId = $tv ? $tv->get('id') : 0;
//$tmpl = $modx->getObject('modTemplate', ['templatename' => 'Food - Product']);
//$tmplId = $tmpl ? $tmpl->get('id') : 0;
//if (!createObject('modTemplateVarTemplate', [
//    'tmplvarid' => $tvId,
//    'templateid' => $tmplId,
//], ['tmplvarid', 'templateid'], false)) {
//    echo "Error creating modTemplateVar system setting.\n";
//}
//
//$tv = $modx->getObject('modTemplateVar', ['name' => 'ctfood.product_tab_1_content']);
//$tvId = $tv ? $tv->get('id') : 0;
//$tmpl = $modx->getObject('modTemplate', ['templatename' => 'Food - Product']);
//$tmplId = $tmpl ? $tmpl->get('id') : 0;
//if (!createObject('modTemplateVarTemplate', [
//    'tmplvarid' => $tvId,
//    'templateid' => $tmplId,
//], ['tmplvarid', 'templateid'], false)) {
//    echo "Error creating modTemplateVar system setting.\n";
//}
//
//$tv = $modx->getObject('modTemplateVar', ['name' => 'ctfood.product_tab_2_title']);
//$tvId = $tv ? $tv->get('id') : 0;
//$tmpl = $modx->getObject('modTemplate', ['templatename' => 'Food - Product']);
//$tmplId = $tmpl ? $tmpl->get('id') : 0;
//if (!createObject('modTemplateVarTemplate', [
//    'tmplvarid' => $tvId,
//    'templateid' => $tmplId,
//], ['tmplvarid', 'templateid'], false)) {
//    echo "Error creating modTemplateVar system setting.\n";
//}
//
//$tv = $modx->getObject('modTemplateVar', ['name' => 'ctfood.product_tab_2_content']);
//$tvId = $tv ? $tv->get('id') : 0;
//$tmpl = $modx->getObject('modTemplate', ['templatename' => 'Food - Product']);
//$tmplId = $tmpl ? $tmpl->get('id') : 0;
//if (!createObject('modTemplateVarTemplate', [
//    'tmplvarid' => $tvId,
//    'templateid' => $tmplId,
//], ['tmplvarid', 'templateid'], false)) {
//    echo "Error creating modTemplateVar system setting.\n";
//}
//
//$tv = $modx->getObject('modTemplateVar', ['name' => 'ctfood.product_tab_3_title']);
//$tvId = $tv ? $tv->get('id') : 0;
//$tmpl = $modx->getObject('modTemplate', ['templatename' => 'Food - Product']);
//$tmplId = $tmpl ? $tmpl->get('id') : 0;
//if (!createObject('modTemplateVarTemplate', [
//    'tmplvarid' => $tvId,
//    'templateid' => $tmplId,
//], ['tmplvarid', 'templateid'], false)) {
//    echo "Error creating modTemplateVar system setting.\n";
//}
//
//$tv = $modx->getObject('modTemplateVar', ['name' => 'ctfood.product_tab_3_content']);
//$tvId = $tv ? $tv->get('id') : 0;
//$tmpl = $modx->getObject('modTemplate', ['templatename' => 'Food - Product']);
//$tmplId = $tmpl ? $tmpl->get('id') : 0;
//if (!createObject('modTemplateVarTemplate', [
//    'tmplvarid' => $tvId,
//    'templateid' => $tmplId,
//], ['tmplvarid', 'templateid'], false)) {
//    echo "Error creating modTemplateVar system setting.\n";
//}
//
//$tv = $modx->getObject('modTemplateVar', ['name' => 'ctfood_category_image']);
//$tvId = $tv ? $tv->get('id') : 0;
//$tmpl = $modx->getObject('modTemplate', ['templatename' => 'Food - Category']);
//$tmplId = $tmpl ? $tmpl->get('id') : 0;
//if (!createObject('modTemplateVarTemplate', [
//    'tmplvarid' => $tvId,
//    'templateid' => $tmplId,
//], ['tmplvarid', 'templateid'], false)) {
//    echo "Error creating modTemplateVar system setting.\n";
//}

// Clear the cache
$modx->cacheManager->refresh();

echo "Done.\n";


/**
 * Creates an object.
 *
 * @param string $className
 * @param array $data
 * @param string $primaryField
 * @param bool $update
 * @return bool
 */
function createObject ($className = '', array $data = array(), $primaryField = '', $update = true) {
    global $modx;
    /* @var xPDOObject $object */
    $object = null;

    /* Attempt to get the existing object */
    if (!empty($primaryField)) {
        if (is_array($primaryField)) {
            $condition = array();
            foreach ($primaryField as $key) {
                $condition[$key] = $data[$key];
            }
        }
        else {
            $condition = array($primaryField => $data[$primaryField]);
        }
        $object = $modx->getObject($className, $condition);
        if ($object instanceof $className) {
            if ($update) {
                $object->fromArray($data);
                return $object->save();
            } else {
                $condition = $modx->toJSON($condition);
                echo "Skipping {$className} {$condition}: already exists.\n";
                return true;
            }
        }
    }

    /* Create new object if it doesn't exist */
    if (!$object) {
        $object = $modx->newObject($className);
        $object->fromArray($data, '', true);
        return $object->save();
    }

    return false;
}
