<?php

namespace App\Filament\Resources\BiodataResource\Pages;

use App\Filament\Resources\BiodataResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action as NotificationAction; // Aliaskan tipe Action dari Filament\Notifications\Actions

class CreateBiodata extends CreateRecord
{
    protected static string $resource = BiodataResource::class;

    protected function getCreatedNotification(): ?Notification
    {
        $data = $this->record;

        // Buat tombol "View" dengan tipe yang benar
        $viewButton = NotificationAction::make('Lihat')
            ->url(BiodataResource::getUrl('edit', ['record' => $data]));

        $recipients = User::all();

        foreach ($recipients as $recipient) {

            $editorName = auth()->user()->name; // Menggunakan Auth untuk mendapatkan nama pengguna yang sedang masuk

            // Buat notifikasi dengan tombol "View"
            $notification = Notification::make()
                ->title('BIODATA')
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
