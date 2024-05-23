<?php

namespace App\Http\Feature\Department;

use App\Foundation\Feature;
use App\Models\Department;
use Symfony\Component\HttpFoundation\Response;

class AllDepartmentsFeature extends Feature
{
    /**
     * Handle the request to retrieve all departments.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle()
    {
        $search = strtolower($this->request->search);
        $status = $this->request->status;
        $per_page = $this->request->per_page ?? 5;
        $array_status = [
            'active' => 1,
            'inactive' => 0
        ];

        $departments = Department::when($search, function ($query) use ($search) {
            return $query->whereRaw('LOWER(name) like ?', ["%$search%"]);
        })
            ->when($status !== null, function ($query) use ($array_status, $status) {
                $status = $array_status[$this->request->status] ?? 1;
                return $query->where('status', $status);
            })->paginate((int)$per_page);

        return response()->json($departments, Response::HTTP_OK);
    }
}
