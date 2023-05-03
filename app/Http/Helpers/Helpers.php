<?php

use App\Models\SiteLanguage;
use App\Models\Setting;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\ImageManagerStatic as Image;
use Symfony\Component\HttpFoundation\Response;
use Spatie\Permission\Models\Permission;


if (!function_exists('upload')) {
    function upload($path, $file)
    {
        try {
            $filename = uniqid() . '.webp';
            Image::make($file)->resize(null, 800, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('webp', 75)->save(public_path('images/' . $path . '/' . $filename), 60);
            $data['photo'] = 'images/' . $path . '/' . $filename;
            return $data['photo'];
        } catch (Exception $e) {
            return redirect()->back();
        }
    }
}

if (!function_exists('multi_upload')) {
    function multi_upload($path, $files): array|\Illuminate\Http\RedirectResponse
    {
        try {
            $result = [];
            foreach ($files as $file) {
                $filename = uniqid() . '.webp';
                Image::make($file)->resize(null, 800, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode('webp', 75)->save(public_path('images/' . $path . '/' . $filename), 60);
                $result[] = "images/$path/$filename";
            }
            return $result;
        } catch (Exception $e) {
            return redirect()->back();
        }
    }
}

if (!function_exists('check_permission')) {
    function check_permission($permission_name)
    {
        return abort_if(Gate::denies($permission_name), Response::HTTP_FORBIDDEN, '403 Forbidden');

    }
}

if (!function_exists('add_permission')) {
    function add_permission($permission_name)
    {
        try {
            $permission_extensions = ['index', 'create', 'edit', 'delete'];
            foreach ($permission_extensions as $extension) {
                $permission = new \Spatie\Permission\Models\Permission();
                $permission->name = $permission_name . ' ' . $extension;
                $permission->guard_name = 'admin';
                $permission->save();
            }
        } catch (Exception $exception) {
            return redirect()->back();
        }
    }
}


if (!function_exists('active_langs')) {
    function active_langs()
    {
        return SiteLanguage::where('status', 1)->get();
    }
}

if (!function_exists('settings')) {
    function settings($name)
    {
        return Setting::where('name', $name)->value('link');
    }
}

if (!function_exists('validation_response')) {
    function validation_response($name)
    {
        return '<div class="valid-feedback">' . __($name) . ' ' . __('messages.is-correct') . '</div><div class="invalid-feedback">' . __($name) . ' ' . __('messages.not-correct') . '</div>';
    }
}


if (!function_exists('convert_number')) {
    function convert_number($value)
    {
        if ($value >= 1000 and $value < 1000000) {
            return round($value / 1000, 0) . 'k';
        }
        if ($value >= 1000000) {
            return round($value / 1000000, 0) . 'M';
        } else {
            return $value;
        }
    }
}
