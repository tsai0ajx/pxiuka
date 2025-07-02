<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GoodsResource\Pages;
use App\Models\Goods;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GoodsResource extends Resource
{
    protected static ?string $model = Goods::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationGroup = '商品管理';

    protected static ?string $modelLabel = '商品';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('group_id')
                    ->relationship('group', 'gp_name')
                    ->required()
                    ->label('商品分类'),
                Forms\Components\TextInput::make('gd_name')
                    ->required()
                    ->maxLength(200)
                    ->label('商品名称'),
                Forms\Components\Textarea::make('gd_description')
                    ->required()
                    ->maxLength(200)
                    ->label('商品简介'),
                Forms\Components\TextInput::make('gd_keywords')
                    ->required()
                    ->maxLength(200)
                    ->label('商品关键词'),
                Forms\Components\FileUpload::make('picture')
                    ->label('商品图片'),
                Forms\Components\TextInput::make('actual_price')
                    ->required()
                    ->numeric()
                    ->prefix('¥')
                    ->label('售价'),
                Forms\Components\TextInput::make('retail_price')
                    ->numeric()
                    ->prefix('¥')
                    ->label('零售价'),
                Forms\Components\TextInput::make('in_stock')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->label('库存'),
                Forms\Components\TextInput::make('buy_limit_num')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->label('单次限购'),
                Forms\Components\RichEditor::make('description')
                    ->columnSpanFull()
                    ->label('商品详情'),
                Forms\Components\Toggle::make('is_open')
                    ->required()
                    ->default(true)
                    ->label('是否上架'),
                Forms\Components\Select::make('type')
                    ->options([
                        1 => '自动发货',
                        2 => '人工处理',
                    ])
                    ->required()
                    ->default(1)
                    ->label('发货类型'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('gd_name')->label('商品名称')->searchable(),
                Tables\Columns\TextColumn::make('group.gp_name')->label('分类'),
                Tables\Columns\TextColumn::make('actual_price')->money('cny')->sortable()->label('售价'),
                Tables\Columns\TextColumn::make('retail_price')->money('cny')->sortable()->label('零售价'),
                Tables\Columns\TextColumn::make('in_stock')->numeric()->sortable()->label('库存'),
                Tables\Columns\TextColumn::make('sales_volume')->numeric()->sortable()->label('销量'),
                Tables\Columns\IconColumn::make('is_open')->boolean()->label('上架'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true)->label('创建时间'),
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
            'index' => Pages\ListGoods::route('/'),
            'create' => Pages\CreateGoods::route('/create'),
            'edit' => Pages\EditGoods::route('/{record}/edit'),
        ];
    }
}