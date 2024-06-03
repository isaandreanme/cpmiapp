<?php

namespace App\Filament\Resources\PendaftaranResource\Pages;

use App\Filament\Resources\PendaftaranResource;
use App\Models\Pendaftaran;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action as NotificationAction; // Aliaskan tipe Action dari Filament\Notifications\Actions


class EditPendaftaran extends EditRecord
{
    protected static string $resource = PendaftaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()->label('Batal'),
            Actions\DeleteAction::make(),

        ];
    }
    public static function getGlobalSearchResultTitle(Pendaftaran $record): string
    {
        return $record->nama;
    }
    protected function getSavedNotification(): ?Notification
    {
        $data = $this->record;

        // Buat tombol "View" dengan tipe yang benar
        $viewButton = NotificationAction::make('Lihat')
            ->url(PendaftaranResource::getUrl('view', ['record' => $data]));

        $recipients = User::all();

        foreach ($recipients as $recipient) {

            $editorName = auth()->user()->name; // Menggunakan Auth untuk mendapatkan nama pengguna yang sedang masuk

            // Buat notifikasi dengan tombol "View"
            $notification = Notification::make()
                ->title('PENDAFTARAN')
                // ->body('Data CPMI Berhasil Diubah')
                ->body("<strong>{$data->nama}</strong> Berhasil Update
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
