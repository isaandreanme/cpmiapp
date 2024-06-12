<!DOCTYPE html>
<html lang="id">

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
            border: 2px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .box-header {
            background-color: black;
            color: white;
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
        }

        .box1 {
            justify-content: flex-end;
            display: flex;
            gap: 10px;
            padding: 10px;
        }

        .box p {
            margin: 0;
            background-color: #f5f5f5;
            padding: 5px 10px;
            border-radius: 5px;
            /* font-weight: bold; */
            text-transform: uppercase;
        }

        .box img {
            max-width: 100%;
            height: auto;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem;
        }

        .border-wrapper {
            border: 0px solid #ccc;
            padding: 20px;
        }

        body {
            background-size: 500px 500px;
            background-repeat: no-repeat;
            background-position: center;
            border: 1px solid #ccc;
            padding: 20px;
        }

        .image-container {
            display: flex;
            justify-content: center;
        }

        .img {
            width: 50px;
            height: 50px;
        }

        @media print {
            .box {
                page-break-inside: avoid;
            }

            body {
                /* margin-top: 10mm; Atur sesuai kebutuhan Anda */
                margin: 0;
                padding: 3;
                border: none;
            }

            .border-wrapper {
                padding: 0;
            }

            .box2 {
                display: flex;
                justify-content: space-between;
            }
        }
    </style>
</head>

