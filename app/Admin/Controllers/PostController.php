<?php

namespace App\Admin\Controllers;

use App\Post;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Tab;
use App\Admin\Actions\Post\Trash;
use App\Admin\Extensions\TrashAction;
use Illuminate\Support\Facades\DB;

class PostController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'All Posts';

    /**
     * Make published a grid builder.
     *
     * @return Grid
     */
    public function published()
    {

        $grid = new Grid(new Post());
        
        $grid->model()->where('status', '=', 'publish');
        $grid->column('title', __('Title'));
        $grid->column('category', __('Category'));
        $grid->setName('published');
        $grid->perPages([10, 20, 30]);

        $grid->actions(function ($actions) {
            $actions->disableView(); // remove action view
            $actions->disableDelete(); // remove action delete
            $actions->append(new TrashAction($actions->getKey())); // action trash
        });

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
            $filter->like('category', 'Category');
        });

        return $grid->render();
    }

    /**
     * Make drafts a grid builder.
     *
     * @return Grid
     */
    public function drafts()
    {

        $grid = new Grid(new Post());

        $grid->model()->where('status', '=', 'draft');
        $grid->setName('drafts');
        $grid->perPages([10, 20, 30]);
        
        $grid->column('title', __('Title'));
        $grid->column('category', __('Category'));

        $grid->actions(function ($actions) {
            $actions->disableView(); // remove action view
            $actions->disableDelete(); // remove action delete
            $actions->append(new TrashAction($actions->getKey())); // action trash
        });

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
            $filter->like('category', 'Category');
        });

        return $grid->render();
    }

    /**
     * Make trashed a grid builder.
     *
     * @return Grid
     */
    public function trashed()
    {

        $grid = new Grid(new Post());

        $grid->model()->where('status', '=', 'trash');
        $grid->column('title', __('Title'));
        $grid->column('category', __('Category'));
        $grid->setName('trashed');
        $grid->perPages([10, 20, 30]);

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
            $filter->like('category', 'Category');
        });

        return $grid->render();
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        
        $tab = new Tab();

        $totalPublished = Post::getPublish();
        $totalDrafts = Post::getDraft();
        $totalTrashed = Post::getTrash();

        $tab->add('Published ('.$totalPublished.')', $this->published(),  null, '1');
        $tab->add('Drafts ('.$totalDrafts.')', $this->drafts(), null, '2');
        $tab->add('Trashed ('.$totalTrashed.')', $this->trashed(), null, '3');
        
        return $tab;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Post::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('content', __('Content'));
        $show->field('category', __('Category'));
        $show->field('status', __('Status'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Post());

        $form->text('title', __('Title'))
            ->rules('required|min:20', [
                    'required' => 'Title harus diisi.', 
                    'min' => 'Minimal 20 karakter.' 
                ]);

        $form->textarea('content', __('Content'))
            ->rules('required|min:200', [
                'required' => 'Content harus diisi.', 
                'min' => 'Minimal 200 karakter.' 
            ]);

        $form->text('category', __('Category'))
            ->rules('required|min:3', [
                'required' => 'Category harus diisi.', 
                'min' => 'Minimal 3 karakter.' 
            ]);
            
        $form->radio('status', __('Status'))
            ->options([
                    'publish' => 'publish', 
                    'draft' => 'draft'
                ])
            ->rules('required', [ 'required' => 'Status harus diisi.' ]);

        $form->disableEditingCheck();

        $form->disableCreatingCheck();
    
        $form->disableViewCheck();
    
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });
            
        return $form;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function trash($id)
    {
        try {

            DB::table('posts')
            ->where('id', $id)
            ->update(['status' => 'trash']);

            return response()->json([
                'status'  => true,
                'message' => 'success',
            ]);

        } catch (\Illuminate\Database\QueryException $e) {

            return response()->json([
                'status'  => false,
                'message' => 'error',
            ]);
        }

        
    }
}
