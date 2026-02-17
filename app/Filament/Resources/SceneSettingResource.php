<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SceneSettingResource\Pages;
use App\Models\SceneSetting;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class SceneSettingResource extends Resource
{
    protected static $model = SceneSetting::class;

    public static function form(Form $form)
    {
        return $form->schema([
            Forms\Components\TextInput::make('id')->disabled(),
        ]);
    }

    public static function table(Table $table)
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('id'),
            Tables\Columns\TextColumn::make('updated_at')->dateTime(),
        ]);
    }

    public static function getPages()
    {
        return [
            'index' => Pages\ListSceneSettings::route('/'),
            'create' => Pages\CreateSceneSetting::route('/create'),
            'edit' => Pages\EditSceneSetting::route('/{record}/edit'),
        ];
    }
}
