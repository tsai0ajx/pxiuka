<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarmiResource\Pages;
use App\Models\Carmi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CarmiResource extends Resource
{
    protected static ?string $model = Carmi::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationGroup = '商品管理';

    protected static ?string $modelLabel = '卡密';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('goods_id')
                    ->relationship('goods', 'gd_name')
                    ->required()
                    ->label('所属商品'),
                Forms\Components\Textarea::make('carmi')
                    ->required()
                    ->label('卡密内容'),
                Forms\Components\Toggle::make('is_loop')
                    ->required()
                    ->label('是否循环卡密'),
                Forms\Components\Select::make('status')
                    ->options([
                        1 => '未售出',
                        2 => '已售出',
                    ])
                    ->default(1)
                    ->required()
                    ->label('状态'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('goods.gd_name')->label('所属商品')->searchable(),
                Tables\Columns\TextColumn::make('carmi')->label('卡密内容')->limit(50),
                Tables\Columns\IconColumn::make('is_loop')->boolean()->label('循环卡密'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 1,
                        'danger' => 2,
                    ])
                    ->formatStateUsing(fn (string $state): string => match ((int)$state) {
                        1 => '未售出',
                        2 => '已售出',
                        default => '未知',
                    })->label('状态'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->label('创建时间'),
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
            'index' => Pages\ListCarmis::route('/'),
            'create' => Pages\CreateCarmi::route('/create'),
            'edit' => Pages\EditCarmi::route('/{record}/edit'),
        ];
    }
}