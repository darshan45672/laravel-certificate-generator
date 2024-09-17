<?php

namespace App\Filament\Resources\CertificateResource\Pages;

use App\Filament\Resources\CertificateResource;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateCertificate extends CreateRecord
{
    protected static string $resource = CertificateResource::class;

    public function getHeader(): ?\Illuminate\Contracts\View\View
    {
        return null; // This will hide the header section completely
    }
    public function getForm(string $name): ?Form
    {
        return Form::make($this)
            ->schema([
                // Including your custom view if needed
                \Filament\Forms\Components\View::make('filament.pages.certificate'),
            ]);
    }
}
