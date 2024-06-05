<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata NIP</title>
    <style>
        .center {
            text-align: center;
        }

        .box {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }

        .box img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="box">
        <h1 class="center">APPLICANT’S QUALIFICATION HIGHLIGHTS / 印尼傭工個人資料及工作簡介</h1>
        <div style="flex: 2;">
            <p class="text-gray-700 text-sm bg-gray-200 p-2 center">
                @if ($record && $record->nomor_lamar)
                Applicant’s No(僱傭編號) : {{ $record->nomor_lamar }}
                @else
                Applicant’s No(僱傭編號) : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 center">
                @if ($record && $record->nomor_hp)
                Phone Number : {{ $record->nomor_hp }}
                @else
                Phone Number : Data Tidak Ditemukan
                @endif
            </p>

        </div>
    </div>

    <!-- New Details -->
    <div class="box">
        <h2>Details</h2>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->nama)
            Nama : {{ $record->nama }}
            @else
            Nama : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->usia)
            Age 年齡 : {{ $record->usia }} (YO)
            @else
            Age 年齡 : Data Tidak Ditemukan (YO)
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->tanggal_lahir)
            Date of birth 出身日期 : {{ $record->tanggal_lahir }}
            @else
            Date of birth 出身日期 : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->tempat_lahir)
            Place of birth 出身地點 : {{ $record->tempat_lahir }}
            @else
            Place of birth 出身地點 : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->tinggi_badan)
            Height 身高 : {{ $record->tinggi_badan }}
            @else
            Height 身高 : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->berat_badan)
            Weight 體重 : {{ $record->berat_badan }}
            @else
            Weight 體重 : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->agama)
            Religion 宗教 : {{ $record->agama }}
            @else
            Religion 宗教 : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->lulusan)
            Education 教育 : {{ $record->lulusan }}
            @else
            Education 教育 : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->status_nikah)
            Marital Status 婚姻狀況 : {{ $record->status_nikah }}
            @else
            Marital Status 婚姻狀況 : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->jumlah_anak)
            No. of children/Age 子女數目/年齡 : {{ $record->jumlah_anak }}
            @else
            No. of children/Age 子女數目/年齡 : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->jumlah_saudara)
            No. of brothers/Sisters 兄妹數目 : {{ $record->jumlah_saudara }}
            @else
            No. of brothers/Sisters 兄妹數目 : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->anak_ke)
            I am the in the family 家中排行第 : {{ $record->anak_ke }}
            @else
            I am the in the family 家中排行第 : Data Tidak Ditemukan
            @endif
        </p>
    </div>

    <!-- New Finished Contract on -->
    <div class="box">
        <h2>Finished Contract on</h2>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->pengalaman_luarnegeri)
            Overseas Experience 海外經驗 : {{ $record->pengalaman_luarnegeri }}
            @else
            Overseas Experience 海外經驗 : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->ket_pengalaman_luarnegeri)
            Where 何處 : {{ $record->ket_pengalaman_luarnegeri }}
            @else
            Where 何處 : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->pengalaman_lokal)
            Local Experience 印尼本土經驗 : {{ $record->pengalaman_lokal }}
            @else
            Local Experience 印尼本土經驗 : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->ket_pengalaman_lokal)
            Where 何處 : {{ $record->ket_pengalaman_lokal }}
            @else
            Where 何處 : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->housekeeping)
            Recommended for House Keeping : {{ $record->housekeeping }}
            @else
            Recommended for House Keeping : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->babysitting)
            Recommended for Baby Sitting : {{ $record->babysitting }}
            @else
            Recommended for Baby Sitting : Data Tidak Ditemukan
            @endif
        </p>
    </div>

    <!-- New PHOTO -->
    <div class="box">
        <h2>PHOTO</h2>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->foto)
            <img src="{{ asset($record->foto) }}" alt="Foto Profil">
            @else
            Data Tidak Ditemukan
            @endif
        </p>
    </div>

    <!-- New SKILLS -->
    <div class="box">
        <h2>SKILLS</h2>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->careofbabies)
            護理嬰兒 Care of Babies : {{ $record->careofbabies }}
            @else
            護理嬰兒 Care of Babies : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->careofyoung)
            護理兒童 Care of Young Children : {{ $record->careofyoung }}
            @else
            護理兒童 Care of Young Children : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->householdworks)
            家務 Household Works : {{ $record->householdworks }}
            @else
            家務 Household Works : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->personality)
            個性表現 Personality : {{ $record->personality }}
            @else
            個性表現 Personality : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->facialexpression)
            儀容 Facial Expression : {{ $record->facialexpression }}
            @else
            儀容 Facial Expression : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->careofelderly)
            護理老人 Care of Elderly/Disable : {{ $record->careofelderly }}
            @else
            護理老人 Care of Elderly/Disable : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->cooking)
            烹飪 Cooking : {{ $record->cooking }}
            @else
            烹飪 Cooking : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->housmaid)
            女傭經驗 Exp. In Housemaid : {{ $record->housmaid }}
            @else
            女傭經驗 Exp. In Housemaid : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->spokenenglish)
            能操英語 Spoken English : {{ $record->spokenenglish }}
            @else
            能操英語 Spoken English : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->spokencantonese)
            能操廣東話 Spoken Cantonese : {{ $record->spokencantonese }}
            @else
            能操廣東話 Spoken Cantonese : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->spokenmandarin)
            能操國語 Spoken Mandarin : {{ $record->spokenmandarin }}
            @else
            能操國語 Spoken Mandarin : Data Tidak Ditemukan
            @endif
        </p>
    </div>

     <!-- New PREVIOUS EMPLOYMENT HISTORY 以往僱員工作紀錄 -->
     <div class="box">
        <h2>PREVIOUS EMPLOYMENT HISTORY 以往僱員工作紀錄</h2>
        
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->nama_majikan)
            Nama : {{ $record->nama_majikan }}
            @else
            Nama : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->alamat_majikan)
            Nama : {{ $record->alamat_majikan }}
            @else
            Nama : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->tahun_mulai)
            Nama : {{ $record->tahun_mulai }}
            @else
            Nama : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->tahun_selesai)
            Nama : {{ $record->tahun_selesai }}
            @else
            Nama : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->gaji)
            Nama : {{ $record->gaji }}
            @else
            Nama : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->alasan_selesai)
            Nama : {{ $record->alasan_selesai }}
            @else
            Nama : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 ">
            @if ($record && $record->keterangan)
            Nama : {{ $record->keterangan }}
            @else
            Nama : Data Tidak Ditemukan
            @endif
        </p>
    </div>

</body>

</html>