<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true),
            Forms\Components\Toggle::make('featured'),
            Forms\Components\FileUpload::make('cover_image_path')->disk('public'),
            Forms\Components\FileUpload::make('model_gltf_path')->disk('public'),
            Forms\Components\Textarea::make('title.en')->required(), Forms\Components\Textarea::make('title.fr')->required(), Forms\Components\Textarea::make('title.ar')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([Tables\Columns\TextColumn::make('slug'), Tables\Columns\IconColumn::make('featured')->boolean()]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ListProjects::route('/'), 'create' => Pages\CreateProject::route('/create'), 'edit' => Pages\EditProject::route('/{record}/edit')];
    }
}
