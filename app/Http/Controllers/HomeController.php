<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lemma;
use App\Revisions;
use App\Search;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function dashboard(Request $request)
    {
        $word = strip_tags($request->input("word"));
        if (!$word)
            return back();
        //
        $s = new Search;
        $s->lemma = $word;
        $s->ip =\Request::ip();
        $s->save();
        //
        $lemma = Lemma::where('lemma_text', $word)->first();
        $arr_revs = '';
        if ($lemma)
        {
            $revs = Revisions::where('lemma_id', $lemma->lemma_id)->first()->rev_text;
            $arr_revs = Revisions::get_values($revs);
        }
        return view('welcome')->with(['word' => $word, 'revisions' => $arr_revs]);
    }

    public function statistic(Request $request)
    {
        $date = $request->input("date");
        $ip = $request->input("ip");
        $search = new Search();
        if($date)
            $search = $search->whereRaw("time >= ? AND time <= ?",
                array($date." 00:00:00", $date." 23:59:59"));
        if($ip)
            $search = $search->where('ip', $ip);

        $search = $search->get();
        //
        return view('statistic')->with(['search' => $search, 'date' => $date, 'ip' => $ip]);
    }

    public function top()
    {
        $date = date('Y-m-d',strtotime('-1 week'));
        $search = Search::where('time', '>=', $date)
            ->select('ip')
            ->groupBy('ip')
            ->havingRaw("COUNT(ip) > 3")
            ->limit(10)
            ->get();
        //
        return view('top')->with(['search' => $search]);
    }


}
