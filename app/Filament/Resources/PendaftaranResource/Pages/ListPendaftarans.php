<?php

namespace App\Filament\Resources\PendaftaranResource\Pages;

use App\Filament\Resources\PendaftaranResource;
use App\Filament\Resources\PendaftaranResource\Widgets\PendaftaranOverview;
use App\Models\Pendaftaran;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;
// use Filament\Resources\Pages\ListRecords\Tab;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use Filament\Notifications\Actions\Action as NotificationAction; // Aliaskan tipe Action dari Filament\Notifications\Actions



class ListPendaftarans extends ListRecords
{
    protected static string $resource = PendaftaranResource::class;

    protected ?string $heading = 'PENDAFTARAN';
    protected ?string $subheading = 'List Pendaftaran';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-m-check-badge')
                ->label('PENDAFTARAN BARU +'),
        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
            // PendaftaranOverview::class,

        ];
    }
    public function getFooter(): ?View
    {
        return view('filament.settings.custom-footer');
    }

    public function getTabs(): array
    {
        return [
            'ALL' => Tab::make('DOCUMENT')
                ->icon('heroicon-m-clipboard-document-list')
                ->badge(Pendaftaran::query()->count()),
            'LENGKAP' => Tab::make('LENGKAP')
                ->badge(Pendaftaran::query()->where('data_lengkap', '1')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('data_lengkap', '1')),
            'TIDAK' => Tab::make('TIDAK')
                ->badge(Pendaftaran::query()->where('data_lengkap', '0')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('data_lengkap', '0')),
        ];
    }
    protected function getCreatedNotification(): ?Notification
    {
        $data = $this->record;

        // Buat tombol "View" dengan tipe yang benar
        $viewButton = NotificationAction::make('Lihat')
            ->url(PendaftaranResource::getUrl('edit', ['record' => $data]));

        $recipients = User::all();

        foreach ($recipients as $recipient) {

            $editorName = auth()->user()->name; // Menggunakan Auth untuk mendapatkan nama pengguna yang sedang masuk

            // Buat notifikasi dengan tombol "View"
            $notification = Notification::make()
                ->title('PENDAFTARAN')
                // ->body('Data CPMI Berhasil Diubah')
                ->body("<strong>{$data->nama}</strong> Berhasil dibuat
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
