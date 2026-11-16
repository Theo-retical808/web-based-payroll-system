<?php

namespace App\Http\Controllers;

class PayrollController extends Controller
{
    private function allPeriods(): array { return (require resource_path('data/payroll.php'))['periods']; }
    private function totals(array $records): array { return ['gross'=>array_sum(array_column($records,'gross_pay')),'deductions'=>array_sum(array_column($records,'deductions')),'net'=>array_sum(array_column($records,'net_pay'))]; }
    public function overview()
    {
        $periods=$this->allPeriods(); $employees=require resource_path('data/employees.php'); $stats=['periods'=>count($periods),'finalized'=>0,'net'=>0,'pending'=>0];
        foreach($periods as &$p){$p['totals']=$this->totals($p['records']); if($p['status']==='Finalized'){$stats['finalized']++;$stats['net']+=$p['totals']['net'];}else $stats['pending']++;} unset($p);
        $labels=array_column($periods,'period_label');$values=array_map(fn($p)=>$p['totals']['net'],$periods);return view('payroll.overview',compact('periods','stats','labels','values'));
    }
    public function periods(){ $periods=$this->allPeriods(); foreach($periods as &$p)$p['totals']=$this->totals($p['records']);unset($p); return view('payroll.periods',compact('periods')); }
    public function records($periodId)
    {
        $period=collect($this->allPeriods())->firstWhere('id',(int)$periodId);abort_if(!$period,404);$employees=require resource_path('data/employees.php');$map=array_column($employees,null,'employee_id');
        foreach($period['records'] as &$r){$r['full_name']=$map[$r['employee_id']]['full_name']??$r['employee_id'];$r['pay_rate']=$map[$r['employee_id']]['pay_rate']??0;}unset($r);$totals=$this->totals($period['records']);return view('payroll.records',compact('period','totals'));
    }
    public function payslip($periodId,$employeeId)
    {
        $period=collect($this->allPeriods())->firstWhere('id',(int)$periodId);abort_if(!$period,404);$record=collect($period['records'])->firstWhere('employee_id',$employeeId);abort_if(!$record,404);$employees=require resource_path('data/employees.php');$employee=collect($employees)->firstWhere('employee_id',$employeeId);abort_if(!$employee,404);return view('payroll.payslip',compact('period','record','employee'));
    }
}
