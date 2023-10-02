<?php

namespace App\Repositories;

use App\Models\Commentary;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class CommentaryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CommentaryRepository extends BaseRepository implements RepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Commentary::class;
    }

    public function create (array $attributes)
    {
        return DB::transaction(function () use ($attributes) {

            $description = $attributes['description'];
            $user_id     = $attributes['user_id'];
            $ticket_id = $attributes['ticket_id'];

            $attrs = [
                'description' => $description,
                'user_id' => $user_id,
                'ticket_id' => $ticket_id
            ];

            $ticket[] = parent::create($attrs);

            return $ticket;

        });
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
