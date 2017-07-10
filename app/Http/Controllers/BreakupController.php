<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BreakupController extends Controller
{

    public function index(Request $request)
    {
        //Here we check if the user has given us valid input
        $this->validate($request, [
            'text' => 'required',
            'count' => 'required|numeric'
        ]);
        
        //newText will hold all of the chunks of text
        $newText = [];

        //Break up the text the user sent through into big chunks at every semicolon
        //We can visualise it like this
        //['Chunk 1', 'Chunk 2', 'Chunk 3']
        $chunks = explode(';', $request->text);

        //For every chunk that we make, break it into the size chunks that the user asks for
        //We can visualise it like this:
        //[[Chunk 1a, Chunk 1b, Chunk 1c], [Chunk 2a, Chunk 2b], [Chunk 3a... etc]]
        foreach ($chunks as $chunk => $text) {
            $newText[] = $this->break($text, $request->count);
        }

        //Make a temporary text file that has all of the chunks together
        $textFile = $this->generateTextFile($newText);

        //Show the user the pretty version
        return view('broken', compact(['newText', 'textFile']));
    }

    /**
     * Break a chunk of text into smaller chunks
     * @param  String $chunk The chunk of text to be broken up
     * @return Array         An array of smaller chunks
     */
    private function break($chunk, $size)
    {
        //This will contain all the small chunks
        $return = [];
        $x = 0;

        //While the variable $x is less than the length of the big chunk
        while($x <= strlen($chunk)) {
            //Add a small chunk to what we will show to the user
            $return[] = substr($chunk,$x,$size);
            //Add the length of the small chunk to $x, 
            //so that when this function repeats
            //it will start further into the big chunk
            $x+= $size;
        }

        //return all the smaller chunks
        return $return;
    }

    /**
     * This function loops through the small chunks we've created
     * and writes them to a text file
     * @param  Array $text Array of arrays of short chunks of text
     * @return String       Location of the text file, to give to the user
     */
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
