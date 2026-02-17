<?php

namespace App\Filament\Resources;

use App\Models\Project;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')->required(),
            Forms\Components\TextInput::make('slug')->required(),
            Forms\Components\FileUpload::make('cover_image_path')->image(),
            Forms\Components\FileUpload::make('model_gltf_path')->acceptedFileTypes(['model/gltf+json', '.gltf', '.glb']),
            Forms\Components\KeyValue::make('model_position'),
            Forms\Components\KeyValue::make('model_rotation'),
            Forms\Components\Toggle::make('featured'),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->searchable(),
            Tables\Columns\TextColumn::make('slug'),
            Tables\Columns\IconColumn::make('featured')->boolean(),
        ]);
    }
}
