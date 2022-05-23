<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class Trash extends RowAction
{
    public $name = 'Trash';

    public function dialog()
    {
        $this->warning('Apakah anda yakin?');
    }

    public function handle(Model $model)
    {

        return $this->response()->success('Success message.')->refresh();
    }

}