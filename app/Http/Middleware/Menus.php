<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Menu;
use Auth;
use URL;

class Menus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        DB::enableQueryLog();
 /*
        $query = DB::table('sys_menus_mst') 
        ->leftjoin('sys_app_mst', function($join){
              $join->on('sys_menus_mst.f_app', '=', 'sys_app_mst.id_app')
              ->where('sys_app_mst.sys_status_aktif','=','A'); 
        })
        ->select('sys_menus_mst.id_menu AS id_menu','sys_menus_mst.root AS root','sys_menus_mst.lvl AS lvl','sys_menus_mst.f_type AS type_menu','sys_menus_mst.urutan AS urutan','sys_menus_mst.nama_menu AS nama_menu','sys_menus_mst.keterangan AS ket_menu','sys_menus_mst.icon AS icon','sys_menus_mst.auth AS auth','sys_menus_mst.sys_status_aktif AS aktif_menu','sys_app_mst.id_app AS id_app','sys_app_mst.nama AS nama','sys_app_mst.f_type AS type_app','sys_app_mst.route AS route','sys_app_mst.link_ AS link_','sys_app_mst.akses_role AS akses_role','sys_app_mst.keterangan AS ket_app','sys_app_mst.sys_status_aktif AS aktif_app')
        ;
*/
        $query = DB::table('V_MENU_APP_AKSES')->where('f_user','*');

        if(!Auth::check()){
          $query->where('auth','T');
        }else{
          $query->OrWhere('f_user', Auth::user()->f_nip_sys);
        }
        // $listMenu = $query->get();
        $listMenu = $query->whereNotNull('root')
        // ->orderByRaw('GetPriority(sys_menus_mst.id_menu), sys_menus_mst.urutan')
        ->orderByRaw('GetPriority(id_menu), urutan')
        ->get();

        // dd(DB::getQueryLog());
        Menu::make('MyNavBar', function($menu) use ($listMenu) {
            $subroot = $subsubroot = null;
            foreach ($listMenu as $key => $value) {

              switch($value->lvl){
                case 1 :
                    $subroot = null;
                    if((!empty($listMenu[$key+1])) and $listMenu[$key+1]->root == $value->id_menu){   
                      $subroot = $menu->add($value->nama_menu);                    
                    }
                break;
                case 2 :
                    if(!empty($subroot)){
                      // dd($listMenu[$key+1]);
                        if((!empty($listMenu[$key+1])) and $listMenu[$key+1]->root == $value->id_menu){   
                           $subsubroot = $subroot->add($value->nama_menu)->prepend('<i class="fa '.$value->icon.'"></i>');
                        }
                        else if(!empty($value->route)) {
                            $subroot->add($value->nama_menu,['url'=>URL::to('/').$value->route])->prepend('<i class="fa '.$value->icon.'"></i>');
                        } 
                    }
                break;
                case 3 : 
                    if(!empty($subsubroot)){
                          $subsubroot->add($value->nama_menu, ['url'=> (!empty($value->route) ? URL::to('/').$value->route : '#')]);
                    }
                break;
                default:
                  $subroot = null;
                break;
              }

            }     
        });

        return $next($request);
    }
}
