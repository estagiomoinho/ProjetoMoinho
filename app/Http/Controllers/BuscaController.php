<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Livro;

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
            $livro->where('titulo', 'like', '%'.$R->cpbusca.'%');
             
        }
        $data = array();
        foreach ( $livro->get() as $a ) {

            $nestedData = array ();
            $nestedData [0] = $a->titulo;
            $nestedData [1] = $a->titulo;
            $nestedData [2] = $a->autor;
            $nestedData [3] = $a->genero;
            $nestedData [4] = $a->editora;
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
            $nestedDato [0] = $a->titulo;
            $nestedDato [1] = $a->titulo;
            $nestedDato [2] = $a->autor;
            $nestedDato [3] = $a->genero;
            $nestedDato [4] = $a->editora;
            $dato [] = $nestedDato;
        }

        return ($dato);

    }
}