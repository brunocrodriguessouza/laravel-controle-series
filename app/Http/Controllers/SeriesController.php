<?php

namespace App\Http\Controllers;

use App\Serie;
use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;

class SeriesController extends Controller
{

    public function index(Request $request) {
        $series = Serie::query()
        ->orderBy('nome')
        ->get();

        $mensagem = $request->session()->get('mensagem');

        return view ('series.index', compact('series', 'mensagem'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request) 
    {
        $serie = Serie::create($request->all());
        $request->session()
            ->flash(
                'mensagem',
                "Série {$serie->id} criada com sucesso {$serie->nome}"
            );

        return redirect() -> route('listar_series');
    }

    public function destroy(Request $request)
    {
        Serie::destroy($request->id);
        $request->session()
        ->flash(
            'mensagem',
            "Série removida com sucesso!"
        );

        return redirect() -> route('listar_series');
    }
}

    // $series = [ 
    //     'Grey\'s Anatomy',
    //     'Lost',
    //     'Agents of SHIELD'
    // ];

    // $series = Serie::all();

    // echo "Série com id {$serie->id} criada: {$serie->nome}";

    // $series = Serie::query()->orderBy('nome')->get();

    // $nome = $request -> nome;
    // $serie = $Serie::create([
    //     'nome' => $nome
    // ]);

    // $serie = new Serie();
    // $serie -> nome = $nome;
    
    // var_dump($serie -> save());;

    // $html = "<ul>";
    // foreach ($series as $serie) {
    //     $html .= "<li>$serie</li>";
    // }
    // $html .=  "<ul>";

    // return $html;