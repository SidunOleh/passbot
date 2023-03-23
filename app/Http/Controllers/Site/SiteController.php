<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class SiteController extends Controller
{
    public function index()
    {
        $sites = Site::orderByDesc('created_at')->paginate(10);

        return response([
            'message' => 'Ok',
            'sites' => $sites,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validated = Validator::validate($request->all(), [
                'name' => 'required|string|min:2',
                'url' => 'required|url',
            ]);
        } catch (ValidationException $e) {
            return response([
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 422);
        }

        $site = Site::create($validated);

        return response([
            'message' => 'Ok',
            'site' => $site,
        ]);
    }

    public function destroy(Site $site)
    {
        $site->delete();

        return response([
            'message' => 'Ok',
        ]);
    }

    public function show(Site $site)
    {
        $site['credentials'] = $site->credentials()->orderByDesc('created_at')->get();
       
       return response([
            'message' => 'Ok',
            'site' => $site,
        ]);
    }

    public function update(Request $request, Site $site)
    {
        try {
            $validated = Validator::validate($request->all(), [
                'name' => 'required|string|min:2',
                'url' => 'required|url',
            ]);
        } catch (ValidationException $e) {
            return response([
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 422);
        }

        $site->name = $validated['name'];
        $site->url = $validated['url'];
        $site->save();

        return response([
            'message' => 'Ok',
        ]);
    }
}
