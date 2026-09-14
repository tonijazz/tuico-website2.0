<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {

    $this->migrator->add('site.vision', 'To have a strong and Democratic Trade Union that provides high quality of services to its members.');
    $this->migrator->add('site.mission', 'To provide high-quality services that meet the needs of our members.');
    $this->migrator->add('site.logo', null);
    $this->migrator->add('site.facebook_url', null);
    $this->migrator->add('site.instagram_url', null);
    $this->migrator->add('site.tiktok_url', null);
    $this->migrator->add('site.linkedin_url', null);
    $this->migrator->add('site.youtube_url', null);
    $this->migrator->add('site.po_box', '5680, Dar es Salaam');
    $this->migrator->add('site.phone', '+255 (0) 222 866 910/960');
    $this->migrator->add('site.email', 'info@tuico.or.tz');
    $this->migrator->add('site.fax', '+255 (0) 222 866 911');
    $this->migrator->add('site.street_address', 'Sharif Shamba Street, Ilala District, Dar es Salaam');


    }
};
