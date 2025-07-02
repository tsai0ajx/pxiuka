<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CouponResource\Pages;
use App\Models\Coupon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CouponResource extends Resource
{
    protected static ?string $model = Coupon::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    protected static ?string $navigationGroup = '营销管理';

    protected static ?string $modelLabel = '优惠券';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('coupon')
                    ->required()
                    ->maxLength(150)
                    ->label('优惠码'),
                Forms\Components\TextInput::make('discount')
                    ->required()
                    ->numeric()
                    ->prefix('¥')
                    ->label('折扣金额'),
                Forms\Components\TextInput::make('ret')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->label('剩余使用次数'),
                Forms\Components\Toggle::make('is_open')
                    ->required()
                    ->default(true)
                    ->label('是否启用'),
                Forms\Components\Select::make('goods')
                    ->relationship('goods', 'gd_name')
                    ->multiple()
                    ->preload()
                    ->label('适用商品 (不选则为全场通用)'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('coupon')->label('优惠码')->searchable(),
                Tables\Columns\TextColumn::make('discount')->money('cny')->sortable()->label('折扣金额'),
                Tables\Columns\TextColumn::make('ret')->numeric()->sortable()->label('剩余次数'),
                Tables\Columns\IconColumn::make('is_open')->boolean()->label('是否启用'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->label('创建时间'),
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
            'index' => Pages\ListCoupons::route('/'),
            'create' => Pages\CreateCoupon::route('/create'),
            'edit' => Pages\EditCoupon::route('/{record}/edit'),
        ];
    }
}