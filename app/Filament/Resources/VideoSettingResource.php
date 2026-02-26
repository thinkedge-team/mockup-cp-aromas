<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VideoSettingResource\Pages;
use App\Filament\Resources\VideoSettingResource\RelationManagers;
use App\Models\VideoSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VideoSettingResource extends Resource
{
    protected static ?string $model = VideoSetting::class;

    protected static ?string $navigationIcon = 'heroicon-s-video-camera';

    protected static ?string $navigationGroup = 'Beranda';

    protected static ?int $navigationSort = 8;

    protected static ?string $navigationLabel = 'Video Section';

    protected static ?string $recordTitleAttribute = 'section_title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Video Section Settings')
                    ->description('Configure the video background section')
                    ->schema([
                        Forms\Components\TextInput::make('section_title')
                            ->label('Section Title')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Proses Produksi AROMAS')
                            ->helperText('Title shown above the video play button'),
                        Forms\Components\TextInput::make('video_url')
                            ->label('Video URL (YouTube Embed)')
                            ->required()
                            ->maxLength(500)
                            ->placeholder('https://www.youtube.com/embed/VIDEO_ID')
                            ->helperText('Enter YouTube embed URL (e.g., https://www.youtube.com/embed/dQw4w9WgXcQ)'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Show/hide the video section'),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('video_url')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->actions([])
            ->bulkActions([])
            ->filters([])
            ->paginated(false);
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
            'index' => Pages\ManageVideoSetting::route('/'),
            'create' => Pages\CreateVideoSetting::route('/create'),
            'edit' => Pages\EditVideoSetting::route('/{record}/edit'),
        ];
    }
}
