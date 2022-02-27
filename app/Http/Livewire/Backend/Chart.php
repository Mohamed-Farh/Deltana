<?php

namespace App\Http\Livewire\Backend;

use App\Models\ProjectDetails;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart extends Component
{
    public $monthLabels = [];
    public $monthValues = [];

    public function mount()
    {
        $orders = ProjectDetails::select(DB::raw('COUNT(id) as revenue'), DB::raw('Month(created_at) as month'))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('Month(created_at)'))
            ->pluck('revenue', 'month');


        foreach ($orders->keys() as $month_number) {
            $this->monthLabels[] = date('F', mktime(0, 0, 0, $month_number, 1));
        }
        $this->monthValues = $orders->values()->toArray();
    }

    public function render()
    {
        return view('livewire.backend.chart');
    }
}
