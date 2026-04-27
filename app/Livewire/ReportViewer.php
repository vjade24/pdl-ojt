<?php

namespace App\Livewire;

use App\Models\Jailbook;
use Carbon\Carbon;
use Livewire\Component;

class ReportViewer extends Component
{
    public function render()
    {
        return view('livewire.report-viewer');
    }
}