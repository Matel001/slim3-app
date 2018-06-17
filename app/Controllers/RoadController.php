<?php
/**
 * Created by PhpStorm.
 * User: matel
 * Date: 14.06.18
 * Time: 14:44
 */

namespace App\Controllers;

use PDO;
use App\Models\Roads;
use Respect\Validation\Validator as v;
class RoadController extends Controller
{
    public function show($request, $response){

        $roads = $this->c->db->query("SELECT * FROM roads")->fetchAll(PDO::FETCH_CLASS, Roads::class);

        return $this->c->view->render($response, 'roads.twig', compact('roads'));
    }

    public function get($request, $response){
        $_SESSION['errors'] =[];
        $this->c->view->render($response, 'add-road.twig');
    }
    public function post($request, $response, $args){
        $validation = $this->c->validator->validate($request,[
            'load_place' => v::notEmpty()->alpha(),
            'load_date' => v::notEmpty(),
            'unload_place' => v::notEmpty()->alpha(),
            'unload_date' => v::notEmpty(),
            'spedition' => v::notEmpty()
        ]);

        if($validation->failed()){
            return $response->withRedirect('http://localhost/trans/public/add-road');
        }

        Roads::create([
           'load_place' =>  $request->getParam('load_place'),
           'load_date' =>  $request->getParam('load_date'),
           'unload_place' =>  $request->getParam('unload_place'),
           'unload_date' =>  $request->getParam('unload_date'),
           'spedition' =>  $request->getParam('spedition'),
           'comment' =>  $request->getParam('comment')
       ], $this->c);

       return $response->withRedirect('http://localhost/trans/public/main');    // tutaj trzeba pogmerać $this->router->pathFor()
    }
}