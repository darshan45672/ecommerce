<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AddressRelationManager extends RelationManager
{
    protected static string $relationship = 'address';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('first_name')->required()->maxLength(255),
                TextInput::make('last_name')->required()->maxLength(255),
                TextInput::make('email')->email()->required()->maxLength(255),
                TextInput::make('phone')->tel()->required()->maxLength(20),
                TextInput::make('city')->required()->maxLength(255),
                TextInput::make('state')->required()->maxLength(255),
                TextInput::make('zip')->required()->maxLength(10)->numeric(),
                TextInput::make('country')->required()->maxLength(255),
                Textarea::make('street_address')->required()->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('street_address')
            ->columns([
                TextColumn::make('fullname')->label('Full Name'),
                TextColumn::make('email')->label('Email'),
                TextColumn::make('phone')->label('Phone'),
                TextColumn::make('city')->label('City'),
                TextColumn::make('state')->label('State'),
                TextColumn::make('zip')->label('Zip'),
                TextColumn::make('country')->label('Country'),
                
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}