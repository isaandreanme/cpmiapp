<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata NIP</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 5px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .box-header {
            background-color: skyblue;
            padding: 10px;
        }

        .left-align {
            text-align: left;
        }

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
            <h2 class="text-center mb-4 font-bold uppercase box-header">Details</h2>
            <table class="w-full">
                <tr>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">Name</td>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">
                        @if ($record && $record->nama)
                        {{ $record->nama }}
                        @else
                        Data Tidak Ditemukan
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">Age 年齡</td>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">
                        @if ($record && $record->usia)
                        {{ $record->usia }} (YO)
                        @else
                        Data Tidak Ditemukan (YO)
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">Date of birth 出身日期</td>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">
                        @if ($record && $record->tanggal_lahir)
                        {{ $record->tanggal_lahir }}
                        @else
                        Data Tidak Ditemukan
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">Place of birth 出身地點</td>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">
                        @if ($record && $record->tempat_lahir)
                        {{ $record->tempat_lahir }}
                        @else
                        Data Tidak Ditemukan
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">Height 身高</td>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">
                        @if ($record && $record->tinggi_badan)
                        {{ $record->tinggi_badan }} (CM)
                        @else
                        Data Tidak Ditemukan
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">Weight 體重</td>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">
                        @if ($record && $record->berat_badan)
                        {{ $record->berat_badan }} (KG)
                        @else
                        Data Tidak Ditemukan
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">Religion 宗教</td>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">
                        @if ($record && $record->agama)
                        {{ $record->agama }}
                        @else
                        Data Tidak Ditemukan
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">Education 教育</td>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">
                        @if ($record && $record->lulusan)
                        {{ $record->lulusan }}
                        @else
                        Data Tidak Ditemukan
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">Marital Status 婚姻狀況</td>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">
                        @if ($record && $record->status_nikah)
                        {{ $record->status_nikah }}
                        @else
                        Data Tidak Ditemukan
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">No. of children/Age 子女數目/年齡</td>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">
                        @if ($record && $record->jumlah_anak)
                        {{ $record->jumlah_anak }}
                        @else
                        Data Tidak Ditemukan
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">No. of brothers/Sisters 兄妹數目</td>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">
                        @if ($record && $record->jumlah_saudara)
                        {{ $record->jumlah_saudara }}
                        @else
                        Data Tidak Ditemukan
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">I am the in the family 家中排行第</td>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">
                        @if ($record && $record->anak_ke)
                        {{ $record->anak_ke }}
                        @else
                        Data Tidak Ditemukan
                        @endif
                    </td>
                </tr>
            </table>
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
            <table class="w-full">
                <!-- <tr>
                    <th class="text-gray-700 font-bold uppercase">Label</th>
                    <th class="text-gray-700 font-bold uppercase">Value</th>
                </tr> -->
                <tr>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">Overseas Experience 海外經驗</td>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">
                        @if ($record && $record->pengalaman_luarnegeri)
                        {{ $record->pengalaman_luarnegeri }}
                        @else
                        Data Tidak Ditemukan
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">Where 何處 (Overseas)</td>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">
                        @if ($record && $record->ket_pengalaman_luarnegeri)
                        {{ $record->ket_pengalaman_luarnegeri }}
                        @else
                        Data Tidak Ditemukan
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">Local Experience 印尼本土經驗</td>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">
                        @if ($record && $record->pengalaman_lokal)
                        {{ $record->pengalaman_lokal }}
                        @else
                        Data Tidak Ditemukan
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">Where 何處 (Local)</td>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">
                        @if ($record && $record->ket_pengalaman_lokal)
                        {{ $record->ket_pengalaman_lokal }}
                        @else
                        Data Tidak Ditemukan
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">Recommended for House Keeping</td>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">
                        @if ($record && $record->housekeeping)
                        {{ $record->housekeeping }}
                        @else
                        Data Tidak Ditemukan
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">Recommended for Baby Sitting</td>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">
                        @if ($record && $record->babysitting)
                        {{ $record->babysitting }}
                        @else
                        Data Tidak Ditemukan
                        @endif
                    </td>
                </tr>
            </table>
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
            <h2 class="text-center mb-4 font-bold uppercase box-header">SKILLS</h2>

            <table class="w-full">
                <tr>
                    <th class="text-gray-700 text-sm p-2 font-bold uppercase left-align">Working Experience 工作經驗</th>
                    <th class="text-gray-700 text-sm p-2 font-bold uppercase">YES</th>
                    <th class="text-gray-700 text-sm p-2 font-bold uppercase">NO</th>
                </tr>
                @foreach ([
                '護理嬰兒 Care of Babies' => $record->careofbabies ?? 'Data Tidak Ditemukan',
                '護理兒童 Care of Young Children' => $record->careofyoung ?? 'Data Tidak Ditemukan',
                '家務 Household Works' => $record->householdworks ?? 'Data Tidak Ditemukan',
                '護理老人 Care of Elderly/Disable' => $record->careofelderly ?? 'Data Tidak Ditemukan',
                '烹飪 Cooking' => $record->cooking ?? 'Data Tidak Ditemukan',
                '女傭經驗 Exp. In Housemaid' => $record->housmaid ?? 'Data Tidak Ditemukan',
                ] as $skill => $value)
                <tr>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">{{ $skill }}</td>
                   <td class="text-gray-700 text-sm p-2 font-bold uppercase">
                        @if ($value == 'POOR') ✓ @endif
                    </td>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase">
                        @if ($value == 'FAIR') ✓ @endif
                    </td>
                    <!--<td class="text-gray-700 text-sm p-2 font-bold uppercase">-->
                    <!--    @if ($value == 'GOOD') ✓ @endif-->
                    <!--</td>-->
                    <!-- <td class="text-gray-700 text-sm p-2 font-bold uppercase">
                        @if ($value == 'GOOD') ✓ @endif
                    </td> -->
                    <!-- <td class="text-gray-700 text-sm p-2 font-bold uppercase">
                        @if ($value == 'VERY GOOD') ✓ @endif
                    </td> -->
                </tr>
                @endforeach
            </table>
            <br>

            <table class="w-full">
                <tr>
                    <th class="text-gray-700 text-sm p-2 font-bold uppercase left-align">Language Skills 語言能力</th>
                    <th class="text-gray-700 text-sm p-2 font-bold uppercase">POOR</th>
                    <th class="text-gray-700 text-sm p-2 font-bold uppercase">FAIR</th>
                    <th class="text-gray-700 text-sm p-2 font-bold uppercase">GOOD</th>
                    <!-- <th class="text-gray-700 text-sm p-2 font-bold uppercase">VERY GOOD</th> -->
                </tr>
                @foreach ([
                '能操英語 Spoken English' => $record->spokenenglish ?? 'Data Tidak Ditemukan',
                '能操廣東話 Spoken Cantonese' => $record->spokencantonese ?? 'Data Tidak Ditemukan',
                '能操國語 Spoken Mandarin' => $record->spokenmandarin ?? 'Data Tidak Ditemukan',
                 '個性表現 Personality' => $record->personality ?? 'Data Tidak Ditemukan',
                '儀容 Facial Expression' => $record->facialexpression ?? 'Data Tidak Ditemukan',
                ] as $skill => $value)
                <tr>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">{{ $skill }}</td>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase">
                        @if ($value == 'POOR') ✓ @endif
                    </td>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase">
                        @if ($value == 'FAIR') ✓ @endif
                    </td>
                    <td class="text-gray-700 text-sm p-2 font-bold uppercase">
                        @if ($value == 'GOOD') ✓ @endif
                    </td>
                    <!-- <td class="text-gray-700 text-sm p-2 font-bold uppercase">
                        @if ($value == 'VERY GOOD') ✓ @endif
                    </td> -->
                </tr>
                @endforeach
            </table>
            <br>
            <!-- New Section PETS -->
            <div class="box">
                <h2 class="text-center mb-4 font-bold uppercase box-header">PETS</h2>
                <table class="w-full">
                    <tr>
                        <th class="text-gray-700 text-sm p-2 font-bold uppercase left-align"></th>
                        <th class="text-gray-700 text-sm p-2 font-bold uppercase">YES</th>
                        <th class="text-gray-700 text-sm p-2 font-bold uppercase">NO</th>
                    </tr>
                    @foreach ([
                    '怕狗 Afraid of Dog' => $record->afraidofdog ?? 'Data Tidak Ditemukan',
                    '經驗照顧狗 Exp. Caring for Dogs' => $record->caringdog ?? 'Data Tidak Ditemukan',
                    ] as $skill => $value)
                    <tr>
                        <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">{{ $skill }}</td>
                        <td class="text-gray-700 text-sm p-2 font-bold uppercase">
                            @if ($value === 'YES') ✓ @endif
                        </td>
                        <td class="text-gray-700 text-sm p-2 font-bold uppercase">
                            @if ($value === 'NO') ✓ @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>


    <!-- ---------------------------------------------------------------->

    <!-- <div class="grid grid-cols-2 gap-4"> -->
    <!-- New Section HUSBAN -->
    <div class="box">
        <h2 class="text-center mb-4 font-bold uppercase" style="background-color: skyblue; padding: 10px;">
            HUSBAND</h2>
        <table>
            <!-- <tr>
                <th class="text-gray-700 font-bold uppercase">Label</th>
                <th class="text-gray-700 font-bold uppercase">Value</th>
            </tr> -->
            <tr>
                <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">Name of Spouse 配偶姓名/husband</td>
                <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">
                    @if ($record && $record->nama_suami)
                    {{ $record->nama_suami }}
                    @else
                    Data Tidak Ditemukan
                    @endif
                </td>
            </tr>
            <tr>
                <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">Age 年齡</td>
                <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">
                    @if ($record && $record->usia_suami)
                    {{ $record->usia_suami }} (YO)
                    @else
                    Data Tidak Ditemukan (YO)
                    @endif
                </td>
            </tr>
            <tr>
                <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">Spouse’s Occupation 配偶職業</td>
                <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">
                    @if ($record && $record->pekerjaan_suami)
                    {{ $record->pekerjaan_suami }}
                    @else
                    Data Tidak Ditemukan
                    @endif
                </td>
            </tr>
            <tr>
                <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">No. of Children 子女數</td>
                <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">
                    @if ($record && $record->anakke_suami)
                    {{ $record->anakke_suami }}
                    @else
                    Data Tidak Ditemukan
                    @endif
                </td>
            </tr>
        </table>
        <!-- </div> -->
        <br>

        <!-- New Section PARENTS -->
        <!-- <div class="box"> -->
        <h2 class="text-center mb-4 font-bold uppercase" style="background-color: skyblue; padding: 10px;">
            PARENTS</h2>
        <table>
            <!-- <tr>
                <th class="text-gray-700 text-sm p-2 font-bold uppercase left-align">Label</th>
                <th class="text-gray-700 text-sm p-2 font-bold uppercase left-align">Value</th>
            </tr> -->
            <tr>
                <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">Name of Father/Occupation 父親姓名/職業</td>
                <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">
                    @if ($record && $record->nama_ayah)
                    {{ $record->nama_ayah }}
                    @else
                    Data Tidak Ditemukan
                    @endif
                </td>
            </tr>
            <tr>
                <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">Age of Father 年齡</td>
                <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">
                    @if ($record && $record->usia_ayah)
                    {{ $record->usia_ayah }} (YO)
                    @else
                    Data Tidak Ditemukan (YO)
                    @endif
                </td>
            </tr>
            <tr>
                <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">Name of Mother/Occupation 母親姓/職業</td>
                <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">
                    @if ($record && $record->nama_ibu)
                    {{ $record->nama_ibu }}
                    @else
                    Data Tidak Ditemukan
                    @endif
                </td>
            </tr>
            <tr>
                <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">Age of Mother 年齡</td>
                <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">
                    @if ($record && $record->usia_ibu)
                    {{ $record->usia_ibu }} (YO)
                    @else
                    Data Tidak Ditemukan (YO)
                    @endif
                </td>
            </tr>
            <tr>
                <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">Address Alamat</td>
                <td class="text-gray-700 text-sm p-2 font-bold uppercase left-align">
                    @if ($record && $record->alamat_ortu)
                    {{ $record->alamat_ortu }}
                    @else
                    Data Tidak Ditemukan
                    @endif
                </td>
            </tr>
        </table>
    </div>
    <!-- </div> -->

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
            BRANCH OFFICE : {{ App\Models\Kantor::find($record->kantor_id)->nama ?? 'Tidak ditemukan' }}
            @else
            BRANCH OFFICE : Data Tidak Ditemukan
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