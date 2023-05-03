<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;
class Statistics extends Controller
{
    public function index()
    {
      return Analytics::fetchMostVisitedPages(Period::days(7));
    }
}
