<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;

class Articleseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Testing (image) - Promoted Article',
                'body' => "Wenn hoch vom Himmelsbogen, der Stern zum Meere sieht, \n Dann singen alle Wogen, ein wunderbares Lied. \n Dann singen alle Wogen, ein wunderbares Lied. \n\n Das ist ein Lied, so traurig, wie's nie ein Mensch erdacht! \n Am Felsen rauscht es schaurig, in dunkler Mitternacht. \n Am Felsen rauscht es schaurig, in dunkler Mitternacht. \n\n Die Wogen wünschen leise, die Heimat sich zurück; \n Sie singen eine Weise, von längstverlor'nem Glück. \n Sie singen eine Weise, von längstverlor'nem Glück. \n\n Vom Palmenlande klingen, der Worte viele drein; \n Von Alpengletschern singen, die Wogen aus dem Rhein. \n Von Alpengletschern singen, die Wogen aus dem Rhein. \n\n Die Fischer in den Booten, \n Vernehmen oft den Klang, \n Und tief im Grund die Toten \n Erwachen beim Gesang. \n Es wachen auf die Leichen, \n Wenn so die Welle spricht. \n Die nassen Locken streifen \n Sie aus dem Angesicht. \n\n Sie fleh'n zum Wogenschaume: 'O, unsre Heimat grüß'!' \n Und lispeln wie im Träume: 'Wie war das Leben süß!' \n Und lispeln wie im Träume: 'Wie war das Leben süß!'",
                'user_id' => '2',
                'image_path' => 'Wkgg9d2Ge42jd8kHCOOU9iYpZ427GLuQDNg39Eyc.jpg',
                'is_promoted' => true
            ],[
                'title' => 'Testing (image) - NonPromoted Article',
                'body' => "test 2Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
                'user_id' => '2',
                'image_path' => 'MunfbWmb9twLBdT3x9ItX4vs2vrRh9sr5CGXo4vF.jpg',
                'is_promoted' => false
            ],[
                'title' => 'Testing (no image) - NonPromoted Article',
                'body' => "test 3 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
                'user_id' => '2',
                'image_path' => '0',
                'is_promoted' => false
            ],
        ];
        foreach ($articles as $user) {
            Article::create($user);       
        };

        Article::factory()->count(45)->create();
    }
}
