<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BreakupController extends Controller
{

    public function index(Request $request)
    {
        $this->validate($request, [
            'text' => 'required',
            'count' => 'required|numeric'
        ]);
        
        $newText = [];

        $chunks = explode(';', $request->text);

        foreach ($chunks as $chunk => $text) {
            $newText[] = $this->break($text, $request->count);
        }
        return view('broken', compact(['newText']));
    }

    /**
     * Break a chunk of text into smaller chunks
     * @param  String $chunk The chunk of text to be broken up
     * @return Array         An array of smaller chunks
     */
    private function break($chunk, $size)
    {
        $return = [];
        $x = 0;

        while($x <= strlen($chunk)) {
            $return[] = substr($chunk,$x,$size);
            $x+= $size;
        }

        return $return;
    }

}
