<?php

namespace App\Filament\Resources\PendaftaranResource\Pages;

use App\Filament\Resources\PendaftaranResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action as NotificationAction; // Aliaskan tipe Action dari Filament\Notifications\Actions


class CreatePendaftaran extends CreateRecord
{
    protected static string $resource = PendaftaranResource::class;
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
    protected function getRedirectUrl(): string
    {
        $record = $this->record;
        return $this->getResource()::getUrl('edit', ['record' => $record]);
    }
}
