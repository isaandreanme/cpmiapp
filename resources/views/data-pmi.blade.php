<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data PMI</title>
    <!-- Tambahkan link ke CDN Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @media print {
            @page {
                size: A4;
                margin: 0, 5cm;
            }

            body {
                margin: 0, 5cm;
            }

            .print-background {
                background: transparent !important;
            }
        }

        @media print {
            .print-background {
                background: transparent !important;
            }
        }
    </style>
</head>

<body class=" font-sans">

    <div class="max-w-2xl mx-auto hide-on-print  bg-yellow-500 shadow-md mb-4 p-6">
        <div class="grid grid-cols-2 hide-on-print gap-4 px-4">
            <!-- Kolom Pertama -->
            <div>
                <!-- Instruksi untuk mencetak -->
                <p
                    class="text-gray-700 px-4 py-2 rounded text-center mx-auto hover:bg-white text-sm hover:text-gray-700 block hide-on-print">
                    Tekan Tombol <strong>CTRL+P</strong>
                    Untuk Mencetak</p>

            </div>
            <!-- Kolom Kedua -->
            <div>
                <!-- Tombol Tutup Halaman -->
                <button onclick="closePage()"
                    class="text-gray-700 px-4 py-2 rounded text-center mx-auto hover:bg-white text-sm hover:text-gray-700 block hide-on-print">Tutup
                    Halaman</button>
            </div>
        </div>
    </div>

    <div class="max-w-2xl mx-auto rounded-lg shadow-md mb-4 p-6 ">
        <h1 class="text-lg font-bold mb-2 text-center bg-yellow-500 py-2">PENDAFTARAN</h1>
        <div class="grid grid-cols-2 gap-4 px-4">
            <!-- Kolom Pertama -->
            <div style="display: flex; justify-content: space-between;">
                <!-- Kolom Kiri -->
                <div style="flex: 1;">
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>TGL Daftar :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Kantor:</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Sponsor-PL :</strong>
                    </p>
                </div>
                <!-- Kolom Kanan -->
                <div style="flex: 2;">
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record && $record->pendaftaran->created_at)
                            {{ date('d-m-Y', strtotime($record->pendaftaran->created_at)) }}
                        @else
                            Data Tidak Ditemukan
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record->kantor_id)
                            {{ App\Models\Kantor::find($record->kantor_id)->nama ?? 'Tidak ditemukan' }}
                        @else
                            Data tidak ditemukan
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record->sponsor_id)
                            {{ App\Models\Sponsor::find($record->sponsor_id)->nama ?? 'Tidak ditemukan' }}
                        @else
                            Data tidak ditemukan
                        @endif
                    </p>
                </div>
            </div>

            <!-- Kolom Kedua -->
            <div style="display: flex; justify-content: space-between;">
                <!-- Kolom Kiri -->
                <div style="flex: 1;">
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Tujuan :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Pengalaman :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-green-500 p-2 ">
                        <strong>STATUS :</strong>
                    </p>
                </div>
                <!-- Kolom Kanan -->
                <div style="flex: 2;">
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record->tujuan_id)
                            {{ App\Models\Tujuan::find($record->tujuan_id)->nama ?? 'Data Tidak Ditemukan' }}
                        @else
                            Data tidak ditemukan
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record->pengalaman_id)
                            {{ App\Models\Pengalaman::find($record->pengalaman_id)->nama ?? 'Data Tidak Ditemukan' }}
                        @else
                            Data tidak ditemukan
                        @endif
                    </p>
                    <p class="text-white text-sm bg-green-500 p-2 ">
                        @if ($record->status_id)
                            <strong>
                                {{ App\Models\Status::find($record->status_id)->nama ?? 'Data Tidak Ditemukan' }}</strong>
                        @else
                            Data tidak ditemukan
                        @endif
                    </p>
                </div>
            </div>

        </div>
    </div>

    <div class="max-w-2xl mx-auto rounded-lg shadow-md mb-4 p-6">
        <h1 class="text-lg font-bold mb-2 text-center bg-yellow-500 py-2">DATA PENDAFTAR</h1>
        <div class="grid grid-cols-2 gap-4 px-4">
            <!-- Kolom Pertama -->
            <div style="display: flex; justify-content: space-between;">
                <!-- Kolom Kiri -->
                <div style="flex: 1;">
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Nama :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>E-KTP :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>No. Telp :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>TGL Lahir :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Tinggi :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Berat :</strong>
                    </p>
                </div>
                <!-- Kolom Kanan -->
                <div style="flex: 2;">
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <span class="copyable-text">
                            <strong> {{ $record->pendaftaran->nama ?? 'Data Tidak Ditemukan' }}</strong>
                        </span>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <span class="copyable-text">
                            {{ $record->pendaftaran->nomor_ktp ?? 'Data Tidak Ditemukan' }}
                        </span>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <span class="copyable-text">
                            {{ $record->pendaftaran->nomor_telp ?? 'Data Tidak Ditemukan' }}
                        </span>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <span class="copyable-text">
                            {{ $record->pendaftaran->tgllahir ?? 'Data Tidak Ditemukan' }}
                        </span>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <span class="copyable-text">
                            {{ $record->pendaftaran->tinggibadan ? $record->pendaftaran->tinggibadan . ' Cm' : 'Data Tidak Ditemukan' }}
                        </span>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <span class="copyable-text">
                            {{ $record->pendaftaran->beratbadan ? $record->pendaftaran->beratbadan . ' Kg' : 'Data Tidak Ditemukan' }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Kolom Kedua -->
            <div style="display: flex; justify-content: space-between;">
                <!-- Kolom Kiri -->
                <div style="flex: 1;">
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Alamat :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>RT/RW :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Kelurahan :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Kecamatan :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Kab/Kota :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Provinsi :</strong>
                    </p>
                </div>
                <!-- Kolom Kanan -->
                <div style="flex: 2;">
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        {{ $record->pendaftaran->alamat ?? 'Data Tidak Ditemukan' }}
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        {{ $record->pendaftaran->rtrw ? substr($record->pendaftaran->rtrw, 0, 3) . '/' . substr($record->pendaftaran->rtrw, 3) : 'Data Tidak Ditemukan' }}
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record->pendaftaran->village_id)
                            {{ App\Models\Village::find($record->pendaftaran->village_id)->name ?? 'Tidak ditemukan' }}
                        @else
                            Data tidak ditemukan
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record->pendaftaran->district_id)
                            {{ App\Models\District::find($record->pendaftaran->district_id)->name ?? 'Tidak ditemukan' }}
                        @else
                            Data tidak ditemukan
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record->pendaftaran->regency_id)
                            {{ App\Models\Regency::find($record->pendaftaran->regency_id)->name ?? 'Tidak ditemukan' }}
                        @else
                            Data tidak ditemukan
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record->pendaftaran->province_id)
                            {{ App\Models\Province::find($record->pendaftaran->province_id)->name ?? 'Tidak ditemukan' }}
                        @else
                            Data tidak ditemukan
                        @endif
                    </p>
                </div>
            </div>

        </div>
    </div>

    <div class="max-w-2xl mx-auto rounded-lg shadow-md mb-4 p-6">
        <h1 class="text-lg font-bold mb-2 text-center bg-yellow-500 py-2">DATA KELUARGA / WALI</h1>
        <div class="grid grid-cols-2 gap-4 px-4">
            <!-- Kolom Pertama -->
            <div style="display: flex; justify-content: space-between;">
                <div style="flex: 1;">
                    <p class="text-gray-700 text-sm bg-gray-200 p-2">
                        <strong>Nama :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2">
                        <strong>KK :</strong>
                    </p>
                </div>
                <div style="flex: 2;">
                    <p class="text-gray-700 text-sm bg-gray-200 p-2">
                        <span class="copyable-text">
                            {{ $record->pendaftaran->nama_wali ?? 'Data Tidak Ditemukan' }}
                        </span>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2">
                        <span class="copyable-text">
                            {{ $record->pendaftaran->nomor_kk ?? 'Data Tidak Ditemukan' }}
                        </span>
                    </p>

                </div>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <div style="flex: 1;">
                    <p class="text-gray-700 text-sm bg-gray-200 p-2">
                        <strong>E-KTP :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2">
                        <strong>No. Telp :</strong>
                    </p>
                </div>
                <div style="flex: 2;">
                    <p class="text-gray-700 text-sm bg-gray-200 p-2">
                        <span class="copyable-text">
                            {{ $record->pendaftaran->nomor_ktp_wali ?? 'Data Tidak Ditemukan' }}
                        </span>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2">
                        <span class="copyable-text">
                            {{ $record->pendaftaran->nomor_telp_wali ?? 'Data Tidak Ditemukan' }}
                        </span>
                    </p>

                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="max-w-2xl mx-auto rounded-lg shadow-md mb-4 p-6">
        <h1 class="text-lg font-bold mb-2 text-center bg-yellow-500 py-2">SIAP KERJA</h1>
        <div class="grid grid-cols-2 gap-4 px-4">
            <!-- Kolom Pertama -->
            <div style="display: flex; justify-content: space-between;">
                <div style="flex: 1;">
                    <p class="text-gray-700 text-sm bg-gray-200 p-2">
                        <strong>Tanggal :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2">
                        <strong>Dokumen :</strong>
                    </p>
                </div>
                <div style="flex: 2;">
                    <p class="text-gray-700 text-sm  bg-gray-200 p-2 ">
                        @if ($record && $record->tglsiapkerja)
                            {{ date('d-m-Y', strtotime($record->tglsiapkerja)) }}
                        @else
                            Data Tidak Ditemukan
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record)
                            @if ($record->pendaftaran->data_lengkap === 1)
                                Lengkap
                            @elseif ($record->pendaftaran->data_lengkap === 0)
                                Tidak Lengkap
                            @else
                                Data Tidak Ditemukan
                            @endif
                        @else
                            Data Tidak Ditemukan
                        @endif
                    </p>
                </div>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <div style="flex: 1;">
                    <p class="text-gray-700 text-sm bg-gray-200 p-2">
                        <strong>Nomor HP :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2">
                        <strong>Email :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2">
                        <strong>Password :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2">
                        <strong>ID SiapKerja :</strong>
                    </p>
                </div>
                <div style="flex: 2;">
                    <p class="text-gray-700 text-sm  bg-gray-200 p-2 "><span class="copyable-text">
                            {{ $record->telp_siapkerja ?? 'Data Tidak Ditemukan' }}</span></p>
                    <p class="text-gray-700 text-sm  bg-gray-200 p-2 "><span class="copyable-text">
                            {{ $record->email_siapkerja ?? 'Data Tidak Ditemukan' }}</span></p>
                    <p class="text-gray-700 text-sm  bg-gray-200 p-2 "><span class="copyable-text">
                            {{ $record->password_siapkerja ?? 'Data Tidak Ditemukan' }}</span></p>
                    <p class="text-gray-700 text-sm  bg-gray-200 p-2 "><span class="copyable-text">
                            {{ $record->no_id_pmi ?? 'Data Tidak Ditemukan' }}</span></p>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="max-w-2xl mx-auto rounded-lg shadow-md mb-4 p-6">
        <h1 class="text-lg font-bold mb-2 text-center bg-yellow-500 py-2">PROSES CPMI</h1>
        <div class="grid grid-cols-2 gap-4 px-4">
            <!-- Kolom Pertama -->
            <div style="display: flex; justify-content: space-between;">
                <!-- Kolom Kiri -->
                <div style="flex: 1;">
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Medical :</strong>
                    </p>
                    <br>
                    <br>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>JOB :</strong>
                    </p>
                    <br>
                    <br>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Passport :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Pra BPJS :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Medical Full :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>EC :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Visa :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>BPJS Purna :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>KTKLN :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Terbang :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Inv Toyo :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Inv Agency :</strong>
                    </p>
                </div>
                <!-- Kolom Kanan -->
                <div style="flex: 2;">
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record)
                            @if ($record->medical_check === 1)
                                Ya
                            @elseif ($record->medical_check === 0)
                                Tidak
                            @else
                                Data Tidak Ditemukan
                            @endif
                        @else
                            Data Tidak Ditemukan
                        @endif
                    </p>
                    <br>
                    <br>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record)
                            @if ($record->job === 1)
                                Ya
                            @elseif ($record->job === 0)
                                Tidak
                            @else
                                Data Tidak Ditemukan
                            @endif
                        @else
                            Data Tidak Ditemukan
                        @endif
                    </p>
                    <br>
                    <br>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record)
                            @if ($record->validasi_paspor === 1)
                                Ya
                            @elseif ($record->validasi_paspor === 0)
                                Tidak
                            @else
                                Data Tidak Ditemukan
                            @endif
                        @else
                            Data Tidak Ditemukan
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record)
                            @if ($record->pra_bpjs === 1)
                                Ya
                            @elseif ($record->pra_bpjs === 0)
                                Tidak
                            @else
                                Data Tidak Ditemukan
                            @endif
                        @else
                            Data Tidak Ditemukan
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record)
                            @if ($record->medical_full === 1)
                                Ya
                            @elseif ($record->medical_full === 0)
                                Tidak
                            @else
                                Data Tidak Ditemukan
                            @endif
                        @else
                            Data Tidak Ditemukan
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record)
                            @if ($record->ec === 1)
                                Ya
                            @elseif ($record->ec === 0)
                                Tidak
                            @else
                                Data Tidak Ditemukan
                            @endif
                        @else
                            Data Tidak Ditemukan
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record)
                            @if ($record->visa === 1)
                                Ya
                            @elseif ($record->visa === 0)
                                Tidak
                            @else
                                Data Tidak Ditemukan
                            @endif
                        @else
                            Data Tidak Ditemukan
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record)
                            @if ($record->bpjs_purna === 1)
                                Ya
                            @elseif ($record->bpjs_purna === 0)
                                Tidak
                            @else
                                Data Tidak Ditemukan
                            @endif
                        @else
                            Data Tidak Ditemukan
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record)
                            @if ($record->ktkln === 1)
                                Ya
                            @elseif ($record->ktkln === 0)
                                Tidak
                            @else
                                Data Tidak Ditemukan
                            @endif
                        @else
                            Data Tidak Ditemukan
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record)
                            @if ($record->terbang === 1)
                                Ya
                            @elseif ($record->terbang === 0)
                                Tidak
                            @else
                                Data Tidak Ditemukan
                            @endif
                        @else
                            Data Tidak Ditemukan
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record)
                            @if ($record->invoice_toyo === 1)
                                Ya
                            @elseif ($record->invoice_toyo === 0)
                                Tidak
                            @else
                                Data Tidak Ditemukan
                            @endif
                        @else
                            Data Tidak Ditemukan
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record)
                            @if ($record->invoice_agency === 1)
                                Ya
                            @elseif ($record->invoice_agency === 0)
                                Tidak
                            @else
                                Data Tidak Ditemukan
                            @endif
                        @else
                            Data Tidak Ditemukan
                        @endif
                    </p>
                </div>
            </div>

            <!-- Kolom Kedua -->
            <div style="display: flex; justify-content: space-between;">
                <!-- Kolom Kiri -->
                <div style="flex: 1;">
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Tanggal :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Hasil MCU :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Tanggal :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Agency :</strong>
                    </p>
                    <br>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Tanggal :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Tanggal :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Tanggal :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Tanggal :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Tanggal :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Tanggal :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Tanggal :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Tanggal :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Tanggal :</strong>
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        <strong>Tanggal :</strong>
                    </p>
                </div>
                <!-- Kolom Kanan -->
                <div style="flex: 2;">
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record && $record->tanggal_pra_medical)
                            {{ date('d-m-Y', strtotime($record->tanggal_pra_medical)) }}
                        @else
                            Data Tidak Ditemukan
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        {{ $record->pra_medical ?? 'Data Tidak Ditemukan' }}
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record && $record->tanggal_job)
                            {{ date('d-m-Y', strtotime($record->tanggal_job)) }}
                        @else
                            Data Tidak Ditemukan
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record->agency_id)
                            {{ App\Models\Agency::find($record->agency_id)->nama ?? 'Tidak ditemukan' }}
                        @else
                            Data tidak ditemukan
                        @endif
                    </p>
                    <br>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record && $record->tanggal_validasi_paspor)
                            {{ date('d-m-Y', strtotime($record->tanggal_validasi_paspor)) }}
                        @else
                            Data Tidak Ditemukan
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record && $record->tanggal_pra_bpjs)
                            {{ date('d-m-Y', strtotime($record->tanggal_pra_bpjs)) }}
                        @else
                            Data Tidak Ditemukan
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record && $record->tanggal_medical_full)
                            {{ date('d-m-Y', strtotime($record->tanggal_medical_full)) }}
                        @else
                            Data Tidak Ditemukan
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record && $record->tanggal_ec)
                            {{ date('d-m-Y', strtotime($record->tanggal_ec)) }}
                        @else
                            Data Tidak Ditemukan
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record && $record->tanggal_visa)
                            {{ date('d-m-Y', strtotime($record->tanggal_visa)) }}
                        @else
                            Data Tidak Ditemukan
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record && $record->tanggal_bpjs_purna)
                            {{ date('d-m-Y', strtotime($record->tanggal_bpjs_purna)) }}
                        @else
                            Data Tidak Ditemukan
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record && $record->tanggal_ktkln)
                            {{ date('d-m-Y', strtotime($record->tanggal_ktkln)) }}
                        @else
                            Data Tidak Ditemukan
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record && $record->tanggal_terbang)
                            {{ date('d-m-Y', strtotime($record->tanggal_terbang)) }}
                        @else
                            Data Tidak Ditemukan
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record && $record->tanggal_invoice_toyo)
                            {{ date('d-m-Y', strtotime($record->tanggal_invoice_toyo)) }}
                        @else
                            Data Tidak Ditemukan
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
                        @if ($record && $record->tanggal_invoice_agency)
                            {{ date('d-m-Y', strtotime($record->tanggal_invoice_agency)) }}
                        @else
                            Data Tidak Ditemukan
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>






    <!-- Script JavaScript untuk menutup halaman -->
    <script>
        function closePage() {
            window.close();
        }
    </script>

    <script>
        const copyableTexts = document.querySelectorAll('.copyable-text');

        copyableTexts.forEach((copyableText) => {
            copyableText.addEventListener('click', function() {
                const textToCopy = copyableText.innerText;

                const textarea = document.createElement('textarea');
                textarea.value = textToCopy;
                document.body.appendChild(textarea);

                textarea.select();
                document.execCommand('copy');

                document.body.removeChild(textarea);

                alert(textToCopy + ' - Berhasil Disalin');
            });
        });
    </script>

    <style>
        /* Ganti ukuran font untuk teks dengan class "text-sm" */
        .text-sm {
            font-size: 12px;
            /* Sesuaikan dengan ukuran yang Anda inginkan */
        }

        /* Ganti ukuran font untuk teks dengan class "text-lg" */
        .text-lg {
            font-size: 16px;
            /* Sesuaikan dengan ukuran yang Anda inginkan */
        }

        /* Ganti ukuran font untuk teks dengan class "font-bold" */
        .font-bold {
            font-weight: bold;
        }
    </style>

    <style>
        /* CSS untuk menyembunyikan elemen saat mencetak */
        @media print {
            .hide-on-print {
                display: none !important;
            }
        }
    </style>

    {{-- <!-- Instruksi untuk mencetak -->
    <p class="text-gray-700 text-center mt-4 hide-on-print text-sm">Tekan Tombol <strong>CTRL+P</strong> Untuk Mencetak
    </p>
    <br>
    <!-- Tombol Tutup Halaman -->
    <button onclick="closePage()"
        class="bg-red-500 text-white px-4 py-2 rounded mx-auto hover:bg-red-600 block hide-on-print">Tutup
        Halaman</button>
    <br><br> --}}

</body>

</html>
