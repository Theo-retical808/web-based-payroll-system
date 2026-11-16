<?php

namespace App\Http\Controllers;

class AttendanceController extends Controller
{
    private function data(): array { return [require resource_path('data/employees.php'), require resource_path('data/attendance.php')]; }
    public function overview()
    {
        [$employees, $data] = $this->data(); $records = $data['records']; $month = date('Y-m');
        $monthRecords = array_values(array_filter($records, fn ($r) => str_starts_with($r['work_date'], $month)));
        $stats = ['total' => count($monthRecords), 'present' => 0, 'late' => 0, 'absent' => 0];
        foreach ($monthRecords as $r) if (isset($stats[strtolower($r['status'])])) $stats[strtolower($r['status'])]++;
        $days = (int) date('t'); $scheduledDays = 0; for ($d=1; $d <= $days; $d++) if ((int) date('N', strtotime("$month-".sprintf('%02d',$d))) <= 5) $scheduledDays++;
        $summary = []; foreach ($employees as $e) { $mine = array_values(array_filter($monthRecords, fn ($r) => $r['employee_id'] === $e['employee_id'])); $present=count(array_filter($mine,fn($r)=>$r['status']==='Present')); $summary[]=['employee'=>$e,'present'=>$present,'absent'=>count(array_filter($mine,fn($r)=>$r['status']==='Absent')),'late'=>count(array_filter($mine,fn($r)=>$r['status']==='Late')),'rate'=>$scheduledDays ? round($present/$scheduledDays*100,1) : 0]; }
        $labels=[]; $trend=['Present'=>[],'Late'=>[],'Absent'=>[]]; for($i=29;$i>=0;$i--){$date=date('Y-m-d',strtotime("-$i days"));$labels[]=date('M j',strtotime($date));foreach($trend as $status=>$_)$trend[$status][]=count(array_filter($records,fn($r)=>$r['work_date']===$date&&$r['status']===$status));}
        $preFilterEmployeeId = request('employee_id');
        return view('attendance.overview', compact('stats','summary','labels','trend','monthRecords','preFilterEmployeeId'));
    }
    public function records()
    {
        [$employees,$data]=$this->data(); $records=$data['records']; $employeeMap=array_column($employees,null,'employee_id');
        foreach($records as &$r){$r['full_name']=$employeeMap[$r['employee_id']]['full_name']??$r['employee_id'];$r['adjustment_notes']='';} unset($r);
        $preFilterEmployeeId=request('employee_id'); return view('attendance.records',compact('records','preFilterEmployeeId'));
    }
    public function terminal(){ $employees=require resource_path('data/employees.php'); return view('attendance.terminal',compact('employees')); }
    public function adjustments(){ [$employees,$data]=$this->data(); $adjustments=$data['adjustments']; $map=array_column($employees,null,'employee_id'); foreach($adjustments as &$a)$a['full_name']=$map[$a['employee_id']]['full_name']??$a['employee_id']; unset($a); return view('attendance.adjustments',compact('adjustments')); }
}
