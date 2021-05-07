<?php

namespace App\Http\Controllers\Backend;

use App\Controllers\Requests\BaseRequest;
use App\Http\Controllers\Controller;
use App\Services\AppBaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
/**
 * Class BaseBackendController
 * base controller for backend
 * please set protected 
 *                      @var $service
 *                      @var $view_index
 *                      @var $view_create
 *                      @var $view_edit
 */
class BaseBackendController extends Controller
{
    /**
     * @var Service
     */
    protected $service;
    protected $view_index;
    protected $view_create;
    protected $view_edit;

    public function __construct(AppBaseService $service)
    {
        $this->service = $service;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view($this->view_index);
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view($this->view_create);
    }

}
