<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata NIP</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .center {
            text-align: center;
        }



        .box {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
            /* background-color: skyblue; */

        }

        .box1 {
            justify-content: flex-end;
            display: flex;
            gap: 10px;
            padding: 10px;
            /* Add space between the items */
            /* background-color: #87CEEB; */
            /* Sky blue background color */
            /* Add some padding */
            /* border: 1px solid #000; */
            /* Optional: Add border */
        }

        .box p {
            margin: 0;
            background-color: #f5f5f5;
            /* Background color for paragraphs */
            padding: 5px 10px;
            /* Padding for paragraphs */
            border-radius: 5px;
            /* Rounded corners for paragraphs */
            font-weight: bold;
            text-transform: uppercase;
        }

        .box img {
            max-width: 100%;
            height: auto;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            /* Dua kolom dengan lebar yang sama */
            gap: 1rem;
            /* Jarak antar elemen */
        }

        /* CSS untuk kotak konten */
        .box {
            border: 1px solid #ccc;
            /* Garis border */
            padding: 1rem;
            /* Padding di dalam kotak */
        }

        /* Flexible border wrapper */
        .border-wrapper {
            border: 0px solid #ccc;
            padding: 20px;
        }

        body {
            /* background-image: url('/images/nip.png'); */
            background-size: 500px 500px;
            background-repeat: no-repeat;
            background-position: center;
            border: 1px solid #ccc;
            padding: 20px;
        }

        .image-container {
            display: flex;
            justify-content: center;
            /* Adjust the height as needed */
        }

        .img {
            width: 50px;
            height: 50px;
        }
    </style>
</head>

