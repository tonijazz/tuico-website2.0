<?php

namespace Database\Seeders;

use App\Enums\OrgUnitType;
use App\Models\OrgUnit;
use Illuminate\Database\Seeder;

class DepartmentUnitExamplesSeeder extends Seeder
{
    public function run(): void
    {
        // DRAFT content. Keys are the "order" values within each type.
        $data = [
            'department' => [
                1 => [ // Finance & Administration
                    'en' => [
                        'Financial and administrative operations',
                        'Membership records',
                        'Membership dues procedures',
                    ],
                    'sw' => [
                        'Shughuli za fedha na utawala',
                        'Taarifa za uanachama',
                        'Taratibu za ada ya uanachama',
                    ],
                ],
                2 => [ // Legal
                    'en' => [
                        'Guidance on labour rights',
                        'Support on workplace disputes',
                        'Guidance on disciplinary matters',
                        'Support for collective bargaining',
                    ],
                    'sw' => [
                        'Maelekezo kuhusu haki za wafanyakazi',
                        'Msaada kuhusu migogoro ya kazi',
                        'Maelekezo kuhusu masuala ya kinidhamu',
                        'Msaada katika majadiliano ya pamoja',
                    ],
                ],
                3 => [ // Women, Health, Safety & People with Disabilities
                    'en' => [
                        'Women’s participation and rights',
                        'Workplace health and safety',
                        'Inclusion of workers with disabilities',
                    ],
                    'sw' => [
                        'Ushiriki na haki za wanawake',
                        'Afya na usalama mahali pa kazi',
                        'Ujumuishaji wa wafanyakazi wenye ulemavu',
                    ],
                ],
                4 => [ // Education, Training & Youth
                    'en' => [
                        'Education and training for workers',
                        'Training for union representatives',
                        'Participation of young workers',
                    ],
                    'sw' => [
                        'Elimu na mafunzo kwa wafanyakazi',
                        'Mafunzo kwa wawakilishi wa Chama',
                        'Ushiriki wa vijana wafanyakazi',
                    ],
                ],
            ],
            'unit' => [
                1 => [ // Mobilisation & Strengthening
                    'en' => [
                        'Supporting workers who want to organise',
                        'Strengthening workplace branches',
                        'Connecting new members to regional offices',
                    ],
                    'sw' => [
                        'Kusaidia wafanyakazi wanaotaka kujipanga',
                        'Kuimarisha matawi mahali pa kazi',
                        'Kuunganisha wanachama wapya na ofisi za mikoa',
                    ],
                ],
                2 => [ // Information & Public Relations
                    'en' => [
                        'Public communications',
                        'Union updates and publications',
                        'Media and partnership enquiries',
                    ],
                    'sw' => [
                        'Mawasiliano kwa umma',
                        'Taarifa na machapisho ya Chama',
                        'Maswali ya vyombo vya habari na ushirikiano',
                    ],
                ],
                3 => [ // Statistics & ICT
                    'en' => [
                        'Statistics',
                        'Digital systems',
                        'Website support',
                    ],
                    'sw' => [
                        'Takwimu',
                        'Mifumo ya kidijitali',
                        'Usimamizi wa tovuti',
                    ],
                ],
                4 => [ // Internal Audit
                    'en' => [
                        'Reviewing internal controls',
                        'Checking that union procedures are followed',
                    ],
                    'sw' => [
                        'Kukagua mifumo ya udhibiti wa ndani',
                        'Kukagua kama taratibu za Chama zinafuatwa',
                    ],
                ],
            ],
        ];

        $types = [
            'department' => OrgUnitType::Department,
            'unit' => OrgUnitType::Unit,
        ];

        foreach ($types as $key => $type) {
            $records = OrgUnit::where('type', $type)->get()->keyBy('order');

            foreach ($data[$key] as $order => $translations) {
                $record = $records->get($order);

                if (! $record) {
                    $this->command?->warn("No {$key} with order {$order}");
                    continue;
                }

                foreach ($translations as $locale => $items) {
                    $record->setTranslation('examples', $locale, $items);
                }

                $record->save();
            }
        }
    }
}
