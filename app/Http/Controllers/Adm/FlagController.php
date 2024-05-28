<?php
namespace Coyote\Http\Controllers\Adm;

use Carbon\Carbon;
use Coyote\Domain\ReportedPost;
use Coyote\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class FlagController extends BaseController
{
    public function index(): View
    {
        $this->breadcrumb->push('Sprawy', route('adm.flag'));
        return $this->view('adm.flag.home')->with([
            'posts' => $this->reportedPosts(),
        ]);
    }

    public function show(Post $post): View
    {
        $this->breadcrumb->push('Sprawy', route('adm.flag'));
        $this->breadcrumb->push('#' . $post->id, route('adm.flag.show', [$post->id]));
        $this->breadcrumb->push('Podgląd', '');

        $arrayFilter = \array_values(\array_filter(
            $this->reportedPosts(),
            fn(ReportedPost $r) => $r->id === $post->id,
        ));
        return $this->view('adm.flag.show')->with([
            'post'    => $arrayFilter[0],
            'backUrl' => route('adm.flag'),
        ]);
    }

    private function reportedPosts(): array
    {
        $query = DB::select(<<<query
            SELECT 
                  posts.id AS post_id,
                  MIN(posts.text)          AS post,
                  MIN(posts.forum_id)      AS forum_id,
                  MIN(forums.slug)         AS forum_slug,
                  MIN(authors.id)          AS author_id,
                  MIN(authors.name)        AS author_name,
                  JSON_AGG(reporters.id)   AS reporter_ids,
                  JSON_AGG(reporters.name) AS reporter_names,
                  MIN(flags.created_at)    AS created_at,
                  MAX(flags.created_at)    AS updated_at
            FROM flags
                 JOIN users AS reporters ON reporters.id = flags.user_id
                 JOIN flag_types ON flags.type_id = flag_types.id
                 JOIN flag_resources ON flags.id = flag_resources.flag_id
                 JOIN posts ON posts.id = flag_resources.resource_id
                 JOIN users AS authors ON authors.id = posts.user_id
                 JOIN forums ON forums.id = posts.forum_id
            WHERE flag_resources.resource_type in ('Coyote\Post')
            GROUP BY posts.id, posts.text
            ORDER BY MAX(flags.created_at) DESC
            LIMIT 20;
            query,);

        return \array_map(
            fn(\stdClass $record) => new \Coyote\Domain\ReportedPost(
                $record->post_id,
                $record->post,
                $record->author_id,
                $record->author_name,
                \json_decode($record->reporter_ids),
                \array_unique(\json_decode($record->reporter_names)),
                new Carbon($record->created_at),
                new Carbon($record->updated_at),
                $record->forum_id,
                $record->forum_slug,
            ),
            $query,
        );
    }
}
