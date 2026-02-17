<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Pages\Page;

class EditSiteSettings extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static string $view = 'filament.pages.edit-site-settings';

    public $data = [];

    public function mount(): void
    {
        $this->form->fill(SiteSetting::firstOrCreate(['id' => 1])->toArray());
    }

    protected function getFormSchema(): array
    {
        return [Forms\Components\TextInput::make('site_name.en')->required(), Forms\Components\Select::make('theme_default')->options(['dark'=>'dark','light'=>'light'])];
    }

    public function save(): void
    {
        SiteSetting::query()->updateOrCreate(['id' => 1], $this->form->getState());
    }
}
