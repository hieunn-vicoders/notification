<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_settings', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('notification_id');
            $table->unsignedBigInteger('notificationable_id');
            $table->tinyInteger('email_enable');
            $table->tinyInteger('mobile_enable');
            $table->tinyInteger('web_enable');
            $table->string('notificationable_type');

            $table->foreign('notification_id')->references('id')->on('notifications');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification_settings');
    }
}
