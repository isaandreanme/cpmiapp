<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BiodataResource\Pages;
use App\Filament\Resources\BiodataResource\RelationManagers;
use App\Models\Biodata;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Infolist;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Filters\SelectFilter;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;







class BiodataResource extends Resource
{
    protected static ?string $model = Biodata::class;

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
                //----------------------------------------------------------------

                Section::make('印尼傭工個人資料及工作簡介')
                    ->description('APPLICANT’S QUALIFICATION HIGHLIGHTS')
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
                        //----------------------------------------------------------------
                        TextInput::make('nomor_lamar')
                            ->label('Applicant’s No(僱傭編號)'),
                        //----------------------------------------------------------------
                        TextInput::make('nomor_hp')
                            ->prefix('+62')
                            ->numeric()
                            ->minLength(1)
                            ->maxLength(12)
                            ->label('Phone Number'),
                        //----------------------------------------------------------------
                        Fieldset::make('')
                            ->schema([
                                TextInput::make('nama')
                                    ->label('Name 姓名'),
                                TextInput::make('usia')
                                    ->numeric()
                                    ->minLength(1)
                                    ->maxLength(2)
                                    ->suffix(' YO')
                                    ->label('Age 年齡'),
                                DatePicker::make('tanggal_lahir')
                                    ->label('Date of birth 出身日期'),
                                TextInput::make('tempat_lahir')
                                    ->label('Place of birth 出身地點'),
                                TextInput::make('tinggi_badan')
                                    ->label('Height 身高')
                                    ->numeric()
                                    ->minLength(3)
                                    ->maxLength(3)
                                    ->suffix(' Cm'),
                                TextInput::make('berat_badan')
                                    ->label('Weight 體重')
                                    ->numeric()
                                    ->minLength(2)
                                    ->maxLength(2)
                                    ->suffix(' Kg'),
                                Select::make('agama')
                                    ->label('Religion 宗教')
                                    ->options([
                                        'MOESLIM' => 'MOESLIM',
                                        'CRISTIAN' => 'CRISTIAN',
                                        'HINDU' => 'HINDU',
                                        'BOEDHA' => 'BOEDHA',
                                    ]),
                                Select::make('lulusan')
                                    ->options([
                                        'Elementary School' => 'Elementary School',
                                        'Junior High School' => 'Junior High School',
                                        'Senior Highschool' => 'Senior Highschool',
                                        'University' => 'University',
                                    ])
                                    ->label('Education 教育'),
                            ]),
                        //----------------------------------------------------------------
                        Fieldset::make('')
                            ->schema([
                                Select::make('status_nikah')
                                    ->options([
                                        'SINGLE' => 'SINGLE',
                                        'MARRIED' => 'MARRIED',
                                        'DIVORCED' => 'DIVORCED',
                                        'WIDOW' => 'WIDOW',
                                    ])
                                    ->label('Marital Status 婚姻狀況'),
                                TextInput::make('jumlah_anak')
                                    ->label('No. of children/Age 子女數目/年齡'),
                                TextInput::make('jumlah_saudara')
                                    ->label('No. of brothers/Sisters 兄妹數目'),
                                TextInput::make('anak_ke')
                                    ->numeric()
                                    ->minLength(1)
                                    ->maxLength(2)
                                    ->label('I am the in the family 家中排行第'),
                            ]),
                        //----------------------------------------------------------------
                        Fieldset::make('')
                            ->schema([
                                Radio::make('pengalaman_luarnegeri')
                                    ->options([
                                        'YES' => 'YES',
                                        'NO' => 'NO',
                                    ])
                                    ->inline()
                                    ->inlineLabel(false)
                                    ->label('Overseas Experience 海外經驗'),
                                TextInput::make('ket_pengalaman_luarnegeri')
                                    ->label('Where 何處'),
                                Radio::make('pengalaman_lokal')
                                    ->options([
                                        'YES' => 'YES',
                                        'NO' => 'NO',
                                    ])
                                    ->inline()
                                    ->inlineLabel(false)
                                    ->label('Local Experience 印尼本土經驗'),
                                TextInput::make('ket_pengalaman_lokal')
                                    ->label('Where 何處'),
                                Fieldset::make('Recommended for')
                                    ->schema([
                                        Radio::make('housekeeping')
                                            ->options([
                                                'YES' => 'YES',
                                                'NO' => 'NO',
                                            ])
                                            ->inline()
                                            ->inlineLabel(false)
                                            ->label('House Keeping'),

                                        Radio::make('babysitting')
                                            ->options([
                                                'YES' => 'YES',
                                                'NO' => 'NO',
                                            ])
                                            ->inline()
                                            ->inlineLabel(false)
                                            ->label('Baby Sitting'),
                                    ]),

                            ]),
                        //----------------------------------------------------------------
                        Fieldset::make('SKILLS')
                            // ->columns([
                            //     'sm' => 2,
                            //     'xl' => 4,
                            //     '2xl' => 4,
                            // ])
                            ->schema([

                                Radio::make('careofbabies')
                                    ->label('護理嬰兒 Care of Babies')
                                    ->options([
                                        'POOR' => 'YES',
                                        'FAIR' => 'NO',
                                    ])
                                    ->inline()
                                    ->inlineLabel(false),

                                Radio::make('careofyoung')
                                    ->label('護理兒童 Care of Young Children')
                                    ->options([
                                        'POOR' => 'YES',
                                        'FAIR' => 'NO',
                                    ])
                                    ->inline()
                                    ->inlineLabel(false),

                                Radio::make('householdworks')
                                    ->label('家務 Household Works')
                                    ->options([
                                        'POOR' => 'YES',
                                        'FAIR' => 'NO',
                                    ])
                                    ->inline()
                                    ->inlineLabel(false),

                                Radio::make('careofelderly')
                                    ->label('護理老人 Care of Elderly/Disable')
                                    ->options([
                                        'POOR' => 'YES',
                                        'FAIR' => 'NO',
                                    ])
                                    ->inline()
                                    ->inlineLabel(false),

                                Radio::make('cooking')
                                    ->label('烹飪 Cooking')
                                    ->options([
                                        'POOR' => 'YES',
                                        'FAIR' => 'NO',
                                    ])
                                    ->inline()
                                    ->inlineLabel(false),

                                Radio::make('housmaid')
                                    ->label('女傭經驗 Exp. In Housemaid')
                                    ->options([
                                        'POOR' => 'YES',
                                        'FAIR' => 'NO',
                                    ])
                                    ->inline()
                                    ->inlineLabel(false),
                            ])->columns(3),
                        Fieldset::make('LANGUAGE')
                            // ->columns([
                            //     'sm' => 2,
                            //     'xl' => 4,
                            //     '2xl' => 4,
                            // ])
                            ->schema([

                                Radio::make('spokenenglish')
                                    ->label('能操英語 Spoken English')
                                    ->options([
                                        'POOR' => 'POOR',
                                        'FAIR' => 'FAIR',
                                        'GOOD' => 'GOOD',
                                        // 'VERY GOOD' => 'VERY GOOD',
                                    ]),

                                Radio::make('spokencantonese')
                                    ->label('能操廣東話 Spoken Cantonese')
                                    ->options([
                                        'POOR' => 'POOR',
                                        'FAIR' => 'FAIR',
                                        'GOOD' => 'GOOD',
                                        // 'VERY GOOD' => 'VERY GOOD',
                                    ]),

                                Radio::make('spokenmandarin')
                                    ->label('能操國語 Spoken Mandarin')
                                    ->options([
                                        'POOR' => 'POOR',
                                        'FAIR' => 'FAIR',
                                        'GOOD' => 'GOOD',
                                        // 'VERY GOOD' => 'VERY GOOD',
                                    ]),
                                Radio::make('personality')
                                    ->label('個性表現 Personality')
                                    ->options([
                                        'POOR' => 'POOR',
                                        'FAIR' => 'FAIR',
                                        'GOOD' => 'GOOD',
                                        // 'VERY GOOD' => 'VERY GOOD',
                                    ]),
                                Radio::make('facialexpression')
                                    ->label('儀容 Facial Expression')
                                    ->options([
                                        'POOR' => 'POOR',
                                        'FAIR' => 'FAIR',
                                        'GOOD' => 'GOOD',
                                        // 'VERY GOOD' => 'VERY GOOD',
                                    ]),
                            ])->columns(5),
                        //----------------------------------------------------------------
                        Fieldset::make('PETS')
                            ->schema([
                                Radio::make('afraidofdog')
                                    ->options([
                                        'YES' => 'YES',
                                        'NO' => 'NO',
                                    ])
                                    ->inline()
                                    ->inlineLabel(false)
                                    ->label('怕狗 Afraid of Dog'),
                                Radio::make('caringdog')
                                    ->options([
                                        'YES' => 'YES',
                                        'NO' => 'NO',
                                    ])
                                    ->inline()
                                    ->inlineLabel(false)
                                    ->label('經驗照顧狗 Exp. Taking care of Dog'),
                            ]),
                        //----------------------------------------------------------------
                        // TextInput::make('pengalaman')
                        //     ->label('PREVIOUS EMPLOYMENT '),
                        //----------------------------------------------------------------
                        Fieldset::make('PREVIOUS EMPLOYMENT')
                            ->schema([
                                Repeater::make('pengalaman')
                                    ->schema([
                                        TextInput::make('nama_majikan')
                                            ->label('Name of Employer 前僱主名稱'),
                                        TextInput::make('alamat_majikan')
                                            ->label('Location of Employer 前僱主地'),
                                        TextInput::make('tahun_mulai')
                                            ->numeric()
                                            ->minLength(4)
                                            ->maxLength(4)
                                            ->label('From 由'),
                                        TextInput::make('tahun_selesai')
                                            ->numeric()
                                            ->minLength(4)
                                            ->maxLength(4)
                                            ->label('To 由'),
                                        TextInput::make('gaji')
                                            ->label('Salary 薪金 '),
                                        TextInput::make('alasan_selesai')
                                            ->label('Reason of Leave 離'),
                                        Textarea::make('keterangan')
                                            ->label('Description of job 工作性質'),
                                    ])
                                    ->label(' PREVIOUS EMPLOYMENT')
                                    ->columns(2),
                            ])->columns(1),
                        //----------------------------------------------------------------
                        Fieldset::make('Husband')
                            ->schema([
                                TextInput::make('nama_suami')
                                    ->label('Name of Spouse 配偶姓名/husband'),
                                TextInput::make('usia_suami')
                                    ->numeric()
                                    ->minLength(1)
                                    ->maxLength(2)
                                    ->suffix(' YO')
                                    ->label('Age 年齡'),
                                TextInput::make('pekerjaan_suami')
                                    ->label('Spouse’s Occupation 配偶職業'),
                                TextInput::make('anakke_suami')
                                    ->numeric()
                                    ->minLength(1)
                                    ->maxLength(2)
                                    ->label('No. of Children 子女數'),
                            ]),
                        //----------------------------------------------------------------
                        Fieldset::make('Parents')
                            ->schema([
                                TextInput::make('nama_ayah')
                                    ->label('Name of Father/Occupation 父親姓名/職業'),
                                TextInput::make('usia_ayah')
                                    ->suffix(' YO')
                                    ->label('Age年齡'),
                                TextInput::make('nama_ibu')
                                    ->label('Name of Mother/Occupation母親姓'),
                                TextInput::make('usia_ibu')
                                    ->suffix(' YO')
                                    ->label('Age 年齡'),
                                Textarea::make('alamat_ortu')
                                    ->label('ADDRESS'),
                            ]),
                    ])
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
                        TextColumn::make('nomor_lamar')->label('NOMOR BIODATA'),
                    ]),
                    TextColumn::make('usia')->label('USIA')->suffix(' YO')->sortable(),
                    TextColumn::make('tanggal_lahir')->label('TANGGAL LAHIR')->sortable(),
                    TextColumn::make('created_at')->label('DIBUAT PADA')->sortable(),
                ]),


            ])
            ->filters([
                DateRangeFilter::make('created_at')
                    ->label('DIBUAT PADA'),
                SelectFilter::make('Marketing')->relationship('Marketing', 'nama')->label('MARKETING'),
                SelectFilter::make('Tujuan')->relationship('Tujuan', 'nama')->label('NEGARA'),
                SelectFilter::make('Agency')->relationship('Agency', 'nama')->label('AGENCY'),
                SelectFilter::make('Kantor')->relationship('Kantor', 'nama')->label('KANTOR'),
                SelectFilter::make('Tujuan')->relationship('Tujuan', 'nama')->label('NEGARA'),
                SelectFilter::make('Agency')->relationship('Agency', 'nama')->label('AGENCY'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make()->label('View Detail')->icon('heroicon-o-identification')->color('success')
                    ->openUrlInNewTab(),
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
            'index' => Pages\ListBiodatas::route('/'),
            'create' => Pages\CreateBiodata::route('/create'),
            'edit' => Pages\EditBiodata::route('/{record}/edit'),
            'view' => Pages\ViewBiodata::route('/{record}'),

        ];
    }


    // public static function infolist(Infolist $infolist): Infolist
    // {
    //     return $infolist
    //         ->schema([
    //             ComponentsSection::make('印尼傭工個人資料及工作簡介')
    //                 ->description('APPLICANT’S QUALIFICATION HIGHLIGHTS')
    //                 ->schema([
    //                     ComponentsSection::make('')
    //                         ->description('')
    //                         ->schema([
    //                             TextEntry::make('nomor_lamar')->label('Applicant’s No(僱傭編號)'),
    //                             TextEntry::make('nomor_hp')->label('Phone Number')->prefix('+62 '),
    //                         ])->columns(2),
    //                     Split::make([
    //                         ComponentsSection::make('Details')
    //                             ->description('')
    //                             ->schema([
    //                                 TextEntry::make('nama')->label('Name 姓名'),
    //                                 TextEntry::make('tempat_lahir')->label('Place of birth 出身地點'),
    //                                 TextEntry::make('tanggal_lahir')->label('Date of birth 出身日期'),
    //                                 TextEntry::make('tinggi_badan')->label('Height 身高')->suffix(' Cm'),
    //                                 TextEntry::make('berat_badan')->label('Weight 體重')->suffix(' Kg'),
    //                                 TextEntry::make('agama')->label('Religion 宗教'),
    //                                 TextEntry::make('lulusan')->label('Education 教育'),
    //                                 TextEntry::make('status_nikah')->label('Marital Status 婚姻狀況'),
    //                                 TextEntry::make('jumlah_anak')->label('No. of children/Age 子女數目/年齡'),
    //                                 TextEntry::make('jumlah_saudara')->label('No. of brothers/Sisters 兄妹數目'),
    //                                 TextEntry::make('anak_ke')->label('I am the in the family 家中排行第'),
    //                             ])->columns(2),

    //                         ComponentsSection::make('Finished Contract on')
    //                             ->description('')
    //                             ->schema([
    //                                 TextEntry::make('pengalaman_luarnegeri')->label('Overseas Experience 海外經驗'),
    //                                 TextEntry::make('ket_pengalaman_luarnegeri')->label('Where 何處'),
    //                                 TextEntry::make('pengalaman_lokal')->label('Local Experience 印尼本土經驗'),
    //                                 TextEntry::make('ket_pengalaman_lokal')->label('Where 何處'),
    //                                 TextEntry::make('housekeeping')->label('Recommended for House Keeping'),
    //                                 TextEntry::make('babysitting')->label('Recommended for Baby Sitting'),
    //                             ]),
    //                     ]),
    //                     Split::make([
    //                         ComponentsSection::make('PHOTO')
    //                             ->description('')
    //                             ->schema([

    //                                 ImageEntry::make('foto')
    //                                     ->label('')
    //                                     // ->circular()
    //                                     ->square()
    //                                     ->width(520)
    //                                     ->height(700)
    //                                     ->extraImgAttributes(['loading' => 'lazy']),
    //                             ]),

    //                         ComponentsSection::make('SKILLS')
    //                             ->description('')
    //                             ->schema([
    //                                 TextEntry::make('careofbabies')->label('護理嬰兒 Care of Babies'),
    //                                 TextEntry::make('careofyoung')->label('護理兒童 Care of Young Children'),
    //                                 TextEntry::make('householdworks')->label('家務 Household Works'),
    //                                 TextEntry::make('personality')->label('個性表現 Personality'),
    //                                 TextEntry::make('facialexpression')->label('儀容 Facial Expression'),
    //                                 TextEntry::make('careofelderly')->label('護理老人 Care of Elderly/Disable'),
    //                                 TextEntry::make('cooking')->label('烹飪 Cooking'),
    //                                 TextEntry::make('housmaid')->label('女傭經驗 Exp. In Housemaid'),
    //                                 TextEntry::make('spokenenglish')->label('能操英語 Spoken English'),
    //                                 TextEntry::make('spokencantonese')->label('能操廣東話 Spoken Cantonese'),
    //                                 TextEntry::make('spokenmandarin')->label('能操國語 Spoken Mandarin'),
    //                             ])->columns(2),

    //                     ]),
    //                     ComponentsSection::make('PREVIOUS EMPLOYMENT HISTORY 以往僱員工作紀錄')
    //                         ->description('')
    //                         ->schema([
    //                             RepeatableEntry::make('pengalaman')
    //                                 ->schema([
    //                                     TextEntry::make('nama_majikan')
    //                                         ->label('Name of Employer 前僱主名稱'),
    //                                     TextEntry::make('alamat_majikan')
    //                                         ->label('Location of Employer 前僱主地'),
    //                                     TextEntry::make('tahun_mulai')
    //                                         ->label('From 由'),
    //                                     TextEntry::make('tahun_selesai')
    //                                         ->label('To 由'),
    //                                     TextEntry::make('gaji')
    //                                         ->label('Salary 薪金 '),
    //                                     TextEntry::make('alasan_selesai')
    //                                         ->label('Reason of Leave 離'),
    //                                     TextEntry::make('keterangan')
    //                                         ->label('Description of job 工作性質'),
    //                                 ])
    //                                 ->label('')
    //                                 ->columns(2),
    //                         ]),

    //                     ComponentsSection::make('HUSBAN')
    //                         ->description('')
    //                         ->schema([
    //                             TextEntry::make('nama_suami')
    //                                 ->label('Name of Spouse 配偶姓名/husband'),
    //                             TextEntry::make('usia_suami')
    //                                 ->label('Age 年齡')
    //                                 ->suffix(' (YO)'),
    //                             TextEntry::make('pekerjaan_suami')
    //                                 ->label('Spouse’s Occupation 配偶職業'),
    //                             TextEntry::make('anakke_suami')
    //                                 ->label('No. of Children 子女數'),
    //                         ])->columns(2),
    //                     ComponentsSection::make('PARENT')
    //                         ->description('')
    //                         ->schema([
    //                             TextEntry::make('nama_ayah')
    //                                 ->label('Name of Father/Occupation 父親姓名/職業'),
    //                             TextEntry::make('usia_ayah')->suffix(' (YO)')->label('Age 年齡'),
    //                             TextEntry::make('nama_ibu')
    //                                 ->label('Name of Mother/Occupation母親姓'),
    //                             TextEntry::make('usia_ibu')->suffix(' (YO)')->label('Age 年齡'),
    //                             TextEntry::make('alamat_ortu')->label('ADDRESS'),
    //                         ])->columns(2),
    //                     ComponentsSection::make('SHE HAS WORKING EXPERIENCE')
    //                         ->description('')
    //                         ->schema([
    //                             RepeatableEntry::make('pengalaman')
    //                                 ->schema([
    //                                     TextEntry::make('keterangan')
    //                                         ->label(''),
    //                                 ])
    //                                 ->label('')
    //                                 ->columns(2),
    //                         ]),
    //                 ])->compact(),

    //         ]);
    // }
}
