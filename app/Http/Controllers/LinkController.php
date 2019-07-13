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
    public function showlink($titleId, $seasonNumber = null)
    {
        
        $link["link"] = Link::where('id', $titleId)->get();

        foreach($link["link"] as $details) 
        {
          $link["link"]->titlename=$details->title->name;
          $link["link"][0]->izom=$details->url;
        }
       

        return $link;
    }

    
    public function index($id)
    {
        $links = Link::where('title_id', $id)->get();
        return $links;
    }
    public function episode($id,$evad,$epizod)
    {
        $links = Link::where('title_id', $id)->where('season', $evad) ->where('episode', $epizod) ->get();
        return $links;
    }

    public function show($id)
    {
        return Link::FindOrFail($id);
    }


    public function update(Request $request,$id)
    {
        $links = Link::findOrFail($id);
        $links->url = $request->url;
        $links->approved=$request->approved;
        $links->season=$request->season;
        $links->episode=$request->episode;
        $links->quality=$request->quality;
        $links->user_name=$request->user_name;
        $links->label=$request->label;
        $links->save();

    }
    
    public function store(Request $request){
        $links = new Link;
        $links->url = $request->url;
        $links->type="external";
        $links->approved=$request->approved;
        $links->season=$request->season;
        $links->episode=$request->episode;
        $links->quality=$request->quality;
        $links->user_name=$request->user_name;
        $links->label=$request->label;
        $links->title_id=$request->title_id;
        $links->save();
    }

    public function destroy($id){
        $links = Link::findOrFail($id);
        $links->delete();
    }

    public function approved($id){
        $links = Link::findOrFail($id);
        $links->approved=1;
        $links->save();
    }

    public function listnotapproved(){
        $links = Link::where("approved",0)->get();
        return $links;

    }


}
