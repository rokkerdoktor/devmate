<?php

Route::group(['prefix' => 'secure'], function () {
    // titles
    Route::get('movies/{id}', 'TitleController@show');
    Route::get('series/{id}', 'TitleController@show');
    Route::get('titles/{id}', 'TitleController@show');
    Route::get('titles/{id}/related', 'RelatedTitlesController@index');
    Route::get('titles', 'TitleController@index');
    Route::post('titles', 'TitleController@store');
    Route::post('titles/credits', 'TitleCreditController@store');
    Route::post('titles/credits/reorder', 'TitleCreditController@changeOrder');
    Route::put('titles/credits/{id}', 'TitleCreditController@update');
    Route::delete('titles/credits/{id}', 'TitleCreditController@destroy');
    Route::put('titles/{id}', 'TitleController@update');
    Route::delete('titles', 'TitleController@destroy');

    
    //Linkplayer
    Route::get('linkplay/{id}', 'LinkController@showlink');
        //Link
        Route::get('linklist', 'LinkController@listnotapproved');
        Route::put('linkapproved/{id}', 'LinkController@approved');
        Route::get('link/{id}', 'LinkController@index');
        Route::get('link/{id}/season/{evad}/episode/{epizod}', 'LinkController@episode');
        Route::get('link/show/{id}', 'LinkController@show');
        Route::post('link', 'LinkController@store');
        Route::put('link/{id}', 'LinkController@update');
        Route::delete('link/{id}', 'LinkController@destroy');
        
    // seasons
    Route::post('titles/{titleId}/seasons', 'SeasonController@store');
    Route::delete('seasons/{seasonId}', 'SeasonController@destroy');

    // episodes
    Route::get('episodes/{id}', 'EpisodeController@show');
    Route::post('seasons/{seasonId}/episodes', 'EpisodeController@store');
    Route::put('episodes/{id}', 'EpisodeController@update');
    Route::delete('episodes/{id}', 'EpisodeController@destroy');

    // people
    Route::get('people', 'PersonController@index');
    Route::get('people/{id}', 'PersonController@show');
    Route::post('people', 'PersonController@store');
    Route::put('people/{id}', 'PersonController@update');
    Route::delete('people', 'PersonController@destroy');

    // search
    Route::get('search/{query}', 'SearchController@index');

    // update
    Route::get('update', 'UpdateController@show');
    Route::post('update/run', 'UpdateController@update');

    // lists
    Route::get('lists', 'ListController@index');
    Route::get('lists/{id}', 'ListController@show');
    Route::post('lists', 'ListController@store');
    Route::put('lists/{id}', 'ListController@update');
    Route::post('lists/{id}/reorder', 'ListOrderController@changeOrder');
    Route::delete('lists', 'ListController@destroy');

    // list items
    Route::post('lists/{id}/add', 'ListItemController@add');
    Route::post('lists/{id}/remove', 'ListItemController@remove');

    // homepage
    Route::get('homepage/lists', 'HomepageContentController@show');

    // related videos
    Route::get('related-videos', 'RelatedVideosController@index');

    // images
    Route::post('images', 'ImagesController@store');
    Route::delete('images', 'ImagesController@destroy');

    // reviews
    Route::get('reviews', 'ReviewController@index');
    Route::post('reviews', 'ReviewController@store');
    Route::put('reviews/{id}', 'ReviewController@update');
    Route::delete('reviews', 'ReviewController@destroy');

    // news
    Route::get('news', 'NewsController@index');
    Route::get('news/{id}', 'NewsController@show');
    Route::post('news', 'NewsController@store');
    Route::put('news/{id}', 'NewsController@update');
    Route::delete('news', 'NewsController@destroy');

    // videos
    Route::get('videos', 'VideosController@index');
    Route::post('videos', 'VideosController@store');
    Route::put('videos/{id}', 'VideosController@update');
    Route::delete('videos', 'VideosController@destroy');
    Route::post('videos/{id}/rate', 'VideoRatingController@rate');
    Route::post('titles/{id}/videos/change-order', 'VideoOrderController@changeOrder');

    // title tags
    Route::post('titles/{titleId}/tags', 'TitleTagsController@store');
    Route::delete('titles/{titleId}/tags/{type}/{tagId}', 'TitleTagsController@destroy');

    // import
    Route::post('media/import', 'ImportMediaController@importMediaItem');
    Route::get('tmdb/import', 'ImportMediaController@importViaBrowse');
});

// FRONT-END ROUTES THAT NEED TO BE PRE-RENDERED
$homeController = '\Common\Core\Controllers\HomeController@show';
Route::get('/', 'HomepageContentController@show')->middleware('prerenderIfCrawler');
Route::get('browse', 'TitleController@index')->middleware('prerenderIfCrawler');
Route::get('titles/{id}', 'TitleController@show')->middleware('prerenderIfCrawler');
Route::get('titles/{id}/season/{season}/episode/{episode}', 'EpisodeController@show')->middleware('prerenderIfCrawler');
Route::get('titles/{id}/season/{season}', 'TitleController@show')->middleware('prerenderIfCrawler');
Route::get('people', 'PersonController@index')->middleware('prerenderIfCrawler');
Route::get('people/{id}', 'PersonController@show')->middleware('prerenderIfCrawler');
Route::get('news', 'NewsController@index')->middleware('prerenderIfCrawler');
Route::get('news/{id}', 'NewsController@show')->middleware('prerenderIfCrawler');
Route::get('lists/{id}', 'ListController@show')->middleware('prerenderIfCrawler');

// CATCH ALL ROUTES AND REDIRECT TO HOME
Route::get('{all}', $homeController)->where('all', '.*');
