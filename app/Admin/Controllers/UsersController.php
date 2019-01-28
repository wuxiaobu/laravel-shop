<?php

namespace App\Admin\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class UsersController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User);

        $grid->id('Id');
        $grid->name('Name');
        $grid->email('Email');
        $grid->password('Password');
        $grid->remember_token('Remember token');
        $grid->email_verified_at('已验证邮箱')->display(function ($value) {
            return $value ? '是' : '否';
        });
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');

        return $grid;
    }
}
