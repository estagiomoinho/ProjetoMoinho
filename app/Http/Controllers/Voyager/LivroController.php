<?php

namespace App\Http\Controllers\Voyager;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataRestored;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use App\Prateleira;

class LivroController extends VoyagerBaseController
{
    use BreadRelationshipParser;

    /**
     * POST BRE(A)D - Store data.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows)->validate();
        $Prateleira = Prateleira::where('genero', '=', $request->genero)->first();
        //return var_dump($Prateleira);

        if ($Prateleira != null && $Prateleira != 'null') {
            $request->merge([
             'prateleira_id' => $Prateleira->id,
         ]);
            if ($Prateleira->cheio) {
                return redirect()
                ->route("voyager.{$dataType->slug}.index")
                ->with([
                    'message'    =>'Erro: Prateleira cheia',
                    'alert-type' => 'error',
                ]);
            }
        }else{
            return redirect()
            ->route("voyager.{$dataType->slug}.index")
            ->with([
                'message'    =>'Erro: Não existe prateleira disponível para o gênero informado',
                'alert-type' => 'error',
            ]);
        }
        $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());

        event(new BreadDataAdded($dataType, $data));

        return redirect()
        ->route("voyager.{$dataType->slug}.index")
        ->with([
            'message'    => __('voyager::generic.successfully_added_new')." {$dataType->display_name_singular}",
            'alert-type' => 'Livro adicionado à prateleira com sucesso',
        ]);
    }
}