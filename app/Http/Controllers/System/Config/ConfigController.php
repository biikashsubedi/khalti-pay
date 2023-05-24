<?php

namespace App\Http\Controllers\System\Config;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\ConfigRequest;
use App\Models\Config;
use App\Traits\ImageTrait;
use File;

class ConfigController extends Controller
{
    use ImageTrait;

    public $dir = '/uploads/images/config';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexUrl()
    {
        return 'config';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['items'] = Config::get();
        $data['title'] = 'Config';
        $data['indexUrl'] = $this->indexUrl();
        $data['breadcrumbs'] = breadcrumbForIndex('Config', $this->indexUrl());

        return view('system.config.index', $data);
    }

    public function update(ConfigRequest $request, $id)
    {
        $config = Config::find($id);
        if ($request->hasFile('value')) {
            $fileExtension = $request->value->getClientOriginalExtension();
            if (!in_array($fileExtension, ['png', 'jpg', 'jpeg', 'ico'])) {
                return redirect()->back()->withErrors(['alert-danger' => 'Config Image Must be in png, jpg and jpeg']);
            }
        }
        $data = $request->except('_token');
        if (isset($request->dataFromCheckBox)) {
            $data['value'] = !(bool)$data['dataFromCheckBox'];
            unset($data['dataFromCheckBox']);
        }
        if (strtolower($config->type) == 'file') {
            $directory = $this->dir . '/' . str_replace(' ', '', $config->label) . '/';
            $this->removeImage($directory, $config->value);
            $data['value'] = $directory . $this->uploadImage($directory, $request->value);
        }
        $config->update($data);
        return redirect()->back()->withErrors(['alert-success' => 'Update Successfully.']);
    }

    public function removeImage($dir, $image)
    {
        $f1 = storage_path('app/public') . $image;
        File::delete($f1);
    }
}
