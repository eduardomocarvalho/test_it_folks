<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\CommentaryRepository;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CommentaryController extends Controller
{
   public function __construct(protected CommentaryRepository $repository)
    {
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($ticket_id)
    {
        return $this->repository->with(['user'])
            ->where('ticket_id',$ticket_id)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request['user_id'] = $user->id;
        $ticket = $this->repository->create($request->all());

        if (!empty($ticket)){
            return new JsonResponse(['success' => true, 'message' => "Commentary created."], 200);
        }
        return new JsonResponse(['success' => false, 'message' => "Error."], 422);
    }

}
