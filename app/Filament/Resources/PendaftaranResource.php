<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendaftaranResource\Pages;
use App\Filament\Resources\PendaftaranResource\RelationManagers;
use App\Filament\Resources\PendaftaranResource\RelationManagers\DataPmiRelationManager;
use App\Models\District;
use App\Models\Pendaftaran;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use Illuminate\Contracts\View\View;

class PendaftaranResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;

    protected static ?string $navigationIcon = 'heroicon-m-check-badge';
    // protected static ?string $navigationGroup = 'CPMI';
    protected static ?string $navigationLabel = 'PENDAFTARAN';
    protected static ?int $navigationSort = -2;
    protected static ?string $recordTitleAttribute = 'nama';
    public static function getGloballySearchableAttributes(): array
    {
        return ['nama', 'nomor_ktp', 'nomor_telp'];
    }

    // public static function getNavigationBadge(): ?string
    // {
    //     return static::getModel()::count();
    // }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)
                    ->schema([
                        Section::make('DATA PENDAFTARAN')
                            ->description('Silahkan Input Data Pendaftar')
                            ->icon('heroicon-o-check-circle')
                            ->schema([
                                Fieldset::make('PENDAFTARAN')
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                Select::make('kantor_id',)
                                                    ->relationship('Kantor', 'nama')
                                                    ->required()
                                                    ->placeholder('Pilih Kantor Cabang')
                                                    ->label('Kantor Cabang'),
                                                Select::make('sponsor_id',)
                                                    ->relationship('Sponsor', 'nama')
                                                    ->placeholder('Pilih SPONSOR PL')
                                                    ->required()
                                                    ->searchable()
                                                    ->optionsLimit(5)
                                                    ->label('SPONSOR PL')
                                                    ->createOptionForm([
                                                        Forms\Components\TextInput::make('nama')->unique()
                                                    ]),
                                            ]),

                                        //----------------------------------------------------------------
                                        TextInput::make('nama')
                                            ->rules('required')
                                            ->placeholder('Masukan Nama Lengkap')
                                            ->label('Nama CPMI'),
                                        TextInput::make('nomor_ktp')
                                            ->label('Nomor E-KTP')
                                            ->rules('required')
                                            ->placeholder('Masukan 16 Digit No KTP')
                                            ->unique(ignoreRecord: true)
                                            ->required()
                                            ->numeric()
                                            ->minLength(5)
                                            ->maxLength(17),
                                        TextInput::make('nomor_telp')
                                            ->label('Nomor Telp CPMI')
                                            ->placeholder('Contoh. 081xxxx')
                                            ->numeric()
                                            ->minLength(6)
                                            ->maxLength(13),
                                        FileUpload::make('fotopmi')->disk('public')->label('Lengkapi Foto PMI')
                                            ->directory('pendaftaran/fotopmi')
                                            ->preserveFilenames()
                                            ->openable()
                                            ->previewable()
                                            ->downloadable()
                                            ->loadingIndicatorPosition('right')
                                            ->removeUploadedFileButtonPosition('right')
                                            ->uploadButtonPosition('left')
                                            ->uploadProgressIndicatorPosition('left')
                                            ->image()
                                            ->imageEditor()
                                            ->imageEditorAspectRatios([
                                                null,
                                                '16:9',
                                                '4:3',
                                                '1:1',
                                            ]),

                                    ])->columns(4),
                                //----------------------------------------------------------------
                                Fieldset::make('ALAMAT')
                                    ->schema([
                                        TextInput::make('alamat')
                                            ->placeholder('Masukan Alamat')
                                            ->label('Alamat'),
                                        TextInput::make('rtrw')
                                            ->placeholder('Masukan RT / RW')
                                            ->label('RT / RW')
                                            // ->numeric()
                                            ->minLength(7)
                                            ->maxLength(7)
                                            ->mask('999/999'),

                                        //----------------------------------------------------------------
                                        Select::make('province_id')
                                            ->label('Provinsi')
                                            ->options(Province::all()->pluck('name', 'id')->toArray())
                                            ->reactive()
                                            ->optionsLimit(3)
                                            ->afterStateUpdated(fn (callable $set) => $set('regency_id', null))
                                            ->searchable()
                                            ->preload()
                                            ->placeholder('Pilih Provinsi'),
                                        Select::make('regency_id')
                                            ->label('Kabupaten / Kota')
                                            ->options(function (callable $get) {
                                                $province = Province::find($get('province_id'));
                                                if (!$province) {
                                                    return Regency::pluck('name', 'id');
                                                }
                                                return $province->regencies->pluck('name', 'id');
                                            })
                                            ->reactive()
                                            ->afterStateUpdated(fn (callable $set) => $set('district_id', null))
                                            ->searchable()
                                            ->preload()
                                            ->optionsLimit(3)
                                            ->placeholder('Cari Kabupaten / Kota'),
                                        Select::make('district_id')
                                            ->label('Kecamatan')
                                            ->options(function (callable $get) {
                                                $regencies = Regency::find($get('regency_id'));
                                                if (!$regencies) {
                                                    return District::pluck('name', 'id');
                                                }
                                                return $regencies->districts->pluck('name', 'id');
                                            })
                                            ->reactive()
                                            ->afterStateUpdated(fn (callable $set) => $set('village_id', null))
                                            ->searchable()
                                            ->preload()
                                            ->optionsLimit(3)
                                            ->placeholder('Cari Kecamatan'),
                                        Select::make('village_id')
                                            ->searchable()
                                            ->label('Kelurahan')
                                            ->optionsLimit(3)
                                            ->placeholder('Cari Kelurahan')
                                            ->getSearchResultsUsing(function ($search, $get) {
                                                if (!$get('regency_id')) {
                                                    return [];
                                                }
                                                return Village::where('district_id', $get('district_id'))
                                                    ->where('name', 'like', "%{$search}%")
                                                    // ->Limit(3)
                                                    ->pluck('name', 'id');
                                            })
                                            ->getOptionLabelUsing(fn ($value): ?string => Village::find($value)?->name),
                                    ])->columns(2),

                                //----------------------------------------------------------------
                                Fieldset::make('BIODATA')
                                    ->schema([
                                        Select::make('tempatlahir')
                                            ->label('Tempat Lahir')
                                            ->options(Regency::all()->pluck('name', 'id')->toArray())
                                            ->reactive()
                                            ->optionsLimit(3)
                                            ->searchable()
                                            ->preload()
                                            ->placeholder('Pilih Kota'),
                                        DatePicker::make('tgllahir')
                                            ->label('Tanggal Lahir')
                                            ->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y'),
                                        TextInput::make('tinggibadan')
                                            ->label('Tinggi Badan')
                                            ->placeholder('Centimeter')
                                            ->numeric()
                                            ->minLength(2)
                                            ->maxLength(3),
                                        TextInput::make('beratbadan')
                                            ->label('Berat Badan')
                                            ->placeholder('Kilogram')
                                            ->numeric()
                                            ->minLength(2)
                                            ->maxLength(3),
                                    ])->columns(2),
                                //----------------------------------------------------------------
                                Fieldset::make('DATA KELUARGA')
                                    ->schema([
                                        TextInput::make('nomor_kk')
                                            ->label('Nomor KK')
                                            ->placeholder('Masukan 16 Digit No KK')
                                            ->numeric()
                                            ->minLength(5)
                                            ->maxLength(17),
                                        TextInput::make('nama_wali')
                                            ->placeholder('Masukan Nama Wali / Suami')
                                            ->label('Nama Wali'),
                                        TextInput::make('nomor_ktp_wali')
                                            ->label('Nomor E-KTP WALI')
                                            ->rules('required')
                                            ->placeholder('Masukan 16 Digit No KTP')
                                            ->unique(ignoreRecord: true)
                                            ->required()
                                            ->numeric()
                                            ->minLength(5)
                                            ->maxLength(17),
                                        TextInput::make('nomor_telp_wali')
                                            ->label('Nomor Telp Wali')
                                            ->placeholder('Contoh. 081xxxx')
                                            ->numeric()
                                            ->columnSpan([
                                                '2xl'
                                            ])
                                            ->minLength(6)
                                            ->maxLength(13),
                                    ])->columns(2),
                            ])->columns(2)->collapsed(),
                        Section::make('UPLOAD DOKUMEN')
                            ->description('Silahkan Upload Data Pendaftar')
                            ->icon('heroicon-o-check-circle')
                            ->schema([
                                FileUpload::make('file_ktp')->label('Upload KTP')
                                    ->disk('public')
                                    ->directory('pendaftaran/file_ktp')
                                    ->preserveFilenames()
                                    ->loadingIndicatorPosition('right')
                                    ->removeUploadedFileButtonPosition('right')
                                    ->uploadButtonPosition('left')
                                    ->uploadProgressIndicatorPosition('left')->openable()
                                    ->previewable()
                                    ->downloadable(),
                                FileUpload::make('file_ktp_wali')->label('Upload KTP Wali')
                                    ->disk('public')
                                    ->directory('pendaftaran/file_ktp_wali')
                                    ->preserveFilenames()
                                    ->loadingIndicatorPosition('right')
                                    ->removeUploadedFileButtonPosition('right')
                                    ->uploadButtonPosition('left')
                                    ->uploadProgressIndicatorPosition('left')->openable()
                                    ->previewable()
                                    ->downloadable(),
                                FileUpload::make('file_kk')->label('Upload KK')
                                    ->disk('public')
                                    ->directory('pendaftaran/file_kk')
                                    ->preserveFilenames()
                                    ->loadingIndicatorPosition('right')
                                    ->removeUploadedFileButtonPosition('right')
                                    ->uploadButtonPosition('left')
                                    ->uploadProgressIndicatorPosition('left')->openable()
                                    ->previewable()
                                    ->downloadable(),
                                FileUpload::make('file_akta_lahir')->label('Upload Akta Lahir')
                                    ->disk('public')
                                    ->directory('pendaftaran/file_akta_lahir')
                                    ->preserveFilenames()
                                    ->loadingIndicatorPosition('right')
                                    ->removeUploadedFileButtonPosition('right')
                                    ->uploadButtonPosition('left')
                                    ->uploadProgressIndicatorPosition('left')->openable()
                                    ->previewable()
                                    ->downloadable(),
                                FileUpload::make('file_surat_nikah')->label('Upload Surat Nikah')
                                    ->disk('public')
                                    ->directory('pendaftaran/file_surat_nikah')
                                    ->preserveFilenames()
                                    ->loadingIndicatorPosition('right')
                                    ->removeUploadedFileButtonPosition('right')
                                    ->uploadButtonPosition('left')
                                    ->uploadProgressIndicatorPosition('left')->openable()
                                    ->previewable()
                                    ->downloadable(),
                                FileUpload::make('file_surat_ijin')->label('Upload Surat Ijin')
                                    ->disk('public')
                                    ->directory('pendaftaran/file_surat_ijin')
                                    ->preserveFilenames()
                                    ->loadingIndicatorPosition('right')
                                    ->removeUploadedFileButtonPosition('right')
                                    ->uploadButtonPosition('left')
                                    ->uploadProgressIndicatorPosition('left')->openable()
                                    ->previewable()
                                    ->downloadable(),
                                FileUpload::make('file_ijazah')->label('Upload Ijazah')
                                    ->disk('public')
                                    ->directory('pendaftaran/file_ijazah')
                                    ->preserveFilenames()
                                    ->loadingIndicatorPosition('right')
                                    ->removeUploadedFileButtonPosition('right')
                                    ->uploadButtonPosition('left')
                                    ->uploadProgressIndicatorPosition('left')->openable()
                                    ->previewable()
                                    ->downloadable(),
                                FileUpload::make('file_tambahan')->label('Upload File Tambahan')
                                    ->disk('public')
                                    ->directory('pendaftaran/file_tambahan')
                                    ->preserveFilenames()
                                    ->loadingIndicatorPosition('right')
                                    ->removeUploadedFileButtonPosition('right')
                                    ->uploadButtonPosition('left')
                                    ->uploadProgressIndicatorPosition('left')->openable()
                                    ->previewable()
                                    ->downloadable(),
                                Section::make('VERIVIKASI DOKUMEN')
                                    ->description('Silahkan Centang Jika Data Lengkap')
                                    ->icon('heroicon-o-check-circle')
                                    ->schema([
                                        Toggle::make('data_lengkap')
                                            ->inline(true),

                                        // Toggle::make('proses')->label('Proses Data PMI')
                                        //     ->inline(true)
                                        //     ->default('1')
                                        //     ->disabled()
                                    ])->columns(2)->collapsible()
                            ])->columns(4)->collapsed(),
                        //----------------------------------------------------------------


                        //----------------------------------------------------------------


                        //----------------------------------------------------------------
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->paginated([9, 25, 50, 100, 'all'])
            ->recordUrl(
                null
            )
            ->columns([
                ImageColumn::make('fotopmi')
                    ->label('FOTO')
                    ->circular()
                    ->size(60)
                    ->extraImgAttributes(['loading' => 'lazy'])
                    ->defaultImageUrl(url('/images/user.svg')),
                // ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('nama')->label('NAMA CPMI')
                    ->weight(FontWeight::Bold)
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500),
                TextColumn::make('nomor_ktp')->label('E-KTP')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500)
                    ->icon('heroicon-m-check-badge'),
                TextColumn::make('Datapmi.Tujuan.nama')->label('TUJUAN')
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('Kantor.nama')->label('KANTOR')->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('Sponsor.nama')->label('SPONSOR-PL')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('Regency.name')->label('KOTA ASAL')
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500),
                // ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('District.name')->label('KECAMATAN')
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500)->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('nomor_telp')->label('NO HP')
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('Datapmi.email_siapkerja')->label('EMAIL')
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500)
                    ->toggleable(isToggledHiddenByDefault: true),
                SelectColumn::make('data_lengkap')->label('PERSYARATAN')
                    ->options([
                        '1' => 'LENGKAP',
                        '0' => 'BELUM',
                    ])
                    // ->toggleable(isToggledHiddenByDefault: true)
                    ->disabled(),
                TextColumn::make('DataPmi.created_at')->label('PROSES')->toggleable(isToggledHiddenByDefault: false),

            ])->defaultSort('created_at', 'desc')
            ->filters([
                DateRangeFilter::make('created_at')
                    ->label('Tanggal Daftar')
                    ->timezone('UTC +7'),

                SelectFilter::make('Kantor')->relationship('Kantor', 'nama'),
                SelectFilter::make('Sponsor')->relationship('Sponsor', 'nama'),
                TernaryFilter::make('data_lengkap'),
                SelectFilter::make('regency_id')->relationship('Regency', 'name')->label('KOTA ASAL')
                    ->multiple()
                    ->optionsLimit(6)
                    ->preload()
                    ->placeholder('Pilih Satu Atau Beberapa'),
                SelectFilter::make('district_id')->relationship('district', 'name')->label('KECAMATAN')
                    ->multiple()
                    ->optionsLimit(6)
                    ->preload()
                    ->placeholder('Pilih Satu Atau Beberapa'),
            ], layout: FiltersLayout::Modal)
            ->filtersTriggerAction(
                fn (Action $action) => $action
                    ->button()
                    ->label('FILTER'),
            )->filtersFormColumns(4)
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->openUrlInNewTab(),
                    Tables\Actions\EditAction::make()->label('Update')->openUrlInNewTab(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            DataPmiRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPendaftarans::route('/'),
            'create' => Pages\CreatePendaftaran::route('/create'),
            'edit' => Pages\EditPendaftaran::route('/{record}/edit'),
            'view' => Pages\ViewPendaftaran::route('/{record}'),
        ];
    }
    public function getFooter(): ?View
    {
        return view('filament.settings.custom-footer');
    }
}
