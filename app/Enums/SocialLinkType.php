<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum SocialLinkType: string implements HasLabel
{
    case Instagram = 'Instagram';
    case Facebook = 'Facebook';
    case X = 'X';
    case Linkedin = 'Linkedin';
    case Github = 'Github';
    case Tiktok = 'Tiktok';
    case WeChat = 'WeChat';
    case Site = 'Site';
    case Outro = 'Outro';

    public function getLabel(): string|Htmlable|null
    {
        return $this->name;
    }
}
