<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['prefix' => config('webpress-notification.namespace')], function ($api) {
        $api->get("notification-setting/configable", "VCComponent\Laravel\Notification\Http\Controllers\Api\Frontend\NotificationSettingController@getConfigableNotification");
        $api->get("notification-setting", "VCComponent\Laravel\Notification\Http\Controllers\Api\Frontend\NotificationSettingController@getSetting");
        $api->put("notification-setting/sync", "VCComponent\Laravel\Notification\Http\Controllers\Api\Frontend\NotificationSettingController@syncSetting");

        $api->group(['prefix' => 'admin'], function ($api) {
            $api->get("notification-setting/role/{role_id}", "VCComponent\Laravel\Notification\Http\Controllers\Api\Admin\NotificationSettingController@getSetting");
            $api->put("notification-setting/sync", "VCComponent\Laravel\Notification\Http\Controllers\Api\Admin\NotificationSettingController@syncSetting");
            
            $api->resource("notifications", "VCComponent\Laravel\Notification\Http\Controllers\Api\Admin\NotificationController");
            $api->resource("template-variants", "VCComponent\Laravel\Notification\Http\Controllers\Api\Admin\TemplateVariantController");
        });
    });
});
