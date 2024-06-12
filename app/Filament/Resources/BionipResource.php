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
use Filament\Tables\Filters\SelectFilter;

class BionipResource extends Resource
{
    protected static ?string $model = Bionip::class;

    protected static ?string $navigationIcon = 'heroicon-m-finger-print';
    protected static ?int $navigationSort = 3;
    // protected static ?string $activeNavigationIcon = 'heroicon-m-cursor-arrow-ripple';
    // protected static ?string $navigationGroup = 'CPMI';
    protected static ?string $navigationLabel = 'BIODATA';
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
                            ->placeholder('Pilih Pengalaman Terahir')
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
                            ->default('NO')
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
                                TextInput::make('nama')->label('Nama'),
                                Select::make('national')
                                    ->label('Negara Asal')
                                    ->options([
                                        'INDONESIAN' => 'INDONESIAN',
                                    ]),
                                Select::make('kelamin')
                                    ->label('Jenis Kelamin')
                                    ->options([
                                        'FEMALE' => 'FEMALE',
                                        'MALE' => 'MALE',
                                    ]),
                                Select::make('lulusan')
                                    ->label('Pendidikan')
                                    ->options([
                                        'Elementary School' => 'Elementary School',
                                        'Junior High School' => 'Junior High School',
                                        'Senior Highschool' => 'Senior Highschool',
                                        'University' => 'University',
                                    ]),
                                Select::make('agama')
                                    ->label('Agama')
                                    ->options([
                                        'MOESLIM' => 'MOESLIM',
                                        'CRISTIAN' => 'CRISTIAN',
                                        'HINDU' => 'HINDU',
                                        'BOEDHA' => 'BOEDHA',
                                    ]),
                                TextInput::make('anakke')
                                    ->label('Anak Ke')
                                    ->numeric()
                                    ->minLength(1)
                                    ->maxLength(2),
                                TextInput::make('brother')
                                    ->label('Saudara Laki Laki')
                                    ->numeric()
                                    ->minLength(1)
                                    ->maxLength(2),
                                TextInput::make('sister')
                                    ->label('Saudara perempuan')
                                    ->numeric()
                                    ->minLength(1)
                                    ->maxLength(2),
                            ]),

                        Fieldset::make('')
                            ->schema([
                                TextInput::make('usia')
                                    ->label('Usia CPMI')
                                    ->numeric()
                                    ->minLength(1)
                                    ->maxLength(2)
                                    ->suffix(' YO'),
                                DatePicker::make('tanggal_lahir')
                                    ->label('Tanggal Lahir CPMI'),
                                Select::make('status_nikah')
                                    ->label('Setatus Pernikahan')
                                    ->options([
                                        'SINGLE' => 'SINGLE',
                                        'MARRIED' => 'MARRIED',
                                        'DIVORCED' => 'DIVORCED',
                                        'WIDOW' => 'WIDOW',
                                    ]),
                                TextInput::make('tinggi_badan')
                                    ->label('Tinggi Badan')
                                    ->numeric()
                                    ->minLength(1)
                                    ->maxLength(3)
                                    ->suffix(' CM'),
                                TextInput::make('berat_badan')
                                    ->label('Berat Badan')
                                    ->numeric()
                                    ->minLength(1)
                                    ->maxLength(2)
                                    ->suffix(' KG'),
                                TextInput::make('son')->placeholder('CONTOH : 1 / 14 (YO)')
                                    ->label('Anak Laki Laki'),
                                TextInput::make('daughter')->placeholder('CONTOH : 1 / 14 (YO)')
                                    ->label('Anak Perempuan'),
                            ]),

                    ])->columns(2),

                //---------------------------------------------------------------- Working Experience 工作經驗
                Section::make('Working Experience')
                    ->description('工作經驗')
                    ->schema([
                        Radio::make('careofbabies')
                            ->label('Merawat Bayi ?')
                            ->default('NO')
                            ->options([
                                'YES' => 'YES',
                                'NO' => 'NO',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                        Radio::make('careoftoddler')
                            ->label('Merawat Balita ?')
                            ->default('NO')
                            ->options([
                                'YES' => 'YES',
                                'NO' => 'NO',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                        Radio::make('careofchildren')
                            ->label('Merawat Anak ?')
                            ->default('NO')
                            ->options([
                                'YES' => 'YES',
                                'NO' => 'NO',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                        Radio::make('careofelderly')
                            ->label('Merawat Lansia ?')
                            ->default('NO')
                            ->options([
                                'YES' => 'YES',
                                'NO' => 'NO',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                        Radio::make('careofdisabled')
                            ->label('Merawat Penyandang Cacat ?')
                            ->default('NO')
                            ->options([
                                'YES' => 'YES',
                                'NO' => 'NO',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                        Radio::make('careofbedridden')
                            ->label('Merawat Penyandang Lumpuh ?')
                            ->default('NO')
                            ->options([
                                'YES' => 'YES',
                                'NO' => 'NO',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                        Radio::make('careofpet')
                            ->label('Merawat Hewan ?')
                            ->default('NO')
                            ->options([
                                'YES' => 'YES',
                                'NO' => 'NO',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                        Radio::make('householdworks')
                            ->label('Pekerjaan Rumah Tangga ?')
                            ->default('NO')
                            ->options([
                                'YES' => 'YES',
                                'NO' => 'NO',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                        Radio::make('carwashing')
                            ->label('Mencuci Mobil ?')
                            ->default('NO')
                            ->options([
                                'YES' => 'YES',
                                'NO' => 'NO',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                        Radio::make('gardening')
                            ->label('Berkebun ?')
                            ->default('NO')
                            ->options([
                                'YES' => 'YES',
                                'NO' => 'NO',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                        Radio::make('cooking')
                            ->label('Memasak ?')
                            ->default('NO')
                            ->options([
                                'YES' => 'YES',
                                'NO' => 'NO',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                        Radio::make('driving')
                            ->label('Menyetir Mobil ?')
                            ->default('NO')
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
                        TextInput::make('hongkong')->suffix(' Years')->label('Hong Kong'),
                        TextInput::make('singapore')->suffix(' Years')->label('Singapore'),
                        TextInput::make('taiwan')->suffix(' Years')->label('Taiwan'),
                        TextInput::make('malaysia')->suffix(' Years')->label('Malaysia'),
                        TextInput::make('macau')->suffix(' Years')->label('Macau'),
                        TextInput::make('middleeast')->suffix(' Years')->label('Timur Tengah'),
                        TextInput::make('other')->suffix(' Years')->label('Lainya'),
                        TextInput::make('homecountry')->suffix(' Years')->label('Di Indonesia'),
                    ])->columns(4),

                //---------------------------------------------------------------- Language Skills 語言能力
                Section::make('Language Skills')
                    ->description('語言能力')
                    ->schema([
                        Radio::make('spokenenglish')
                            ->label('Bahasa Inggris')
                            ->options([
                                'POOR' => 'POOR',
                                'FAIR' => 'FAIR',
                                'GOOD' => 'GOOD',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                        Radio::make('spokencantonese')
                            ->label('Bahasa Kantonis')
                            ->options([
                                'POOR' => 'POOR',
                                'FAIR' => 'FAIR',
                                'GOOD' => 'GOOD',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                        Radio::make('spokenmandarin')
                            ->label('Bahasa Mandarin')
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
                        Repeater::make('pengalaman')->label('Pengalaman')
                            ->schema([
                                TextInput::make('nomorpengalaman')->label('Nomor'),
                                TextInput::make('negara')->label('Negara'),
                                TextInput::make('gaji')->label('Gaji'),
                                TextInput::make('jumlahorang')->label('Jumlah Orang'),
                                TextInput::make('tahunmulai')->label('Tahun Mulai'),
                                TextInput::make('tahunselesai')->label('Tahun Selesai'),
                                TextInput::make('alasan')->placeholder('Kosongkan Jika Tidak Ada')->label('Alasan Berhenti'),
                                Fieldset::make('')
                                    ->schema([
                                        Fieldset::make('')
                                            ->schema([
                                                Radio::make('careofbabies')
                                                    ->label('Merawat Bayi ?')
                                                    ->default('NO')
                                                    ->options([
                                                        'YES' => 'YES',
                                                        'NO' => 'NO',
                                                    ])
                                                    ->inline()
                                                    ->inlineLabel(false),
                                                TextInput::make('usiabayi')->label('Usia Bayi')->suffix(' Bulan'),
                                            ]),
                                        Fieldset::make('')
                                            ->schema([
                                                Radio::make('careoftoddler')
                                                    ->label('Merawat Balita ?')
                                                    ->default('NO')
                                                    ->options([
                                                        'YES' => 'YES',
                                                        'NO' => 'NO',
                                                    ])
                                                    ->inline()
                                                    ->inlineLabel(false),
                                                TextInput::make('usiabalita')->label('Usia Balita')->suffix(' Tahun'),
                                            ]),
                                        Fieldset::make('')
                                            ->schema([
                                                Radio::make('careofchildren')
                                                    ->label('Merawat Anak ?')
                                                    ->default('NO')
                                                    ->options([
                                                        'YES' => 'YES',
                                                        'NO' => 'NO',
                                                    ])
                                                    ->inline()
                                                    ->inlineLabel(false),
                                                TextInput::make('usiaanak')->label('Usia Anak')->suffix(' Tahun'),
                                            ]),
                                        Fieldset::make('')
                                            ->schema([
                                                Radio::make('careofelderly')
                                                    ->label('Merawat Lansia ?')
                                                    ->default('NO')
                                                    ->options([
                                                        'YES' => 'YES',
                                                        'NO' => 'NO',
                                                    ])
                                                    ->inline()
                                                    ->inlineLabel(false),
                                                TextInput::make('usialansia')->label('Usia Lansia')->suffix(' Tahun'),
                                            ]),
                                        Fieldset::make('')
                                            ->schema([
                                                Radio::make('careofdisabled')
                                                    ->label('Merawat Penyandang Cacat ?')
                                                    ->default('NO')
                                                    ->options([
                                                        'YES' => 'YES',
                                                        'NO' => 'NO',
                                                    ])
                                                    ->inline()
                                                    ->inlineLabel(false),
                                                TextInput::make('usiadisable')->label('Usia Disable')->suffix(' Tahun'),
                                            ]),
                                        Fieldset::make('')
                                            ->schema([
                                                Radio::make('careofbedridden')
                                                    ->label('Merawat Penyandang Lumpuh ?')
                                                    ->default('NO')
                                                    ->options([
                                                        'YES' => 'YES',
                                                        'NO' => 'NO',
                                                    ])
                                                    ->inline()
                                                    ->inlineLabel(false),
                                                TextInput::make('usialumpuh')->label('Usia Penyandang Lumpuh')->suffix(' Tahun'),
                                            ]),
                                        Radio::make('careofpet')
                                            ->label('Merawat Hewan ?')
                                            ->default('NO')
                                            ->options([
                                                'YES' => 'YES',
                                                'NO' => 'NO',
                                            ])
                                            ->inline()
                                            ->inlineLabel(false),
                                        Radio::make('householdworks')
                                            ->label('Pekerjaan Rumah Tangga ?')
                                            ->default('NO')
                                            ->options([
                                                'YES' => 'YES',
                                                'NO' => 'NO',
                                            ])
                                            ->inline()
                                            ->inlineLabel(false),
                                        Radio::make('carwashing')
                                            ->label('Mencuci Mobil ?')
                                            ->default('NO')
                                            ->options([
                                                'YES' => 'YES',
                                                'NO' => 'NO',
                                            ])
                                            ->inline()
                                            ->inlineLabel(false),
                                        Radio::make('gardening')
                                            ->label('Berkebun ?')
                                            ->default('NO')
                                            ->options([
                                                'YES' => 'YES',
                                                'NO' => 'NO',
                                            ])
                                            ->inline()
                                            ->inlineLabel(false),
                                        Radio::make('cooking')
                                            ->label('Memasak ?')
                                            ->default('NO')
                                            ->options([
                                                'YES' => 'YES',
                                                'NO' => 'NO',
                                            ])
                                            ->inline()
                                            ->inlineLabel(false),
                                        Radio::make('driving')
                                            ->label('Menyetir Mobil ?')
                                            ->default('NO')
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
                                Radio::make('babi')->label('Memakan Daging Babi ?')
                                    ->default('NO')
                                    ->options([
                                        'YES' => 'YES',
                                        'NO' => 'NO',
                                    ])
                                    ->inline()
                                    ->inlineLabel(false),
                                Radio::make('liburbukanhariminggu')->label('Bersedia Libur Selain Minggu')
                                    ->default('NO')
                                    ->options([
                                        'YES' => 'YES',
                                        'NO' => 'NO',
                                    ])
                                    ->inline()
                                    ->inlineLabel(false),
                                Radio::make('berbagikamar')->label('Berbagi Kamar ?')
                                    ->helperText('Berbagi Kamar Dengan BAYI / ANAK / ORANG TUA ?')
                                    ->default('NO')
                                    ->options([
                                        'YES' => 'YES',
                                        'NO' => 'NO',
                                    ])
                                    ->inline()
                                    ->inlineLabel(false),
                                Radio::make('takutanjing')->label('Takut Dengan Anjing ?')
                                    ->default('NO')
                                    ->options([
                                        'YES' => 'YES',
                                        'NO' => 'NO',
                                    ])
                                    ->inline()
                                    ->inlineLabel(false),
                                Radio::make('merokok')->label('Merokok ?')
                                    ->default('NO')
                                    ->options([
                                        'YES' => 'YES',
                                        'NO' => 'NO',
                                    ])
                                    ->inline()
                                    ->inlineLabel(false),
                                Radio::make('alkohol')->label('Minum Alkohol ?')
                                    ->default('NO')
                                    ->options([
                                        'YES' => 'YES',
                                        'NO' => 'NO',
                                    ])
                                    ->inline()
                                    ->inlineLabel(false),
                            ])->columns(3),
                        Fieldset::make('')
                            ->schema([
                                Radio::make('pernahsakit')->label('Pernah Sakit ?')
                                    ->default('NO')
                                    ->helperText('Isi Keterangan Jika Pernah Sakit Lama / Operasi')
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
                ImageColumn::make('foto')->label('')
                    ->circular()->size(60)
                    ->defaultImageUrl(url('/images/user.svg')),
                TextColumn::make('nama')->label('NAMA')->searchable()
                    ->description(fn (Bionip $record): string => $record->code),
                TextColumn::make('usia')->label('USIA')->suffix(' THN')->sortable()
                    ->description(fn (Bionip $record): string => $record->tanggal_lahir),
                TextColumn::make('created_at')->label('DIBUAT PADA')->sortable()->dateTime('d-m-Y'),
                TextColumn::make('Tujuan.nama')->label('NEGARA'),
                TextColumn::make('Marketing.nama')->label('MARKETING')->color('success'),
                TextColumn::make('Kantor.nama')->label('KANTOR')->color('primary'),
                // ->icon('heroicon-m-envelope')
            ])->defaultSort('updated_at', 'desc')
            ->filters([
                SelectFilter::make('Kantor')->relationship('Kantor', 'nama')->label('KANTOR'),
                SelectFilter::make('Tujuan')->relationship('Tujuan', 'nama')->label('NEGARA'),
                SelectFilter::make('Agency')->relationship('Agency', 'nama')->label('AGENCY'),
                SelectFilter::make('Marketing')->relationship('Marketing', 'nama')->label('MARKETING')

            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->label('Ubah')
                        ->color('primary'),
                    Action::make('Download Pdf')
                        ->label('Cetak')
                        ->icon('heroicon-o-printer')
                        ->url(fn (Bionip $record) => route('bionip.pdf.download', $record))
                        // ->url(fn() => route('biodata.pdf'))
                        ->openUrlInNewTab()
                        ->color('success'),
                    // Tables\Actions\ViewAction::make()->label('Lihat')->icon('heroicon-o-identification')
                    //     ->openUrlInNewTab(),
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
