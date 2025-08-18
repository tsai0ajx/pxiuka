<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GoodsGroupResource\Pages;
use App\Models\GoodsGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GoodsGroupResource extends Resource
{
    protected static ?string $model = GoodsGroup::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = '商品管理';

    protected static ?string $modelLabel = '商品分类';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('gp_name')
                    ->required()
                    ->maxLength(200)
                    ->label('分类名称'),
                Forms\Components\Toggle::make('is_open')
                    ->required()
                    ->default(true)
                    ->label('是否启用'),
                Forms\Components\TextInput::make('ord')
                    ->required()
                    ->numeric()
                    ->default(1)
                    ->label('排序'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('gp_name')
                    ->searchable()
                    ->label('分类名称'),
                Tables\Columns\IconColumn::make('is_open')
                    ->boolean()
                    ->label('是否启用'),
                Tables\Columns\TextColumn::make('ord')
                    ->numeric()
                    ->sortable()
                    ->label('排序'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('创建时间'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('更新时间'),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGoodsGroups::route('/'),
            'create' => Pages\CreateGoodsGroup::route('/create'),
            'edit' => Pages\EditGoodsGroup::route('/{record}/edit'),
        ];
    }
}