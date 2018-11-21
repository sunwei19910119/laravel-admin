<?php
/**
 * Created by PhpStorm.
 * User: sunwei
 * Date: 2018/11/21
 * Time: 9:34 AM
 */

namespace App\Helpers\Api;

use App\Helpers\Api\ResponseMsg;
use Response;

trait ApiResponse
{
    /**
     * @var int
     */
    protected $statusCode = ResponseMsg::HTTP_OK;
    protected $message = '';
    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {

        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param $data
     * @param array $header
     * @return mixed
     */
    public function respond($data, $header = [])
    {

        return Response::json($data,$this->getStatusCode(),$header);
    }

    /**
     * @param $status
     * @param array $data
     * @param null $code
     * @return mixed
     */
    public function status($status, array $data, $code = null){

        if ($code){
            $this->setStatusCode($code);
        }

        $status = [
            'status' => $status,
            'code' => $this->statusCode
        ];

        $data = array_merge($status,$data);
        return $this->respond($data);

    }

    /**
     * @param $message
     * @param int $code
     * @param string $status
     * @return mixed
     */
    public function failed($message, $code = ResponseMsg::HTTP_BAD_REQUEST, $status = 0){

        return $this->setStatusCode($code)->message($message,$status);
    }

    /**
     * @param $message
     * @param string $status
     * @return mixed
     */
    public function message($message, $status = 1){

        return $this->status($status,[
            'message' => $message
        ]);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function internalError(){
        $this->statusCode = ResponseMsg::HTTP_INTERNAL_SERVER_ERROR;
        $this->message = ResponseMsg::$statusTexts[$this->statusCode];
        return $this->failed($this->message, $this->statusCode);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function created()
    {
        $this->statusCode = ResponseMsg::HTTP_CREATED;
        $this->message = ResponseMsg::$statusTexts[$this->statusCode];
        return $this->setStatusCode( $this->statusCode)
            ->message($this->message);

    }

    /**
     * @param $data
     * @param string $status
     * @return mixed
     */
    public function success($data, $status = 1){

        return $this->status($status,compact('data'));
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function notFond()
    {
        $this->statusCode = ResponseMsg::HTTP_NOT_FOUND;
        $this->message = ResponseMsg::$statusTexts[$this->statusCode];
        return $this->failed(ResponseMsg::$statusTexts,$this->statusCode);
    }

}