<body>
    <div class="border-wrapper">
        <div class="grid grid-cols-2 gap-4">
            <div class="image-container">
                <img class="rounded-lg w-full h-auto" src="/images/logonip1.png">
            </div>
            <h2 class="text-center mb-4 font-bold uppercase" style="background-color: skyblue; padding: 10px;">
                印尼傭工個人資料及工作簡介
                <br>
                APPLICANT’S QUALIFICATION HIGHLIGHTS
            </h2>

        </div>
    </div>

    <!-- ---------------------------------------------------------------->

    <div class="grid grid-cols-2 gap-4">
        <!-- New Section Details -->
        <div class="box">
            <h2 class="text-center mb-4 font-bold uppercase" style="background-color: skyblue; padding: 10px;">
                Details</h2>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->nama)
                Name : {{ $record->nama }}
                @else
                Name : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->usia)
                Age 年齡 : {{ $record->usia }} (YO)
                @else
                Age 年齡 : Data Tidak Ditemukan (YO)
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->tanggal_lahir)
                Date of birth 出身日期 : {{ $record->tanggal_lahir }}
                @else
                Date of birth 出身日期 : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->tempat_lahir)
                Place of birth 出身地點 : {{ $record->tempat_lahir }}
                @else
                Place of birth 出身地點 : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->tinggi_badan)
                Height 身高 : {{ $record->tinggi_badan }}
                @else
                Height 身高 : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->berat_badan)
                Weight 體重 : {{ $record->berat_badan }}
                @else
                Weight 體重 : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->agama)
                Religion 宗教 : {{ $record->agama }}
                @else
                Religion 宗教 : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->lulusan)
                Education 教育 : {{ $record->lulusan }}
                @else
                Education 教育 : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->status_nikah)
                Marital Status 婚姻狀況 : {{ $record->status_nikah }}
                @else
                Marital Status 婚姻狀況 : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->jumlah_anak)
                No. of children/Age 子女數目/年齡 : {{ $record->jumlah_anak }}
                @else
                No. of children/Age 子女數目/年齡 : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->jumlah_saudara)
                No. of brothers/Sisters 兄妹數目 : {{ $record->jumlah_saudara }}
                @else
                No. of brothers/Sisters 兄妹數目 : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->anak_ke)
                I am the in the family 家中排行第 : {{ $record->anak_ke }}
                @else
                I am the in the family 家中排行第 : Data Tidak Ditemukan
                @endif
            </p>
        </div>

        <!-- New Section Finished Contract on -->

        <div class="box">
            <p class=" text-gray-700 text-sm p-2 center font-bold uppercase">
                @if ($record && $record->nomor_lamar)
                Applicant’s No(僱傭編號) : {{ $record->nomor_lamar }}
                @else
                Applicant’s No(僱傭編號) : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm p-2 center font-bold uppercase">
                @if ($record && $record->nomor_hp)
                Phone Number : {{ $record->nomor_hp }}
                @else
                Phone Number : Data Tidak Ditemukan
                @endif
            </p>
            <br>
            <h2 class="text-center mb-4 font-bold uppercase" style="background-color: skyblue; padding: 10px;">
                Finished Contract on</h2>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->pengalaman_luarnegeri)
                Overseas Experience 海外經驗 : {{ $record->pengalaman_luarnegeri }}
                @else
                Overseas Experience 海外經驗 : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->ket_pengalaman_luarnegeri)
                Where 何處 : {{ $record->ket_pengalaman_luarnegeri }}
                @else
                Where 何處 : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->pengalaman_lokal)
                Local Experience 印尼本土經驗 : {{ $record->pengalaman_lokal }}
                @else
                Local Experience 印尼本土經驗 : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->ket_pengalaman_lokal)
                Where 何處 : {{ $record->ket_pengalaman_lokal }}
                @else
                Where 何處 : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->housekeeping)
                Recommended for House Keeping : {{ $record->housekeeping }}
                @else
                Recommended for House Keeping : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->babysitting)
                Recommended for Baby Sitting : {{ $record->babysitting }}
                @else
                Recommended for Baby Sitting : Data Tidak Ditemukan
                @endif
            </p>
        </div>
    </div>

    <!-- ---------------------------------------------------------------->

    <div class="grid grid-cols-2 gap-4">
        <!-- New Section PHOTO -->
        <div class="box">
            <!-- <h2 class="text-center mb-4 font-bold uppercase">PHOTO</h2> -->
            @if ($record && $record->foto)
            <img class="rounded-lg w-full h-auto" src="/storage/{{ $record->foto }}">
            @else
            Data Tidak Ditemukan
            @endif
        </div>


        <!-- New Section SKILLS -->
        <div class="box">
            <h2 class="text-center mb-4 font-bold uppercase" style="background-color: skyblue; padding: 10px;">
                SKILLS</h2>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->careofbabies)
                ★ 護理嬰兒 Care of Babies : {{ $record->careofbabies }}
                @else
                ★ 護理嬰兒 Care of Babies : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->careofyoung)
                ★ 護理兒童 Care of Young Children : {{ $record->careofyoung }}
                @else
                ★ 護理兒童 Care of Young Children : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->householdworks)
                ★ 家務 Household Works : {{ $record->householdworks }}
                @else
                ★ 家務 Household Works : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->personality)
                ★ 個性表現 Personality : {{ $record->personality }}
                @else
                ★ 個性表現 Personality : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->facialexpression)
                ★ 儀容 Facial Expression : {{ $record->facialexpression }}
                @else
                ★ 儀容 Facial Expression : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->careofelderly)
                ★ 護理老人 Care of Elderly/Disable : {{ $record->careofelderly }}
                @else
                ★ 護理老人 Care of Elderly/Disable : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->cooking)
                ★ 烹飪 Cooking : {{ $record->cooking }}
                @else
                ★ 烹飪 Cooking : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->housmaid)
                ★ 女傭經驗 Exp. In Housemaid : {{ $record->housmaid }}
                @else
                ★ 女傭經驗 Exp. In Housemaid : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->spokenenglish)
                ★ 能操英語 Spoken English : {{ $record->spokenenglish }}
                @else
                ★ 能操英語 Spoken English : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->spokencantonese)
                ★ 能操廣東話 Spoken Cantonese : {{ $record->spokencantonese }}
                @else
                ★ 能操廣東話 Spoken Cantonese : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->spokenmandarin)
                ★ 能操國語 Spoken Mandarin : {{ $record->spokenmandarin }}
                @else
                ★ 能操國語 Spoken Mandarin : Data Tidak Ditemukan
                @endif
            </p>
            <!-- New PETS -->
            <div class="box">
                <h2 class="text-center mb-4 font-bold uppercase" style="background-color: skyblue; padding: 10px;">
                    PETS
                </h2>
                <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                    @if ($record && $record->afraidofdog)
                    怕狗 Afraid of Dog : {{ $record->afraidofdog }}
                    @else
                    怕狗 Afraid of Dog : Data Tidak Ditemukan
                    @endif
                </p>
                <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                    @if ($record && $record->caringdog)
                    經驗照顧狗 Exp. Caring for Dogs : {{ $record->caringdog }}
                    @else
                    經驗照顧狗 Exp. Caring for Dogs : Data Tidak Ditemukan
                    @endif
                </p>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>


    <!-- ---------------------------------------------------------------->

    <div class="grid grid-cols-2 gap-4">
        <!-- New Section HUSBAN -->
        <div class="box">
            <h2 class="text-center mb-4 font-bold uppercase" style="background-color: skyblue; padding: 10px;">
                HUSBAN</h2>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->nama_suami)
                Name of Spouse 配偶姓名/husband : {{ $record->nama_suami }}
                @else
                Name of Spouse 配偶姓名/husband : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->usia_suami)
                Age 年齡 : {{ $record->usia_suami }} (YO)
                @else
                Age 年齡 : Data Tidak Ditemukan (YO)
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->pekerjaan_suami)
                Spouse’s Occupation 配偶職業 : {{ $record->pekerjaan_suami }}
                @else
                Spouse’s Occupation 配偶職業 : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->anakke_suami)
                No. of Children 子女數 : {{ $record->anakke_suami }}
                @else
                No. of Children 子女數 : Data Tidak Ditemukan
                @endif
            </p>
        </div>


        <!-- New Section PARENTS -->
        <div class="box">
            <h2 class="text-center mb-4 font-bold uppercase" style="background-color: skyblue; padding: 10px;">
                PARENTS</h2>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->nama_ayah)
                Name of Father/Occupation 父親姓名/職業 : {{ $record->nama_ayah }}
                @else
                Name of Father/Occupation 父親姓名/職業 : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->usia_ayah)
                Age 年齡 : {{ $record->usia_ayah }} (YO)
                @else
                Age 年齡 : Data Tidak Ditemukan (YO)
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->nama_ibu)
                Name of Mother/Occupation母親姓 : {{ $record->nama_ibu }}
                @else
                Name of Mother/Occupation母親姓 : Data Tidak Ditemukan
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->usia_ibu)
                Age 年齡 : {{ $record->usia_ibu }} (YO)
                @else
                Age 年齡 : Data Tidak Ditemukan (YO)
                @endif
            </p>
            <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
                @if ($record && $record->alamat_ortu)
                ADDRESS : {{ $record->alamat_ortu }}
                @else
                ADDRESS : Data Tidak Ditemukan
                @endif
            </p>
        </div>
    </div>

    <!-- ---------------------------------------------------------------->

    <!-- New Section PREVIOUS EMPLOYMENT HISTORY 以往僱員工作紀錄 -->
    <div class="box">
        <h2 class="text-center mb-4 font-bold uppercase" style="background-color: skyblue; padding: 10px;">
            PREVIOUS EMPLOYMENT HISTORY 以往僱員工作紀錄</h2>

        <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
            @if ($record && isset($record['pengalaman']) && is_array($record['pengalaman']))
            @foreach ($record['pengalaman'] as $experience)
        <div class="experience-entry bg-gray-200 p-2 mb-2">
            <p class="text-gray-700 text-sm">
                <strong>Name of Employer:</strong> {{ $experience['nama_majikan'] }} <br>
                <strong>Location of Employer:</strong> {{ $experience['alamat_majikan'] }} <br>
                <strong>From:</strong> {{ $experience['tahun_mulai'] }}
                <strong>To:</strong> {{ $experience['tahun_selesai'] }} <br>
                <strong>Salary:</strong> {{ $experience['gaji'] }} <br>
                <strong>Reason of Leave:</strong> {{ $experience['alasan_selesai'] }} <br>
                <strong>Description of Job:</strong> {{ $experience['keterangan'] }}
            </p>
        </div>
        @endforeach
        @else
        <p class="text-gray-700 text-sm bg-gray-200 p-2">
            ADDRESS: Data Tidak Ditemukan
        </p>
        @endif
        </p>
    </div>

    <!-- ---------------------------------------------------------------->
    <br>
    <br>
    <br>
    <br>

    <!-- New Section SHE HAS WORKING EXPERIENCE -->
    <div class="box">
        <h2 class="text-center mb-4 font-bold uppercase" style="background-color: skyblue; padding: 10px;">
            SHE HAS WORKING EXPERIENCE</h2>
        <p class="text-gray-700 text-sm bg-gray-200 p-2 font-bold uppercase">
            @if ($record && isset($record['pengalaman']) && is_array($record['pengalaman']))
            @foreach ($record['pengalaman'] as $experience)
        <div class="experience-entry bg-gray-200 p-2 mb-2">
            <p class="text-gray-700 text-sm">
                {{ $experience['keterangan'] }}
            </p>
        </div>
        @endforeach
        @else
        <p class="text-gray-700 text-sm bg-gray-200 p-2">
            ADDRESS: Data Tidak Ditemukan
        </p>
        @endif
        </p>
    </div>

    <!-- ---------------------------------------------------------------->

    <!-- New Section Marketing -->
    <div class="box1">
        <p class="text-gray-700 text-sm p-2 font-bold uppercase">
            @if ($record->kantor_id)
            CABANG : {{ App\Models\Kantor::find($record->kantor_id)->nama ?? 'Tidak ditemukan' }}
            @else
            CABANG : Data Tidak Ditemukan
            @endif
        </p>
        <p class="text-gray-700 text-sm p-2 font-bold uppercase">
            @if ($record->kantor_id)
            MARKETING : {{ App\Models\Marketing::find($record->marketing_id)->nama ?? 'Tidak ditemukan' }}
            @else
            MARKETING : Data Tidak Ditemukan
            @endif
        </p>
    </div>

    </div>

</body>

</html>