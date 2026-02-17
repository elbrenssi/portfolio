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
    protected static ?string $model = Experience::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Textarea::make('company.en')->required(),
            Forms\Components\Textarea::make('role.en')->required(),
            Forms\Components\DatePicker::make('start_date')->required(),
            Forms\Components\DatePicker::make('end_date'),
            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([Tables\Columns\TextColumn::make('id'), Tables\Columns\TextColumn::make('start_date')]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ListExperiences::route('/'), 'create' => Pages\CreateExperience::route('/create'), 'edit' => Pages\EditExperience::route('/{record}/edit')];
    }
}
