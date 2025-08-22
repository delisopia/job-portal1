<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application; // pastikan model Application ada
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    // App\Http\Controllers\Admin\ApplicationController.php

public function index()
{
    $applications = Application::with('job')->latest()->get(); // mengambil data + relasi job
    return view('admin.applications.index', compact('applications'));
}
}