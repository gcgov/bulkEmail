<?php

namespace gcgov\framework\services\bulkEmail;

use GuzzleHttp\Exception\GuzzleException;

class bulkEmail {

	/**
	 * @throws \gcgov\framework\services\bulkEmail\exceptions\bulkEmailException
	 */
	protected static function validateRuntimeConfiguration(): bool {
		if(empty(\gcgov\framework\services\bulkEmail\config::getApiUrl())) {
			throw new \gcgov\framework\services\bulkEmail\exceptions\bulkEmailException( 'Bulk email api url not set. Prior to calling subscribe you must set \gcgov\framework\services\bulkEmail\config::setApiUrl( \'https://bulkemailapi.example.com\' );' );
		}
		if(empty(\gcgov\framework\services\bulkEmail\config::getApiAccessToken())) {
			throw new \gcgov\framework\services\bulkEmail\exceptions\bulkEmailException( 'Bulk email api url not set. Prior to calling subscribe you must set \gcgov\framework\services\bulkEmail\config::setApiAccessToken( \'jwt\' );' );
		}
		return true;
	}

	/**
	 * @param string[] $emailAddresses
	 * @param string[] $channelIds
	 * @param bool     $force Subscribe email address even if they previously unsubscribed
	 *
	 * @return void
	 * @throws \gcgov\framework\services\bulkEmail\exceptions\bulkEmailException
	 */
	public static function subscribe( array $emailAddresses = [], array $channelIds = [], bool $force=true ): void {
		static::validateRuntimeConfiguration();

		$client = new \GuzzleHttp\Client( [ 'base_uri' => \gcgov\framework\services\bulkEmail\config::getApiUrl() ] );
		try {
			$response = $client->request( 'POST', 'subscribe', [
				'json' => [
					'emailAddresses' => $emailAddresses,
					'channelIds'     => $channelIds,
					'force'          => $force,
				],
				'headers'=>[
					'Authorization' => 'Bearer ' . \gcgov\framework\services\bulkEmail\config::getApiAccessToken(),
				]
			] );
		}
		catch( GuzzleException $e ) {
			if(\gcgov\framework\services\bulkEmail\config::isDebugLogging()) {
				$logger = \gcgov\framework\services\bulkEmail\config::getDebugLogger();
				$logger->error( $e->getMessage() );
			}
			error_log($e);
			throw new \gcgov\framework\services\bulkEmail\exceptions\bulkEmailException( 'Subscription failed because the email delivery service could be reached' );
		}
	}

	/**
	 * @param string[] $emailAddresses
	 * @param string   $channelId
	 * @param bool     $force Subscribe email address even if they previously unsubscribed
	 *
	 * @return void
	 * @throws \gcgov\framework\services\bulkEmail\exceptions\bulkEmailException
	 */
	public static function syncChannel( array $emailAddresses = [], string $channelId='', bool $force=false ): void {
		static::validateRuntimeConfiguration();

		$client = new \GuzzleHttp\Client( [ 'base_uri' => \gcgov\framework\services\bulkEmail\config::getApiUrl() ] );
		try {
			$response = $client->request( 'POST', 'subscribe/syncChannel', [
				'json' => [
					'emailAddresses' => $emailAddresses,
					'channelId'      => $channelId,
					'force'          => $force,
				],
				'headers'=>[
					'Authorization' => 'Bearer ' . \gcgov\framework\services\bulkEmail\config::getApiAccessToken(),
				]
			] );
			if(\gcgov\framework\services\bulkEmail\config::isDebugLogging()) {
				$logger = \gcgov\framework\services\bulkEmail\config::getDebugLogger();
				$logger->debug( $response->getBody() );
			}
		}
		catch( GuzzleException $e ) {
			if(\gcgov\framework\services\bulkEmail\config::isDebugLogging()) {
				$logger = \gcgov\framework\services\bulkEmail\config::getDebugLogger();
				$logger->error( $e->getMessage() );
			}
			error_log($e);
			throw new \gcgov\framework\services\bulkEmail\exceptions\bulkEmailException( 'Subscription failed because the email delivery service could be reached' );
		}
	}


	/**
	 * @param \gcgov\framework\services\bulkEmail\models\messageToChannel $message
	 *
	 * @return void
	 * @throws \gcgov\framework\services\bulkEmail\exceptions\bulkEmailException
	 */
	public static function messageToChannel( \gcgov\framework\services\bulkEmail\models\messageToChannel $message ): void {
		static::validateRuntimeConfiguration();

		$client = new \GuzzleHttp\Client( [ 'base_uri' => \gcgov\framework\services\bulkEmail\config::getApiUrl() ] );
		try {
			$client->request( 'POST', 'message/toChannel', [
				'json' => $message,
				'headers'=>[
					'Authorization' => 'Bearer ' . \gcgov\framework\services\bulkEmail\config::getApiAccessToken(),
				]
			] );
		}
		catch( GuzzleException $e ) {
			if(\gcgov\framework\services\bulkEmail\config::isDebugLogging()) {
				$logger = \gcgov\framework\services\bulkEmail\config::getDebugLogger();
				$logger->error( $e->getMessage() );
			}
			error_log($e);
			throw new \gcgov\framework\services\bulkEmail\exceptions\bulkEmailException( 'Sending messages failed' );
		}
	}

	/**
	 * @param \gcgov\framework\services\bulkEmail\models\messageToEmail $message
	 *
	 * @return void
	 * @throws \gcgov\framework\services\bulkEmail\exceptions\bulkEmailException
	 */
	public static function messageToEmail( \gcgov\framework\services\bulkEmail\models\messageToEmail $message ): void {
		static::validateRuntimeConfiguration();

		$client = new \GuzzleHttp\Client( [ 'base_uri' => \gcgov\framework\services\bulkEmail\config::getApiUrl() ] );
		try {
			$client->request( 'POST', 'message/toEmail', [
				'json' => $message,
				'headers'=>[
					'Authorization' => 'Bearer ' . \gcgov\framework\services\bulkEmail\config::getApiAccessToken(),
				]
			] );
		}
		catch( GuzzleException $e ) {
			if(\gcgov\framework\services\bulkEmail\config::isDebugLogging()) {
				$logger = \gcgov\framework\services\bulkEmail\config::getDebugLogger();
				$logger->error( $e->getMessage() );
			}
			error_log($e);
			throw new \gcgov\framework\services\bulkEmail\exceptions\bulkEmailException( 'Sending messages failed' );
		}
	}

}