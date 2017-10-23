<?php

namespace Displore\Blog\Responses;

use Illuminate\Contracts\Support\Responsable;

abstract class Response implements Responsable
{
    protected $view;
    protected $data;
    protected $withs = [];

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        if ($request->wantsJson()) {
            return response()->json($this->data);
        }
        return view($this->view, $this->data)->with($this->withs);
    }

    public function withMessage($message)
    {
        $this->withs['message'] = $message;
    }

    public function withError($error)
    {
        $this->withs['errors'] = $error;
    }
}