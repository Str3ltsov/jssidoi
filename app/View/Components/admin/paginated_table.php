<?php

namespace App\View\Components\admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class paginated_table extends Component
{
    /**
     * Create a new component instance.
     */

     public $thead_content;
     public $tbody_content;
     public $paginated;
     public $header_right;

    public function __construct($thead, $tbody, $paginated, $hr = "")
    {
        //
        $this->thead_content = $thead;
        $this->tbody_content = $tbody;
        $this->$paginated = $paginated;
        $this->$header_right = $hr;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.paginated_table');
    }
}
