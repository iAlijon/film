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
        $news = News::search($q, ['name_oz','name_uz','description_oz','description_uz'])->get();
        $premiere = Premiere::search($q, ['name_oz','name_ru','description_oz','description_uz'])->get();
        $analysis = FilmAnalysis::search($q, ['name_oz','name_uz','description_oz','description_uz','content_oz','content_uz'])->get();
        $interview = Interview::search($q, ['interview_oz','interview_uz','description_oz','description_uz','content_oz','content_uz'])->get();
        $persons = Person::search($q,['full_name_oz','full_name_uz','description_oz','description_uz','content_oz','content_uz'])->get();
        $film_dictionary = FilmDictionary::search($q, ['name_oz','name_uz','description_oz','description_uz','content_oz','content_uz'])->get();
        $fact = CinemaFact::search($q, ['name_oz','name_uz','description_oz','description_uz','content_oz','content_uz'])->get();
        $filmography = Filmography::search($q, ['name_oz','name_uz','description_oz','description_uz','content_oz','content_uz'])->get();
        $book = Books::search($q, ['name_oz','name_uz','description_oz','description_uz','about_oz','about_uz','author_oz','author_uz'])->get();
        $data = [
            'news' => $news,
            'premiere' => $premiere,
            'analysis' => $analysis,
            'interview' => $interview,
            'person' => $persons,
            'dictionary' => $film_dictionary,
            'fact' => $fact,
            'filmography' => $filmography,
            'books' => $book,
        ];
        return successJson($data);
    }
}
