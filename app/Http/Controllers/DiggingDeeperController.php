<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateCatalog\GenerateCatalogMainJob;
use App\Models\BlogPost;
use Carbon\Carbon;

class DiggingDeeperController extends Controller {
    public function collections() {
        $result = [];

        $eloquentCollection = BlogPost::withTrashed()->get();

        // dd($eloquentCollection, $eloquentCollection->toArray());

        $collection = collect($eloquentCollection->toArray());

        // dd(get_class($eloquentCollection), get_class($collection), $collection);

        $result['first'] = $collection->first();
        $result['last'] = $collection->last();

        $result['where']['data'] = $collection->where('category_id', 10)->values()->keyBy('id');

        $result['where']['count'] = $result['where']['data']->count();
        $result['where']['isEmpty'] = $result['where']['data']->isEmpty();
        $result['where']['isNotEmpty'] = $result['where']['data']->isNotEmpty();

        $result['where_first'] = $collection->firstWhere('created_at', '>', '2019-01-17 01:35:11');

        $result['map']['all'] = $collection->map(function (array $item) {
           $newItem = new \stdClass();
           $newItem->item_id = $item['id'];
           $newItem->item_name = $item['title'];
           $newItem->exists = is_null($item['deleted_at']);

           return $newItem;
        });

        // dd($result);

        $collection->transform(function (array $item) {
            $newItem = new \stdClass();
            $newItem->item_id = $item['id'];
            $newItem->item_name = $item['title'];
            $newItem->exists = is_null($item['deleted_at']);
            $newItem->created_at = Carbon::parse($item['created_at']);

            return $newItem;
        });

        // dd($collection);
    }

    /**
     * @link http://localhost:8000/digging-deeper/prepare-catalog
     *
     * php artisan queue:listen --queue=generate-catalog --tries=3 --delay=10
     */
    public function prepareCatalog() {
        GenerateCatalogMainJob::dispatch();
    }
}
