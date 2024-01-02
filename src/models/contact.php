<?php

namespace gcgov\framework\services\bulkEmail\models;

class contact extends \andrewsauder\jsonDeserialize\jsonDeserialize {

	public string $_id = '';

	public ?string $emailAddress = '';

	public ?string $name = '';

	public bool $doNotEmail = false;

	/**  @var string[] $cc */
	public array $channelIds = [];


	public function hasChannel( string $_id ): bool {
		return in_array( $_id, $this->channelIds );
	}

}
