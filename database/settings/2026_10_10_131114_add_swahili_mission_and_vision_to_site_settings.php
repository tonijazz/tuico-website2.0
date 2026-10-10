<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add(
            'site.vision_sw',
            'Kuwa Chama cha Wafanyakazi imara na cha kidemokrasia kinachotoa huduma bora kwa wanachama wake.'
        );

        $this->migrator->add(
            'site.mission_sw',
            'Kutoa huduma bora zinazokidhi mahitaji ya wanachama wetu.'
        );
    }
};
