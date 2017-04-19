<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Story;

class StoryController extends Controller
{
    /**
     * add new story.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $this->validate($request, [
            'title'       => 'required|max:255',
            'content' => 'required'
            ]);

        $title = $request->get('title');
        $content = $request->get('content');
        $volunteer = $request->get('volunteer_id');

        $story = new Story;
        $story->title = $title;
        $story->content = $content;
        $story->volunteer_id = $volunteer;

        $story->save();

        return response()->json("successfully created",201);
    }

    /**
     * Get All stories.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $stories = Story::all();
        return response()->json($stories,200);
    }
    
    /**
     * Get All stories paginated.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllPaginate()
    {
        $stories = Story::paginate();    // default 15 per page
        return response()->json($stories,200);
    }

    /**
     * Get specific event.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        $story= Story::find($id);
        return response()->json($story,200);
    }

    /**
     * add new story.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'       => 'required|max:255',
            'content' => 'required'
            ]);

        $title = $request->get('title');
        $content = $request->get('content');
        $volunteer = $request->get('volunteer_id');

        $story = Story::find($id);
        $story->title = $title;
        $story->content = $content;
        $story->volunteer_id = $volunteer;

        $story->save();

        return response()->json("successfully edited",200);
    }

    /**
     * Get most recent stories.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMostRecent()
    {
        $stories = Story::orderBy('id', 'desc')->take(3)->get();
        return response()->json($stories,200);
    }
}