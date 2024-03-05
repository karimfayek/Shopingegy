<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\BaseController;

/**
 * Class SettingController
 * @package App\Http\Controllers\Admin
 */
class SettingController extends BaseController
{
    use UploadAble;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->setPageTitle('Settings', 'Manage Settings');
        return view('admin.settings.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        if ($request->has('site_logo') && ($request->file('site_logo') instanceof UploadedFile)) {

            if (config('settings.site_logo') != null) {
                $this->deleteOne(config('settings.site_logo'));
            }
            $logo = $this->uploadOne($request->file('site_logo'), 'img');
            Setting::set('site_logo', $logo);

        } elseif ($request->has('site_favicon') && ($request->file('site_favicon') instanceof UploadedFile)) {

            if (config('settings.site_favicon') != null) {
                $this->deleteOne(config('settings.site_favicon'));
            }
            $favicon = $this->uploadOne($request->file('site_favicon'), 'img');
            Setting::set('site_favicon', $favicon);

        }elseif ($request->has('home_pre') && ($request->file('home_pre') instanceof UploadedFile)) {

            if (config('settings.home_pre') != null) {
                $this->deleteOne(config('settings.home_pre'));
            }
            $favicon = $this->uploadOne($request->file('home_pre'), 'img');
            Setting::set('home_pre', $favicon);

        } else {

            $keys = $request->except('_token');

            foreach ($keys as $key => $value)
            {
                Setting::set($key, $value);
            }
        }
        return $this->responseRedirectBack('Settings updated successfully.', 'success');
    }
//seller approve 
    public function approve($user_id)
    {
        $user = \App\Models\Seller::findOrFail($user_id);
        $user->update(['approved_at' => now()]);
        $user->active = 1 ;
        $user->save();

        return redirect()->route('admin.sellers.index')->withMessage('User approved successfully');
    }
    public function deactivate($user_id)
    {
        $user = \App\Models\Seller::findOrFail($user_id);
        $user->active = 0 ;
        $user->save();

        return redirect()->route('admin.sellers.index')->withMessage('User deactivated successfully');
    }
    public function activate($user_id)
    {
        $user = \App\Models\Seller::findOrFail($user_id);
       // dd($user->first_name);
        $user->active = 1 ;
        $user->save();

        return redirect()->route('admin.sellers.index')->withMessage('User activated successfully');
    }

    public function sellers()
    {
        $users = \App\Models\Seller::whereNull('approved_at')->get();
        $deactivateds = \App\Models\Seller::where('active' , 0)->get();
        $all = \App\Models\Seller::all();

        return view('admin.sellers', compact('users','all','deactivateds'));
    }
}
