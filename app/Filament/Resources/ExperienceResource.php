<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExperienceResource\Pages;
use App\Models\Experience;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ExperienceResource extends Resource
{
    protected static $model = Experience::class;

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
            'index' => Pages\ListExperiences::route('/'),
            'create' => Pages\CreateExperience::route('/create'),
            'edit' => Pages\EditExperience::route('/{record}/edit'),
        ];
    }
}
