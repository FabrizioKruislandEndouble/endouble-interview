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
     * Retrieve corresponding DataSource
     *
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request)
    {

        // Retrieve all query params
        $queryParams = $request->query->all();

        // Check if there is a sourceId given
        if (array_key_exists('sourceId', $queryParams)) {

            // Retrieve data from DataSource based on given sourceId
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
                    return response()->json(['message' => 'SourceId unkown. Try another SourceId.', 'status' => 204]);
                    break;
            }
        }

        return response()->json(['message' => 'No SourceId given. Please give a SourceId.', 'status' => 204]);
    }
}
