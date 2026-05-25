<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\CinemaFact;
use App\Models\FilmAnalysis;
use App\Models\FilmDictionary;
use App\Models\Filmography;
use App\Models\Interview;
use App\Models\Kinogit;
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
//        $q = $request->input();
//        $lang = $request->header('lang', 'oz');
//
//        $film_digests = Premiere::search($q, ['name_oz','name_ru','description_oz','description_uz'],
//            ['id','category_id','images','created_at','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content']);
//
//        $film_diagnostics = FilmAnalysis::search($q, ['name_oz','name_uz','description_oz','description_uz','content_oz','content_uz'],
//            ['id','category_id','name_'.$lang.' as name','description_'.$lang.' as description', 'content_'.$lang.' as content','images','created_at','updated_at']);
//
//        $film_catalogs = Filmography::search($q, ['name_oz','name_uz','description_oz','description_uz','content_oz','content_uz'],
//            ['id','images','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','created_at','updated_at']);
//
//        $film_grids = Kinogit::search($q, ['name_oz','name_uz','description_oz','description_uz','content_oz','content_uz'],
//            ['id','images','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','created_at','updated_at']);
//
//        $book = Books::search($q, ['name_oz','name_uz','description_oz','description_uz','about_oz','about_uz','author_oz','author_uz'],
//            ['id','name_'.$lang.' as name','description_'.$lang.' as description','author_'.$lang.' as author','category_id','date','images','files','about_'.$lang.' as about','created_at']);
//
//        $data = [
//            'film_digests' => $film_digests,
//            'film_diagnostics' => $film_diagnostics,
//            'film_grids' => $film_grids,
//            'film_catalogs' => $film_catalogs,
//            'books' => $book,
//        ];
//        return successJson($data);

        $q = $request->input();
        dd($q);
        $lang = $request->header('lang', 'oz');

        $film_digests = Premiere::where('status', 1)
            ->whereHas('translates', function ($query) use ($q, $lang) {
                $query->where('translates', $lang)
                    ->where(function ($query) use ($q) {
                        $query->where('name', 'like', "%{$q}%")
                            ->orWhere('description', 'like', "%{$q}%")
                            ->orWhere('content', 'like', "%{$q}%");
                    });
            })
            ->with(['translates' => function ($query) use ($lang) {
                $query->where('translates', $lang);
            }])
            ->get()
            ->map(function ($item) {
                $translate = collect($item->translates)->first();
                $arr = $item->toArray();
                unset($arr['translates']);
                $arr['name'] = $translate->name ?? null;
                $arr['description'] = $translate->description ?? null;
                $arr['content'] = $translate->content ?? null;
                return $arr;
            });

        $film_diagnostics = FilmAnalysis::where('status', 1)
            ->whereHas('translates', function ($query) use ($q, $lang) {
                $query->where('translates', $lang)
                    ->where(function ($query) use ($q) {
                        $query->where('name', 'like', "%{$q}%")
                            ->orWhere('description', 'like', "%{$q}%")
                            ->orWhere('content', 'like', "%{$q}%");
                    });
            })
            ->with(['translates' => function ($query) use ($lang) {
                $query->where('translates', $lang);
            }])
            ->get()
            ->map(function ($item) {
                $translate = collect($item->translates)->first();
                $arr = $item->toArray();
                unset($arr['translates']);
                $arr['name'] = $translate->name ?? null;
                $arr['description'] = $translate->description ?? null;
                $arr['content'] = $translate->content ?? null;
                return $arr;
            });

        $film_catalogs = Filmography::where('status', 1)
            ->whereHas('translations', function ($query) use ($q, $lang) {
                $query->where('translates', $lang)
                    ->where(function ($query) use ($q) {
                        $query->where('name', 'like', "%{$q}%")
                            ->orWhere('description', 'like', "%{$q}%")
                            ->orWhere('content', 'like', "%{$q}%");
                    });
            })
            ->with(['translations' => function ($query) use ($lang) {
                $query->where('translates', $lang);
            }])
            ->get()
            ->map(function ($item) {
                $translate = collect($item->translations)->first();
                $arr = $item->toArray();
                unset($arr['translations']);
                $arr['name'] = $translate->name ?? null;
                $arr['description'] = $translate->description ?? null;
                $arr['content'] = $translate->content ?? null;
                return $arr;
            });

        $film_grids = Kinogit::where('status', 1)
            ->whereHas('translates', function ($query) use ($q, $lang) {
                $query->where('translates', $lang)
                    ->where(function ($query) use ($q) {
                        $query->where('name', 'like', "%{$q}%")
                            ->orWhere('description', 'like', "%{$q}%")
                            ->orWhere('content', 'like', "%{$q}%");
                    });
            })
            ->with(['translates' => function ($query) use ($lang) {
                $query->where('translates', $lang);
            }])
            ->get()
            ->map(function ($item) {
                $translate = collect($item->translates)->first();
                $arr = $item->toArray();
                unset($arr['translates']);
                $arr['name'] = $translate->name ?? null;
                $arr['description'] = $translate->description ?? null;
                $arr['content'] = $translate->content ?? null;
                return $arr;
            });

        $book = Books::where('status', 1)
            ->whereHas('translates', function ($query) use ($q, $lang) {
                $query->where('translates', $lang)
                    ->where(function ($query) use ($q) {
                        $query->where('name', 'like', "%{$q}%")
                            ->orWhere('description', 'like', "%{$q}%")
                            ->orWhere('content', 'like', "%{$q}%");
                    });
            })
            ->with(['translates' => function ($query) use ($lang) {
                $query->where('translates', $lang);
            }])
            ->get()
            ->map(function ($item) {
                $translate = collect($item->translates)->first();
                $arr = $item->toArray();
                unset($arr['translates']);
                $arr['name'] = $translate->name ?? null;
                $arr['description'] = $translate->description ?? null;
                $arr['content'] = $translate->content ?? null;
                return $arr;
            });

        $data = [
            'film_digests'     => $film_digests,
            'film_diagnostics' => $film_diagnostics,
            'film_grids'       => $film_grids,
            'film_catalogs'    => $film_catalogs,
            'books'            => $book,
        ];

        return successJson($data, 'ok');
    }
}
