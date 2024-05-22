<?php

namespace gcgov\framework\services\bulkEmail\models;

use gcgov\framework\services\bulkEmail\exceptions\bulkEmailException;

class attachment {

	public ?string $_id                  = null;
	public string  $filename             = '';
	public string  $base64EncodedContent = '';


	/**
	 * @param string $filePathname
	 *
	 * @throws \gcgov\framework\services\bulkEmail\exceptions\bulkEmailException
	 */
	public function __construct( string $filePathname='' ) {
		if(empty($filePathname)) {

		}
		elseif( file_exists( $filePathname ) ) {
			$this->filename             = basename( $filePathname );
			$this->base64EncodedContent = base64_encode( file_get_contents( $filePathname ) );
		}
		else {
			throw new bulkEmailException( $filePathname . ' is not a file' );
		}
	}

}
