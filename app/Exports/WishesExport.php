<?php

namespace App\Exports;

use App\Models\Wishes;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class WishesExport implements FromView ,ShouldAutoSize
{
    public function view(): View
    {
        return view('exports.wishes', [
            'wishes' => Wishes::orderBy('id','desc')->get(),
             'granted' =>Wishes::where('status','Granted')->count(),
        ]);
    }
}
