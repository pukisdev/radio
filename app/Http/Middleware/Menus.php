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

        // $listMenu =  DB::table('sys_menus_mst AS l1')
        //             ->select('l1.id_menu as id1', 'l1.nama_menu as menu1', 'l1.level', 'l2.id_menu as id2', 'l2.nama_menu as menu2', 'l3.id_menu as id3', 'l3.nama_menu as menu3', 'l4.id_menu as id4', 'l4.nama_menu as menu4')
        //             ->leftJoin('sys_menus_mst AS l2', function($join){
        //                 $join->on('l1.root','=','l2.id_menu')
        //                 ->where('l2.sys_status_aktif','=','A');
        //             })
        //             ->leftJoin('sys_menus_mst AS l3', function($join){
        //                 $join->on('l2.root','=','l3.id_menu')
        //                 ->where('l3.sys_status_aktif','=','A');
        //             })
        //             ->leftJoin('sys_menus_mst AS l4', function($join){
        //                 $join->on('l3.root','=','l4.id_menu')
        //                 ->where('l4.sys_status_aktif','=','A');
        //             })->where('l1.sys_status_aktif','A')->get();

//irwan haryanto
        $query = DB::table('v_menu_app')->whereNotNull('root');//->get();
        if(!Auth::check()){
          $query->where('auth','T');
        }
        $listMenu = $query->get();

        Menu::make('MyNavBar', function($menu) use ($listMenu) {
            $subroot = $subsubroot = null;
            foreach ($listMenu as $key => $value) {

              switch($value->level){
                case 1 :
                    $subroot = null;
                    $subroot = $menu->add($value->nama_menu);                    
                break;
                case 2 :
                    if(!empty($subroot)){
                        if((!empty($listMenu[$key+1])) and $listMenu[$key+1]->root == $value->id_menu){   
                           $subsubroot = $subroot->add($value->nama_menu)->prepend('<i class="fa '.$value->icon.'"></i>');
                        }
                        else {
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
                // if($value->level == 1){
                //     $subroot = null;
                //     $subroot = $menu->add($value->nama_menu);
                // }else {
                //     // null;

                //   if(!empty($subroot)){
                //       if((!empty($listMenu[$key+1])) and $listMenu[$key+1]->root == $value->id_menu){   
                //          $subsubroot = $subroot->add($value->nama_menu)->prepend('<i class="fa fa-bank"></i>');
                //       }
                //       else {
                //           $subroot->add($value->nama_menu,['url'=>$value->route])->prepend('<i class="fa fa-home"></i>');
                //       }

                //   }

                //   if(!empty($subsubroot)){
                //       $subsubroot->add($value->nama_menu, ['url'=>$value->route]);
                //   }
                // }

            }                
            // $menu->add('Home',     array('action'  => 'PMS\customerController@_index', 'class' => 'navbar navbar-home', 'id' => 'home'));

            // $menu->add('About', array('url'  => 'mst/customer', 'class' => 'navbar navbar-about dropdown'));  // URL: /about 

            // $menu->group(array('prefix' => 'about'), function($m){
            //  $m->add('Who we are?', 'who-we-are');   // URL: about/who-we-are
            //  $m->add('What we do?', 'what-we-do');   // URL: about/what-we-do
            // });

            // $menu->add('Contact',  'contact');
              // $subroot->add('Home',['url'=>'mst/pms/customer'])->prepend('<span class="glyphicon glyphicon-user"></span> ');
            /*
              $subroot = $menu->add('General');
              $subroot->add('Home',['url'=>'mst/pms/customer'])->prepend('<i class="fa fa-home"></i>');
              $subsubroot = $subroot->add('Company Profile')->prepend('<i class="fa fa-bank"></i>');//,    array('url'  => 'mst/pms/customer'));
              $subsubroot->add('Sejarah');//,    array('url'  => 'mst/pms/customer'));
              $subsubroot->add('Struktur Organisasi');//,    array('url'  => 'mst/pms/customer'));
              $subsubroot->add('Peraturan Perusahaan');//,    array('url'  => 'mst/pms/customer'));
              $subsubroot->add('...');//,    array('url'  => 'mst/pms/customer'));
              
              $subsubroot = $subroot->add('Serabutan')->prepend('<i class="fa fa-navicon"></i>');
              $subsubroot->add('Download');//,    array('url'  => 'mst/pms/customer'));
              $subsubroot->add('Gallery');//,    array('url'  => 'mst/pms/customer'));
              $subsubroot->add('Event');//,    array('url'  => 'mst/pms/customer'));
              $subsubroot->add('Extension');//,    array('url'  => 'mst/pms/customer'));
              $subsubroot->add('...');//,    array('url'  => 'mst/pms/customer'));
            */
              // $whoAreWe = $about->add('Who are we');
              // $whoAreWe->add('nothing', array('url'  => 'mst/pms/customer'));
              // $about->add('What we do?', 'mst/pms/customer');

              // $menu->add('services', 'services');
              // $menu->add('Contact',  'contact');
        });

        return $next($request);
    }
}
