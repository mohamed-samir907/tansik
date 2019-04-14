<?php

namespace App;

use Validator;
use File;
use ImageOptimizer;

/**
 * This class contain some helper functions
 */
class MyHelper
{
	/**
	 * Upload Image to Path
	 * 
	 * @param  object $requestImage
	 * @param  string $uplPath
	 * @param  bool $update
	 * @param  string $oldImage
	 * @return string 
	 */
	public static function uploadImage($requestImage, $uplPath, $update = false, $oldImage = '')
	{
		$image = $requestImage;

		list($width, $height) = getimagesize($image);

		if ($width == 0 || $height == 0)
			return 'invalid_dimensions';

		if ($update != false)
			self::removeImage($oldImage);

		$imageName = $image->getClientOriginalName();
		$extension = $image->getClientOriginalExtension();

		$uploadPath = rtrim($uplPath, '/');
		$newName = 'image_' . time() . '_' . mt_rand(1, 1000000000) . '.' . $extension;

		if ($image->move($uploadPath, $newName)) {
			
			$pathToImage = $uploadPath . '/' . $newName;
			
			return $pathToImage;
		}
		else {
			return 'unexpected_error';
		}
	}

	/**
	 * Remove an Image
	 * 
	 * @param  string $path
	 * @return bool
	 */
	public static function removeImage($path)
	{
		if (file_exists($path)) {
			File::delete($path);
			return true;
		}

		return false;
	}

	/**
	 * Compress The Image
	 * 
	 * @param  string $source_url
	 * @param  string $destination_url
	 * @param  int $quality
	 * @return string
	 */
	public static function compressImage($source_url, $destination_url, $quality)
	{
		$info = getimagesize($source_url);

		if ($info['mime'] == 'image/jpeg')
			$image = imagecreatefromjpeg($source_url);
		elseif ($info['mime'] == 'image/gif')
			$image = imagecreatefromgif($source_url);
		elseif ($info['mime'] == 'image/png')
			$image = imagecreatefrompng($source_url);

		imagejpeg($image, $destination_url, $quality);

		return $destination_url;
	}

	/**
	 * Validate the image field
	 * 
	 * @return Validator
	 */
	public static function validateImage($request, $inputName = 'image', $mimes = 'jpeg,jpg,png,gif', $maxSize = 5000)
	{
		$valid = Validator::make($request, [
			"$inputName" => "bail|required|mimes:" . $mimes . "|max:" . $maxSize
		], [], [
			"$inputName.required" => 'The image is required',
            "$inputName.mimes" => 'The image must be in type of (jpeg, jpg, png, gif)',
            "$inputName.max" => 'The image can not be more than ' . ($maxSize/1024) . ' MB'
		]);

		return $valid->messages()->messages();
	}

	/**
	 * Santize a given fields to be a valid string
	 * 
	 * @return array
	 */
	public static function sanitizeString()
	{
		$fields = func_get_args();
		$sanitized = [];

		foreach ($fields as $field) {
			$str = strip_tags($field);
			$str = filter_var($str, FILTER_SANITIZE_STRING);
			$str = htmlentities($str, ENT_QUOTES, "UTF-8");
			array_push($sanitized, $str);
		}

		return $sanitized;
	}

	/**
	 * Sanitize a given fields to be a valid integers
	 * 
	 * @return array
	 */
	public static function sanitizeInteger()
	{
		$fields = func_get_args();
		$sanitized = [];

		foreach ($fields as $field) {
			$num = filter_var($field, FILTER_SANITIZE_NUMBER_INT);
			array_push($sanitized, $num);
		}

		return $sanitized;
	}

	/**
	 * Sanitize a given fields to be a valid Float
	 * 
	 * @return array
	 */
	public static function sanitizeFloat()
	{
		$fields = func_get_args();
		$sanitized = [];

		foreach ($fields as $field) {
			$num = filter_var($field, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			array_push($sanitized, $num);
		}

		return $sanitized;
	}

	/**
	 * Convert the date to timestamp
	 * 
	 * @param  date $date
	 * @return date
	 */
	public static function toTimestamp($date)
	{
		return date('Y-m-d H:i:s',  strtotime($date));
	}
}