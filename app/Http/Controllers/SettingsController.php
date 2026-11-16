<?php
namespace App\Http\Controllers;
class SettingsController extends Controller { public function index(){ $settings=['business_name'=>'Palma General Store','address'=>'San Carlos City, Pangasinan','contact_number'=>'075-532-1000','email'=>'admin@palma.local','timezone'=>'Asia/Manila','standard_hours'=>8,'workdays'=>6,'work_start'=>'08:00','work_end'=>'17:00','grace_period'=>10,'payroll_frequency'=>'Semi-Monthly','cutoff_day'=>15,'pay_day'=>20,'cooldown'=>30]; return view('settings.index',compact('settings')); } }
