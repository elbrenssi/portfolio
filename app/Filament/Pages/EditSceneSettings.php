<?php
namespace App\Filament\Pages;
use App\Models\SceneSetting;
use Filament\Forms;
use Filament\Pages\Page;
class EditSceneSettings extends Page implements Forms\Contracts\HasForms {
 use Forms\Concerns\InteractsWithForms;
 protected static ?string $navigationIcon = 'heroicon-o-sparkles';
 protected static string $view = 'filament.pages.edit-scene-settings';
 public function mount(): void { $this->form->fill(SceneSetting::firstOrCreate(['id'=>1])->toArray()); }
 protected function getFormSchema(): array { return [Forms\Components\Select::make('background_mode')->options(['aurora'=>'aurora','particles'=>'particles','none'=>'none'])]; }
 public function save(): void { SceneSetting::query()->updateOrCreate(['id'=>1], $this->form->getState()); }
}
