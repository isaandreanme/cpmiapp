<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DataPmiResource\Pages;
use App\Filament\Resources\DataPmiResource\RelationManagers;
use App\Filament\Resources\DataPmiResource\RelationManagers\PendaftaranRelationManager;
use App\Models\DataPmi;
use App\Models\Pendaftaran;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Filament\Tables\Actions\Action;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use Filament\Forms\Components\Fieldset as ComponentsFieldset;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\Grid as ComponentsGrid;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section as ComponentsSection;
use Filament\Infolists\Components\Split as ComponentsSplit;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;



class DataPmiResource extends Resource
{
    protected static ?string $model = DataPmi::class;

    protected static ?string $navigationIcon = 'heroicon-m-clipboard-document-list';
    // protected static ?string $activeNavigationIcon = 'heroicon-m-cursor-arrow-ripple';
    // protected static ?string $navigationGroup = 'CPMI';
    protected static ?string $navigationLabel = 'DATA PMI';
    // public static function getNavigationBadge(): ?string
    // {
    //     return static::getModel()::count();
    // }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('PENDAFTARAN')
                    ->description('Data Pendaftaran')
                    ->icon('heroicon-m-check-badge')
                    ->schema([
                        Select::make('pendaftaran_id',)
                            ->relationship('Pendaftaran', 'nama')
                            ->getOptionLabelFromRecordUsing(fn (Pendaftaran $record) => "{$record->nama}")
                            ->label('Nama')
                            ->disabled(),
                        Select::make('pendaftaran_id',)
                            ->relationship('Pendaftaran', 'nomor_ktp')
                            ->getOptionLabelFromRecordUsing(fn (Pendaftaran $record) => "{$record->nomor_ktp}")
                            ->label('E-KTP')
                            ->disabled(),
                    ])->columns(2),
                Section::make('AKUN SIAP KERJA')
                    ->description('Silahkan Input Akun SiapKerja')
                    ->icon('heroicon-o-briefcase')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                ComponentsFieldset::make('')
                                    ->schema([
                                        Toggle::make('siapkerja')
                                            ->label('Terdaftar SiapKerja')
                                            ->inline(true),
                                        Toggle::make('verdata')->label('Verifikasi SiapKerja')
                                            ->inline(true),
                                        Toggle::make('verpp')->label('Verifikasi PP')
                                            ->inline(true),
                                    ])->columns(3),
                                DatePicker::make('tglsiapkerja')
                                    ->label('Tanggal SiapKerja')
                                    ->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y'),

