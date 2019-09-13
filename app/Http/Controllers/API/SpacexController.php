<?php

namespace App\Http\Controllers\API;

use App\Adaptees\SpacexAdaptee;
use Illuminate\Http\Request;
use App\Adapters\DataSourceAdapter;
use App\Http\Controllers\Controller;

class SpacexController extends Controller
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

        $datasource = new DataSourceAdapter(new SpacexAdaptee());
        
        return $datasource->get($queryParams);

    }
}
