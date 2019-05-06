<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Event;
use App\Events\SendMail;
class TestEventController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}
    public function index()
    {
   Event::fire( new SendMail(1));
    return view('teste.index');
    }
}
