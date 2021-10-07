<?php

namespace ApiWebPsp\Http\Controllers\Api\V1\Admin;

use ApiWebPsp\Models\Base\Registration;
use Illuminate\Http\Request;
use ApiWebPsp\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    //
    public function store(Request $request, $id) {
        try {
            $data = $request->all();
            $lastRegistration = $this->getLastStatus($id);

            if ($lastRegistration) {
                $lastStatus = $lastRegistration['status'];
                if ($lastStatus == "success") {
                    $attempt = $lastRegistration['attempt'];
                    $data['attempt'] = $attempt + 1;
                } else {
                    $data['attempt'] = $lastRegistration['attempt'];
                }
            } else {
                $data['attempt'] = 1;
            }

            $data['solicitation_id'] = $id;
            $registration = Registration::create($data);
            $response = $registration->toArray();
            return response()->json($response, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'data' => $e,
                'message' => $e->getMessage()
            ];
            return response()->json($response, Response::HTTP_PRECONDITION_FAILED);
        }
    }

    private function getLastStatus($id) {
        return Registration::where('solicitation_id', $id)
            ->orderBy('created_at', 'desc')
            ->first();
    }


    public function maxAttempt($id) {
    //SELECT * from registration where attempt = (select max(attempt) from registration)

        $response = DB::table('registration')
            ->where('attempt', '=',
                DB::raw("( SELECT max(attempt) FROM registration WHERE registration.solicitation_id = '$id')"))
            ->where('solicitation_id', $id)
            ->get();

        return response()->json($response, Response::HTTP_OK);
    }

    public function list($id) {
        try {
            $registrations = Registration::where('solicitation_id', $id)->get();
            return response()->json($registrations, Response::HTTP_OK);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'data' => $e,
                'message' => $e->getMessage()
            ];
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }
    }

}
