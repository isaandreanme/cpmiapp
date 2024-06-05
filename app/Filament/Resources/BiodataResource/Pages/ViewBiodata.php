<?php

namespace App\Filament\Resources\BiodataResource\Pages;

use App\Filament\Resources\BiodataResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section as ComponentsSection;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Actions\Action;


class ViewBiodata extends ViewRecord
{
    protected static string $resource = BiodataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Action::make('Download Pdf')
                ->label('Cetak')
                ->icon('heroicon-o-printer')
                ->url(fn() => route('biodata.pdf'))
                ->openUrlInNewTab(),
        ];
    }
    

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                ComponentsSection::make('APPLICANT’S QUALIFICATION HIGHLIGHTS')
                    ->description('印尼傭工個人資料及工作簡介')
                    ->schema([
                        ComponentsSection::make('')
                            ->description('')
                            ->schema([
                                TextEntry::make('nomor_lamar')->label('Applicant’s No(僱傭編號)'),
                                TextEntry::make('nomor_hp')->label('Phone Number')->prefix('+62 '),
                            ])->columns(2),
                        Split::make([
                            ComponentsSection::make('Details')
                                ->description('')
                                ->schema([
                                    TextEntry::make('nama')->label('Name 姓名'),
                                    TextEntry::make('tempat_lahir')->label('Place of birth 出身地點'),
                                    TextEntry::make('tanggal_lahir')->label('Date of birth 出身日期'),
                                    TextEntry::make('tinggi_badan')->label('Height 身高')->suffix(' Cm'),
                                    TextEntry::make('berat_badan')->label('Weight 體重')->suffix(' Kg'),
                                    TextEntry::make('agama')->label('Religion 宗教'),
                                    TextEntry::make('lulusan')->label('Education 教育'),
                                    TextEntry::make('status_nikah')->label('Marital Status 婚姻狀況'),
                                    TextEntry::make('jumlah_anak')->label('No. of children/Age 子女數目/年齡'),
                                    TextEntry::make('jumlah_saudara')->label('No. of brothers/Sisters 兄妹數目'),
                                    TextEntry::make('anak_ke')->label('I am the in the family 家中排行第'),
                                ])->columns(2),

                            ComponentsSection::make('Finished Contract on')
                                ->description('')
                                ->schema([
                                    TextEntry::make('pengalaman_luarnegeri')->label('Overseas Experience 海外經驗'),
                                    TextEntry::make('ket_pengalaman_luarnegeri')->label('Where 何處'),
                                    TextEntry::make('pengalaman_lokal')->label('Local Experience 印尼本土經驗'),
                                    TextEntry::make('ket_pengalaman_lokal')->label('Where 何處'),
                                    TextEntry::make('housekeeping')->label('Recommended for House Keeping'),
                                    TextEntry::make('babysitting')->label('Recommended for Baby Sitting'),
                                ]),
                        ]),
                        Split::make([
                            ComponentsSection::make('PHOTO')
                                ->description('')
                                ->schema([

                                    ImageEntry::make('foto')
                                        ->label('')
                                        // ->circular()
                                        ->square()
                                        ->width(530)
                                        ->height(700)
                                        ->extraImgAttributes(['loading' => 'lazy']),
                                ]),

                            ComponentsSection::make('SKILLS')
                                ->description('')
                                ->schema([
                                    TextEntry::make('careofbabies')->label('護理嬰兒 Care of Babies'),
                                    TextEntry::make('careofyoung')->label('護理兒童 Care of Young Children'),
                                    TextEntry::make('householdworks')->label('家務 Household Works'),
                                    TextEntry::make('personality')->label('個性表現 Personality'),
                                    TextEntry::make('facialexpression')->label('儀容 Facial Expression'),
                                    TextEntry::make('careofelderly')->label('護理老人 Care of Elderly/Disable'),
                                    TextEntry::make('cooking')->label('烹飪 Cooking'),
                                    TextEntry::make('housmaid')->label('女傭經驗 Exp. In Housemaid'),
                                    TextEntry::make('spokenenglish')->label('能操英語 Spoken English'),
                                    TextEntry::make('spokencantonese')->label('能操廣東話 Spoken Cantonese'),
                                    TextEntry::make('spokenmandarin')->label('能操國語 Spoken Mandarin'),
                                ])->columns(2),

                        ]),
                        ComponentsSection::make('PREVIOUS EMPLOYMENT HISTORY 以往僱員工作紀錄')
                            ->description('')
                            ->schema([
                                RepeatableEntry::make('pengalaman')
                                    ->schema([
                                        TextEntry::make('nama_majikan')
                                            ->label('Name of Employer 前僱主名稱'),
                                        TextEntry::make('alamat_majikan')
                                            ->label('Location of Employer 前僱主地'),
                                        TextEntry::make('tahun_mulai')
                                            ->label('From 由'),
                                        TextEntry::make('tahun_selesai')
                                            ->label('To 由'),
                                        TextEntry::make('gaji')
                                            ->label('Salary 薪金 '),
                                        TextEntry::make('alasan_selesai')
                                            ->label('Reason of Leave 離'),
                                        TextEntry::make('keterangan')
                                            ->label('Description of job 工作性質'),
                                    ])
                                    ->label('')
                                    ->columns(2),
                            ]),

                        ComponentsSection::make('HUSBAN')
                            ->description('')
                            ->schema([
                                TextEntry::make('nama_suami')
                                    ->label('Name of Spouse 配偶姓名/husband'),
                                TextEntry::make('usia_suami')
                                    ->label('Age 年齡')
                                    ->suffix(' (YO)'),
                                TextEntry::make('pekerjaan_suami')
                                    ->label('Spouse’s Occupation 配偶職業'),
                                TextEntry::make('anakke_suami')
                                    ->label('No. of Children 子女數'),
                            ])->columns(2),
                        ComponentsSection::make('PARENT')
                            ->description('')
                            ->schema([
                                TextEntry::make('nama_ayah')
                                    ->label('Name of Father/Occupation 父親姓名/職業'),
                                TextEntry::make('usia_ayah')->suffix(' (YO)')->label('Age 年齡'),
                                TextEntry::make('nama_ibu')
                                    ->label('Name of Mother/Occupation母親姓'),
                                TextEntry::make('usia_ibu')->suffix(' (YO)')->label('Age 年齡'),
                                TextEntry::make('alamat_ortu')->label('ADDRESS'),
                            ])->columns(2),
                        ComponentsSection::make('SHE HAS WORKING EXPERIENCE')
                            ->description('')
                            ->schema([
                                RepeatableEntry::make('pengalaman')
                                    ->schema([
                                        TextEntry::make('keterangan')
                                            ->label(''),
                                    ])
                                    ->label('')
                                    ->columns(2),
                            ]),
                    ])->compact(),

            ]);
    }
}
