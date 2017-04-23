<?php

namespace UniversalCodeDefinition\Controller;

use UniversalCodeDefinition\View\ViewInterface;
use UniversalCodeDefinition\Model\RepositoryModelInterface;
use RuntimeException;

/**
 * @author seeren
 */
class UCDController implements ControllerInterface
{

    private
        /**
         * @var RepositoryModelInterface model
         */
        $model,
        /**
         * @var ViewInterface view
         */
        $view;

    /**
     * Construct UCDController
     * 
     * @param RepositoryModelInterface $model
     * @param ViewInterface $view
     */
    public function __construct(
        RepositoryModelInterface $model,
        ViewInterface $view)
    {
        $this->model = $model;
        $this->view = $view;
    }
    
    /**
     * Is repository
     * 
     * @return boolean
     */
    private function isRepository(): bool
    {
        if (($repository = filter_input(INPUT_GET, "repository"))) {
            $explode = explode("/", $repository);
            foreach ($explode as $input) {
                if (strlen($input) > 50) {
                    return false;   
                }
            }
            if (2 >= count($explode) && array_key_exists(0, $explode)) {
                $this->model->set(
                   $explode[0],
                   (array_key_exists(1, $explode) ? $explode[1] : $explode[0]));
                return true;
            }
        }
        return false;
    }

    /**
     * Execute controller
     * 
     * @return string
     */
    public function execute(): string
    {
        header("Access-Control-Allow-Origin: *");
        $action = strtolower(filter_input(INPUT_SERVER, "REQUEST_METHOD"));
        if (!method_exists($this->model, $action)) {
            $header = "HTTP/1.1 405 Method Not Allowed";
        } else if (!$this->isRepository()) {
            $header = "HTTP/1.1 412 Precondition failed";
        } else if (!isset($header)) {
            try {
                $header = "HTTP/1.1 200 OK";
                $this->model->{$action}();
            } catch (RuntimeException $e) {
                $header = "HTTP/1.1 404 No Found";
            } catch (Throwable $e) {
                $header = "HTTP/1.1 500 Internal Server Error";
            }
        }
        header($header);
        $this->view->update($this->model);
        return $this->view->render();
    }

}
