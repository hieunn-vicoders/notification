<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['prefix' => config('webpress-notification.namespace')], function ($api) {
        $api->get("notification-setting", "VCComponent\Laravel\Notification\Http\Controllers\Api\Frontend\NotificationSettingController@getSetting");
        $api->put("notification-setting/sync", "VCComponent\Laravel\Notification\Http\Controllers\Api\Frontend\NotificationSettingController@syncSetting");

        $api->group(['prefix' => 'admin'], function ($api) {            
            $api->resource("notifications", "VCComponent\Laravel\Notification\Http\Controllers\Api\Admin\NotificationController");
            $api->resource("template-variables", "VCComponent\Laravel\Notification\Http\Controllers\Api\Admin\TemplateVariableController");
        });
    });
});
