<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Exception\CommonMarkException;

class MarkdownController extends Controller
{
    /**
     * @throws CommonMarkException
     */
    public function convert(Request $request)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        $converter = new CommonMarkConverter();
        $html = $converter->convert($request->content)->getContent();

        return response()->json([
            'html' => $html
        ]);
    }
}
