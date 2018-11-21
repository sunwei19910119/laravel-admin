<?php

namespace App\Helpers\Api;

use Dingo\Api\Http\Response\Format\Format;
use Dingo\Api\Http\Response\Format\JsonOptionalFormatting;
use Illuminate\Support\Str;
use Illuminate\Contracts\Support\Arrayable;

class DingoResponse extends Format
{
    /*
     * JSON format (as well as JSONP) uses JsonOptionalFormatting trait, which
     * provides extra functionality for the process of encoding data to
     * its JSON representation.
     */
    use JsonOptionalFormatting,ApiResponse;

    /**
     * Format an Eloquent model.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return string
     */
    public function formatEloquentModel($model)
    {
        $key = Str::singular($model->getTable());

        if (! $model::$snakeAttributes) {
            $key = Str::camel($key);
        }

        return $this->encode([$key => $model->toArray()]);
    }

    /**
     * Format an Eloquent collection.
     *
     * @param \Illuminate\Database\Eloquent\Collection $collection
     *
     * @return string
     */
    public function formatEloquentCollection($collection)
    {
        if ($collection->isEmpty()) {
            return $this->encode([]);
        }

        $model = $collection->first();
        $key = Str::plural($model->getTable());

        if (! $model::$snakeAttributes) {
            $key = Str::camel($key);
        }

        return $this->encode([$key => $collection->toArray()]);
    }

    /**
     * Format an array or instance implementing Arrayable.
     *
     * @param array|\Illuminate\Contracts\Support\Arrayable $content
     *
     * @return string
     */
    public function formatArray($content)
    {
        $content = $this->morphToArray($content);

        array_walk_recursive($content, function (&$value) {
            $value = $this->morphToArray($value);
        });

        return $this->encode($content);
    }

    /**
     * Get the response content type.
     *
     * @return string
     */
    public function getContentType()
    {
        return 'application/json';
    }

    /**
     * Morph a value to an array.
     *
     * @param array|\Illuminate\Contracts\Support\Arrayable $value
     *
     * @return array
     */
    protected function morphToArray($value)
    {
        return $value instanceof Arrayable ? $value->toArray() : $value;
    }

    /**
     * Encode the content to its JSON representation.
     *
     * @param mixed $content
     *
     * @return string
     */
    protected function encode($content)
    {
        if(!empty($content['status_code']) && $content['status_code'] != 200){
            $message = ResponseMsg::$statusTexts[$content['status_code']];
            return $this->failed($message ?: $content['message'],$content['status_code']);
        }

        return $this->success($content);
    }
}
