<?php

namespace Database\Seeders;

use App\Enums\OrgUnitType;
use App\Models\OrgUnit;
use Illuminate\Database\Seeder;

class SectorExamplesSeeder extends Seeder
{
    public function run(): void
    {
        // Keys are the sector "order" values in org_units.
        $examples = [
            1 => [ // Industrial
                'en' => [
                    'Manufacturing and processing (textiles, food and beverages, and building materials)',
                    'Vehicle and metal workshops',
                    'Mines and mineral processing',
                    'Building construction and renovation',
                ],
                'sw' => [
                    'Utengenezaji na usindikaji (nguo, vyakula na vinywaji, na vifaa vya ujenzi)',
                    'Gereji na karakana za vyuma',
                    'Migodi na uchenjuaji wa madini',
                    'Ujenzi na ukarabati wa majengo',
                ],
            ],
            2 => [ // Commercial
                'en' => [
                    'Trade and retail',
                    'Energy and utility infrastructure',
                    'Oil, gas and mineral exploration and extraction',
                    'Freight and dry ports',
                    'Fish landing sites and markets',
                ],
                'sw' => [
                    'Biashara na maduka ya rejareja',
                    'Nishati na miundombinu ya huduma',
                    'Utafiti na uchimbaji wa mafuta, gesi na madini',
                    'Usafirishaji wa mizigo na bandari kavu',
                    'Mialo na masoko ya samaki',
                ],
            ],
            3 => [ // Financial Institutions
                'en' => [
                    'Banks and insurance institutions',
                    'Revenue, tax and social security institutions',
                    'Investment funds and capital markets',
                    'Mobile network agents and financial services',
                    'Gaming companies',
                ],
                'sw' => [
                    'Benki na taasisi za bima',
                    'Taasisi za mapato, kodi na hifadhi ya jamii',
                    'Mifuko ya uwekezaji na masoko ya mitaji',
                    'Wakala wa mitandao ya simu na huduma za fedha',
                    'Kampuni za michezo ya kubahatisha',
                ],
            ],
            4 => [ // Services & Consultancy
                'en' => [
                    'Professional services (audit, legal and consultancy)',
                    'Schools, clinics and colleges',
                    'Tourism and cultural work',
                    'Cleaning and security services',
                    'Informal economy and cooperatives',
                    'Fish farming and the blue economy',
                ],
                'sw' => [
                    'Huduma za kitaalamu (ukaguzi, uwakili na ushauri)',
                    'Shule, zahanati na vyuo',
                    'Utalii na shughuli za sanaa',
                    'Huduma za usafi na ulinzi',
                    'Uchumi usio rasmi na vyama vya ushirika',
                    'Ufugaji wa samaki na uchumi wa bluu',
                ],
            ],
        ];

        $sectors = OrgUnit::where('type', OrgUnitType::Sector)->get()->keyBy('order');

        foreach ($examples as $order => $translations) {
            $sector = $sectors->get($order);

            if (! $sector) {
                $this->command?->warn("No sector with order {$order}");
                continue;
            }

            foreach ($translations as $locale => $items) {
                $sector->setTranslation('examples', $locale, $items);
            }

            $sector->save();
        }
    }
}
