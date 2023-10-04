<?php

namespace App\Repositories;

use App\Entities\Category;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * class DocumentRepository
 *
 * @package namespace App\Repositories;
 */
class TicketRepository extends BaseRepository implements RepositoryInterface
{
    protected $fieldSearchable = [
        'description' => 'like',
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Ticket::class;
    }

    public function create(array $attributes)
    {
        return DB::transaction(function () use ($attributes) {

            $title       = $attributes['title'];
            $description = $attributes['description'];
            $user_id     = $attributes['user_id'];
            $category_id = $attributes['category_id'];
            $ticket_status_id   = $attributes['ticket_status_id'];

            $attrs = [
                'title' => $title,
                'description' => $description,
                'category_id' => $category_id,
                'user_id' => $user_id,
                'ticket_status_id' => $ticket_status_id
            ];

            $ticket = parent::create($attrs);

            return $ticket;

        });
    }

    public function save_file($ticket, $file){
        if (!empty($file)) {

            /*$name = $file->getFilename();
            $path = Storage::putFileAs(
                "ticket-files/$ticket->id",
                $file,
                $name,
                'public'
            );

            if (!$path) {
                throw ValidationException::withMessages(['error' => "Problem with the attachment"]);
            }

            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();*/

            $path = "ticket-files/$ticket->id";

            $path = Storage::disk('local')->put($path, $file);

            $ticket->path = $path;
            $ticket->name_file = $file->getClientOriginalName();
            $ticket->update();
        }
    }

    public function update_val($id, $attributes){

        $ticket = $this->model()::where('id', $id)->first();
        $ticket->title       = $attributes['title'];
        $ticket->description = $attributes['description'];
        $ticket->category_id = $attributes['category_id'];
        $ticket->update();

        return $ticket;
    }

    public function alter_status($id,$ticket_status_id, $data = null){

        $ticket = $this->model()::where('id', $id)->first();
        $ticket->ticket_status_id = $ticket_status_id;
        if ($ticket_status_id == 3 && !empty($data)){
            $ticket->resolution = $data['resolution'];
        }
        $ticket->update();

        return $ticket;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
