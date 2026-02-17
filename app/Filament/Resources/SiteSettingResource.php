<?php

namespace App\Filament\Resources;

use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('site_name')->required(),
            Forms\Components\Textarea::make('hero_headline')->required(),
            Forms\Components\Toggle::make('effects_enabled'),
            Forms\Components\TextInput::make('effects_intensity')->numeric()->minValue(0)->maxValue(100),
            Forms\Components\Toggle::make('robots_index'),
            Forms\Components\Toggle::make('robots_follow'),
            Forms\Components\KeyValue::make('social_links'),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('site_name'),
            Tables\Columns\IconColumn::make('effects_enabled')->boolean(),
        ]);
    }
}
