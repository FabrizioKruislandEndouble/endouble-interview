<?php

namespace App\Http\Controllers\API;

use App\Adaptees\SpacexAdaptee;
use App\Adaptees\XKCDAdaptee;
use Illuminate\Http\Request;
use App\Adapters\DataSourceAdapter;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request)
    {
        $queryParams = $request->query->all();

        if (array_key_exists('sourceId', $queryParams)) {
            switch($queryParams['sourceId']){
                case 'spacex':
                    $datasource = new DataSourceAdapter(new SpacexAdaptee());
                    return $datasource->get($queryParams);
                    break;
                case 'comics':
                    $datasource = new DataSourceAdapter(new XKCDAdaptee());
                    return $datasource->get($queryParams);
                    break;
                default:
                    return 'SourceId unkown. Try another SourceId.';
                    break;
            }
        }
    }
}
