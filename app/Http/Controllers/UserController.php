<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(){
        return view('user.index');
    }
    public function create(){
        return view('user.create');
    }
    public function update(){
        return view('user.update');
    }
    public function home(){
        return "Such devastation... This was not my intention...";
    }

    public function welcome(Request $request){
        $search = $request->input('search');

        $blog = Blog::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
        })->latest()->paginate(3);

        return view('welcome', compact('blog'));
    }

    public function show(Blog $blog){
        return view('article', compact('blog'));
    }

    public function chartData()
    {
        $startDate = Carbon::now()->subDays(6)->startOfDay();

        $blogs = Blog::selectRaw('DATE(created_at) as tanggal, COUNT(*) as jumlah')
            ->where('created_at', '>=', $startDate)
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $labels = collect(range(0, 6))->map(function ($i) {
            return Carbon::now()->subDays(6 - $i)->format('Y-m-d');
        });

        $dataValues = $labels->map(function ($tanggal) use ($blogs) {
            $found = $blogs->firstWhere('tanggal', $tanggal);
            return $found ? $found->jumlah : 0;
        });

        return response()->json([
            'labels' => $labels,
            'data' => $dataValues,
        ]);
    }

}
