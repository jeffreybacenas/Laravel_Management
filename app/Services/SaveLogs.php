<?php

namespace App\Services;

use App\Models\Systemlog;

class SaveLogs {
    
    public function store($moduleName, $actionName, $status, $remarks){
       $systemlog = new Systemlog;
       $systemlog->modulename = $moduleName;
       $systemlog->actionname = $actionName;
       $systemlog->status = $status;
       $systemlog->remarks = $remarks;
       $systemlog->save();
    }
}