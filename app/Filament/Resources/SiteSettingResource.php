<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages;
use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class SiteSettingResource extends Resource
{
    protected static $model = SiteSetting::class;

    public static function form(Form $form)
    {
        return $form->schema([
            Forms\Components\TextInput::make('site_name')->required(),
            Forms\Components\TextInput::make('primary_email')->email(),
            Forms\Components\Toggle::make('effects_enabled'),
            Forms\Components\TextInput::make('effects_intensity')->numeric()->minValue(0)->maxValue(100),
            Forms\Components\TextInput::make('canonical_base_url')->required(),
        ]);
    }

    public static function table(Table $table)
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('site_name')->searchable(),
            Tables\Columns\IconColumn::make('effects_enabled')->boolean(),
        ]);
    }

    public static function getPages()
    {
        return [
            'index' => Pages\ListSiteSettings::route('/'),
            'create' => Pages\CreateSiteSetting::route('/create'),
            'edit' => Pages\EditSiteSetting::route('/{record}/edit'),
        ];
    }
}
