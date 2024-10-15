<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\User;

class Messageseeder extends Seeder
{
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $messages = [
            ['user_id' => '2',
            'writer' => 'hasArticles2',
            'text' => "Dođi Švabo da vidiš, gde je srpski Tekeriš, \nsamo nemoj režati kada počneš bežati, \nkad primakneš Trojanu, dušu neopoјanu \nnemoj glasno lajati, grdo ćeš se kajati \n\nKrenuo si u juriš na junački Tekeriš, \nal' tu zube polomi, tvrdog gedžu ne slomi, \ntu zastavu ne vije švapsko srce zečije, \ntu Srbija pobode barjak časti, slobode \n\nLjuta srpska rakija još uvek te opija, \nu grlu ti zastala, čemerna ti postala, \n   ne varaj se kod Drine, priseti se istine, \nopet dođi da vidiš gde je srpski Tekeriš. \n\ngde je srpski Tekeriš."],
            ['user_id' => '2',
            'writer' => 'hasArticles2',
            'text' => "2\nDođi Švabo da vidiš, gde je srpski Tekeriš, \nsamo nemoj režati kada počneš bežati, \nkad primakneš Trojanu, dušu neopoјanu \nnemoj glasno lajati, grdo ćeš se kajati \n\nKrenuo si u juriš na junački Tekeriš, \nal' tu zube polomi, tvrdog gedžu ne slomi, \ntu zastavu ne vije švapsko srce zečije, \ntu Srbija pobode barjak časti, slobode \n\nLjuta srpska rakija još uvek te opija, \nu grlu ti zastala, čemerna ti postala, \n   ne varaj se kod Drine, priseti se istine, \nopet dođi da vidiš gde je srpski Tekeriš. \n\ngde je srpski Tekeriš."],
            ['user_id' => '3',
            'writer' => 'hasArticles',
            'text' => "Dođi Švabo da vidiš, gde je srpski Tekeriš, \nsamo nemoj režati kada počneš bežati, \nkad primakneš Trojanu, dušu neopoјanu \nnemoj glasno lajati, grdo ćeš se kajati \n\nKrenuo si u juriš na junački Tekeriš, \nal' tu zube polomi, tvrdog gedžu ne slomi, \ntu zastavu ne vije švapsko srce zečije, \ntu Srbija pobode barjak časti, slobode \n\nLjuta srpska rakija još uvek te opija, \nu grlu ti zastala, čemerna ti postala, \n   ne varaj se kod Drine, priseti se istine, \nopet dođi da vidiš gde je srpski Tekeriš. \n\ngde je srpski Tekeriš."],
            ['user_id' => '3',
            'writer' => 'hasArticles',
            'text' => "2\nDođi Švabo da vidiš, gde je srpski Tekeriš, \nsamo nemoj režati kada počneš bežati, \nkad primakneš Trojanu, dušu neopoјanu \nnemoj glasno lajati, grdo ćeš se kajati \n\nKrenuo si u juriš na junački Tekeriš, \nal' tu zube polomi, tvrdog gedžu ne slomi, \ntu zastavu ne vije švapsko srce zečije, \ntu Srbija pobode barjak časti, slobode \n\nLjuta srpska rakija još uvek te opija, \nu grlu ti zastala, čemerna ti postala, \n   ne varaj se kod Drine, priseti se istine, \nopet dođi da vidiš gde je srpski Tekeriš. \n\ngde je srpski Tekeriš."],
        ];  
        foreach ($messages as $message) {
            Message::create($message);       
        }
        Message::factory()->count(50)->create();
    }
}
