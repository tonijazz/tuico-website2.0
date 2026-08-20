<?php

namespace App\Enums;

enum NewsType: string implements \Filament\Support\Contracts\HasLabel
{
    case Update = 'update';
    case PressRelease = 'press_release';
    case Blog = 'blog';

    public function getLabel(): string
    {
        return match ($this) {
            self::Update => 'Update',
            self::PressRelease => 'Press Release',
            self::Blog => 'Blog / Opinion',
        };
    }
}
