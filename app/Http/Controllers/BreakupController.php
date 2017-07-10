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

        $textFile = $this->generateTextFile($newText);

        return view('broken', compact(['newText', 'textFile']));
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

    private function generateTextFile($text) {
        $formattedText = '';
        foreach($text as $largeChunk) {
            foreach($largeChunk as $smallChunk) {
                $formattedText.= $smallChunk;
                $formattedText.= "\n\n\n\n\n\n";
            }
            $formattedText.= "---";
            $formattedText.= "\n\n\n\n\n\n";
        }
        $file_location = '/tmp/brokenText_' . date('Y-m-d_') . rand(1000, 5000) . '.txt';
        $file = file_put_contents(public_path() . $file_location , $formattedText);

        return $file_location;
    }

}
