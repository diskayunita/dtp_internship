<?php

use Illuminate\Database\Seeder;
use App\Agency;
use App\AgencyTranslation;

class AgenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('agencies')->truncate();
        $defaultAgency = ['BUMN','Komunitas','Perusahaan','Sekolah'];
        foreach ($defaultAgency as $key => $value) {
            DB::table('agencies')->insert([
                'name' => $value,
                'description' => $value
            ]);
        }*/

        $agencies_en = [
            'State-Owned Enterprises',
            'Community',
            'Company',
            'School'
        ];
        $description_en = [
            'State-Owned Enterprises Related Group',
            'Community Related Group',
            'Company Related Group',
            'School or Education Related Group'
        ];

        $agencies_id = [
            'BUMN',
            'Komunitas',
            'Perusahaan',
            'Sekolah'
        ];
        $description_id = [
            'Tergolong sebagai Badan Usaha Milik Negara',
            'Tergolong sebagai Komunitas',
            'Tergolong sebagai Perusahaan',
            'Tergolong sebagai Sekolah atau bidang Pendidikan'
        ];

        foreach ($agencies_en as $index => $value) {
            $agency = Agency::create([
                'name' => $value,
                'description' => $description_en[$index],
            ]);

            foreach (config('app.languages') as $key => $lang) {
                $agency->translation()->save(
                    new AgencyTranslation([
                        'name' => $key ? $agencies_id[$index] : $value,
                        'description' => $key ? $description_id[$index] : $description_en[$index],
                        'language' => $lang,
                    ])
                );
            }
        }
    }
}
