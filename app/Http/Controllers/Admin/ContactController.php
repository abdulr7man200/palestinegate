<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\DataTables\ContactDataTable;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index(ContactDataTable $dataTable)
    {
        return $dataTable->render('admin.contact.index');
    }

    public function destroy($id)
    {
        $data = ContactUs::find($id);

        if (!$data) {
            return response()->json(['error' => 'Not Found.'], 404);
        }

        $data->delete();

        return response()->json(['success' => 'Successfully Deleted']);
    }
}
