<?php
/*
This file is part of iCE Hrm.

iCE Hrm is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

iCE Hrm is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with iCE Hrm. If not, see <http://www.gnu.org/licenses/>.

------------------------------------------------------------------

Original work Copyright (c) 2012 [Gamonoid Media Pvt. Ltd]
Developer: Thilina Hasantha (thilina.hasantha[at]gmail.com / facebook.com/thilinah)
 */

$moduleName = 'travel';
define('MODULE_PATH',dirname(__FILE__));
include APP_BASE_PATH.'header.php';
include APP_BASE_PATH.'modulejslibs.inc.php';

$customFields = \Classes\BaseService::getInstance()->getCustomFields("EmployeeTravelRecord");

$travelRequestOptions = [];
$travelRequestOptions['setRemoteTable'] = 'true';
$travelRequestOptions['setCustomFields'] = json_encode($customFields);



$moduleBuilder = new \Classes\ModuleBuilder\ModuleBuilder();

$moduleBuilder->addModuleOrGroup(new \Classes\ModuleBuilder\ModuleTab(
	'EmployeeTravelRecord',
	'EmployeeTravelRecord',
	'Travel Requests',
	'EmployeeTravelRecordAdminAdapter',
	'',
	'',
	true,
    $travelRequestOptions
));

if ($user->user_level === 'Admin') {
    $travelCustomFieldOptions = [];
    $travelCustomFieldOptions['setRemoteTable'] = 'true';
    $travelCustomFieldOptions['setTableType'] = '\'EmployeeTravelRecord\'';

    $moduleBuilder->addModuleOrGroup(new \Classes\ModuleBuilder\ModuleTab(
        'TravelCustomField',
        'CustomField',
        'Custom Fields',
        'CustomFieldAdapter',
        '{"type":"EmployeeTravelRecord"}',
        '',
        false,
        $travelCustomFieldOptions
    ));
}

echo \Classes\UIManager::getInstance()->renderModule($moduleBuilder);


$itemName = 'TravelRequest';
$moduleName = 'Travel Management';
$itemNameLower = strtolower($itemName);

include APP_BASE_PATH.'footer.php';