                                TextInput::make('telp_siapkerja')
                                    ->label('Nomor Telp Akun SiapKerja')
                                    ->placeholder('Contoh. 081xxxx')
                                    ->numeric()
                                    ->minLength(6)
                                    ->maxLength(13),
                                TextInput::make('email_siapkerja')
                                    ->label('Email  Akun SiapKerja')
                                    ->placeholder('Contoh. mario@gmail.com')
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),
                                TextInput::make('password_siapkerja')
                                    ->label('Password Akun SiapKerja')
                                    ->placeholder('Password Akun SiapKerja')
                                    ->maxLength(255),
                                TextInput::make('no_id_pmi')
                                    ->placeholder('Masukan NO ID CPMI')
                                    ->label('ID SISKO BP2MI'),
                                FileUpload::make('file_pp')->disk('public')->label('Perjanjian Penempatan')
                                    ->directory('datapmi/file_pp')
                                    ->loadingIndicatorPosition('right')
                                    ->removeUploadedFileButtonPosition('right')
                                    ->uploadButtonPosition('left')
                                    ->uploadProgressIndicatorPosition('left')
                                    ->openable()
                                    ->previewable()
                                    ->downloadable(),



                            ]),
                    ])->columns(2)->collapsed(),

                // ----------------------------------------------------------------BATAS

                Section::make('INPUT DATA')
                    ->description('Input Proses Data PMI')
                    ->icon('heroicon-o-check-circle')
                    ->schema([
                        Select::make('status_id',)
                            ->relationship('Status', 'nama')
                            ->required()
                            ->placeholder('Pilih Status CPMI')
                            ->label('Status CPMI'),
                        Select::make('pendaftaran_id',)
                            ->relationship('Pendaftaran', 'nama')
                            ->getOptionLabelFromRecordUsing(fn (Pendaftaran $record) => "{$record->nama} No.eKTP {$record->nomor_ktp}")
                            ->searchable()
                            ->required()
                            ->optionsLimit(25)
                            ->placeholder('Ketik Nama TKW/CPMI')
                            ->disabled()
                            ->label('Cari TKW/CPMI'),
                        Select::make('kantor_id',)
                            ->relationship('Kantor', 'nama')
                            ->required()
                            ->placeholder('Pilih Kantor Cabang')
                            ->label('Kantor Cabang'),
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
                        Select::make('sponsor_id',)
                            ->relationship('Sponsor', 'nama')
                            ->placeholder('Pilih SPONSOR PL')
                            ->searchable()
                            ->required()
                            ->optionsLimit(10)
                            ->label('SPONSOR PL')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('nama')->unique()
                            ])
                            ->required(),
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
                    ])->columns(2)->collapsed(),

                // ----------------------------------------------------------------BATAS
                Section::make('INPUT STATUS')
                    ->description('Input StatusProses Data PMI')
                    ->icon('heroicon-o-check-circle')
                    ->schema([
                        Tabs::make('INPUT DATA')
                            ->tabs([
                                Tabs\Tab::make('PRA - PASPORT')
                                    ->icon('heroicon-o-check-circle')
                                    ->schema([
                                        Grid::make(4)
                                            ->schema([
                                                ComponentsFieldset::make('')
                                                    ->schema([
                                                        Toggle::make('medical_check')
                                                            ->label('Medical Check (Wajib di Centang)')
                                                            ->inline(false),
                                                        Toggle::make('fit')
                                                            ->label('FIT')
                                                            ->inline(false),
                                                        TextInput::make('pra_medical')->placeholder('Keterangan')->label('Pra Medical'),
                                                        DatePicker::make('tanggal_pra_medical')->label('Tanggal Pra Medical')->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y'),
                                                    ])->columns(4),
                                                ComponentsFieldset::make('')
                                                    ->schema([
                                                        Toggle::make('ujk')->label('UJK CPMI')->inline(false),
                                                        DatePicker::make('tanggal_ujk')->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y')->label('Tanggal UJK CPMI'),
                                                        FileUpload::make('file_ujk')->disk('public')->label('Upload File')
                                                            ->directory('datapmi/file_ujk')
                                                            ->preserveFilenames()
                                                            ->openable()
                                                            ->previewable()
                                                            ->downloadable()
                                                            ->loadingIndicatorPosition('right')
                                                            ->removeUploadedFileButtonPosition('right')
                                                            ->uploadButtonPosition('left')
                                                            ->uploadProgressIndicatorPosition('left'),
                                                    ])->columns(3),

                                                ComponentsFieldset::make('')
                                                    ->schema([
                                                        Toggle::make('job')
                                                            ->label('GET JOB')
                                                            ->inline(false),
                                                        DatePicker::make('tanggal_job')->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y')->label('Tanggal JOB'),
                                                        // Select::make('agency_id',)
                                                        //     ->relationship('Agency', 'agency')
                                                        //     ->required()
                                                        //     ->placeholder('Pilih Agency')
                                                        //     ->label('Agency'),
                                                        // FileUpload::make('file_job')->disk('public')->label('Upload File')
                                                        //         ->directory('datapmi/file_job')
                                                        //         ->preserveFilenames()
                                                        //         ->enableDownload()
                                                        //         ->enableOpen()
                                                        //         ->enableReordering()
                                                        //         ->loadingIndicatorPosition('right')
                                                        //         ->removeUploadedFileButtonPosition('right')
                                                        //         ->uploadButtonPosition('left')
                                                        //         ->uploadProgressIndicatorPosition('left'),
                                                    ])->columns(2),
                                                ComponentsFieldset::make('')
                                                    ->schema([
                                                        Toggle::make('validasi_paspor')->inline(false)->label('Validasi Paspor'),
                                                        DatePicker::make('tanggal_validasi_paspor')->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y')->label('Tanggal Validasi Paspor'),
                                                        FileUpload::make('file_validasi_paspor')->disk('public')->label('Upload File')
                                                            ->directory('datapmi/file_validasi_paspor')
                                                            ->preserveFilenames()
                                                            ->openable()
                                                            ->previewable()
                                                            ->downloadable()
                                                            ->loadingIndicatorPosition('right')
                                                            ->removeUploadedFileButtonPosition('right')
                                                            ->uploadButtonPosition('left')
                                                            ->uploadProgressIndicatorPosition('left'),
                                                    ])->columns(3),
                                            ])
                                    ]),

                                // ----------------------------------------------------------------BATAS

                                Tabs\Tab::make('PRA BPJS - EC')
                                    ->icon('heroicon-o-check-circle')
                                    ->schema([
                                        Grid::make(3)
                                            ->schema([

                                                ComponentsFieldset::make('')
                                                    ->schema([
                                                        Toggle::make('pra_bpjs')->inline(false)->label('PRA BPJS'),
                                                        DatePicker::make('tanggal_pra_bpjs')->label('Tanggal PRA BPJS')->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y'),
                                                        FileUpload::make('file_pra_bpjs')->disk('public')->label('Upload File')
                                                            ->directory('datapmi/file_pra_bpjs')
                                                            ->preserveFilenames()
                                                            ->openable()
                                                            ->previewable()
                                                            ->downloadable()
                                                            ->loadingIndicatorPosition('right')
                                                            ->removeUploadedFileButtonPosition('right')
                                                            ->uploadButtonPosition('left')
                                                            ->uploadProgressIndicatorPosition('left'),
                                                    ])->columns(3),

                                                ComponentsFieldset::make('')
                                                    ->schema([
                                                        Toggle::make('medical_full')->inline(false)->label('Medical Full'),
                                                        DatePicker::make('tanggal_medical_full')->label('Tanggal Medical Full')->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y'),
                                                        FileUpload::make('file_medical_full')->disk('public')->label('Upload File')
                                                            ->directory('datapmi/file_medical_full')
                                                            ->preserveFilenames()
                                                            ->openable()
                                                            ->previewable()
                                                            ->downloadable()
                                                            ->loadingIndicatorPosition('right')
                                                            ->removeUploadedFileButtonPosition('right')
                                                            ->uploadButtonPosition('left')
                                                            ->uploadProgressIndicatorPosition('left'),
                                                    ])->columns(3),
                                                ComponentsFieldset::make('')
                                                    ->schema([
                                                        Toggle::make('ec')->inline(false)->label('EC'),
                                                        DatePicker::make('tanggal_ec')->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y')->label('Tanggal EC'),
                                                        FileUpload::make('file_ec')->disk('public')->label('Upload File')
                                                            ->directory('datapmi/file_ec')
                                                            ->preserveFilenames()
                                                            ->openable()
                                                            ->previewable()
                                                            ->downloadable()
                                                            ->loadingIndicatorPosition('right')
                                                            ->removeUploadedFileButtonPosition('right')
                                                            ->uploadButtonPosition('left')
                                                            ->uploadProgressIndicatorPosition('left'),
                                                    ])->columns(3),
                                            ])
                                    ]),

                                // ----------------------------------------------------------------BATAS

                                Tabs\Tab::make('VISA - KTKLN')
                                    ->icon('heroicon-o-check-circle')
                                    ->schema([
                                        Grid::make(3)
                                            ->schema([
                                                ComponentsFieldset::make('')
                                                    ->schema([
                                                        Toggle::make('visa')->inline(false)->label('VISA'),
                                                        DatePicker::make('tanggal_visa')->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y')->label('Tanggal VISA'),
                                                        FileUpload::make('file_visa')->disk('public')->label('Upload File')
                                                            ->directory('datapmi/file_visa')
                                                            ->preserveFilenames()
                                                            ->openable()
                                                            ->previewable()
                                                            ->downloadable()
                                                            ->loadingIndicatorPosition('right')
                                                            ->removeUploadedFileButtonPosition('right')
                                                            ->uploadButtonPosition('left')
                                                            ->uploadProgressIndicatorPosition('left'),
                                                    ])->columns(3),



                                                ComponentsFieldset::make('')
                                                    ->schema([
                                                        Toggle::make('bpjs_purna')->inline(false)->label('BPJS Purna'),
                                                        DatePicker::make('tanggal_bpjs_purna')->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y')->label('Tanggal BPJS Purna'),
                                                        FileUpload::make('file_bpjs_purna')->disk('public')->label('Upload File')
                                                            ->directory('datapmi/file_bpjs_purna')
                                                            ->preserveFilenames()
                                                            ->openable()
                                                            ->previewable()
                                                            ->downloadable()
                                                            ->loadingIndicatorPosition('right')
                                                            ->removeUploadedFileButtonPosition('right')
                                                            ->uploadButtonPosition('left')
                                                            ->uploadProgressIndicatorPosition('left'),
                                                    ])->columns(3),
                                                ComponentsFieldset::make('')
                                                    ->schema([
                                                        Toggle::make('ktkln')->inline(false)->label('KTKLN'),
                                                        DatePicker::make('tanggal_ktkln')->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y')->label('Tanggal KTKLN'),
                                                        FileUpload::make('file_ktkln')->disk('public')->label('Upload File')
                                                            ->directory('datapmi/file_ktkln')
                                                            ->preserveFilenames()
                                                            ->openable()
                                                            ->previewable()
                                                            ->downloadable()
                                                            ->loadingIndicatorPosition('right')
                                                            ->removeUploadedFileButtonPosition('right')
                                                            ->uploadButtonPosition('left')
                                                            ->uploadProgressIndicatorPosition('left'),
                                                    ])->columns(3),
                                            ])
                                    ]),

                                // ----------------------------------------------------------------BATAS

                                Tabs\Tab::make('PENERBANGAN - INVOICE')
                                    ->icon('heroicon-o-check-circle')
                                    ->schema([
                                        Grid::make(3)
                                            ->schema([
                                                ComponentsFieldset::make('')
                                                    ->schema([
                                                        Toggle::make('terbang')->inline(false)->label('Tebang/FLY'),
                                                        DatePicker::make('tanggal_terbang')->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y')->label('Tanggal Tebang/FLY'),
                                                        FileUpload::make('file_terbang')->disk('public')->label('Upload File')
                                                            ->directory('datapmi/file_terbang')
                                                            ->preserveFilenames()
                                                            ->openable()
                                                            ->previewable()
                                                            ->downloadable()
                                                            ->loadingIndicatorPosition('right')
                                                            ->removeUploadedFileButtonPosition('right')
                                                            ->uploadButtonPosition('left')
                                                            ->uploadProgressIndicatorPosition('left'),
                                                    ])->columns(3),
                                                ComponentsFieldset::make('')
                                                    ->schema([
                                                        Toggle::make('invoice_toyo')->inline(false)->label('Invoice Toyo'),
                                                        DatePicker::make('tanggal_invoice_toyo')->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y')->label('Tanggal Invoice Toyo'),
                                                        FileUpload::make('file_invoice_toyo')->disk('public')->label('Upload File')
                                                            ->directory('datapmi/file_invoice_toyo')
                                                            ->preserveFilenames()
                                                            ->openable()
                                                            ->previewable()
                                                            ->downloadable()
                                                            ->loadingIndicatorPosition('right')
                                                            ->removeUploadedFileButtonPosition('right')
                                                            ->uploadButtonPosition('left')
                                                            ->uploadProgressIndicatorPosition('left'),
                                                    ])->columns(3),
                                                ComponentsFieldset::make('')
                                                    ->schema([
                                                        Toggle::make('invoice_agency')->inline(false)->label('Invoice Agency'),
                                                        DatePicker::make('tanggal_invoice_agency')->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y')->label('Tanggl Invoice Agency'),
                                                        FileUpload::make('file_invoice_agency')->disk('public')->label('Upload File')
                                                            ->directory('datapmi/file_invoice_agency')
                                                            ->preserveFilenames()
                                                            ->openable()
                                                            ->previewable()
                                                            ->downloadable()
                                                            ->loadingIndicatorPosition('right')
                                                            ->removeUploadedFileButtonPosition('right')
                                                            ->uploadButtonPosition('left')
                                                            ->uploadProgressIndicatorPosition('left'),
                                                    ])->columns(3),
                                            ])
                                    ])
                            ])
                    ])->columns(1)->collapsed(),
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
                ImageColumn::make('Pendaftaran.fotopmi')
                    ->label('FOTO')
                    ->circular()
                    ->size(60)
                    ->extraImgAttributes(['loading' => 'lazy'])
                    ->defaultImageUrl(url('/images/user.svg'))
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('Pendaftaran.nama')->label('CPMI')->weight('bold')->searchable()
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500),
                TextColumn::make('Pendaftaran.nomor_ktp')->label('E-KTP')->color('primary')
                    ->copyable()
                    ->searchable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500),
                TextColumn::make('Tujuan.nama')->label('NEGARA')->color('primary')
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500)->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('kantor.nama')->label('KANTOR')->color('warning')
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500)->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('Pendaftaran.regency.name')->label('KOTA ASAL')
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500)->toggleable(isToggledHiddenByDefault: false),
                // SelectColumn::make('status_id')->label('STATUS')
                //     ->options([
                //         '1' => 'BARU',
                //         '2' => 'ON PROSES',
                //         '3' => 'TERBANG',
                //         '4' => 'FINISH',
                //         '5' => 'PENDING',
                //         '6' => 'MD',
                //         '22' => 'UNFIT',
                //     ])->disabled(),
                TextColumn::make('Status.nama')->label('STATUS')->color('primary')
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500),
                    // ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('Pendaftaran.created_at')->label('TGL DAFTAR')->color('warning')
                    ->date()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500)->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')->label('LAMA PROSES')->color('warning')
                    ->since()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500)->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('tanggal_terbang')->label('TERBANG')
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500)->toggleable(isToggledHiddenByDefault: true),
                SelectColumn::make('medical_check')
                    ->options([
                        '1' => 'YA',
                        '0' => 'BELUM',
                    ])->disabled()
                    ->label('PRA MEDICAL')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('tanggal_pra_medical')->label('TGL MCU')
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500)->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('job')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->label('JOB')->toggleable(isToggledHiddenByDefault: false)->disabled(),
                TextColumn::make('tanggal_job')->label('TGL JOB')
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500)->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('Marketing.nama')->label('MARKETING')->color('primary')
                    ->copyable()
                    ->searchable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500)->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('Agency.nama')->label('AGENCY')->color('primary')
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500)->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('Pengalaman.nama')->label('PENGALAMAN')->color('primary')
                    ->copyable()
                    ->searchable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500)->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('tanggal_ujk')->label('TGL UJK')
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500)->toggleable(isToggledHiddenByDefault: true),
                SelectColumn::make('siapkerja')
                    ->options([
                        '1' => 'YA',
                        '0' => 'BELUM',
                    ])->disabled()
                    ->label('SIAP KERJA')->toggleable(isToggledHiddenByDefault: true),
                SelectColumn::make('verpp')
                    ->options([
                        '1' => 'YA',
                        '0' => 'BELUM',
                    ])->disabled()
                    ->label('ID SIAPKERJA')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('Pendaftaran.nomor_telp')->label('NO TELP')->weight('bold')->searchable()
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500)->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('telp_siapkerja')->label('NO TELP SIAPKERJA')->weight('bold')->searchable()
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500)->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('Pendaftaran.nama_wali')->label('NAMA WALI')->weight('bold')->searchable()
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500)->toggleable(isToggledHiddenByDefault: true),

                // TextColumn::make('Sponsor.nama')->label('SPONSOR PL'),
                // TextColumn::make('tanggal_pra_medical')->label('PRA MEDICAL'),
                // TextColumn::make('pendaftaran_id')->searchable()->alignment('left')->label('ID PENDAFTARAN'),
                // TextColumn::make('pra_medical')->label('HASIL')->sortable()->limit(7),
                // TextColumn::make('tanggal_ujk')->sortable()->alignment('left')->label('UJK'),
                // TextColumn::make('tanggal_job')->label('TGL JOB'),
                // TextColumn::make('no_id_pmi')->label('ID PMI')->prefix('ID PMI : ')->weight('bold'),
                // TextColumn::make('tanggal_validasi_paspor')->label('PASPOR')->prefix('TANGGAL VAL-PASPOR : '),
                // TextColumn::make('tanggal_pra_bpjs')->label('PRA BPJS')->prefix('TANGGAL PRA BPJS : '),
                // TextColumn::make('tanggal_medical_full')->label('MEDICAL FULL')->prefix('TANGGAL MEDICAL FULL : '),
                // TextColumn::make('tanggal_ec')->label('EC')->prefix('TANGGAL EC : '),
                // TextColumn::make('tanggal_visa')->label('VISA')->prefix('TANGGAL VISA : '),
                // TextColumn::make('tanggal_bpjs_purna')->label('BPJS PURNA')->prefix('TANGGAL BPJS PURNA : '),
                // TextColumn::make('tanggal_ktkln')->label('KTKLN')->prefix('TANGGAL KTKLN : '),
                // TextColumn::make('tanggal_terbang')->label('PENERBANGAN')->prefix('TANGGAL PENERBANGAN : '),
                // TextColumn::make('tanggal_invoice_toyo')->label('INV TOYO')->prefix('TANGGAL INV TOYO : '),
                // TextColumn::make('tanggal_invoice_agency')->label('INV AGENCY')->prefix('TANGGAL INV AGENCY : '),
                // TextColumn::make('id')->searchable()->alignment('left')->label('NOMOR DATA PMI')->prefix('NOMOR DATA PMI : '),
            ])->defaultSort('updated_at', 'desc')

            ->filters([
                DateRangeFilter::make('created_at')
                    ->label('PENDAFTARAN')
                    ->timezone('UTC +7'),

                DateRangeFilter::make('tanggal_pra_medical')
                    ->label('TANGGAL PRA MEDICAL')
                    ->timezone('UTC +7'),

                DateRangeFilter::make('tanggal_ujk')
                    ->label('TANGGAL UJK')
                    ->timezone('UTC +7'),

                DateRangeFilter::make('tglsiapkerja')
                    ->label('TANGGAL SIAPKERJA')
                    ->timezone('UTC +7'),

                DateRangeFilter::make('tanggal_job')
                    ->label('TANGGAL JOB')
                    ->timezone('UTC +7'),

                DateRangeFilter::make('tanggal_terbang')
                    ->label('TANGGAL PENERBANGAN')
                    ->timezone('UTC +7'),

                // -------------------------------------BATAS
                SelectFilter::make('Status')->relationship('Status', 'nama')->label('STATUS')
                    ->multiple()
                    ->optionsLimit(6)
                    ->preload()
                    ->placeholder('Pilih Satu Atau Beberapa'),
                SelectFilter::make('Kantor')->relationship('Kantor', 'nama')->label('KANTOR'),
                SelectFilter::make('Tujuan')->relationship('Tujuan', 'nama')->label('NEGARA'),
                SelectFilter::make('Agency')->relationship('Agency', 'nama')->label('AGENCY'),
                SelectFilter::make('Sponsor')->relationship('Sponsor', 'nama')->label('SPONSOR PL')
                    ->preload()
                    ->searchable()
                    ->optionsLimit(10),
                SelectFilter::make('Pengalaman')->relationship('Pengalaman', 'nama')->label('PENGALAMAN')
                    ->multiple()
                    ->optionsLimit(6)
                    ->preload()
                    ->placeholder('Pilih Satu Atau Beberapa'),
                TernaryFilter::make('data_lengkap')
                    ->label('SYARAT')
                    ->relationship('Pendaftaran', 'data_lengkap'),
                TernaryFilter::make('siapkerja')->label('TERDAFTAR SIAPKERJA'),
                TernaryFilter::make('medical_check')->label('MEDICAL'),
                TernaryFilter::make('fit')->label('FIT'),
                TernaryFilter::make('ujk')->label('UJK'),
                TernaryFilter::make('job')->label('DAPAT JOB'),
                TernaryFilter::make('verpp')->label('VER PP /ID SIAPKERJA'),
                TernaryFilter::make('validasi_paspor')->label('PASPOR'),
                TernaryFilter::make('pra_bpjs')->label('PRA BPSJ'),
                TernaryFilter::make('medical_full')->label('MEDICAL FULL'),
                TernaryFilter::make('ec')->label('EC'),
                TernaryFilter::make('visa')->label('VISA'),
                TernaryFilter::make('bpjs_purna')->label('BPJS PURNA'),
                TernaryFilter::make('ktkln')->label('KTKLN'),
                TernaryFilter::make('terbang')->label('PENERBANGAN'),
                TernaryFilter::make('invoice_toyo')->label('INV TOYO'),
                TernaryFilter::make('invoice_agency')->label('INV AGENCY'),
                // SelectFilter::make('Pengalaman')->relationship('Pengalaman', 'nama')->label('PENGALAMAN'),
            ], layout: FiltersLayout::Modal)
            ->filtersTriggerAction(
                fn (Action $action) => $action
                    ->button()
                    ->label('FILTER'),
            )->filtersFormColumns(4)


            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->label('Update')
                        ->color('primary')
                        ->openUrlInNewTab(),
                    Tables\Actions\ViewAction::make()->label('View Detail')->icon('heroicon-o-identification')->color('success')
                        ->openUrlInNewTab(),
                    Action::make('Download Pdf')
                        ->label('Cetak')
                        ->icon('heroicon-o-printer')
                        ->url(fn (DataPmi $record) => route('datapmi.pdf.download', $record))
                        ->openUrlInNewTab(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),

                    ExportBulkAction::make()
                        ->label('Export')
                        ->exports([
                            ExcelExport::make('table')->fromTable()
                                ->withFilename(date('Y-m-d') . ' - Table Data PMI'),
                            ExcelExport::make('form')->fromForm()
                                ->withFilename(date('Y-m-d') . ' - Form Data PMI'),
                        ]),
                    // FilamentExportBulkAction::make('export')
                    //     ->fileName('My File') // Default file name
                    //     ->timeFormat('m y d') // Default time format for naming exports
                    //     ->defaultFormat('pdf') // xlsx, csv or pdf
                    //     ->defaultPageOrientation('landscape') // Page orientation for pdf files. portrait or landscape
                    //     ->disableAdditionalColumns() // Disable additional columns input
                    //     //  ->disableFilterColumns() // Disable filter columns input
                    //     ->disableFileName() // Disable file name input
                    //     ->disableFileNamePrefix() // Disable file name prefix
                    //     //  ->disablePreview() // Disable export preview
                    //     ->fileNameFieldLabel('File Name') // Label for file name input
                    //     ->formatFieldLabel('Format') // Label for format input
                    //     ->pageOrientationFieldLabel('Page Orientation') // Label for page orientation input
                    //     ->filterColumnsFieldLabel('filter columns') // Label for filter columns input
                    //     ->additionalColumnsFieldLabel('Additional Columns') // Label for additional columns input
                    //     ->additionalColumnsTitleFieldLabel('Title') // Label for additional columns' title input
                    //     ->additionalColumnsDefaultValueFieldLabel('Default Value') // Label for additional columns' default value input
                    //     ->additionalColumnsAddButtonLabel('Add Column'), // Label for additional columns' add button
                ]),
            ])
            ->emptyStateActions([
                // Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // PendaftaranRelationManager::class,
        ];
    }



    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDataPmis::route('/'),
            'create' => Pages\CreateDataPmi::route('/create'),
            'edit' => Pages\EditDataPmi::route('/{record}/edit'),
            'view' => Pages\ViewDataPmi::route('/{record}'),
        ];
    }
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                ComponentsGrid::make(1)
                    ->schema([
                        ComponentsSection::make('')
                            // ->description('Data CPMI ')
                            ->schema([
                                ComponentsSplit::make([
                                    ImageEntry::make('Pendaftaran.fotopmi')
                                        ->label('')
                                        ->circular()
                                        ->size(100)
                                        ->extraImgAttributes(['loading' => 'lazy'])
                                        ->defaultImageUrl(url('/images/user.svg'))
                                        ->tooltip('Untuk Melihat Gambar Ukuran Penuh, Silahkan Klik Kanan (Open New Tab) / Kilk Kanan (Save Image)'),
                                ]),
                                ComponentsSplit::make([
                                    Fieldset::make('PENDAFTARAN')
                                        ->schema([
                                            TextEntry::make('Pendaftaran.created_at')->label('Tanggal Daftar'),
                                            TextEntry::make('kantor.nama')->label('Kantor'),
                                            TextEntry::make('sponsor.nama')->label('Sponsor'),
                                            TextEntry::make('tujuan.nama')->label('Tujuan'),
                                            TextEntry::make('status.nama')->label('Status')->color('success'),
                                        ])->columns(5)->grow()
                                ])
                            ]),
                    ]),
                ComponentsGrid::make(2)
                    ->schema([
                        //----------------------------------------------------------------
                        ComponentsSplit::make([
                            ComponentsSection::make('')
                                // ->description('Data CPMI ')
                                ->schema([
                                    ComponentsGrid::make(2)
                                        ->schema([
                                            Fieldset::make('DATA PMI')
                                                ->schema([
                                                    TextEntry::make('pendaftaran.nama')->label('Nama')
                                                        ->copyable()
                                                        ->copyMessage('Salin Berhasil')
                                                        ->copyMessageDuration(1500),
                                                    TextEntry::make('pendaftaran.nomor_ktp')->label('E-KTP')
                                                        ->copyable()
                                                        ->copyMessage('Salin Berhasil')
                                                        ->copyMessageDuration(1500),
                                                    TextEntry::make('pendaftaran.nomor_telp')->label('Nomor Telp'),

                                                ]),
                                            Fieldset::make('DOMISILI')
                                                ->schema([
                                                    TextEntry::make('pendaftaran.alamat')->label('Alamat'),
                                                    TextEntry::make('pendaftaran.rtrw')->label('RT / RW'),
                                                    TextEntry::make('Pendaftaran.village.name')->label('Kelurahan'),
                                                    TextEntry::make('Pendaftaran.district.name')->label('Kecamatan'),
                                                    TextEntry::make('Pendaftaran.regency.name')->label('Kota/Kabupaten'),
                                                    TextEntry::make('Pendaftaran.province.name')->label('Provinsi'),
                                                ])->columns(2)
                                        ])
                                ])
                        ]),
                        ComponentsSplit::make([
                            ComponentsSection::make('')
                                // ->description('Data CPMI ')
                                ->schema([
                                    ComponentsGrid::make(2)
                                        ->schema([
                                            Fieldset::make('BIODATA')
                                                ->schema([
                                                    TextEntry::make('Pendaftaran.regency.name')->label('Tempat Lahir'),
                                                    TextEntry::make('pendaftaran.tgllahir')->label('Tanggal Lahir'),
                                                    TextEntry::make('pendaftaran.tinggibadan')->label('Berat Badan')->suffix(' Kg'),
                                                    TextEntry::make('pendaftaran.beratbadan')->label('Tinggi Badan')->suffix(' Cm'),
                                                    TextEntry::make('pengalaman.nama')->label('Pengalaman'),
                                                ]),
                                            Fieldset::make('DATA KELUARGA')
                                                ->schema([
                                                    TextEntry::make('pendaftaran.nama_wali')->label('Nama'),
                                                    TextEntry::make('pendaftaran.nomor_ktp_wali')->label('E-KTP'),
                                                    TextEntry::make('pendaftaran.nomor_kk')->label('Nomor KK'),
                                                    TextEntry::make('pendaftaran.nomor_telp_wali')->label('Nomor Telp'),

                                                ])
                                        ])
                                ])
                        ]),
                        //----------------------------------------------------------------
                    ]),
                ComponentsSection::make('PROSES CPMI')
                    // ->description('Data CPMI ')
                    ->schema([
                        ComponentsGrid::make(2)
                            ->schema([
                                Fieldset::make('SIAP KERJA')
                                    ->schema([
                                        // TextEntry::make('siapkerja')->label('Siap Kerja'),
                                        // TextEntry::make('verpp')->label('Verifikasi PP'),
                                        IconEntry::make('pendaftaran.data_lengkap')->label('Dokumen')
                                            ->boolean()
                                            ->trueIcon('heroicon-o-check-badge')
                                            ->falseIcon('heroicon-o-x-mark')
                                            ->trueColor('success')
                                            ->falseColor('warning'),
                                        TextEntry::make('tglsiapkerja')->label('Tanggal'),
                                        TextEntry::make('email_siapkerja')->label('Email'),
                                        TextEntry::make('telp_siapkerja')->label('Telp'),
                                        TextEntry::make('password_siapkerja')->label('Password'),
                                        TextEntry::make('no_id_pmi')->label('ID PMI'),
                                    ])->columns(3),
                                Fieldset::make('MEDICAL')
                                    ->schema([
                                        IconEntry::make('medical_check')->label('Status')
                                            ->boolean()
                                            ->trueIcon('heroicon-o-check-badge')
                                            ->falseIcon('heroicon-o-x-mark')
                                            ->trueColor('success')
                                            ->falseColor('warning'),
                                        TextEntry::make('tanggal_pra_medical')->label('Tanggal')->date(),
                                        TextEntry::make('pra_medical')->label('Hasil Medical'),
                                    ])->columns(3),
                                Fieldset::make('JOB')
                                    ->schema([
                                        IconEntry::make('job')->label('Status')
                                            ->boolean()
                                            ->trueIcon('heroicon-o-check-badge')
                                            ->falseIcon('heroicon-o-x-mark')
                                            ->trueColor('success')
                                            ->falseColor('warning'),
                                        TextEntry::make('tanggal_job')->label('Tanggal')->date(),
                                        TextEntry::make('Agency.nama')->label('Agency'),
                                    ])->columns(3),
                                Fieldset::make('PASPOR')
                                    ->schema([
                                        IconEntry::make('validasi_paspor')->label('Status')
                                            ->boolean()
                                            ->trueIcon('heroicon-o-check-badge')
                                            ->falseIcon('heroicon-o-x-mark')
                                            ->trueColor('success')
                                            ->falseColor('warning'),
                                        TextEntry::make('tanggal_validasi_paspor')->label('Tanggal')->date(),
                                    ])->columns(2),
                                Fieldset::make('PRA BPJS')
                                    ->schema([
                                        IconEntry::make('pra_bpjs')->label('Status')
                                            ->boolean()
                                            ->trueIcon('heroicon-o-check-badge')
                                            ->falseIcon('heroicon-o-x-mark')
                                            ->trueColor('success')
                                            ->falseColor('warning'),
                                        TextEntry::make('tanggal_validasi_paspor')->label('Tanggal')->date(),
                                    ])->columns(2),
                                Fieldset::make('MEDICAL FULL')
                                    ->schema([
                                        IconEntry::make('medical_full')->label('Status')
                                            ->boolean()
                                            ->trueIcon('heroicon-o-check-badge')
                                            ->falseIcon('heroicon-o-x-mark')
                                            ->trueColor('success')
                                            ->falseColor('warning'),
                                        TextEntry::make('tanggal_medical_full')->label('Tanggal')->date(),
                                    ])->columns(2),
                                Fieldset::make('EC')
                                    ->schema([
                                        IconEntry::make('ec')->label('Status')
                                            ->boolean()
                                            ->trueIcon('heroicon-o-check-badge')
                                            ->falseIcon('heroicon-o-x-mark')
                                            ->trueColor('success')
                                            ->falseColor('warning'),
                                        TextEntry::make('tanggal_ec')->label('Tanggal')->date(),
                                    ])->columns(2),
                                Fieldset::make('VISA')
                                    ->schema([
                                        IconEntry::make('visa')->label('Status')
                                            ->boolean()
                                            ->trueIcon('heroicon-o-check-badge')
                                            ->falseIcon('heroicon-o-x-mark')
                                            ->trueColor('success')
                                            ->falseColor('warning'),
                                        TextEntry::make('tanggal_visa')->label('Tanggal')->date(),
                                    ])->columns(2),
                                Fieldset::make('BPJS PURNA')
                                    ->schema([
                                        IconEntry::make('bpjs_purna')->label('Status')
                                            ->boolean()
                                            ->trueIcon('heroicon-o-check-badge')
                                            ->falseIcon('heroicon-o-x-mark')
                                            ->trueColor('success')
                                            ->falseColor('warning'),
                                        TextEntry::make('tanggal_bpjs_purna')->label('Tanggal')->date(),
                                    ])->columns(2),
                                Fieldset::make('KTKLN')
                                    ->schema([
                                        IconEntry::make('ktkln')->label('Status')
                                            ->boolean()
                                            ->trueIcon('heroicon-o-check-badge')
                                            ->falseIcon('heroicon-o-x-mark')
                                            ->trueColor('success')
                                            ->falseColor('warning'),
                                        TextEntry::make('tanggal_ktkln')->label('Tanggal')->date(),
                                    ])->columns(2),
                                Fieldset::make('PENERBANGAN')
                                    ->schema([
                                        IconEntry::make('terbang')->label('Status')
                                            ->boolean()
                                            ->trueIcon('heroicon-o-check-badge')
                                            ->falseIcon('heroicon-o-x-mark')
                                            ->trueColor('success')
                                            ->falseColor('warning'),
                                        TextEntry::make('tanggal_terbang')->label('Tanggal')->date(),
                                    ])->columns(2),
                                Fieldset::make('INV TOYO')
                                    ->schema([
                                        IconEntry::make('invoice_toyo')->label('Status')
                                            ->boolean()
                                            ->trueIcon('heroicon-o-check-badge')
                                            ->falseIcon('heroicon-o-x-mark')
                                            ->trueColor('success')
                                            ->falseColor('warning'),
                                        TextEntry::make('tanggal_invoice_toyo')->label('Tanggal')->date(),
                                    ])->columns(2),
                                Fieldset::make('INV AGENCY')
                                    ->schema([
                                        IconEntry::make('invoice_agency')->label('Status')
                                            ->boolean()
                                            ->trueIcon('heroicon-o-check-badge')
                                            ->falseIcon('heroicon-o-x-mark')
                                            ->trueColor('success')
                                            ->falseColor('warning'),
                                        TextEntry::make('tanggal_invoice_agency')->label('Tanggal')->date(),
                                    ])->columns(2),
                            ])
                    ])->collapsed(),
            ]);
    }
}
