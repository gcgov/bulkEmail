<?php

namespace gcgov\framework\services\bulkEmail\models;

class message {

	public ?template $template = template::countyTemplate2023;

	public ?string $sendingDepartmentId = null;

	public string $subject = '';

	public string $message = '';

	/**  @var string[] $cc */
	public array $cc = [];

	/**  @var string[] $bcc */
	public array $bcc = [];

	public int $priority = 1000; //lower is higher priority

	public string $reference = '';

	/** @var \gcgov\framework\services\bulkEmail\models\attachment[] $attachments */
	public array $attachments = [];


	/**
	 * @throws \gcgov\framework\services\bulkEmail\exceptions\bulkEmailException
	 */
	public function addAttachment( string $filePathname ): void {
		$this->attachments[] = new attachment( $filePathname );
	}


	public function removeAttachment( string $filename ): void {
		foreach( $this->attachments as $i => $attachment ) {
			if( $attachment->filename==$filename ) {
				unset( $this->attachments[ $i ] );
			}
		}

		$this->attachments = array_values( $this->attachments );
	}

}
