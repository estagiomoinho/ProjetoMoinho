<?php

namespace App\Widgets;

use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;
use App\Livro;

class LivroDimmer extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //$count = Voyager::model('Livro')->count();
        $count = Livro::count();
        $string = "Livros";

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-book',
            'title'  => "{$count} {$string}",
            'text'   => "Tem {$count} Livros no seu banco de dados. Clique no botão abaixo para ver todos os livros.",
            'button' => [
                'text' => 'Ver Livros',
                'link' => route('voyager.livros.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/03.jpg'),
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        //return true;
        return app('VoyagerAuth')->user()->can('browse', app(Livro::class));
    }
}
