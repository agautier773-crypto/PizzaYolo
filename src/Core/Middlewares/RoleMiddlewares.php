<?php
namespace App\Core\Middlewares;

use App\Core\Auth;
use App\Core\Session;

class RoleMiddlewares implements InterfaceMiddlewares {

    public ?array $expected_roles = null;

    public function __construct($expected_roles)
    {
        $expected_roles = explode(',', $expected_roles);
        $this->expected_roles = $expected_roles;
    }
    public function handle() : void {
        $u_roles = Auth::employe()->getRole();
        if (empty(array_intersect($this->expected_roles, $u_roles))){
            Session::setFlash("danger", "Vous n'avez pas les droits !");
            header("location: /");
            exit;
        }
    }
}
