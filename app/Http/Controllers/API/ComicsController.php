<?php

namespace App\Http\Controllers\API;

use App\Adaptees\XKCDAdaptee;
use Illuminate\Http\Request;
use App\Adapters\DataSourceAdapter;
use App\Http\Controllers\Controller;

class ComicsController extends Controller
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

        $datasource = new DataSourceAdapter(new XKCDAdaptee());
        
        return $datasource->get('comics', $queryParams);
    }
}
