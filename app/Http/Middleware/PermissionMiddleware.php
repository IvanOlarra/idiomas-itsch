<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PermissionMiddleware
{


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $roles)
    {

        //Separar los roles por token
        $token = strtok($roles, "|");

        if ($request->user() === null) {
            abort(403);
        } else {
            //Si solo hay un rol, verificar si el usuario tiene ese rol, en caso contrario
            //se inicializa la bandera en false.
            $allow = $request->user()->hasRole($roles);

            //Se recorre la lista de roles si hay más de uno.
            while ($allow == false && $token !== false) {
                //Si se encuentra que el usuario tiene algún rol de la lista de roles, $allow se vuelve true.
                $allow |= $request->user()->hasRole($token);

                //Se pasa al siguiente token
                $token = strtok("|");
            }

            //Si el usuario no tiene permiso, se prohibe el paso.
            if (!$allow) {
                abort(403);
            }
        }



        //Si no se abortó, se pasa a la página que el usuario había solicitado.
        return $next($request);
    }
}
