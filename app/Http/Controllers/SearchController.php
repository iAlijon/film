<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\CinemaFact;
use App\Models\FilmAnalysis;
use App\Models\FilmDictionary;
use App\Models\Filmography;
use App\Models\Interview;
use App\Models\News;
use App\Models\Person;
use App\Models\Premiere;
use App\Traits\GlobalSearch;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    use GlobalSearch;
    public function search(Request $request)
    {
        $q = $request->input();
        $lang = $request->header('lang', 'oz');
        $news = News::search($q, ['name_oz','name_uz','description_oz','description_uz'],
            ['id','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','category_id','image','status','view_count','created_at']);

        $premiere = Premiere::search($q, ['name_oz','name_ru','description_oz','description_uz'],
            ['id','category_id','images','created_at','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content']);

        $analysis = FilmAnalysis::search($q, ['name_oz','name_uz','description_oz','description_uz','content_oz','content_uz'],
            ['id','category_id','name_'.$lang.' as name','description_'.$lang.' as description', 'content_'.$lang.' as content','images','created_at','updated_at']);

        $interview = Interview::search($q, ['interview_oz','interview_uz','description_oz','description_uz','content_oz','content_uz'],
            ['id', 'interview_people_id' ,'interview_'.$lang.' as interview', 'description_'.$lang.' as description', 'content_'.$lang.' as content','created_at']);

        $persons = Person::search($q,['full_name_oz','full_name_uz','description_oz','description_uz','content_oz','content_uz'],
            ['id','category_id','images','birth_date','full_name_'.$lang.' as full_name','description_'.$lang.' as description','content_'.$lang.' as content','created_at','updated_at']);

        $film_dictionary = FilmDictionary::search($q, ['name_oz','name_uz','description_oz','description_uz','content_oz','content_uz'],
            ['id','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','created_at','updated_at']);

        $fact = CinemaFact::search($q, ['name_oz','name_uz','description_oz','description_uz','content_oz','content_uz'],
            ['id','images','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','created_at','updated_at']);

        $filmography = Filmography::search($q, ['name_oz','name_uz','description_oz','description_uz','content_oz','content_uz'],
            ['id','images','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','created_at','updated_at']);

        $book = Books::search($q, ['name_oz','name_uz','description_oz','description_uz','about_oz','about_uz','author_oz','author_uz'],
            ['id','name_'.$lang.' as name','description_'.$lang.' as description','author_'.$lang.' as author','category_id','date','images','files','about_'.$lang.' as about','created_at']);

        $data = [
            'news' => $news,
            'premiere' => $premiere,
            'analysis' => $analysis,
            'interviews' => $interview,
            'persons' => $persons,
            'dictionary' => $film_dictionary,
            'facts' => $fact,
            'filmography' => $filmography,
            'books' => $book,
        ];
        return successJson($data);
    }
}
