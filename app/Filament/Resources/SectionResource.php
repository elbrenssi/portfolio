<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionResource\Pages;
use App\Models\Section;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class SectionResource extends Resource
{
    protected static ?string $model = Section::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('key')->required()->unique(ignoreRecord: true),
            Forms\Components\Textarea::make('title.en')->required(),
            Forms\Components\Textarea::make('title.fr')->required(),
            Forms\Components\Textarea::make('title.ar')->required(),
            Forms\Components\Toggle::make('is_enabled')->default(true),
            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('key'),
            Tables\Columns\IconColumn::make('is_enabled')->boolean(),
            Tables\Columns\TextColumn::make('sort_order'),
        ]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ListSections::route('/'), 'create' => Pages\CreateSection::route('/create'), 'edit' => Pages\EditSection::route('/{record}/edit')];
    }
}
