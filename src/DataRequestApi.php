<?php

namespace o6web\DataRequestApi;

use JsonException;

class DataRequestApi
{
	private string $baseUrl;
	private string $token;

	public function __construct(string $baseUrl, string $token)
	{
		$this->baseUrl = $baseUrl;
		$this->token = $token;
	}

	/**
	 * Make a request to the O6 Data Request API
	 *
	 * @param string $type
	 * @param string $request
	 * @param array $args
	 * @return object|null
	 * @throws JsonException
	 */
	public function request(string $type, string $request, array $args = []): ?object
	{
		$request = trim($request, ' /');
		$request_url = $this->baseUrl . $request;

		$headers = [
			'O6Data-Key: ' . $this->token,
		];

		if (($type === 'GET') && (count($args))) {
			$request_url .= '?' . http_build_query(['args' => $args]);
		}

		$c = curl_init();
		curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($c, CURLOPT_HEADER, 0);
		curl_setopt($c, CURLOPT_VERBOSE, 0);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 1);
		curl_setopt($c, CURLOPT_URL, $request_url);

		switch ($type) {
			case 'POST':
				curl_setopt($c, CURLOPT_POST, 1);
				break;
			case 'GET':
				curl_setopt($c, CURLOPT_HTTPGET, 1);
				break;
			default:
				curl_setopt($c, CURLOPT_CUSTOMREQUEST, $type);
		}

		if ($type !== 'GET') {
			curl_setopt($c, CURLOPT_POSTFIELDS, http_build_query($args));
		}

		$data = curl_exec($c);

		if ($data) {
			return json_decode($data, false, 512, JSON_THROW_ON_ERROR);
		}

		return null;
	}
}