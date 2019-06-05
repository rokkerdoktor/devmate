<?php

namespace App\Http\Controllers;

use App\Episode;
use App\Image;
use App\Jobs\IncrementModelViews;
use App\Listable;
use App\Review;
use App\Season;
use App\Services\Titles\Retrieve\PaginateTitles;
use App\Services\Titles\Retrieve\ShowTitle;
use App\Services\Titles\Store\StoreTitleData;
use App\Title;
use App\Link;
use Common\Core\Controller;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class LinkController extends Controller
{
    public function show($titleId, $seasonNumber = null)
    {
        
        $link["link"] = Link::where('id', $titleId)->get();

        foreach($link["link"] as $details) 
        {
          $link["link"]->titlename=$details->title->name;
          $link["link"][0]->izom=$details->url;
        }
       

        return $link;
    }



}
