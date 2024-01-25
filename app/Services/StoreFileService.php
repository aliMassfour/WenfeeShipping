<?php


namespace App\Services;


use App\Models\Order;
use Illuminate\Http\UploadedFile;

class StoreFileService
{
    /**
     * @param UploadedFile $file
     * @param int $orderId
     */
    public function store(UploadedFile $file, int $orderId)
    {
        $path = 'orders/' . $orderId . "/truckDashboard";
        $name = $file->getClientOriginalName();
        $file->move($path, $name);
        return $path . "/" . $name;
    }
}
