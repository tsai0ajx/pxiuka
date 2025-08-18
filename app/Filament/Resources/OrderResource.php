<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationGroup = '订单管理';

    protected static ?string $modelLabel = '订单';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('order_sn')->label('订单号')->disabled(),
                Forms\Components\TextInput::make('email')->label('邮箱')->disabled(),
                Forms\Components\TextInput::make('total_price')->label('总价')->disabled(),
                Forms\Components\Select::make('status')
                    ->options([
                        1 => '待支付',
                        2 => '待处理',
                        3 => '处理中',
                        4 => '已完成',
                        5 => '处理失败',
                        6 => '异常',
                        -1 => '过期',
                    ])
                    ->label('订单状态'),
                Forms\Components\Textarea::make('info')->label('订单详情')->columnSpanFull()->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_sn')->label('订单号')->searchable(),
                Tables\Columns\TextColumn::make('goods.gd_name')->label('商品名称'),
                Tables\Columns\TextColumn::make('email')->label('邮箱')->searchable(),
                Tables\Columns\TextColumn::make('total_price')->money('cny')->sortable()->label('总价'),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('状态')
                    ->colors([
                        'primary' => 1,
                        'warning' => 2,
                        'success' => 4,
                        'danger' => 5,
                    ])
                    ->formatStateUsing(fn (string $state): string => match ((int)$state) {
                        1 => '待支付',
                        2 => '待处理',
                        3 => '处理中',
                        4 => '已完成',
                        5 => '处理失败',
                        6 => '异常',
                        -1 => '过期',
                        default => '未知',
                    }),
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
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}