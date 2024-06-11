<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BionipResource\Pages;
use App\Filament\Resources\BionipResource\RelationManagers;
use App\Models\Bionip;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\Layout\Split;


class BionipResource extends Resource
{
    protected static ?string $model = Bionip::class;

    protected static ?string $navigationIcon = 'heroicon-m-finger-print';
    protected static ?int $navigationSort = 3;
    // protected static ?string $activeNavigationIcon = 'heroicon-m-cursor-arrow-ripple';
    // protected static ?string $navigationGroup = 'CPMI';
    protected static ?string $navigationLabel = 'BIODATA NIP';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                //---------------------------------------------------------------- INPUT

                Section::make('INPUT')
                    ->description('INPUT DATA BIODATA')
                    ->schema([
                        Select::make('tujuan_id',)
                            ->relationship('Tujuan', 'nama')
                            ->required()
                            ->placeholder('Pilih Negara Tujuan')
                            ->label('Negara Tujuan'),
                        Select::make('pengalaman_id',)
                            ->relationship('Pengalaman', 'nama')
                            ->required()
                            ->placeholder('Pilih Pengalaman')
                            ->label('Pengalaman CPMI'),
                        Select::make('kantor_id',)
                            ->relationship('Kantor', 'nama')
                            ->required()
                            ->placeholder('Pilih Kantor Cabang')
                            ->label('Kantor Cabang'),
                        Select::make('marketing_id',)
                            ->relationship('Marketing', 'nama')
                            ->required()
                            ->placeholder('Pilih Marketing')
                            ->label('Markerting'),
                        Select::make('agency_id',)
                            ->relationship('Agency', 'nama')
                            ->required()
                            ->placeholder('Pilih Agency')
                            ->label('Agency'),
                        Radio::make('dapatjob')
                            ->options([
                                'YES' => 'YES',
                                'NO' => 'NO',
                            ])
                            ->inline()
                            ->inlineLabel(false)
                            ->label('Dapat Job'),
                    ])->columns(3),

                //---------------------------------------------------------------- Applicants Information Sheet 申請人資料

                Section::make('')
                    ->schema([
                        FileUpload::make('foto')->label('Upload FOTO')
                            ->disk('public')
                            ->directory('biodata/foto')
                            ->preserveFilenames()
                            ->loadingIndicatorPosition('right')
                            ->removeUploadedFileButtonPosition('right')
                            ->uploadButtonPosition('left')
                            ->uploadProgressIndicatorPosition('left')->openable()
                            ->previewable()
                            ->downloadable(),
                    ]),
                Section::make('')
                    ->schema([
                        TextInput::make('code'),
                        TextInput::make('nomor_hp')
                            ->numeric()
                            ->minLength(1)
                            ->maxLength(12)
                            ->placeholder('CONTOH : +62812686753')
                            ->label('Phone Number'),
                    ])->columns(2),

                //----------------------------------------------------------------
                Section::make('Applicants Information Sheet')
                    ->description('申請人資料')
                    ->schema([
                        Fieldset::make('')
                            ->schema([
                                TextInput::make('nama'),
                                Select::make('national')
                                    ->options([
                                        'INDONESIAN' => 'INDONESIAN',
                                    ]),
                                Select::make('kelamin')
                                    ->options([
                                        'FEMALE' => 'FEMALE',
                                        'MALE' => 'MALE',
                                    ]),
                                Select::make('lulusan')
                                    ->options([
                                        'Elementary School' => 'Elementary School',
                                        'Junior High School' => 'Junior High School',
                                        'Senior Highschool' => 'Senior Highschool',
                                        'University' => 'University',
                                    ]),
                                Select::make('agama')
                                    ->options([
                                        'MOESLIM' => 'MOESLIM',
                                        'CRISTIAN' => 'CRISTIAN',
                                        'HINDU' => 'HINDU',
                                        'BOEDHA' => 'BOEDHA',
                                    ]),
                                TextInput::make('anakke')
                                    ->numeric()
                                    ->minLength(1)
                                    ->maxLength(2),
                                TextInput::make('brother')
                                    ->numeric()
                                    ->minLength(1)
                                    ->maxLength(2),
                                TextInput::make('sister')
                                    ->numeric()
                                    ->minLength(1)
                                    ->maxLength(2),
                            ]),

                        Fieldset::make('')
                            ->schema([
                                TextInput::make('usia')
                                    ->numeric()
                                    ->minLength(1)
                                    ->maxLength(2)
                                    ->suffix(' YO'),
                                DatePicker::make('tanggal_lahir'),
                                Select::make('status_nikah')
                                    ->options([
                                        'SINGLE' => 'SINGLE',
                                        'MARRIED' => 'MARRIED',
                                        'DIVORCED' => 'DIVORCED',
                                        'WIDOW' => 'WIDOW',
                                    ]),
                                TextInput::make('tinggi_badan')
                                    ->numeric()
                                    ->minLength(1)
                                    ->maxLength(3)
                                    ->suffix(' CM'),
                                TextInput::make('berat_badan')
                                    ->numeric()
                                    ->minLength(1)
                                    ->maxLength(2)
                                    ->suffix(' KG'),
                                TextInput::make('son')->placeholder('CONTOH : 1 / 14 (YO)'),
                                TextInput::make('daughter')->placeholder('CONTOH : 1 / 14 (YO)'),
                            ]),

                    ])->columns(2),

