<?php

namespace App\Services\Uploader;

use App\Contracts\Uploader;


class ImageUploader implements Uploader {



    public function upload($item) {

		// ------ Upload to disk: storage/app/public/images/products ------

		$imageName = $item->getClientOriginalName();

		$item->storeAs('images/products', $imageName, 'public');


		//  ------ Image hash ------

		$fileHash = substr(md5_file($item->getRealPath()), -20);

        //  ------ Image path for frontend ------

		return '/storage/images/products/' . $imageName . '?id=' . $fileHash;
	}
}
