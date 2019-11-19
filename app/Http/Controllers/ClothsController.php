<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Interfaces\ClothsRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class ClothsController extends Controller
{
    private $clothRepo;
    private $helper;
    public function __construct(
        Helper $helper,
        ClothsRepositoryInterface $clothsRepository
    ) {
        $this->helper = $helper;
        $this->clothRepo = $clothsRepository;
    }

    /**
     * @param Request $request
     * @return mixed|\Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getList(Request $request) {
        $arrData = $request->all();
        $arrResult = $this->clothRepo->getList($arrData);

        if (!$arrResult['success']) {
            return $this->helper->response([], $arrResult['message'], false, 401);
        } else {
            return $this->helper->response($arrResult["data"], $arrResult['message'], true, 200);
        }
    }


    /**
     * @param Request $request
     * @return mixed|\Symfony\Component\HttpFoundation\JsonResponse
     */
    public function addCloths(Request $request) {
        $arrData = $request->all();
        $arrResult = $this->clothRepo->addCloths($arrData);

        if (!$arrResult['success']) {
            return $this->helper->response([], $arrResult['message'], false, 401);
        } else {
            return $this->helper->response($arrResult["data"], $arrResult['message'], true, 200);
        }
    }

    public function deleteCloth(Request $request) {
        $arrData = $request->route('id');
        $arrResult = $this->clothRepo->deleteCloths($arrData);

        if (!$arrResult['success']) {
            return $this->helper->response([], $arrResult['message'], false, 401);
        } else {
            return $this->helper->response($arrResult["data"], $arrResult['message'], true, 200);
        }
    }

    public function updateCloth(Request $request) {
        $arrData = $request->all();
        $arrResult = $this->clothRepo->editCloths($arrData);

        if (!$arrResult['success']) {
            return $this->helper->response([], $arrResult['message'], false, 401);
        } else {
            return $this->helper->response($arrResult["data"], $arrResult['message'], true, 200);
        }
    }

    public function getByID(Request $request) {
        $arrData = $request->route('id');
        $arrResult = $this->clothRepo->getById($arrData);

        if (!$arrResult['success']) {
            return $this->helper->response([], $arrResult['message'], false, 401);
        } else {
            return $this->helper->response($arrResult["data"], $arrResult['message'], true, 200);
        }
    }

}
