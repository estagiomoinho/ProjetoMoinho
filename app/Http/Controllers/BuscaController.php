<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Livro;
use App\Sala;
use App\Estante;
use App\Prateleira;

class BuscaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('busca/busca');
    }
    public function buscaAvancada()
    {
        return view('busca/avancado');
    }
    public function buscaExternaSimples(){
        return view('buscaaberta/busca');
    }

    public function buscaExterna(){
        return view('buscaaberta/avancadoexterno');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

   
    public function buscaLivro(Request $R){
        
        $livro = Livro::select('*');

         if($R->cpbusca != null){
            $livro->where('titulo', 'like', '%'.$R->cpbusca.'%')
            ->orwhere('autor', 'like', '%'.$R->cpbusca.'%')
            ->orwhere('sinopse', 'like', '%'.$R->cpbusca.'%')
            ->orwhere('genero', 'like', '%'.$R->cpbusca.'%');
             
        }
        $data = array();
        foreach ( $livro->get() as $a ) {

            $nestedData = array ();
            if ($a->capa=="") {
                 $nestedData [0] = '<div class="capaLivro">'.$a->titulo.'</div>';
            }else{
                $nestedData [0] = '<div class="capaLivro">'.$a->capa.'</div>';
            }
            $nestedData [1] = $a->titulo;
            $nestedData [2] = $a->autor;
            $nestedData [3] = $a->genero;
            $nestedData [4] = $a->editora;
            $prateleira=Prateleira::find($a->prateleira_id);
            $estante=Estante::find($prateleira->id_estante);
            $sala=Sala::find($estante->id_sala);
            $nestedData [5] = "<u><b>Sala</b></u>: ".$sala->nome."<br><u><b>Estante:</b></u>".$estante->nome."<br><u><b>Prateleira:</b></u>".$prateleira->id;

            $data [] = $nestedData;
        }

        return ($data);

    }
    public function buscaAvancadaLivro(Request $R){
        
        $livro = Livro::select('*');

        if(($R->nome != null)&&($R->autor == null)&&($R->genero== null)&& ($R->editora == null)){
            $livro->where('titulo', 'like', '%'.$R->nome.'%');     
        }
        if(($R->autor != null)&&($R->nome == null)&&($R->genero== null)&& ($R->editora == null)){
            $livro->where('autor', 'like', '%'.$R->autor.'%');  
        }
        if(($R->genero!= null)&&($R->nome == null)&&($R->autor== null)&& ($R->editora == null)){
            $livro->where('genero', 'like', '%'.$R->genero.'%');
        }
        if(($R->editora != null)&&($R->nome == null)&&($R->autor== null)&& ($R->genero == null)){
            $livro->where('editora', 'like', '%'.$R->editora.'%');
        }
         if(($R->nome != null)&&($R->autor != null)&&($R->genero!= null)&& ($R->editora != null)){
            $livro->where('titulo', 'like', '%'.$R->nome.'%');
            $livro->where('autor', 'like', '%'.$R->autor.'%'); 
            $livro->where('genero', 'like', '%'.$R->genero.'%');
             $livro->where('editora', 'like', '%'.$R->editora.'%');    
        }
        if(($R->nome != null)&&($R->autor != null)&& ($R->editora != null)&&($R->genero== null)){
            $livro->where('titulo', 'like', '%'.$R->nome.'%');
            $livro->where('autor', 'like', '%'.$R->autor.'%'); 
             $livro->where('editora', 'like', '%'.$R->editora.'%');    
        }
        if(($R->nome != null)&&($R->genero!= null)&& ($R->editora != null)&&($R->oautor== null)){
            $livro->where('titulo', 'like', '%'.$R->nome.'%');
            $livro->where('genero', 'like', '%'.$R->genero.'%');
             $livro->where('editora', 'like', '%'.$R->editora.'%');    
        }
        if(($R->nome != null)&&($R->autor != null)&&($R->genero!= null)&&($R->editora== null)){
            $livro->where('titulo', 'like', '%'.$R->nome.'%');
            $livro->where('autor', 'like', '%'.$R->autor.'%'); 
            $livro->where('genero', 'like', '%'.$R->genero.'%');
        }
        if(($R->autor != null)&&($R->genero!= null)&& ($R->editora != null)&&($R->nome== null)){
            $livro->where('autor', 'like', '%'.$R->autor.'%'); 
            $livro->where('genero', 'like', '%'.$R->genero.'%');
             $livro->where('editora', 'like', '%'.$R->editora.'%');    
        }
       if(($R->nome != null)&&($R->autor != null)&&($R->genero== null)&& ($R->editora == null)){
            $livro->where('titulo', 'like', '%'.$R->nome.'%');
            $livro->where('autor', 'like', '%'.$R->autor.'%');    
        }
        if(($R->nome != null)&&($R->autor == null)&&($R->genero== null)&& ($R->editora != null)){
            $livro->where('titulo', 'like', '%'.$R->nome.'%');
            $livro->where('editora', 'like', '%'.$R->editora.'%');    
        }
        if(($R->nome != null)&&($R->autor == null)&&($R->genero != null)&& ($R->editora == null)){
            $livro->where('titulo', 'like', '%'.$R->nome.'%');
            $livro->where('genero', 'like', '%'.$R->genero.'%');    
        }
        if(($R->nome == null)&&($R->autor != null)&&($R->genero== null)&& ($R->editora != null)){
            $livro->where('autor', 'like', '%'.$R->autor.'%');
            $livro->where('editora', 'like', '%'.$R->editora.'%');    
        }
        if(($R->nome == null)&&($R->autor != null)&&($R->genero!= null)&& ($R->editora == null)){
            $livro->where('autor', 'like', '%'.$R->autor.'%');
            $livro->where('genero', 'like', '%'.$R->genero.'%');    
        }
        if(($R->nome == null)&&($R->autor == null)&&($R->genero!= null)&& ($R->editora != null)){
            $livro->where('genero', 'like', '%'.$R->genero.'%');
            $livro->where('editora', 'like', '%'.$R->editora.'%');    
        }


        $dato = array();
        foreach ( $livro->get() as $a ) {

            $nestedDato = array ();
            if ($a->capa=="") {
                 $nestedDato [0] = '<div class="capaLivro">'.$a->titulo.'</div>';
            }else{
                $nestedDato [0] = '<div class="capaLivro">'.$a->capa.'</div>';
            }
            $nestedDato [1] = $a->titulo;
            $nestedDato [2] = $a->autor;
            $nestedDato [3] = $a->genero;
            $nestedDato [4] = $a->editora;
            $prateleira=Prateleira::find($a->prateleira_id);
            $estante=Estante::find($prateleira->id_estante);
            $sala=Sala::find($estante->id_sala);
            $nestedDato [5] = "<u><b>Sala</b></u>: ".$sala->nome."<br><u><b>Estante:</b></u>".$estante->nome."<br><u><b>Prateleira:</b></u>".$prateleira->id;
            $dato [] = $nestedDato;
        }

        return ($dato);

    }
}