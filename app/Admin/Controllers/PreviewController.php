<?php

namespace App\Admin\Controllers;

use App\Post;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PreviewController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Preview';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Post());

        $grid->model()->where('status', '=', 'publish')->paginate(10);
        $grid->column('Blog List')->view('preview');

        //remove button actions
        $grid->disableActions();
        //remove button create
        $grid->disableCreateButton();
        //remove column selector
        $grid->disableColumnSelector();

        //filter
        $grid->filter(function($filter){

            // Remove the default id filter
            $filter->disableIdFilter();
        
            // Add a column filter
            $filter->like('title', 'Title');
            $filter->like('content', 'Content');
            $filter->like('category', 'Category');
        });

        return $grid;
    }
}