<body>
    <div class="border-wrapper">
        <div class="grid grid-cols-2 gap-4">
            <div class="image-container">
                <img class="rounded-lg w-full h-auto" src="/images/logonip1.png">
            </div>
            <div class="box">
                <h2 class="text-gray-700 text-4xl p-2 text-center uppercase">
                    @if ($record && $record->code)
                    CODE : {{ $record->code }}
                    @else
                    CODE : -
                    @endif
                </h2>
            </div>
        </div>
    </div>

    <div class="box">
        <h2 class="text-center mb-4 uppercase box-header">Applicants Information Sheet 申請人資料</h2>
        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-1">
                <table class="w-full">
                    <tr>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align" style="background-color: #f3f3f3;">Name 姓名</td>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align">
                            @if ($record && $record->nama)
                            {{ $record->nama }}
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align" style="background-color: #f3f3f3;">Nationality 國籍</td>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align">
                            @if ($record && $record->national)
                            {{ $record->national }}
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align" style="background-color: #f3f3f3;">Gender 性別</td>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align">
                            @if ($record && $record->kelamin)
                            {{ $record->kelamin }}
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align" style="background-color: #f3f3f3;">Education 學歷</td>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align">
                            @if ($record && $record->lulusan)
                            {{ $record->lulusan }}
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align" style="background-color: #f3f3f3;">Religion 宗教</td>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align">
                            @if ($record && $record->agama)
                            {{ $record->agama }}
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align" style="background-color: #f3f3f3;">Ranking by age 家中排行</td>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align">
                            @if ($record && $record->anakke)
                            {{ $record->anakke }}
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align" style="background-color: #f3f3f3;">No. of brother 兄弟數目</td>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align">
                            @if ($record && $record->brother)
                            {{ $record->brother }}
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align" style="background-color: #f3f3f3;">No. of sister 姊妹數目</td>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align">
                            @if ($record && $record->sister)
                            {{ $record->sister }}
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <div class="col-span-1">
                <table class="w-full">
                    <tr>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align" style="background-color: #f3f3f3;">Age 年齡</td>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align">
                            @if ($record && $record->usia)
                            {{ $record->usia }} (YO)
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align" style="background-color: #f3f3f3;">Date of Birth 出生日期</td>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align">
                            @if ($record && $record->tanggal_lahir)
                            {{ $record->tanggal_lahir }}
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align" style="background-color: #f3f3f3;">Marital Status 婚姻狀況</td>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align">
                            @if ($record && $record->status_nikah)
                            {{ $record->status_nikah }}
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align" style="background-color: #f3f3f3;">Height 身高</td>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align">
                            @if ($record && $record->tinggi_badan)
                            {{ $record->tinggi_badan }} (CM)
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align" style="background-color: #f3f3f3;">Weight 體重</td>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align">
                            @if ($record && $record->berat_badan)
                            {{ $record->berat_badan }} (KG)
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align" style="background-color: #f3f3f3;">Son No. / Age 兒子數目/年齡</td>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align">
                            @if ($record && $record->son)
                            {{ $record->son }}
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align" style="background-color: #f3f3f3;">Daughter No. / Age 女兒數目/年齡</td>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align">
                            @if ($record && $record->daughter)
                            {{ $record->daughter }}
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align" style="background-color: #f3f3f3;">Phone Number 電話號碼</td>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align">
                            @if ($record && $record->nomor_hp)
                            {{ $record->nomor_hp }}
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div class="box">
            @if ($record && $record->foto)
            <img class="rounded-lg w-full h-auto" src="/storage/{{ $record->foto }}">
            @else
            <img class="rounded-lg w-full h-auto" src="/images/user.svg">
            @endif

            <br>
            <p class="text-gray-700 text-sm p-2 uppercase">
                @if ($record && $record->remark)
                REMARK 備註 : {{ $record->remark }}
                @else
                -
                @endif
            </p>
        </div>

        <div class="box">
            <h2 class="text-center mb-4 uppercase box-header">Working Experience 工作經驗</h2>

            <table class="w-full">
                <tr>
                    <th class="text-gray-700 text-sm p-2 uppercase left-align"></th>
                    <th class="text-gray-700 text-sm p-2 uppercase">YES 是</th>
                    <th class="text-gray-700 text-sm p-2 uppercase">NO 否</th>
                </tr>
                @foreach ([
                'Care of Babies 照顧嬰兒' => $record->careofbabies ?? '-',
                'Care of Toddler 照顧幼兒 (1-3)' => $record->careoftoddler ?? '-',
                'Care of Children 照顧小孩 (4-12)' => $record->careofchildren ?? '-',
                'Care of Elderly 照顧長者' => $record->careofelderly ?? '-',
                'Care of Disabled 照顧傷殘' => $record->careofdisabled ?? '-',
                'Care of Bedridden 照顧卧床人士' => $record->careofbedridden ?? '-',
                'Care of Pet 照顧寵物' => $record->careofpet ?? '-',
                'Household Works 家務' => $record->householdworks ?? '-',
                'Car Washing 洗車' => $record->carwashing ?? '-',
                'Gardening 打理花園' => $record->gardening ?? '-',
                'Cooking 烹飪' => $record->cooking ?? '-',
                'Driving 駕駛' => $record->driving ?? '-',
                ] as $skill => $value)
                <tr>
                    <td class="text-gray-700 text-sm p-2 uppercase left-align">{{ $skill }}</td>
                    <td class="text-gray-700 text-sm p-2 uppercase">
                        @if ($value == 'YES') ✓ @endif
                    </td>
                    <td class="text-gray-700 text-sm p-2 uppercase">
                        @if ($value == 'NO') X @endif
                    </td>
                </tr>
                @endforeach
            </table>
            <br>

            <table class="w-full">
                <tr>
                    <th class="text-gray-700 text-sm p-2 uppercase left-align">Language Skills 語言能力</th>
                    <th class="text-gray-700 text-sm p-2 uppercase">POOR 差</th>
                    <th class="text-gray-700 text-sm p-2 uppercase">FAIR 平</th>
                    <th class="text-gray-700 text-sm p-2 uppercase">GOOD 好</th>
                </tr>
                @foreach ([
                '英語 English' => $record->spokenenglish ?? '-',
                '廣東話 Cantonese' => $record->spokencantonese ?? '-',
                '國語 Mandarin' => $record->spokenmandarin ?? '-',
                ] as $skill => $value)
                <tr>
                    <td class="text-gray-700 text-sm p-2 uppercase left-align">{{ $skill }}</td>
                    <td class="text-gray-700 text-sm p-2 uppercase">
                        @if ($value == 'POOR') ✓ @endif
                    </td>
                    <td class="text-gray-700 text-sm p-2 uppercase">
                        @if ($value == 'FAIR') ✓ @endif
                    </td>
                    <td class="text-gray-700 text-sm p-2 uppercase">
                        @if ($value == 'GOOD') ✓ @endif
                    </td>
                </tr>
                @endforeach
            </table>
            <br>
        </div>
    </div>
    <br>
    <div class="box">
        <h2 class="text-center mb-4 uppercase box-header">Previous Duties 過往工作</h2>
        <div class="text-gray-700 text-sm p-2 uppercase">
            @if ($record && isset($record['pengalaman']) && is_array($record['pengalaman']))
            @foreach ($record['pengalaman'] as $experience)
            <div class="experience-entry p-2 mb-2">
                <div class="box">
                    <tr>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align" style="background-color: #f3f3f3;"><b>Previous Duties 過往工作</b></td>
                        <td class="text-gray-700 text-sm p-2 uppercase left-align">
                            <b> : {{ $experience['nomorpengalaman'] ?? '-' }} </b>
                        </td>
                    </tr>
                    <br>
                    <br>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-1">
                            <table class="w-full">
                                <tr>
                                    <td class="text-gray-700 text-sm p-2 uppercase left-align" style="background-color: #f3f3f3;">Working Country 工作國家</td>
                                    <td class="text-gray-700 text-sm p-2 uppercase left-align">
                                        {{ $experience['negara'] ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-gray-700 text-sm p-2 uppercase left-align" style="background-color: #f3f3f3;">From:</td>
                                    <td class="text-gray-700 text-sm p-2 uppercase left-align">
                                        {{ $experience['tahunmulai'] ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-gray-700 text-sm p-2 uppercase left-align" style="background-color: #f3f3f3;">To:</td>
                                    <td class="text-gray-700 text-sm p-2 uppercase left-align">
                                        {{ $experience['tahunselesai'] ?? '-' }}
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-span-1">
                            <table class="w-full">
                                <tr>
                                    <td class="text-gray-700 text-sm p-2 uppercase left-align" style="background-color: #f3f3f3;">Reason to Leave 離職原因</td>
                                    <td class="text-gray-700 text-sm p-2 uppercase left-align">
                                        {{ $experience['alasan'] ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-gray-700 text-sm p-2 uppercase left-align" style="background-color: #f3f3f3;">Salary 工資</td>
                                    <td class="text-gray-700 text-sm p-2 uppercase left-align">
                                        {{ $experience['gaji'] ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-gray-700 text-sm p-2 uppercase left-align" style="background-color: #f3f3f3;">No. of Serve 總服務人數</td>
                                    <td class="text-gray-700 text-sm p-2 uppercase left-align">
                                        {{ $experience['jumlahorang'] ?? '-' }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <br>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-1">
                            <table class="w-full">
                                <tr>
                                    <th class="text-gray-700 text-sm p-2 uppercase left-align"></th>
                                    <th class="text-gray-700 text-sm p-2 uppercase">YES 是</th>
                                    <th class="text-gray-700 text-sm p-2 uppercase">NO 否</th>
                                    <th class="text-gray-700 text-sm p-2 uppercase">Age 年齡</th>
                                </tr>
                                @foreach ([
                                'Care of Babies 照顧嬰兒' => $experience['careofbabies'] ?? '-',
                                'Care of Toddler 照顧幼兒 (1-3)' => $experience['careoftoddler'] ?? '-',
                                'Care of Children 照顧小孩 (4-12)' => $experience['careofchildren'] ?? '-',
                                'Care of Elderly 照顧長者' => $experience['careofelderly'] ?? '-',
                                'Care of Disabled 照顧傷殘' => $experience['careofdisabled'] ?? '-',
                                'Care of Bedridden 照顧卧床人士' => $experience['careofbedridden'] ?? '-',
                                ] as $skill => $value)
                                <tr>
                                    <td class="text-gray-700 text-sm p-2 uppercase left-align">{{ $skill }}</td>
                                    <td class="text-gray-700 text-sm p-2 uppercase">
                                        @if ($value == 'YES') ✓ @endif
                                    </td>
                                    <td class="text-gray-700 text-sm p-2 uppercase">
                                        @if ($value == 'NO') X @endif
                                    </td>
                                    <td class="text-gray-700 text-sm p-2 ">
                                        @if ($skill == 'Care of Babies 照顧嬰兒')
                                        {{ $experience['usiabayi'] ? $experience['usiabayi'] . ' Yrs 歲' : '-' }}
                                        @elseif ($skill == 'Care of Toddler 照顧幼兒 (1-3)')
                                        {{ $experience['usiabalita'] ? $experience['usiabalita'] . ' Yrs 歲' : '-' }}
                                        @elseif ($skill == 'Care of Children 照顧小孩 (4-12)')
                                        {{ $experience['usiaanak'] ? $experience['usiaanak'] . ' Yrs 歲' : '-' }}
                                        @elseif ($skill == 'Care of Elderly 照顧長者')
                                        {{ $experience['usialansia'] ? $experience['usialansia'] . ' Yrs 歲' : '-' }}
                                        @elseif ($skill == 'Care of Disabled 照顧傷殘')
                                        {{ $experience['usiadisable'] ? $experience['usiadisable'] . ' Yrs 歲' : '-' }}
                                        @elseif ($skill == 'Care of Bedridden 照顧卧床人士')
                                        {{ $experience['usialumpuh'] ? $experience['usialumpuh'] . ' Yrs 歲' : '-' }}
                                        @else
                                        {{ $experience['usia'] ? $experience['usia'] . ' Yrs 歲' : '-' }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="col-span-1">
                            <table class="w-full">
                                <tr>
                                    <th class="text-gray-700 text-sm p-2 uppercase left-align"></th>
                                    <th class="text-gray-700 text-sm p-2 uppercase">YES 是</th>
                                    <th class="text-gray-700 text-sm p-2 uppercase">NO 否</th>
                                </tr>
                                @foreach ([
                                'Care of Pet 照顧寵物' => $experience['careofpet'] ?? '-',
                                'Household Works 家務' => $experience['householdworks'] ?? '-',
                                'Car Washing 洗車' => $experience['carwashing'] ?? '-',
                                'Gardening 打理花園' => $experience['gardening'] ?? '-',
                                'Cooking 烹飪' => $experience['cooking'] ?? '-',
                                'Driving 駕駛' => $experience['driving'] ?? '-',
                                ] as $skill => $value)
                                <tr>
                                    <td class="text-gray-700 text-sm p-2 uppercase left-align">{{ $skill }}</td>
                                    <td class="text-gray-700 text-sm p-2 uppercase">
                                        @if ($value == 'YES') ✓ @endif
                                    </td>
                                    <td class="text-gray-700 text-sm p-2 uppercase">
                                        @if ($value == 'NO') X @endif
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            @endif
        </div>
    </div>




    <div class="box">
        <h2 class="text-center mb-4 uppercase box-header">Other Question 其他問題</h2>
        <table class="w-full">
            <tr>
                <th class="text-gray-700 text-sm p-2 uppercase left-align"></th>
                <th class="text-gray-700 text-sm p-2 uppercase">YES 是</th>
                <th class="text-gray-700 text-sm p-2 uppercase">NO 否</th>
            </tr>
            @foreach ([
            'Do you eat pork? 你吃豬肉嗎?' => $record->babi ?? '-',
            'Accept Day-off not on Sunday? 接受假日不在星期日?' => $record->liburbukanhariminggu ?? '-',
            'Sharing a room with babies / children / elder? 你願意和小孩/嬰兒/長者同房嗎?' => $record->berbagikamar ?? '-',
            'Are you afraid of dog or cat? 你會害怕狗或貓?' => $record->takutanjing ?? '-',
            'Do you smoke? 你會抽煙嗎?' => $record->merokok ?? '-',
            'Do you drink alcohol? 你會喝酒嗎?' => $record->alkohol ?? '-',
            'Have you any prolonged illnesses / undergone surgery?你有任何長期的疾病/做過手術嗎?' => $record->pernahsakit ?? '-',
            ] as $skill => $value)
            <tr>
                <td class="text-gray-700 text-sm p-2 uppercase left-align">{{ $skill }}</td>
                <td class="text-gray-700 text-sm p-2 uppercase">
                    @if ($value == 'YES') ✓ @endif
                </td>
                <td class="text-gray-700 text-sm p-2 uppercase">
                    @if ($value == 'NO') X @endif
                </td>
            </tr>
            @endforeach
        </table>
        <br>
        <table class="w-full">
            <tr>
                <td class="text-gray-700 text-sm p-2 uppercase left-align">If Yes, 如有</td>
                <td class="text-gray-700 text-sm p-2 uppercase left-align">
                    @if ($record && $record->ketsakit)
                    {{ $record->ketsakit }}
                    @else
                    -
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <div style="text-align: center;">
        <p style="font-size: small;">
            Declaration by Applicant <br>
            I agree and will be responsible for any publication of above information. I hereby confirm that all information and answer give to me is to the best of my knowledge. <br>
            “The applicant gives all information with No responsibility holding by our company.” “以上資料由申請者提供, 任何法律責任與本公司無關。”
        </p>
    </div>

    <div class="box1">
        <p class="text-gray-700 text-sm p-2 uppercase">
            @if ($record->kantor_id)
            BRANCH OFFICE : {{ App\Models\Kantor::find($record->kantor_id)->nama ?? 'Tidak ditemukan' }}
            @else
            BRANCH OFFICE : -
            @endif
        </p>
        <p class="text-gray-700 text-sm p-2 uppercase">
            @if ($record->kantor_id)
            MARKETING : {{ App\Models\Marketing::find($record->marketing_id)->nama ?? 'Tidak ditemukan' }}
            @else
            MARKETING : -
            @endif
        </p>
    </div>
</body>

</html>