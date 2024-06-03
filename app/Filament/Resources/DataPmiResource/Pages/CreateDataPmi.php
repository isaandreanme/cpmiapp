<?php

namespace App\Filament\Resources\DataPmiResource\Pages;

use App\Filament\Resources\DataPmiResource;
use App\Models\DataPmi;
use App\Models\User;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Actions\Action as NotificationAction; // Aliaskan tipe Action dari Filament\Notifications\Actions


class CreateDataPmi extends CreateRecord
{
    protected static string $resource = DataPmiResource::class;
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
