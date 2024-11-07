<?php

// AdminController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.item_groups.index');  // Ensure this view exists
    }
}



?>