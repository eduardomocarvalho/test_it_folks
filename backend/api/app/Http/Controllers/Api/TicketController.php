<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendTicketRequest;
use App\Models\Ticket;
use App\Repositories\TicketRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class TicketController extends Controller
{
   public function __construct(protected TicketRepository $repository)
    {
    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel_ticket($id)
    {
        $ticket = $this->repository->alter_status($id,4);
        if (!empty($ticket)){
            return new JsonResponse(['success' => true, 'message' => "Ticket was cancel."], 200);
        }
        return new JsonResponse(['success' => false, 'message' => "Error."], 422);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function close_ticket(Request $request, $id)
    {
        $ticket = $this->repository->alter_status($id,3,$request->all());
        if (!empty($ticket)){
            return new JsonResponse(['success' => true, 'message' => "Ticket was close."], 200);
        }
        return new JsonResponse(['success' => false, 'message' => "Error."], 422);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function accept_ticket($id)
    {
        $ticket = $this->repository->alter_status($id,2);
        if (!empty($ticket)){
            return new JsonResponse(['success' => true, 'message' => "Ticket was accepted."], 200);
        }
        return new JsonResponse(['success' => false, 'message' => "Error."], 422);
    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->repository->with(['category', 'user','status'])
            ->orderBy('created_at', 'desc')
            ->all();
    }

    /**
     * Adicionar o Ticket.
     *
     * @param  App\Http\Requests\SendDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $request['user_id'] = $user->id;
        $ticket = $this->repository->create($request->all());

        if (!empty($ticket)){
            if(!empty($request->file)){
                $this->repository->save_file($ticket,$request->file);
            }
            return new JsonResponse(['success' => true, 'message' => "Ticket created."], 200);
        }
        return new JsonResponse(['success' => false, 'message' => "Error."], 422);
    }

    /**
     * Editar o Ticket.
     *
     * @param  App\Http\Requests\SendDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, SendTicketRequest $request)
    {
        $user = Auth::user();
        $request['user_id'] = $user->id;
        $ticket = $this->repository->update_val($id,$request->all());

        if (!empty($ticket)){
            if(!empty($request->file)){
                $this->repository->save_file($ticket,$request->file);
            }
            return new JsonResponse(['success' => true, 'message' => "Ticket was updated."], 200);
        }
        return new JsonResponse(['success' => false, 'message' => "Error."], 422);
    }

    public function file_download($id)
    {
        $file = Ticket::findOrFail($id);
        return Storage::download($file->path, $file->name_file,[
            'name_file' => $file->name_file,
        ]);

    }

}
