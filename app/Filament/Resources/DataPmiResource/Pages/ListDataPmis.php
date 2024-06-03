<?php

namespace App\Filament\Resources\DataPmiResource\Pages;

use App\Filament\Resources\DataPmiResource;
use App\Filament\Resources\DataPmiResource\Widgets\OverwiewChart;
use App\Filament\Resources\PendaftaranResource\Widgets\PendaftaranOverview;
use App\Models\DataPmi;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;
// use Filament\Resources\Pages\ListRecords\Tab;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use Filament\Notifications\Actions\Action as NotificationAction; // Aliaskan tipe Action dari Filament\Notifications\Actions
use App\Filament\Resources\DataPmiResource\Widgets\Job;




class ListDataPmis extends ListRecords
{
    protected static string $resource = DataPmiResource::class;
    protected ?string $heading = 'DATA PMI';
    protected ?string $subheading = 'List Proses CPMI';

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make()
            //     ->icon('heroicon-m-check-badge')
            //     ->label('DATA PMI BARU +'),
        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
            // OverwiewChart::class,
            // PendaftaranOverview::class,
            Job::class,


        ];
    }
    public function getFooter(): ?View
    {
        return view('filament.settings.custom-footer');
    }

    public function getTabs(): array
    {
        return [
            'ALL' => Tab::make('SEMUA')
                ->icon('heroicon-m-user-group')
                ->badge(DataPmi::query()->count()),
            'BARU' => Tab::make('BARU')
                ->badge(DataPmi::query()->where('status_id', '1')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_id', '1')),
            'ON PROSES' => Tab::make('PROSES')
                ->badge(DataPmi::query()->where('status_id', '2')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_id', '2')),
            'TERBANG' => Tab::make('TERBANG')
                ->badge(DataPmi::query()->where('status_id', '3')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_id', '3')),
            'FINISH' => Tab::make('FINISH')
                ->badge(DataPmi::query()->where('status_id', '4')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_id', '4')),
        ];
    }
    protected function getCreatedNotification(): ?Notification
    {
        $data = $this->record;

        // Buat tombol "View" dengan tipe yang benar
        $viewButton = NotificationAction::make('Lihat')
            ->url(DataPmiResource::getUrl('view', ['record' => $data]));

        $recipients = User::all();

        foreach ($recipients as $recipient) {
            $editorName = auth()->user()->name; // Menggunakan Auth untuk mendapatkan nama pengguna yang sedang masuk
            // Buat notifikasi dengan tombol "View"
            $notification = Notification::make()
                ->title('DATA PMI')
                // ->body('Data CPMI Berhasil Diubah')
                ->body("<strong>{$data->pendaftaran->nama}</strong> Berhasil Update
                <br>
                Oleh <strong>{$editorName}</strong>")
                ->actions([$viewButton]) // Tambahkan tombol "View" ke notifikasi
                // ->send()
                ->persistent()
                ->success()
                ->duration(1000)
                ->sendToDatabase($recipient);
        }

        return $notification;
    }
}
