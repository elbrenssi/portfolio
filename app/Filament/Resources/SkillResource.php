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
    protected static ?string $model = Skill::class;
    protected static ?string $navigationIcon = 'heroicon-o-lightning-bolt';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Textarea::make('name.en')->required(),
            Forms\Components\Textarea::make('name.fr')->required(),
            Forms\Components\Textarea::make('name.ar')->required(),
            Forms\Components\TextInput::make('level')->numeric()->minValue(0)->maxValue(100),
            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([Tables\Columns\TextColumn::make('id'), Tables\Columns\TextColumn::make('level')]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ListSkills::route('/'), 'create' => Pages\CreateSkill::route('/create'), 'edit' => Pages\EditSkill::route('/{record}/edit')];
    }
}
