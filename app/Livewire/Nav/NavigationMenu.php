<?php

namespace App\Livewire\Nav;

use Livewire\Component;

class NavigationMenu extends Component
{
    public $items = [], $leadCount = 0, $productsCount = 0, $companiesCount = 0;
    // protected $listeners = ['leadSaved' => 'updateLeadCount'];


    // public function updateLeadCount()
    // {
    //     // Recalcula el contador
    //     // Si Jetstream Teams está habilitado, filtra por el equipo actual
    //     if (method_exists(auth()->user(), 'currentTeam') && auth()->user()->currentTeam) {
    //         $teamId = auth()->user()->currentTeam->id;
    //         $this->leadCount = Leads::where('team_id', $teamId)->count();
    //     } else {
    //         $this->leadCount = Leads::count();
    //     }

    //     $this->productsCount = Products::count();
    //     $this->companiesCount = Companies::count();
    //     // Reconstruye el menú si necesitas refrescar badges
    //     $this->buildMenu();
    // }

    protected function buildMenu()
    {
        $this->items = [
            [
                'name' => 'Dashboard',
                'icon' => <<<SVG
                                <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 22 21">
                                    <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                    <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                                </svg>
                                SVG,
                'route' => route('dashboard'),
            ],
            [
                'name' => 'Users',
                'icon' => <<<SVG
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12h4m-2 2v-4M4 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                </svg>
                            SVG,
                'route' => route('user.module'),
            ],
            // Add more items as needed
        ];
    }

    public function mount()
    {
        // if (method_exists(auth()->user(), 'currentTeam') && auth()->user()->currentTeam) {
        //     $teamId = auth()->user()->currentTeam->id;
        //     $this->leadCount = Leads::where('team_id', $teamId)->count();
        // } else {
        //     $this->leadCount = Leads::count();
        // }

        // $this->productsCount = Products::count();
        // $this->companiesCount = Companies::count();
        $this->buildMenu();
    }
    public function render()
    {
        $team = auth()->user()->currentTeam;
        return view('livewire.nav.navigation-menu', compact('team'));
        return view('livewire.nav.navigation-menu');
    }
}
