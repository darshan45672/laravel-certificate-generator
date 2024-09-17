<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CertificateResource\Pages;
use App\Filament\Resources\CertificateResource\RelationManagers;
use App\Models\Certificate;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CertificateResource extends Resource
{
    protected static ?string $model = Certificate::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('template_name')
                    ->required(),
                FileUpload::make('template_image')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('description_font_size')
                    ->required()
                    ->numeric()
                    ->default(20),
                TextInput::make('description_x_axis')
                    ->required()
                    ->numeric()
                    ->default(360),
                TextInput::make('description_y_axis')
                    ->required()
                    ->numeric()
                    ->default(360),
                TextInput::make('description_angle')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('unique_id_font_size')
                    ->required()
                    ->numeric()
                    ->default(20),
                TextInput::make('unique_id_x_axis')
                    ->required()
                    ->numeric()
                    ->default(360),
                TextInput::make('unique_id_y_axis')
                    ->required()
                    ->numeric()
                    ->default(360),
                TextInput::make('unique_id_angle')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('unique_id_color')
                    ->required(),
                TextInput::make('description_color')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('template_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description_font_size')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description_x_axis')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description_y_axis')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description_angle')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('unique_id_font_size')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('unique_id_x_axis')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('unique_id_y_axis')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('unique_id_angle')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('unique_id_color')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description_color')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCertificates::route('/'),
            'create' => Pages\CreateCertificate::route('/create'),
            'edit' => Pages\EditCertificate::route('/{record}/edit'),
        ];
    }
}