                //---------------------------------------------------------------- Working Experience 工作經驗
                Section::make('Working Experience')
                    ->description('工作經驗')
                    ->schema([
                        Radio::make('careofbabies')
                            ->options([
                                'YES' => 'YES',
                                'NO' => 'NO',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                        Radio::make('careoftoddler')
                            ->options([
                                'YES' => 'YES',
                                'NO' => 'NO',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                        Radio::make('careofchildren')
                            ->options([
                                'YES' => 'YES',
                                'NO' => 'NO',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                        Radio::make('careofelderly')
                            ->options([
                                'YES' => 'YES',
                                'NO' => 'NO',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                        Radio::make('careofdisabled')
                            ->options([
                                'YES' => 'YES',
                                'NO' => 'NO',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                        Radio::make('careofbedridden')
                            ->options([
                                'YES' => 'YES',
                                'NO' => 'NO',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                        Radio::make('careofpet')
                            ->options([
                                'YES' => 'YES',
                                'NO' => 'NO',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                        Radio::make('householdworks')
                            ->options([
                                'YES' => 'YES',
                                'NO' => 'NO',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                        Radio::make('carwashing')
                            ->options([
                                'YES' => 'YES',
                                'NO' => 'NO',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                        Radio::make('gardening')
                            ->options([
                                'YES' => 'YES',
                                'NO' => 'NO',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                        Radio::make('cooking')
                            ->options([
                                'YES' => 'YES',
                                'NO' => 'NO',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                        Radio::make('driving')
                            ->options([
                                'YES' => 'YES',
                                'NO' => 'NO',
                            ])
                            ->inline()
                            ->inlineLabel(false),

                    ])->columns(3),

                //---------------------------------------------------------------- Overseas Experience 海外工作經驗
                Section::make('Overseas Experience')
                    ->description('海外工作經驗')
                    ->schema([
                        TextInput::make('hongkong')->suffix(' Years'),
                        TextInput::make('singapore')->suffix(' Years'),
                        TextInput::make('taiwan')->suffix(' Years'),
                        TextInput::make('malaysia')->suffix(' Years'),
                        TextInput::make('macau')->suffix(' Years'),
                        TextInput::make('middleeast')->suffix(' Years'),
                        TextInput::make('other')->suffix(' Years'),
                        TextInput::make('homecountry')->suffix(' Years'),
                    ])->columns(4),

                //---------------------------------------------------------------- Language Skills 語言能力
                Section::make('Language Skills')
                    ->description('語言能力')
                    ->schema([
                        Radio::make('spokenenglish')
                            ->options([
                                'POOR' => 'POOR',
                                'FAIR' => 'FAIR',
                                'GOOD' => 'GOOD',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                        Radio::make('spokencantonese')
                            ->options([
                                'POOR' => 'POOR',
                                'FAIR' => 'FAIR',
                                'GOOD' => 'GOOD',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                        Radio::make('spokenmandarin')
                            ->options([
                                'POOR' => 'POOR',
                                'FAIR' => 'FAIR',
                                'GOOD' => 'GOOD',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                    ])->columns(3),

                //---------------------------------------------------------------- Remark 備註
                Section::make('REMARK')
                    ->description('備註')
                    ->schema([
                        Textarea::make('remark')->label(false),
                    ]),
                //---------------------------------------------------------------- Previous Duties 過往工作
                Section::make('Previous Duties')
                    ->description('過往工作')
                    ->schema([
                        Repeater::make('pengalaman')
                            ->schema([
                                TextInput::make('negara'),
                                TextInput::make('gaji'),
                                TextInput::make('jumlahorang'),
                                TextInput::make('tahunmulai'),
                                TextInput::make('tahunselesai'),
                                TextInput::make('alasan')->placeholder('Kosongkan Jika Tidak Ada'),
                                Fieldset::make('')
                                    ->schema([
                                        Radio::make('careofbabies')
                                            ->options([
                                                'YES' => 'YES',
                                                'NO' => 'NO',
                                            ])
                                            ->inline()
                                            ->inlineLabel(false),
                                        Radio::make('careoftoddler')
                                            ->options([
                                                'YES' => 'YES',
                                                'NO' => 'NO',
                                            ])
                                            ->inline()
                                            ->inlineLabel(false),
                                        Radio::make('careofchildren')
                                            ->options([
                                                'YES' => 'YES',
                                                'NO' => 'NO',
                                            ])
                                            ->inline()
                                            ->inlineLabel(false),
                                        Radio::make('careofelderly')
                                            ->options([
                                                'YES' => 'YES',
                                                'NO' => 'NO',
                                            ])
                                            ->inline()
                                            ->inlineLabel(false),
                                        Radio::make('careofdisabled')
                                            ->options([
                                                'YES' => 'YES',
                                                'NO' => 'NO',
                                            ])
                                            ->inline()
                                            ->inlineLabel(false),
                                        Radio::make('careofbedridden')
                                            ->options([
                                                'YES' => 'YES',
                                                'NO' => 'NO',
                                            ])
                                            ->inline()
                                            ->inlineLabel(false),
                                        Radio::make('careofpet')
                                            ->options([
                                                'YES' => 'YES',
                                                'NO' => 'NO',
                                            ])
                                            ->inline()
                                            ->inlineLabel(false),
                                        Radio::make('householdworks')
                                            ->options([
                                                'YES' => 'YES',
                                                'NO' => 'NO',
                                            ])
                                            ->inline()
                                            ->inlineLabel(false),
                                        Radio::make('carwashing')
                                            ->options([
                                                'YES' => 'YES',
                                                'NO' => 'NO',
                                            ])
                                            ->inline()
                                            ->inlineLabel(false),
                                        Radio::make('gardening')
                                            ->options([
                                                'YES' => 'YES',
                                                'NO' => 'NO',
                                            ])
                                            ->inline()
                                            ->inlineLabel(false),
                                        Radio::make('cooking')
                                            ->options([
                                                'YES' => 'YES',
                                                'NO' => 'NO',
                                            ])
                                            ->inline()
                                            ->inlineLabel(false),
                                        Radio::make('driving')
                                            ->options([
                                                'YES' => 'YES',
                                                'NO' => 'NO',
                                            ])
                                            ->inline()
                                            ->inlineLabel(false),

                                    ])->columns(3)
                            ])->columns(3),
                    ]),
                //---------------------------------------------------------------- Other Question 其他問題
                Section::make('Other Question')
                    ->description('其他問題')
                    ->schema([
                        Fieldset::make('')
                            ->schema([
                                Radio::make('babi')
                                    ->options([
                                        'YES' => 'YES',
                                        'NO' => 'NO',
                                    ])
                                    ->inline()
                                    ->inlineLabel(false),
                                Radio::make('liburbukanhariminggu')
                                    ->options([
                                        'YES' => 'YES',
                                        'NO' => 'NO',
                                    ])
                                    ->inline()
                                    ->inlineLabel(false),
                                Radio::make('berbagikamar')
                                    ->options([
                                        'YES' => 'YES',
                                        'NO' => 'NO',
                                    ])
                                    ->inline()
                                    ->inlineLabel(false),
                                Radio::make('takutanjing')
                                    ->options([
                                        'YES' => 'YES',
                                        'NO' => 'NO',
                                    ])
                                    ->inline()
                                    ->inlineLabel(false),
                                Radio::make('merokok')
                                    ->options([
                                        'YES' => 'YES',
                                        'NO' => 'NO',
                                    ])
                                    ->inline()
                                    ->inlineLabel(false),
                                Radio::make('alkohol')
                                    ->options([
                                        'YES' => 'YES',
                                        'NO' => 'NO',
                                    ])
                                    ->inline()
                                    ->inlineLabel(false),
                            ])->columns(3),
                        Fieldset::make('')
                            ->schema([
                                Radio::make('pernahsakit')
                                    ->options([
                                        'YES' => 'YES',
                                        'NO' => 'NO',
                                    ])
                                    ->inline()
                                    ->inlineLabel(false),

                                Textarea::make('ketsakit')
                                    ->label('Keterangan Pernah Sakit'),
                            ])->columns(2),

                    ])->columns(2),

                //----------------------------------------------------------------



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    ImageColumn::make('foto')->label('Picture')->circular()->size(60),
                    Stack::make([
                        TextColumn::make('nama')->label('NAMA')->sortable(),
                        TextColumn::make('code')->label('NOMOR BIODATA'),
                    ]),
                    TextColumn::make('usia')->label('USIA')->suffix(' YO')->sortable(),
                    TextColumn::make('tanggal_lahir')->label('TANGGAL LAHIR')->sortable(),
                    TextColumn::make('created_at')->label('DIBUAT PADA')->sortable(),
                ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->label('Ubah')
                        ->color('primary')
                        ->openUrlInNewTab(),
                    Action::make('Download Pdf')
                        ->label('Cetak')
                        ->icon('heroicon-o-printer')
                        ->url(fn (Bionip $record) => route('bionip.pdf.download', $record))
                        // ->url(fn() => route('biodata.pdf'))
                        ->openUrlInNewTab()
                        ->color('success'),
                    Tables\Actions\ViewAction::make()->label('Lihat')->icon('heroicon-o-identification')
                        ->openUrlInNewTab(),
                    Tables\Actions\DeleteAction::make(),

                ])

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
            'index' => Pages\ListBionips::route('/'),
            'create' => Pages\CreateBionip::route('/create'),
            'view' => Pages\ViewBionip::route('/{record}'),
            'edit' => Pages\EditBionip::route('/{record}/edit'),
        ];
    }
}
