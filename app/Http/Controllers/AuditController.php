<?php
namespace App\Http\Controllers;
class AuditController extends Controller { public function index(){ $entries=require resource_path('data/audit_logs.php'); $categories=array_values(array_unique(array_column($entries,'action_category'))); return view('audit.index',compact('entries','categories')); } }
