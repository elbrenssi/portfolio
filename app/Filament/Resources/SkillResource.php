<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkillResource\Pages;
use App\Models\Skill;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class SkillResource extends Resource
{
    protected static $model = Skill::class;

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
            'index' => Pages\ListSkills::route('/'),
            'create' => Pages\CreateSkill::route('/create'),
            'edit' => Pages\EditSkill::route('/{record}/edit'),
        ];
    }
}
