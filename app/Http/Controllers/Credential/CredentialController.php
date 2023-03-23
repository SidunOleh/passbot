<?php

namespace App\Http\Controllers\Credential;

use App\Http\Controllers\Controller;
use App\Models\Credential;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CredentialController extends Controller
{
    public function store(Request $request, Site $site)
    {
        try {
            $validated = Validator::validate($request->all(), [
                'name' => 'required|string|min:2',
                'credentials' => 'required|array',
                'credentials.*' => 'string',
            ]);
        } catch (ValidationException $e) {
            return response([
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 422);
        }

        $site->credentials()->create($validated);

        return response([
            'message' => 'Ok',
        ]);
    }

    public function destroy(Site $site, Credential $credential)
    {
        $credential->delete();

        return response([
            'message' => 'Ok',
        ]);
    }
}
