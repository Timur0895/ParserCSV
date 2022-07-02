<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPSTORM_META\map;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function getFile(Request $request)
    {
        //dd($request->hasFile('file'));
        if ($request->hasFile('file')) {
            $fileName = time().'_'.request()->file->getClientOriginalName();            
            request()->file('file')->storeAs('reports', $fileName, 'public');
            //dd($request);
            $file = storage_path('app/public/reports/'.$fileName);
        } else {
            return back();
        }

        //dd($file);

        $file_handle = fopen($file, 'r');                                                 
                                                                                            

        //dd($file_handle);
        if ($file_handle !== FALSE) {
            while (($data = fgetcsv($file_handle, 1000, ';')) !== FALSE) {
                list($item_name, $type, $parent, $relation) = $data;
                $csv[] = [
                    'item_name' => $item_name,
                    'type' => $type,
                    'parent' => $parent,
                    'relation' => $relation
                ];
            }
            fclose($file_handle);
        };

        //dd(array($csv));

        $new = array();
        foreach($csv as $a)
        {
            $new[$a['parent']][] = $a;
        }

        //dd($new[""]);

        function createTree(&$list, $parent) {
            $tree = array();
            foreach($parent as $k => $i)
            {
                if(isset($list[$i['item_name']]))
                {
                    $i['children'] = createTree($list, $list[$i['item_name']]);
                }
                $tree[] = $i;
            }
            return $tree;
        }

        $tree = createTree($new, $new[""]);

        
        //dd($tree);
        
        Storage::disk('public')->put('results/'.time().'-'.'output.json', json_encode($tree));
        
        $file = time().'-'.'output.json';


        //dd($file);

        return view('welcome')->with('file', $file);
    }

    public function download($file)
    {
        return response()->download(storage_path('app/public/results/'.$file));
    }
}
